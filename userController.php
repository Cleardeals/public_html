<?php 
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection object

//$info = $_REQUEST['info'] ?? ""; // data array sent from form
$mode = $_REQUEST['mode'] ?? "";
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$from = $_REQUEST['from'] ?? ""; 
$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable
$page_id = $_REQUEST['page_id'] ?? ""; // action to perform

//to get admin's email id
$dbObj->dbQuery = "SELECT email FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

//mode to sell property
if($mode=="sell_property") {

	$for_property = $dbObj->sc_mysql_escape($_REQUEST['for_property']);
	$type = $dbObj->sc_mysql_escape($_REQUEST['type']);

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."package where status='1' and property_type='".$for_property."'";
	$dbPackage = $dbObj->SelectQuery();

	$_SESSION['billing']['for_property'] = $for_property;
	
	
	if($type=='plan3'){
		$_SESSION['billing']['amount'] = ((18/100)*$dbPackage[0]['cost_split'])+$dbPackage[0]['cost_split'];
		$_SESSION['billing']['validity'] = $dbPackage[0]['validity_split'];
	}else if($type=='plan2'){
		$_SESSION['billing']['amount'] = ((18/100)*$dbPackage[0]['cost_premium'])+$dbPackage[0]['cost_premium'];	
		$_SESSION['billing']['validity'] = $dbPackage[0]['validity_premium'];
	}else if($type=='plan1'){
		$_SESSION['billing']['amount'] = ((18/100)*$dbPackage[0]['cost'])+$dbPackage[0]['cost'];	
		$_SESSION['billing']['validity'] = $dbPackage[0]['validity'];	
	} else if($type=='Basic Package'){
		$_SESSION['billing']['amount'] = ((18/100)*$dbPackage[0]['cost'])+$dbPackage[0]['cost'];	
		$_SESSION['billing']['validity'] = $dbPackage[0]['validity'];	
	}
	

	header('location:'.HTACCESS_URL.'billing/');
	exit;
}


//mode to billing detail
if($mode=="billing_detail") {

	$key=substr($_SESSION['key'],0,5);
    $number = $_REQUEST['number'];

	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id']);

	/*$overlooking = $_REQUEST['overlooking'];
	for($i=0;$i<count((array)$overlooking);$i++){
		$overl .= $overlooking[$i].',';
	}
	$_SESSION['billing']['overlooking'] = $overl;*/

	//$_SESSION['billing']['address'] = $_REQUEST['address'];
	//$_SESSION['billing']['add'] = $_REQUEST['add'];
	//$_SESSION['billing']['prop_add'] = $_REQUEST['prop_add'];
	//$_SESSION['billing']['form_no'] = $_REQUEST['form_no'];
	$_SESSION['billing']['property_name'] = $dbObj->sc_mysql_escape($_REQUEST['property_name']);
	$_SESSION['billing']['property_type'] = $dbObj->sc_mysql_escape($_REQUEST['property_type']);
	$_SESSION['billing']['no_of_bedrooms'] = $dbObj->sc_mysql_escape($_REQUEST['no_of_bedrooms']);
	$_SESSION['billing']['no_of_bathrooms'] = $dbObj->sc_mysql_escape($_REQUEST['no_of_bathrooms']);
	$_SESSION['billing']['prop_state'] = $dbObj->sc_mysql_escape($_REQUEST['prop_state']);
	$_SESSION['billing']['prop_city'] = $dbObj->sc_mysql_escape($_REQUEST['prop_city']);
	//$_SESSION['billing']['detail'] = $_REQUEST['detail'];
	$_SESSION['billing']['hear_about'] = $dbObj->sc_mysql_escape($_REQUEST['hear_about']);
	//$_SESSION['billing']['prop_remark'] = $_REQUEST['prop_remark'];
	//$_SESSION['billing']['for_property'] = $_REQUEST['for_property'];
	$_SESSION['billing']['amount'] = $dbObj->sc_mysql_escape($_REQUEST['amount']);
	$_SESSION['billing']['validity'] = $dbObj->sc_mysql_escape($_REQUEST['validity']);

	if($number==$key){

	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['billing']['otp'] = $rndno;//exit;

	//include('mobileAPI1.php');
	header('location:'.HTACCESS_URL.'billing-detail/');
	exit;
	}else{
		
	 $_SESSION['bill_msg'] = base64_encode("Invalid security code.");
	 header('location:'.HTACCESS_URL.'billing/');
	 exit;
	}
}



