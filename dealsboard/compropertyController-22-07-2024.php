<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once '../excel_reader/excel_reader.php';
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
$dbObj = new DBConnection(); // database connection

login_check();

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
//$info = $_REQUEST['info']; // data array sent from form

if($mode=="getcity"){
	
	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID']);
	
	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."city where state_id='".$stateID."'"; // for listing of records
	$dbcities = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dbcities);exit;
	
	$data='<option value="">City</option>';
	for($i=0;$i<count((array)$dbcities);$i++){
		if(!empty($stateID) && ($dbcities[$i]['city_name']==$stateID)){
		$data.='<option value="'.$dbcities[$i]['city_name'].'" selected >'.$dbcities[$i]['city_name'].'</option>';
		} else{
        	$data.='<option value="'.$dbcities[$i]['city_name'].'" >'.$dbcities[$i]['city_name'].'</option>';
		}
    }
	echo $data;
	exit;
}


//mode to get location
if($mode=="getlocation"){
	
	$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID']);
	
	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityID."'"; // for listing of records
	$dblocation = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dblocation);exit;
	
	$data='<option value="">Location</option>';
	for($i=0;$i<count((array)$dblocation);$i++){
		if(!empty($cityID) && ($dblocation[$i]['location']==$cityID)){
		$data.='<option value="'.$dblocation[$i]['location'].'" selected>'.$dblocation[$i]['location'].'</option>';
		} else{
        	$data.='<option value="'.$dblocation[$i]['location'].'">'.$dblocation[$i]['location'].'</option>';
		}
    }
	echo $data;
	exit;
}


