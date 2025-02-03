<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['enq_msg']);
?>
<style>
#error1{
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
</style>
<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border">
     Enquiry <span class="themecolor">Form</span> </h2>
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
        <input type="hidden" name="mode" value="enquiry_form">
        <input type="hidden" name="service" value="<?=$_SESSION['enquiry']['service']?>">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control font-15 input-css" placeholder="Name" value="<?=$_SESSION['enquiry']['name']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="email" id="email" class="form-control font-15 input-css" placeholder="Email Address" value="<?=$_SESSION['enquiry']['email']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="mobile_no" id="mobile_no" class="form-control font-15 input-css" placeholder="Mobile No." value="<?=$_SESSION['enquiry']['mobile_no']?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="city" id="city" class="form-control font-15 input-css" placeholder="City" value="<?=$_SESSION['enquiry']['city']?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control font-15 input-css" name="enq_detail" id="enq_detail" rows="5" placeholder="Enquiry"><?=$_SESSION['enquiry']['enq_detail']?></textarea>
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
              <input type="submit" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT" style="margin-top:15px;">
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<?php unset($_SESSION['enq_msg'])?>
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
		document.getElementById("error1").innerHTML=(" Invalid Email ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
		document.getElementById("mobile_no").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Mobile No.* ");
		document.getElementById('mobile_no').style.borderColor  = '#FF0000';
		document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(document.getElementById("mobile_no").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("mobile_no").value;  
		  if(document.getElementById("mobile_no").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;  
				
		  }	
		  
		  if(i==2){
				document.getElementById('mobile_no').style.borderColor  = '#FF0000';
				document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
				document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
				document.getElementById("error1").innerHTML=('Please enter only 10 digits mobile number.');
				document.getElementById("mobile_no").value='';
				document.getElementById("mobile_no").focus();
				return false;    
		  }
	}
	if(isEmpty("City",document.getElementById("city").value)) {
		document.getElementById("city").focus();
		document.getElementById("error1").innerHTML=(" Please Enter City* ");
		document.getElementById('city').style.borderColor  = '#FF0000';
		document.getElementById("city").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("city").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Enquiry",document.getElementById("enq_detail").value)) {
		document.getElementById("enq_detail").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Enquiry* ");
		document.getElementById('enq_detail').style.borderColor  = '#FF0000';
		document.getElementById("enq_detail").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("enq_detail").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	/*if(isEmpty("Captcha",document.getElementById("captcha").value)) {
		document.getElementById("captcha").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Captcha* ");
		document.getElementById("captcha").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("captcha").addEventListener("keyup", controlBorderColor, false);
		return false;
	}*/
	return true;
}

function submit_host(){
	if(chkform() == true){
		document.getElementById("accForm").submit();
	}
}
</script>
<?php include(INCLUDE_DIR.'footer.php');?>
