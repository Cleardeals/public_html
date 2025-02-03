<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<div class="center-section-in page-css">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> Digital Marketing for 
    <span class="themecolor">New Real Estate Projects </span> </h2>
    <div class="row">
      <div class="new-projects">
        <h1 class="mx-auto wow fadeInDown montserrat font-weight-bolder"> Service to help you generate more leads for your Real Estate<br />
          Project in a cost effective way!</h1>
        <h2 class="font-italic wow fadeIn">Connect with Buyers. <span class="themecolor"> Sell Quickly. </span> 
        <span class="green">Make good profits</span></h2>
      </div>
      <div class="col-lg-8">
        <ul class="list-css2">
          <li>Are Newspaper or Print Media adverts not delivering enough leads as use to before 3 to 5 years?</li>
          <li>Is the Cost per lead of print media increased more than double in recent times?</li>
          <li>Are you burning your hard earned money on print media advertisements?</li>
          <li>Is delay in new bookings hurting your ROI for the Project?</li>
          <li>Is "Digital Marketing" of your Project up to mark?</li>
        </ul>
        <h5 class="mt-4 mb-3"><i>"Digital Marketing has substantially reduced the cost per lead for Real Estate Projects"</i></h5>
        <h5>The Road ahead for a Bright Future:-</h5>
        <p class="mt-1 mb-3"> Clear deals is a core Real Estate Company, providing Digital Marketing Services to Real Estate Developers for cost effective lead generation of their projects !</p>
        <h5 class="mt-3 mb-2">We help the Real Estate Developers avoid,</h5>
        <ul class="list-css2">
          <li>Negative consequences of dealing with a General Digital Marketer!</li>
          <li>Losing your hard earned money on print media advertising!</li>
          <li>Opportunity costs for delayed booking of project!</li>
          <li>Feeling taken advantage of!</li>
        </ul>
        <p>We with your support are working to change the big wallet traditional marketing techniques to cost effective digital marketing to help every developer generate good quality and cost effective leads for their project.
          With "Cleardeals" in the market trying its best, no developer should have to experience any frustration for lead generation"</p>
        <h5 class="mb-3"> "We save real estate developers from frustration of poor quality leads, yet deliver the quickest, hassle-free and affordable lead generation services you love" </h5>
      </div>
      <div class="col-lg-4">
        <div class="box-css-form">
          <h4 class="text-uppercase font-25 font-bold text-center mb-1 text-white">Get MORE Buyers</h4>
          <p class="text-center text-white">we're on a path to improve your business!</p>
          <p style="margin:0; padding:0; font-size:15px; text-align:center; color:#FF0000" id="error1"></p>
          <form action="/" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
            <input type="hidden" name="mode" value="enquiry">
            <div class="form-group mb-3">
              <input type="text" name="name" id="name" class="form-control font-14 input-css" placeholder="Name">
            </div>
            <div class="form-group mb-3">
              <input type="text" name="company_name" id="company_name" class="form-control font-14 input-css" placeholder="Company Name">
            </div>
            <div class="form-group mb-3">
              <input type="text" name="email" id="email" class="form-control font-14 input-css" placeholder="official email id">
            </div>
            <div class="form-group mb-3">
              <input type="text" name="contact_no" id="contact_no" class="form-control font-14 input-css" placeholder="Contact Number">
            </div>
            <div class="form-group mb-3">
              <input type="submit" class="btn btn-primary subscribe-now submit font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100" value="Enquire Now">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#474845"; 
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
	if(isEmpty("Company Name",document.getElementById("company_name").value)) {
		document.getElementById("company_name").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Company Name* ");
		document.getElementById('company_name').style.borderColor  = '#FF0000';
		document.getElementById("company_name").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("company_name").addEventListener("keyup", controlBorderColor, false);
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
	if(isEmpty("Contact Number",document.getElementById("contact_no").value)) {
		document.getElementById("contact_no").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Contact Number* ");
		document.getElementById('contact_no').style.borderColor  = '#FF0000';
		document.getElementById("contact_no").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("contact_no").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(document.getElementById("contact_no").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("contact_no").value;  
		  if(document.getElementById("contact_no").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;  
				
		  }	
		  
		  if(i==2){
				document.getElementById('contact_no').style.borderColor  = '#FF0000';
				document.getElementById("contact_no").addEventListener("keydown", controlBorderColor, false);
				document.getElementById("contact_no").addEventListener("keyup", controlBorderColor, false);
				document.getElementById("error1").innerHTML=('Please enter only 10 digits contact no.');
				document.getElementById("contact_no").value='';
				document.getElementById("contact_no").focus();
				return false;    
		  }
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
			url:"<?=HTACCESS_URL?>contactController.php?mode=enquiry",
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