<?php
ob_start();
session_start();
require_once('config.php');// inlclude config file 

require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection

require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function

include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query

include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query

require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image

require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image

//require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail  

require("/home/cleardealsconi/public_html/classes/php_functions/class.phpmailer.php");



$dbObj = new DBConnection(); // database connection object 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="https://cleardeals.authlink.me/js/sdk/otpless.js"></script>
</head>

<body>


 <button id="whatsapp-login"/>

<script type="text/ecmascript">
function otpless() {

const waId = otplessWaId();

// Once you signup/sign a user, you can redirect the user to your signup/signin flow.

 
//window.open("https://cleardeals.co.in/", "_self")

}
</script>
 
 
<?php

//echo $_SESSION['wid'];
if(!empty($_REQUEST['waId'])){
	//$_SESSION['wid'] = $_REQUEST['waId'];
	
	$url = "https://cleardeals.authlink.me";
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
	$headers = array(
	   "clientId: 7rollnr9",
	   "clientSecret: meeq6baiv9agi6um",
	   "Content-Type: application/json",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
	$data = json_encode(array(
	"waId"  => $_REQUEST['waId']
	 
	));
	
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
	$resp = curl_exec($curl);
	curl_close($curl);
	//echo $resp;
	$obj = json_decode($resp, true);;
	$userstatusCode = $obj['statusCode'];
	$user = $obj['data'];
	$userstatus = $obj['status'];
	$useruserMobile = substr($user['userMobile'],2);
	$useruserName = $user['userName'];
	 
	if($userstatusCode=='200' && $userstatus='SUCCESS' ){
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE mobile_no='".$useruserMobile."'";
		$dbUserCheck = $dbObj->SelectQuery();
		
		if(count($dbUserCheck)>0){
			$_SESSION['user']['is_login'] = 1;
	
			$_SESSION['user']['username'] = $dbUserCheck[0]['username'];
	
			$_SESSION['user']['userid'] = $dbUserCheck[0]['id'];
	
			$_SESSION['user']['clientid'] = $dbUserCheck[0]['clientid'];
	
	
	
			//unset($_SESSION['login']);
	
			header('location:'.HTACCESS_URL.'dashboard/');
	
			exit;
		} else {
		
			$info['name'] = $_REQUEST['name'];
			$info['mobile_no'] = $_REQUEST['mobile_no'];
			$info['username'] = $_REQUEST['username'];
			$info['user_type'] = 'Buyer';
			$info['status'] = '1';
			$info['datetime'] = date('Y-m-d H:i:s');
			
			$client_id = add_record($dbObj,PREFIX.'user_detail',$info);
			
			$znum = sprintf("%04s", $client_id);
			$clientid = "CLR".$znum."";//exit;
			
			$dbObj->dbQuery = "update ".PREFIX."user_detail set clientid='".$clientid."' where id='".$client_id."'";
			$dbObj->ExecuteQuery();
			
			$_SESSION['user']['is_login'] = 1;
	
			$_SESSION['user']['username'] = $dbUserCheck[0]['username'];
	
			$_SESSION['user']['userid'] = $dbUserCheck[0]['id'];
	
			$_SESSION['user']['clientid'] = $dbUserCheck[0]['clientid'];
			
			header('location:'.HTACCESS_URL.'dashboard/');
	
			exit;
		
		}
		
	} else {
		header('Location:'.HTACCESS_URL);
		exit;	
	}
	 
	
	
	
	
} 
?>
</body>
</html>
