<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<!-- Header -->
<div  class="center-section-in">
  <header class="masthead2">
    <div class="container text-center mt-10">
      <div class="clearfix"></div>
      <h4 class="wow fadeIn"> THANK YOU FOR YOUR REVIEW </h4>
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>
