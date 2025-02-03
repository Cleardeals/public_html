<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}
$msg = base64_decode($_SESSION['find_msg']);
?>
<style>
#error1 {
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
</style>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Properties <span class="themecolor">
          For You</span></h2>
          <div class="row justify-content-md-center">
            <div class="col-md-8">
            <p>Nik will help you guide in your home buying.Let him know your preference by filling below details.</p>
              <div class="box-css-2">
                <?php if(!empty($msg)) { ?>
                <center>
                  <p style="color:#F00">
                    <?=$msg?>
                  </p>
                </center>
                <?php } ?>
                <p id="error1"></p>
                <form action="<?=HTACCESS_URL?>userController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
                  <input type="hidden" name="mode" value="find_property">
                  <input type="hidden" name="user_id" value="<?=$_SESSION['user']['userid']?>">
                  <div class="form-group">
                    <input type="text" name="range" id="range" class="form-control" placeholder="Budget range">
                  </div>
                  <div class="form-group">
                    <input type="text" name="city" id="city" class="form-control" placeholder="City">
                  </div>
                  <div class="form-group">
                    <input type="text" name="location" id="location" class="form-control" placeholder="Area Location">
                  </div>
                  <div class="form-group">
                    <textarea name="message" id="message" rows="5" class="form-control" placeholder="Message"></textarea>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-info mb-2 btn-css text-uppercase font-bold">Submit</button>
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
<?php unset($_SESSION['find_msg']);?>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}


function chkform() {
	if(isEmpty("Budget Range",document.getElementById("range").value)) {
		document.getElementById("range").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Budget Range* ");
		document.getElementById('range').style.borderColor  = '#FF0000';
		document.getElementById("range").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("range").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("City",document.getElementById("city").value)) {
		document.getElementById("city").focus();
		document.getElementById("error1").innerHTML=(" Please Enter City* ");
		document.getElementById('city').style.borderColor  = '#FF0000';
		document.getElementById("city").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("city").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Location",document.getElementById("location").value)) {
		document.getElementById("location").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Location* ");
		document.getElementById('location').style.borderColor  = '#FF0000';
		document.getElementById("location").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("location").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Message",document.getElementById("message").value)) {
		document.getElementById("message").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Message* ");
		document.getElementById('message').style.borderColor  = '#FF0000';
		document.getElementById("message").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("message").addEventListener("keyup", controlBorderColor, false);
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
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>
