<?php include(INCLUDE_DIR.'header.php') ?>
<?
$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
$msg = base64_decode($_SESSION['otp_msg']);
?>
<div class="center-section-in">
  <div class="container">
    <div class="row">
     <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="box-1" style="min-height: auto;">
          <h2 class="font-20 text-uppercase text-center mb-3"> 
          please enter OTP below</span> </h2>
          <?=$_SESSION['billing']['otp']?>
           <?php if(!empty($msg)) { ?>
                 <center><p style="color:#F00">
                  <?=$msg?>
                </p></center>
                <?php } ?>
          <p style="margin:0;padding:0;font-size:15px;text-align:right;color:#FF0000" id="error1"></p>
          <form action="<?=HTACCESS_URL?>userController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
          <input type="hidden" name="mode" value="billing">
          <input type="hidden" name="info[name]" value="<?=$_SESSION['billing']['name']?>">
          <input type="hidden" name="info[mobile_no]" value="<?=$_SESSION['billing']['mobile_no']?>">
          <input type="hidden" name="info[email]" value="<?=$_SESSION['billing']['email']?>">
          <input type="hidden" name="info[state]" value="<?=$_SESSION['billing']['state']?>">
          <input type="hidden" name="info[city]" value="<?=$_SESSION['billing']['city']?>">
          <input type="hidden" name="info[address]" value="<?=$_SESSION['billing']['address']?>">
          <input type="hidden" name="info[add]" value="<?=$_SESSION['billing']['add']?>">
          <input type="hidden" name="info[prop_add]" value="<?=$_SESSION['billing']['prop_add']?>">
          <input type="hidden" name="data[property_type]" value="<?=$_SESSION['billing']['property_type']?>">
          <input type="hidden" name="data[no_of_bedrooms]" value="<?=$_SESSION['billing']['no_of_bedrooms']?>">
          <input type="hidden" name="data[no_of_bathrooms]" value="<?=$_SESSION['billing']['no_of_bathrooms']?>">
          <input type="hidden" name="data[state]" value="<?=$_SESSION['billing']['prop_state']?>">
          <input type="hidden" name="data[city]" value="<?=$_SESSION['billing']['prop_city']?>">
          <input type="hidden" name="data[detail]" value="<?=$_SESSION['billing']['detail']?>">
          <input type="hidden" name="data[hear_about]" value="<?=$_SESSION['billing']['hear_about']?>">
          <input type="hidden" name="data[for_property]" value="<?=$_SESSION['billing']['for_property']?>">
          <input type="hidden" name="data[amount]" value="<?=$_SESSION['billing']['amount']?>">
          <input type="hidden" name="data[validity]" value="<?=$_SESSION['billing']['validity']?>">
         
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
      <div class="col-lg-3"></div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<? unset($_SESSION['otp_msg']);?>
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
<? if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<? }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<? }?>