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
      <h1 class="mb-1 blue-text">Thank you for request call back.</h1>
      <div class="clearfix"></div>
      <h4 class="wow fadeIn"> We will get back to you soon.</h4>
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<script>
		fbq('track', 'Lead', {currency: "INR", value: 1.00});
	</script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
