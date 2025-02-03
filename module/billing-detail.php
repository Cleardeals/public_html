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
$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbUser[0]['state']."'";
$dbState = $dbObj->SelectQuery();
?>

<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> Billing Detail </h2>
    <form action="<?=HTACCESS_URL?>userController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
      <input type="hidden" name="mode" value="billing">
      <input type="hidden" name="data[for_property]" value="<?=$_SESSION['billing']['for_property'] ?? ""?>">
      <input type="hidden" name="data[property_name]" value="<?=$_SESSION['billing']['property_name'] ?? ""?>">
      <input type="hidden" name="data[property_type]" value="<?=$_SESSION['billing']['property_type'] ?? ""?>">
      <input type="hidden" name="data[no_of_bedrooms]" value="<?=$_SESSION['billing']['no_of_bedrooms'] ?? ""?>">
      <input type="hidden" name="data[no_of_bathrooms]" value="<?=$_SESSION['billing']['no_of_bathrooms'] ?? ""?>">
      <input type="hidden" name="data[state]" value="<?=$_SESSION['billing']['prop_state'] ?? ""?>">
      <input type="hidden" name="data[city]" value="<?=$_SESSION['billing']['prop_city'] ?? ""?>">
      <input type="hidden" name="data[hear_about]" value="<?=$_SESSION['billing']['hear_about'] ?? ""?>">
      <input type="hidden" name="data[amount]" value="<?=$_SESSION['billing']['amount'] ?? ""?>">
      <input type="hidden" name="data[validity]" value="<?=$_SESSION['billing']['validity'] ?? ""?>">
      <!--<input type="hidden" name="appId" value="171558d31a2803ed631c348a455171">-->
      <input type="hidden" name="appId" value="<?=APP_ID?>">
      <input type="hidden" name="orderAmount" value="<?=$_SESSION['billing']['amount'] ?? ""?>">
      <input type="hidden" name="orderCurrency" value="INR">
      <input type="hidden" name="customerName" value="<?=$dbUser[0]['name'] ?? ""?>">
      <input type="hidden" name="customerPhone" value="<?=$dbUser[0]['mobile_no'] ?? ""?>">
      <input type="hidden" name="customerEmail" value="<?=$dbUser[0]['email'] ?? ""?>">
      <input type="hidden" name="returnUrl" value="<?=HTACCESS_URL?>thankyou-billing/">
      <input type="hidden" name="notifyUrl" value="<?=HTACCESS_URL?>response.php">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 row m-0 p-0">
          <?php $name = explode(' ',$_SESSION['billing']['name'] ?? "");?>
          <div class="col-md-6 boder-22">
            <h4 class="mb-2 bg-light p-2">Personal Detail</h4>
            <div class="col">
              <p class="mb-1"> Client Id -
                <?=$dbUser[0]['clientid'] ?? ""?>
              </p>
              <p class="mb-1"> Name -
                <?=$dbUser[0]['name'] ?? ""?>
              </p>
              <p class="mb-1"> Email -
                <?=$dbUser[0]['email'] ?? ""?>
              </p>
              <p class="mb-1"> Mobile -
                <?=$dbUser[0]['mobile_no'] ?? ""?>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-2 bg-light p-2">Billing Address </h4>
            <div class="col">
              <p class="m-0"><strong>
                <?=$dbUser[0]['name'] ?? ""?>
                </strong><br />
                <?php if(!empty($dbUser[0]['address'])){?>
                <?=$dbUser[0]['address'] ?? ""?>
                <br />
                <?php }?>
                <?=$dbUser[0]['city'] ?? ""?>
                <?php if(!empty($dbUser[0]['state'])){?>
                ,
                <?=$dbState[0]['state_name'] ?? ""?>
                <?php }?>
                <?php if(!empty($dbUser[0]['country'])){?>
                ,<br />
                <?=$dbUser[0]['country'] ?? ""?>
                <br />
                <?php }?>
              </p>
            </div>
          </div>
          <?php
		  $prop_state = $_SESSION['billing']['prop_state'] ?? "";
          $dbObj->dbQuery="select * from ".PREFIX."state where id='".$prop_state."'";
		  $dbpropState = $dbObj->SelectQuery();
		  $billingAdd = $_SESSION['billing']['add'] ?? "";
		  ?>
          <div class="col-md-12">
            <h4 class="mb-2 bg-light p-2 mt-3">Property Detail</h4>
            <div class="col">
              <?php if($billingAdd=='2'){?>
              <p class="mb-1">Property Address -
                <?=$_SESSION['billing']['prop_add'] ?? ""?>
              </p>
              <?php }?>
              
              <!--<p class="mb-1">Form No - <? //=$_SESSION['billing']['form_no']?></p>-->
              
              <p class="mb-1">Property Name -
                <?=$_SESSION['billing']['property_name'] ?? ""?>
              </p>
              <p class="mb-1">Property Type -
                <?=$_SESSION['billing']['property_type'] ?? ""?>
              </p>
              <p class="mb-1">No. of Bedroom -
                <?=$_SESSION['billing']['no_of_bedrooms'] ?? ""?>
              </p>
              <p class="mb-1">No. of Bathrooms -
                <?=$_SESSION['billing']['no_of_bathrooms'] ?? ""?>
              </p>
              <p class="mb-1">State -
                <?=$dbpropState[0]['state_name'] ?? ""?>
              </p>
              <p class="mb-1">City -
                <?=$_SESSION['billing']['prop_city'] ?? ""?>
              </p>
              
              <!--<p class="mb-1">Overlooking - <? //=$_SESSION['billing']['overlooking']?></p>-->
              
              <p class="mb-1">Where did you hear about us -
                <?=$_SESSION['billing']['hear_about'] ?? ""?>
              </p>
              
              <!--   <p class="mb-1">Remark - <? //=$_SESSION['billing']['prop_remark']?></p>--> 
              
            </div>
          </div>
          <div class="col-md-12 text-center mt-3">
            <div class="form-group">
              <input type="submit" class="btn btn-primary subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 submit2" value="Make Payment">
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
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