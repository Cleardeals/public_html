<?php
if(isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'');
	exit;
}
?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php
//unset($_SESSION['sign_up']);

$id = $_REQUEST['id'] ?? "";
$msg = base64_decode($_SESSION['signup_msg'] ?? "");
$msg1 = base64_decode($_SESSION['login_msg'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();
?>
<style>
#error1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
#error2 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
</style>

<div class="center-section-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="box-1" style="min-height:inherit">
          <p class="font-20 text-uppercase text-center mb-3"> Sign up whatsapp</span></p>
          <script src="https://cleardeals.authlink.me/js/sdk/otpless.js"></script>
          <button id="whatsapp-login"/>
          <script type="text/javascript">
function otpless() {

//const waId = otplessWaId();
 var otplessUser = window.otplessUser;
    var waNumber = otplessUser.waNumber;
    var waName = otplessUser.waName;

// Once you signup/sign a user, you can redirect the user to your signup/signin flow.

window.open("https://cleardeals.co.in", "_self")

}
</script> 
        </div>
      </div>
      <div class="col-lg-6 boder-2">
        <div class="box-1" style="min-height:inherit">
          <div class="box-css4">
            <p class="mb-3  font-30 text-uppercase themecolor">cleardeals</p>
            <p class="mb-3  font-18 text-uppercase"> Login to your account<br>
              to unlock these benefits </p>
            <div class="list-css2">
              <ol>
                <li>Get latest updates about new properties. </li>
                <li>Access thousand of properties in one click. </li>
                <li>Get market information, reports, price trends </li>
                <li>Chat with our Experts </li>
                <li>Hand-Holding support from our Support Team <a href="#" onclick="otpless()">qeqweqwe</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="box-1" style="min-height:inherit">
          <p class="font-20 text-uppercase text-center mb-3"> Sign up</span></p>
          <?php if(!empty($msg)) { ?>
          <center>
            <p style="color:#F00">
              <?=$msg?>
            </p>
          </center>
          <?php } ?>
          <p id="errorpop1" style="color:red;"></p>
          <center>
            <span style="color: #090;font-size:14px;" id="message"></span>
          </center>
          <form action="/" method="post" id="accFormRegpop" onSubmit="return chkformRegpop();" autocomplete="off">
            <input type="hidden" name="check_otp" id="check_otp">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="name" id="pop_name" class="form-control font-15 input-css" placeholder="Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="email" id="pop_email" class="form-control font-15 input-css" placeholder="Email Address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="mobile_no" id="pop_mobile_no" class="form-control font-15 input-css" placeholder="Mobile No.">
                </div>
                
                <!--<a href="#" id="otp_send" style="color:#F00">Click here to verify mobile no</a>--> 
                
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select name="user_type" id="pop_user_type" class="form-control font-15 input-css">
                    <option value="">User Type</option>
                    <option value="Buyer"> Buyer</option>
                    <option value="Seller"> Seller</option>
                  </select>
                </div>
              </div>
              
              <!-- <div class="col-md-6">

                          <div class="form-group"> 

                            <input type="text" name="otp" id="otp" class="form-control font-15 input-css" placeholder="Otp"> 

                          </div>

                        </div>--> 
              
              <!--<div class="col-md-6">

                          <div class="form-group">

                            <select name="state" id="pop_state" class="form-control font-15 input-css" onChange="getstates(this.value)">

                              <option value="">Select State</option>

                              <?php for($i=0;$i<count((array)$dbStates);$i++){?>

                              <option value="<?=$dbStates[$i]['id']?>">

                              <?=$dbStates[$i]['name']?>

                              </option>

                              <?php }?>

                            </select>

                          </div>

                        </div>

                        <?php if(!empty($_SESSION['sign_up']['city'])){?>

                        <div class="col-md-6">

                          <div class="form-group">

                            <select name="city" id="pop_selectcity" class="form-control font-15 input-css">

                              <option value="<?=$_SESSION['sign_up']['city']?>">

                              <?=$_SESSION['sign_up']['city']?>

                              </option>

                            </select>

                          </div>

                        </div>

                        <?php }else{?>

                        <div class="col-md-6">

                          <div class="form-group">

                            <select name="city" id="pop_selectcity" class="form-control font-15 input-css">

                              <option value="">Select City</option>

                            </select>

                          </div>

                        </div>

                        <?php }?>-->
              
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="username" id="pop_username1" class="form-control font-15 input-css" placeholder="Username">
                  <span style="color:#F00">e.g - CDjo1234</span> </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="password" name="password" id="pop_password" class="form-control font-15 input-css" placeholder="Password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="password" name="cpassword" id="pop_cpassword" class="form-control font-15 input-css" placeholder="Confirm Password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-control text-center captcha p-2"> <img src="<?=HTACCESS_URL?>php_captcha.php" style="height:30px;width:50%;margin-top:-17px;"/> </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="number" id="pop_captcha" class="form-control font-15 input-css" placeholder="Enter Captcha">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group"> 
                  
                  <!--<input type="button" name="otpbutton" id="otpbut" value="Send Mobile OTP" onclick="javascript:test1()" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" />-->
                  
                  <input type="submit" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SIGN UP NOW" >
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-6 boder-2">
        <div class="box-1" style="min-height:inherit">
          <p class="font-20 text-uppercase text-center mb-3"> Sign In</span> </p>
          <p id="errorpop2"></p>
          <form action="/" method="post" id="accFormpop1" onSubmit="return chkloginpop();" autocomplete="off">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="username" id="pop_username" class="form-control font-15 input-css" placeholder="Username">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="password" name="password" id="pop_password1" class="form-control font-15 input-css" placeholder="Password">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary subscribe-now font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Sign In">
                </div>
              </div>
            </div>
          </form>
          <div class="col-md-6"><a href="<?=HTACCESS_URL?>forgot-password/" style="color:#e30000;">Forgot Password?</a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php unset($_SESSION['signup_msg']);

unset ($_SESSION['login_msg']); ?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}


function chkformRegpop() {

	if(isEmpty("Name",document.getElementById("pop_name").value)) {

		document.getElementById("pop_name").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Name* ");

		document.getElementById("pop_name").style.borderColor  = "#FF0000";

		document.getElementById("pop_name").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_name").addEventListener("keyup", controlBorderColor, false);

		return false;

	}

	if(isEmpty("Email",document.getElementById("pop_email").value)) {

		document.getElementById("pop_email").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Email* ");

		document.getElementById("pop_email").style.borderColor  = "#FF0000";

		document.getElementById("pop_email").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_email").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(!validateEmail("Email",document.getElementById("pop_email").value)) {

		document.getElementById("pop_email").focus();

		document.getElementById("errorpop1").innerHTML=(" Invalid Email ");

		document.getElementById("pop_email").style.borderColor  = "#FF0000";

		document.getElementById("pop_email").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_email").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(isEmpty("Mobile Number",document.getElementById("pop_mobile_no").value)) {

		document.getElementById("pop_mobile_no").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Mobile No.* ");

		document.getElementById("pop_mobile_no").style.borderColor  = "#FF0000";

		document.getElementById("pop_mobile_no").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_mobile_no").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(document.getElementById("pop_mobile_no").value!=''){ 

		  var phoneno = /^\d{10}$/; 

		  var i;

		  var inputtxt = document.getElementById("pop_mobile_no").value;  

		  if(document.getElementById("pop_mobile_no").value.match(phoneno)) {  

			  i = 1;

		  } else {

			  i = 2;

		  }

		  

		  if(i==2){

				document.getElementById("pop_mobile_no").style.borderColor  = "#FF0000";

				document.getElementById("pop_mobile_no").addEventListener("keydown", controlBorderColor, false);

				document.getElementById("pop_mobile_no").addEventListener("keyup", controlBorderColor, false);

				document.getElementById("errorpop1").innerHTML=('Please enter only 10 digits mobile number.');

				document.getElementById("pop_mobile_no").value='';

				document.getElementById("pop_mobile_no").focus();

				return false;

		  }

	}

	

	/*if(isEmpty("User Type",document.getElementById("pop_user_type").value)) {



		document.getElementById("pop_user_type").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Select User Type* ");

		document.getElementById("pop_user_type").addEventListener("change", controlBorderColor, false);

		return false;

	}



	if(isEmpty("State",document.getElementById("pop_state").value)) {



		document.getElementById("pop_state").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter State* ");

		document.getElementById("pop_state").style.borderColor  = "#FF0000";

		document.getElementById("pop_state").addEventListener("change", controlBorderColor, false);

		return false;

	}



	if(isEmpty("City",document.getElementById("pop_selectcity").value)) {



		document.getElementById("pop_selectcity").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter City* ");

		document.getElementById("pop_selectcity").style.borderColor  = "#FF0000";

		document.getElementById("pop_selectcity").addEventListener("change", controlBorderColor, false);

		return false;

	}*/



	if(isEmpty("Username",document.getElementById("pop_username1").value)) {



		document.getElementById("pop_username1").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Username* ");

		document.getElementById("pop_username1").style.borderColor  = "#FF0000";

		document.getElementById("pop_username1").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_username1").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(isEmpty("Password",document.getElementById("pop_password").value)) {



		document.getElementById("pop_password").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Password* ");

		document.getElementById("pop_password").style.borderColor  = "#FF0000";

		document.getElementById("pop_password").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_password").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(isEmpty("Confirm Password",document.getElementById("pop_cpassword").value)) {



		document.getElementById("pop_cpassword").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Confirm Password* ");

		document.getElementById("pop_cpassword").style.borderColor  = "#FF0000";

		document.getElementById("pop_cpassword").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_cpassword").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(document.getElementById("pop_cpassword").value!='') {

		if(document.getElementById("pop_cpassword").value!=document.getElementById("pop_password").value) {

			//alert("Password Do Not Match");

			document.getElementById("errorpop1").innerHTML=(" Password Do Not Match ");

			document.getElementById("pop_cpassword").focus();

			return false;

		}

	}



	if(isEmpty("Captcha",document.getElementById("pop_captcha").value)) {

		document.getElementById("pop_captcha").focus();

		document.getElementById("errorpop1").innerHTML=(" Please Enter Captcha* ");

		document.getElementById("pop_captcha").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_captcha").addEventListener("keyup", controlBorderColor, false);

		return false;

	}

	

	submit_host_regpop();



	return false;

}





function submit_host_regpop(){

	

		var form_data=$('#accFormRegpop').serialize();

		

		$.ajax({

			url:"<?=HTACCESS_URL?>loginController.php?mode=signup_pop",

			data:form_data,

			cache:false,

			async:false,

			success: function(data) {

				//alert(data);

				if(data==1){

					//alert(data);

					$('#myModal').click();



					<?php if($mo=='pricing-details-for-sell-property'){?>

					

					$("#openthankyou1").click();



					setTimeout(function() {



					window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=sell';



					}, 1500);

					

					<?php }elseif($mo=='pricing-details-for-rent-property'){?>

					

					$("#openthankyou1").click();



					setTimeout(function() {



					window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent';



					}, 1500);

					

					<?php }else{?>



					$('#openthankyou1').click();



					setTimeout(function() {



						location.reload();



					}, 1500);

					

					<?php }?>



				}else 

					if(data==3){

					$("#errorpop1").html("Invalid Otp.");

					}else if(data==2){

					$("#errorpop1").html("Username Already Exists Please Try With Different Username.");

					} else {

					$("#myModal").click();

					<?php if($mo=='pricing-details-for-sell-property'){?>

					$("#openthankyou1").click();

					setTimeout(function() {

					window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=sell';

					}, 1500);

					

					<?php }elseif($mo=='pricing-details-for-rent-property'){?>

					

					$("#openthankyou1").click();



					setTimeout(function() {



					window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent';



					}, 1500);

					

					<?php }else{?>



					$("#openthankyou1").click();



					setTimeout(function() {



					location.reload();



					}, 1500);



					<?php }?>

					}

			}

			});

}





function chkloginpop() {



	if(isEmpty("Username",document.getElementById("pop_username").value)) {

		document.getElementById("pop_username").focus();

		document.getElementById("errorpop2").innerHTML=(" Please Enter Username* ");

		document.getElementById("pop_username").style.borderColor  = "#FF0000";

		document.getElementById("pop_username").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_username").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	if(isEmpty("Password",document.getElementById("pop_password1").value)) {

		document.getElementById("pop_password1").focus();

		document.getElementById("errorpop2").innerHTML=(" Please Enter Password* ");

		document.getElementById("pop_password1").style.borderColor  = "#FF0000";

		document.getElementById("pop_password1").addEventListener("keydown", controlBorderColor, false);

		document.getElementById("pop_password1").addEventListener("keyup", controlBorderColor, false);

		return false;

	}



	submit_hostpop1();

	//return true;

	return false;

}





function submit_hostpop1(){



		var pop_username = document.getElementById("pop_username").value;

		var pop_password1 = document.getElementById("pop_password1").value;



          $.ajax({

                url:"<?=HTACCESS_URL?>loginController.php?mode=login_pop&pop_username="+pop_username+"&pop_password1="+pop_password1,

				cache:false,

				async:true,

                //data:"username =" + username,

                    success:function(data){

					 if(data==2){

						//alert(data);

						$("#errorpop2").html("Invalid Username Or Password Please Try Again.");

						return false;



                    }  else{

						$('#myModal').click();



						<?php //if($mo=='pricing-details-for-sell-property'){?>

						/*$('#openthankyou2').click();

						

						

						$('#openthankyou2').click();

						setTimeout(function() {



						window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=sell';



					}, 1500);*/

						<?php //}elseif($mo=='pricing-details-for-rent-property'){?>

						/* $('#openthankyou2').click();

						setTimeout(function() {



						window.location.href = '<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent';



					}, 1500);*/

						

						<?php //}else{?>



					    $('#openthankyou2').click();

						setTimeout(function() {



						location.reload();



					}, 1500);

					<?php //}?>

						return true;

                    }

                }

             });



}







function getstates(stateID){

	 $.ajax({

			url:'<?=HTACCESS_URL?>loginController.php?mode=getcitypop',

			data:'stateID='+stateID,

			success:function(response){

			//alert(response);

			$('#pop_selectcity').html(response);

		}

		});

}

</script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
