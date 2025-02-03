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
          <h6 style="text-align:center;padding-bottom:20px;line-height:20px;"> Please fill below form if you forgot your username, admin will review your details and revert back to you. </h6>
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
          <input type="hidden" name="mode" value="change_username">
         
          <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control font-15 input-css" placeholder="Name" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control font-15 input-css" placeholder="Email" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="clientid" id="clientid" class="form-control font-15 input-css" placeholder="Client Id" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea name="detail" id="detail" class="form-control font-15 input-css" placeholder="Note"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Submit">
                
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
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Name* ");
		document.getElementById('name').style.borderColor  = '#FF0000';
		document.getElementById("name").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("name").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Email* ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Invalid Email ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Client Id",document.getElementById("clientid").value)) {
		document.getElementById("clientid").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Client Id* ");
		document.getElementById('clientid').style.borderColor  = '#FF0000';
		document.getElementById("clientid").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("clientid").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Note",document.getElementById("detail").value)) {
		document.getElementById("detail").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Note* ");
		document.getElementById('detail').style.borderColor  = '#FF0000';
		document.getElementById("detail").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("detail").addEventListener("keyup", controlBorderColor, false);
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
