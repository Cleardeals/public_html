<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='7'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."faq where status='1' order by display_order";
$dbFaq = $dbObj->SelectQuery();
?>

<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">
      <?=$dbSitecontent[0]['heading']?>
      <span class="themecolor"></span> </h2>
    <div id="accordion">
      <?php for($i=0;$i<count((array)$dbFaq);$i++){?>
      <?php if($i==0){?>
      <button class="ff_faq_header btn btn-link montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="true" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
      <?=$dbFaq[$i]['question']?>
      </button>
      <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse show" data-parent="#accordion">
        <div class="ff_faq_item">
          <?=$dbFaq[$i]['answer']?>
        </div>
      </div>
      <?php }else{?>
      <button class="ff_faq_header btn btn-link collapsed montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="false" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
      <?=$dbFaq[$i]['question']?>
      </button>
      <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse montserrat" data-parent="#accordion">
        <div class="ff_faq_item">
          <?=$dbFaq[$i]['answer']?>
        </div>
      </div>
      <?php }?>
      <?php }?>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
