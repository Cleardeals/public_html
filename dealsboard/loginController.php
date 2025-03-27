<?php
ob_start();
require_once 'session_config.php'; // Ensure the session is consistent
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR . 'DBConnection.php'); // Database connection
require_once(PHP_FUNCTION_DIR . 'function.database.php'); // Predefined PHP functions
include(PHP_FUNCTION_DIR . "module_functions.php"); // User-defined functions (like execute query)
include(PHP_FUNCTION_DIR . "server_side_validation.php"); // Validation functions
require_once(PHP_FUNCTION_DIR . 'class.phpmailer.php'); // To send mail
$dbObj = new DBConnection();
$mode = $_REQUEST['mode'] ?? "";
$link = $dbObj->sc_mysql_escape($_REQUEST['link'] ?? "");
$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? "");
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
if ($mode == 'logout') {
    unset($_SESSION['is_admin']);
    unset($_SESSION['admin_user_name']);
    unset($_SESSION['access']);
    unset($_SESSION['srgit_cms_admin_id']);
    $msg = base64_encode("Logout successfully...");
    header('location:index.php?mo=login&msg=' . $msg);
    exit;
}
$apiBaseUrl = AUTH_MICROSERVICE_URL ?? "http://127.0.0.1:3000/auth";
if ($mode == "login_step1") {
    $name = $dbObj->sc_mysql_escape($_POST['username'] ?? "");
    $postData = json_encode(["username" => $name]);

    // Get the current session cookie
    $cookies = [];
    foreach ($_COOKIE as $key => $value) {
        $cookies[] = "$key=$value";
    }
    $cookieString = implode('; ', $cookies);

    // cURL request to send OTP
    $ch = curl_init("$apiBaseUrl/send-otp");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Cookie: $cookieString"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  // Save cookies to file
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');  // Load cookies from file

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true);
    curl_close($ch);

    // Log the response for debugging
    error_log("Send OTP Response - HTTP Code: $httpCode, Response: " . json_encode($responseData, JSON_PRETTY_PRINT));

    if ($httpCode === 200 && isset($responseData['success']) && $responseData['success'] === true) {
        $msg = base64_encode("OTP request sent successfully.");
        header("location:index.php?mo=login-otp&msg=" . $msg);
        exit;
    } else {
        // Get the error message from the response if available
        $errorMessage = $responseData['message'] ?? "Failed to send OTP. Please try again.";
        $msg = base64_encode($errorMessage);
        header("location:index.php?mo=login&msg=" . $msg);
        exit;
    }
}
if ($mode == "login") {
    $otp = $dbObj->sc_mysql_escape($_POST['otp'] ?? "");
    $postData = json_encode(["otp" => $otp]);

    // Log the request details
    error_log("OTP Verification Request - OTP: $otp, PostData: $postData");

    // Get the current session cookie
    $cookies = [];
    foreach ($_COOKIE as $key => $value) {
        $cookies[] = "$key=$value";
    }
    $cookieString = implode('; ', $cookies);

    // cURL request to verify OTP
    $ch = curl_init("$apiBaseUrl/verify-otp");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Cookie: $cookieString"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');  // Save cookies to file
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');  // Load cookies from file

    // Add error handling for curl
    if (curl_errno($ch)) {
        error_log("Curl Error: " . curl_error($ch));
        $msg = base64_encode("Connection error occurred. Please try again.");
        header('location:index.php?mo=login-otp&msg=' . $msg);
        exit;
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true);
    curl_close($ch);

    // Enhanced logging
    error_log("OTP Verification Details:");
    error_log("HTTP Code: $httpCode");
    error_log("Raw Response: $response");
    error_log("Decoded Response: " . json_encode($responseData, JSON_PRETTY_PRINT));

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
        header('location:index.php?mo=dashboard');
        exit;
    } else {
        $msg = base64_encode("Invalid OTP...");
        header('location:index.php?mo=login-otp&msg=' . $msg);
        exit;
    }
}
