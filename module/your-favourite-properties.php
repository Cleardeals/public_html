<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$var_extra = 'your-favourite-properties';

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."favourite where user_id='".$_SESSION['user']['userid']."' and favourite='1'"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"] ?? "";
  
require_once(PHP_FUNCTION_DIR.'fav-property-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."favourite where user_id='".$_SESSION['user']['userid']."' and favourite='1'"; // for listing of records
$dbObj->dbQuery.=" order by $sort $page_limit";
$dbFav = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php include(INCLUDE_DIR.'left-menu.php'); ?>
      </div>
      <div class="col-lg-9">
        <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Your Favourite 
        <span class="themecolor"> properties</span></h2>
        <?php if(count((array)$dbFav)>0){?>
        <div class="row">
          <?php for($i=0;$i<count((array)$dbFav);$i++){
			
			$dbObj->dbQuery="select * from ".PREFIX."property where id='".$dbFav[$i]['property_id']."'";
			$dbProperty = $dbObj->SelectQuery();
			
			$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$dbFav[$i]['property_id']."'";
			$dbPropertyDetail = $dbObj->SelectQuery();
			
			$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$dbFav[$i]['property_id']."' and front_status='1'";
			$dbPropertyImg = $dbObj->SelectQuery();
			
		?>
        <?php if(count((array)$dbProperty)>0){?>
          <div class="col-12 row properties-div2 m-0 wow fadeIn">
            <div class="col-lg-4 col-md-4">
              <div class="img-pro text-center"><a data-fancybox="gallery" href="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropertyImg[0]['image']?>"> <img src="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropertyImg[0]['image']?>" class="img-fluid"></a> </div>
            </div>
            <div class="col-lg-8 col-md-8">
              <div class="properties-name pt-3 pl-3 pr-3 pb-0">
                <div class="row">
                  <div class="col-md-7">
                    <div class="for-sell">for
                      <?=$dbProperty[0]['for_property']?>
                    </div>
                    <span class="montserrat font-semibold text-blue font-18 float-left">
                    <?=$dbPropertyDetail[0]['offer_price']?>
                    <?=$dbPropertyDetail[0]['offer_price_unit']?>
                    </span>
                    <p class="float-left pl-3"><i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?=$dbProperty[0]['location']?>
                    </p>
                  </div>
                  <div class="col-md-5">
                    <div class="heart heart2">
                      <div class="row m-0">
                        <div class="col-lg-9 col-6 mt-3 mt-3">
                          <p> <strong>Post Date:</strong>
                            <?=date('d/m/Y', strtotime($dbPropertyDetail[0]['post_date']))?>
                          </p>
                        </div>
                        <div class="col-lg-3 col-6"> 
                        <a href="<?=HTACCESS_URL?>userController.php?mode=remove_fav_prop&property_id=<?=$dbProperty[0]['id']?>">
                        <i class="fa fa-heart" style="color:#e30000;"></i></a></div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <h4 class="font-semibold mt-1 mb-3 float-left pr-3"> 
                <a href="<?=HTACCESS_URL?>property-detail/<?=$dbProperty[0]['url']?>/">
                  <?=$dbProperty[0]['property_name']?>
                  </a> </h4>
                <div class="tag-css mb-3">
                  <?=$dbProperty[0]['property_type']?>
                </div>
                <div class="clearfix"></div>
                <p class="mb-4"> </p>
                <?=substr($dbProperty[0]['content'],0,123)?>
                <div class="row m-0">
                  <div class="col-md-6 p-0">
                    <div class="list2">
                      <ul>
                        <li><i class="flaticon-hotel-sign"></i>
                          <?=$dbPropertyDetail[0]['no_of_bedrooms']?>
                        </li>
                        <li><i class="flaticon-bath-tub"></i>
                          <?=$dbPropertyDetail[0]['no_of_bathrooms']?>
                        </li>
                        <!--<li><i class="flaticon-sports-car"></i>01</li>-->
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>property-detail/<?=$dbProperty[0]['id']?>/<?=str_replace(' ','-',$dbProperty[0]['property_name'] ?? "")?>/" class="btn themebg text-white theme-btn mr-3 mb-1 theme-btn2">Show Details</a> <a href="<?=HTACCESS_URL?>contact/" class="btn themebg text-white theme-btn theme-btn2">Contact Us</a></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="clerfix"></div>
          <?php }}?>
        </div>
        <div class="col-12-md text-center w-100"> <br />
          <br />
          <?php if(count((array)$dbFav)>10){?>
          <ul class="pagination2">
            <?=$page_link;?>
          </ul>
          <?php }?>
        </div>
        <?php }else{?>
        <p style="color:#F00;text-align:center;">No Record Found</p>
        <?php }?>
      </div>
    </div>
  </div>
</div>
</div>
<?php include(INCLUDE_DIR.'footer1.php'); ?>