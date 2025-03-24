<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';
$pageurl = $dbObj->sc_mysql_escape($_REQUEST['url'] ?? "");
//echo "Page URL is ".$pageurl;
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."contact_detail where id='1'";
$dbContact = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."social_links";
$dbSocial = $dbObj->SelectQuery();
?>
<!-- Footer -->
<style>
.bring {
	max-height: inherit!important;
	visibility: visible!important
}
</style>
<div class="footer" style="background-color:#e9ecf0;color:#1c304e;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 text1">
        <div class="logo"><img src="<?=HTACCESS_URL?>assets/img/logo.webp" width="250" height="60" alt="cleardeals logo"></div>
        <?=html_entity_decode(stripslashes($dbContact[0]['content']))?>
        <div class="social-media">
          <?php if($dbSocial[0]['status']=='1') {?>
          <a href="<?=$dbSocial[0]['link']?>" target="<?=$dbSocial[0]['target']?>"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[1]['status']=='1') {?>
          <a href="<?=$dbSocial[1]['link']?>" target="<?=$dbSocial[1]['target']?>"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[2]['status']=='1') {?>
          <a href="<?=$dbSocial[2]['link']?>" target="<?=$dbSocial[2]['target']?>"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[3]['status']=='1') {?>
          <a href="<?=$dbSocial[3]['link']?>" target="<?=$dbSocial[3]['target']?>"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
          <?php }?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row m-0">
          <div class="col-lg-4 col-md-3 col-sm-4 p-0">
            <p><b>Quick Links</b></p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>about/" target="_blank">
                <?=$dbSiteContent[1]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>services/" target="_blank">
                <?=$dbSiteContent[4]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing/" target="_blank">
                <?=$dbSiteContent[11]['menu_name']?>
                </a></li>
              <li> <a href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Search property</a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank">
                <?=$dbSiteContent[2]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank">
                <?=$dbSiteContent[3]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>emi-calculator/" target="_blank"> Home Loan EMI Calculator </a></li>
              <li><a href="<?=HTACCESS_URL?>eligibility-calculator/" target="_blank"> Home Loan Eligibility Calculator </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 p-0">
            <p><b>Useful links</b></p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>contact/" target="_blank">
                <?=$dbSiteContent[8]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>terms-nd-conditions/" target="_blank">
                <?=$dbSiteContent[12]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>privacy-policy/" target="_blank">
                <?=$dbSiteContent[13]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>service-agreement/" target="_blank">
                <?=$dbSiteContent[14]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>website-disclaimer/" target="_blank">
                <?=$dbSiteContent[15]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>faq/" target="_blank">
                <?=$dbSiteContent[6]['menu_name']?>
                </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-4 p-0">
            <p><b>Contact Details</b></p>
            <ul class="contact-details">
              <?php if(!empty($dbContact[0]['address'])){?>
              <li class="montserrat font-18"> <i class="flaticon-maps-and-flags"></i>
                <p>
                  <?=substr($dbContact[0]['address'],0,28)?>
                  <span>
                  <?=substr($dbContact[0]['address'],28)?>
                  </span></p>
              </li>
              <?php }?>
              <?php if(!empty($dbContact[0]['contact_no'])){?>
              <li><i class="flaticon-phone-call-button"></i> <span class="font-bold">Phone</span> - <a href="tel:+91-<?=$dbContact[0]['contact_no']?>">
                <?=$dbContact[0]['contact_no']?>
                </a></li>
              <?php }?>
              <?php if(!empty($dbContact[0]['email'])){?>
              <li><i class="flaticon-new-email-button"></i> <span class="font-bold">Email</span> - <a href="mailto:<?=$dbContact[0]['email']?>">
                <?=$dbContact[0]['email']?>
                </a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="copyright">
  <div class="container"> <!--Created by <a href="<?php //=$dbContact[0]['link']?>" target="_blank">
   <?php //=$dbContact[0]['created_by']?></a>-->
    <!-- <?=$dbContact[0]['copyright']?> -->
    <?= preg_replace('/\d{4}/', date("Y"), $dbContact[0]['copyright']) ?>
  </div>
</div>
<div class="overlay"></div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you" id="openthankyou"/>
<div id="thank-you" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Thank You For Enquiry.</p>
              <p class="text-center font">We will get back to you soon.</p>
              <hr>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you1" id="openthankyou1"/>
<div id="thank-you1" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Thank you for your registration.</p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you2" id="openthankyou2"/>
<div id="thank-you2" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css"> 
      <!--<button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>-->
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Signin here to continue.</p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- main --> 
<!-- Global site tag (gtag.js) - Google Analytics --> 

<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172366146-1"></script> 
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-172366146-1');
</script>--> 
<!-- Google Tag Manager --> 
<!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':--> 
<!--new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],--> 
<!--j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=--> 
<!--'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);--> 
<!--})(window,document,'script','dataLayer','GTM-5B7BRLZ');</script>--> 
<!-- End Google Tag Manager --> 
<!-- Global site tag (gtag.js) - Google Analytics --> 
<!--<script> --> 

