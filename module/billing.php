<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}
?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
//unset($_SESSION['billing']);
$msg = base64_decode($_SESSION['bill_msg'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();
?>
<style>
#error1 {
	margin:0 0 15px 0;
	padding:0;
	font-size:15px;
	color:#FF0000;
	text-align:center;
}
</style>
<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> Billing </h2>
    <?php if(!empty($msg)) { ?>
    <center>
      <p style="color:#F00">
        <?=$msg?>
      </p>
    </center>
    <?php } ?>
    <p id="error1"></p>
    <form action="<?=HTACCESS_URL?>userController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
      <input type="hidden" name="mode" value="billing_detail">
      <input type="hidden" name="amount" value="<?=$_SESSION['billing']['amount'] ?? ""?>">
      <input type="hidden" name="for_property" value="<?=$_SESSION['billing']['for_property'] ?? ""?>">
      <input type="hidden" name="validity" value="<?=$_SESSION['billing']['validity'] ?? ""?>">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 row m-0 p-0">
          <!--<div class="col-md-12 mb-3 mt-3">
            <h3 class="billing-t">Selling / Renting Property Details</h3>
            <p>Is selling Property address same as billing address?</p>
            <label>
              <input name="add" id="add" value="1" type="radio" <?=($_SESSION['billing']['add']=='1')?'checked':''?>>
              Yes </label>
            &nbsp;
            <label>
              <input name="add" id="add1" value="2" <?=($_SESSION['billing']['add']=='2')?'checked':''?> type="radio" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              No </label>
          </div>-->
         <!-- <div class="col-md-12">
            <div class="collapse" id="collapseExample">
              <div class="form-group">
                <textarea name="prop_add" id="prop_add" rows="4" cols="30" placeholder="Address" class="select-css form-control font-14"><?=$_SESSION['billing']['prop_add']?></textarea>
              </div>
            </div>
          </div>-->
         <!-- <div class="col-md-6">
            <div class="form-group">
              <label class="mb-2 font-bold font-13">Form No. </label>
              <input type="text" name="form_no" id="form_no" class="form-control" placeholder="Form No." value="<?=$_SESSION['billing']['form_no']?>">
            </div>
          </div>-->
          <div class="col-md-12">
            <div class="form-group">
              <label class="mb-2 font-bold font-13">Property Name and Address</label>
              <input type="text" name="property_name" id="property_name" class="form-control" placeholder="Property Name and Address" value="<?=$_SESSION['billing']['property_name'] ?? ""?>">
            </div>
          </div>
          <?php $property_type = $_SESSION['billing']['property_type'] ?? "";?>
          <div class="col-md-4">
            <div class="form-group">
              <label class="mb-2 font-bold font-13">Property Type </label>
              <select name="property_type" id="property_type" class="form-control">
              <option value="">Select</option>
                <option value="Flat" <?=($property_type=='Flat')?'selected':''?>> Flat</option>
                <option value="Apartment" <?=($property_type=='Apartment')?'selected':''?>> Apartment</option>
                <option value="Tower" <?=($property_type=='Tower')?'selected':''?>> Tower</option>
                <option value="Row House" <?=($property_type=='Row House')?'selected':''?>> Row House</option>
                <option value="Individual Bunglow" <?=($property_type=='Individual Bunglow')?'selected':''?>> Individual Bunglow</option>
                <option value="Twin Bunglow" <?=($property_type=='Twin Bunglow')?'selected':''?>> Twin Bunglow</option>
                <option value="Individual Villa" <?=($property_type=='Individual Villa')?'selected':''?>> Individual Villa</option>
                <option value="Weekend Homes" <?=($property_type=='Weekend Homes')?'selected':''?>> Weekend Homes</option>
                <option value="Farm House" <?=($property_type=='Farm House')?'selected':''?>> Farm House</option>
                <option value="Residential Plot" <?=($property_type=='Residential Plot')?'selected':''?>> Residential Plot</option>
                <option value="Open Plot" <?=($property_type=='Open Plot')?'selected':''?>> Open Plot</option>
                <option value="Pent House" <?=($property_type=='Pent House')?'selected':''?>> Pent House</option>
                <option value="Duplex" <?=($property_type=='Duplex')?'selected':''?>> Duplex</option>
                <option value="Tenament" <?=($property_type=='Tenament')?'selected':''?>> Tenament</option>
              </select>
            </div>
          </div>
          <?php $no_of_bedrooms = $_SESSION['billing']['no_of_bedrooms'] ?? "";?>
          <div class="col-md-4">
            <label class="mb-2 font-bold font-13">No. of Bedroom</label>
            <select name="no_of_bedrooms" id="no_of_bedrooms" class="form-control">
            <option value="">Select</option>
              <?php //for($i=0;$i<15;$i++){?>
              <?php //if(!empty($_SESSION['billing']['no_of_bedrooms'])){?>
             <!-- <option value="<?=$i?>" <?=($_SESSION['billing']['no_of_bedrooms']==$i)?'selected':''?>>
              <?=$i?>
              BHK</option>
              <?php //}else{?>
              <option value="<?=$i?>">
              <?=$i?>
              BHK</option>-->
              <?php //}?>
              <?php //}?>
               <option value="1 RK" <?=($no_of_bedrooms=='1 RK')?'selected':''?>>1 RK</option>
                    <option value="1 BHK" <?=($no_of_bedrooms=='1 BHK')?'selected':''?>>1 BHK</option>
                    <option value="1.5 BHK" <?=($no_of_bedrooms=='1.5 BHK')?'selected':''?>>1.5 BHK</option>
                    <option value="2 BHK" <?=($no_of_bedrooms=='2 BHK')?'selected':''?>>2 BHK</option>
                    <option value="2.5 BHK" <?=($no_of_bedrooms=='2.5 BHK')?'selected':''?>>2.5 BHK</option>
                    <option value="3 BHK" <?=($no_of_bedrooms=='3 BHK')?'selected':''?>>3 BHK</option>
                    <option value="3.5 BHK" <?=($no_of_bedrooms=='3.5 BHK')?'selected':''?>>3.5 BHK</option>
                    <option value="4 BHK" <?=($no_of_bedrooms=='4 BHK')?'selected':''?>>4 BHK</option>
                    <option value="4.5 BHK" <?=($no_of_bedrooms=='4.5 BHK')?'selected':''?>>4.5 BHK</option>
                    <option value="5 BHK" <?=($no_of_bedrooms=='5 BHK')?'selected':''?>>5 BHK</option>
                    <option value="5 + BHK" <?=($no_of_bedrooms=='5 + BHK')?'selected':''?>>5 + BHK</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="mb-2 font-bold font-13">No. of Bathrooms</label>
            <select name="no_of_bathrooms" id="no_of_bathrooms" class="form-control">
             <option value="">Select</option>
              <?php for($i=0;$i<30;$i++){?>
              <?php if(!empty($_SESSION['billing']['no_of_bathrooms'])){?>
              <option value="<?=$i?>" <?=($_SESSION['billing']['no_of_bathrooms']==$i)?'selected':''?>>
              <?=$i?>
              </option>
              <?php }else{?>
              <option value="<?=$i?>">
              <?=$i?>
              </option>
              <?php }?>
              <?php }?>
            </select>
          </div>
          <?php $prop_state = $_SESSION['billing']['prop_state'] ?? "";?>
          <div class="col-md-6">
            <div class="form-group">
              <select name="prop_state" id="prop_state" class="form-control font-14 input-css" onChange="getstate1(this.value)">
                <option value="">Select State</option>
                <?php for($i=0;$i<count((array)$dbState);$i++){?>
                <option value="<?=$dbState[$i]['id']?>" <?=($dbState[$i]['id']==$prop_state)?'selected':''?>>
                <?=$dbState[$i]['state_name']?>
                </option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php if(!empty($_SESSION['billing']['prop_city'])){?>
              <select class="form-control" name="prop_city" id="selectcity1">
                <option value="<?=$_SESSION['billing']['prop_city']?>">
                <?=$_SESSION['billing']['prop_city']?>
                </option>
              </select>
              <?php }else{?>
              <select name="prop_city" id="selectcity1" class="form-control font-14 input-css">
                <option value="">Select City</option>
              </select>
              <?php }?>
            </div>
          </div>
          <!--<div class="col-md-12">
            <div class="form-group">
              <textarea name="detail" id="detail" rows="5" cols="40" placeholder="Detail" class="select-css form-control font-14 input-css"><?=$_SESSION['billing']['detail']?></textarea>
            </div>
          </div>-->
          <!--<div class="col-md-12">
           <?php
                      $overlookingval = str_replace("'",'',$_SESSION['billing']['overlooking']);
					  $overLookingvalarray = explode(',',$overlookingval);
					  ?>
            <label class="mb-2 font-bold font-13">Overlooking</label><br />
            <input type="checkbox" name="overlooking[]" id="overlooking" value="Park/Garden" <?=(in_array('Park/Garden',$overLookingvalarray))?'checked':''?>>  Park/Garden &nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="overlooking[]" id="overlooking" value="Main Road" <?=(in_array('Main Road',$overLookingvalarray))?'checked':''?>>  Main Road &nbsp;&nbsp;&nbsp;
              <input type="checkbox" name="overlooking[]" id="overlooking" value="Club" <?=(in_array('Club',$overLookingvalarray))?'checked':''?>>  Club &nbsp;&nbsp;&nbsp;
               <input type="checkbox" name="overlooking[]" id="overlooking" value="Pool" <?=(in_array('Pool',$overLookingvalarray))?'checked':''?>>  Pool &nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="overlooking[]" id="overlooking" value="Others" <?=(in_array('Others',$overLookingvalarray))?'checked':''?>>  Others &nbsp;&nbsp;&nbsp;
          </div>-->
          
          <?php $hear_about = $_SESSION['billing']['hear_about'] ?? "";?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="mb-2 font-bold font-13"> Where did you hear about us ?
              </label>
              <select name="hear_about" id="hear_about" class="form-control font-14 input-css custom-selec">
                <option value="">Select Option</option>
                <option value="Facebook/Instagram/Twitter" <?=($hear_about=='Facebook/Instagram/Twitter')?'selected':''?>>Facebook/Instagram/Twitter</option>
                <option value="Through Company executive" <?=($hear_about=='Through Company executive')?'selected':''?>>Through Company executive</option>
                <option value="Through Email" <?=($hear_about=='Through Email')?'selected':''?>> Through Email</option>
                <option value="From Google search" <?=($hear_about=='From Google search')?'selected':''?>>From Google search</option>
                <option value="From our Blog Post" <?=($hear_about=='From our Blog Post')?'selected':''?>>From our Blog Post</option>
                <option value="From a Friend / Relative" <?=($hear_about=='From a Friend / Relative')?'selected':''?>>From a Friend / Relative</option>
              </select>
            </div>
          </div>
          <!--<div class="col-md-12">
            <div class="form-group">
              <textarea name="address" id="address" rows="4" cols="30" placeholder="Your Current Address of Residence" class="form-control font-14 input-css"><?=$_SESSION['billing']['address']?></textarea>
            </div>
          </div>-->
          <!--<div class="col-md-12">
            <div class="form-group">
              <textarea name="prop_remark" id="prop_remark" rows="4" cols="30" placeholder="Remark" class="form-control font-14 input-css"><?=$_SESSION['billing']['prop_remark']?></textarea>
            </div>
          </div>-->
          <div class="col-md-6">
            <div class="form-group">
              <div class="form-control text-center captcha"> <img src="<?=HTACCESS_URL?>php_captcha.php" style="height:30px;width:50%;margin-top:-17px;"/></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="number" id="captcha" class="form-control font-15 input-css" placeholder="Enter Captcha">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <input type="submit" class="btn btn-primary subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 submit2 w-100" value="Proceed">
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<?php unset($_SESSION['bill_msg']);?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
$('#multi-select-demo').multiselect();

$('#multi-select4').multiselect({
	maxHeight: 400,	
});
$('#multi-select5').multiselect();
$('#multi-select6').multiselect();


});
</script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}


