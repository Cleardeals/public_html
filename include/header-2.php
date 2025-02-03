<style>
body {
	padding: 73px 0 0 0!important;
}
@media (max-width:992px) {
.center-section-in {
	padding-top: 0!important
}
}
</style>
<?php
//ead7be057a9b75c81a0a40741881ef46

$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';

$pageurl = $dbObj->sc_mysql_escape($_REQUEST['url'] ?? "");

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."services where status='1'";
$dbServices = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from states";
$dbStates = $dbObj->SelectQuery();
//unset($_SESSION['sign_up']);
?>
<style>
#errorpop1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
#errorpop2 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
.box-css4 {
	padding: 20px
}
 @media (min-width: 576px) {
.modal-dialog {
	margin: 8.75rem auto;
}
</style>
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu nav-boder" id="mainNav">
  <div class="container-fluid">
    <div class="row">
      <div class="container"> <a class="navbar-brand js-scroll-trigger" href="<?=HTACCESS_URL?>"> <img src="<?=HTACCESS_URL?>assets/img/logo.png"></a>
        <div class="navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav montserrat">
            <li class="nav-item none-nav"><a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3" target="_blank">Home  Loan EMI Calculator </a> </li>
            <li class="nav-item none-nav"><a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3" target="_blank"> Home Loan Eligiblity
              Calculator </a></li>
            <li class="nav-item none-nav"> <a href="tel:+9723992226" class="btn text-white call-bt call-bt2"> <i class="flaticon-phone"></i> 9723992226 </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Header -->