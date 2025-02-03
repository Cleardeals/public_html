<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where user_id='".$_SESSION['user']['userid']."'";
$dbUserPropDetail = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn">Cleardeals <span class="themecolor">Dashboard!</span></h2>
        <div class="row">
          <!--<div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>sell-property-listing/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/home.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Search Property</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"><a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/sale.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark"> Sell property </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"><a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/for-rent.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark"> Rent property </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>book-free-valuation/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/icons/004-quote.png" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark">Book Free Valuation</h4>
                </div>
              </div>
              </a> </div>
          </div>-->
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>your-favourite-properties/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/icons/002-plus.png" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark"> Your Favourite Properties</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>properties-for-you/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/icons/003-salesman.png" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark"> Let Nik find Properties for you</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"><a href="<?=HTACCESS_URL?>support/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/icons/speech-bubble.png" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark"> Customer Support</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <!--<div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>services/#propertyservice1" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/icons/005-patent.png" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark">Property Legal Service </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>services/#propertyservice2" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/loan.svg" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark">Financial - Loan Service</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>services/#propertyservice3" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/truck.svg" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark"> Movers and Packers </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card">
            <a href="<?=HTACCESS_URL?>services/#propertyservice4" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> 
                <img src="<?=HTACCESS_URL?>assets/img/furniture.svg" width="40" class="top-icons"/>
                  <h4 class="mt-15 font-14 text-dark">
                  Interiors and Furnishings</h4>
                </div>
              </div>
              </a>
             </div>
          </div>-->
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>recent-property/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/recent.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Recent property </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>billing-invoice/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/payment-receipt.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Payment Receipt for Paid Client </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>progress-report/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/report.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Progress Report for Paid Client </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>my-account/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/edit-my-profile.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Edit My Profile </h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=HTACCESS_URL?>change-password/" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/change-password.svg" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">change password</h4>
                </div>
              </div>
              </a> </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="card"> <a href="<?=$dbUserPropDetail[0]['property_link'] ?? ""?>" target="_blank">
              <div class="card-body pt-40 pl-10 pr-10">
                <div class="no-block text-center text-themecolor"> <img src="<?=HTACCESS_URL?>assets/img/005-patent.png" width="40" class="top-icons">
                  <h4 class="mt-15 font-14 text-dark">Property Link</h4>
                </div>
              </div>
              </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include(INCLUDE_DIR.'footer1.php'); ?>