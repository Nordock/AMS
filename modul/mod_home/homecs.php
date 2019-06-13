<?php
session_start();
$cabang = $_SESSION['nama_cabang'];

$aksi = "modul/mod_home/aksi_home.php";
// mengatasi variabel yang belum di definisikan (notice undefined index)
$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    default:
        ?>




        <?php
        $querytarget = "SELECT * FROM tbl_target WHERE id_target='1'";
        $hasiltarget = mysqli_query($konek, $querytarget);
        $t = mysqli_fetch_array($hasiltarget);
        $tgt_value = $t['value'];

        $query_bulan = "SELECT MONTH(tgl_registrasiagen) MONTH, COUNT(*) COUNT FROM tbl_agent WHERE MONTH(tgl_registrasiagen)=MONTH(CURDATE()) GROUP BY YEAR(tgl_registrasiagen)";
        $tampil_bulan = mysqli_query($konek, $query_bulan);
        $b = mysqli_fetch_array($tampil_bulan);
        $valuebulan = $b['COUNT'];
        $valuebulan_persen = ($valuebulan / $tgt_value) * 100;

        $query_regtotal = "SELECT  COUNT(*) COUNT FROM tbl_agent WHERE status=0  GROUP BY YEAR(`tgl_registrasiagen`)";
        $tampil_regtotal = mysqli_query($konek, $query_regtotal);
        $reg = mysqli_fetch_array($tampil_regtotal);
        $valueregtotal = $reg['COUNT'];
        $valueregtotal_persen = ($valueregtotal / $tgt_value) * 100;


        $query_aktivtotal = "SELECT  COUNT(*) COUNT FROM tbl_agent WHERE status=1  GROUP BY YEAR(`tgl_registrasiagen`)";
        $tampil_aktiftotal = mysqli_query($konek, $query_aktivtotal);
        $aktif = mysqli_fetch_array($tampil_aktiftotal);
        $valueaktiftotal = $aktif['COUNT'];





        $query_total = "SELECT  COUNT(*) COUNT FROM tbl_agent WHERE status=1 and YEAR(`tgl_registrasiagen`)=YEAR(CURDATE()) GROUP BY YEAR(`tgl_registrasiagen`)";
        $tampil_total = mysqli_query($konek, $query_total);
        $r = mysqli_fetch_array($tampil_total);
        $valuetotal = $r['COUNT'];
        $valuetotal_persen = ($valuetotal / $tgt_value) * 100;

//total_jamaah
if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
		$query_total_jamaah = "select count(id_jamaah) as total_jamaah, tgl_reg from tbl_jamaah where aktif ='1'";
        $data_query_total = mysqli_query($konek, $query_total_jamaah);
        $t_jam = mysqli_fetch_array($data_query_total);
		
	}else{
		$query_total_jamaah = "select count(id_jamaah) as total_jamaah, tgl_reg from tbl_jamaah where aktif ='1' and cabang='$cabang' ";
        $data_query_total = mysqli_query($konek, $query_total_jamaah);
        $t_jam = mysqli_fetch_array($data_query_total);
	}
		
//total_jamaah_tervalidasi
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_tervalidasi = "select count(id_jamaah) as tervalidasi from tbl_jamaah where status_registrasi='1' and aktif ='1'";
        $data_query_tota_tervalidasil = mysqli_query($konek, $query_total_jamaah_tervalidasi);
        $t_jam_tervalidasi = mysqli_fetch_array($data_query_tota_tervalidasil);
		
		}else{
		$query_total_jamaah_tervalidasi = "select count(id_jamaah) as tervalidasi from tbl_jamaah where status_registrasi='1' and aktif ='1' and cabang='$cabang'";
        $data_query_tota_tervalidasil = mysqli_query($konek, $query_total_jamaah_tervalidasi);
        $t_jam_tervalidasi = mysqli_fetch_array($data_query_tota_tervalidasil);
		}
		
//sudah membayaran DP
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_sdh_dp = "select count(id_jamaah) as sdh_dp from tbl_jamaah where status_pembayaran='3' and aktif ='1'";
        $data_query_tota_sdh_dp = mysqli_query($konek, $query_total_jamaah_sdh_dp);
        $t_jam_sdh_dp = mysqli_fetch_array($data_query_tota_sdh_dp);
	}else{
		$query_total_jamaah_sdh_dp = "select count(id_jamaah) as sdh_dp from tbl_jamaah where status_pembayaran='3' and aktif ='1' and cabang='$cabang'";
        $data_query_tota_sdh_dp = mysqli_query($konek, $query_total_jamaah_sdh_dp);
        $t_jam_sdh_dp = mysqli_fetch_array($data_query_tota_sdh_dp);
	}
		
