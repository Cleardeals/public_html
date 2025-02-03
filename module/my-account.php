<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$msg = base64_decode($_SESSION['update_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from states where id='".$dbUser[0]['state']."'";
$dbState = $dbObj->SelectQuery();
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
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> My <span class="themecolor">Account</span></h2>
          <div class="row justify-content-md-center">
            <div class="col-md-12">
              <div class="box-css-2">
                <?php if(!empty($msg)) { ?>
                <center>
                  <p style="color:#F00">
                    <?=$msg?>
                  </p>
                </center>
                <?php } ?>
                <p id="error1"></p>
                <form action="<?=HTACCESS_URL?>userController.php" method="post" autocomplete="off" id="accForm" onSubmit="return chkform();">
                  <input type="hidden" name="mode" value="my_account">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[name]" id="name" class="form-control" placeholder="Name" value="<?=$dbUser[0]['name']?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[email]" id="email" class="form-control" placeholder="Email" value="<?=$dbUser[0]['email']?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[mobile_no]" id="mobile_no" class="form-control" placeholder="Mobile Number" value="<?=$dbUser[0]['mobile_no']?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[country]" class="form-control" placeholder="Country" value="<?=$dbUser[0]['country'] ?? ""?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[state]" class="form-control" placeholder="State" value="<?=$dbUser[0]['state'] ?? ""?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="info[city]" id="city" class="form-control" placeholder="City" value="<?=$dbUser[0]['city'] ?? ""?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <textarea class="form-control" name="info[address]" placeholder="Address"><?=$dbUser[0]['address'] ?? ""?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select class="form-control" name="info[user_type]" id="user_type">
                          <option value="">User Type</option>
                          <option value="Buyer" <?=($dbUser[0]['user_type']=='Buyer')?'selected':''?>>Buyer</option>
                          <option value="Seller" <?=($dbUser[0]['user_type']=='Seller')?'selected':''?>> Seller</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="text-center">
                        <button type="submit" class="btn btn-info mb-2 btn-css text-uppercase font-bold"> Submit</button>
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
  </div>
</div>
</div>
<?php unset($_SESSION['update_msg']);?>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
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
	if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
		document.getElementById("mobile_no").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Mobile No.* ");
		document.getElementById('mobile_no').style.borderColor  = '#FF0000';
		document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(document.getElementById("mobile_no").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("mobile_no").value;  
		  if(document.getElementById("mobile_no").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;  
				
		  }	
		  
		  if(i==2){
				document.getElementById('mobile_no').style.borderColor  = '#FF0000';
				document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
				document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
				document.getElementById("error1").innerHTML=('Please enter only 10 digits mobile number.');
				document.getElementById("mobile_no").value='';
				document.getElementById("mobile_no").focus();
				return false;    
		  }
	}
	if(isEmpty("City",document.getElementById("city").value)) {
		document.getElementById("city").focus();
		document.getElementById("error1").innerHTML=(" Please Enter City* ");
		document.getElementById('city').style.borderColor  = '#FF0000';
		document.getElementById("city").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("city").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("User Type",document.getElementById("user_type").value)) {
		document.getElementById("user_type").focus();
		document.getElementById("error1").innerHTML=(" Please Select User Type* ");
		document.getElementById("user_type").addEventListener("change", controlBorderColor, false);
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
<?php include(INCLUDE_DIR.'footer1.php');?>
