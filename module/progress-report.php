<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$dbObj->dbQuery="select * from ".PREFIX."progress_report where user_id='".$_SESSION['user']['userid']."' and status='1' order by display_order";
$dbReport = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Progress <span class="themecolor">
          Report</span></h2>
          <div class="row justify-content-md-center">
          <?php if((count((array)$dbReport))>0){?>
         <div class="table-responsive">
              <table width="100%" class="table table-bordered table-striped m-0 pricing-2">
                <tr>
                  <th class="text-center"><h4>Title</h4></th>
                  <th class="text-center"><h4>Progress Report</h4></th>
                </tr>
                <?php for($i=0;$i<count((array)$dbReport);$i++){?>
                <tr>
                  <td class="text-center"><p class="m-0 pl-3">
                      <?=$dbReport[$i]['title']?>
                    </p></td>
                  <td class="text-center"><a href="<?=HTACCESS_URL?>cms_images/progress_report/<?=$dbReport[$i]['upload_file']?>" class="btn themebg text-white theme-btn mr-3 mb-1 theme-btn2" download="download"> download </a></td>
                </tr>
                <?php }?>
              </table>
            </div>
            <?php }else{?>
            <p style="color:#F00;text-align:center;">No Record Found</p>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php unset($_SESSION['find_msg']);?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>