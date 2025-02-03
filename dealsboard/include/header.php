<?php
//to get login admin name
$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='".$dbObj->sc_mysql_escape($_SESSION['srgit_cms_admin_id'])."'";
$dbAdmin = $dbObj->SelectQuery();
?>
<header class="topbar">
  <nav class="navbar top-navbar navbar-expand-md navbar-light"> 
    <!-- ============================================================== --> 
    <!-- Logo --> 
    <!-- ============================================================== -->
    <?php include(ADMIN_INCLUDE_DIR.'logo.php'); ?>
    <!-- ============================================================== --> 
    <!-- End Logo --> 
    <!-- ============================================================== -->
    <div class="navbar-collapse"> 
      <!-- ============================================================== --> 
      <!-- toggle and nav items --> 
      <!-- ============================================================== -->
      <ul class="navbar-nav mr-auto">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
        <!-- ============================================================== --> 
        <!-- Search --> 
        <!-- ============================================================== -->
      </ul>
      <!-- ============================================================== --> 
      <!-- User profile and search --> 
      <!-- ============================================================== -->
      <ul class="navbar-nav my-lg-0">
        <!-- ============================================================== -->
        <li class="nav-item dropdown u-pro"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!--<img src="assets/images/users/1.jpg" alt="user" class="" />--> <span class="hidden-md-down"> Hello,
          <?=$dbAdmin[0]['full_name']?>
          &nbsp;<i class="fa fa-angle-down"></i></span> </a>
          <div class="dropdown-menu dropdown-menu-right animated fadeIn">
            <ul class="dropdown-user">
              <li>
                <div class="dw-user-box"> 
                  <!-- <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>-->
                  <div class="u-text">
                    <h4>
                      <?=$dbAdmin[0]['full_name']?>
                    </h4>
                    <p class="text-muted">
                      <?=$dbAdmin[0]['email']?>
                    </p>
                  </div>
                </div>
              </li>
              <li role="separator" class="divider"></li>
              <?php if($_SESSION['srgit_cms_admin_id']=='1'){?>
              <li><a href="index.php?mo=change_password"><i class="ti-settings"></i>&nbsp;&nbsp;&nbsp; Account Setting</a></li>
              <li role="separator" class="divider"></li>
              <?php }else{?>
              <li><a href="index.php?mo=edit_profile"><i class="ti-pencil-alt"></i>&nbsp;&nbsp;&nbsp; Edit Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="index.php?mo=change_password"><i class="ti-settings"></i>&nbsp;&nbsp;&nbsp; Change Password</a></li>
              <li role="separator" class="divider"></li>
              <?php }?>
              <li><a href="loginController.php?mode=logout"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>