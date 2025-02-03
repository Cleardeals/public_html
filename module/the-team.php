<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='10'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."team where status='1' order by display_order";
$dbTeam = $dbObj->SelectQuery();
?>
<div class="center-section-in">
<div class="container">
<?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
  <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"><?=$heading[0]?> <span class="themecolor"><?=$heading[1]?></span></h2>
  <!-- Section: Team v.1 -->
  <section class="team-section text-center">
    <!-- Grid row -->
    <div class="row">
      <!-- Grid column -->
      <?php for($i=0;$i<count((array)$dbTeam);$i++){?>
      <div class="col-lg-3 col-md-6 mb-lg-4 mb-4">
        <div class="box-boder p-1 pb-4">
          <div class="avatar mx-auto">
          <img src="<?=HTACCESS_URL?>cms_images/team/original/<?=$dbTeam[$i]['image']?>" class="img-fluid w-100">
          </div>
          <h5 class="font-weight-bold mt-4 mb-3"><?=$dbTeam[$i]['name']?></h5>
          <p class="text-uppercase blue-text"><strong><?=$dbTeam[$i]['designation']?></strong></p>
          <p class="grey-text"><?=$dbTeam[$i]['short_desc']?></p>
          <ul class="list-unstyled mb-0 social-link">
            <!-- Facebook -->
            <?php if(!empty($dbTeam[$i]['fb'])){?>
            <a href="<?=$dbTeam[$i]['fb']?>" target="_blank" class="p-2 fa-lg fb-ic">
            <i class="fa fa-facebook"></i> </a>
            <?php }?>
            <!-- Twitter -->
            <?php if(!empty($dbTeam[$i]['twitter'])){?>
            <a href="<?=$dbTeam[$i]['twitter']?>" target="_blank" class="p-2 fa-lg tw-ic">
            <i class="fa fa-twitter"></i> </a>
            <?php }?>
            <!-- Instagram -->
            <?php if(!empty($dbTeam[$i]['insta'])){?>
            <a href="<?=$dbTeam[$i]['insta']?>" target="_blank" class="p-2 fa-lg ins-ic">
            <i class="fa fa-instagram"></i> </a>
            <?php }?>
          </ul>
        </div>
      </div>
      <?php }?>
      <!-- Grid column -->
  </section>
  <div class="clearfix"></div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>