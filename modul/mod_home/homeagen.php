<?php
session_start();
$cabang = $_SESSION['nama_cabang'];

$bln_=isset($_GET['tahun']) ? $_GET['tahun'] : '';
$aksi = "modul/mod_home/aksi_home.php";
// mengatasi variabel yang belum di definisikan (notice undefined index)
$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    default:
//zzzzz

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
		
//$t_muhrim_1
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
		$sqltotalsqlmuhrim="SELECT count(*) as t_muhrim_1 FROM tbl_jamaah where muhrim='1' ";
        $querytotalsqlmuhrim=mysqli_query($konek,$sqltotalsqlmuhrim);
        $datamuhrim=mysqli_fetch_array($querytotalsqlmuhrim);
	}else{
		$sqltotalsqlmuhrim="SELECT count(*) as t_muhrim_1 FROM tbl_jamaah where muhrim='1' and cabang='$cabang' ";
        $querytotalsqlmuhrim=mysqli_query($konek,$sqltotalsqlmuhrim);
        $datamuhrim=mysqli_fetch_array($querytotalsqlmuhrim);
	}

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
	
//belum melakukan pembayaran
	if($cabang == 'Atrium Mulia' || $cabang == 'GKM' || $cabang == 'DEPOK HEADQUARTER'){
        $query_total_jamaah_blmbayar = "select count(id_jamaah) as blm_bayar from tbl_jamaah where status_pembayaran='2' and aktif ='1'";
        $data_query_tota_blmbayar = mysqli_query($konek, $query_total_jamaah_blmbayar);
        $t_jam_blmbayar = mysqli_fetch_array($data_query_tota_blmbayar);
	}else{
		$query_total_jamaah_blmbayar = "select count(id_jamaah) as blm_bayar from tbl_jamaah where status_pembayaran='2' and aktif ='1' and cabang='$cabang'";
        $data_query_tota_blmbayar = mysqli_query($konek, $query_total_jamaah_blmbayar);
        $t_jam_blmbayar = mysqli_fetch_array($data_query_tota_blmbayar);
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


//agent smart
		//total registrasi
        //$query_total_agent = "select count(no_registrasiagen) as total_agent from tbl_agent where batch='3' and status NOT IN (3)";
		$query_total_allagent = "SELECT count(tbl_agent.no_registrasiagen) as total_allagent FROM tbl_agent
 where   status != 3 and no_registrasiagen != 'FT000007' or 'FT000005'";

	    $data_query_alltotalagent = mysqli_query($konek, $query_total_allagent);
        $t_allagent = mysqli_fetch_array($data_query_alltotalagent);
        
	    $query_total_agent = "SELECT count(tbl_agent.no_registrasiagen) as total_agent FROM tbl_agent
               join tbl_transaction on tbl_transaction.order_id=tbl_agent.order_id where batch='7' and status != 3 and no_registrasiagen != 'FT000007'";

	    $data_query_totalagent = mysqli_query($konek, $query_total_agent);
        $t_agent = mysqli_fetch_array($data_query_totalagent);

        $query_total_agentbayar = "select count(no_registrasiagen) as total_bayar from tbl_agent where batch='7' and ( status = 1 ) and no_registrasiagen != 'FT000007'";
        $data_query_totalagentbayar = mysqli_query($konek, $query_total_agentbayar);
        $t_agentbayar = mysqli_fetch_array($data_query_totalagentbayar);

        $query_total_agentblnbayar = " SELECT count(no_registrasiagen) as belum_bayar FROM tbl_agent
               join tbl_transaction on tbl_transaction.order_id=tbl_agent.order_id where batch='7' and status='0' ";
        $data_query_totalagentblnbayar = mysqli_query($konek, $query_total_agentblnbayar);
        $t_agentblnbayar = mysqli_fetch_array($data_query_totalagentblnbayar);


        class total_per_promo {
                    private $data_paket;
                    function pettren() {
                        $paket[1] = 'VIP';
                        $paket[2] = 'Quad';
                        $paket[3] = 'Triple';
                        $paket[4] = 'Double';
                        $paket[5] = 'Promo';
                        $paket[6] = 'Promo Triple';
                        $paket[7] = 'Promo Double';
                        return $paket;
                    }
                    function query($konek, $year) {
                        $sql = "select  noreg_jamaah, count(*) as jml, month(tgl_reg) as bln ,tgl_reg,prog_umroh from tbl_jamaah where tgl_reg like '" . $year . "%' group by month(tgl_reg),prog_umroh";
                        $query = mysqli_query($konek, $sql);
                        return $query;
                    }
                    function arrange_paket($konek, $year, $month) {
                        $query = $this->query($konek, $year);
                        while ($data = mysqli_fetch_assoc($query)) {
                            $this->data_paket[$data['bln']][$data['prog_umroh']] = $data['jml'];
                        }
                        $this->pettren_paket($this->data_paket, $month, $year);
                    }
                    function pettren_paket($data_paket, $month, $year) {
                        $paket = $this->pettren();
                        for ($fst = 1; $fst <= $month; $fst++) {
                            if (isset($data_paket[$fst]) == false) {
                                for ($fst_1 = 1; $fst_1 <= count($paket); $fst_1++) {
                                    if (isset($data_paket[$fst][$paket[$fst_1]]) == false) {
                                        $primary_data_paket[$fst][$paket[$fst_1]] = 0;
                                    }
                                }
                            } else if (isset($data_paket[$fst]) == true) {
                                for ($fst_2 = 1; $fst_2 <= count($paket); $fst_2++) {
                                    if (isset($data_paket[$fst][$paket[$fst_2]]) == false) {
                                        $primary_data_paket[$fst][$paket[$fst_2]] = 0;
                                    } else if (isset($data_paket[$fst][$paket[$fst_2]]) == true) {
                                        $primary_data_paket[$fst][$paket[$fst_2]] = $data_paket[$fst][$paket[$fst_2]];
                                    }
                                }
                            }
                        }
                        $this->write_data_to_obj_js($primary_data_paket, $month, $year);
                    }
                    function write_data_to_obj_js($data_paket, $month, $year) {
                        for ($i = 1; $i <= 12; $i++) {
                            echo "{Bulan:'" . $i . ".(" . substr(date("F", mktime(0, 0, 0, $i, 1, 2015)), 0, 3) . ")', ";
                            foreach ($data_paket[$i] as $key => $value) {
                                if ($key == "VIP") {
                                    echo "PAKET_VIP:" . $value . ",";
                                }
                                if ($key == "Quad") {
                                    echo "PAKET_QUAD:" . $value . ",";
                                }
                                if ($key == "Triple") {
                                    echo "PAKET_TRIPLE:" . $value . ",";
                                }
                                if ($key == "Double") {
                                    echo "PAKET_DOUBLE:" . $value . ",";
                                }
                                if ($key == "Promo") {
                                    echo "PAKET_PROMO:" . $value . ",";
                                }
                                if ($key == "Promo Triple") {
                                    echo "PAKET_Promo_Triple:" . $value . ",";
                                }
                                if ($key == "Promo Double") {
                                    echo "PAKET_PROMO_DOUBLE:" . $value . ",";
                                }
                            }
                            echo "},";
                        }
                    }
                }


class statistik_jamaah {
            private $dipper_query;
            private $data_pertahun;
            private $data_bulanan;
            function query($data,$tahun) {
                $sql = "select count(*) as jml,tgl_reg from tbl_jamaah where tgl_reg like '".$tahun."%' group by month(tgl_reg)";
                $query = mysqli_query($data, $sql);
                return $query;
            }
            function data_sampai_bln_sekarang($koneksi,$tahun){
                $tr = null;
                $query = $this->query($koneksi,$tahun);
                $count = 0;
                while($data=  mysqli_fetch_assoc($query)){
                   $this->data_pertahun[(int)(substr($data['tgl_reg'],5,12 ))]=$data['jml'];
                }
                for($ft=1;$ft<=12;$ft++){
                   if(isset($this->data_pertahun[$ft])==true){
                       $this->data_bulanan[$ft]=$this->data_pertahun[$ft];
                   }
                   else if(isset($this->data_pertahun[$ft])==false){
                       $this->data_bulanan[$ft]=0;
                   }
                }
                return $this->data_bulanan;
            }
            function write_js_data_jamaah($koneksi, $mounth, $tahun) {
                $data = $this->data_sampai_bln_sekarang($koneksi,$tahun);
                for ($i1 = 1; $i1 <= $mounth; $i1++){
//                    echo $data[$i1]."<br>";
                    echo "['" . substr(date("F", mktime(0, 0, 0, $i1, date('j'), date('Y'))), 0, 3) . "'," . $this->data_bulanan[$i1] . "],";
                }
            }
            }


?>

        <div class="row">



        
<div class="col-md-3 col-lg-3 col-xl-3">
        	<section class="panel panel-featured-top panel-featured-quartenary">
							<div style="background-color: WhiteSmoke    ;" class="panel-body">
										<div class="widget-summary widget-summary-sm">
											<div class="widget-summary-col widget-summary-col-icon">

												<div style="background-color: Red;" class="summary-icon bg-quartenary">
													<i class="fa fa-money"></i>
												</div>
											</div>
											<div class="widget-summary-col">
                                                                                            <a style="text-decoration: none;" href="/modul/mod_home/download_agenexcel.php?sts=1">
                                                                                                <div class="summary">
													<h4 class="title">Agent Batch 7</h4>
													<div class="info">
														<strong class="amount"><?php echo $t_agentblnbayar['belum_bayar'] ?></strong><br>
														<span class="text-primary">( Belum Bayar )</span>
													</div>
												</div>
                                                                                            </a>

												<div class="summary-footer">
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>



<div class="col-md-3 col-lg-3 col-xl-3">
        	<section class="panel panel-featured-top panel-featured-quartenary">
							<div style="background-color: WhiteSmoke    ;" class="panel-body">
										<div class="widget-summary widget-summary-sm">
											<div class="widget-summary-col widget-summary-col-icon">

												<div style="background-color: green;" class="summary-icon bg-quartenary">
													<i class="fa fa-money"></i>
												</div>
											</div>
											<div class="widget-summary-col"> 
                                                                                            <a style="text-decoration: none;" href="/modul/mod_daftaragen/download_excel_M.php">
												<div class="summary">
													<h4 class="title">Agent Batch 7</h4>
													<div class="info">
														<strong class="amount"><?php echo $t_agentbayar['total_bayar'] ?></strong><br>
														<span class="text-primary">( Sudah Bayar)</span>
													</div>
												</div>
                                                                                            </a>
												<div class="summary-footer">
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>

<div class="col-md-3 col-lg-3 col-xl-3">
        	<section class="panel panel-featured-top panel-featured-quartenary">
							<div style="background-color: WhiteSmoke    ;" class="panel-body">
										<div class="widget-summary widget-summary-sm">
											<div class="widget-summary-col widget-summary-col-icon">

												<div style="background-color: blue;" class="summary-icon bg-quartenary">
													<i class="fa fa-users"></i>
												</div>
											</div>
											<div class="widget-summary-col">
                                                                                            <a style="text-decoration: none;" href="/modul/mod_home/download_agenexcel.php?sts=3">
												<div class="summary">
													<h4 class="title">Agent Batch 7</h4>
													<div class="info">
														<strong class="amount"><?php echo $t_agent['total_agent'] ?></strong><br>
														<span class="text-primary">( Total Agent)</span>
													</div>
												</div>
                                                                                                </a>
												<div class="summary-footer">
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                      <section class="panel panel-featured-top panel-featured-quartenary">
                          <div style="background-color: WhiteSmoke    ;" class="panel-body">
                                <div class="widget-summary widget-summary-sm">
                                  <div class="widget-summary-col widget-summary-col-icon">

                                    <div style="background-color: darkred;" class="summary-icon bg-quartenary">
                                      <i class="fa fa-users"></i>
                                    </div>
                                  </div>
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Agent Aktif</h4>
                                      <div class="info">
                                        <strong class="amount"><?php echo $t_allagent['total_allagent'] ?></strong><br>
                                        <span class="text-primary">( All Batch)</span>
                                      </div>
                                    </div>
                                    <div class="summary-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>

<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="chart-data-selector" id="salesSelectorWrapper">
                                    <h2>
                                        Tahun:
                                        <strong>
                                            <select class="form-control" id="salesSelector">
                                                <option value="Porto Admin" selected>2015</option>
                                                <option value="Porto Drupal">2016</option>
                                            </select>
                                        </strong>
                                    </h2>


<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                        <!--Flot: Statistik Jamaah 2015-->
                                        <div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active"></div>
                                        <script>
                                            var my_var = <?php echo 23; ?>;
                                            var flotDashSales1Data = [{
                                                    data: [
                                                        <?php
                                                        $call_statistik=new statistik_jamaah;
                                                        $call_statistik->write_js_data_jamaah($konek, 12,2015); ?>
                                                    ],
                                                    color: "#0088cc"
                                                }];
                                            // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                        </script>

                                        <!--Flot: Statistik Jamaah 2016-->
                                        <div class="chart chart-sm" data-sales-rel="Porto Drupal" id="flotDashSales2" class="chart-hidden"></div>
                                        <script>
                                            var flotDashSales2Data = [{
                                                    data: [
                                                    <?php
                                                    $call_statistik=new statistik_jamaah;
                                                    $call_statistik->write_js_data_jamaah($konek, 12,2016); ?>
                                                    ],
                                                    color: "#2baab1"
                                                }];
                                            // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><div style="float: left; line-height: 140%;">TOP PAKET &nbsp; Tahun:</div><div class="col-md-2">
                <select class="form-control input-sm mb-md">
                    <option onclick="direct_thn(this.value);" value="2015" <?php
                      if($bln_==2015){echo "selected"; } ?> >2015</option>
                                <option onclick="direct_thn(this.value);" value="2016" <?php if($bln_==2016){echo "selected";} else if($bln_==''){echo "selected";}?> >2016</option>
                                <script>
                                    function direct_thn(tahun){
                                        window.location.assign("dashboard.php?mod=home&tahun="+tahun);
                                    }
                                </script>
		</select
                </div></h2>
                <br>
                <p class="panel-subtitle"></p>
            </header>
            <div class="panel-body">
                <!--dari sini-->
                <div id="morrisLine" class="chart chart-md" style="position: relative;"></div>
                <script type="text/javascript">
                    var morrisLineData = [
                    <?php
                    $call = new total_per_promo;
                    if($bln_==''){
                        $call->arrange_paket($konek, date("Y"), 12);
                    }
                    else if($bln_!=''){
                        $call->arrange_paket($konek, $bln_, 12);
                    }
                    ?>];
                </script>
                <!--sampai sini-->
            </div>
        </section>
						</div>
        <?php
        break;
}
?>
