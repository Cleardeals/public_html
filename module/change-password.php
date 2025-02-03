<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$msg = base64_decode($_SESSION['pass_msg']);
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Change 
          <span class="themecolor">Password</span></h2>
          <div class="row justify-content-md-center">
            <div class="col-md-8">
              <div class="box-css-2">
                <?php if(!empty($msg)) { ?>
                <center>
                  <p style="color:#F00">
                    <?=$msg?>
                  </p>
                </center>
                <?php } ?>
                <p style="margin:0; padding:0; font-size:15px; text-align:right; color:#FF0000" id="error1"></p>
                <form action="<?=HTACCESS_URL?>userController.php" method="post" autocomplete="off" id="accForm" onSubmit="return chkform();">
                  <input type="hidden" name="mode" value="user_password">
                  <input type="hidden" name="user_id" value="<?=$_SESSION['user']['userid']?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="password" name="password" id="current_pass" class="form-control" placeholder="Current Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="password" name="cnfrm_new_pass" id="cnfrm_new_pass" class="form-control" placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="text-center">
                        <button type="submit" class="btn btn-info mb-2 btn-css text-uppercase font-bold">
                        Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php unset($_SESSION['pass_msg']);?>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}


function chkform() {
	if(isEmpty("Current Password",document.getElementById("current_pass").value)) {
		document.getElementById("current_pass").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Current Password* ");
		document.getElementById('current_pass').style.borderColor  = '#FF0000';
		document.getElementById("current_pass").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("current_pass").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("New Password",document.getElementById("new_pass").value)) {
		document.getElementById("new_pass").focus();
		document.getElementById("error1").innerHTML=(" Please Enter New Password* ");
		document.getElementById('new_pass').style.borderColor  = '#FF0000';
		document.getElementById("new_pass").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("new_pass").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Confirm Password",document.getElementById("cnfrm_new_pass").value)) {
		document.getElementById("cnfrm_new_pass").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Confirm Password* ");
		document.getElementById('cnfrm_new_pass').style.borderColor  = '#FF0000';
		document.getElementById("cnfrm_new_pass").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("cnfrm_new_pass").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(document.getElementById("cnfrm_new_pass").value!='') {
		if(document.getElementById("cnfrm_new_pass").value!=document.getElementById("new_pass").value) {
			//alert("Password Do Not Match");
			document.getElementById("error1").innerHTML=(' Password Do Not Match ');
			document.getElementById("cnfrm_new_pass").focus();
			return false;
		}
	}
	return true;
}

function submit_host(){
	if(chkform() == true){
		document.getElementById("accForm").submit();
	}
}
</script>
<?php include(INCLUDE_DIR.'footer1.php'); ?>