<!--  window.dataLayer = window.dataLayer || []; --> 

<!--  function gtag(){dataLayer.push(arguments);} --> 

<!--  gtag('js', new Date()); --> 

<!--  gtag('config', 'UA-172366146-1'); --> 

<!--</script>--> 
<!-- Facebook Pixel Code --> 
<!-- <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '595120771241038');
fbq('track', 'PageView');

</script> -->
<noscript>
<!--<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=595120771241038&ev=PageView&noscript=1"/>-->
</noscript>
<!-- End Facebook Pixel Code --> 

<!-- Google Tag Manager --> 
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5B7BRLZ');</script> --> 
<!-- End Google Tag Manager --> 
<!-- Bootstrap core JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?=HTACCESS_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
<!--<script src="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.js"></script> --> 
<script>
//var citydata = 'ddd';	
function getcity(cityName){ 
window.location.href = "<?=HTACCESS_URL?>property-valuation-calculator/"+cityName+"/";
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
<?php   
/******************************
  Changed by Naeem
  Dated: 7th July 2022
 /****************************/

  $homeurl = '/index.php';                               
  $homepage = "/";
  $currentpage = $_SERVER['REQUEST_URI'];

  if($currentpage != $homepage or $currentpage != 'index.php') {

?>
<script>
$(window).bind("load", function() {
    setTimeout(function(){ 
        $(".lazy").each(function(){
           $(this).attr("src",  $(this).attr("data-src"));  
        });
    }, 12000);
    setTimeout(function(){ 
        $(".lazy-fast").each(function(){
           $(this).attr("src",  $(this).attr("data-src"));  
        });
    }, 6000);
});	
$(document).ready(function() {
$("#dismiss2").click(function () {
   $("#sidebar2").removeClass("active");
   $("#sidebar2").addClass("active");        
});
});
</script>
<?php
  }

?>
<script>
var a = 0;
$(window).scroll(function() {

 var oTop = $('#counter').offset().top - window.innerHeight;
 if (a == 0 && $(window).scrollTop() > oTop) {
   $('.counter-value').each(function() {
     var $this = $(this),
       countTo = $this.attr('data-count');
     $({
       countNum: $this.text()
     }).animate({
         countNum: countTo
       },

       {

         duration:400000000,
         easing: 'swing',
         step: function() {
           $this.text(Math.floor(this.countNum));
         },
         complete: function() {
           $this.text(this.countNum);
           //alert('finished');
         }

       });
   });
   a = 1;
 }

});
</script> 
<script>
$(document).ready(function(){
 $("#hide").click(function(){
   $("#sticky").hide();
 });
 $("#show").click(function(){
   $("#sticky").show();
 });
});
</script> 
<script>
const el = document.getElementById('does-not-exist');
console.log(el); // 👉️ null

// ⛔️ Cannot read properties of null (reading 'focus')
el.focus();

$('#navbarResponsive').focus(); 
$('footer').offset().top;
</script> 

<!-- Google Tag Manager (noscript) -->
<noscript>
<!--<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5B7BRLZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe>-->
</noscript>
<!-- End Google Tag Manager (noscript) -->

</body></html>

<!-- Popup Modal -->
<!-- <div id="homepopupModal" class="home-popup-modal">
    <div class="home-popup-content">
        <span id="homecloseBtn" class="home-close-btn">&times;</span>
        <img src="<?=HTACCESS_URL?>assets/img/popup-home.png" alt="Popup Image" class="home-popup-image">
    </div>
</div>  -->


<!-- Popup Modal -->
<div id="homepopupModal" class="home-popup-modal">
    <div class="home-popup-content">
        <span id="homecloseBtn" class="home-close-btn">&times;</span>
        <!-- Added `data-mobile-src` for mobile image -->
        <img src="<?=HTACCESS_URL?>assets/img/popup-home.png" 
             alt="Popup Image" 
             class="home-popup-image d-none d-md-block d-lg-block">
        
        <!-- Mobile Image (Hidden on Desktop) -->
        <img src="<?=HTACCESS_URL?>assets/img/popup-mobile.png" 
             alt="Popup Image" 
             class="home-popup-image d-md-none d-lg-none d-block">
    </div>
</div>

<!-- <div id="homepopupModal" class="home-popup-modal d-md-none d-lg-none d-block">
    <div class="home-popup-content">
        <span id="homecloseBtn" class="home-close-btn">&times;</span>
        <img id="homePopupImage" 
             src="<?=HTACCESS_URL?>assets/img/popup-mobile.png" 
             alt="Popup Image" 
             class="home-popup-image">
    </div>
</div> -->

<!-- <div id="homepopupModal" class="home-popup-modal">
    <div class="home-popup-content">
        <span id="homecloseBtn" class="home-close-btn">&times;</span>
       
        <img id="homePopupImage" 
             src="<?=HTACCESS_URL?>assets/img/popup-home.png" 
             data-mobile-src="<?=HTACCESS_URL?>assets/img/popup-mobile.png"
             alt="Popup Image" 
             class="home-popup-image">
    </div>
</div> -->


<!-- Include jQuery (if not already included) -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Include Your Custom Script -->
<!-- <script src="script.js"></script> -->

<script>

$(document).ready(function() {
    // Function to switch image based on screen size
    // function updatePopupImage() {
    //     let imgElement = $("#homePopupImage");
    //     let mobileSrc = imgElement.attr("data-mobile-src");
    //     let desktopSrc = "<?=HTACCESS_URL?>assets/img/popup-home.png"; // Desktop image
        
    //     if ($(window).width() <= 767) {
    //         imgElement.attr("src", mobileSrc);  // Set mobile image
    //     } else {
    //         imgElement.attr("src", desktopSrc); // Set desktop image
    //     }
    // }

    // Call the function on page load and on window resize
    // updatePopupImage();
    // $(window).resize(updatePopupImage);

    // Show popup instantly
    $('#homepopupModal').css({ "visibility": "visible", "opacity": "1", "pointer-events": "auto" });

    //Auto-hide after 5 seconds
    setTimeout(() => {
        $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0", "pointer-events": "none" });
    }, 5000);

    // Close the popup when clicking the close button
    $('#homecloseBtn').click(function() {
        console.log("Close button clicked!"); // Debugging log
        $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0", "pointer-events": "none" });
    });

    // Close the popup if the user clicks outside of it
    $(window).click(function(event) {
        if ($(event.target).is('#homepopupModal')) {
            $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0", "pointer-events": "none" });
        }
    });
});


</script> 

<style> 
@media (max-width: 767px) {
  .home-popup-content .home-popup-image {
        width: 80% !important;
        height: auto !important;
    }

  .home-popup-content {
    width: 100% !important;
    height: 70% !important;
}

.home-close-btn {
    position: absolute;
    font-size: 25px !important;
    width: 30px !important;
    height: 30px !important;
    right: 7% !important;
}
}
#homepopupModal {
    opacity: 0;
    visibility: hidden;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease-in-out, visibility 0s 0.5s;
    pointer-events: none;
}

.home-popup-content {
    position: relative;
    border-radius: 8px;
    text-align: -webkit-center;
    width: 100% !important;
    height: auto !important;
}

.home-popup-image {
        width: 60% !important;
        height: auto !important;
    }

    .home-close-btn {
    position: absolute;
    top: -2%;
    right: 19%;
    font-size: 38px;
    font-weight: bold;
    color: white;
    background: black;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
    z-index: 1001;
}

.home-close-btn:hover {
    background: red;
}
</style>