//mode to add /update Property
if($mode=="add_update_property"){
	
	$info = $_REQUEST['info'];
	$data = $_REQUEST['data'];
	if(!empty($_REQUEST['pricerequest'])){
		$pricerequest = $dbObj->sc_mysql_escape($_REQUEST['pricerequest'] ?? "");
		$data['pricerequest'] = $pricerequest;
		
	} else {
		$data['pricerequest'] = 0;
	}
	//$adata = $_REQUEST['adata'];
	
	//echo $_REQUEST['sell_google_map'];
	//echo $_REQUEST['rent_google_map'];exit;
	if($info['for_property']=='Rent'){
		$data['google_map'] = $dbObj->sc_mysql_escape($_REQUEST['rent_google_map']);
	}
	
	if($info['for_property']=='Sell'){
		$data['google_map'] = $dbObj->sc_mysql_escape($_REQUEST['sell_google_map']);
	}
	
	if(!empty($data['offer_price'])){
		$data['offer_price'] = $dbObj->sc_mysql_escape($data['offer_price']);
	}else{
		$data['offer_price'] = 0;	
	}
	
	if(!empty($data['offer_price_unit'])){
		$data['offer_price_unit'] = $dbObj->sc_mysql_escape($data['offer_price_unit']);
	}else{
		$data['offer_price_unit'] = NULL;	
	}
	
	$amenities = $_REQUEST['amenities'] ?? "";
	for($i=0;$i<count((array)$amenities);$i++){
		$amts .= $amenities[$i].',';
	}
	
	$data['amenities'] = $amts;
	
	$amenity = $_REQUEST['amenity'];
	if(!empty($_REQUEST['amenity'])){
		$data['otheramenities'] = $amenity;
		/*$amt = 	explode(',',$amenity);
		for($i=0;$i<count($amt);$i++){
			
			$dbObj->dbQuery = "SELECT * FROM ".PREFIX."amenities WHERE amenities='".$amt[$i]."'";
			$dbAmen = $dbObj->SelectQuery();
			
			if(count((array)$dbAmen)>0) {
			}else{
			if(!empty($amt[$i])){
				$gh['amenities'] = trim($amt[$i]);
				add_record($dbObj,PREFIX.'amenities',$gh); 
				//echo $dbObj->dbQuery;exit;  
			}
			}
			
		}*/
	} 
	
	/*$kitchendetail = $_REQUEST['kitchen_detail'];
	
	for($i=0;$i<count((array)$kitchendetail);$i++){
		$kitch .= $kitchendetail[$i].',';
	}
	$data['kitchen_detail'] = $kitch;*/
	
	$overlooking = $_REQUEST['overlooking'] ?? "";
	$overl = $_REQUEST['overl'] ?? "";
	for($i=0;$i<count((array)$overlooking);$i++){
		$overl .= $overlooking[$i].',';
	}
	$data['overlooking'] = $overl;
	//exit;
	
	$some_features = $_REQUEST['some_features'] ?? "";
	for($i=0;$i<count((array)$some_features);$i++){
		$someFeatures .= $some_features[$i].',';
	}
	$data['some_features'] = $someFeatures;
	
	//upload brochure
	/*if(isset($_FILES['brochure']) && $_FILES['brochure']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['brochure']['name']); // to remane image
		$temp = explode('.',$_FILES['brochure']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		
		
		if($ext!='pdf' && $ext!='PDF' && $ext!='doc' && $ext!='DOC' && $ext!='docx' && $ext!='DOCX'){ // check image format
		//echo "9";
		$msg=base64_encode('Please Select PDF/Doc Files.'); // message about action performed
		header('location:index.php?mo=add_com_property&msg='.$msg);
		exit;
		}

		$data['brochure'] = $image_name;
		
		move_uploaded_file($_FILES['brochure']['tmp_name'],PROPERTY_BROCHURE.$image_name);
		
	}*/
	if(!empty($_REQUEST['main_charges'])){

		$data['main_charges'] = $dbObj->sc_mysql_escape($_REQUEST['main_charges']);

	}else{

		$data['main_charges'] = 0;

	}
	
	if(!empty($id)){
		
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_detail where property_id='".$id."'";
	$dbPropDetail = $dbObj->SelectQuery();
	
	$dbObj->dbQuery = "select * from ".PREFIX."appliances where property_id='".$id."'";
	$dbAppliances = $dbObj->SelectQuery();
	
	$info['prop_date'] = date('Y-m-d', strtotime($dbObj->sc_mysql_escape($_REQUEST['prop_date'])));
	modify_record($dbObj,PREFIX.'com_property',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
	
	if(!empty($dbPropDetail)){
	//$data['post_date'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'com_property_detail',$data,'property_id='.$id);
	//echo $dbObj->dbQuery;exit;
	}else{
	$data['property_id'] = $id;
	$data['post_date'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'com_property_detail',$data);
	//echo $dbObj->dbQuery;exit;
	}
	
	/*if(!empty($dbAppliances)){
	modify_record($dbObj,PREFIX.'com_appliances',$adata,'property_id='.$id);
	//echo $dbObj->dbQuery;exit;
	}else{
	$adata['property_id'] = $id;
	add_record($dbObj,PREFIX.'com_appliances',$adata);
	}*/
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=com_property&msg='.$msg);
	exit;
	
	} else {
	
	$property_name = $dbObj->sc_mysql_escape($info['property_name']);
	$dbObj->dbQuery = "select * from ".PREFIX."com_property where property_name='".$property_name."' order by id desc";
		if(!empty($id)){
			$dbObj->dbQuery .= "and id = $id";
		}
		$Res1 = $dbObj->SelectQuery();
		if(count((array)$Res1)>0){
			$i = $Res1[0]['id'];
			$catname1 = str_replace(' ','-',just_clean($property_name));
			$info['url'] = $catname1.'-'.($i+1);
		} else {
			$info['url'] = str_replace(' ','-',just_clean($property_name));
		}
	$info['prop_date'] = date('Y-m-d', strtotime($dbObj->sc_mysql_escape($_REQUEST['prop_date'])));
	$info['display_order'] = 0;
	$id = add_record($dbObj,PREFIX.'com_property',$info); 
	//echo $dbObj->dbQuery;//exit;
	
	if(empty($data['offer_price'])){
		$data['offer_price'] = 0;
	}
	
	$data['property_id'] = $id;
	$data['post_date'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'com_property_detail',$data); 
	//echo $dbObj->dbQuery;//exit;

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."com_property order by display_order ASC";
	$dbPages = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbPages);$k++){
		$dbObj->dbQuery = "update ".PREFIX."com_property set display_order='".($k+1)."' where id=".$dbPages[$k]['id'];
		$dbObj->ExecuteQuery();
	}
	
	//$adata['property_id'] = $id;
	//add_record($dbObj,PREFIX.'com_appliances',$adata); 
	//echo $dbObj->dbQuery;
	//exit;
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=com_property&msg='.$msg);
	exit;
	}
}

