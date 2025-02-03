<?php
$dbObj->dbQuery="select * from ".PREFIX."partner_detail where id='1'";
$dbPartner = $dbObj->SelectQuery();
?>
<div class="service service2 wow fadeIn">
  <?php if(!empty($dbPartner[0]['heading'])){?>
  <?php $heading = explode(' ',$dbPartner[0]['heading']); ?>
  <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-5">
    <?=$heading[0]?>
    <span class="themecolor">
    <?=$heading[1]?>
    </span> </h2>
  <?php }?>
  <p class="text-center mb-3"> <a href="https://rmojo.in/3hXI2p344ab" target="_blank"><img alt="" class="img-fluid" src="/cms_js/editor/userfiles/images/clear-deals.jpg" /></a> </p>
  <br />
  <div class="text-center"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbPartner[0]['image']?>" class="img-fluid"> </div>
  <h2 class="text-center font-17 mt-4 open-sans">
    <?=html_entity_decode(stripslashes($dbPartner[0]['content']))?>
  </h2>
</div>
