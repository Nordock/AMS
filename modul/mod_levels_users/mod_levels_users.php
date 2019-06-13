<?php
$id_agen = $_SESSION['namauser'];
$aksi = "modul/mod_levels_users/act_levels_users.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
	$randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function view_levels($data){
    if($data=='1'){
        $level="Admin";
    }
    else if($data=='2'){
        $level="Finance";
    }
    else if($data=='3'){
        $level="CS";
    }

    else if($data=='4'){
        $level="Admin Agent";
    }
    else if($data=='5'){
        $level="Admin BO / Manifest";
    }
	else if($data=='6'){
        $level="Finance Bo";
    }
	else if($data=='7'){
        $level="Logistik";
    }
	else if($data=='9'){
        $level="Manasik";
    }
	else if($data=='10'){
        $level="File Control";
    }
	else if($data=='11'){
        $level="Receptionist";
    }
	else if($data=='12'){
        $level="CRO";
    }
    return $level;
}
function view_status($data){
    if($data=='1'){
        $status="Aktif";
    }
    else if($data=='0'){
        $status="non aktif";
    }
    return $status;
}

switch ($act) {
    default:
	?>
	<section class="panel">
	    <header class="panel-heading">
		<div class="panel-actions">
		    <a href="#" class="fa fa-caret-down"></a>
		    <a href="#" class="fa fa-times"></a>
		</div>
		<h2 id="k" class="panel-title">Management User &nbsp <a href="?mod=listuser&act=registrasiuser"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2>
	    </header>
	    <div class="panel-body">

		<table class="table table-bordered table-striped table-hover mb-none" id="datatable-default" >
		    <thead>
			<tr>
			<th>No</th>
			<th>Username</th>
			<th>Password</th>
			<th>E-mail</th>
			<th>City</th>
			<th>Lokasi</th>
			<th >Status</th>
			<th >Action</th>
			</tr>
		    </thead>
		    <tbody>

			<?php
			$query = "select * from tbl_users where status='1';";
			$tampil = mysqli_query($konek, $query);
                        $no=0;
			while ($r = mysqli_fetch_array($tampil)) {

			    //Status Registrasi
			    if ($r['status'] == 1) {
				$warnareg = 'label label-success';
				$statusreg = 'Menunggu Verifikasi';
			    } elseif ($r['status'] == 0){
				$warnareg = 'label label-danger';
			    }
			    $random = generateRandomString();
			    $str = $r['id_users'];
			    $encode = base64_encode($str);
			    $tambah = $random . $encode;
				echo "<tr class='gradeX'>
					 <td>". $no=$no+1 ."</td>
                     <td>$r[username]</td>
                     <td>$r[pwd]</td>
                     <td>$r[email]</td>
					 <td>$r[city]</td>
					 <td>$r[lokasi]</td>
					 <td>
					 <span style='' class='$warnareg'>".view_status($r['status'])."</span>
					 </td>
					 <td class='actions'>
					 <a style='float:left;' href='?mod=listuser&act=edituser&id=$tambah' title='Lihat lebih Detail'> <i class='fa fa-search'>Update</i></a>
					||<a  id='$aksi?mod=listuser&act=delete&no_aja=$r[id_users]' onclick='data_hapus_jamaah.hapus_by_id(this.title,this.id)'  class='modal-sizes' href='#modalSM'> <i class='fa fa-trash-o'> Hapus</i></a>
					 </td>
					</tr>";
			}
			?>

		    </tbody>
		</table>
	    </div>
                     <div id="modalSM" class="modal-block modal-block-sm mfp-hide">
                     <section class="panel">
					<header class="panel-heading">
					<h2 class="panel-title">Konfirmasi Hapus Users</h2>
					</header>
					<div class="panel-body">
					<div class="modal-wrapper">
					<div class="modal-text">
					<p id="title_Chapus_jamaah">Apakah Anda Ingin Menghapus User :</p>
<div style="" ><div style=" width:19%; float:left;">Nama</div><div style="float:left; padding-right: 5px;">:</div><div style="width:auto; float:left;" id="nama_jam_"></div></div>
<div style="clear: both;" ><div style="width:19%; float:left;">Levels</div><div style="float:left; padding-right: 5px;">:</div><div style="width:auto; float:left;" id="id_jam_"></div></div>
</div>
</div>
</div>
	<footer class="panel-footer">
	<div class="row">
	<div class="col-md-12 text-right">
	<a id="dom_alamat">
		<button class="btn btn-primary">Hapus</button>
		</a>
		<button class="btn btn-default modal-dismiss">Batal</button>
	</div>
	</div>
	</footer>
	</section>
	</div>

	    <script>
		var data_hapus_jamaah={
                                                                hapus_by_id:function(data,data1){
                                                                var dataku=document.getElementById(data1).getAttribute('data-noregjamaah');
								var el_btn_hpus=document.getElementById('dom_alamat').setAttribute("href",data1);
								var el_nm_data_hps=document.getElementById('nama_jam_').textContent=data;
                                                                document.getElementById('id_jam_').textContent=dataku;

//                                                                "["+dataku+"]"+"::
							    }
							}
	    </script>
	</section>
	<?php
	break;
    case "viewuser":
        $decode = $_GET['id'];
	$getbase = substr($decode, +4);
	$decodeid = base64_decode($getbase);
	$query = "SELECT * FROM tbl_users where id_users='".$decodeid."' ";
	$hasil = mysqli_query($konek, $query);
	$r = mysqli_fetch_array($hasil);
//
	$str = $r['id_users'];
	$encode = base64_encode($str);
	$tambah = '9Sa9' . $encode;
	?>
	<!-- start: page -->
	<div class="row">
	    <div class="col-lg-12">
		<section class="panel">
		    <header class="panel-heading">
			<div class="panel-actions">
			    <a href="#" class="fa fa-caret-down"></a>
			    <a href="#" class="fa fa-times"></a>
			</div>

			<h2 class="panel-title">Data User</h2>
		    </header>
		    <div class="panel-body">


	    <!--<form class="form-horizontal form-bordered" action ="<?php echo $aksi; ?>?mod=daftarjamaah&act=validasi" method="POST">-->

			<div class="form-group">
<!--                                <center>
					<img hight="15" widht="40" src="assets/images/logov3.png">
				    </center>-->
			</div>
                        <br>
			<div class="form-group">
			    <label class="col-md-3 control-label" for="inputReadOnly">Level User</label>
			    <div class="col-md-6">
                                <input type="text" name="noreg" value="<?php echo  view_levels($r['level']); ?>" id="inputReadOnly" class="form-control" readonly="readonly">
				<input type="hidden" name="id_agen" value="<?php echo $r['id_admin']; ?>" >
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-md-3 control-label" for="inputReadOnly">Nama User</label>
			    <div class="col-md-6">
				<input type="text" name="no_rek" value="<?php echo $r['nama']; ?>" id="inputReadOnly" class="form-control" readonly="readonly">
			    </div>
			</div>
                        <div class="form-group">
			    <label class="col-md-3 control-label" for="inputReadOnly">Email</label>
			    <div class="col-md-6">
				<input type="text" name="no_rek" value="<?php echo $r['email']; ?>" id="inputReadOnly" class="form-control" readonly>
			    </div>
			</div>
                        <div class="form-group">
			    <label class="col-md-3 control-label" for="inputReadOnly">Status</label>
			    <div class="col-md-6">
				<input type="text" name="no_rek" value="<?php
    if($r['status']=='1'){
        echo "Aktif";
    }
    else if($r['status']=='0'){
        echo "tidak";
    }
     ?>" id="inputReadOnly" class="form-control" readonly="readonly">
			    </div>
			</div>
      <div class="form-group">
<label class="col-md-3 control-label" for="inputReadOnly">Kantor Cabang</label>
<div class="col-md-6">
<input type="text" name="no_rek" value="<?php echo $r['kd_cabang']."-".$r['nama_cabang']; ?>" id="inputReadOnly" class="form-control" readonly="readonly">
</div>
</div>
			<br>
      <br>
			<button class='btn btn-info' onclick='history.back();' type='back'><i class='fa fa-back'></i>Back</button>
			<a href='?mod=listuser&act=edituser&id=<?php echo $tambah ?>'<button class='btn btn-danger' ><i class='fa fa-copy'></i> Edit User</button></a>

			<!--<a href='?mod=daftarjamaah&act=resendnotif&nojamaah=<?php echo $tambah . '&email=' . $r['email'] . '&alamat=' . $r['alamat'] . '&idagent=' . $r['kode_agen'] . '&nama=' . $r['nama_lengkap'] . '&tglreg=' . $r['tgl_reg'] ?>'<button class='btn btn-info' ><i class='fa fa-envelope'></i> Resend Email Notifikasi</button></a>-->
			<!--<a href="<?php echo $print ?>" target="blank" class='btn btn-danger' ><i class='fa fa-print'></i>Print</a>
			<!--<a href='?mod=daftarjamaah&act=resendnotif&nojamaah=<?php echo $tambah . '&email=$r[email]&alamat=$r[alamat]&idagent=$r[kode_agen]&nama=$r[nama_lengkap];' ?>'<button class='btn btn-info' ><i class='fa fa-copy'></i>Resend Email Notifikasi</button></a>-->



	<!--<a href="<?php echo $print ?>" target="blank" class='btn btn-danger' ><i class='fa fa-print'></i>Print</a>
		<!--<a href='?mod=daftarjamaah&act=editjamaah&id=<?php echo $tambah ?>' class='btn btn-danger' ><i class='fa fa-copy'></i>Edit Jamaah</a>-->





	<?php
//	if ($r['status_pembayaran'] == 3) {
//	    $status = "Sudah Bayar DP";
//	    $optionvalue = "<option value='1'>Bayar Pelunasan</option>";
//	} else if ($r['status_pembayaran'] == 1) {
//	    $status = "Sudah lunas";
//	    $optionvalue = "<option value='0'>Refund</option>";
//	} elseif ($r['status_pembayaran'] == 2) {
//	    $status = "Belum Bayar";
//	    $optionvalue = "<option value='3'>Bayar DP</option>
//												<option value='1'>Bayar Lunas</option>";
//	}
	?>
												<!--<span class="center help-block">Update Pembayaran</span>
												<!--<form action ="<?php echo $aksi; ?>?mod=jamaah&act=updatepayment" method="POST" >
			<!--<div class="form-group">
			<!--<label class="col-md-3 control-label" for="w1-jenis">Update Pembayaran</label>
			<!--<div class="col-md-6">
			<!--<input type='hidden' name='nojamaah' value ='<?php echo $r[noreg_jamaah]; ?>' >
				<!--<select name="payment" id="dropdown_selector" data-plugin-selectTwo class="form-control populate" required>



						<!--<option  value="<?php echo $r['status']; ?>"><?php echo $status; ?></option>
			<!--<?php echo $optionvalue; ?>

			<!--</select>

			<!--</div>
			<!--</div>

			<!--<button class='btn btn-info' onclick='history.back();' type='back' ><i class='fa fa-back'></i>Back</button>
			<!--<button class='btn btn-info'  type='submit' ><i class='fa fa-money'></i>Update</button>
			<!--<a href="<?php echo $print ?>" target="blank" class='btn btn-danger' ><i class='fa fa-print'></i>Print</a>
			</div>
			</div>
			<!--</form>-->
		    </div>
		</section>



	<?php
	break;
    case "registrasiuser":
        $sql="select * from tbl_users where status='1'";
        $query=  mysqli_query($konek, $sql);
        ?>
            <div class="row">
				<div class="col-md-12">
					<form method="POST" id="summary-form" action="modul/mod_levels_users/act_levels_users.php?mod=listuser&act=plush" class="form-horizontal" required>
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>

								<h2 class="panel-title">Registrasi Users</h2>
								</header>
									<div class="panel-body">
										<div class="validation-message">
											<ul></ul>
										</div>
                                        <br>

										<div class="form-group">
											<label class="col-sm-3 control-label">Username</label>
											<div class="col-sm-6">
                                                <input type="text" name="username" class="form-control" title="Plase enter a name." placeholder="Username" required="">
                                                <input type="hidden" value="2" name="x_user">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Password</label>
											<div class="col-sm-6">
                                                <input type="text" name="password" class="form-control" title="Plase enter a name." placeholder="Password" required="">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
                                                    <input type="email" name="email" class="form-control" placeholder="eg.: email@email.com" required="">
												</div>
											</div>
											<br>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">City</label>
											<div class="col-sm-6">
                                                <input type="text" name="city" class="form-control" title="Plase enter a name." placeholder="City" required="">
											</div>
										</div>

                                        <div class="form-group">
											<label class="col-sm-3 control-label">Lokasi</label>
											<div class="col-sm-6">
												<input type="text" name="namalengkap" class="form-control" title="Plase enter a name." placeholder="Lokasi" required="">
											</div>
										</div>
										<br>
										
									<footer class="panel-footer">

										<div class="row">
											<div class="col-sm-9 col-sm-offset-0">

												<button class="btn btn-primary">Submit</button>
											</div>
										</div>
									</footer>
								</div></section>
							</form>
						</div>
        			</div>

    <?php
    break;
    case "edituser":
    $decode = $_GET['id'];
		$getbase = substr($decode, +4);
		$decodeid = base64_decode($getbase);
		$query = "SELECT * FROM tbl_users where id_users='".$decodeid."' ";
		$hasil = mysqli_query($konek, $query);
		$r = mysqli_fetch_array($hasil);
		$str = $r['id_users'];
		$encode = base64_encode($str);
		$tambah = '9Sa9' . $encode;
    ?>
	
    <link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css"/>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="<?php echo $aksi; ?>?mod=listuser&act=update" id="summary-form"  method="POST" required>
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a class="fa fa-caret-down" href="#"></a>
								<a class="fa fa-times" href="#"></a>
							</div>

							<h2 class="panel-title">Edit User</h2>
								</header>
									<div class="panel-body">
										<div class="validation-message">
											<ul></ul>
										</div>
                                        <br>
										
                                        <div class="form-group">
											<label class="col-sm-3 control-label">Levels</label>
											<div class="col-sm-6">
                                                <!-- <select required="" class="form-control" id="company" name="levels">
													<option <?php if($r['level']=='1'){echo "selected";}?> value="admin">
														Admin
													</option>
													<option <?php if($r['level']=='2'){echo "selected";}?>value="finance">
														Finance
													</option>
													<option <?php if($r['level']=='3'){echo "selected";}?> value="cs">
														CS
													</option>
													<option <?php if($r['level']=='4'){echo "selected";}?> value="admin agen">
														Admin Agen
													</option>
												</select> -->
												
													<select name="levels" id="dropdown_selector" data-plugin-selectTwo class="form-control populate" required>
														<optgroup label="Levels User">
                                                            <?php
                                                                $sqlktrc="select * from tbl_users";
                                                                $queryktrc=mysqli_query($konek,$sqlktrc);
															?>
															
															<option <?php if($r['level']=='1'){echo "selected";}?> value="admin">
                                                                Admin
                                                            </option>
															<option <?php if($r['level']=='2'){echo "selected";}?>value="finance">
                                                                Finance
                                                            </option>
															<option <?php if($r['level']=='3'){echo "selected";}?> value="cs">
                                                                CS
                                                            </option>
															<option <?php if($r['level']=='4'){echo "selected";}?> value="admin agen">
                                                                Admin Agen
                                                            </option>
															<option <?php if($r['level']=='5'){echo "selected";}?> value="admin bo">
																Admin BO
															</option>
															<option <?php if($r['level']=='6'){echo "selected";}?> value="finance bo">
																Finance BO
															</option>
															
															<option <?php if($r['level']=='7'){echo "selected";}?> value="logistik">
																Logistik
															</option>
															<option <?php if($r['level']=='9'){echo "selected";}?> value="manasik">
																Manasik
															</option> 
															<option <?php if($r['level']=='10'){echo "selected";}?> value="filecontrol">
																File Control
															</option>
															<option <?php if($r['level']=='11'){echo "selected";}?> value="receptionist">
																Receptionist
															</option>
															<option <?php if($r['level']=='12'){echo "selected";}?> value="CRO">
																CRO
															</option>
														</optgroup>
													</select>
												<label for="company" class="error"></label>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Username</label>
											<div class="col-sm-6">
												<input type="text"  placeholder="Username" title="Plase enter a username." class="form-control" name="username" value="<?php echo $r['username']; ?>" readonly>
												<input type="hidden" name="x_user" value="<?php echo $r['id_users'];?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Password</label>
											<div class="col-sm-6">
                                                <input type="text" placeholder="Password" title="Plase enter a password." class="form-control" name="password"  value="<?php echo $r['pwd']; ?>" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
                                                    <input type="email" required="" placeholder="eg.: email@email.com" class="form-control" name="email" value="<?php echo $r['email'];?>" readonly="">
												</div>
											</div>
                                            <br>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">City</label>
											<div class="col-sm-6">
												<input type="text" name="city" class="form-control"  value="<?php echo $r['city'];?>">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Lokasi</label>
											<div class="col-sm-6">
												<input type="text" name="lokasi" class="form-control"  value="<?php echo $r['lokasi'];?>">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Status</label>
											<div class="col-sm-6">
												<select name="status" id="dropdown_selector" data-plugin-selectTwo class="form-control populate" required>
                                                    <option <?php if($r['status']=='1'){echo "selected";}?> value="1">aktif</option>
                                                    <option <?php if($r['status']=='0'){echo "selected";}?> value="0">non aktif</option>
												</select>
												<label for="company" class="error"></label>
											</div>
										</div>

										<footer class="panel-footer">
											<div class="row">
												<div class="col-sm-9 col-sm-offset-0">
                                                    <button type="back" onclick="history.back([0]);" class="btn btn-info"><i class="fa fa-back"></i>Back</button>
													<button class="btn btn-primary">Submit</button>
												</div>
											</div>
										</footer>
								</section>
							</form>
						</div>
        </div>
    <?php
break;
}
