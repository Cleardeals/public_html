<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='12'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package where id='1' and property_type='sell' and status='1'";
$dbSellPackage = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package where id='2' and property_type='rent' and status='1'";
$dbRentPackage = $dbObj->SelectQuery();
?>

<header class="pricing-banner">
  <div class="container">
    <h2 class="mb-5 wow fadeInDown font-44">We Serve</h2>
    <div class="pricing-header">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/ahmedabad.jpg" class="white-boder rounded-circle">
          <h4 class="font-16 text-uppercase">Ahmedabad</h4>
          <span class="font-17 font-italic">Gujarat</span></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/gandhinagar.jpg" class="white-boder rounded-circle">
          <h4 class="font-16 text-uppercase">Gandhinagar</h4>
          <span class="font-17 font-italic">Gujarat</span></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/vadodara.jpg" class="white-boder rounded-circle">
          <h4 class="font-16 text-uppercase">Vadodara</h4>
          <span class="font-17 font-italic">Gujarat</span></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/surat.jpg" class="white-boder rounded-circle">
          <h4 class="font-16 text-uppercase">SURAT</h4>
          <span class="font-17 font-italic">Gujarat</span></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</header>

<!--package-->

<div class="package">
  <div class="container">
    <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
    <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInDown">
      <?=$heading[0] ?? ""?>
      <span class="themecolor">
      <?=$heading[1] ?? ""?>
      </span> </h2>
    <div class="center-div2 row">
      <div class="col-md-6 wow fadeInLeft">
        <div class="package1 text-center">
          <h2><sup class="rs">₹</sup>
            <?=floor($dbRentPackage[0]['cost'])?>
            <sup class="star">*</sup></h2>
          <span class="text-blue">Incl.GST</span>
          <p>PER Property</p>
          <div class="validity">
            <h3 class="font-17 text-uppercase font-medium montserrat"><span>Validity:</span>
              <?=$dbRentPackage[0]['validity']?>
            </h3>
            <h4 class="text-uppercase font-21 montserrat font-weight-bold">Premium Package</h4>
            
            <!--<a data-fancybox="packages-pop1" data-src="#packages-pop1" href="javascript:;" class="font-16 click-more text-uppercase font-900 montserrat">CLICK MORE <i class="fa fa-long-arrow-right font-16"></i></a>--> 
            
            <br>
            <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" class="btn border-0 font-16 text-uppercase font-900 montserrat rent-my-property text-white">Rent my property <i class="flaticon-play-button"></i></a> </div>
        </div>
      </div>
      <?php 
		
		if($dbSellPackage[0]['onhome']=='plan1'){
			
			$planprice = number_format($dbSellPackage[0]['cost']);
			$planvaliduty = $dbSellPackage[0]['validity'];
			$plantext = $dbSellPackage[0]['plan1'];
			
		} else if($dbSellPackage[0]['onhome']=='plan2'){
			
			$planprice = number_format($dbSellPackage[0]['cost_premium']);
			$planvaliduty = $dbSellPackage[0]['validity_premium'];
			$plantext = $dbSellPackage[0]['plan2'];
			
		} else if($dbSellPackage[0]['onhome']=='plan3'){
			
			$planprice = number_format($dbSellPackage[0]['cost_split']);
			$planvaliduty = $dbSellPackage[0]['validity_split'];
			$plantext = $dbSellPackage[0]['plan3'];
			
		}
		
		?>
      <div class="col-md-6 wow fadeInRight">
        <div class="package2 text-center">
          <h2><sup class="rs">₹</sup><?php echo $planprice;?><sup class="star">*</sup></h2>
          <span class="themecolor">Incl.GST</span>
          <p>PER Property</p>
          <div class="validity2">
            <h3 class="font-17 text-uppercase font-medium montserrat"><span>Validity:</span>
              <?=$planvaliduty?>
            </h3>
            <h4 class="text-uppercase font-21 montserrat font-weight-bold">
              <?=$plantext?>
            </h4>
            
            <!--<a data-fancybox="packages-pop2" data-src="#packages-pop2" href="javascript:;" class="font-16 click-more2 text-uppercase font-900 montserrat" >CLICK MORE <i class="fa fa-long-arrow-right font-16"></i></a>--> 
            
            <br>
            <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="btn border-0 font-16 text-uppercase font-900 montserrat sell-my-property text-white">Sell my property <i class="flaticon-play-button"></i></a> </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>

<!--package-->
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>