//mode to change property status
if($mode=="property_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."com_property set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete Property
if($mode=='delete_property'){  //to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  //array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=com_property&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'com_property','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'com_property_detail','property_id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images where property_id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(PROPERTY_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(PROPERTY_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(PROPERTY_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}	
	
	delete_record($dbObj,PREFIX.'com_property_images','property_id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."com_property where id=".$id;
	$dbProperty = $dbObj->SelectQuery();
		
		for($i=0;$i<count($dbProperty);$i++){
			$dbObj->dbQuery = "update ".PREFIX."com_property set display_order='".($i+1)."' where id=".$dbProperty[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=com_property&id='.$id.'&msg='.$msg);
	exit;	
}


//mode to delete Single Property
if($mode=='delete_single_com_property'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images where property_id=".$id;
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	
	for($j=0;$j<count((array)$dbResult);$j++){
	   
	if(file_exists(PROPERTY_IMAGE_PATH.$dbResult[$j]['image']) && !empty($dbResult[$j]['image'])){ 
		unlink(PROPERTY_THUMB_IMAGE_PATH.$dbResult[$j]['image']); // remove resize image from thumbd folder
		unlink(PROPERTY_IMAGE_PATH.$dbResult[$j]['image']); // remove original image form folder
	}	
	
	delete_record($dbObj,PREFIX.'com_property_images','property_id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	if(file_exists(PROPERTY_BROCHURE.$dbProDetail[0]['brochure']) && !empty($dbProDetail[0]['brochure'])){ 
		unlink(PROPERTY_BROCHURE.$dbProDetail[0]['brochure']); // remove resize image from thumbd folder
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_detail where property_id=".$id;
	$dbProDetail = $dbObj->SelectQuery();
	
	delete_record($dbObj,PREFIX.'com_property_detail','property_id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'com_property','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."com_property where id=".$id;
	$dbProperty = $dbObj->SelectQuery();
		
	for($i=0;$i<count($dbProperty);$i++){
		$dbObj->dbQuery = "update ".PREFIX."com_property set display_order='".($i+1)."' where id=".$dbProperty[$i]['id'];
		$dbObj->ExecuteQuery();
		//echo $dbObj->ExecuteQuery;exit;
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=com_property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete Admin Property
if($mode=='delete_admin_property'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);//exit;  // array of selected record ids to delete
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."com_property set admin_del='1' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=com_property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to Property Restore
if($mode=='property_restore'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);//exit;  // array of selected record ids to delete
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."com_property set admin_del='0' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Restore Successfully."); // message about action performed
	header('location:index.php?mo=com_property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete deleted Property
if($mode=='delete_deleted_property'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'com_property','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'com_property_detail','property_id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images where property_id=".$id;
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	
	if(file_exists(PROPERTY_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(PROPERTY_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(PROPERTY_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}	
	
	delete_record($dbObj,PREFIX.'com_property_images','property_id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."com_property where id=".$id;
	$dbProperty = $dbObj->SelectQuery();
		
		for($i=0;$i<count($dbProperty);$i++){
			$dbObj->dbQuery = "update ".PREFIX."com_property set display_order='".($i+1)."' where id=".$dbProperty[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=deleted_com_property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to change property display order
if($mode == "change_property_order"){
	//echo $_REQUEST['tdata'];
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."com_property SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}


//for set order
$updateRecordsArray = $_POST['recordsArray'];
$action = mysqli_real_escape_string($dbObj->connection, $_POST['action']);
$list = mysqli_real_escape_string($dbObj->connection, $_POST['list']);
$count = mysqli_real_escape_string($dbObj->connection, $_POST['count']);
$page_limit = mysqli_real_escape_string($dbObj->connection, $_POST['page_limit']);
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
if ($action == "change_property_images_order"){
	
	$listingCounter = $list;
	foreach ($updateRecordsArray as $recordIDValue) {
		
	$query = "UPDATE ".PREFIX."com_property_images SET display_order = " . $listingCounter . " WHERE property_id='".$property_id."' and id = " . $recordIDValue;
	mysqli_query($dbObj->connection, $query) or die('Error, update query failed');
	$listingCounter = $listingCounter + 1;	
	}
?>
<?php
	$dbObj->dbQuery="select * from ".PREFIX."com_property_images WHERE property_id='".$property_id."'"; // to show all records
    $dbObj->dbQuery.=" order by display_order asc $page_limit";

    $dbImages = $dbObj->SelectQuery();
    $list = $dbImages[0]['display_order'];
    $cntH = count($dbImages);

	//$count= count($dbpackages);
	for($i=0;$i<$cntH;$i++){                    
		if($i%2==0){
			$bgcolor = '#f2f2f2';
		} else {
			$bgcolor = '#fafafa';
		} ?>

    <li id="recordsArray_<?=$dbImages[$i]['id']?>">
      <table background="#FFF" class="mws-datatable-fn mws-table" id="sample_editable_1">
        <tr style="background-color:<?=$bgcolor?>" id="move">
          <td valign="top" style="text-align:center" width="5%">
          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbImages[$i]['id']?>">
          </td>
          <td valign="top" id="move" width="10%">
          <img src="../cms_images/property/thumb/<?=$dbImages[$i]['image']?>" width="150"/>
          </td>
          <td valign="top" align="center" width="10%"><?=$dbImages[$i]['display_order']?></td>
          <td valign="top" align="center" width="10%">
          <input type="checkbox" id="s<?=$i+1?>"  <?=($dbImages[$i]['front_status']==1)?'checked':''?> onclick="product_image_status(<?=$dbImages[$i]['id']?>,this.value,this.checked)" value="<?=$dbImages[$i]['id']?>"></td>
          <td valign="top" align="center" width="8%">
          <input type="checkbox" id="s<?=$i+1?>"  <?=($dbImages[$i]['status']==1)?'checked':''?> onclick="product_image_status(<?=$dbImages[$i]['id']?>,this.value,this.checked)" value="<?=$dbImages[$i]['id']?>"></td>
          <td valign="top" align="center" width="8%">
          <a href="index.php?mo=com_property_images&pid=<?=$property_id?>&property_id=<?=$dbImages[$i]['id']?>">
          <i class="icon-pencil"></i></a></td>
        </tr>
      </table>
    </li>      
	<?php } 
}


//mode to update property images
if($mode=="update_property_images"){ 
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	
	if($_FILES['image']['size']==0 && empty($id)){ // check for empty record
	$msg = base64_encode("Please Select A Image To Upload."); // message about action performed
	header('location:index.php?mo=com_property_images&property_id='.$property_id.'&id='.$id.'&msg='.$msg);
	exit;
	}
	
	// code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
	$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
	$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
	$ext = $temp[count($temp)-1]; // get image extension
	
	if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='PNG' && $ext!='png'){ // check image format
	$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
	header('location:index.php?mo=com_property_images&property_id='.$property_id.'&id='.$id.'&msg='.$msg);
	exit;
	}
		
	$info['image'] = $image_name;

	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images WHERE id='".$id."'";
	$imgRes = $dbObj->SelectQuery();
	
	if(file_exists(PROPERTY_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
		unlink(PROPERTY_THUMB_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
		unlink(PROPERTY_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
	}
		
	resize_img_new($_FILES['image']['tmp_name'],600,PROPERTY_THUMB_IMAGE_PATH.$image_name,$ext); // to resize image and upload it in thumbs folder
	move_uploaded_file($_FILES['image']['tmp_name'],PROPERTY_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	//$info['modify_at'] = date('Y-m-d h:i:s');
	//$info['modify_by'] = $_SESSION['srgit_cms_admin_id'];
	
	modify_record($dbObj,PREFIX.'com_property_images',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=com_property_images&property_id='.$property_id.'&msg='.$msg);
	exit;
}

//mode to change property front image status
if($mode=="front_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."com_property_images set front_status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to change property image status
if($mode=="pro_image_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."com_property_images set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete property images
if($mode=="delete_property_images"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']); //array of selected record ids to delete
 	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=com_property_images&property_id='.$property_id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count((array)$id);$i++){
		
	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images where id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(PROPERTY_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(PROPERTY_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(PROPERTY_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}	
	
	delete_record($dbObj,PREFIX.'com_property_images','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
	
	$dbObj->dbQuery = "select * from ".PREFIX."com_property_images where id='".$id."' order by display_order asc";
	$dbResult1 = $dbObj->SelectQuery();
	
	for($k=0;$k<count((array)$dbResult1);$k++){
		$dbObj->dbQuery = "update ".PREFIX."com_property_images set display_order='".($k+1)."' where property_id='".$property_id."' and id=".$dbResult1[$k]['id'];
	    $dbObj->ExecuteQuery();
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=com_property_images&property_id='.$property_id.'&msg='.$msg);
	exit;	
}

//mode to import property
if($mode=="import_property"){
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	
	/*$dbObj->dbQuery = "TRUNCATE TABLE ".PREFIX."price_list" ;
	$dbRes = $dbObj->ExecuteQuery('banner.php','get_detail()');*/
	
	//code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_xls']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_xls']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='xls' && $ext!='xlsx'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select xls Files.'); // message about action performed
		header('location:index.php?mo=import_property/');
		exit;
		}
		
		move_uploaded_file($_FILES['upload_xls']['tmp_name'],PROP_EXC_PATH.$image_name);
		
	}
	
	$file = PROP_EXC_PATH.$image_name;
	$excel = new PhpExcelReader; // creates object instance of the class
	$excel->read($file); // reads and stores the excel file data
	
//echo "Total Sheets in this xls file: ".count((array)$excel->sheets)."<br /><br />";exit;

$html="<table border='1'>";

for($i=0;$i<count((array)$excel->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count((array)$excel->sheets[$i][CELLS])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count((array)$excel->sheets[$i][CELLS])."<br />";
		for($j=2;$j<=count((array)$excel->sheets[$i][CELLS]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count((array)$excel->sheets[$i][CELLS][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$excel->sheets[$i][CELLS][$j][$k];
				$html.="</td>";
			}
			
			//$id = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			//$location = str_replace(",",'',mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]));
			
			$form_no = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			$prop_date = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]);
			$property_name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][3]);
			$property_type = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][4]);
			$for_property = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][5]);
			$membership = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][6]);
			$project_name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][7]);
			$State = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][8]);
			$city = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][9]);
			$location = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][10]);
			$video_url = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][11]);
			$content = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][12]);
			$call_us = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][13]);
			$exe_name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][14]);
			$exe_email = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][15]);
			$exe_contact_no = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][16]);
			$exe_address = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][17]);
			$owner_name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][18]);
			$owner_email = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][19]);
			$owner_contact_no = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][20]);
			$owner_address = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][21]);
			$pro_curr_status = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][22]);
			$prop_avail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][23]);
			$permi_avail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][24]);
			$project_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][25]);
			$floor_loc = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][26]);
			$prop_ownership = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][27]);
			$flooring_type = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][28]);
			$facing = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][29]);
			$no_of_lift = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][30]);
			$no_of_bedrooms = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][31]);
			$no_of_bathrooms = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][32]);
			$no_of_balconies = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][33]);
			$no_of_open_sides = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][34]);
			$kitchen_detail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][35]);
			$furniture_detail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][36]);
			$age_of_property = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][37]);
			$power_supply = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][38]);
			$security_guards = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][39]);
			$camera = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][40]);
			$fire_avai = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][41]);
			$water_supply = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][42]);
			$water_timing = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][43]);
			$road_width = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][44]);
			$parking_detail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][45]);
			$gas_supply = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][46]);
			$amenities = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][47]);
			$client_avail = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][48]);
			$overlooking = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][49]);
			$some_features = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][50]);
			$wardrobe = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][51]);
			$beds = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][52]);
			$fans = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][53]);
			$light = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][54]);
			$m_kitchen = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][55]);
			$fridge = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][56]);
			$ac = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][57]);
			$geyser = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][58]);
			$tv = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][59]);
			$stove = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][60]);
			$washing_machine = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][61]);
			$water_purifier = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][62]);
			$microwave = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][63]);
			$curtains = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][64]);
			$chimney = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][65]);
			$exhaust_fan = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][66]);
			$sofa = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][67]);
			$dinning_table = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][68]);
			$super_plot_area = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][69]);
			$super_plot_area_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][70]);
			$super_con_area = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][71]);
			$super_con_area_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][72]);
			$carpet_plot_area = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][73]);
			$carpet_plot_area_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][74]);
			$carpet_con_area = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][75]);
			$carpet_con_area_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][76]);
			$offer_price = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][77]);
			$offer_price_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][78]);
			$expected_rent = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][79]);
			$expected_rent_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][80]);
			$rent_security = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][81]);
			$rent_security_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][82]);
			$maint_charge = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][83]);
			$maint_charge_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][84]);
			$tax_charge = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][85]);
			$tax_charge_unit = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][86]);
			$other_charge = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][87]);
			$google_map = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][88]);
			$school = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][89]);
			$college = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][90]);
			$hospital = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][91]);
			$bank = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][92]);
			$brts_stop = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][93]);
			$r_station = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][94]);
			$m_station = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][95]);
			$airport = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][96]);
			
			
			$propertyName = $property_name;
			$dbObj->dbQuery = "select * from ".PREFIX."com_property where property_name='".$propertyName."' order by id desc";
			if(!empty($id)){
				$dbObj->dbQuery .= "and id = $id";
			}
			$Res1 = $dbObj->SelectQuery();
			if(count((array)$Res1)>0){
				$m = $Res1[0]['id'];
				$catname1 = str_replace(' ','-',just_clean($propertyName));
				$url = $catname1.'-'.($m+1);
			} else {
				$url = str_replace(' ','-',just_clean($propertyName));
			}
			
			$query = "insert into ".PREFIX."com_property(form_no,prop_date,property_name,property_type,for_property,membership,project_name,State,city,location,video_url,content,status,display_order,url) values('".$form_no."','".date('Y-m-d', strtotime($prop_date))."','".$property_name."','".$property_type."','".$for_property."','".$membership."','".$project_name."','".$State."','".$city."','".$location."','".$video_url."','".$content."','1','0','".$url."')";
 
			mysqli_query($dbObj->connection, $query);
			
			$property_id = mysqli_insert_id($dbObj->connection); 
			
			$cDate = date("Y-m-d");
			
			$querys = "insert into ".PREFIX."com_property_detail(property_id,call_us,exe_name,exe_email,exe_contact_no,exe_address,owner_name,owner_email,owner_contact_no,owner_address,pro_curr_status,prop_avail,permi_avail,project_unit,floor_loc,prop_ownership,flooring_type,facing,no_of_lift,no_of_bedrooms,no_of_bathrooms,no_of_balconies,no_of_open_sides,kitchen_detail,furniture_detail,age_of_property,power_supply,security_guards,camera,fire_avai,water_supply,water_timing,road_width,parking_detail,gas_supply,amenities,client_avail,overlooking,some_features,wardrobe,beds,fans,light,m_kitchen,fridge,ac,geyser,tv,stove,washing_machine,water_purifier,microwave,curtains,chimney,exhaust_fan,sofa,dinning_table,super_plot_area,super_plot_area_unit,super_con_area,super_con_area_unit,carpet_plot_area,carpet_plot_area_unit,carpet_con_area,carpet_con_area_unit,offer_price,offer_price_unit,expected_rent,expected_rent_unit,rent_security,rent_security_unit,maint_charge,maint_charge_unit,tax_charge,tax_charge_unit,other_charge,google_map,school,college,hospital,bank,brts_stop,r_station,m_station,airport,post_date) values('".$property_id."','".$call_us."','".$exe_name."','".$exe_email."','".$exe_contact_no."','".$exe_address."','".$owner_name."','".$owner_email."','".$owner_contact_no."','".$owner_address."','".$pro_curr_status."','".$prop_avail."','".$permi_avail."','".$project_unit."','".$floor_loc."','".$prop_ownership."','".$flooring_type."','".$facing."','".$no_of_lift."','".$no_of_bedrooms."','".$no_of_bathrooms."','".$no_of_balconies."','".$no_of_open_sides."','".$kitchen_detail."','".$furniture_detail."','".$age_of_property."','".$power_supply."','".$security_guards."','".$camera."','".$fire_avai."','".$water_supply."','".$water_timing."','".$road_width."','".$parking_detail."','".$gas_supply."','".$amenities."','".$client_avail."','".$overlooking."','".$some_features."','".$wardrobe."','".$beds."','".$fans."','".$light."','".$m_kitchen."','".$fridge."','".$ac."','".$geyser."','".$tv."','".$stove."','".$washing_machine."','".$water_purifier."','".$microwave."','".$curtains."','".$chimney."','".$exhaust_fan."','".$sofa."','".$dinning_table."','".$super_plot_area."','".$super_plot_area_unit."','".$super_con_area."','".$super_con_area_unit."','".$carpet_plot_area."','".$carpet_plot_area_unit."','".$carpet_con_area."','".$carpet_con_area_unit."','".$offer_price."','".$offer_price_unit."','".$expected_rent."','".$expected_rent_unit."','".$rent_security."','".$rent_security_unit."','".$maint_charge."','".$maint_charge_unit."','".$tax_charge."','".$tax_charge_unit."','".$other_charge."','".$google_map."','".$school."','".$college."','".$hospital."','".$bank."','".$brts_stop."','".$r_station."','".$m_station."','".$airport."','".$cDate."')";
 
			mysqli_query($dbObj->connection, $querys);
			
			$dbObj->dbQuery = "SELECT * FROM ".PREFIX."com_property order by display_order ASC";
			$dbPages = $dbObj->SelectQuery();
	
			for($k=0;$k<count($dbPages);$k++){
				$dbObj->dbQuery = "update ".PREFIX."com_property set display_order='".($k+1)."' where id=".$dbPages[$k]['id'];
				$dbObj->ExecuteQuery();
			}
						
			$html.="</tr>";
		}
 
}
 
$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";//exit;

		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=com_property&msg='.$msg);
	    exit;
	}
}
?>