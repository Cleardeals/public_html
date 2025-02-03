<?php
ob_start();
session_start();
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php'); // file to access predefined PHP functions
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection();

$mode = $_REQUEST['mode'] ?? "";
$link = $dbObj->sc_mysql_escape($_REQUEST['link'] ?? "");
$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? "");
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//LOGOUT MODULE
if($mode=='logout'){
    unset($_SESSION['is_admin']);
    unset($_SESSION['admin_user_name']);
    unset($_SESSION['access']);
    unset($_SESSION['srgit_cms_admin_id']);
    // Unsetting other session variables...
    
    $msg = base64_encode("Logout successfully...");
    header('location:index.php?mo=login&msg='.$msg);
    exit;
}

//LOGIN MODULE
if($mode=="login_step1"){ 
    $name = $dbObj->sc_mysql_escape($_POST['username'] ?? "");
    
    $dbObj->dbQuery="select * from ".PREFIX."adminuser where username='".$name."'";
    $dbResult = $dbObj->SelectQuery();
    
    if(count((array)$dbResult) > 0){
        // Setting fixed OTP
        $otp = 'Clear$Deals@1B$@1587';
        $_SESSION['adminLogin']['otp'] = $otp;
        $_SESSION['adminLogin']['mobile_no'] = $dbResult[0]['contact_no'];
        $_SESSION['adminLogin']['email'] = $dbResult[0]['email'];
        
        include('mobileAPI.php');
        
        $to = "".$dbResult[0]['full_name']." <".$dbResult[0]['email'].">";
        $subject = "Login Otp";  
        $message = '<table cellpadding="5" cellspacing="0" width="500px">
            <tr>
                <td><font face="Verdana" style="font-size:12px"> <b>Hello '.$dbResult[0]['full_name'].',</b></font></td>
            </tr>
            <tr>
                <td><font face="Verdana" style="font-size:12px"> Your otp is '.$_SESSION['adminLogin']['otp'].'.</font></td>
            </tr>
            <tr>
                <td><br />
                    <font face="Verdana" style="font-size:12px" color="#0B1D24"> <b>Regards,<br>
                    <font face="Verdana" style="font-size:12px" color="#0B1D24"> Cleardeals.co.in</font></b> </font></td>
            </tr>
        </table>';
        
        $header = "From:Cleardeals <contact@cleardeals.co.in> \r
";  
        $header .= "MIME-Version: 1.0 \r
";  
        $header .= "Content-type: text/html;charset=UTF-8 \r
";  
        
        // Send email
        $result = mail($to, $subject, $message, $header);
        
        $msg = base64_encode("Your otp has been sent to your email.");
        header('location:index.php?mo=login-otp&msg='.$msg);
        exit;    
    } else {
        $msg = base64_encode("Invalid Username....");
        header('location:index.php?mo=login&msg='.$msg);
        exit;
    }
}

//LOGIN OTP MODULE
if($mode=="login"){ 
    $otp = $dbObj->sc_mysql_escape($_POST['otp'] ?? "");

    $dbObj->dbQuery="select * from ".PREFIX."adminuser where contact_no='".$_SESSION['adminLogin']['mobile_no']."' and email='".$_SESSION['adminLogin']['email']."'";
    $dbResult = $dbObj->SelectQuery();

    if($otp==$_SESSION['adminLogin']['otp']){ // Check if the OTP matches
        $_SESSION['is_admin'] = 1;
        $_SESSION['admin_user_name'] = $dbResult[0]['username'];
        $_SESSION['srgit_cms_admin_id'] = $dbResult[0]['id'];

        $access = explode(',', $dbResult[0]['privilege'] ?? "");
        foreach ($access as $privilege) {
            if(!empty($privilege)){
                $_SESSION[$privilege] = 'Y';
            }
        }

        unset($_SESSION['adminLogin']);
        header('location:index.php?mo=dashboard');
        exit;    
    } else {
        $msg = base64_encode("Invalid Otp....");
        header('location:index.php?mo=login-otp&msg='.$msg);
        exit;
    }
}

// Other codes for change password, forgot password, etc. remain unchanged ...

?>
