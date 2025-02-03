<?php include(INCLUDE_DIR.'header.php') ?>
<?php
$msg = base64_decode($_SESSION['otp_msg']);
?>
<div class="center-section-in">
  <div class="container">
    <div class="row">
     <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="box-1" style="min-height: auto;">
          <h2 class="font-20 text-uppercase text-center mb-3"> please enter OTP below</span> </h2>
          
           <?php if(!empty($msg)) { ?>
               <center><p style="color:#F00">
                  <?=$msg?>
                </p></center>
                <?php } ?>
          <p style="margin:0; padding:0; font-size:15px; text-align:right; color:#FF0000" id="error1"></p>
          <form action="<?=HTACCESS_URL?>loginController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
          <input type="hidden" name="mode" value="verify_otp">
          <input type="hidden" name="info[name]" value="<?=$_SESSION['sign_up']['name']?>">
          <input type="hidden" name="info[email]" value="<?=$_SESSION['sign_up']['email']?>">
          <input type="hidden" name="info[mobile_no]" value="<?=$_SESSION['sign_up']['mobile_no']?>">
          <input type="hidden" name="info[state]" value="<?=$_SESSION['sign_up']['state']?>">
          <input type="hidden" name="info[city]" value="<?=$_SESSION['sign_up']['city']?>">
          <input type="hidden" name="info[username]" value="<?=$_SESSION['sign_up']['username']?>">
          <input type="hidden" name="password" value="<?=$_SESSION['sign_up']['password']?>">
          <input type="hidden" name="info[user_type]" value="<?=$_SESSION['sign_up']['user_type']?>">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="otp" id="otp" class="form-control font-15 input-css" placeholder="Otp" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Verify">
              </div>
            </div>
          </div>
          </form>
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
<?php unset($_SESSION['otp_msg']);?>
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
	if(isEmpty("Otp",document.getElementById("otp").value)) {
		document.getElementById("otp").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Otp* ");
		document.getElementById('otp').style.borderColor  = '#FF0000';
		document.getElementById("otp").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("otp").addEventListener("keyup", controlBorderColor, false);
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
