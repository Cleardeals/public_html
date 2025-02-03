<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent WHERE id='9'";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."contact_detail where id='1'";
$dbContact = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."social_links";
$dbSocial = $dbObj->SelectQuery();
?>
<div  class="center-section-in">
  <div class="container">
   <?php $heading = explode(' ',$dbSiteContent[0]['heading'],2); ?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> <?=$heading[0] ?? ""?> <span class="themecolor"><?=$heading[1] ?? ""?></span> </h2>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 text-center contact-css wow fadeInLeft">
        <div class="text-center"> <i class="flaticon-home-page font-24 themecolor" aria-hidden="true"></i></div>
        <h4 class="font-18"><?=substr($dbContact[0]['address'],0,24)?></h4>
        <p class="font-16"><?=substr($dbContact[0]['address'],24)?></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center contact-css wow fadeInLeft">
        <div class="text-center"> <i class="flaticon-mail font-24 themecolor" aria-hidden="true"></i></div>
        <h4 class="font-18">Send us an Email</h4>
        <p class="font-16"><a href="mailto:<?=$dbContact[0]['email']?>"><?=$dbContact[0]['email']?></a></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center contact-css wow fadeInLeft">
        <div class="text-center"> <i class="fa fa-mobile-phone font-28 themecolor" aria-hidden="true"></i></div>
        <h4 class="font-18">Call Us</h4>
        <p class="font-16"><a href="tel:<?=$dbContact[0]['contact_no']?>"><?=$dbContact[0]['contact_no']?></a></p>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 text-center contact-css wow fadeInLeft">
        <div class="text-center"> <i class="fa fa-twitter font-24 themecolor" aria-hidden="true"></i></div>
        <h4 class="font-18">Follow Us on</h4>
        <div class="social-media2">
        <?php if($dbSocial[0]['status']=='1') {?>
        <a href="<?=$dbSocial[0]['link']?>" target="<?=$dbSocial[0]['target']?>">
        <i class="fa fa-facebook" aria-hidden="true"></i></a>
        <?php }?>
        <?php if($dbSocial[1]['status']=='1') {?>
        <a href="<?=$dbSocial[1]['link']?>" target="<?=$dbSocial[1]['target']?>">
        <i class="fa fa-twitter" aria-hidden="true"></i></a>
        <?php }?>
        <?php if($dbSocial[2]['status']=='1') {?>
        <a href="<?=$dbSocial[2]['link']?>" target="<?=$dbSocial[2]['target']?>">
        <i class="fa fa-instagram" aria-hidden="true"></i></a>
        <?php }?>
        <?php if($dbSocial[3]['status']=='1') {?>
        <a href="<?=$dbSocial[3]['link']?>" target="<?=$dbSocial[3]['target']?>">
        <i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <?php }?>
        </div>
      </div>
    </div>
    <div class="map wow fadeIn">
      <div class="embed-responsive embed-responsive-16by9">
      <?php if(!empty($dbContact[0]['google_map'])){?>
        <?=$dbContact[0]['google_map']?>
        <?php }?>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
