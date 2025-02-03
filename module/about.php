<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['subscribe_msg'] ?? "");
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='2'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."about where pageid='2'";
$dbAbout = $dbObj->SelectQuery();
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
<header class="inner-header" style="background: url(<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbSitecontent[0]['image']?>) no-repeat center top #000000;">
<div class="container">
  <h2 class="wow fadeInDown">
    <?=$dbSitecontent[0]['title']?>
  </h2>
  <p class="wow fadeIn">
    <?=$dbSitecontent[0]['short_desc']?>
  </p>
</div>
<div class="clearfix"></div>
</header>
<div class="how-can">
  <div class="container">
    <h2 class="font-31 text-center themecolor text-uppercase font-bold montserrat wow fadeInLeft"><span>
      <?=$dbSitecontent[0]['heading']?>
      </span></h2>
  </div>
</div>
<div class="trusted-by ">
  <div class="container">
    <h2 class="font-34 text-center font-extrabold wow fadeInRight">
      <?=$dbAbout[0]['ab_heading']?>
    </h2>
  </div>
</div>
<div class="four-img">
  <div class="container">
    <div class="row four-img-div justify-content-center">
      <div class="col-lg-3 col-md-6 col-sm-6 text-center wow fadeInLeft">
        <div class="position-relative">
          <div class="img-css"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbAbout[0]['image1']?>" class="img-fluid">
            <div class="image-layer"></div>
          </div>
          <div class="icon-div"> <i class="flaticon-heart text-white font-35"></i></div>
          <a href="<?=$dbAbout[0]['ab_url1']?>" class="btn btn-css2 font-13 font-bold montserrat text-uppercase">
          <?=$dbAbout[0]['ab_title1']?>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center wow fadeInLeft">
        <div class="position-relative">
          <div class="img-css"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbAbout[0]['image2']?>" class="img-fluid">
            <div class="image-layer"></div>
          </div>
          <div class="icon-div"> <i class="flaticon-key text-white font-35"></i></div>
          <a href="<?=$dbAbout[0]['ab_url2']?>" class="btn btn-css2 font-13 font-bold montserrat text-uppercase">
          <?=$dbAbout[0]['ab_title2']?>
          </a> </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center wow fadeInRight">
        <div class="position-relative">
          <div class="img-css"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbAbout[0]['image3']?>" class="img-fluid">
            <div class="image-layer"></div>
          </div>
          <div class="icon-div"><i class="flaticon-placeholder text-white font-35" style="margin-right:-10px"></i> </div>
          <a href="<?=$dbAbout[0]['ab_url3']?>" class="btn btn-css2 font-13 font-bold montserrat text-uppercase">
          <?=$dbAbout[0]['ab_title3']?>
          </a></div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center wow fadeInRight">
        <div class="position-relative">
          <div class="img-css"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbAbout[0]['image4']?>" class="img-fluid">
            <div class="image-layer"></div>
          </div>
          <div class="icon-div"><i class="flaticon-house-key text-white font-35"></i></div>
          <a href="<?=$dbAbout[0]['ab_url4']?>" target="_blank" class="btn btn-css2 font-13 font-bold montserrat text-uppercase">
          <?=$dbAbout[0]['ab_title4']?>
          </a> </div>
      </div>
      <div class="col-md-12 text-center bt-div"> <a href="<?=HTACCESS_URL?>request-call-back/" class="font-16 montserrat text-white text-uppercase blue-bt btn font-bold mb-2 wow fadeIn">Request Call back <i class="flaticon-paper-plane font-24 ml-2"> </i></a> <a href="<?=HTACCESS_URL?>faq/" class="mb-2 font-16 montserrat text-white text-uppercase blue-bt btn font-bold wow fadeIn">FAQ's <i class="flaticon-question font-24 ml-2"> </i></a> </div>
    </div>
  </div>
</div>
<div class="subscribe" id="subscribe-now">
  <div class="subscribe-img bg-white shadow wow fadeInDown">
    <div class="subscribe-div">
      <div class="text-title">
        <h3 class="font-18 text-uppercase">GET SECRET TIPS TO HELP YOU </h3>
        <h4>SELL YOUR PROPERTY</h4>
        <p>The secret tips will increase your chances of selling <br>
          your property quickly</p>
      </div>
      <img src="<?=HTACCESS_URL?>assets/img/top-img.png" class="position-absolute img-fluid"> <img src="<?=HTACCESS_URL?>assets/img/img-5.png" class="sub-in img-fluid"> <img src="<?=HTACCESS_URL?>assets/img/bottom.png" class="position-absolute bottom-img img-fluid"> </div>
    <div class="sub-text">
      <p class="mb-0"> <span class="font-16 font-bold">This secret tips have helped 100's of property sellers to sell their property quickly and without Brokerage.</span> </p>
      <p>We love giving away valuable content.<br>
        Learning about the secret tips is a great way to start.</p>
    </div>
    <div class="col-md-12">
      <?php if(!empty($msg)) { ?>
      <center>
        <p style="color:#F00">
          <?=$msg?>
        </p>
      </center>
      <?php } ?>
      <p id="error1"></p>
    </div>
    <form action="/" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
      <input type="hidden" name="mode" value="about_subs">
      <div class="col-md-12">
        <div class="form-group">
          <input type="text" name="info[email]" id="email" class="form-control font-16 input-css" placeholder="Email Address">
        </div>
      </div>
      <div class="">
        <input type="submit" value="SUBSCRIBE NOW" class="btn font-24 montserrat text-white text-uppercase font-weight-bold text-center themebg2 d-block border-0 rounded-0 pt-4 pb-4 w-100" />
      </div>
    </form>
  </div>
  <?php unset($_SESSION['subscribe_msg']);?>
  <?php include('partner-detail.php');?>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}

function chkform() {
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
	submit_host();
	return false;
}

/*function submit_host(){
	if(chkform() == true){
		document.getElementById("accForm").submit();
	}
}*/

function submit_host(){
	//if(ckhform() == true){
		//document.getElementById("accForm").submit();
		//var form = $("#accForm")
		var form_data=$('#accForm').serialize();
		
		
		$.ajax({
			url:"<?=HTACCESS_URL?>contactController.php?mode=about_subs",
			data:form_data,
			cache:false,
			async:false,
			success: function(data) {
				//alert(data);
				if(data){
					//$('#accForm').reset();
					$('#openthankyou').click();
					//return true;
				
			}
			}
			
			});
		}
</script>
<?php include(INCLUDE_DIR.'footer.php'); ?>