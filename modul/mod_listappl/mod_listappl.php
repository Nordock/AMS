 <?php
$aksi = "modul/mod_listappl/action_listappl.php";
// mengatasi variabel yang belum di definisikan (notice undefined index)
$act = isset($_GET['act']) ? $_GET['act'] : '';
  switch($act){
  default:

?>
<section class="panel panel-primary">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>
   		<h2 class="panel-title">Applicant List</h2>
	</header>
    <div class="panel-body">
		<form  class="form-group" class="form-horizontal" method="POST" id="new2">
            <div class="form-group">
	            <div class="row">
	              <div class="col-md-4">
	                    <select name="dropdown_selector_fin" id="dropdown_selector_fin" data-plugin-selectTwo class="form-control populate">
	                        <optgroup label="Choose Filter">
	                        	<option value="">-Choose-</option>
	                        </optgroup>
	                    </select>
	                    <span class="help-block">By Finance</span>
	            	</div>
                <div class="col-md-4">
	                    <select name="dropdown_selector_status" id="dropdown_selector_status" data-plugin-selectTwo class="form-control populate">
	                        <optgroup label="Choose Filter">
	                        	<option value="">-Choose-</option>
	                        </optgroup>
	                    </select>
	                    <span class="help-block">By Status</span>
	            	</div>
	            	<div class="col-md-4">
	                    <select name="dropdown_selector_action" id="dropdown_selector_action" data-plugin-selectTwo class="form-control populate">
	                        <optgroup label="Choose Filter">
	                        	<option value="">-Choose-</option>
	                        </optgroup>
	                    </select>
	                    <span class="help-block">By Action</span>
	            	</div>

	            </div>
	            <table>
	            	<tr>
    	        		<td><button type="button" class="btn btn-success" id = 'search'>Find</button><br/></td>
            			<td>
            				<div id="download-div" style="display: none">
    							<label class="btn btn-info" id = 'download'>Download</label>
            				</div>
    					</td>
            		</tr>
            	</table>
          	</div>
          	<br>
        </form>
		<table class="table table-bordered table-striped table-hover mb-none" id="datatable-listapplication" >
			<thead>
				<tr>

					<th>Name</th>
					<th>Registration Date</th>
					<th>GMS PIC</th>
					<th>Channel</th>
          <th>Branch</th>
          <th>Finance</th>
					<th>Status</th>
          <th>Action</th>
					<th class="hidden-phone">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</section>
<script>
	(function( $ ) {
		'use strict';
		$(function() {
			var dataTable = $('#datatable-listapplication').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "modul/mod_listappl/json_listappl2.php"
			});

			$('#new').click(function(){
				$('#new2')[0].reset();
			});

      $('#search').click(function(){
				var i_fin = 1;
				var v_fin = $('#dropdown_selector_fin').val();
        //window.alert(v_fin);
        //exit();
				dataTable.columns(i_fin).search(v_fin).draw();

				var i_status = 2;
				var v_status = $('#dropdown_selector_status').val();
				dataTable.columns(i_status).search(v_status).draw();

				var i_action = 3;
				var v_action = $('#dropdown_selector_action').val();
				dataTable.columns(i_action).search(v_action).draw();

				//$('#download-div').show();
			});

      $('#download').click(function() {
        /*
				var agent = $('#dropdown_selector_agent').val();
				var paket = $('#dropdown_selector_paket').val();
				var bayar = $('#dropdown_selector_bayar').val();
				var gender = $('#dropdown_selector_gender').val();
				var tahun = $('#dropdown_selector_tahun').val();

				var url =encodeURI("modul/mod_listjamaah/download_data.php?idAgen="+agent+'&paket='+paket+'&typebayar='+bayar+'&tahun_paket='+tahun+'&gender='+gender);
				window.location.href = url;
        */
			});

      $.getJSON("modul/mod_listappl/json_getfin.php?",function(respond){
				console.log(respond);
				$('#dropdown_selector_fin').select2({
					// allowClear: true,
					data: respond
				});
			});
      $.getJSON("modul/mod_listappl/json_getstatus.php?",function(respond){
				console.log(respond);
				$('#dropdown_selector_status').select2({
					// allowClear: true,
					data: respond
				});
			});
      $.getJSON("modul/mod_listappl/json_getaction.php?",function(respond){
				console.log(respond);
				$('#dropdown_selector_action').select2({
					// allowClear: true,
					data: respond
				});
			});

		});
	}).apply( this, [ jQuery ]);
