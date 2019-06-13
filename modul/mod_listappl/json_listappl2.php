<?php
session_start();
require( '../../config/koneksi.php' );

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
	0 => 'nmCust',
	1 => 'regDate',
	2 => 'nama',
	3 => 'salesChannel',
  4 => 'SalesChannelBranch',
  5 => 'codeFinCompany',
  6 => 'appStatus',
  7 => 'appAction',
	8 => '',
);


// getting total number records without any search
$sql = "select * from v_listappl2 where 1 = 1";
$query=mysqli_query($konek, $sql);

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ){
	$sql.=" and (nmCust like '".$requestData['search']['value']."%') or salesChannel like '".$requestData['search']['value']."%' or SalesChannelBranch like '".$requestData['search']['value']."%' or codeFinCompany like '".$requestData['search']['value']."%'  or appAction like '".$requestData['search']['value']."%' ";
}
if (!empty($requestData['columns'][1]['search']['value'])) {
  $sql.=" and codeFinCompany like '%".$requestData['columns'][1]['search']['value']."%'";
}
if (!empty($requestData['columns'][2]['search']['value'])) {
  $sql .=" and appStatus like '%".$requestData['columns'][2]['search']['value']."%'";
}
if (!empty($requestData['columns'][3]['search']['value'])) {
  $sql .=" and appAction like '%".$requestData['columns'][3]['search']['value']."%'";
}

$query=mysqli_query($konek, $sql) or die($sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY idCust desc  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=mysqli_query($konek, $sql) or die("Maintenance DB");


$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

	$action= "<td class='actions'>
    <a href='?mod=listappl&act=viewappl&id=$row[idCust]' title='View Applicant Detail'> <i class='fa fa-search'></i></a> |
		<a href='?mod=listappl&act=editappl&id=$row[idCust]' title='Edit Applicant Detail'> <i class='fa fa-pencil'></i></a> |
    <a href='?mod=modtrxlogistik&act=viewdatalogistik&nojamaah=$row[noreg_jamaah]' title='Income Summary'> <i class='fa fa-money'></i></a>
    </td>";

	$nestedData[] = $row["nmCust"];
	$nestedData[] = $row["regDate"];
	$nestedData[] = $row["nama"];
	$nestedData[] = $row["salesChannel"];
  $nestedData[] = $row["SalesChannelBranch"];
	$nestedData[] = $row["codeFinCompany"];
	$nestedData[] = $row["appStatus"];
  $nestedData[] = $row["appAction"];
	$nestedData[] = $action;

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
