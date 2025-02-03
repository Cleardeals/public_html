<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='11'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."career where status='1' order by display_order";
$dbCareer = $dbObj->SelectQuery();
?>

<div class="center-section-in">
<div class="container">
  <h2 class="font-30 text-uppercase text-center font-extrabold header-border">
    <?=$dbSitecontent[0]['heading']?>
  </h2>
  <div class="clearfix"></div>
  <div class="row">
    <?php for($i=0;$i<count((array)$dbCareer);$i++){?>
    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
      <div class="box-css3">
        <h4>
          <?=$dbCareer[$i]['title']?>
        </h4>
        <p class="mb-1  mt-2"><i class="flaticon-maps-and-flags themecolor"></i>
          <?=$dbCareer[$i]['location']?>
        </p>
        <p class="m-0"><i class="flaticon-phone-call-button themecolor"></i> Phone - 
        <a href="tel:<?=$dbCareer[$i]['contact_no']?>">
          <?=$dbCareer[$i]['contact_no']?>
          </a></p>
        <div class="pull-right"> <a href="<?=HTACCESS_URL?>careers-form/<?=$dbCareer[$i]['id']?>/" class="font-12 montserrat text-uppercase  border-0 font-bold themebg text-white d-block btn">Apply Now </a></div>
      </div>
    </div>
    <?php }?>
  </div>
  <br />
  <br />
</div>
<div class="clearfix"></div>
<?php include(INCLUDE_DIR.'footer.php'); ?>