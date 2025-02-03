<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$var_extra = 'my-property';

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."user_property_detail
 where user_id='".$_SESSION['user']['userid']."'"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'fav-property-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail
 where user_id='".$_SESSION['user']['userid']."'"; // for listing of records
$dbObj->dbQuery.=" order by $sort $page_limit";
$dbUserProp = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php include(INCLUDE_DIR.'left-menu.php'); ?>
      </div>
      <div class="col-lg-9">
        <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> My <span class="themecolor"> property</span></h2>
        <?php if(count((array)$dbUserProp)>0){?>
        <div class="row">
          <?php for($i=0;$i<count((array)$dbUserProp);$i++){
			
			$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbUserProp[0]['state']."'";
			$dbState = $dbObj->SelectQuery();
		?>
          <div class="col-12 row properties-div2 m-0 wow fadeIn">
            <div class="col-lg-12 col-md-12">
              <div class="properties-name pt-3 pl-3 pr-3 pb-0">
                <div class="row">
                  <div class="col-md-7">
                    <div class="for-sell">for
                      <?=$dbUserProp[$i]['for_property']?>
                    </div>
                    <p class="float-left pl-3"> 
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?=$dbUserProp[$i]['city']?>
                      ,
                      <?=$dbState[0]['state_name']?>
                    </p>
                  </div>
                  <div class="col-md-5">
                    <div class="heart heart2">
                      <div class="row m-0">
                        <div class="col-lg-12 col-12 mt-3 mt-3">
                          <p> <strong>Post Date:</strong>
                            <?=date('d/m/Y', strtotime($dbUserProp[$i]['post_date']))?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <?php $property_type = rtrim($dbUserProp[$i]['property_type'], ',');?>
                <div class="tag-css mb-3">
                  <?=$property_type?>
                </div>
                <div class="clearfix"></div>
                <p class="mb-4"> </p>
                <?=substr($dbUserProp[$i]['detail'] ?? "",0,123)?>
                <p class="mb-4"> </p>
                <div class="row m-0">
                  <div class="col-md-6 p-0">
                    <div class="list2">
                      <ul>
                        <?php $no_of_bedrooms = rtrim($dbUserProp[$i]['no_of_bedrooms'], ',');?>
                        <li><i class="flaticon-hotel-sign"></i>
                          <?=$no_of_bedrooms?>
                        </li>
                        <?php $no_of_bathrooms = rtrim($dbUserProp[$i]['no_of_bathrooms'], ',');?>
                        <li><i class="flaticon-bath-tub"></i>
                          <?=$no_of_bathrooms?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="clerfix"></div>
          <?php }?>
        </div>
        <div class="col-12-md text-center w-100"> <br />
          <br />
          <?php if(count((array)$dbUserProp)>10){?>
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