</script>

<?php
break;
case "viewappl":
$list = mysqli_query($konek, "select * from v_listAppl where idCust='$_GET[id]'");
$r    = mysqli_fetch_array($list);
//echo $lastID;
//exit();
?>
<div class="row">
    <div class="col-lg-12">
        <section class=" panel-featured panel-featured-warning">
            <header class="panel-heading">
                <center>
                    <h3 class="panel-title">View Applicant Detail</h3>
                </center>
            </header>
            <div class="panel-body">

                    <span class="center help-block border-top">Applican Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Application Status</label>
                        <div class="col-md-6">
              						<input type="text" name="appStatus" value="<?php echo $r['appStatus'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Application Action</label>
                        <div class="col-md-6">
              						<input type="text" name="app_action" value="<?php echo $r['appAction'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                        <div class="col-md-6">
              						<input type="text" name="full_name" value="<?php echo $r['nmCust'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
              						<input type="text" name="gender" value="<?php echo $r['jnsKelamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                        <div class="col-md-6">
              						<input type="text" name="ktp" value="<?php echo $r['ktp'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                        <div class="col-md-6">
              						<input type="text" name="npwp" value="<?php echo $r['npwp'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
              					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                      <div class="col-md-6">
            						<textarea name="address" class="form-control" rows="3" id="textareaDefault" readonly><?php echo $r['alamat'];?></textarea>
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                      <div class="col-md-6">
            						<input type="text" name="dob" value="<?php echo date("d-m-Y", strtotime($r['tglLahir'])); ?>" id="inputReadOnly" class="form-control" readonly="readonly">
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                      <div class="col-md-6">
                        <input type="text" name="pob" value="<?php echo $r['tmptLahir'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Handphone Number</label>
                        <div class="col-md-6">
                          <input type="text" name="hp" value="<?php echo $r['noHP'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>

                    <span class="center help-block border-top">Source of Income</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Online Driver?</label>
                        <div class="col-md-6">
                          <input type="text" name="online_driver" value="<?php echo $r['driverOnline'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Driver Apps</label>
                        <div class="col-md-6">
                          <input type="text" name="driver_apps" value="<?php echo $r['aplikasi'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>

                    <span class="center help-block border-top">Spouse Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                        <div class="col-md-6">
                          <input type="text" name="full_name_spouse" value="<?php echo $r['nmPas'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
                          <input type="text" name="gender_spouse" value="<?php echo $r['jnsKelaminPas'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                        <div class="col-md-6">
                          <input type="text" name="ktp_spouse" value="<?php echo $r['ktpPas'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                        <div class="col-md-6">
                          <input type="text" name="npwp_spouse" value="<?php echo $r['npwpPas'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                      <div class="col-md-6">
            						<textarea name="address_spouse" class="form-control" rows="3" id="textareaDefault" readonly><?php echo $r['almtPas'];?></textarea>
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                      <div class="col-md-6">
            						<input type="text" name="dob_spouse" value="<?php echo date("d-m-Y", strtotime($r['tglLahirPas'])); ?>" id="inputReadOnly" class="form-control" readonly="readonly">
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                      <div class="col-md-6">
                        <input type="text" name="pob_spouse" value="<?php echo $r['tmptLahirPas'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>

                    <span class="center help-block border-top">Guarantor Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                        <div class="col-md-6">
                          <input type="text" name="full_name_guarantor" value="<?php echo $r['nmJamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
                          <input type="text" name="gender_guarantor" value="<?php echo $r['jnskelaminJamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                        <div class="col-md-6">
                          <input type="text" name="ktp_guarantor" value="<?php echo $r['ktpJamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                        <div class="col-md-6">
                          <input type="text" name="npwp_guarantor" value="<?php echo $r['npwpJamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                      <div class="col-md-6">
            						<textarea name="address_guarantor" class="form-control" rows="3" id="textareaDefault" readonly><?php echo $r['almtJamin'];?></textarea>
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                      <div class="col-md-6">
            						<input type="text" name="dob_guarantor" value="<?php echo date("d-m-Y", strtotime($r['tglLahirJamin'])); ?>" id="inputReadOnly" class="form-control" readonly="readonly">
            					</div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                      <div class="col-md-6">
                        <input type="text" name="pob_guarantor" value="<?php echo $r['tmptLahirJamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>

                    <span class="center help-block border-top">Financier Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Financing Company</label>
                        <div class="col-md-6">
                          <input type="text" name="fin_comp" value="<?php echo $r['codeFinCompany'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>

                    <span class="center help-block border-top">Sales Channel Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Sales Channel</label>
                        <div class="col-md-6">
                          <input type="text" name="dealer" value="<?php echo $r['salesChannel'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Branch</label>
                        <div class="col-md-6">
                          <input type="text" name="branch" value="<?php echo $r['SalesChannelBranch'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Sales/PIC Name</label>
                        <div class="col-md-6">
                          <input type="text" name="sales_name" value="<?php echo $r['salesName'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                        </div>
                    </div>

                    <span class="center help-block border-top">Document Upload</span>
                    <div class="form-group" id="form-fotoktp">
                      <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                      <div class="col-md-6">
                        <input type="text" name="fotoktp" value="<?php echo $r['fotoKTP'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotoktp2">
                      <label class="col-md-3 control-label" for="inputHelpText">Spouse/Guarantor KTP</label>
                      <div class="col-md-6">
                        <input type="text" name="fotoktp2" value="<?php echo $r['fotoKTP2'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotosim">
                      <label class="col-md-3 control-label" for="inputHelpText">SIM (Driver License)</label>
                      <div class="col-md-6">
                        <input type="text" name="fotosim" value="<?php echo $r['fotoSIM'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotonpwp">
                      <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                      <div class="col-md-6">
                        <input type="text" name="fotonpwp" value="<?php echo $r['fotoNPWP'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotokk">
                      <label class="col-md-3 control-label" for="inputHelpText">KK</label>
                      <div class="col-md-6">
                        <input type="text" name="fotokk" value="<?php echo $r['fotoKK'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-aeonform">
                      <label class="col-md-3 control-label" for="inputHelpText">AEON Form</label>
                      <div class="col-md-6">
                        <input type="text" name="fotoaeonform" value="<?php echo $r['fotoAEONForm'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group" id="form-other">
                      <label class="col-md-3 control-label" for="inputHelpText">Other Dokumen</label>
                      <div class="col-md-6">
                        <input type="text" name="fotoother" value="<?php echo $r['fotoAppDok'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                      </div>
                    </div>
                    <div class="center form-group">
                          <button class='btn btn-info' onclick='history.back();' type='back' ><i class='fa fa-back'></i>Back</button>
                  				<?php
                  					if($_SESSION['leveluser']=='3' or $_SESSION['leveluser']=='5' or $_SESSION['leveluser']=='1'){
                  				?>
                  						<a href='?mod=listappl&act=editappl&id=<?php echo $r['idCust']; ?>'> <button class='btn btn-danger' ><i class='fa fa-pencil'> Edit Data</i></button></a>
                  				<?php
                  					}
                  				?>
                    </div>
            </div>
        </section>
    </div>
