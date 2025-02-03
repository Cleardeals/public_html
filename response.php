<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
	<?php  
		 //$secretkey = "7a52bd4a6f6033b6146999dd8501b68f92b0ce15";
		 $secretkey = SECRET_KEY;
		 $orderId = $_POST["orderId"];
		 $orderAmount = $_POST["orderAmount"];
		 $referenceId = $_POST["referenceId"];
		 $txStatus = $_POST["txStatus"];
		 $paymentMode = $_POST["paymentMode"];
		 $txMsg = $_POST["txMsg"];
		 $txTime = $_POST["txTime"];
		 $signature = $_POST["signature"];
		 $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
		 $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
		 $computedSignature = base64_encode($hash_hmac);
		 //if ($signature == $computedSignature) {
			 
			 $info['orderAmount'] = $orderAmount;
$info['referenceId'] = $referenceId;
$info['txStatus'] = $txStatus;
$info['paymentMode'] = $paymentMode;
$info['txTime'] = $txTime;
$info['signature'] = $signature;
modify_record($dbObj,PREFIX.'user_property_detail',$info,'id='.$orderId);
	 ?>
	<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<!-- Header -->
<div class="center-section-in">
  <header class="masthead2">
    <div class="container text-center mt-10">
      <h2 class="mb-1 blue-text" style="font-size:34px;">Thanks for your billing </h2>
      <div class="clearfix"></div>
      <br />
      
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>