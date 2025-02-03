<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>

<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<!-- Header -->
<div class="center-section-in">
  <header class="masthead2">
    <div class="container text-center mt-10">
      <h2 class="mb-1 blue-text" style="font-size:34px;">Thanks for your billing </h2>
      <div class="clearfix"></div>
      <br />
      
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>