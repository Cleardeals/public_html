<?php
if(isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'');
	exit;
}
?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php
$msg = base64_decode($_SESSION['forgot_msg'] ?? "");
$msg1 = base64_decode($_SESSION['forgot_succ_msg'] ?? "");
?>
<div class="center-section-in">
  <div class="container">
    <div class="row">
     <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="box-1" style="min-height: auto;">
          <h2 class="font-20 text-uppercase text-center mb-3"> Forgot Password</span> </h2>
           <?php if(!empty($msg)) { ?>
               <center><p style="color:#F00">
                  <?=$msg?>
                </p></center>
                <?php } ?>
                <?php if(!empty($msg1)) { ?>
               <center><p style="color:#060;">
                  <?=$msg1?>
                </p></center>
                <?php } ?>
          <p style="margin:0; padding:0; font-size:15px; text-align:right; color:#FF0000" id="error1"></p>
          <form action="<?=HTACCESS_URL?>loginController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
          <input type="hidden" name="mode" value="forgot_pass">
         
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="username" id="username" class="form-control font-15 input-css" placeholder="Username" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Submit">
                
              </div>
              
            </div>
            
          </div>
          </form>
          <center><a href="<?=HTACCESS_URL?>change-username/" style="color:#F00"><!--Click here to -->Forgot Username</a></center>
        </div>
      </div>
      <div class="col-lg-3">
        
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<?php unset($_SESSION['forgot_msg']);
	unset($_SESSION['forgot_succ_msg']);
?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#474845"; 
  //}
}


function chkform() {
	if(isEmpty("Username",document.getElementById("username").value)) {
		document.getElementById("username").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Username* ");
		document.getElementById('username').style.borderColor  = '#FF0000';
		document.getElementById("username").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("username").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	return true;
}

function submit_host(){
	if(chkform() == true){
		document.getElementById("accForm").submit();
	}
}

</script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
