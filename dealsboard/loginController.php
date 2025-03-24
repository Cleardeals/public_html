<?php
ob_start();
session_start();
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR . 'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR . 'function.database.php'); // file to access predefined PHP functions
include(PHP_FUNCTION_DIR . "module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR . "server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR . 'class.phpmailer.php'); // to send mail 
$dbObj = new DBConnection();

$mode = $_REQUEST['mode'] ?? "";
$link = $dbObj->sc_mysql_escape($_REQUEST['link'] ?? "");
$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? "");
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//LOGOUT MODULE
if ($mode == 'logout') {
    unset($_SESSION['is_admin']);
    unset($_SESSION['admin_user_name']);
    unset($_SESSION['access']);
    unset($_SESSION['srgit_cms_admin_id']);
    // Unsetting other session variables...

    $msg = base64_encode("Logout successfully...");
    header('location:index.php?mo=login&msg=' . $msg);
    exit;
}

// Read API Base URL from environment variables
$apiBaseUrl = AUTH_MICROSERVICE_URL ?? "http://127.0.0.1:3000/auth";

//LOGIN MODULE
if ($mode == "login_step1") {
    $name = $dbObj->sc_mysql_escape($_POST['username'] ?? "");

    // Prepare the request payload
    $postData = json_encode(["username" => $name]);

    // Initialize cURL
    $ch = curl_init("$apiBaseUrl/send-otp");

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true); // Decode JSON response
    // Close cURL session
    curl_close($ch);


    // Handle response
    if ($httpCode === 200 && isset($responseData['success']) && $responseData['success'] === true) {
        $msg = base64_encode("OTP request sent successfully.");
        header("location:index.php?mo=login-otp&msg=" . $msg);
        exit;
    } else {
        $msg = base64_encode("Failed to send OTP. Please try again.");
        header("location:index.php?mo=login-otp&msg=" . $msg);
        exit;
    }
}
//  else {
//     $msg = base64_encode("Invalid Username....");
//     header('location:index.php?mo=login&msg=' . $msg);
//     exit;
// }


//LOGIN OTP MODULE
if ($mode == "login") {
    $otp = $dbObj->sc_mysql_escape($_POST['otp'] ?? "");

    // Prepare the request payload
    $postData = json_encode(["otp" => $otp]);

    // Initialize cURL
    $ch = curl_init("$apiBaseUrl/verify-otp");

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true); // Decode JSON response

    // Close cURL session
    curl_close($ch);

    // Handle response
    if ($httpCode === 200 && isset($responseData['success']) && $responseData['success'] === true) {
        $_SESSION['is_admin'] = 1;
        $_SESSION['admin_user_name'] = $responseData['user']['username'];
        $_SESSION['srgit_cms_admin_id'] = $responseData['user']['id'];

        $access = explode(',', $responseData['user']['privilege'] ?? "");
        foreach ($access as $privilege) {
            if (!empty($privilege)) {
                $_SESSION[$privilege] = 'Y';
            }
        }

        unset($_SESSION['adminLogin']);
        header('location:index.php?mo=dashboard');
        exit;
    } else {
        $msg = base64_encode("Invalid OTP...");
        header('location:index.php?mo=login-otp&msg=' . $msg);
        exit;
    }
}

// Other codes for change password, forgot password, etc. remain unchanged ...
