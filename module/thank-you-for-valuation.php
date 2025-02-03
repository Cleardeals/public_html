<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$from = $dbObj->sc_mysql_escape($_REQUEST['from'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."valuation where id='".$_SESSION['last_id']."'";
$dbUser = $dbObj->SelectQuery();
?>
<script>
fbq('track', 'Lead', {
value: 1,
currency: '200',
});
</script>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<style>
.contact-thank-you {
	padding: 30px;
	border: solid 10px #1e70ab;
}
</style>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu" id="mainNav">
<div class="container-fluid">
  <div class="row">
    <div class="container"> 
    <a href="<?=HTACCESS_URL?>">
      <center>
        <img src="<?=HTACCESS_URL?>assets/img/logo.png" style="margin-top:60px;width: 280px;">
      </center>
      </a> 
      </div>
  </div>
</div>
</nav>

<!-- Header -->
<div class="center-section-in" style="padding:0">
  <header>
    <div class="container text-center mt-10">
      <h2 class="mb-1 blue-text text-2 mb-2">Estimated Price Range of your Property in
        <?=$dbUser[0]['location']?>
      </h2>
      <div class="clearfix"></div>
      <div class="price wow fadeIn" style="font-size: 40px;    text-transform: none;">Rs. 
        <?=$dbUser[0]['est_min_value']?>
        to Rs.
        <?=$dbUser[0]['est_max_value']?>
      </div>
    </div>
  </header>
  <div class="clearfix"></div>
  <div class="container bg-white">
    <div class="inner-page">
      <div class="heading wow fadeIn">
        <div class="inner-boder">What Should I do <span>Next</span>?</div>
      </div>
      <div class="inner-text wow fadeIn" style="text-align: left;line-height: 37px;">
        <ul>
          <li> <span>* </span> An online valuation is a great place to start, but every property is <span>"UNIQUE"</span>.</li>
          <li> <span>* </span> We don't want you to sell your property at a 'wrong' price.</li>
          <li> <span>* </span> To get an accurate valuation of what your property is really worth, your  Cleardeals Local Property Expert will be happy to provide you with a FREE,  no-strings attached valuation. </li>
        </ul> 
      </div>
      <div class="choose-a-time mb-4 wow fadeIn"> <a data-toggle="modal" data-target="#choose-a-time" href="javascript:;"> Choose a time 
      <img src="<?=HTACCESS_URL?>assets/img/calander.png"> </a></div>
      <div class="heading wow fadeIn">
        <div class="inner-boder">Looking to sell your <span>Property</span>?</div>
      </div>
      <div class="choose-a-time mt-6 wow fadeIn"><a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> Sell your property at No Brokerage - book now</a></div>
      <h5 class="text-css2 wow fadeIn"><a href="http://www.cleardeals.co.in" target="_blank">Cleardeals.co.in</a> gives you the real estate services you need to sell your property and <span>save your brokerages !</span></h5>
    </div>
  </div>
</div>
<div class="modal fade" id="choose-a-time">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <!-- Modal body -->
      <div class="modal-body"> <a class="close-modal" data-dismiss="modal">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
          <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z" fill="#ffffff"></path>
        </svg>
        </a>
        <div style="width:100%;">
          <form method="post" action="<?=HTACCESS_URL?>valuationController.php" id="ChooseTime">
            <input type="hidden" name="mode" value="add_time">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="from" value="<?=$from?>">
            <input type="hidden" name="info[pid]" value="<?=$_SESSION['last_id']?>">
            <div class="datetimepicker3">
              <h6>Just let us know a time that suits you!</h6>
              <input type="text" name="p_date_time" id="datetimepicker3"/>
              <button type="submit" class="btn">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<a data-fancybox="thank-you-popup" data-src="#thank-you-popup" href="javascript:;"></a>
<input type='hidden' id="is_home" value="1">
<!--contact-us-popup-->
<div id="thank-you-popup" style="display:none;width:100%;max-width:660px;" class="contact-thank-you">
  <div class="right-section form-sec">
    <div>
      <div class="container text-center mt-10">
        <h2 class="mb-1 blue-text" style="font-size:34px;">Thanks for your interest </h2>
        <div class="clearfix"></div>
        <br />
        <h4 class="wow fadeIn"> Cleardeals.co.in Local Property Expert<br>
          will soon get in touch with you. </h4>
        <div class="choose-a-time mt-6">
        <a target="_blank" href="<?=HTACCESS_URL?>pricing-details-for-sell-property/"> Sell your property at No Brokerage - book now </a></div>
      </div>
    </div>
  </div>
</div>
<script>
function ajaxgetpChooseTime() {
    // Fetch form to apply custom Bootstrap validation
    var form = $("#ChooseTime")
	var form_data=$('#ChooseTime').serialize();
			$.ajax({
			url:"<?=HTACCESS_URL?>valuationController.php?mode=add_time",
			data:form_data,
			cache:false,
			async:false,
			//data: {message: "message"},
			success: function(data) {
				//alert(data);
				if(data){
					//alert(data);
				//$('#myModal3').click();
				//$('#requestForm')[0].reset(); 
				$('#choose-a-time').click();
				$('#thank-you-popup').click();
				}
			}
			});
}
</script> 
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
} );


function forceReload() {
    window.location.reload(true);
}
</script>
<link rel="stylesheet" type="text/css" href="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.css"/>
<script src="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.full.js"></script> 
<script> 
/*$('#datetimepicker3').datetimepicker({
	inline:true,
	minDate: "+1",
	 allowTimes:[
  '10:00', '11:00', '12:00',
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ]
});*/
jQuery('#datetimepicker3').datetimepicker({
   onGenerate:function( ct ){
    jQuery(this).find('.xdsoft_date')
      .toggleClass('xdsoft_disabled');
  },
  inline:true,
  maxDate:'+2',
  allowTimes:[
  '10:00', '11:00', '12:00',
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ],
});
</script> 
<script src="<?=HTACCESS_URL?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 