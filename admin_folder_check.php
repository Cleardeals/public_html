<?php
session_start();

function login_check1() {
    if (!isset($_SESSION['is_admin'])) {
        $msg = base64_encode("Please Login");
        //header("Location: /public_html/dealsboard/index.php?mo=login&msg=".$msg);
         header("Location: /dealsboard/index.php?mo=login&msg=".$msg);
        exit;
    }
}

// Check if the user is an admin
login_check1();

// Get the requested path
$requested_path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];

// If the path is a directory, list files
if (is_dir($requested_path)) {
    $files = scandir($requested_path);
    echo "<h3>Directory Listing for: " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</h3>";

    foreach ($files as $file) {
        if ($file !== "." && $file !== "..") {
            echo "<li><a href='" . $_SERVER['REQUEST_URI'] . "/" . $file . "'>$file</a></li>";
        }
    }
} elseif (is_file($requested_path)) {
    // Serve the requested file
    header("Content-Type: " . mime_content_type($requested_path));
    readfile($requested_path);
    exit;
} else {

    http_response_code(404);
    echo "Error: File or Directory Not Found!";
}
?>