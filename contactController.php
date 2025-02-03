<?php
ob_start();// turn on output buffering
session_start();//start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection

$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$from = $_REQUEST['from'] ?? "";
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
//$info = $_REQUEST['info'] ?? ""; // data array sent from form

// to get contact details
$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='1'"; // to fetch selected id's data
$dbAdmin = $dbObj->SelectQuery();
//echo $dbAdmin[0]['email'];exit;

// mode to career
if($mode=="career_form"){
	
	//$key=substr($_SESSION['key'],0,5);
    //$number = $_REQUEST['number'];
	
	$_SESSION['career']['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$_SESSION['career']['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$_SESSION['career']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['career']['job_desc'] = $dbObj->sc_mysql_escape($_REQUEST['job_desc']);
	$_SESSION['career']['applied_for'] = $dbObj->sc_mysql_escape($_REQUEST['applied_for']);
	$_SESSION['career']['career_id'] = $dbObj->sc_mysql_escape($_REQUEST['career_id']);
	//exit;
	//if($number==$key){
	ini_set('allow_url_fopen', 'On');
	$captcha;
		if(isset($_POST['g-recaptcha-response']))
           $captcha=$_POST['g-recaptcha-response'];

		//$secretKey = "6LdHmlAUAAAAALBiwaiup98BhyBUsw-RGi0tgFbC"; //for local
		$secretKey = "6LdQg54UAAAAANiVzR3rE_jWJJtWyzTLTJU3vfg2"; //for cleardeals
		
		$ch = curl_init();

		curl_setopt_array($ch, [
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' => $secretKey,
				'response' => $captcha,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			],
			CURLOPT_RETURNTRANSFER => true
		]);
		
		$output = curl_exec($ch);
		curl_close($ch);
		
		$json = json_decode($output);
		//echo $response["success"];exit;

if (isset($json->success) && $json->success) {
		
	// code to upload pdf
	if(isset($_FILES['resume']) && $_FILES['resume']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['resume']['name']); // to remane image
		$temp = explode('.',$_FILES['resume']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='pdf' && $ext!='PDF' && $ext!='doc' && $ext!='DOC' && $ext!='docx' && $ext!='DOCX'){ // check image format
		//echo "9";
		$msg=base64_encode('Please Select PDF/Doc Files.'); // message about action performed
		header('location:'.HTACCESS_URL.'careers-form/');
		exit;
		}

		$info['resume'] = $image_name;
		
		move_uploaded_file($_FILES['resume']['tmp_name'],CAREER_DOC_PATH.$image_name);
		
	}
	if(!empty($_SESSION['career']['applied_for']) && !empty($_SESSION['career']['career_id']) && !empty($_SESSION['career']['name']) && !empty($_SESSION['career']['email']) && !empty($_SESSION['career']['mobile_no']) && !empty($_SESSION['career']['job_desc'])){
	$info['applied_for'] = $_SESSION['career']['applied_for'];
	$info['career_id'] = $_SESSION['career']['career_id'];
	$info['name'] = $_SESSION['career']['name'];
	$info['email'] = $_SESSION['career']['email'];
	$info['mobile_no'] = $_SESSION['career']['mobile_no'];
	$info['job_desc'] = $_SESSION['career']['job_desc'];
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."career_request",$info);
	//echo $dbObj->dbQuery;exit;
	
	include('usersmsCareer.php');
	
	include('adminCareersms.php');
	
	
	//echo $image_name;
	//exit;
	 // mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Career";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello ,</b></font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['career']['name']).' has contacted Cleardeals Career. </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['career']['name']).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['career']['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['career']['mobile_no'].'</font></td>
                      </tr>';
					  if(empty($_SESSION['career']['applied_for']))
                      $body .='<tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Applied For : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['applied_for'].'</font></td>
                      </tr>';
					  else
					  $body .='<tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Applied For : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['career']['applied_for'].'</font></td>
                      </tr>';
                      $body .='<tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Document : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> 
						<a href="'.HTACCESS_URL.'cms_images/career/'.$image_name.'" target="_blank"> Document</a>
						</font></td>
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
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Career";
	$mail->AddAddress($_SESSION['career']['email'],$_SESSION['career']['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_SESSION['career']['name']).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Career" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	unset($_SESSION['career']);
	header('location:'.HTACCESS_URL.'careers-form/'.$_SESSION['career']['career_id'].'/#thank-you-popup');
	exit;
	}}else{
		$_SESSION['career_msg'] = base64_encode("You are a robot !");
		header('location:'.HTACCESS_URL.'careers-form/'.$_SESSION['career']['career_id'].'/');
		exit;
		}
//}
}


