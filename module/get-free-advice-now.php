<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}
?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['freeadvice_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();
?>
<style>
#error1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
.contact-thank-you {
	padding: 30px;
	border: solid 10px #1e70ab;
}
</style>

<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border"> Get Free <span class="themecolor"> Advice Now </span> </h2>
    <div class="careers">
      <?php if(!empty($msg)) { ?>
      <center>
        <p style="color:#F00">
          <?=$msg?>
        </p>
      </center>
      <?php } ?>
      <p id="error1"></p>
      <form action="<?=HTACCESS_URL?>contactController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
        <input type="hidden" name="mode" value="free_advice">
        <input type="hidden" name="service" value="<?=$_SESSION['advice']['service']?>">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control font-15 input-css" placeholder="Name" value="<?=$dbUser[0]['name']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="email" id="email" class="form-control font-15 input-css" placeholder="Email" value="<?=$dbUser[0]['email']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="city" id="city" class="form-control font-15 input-css" placeholder="City" value="<?=$dbUser[0]['city']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="mobile_no" id="mobile_no" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-15 input-css" onBlur="getOtp(this.value)" placeholder="Mobile No" value="<?=$_SESSION['advice']['mobile_no'] ?? ""?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control font-15 input-css" name="message" id="message" rows="5" placeholder="Message"><?=$_SESSION['advice']['message'] ?? ""?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="otp" id="otp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-15 input-css" placeholder="Otp" value="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group"> 
              
              <!--for cleardeals-->
              
              <div class="g-recaptcha" data-sitekey="6LdQg54UAAAAAEE_4Q6mf146BcexC3MJd8RBLLxm"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="btn btn-primary subscribe-now submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT" style="margin-top:15px;">
            </div>
          </div>
        </div>
      </form>
      <a data-fancybox="thank-you-popup" data-src="#thank-you-popup" href="javascript:;"></a> </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<?php unset($_SESSION['freeadvice_msg']);?>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
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
		document.getElementById("error1").innerHTML=(" Invalid Email* ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
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
	
	if(isEmpty("Mobile No",document.getElementById("mobile_no").value)) {
		document.getElementById("mobile_no").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Mobile No* ");
		document.getElementById('mobile_no').style.borderColor  = '#FF0000';
		document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
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


function getOtp(MobileNo){
	//alert(itemCode);
	//itemCodes = utf8_encode(itemCode);
	 $.ajax({
			url:'<?=HTACCESS_URL?>contactController.php?mode=get_service_otp',
			data:'MobileNo='+MobileNo,
			success:function(response){
			//alert(response);
			//document.getElementById("itemDesc").value = response;
			if(response==1){
			alert("Otp send to your mobile no.");
			}
		}
		});
}
</script>
<input type='hidden' id="is_home" value="1">

<!--contact-us-popup-->

<div id="thank-you-popup" style="display:none;width:100%;max-width:660px;" class="contact-thank-you">
  <div class="right-section form-sec">
    <div> 
      
      <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
      
      <h1 class="text-dark text-center text-uppercase font-weight-bolder">Thank You</h1>
      <p class="text-center mb-0">Thank You For Enquiry.</p>
      <p class="text-center font">We will get back to you soon.</p>
      <hr>
      
      <!--<h4 class="text-center">You can instant contact using details</h4>--> 
      
      <!--<div class="contact-text">

                <div class="text-center"><i class="fa fa-mobile-alt" aria-hidden="true"> </i>&nbsp; +1 23 567 8596 

                  

                  &nbsp;&nbsp; <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@example.com">info@example.com</a> </div>

              </div>--> 
      
    </div>
  </div>
</div>
<?php include(INCLUDE_DIR.'footer.php');?>