function random_strings($length_of_string){ 

    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

    // Shufle the $str_result and returns substring 

    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 

}


//mode to billing
if($mode=="billing") {
	
	$info = $_REQUEST['info'] ?? "";

	$data = $dbObj->sc_mysql_escape($_REQUEST['data']);
	$user_id = $_SESSION['user']['userid'];

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
	$dbUser = $dbObj->SelectQuery();

	modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$user_id);
	//echo $dbObj->dbQuery;exit;

	$data['user_id'] = $user_id;
	$data['pay_status'] = 'Unpaid';
	$data['post_date'] = date('Y-m-d');
	//exit;

	$lastId = add_record($dbObj,PREFIX.'user_property_detail',$data);
	//echo $dbObj->dbQuery;

	//include("email.php");
	unset($_SESSION['billing']);
	//include("email.php");//exit;

	//if($dbUser[0]['user_type']=='Seller'){
	//header('location:'.HTACCESS_URL.'payment.php&lastId='.$lastId);
	header('location:index.php?mo=payment&lastId='.$lastId);
	/*exit;
	}else{
		include("email-buyer.php");
		header('location:'.HTACCESS_URL.'thankyou-buyer-billing/');
		}*/

}



//mode to update account
if($mode=='my_account') {
	
	$info = $_REQUEST['info'];
	$id = $_SESSION['user']['userid'];

	modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;

	$_SESSION['update_msg'] = base64_encode("Record Update Successfully.");
	header('location:'.HTACCESS_URL.'my-account/');
	exit;
}



//get mode change password
if($mode=="user_password") {

	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id']);
	$password = $dbObj->sc_mysql_escape(md5((trim($_REQUEST['password']))));//exit;

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id=".$user_id."";
	$dbUser = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;

	if($dbUser[0]['password']!=$password){

	$_SESSION['pass_msg'] = base64_encode("Current password do not match.");
	header("location:".HTACCESS_URL."change-password/");
	exit;
	}else{

	$info['password'] = $dbObj->sc_mysql_escape(md5((trim($_REQUEST['new_pass']))));
	//echo $info['password'] = $dbObj->sc_mysql_escape($_REQUEST['new_pass']);
	//exit;

	modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$user_id);
	//echo $dbObj->dbQuery;exit;
	//exit;

	$_SESSION['pass_msg'] = base64_encode("Password Changed Successfully.");
	header("location:".HTACCESS_URL."change-password/");
	exit;
}}


//mode to add favourite
if($mode=='add_favourite') {

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);

	if(!empty($id)){

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='1' where id='".$id."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-property-thumb/');
	exit;
	}else{

	$info['user_id'] = $dbObj->sc_mysql_escape($_REQUEST['userId']);
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	add_record($dbObj,PREFIX.'favourite',$info);
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-property-thumb/');
	exit;
	}
}


//mode to remove favourite
if($mode=='remove_favourite') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];
	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'search-property-thumb/');
	exit;
}



//mode to add favourite
if($mode=='add_favourite_list') {

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	if(!empty($id)){

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='1' where id='".$id."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-property-list/');
	exit;
	}else{

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	add_record($dbObj,PREFIX.'favourite',$info);
	//echo $dbObj->dbQuery;exit;
	
	header('location:'.HTACCESS_URL.'search-property-list/');
	exit;
	}
}



//mode to remove favourite
if($mode=='remove_favourite_list') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'search-property-list/');
	exit;
}



//mode to add favourite
if($mode=='add_favourite_rent') {

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	if(!empty($id)){

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='1' where id='".$id."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-rent-property-thumb/');
	exit;
	}else{
		
	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	add_record($dbObj,PREFIX.'favourite',$info);
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-rent-property-thumb/');
	exit;
	}
}



//mode to remove favourite
if($mode=='remove_favourite_rent') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'search-rent-property-thumb/');
	exit;
}