// mode to request call back
if($mode=="request_call_back"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	$_SESSION['request']['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	
	$_SESSION['request']['lookingfor'] = $dbObj->sc_mysql_escape($_REQUEST['lookingfor']);
	$_SESSION['request']['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$_SESSION['request']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['request']['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	
	ini_set('allow_url_fopen', 'On');
	$captcha;
		if(isset($_POST['g-recaptcha-response']))
           $captcha=$_POST['g-recaptcha-response'];

		//$secretKey = "6LdHmlAUAAAAALBiwaiup98BhyBUsw-RGi0tgFbC"; //for local
		$secretKey = "6LdQg54UAAAAANiVzR3rE_jWJJtWyzTLTJU3vfg2"; //for cleardeals
		//$secretKey = "6LdQ5fccAAAAABl0-QTWFK8RLAnFubxTzoGwM3BE"; //for cleardeals VR4C V2
		
		$ch = curl_init();

		curl_setopt_array($ch, [
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' => $secretKey,
				'response' => $captcha,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			],
			CURLOPT_RETURNTRANSFER => true
		]);
		
		$output = curl_exec($ch);
		curl_close($ch);
		
		$json = json_decode($output);
		//echo $output;exit;
		//echo $response["success"];exit;

if (isset($json->success) && $json->success) {
	
	if(!empty($_SESSION['request']['name']) && !empty($_SESSION['request']['email']) && !empty($_SESSION['request']['mobile_no']) && !empty($_SESSION['request']['message'])){
	
	$info['name'] = $_SESSION['request']['name'];
	
	$info['lookingfor'] = $_SESSION['request']['lookingfor'];
	$info['email'] = $_SESSION['request']['email'];
	$info['mobile_no'] = $_SESSION['request']['mobile_no'];
	$info['message'] = $_SESSION['request']['message'];
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."req_call_back",$info);
	//echo $dbObj->dbQuery;exit;
	
	include('usersmsRequeCall.php');
	
	include('adminRequeCallsms.php');
	
	 // mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Request Call Back";
	$mail->Subject = "Cleardeals Request Call Back";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello ,</b></font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['request']['name']).' has contacted Cleardeals Request Call Back. </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['request']['name']).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Looking To: </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['request']['lookingfor']).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['request']['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['request']['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['request']['message'].'</font></td>
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
	
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Request Call Back";
	$mail->Subject = "Cleardeals Request Call Back";
	$mail->AddAddress($_SESSION['request']['email'],$_SESSION['request']['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_SESSION['request']['name']).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Request Call Back" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	unset($_SESSION['request']);
	//echo 1;
	//header('location:'.HTACCESS_URL.'request-call-back/#thank-you-popup');
	header('location:'.HTACCESS_URL.'thank-you-request/');
	exit;
	}}else{
			//echo 0;
	  	  $_SESSION['call_msg'] = base64_encode("You are a robot !");
		  header('location:'.HTACCESS_URL.'request-call-back/');
		  exit();
	}
}


// mode to enquiry
if($mode=="enquiry"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	if(!empty($_REQUEST['name']) && !empty($_REQUEST['company_name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['contact_no'])){
	
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['company_name'] = $dbObj->sc_mysql_escape($_REQUEST['company_name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['contact_no'] = $dbObj->sc_mysql_escape($_REQUEST['contact_no']);
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."new_project_enquiry",$info);
	//echo $dbObj->dbQuery;exit;
	
	include('usersmsProEnqu.php');
	
	include('adminProEnqsms.php');
	
	 //mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals New Real Estate Projects Enquiry";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>Please check enquiry details below:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_REQUEST['name']).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Company Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['company_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">official Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Contact No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['contact_no'].'</font></td>
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
	
	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals New Real Estate Projects Enquiry";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "New Real Estate Projects Enquiry" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	//header('location:'.HTACCESS_URL.'thank-you-enquiry/');
	echo 1;
	exit();
	}
}

// mode to help you
if($mode=="help_you"){
	
	if(!empty($_REQUEST['email'])){
	 // mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Real Estate Updates Help You";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center">
	  <strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font>
						</td>
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
	
	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Real Estate Updates Help You";
	$mail->AddAddress($_REQUEST['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>,</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Real Estate Updates Help You" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	echo 1;
	exit();
	}
}

//mode to subscribe
if($mode=="subscribe"){
	
	if(!empty($_REQUEST['subs_email'])){
	 //mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Subscription";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center">
	  <strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User subscribetion details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['subs_email'].'</font>
						</td>
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
	
	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Subscription";
	$mail->AddAddress($_REQUEST['subs_email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>,</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Subscription" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	echo 1;
	exit();
	}
}

//mode to free advice now
if($mode=="get_free_advice"){
	$_SESSION['advice']['service'] = $dbObj->sc_mysql_escape($_REQUEST['service']);
	header('location:'.HTACCESS_URL.'get-free-advice-now/');
	exit;
}

// mode to free advice now
if($mode=="free_advice"){
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

	$_SESSION['advice']['service'] = $dbObj->sc_mysql_escape($_REQUEST['service']);
	$_SESSION['advice']['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$_SESSION['advice']['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$_SESSION['advice']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['advice']['city'] = $dbObj->sc_mysql_escape($_REQUEST['city']);
	$_SESSION['advice']['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	ini_set('allow_url_fopen', 'On');
	$captcha;
		if(isset($_POST['g-recaptcha-response']))
           $captcha=$_POST['g-recaptcha-response'];
		//$secretKey = "6LdHmlAUAAAAALBiwaiup98BhyBUsw-RGi0tgFbC"; //for local
		$secretKey = "6LdQg54UAAAAANiVzR3rE_jWJJtWyzTLTJU3vfg2"; //for cleardeals
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' => $secretKey,
				'response' => $captcha,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			],
			CURLOPT_RETURNTRANSFER => true
		]);
		$output = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($output);
		//echo $response["success"];exit;
if (isset($json->success) && $json->success) {
	
	if($_SESSION['advice']['otp']==$_REQUEST['otp']){
	if(!empty($_SESSION['advice']['service']) && !empty($_SESSION['advice']['name']) && !empty($_SESSION['advice']['email']) && !empty($_SESSION['advice']['mobile_no']) && !empty($_SESSION['advice']['city']) && !empty($_SESSION['advice']['message'])){
	$info['service'] = $_SESSION['advice']['service'];
	$info['name'] = $_SESSION['advice']['name'];
	$info['email'] = $_SESSION['advice']['email'];
	$info['mobile_no'] = $_SESSION['advice']['mobile_no'];
	$info['city'] = $_SESSION['advice']['city'];
	$info['message'] = $_SESSION['advice']['message'];
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."free_advice",$info);
	//echo $dbObj->dbQuery;exit;
	
	include('usersmsGetAdvice.php');
	include('adminGetAdvicesms.php');
	
	 //mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Free Advice Now";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>Please check free advice details below:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
				  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Service : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_SESSION['advice']['service'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['advice']['name']).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['advice']['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['advice']['mobile_no'].'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['advice']['city'].'</font></td>
                      </tr>
					   <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['advice']['message'].'</font></td>
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
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Free Advice Now";
	$mail->AddAddress($_SESSION['advice']['email'],$_SESSION['advice']['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_SESSION['advice']['name']).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Free Advice Now" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	unset($_SESSION['advice']);
	header('location:'.HTACCESS_URL.'get-free-advice-now/#thank-you-popup');
	exit;
	}
	}else{
	$_SESSION['freeadvice_msg'] = base64_encode("Invalid Otp.");
	header('location:'.HTACCESS_URL.'get-free-advice-now/');
	exit;	
	}
	}else{
		$_SESSION['freeadvice_msg'] = base64_encode("You are a robot !");
		header('location:'.HTACCESS_URL.'get-free-advice-now/');
		exit;
		}
}

//mode to enquiry form
if($mode=="services_enquiry"){
	
	$_SESSION['enquiry']['service'] = $dbObj->sc_mysql_escape($_REQUEST['service']);

	header('location:'.HTACCESS_URL.'enquiry-form/');
	exit;
}

//mode to enquiry form
if($mode=="enquiry_form"){
	
	//$key=substr($_SESSION['key'],0,5);
    //$number = $_REQUEST['number'];
	
	//echo $_REQUEST['service'];exit;
	
	$_SESSION['enquiry']['service'] = $dbObj->sc_mysql_escape($_REQUEST['service']);
	$_SESSION['enquiry']['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$_SESSION['enquiry']['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$_SESSION['enquiry']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['enquiry']['city'] = $dbObj->sc_mysql_escape($_REQUEST['city']);
	$_SESSION['enquiry']['enq_detail'] = $dbObj->sc_mysql_escape($_REQUEST['enq_detail']);
	
	
	ini_set('allow_url_fopen', 'On');
	$captcha;
		if(isset($_POST['g-recaptcha-response']))
           $captcha=$_POST['g-recaptcha-response'];

		//$secretKey = "6LdHmlAUAAAAALBiwaiup98BhyBUsw-RGi0tgFbC"; //for local
		$secretKey = "6LdQg54UAAAAANiVzR3rE_jWJJtWyzTLTJU3vfg2"; //for cleardeals
		
		$ch = curl_init();

		curl_setopt_array($ch, [
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => [
				'secret' => $secretKey,
				'response' => $captcha,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			],
			CURLOPT_RETURNTRANSFER => true
		]);
		
		$output = curl_exec($ch);
		curl_close($ch);
		
		$json = json_decode($output);
		//echo $response["success"];exit;

if (isset($json->success) && $json->success) {

if(!empty($_SESSION['enquiry']['service']) && !empty($_SESSION['enquiry']['name']) && !empty($_SESSION['enquiry']['email']) && !empty($_SESSION['enquiry']['mobile_no']) && !empty($_SESSION['enquiry']['city']) && !empty($_SESSION['enquiry']['enq_detail'])){
	$info['service'] = $_SESSION['enquiry']['service'];
	$info['name'] = $_SESSION['enquiry']['name'];
	$info['email'] = $_SESSION['enquiry']['email'];
	$info['mobile_no'] = $_SESSION['enquiry']['mobile_no'];
	$info['city'] = $_SESSION['enquiry']['city'];
	$info['enq_detail'] = $_SESSION['enquiry']['enq_detail'];
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."service_enquiry",$info);
	//echo $dbObj->dbQuery;exit;
	
	 // mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Enquiry";
	$mail->Subject = "Cleardeals Enquiry";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>Please check enquiry details below:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
				  	  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Service : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_SESSION['enquiry']['service'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($_SESSION['enquiry']['name']).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['enquiry']['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['enquiry']['mobile_no'].'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['enquiry']['city'].'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Enquiry : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['enquiry']['enq_detail'].'</font></td>
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
	
	unset($_SESSION['enquiry']);
	header('location:'.HTACCESS_URL.'thank-you-enquiry/');
	//echo 1;
	exit;
}}else{
		$_SESSION['enq_msg'] = base64_encode("You are a robot !");
		header('location:'.HTACCESS_URL.'enquiry-form/');
		exit;
		}
}


// mode to about subscribe
if($mode=="about_subs"){
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	if(!empty($info['email'])){
	$info['current_datetime'] = date('Y-m-d H:i:s');
	add_record($dbObj,PREFIX."subscribe",$info);
	//echo $dbObj->dbQuery;exit;
	
	//include('usersmsAskQue.php');
	
	include('adminSubssms.php');
	
	 //mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = $info['email'];
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Subscription";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>Please check subscription details below:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbObj->sc_mysql_escape($info['email']).'</font></td>
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
	
	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Subscription";
	$mail->AddAddress($info['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_SESSION['advice']['name']).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Subscription" <br /><br />Our Support Team will contact you soon. <br /><br />
			For More Details Contact our support team <br /><br />contact@cleardeals.co.in<br /><br />Mo: 9723992200</font></p>
             </td>
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
	
	//$_SESSION['subscribe_msg'] = base64_encode("Thank you for your subscription.");
	//header('location:'.HTACCESS_URL.'about/#subscribe-now');
	echo 1;
	exit();
	}
}

//generate otp
if($mode=="get_service_otp"){
	
	$_SESSION['advice']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['advice']['otp'] = $rndno;//exit;
	include('propServicesmobileAPI.php');
	
	//echo $_SESSION['advice']['otp'];
	echo 1;
	}
	
	exit;
}
?>