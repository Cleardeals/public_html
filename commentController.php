<?php
ob_start(); //To start output buffering
session_start(); //To start new or existing session

require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
$dbObj = new DBConnection();// database connection object

//$info = $_REQUEST['info'] ?? ""; // data array sent from form
$mode = $_REQUEST['mode'] ?? "";

if($mode=="blog_comment"){
	//echo $_REQUEST['comment'];exit;
	/*if(!isset($_SESSION['user']['is_login'])){
		$_SESSION['msg'] = base64_encode("Please Login.");
		header("location:".HTACCESS_URL."sign-up"."/");
		exit;
		}*/
		
	date_default_timezone_set('Asia/kolkata');
	$info['comment'] = $dbObj->sc_mysql_escape($_REQUEST['comment'] ?? "");
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name'] ?? "");
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email'] ?? "");
	$info['status'] = 0;
	$info['comment_date'] = date('Y-m-d H:i:s');
	$info['blog_id'] = $dbObj->sc_mysql_escape($_REQUEST['blog_id'] ?? "");
	$info['user_id'] = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	add_record($dbObj,PREFIX."blog_comment",$info);
	//echo $dbObj->dbQuery;exit;
	
	//$_SESSION['comment_msg'] = base64_encode('Comment display after admin approvel.');
	//header('location:'.HTACCESS_URL.'blog-detail/'.$dbObj->sc_mysql_escape($commentId[0]['url']).'/');
	header('location:'.HTACCESS_URL.'thankyou-comment/');
	exit;
}

if($mode=="blog_contact_us"){ 
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name'] ?? "");
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email'] ?? "");
	$info['city'] =  $dbObj->sc_mysql_escape($_REQUEST['city'] ?? "");
	$info['service'] = $dbObj->sc_mysql_escape($_REQUEST['service'] ?? ""); 
	$info['mobile'] = $dbObj->sc_mysql_escape($_REQUEST['mobile'] ?? "");  

	add_record($dbObj,PREFIX."blog_contact_us",$info);
	//echo $dbObj->dbQuery;exit;
	
	//$_SESSION['comment_msg'] = base64_encode('Comment display after admin approvel.');
	//header('location:'.HTACCESS_URL.'blog-detail/'.$dbObj->sc_mysql_escape($commentId[0]['url']).'/');
	header('location:'.HTACCESS_URL.'thank-you-request/');
	exit;
}

if($mode=="valuation_comment"){
//echo $_REQUEST['comment'];exit;
/*if(!isset($_SESSION['user']['is_login'])){
	$_SESSION['msg'] = base64_encode("Please Login.");
	header("location:".HTACCESS_URL."sign-up"."/");
	exit;
	}*/
	
	date_default_timezone_set('Asia/kolkata');
	$info['comment'] = $dbObj->sc_mysql_escape($_REQUEST['comment'] ?? "");
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name'] ?? "");
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email'] ?? "");
	$info['status'] = 0;
	$info['comment_date'] = date('Y-m-d H:i:s'); 
	
	add_record($dbObj,PREFIX."valuation_comment",$info);
	//echo $dbObj->dbQuery;exit;
	
	//$_SESSION['comment_msg'] = base64_encode('Comment display after admin approvel.');
	//header('location:'.HTACCESS_URL.'blog-detail/'.$dbObj->sc_mysql_escape($commentId[0]['url']).'/');
	header('location:'.HTACCESS_URL.'thankyou-comment/');
	exit;
}
	
?>