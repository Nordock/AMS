<?php
header('Access-Control-Allow-Origin: *');
//hit URL
//check_jamaah.php?dname=android&jamaahid=J20130100008&vkey=6401136c27e056619e90b9184c56fad2
//token_id =08c839bcbc189be749154df668660e8c

include "../../../config/koneksi.php";
include "../../../config/Browser.php";
include "../../../config/sendmail_daftar.php";


header('Content-Type: application/json'); 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, x");
header("Access-Control-Allow-Headers: Content-Type, x-xsrf-token");

function get_ip_address()
{
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

//ngitung id_jamaah di tbl_jamaah untuk dijadikan noreg_jamaah
	$max_id    = "SELECT max(id_jamaah) as xid_jamaah FROM tbl_jamaah";
	$hsl_id  = mysqli_query($konek, $max_id);
    $data_id = mysqli_fetch_array($hsl_id);

    //id_jamaah terakhir
	$hasil = $data_id['xid_jamaah'];

    //bikin noreg_jamaah
    $hasil++;
    $char       = "J";
    $thaunbulan = date('Ym');
    $autoreg_no = $char . "6" . $thaunbulan . sprintf("%05s", $hasil);

    //Token
    $tokenid        =  $_POST['tkn_id'];

    // include "Browser.php";
    // $browser      = new Browser();
    // $browser_info = $browser->getBrowser();


    $true_ip = get_ip_address();
	 
	$id_login           =  $_POST['id_login']; 
	$realname           =  $_POST['realname'];
    $email              =  $_POST['email'];
    $jskelamin          =  $_POST['jskelamin'];
    $tgllahir           =  $_POST['tgllahir'];
    $tempatlahir        =  $_POST['tempatlahir'];
    $gol_darah          =  $_POST['gol_darah'];
    $statuspernikahan   =  $_POST['statuspernikahan'];
    $nama_ayah          =  $_POST['nama_ayah'];
    $pendidikan         =  $_POST['pendidikan'];
    $pekerjaan          =  $_POST['pekerjaan'];
    $nama_darurat       =  $_POST['nama_darurat'];
    $hubungan_darurat   =  $_POST['hubungan_darurat'];
    $notlp_darurat      =  $_POST['notlp_darurat'];
    $alamat_darurat     =  $_POST['alamat_darurat'];
    $jenisid            =  $_POST['jenisid'];
    $noid               =  $_POST['noid'];
    $nopasspor          =  $_POST['nopasspor'];
    $tgldikeluarkan     =  $_POST['tgldikeluarkan'];
    $paspordikeluarkan  =  $_POST['paspordikeluarkan'];
    $massaberlakupaspor =  $_POST['massaberlakupaspor'];
    $alamat             =  $_POST['alamat'];
    $kota               =  $_POST['kota'];
    $provinsi           =  $_POST['provinsi'];
    $telephone          =  $_POST['telephone'];
    $hp                 =  $_POST['hp'];
    $penyakit           =  $_POST['penyakit'];
    $infoft             =  $_POST['infoft'];
    $namapaket          =  $_POST['namapaket'];
    $hargapaket         =  $_POST['hargapaket'];
    $jspembayaran       =  $_POST['jspembayaran'];  
    $metodepembayaran   =  $_POST['metodepembayaran'];
	$tokenid        	=  $_POST['tkn_id'];
	$muhrim   			=  $_POST['muhrim'];
	$kode_agen        	=  $_POST['kode_agen'];
	$bulanberangkat   	=  $_POST['bulanberangkat'];
	$tahunberangkat     =  $_POST['tahunberangkat'];
	$lamamenabung     	=  $_POST['lamamenabung'];
	$kodeBulan     		=  $_POST['kodeBulan'];
	
	if($namapaket == "DES 2017"){
		$paketnama = "Special Seat 2017"; 
	}elseif($namapaket == "Umroh Merakyat 2018 2019"){
		$paketnama = "Tabungan Promo 2018 2019";
	}else {
		$paketnama = $namapaket;
	}
	
//ganti format tanggal
	$tgl_baru 					= date("Y-m-d", strtotime($tgllahir));
	$tgldikeluarkan_baru 		= date("Y-m-d", strtotime($tgldikeluarkan));
	$massaberlakupaspor_baru 	= date("Y-m-d", strtotime($massaberlakupaspor));
	
//mengambil kontak Kordinator
	$sql = "select * from tbl_agent where no_registrasiagen ='$kode_agen' ";
    $query = mysqli_query($konek, $sql);
    $r = mysqli_fetch_array($query);
	$kontakHP = $r['hp'];
	$kontakTlp = $r['tlp'];
	$kontakEmail = $r['email'];

    if ($jspembayaran == 'LUNAS') {
        $nominal = $hargapaket;
    } 
	elseif ($jspembayaran == 'DP') {
         $nominal ='5000000';
    }
	// elseif ($jspembayaran == 'DP 3JT') {
                // $nominal ='3000000';
    // }elseif ($jspembayaran == '3150000') {
                // $nominal ='3150000';
    // }elseif ($jspembayaran == '5000000') {
                // $nominal ='5000000';
    // }
	 
	  
    date_default_timezone_set("Asia/Jakarta");
	
    $tgl_registrasi = date("Y-m-d H:i:s");
    $namalengkap = str_replace(array("'", "\""), " ", htmlspecialchars($realname));
    $comment = 'Via Website';//nama penginput
    
//ngecek token_id
    $token = "SELECT token_id FROM tbl_authentication where token_id='$tokenid' and status=1";
    $hsl_token = mysqli_query($konek, $token);
    $row = mysqli_fetch_array($hsl_token);
    
//Ambil data token dari database
    $tokenDB = $row['token_id'];

    if($tokenid=='')
	{
        $msg = "Not authorized";
    }else if ($tokenDB != $tokenid)
	{
        $msg = "Not authorized";
    }else 
	{
	
		//bikin order_id
		$acakacak        = rand(5,999999);
		$orderid =$acakacak.$hasil;

		//insert data ke tbl_jamaah
		$hsl = "INSERT INTO `tbl_jamaah`
		( `tgl_reg`, `noreg_jamaah`, `nama_lengkap`, `jns_id`, `no_id`,`nama_ayah`, `tempat_lahir`, `tgl_lahir`,
		`no_passpor`, `passpor_dikeluarkan`, `passpor_tgldikeluarkan`,`passpor_masaberlaku`,`jns_kelamin`, `gol_darah`, `status_pernikahan`, `alamat`,`provinsi`, `kota`, `email`,
		`tlp_rumah`, `tlp_seluler`, `pendidikan`, `pekerjaan`, `penyakit_diderita`, `nama_darurat`, `hubungan_darurat`, `notlp_darurat`, 
		`alamat_darurat`, `status_registrasi`,`status_jamaah`,`status_pembayaran`,`kode_agen`, `info_ft`,`prog_umroh`,`harga_paket`,`comment`,`browser`, `ip`,`orderid`,`inputby`,`bulan_keberangkatan`,`tahun_keberangkatan`,`login_id`,`tenor_tabungan`,`kodeBulanPaket`)
		VALUES
		('$tgl_registrasi', '$autoreg_no', '$namalengkap', '$jenisid', '$noid', '$nama_ayah', '$tempatlahir', '$tgl_baru',
		'$nopasspor','$paspordikeluarkan','$tgldikeluarkan_baru','$massaberlakupaspor_baru','$jskelamin','$gol_darah','$statuspernikahan','$alamat','$provinsi','$kota','$email',
		'$telephone','$hp','$pendidikan', '$pekerjaan', '$penyakit', '$nama_darurat', '$hubungan_darurat', '$notlp_darurat', 
		'$alamat_darurat','2','1','2','$kode_agen','$infoft','$paketnama','$hargapaket', '$comment','', '$true_ip', '$orderid', 'Via Website', '$bulanberangkat', '$tahunberangkat', '$id_login', '$lamamenabung','$kodeBulan')";

        $hasilsql2 = mysqli_query($konek, $hsl);

		
		if($metodepembayaran== 'virtualaccount'){

        $type_bayar ="$jspembayaran";

		if($type_bayar == '3150000'){
			$tipe = 'DP - RP. 3,150,000';
		}
		elseif($type_bayar == '5000000'){
			$tipe = 'DP - RP. 5,000,000';
		}else{
			$tipe = $type_bayar;
		}
        $data = array(
                'amount' => $nominal,
                'name' => 'FirstTravel',
                'oid' => $orderid,
                'email' => 'molpay_notif@firsttravel.co.id',
                'mobile' => $hp,
                'description' => $tipe
                );

        $build_data = http_build_query($data);
        //$url= 'config/get_va.php?'.$build_data;
		
		// $xml = file_get_contents('http://10.10.10.134/lib/api/web/get_va.php?'.$build_data);
		$xml = file_get_contents('http://117.102.253.126/lib/api/web/get_va.php?'.$build_data);
        //$xml = file_get_contents('http://agenfirsttravel.co.id/registrasionline/config/get_va.php?'.$build_data); //url to xml data 
        
    
        $dataxml =  simplexml_load_string($xml) or die("Error: Cannot create object"); //parsing xml to array object
        
        if($dataxml->Response->status_code == 000){
            //nama - va - amount - desc
            $data = $dataxml->Wiretransfer;
            $virtualaccount =  $data->virtualaccount;
            $req_date = $data->req_date;
            $due_time = $data->due_time;
            $orderids = $data->orderid;
            $amount = $data->amount;
            $bill_desc = $data->bill_desc;
            
            /*
            $datava= "nojamaah=$no_regjamaah&oid=$orderid&nova=$nova&nominal=$amount&datereq=$req_date&duedate=$due_time&bildesc=$bill_desc&nmjamaah=$nm_jamaah&nmpaket=$nm_paket&pembayaran=$pembayaran";
            header("location:../../dashboard.php?mod=resultbayar&".$datava);
            
            }else{
            echo 'tidak berhasil';
            header("location:../../dashboard.php?mod".$module);
             * 
             */
             $msg_virtualaccount="$virtualaccount";

		//Simpan ke tbl_transaksi        
		$data_trx = "INSERT INTO `tbl_transaction` ( `order_id`,`no_jamaah`,`name`, `virtualaccount`, `type`,`amount`, `trx_date`, `exp_date`, `payment_date`, `last_update`, `payment_status`,`log_respond`, `note`) 
		  VALUES( '$orderids', '$autoreg_no','$namalengkap', '$virtualaccount', '$tipe', '$amount', '$req_date', '$due_time', '0', '0', '0', '0', '0')";
		  
		 
		  $simpan_trans=mysqli_query($konek,$data_trx);   

		  $namabukti_transfer ="Virtual Account";
		  $berita="Virtual Account";
		  $darirek="Virtual Account";
		  $norek="$virtualaccount";
		  $atasnama="$virtualaccount";
     
        //generate no kwitansi
        $date = date("md");
        $randomnum = rand(1000, 9999);
        $count = substr($autoreg_no, -3);
        $no_kwitansi = "K$date$count$randomnum";
      
     //Simpan ke tbl_pembayaran   
	$insert_payment = "INSERT INTO `tbl_pembayaran` ( `no_jamaah`, `id_agent`, `ke_rekening`, `dari_rekening`, `tgl_transfer`, `ref`,`atasnama`,`beritaacara`,`buktitransfer`,`pembayaran`, `status_payment`, `last_update`,`nominal`, `no_kwitansi`) VALUES
	('$autoreg_no', '$kode_agen', '$norek', '$darirek','$req_date','$orderids','$atasnama','$berita','$namabukti_transfer', '$tipe', '1', '$tgl_registrasi','$amount', '$no_kwitansi')";
			
	$simpan_pembayaran=mysqli_query($konek, $insert_payment);

     // echo ($email.'-'.$namalengkap.'-'.$autoreg_no.'-'.$virtualaccount.'-'.$due_time.'-'.$amount.'-'.$jspembayaran.'-'.$namapaket.'-'.$kode_agen);die('sedang perbaikin');
    sendingemail_regva($email,$namalengkap,$autoreg_no,$virtualaccount,$due_time,$amount,$tipe,$namapaket,$kode_agen);
	
	// if(sendingemail_regva){
		// echo "email done";
	// }else{
		// echo "email gagal";
	// }

	$msg="Terimakasih anda sudah terdaftar menjadi calon jamaah kami!<br> Silahkan check email anda <br>untuk melihat nomor Registrasi dan melakukan pembayaran";
	$data1 ['paket'] = 'result.php?msg='.$msg.'&va='.$msg_virtualaccount.'&st=alert-success';
	$data1 = array('pesan' => $msg, 'va' => $msg_virtualaccount);
	echo json_encode($data1);
     }
			
     }elseif ($metodepembayaran== 'cc'){
	 }
	     }
		 
	

 ?>
