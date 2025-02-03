<?php
session_start();
// Database connection
$servername = "localhost"; 
$username = "cleardealsconi_awards"; 
$password = "Himesh@21"; 
$dbname = "cleardealsconi_awards";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $login_username = $_POST['username'];
        $login_password = $_POST['password'];
        
        // Replace these with your actual credentials
        $actual_username = 'admin'; 
        $actual_password = 'Himesh@21'; // Use hashed passwords in a real application
        
        // Check if login credentials are correct
        if ($login_username === $actual_username && $login_password === $actual_password) {
            $_SESSION['loggedin'] = true;
        } else {
            $login_error = "Invalid username or password.";
        }
    }
} else {
    // Handle form submission for uploading awards if logged in
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
        $award_name = $_POST['award_name'];
        $award_date = $_POST['award_date'];
        $award_place = $_POST['award_place'];
        $award_description = $_POST['award_description'];
        $award_image = $_FILES['award_image']['name'];

        if ($_FILES['award_image']['error'] !== UPLOAD_ERR_OK) {
            die("File upload error: " . $_FILES['award_image']['error']);
        }

        // Image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($award_image);
        if (move_uploaded_file($_FILES['award_image']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO awards (award_name, award_date, award_place, award_description, award_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $award_name, $award_date, $award_place, $award_description, $target_file);
            if ($stmt->execute()) {
                $upload_message = "New record created successfully";
            } else {
                $upload_message = "Error: " . $stmt->error;
            }
        } else {
            $upload_message = "File could not be uploaded.";
        }
    }

    // Handle logout request
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Award</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($login_error)): ?>
            <p style="color:red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login" name="login">
        </form>
    </div>
<?php else: ?>
    <div class="container">
        <h2>Upload Award</h2>
        <?php if (isset($upload_message)): ?>
            <p><?php echo $upload_message; ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label for="award_name">Award Name:</label>
            <input type="text" id="award_name" name="award_name" required>

            <label for="award_date">Award Date:</label>
            <input type="date" id="award_date" name="award_date" required>

            <label for="award_place">Award Place:</label>
            <input type="text" id="award_place" name="award_place" required>

            <label for="award_description">Award Description:</label>
            <textarea id="award_description" name="award_description" required></textarea>

            <label for="award_image">Award Image:</label>
            <input type="file" id="award_image" name="award_image" accept="image/*" required>

            <input type="submit" value="Upload Award" name="upload">
        </form>
        <form method="post" style="margin-top: 20px;">
            <input type="submit" value="Logout" name="logout">
        </form>
    </div>
<?php endif; ?>

</body>
</html>
