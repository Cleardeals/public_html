<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$msg = base64_decode($_SESSION['career_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."career where id='".$id."'";
$dbCareer = $dbObj->SelectQuery();
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
<div class="center-section-in">
<div class="container">
  <h2 class="font-30 text-uppercase text-center font-extrabold header-border"> 
  CAREERS </h2>
  <div class="careers">
    <?php if(!empty($msg)) { ?>
    <center>
      <p style="color:#F00">
        <?=$msg?>
      </p>
    </center>
    <?php } ?>
    <p id="error1"></p>
    <form action="<?=HTACCESS_URL?>contactController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="mode" value="career_form">
      <?php if(!empty($_SESSION['career']['applied_for'])){?>
      <input type="hidden" name="applied_for" value="<?=$_SESSION['career']['applied_for']?>">
      <?php }else{?>
      <input type="hidden" name="applied_for" value="<?=$dbCareer[0]['title']?>">
      <?php }?>
      <input type="hidden" name="career_id" value="<?=$dbCareer[0]['id']?>">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="form-group">
            <input type="text" name="name" id="name" class="form-control font-14 input-css" placeholder="Name" value="<?=$_SESSION['career']['name'] ?? ""?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="email" id="email" class="form-control font-14 input-css" placeholder="Email Address" value="<?=$_SESSION['career']['email'] ?? ""?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="mobile_no" id="mobile_no" class="form-control font-14 input-css " placeholder="Mobile No." value="<?=$_SESSION['career']['mobile_no'] ?? ""?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <textarea class="form-control font-14 input-css" name="job_desc" id="job_desc" rows="5" placeholder="Job Description"><?=$_SESSION['career']['job_desc'] ?? ""?></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"> <i class="fa fa-paperclip"></i></span> </div>
                <input type="file" name="resume" id="resume" class="file boarder-0">
                <input type="text" class="form-control boarder-0" disabled placeholder="Submit your resume" aria-label="Submit your resume" aria-describedby="basic-addon1">
                <div class="input-group-append">
                  <button class="browse input-group-text btn btn-primary bg-theme text-white" id="basic-addon2"> <i class="fa fa-search"></i>&nbsp;Browse</button>
                </div>
              </div>
              <p style="font-size:12px;color:#F00;">Doc / Pdf (File Will Accept)
              </p>
            </div>
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
            <input type="submit" class="btn btn-primary subscribe-now submit-re font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT" style="margin-top:15px;">
          </div>
        </div>
      </div>
    </form>
    <a data-fancybox="thank-you-popup" data-src="#thank-you-popup" href="javascript:;"></a>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php unset($_SESSION['career_msg']);?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<script>
$(document).on("click", ".browse", function() {
  var file = $(this)
    .parent()
    .parent()
    .parent()
    .find(".file");
  file.trigger("click");
});
$(document).on("change", ".file", function() {
  $(this)
    .parent()
    .find(".form-control")
    .val(
      $(this)
        .val()
        .replace(/C:\\fakepath\\/i, "")
    );
});
</script> 
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
	if(isEmpty("Job Description",document.getElementById("job_desc").value)) {
		document.getElementById("job_desc").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Job Description* ");
		document.getElementById('job_desc').style.borderColor  = '#FF0000';
		document.getElementById("job_desc").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("job_desc").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Resume",document.getElementById("resume").value)) {
		document.getElementById("resume").focus();
		document.getElementById("error1").innerHTML=(" Please upload Resume* ");
		document.getElementById('resume').style.borderColor  = '#FF0000';
		document.getElementById("resume").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("resume").addEventListener("keyup", controlBorderColor, false);
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

<input type='hidden' id="is_home" value="1">
      <!--contact-us-popup-->
      <div id="thank-you-popup" style="display:none;width:100%;max-width:660px;">
        <div class="right-section form-sec">
            <div>
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <h1 class="text-dark text-center text-uppercase font-weight-bolder">Thank You</h1>
              <p class="text-center mb-0">Thank You For Applying.</p>
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