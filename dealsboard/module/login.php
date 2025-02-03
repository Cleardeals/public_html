<?php
$msg = base64_decode($_REQUEST['msg'] ?? "");
?>
<!-- page css -->
<link href="assets/css/pages/login-register-lock.css" rel="stylesheet">
<body class="card-no-border login-register">
<!-- ============================================================== --> 
<!-- Preloader - style you can find in spinners.css --> 
<!-- ============================================================== -->
<div class="preloader">
  <div class="loader">
    <div class="lds-roller">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
</div>
<!-- ============================================================== --> 
<!-- Main wrapper - style you can find in pages.scss --> 
<!-- ============================================================== -->
<section id="wrapper">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material" id="loginform" action="loginController.php" method="post">
        <input type="hidden" name="mode" value="login_step1" />
        <h3 class="box-title mb-20 text-center text-uppercase text-blue">
        <img src="assets/images/logo-main.png"></h3>
        <?php if(!empty($msg)){ ?>
        <div style="color:#FF0000" class="mws-form-row">
          <?=$msg?>
        </div>
        <?php } ?>
        <div class="form-group mb-30">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="username" required="" placeholder="Username">
          </div>
        </div>
        <!--<div class="form-group mb-30">
          <div class="col-xs-12">
            <input class="form-control" name="password" type="password" required="" placeholder="Password">
          </div>
        </div>-->
        <!--<div class="form-group row mb-30">
          <div class="col-md-12">
            <div class="checkbox checkbox-info pull-left pt-0"> 
            <a href="index.php?mo=forgot_password" class="text-danger pull-right">forgot password?</a> </div>
          </div>
        </div>-->
        <div class="form-group text-center">
          <div class="col-xs-12">
            <button class="btn-block btn-rounded2 waves-effect waves-light" type="submit">LogIn</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- ============================================================== --> 
<!-- All Jquery --> 
<!-- ============================================================== --> 
<script src="assets/vendors/jquery/jquery.min.js"></script> 
<!-- Bootstrap tether Core JavaScript --> 
<script src="assets/vendors/bootstrap/js/popper.min.js"></script> 
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<!--Custom JavaScript --> 
<script>
$(function() {
$(".preloader").fadeOut();
});
$(function() {
$('[data-toggle="tooltip"]').tooltip()
});
// ============================================================== 
// Login and Recover Password 
// ============================================================== 
$('#to-recover').on("click", function() {
$("#loginform").slideUp();
$("#recoverform").fadeIn();
});
</script>