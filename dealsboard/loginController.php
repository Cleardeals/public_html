<?php
ob_start();
// Check if a session ID exists in the cookie and restore it
if (isset($_COOKIE['PHPSESSID'])) {
    session_id($_COOKIE['PHPSESSID']); // Use existing session ID
}
// Set session parameters
session_set_cookie_params([
    'lifetime' => 86400, // 1 day
    'path' => '/',
    'domain' => "127.0.0.1", // Change to actual domain in production
    'secure' => false, // Set `true` if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
// Ensure session ID is stored in a cookie to persist across requests
setcookie("PHPSESSID", session_id(), [
    'expires' => time() + 86400, // 1-day expiration
    'path' => '/',
    'domain' => "127.0.0.1", // Change to actual domain in production
    'secure' => false, // Set to `true` if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR . 'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR . 'function.database.php'); // file to access predefined PHP functions
include(PHP_FUNCTION_DIR . "module_functions.php"); // to use user-defined functions like execute query
include(PHP_FUNCTION_DIR . "server_side_validation.php"); // to use user-defined functions
require_once(PHP_FUNCTION_DIR . 'class.phpmailer.php'); // to send mail
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
$sessionId = session_id();
if ($mode == "login_step1") {
    $name = $dbObj->sc_mysql_escape($_POST['username'] ?? "");
    $postData = json_encode(["username" => $name]);
    $ch = curl_init("$apiBaseUrl/send-otp");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Cookie: PHPSESSID=$sessionId"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true); // Decode JSON response
    curl_close($ch);
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
if ($mode == "login") {
    $otp = $dbObj->sc_mysql_escape($_POST['otp'] ?? "");
    $postData = json_encode(["otp" => $otp]);
    $ch = curl_init("$apiBaseUrl/verify-otp");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Cookie: PHPSESSID=$sessionId"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseData = json_decode($response, true); 
    curl_close($ch);
    error_log("OTP Verification: HTTP Code: $httpCode, Response: " . json_encode($responseData, JSON_PRETTY_PRINT));
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