//sudah lunas
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_sdh_lns = "select count(id_jamaah) as sdh_lns from tbl_jamaah where status_pembayaran='1' and aktif ='1' ";
        $data_query_tota_sdh_lns = mysqli_query($konek, $query_total_jamaah_sdh_lns);
        $t_jam_sdh_lns = mysqli_fetch_array($data_query_tota_sdh_lns);
	}else{
		$query_total_jamaah_sdh_lns = "select count(id_jamaah) as sdh_lns from tbl_jamaah where status_pembayaran='1' and aktif ='1' and cabang='$cabang'";
        $data_query_tota_sdh_lns = mysqli_query($konek, $query_total_jamaah_sdh_lns);
        $t_jam_sdh_lns = mysqli_fetch_array($data_query_tota_sdh_lns);
	}

//Jamaah Laki-laki
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_L = "select count(id_jamaah) as total_jamaah_L from tbl_jamaah where jns_kelamin='laki-laki'";
        $data_query_total_L = mysqli_query($konek, $query_total_jamaah_L);
        $t_jam_L = mysqli_fetch_array($data_query_total_L);
	}else{
		$query_total_jamaah_L = "select count(id_jamaah) as total_jamaah_L from tbl_jamaah where jns_kelamin='laki-laki' and cabang='$cabang'";
        $data_query_total_L = mysqli_query($konek, $query_total_jamaah_L);
        $t_jam_L = mysqli_fetch_array($data_query_total_L);
	}

//Jamaah Perempuan
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_P = "select count(id_jamaah) as total_jamaah_P from tbl_jamaah where jns_kelamin='perempuan'";
        $data_query_total_P = mysqli_query($konek, $query_total_jamaah_P);
        $t_jam_P = mysqli_fetch_array($data_query_total_P);
	}else{
		$query_total_jamaah_P = "select count(id_jamaah) as total_jamaah_P from tbl_jamaah where jns_kelamin='perempuan' and cabang='$cabang'";
        $data_query_total_P = mysqli_query($konek, $query_total_jamaah_P);
        $t_jam_P = mysqli_fetch_array($data_query_total_P);
	}
        

        class statistik_jamaah {

            private $data_pertahun;

            function query($data) {
                $sql = "select  tgl_reg from tbl_jamaah";
                $query = mysqli_query($data, $sql);
                return $query;
            }

            function data_sampai_bln_sekarang($bln_ini, $koneksi) {
                $tr = null;
                $query = $this->query($koneksi);
                $count = 0;
                while ($data_query = mysqli_fetch_array($query)) {
                    if (substr($data_query['tgl_reg'], 0, -15) == date('Y')) {
                        for ($i = 1; $i <= 12; $i++) {
                            if (substr($data_query['tgl_reg'], 5, -12) == $i) {
                                if (isset($data_bln[$i]) == false) {
                                    $data_bln[$i] = 1;
                                } else {
                                    $data_bln[$i] = $data_bln[$i] + 1;
                                }
                            } else {
                                $data_bln[$i] = 0;
                            }
                        }
                    }
                }
//                                                                                                   echo $data_bln[2];
            }

//------------new                                                                                               
        }

        $call_statistik = new statistik_jamaah;
        ?>
        <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div style="background-color:blue;" class="summary-icon bg-quartenary">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Jamaah</h4>
                                <div class="info">
                                    <strong class="amount"><?php echo $t_jam['total_jamaah'] ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-muted">Jamaah Yang Telah Melakukan Registrasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
             <div class="col-md-12 col-lg-6 col-xl-6">
                 <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div style="background-color:darkorange;" class="summary-icon bg-quartenary">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Dp</h4>
                                <div class="info">
                                    <strong class="amount"><?php echo $t_jam_sdh_dp['sdh_dp'] ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-muted">Jamaah Yang Telah Melakukan DP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-quartenary">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Jamaah Tervalidasi</h4>
                                <div class="info">
                                    <strong class="amount"><?php echo $t_jam_tervalidasi['tervalidasi'] ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-muted">Jamaah Yang Telah Tervalidasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                </div>
<div class="col-md-12 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div style="background-color: green;" class="summary-icon bg-quartenary">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Lunas</h4>
                                <div class="info">
                                    <strong class="amount"><?php echo $t_jam_sdh_lns['sdh_lns'] ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-muted">Jamaah Yang Telah Melakukan Pelunasan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</div>





        <?php
        break;
}
?>
