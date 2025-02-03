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

login_check();

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info']; // data array sent from form

//mode to add /update Property
if($mode=="add_update_property"){
	
	$info = $_REQUEST['info'];
	
	//code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
	$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
	$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
	$ext = $temp[count($temp)-1]; // get image extension
	
	if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='PNG' && $ext!='png'){ // check image format
	$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
	header('location:index.php?mo=sold_property&id='.$id.'&id='.$id.'&msg='.$msg);
	exit;
	}
		
	$info['image'] = $image_name;

	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."sold_property WHERE id='".$id."'";
	$imgRes = $dbObj->SelectQuery();
	
	if(file_exists(SOLD_PROPERTY_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
		unlink(SOLD_PROPERTY_THUMB_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
		unlink(SOLD_PROPERTY_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
	}
		
	resize_img_new($_FILES['image']['tmp_name'],600,$ext,SOLD_PROPERTY_THUMB_IMAGE_PATH.$image_name); // to resize image and upload it in thumbs folder
	move_uploaded_file($_FILES['image']['tmp_name'],SOLD_PROPERTY_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	if(!empty($id)){
	
	$info['post_date'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'sold_property',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=sold_property&msg='.$msg);
	exit;
	
	} else {
		
	$info['post_date'] = date('Y-m-d');
	$info['display_order'] = 0;
	$id = add_record($dbObj,PREFIX.'sold_property',$info); 
	//echo $dbObj->dbQuery;exit;

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sold_property order by display_order ASC";
	$dbPages = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbPages);$k++){
		$dbObj->dbQuery = "update ".PREFIX."sold_property set display_order='".($k+1)."' where id=".$dbPages[$k]['id'];
		$dbObj->ExecuteQuery();
	}
	
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=sold_property&msg='.$msg);
	exit;
	}
}

//mode to change property status
if($mode=="property_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."sold_property set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete Single Property
if($mode=='delete_single_property'){ 

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."sold_property where id=".$id;
	$dbResult = $dbObj->SelectQuery();
	
	//echo $dbObj->dbQuery;exit;
	for($j=0;$j<count((array)$dbResult);$j++){
	if(file_exists(SOLD_PROPERTY_IMAGE_PATH.$dbResult[$j]['image']) && !empty($dbResult[$j]['image'])){ 
		unlink(SOLD_PROPERTY_THUMB_IMAGE_PATH.$dbResult[$j]['image']); // remove resize image from thumbd folder
		unlink(SOLD_PROPERTY_IMAGE_PATH.$dbResult[$j]['image']); // remove original image form folder
	}
	
	delete_record($dbObj,PREFIX.'sold_property','id='.$dbResult[$j]['id']); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."sold_property where id=".$id;
	$dbProperty = $dbObj->SelectQuery();
		
		for($i=0;$i<count($dbProperty);$i++){
			$dbObj->dbQuery = "update ".PREFIX."sold_property set display_order='".($i+1)."' where id=".$dbProperty[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=sold_property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to change sold property display order
if ($mode == "change_sold_property_order"){
	//echo $_REQUEST['tdata'];
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."sold_property SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}
?>