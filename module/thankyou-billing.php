<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$secretkey = SECRET_KEY;
$orderId = $dbObj->sc_mysql_escape($_POST["orderId"] ?? "");
$orderAmount = $dbObj->sc_mysql_escape($_POST["orderAmount"] ?? "");
$referenceId = $dbObj->sc_mysql_escape($_POST["referenceId"] ?? "");
$txStatus = $dbObj->sc_mysql_escape($_POST["txStatus"] ?? "");
$paymentMode = $dbObj->sc_mysql_escape($_POST["paymentMode"] ?? "");
$txMsg = $dbObj->sc_mysql_escape($_POST["txMsg"] ?? "");
$txTime = $dbObj->sc_mysql_escape($_POST["txTime"] ?? "");
$signature = $dbObj->sc_mysql_escape($_POST["signature"] ?? "");
$data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
$hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
$computedSignature = base64_encode($hash_hmac);
//if ($signature == $computedSignature) {

//$info['orderAmount'] = $orderAmount;
if($txStatus=='SUCCESS'){
$info['pay_status'] = 'Paid';	
}
$info['referenceId'] = $referenceId;
//$info['txStatus'] = $txStatus;
$info['paymentMode'] = $paymentMode;
$info['txTime'] = $txTime;
$info['signature'] = $signature;
modify_record($dbObj,PREFIX.'user_property_detail',$info,'id='.$orderId);

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where id='".$orderId."'";
$dbOrder = $dbObj->SelectQuery();

if($dbOrder[0]['pay_status']=='Paid'){

 include("email.php");
 
}

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