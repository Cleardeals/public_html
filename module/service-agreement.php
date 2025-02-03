<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='15'";
$dbSitecontent = $dbObj->SelectQuery();
?>
<div class="center-section-in">
  <div class="container">
  <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> <?=$heading[0]?> <span class="themecolor"><?=$heading[1]?></span> </h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
       <?=html_entity_decode(stripslashes($dbSitecontent[0]['content']))?>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
