<?php
ob_start();
session_start();
require_once('../config.php');
require_once(MYSQL_CLASS_DIR.'DBConnection.php');
require_once(PHP_FUNCTION_DIR.'function.database.php');
require_once(PHP_FUNCTION_DIR.'function.image.php');
$dbObj = new DBConnection();

login_check();

$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");

if(isset($_FILES["myfile"]))
{
	$ret = array();
//echo "abc";exit;
	$error = $_FILES["myfile"]["error"];
   {
	if(!is_array($_FILES["myfile"]['name'])) //single file
	{
	$RandomNum  = time();

	$ImageName = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
	$ImageType = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.

	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt = str_replace('.','',$ImageExt);
	$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
				
	resize_img_new($_FILES['myfile']['tmp_name'],600,$ImageExt,PROPERTY_THUMB_IMAGE_PATH.$NewImageName); // to resize image and upload it in thumbs folder
	//resize_img_new($_FILES['myfile']['tmp_name'],223,PAGE_MID_IMAGE_PATH.$NewImageName,$ImageExt,$ImageExt); // to resize image and upload it in thumbs folder
	move_uploaded_file($_FILES["myfile"]["tmp_name"],PROPERTY_IMAGE_PATH.$NewImageName);
	//echo "<br> Error: ".$_FILES["myfile"]["error"];
	$info['property_id'] = $property_id;//exit;
	$info['image']= $NewImageName;
	//echo $info['image'];exit;
	
	$info['front_status'] = "0";
	$info['status'] = "1";
	$info['display_order'] = '0';
	//$info['status'] = "0";
	add_record($dbObj,PREFIX.'property_images',$info); 
	//echo $dbObj->dbQuery;exit;

	$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$property_id."' order by display_order ASC";
	$order = $dbObj->SelectQuery();
	
	for($i=0;$i<count((array)$order);$i++){
		$dbObj->dbQuery = "update ".PREFIX."property_images set display_order='".($i+1)."' where  property_id='".$property_id."' and id=".$order[$i]['id'];
		$dbObj->ExecuteQuery();
	}
			
	} else {
		
		$fileCount = count($_FILES["myfile"]['name']);
		for($i=0; $i < $fileCount; $i++)
		{
		$RandomNum   = time();

		$ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
		$ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.

		$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
		
		$info['property_id'] = $property_id;
		$info["image"]= $NewImageName;
		$info['front_status'] = "0";
		$info['status'] = "1";
		$info['display_order'] = "0";
		
		add_record($dbObj,PREFIX.'property_images',$info); 
		//echo $dbObj->dbQuery;exit;
				
			$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$property_id."' order by display_order ASC";
			$order = $dbObj->SelectQuery();
		
			for($i=0;$i<count((array)$order);$i++){
				$dbObj->dbQuery = "update ".PREFIX."property_images set display_order='".($i+1)."' where property_id='".$property_id."' and id=".$order[$i]['id'];
				$dbObj->ExecuteQuery();
			}
			
			resize_img_new($_FILES['myfile']['tmp_name'],600,$ImageExt,PROPERTY_THUMB_IMAGE_PATH.$NewImageName); // to resize image and upload it in thumbs folder
			//resize_img_new($_FILES['myfile']['tmp_name'],223,PAGE_MID_IMAGE_PATH.$NewImageName,$ImageExt); // to resize image and upload it in thumbs folder
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],PROPERTY_IMAGE_PATH.$NewImageName );
		}
	}
	}
	
	}

?>