//mode to add favourite
if($mode=='add_favourite_rlist') {

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	if(!empty($id)){

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='1' where id='".$id."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-rent-property-list/');
	exit;
	}else{
		
	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	add_record($dbObj,PREFIX.'favourite',$info);
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'search-rent-property-list/');
	exit;
	}
}



//mode to remove favourite
if($mode=='remove_favourite_rlist') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'search-rent-property-list/');
	exit;
}



//mode to add favourite
if($mode=='add_favourite_prop') {
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];
	$url = $dbObj->sc_mysql_escape($_REQUEST['url']);
	
	if(!empty($id)){

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='1' where id='".$id."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'property-detail/'.$url.'/');
	exit;
	}else{

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	add_record($dbObj,PREFIX.'favourite',$info);
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'property-detail/'.$url.'/');
	exit;
	}
}



//mode to remove favourite
if($mode=='remove_favourite_prop') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];
	$url = $dbObj->sc_mysql_escape($_REQUEST['url']);

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'property-detail/'.$url.'/');
	exit;
}



//mode to remove favourite
if($mode=='remove_fav_prop') {

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	$user_id = $_SESSION['user']['userid'];

	$info['user_id'] = $user_id;
	$info['property_id'] = $property_id;
	$info['favourite'] = '1';

	$dbObj->dbQuery = "update ".PREFIX."favourite set favourite='0' where user_id='".$user_id."' and property_id='".$property_id."'";
	$dbObj->ExecuteQuery();

	header('location:'.HTACCESS_URL.'your-favourite-properties/');
	exit;
}



//mode to find properties
if($mode=='find_property') {

	$data = $_REQUEST['data'];
	$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id']);

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$user_id."'";
	$dbUser = $dbObj->SelectQuery();

	$info['user_id'] = $user_id;
	$info['range'] = $dbObj->sc_mysql_escape($_REQUEST['range']);
	$info['city'] = $dbObj->sc_mysql_escape($_REQUEST['city']);
	$info['location'] = $dbObj->sc_mysql_escape($_REQUEST['location']);
	$info['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	$info['view_status'] = '0';
	$info['currentDate'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX.'find_property',$info);
	//echo $dbObj->dbQuery;exit;

	$data['username'] = $dbUser[0]['username'];
	$data['user_msg'] = $dbObj->sc_mysql_escape($info['message']);
	$data['user_read_status'] = 'read';
	$data['msgDatetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX.'find_msg',$data);
	//echo $dbObj->dbQuery;exit;

	$dbObj->dbQuery = "update ".PREFIX."user_detail set admin_read_status='unread' where id='".$user_id."'";
	$dbObj->ExecuteQuery();

	//------------------------- mail send to admin ----------------------

	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "".$dbUser[0]['name']." Find Properties";
	$mail->AddAddress($dbAdmin[0]['email'],"Cleardeals");
	//$mail->AddBcc('swalehap@srgit.com', "SRGIT");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '';
	$body ='<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> <b>Hello, </b> </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial,Helvetica,sans-serif;font-size:13px"> <b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="40%"><font face="Verdana" style="font-size:12px"> Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($dbUser[0]['name']).' </font></td>
                      </tr>
                      <tr>
                        <td align="left" width="40%"><font face="Verdana" style="font-size:12px"> Budget range : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_REQUEST['range'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="40%"><font face="Verdana" style="font-size:12px"> City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_REQUEST['city'].' </font></td>
                      </tr>
                      <tr>
                        <td align="left" width="40%"><font face="Verdana" style="font-size:12px"> Area Location : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_REQUEST['location'].' </font></td>
                      </tr>
                      <tr>
                        <td align="left" width="40%"><font face="Verdana" style="font-size:12px"> Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_REQUEST['message'].' </font></td>
                      </tr>';
                      $body .= '
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
	//echo $body;exit;
	//echo $mail->Body .= $body;exit;
	$mail->MsgHTML($body);
	//$mail->Body .= $body;
	$mail->Send();
	$mail->ClearAllRecipients();

	$_SESSION['find_msg'] = base64_encode("Mail Send Successfully.");
	header('location:'.HTACCESS_URL.'properties-for-you/');
	exit;
}
?>