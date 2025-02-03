<?php 
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php');
$dbObj = new DBConnection(); // database connection object

$info = $_REQUEST['info'] ?? ""; // data array sent from form
$mode = $_REQUEST['mode'] ?? ""; 
$id = $_REQUEST['id'] ?? ""; 
$from = $_REQUEST['from'] ?? "";
?>
<style type="text/css">
#headerbox1 {
	z-index:100;
	overflow:hidden;
	top:0px;
	left:0;
	width:100%;
	margin-top:200px;
}
.headerdiv {
	text-align: center;
}
.logo {
	float:none;
	height:72px;
	width: auto;
}
</style>
<body onLoad="document.frm1.submit()">
<!--<body>-->
<title style="color:#FFF;"></title>
<div id="headerbox1">
  <div id="header">
    <div class="headerdiv">
      <div class="logo"><img src="<?=HTACCESS_URL?>assets/img/logo.png" alt="" /></div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<div class="clear"></div>
<div id="main-div" style="padding-top:50px;">
  <div id="middle">
    <div align="center" class="product-shop">
      <h1 style="color:#000; font-size:25px">Thank You For Your Order</h1>
      <br />
      <h1 style="color:#000; font-size:15px;">Now loading the Secure Payment Page.</h1>
    </div>
    
    <?php
/*$data = $_REQUEST['data'];
		
$user_id = $_SESSION['user']['userid'];

modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$user_id);
//echo $dbObj->dbQuery;exit;

$data['user_id'] = $user_id;
$data['pay_status'] = 'Unpaid';
$data['post_date'] = date('Y-m-d');
//exit;
$lastId = add_record($dbObj,PREFIX.'user_property_detail',$data);*/
//echo $dbObj->dbQuery;
//unset($_SESSION['billing']);
//$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_property_detail where id='".$lastId."'";
//$dbUserDetail = $dbObj->SelectQuery();

//$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail where id='".$dbUserDetail[0]['user_id']."'";
//$dbUser = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;exit;


	
	
$mode = "PROD"; //<------------ Change to TEST for test server, PROD for production
//$mode = "TEST";
//echo $dbUserDetail[0]['amount'];
extract($_POST);
  $secretKey = SECRET_KEY;
  $postData = array( 
  //"appId" => "171558d31a2803ed631c348a455171", 
  "appId" => $appId, 
  "orderId" => $orderId, 
  "orderAmount" => $orderAmount, 
  "orderCurrency" => $orderCurrency, 
  //"orderNote" => $orderNote, 
  "customerName" => $customerName, 
  "customerPhone" => $customerPhone, 
  "customerEmail" => $customerEmail,
  "returnUrl" => $returnUrl, 
  //"notifyUrl" => $notifyUrl,
);
ksort($postData);
$signatureData = "";
foreach ($postData as $key => $value){
    $signatureData .= $key.$value;
}
$signature = hash_hmac('sha256', $signatureData, $secretKey,true);
$signature = base64_encode($signature);

if ($mode == "PROD") {
  $url = "https://www.cashfree.com/checkout/post/submit";
} else {
  $url = "https://test.cashfree.com/billpay/checkout/post/submit";
}

	?>
    
  <form action="<?php echo $url; ?>" name="frm1" method="post">
      <!--<p>Please wait.......</p>-->
      <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
      <!--<input type="text" name="orderNote" value='<?php echo $orderNote; ?>'/>-->
      <input type="hidden" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
      <input type="hidden" name="customerName" value='<?php echo $customerName; ?>'/>
      <input type="hidden" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
      <input type="hidden" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
      <input type="hidden" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
     <!-- <input type="text" name="notifyUrl" value='<?php echo $notifyUrl; ?>'/>-->
      <input type="hidden" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
      <input type="hidden" name="appId" value='<?php echo $appId; ?>'/>
      <input type="hidden" name="orderId" value='<?php echo $orderId; ?>'/>
  </form>
    </div>
</div>  
</body>
</html>
