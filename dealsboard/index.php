<?php
ob_start();
session_start();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
require_once("../config.php"); // include confog file
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject

$mo = (isset($_REQUEST['mo']))?$_REQUEST['mo']:"dashboard"; // to request default page 
include(ADMIN_INCLUDE_DIR.'head.php');
?>
<!-- Main Container Start -->
<?php include(ADMIN_MODULE_DIR.$mo.'.php');?>
<!-- Main Container End -->
</body>
</html>