function chkform() {
	/*if(document.getElementById("add").checked==false && document.getElementById("add1").checked==false){
		//alert("Please select Payment Option");
		document.getElementById("error1").innerHTML=(" Please Choose Selling Property Address* ");
		document.getElementById("add").focus();
		return false;

	}
	if(isEmpty("Form No",document.getElementById("form_no").value)) {
		document.getElementById("form_no").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Form No* ");
		document.getElementById('form_no').style.borderColor  = '#FF0000';
		document.getElementById("form_no").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("form_no").addEventListener("keyup", controlBorderColor, false);
		return false;
	}*/
	if(isEmpty("Property Name",document.getElementById("property_name").value)) {
		document.getElementById("property_name").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Property Name* ");
		document.getElementById('property_name').style.borderColor  = '#FF0000';
		document.getElementById("property_name").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("property_name").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Property Type",document.getElementById("property_type").value)) {
		document.getElementById("property_type").focus();
		document.getElementById("error1").innerHTML=(" Please Select Property Type* ");
		document.getElementById('property_type').style.borderColor  = '#FF0000';
		document.getElementById("property_type").addEventListener("change", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Number of Bedroom",document.getElementById("no_of_bedrooms").value)) {
		document.getElementById("no_of_bedrooms").focus();
		document.getElementById("error1").innerHTML=(" Please Select Number of Bedroom* ");
		document.getElementById('no_of_bedrooms').style.borderColor  = '#FF0000';
		document.getElementById("no_of_bedrooms").addEventListener("change", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Number of Bathrooms",document.getElementById("no_of_bathrooms").value)) {
		document.getElementById("no_of_bathrooms").focus();
		document.getElementById("error1").innerHTML=(" Please Select Number of Bathrooms* ");
		document.getElementById('no_of_bathrooms').style.borderColor  = '#FF0000';
		document.getElementById("no_of_bathrooms").addEventListener("change", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Property State",document.getElementById("prop_state").value)) {
		document.getElementById("prop_state").focus();
		document.getElementById("error1").innerHTML=(" Please Select Property State* ");
		document.getElementById('prop_state').style.borderColor  = '#FF0000';
		document.getElementById("prop_state").addEventListener("change", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Property City",document.getElementById("selectcity1").value)) {
		document.getElementById("selectcity1").focus();
		document.getElementById("error1").innerHTML=(" Please Select Property City* ");
		document.getElementById('selectcity1').style.borderColor  = '#FF0000';
		document.getElementById("selectcity1").addEventListener("change", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Where did you hear about us ?",document.getElementById("hear_about").value)) {
		document.getElementById("hear_about").focus();
		document.getElementById("error1").innerHTML=(" Please Select Where did you hear about us ?* ");
		document.getElementById('hear_about').style.borderColor  = '#FF0000';
		document.getElementById("hear_about").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("hear_about").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	/*if(isEmpty("Address",document.getElementById("address").value)) {
		document.getElementById("address").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Address* ");
		document.getElementById('address').style.borderColor  = '#FF0000';
		document.getElementById("address").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("address").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(isEmpty("Remark",document.getElementById("prop_remark").value)) {
		document.getElementById("prop_remark").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Remark* ");
		document.getElementById('prop_remark').style.borderColor  = '#FF0000';
		document.getElementById("prop_remark").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("prop_remark").addEventListener("keyup", controlBorderColor, false);
		return false;
	}*/
	if(isEmpty("Captcha",document.getElementById("captcha").value)) {
		document.getElementById("captcha").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Captcha* ");
		document.getElementById("captcha").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("captcha").addEventListener("keyup", controlBorderColor, false);
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
<script>
function getstate(stateID){
	 $.ajax({
			url:'<?=HTACCESS_URL?>propertyController.php?mode=getcity',
			data:'stateID='+stateID,
			success:function(response){
			//alert(response);
			
			$('#selectcity').html(response);
			
		}
		});
}

function getstate1(stateID){
	 $.ajax({
			url:'<?=HTACCESS_URL?>propertyController.php?mode=getcity1',
			data:'stateID='+stateID,
			success:function(response){
			//alert(response);
			
			$('#selectcity1').html(response);
			
		}
		});
}
</script>