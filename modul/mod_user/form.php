<section class="panel form-wizard" id="w1">
				<header class="panel-heading">
					<div class="panel-actions">
						<!--<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>-->
					</div><center>
					<img src="assets/images/logov3.png" widht="40" hight="15">
					</center>
					<a id="click-to-close-info-FT-jamaah"></a>
				</header>
				<div class="panel-body panel-body-nopadding">
					<!--<form action="validasi.php" method="POST" class="form-horizontal" id="formregistrasi"  enctype="multipart/form-data">-->
										<!-- <form  action ="modul/mod_registrasi/action_registrasi.php?mod=registrasi&act=addnew" method="POST" id="formregistrasi" enctype="multipart/form-data"> -->
					 
					<form>
						<div class="tab-content">
							<div id="w1-account" class="tab-pane active">
								<div class="form-group ">
									<label class="col-md-3 control-label" for="w1-namalengkap">Id jamaah</label>
									<div class="col-sm-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input type="text" name="namalengkap" value="" class="form-control" placeholder="ID jamaah anda" required=""> 

											<input type="hidden" name="id_agen" value="FT000007">
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="w1-namalengkap">tujuan</label>
									<div class="col-sm-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
											</span>
											<div id="s2id_dropdown_selector"></div></div><select name="jenis" id="dropdown_selector" data-plugin-selecttwo="" class="form-control populate select2-offscreen" required="" tabindex="-1" title="">
											<optgroup label="Jenis Kelamin">
												<option value="">-Pilih-</option>
												<option value="Laki-laki">Laki-laki</option>
												<option value="Perempuan">Perempuan</option>
											</optgroup>
										</select>
											<!--<textarea name="alamatdarurat" id="showoption" class="form-control input-sm" rows="3" id="w1-alamat" required></textarea>-->
										</div>
									</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="w1-namalengkap">Item</label>
									<div class="col-sm-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
											</span>
											<div id="s2id_dropdown_selector"></div></div><select name="jenis" id="dropdown_selector" data-plugin-selecttwo="" class="form-control populate select2-offscreen" required="" tabindex="-1" title="">
											<optgroup label="Jenis Kelamin">
												<option value="">-Pilih-</option>
												<option value="Laki-laki">Laki-laki</option>
												<option value="Perempuan">Perempuan</option>
											</optgroup>
										</select>
											<!--<textarea name="alamatdarurat" id="showoption" class="form-control input-sm" rows="3" id="w1-alamat" required></textarea>-->
										</div>
								</div>
								<div class="form-group ">
									<label class="col-md-3 control-label" for="w1-namalengkap">Berat</label>
									<div class="col-sm-6">
										<div class="input-group input-group-icon">
	
											<input type="text" name="namalengkap" value="" class="form-control" placeholder="Dalam Kilogram" required=""> 

											<input type="hidden" name="id_agen" value="FT000007">

											<!--<textarea name="alamatdarurat" id="showoption" class="form-control input-sm" rows="3" id="w1-alamat" required></textarea>-->
										</div>
									</div>
								</div>
									
							</div>
																
								
								</div>
							</div>		
						</div>
					</form>					
				</div>
			</section>