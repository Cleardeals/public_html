<?php

ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
$dbObj = new DBConnection(); // database connection


if (isset($_POST['image'])) {
    $imageData = $_POST['image'];

    // Remove the "data:image/png;base64," part
    $imageData = str_replace('data:image/octet-stream;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // Decode the base64 string
    $image = base64_decode($imageData);

    // Set the directory where you want to save the image
    $directory = $_SERVER['DOCUMENT_ROOT'].'/calc/';
    $newFilename = 'property-chart-' . time() . '.png';
    $filePath = $directory . $newFilename;
	
	$flatid = $_POST['flatid'];
	if (isset($_POST['flatid'])) {
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."calc where id='".$flatid."'";
		$dbcheck = $dbObj->SelectQuery();
		
		if(empty($dbcheck[0]['image_name'])){
			$dbObj->dbQuery = "update ".PREFIX."calc set image_name='".basename($filePath)."' where id='".$flatid."'";
	    	$dbObj->ExecuteQuery();
			
			// Save the image to the server
    		file_put_contents($filePath, $image);
		}
		
	}
	 

    echo 'Image saved successfully as: ' .basename($filePath);
	//echo $_SESSION['predictedPrice'];
} else {
    echo 'No image data found!';
}

?>
