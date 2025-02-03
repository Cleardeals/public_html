<?php 
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('../config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php'); // to use database function
$dbObj = new DBConnection();// database connection object

$action = mysql_real_escape_string($_POST['action']); 
$updateRecordsArray = $_POST['recordsArray'];

if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE ".PREFIX."category SET recordListingID = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}

    }
?>