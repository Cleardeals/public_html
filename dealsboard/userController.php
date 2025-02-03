<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail
$dbObj = new DBConnection(); // database connection

login_check();

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info']; // data array sent from form

if($mode=="getcity"){
	
	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
	
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

if($mode=="getcity1"){
	
	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
	
	//to get sub categories
	$dbObj->dbQuery="select * from cities where state_id='".$stateID."'"; // for listing of records
	$dbcities = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dbcities);exit;

	$data='<option value="">City</option>';
	for($i=0;$i<count((array)$dbcities);$i++){
		if(!empty($stateID) && ($dbcities[$i]['name']==$stateID)){
		$data.='<option value="'.$dbcities[$i]['name'].'" selected >'.$dbcities[$i]['name'].'</option>';
		} else{
        	$data.='<option value="'.$dbcities[$i]['name'].'" >'.$dbcities[$i]['name'].'</option>';
		}
    }
	echo $data;
	exit;
}

if($mode=="getcity2"){
	
	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
	
	//to get sub categories
	$dbObj->dbQuery="select * from cities where state_id='".$stateID."'"; // for listing of records
	$dbcities = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dbcities);exit;

	$data='<option value="">City</option>';
	for($i=0;$i<count((array)$dbcities);$i++){
		if(!empty($stateID) && ($dbcities[$i]['name']==$stateID)){
		$data.='<option value="'.$dbcities[$i]['name'].'" selected >'.$dbcities[$i]['name'].'</option>';
		} else{
        	$data.='<option value="'.$dbcities[$i]['name'].'" >'.$dbcities[$i]['name'].'</option>';
		}
    }
	echo $data;
	exit;
}

function random_strings($length_of_string) { 
  
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
}

