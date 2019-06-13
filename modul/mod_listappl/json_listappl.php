<?php
require( '../../config/koneksi.php' );

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
	0 => 'cus.nmCust',
	1 => 'cus.regDate',
	2 => 'adm.nama',
	3 => 'sal.salesChannel',
  4 => 'salb.salesChannelBranch',
  5 => 'fin.codeFinCompany',
  6 => 'aps.appStatus',
  7 => 'apa.appAction'
);


// getting total number records without any search
$sql = "select
	cus.nmCust,
 	cus.regDate,
 	adm.nama,
 	sal.salesChannel,
 	salb.salesChannelBranch,
 	fin.codeFinCompany,
 	aps.appStatus,
 	apa.appAction";
$sql.= "from
	m_customer cus
	left join c_saleschannel sal ON sal.idSalesChannel = cus.idSalesChannel
	left join c_saleschannelbranch salb ON salb.idSalesChannelBranch = cus.idSalesChannelBranch and salb.idSalesChannel = sal.idSalesChannel
	left join c_appstatus aps ON aps.idAppStatus = cus.idAppStatus
	left join c_appaction apa ON apa.idAppAction = cus.idAppAction
	left join tbl_admin adm ON adm.id_admin = cus.idUser
	left join m_fincompany fin ON fin.idFinCompany = cus.idFinCompany";
$query=mysqli_query($konek, $sql) or die("blacklist_1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "select
	cus.nmCust,
 	cus.regDate,
 	adm.nama,
 	sal.salesChannel,
 	salb.salesChannelBranch,
 	fin.codeFinCompany,
 	aps.appStatus,
 	apa.appAction";
$sql.= "from
	m_customer cus
	left join c_saleschannel sal ON sal.idSalesChannel = cus.idSalesChannel
	left join c_saleschannelbranch salb ON salb.idSalesChannelBranch = cus.idSalesChannelBranch and salb.idSalesChannel = sal.idSalesChannel
	left join c_appstatus aps ON aps.idAppStatus = cus.idAppStatus
	left join c_appaction apa ON apa.idAppAction = cus.idAppAction
	left join tbl_admin adm ON adm.id_admin = cus.idUser
	left join m_fincompany fin ON fin.idFinCompany = cus.idFinCompany
  WHERE 1 = 1";


// getting records as per search parameters
/* if( !empty($requestData['columns'][0]['search']['value']) ){
	$sql.=" AND jamaahgroup LIKE '".$requestData['columns'][0]['search']['value']."%' ";
} */

//select * from tbl_supplier where sup_kode like 'S0%' and sup_name like 'B%'

if( !empty($requestData['search']['value']) ){
	$sql.=" AND cus.nmCust like '".$requestData['search']['value']."%' or sal.salesChannel like '".$requestData['search']['value']."%' ";
	$sql.=" or salb.salesChannelBranch like '".$requestData['search']['value']."%' or fin.codeFinCompany like '".$requestData['search']['value']."%'  ";
}

$query=mysqli_query($konek, $sql) or die("blacklist_2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

$query=mysqli_query($konek, $sql) or die("blacklist_3");


$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

	$nestedData[] = $row["cus.nmCust"];
	$nestedData[] = $row["cus.regDate"];
	$nestedData[] = $row["adm.nama"];
	$nestedData[] = $row["sal.salesChannel"];
  $nestedData[] = $row["salb.salesChannelBranch"];
	$nestedData[] = $row["fin.codeFinCompany"];
	$nestedData[] = $row["aps.appStatus"];
  $nestedData[] = $row["apa.appAction"];

	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
