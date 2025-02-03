<?php
/*$dbObj->dbQuery="SELECT MONTHNAME(published_on) FROM ".PREFIX."blog";
$dbBlogArchiv = $dbObj->SelectQuery();
print_r($dbBlogArchiv);
echo $dbBlogArchiv[1];*/
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

<div class="col-lg-4 col-md-7 wow fadeInRight"> <a class="btn themebg text-white theme-btn mr-3 d-block mb-3 font-18 pt-2 pb-2">guest post <img src="<?=HTACCESS_URL?>assets/img/use.png" class="vm ml-3"></a> 
  
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
    <div class="col-md-6 col-6 pr-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> <img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum1.jpg" class="img-fluid">
      <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt"> SELL MY PROPERTY</h4>
      </a> </div>
    <div class="col-md-6 col-6 pl-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank"> <img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum2.jpg" class="img-fluid">
      <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt"> RENT MY PROPERTY</h4>
      </a> </div>
    <div class="col-md-6 col-6 pr-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> <img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum3.jpg" class="img-fluid">
      <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt"> Search properties</h4>
      </a> </div>
    <div class="col-md-6 col-6 pl-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>book-free-valuation/" target="_blank"> <img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum4.jpg" class="img-fluid">
      <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt"> BOOK FREE VALUATION</h4>
      </a> </div>
  </div>
  <div class="newsletter-bg">
    <h3 class="text-white font-19 text-uppercase mb-2">Subscribe Newsletter</h3>
    <p id="error2"></p>
    <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubs();" autocomplete="off">
      <div class="form-group">
        <input type="text" name="subs_email" id="subs_email" class="form-control font-13" placeholder="Email Id">
      </div>
      <button type="button" onClick="return ajaxmailsubs();" class="subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">SUBSCRIBE NOW</button>
    </form>
  </div>
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