//mode to add User
if($mode=="add_user"){
	
	$info = $_REQUEST['info'];
	$data = $_REQUEST['data'];
	
	$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where user_id='".$id."'";
	$dbUserProp = $dbObj->SelectQuery();
	
	$dbObj->dbQuery="select * from ".PREFIX."package where property_type='sell'";
	$dbsellProperty = $dbObj->SelectQuery();
	
	$dbObj->dbQuery="select * from ".PREFIX."package where property_type='rent'";
	$dbrentProperty = $dbObj->SelectQuery();
	
	if($data['for_property']=='sell'){
		$data['amount'] = $dbObj->sc_mysql_escape($dbsellProperty[0]['cost']);
		$data['validity'] = $dbObj->sc_mysql_escape($dbsellProperty[0]['validity']);
	}
	
	if($data['for_property']=='rent'){
		$data['amount'] = $dbObj->sc_mysql_escape($dbrentProperty[0]['cost']);
		$data['validity'] = $dbObj->sc_mysql_escape($dbrentProperty[0]['validity']);
	}
	
	$overlooking = $dbObj->sc_mysql_escape($_REQUEST['overlooking']);
	for($i=0;$i<count((array)$overlooking);$i++){
		$overl .= $overlooking[$i].',';
	}
	$data['overlooking'] = $overl;
	
	if(!empty($id)){
	
	modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
	if(!empty($dbUserProp[0]['user_id'])){
		//echo 11;
	//$data['post_date'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'user_property_detail',$data,'user_id='.$id);
	//echo $dbObj->dbQuery;exit;
	}else{
	
	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$id."'";
	$dbUserDet = $dbObj->SelectQuery();
	
	$data['user_id'] = $dbObj->sc_mysql_escape($dbUserDet[0]['id']);
	
	$data['post_date'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'user_property_detail',$data); 
	//echo $dbObj->dbQuery;
		
	}//exit;
	$msg = base64_encode("Record Modified Successfully"); // message about action performed
	header('location:index.php?mo=manage_user&msg='.$msg);
	exit;
	
	} else {
	
	$ran_pass = random_strings(10);
	$password = md5(trim($ran_pass));
	
	$uname =  substr($dbObj->sc_mysql_escape($_REQUEST['f_name']),0,2);//exit;
	$usernm = rand(1000, 9999);
	$userName = "CD".$uname.$usernm."";
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$userName."'";
	$dbUserCheck = $dbObj->SelectQuery();
	
	if(count((array)$dbUserCheck)<1) {
		
		$unam =  substr($dbObj->sc_mysql_escape($_REQUEST['f_name']),0,2);//exit;
		$usern = rand(1000, 9999);
		$userNM = "CD".$unam.$usern."";
		$info['username'] = $userNM;
	}else{
		
		$info['username'] = $userName;
		}
	
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['f_name']).' '.$dbObj->sc_mysql_escape($_REQUEST['l_name']);
	$info['password'] = $password;
	$info['status'] = '0';
	$info['datetime'] = date('Y-m-d H:i:s');
	$client_id = add_record($dbObj,PREFIX.'user_detail',$info); 
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE id='".$dbObj->sc_mysql_escape($client_id)."'";
	$dbUser = $dbObj->SelectQuery();
	
	
	// generate client id
	$znum=sprintf("%04s", $client_id);
	$clientid="CLR".$znum."";//exit;
	
	// generate username
	//$usernm=sprintf("%04s", $client_id);
	//$userName=$usrname[0]."cleardeal".$usernm."";//exit;
	
	$dbObj->dbQuery = "update ".PREFIX."user_detail set clientid='".$clientid."' where id='".$dbObj->sc_mysql_escape($client_id)."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;
	
	$data['user_id'] = $client_id;
	
	$data['post_date'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'user_property_detail',$data); 
	//echo $dbObj->dbQuery;exit;
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Thank you for Cleardeals signup";
	$mail->AddAddress($dbUser[0]['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center">
	  <img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center">
	  <strong style="font-size:17px"> 
	  Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px">
			<b>Hello </b>'.ucwords($dbUser[0]['name']).',</font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px">
			Thank you for signup Cleardeals.co.in.</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> 
			<font style="font-family:Arial,Helvetica,sans-serif;font-size:13px">
			 <b>Your details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top">
				  <table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%">
						<font face="Verdana" style="font-size:12px">
						Client Id : </font></td>
                        <td align="left">
						<font face="Verdana" style="font-size:12px"> 
						'.$clientid.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%">
						<font face="Verdana" style="font-size:12px">
						Username : </font></td>
                        <td align="left">
						<font face="Verdana" style="font-size:12px">
						'.$dbUser[0]['username'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%">
						<font face="Verdana" style="font-size:12px">
						Password : </font></td>
                        <td align="left">
						<font face="Verdana" style="font-size:12px">
						'.$ran_pass.'</font></td>
                      </tr>';
                      
                      $body .= '
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font face="Verdana" style="font-size:12px">
				  Account activate after admin approvel. </font></td>
                </tr>
                <tr>
                  <td height="64"><span style="float:left;font-size:16px;">
				  Kind regards;<br>
                  <b>Cleardeals.co.in</b></span></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
	
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	/*if($mail->Send) {
		echo "success";
	} else {
		echo "fail";
	}exit;*/
	$mail->Send();
	$mail->ClearAllRecipients();
	
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=manage_user&msg='.$msg);
	exit;
	}
}

//mode to change user active status
if($mode=="user_active"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."user_detail set status='1' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id=".$id."";
	$dbUser = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = $dbUser[0]['name']." your profile has been activated";
	$mail->AddAddress($dbUser[0]['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center">
	  <img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center">
	  <strong style="font-size:17px"> 
	  Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> 
			<b>Hello </b>'.ucwords($dbUser[0]['name']).', </font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> 
			Your profile is activated. </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
			
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	/*if($mail->Send) {
		echo "success";
	} else {
		echo "fail";
	}exit;*/
	$mail->Send();
	$mail->ClearAllRecipients();
	
	$msg = base64_encode("User Activate Successfully");  // message about action performed
	header('location:index.php?mo=manage_user&msg='.$msg);
	exit;
}

//mode to change user deactive status
if($mode=="user_deactive"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."user_detail set status='0' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id=".$id."";
	$dbUser = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = $dbUser[0]['name']." your profile has been deactivated";
	$mail->AddAddress($dbUser[0]['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center">
	  <img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center">
	  <strong style="font-size:17px"> 
	  Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px">
			<b>Hello </b>'.ucwords($dbUser[0]['name']).', </font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> 
			Your profile is deactivated. </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
			
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	/*if($mail->Send) {
		echo "success";
	} else {
		echo "fail";
	}exit;*/
	$mail->Send();
	$mail->ClearAllRecipients();
	
	$msg = base64_encode("User Deactivate Successfully");  // message about action performed
	header('location:index.php?mo=manage_user&msg='.$msg);
	exit;
}

if($mode=="pay_status"){//// to set category status

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? ""); // id of the record
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? ""); // to to update
	
	//to update menu status
	$dbObj->dbQuery = "update ".PREFIX."user_property_detail set pay_status='".$set_val."' where id=".$id; 
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;
	
	echo "Pay Status Successfully changed."; // message about action performed
	exit();
}

//mode to delete Users Property
if($mode=='delete_user_property'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=user_property&id='.$user_id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'user_property_detail','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=user_property&id='.$user_id.'&msg='.$msg);
	exit;	
}

//mode to change property status
if($mode=="property_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."property set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete buyer Users
if($mode=='delete_buyer_user'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=manage_user&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'user_detail','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'user_property_detail','user_id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=manage_user&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete seller Users
if($mode=='delete_seller_user'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=manage_user&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'user_detail','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'user_property_detail','user_id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=manage_user_seller&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete Single User
if($mode=='delete_single_user'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'user_detail','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	delete_record($dbObj,PREFIX.'user_property_detail','user_id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=manage_user&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to upload progress report
if($mode=='progress_report'){  

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	//upload progress report
	if(isset($_FILES['upload_file']) && $_FILES['upload_file']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_file']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_file']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='xls' && $ext!='xlsx'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select Excel Files.'); // message about action performed
		header('location:index.php?mo=progress_report&user_id='.$user_id.'&msg='.$msg);
		exit;
		}

		$info['upload_file'] = $image_name;
		
		move_uploaded_file($_FILES['upload_file']['tmp_name'],PROGRESS_PATH.$image_name);
		
	}
	
	if(!empty($id)){
		
	modify_record($dbObj,PREFIX.'progress_report',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
		
	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=progress_report&user_id='.$user_id.'&msg='.$msg);
	exit;
		
	}else{
	
	$info['user_id'] = $user_id;
	$info['status'] = '1';
	$info['display_order'] = 0;
	$info['published_on'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'progress_report',$info); 
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."progress_report order by display_order ASC";
	$dbPages = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbPages);$k++){
		$dbObj->dbQuery = "update ".PREFIX."progress_report set display_order='".($k+1)."' where id=".$dbPages[$k]['id'];
		$dbObj->ExecuteQuery();
	}
	
	$msg = base64_encode("Record Saved Successfully."); // message about action performed
	header('location:index.php?mo=progress_report&user_id='.$user_id.'&msg='.$msg);
	exit;
	}
}

//mode to change progress report status
if($mode=="report_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."progress_report set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete progress report
if($mode=='delete_report'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=progress_report&user_id='.$user_id.'&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'progress_report','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."progress_report where id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(PROGRESS_PATH.$dbResult[0]['upload_file']) && !empty($dbResult[0]['upload_file'])){ 
		unlink(PROGRESS_PATH.$dbResult[0]['upload_file']); // remove resize image from thumbd folder
		unlink(PROGRESS_PATH.$dbResult[0]['upload_file']); // remove original image form folder
	}	
	
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."progress_report where id=".$id;
	$dbRes = $dbObj->SelectQuery();
		
		for($i=0;$i<count($dbRes);$i++){
			$dbObj->dbQuery = "update ".PREFIX."progress_report set display_order='".($i+1)."' where id=".$dbRes[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=progress_report&user_id='.$user_id.'&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to upload payment receipt
if($mode=='payment_receipt'){  

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	//upload progress report
	if(isset($_FILES['upload_file']) && $_FILES['upload_file']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_file']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_file']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='pdf' && $ext!='PDF'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select Pdf Files.'); // message about action performed
		header('location:index.php?mo=payment_receipt&user_id='.$user_id.'&msg='.$msg);
		exit;
		}

		$info['upload_file'] = $image_name;
		
		move_uploaded_file($_FILES['upload_file']['tmp_name'],PAYMENT_RECEIPT_PATH.$image_name);
	}
	
	if(!empty($id)){
		
	modify_record($dbObj,PREFIX.'payment_receipt',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
		
	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=payment_receipt&user_id='.$user_id.'&msg='.$msg);
	exit;
		
	}else{
	
	$info['user_id'] = $user_id;
	$info['status'] = '1';
	$info['display_order'] = 0;
	$info['published_on'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'payment_receipt',$info); 
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."payment_receipt order by display_order ASC";
	$dbPages = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbPages);$k++){
		$dbObj->dbQuery = "update ".PREFIX."payment_receipt set display_order='".($k+1)."' where id=".$dbPages[$k]['id'];
		$dbObj->ExecuteQuery();
	}
	
	$msg = base64_encode("Record Saved Successfully."); // message about action performed
	header('location:index.php?mo=payment_receipt&user_id='.$user_id.'&msg='.$msg);
	exit;
	}
}

//mode to delete let nik
if($mode=='delete_letnik_property'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'find_property','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=let-nik&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to change payment receipt status
if($mode=="receipt_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."payment_receipt set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete payment receipt
if($mode=='delete_receipt'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
	
	if(empty($id)){	 //check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=payment_receipt&user_id='.$user_id.'&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'payment_receipt','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."payment_receipt where id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(PAYMENT_RECEIPT_PATH.$dbResult[0]['upload_file']) && !empty($dbResult[0]['upload_file'])){ 
		unlink(PAYMENT_RECEIPT_PATH.$dbResult[0]['upload_file']); // remove resize image from thumbd folder
		unlink(PAYMENT_RECEIPT_PATH.$dbResult[0]['upload_file']); // remove original image form folder
	}	
	
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."payment_receipt where id=".$id;
	$dbRes = $dbObj->SelectQuery();
		
		for($i=0;$i<count($dbRes);$i++){
			$dbObj->dbQuery = "update ".PREFIX."payment_receipt set display_order='".($i+1)."' where id=".$dbRes[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=payment_receipt&user_id='.$user_id.'&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to generate invoice
if($mode=='generate_invoice'){

$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$user_id."'";
$dbUser = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;exit;

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_property_detail WHERE user_id='".$user_id."'";
$dbPropDetail = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."state WHERE id='".$dbPropDetail[0]['state']."'";
$dbState = $dbObj->SelectQuery();

// generate reciept number
$znum=sprintf("%05s", $dbPropDetail[0]['id']);
$recieptNo="CDC".$znum."";//exit;

// generate form number
$znums=sprintf("%05s", $dbPropDetail[0]['id']);
$formNo="ARS".$znums."";//exit;

$pdf = '<div class="center-section-in">
  <table width="500" cellpadding="5" align="center">
    <tr>
      <th scope="col"><img src="'.HTACCESS_URL.'assets/img/logo.png"></th>
      <th scope="col" style="text-align:right"><b>RECEIPT NO:
        '.$recieptNo.'
        </b><br />
        DATE:
        '.date('d-M-Y').'</th>
    </tr>
    <tr>
      <td colspan="2"><p style="margin-top:15px;">From: ClearDeals Properties<br />
          52, 1st Floor, Stadium House, 
          Navrangpura, Ahmedabad</p></td>
    </tr>
    <tr>
      <td colspan="2"><strong>RECEIVED WITH THANKS FROM</strong><br />
        <span style="display:block; width:100%; margin-bottom:25px; border-bottom:1px solid #000;">
        '.$dbUser[0]['name'].'
        </span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>FORM NO</strong><br />
        <span style="display:block; width:100%; margin-bottom:25px; border-bottom:1px solid #000;">
        '.$formNo.'
        </span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>PROPERTY NAME</strong><br />
        <span style="display:block; width:100%; margin-bottom:25px; border-bottom:1px solid #000; ">
        
        '.$dbPropDetail[0]['prop_add'].'
       
       '.$dbPropDetail[0]['city'].'
       
        '.$dbState[0]['state_name'].'
       </span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>THE SUM OF RUPEES</strong><br />
        <span style="display:block; width:100%; margin-bottom:5px; border-bottom:1px solid #000;">
        '.number_format($dbPropDetail[0]['amount'],2).'
        </span> <span style="display:block; width:100%; margin-bottom:25px;">BY CHEQUE/CASH/DD</span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>REMARKS</strong><br />
        <span style="display:block; width:100%; margin-bottom:25px; border-bottom:1px solid #000;">PREMIUM PACKAGE (Cash)</span></td>
    </tr>
    <tr>
      <td colspan="2"><span style="display:block; width:100%; margin-bottom:25px; padding:25px 30px;  border-radius:10px; border:2px solid #ccc; font-size:130%; font-weight:700">Rs.
       '.number_format($dbPropDetail[0]['amount'],2).'
        </span></td>
    </tr>
    <tr>
      <td><label>
          <input type="checkbox"/>
          Please click here to calculate Total.</label></td>
      <td style="text-align:right"><p style="margin-bottom:5px"><strong>CGST 0%:</strong> 0.00</p>
        <p style="margin-bottom:5px"><strong>SGST 0%:</strong> 0.00</p>
        <p ><strong>GSTIN/UIN :</strong> <span style="border-bottom:1px solid #000000;">
          '.number_format($dbPropDetail[0]['amount'],2).'
          </span></p></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center"><hr />
        <strong style="margin-bottom:15px; display:inline-block">Created By</strong></td>
    </tr>
    <tr style="border-bottom:1px solid #000">
      <td> ClearDeals Properties </td>
      <td style="text-align:right"> This is online receipt and doesnot require a Signature </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:right"><br />
        <a href="userController.php?mode=generate_invoice&user_id='.$dbUser[0]['id'].'" style="display:inline-block; padding:15px; border-radius:10px; border:2px solid #ccc; font-size:130%; font-weight:700" download>Generate Receipt</a></td>
    </tr>
  </table>
  <div class="clearfix"></div>
</div>';
require('TCPDF/tcpdf.php');
//require('TCPDF/config/lang/eng.php');
$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
//$tcpdf->SetCreator(PDF_CREATOR);

// set default monospaced font
$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set title of pdf
$tcpdf->SetTitle('Payment Receipt');

// set margins
$tcpdf->SetMargins(10, 10, 10, 10);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set header and footer in pdf
$tcpdf->setPrintHeader(false);
$tcpdf->setPrintFooter(false);
$tcpdf->setListIndentWidth(3);

// set auto page breaks
$tcpdf->SetAutoPageBreak(TRUE, 11);

// set image scale factor
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$tcpdf->AddPage();

$tcpdf->SetFont('times', '', 10.5);

$tcpdf->writeHTML($pdf, true, false, false, false, '');

ob_end_clean();
//Close and output PDF document
 
/*$tcpdf->Output("".time()."invoice.pdf", 'I');
echo $dir=PROGRESS_PATH;
move_uploaded_file($tcpdf->Output("".time()."invoice.pdf", 'I'),PROGRESS_PATH.xyz);

header('Content-type: application/pdf');
header("Content-type: application-download");
header("Content-Length: $size");
header("Content-Disposition: attachment; filename=invoice.pdf");
header("Content-Transfer-Encoding: binary");*/
//$dir=PDF_PATH;
//$filename= "".time()."_filename_".$id.".pdf";

$tcpdf ->Output("".time()."invoice.pdf", 'I');
//echo "Save PDF in folder";

header('location:index.php?mo=user_property&id='.$user_id);
exit;
}
?>