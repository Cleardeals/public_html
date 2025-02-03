<?php
/*$dbObj->dbQuery="SELECT MONTHNAME(published_on) FROM ".PREFIX."blog";
$dbBlogArchiv = $dbObj->SelectQuery();
print_r($dbBlogArchiv);
echo $dbBlogArchiv[1];*/

$category = $dbObj->sc_mysql_escape($_REQUEST['category'] ?? "");
$url = $dbObj->sc_mysql_escape($_REQUEST['blog'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."blog where url='".$url."'";
$dbBlogDetail = $dbObj->SelectQuery(); 

$blog_id = $dbBlogDetail[0]['id'] ?? "";

//$dbObj->dbQuery="select * from ".PREFIX."blog_links where blog_id='".$blog_id."'";
$dbObj->dbQuery="select * from ".PREFIX."blog_links ";
$dbBlogQuickLinks = $dbObj->SelectQuery();
?>
<style>
#error2 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: left;
	color: #FF0000;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="col-lg-4 col-md-7 wow fadeInRight">
<a class="btn themebg text-white theme-btn mr-3 d-block mb-3 font-18 pt-2 pb-2">guest post <img src="<?=HTACCESS_URL?>assets/img/use.png" class="vm ml-3"></a> 

<!--<div class="archives">

    <h2 class="font-20 montserrat font-weight-bold">Archives</h2>

    <ul>

      <li><a href="#">October 2019</a></li>

      <li><a href="#">September 2019</a></li>

      <li><a href="#">August 2019</a></li>

      <li><a href="#">July 2019</a></li>

      <li><a href="#">June 2019</a></li>

      <li><a href="#">May 2019</a></li>

    </ul>

  </div>-->

<div class="row mt-3">
  <div class="col-md-12 col-6 pr-2 mb-3 text-center">
    <div class="card mb-4"> 
      <!-- Shipping information -->
      <div class="card-body">
        <?php for($i=0;$i<count((array)$dbBlogQuickLinks);$i++){?>
        <a href="<?=$dbBlogQuickLinks[$i]['link']?>">
        <p class="h6" style="color: #074eaa; text-decoration: underline;">
          <?=$dbBlogQuickLinks[$i]['name']?>
        </p>
        </a>
        <hr>
        <?php }?>
      </div>
    </div>
  </div>
  <div class="newsletter-bg col-md-12 col-6  mb-3 text-center">
    <h3 class="text-white font-19 text-uppercase mb-2">Contact Us</h3>
    <form action="../commentController.php" method="post" id="subsForm"  autocomplete="off">
      <input type="hidden" name="mode"  value="blog_contact_us">
      <div class="form-group">
        <input type="text" name="name" id="name" class="form-control font-13" placeholder="Name" required="required">
      </div>
      <div class="form-group">
        <select class="form-control" aria-label="Default select example" name="city" required="required">
          <option disabled="disabled" selected>Choose a City</option>
          <option value="ahmedabad">Ahmedabad</option>
          <option value="vadodara">Vadodara</option>
          <option value="surat">Surat</option>
          <option value="gandhinagar">Gandhinagar</option>
        </select>
      </div>
      <div class="form-group">
        <select class="form-control" aria-label="Default select example" name="service" required="required">
          <option disabled="disabled" selected>Choose Service </option>
          <option value="sell">Sell Property</option>
          <option value="buy">Buy Property</option>
          <option value="homeloan">Apply For Home Loan</option>
          <option value="valuation">Check Valuation</option>
        </select>
      </div>
      <div class="form-group">
        <input type="text" name="mobile" id="mobile" class="form-control font-13" placeholder="Mobile Number" required="required">
      </div>
      <div class="form-group">
        <input type="text" name="email" id="email" class="form-control font-13" placeholder="Email" required="required">
      </div>
      <input type="submit" vaue="SUBMIT"  class="subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">
    </form>
  </div>
  
  <!--  <div class="newsletter-bg">

    <h3 class="text-white font-19 text-uppercase mb-2">Subscribe Newsletter</h3>

    <p id="error2"></p>

    <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubs();" autocomplete="off">

      <div class="form-group">

        <input type="text" name="subs_email" id="subs_email" class="form-control font-13" placeholder="Email Id">

      </div>

      <button type="button" onClick="return ajaxmailsubs();" class="subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">SUBSCRIBE NOW</button>

    </form>

  </div>--> 
</div>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#474845"; 
  //}
}

function chkformsub() {

	if(isEmpty("Email",document.getElementById("subs_email").value)) {
		document.getElementById("subs_email").focus();
		document.getElementById("error2").innerHTML=(" Please Enter Email* ");
		document.getElementById('subs_email').style.borderColor  = '#FF0000';
		document.getElementById("subs_email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("subs_email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}

	if(!validateEmail("Email",document.getElementById("subs_email").value)) {
		document.getElementById("subs_email").focus();
		document.getElementById("error2").innerHTML=(" Invalid Email ");
		document.getElementById('subs_email').style.borderColor  = '#FF0000';
		document.getElementById("subs_email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("subs_email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}

	return true;
}

function ajaxmailsubs(){

if(chkformsub() == true){

	//alert(email);

	var form_data=$('#subsForm').serialize();

		$.ajax({
		url:"<?=HTACCESS_URL?>contactController.php?mode=subscribe",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data){
			$('#model2').click();
			$('#subsForm')[0].reset();
			}
		}
		});
}
}
</script>