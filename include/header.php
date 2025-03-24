<?php
//ead7be057a9b75c81a0a40741881ef46
// echo "hello"l
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';
$pageurl = $dbObj->sc_mysql_escape($_REQUEST['url'] ?? "");

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."services where status='1'";
$dbServices = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from states";
$dbStates = $dbObj->SelectQuery();

$dbObj->dbQuery="SELECT * FROM ".PREFIX."blog_category";
$dbBlogCategory = $dbObj->SelectQuery();
//unset($_SESSION['sign_up']);
?>
<style>
#errorpop1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
#errorpop2 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
.box-css4 {
	padding: 20px
}
 @media (min-width: 576px) {
.modal-dialog {
	margin: 8.75rem auto;
}
</style>

<!--login popup-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog" style="max-width:1200px; min-height:400px"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="bs-example">
            <div class="box-css4">
              <ul class="nav nav-tabs">
                <li class="nav-item"> <a href="#profile" class="nav-link active btn submit font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100" data-toggle="tab">Sign Up</a> </li>
                <li class="nav-item"> <a href="#home" class="nav-link  btn submit font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100" data-toggle="tab">Sign In</a> </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade" id="home">
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
                <div class="tab-pane fade show active" id="profile">
                  <div class="box-1" style="min-height:inherit">
                    <p class="font-20 text-uppercase text-center mb-3"> Sign up</span></p>
                    <?php if(!empty($msg)) { ?>
                    <center>
                      <p style="color:#F00">
                        <?=$msg?>
                      </p>
                    </center>
                    <?php } ?>
                    <p id="errorpop1"></p>
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
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
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
                <li>Hand-Holding support from our Support Team </li>
              </ol>
              <!--<script src="https://cleardeals.authlink.me/js/sdk/otpless.js"></script>--> 
              <!--<button id="whatsapp-login"/>-->
              <div style="border: none;outline: none;height: 60px;width: 100%;background: rgb(35, 211, 102);border-radius: 20px;color: rgb(255, 255, 255); line-height: 54px;cursor: pointer;" onclick="window.location.href='https://www.cleardeals.co.in/whatsapp.php'">
                <div style="display: flex;align-items: center;justify-content: center;gap: 10px;"> <img style=" width: 30px;" src="https://cleardeals.authlink.me/assets/whatsapp.svg">
                  <p style="font-weight: 600;font-size: 20px;margin: 0;">Continue with WhatsApp</p>
                </div>
              </div>
              
              <!--<script type="text/javascript">
                    function otpless() {
                    const waId = otplessWaId();
                    // Once you signup/sign a user, you can redirect the user to your signup/signin flow.
                    window.open("https://cleardeals.co.in", "_self")
                    }
               </script>--> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$dbObj->dbQuery="select * from ".PREFIX."settings where id='1'";
$dbSettings = $dbObj->SelectQuery();
?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu nav-boder" id="mainNav">
  <div class="container-fluid">
    <div class="row2">
      <?php if($dbSettings[0]['popupstatus']==1){?>
      <div id="top-div-1" style="background-color:#e9ecf0;color:#1c304e;">
        <button type="button" class="close" id="hide" data-dismiss="modal"> <img id="headline" width="20" height="20" src="<?=HTACCESS_URL?>assets/img/Close-Blue.svg"></button>
        <div class="container montserrat">
          <?=$dbSettings[0]['popup']?>
        </div>
      </div>
      <?php }?>
      <div class="top-part2 position-relative">
        <div class="container"> 
          
          <!--<a href="https://api.whatsapp.com/send?phone=9723992200&text=I&source=&data=" target="_blank" 

        class="btn text-white call-bt"><i class="fa fa-whatsapp"></i> 9723992200</a>--> 
          
          <a href="tel:+91-9723992226" class="btn text-white call-bt-neww"><i class="fa fa-phone"></i> 9723992226</a><a href="<?=HTACCESS_URL?>property-valuation-calculator/" class="btn text-white call-bt call-bt3 flashing" target="_blank"> Book Free Valuation <i class="flaticon-clipboard-with-pencil"></i></a>
          <?php if(!isset($_SESSION['user']['is_login'])) {?>
          
          <!--<a class="text-white sign-up pl-1 pr-1" style="color:#fff!important;" href="<?=HTACCESS_URL?>sign-up/" target="_blank"> <i class="fa fa-user themecolor font-15" aria-hidden="true"></i> Log In </a>--> 
          
          <a class="text-white sign-up pl-1 pr-1" style="color:#fff!important;" href=""  data-toggle="modal" data-target="#myModal"> <i class="fa fa-user themecolor font-15" aria-hidden="true"></i> Log In </a>
          <?php }else{?>
          <a class="nav-link sign-up pl-1 pr-1" href="<?=HTACCESS_URL?>dashboard/" target="_blank"> <i class="fa fa-home themecolor font-15" aria-hidden="true"></i> Dashboard </a>
          <?php }?>
          <button type="button" id="sidebarCollapse" class=" text-white call-bt btn btn-info font-14 font-bold themebg text-uppercase border-0"> <i class="fa fa-align-left"></i> <span>Menu3</span></button>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="container"> <a class="navbar-brand js-scroll-trigger" href="<?=HTACCESS_URL?>"> <img width="250" height="60" src="<?=HTACCESS_URL?>assets/img/logo.webp"></a>
        <?php 

        if(strpos($_SERVER['REQUEST_URI'],'blogs') == true){
        ?>
        <div class="navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav montserrat">
            <li class="nav-item none-nav"><a class="nav-link" href="<?=HTACCESS_URL?>"> Home </a> </li>
            <?php for($i=0;$i<count((array)$dbBlogCategory);$i++){?>
            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <?=$dbBlogCategory[$i]['name']?>
              </a>
              <?php 
                $dbObj->dbQuery="SELECT * FROM ".PREFIX."blog_sub_category WHERE category_id='".$dbBlogCategory[$i]['id']."'";
                $dbBlogSubCategory = $dbObj->SelectQuery();
              ?>
              <div class="dropdown-menu">
                <?php for($j=0;$j<count((array)$dbBlogSubCategory);$j++){?>
                <a class="dropdown-item" href="https://www.cleardeals.co.in/blogs/category/<?=$dbBlogSubCategory[$j]['link']?>/">
                <?=$dbBlogSubCategory[$j]['name']?>
                </a>
                <?php } ?>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        <?php 
        }else{
        ?>
        <div class="navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav montserrat">
            <li class="nav-item none-nav"><a class="nav-link" href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Buy Property </a> </li>
            <li class="nav-item none-nav"> <a class="nav-link" href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> Sell property </a> </li>
            <li class="nav-item none-nav"> <a href="<?=HTACCESS_URL?>request-call-back/" class="nav-link" target="_blank"> <i class="flaticon-phone"></i> Request Call Back</a> </li>
          </ul>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</nav>

<!-- Header -->

<div id="social-media"> <a href="https://api.whatsapp.com/send?phone=+919723992226" target="_blank" class="rotate"><img src="<?=HTACCESS_URL?>assets/img/whatsapp.svg" alt="whatsapp" title="whatsapp" width="40" height="40"></a> </div>

<!-- Sidebar  -->

<nav id="sidebar">
  <div id="dismiss"><img width="20" height="20" src="<?=HTACCESS_URL?>assets/img/cross2.svg"> </div>
  <div class="sidebar-header">
    <p>&nbsp;</p>
  </div>
  <div class="list-group panel"> 
    
    <!--<div class="col"> <a class="btn text-white call-bt call-bt3 font-bold d-block mb-2" href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Search Property </a> <a class="btn text-white call-bt call-bt3 d-block mb-2 font-bold" href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> Sell property </a> <a class="btn text-white call-bt call-bt3 d-block mb-2 font-bold" href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank"> Rent  property </a> </div>--> 
    
    <a class="list-group-item" href="<?=HTACCESS_URL?>home/" target="_blank">
    <?=$dbSiteContent[0]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Buy Property </a> <a class="list-group-item" href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> Sell property </a> <a class="list-group-item" href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank"> Rent  property </a> 
    
    <!--<a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down">Core Services </span> </a>

    <div class="collapse" id="menu1"> <a href="<?=HTACCESS_URL?>sell-property-listing/" class="list-group-item" target="_blank"> Search Property </a> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="list-group-item" target="_blank">

      <?=$dbSiteContent[2]['menu_name']?>

      </a> <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" class="list-group-item" target="_blank">

      <?=$dbSiteContent[3]['menu_name']?>

      </a> <a href="<?=HTACCESS_URL?>book-free-valuation/" class="list-group-item" target="_blank"> Property Valuation Calculator</a> </div>--> 
    
    <!--<a href="#menu2" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down"> Additional Services</span> </a>

    <div class="collapse" id="menu2">

      <?php for($i=0;$i<count((array)$dbServices);$i++){?>

      <a class="list-group-item" href="<?=HTACCESS_URL?>services/#propertyservice<?=$dbServices[$i]['id']?>" target="_blank">

      <?=$dbServices[$i]['title']?>

      </a>

      <?php }?>

    </div>--> 
    
    <a href="#menu3" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down"> Other Links</span> </a>
    <div class="collapse" id="menu3"> <a class="list-group-item" href="<?=HTACCESS_URL?>about/" target="_blank">
      <?=$dbSiteContent[1]['menu_name']?>
      </a> <a class="list-group-item" href="<?=HTACCESS_URL?>new-projects-promotion/" target="_blank">
      <?=$dbSiteContent[16]['menu_name']?>
      </a> <a href="<?=HTACCESS_URL?>book-free-valuation/" class="list-group-item" target="_blank"> Property Valuation Calculator</a> <a href="<?=HTACCESS_URL?>home-loan-calculator/" class="list-group-item" target="_blank"> Home Loan Calculator</a>
      <?php for($i=0;$i<count((array)$dbServices);$i++){?>
      <a class="list-group-item" href="<?=HTACCESS_URL?>services/#propertyservice<?=$dbServices[$i]['id']?>" target="_blank">
      <?=$dbServices[$i]['title']?>
      </a>
      <?php }?>
      <a class="list-group-item" href="<?=HTACCESS_URL?>blogs/" target="_blank">
      <?=$dbSiteContent[5]['menu_name']?>
      </a> <a class="list-group-item" href="<?=HTACCESS_URL?>media/" target="_blank">Media</a> <a class="list-group-item" href="<?=HTACCESS_URL?>the-team/" target="_blank">
      <?=$dbSiteContent[9]['menu_name']?>
      </a> <a class="list-group-item" href="<?=HTACCESS_URL?>careers/" target="_blank">
      <?=$dbSiteContent[10]['menu_name']?>
      </a> </div>
    <a class="list-group-item" href="<?=HTACCESS_URL?>faq/" target="_blank">
    <?=$dbSiteContent[6]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>review-us/" target="_blank">
    <?=$dbSiteContent[7]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>contact/" target="_blank">
    <?=$dbSiteContent[8]['menu_name']?>
    </a>
    <?php if(isset($_SESSION['user']['is_login'])) {?>
    <a class="list-group-item" href="<?=HTACCESS_URL?>logout/"> Logout </a>
    <?php }?>
  </div>
</nav>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script type="text/javascript">

//document.getElementById("pop_mobile_no").addEventListener("focusout", myFunction);

function test1(){
	//alert("hello123");
  var pop_mobile_no = document.getElementById('pop_mobile_no').value;
  //alert(pop_mobile_no);
  $.ajax({
			url:'<?=HTACCESS_URL?>mobilepopAPI.php',
			data:'pop_mobile_no='+pop_mobile_no,
			success:function(response){
			//alert(response);
			document.getElementById('check_otp').value = response;
			document.getElementById('submitbut').style.display = 'block';
			document.getElementById('otpbut').style.display = 'none';
		}
		});
}


function myFunction() {

//alert("hello");
  //if (confirm('Click Ok to verify your mobile number using OTP')) {
  // Save it!

  var pop_mobile_no = document.getElementById('pop_mobile_no').value;
  //alert(pop_mobile_no);
  $.ajax({
			url:'<?=HTACCESS_URL?>mobilepopAPI.php',
			data:'pop_mobile_no='+pop_mobile_no,
			success:function(response){
			//alert(response);
			document.getElementById('check_otp').value = response;
			//document.getElementById('submitbut').style.display = 'block';
			//document.getElementById('otpbut').style.display = 'none';
		}
		});
  //alert('Thing was saved to the database.');
/*} else {
  // Do nothing!
  //alert('Thing was not saved to the database.');
}*/
}

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
						//alert(data);
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