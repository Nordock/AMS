<?php
//session_start();
$aksi = "modul/mod_home/aksi_home.php";
// mengatasi variabel yang belum di definisikan (notice undefined index)
$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    default:


?>

        <div class="row">



            <div class="col-md-3 col-lg-3 col-xl-3">
        	<section class="panel panel-featured-top panel-featured-quartenary">
							<div style="background-color:WhiteSmoke ;" class="panel-body">
										<div class="widget-summary widget-summary-sm">
											<div class="widget-summary-col widget-summary-col-icon">

												<div style="background-color: MediumSlateBlue ;" class="summary-icon ">
													<i class="fa fa-users"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">Total Penumpang</h4>
													<div class="info">
														<strong class="amount"><?php //echo $t_jam['total_jamaah'] ?></strong><br>
														<!--<span class="text-primary">(14 unread)</span>-->
													</div>
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

												<div style="background-color: DarkOrange  ;" class="summary-icon ">
													<i class="fa  fa-dollar"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">Total DP</h4>
													<div class="info">
														<strong class="amount"><?php //echo $t_jam_sdh_dp['sdh_dp'] ?></strong><br>
														<span class="text-primary">( Penumpang )</span>
													</div>
												</div>
												<div class="summary-footer">
													<!--<a class="text-muted text-uppercase">(view all)</a>-->
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

												<div style="background-color: DeepSkyBlue;" class="summary-icon bg-quartenary">
													<i class="fa fa-money"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">Total Lunas</h4>
													<div class="info">
														<strong class="amount"><?php //echo $t_jam_sdh_lns['sdh_lns'] ?></strong><br>
														<span class="text-primary">( Penumpang )</span>
													</div>
												</div>
												<div class="summary-footer">
													<!--<a class="text-muted text-uppercase">(view all)</a>-->
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>
              

<script>
	$(document).ready(function() {
		$('#agentBlmByr, #agentSdhByr, #agentTotByr').hide();
		var cab = '<?php echo $_SESSION['nama_cabang']?>';
		
		
		if(cab == 'Atrium Mulia' || cab == 'GKM' || cab == 'DEPOK HEADQUARTER'){
			
		$('#agentBlmByr, #agentSdhByr, #agentTotByr').show();
		}
		else{
			
			$('#agentBlmByr, #agentSdhByr, #agentTotByr').hide();
		}

	});
</script>

        <?php
        break;
}
?>
