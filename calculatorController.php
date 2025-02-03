<?php 


ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute quer
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection object

$info = $_REQUEST['info']; // data array sent from form
$mode = $_REQUEST['mode'] ?? "";
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$from = $_REQUEST['from'] ?? ""; 
$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable
$page_id = $_REQUEST['page_id'] ?? ""; // action to perform

//to get admin's email id
$dbObj->dbQuery = "SELECT email FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

//eligibility
if($mode=='eligibility'){
		
	$_SESSION['eligibility']['amount'] = $dbObj->sc_mysql_escape($_REQUEST['amount']);
	$_SESSION['eligibility']['years'] = $dbObj->sc_mysql_escape($_REQUEST['years']);
	$_SESSION['eligibility']['rate'] = $dbObj->sc_mysql_escape($_REQUEST['rate']);
	$_SESSION['eligibility']['other_emi'] = $dbObj->sc_mysql_escape($_REQUEST['other_emi']);
	$_SESSION['eligibility']['loan_eligibility'] = $dbObj->sc_mysql_escape($_REQUEST['loan_eligibility']);
	$_SESSION['eligibility']['monthly_emi'] = $dbObj->sc_mysql_escape($_REQUEST['monthly_emi']);
	
	$_SESSION['eligibility']['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$_SESSION['eligibility']['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$_SESSION['eligibility']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['eligibility']['emi_purpose'] = $dbObj->sc_mysql_escape($_REQUEST['emi_purpose']);
	
	//generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['eligibility']['otp'] = $rndno;//exit;
	include('eligibilitymobileAPI.php');
	
	$allVal = $_SESSION['eligibility']['otp'].','.$_SESSION['eligibility']['name'].','.$_SESSION['eligibility']['email'].','.$_SESSION['eligibility']['mobile_no'].','.$_SESSION['eligibility']['emi_purpose'].','.$_SESSION['eligibility']['amount'].','.$_SESSION['eligibility']['years'].','.$_SESSION['eligibility']['rate'].','.$_SESSION['eligibility']['other_emi'].','.$_SESSION['eligibility']['loan_eligibility'].','.$_SESSION['eligibility']['monthly_emi'];

	echo $allVal;
	exit;
}


//eligibility varify otp
if($mode=='eligibilityOtp'){
	
	$otpData = explode(',', $dbObj->sc_mysql_escape($_REQUEST['otpdata']));
	$otp = $_SESSION['eligibility']['otp'];
	//$otp = $otpData[0];
	$name = $_SESSION['eligibility']['name'];
	$email = $_SESSION['eligibility']['email'];
	$mobile_no = $_SESSION['eligibility']['mobile_no'];
	$emi_purpose = $_SESSION['eligibility']['emi_purpose'];
	$amount = $_SESSION['eligibility']['amount'];
	$years = $_SESSION['eligibility']['years'];
	$rate = $_SESSION['eligibility']['rate'];
	$other_emi = $_SESSION['eligibility']['other_emi'];
	$loan_eligibility = $_SESSION['eligibility']['loan_eligibility'];
	$monthly_emi = $_SESSION['eligibility']['monthly_emi'];
	
	if($otp==$_REQUEST['checkotp']){
	$info['name'] = $name;
	$info['email'] = $email;
	$info['mobile_no'] = $mobile_no;
	$info['emi_purpose'] = $emi_purpose;
	$info['amount'] = $amount;
	$info['years'] = $years;
	$info['rate'] = $rate;
	$info['other_emi'] = $other_emi;
	$info['loan_eligibility'] = $loan_eligibility;
	$info['monthly_emi'] = $monthly_emi;
	$info['clcType'] = 'eli';
	$info['currentDatetime'] = date('Y-m-d H:i:s');
	$lastId = add_record($dbObj,PREFIX."home_loan_enquiry",$info);
	//echo $dbObj->dbQuery;exit;
		
	//mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Home Loan Eligibility";
	$mail->Subject = "Cleardeals Home Loan Eligibility";
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"> '.ucwords($name).' has calculate Cleardeals Home Loan Eligibility. </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($name).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$email.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$mobile_no.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Emi Purpose : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$emi_purpose.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Gross Income : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($amount)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Years : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$years.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Rate : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$rate.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Other Emi : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($other_emi)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Loan Eligibility : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($loan_eligibility)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Monthly Emi : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($monthly_emi)).'</font></td>
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
	
	$mail->Send();
	$mail->ClearAllRecipients();
	
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Home Loan Eligibility";
	$mail->Subject = "Cleardeals Home Loan Eligibility";
	$mail->AddAddress($email,$name);
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($name).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Home Loan Eligibility" <br /><br />Our Support Team will contact you soon. <br /><br />
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

	$mail->Send();
	$mail->ClearAllRecipients();
		
	unset($_SESSION['eligibility']);
	
	echo $lastId;
	}else{
	echo 2;
	}

	//echo 1;
	exit;
}

//emi
if($mode=='emi'){
		
	$_SESSION['emi']['loan_eligibility'] = $dbObj->sc_mysql_escape($_REQUEST['loan_eligibility']);
	$_SESSION['emi']['years'] = $dbObj->sc_mysql_escape($_REQUEST['years']);
	$_SESSION['emi']['rate'] = $dbObj->sc_mysql_escape($_REQUEST['rate']);
	$_SESSION['emi']['monthly_emi'] = $dbObj->sc_mysql_escape($_REQUEST['monthly_emi']);
	$_SESSION['emi']['intrest'] = $dbObj->sc_mysql_escape($_REQUEST['intrest']);
	$_SESSION['emi']['totalPay'] = $dbObj->sc_mysql_escape($_REQUEST['totalPay']);
	
	$_SESSION['emi']['emi_name'] = $dbObj->sc_mysql_escape($_REQUEST['emi_name']);
	$_SESSION['emi']['emi_email'] = $dbObj->sc_mysql_escape($_REQUEST['emi_email']);
	$_SESSION['emi']['emi_mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['emi_mobile_no']);
	$_SESSION['emi']['emi_purpose_cal'] = $dbObj->sc_mysql_escape($_REQUEST['emi_purpose_cal']);
	
	//generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['emi']['emi_otp'] = $rndno;//exit;
	include('emimobileAPI.php');
	
	$allEmiVal = $_SESSION['emi']['emi_otp'].','.$_SESSION['emi']['emi_name'].','.$_SESSION['emi']['emi_email'].','.$_SESSION['emi']['emi_mobile_no'].','.$_SESSION['emi']['emi_purpose_cal'].','.$_SESSION['emi']['loan_eligibility'].','.$_SESSION['emi']['years'].','.$_SESSION['emi']['rate'].','.$_SESSION['emi']['monthly_emi'].','.$_SESSION['emi']['intrest'].','.$_SESSION['emi']['totalPay'];

	echo $allEmiVal;
	exit;
}


//emi varify otp
if($mode=='emiOtp'){
	
	//$otpData = explode(',', $dbObj->sc_mysql_escape($_REQUEST['otpdataEmi']));
	$otp = $_SESSION['emi']['emi_otp'];
	//$otp = $otpData[0];
	$emi_name = $_SESSION['emi']['emi_name'];
	$emi_email = $_SESSION['emi']['emi_email'];
	$emi_mobile_no = $_SESSION['emi']['emi_mobile_no'];
	$emi_purpose_cal = $_SESSION['emi']['emi_purpose_cal'];
	$loan_eligibility = $_SESSION['emi']['loan_eligibility'];
	$years = $_SESSION['emi']['years'];
	$rate = $_SESSION['emi']['rate'];
	$monthly_emi = $_SESSION['emi']['monthly_emi'];
	$intrest = $_SESSION['emi']['intrest'];
	$totalPay = $_SESSION['emi']['totalPay'];
	
	if($otp==$_REQUEST['checkemiotp']){
	$info['name'] = $emi_name;
	$info['email'] = $emi_email;
	$info['mobile_no'] = $emi_mobile_no;
	$info['emi_purpose'] = $emi_purpose_cal;
	$info['years'] = $years;
	$info['rate'] = $rate;
	$info['loan_eligibility'] = $loan_eligibility;
	$info['monthly_emi'] = $monthly_emi;
	$info['intrest'] = $intrest;
	$info['totalPay'] = $totalPay;
	$info['clcType'] = 'emi';
	$info['currentDatetime'] = date('Y-m-d H:i:s');
	$lastIdVal = add_record($dbObj,PREFIX."home_loan_enquiry",$info);
	//echo $dbObj->dbQuery;exit;
		
	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Home Loan Emi";
	$mail->Subject = "Cleardeals Home Loan Emi";
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"> '.ucwords($emi_name).' has calculate Cleardeals Home Loan Emi. </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			<b>User details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.ucwords($emi_name).'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$emi_email.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Mobile No : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$emi_mobile_no.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Emi Purpose : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$emi_purpose_cal.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Loan Amount : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($loan_eligibility)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Years : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$years.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Rate : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$rate.'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Monthly Emi : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($monthly_emi)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Interest Amount : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($intrest)).'</font></td>
                      </tr>
					  <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Total Amount Payble : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.moneyFormatIndia(round($totalPay)).'</font></td>
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
	$mail->FromName = "Cleardeals Home Loan Emi";
	$mail->Subject = "Cleardeals Home Loan Emi";
	$mail->AddAddress($emi_email,$emi_name);
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($emi_name).',</font></td>
          </tr>
        
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;">
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> 
			Thank you for your Enquiry on "Home Loan Emi" <br /><br />Our Support Team will contact you soon. <br /><br />
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
		
		unset($_SESSION['emi']);
		echo $lastIdVal;
		}else{
			echo 2;
			}
		//echo 1;
		exit;
}
if($mode=='getcity'){
	
	  $city = $_REQUEST['city'] ?? "";
	  $dbObj->dbQuery="select * from ".PREFIX."location where city='".$city."'";
	  $dbLocation = $dbObj->SelectQuery(); 
	  
	  for($i=0;$i<count($dbLocation);$i++){
		   $data.='"'.$dbLocation[$i]['location'].'",';
	  }
	  $newdata = substr($data, 0, -1);
	 
	
	echo $newdata; exit;
	
}


?>