<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."property where status='1' and city='".$dbUser[0]['city']."' order by id desc LIMIT 6";
$dbProperty = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php include(INCLUDE_DIR.'left-menu.php'); ?>
      </div>
      <div class="col-lg-9">
        <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Recent 
        <span class="themecolor"> property </span></h2>
        <div class="row justify-content-center">
          <?php for($i=0;$i<count((array)$dbProperty);$i++){
			  
			$propertyName = str_replace(' ','-',$dbProperty[$i]['property_name']);
			
			$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$dbProperty[$i]['id']."'";
			$dbPropertyDetail = $dbObj->SelectQuery();
			
			$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$dbProperty[$i]['id']."' and front_status='1'";
			$dbPropertyImage = $dbObj->SelectQuery();
			
			$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$dbProperty[$i]['id']."' and status='1' order by display_order";
			$dbPropertyImg = $dbObj->SelectQuery();
			
			$dbObj->dbQuery="select * from ".PREFIX."favourite where property_id='".$dbProperty[$i]['id']."' and user_id='".$_SESSION['user']['userid']."'";
			$dbFav = $dbObj->SelectQuery();
			$favourite = $dbFav[0]['favourite'] ?? "";
			
			$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbProperty[$i]['State']."'";
			$dbPropertyState = $dbObj->SelectQuery();
			
		?>
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn mb-3">
            <div class="item">
              <div class="img-pro">
                <div class="for-sale">For
                  <?=$dbProperty[$i]['for_property']?>
                </div>
                <div class="rate-no">
                  <div class="float-left"><span>
                    <?=$dbPropertyDetail[0]['offer_price']?>
                    <?=$dbPropertyDetail[0]['offer_price_unit']?>
                    </span></div>
                  <div class="float-right">
                    <?php if($favourite==1){?>
                    <i class="fa fa-heart" aria-hidden="true" style="color:#f20000;"></i>
                    <?php }else{?>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <?php }?>
                  </div>
                </div>
                <img src="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropertyImage[0]['image']?>" class="img-fluid">
                <div class="image-layer"></div>
              </div>
              <div class="properties-name2">
                <h3><a href="<?=HTACCESS_URL?>property-detail/<?=$dbProperty[$i]['id']?>/<?=$propertyName?>/">
                  <?=$dbProperty[$i]['property_name']?>
                  </a></h3>
                <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i>
                  <?=$dbProperty[$i]['location']?>, <?=$dbProperty[$i]['city']?>, <?=$dbPropertyState[0]['state_name']?>
                </p>
                <div class="row m-0 mb-2">
                  <?php if(!empty($dbPropertyImg[0]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[0]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                  <?php if(!empty($dbPropertyImg[1]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[1]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                  <?php if(!empty($dbPropertyImg[2]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[2]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                  <?php if(!empty($dbPropertyImg[3]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[3]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                  <?php if(!empty($dbPropertyImg[4]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[4]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                  <?php if(!empty($dbPropertyImg[5]['image'])){?>
                  <div class="col-md-2 pr-1 pl-1 col"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertyImg[5]['image']?>" class="img-fluid border border-light"></div>
                  <?php }?>
                </div>
                <div class="sq sq2">
                  <ul>
                    <li><i class="fa fa-arrows-alt text-white" aria-hidden="true"></i>
 <?=$dbPropertyDetail[0]['super_plot_area']?></li>
                    <li><i class="flaticon-hotel-sign"></i>
                      <?=$dbPropertyDetail[0]['no_of_bedrooms']?>
                      Bedrooms</li>
                    <li><i class="flaticon-bath-tub"></i>
                      <?=$dbPropertyDetail[0]['no_of_bathrooms']?>
                      Bathrooms</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include(INCLUDE_DIR.'footer1.php');?>