<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['offer_msg']);
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
$dbProperty = $dbObj->SelectQuery();
?>
<?php if(!empty($_SESSION['offer_msg'])){?>
<meta http-equiv="refresh" content="3;url=<?=HTACCESS_URL?>property-detail/<?=$dbProperty[0]['url']?>/" />
<? }?>
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
  Make <span class="themecolor">an offer</span> </h2>
  <div class="careers">
    <?php if(!empty($msg)) { ?>
    <center>
      <p style="color:#F00">
        <?=$msg?>
      </p>
    </center>
    <?php } ?>
    <p id="error1"></p>
    <form action="<?=HTACCESS_URL?>propertyController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
      <input type="hidden" name="mode" value="make_an_offer">
      <input type="hidden" name="property_id" value="<?=$property_id?>">
      <input type="hidden" name="clientid" value="<?=$dbUser[0]['clientid']?>">
      <input type="hidden" name="user_id" value="<?=$dbUser[0]['id']?>">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="form-group">
            <input type="text" name="name" id="name" class="form-control font-16 input-css" placeholder="Name" value="<?=$dbUser[0]['name']?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="email" id="email" class="form-control font-16 input-css" placeholder="Email" value="<?=$dbUser[0]['email']?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="mobile_no" id="mobile_no" class="form-control font-16 input-css" placeholder="Mobile" value="<?=$dbUser[0]['mobile_no']?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <textarea class="form-control font-16 input-css" name="offer" id="offer" rows="5" placeholder="Your Offer"></textarea>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <input type="submit" class="btn btn-primary subscribe-now  submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT">
          </div>
        </div>
      </div>
    </form>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php unset($_SESSION['offer_msg']);?>
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
	if(isEmpty("Offer",document.getElementById("offer").value)) {
		document.getElementById("offer").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Offer* ");
		document.getElementById('offer').style.borderColor  = '#FF0000';
		document.getElementById("offer").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("offer").addEventListener("keyup", controlBorderColor, false);
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