</div>


<?php
break;
case "editappl" :
?>
<?php
$list = mysqli_query($konek, "select * from v_listAppl where idCust='$_GET[id]'");
$r    = mysqli_fetch_array($list);
?>
        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12">
                <section class=" panel-featured panel-featured-warning">
                    <header class="panel-heading">
                        <center>
                            <h3 class="panel-title">Edit Applicant Detail</h3>
                        </center>
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-reg" action="<?php echo $aksi;?>?mod=listappl&act=update"  method="post" enctype="multipart/form-data">

                            <span class="center help-block border-top">Applicant Information</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Application Status</label>
                                <div class="col-md-6">
                                    <select name="app_status" id="app_status" data-plugin-selectTwo class="form-control populate">
                                      <optgroup label="Status">
                      									<option value= 1 <?php if($r['appStatus']=='New Application')echo "selected"; ?>>New Application</option>
                      									<option value= 2 <?php if($r['appStatus']=='Send BI Checking')echo "selected"; ?>>Send BI Checking</option>
                      									<option value= 3 <?php if($r['appStatus']=='Cancel (BI Checking)')echo "selected"; ?>>Cancel (BI Checking)</option>
                      									<option value= 4 <?php if($r['appStatus']=='Cancel (Applicant Request)')echo "selected"; ?>>Cancel (Applicant Request)</option>
                      									<option value= 5 <?php if($r['appStatus']=='Approve (BI Checking)')echo "selected"; ?>>Approve (BI Checking)</option>
                                        <option value= 6 <?php if($r['appStatus']=='Reject (BI CHecking)')echo "selected"; ?>>Reject (BI CHecking)</option>
                      									<option value= 7 <?php if($r['appStatus']=='Scheduling Seminar')echo "selected"; ?>>Scheduling Seminar</option>
                      									<option value= 8 <?php if($r['appStatus']=='Joined Seminar')echo "selected"; ?>>Joined Seminar</option>
                      									<option value= 9 <?php if($r['appStatus']=='Reject (Uncomplete Document)')echo "selected"; ?>>Reject (Uncomplete Document)</option>
                      									<option value= 10 <?php if($r['appStatus']=='Reject (Income Calculation)')echo "selected"; ?>>Reject (Income Calculation)</option>
                                        <option value= 11 <?php if($r['appStatus']=='House Visit')echo "selected"; ?>>House Visit</option>
                      									<option value= 12 <?php if($r['appStatus']=='Reject (House Visit)')echo "selected"; ?>>Reject (House Visit)</option>
                                        <option value= 13 <?php if($r['appStatus']=='Hold')echo "selected"; ?>>Hold</option>
                      									<option value= 14 <?php if($r['appStatus']=='PO')echo "selected"; ?>>PO</option>
                      									<option value= 15 <?php if($r['appStatus']=='Car Preparation')echo "selected"; ?>>Car Preparation</option>
                      									<option value= 16 <?php if($r['appStatus']=='Hand Over')echo "selected"; ?>>Hand Over</option>
                                      </optgroup>
                                    </select>
                                    <input type="hidden" name="idCust" value="<?php echo $r['idCust']; ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Application Action</label>
                                <div class="col-md-6">
                                    <select name="app_action" id="app_action" data-plugin-selectTwo class="form-control populate">
                                      <optgroup label="Action">
                      									<option value= 1 <?php if($r['appAction']=='Processing')echo "selected"; ?>>Processing</option>
                      									<option value= 2 <?php if($r['appAction']=='Income calculation')echo "selected"; ?>>Income calculation</option>
                      									<option value= 3 <?php if($r['appAction']=='Complete the document')echo "selected"; ?>>Complete the document</option>
                      									<option value= 4 <?php if($r['appAction']=='Hold')echo "selected"; ?>>Hold</option>
                      									<option value= 5 <?php if($r['appAction']=='Stop')echo "selected"; ?>>Stop</option>
                                      </optgroup>
                                    </select>
                                </div>
                            </div>
                            <span class="center help-block border-top">Applicant Data</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                        </span>
                                        <input type="text" name="full_name" id="full_name" value="<?php echo $r['nmCust']; ?>" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                                <div class="col-md-6">
                                      <input type="text" name="gender" value="<?php echo $r['jnsKelamin'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="ktp" id="ktp" value="<?php echo $r['ktp']; ?>" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="npwp" id="npwp" value="<?php echo $r['npwp']; ?>" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <textarea class="form-control" rows="3" id="address" name="address" readonly><?php echo $r['alamat']; ?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                  </span>
                                  <input type="text" id="dob" name="dob" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $r['tglLahir'];?>" readonly="readonly">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <input type="text" name="pob" id="pob" placeholder="Place of Birth" class="form-control" value="<?php echo $r['tmptLahir']; ?>" readonly="readonly">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Handphone Number</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-phone"></i></span>
                                        </span>
                                        <input type="text" name="hp" id="hp" placeholder="08123456789" class="form-control" value="<?php echo $r['noHP']; ?>" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                            <span class="center help-block border-top">Source of Income</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Online Driver?</label>
                                <div class="col-md-6">
                                  <input type="text" name="online_driver" value="<?php echo $r['driverOnline'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Driver Apps</label>
                                <div class="col-md-6">
                                  <input type="text" name="driver_apps" value="<?php echo $r['aplikasi'];?>" id="inputReadOnly" class="form-control" readonly="readonly">
                                </div>
                            </div>

                            <span class="center help-block border-top">Spouse Information</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                        </span>
                                        <input type="text" name="full_name_spouse" id="full_name_spouse" placeholder="Full Name" class="form-control" value="<?php echo $r['nmPas']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                                <div class="col-md-6">
                                    <select name="gender_spouse" id="gender_spouse" data-plugin-selectTwo class="form-control populate">
                                        <optgroup label="Gender">
                                          <option value= "Male" <?php if($r['jnsKelaminPas']=='Male')echo "selected"; ?>>Male</option>
                                          <option value= "Female" <?php if($r['jnsKelaminPas']=='Female')echo "selected"; ?>>Female</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="ktp_spouse" placeholder="KTP" class="form-control" value="<?php echo $r['ktpPas']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="npwp_spouse" placeholder="NPWP" class="form-control" value="<?php echo $r['npwpPas']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <textarea class="form-control" rows="3" id="address_spouse" name="address_spouse"><?php echo $r['almtPas']; ?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                  </span>
                                  <input type="text" id="dob_spouse" name="dob_spouse" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $r['tglLahirPas'];?>">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <input type="text" name="pob_spouse" id="pob_spouse" placeholder="Place of Birth" class="form-control" value="<?php echo $r['tmptLahirPas'];?>">
                                </div>
                              </div>
                            </div>

                            <span class="center help-block border-top">Guarantor Information</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Full Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                        </span>
                                        <input type="text" name="full_name_guarantor" id="full_name_guarantor" placeholder="Full Name" class="form-control" value="<?php echo $r['nmJamin'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                                <div class="col-md-6">
                                    <select name="gender_guarantor" id="gender_guarantor" data-plugin-selectTwo class="form-control populate" value="<?php echo $r['jnskelaminJamin'];?>">
                                        <optgroup label="Gender">
                                          <option value= "Male" <?php if($r['jnskelaminJamin']=='Male')echo "selected"; ?>>Male</option>
                                          <option value= "Female" <?php if($r['jnskelaminJamin']=='Female')echo "selected"; ?>>Female</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="ktp_guarantor" placeholder="KTP" class="form-control" value="<?php echo $r['ktpJamin'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-copy"></i></span>
                                        </span>
                                        <input type="text" name="npwp_guarantor" placeholder="NPWP" class="form-control" value="<?php echo $r['npwpJamin'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Address</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <textarea class="form-control" rows="3" id="address_guarantor" name="address_guarantor"><?php echo $r['almtJamin']; ?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Date of Birth</label>
                              <div class="col-sm-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                  </span>
                                  <input type="text" id="dob_guarantor" name="dob_guarantor" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $r['tglLahirJamin'];?>">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label" for="inputHelpText">Place of Birth</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                                  </span>
                                  <input type="text" name="pob_guarantor" id="pob_guarantor" placeholder="Place of Birth" class="form-control" value="<?php echo $r['tmptLahirJamin'];?>">
                                </div>
                              </div>
                            </div>

                            <span class="center help-block border-top">Financier Information</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Financing Company</label>
                                <div class="col-md-6">
                                    <select name="fin_comp" id="fin_comp" data-plugin-selectTwo class="form-control populate" >
                                        <optgroup label="Financing Company">
                                            <option value= 1 <?php if($r['codeFinCompany']=='ACSI')echo "selected"; ?>>ACSI</option>
                                            <option value= 2 <?php if($r['codeFinCompany']=='MFI')echo "selected"; ?>>MFI</option>
                                            <option value= 3 <?php if($r['codeFinCompany']=='VMF')echo "selected"; ?>>VMF</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <span class="center help-block border-top">Sales Channel Information</span>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Sales Channel</label>
                                <div class="col-md-6">
                                    <select name="dealer" id="dealer" data-plugin-selectTwo class="form-control populate" >
                                        <optgroup label="Dealer">
                                            <option value= 1 <?php if($r['salesChannel']=='Coop Gober')echo "selected"; ?>>Coop Gober</option>
                                            <option value= 2 <?php if($r['salesChannel']=='Tunas Toyota')echo "selected"; ?>>Tunas Toyota</option>
                                            <option value= 3 <?php if($r['salesChannel']=='Tunas Daihatsu')echo "selected"; ?>>Tunas Daihatsu</option>
                                            <option value= 4 <?php if($r['salesChannel']=='Auto 2000')echo "selected"; ?>>Auto 2000</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Branch</label>
                                <div class="col-md-6">
                                    <select name="branch" id="branch" data-plugin-selectTwo class="form-control populate" >
                                        <optgroup label="Branch">
                                            <option value= 1 <?php if($r['SalesChannelBranch']=='Pasar Minggu')echo "selected"; ?>>Pasar Minggu</option>
                                            <option value= 2 <?php if($r['SalesChannelBranch']=='Mampang')echo "selected"; ?>>Mampang</option>
                                            <option value= 3 <?php if($r['SalesChannelBranch']=='Jatiwaringin')echo "selected"; ?>>Jatiwaringin</option>
                                            <option value= 4 <?php if($r['SalesChannelBranch']=='Mampang')echo "selected"; ?>>Mampang</option>
                                            <option value= 5 <?php if($r['SalesChannelBranch']=='Pondok Bambu')echo "selected"; ?>>Pondok Bambu</option>
                                            <option value= 6 <?php if($r['SalesChannelBranch']=='Pramuka')echo "selected"; ?>>Pramuka</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputHelpText">Sales/PIC Name</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                        </span>
                                        <input type="text" name="sales_name" id="sales_name" placeholder="Sales/PIC Name" class="form-control" value="<?php echo $r['salesName'];?>">
                                    </div>
                                </div>
                            </div>

                            <span class="center help-block border-top">Document Upload</span>
                            <div class="form-group" id="form-fotoktp">
                              <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                                    <?php
                          				    	if(!empty($r['fotoKTP'])){
                          				  ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotoktp" id="fotoktp" placeholder="KTP File" class="form-control" value="<?php echo $r['fotoKTP'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotoktpA" id="fotoktpA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change1' onclick="javascript:switchVisible1();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                              			?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotoktpA" id="fotoktpA" type="file">
                                        </div>
                                    <?php
                                        }
                                  	?>
                            </div>
                            <div class="form-group" id="form-fotoktp2">
                              <label class="col-md-3 control-label" for="inputHelpText">Spouse/Guarantor KTP</label>
                                    <?php
                                        if(!empty($r['fotoKTP2'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotoktp2" id="fotoktp2" placeholder="Spouse/Guarantor KTP File" class="form-control" value="<?php echo $r['fotoKTP2'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotoktp2A" id="fotoktp2A" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change2' onclick="javascript:switchVisible2();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotoktp2" id="fotoktp2" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="form-group" id="form-fotosim">
                              <label class="col-md-3 control-label" for="inputHelpText">SIM (Driver License)</label>
                                    <?php
                                        if(!empty($r['fotoSIM'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotosim" id="fotosim" placeholder="SIM File" class="form-control" value="<?php echo $r['fotoSIM'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotosimA" id="fotosimA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change3' onclick="javascript:switchVisible3();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotosimA" id="fotosimA" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="form-group" id="form-fotonpwp">
                              <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                                    <?php
                                        if(!empty($r['fotoNPWP'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotonpwp" id="fotonpwp" placeholder="NPWP File" class="form-control" value="<?php echo $r['fotoNPWP'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotonpwpA" id="fotonpwpA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change4' onclick="javascript:switchVisible4();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotonpwpA" id="fotonpwpA" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="form-group" id="form-fotokk">
                              <label class="col-md-3 control-label" for="inputHelpText">KK</label>
                                    <?php
                                        if(!empty($r['fotoKK'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotokk" id="fotokk" placeholder="KK File" class="form-control" value="<?php echo $r['fotoKK'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotokkA" id="fotokkA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change5' onclick="javascript:switchVisible5();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotokkA" id="fotokkA" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="form-group" id="form-aeonform">
                              <label class="col-md-3 control-label" for="inputHelpText">AEON Form</label>
                                    <?php
                                        if(!empty($r['fotoAEONForm'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotoaeonform" id="fotoaeonform" placeholder="AEON Form File" class="form-control" value="<?php echo $r['fotoAEONForm'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotoaeonformA" id="fotoaeonformA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change6' onclick="javascript:switchVisible6();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotoaeonformA" id="fotoaeonformA" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="form-group" id="form-other">
                              <label class="col-md-3 control-label" for="inputHelpText">Other Dokumen</label>
                                    <?php
                                        if(!empty($r['fotoAppDok'])){
                                    ?>
                                        <div class="col-md-4">
                                          <input type="text" name="fotoother" id="fotoother" placeholder="Other File" class="form-control" value="<?php echo $r['fotoAppDok'];?>" readonly="readonly">
                                          <input class="form-control"  name="fotootherA" id="fotootherA" type="file" style="display:none">
                                        </div>
                                        <div class="col-md-2">
                                          <button class='btn btn-warning' type='button' id='change7' onclick="javascript:switchVisible7();">Change</button>
                                        </div>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="col-md-4">
                                          <input class="form-control"  name="fotootherA" id="fotootherA" type="file">
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <br>
                            <button class='btn btn-info' onclick='history.back();' type='back' ><i class='fa fa-back'></i>Cancel</button>
                            <button class='btn btn-info'  type='submit' ><i class='fa fa-pencil'></i>Update</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <script>
          function switchVisible1() {
                  if (document.getElementById('fotoktpA'))
                  {
                      if (document.getElementById('fotoktpA').style.display == 'none')
                      {
                          document.getElementById('fotoktpA').style.display = 'block';
                          document.getElementById('fotoktp').style.display = 'none';
                          document.getElementById('change1').style.display = 'none';
                      }
                  }
          }
          function switchVisible2() {
                  if (document.getElementById('fotoktp2A'))
                  {
                      if (document.getElementById('fotoktp2A').style.display == 'none')
                      {
                          document.getElementById('fotoktp2A').style.display = 'block';
                          document.getElementById('fotoktp2').style.display = 'none';
                          document.getElementById('change2').style.display = 'none';
                      }
                  }
          }
          function switchVisible3() {
                  if (document.getElementById('fotosimA'))
                  {
                      if (document.getElementById('fotosimA').style.display == 'none')
                      {
                          document.getElementById('fotosimA').style.display = 'block';
                          document.getElementById('fotosim').style.display = 'none';
                          document.getElementById('change3').style.display = 'none';
                      }
                  }
          }
          function switchVisible4() {
                  if (document.getElementById('fotonpwpA'))
                  {
                      if (document.getElementById('fotonpwpA').style.display == 'none')
                      {
                          document.getElementById('fotonpwpA').style.display = 'block';
                          document.getElementById('fotonpwp').style.display = 'none';
                          document.getElementById('change4').style.display = 'none';
                      }
                  }
          }
          function switchVisible5() {
                  if (document.getElementById('fotokkA'))
                  {
                      if (document.getElementById('fotokkA').style.display == 'none')
                      {
                          document.getElementById('fotokkA').style.display = 'block';
                          document.getElementById('fotokk').style.display = 'none';
                          document.getElementById('change5').style.display = 'none';
                      }
                  }
          }
          function switchVisible6() {
                  if (document.getElementById('fotoaeonformA'))
                  {
                      if (document.getElementById('fotoaeonformA').style.display == 'none')
                      {
                          document.getElementById('fotoaeonformA').style.display = 'block';
                          document.getElementById('fotoaeonform').style.display = 'none';
                          document.getElementById('change6').style.display = 'none';
                      }
                  }
          }
          function switchVisible7() {
                  if (document.getElementById('fotootherA'))
                  {
                      if (document.getElementById('fotootherA').style.display == 'none')
                      {
                          document.getElementById('fotootherA').style.display = 'block';
                          document.getElementById('fotoother').style.display = 'none';
                          document.getElementById('change7').style.display = 'none';
                      }
                  }
          }
        </script>

<?php
break;
}
?>
