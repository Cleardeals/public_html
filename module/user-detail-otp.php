<?php //include(INCLUDE_DIR.'header.php') 
$msg = base64_decode($_SESSION['val_captcha_msg']);
?>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<style>
#logo{
    margin-top:60px;
    width:280px;
}
@media (max-width:768px){
 #logo{
    width:215px;
    }   
}
</style>
<!-- Header -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu" id="mainNav">

<div class="container-fluid">
  <div class="row">
    <div class="container"> <a href="<?=HTACCESS_URL?>">
      <center>
        <img src="<?=HTACCESS_URL?>assets/img/logo.png" id="logo">
      </center>
      </a> </div>
  </div>
</div>
</nav>

<!-- Header -->
<div class="center-section-in" style="padding:0">
  <header class="masthead2">
    <div class="container text-center mt-10">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%"> 90% Completed </div>
          </div>
        </div>
      </div>
      <h3 class="title-h3 small-title percent"><span class="themecolor"> Almost done!</span><br>
        <span class="blue-text">Please enter otp to get your Valuation. </span></h3>
      <div class="clearfix"></div>
      <p style="color:#FF0000;" id="msg1">
        <?=base64_decode($_SESSION['msg1'])?>
        <? unset($_SESSION['msg1'])?>
        <?=$msg?>
      </p>
      
      <form action="<?=HTACCESS_URL?>valuationController.php" method="post" onSubmit="return chkform();" autocomplete="off">
        <input type="hidden" name="mode" value="step_3">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="from" value="<?=$from?>">
        <input type="hidden" name="info[city]" value="<?=$_SESSION['prop']['city']?>">
        <input type="hidden" name="info[location]" value="<?=$_SESSION['prop']['location']?>">
        <input type="hidden" name="info[property_type]" value="<?=$_SESSION['prop']['property_type']?>">
        <input type="hidden" name="info[area]" value="<?=$_SESSION['prop']['area']?>">
        <input type="hidden" name="info[sqf]" value="<?=$_SESSION['prop']['sqf']?>">
        <input type="hidden" name="info[name]" value="<?=$_SESSION['prop']['name']?>">
        <input type="hidden" name="info[email]" value="<?=$_SESSION['prop']['email']?>">
        <input type="hidden" name="info[mobile_no]" value="<?=$_SESSION['prop']['mobile_no']?>">
        <input type="hidden" name="info[purpose_of_valuation]" value="<?=$_SESSION['prop']['purpose_of_valuation']?>">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="row search-div3">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <input class="form-control mb-1" name="val_otp" id="val_otp" placeholder="Type Otp" type="text" value="">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div>
          </div>
        </div>
        <button type="button" onclick="history.go(-1);" class="btn check-now"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</button>
        <button type="submit" class="btn check-now">Get Your Valuation Report <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
      </form>
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<?php unset($_SESSION['val_captcha_msg']);?>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#474845"; 
  //}
}


function chkform() {

	if(isEmpty("otp",document.getElementById("val_otp").value)) {
		document.getElementById("val_otp").focus();
		document.getElementById("msg1").innerHTML=('Please enter otp.');
		document.getElementById('val_otp').style.borderColor  = '#FF0000';
		document.getElementById("val_otp").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("val_otp").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	
	return true;
}
</script>
<?php //include(INCLUDE_DIR.'footer.php'); ?>

<!-- Bootstrap core JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?=HTACCESS_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/jquery-easing/jquery.easing.min.js"></script> 

<!-- Custom scripts for this template --> 
<script src="<?=HTACCESS_URL?>assets/js/grayscale.min.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/home.js"></script> 

<!--owlcarousel--> 
<script src="<?=HTACCESS_URL?>assets/vendor/owlcarousel/owl.carousel.js"></script> 
<!--owlcarousel--> 

<!--fancybox--> 
<script src="<?=HTACCESS_URL?>assets/vendor/fancybox/jquery.fancybox.min.js"></script> 
<!--fancybox--> 

<!--animation--> 
<script src="<?=HTACCESS_URL?>assets/js/wow/wow.js"></script> 
<!--animation--> 

<!--scrolltopcontrol--> 
<script src="<?=HTACCESS_URL?>assets/js/scrolltopcontrol.js"></script> 

<!--scrolltopcontrol-->
<link rel="stylesheet" href="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.css">
<script src="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.js"></script> 
<script>
//var citydata = 'ddd';
function getcity(cityName){
window.location.href = "<?=HTACCESS_URL?>book-free-valuation/"+cityName+"/";
}

function myFunction(){
	var input = document.getElementById('tags')
	//var hiddenDiv = document.getElementById('showMe');
	//div.innerHTML = div.innerHTML + input.value;
	 //hiddenDiv.style.display = (this.value == "") ? "none":"block";
}

$( function() {
// Custom autocomplete instance.
$.widget( "app.autocomplete", $.ui.autocomplete, {

	// Which class get's applied to matched text in the menu items.
	options: {
		highlightClass: "ui-state-highlight"
	},

	_renderItem: function( ul, item ) {

		// Replace the matched text with a custom span. This

		// span uses the class found in the "highlightClass" option.
		var re = new RegExp( "(" + this.term + ")", "gi" ),
			cls = this.options.highlightClass,
			template = "<span class='" + cls + "'>$1</span>",
			label = item.label.replace( re, template ),
			$li = $( "<li/>" ).appendTo( ul );

		// Create and return the custom menu item content.
		$( "<a/>" ).attr( "href", "#" )
				   .html( label )
				   .appendTo( $li );
		return $li;
	}
});

var availableTags =  [ <?=$newdata?>];
$( "#tags" ).autocomplete({
  highlightClass: "bold-text",
  source: availableTags
});
});

function forceReload() {
    window.location.reload(true);
}
</script>
<link rel="stylesheet" type="text/css" href="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.css"/>
<!--<script src="<?=HTACCESS_URL?>assets/vendor/calander/jquery.js"></script> --> 

<script src="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.full.js"></script> 
<script>
$('#datetimepicker3').datetimepicker({
	inline:true,
	 allowTimes:[
  '10:00', '11:00', '12:00', 
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ]
});
</script> 
<script>
$('#datetimepicker4').datetimepicker({
	inline:true,
	 allowTimes:[
  '10:00', '11:00', '12:00', 
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ]
});
</script>
<script src="<?=HTACCESS_URL?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script type="text/javascript">
$(document).ready(function () {
$("#sidebar").mCustomScrollbar({
theme: "minimal"
});


$('#dismiss, .overlay').on('click', function () {
$('#sidebar').removeClass('active');
$('.overlay').removeClass('active');
});

$('#sidebarCollapse').on('click', function () {
$('#sidebar').toggleClass('active');
$('.overlay').addClass('active');
$('.collapse.in').toggleClass('in');
$('a[aria-expanded=true]').attr('aria-expanded', 'false');
});
});
</script>
<script type="text/javascript">
$(document).ready(function () {
$("#sidebar2").mCustomScrollbar({
theme: "minimal"
});


$('#dismiss2, .overlay').on('click', function () {
$('#sidebar2').removeClass('active');
$('.overlay').removeClass('active');
});


$('#sidebarCollapse2').on('click', function () {
$('#sidebar2').toggleClass('active');
$('.overlay').addClass('active');
$('.collapse.in').toggleClass('in');
$('a[aria-expanded=true]').attr('aria-expanded', 'false');
});
});
</script> 
<script>
$(document).ready(function() {
$("#dismiss2").click(function () {
    $("#sidebar2").removeClass("active");
    $("#sidebar2").addClass("active");
});
});
</script>