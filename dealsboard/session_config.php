<?php
ob_start();
$logFile = __DIR__ . '/session_log.txt'; // Log file to track session IDs
if (session_status() === PHP_SESSION_NONE) {
    if (isset($_COOKIE['PHPSESSID'])) {
        session_id($_COOKIE['PHPSESSID']); // Use the existing session ID from the cookie
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - Using existing session ID: " . $_COOKIE['PHPSESSID'] . "\n", FILE_APPEND);
    } else {
        $fixedSessionId = "MY_STATIC_SESSION_ID"; // Set a static session ID
        session_id($fixedSessionId);
        setcookie("PHPSESSID", $fixedSessionId, [
            'expires' => time() + 86400,
            'path' => '/',
            'domain' => "127.0.0.1",
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - Created new static session ID: " . $fixedSessionId . "\n", FILE_APPEND);
    }
    session_start();
}
$SESSION_ID = session_id(); // Store session ID in a variable
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Active session ID: " . $SESSION_ID . "\n", FILE_APPEND);
?>