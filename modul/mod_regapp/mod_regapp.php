<?php
$aksi = "modul/mod_regapp/action_regapp.php";
//$print = "modul/mod_regjamaah/print_jamaah.php";
// mengatasi variabel yang belum di definisikan (notice undefined index)
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id_agen = $_SESSION['namauser'];

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
switch($act){
default:
?>
<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <section class=" panel-featured panel-featured-warning">
            <header class="panel-heading">
                <center>
                    <img src="assets/images/LogoGMSIndonesia.png" height="54" >
                    <h3 class="panel-title">Applicant Registration</h3>
                </center>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" id="form-reg" action="<?php echo $aksi;?>?mod=regapp&act=registrasi"  method="post" enctype="multipart/form-data">

                    <span class="center help-block border-top">Applicant Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Application Status</label>
                        <div class="col-md-6">
                            <select name="app_status" id="app_status" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Status"></optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Application Action</label>
                        <div class="col-md-6">
                            <select name="app_action" id="app_action" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Action"></optgroup>
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
                                <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
                            <select name="gender" id="gender" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Gender">
                                    <option value="">-Choose-</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                                <input type="text" name="ktp" id="ktp" placeholder="KTP" class="form-control" required>
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
                                <input type="text" name="npwp" id="npwp" placeholder="NPWP" class="form-control" required>
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
                          <textarea class="form-control" rows="3" id="address" name="address" required></textarea>
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
                          <input type="text" id="dob" name="dob" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD" required>
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
                          <input type="text" name="pob" id="pob" placeholder="Place of Birth" class="form-control" required>
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
                                <input type="text" name="hp" id="hp" placeholder="08123456789" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <span class="center help-block border-top">Source of Income</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Online Driver?</label>
                        <div class="col-md-6">
                            <select name="online_driver" id="online_driver" data-plugin-selectTwo class="form-control populate">
                                <optgroup label="Online Driver?">
                                    <option value="">-Choose-</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Driver Apps</label>
                        <div class="col-md-6">
                            <select name="driver_apps" id="driver_apps" data-plugin-selectTwo class="form-control populate">
                                <optgroup label="Driver Apps">
                                    <option value="">-Choose-</option>
                                </optgroup>
                            </select>
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
                                <input type="text" name="full_name_spouse" id="full_name_spouse" placeholder="Full Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
                            <select name="gender_spouse" id="gender_spouse" data-plugin-selectTwo class="form-control populate">
                                <optgroup label="Gender">
                                    <option value="">-Choose-</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                                <input type="text" name="ktp_spouse" placeholder="KTP" class="form-control">
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
                                <input type="text" name="npwp_spouse" placeholder="NPWP" class="form-control">
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
                          <textarea class="form-control" rows="3" id="address_spouse" name="address_spouse"></textarea>
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
                          <input type="text" id="dob_spouse" name="dob_spouse" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD">
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
                          <input type="text" name="pob_spouse" id="pob_spouse" placeholder="Place of Birth" class="form-control">
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
                                <input type="text" name="full_name_guarantor" id="full_name_guarantor" placeholder="Full Name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="w1-jenis">Gender</label>
                        <div class="col-md-6">
                            <select name="gender_guarantor" id="gender_guarantor" data-plugin-selectTwo class="form-control populate">
                                <optgroup label="Gender">
                                    <option value="">-Choose-</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                                <input type="text" name="ktp_guarantor" placeholder="KTP" class="form-control">
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
                                <input type="text" name="npwp_guarantor" placeholder="NPWP" class="form-control">
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
                          <textarea class="form-control" rows="3" id="address_guarantor" name="address_guarantor"></textarea>
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
                          <input type="text" id="dob_guarantor" name="dob_guarantor" data-plugin-datepicker class="form-control" placeholder="YYYY-MM-DD">
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
                          <input type="text" name="pob_guarantor" id="pob_guarantor" placeholder="Place of Birth" class="form-control">
                        </div>
                      </div>
                    </div>

                    <span class="center help-block border-top">Financier Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Financing Company</label>
                        <div class="col-md-6">
                            <select name="fin_comp" id="fin_comp" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Financing Company">
                                    <option value="">-Choose-</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <span class="center help-block border-top">Sales Channel Information</span>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Sales Channel</label>
                        <div class="col-md-6">
                            <select name="dealer" id="dealer" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Dealer">
                                    <option value="">-Choose-</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputHelpText">Branch</label>
                        <div class="col-md-6">
                            <select name="branch" id="branch" data-plugin-selectTwo class="form-control populate" required>
                                <optgroup label="Branch">
                                    <option value="">-Choose-</option>
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
                                <input type="text" name="sales_name" id="sales_name" placeholder="Sales/PIC Name" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <span class="center help-block border-top">Document Upload</span>
                    <div class="form-group" id="form-fotoktp">
                      <label class="col-md-3 control-label" for="inputHelpText">KTP</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotoktp" id="fotoktp" type="file">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotoktp2">
                      <label class="col-md-3 control-label" for="inputHelpText">Spouse/Guarantor KTP</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotoktp2" id="fotoktp2" type="file">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotosim">
                      <label class="col-md-3 control-label" for="inputHelpText">SIM (Driver License)</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotosim" id="fotosim" type="file" >
                      </div>
                    </div>
                    <div class="form-group" id="form-fotonpwp">
                      <label class="col-md-3 control-label" for="inputHelpText">NPWP</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotonpwp" id="fotonpwp" type="file">
                      </div>
                    </div>
                    <div class="form-group" id="form-fotokk">
                      <label class="col-md-3 control-label" for="inputHelpText">KK</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotokk" id="fotokk" type="file">
                      </div>
                    </div>
                    <div class="form-group" id="form-aeonform">
                      <label class="col-md-3 control-label" for="inputHelpText">AEON Form</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotoaeonform" id="fotoaeonform" type="file">
                      </div>
                    </div>
                    <div class="form-group" id="form-other">
                      <label class="col-md-3 control-label" for="inputHelpText">Other Dokumen</label>
                      <div class="col-md-6">
                        <input class="form-control"  name="fotoother" id="fotoother" type="file">
                      </div>
                    </div>

            				<div class="row" style="display:none" id="error-block">
            					<center>
            						<div class="col-md-6 col-md-offset-3 alert alert-danger">
            							<label id = "error"> </label>
            						</div>
            					</center>
            				</div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
    						             <a class='modal-sizes' onclick='data_applicant.apl()' href="#modalRJ">
                            <button type="button" id="submit-appl" class="btn btn-primary">Submit</button></a>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="modalRJ" class="modal-block modal-block-sm mfp-hide">
    <section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title">Applicant Registration Confirmation</h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-text">
					<div style="" >
						<div style=" width:40%; float:left;">Applicant Name</div>
						<div style="float:left; padding-right: 5px;">:</div>
						<div style="width:auto; float:left;" id="modal_full_name"></div>
					</div>
					<div style="clear: both;" >
						<div style="width:40%; float:left;">KTP No.</div>
						<div style="float:left; padding-right: 5px;">:</div>
						<div style="width:auto; float:left;" id="modal_ktp"></div>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
				  <a id="dom_applicant">
					<button class="btn btn-primary" id="submit-validasi">Submit</button>
					</a>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    	$("#submit-appl").click(function(){
    		if($('#full_name').val() == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Full name cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('gender')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Gender cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('ktp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("KTP cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('npwp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("NPWP cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('address')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Address cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('dob')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Date of birth cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('pob')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Place of birth cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('hp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Handphone number cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('online_driver')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Online driver status cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('driver_apps')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Driver apps cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fin_comp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Financing Company cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('dealer')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Dealer cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('branch')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Branch dealer cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('sales_name')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("Sales name cannot be empty!!!");
    			return false;
    		}/*else if(document.getElementsByName('fotoktp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("KTP file cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fotoktp2')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("KTP of spouse/guarantor file cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fotosim')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("SIM file cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fotonpwp')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("NPWP file cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fotokk')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("KK file cannot be empty!!!");
    			return false;
    		}else if(document.getElementsByName('fotoaeonform')[0].value == ""){
    			$("#error-block").css("display","block");
    			$("#error").html("AEON Form file cannot be empty!!!");
    			return false;
    		}*/else{
    			$("#error-block").css("display","none");
    			return true;
    		}

    	});
    });
    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    var data_applicant={
    	apl:function(){
    		document.getElementById('modal_full_name').textContent=$('#full_name').val();
    		document.getElementById('modal_ktp').textContent=$('#ktp').val();
    	}
    }
    $('#submit-validasi').click(function(){
    	$( "#form-reg" ).submit();
    });
</script>
<script>
(function( $ ) {
  'use strict';
  $(function() {

    $.getJSON("modul/mod_regapp/json_getstatus.php?",function(respond){
      console.log(respond);
      $('#app_status').select2({
        // allowClear: true,
        data: respond
      });
    });
    $.getJSON("modul/mod_regapp/json_getaction.php?",function(respond){
      console.log(respond);
      $('#app_action').select2({
        // allowClear: true,
        data: respond
      });
    });
    $.getJSON("modul/mod_regapp/json_getdriverapp.php?",function(respond){
      console.log(respond);
      $('#driver_apps').select2({
        // allowClear: true,
        data: respond
      });
    });
    $.getJSON("modul/mod_regapp/json_getfin.php?",function(respond){
      console.log(respond);
      $('#fin_comp').select2({
        // allowClear: true,
        data: respond
      });
    });
    $.getJSON("modul/mod_regapp/json_getdealer.php?",function(respond){
      console.log(respond);
      $('#dealer').select2({
        // allowClear: true,
        data: respond
      });
    });
    $.getJSON("modul/mod_regapp/json_getbranch.php?",function(respond){
      console.log(respond);
      $('#branch').select2({
        // allowClear: true,
        data: respond
      });
    });

  });
}).apply( this, [ jQuery ]);
</script>
<?php
  break;
 }
?>
