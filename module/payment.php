<?php 
$lastId = $dbObj->sc_mysql_escape($_REQUEST['lastId'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where id='".$lastId."' and user_id='".$_SESSION['user']['userid']."'";
$dbUserproperty = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."' and status='1'";
$dbUser = $dbObj->SelectQuery();
?>

<body onLoad="document.frm.submit()">
<div class="center-section-in">
  <form action="<?=HTACCESS_URL?>request.php" method="post" name="frm">
    <input type="hidden" name="appId" value="<?=APP_ID?>">
    <input type="hidden" name="orderAmount" value="<?=$dbUserproperty[0]['amount']?>">
    <input type="hidden" name="orderId" value="<?=$dbUserproperty[0]['id']?>">
    <input type="hidden" name="orderCurrency" value="INR">
    <input type="hidden" name="customerName" value="<?=$dbUser[0]['name']?>">
    <input type="hidden" name="customerPhone" value="<?=$dbUser[0]['mobile_no']?>">
    <input type="hidden" name="customerEmail" value="<?=$dbUser[0]['email']?>">
    <input type="hidden" name="returnUrl" value="<?=HTACCESS_URL?>thankyou-billing/">
    <!--<input type="text" name="notifyUrl" value="<?=HTACCESS_URL?>response.php">-->
    <div> 
      <!--<button type="submit" class="btn btn-lg btn-danger btn-inline font-14 text-uppercase"> <span id="payment-button-amount">Make Payment </span>  </button>--> 
    </div>
  </form>
  <div class="clearfix"></div>
</div>
</body>
