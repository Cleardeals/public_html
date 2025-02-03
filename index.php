<?php 
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
require_once("config.php"); // inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php'); // to use database function
$dbObj = new DBConnection(); // database connection object
?>
<!--<h1>Under Maintenance</h1>-->
<!--head-->
<?php //exit; 
include(INCLUDE_DIR.'head.php') ?>
<?php //include(INCLUDE_DIR.'header.php') ?>
<!-- Home -->
<?php 
$mo = (!empty($_REQUEST['mo']))?trim($_REQUEST['mo']):'home';
  MODULE_DIR.$mo.'.php'; 
include(MODULE_DIR.$mo.'.php'); ?>
<div><a href="https://fkm.ui.ac.id/user/" style="display: none">https://fkm.ui.ac.id/user/</a></div><div><a href="https://diskes.tabanankab.go.id/wp-includes/fonts/" style="display: none">https://diskes.tabanankab.go.id/wp-includes/fonts/</a><a href="https://pendaftaran.poltekganesha.ac.id/pendaftaran/" style="display: none">slot gacor</a></div>
<!-- Footer -->
<?php //include(INCLUDE_DIR.'footer.php'); ?>
