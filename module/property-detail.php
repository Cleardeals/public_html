<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$name = $dbObj->sc_mysql_escape($_REQUEST['name'] ?? "");
//echo "hello";
//$name = str_replace('-',' ',$_REQUEST['name']);
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$msg = base64_decode($_SESSION['siteVisit_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."property where id='".$id."'";
$dbProperty = $dbObj->SelectQuery();

if($dbProperty[0]['admin_del']==1){
	header('location:'.HTACCESS_URL.'home/');
	exit;
}

$hits = $dbProperty[0]['hit']+1;

$dbObj->dbQuery = "update ".PREFIX."property set hit='".$hits."' where id='".$id."'";
$dbObj->ExecuteQuery();

$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbProperty[0]['State']."'";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$dbProperty[0]['id']."'";
$dbPropertyDetail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."appliances where property_id='".$dbProperty[0]['id']."'";
$dbAppliances = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$dbProperty[0]['id']."' and status='1' order by display_order";
$dbPropImages = $dbObj->SelectQuery();

if(isset($_SESSION['user']['is_login'])) {
$dbObj->dbQuery="select * from ".PREFIX."favourite where property_id='".$dbProperty[0]['id']."' and user_id='".$_SESSION['user']['userid']."'";
$dbFav = $dbObj->SelectQuery();
$favourite = $dbFav[0]['favourite'] ?? "";
$favouriteID = $dbFav[0]['id'] ?? "";

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();
}
?>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<div class="center-section-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 wow fadeInLeft"> 
        <!-- Insert to your webpage where you want to display the slider -->
        <div id="amazingslider-wrapper-1">
          <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
              <?php for($i=0;$i<count((array)$dbPropImages);$i++){?>
              <li><a href="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropImages[$i]['image']?>" class="html5lightbox"> 
              <img src="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropImages[$i]['image']?>"/></a></li>
              <?php }?>
            </ul>
            <ul class="amazingslider-thumbnails" style="display:none;">
              <?php for($i=0;$i<count((array)$dbPropImages);$i++){?>
              <li><img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropImages[$i]['image']?>"></li>
              <?php }?>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <!--desktop-section-->
        <div class="desktop-section">
          <div class="header">
            <div class="properties-tab">
              <ul role="tablist" class="nav nav-tabs nav-pills text-center bg-light border-0 rounded-nav">
                <li class="nav-item flex-sm-fill"><a data-toggle="tab" href="#tab11" role="tab" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active btn">Property Details</a> </li>
                <!--<li class="nav-item flex-sm-fill"> <a data-toggle="tab" href="#tab33" role="tab" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold btn">NEARBY LOCALITIES</a> </li>-->
                <li class="nav-item flex-sm-fill"> <a data-toggle="tab" href="#tab44" role="tab" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold btn">Location </a> </li>
              </ul>
            </div>
          </div>
          <div class="tab-content content">
            <div id="tab11" role="tabpanel"  class="tab-pane fade show active">
              <div class="mt-3 mb-3">
                <div class="row">
                  <div class="col-lg-7 col-md-12">
                    <h3 class="font-25 mt-1">
                      <?=$dbProperty[0]['property_name']?>
                      <span class="font-16 font-normal open-sans"><i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?=$dbProperty[0]['location']?>
                      </span></h3>
                  </div>
                  <div class="col-lg-5 col-md-12">
                    <div class="row m-0">
                      <div class="col-lg-6 col-md-4 col p-0"> <i class="flaticon-bath-tub icon-css"></i> <span class="font-16 montserrat font-bold d-block">
                        <?=$dbPropertyDetail[0]['no_of_bathrooms']?>
                        </span> Bathroom </div>
                      <div class="col-lg-6 col-md-4 col p-0"> <i class="flaticon-hotel-sign icon-css"></i> <span class="font-16 montserrat font-bold d-block">
                        <?=$dbPropertyDetail[0]['no_of_bedrooms']?>
                        </span> </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 mt-3 col-6">
                    <div class="residential montserrat">For RESIDENTIAL Use</div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 mt-3 tp-0 col-6">
                    <div class="bungalow2 montserrat">
                      <?=$dbProperty[0]['property_type']?>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="project-detail">
                <div class="row div-22">
                  <div class="col text-center"> <a data-fancybox="" href="<?=$dbProperty[0]['video_url']?>" class="font-bold mb-2 btn"> <i class="fa fa-play"></i> Video</a>
                    <?php if(!empty($dbProperty[0]['tour_link'])){?>
                    <a href="<?=$dbProperty[0]['tour_link']?>" target="_blank" class="btn-360 btn"> <img src="<?=HTACCESS_URL?>assets/img/360.png"></a>
                    <?php }?>
                    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ed66adeb14ee74f"></script> 
                    <i class="fa fa-share-alt"></i> SHARE
                    <div class="addthis_inline_share_toolbox mb-2"></div>
                    <!--<a href="#" class="font-bold"> <i class="fa fa-share-alt"></i> 
                  SHARE</a> &nbsp; <a href="#" class="font-bold"> <i class="fa fa-heart"></i> Add to favourite</a>--> 
                  </div>
                </div>
                <div class="row div-11">
                  <div class="col-md-4 col-sm-6 col-12">
                    <h2 class="font-22 text-uppercase watch-video mb-2"> <a class="btn btn-video mb-2 w-50" data-fancybox="" href="<?=$dbProperty[0]['video_url']?>"> <i class="fa fa-play-circle font-30"></i> Video</a>
                      <?php if(!empty($dbProperty[0]['tour_link'])){?>
                      <div class="clearfix"></div>
                      <a href="<?=$dbProperty[0]['tour_link']?>" target="_blank" class="btn-360 btn w-50"> 
                      <img src="<?=HTACCESS_URL?>assets/img/360.png" width="40" class="align-middle"></a>
                      <?php }?>
                    </h2>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12 text-center"> 
                    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ed66adeb14ee74f"></script> 
                    <i class="fa fa-share-alt"></i> SHARE
                    <div class="addthis_inline_share_toolbox"></div>
                    <!--<a href="#"><i class="flaticon-paper-plane share m-0"></i> 
                      SHARE</a>--> 
                  </div>
                  <div class="col-md-4 col-sm-6 col-12 text-right">
                    <div class="float-right">
                      <h2 class="font-13 text-uppercase float-left">
					  <?php if(isset($_SESSION['user']['is_login'])) {?>
                        <?php if($favourite==1){?>
                        <a href="<?=HTACCESS_URL?>userController.php?mode=remove_favourite_prop&property_id=<?=$dbProperty[0]['id']?>&url=<?=$dbProperty[0]['url']?>"><i class="fa fa-heart like2" style="background-color:#f20000;"></i> favourite</a>
                        <?php }else{?>
                        <a href="<?=HTACCESS_URL?>userController.php?mode=add_favourite_prop&property_id=<?=$dbProperty[0]['id']?>&id=<?=$favouriteID?>&url=<?=$dbProperty[0]['url']?>"><i class="fa fa-heart like2"></i> Add to favourite</a>
                        <?php }}else{?>
						<a href="#"><i class="fa fa-heart like2"></i> Add to favourite</a>
						<?php }?>
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-box mt-3 mb-3" style="padding-bottom: 60px;">
                <?php $text = str_ireplace('<p>','',$dbProperty[0]['content']);?>
                <!--<div id="module" class="container">
  <p class="collapse" id="collapseExample" aria-expanded="false" align="justify">
    <?=$text?>
  </p>
  <a role="button" class="collapsed btn-primary p-2 text-white" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="float:right;"></a>
</div>--> 
                <span class="more">
                <?=$text?>
                </span> </div>
              <div>
                <div class="row m-0">
                  <div class="col-md-12 p-0">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped border-left-0 mb-0">
                        <tr>
                          <td><p class="font-bold m-0 font-14 pl-2">Project Name</p></td>
                          <td><?=$dbProperty[0]['project_name']?></td>
                          <td class="bg-odd "><p class="font-bold m-0 font-14 pl-2">City</p></td>
                          <td class="bg-odd"><?=$dbProperty[0]['city']?></td>
                        </tr>
                        <tr>
                          <td><p class="font-bold m-0 font-14 pl-2">Location Area</p></td>
                          <td><?=$dbProperty[0]['location']?></td>
                          <td class="bg-even"><p class="font-bold m-0 font-14 pl-2">State</p></td>
                          <td class="bg-even"><?=$dbState[0]['state_name']?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> Property Details</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <?php if(!empty($dbPropertyDetail[0]['pro_curr_status'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Current status of property</p></td>
                    <td><?=$dbPropertyDetail[0]['pro_curr_status']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['prop_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Availability of property</p></td>
                    <td><?=$dbPropertyDetail[0]['prop_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['permi_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">B.U. PERMISSION AVAILABILITY</p></td>
                    <td><?=$dbPropertyDetail[0]['permi_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['project_unit'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Total no. of units in Project</p></td>
                    <td><?=$dbPropertyDetail[0]['project_unit']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['floor_loc'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Location of the floor of property</p></td>
                    <td><?=$dbPropertyDetail[0]['floor_loc']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['prop_ownership'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Property Ownership</p></td>
                    <td><?=$dbPropertyDetail[0]['prop_ownership']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['flooring_type'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Type of flooring</p></td>
                    <td><?=$dbPropertyDetail[0]['flooring_type']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['facing'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Facing</p></td>
                    <td><?=$dbPropertyDetail[0]['facing']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_lift'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No. of lifts per block</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_lift']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_bedrooms'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No. of Bedrooms</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_bedrooms']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_bathrooms'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of bathrooms</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_bathrooms']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_balconies'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of balconies</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_balconies']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_open_sides'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of open sides</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_open_sides']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['kitchen_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Kitchen details</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['kitchen_detail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['furniture_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 pl-2">Furniture details of property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['furniture_detail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['age_of_property'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Age of Property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['age_of_property']?>
                      Years</td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['power_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Power Supply</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['power_supply']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['security_guards'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Security Guards</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['security_guards']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['camera'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">CCTV Camera</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['camera']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fire_avai'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Fire fighting availability</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['fire_avai']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['water_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Water supply timings</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['water_supply']?>
                      <?php if(!empty($dbPropertyDetail[0]['water_timing'])){?>
                      (
                      <?=$dbPropertyDetail[0]['water_timing']?>
                      )
                      <?php }?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['road_width'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Road Width near entrance of building</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['road_width']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['parking_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Parking details</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['parking_detail']?> <?=(!empty($dbPropertyDetail[0]['parkingdetail']))?'- ':''?> <?=$dbPropertyDetail[0]['parkingdetail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['gas_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Gas supply line availability</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['gas_supply']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['client_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Availability of the client (Day and Time)</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['client_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['overlooking'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Overlooking</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['overlooking']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['some_features'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Some features about your property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['some_features']?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2"></h3>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Other Amenities of the Project</p></td>
                  <td><?=$dbPropertyDetail[0]['amenities']?><?php if(!empty($dbPropertyDetail[0]['otheramenities'])){?><?=$dbPropertyDetail[0]['otheramenities']?>,<?php }?>
                    <?php if(!empty($dbAppliances[0]['app_stove'])){?>
                    Stove <?=$dbAppliances[0]['app_stove']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_wordrobe'])){?>
                    Wordrobe <?=$dbAppliances[0]['app_wordrobe']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_ac'])){?>
                    AC <?=$dbAppliances[0]['app_ac']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_bed'])){?>
                    Bed <?=$dbAppliances[0]['app_bed']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_chimney'])){?>
                    Chimney <?=$dbAppliances[0]['app_chimney']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_curtains'])){?>
                    Curtains <?=$dbAppliances[0]['app_curtains']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_dtable'])){?>
                    Dining Table <?=$dbAppliances[0]['app_dtable']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_gyeser'])){?>
                    Geyser <?=$dbAppliances[0]['app_gyeser']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['appl_mkitchen'])){?>
                    Modular Kitchen <?=$dbAppliances[0]['appl_mkitchen']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_microwave'])){?>
                    Microwave <?=$dbAppliances[0]['app_microwave']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_sofa'])){?>
                    Sofa <?=$dbAppliances[0]['app_sofa']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_fridge'])){?>
                    Fridge <?=$dbAppliances[0]['app_fridge']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_tv'])){?>
                    TV <?=$dbAppliances[0]['app_tv']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_wmachine'])){?>
                    Washing Machine <?=$dbAppliances[0]['app_wmachine']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_waterp'])){?>
                    Water Purifier <?=$dbAppliances[0]['app_waterp']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_other'])){?>
                    Other <?=$dbAppliances[0]['app_other']?>
                    <?php }?></td>
                </tr>
              </table>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Furniture Detail</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <?php if(!empty($dbPropertyDetail[0]['wardrobe'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Wardrobe</p></td>
                    <td><?=$dbPropertyDetail[0]['wardrobe']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['beds'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Beds</p></td>
                    <td><?=$dbPropertyDetail[0]['beds']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fans'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Fans</p></td>
                    <td><?=$dbPropertyDetail[0]['fans']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['light'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Light</p></td>
                    <td><?=$dbPropertyDetail[0]['light']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['m_kitchen'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Modular Kitchen</p></td>
                    <td><?=$dbPropertyDetail[0]['m_kitchen']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fridge'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Fridge</p></td>
                    <td><?=$dbPropertyDetail[0]['fridge']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['ac'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">AC</p></td>
                    <td><?=$dbPropertyDetail[0]['ac']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['geyser'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Geyser</p></td>
                    <td><?=$dbPropertyDetail[0]['geyser']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['tv'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">TV</p></td>
                    <td><?=$dbPropertyDetail[0]['tv']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['stove'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Stove</p></td>
                    <td><?=$dbPropertyDetail[0]['stove']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['washing_machine'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Washing Machine</p></td>
                    <td><?=$dbPropertyDetail[0]['washing_machine']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['water_purifier'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Water Purifier</p></td>
                    <td><?=$dbPropertyDetail[0]['water_purifier']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['microwave'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Microwave</p></td>
                    <td><?=$dbPropertyDetail[0]['microwave']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['curtains'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Curtains</p></td>
                    <td><?=$dbPropertyDetail[0]['curtains']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['chimney'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Chimney</p></td>
                    <td><?=$dbPropertyDetail[0]['chimney']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['exhaust_fan'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Exhaust Fan</p></td>
                    <td><?=$dbPropertyDetail[0]['exhaust_fan']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['sofa'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Sofa</p></td>
                    <td><?=$dbPropertyDetail[0]['sofa']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['dinning_table'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Dinning Table</p></td>
                    <td><?=$dbPropertyDetail[0]['dinning_table']?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Superbuilt up area of Property</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Plot Area</p></td>
                    <td><?=$dbPropertyDetail[0]['super_plot_area']?>
                      <?=$dbPropertyDetail[0]['super_plot_area_unit']?></td>
                  </tr>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Construction Area</p></td>
                    <td><?=$dbPropertyDetail[0]['super_con_area']?>
                      <?=$dbPropertyDetail[0]['super_con_area_unit']?></td>
                  </tr>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Carpet Area of property</h3>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Plot Area</p></td>
                  <td><?=$dbPropertyDetail[0]['carpet_plot_area']?>
                    <?=$dbPropertyDetail[0]['carpet_plot_area_unit']?></td>
                </tr>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Construction Area</p></td>
                  <td><?=$dbPropertyDetail[0]['carpet_con_area']?>
                    <?=$dbPropertyDetail[0]['carpet_con_area_unit']?></td>
                </tr>
              </table>
              <?php if($dbProperty[0]['for_property']=='Sell'){?>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> For Sell </h3>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Offer Price (In Rupees)</p></td>
                 <td><?php if(empty($dbPropertyDetail[0]['pricerequest'])){?><?=$dbPropertyDetail[0]['offer_price']?>
                    <?=$dbPropertyDetail[0]['offer_price_unit']?>  <?php  } else {?> Price on request <?php }?></td>
                </tr>
                <?php if(!empty($dbPropertyDetail[0]['main_charges'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Maintenance charges</p></td>
                  <td><?=$dbPropertyDetail[0]['main_charges']?>
                    <?=$dbPropertyDetail[0]['main_charges_unit']?></td>
                </tr>
                <?php }?>
              </table>
              <?php }?>
              <?php if($dbProperty[0]['for_property']=='Rent'){?>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> For Rent </h3>
              <table class="table table-bordered table-striped mb-0">
                <?php if(!empty($dbPropertyDetail[0]['expected_rent'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Expected rent per month (In Rupees)</p></td>
                  <td><?php if(empty($dbPropertyDetail[0]['pricerequest'])){?><?=$dbPropertyDetail[0]['expected_rent']?>
                    <?=$dbPropertyDetail[0]['expected_rent_unit']?>  <?php  } else {?> Price on request <?php }?>
					</td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['rent_security'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Refundable Security deposit charges</p></td>
                  <td><?=$dbPropertyDetail[0]['rent_security']?>
                    <?=$dbPropertyDetail[0]['rent_security_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['maint_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Maintenance charges per month</p></td>
                  <td><?=$dbPropertyDetail[0]['maint_charge']?>
                    <?=$dbPropertyDetail[0]['maint_charge_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['tax_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Property tax charges per month approx</p></td>
                  <td><?=$dbPropertyDetail[0]['tax_charge']?>
                    <?=$dbPropertyDetail[0]['tax_charge_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['other_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Other charges please specify</p></td>
                  <td><?=$dbPropertyDetail[0]['other_charge']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['main_charges'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Maintenance charges</p></td>
                  <td><?=$dbPropertyDetail[0]['main_charges']?>
                    <?=$dbPropertyDetail[0]['main_charges_unit']?></td>
                </tr>
                <?php }?>
              </table>
              <?php }?>
               
            </div>
            <!--<div id="tab33" role="tabpanel" class="tab-pane fade">
              <h3 class="font-16 text-uppercase mt-2 mb-3">Nearby Localities</h3>
              <table class="table table-bordered table-striped">
                <tr class="w-40">
                  <td class="border-left"><p class="font-bold m-0 font-14 pl-2">School :</p></td>
                  <td><?=$dbPropertyDetail[0]['school']?></td>
                </tr>
                <?php if(!empty($dbPropertyDetail[0]['college'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">College :</p></td>
                  <td><?=$dbPropertyDetail[0]['college']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['hospital'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Hospital :</p></td>
                  <td><?=$dbPropertyDetail[0]['hospital']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['bank'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Banks :</p></td>
                  <td><?=$dbPropertyDetail[0]['bank']?></td>
                </tr>
                <?php }?>
              </table>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Public transport details</h3>
              <table class="table table-bordered table-striped">
                <tr class="w-40">
                  <td><p class="font-bold m-0 font-14 pl-2">Near by BRTS stop :</p></td>
                  <td><?=$dbPropertyDetail[0]['brts_stop']?></td>
                </tr>
                <?php if(!empty($dbPropertyDetail[0]['r_station'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Near by Railway Station :</p></td>
                  <td><?=$dbPropertyDetail[0]['r_station']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['m_station'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Near by metro station :</p></td>
                  <td><?=$dbPropertyDetail[0]['m_station']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['airport'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Near by Airport :</p></td>
                  <td><?=$dbPropertyDetail[0]['airport']?></td>
                </tr>
                <?php }?>
              </table>
            </div>-->
            <?php if(!empty($dbPropertyDetail[0]['google_map'])){?>
            <div id="tab44" role="tabpanel" class="tab-pane fade">
              <div class="embed-responsive embed-responsive-16by9 mt-3">
                <?=$dbPropertyDetail[0]['google_map']?>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
        <!--desktop-section--> 
        <!--mobile-section-->
        <div class="mobile-section">
          <div class="header" id="myHeader">
            <div class="properties-tab bg-transparent" id="mainNav">
              <ul class="navbar navbar-expand-lg navbar-dark">
                <li class="nav-item"> <a class="nav-link js-scroll-trigger text-uppercase font-weight-bold" href="#tab1"> Property Details</a> </li>
                <!--<li class="nav-item"> <a class="nav-link js-scroll-trigger text-uppercase font-weight-bold" href="#tab3"> NEARBY LOCALITIES</a> </li>-->
                <li class="nav-item"> <a class="nav-link js-scroll-trigger text-uppercase font-weight-bold" href="#tab4"> Location</a> </li>
              </ul>
            </div>
          </div>
          <div>
            <div class="position-relative mb-5">
              <div class="tab-css2" id="tab1"></div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-lg-7 col-md-12">
                    <h3 class="font-25 mt-1">
                      <?=$dbProperty[0]['property_name']?>
                      <span class="font-16 font-normal open-sans"><i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?=$dbProperty[0]['location']?>
                      </span></h3>
                  </div>
                  <div class="col-lg-5 col-md-12">
                    <div class="row m-0">
                      <div class="col-lg-6 col-md-4 col p-0"> <i class="flaticon-bath-tub icon-css"></i> <span class="font-16 montserrat font-bold d-block">
                        <?=$dbPropertyDetail[0]['no_of_bathrooms']?>
                        </span> Bathroom </div>
                      <div class="col-lg-6 col-md-4 col p-0"> <i class="flaticon-hotel-sign  icon-css"></i> <span class="font-16 montserrat font-bold d-block">
                        <?=$dbPropertyDetail[0]['no_of_bedrooms']?>
                        </span> </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 mt-3 col-6">
                    <div class="residential montserrat">For RESIDENTIAL Use</div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 mt-3 tp-3 col-6">
                    <div class="bungalow2 montserrat">
                      <?=$dbProperty[0]['property_type']?>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="project-detail">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6  text-center text-uppercase"> <a data-fancybox="" href="<?=$dbProperty[0]['video_url']?>" class="btn btn-video font-bold mb-4 mr-1"> <i class="fa fa-play"></i> Video </a>
                    <?php if(!empty($dbProperty[0]['tour_link'])){?>
                    <a href="<?=$dbProperty[0]['tour_link']?>" target="_blank" class="mb-4 ml-1 btn-360 btn">
                    <img src="<?=HTACCESS_URL?>assets/img/360.png" width="38">
                    <div class="clearfix"></div>
                    </a>
                    <div class="clearfix"></div>
                    <a href="#" class="text-uppercase"><i class="fa fa-heart like2"></i> Add to favourite</a>
                    <?php }?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-center"> 
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ed66adeb14ee74f"></script> 
                    <i class="flaticon-paper-plane share m-0"></i> SHARE
                    <div class="addthis_inline_share_toolbox mt-2"></div>
                  </div>
                </div>
                <div class="row div-11">
                  <div class="col-md-6 col-sm-6 col-12">
                    <h2 class="font-22 text-uppercase watch-video mb-2"> <a data-fancybox="" class="btn btn-video w-50" href="<?=$dbProperty[0]['video_url']?>"> <i class="fa fa-play-circle font-30"></i> Watch Video</a></h2>
                  </div>
                  <div class="col-md-6 col-sm-6 col-12 text-right">
                    <div class="float-right">
                      <h2 class="font-13 text-uppercase float-left"> 
                        <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ed66adeb14ee74f"></script> 
                        <i class="flaticon-paper-plane share m-0"></i> SHARE
                        <div class="addthis_inline_share_toolbox"></div>
                        <!--<a href="#"><i class="flaticon-paper-plane share m-0"></i> 
                      SHARE</a>--> 
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-box mt-3 mb-3" style="padding-bottom: 42px;">
                <?php $text = str_ireplace('<p>','',$dbProperty[0]['content']);?>
                <!--<div id="module1" class="container">
              <p class="collapse" id="collapseExample" aria-expanded="false" align="justify">
                <?=$text?>
              </p>
              <a role="button" class="collapsed btn-primary p-2 text-white" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="float:right;"></a>
            </div>--> 
                <span class="more">
                <?=$text?>
                </span> </div>
              <div>
                <div class="row m-0">
                  <div class="col-md-12 p-0">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped border-left-0 mb-0">
                        <tr>
                          <td ><p class="font-bold m-0 font-14  pl-2">Project Name</p></td>
                          <td><?=$dbProperty[0]['project_name']?></td>
                          <td class="bg-odd "><p class="font-bold m-0 font-14  pl-2">City</p></td>
                          <td class="bg-odd"><?=$dbProperty[0]['city']?></td>
                        </tr>
                        <tr>
                          <td><p class="font-bold m-0 font-14  pl-2">Location Area</p></td>
                          <td><?=$dbProperty[0]['location']?></td>
                          <td class="bg-even"><p class="font-bold m-0 font-14  pl-2">State</p></td>
                          <td class="bg-even"><?=$dbState[0]['state_name']?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> Property Details</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <?php if(!empty($dbPropertyDetail[0]['pro_curr_status'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Current status of property</p></td>
                    <td><?=$dbPropertyDetail[0]['pro_curr_status']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['prop_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Availability of property</p></td>
                    <td><?=$dbPropertyDetail[0]['prop_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['permi_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">B.U. PERMISSION AVAILABILITY</p></td>
                    <td><?=$dbPropertyDetail[0]['permi_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['project_unit'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Total no. of units in Project</p></td>
                    <td><?=$dbPropertyDetail[0]['project_unit']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['floor_loc'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Location of the floor of property</p></td>
                    <td><?=$dbPropertyDetail[0]['floor_loc']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['prop_ownership'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Property Ownership</p></td>
                    <td><?=$dbPropertyDetail[0]['prop_ownership']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['flooring_type'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Type of flooring</p></td>
                    <td><?=$dbPropertyDetail[0]['flooring_type']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['facing'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Facing</p></td>
                    <td><?=$dbPropertyDetail[0]['facing']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_lift'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No. of lifts per block</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_lift']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_bedrooms'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No. of Bedrooms</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_bedrooms']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_bathrooms'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of bathrooms</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_bathrooms']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_balconies'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of balconies</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_balconies']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['no_of_open_sides'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">No of open sides</p></td>
                    <td><?=$dbPropertyDetail[0]['no_of_open_sides']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['kitchen_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Kitchen details</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['kitchen_detail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['furniture_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 pl-2">Furniture details of property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['furniture_detail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['age_of_property'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Age of Property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['age_of_property']?>
                      Years</td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['power_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Power Supply</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['power_supply']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['security_guards'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Security Guards</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['security_guards']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['camera'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">CCTV Camera</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['camera']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fire_avai'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Fire fighting availability</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['fire_avai']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['water_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Water supply timings</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['water_supply']?>
                      <?php if(!empty($dbPropertyDetail[0]['water_timing'])){?>
                      (
                      <?=$dbPropertyDetail[0]['water_timing']?>
                      )
                      <?php }?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['road_width'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Road Width near entrance of building</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['road_width']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['parking_detail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Parking details</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['parking_detail']?> <?=(!empty($dbPropertyDetail[0]['parkingdetail']))?'- ':''.$dbPropertyDetail[0]['parkingdetail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['gas_supply'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Gas supply line availability</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['gas_supply']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['client_avail'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Availability of the client (Day and Time)</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['client_avail']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['overlooking'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Overlooking</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['overlooking']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['some_features'])){?>
                  <tr>
                    <td><p class="font-bold m-0 font-14 pl-2">Some features about your property</p></td>
                    <td class="font-14"><?=$dbPropertyDetail[0]['some_features']?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2"></h3>
              <?php //if(!empty($dbPropertyDetail[0]['amenities'])){?>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Other Amenities of the Project</p></td>
                  <td><?=$dbPropertyDetail[0]['amenities']?><?php if(!empty($dbPropertyDetail[0]['otheramenities'])){?><?=$dbPropertyDetail[0]['otheramenities']?>,<?php }?>
                    <?php if(!empty($dbAppliances[0]['app_stove'])){?>
                    Stove <?=$dbAppliances[0]['app_stove']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_wordrobe'])){?>
                    Wordrobe <?=$dbAppliances[0]['app_wordrobe']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_ac'])){?>
                    AC <?=$dbAppliances[0]['app_ac']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_bed'])){?>
                    Bed <?=$dbAppliances[0]['app_bed']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_chimney'])){?>
                    Chimney <?=$dbAppliances[0]['app_chimney']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_curtains'])){?>
                    Curtains <?=$dbAppliances[0]['app_curtains']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_dtable'])){?>
                    Dining Table <?=$dbAppliances[0]['app_dtable']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_gyeser'])){?>
                    Geyser <?=$dbAppliances[0]['app_gyeser']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['appl_mkitchen'])){?>
                    Modular Kitchen <?=$dbAppliances[0]['appl_mkitchen']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_microwave'])){?>
                    Microwave <?=$dbAppliances[0]['app_microwave']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_sofa'])){?>
                    Sofa <?=$dbAppliances[0]['app_sofa']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_fridge'])){?>
                    Fridge <?=$dbAppliances[0]['app_fridge']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_tv'])){?>
                    TV <?=$dbAppliances[0]['app_tv']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_wmachine'])){?>
                    Washing Machine <?=$dbAppliances[0]['app_wmachine']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_waterp'])){?>
                    Water Purifier <?=$dbAppliances[0]['app_waterp']?>,
                    <?php }?>
                    <?php if(!empty($dbAppliances[0]['app_other'])){?>
                    Other <?=$dbAppliances[0]['app_other']?>,
                    <?php }?></td>
                </tr>
              </table>
              <?php //}?>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Furniture Detail</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <?php if(!empty($dbPropertyDetail[0]['wardrobe'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Wardrobe</p></td>
                    <td><?=$dbPropertyDetail[0]['wardrobe']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['beds'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Beds</p></td>
                    <td><?=$dbPropertyDetail[0]['beds']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fans'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Fans</p></td>
                    <td><?=$dbPropertyDetail[0]['fans']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['light'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Light</p></td>
                    <td><?=$dbPropertyDetail[0]['light']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['m_kitchen'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Modular Kitchen</p></td>
                    <td><?=$dbPropertyDetail[0]['m_kitchen']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['fridge'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Fridge</p></td>
                    <td><?=$dbPropertyDetail[0]['fridge']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['ac'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">AC</p></td>
                    <td><?=$dbPropertyDetail[0]['ac']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['geyser'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Geyser</p></td>
                    <td><?=$dbPropertyDetail[0]['geyser']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['tv'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">TV</p></td>
                    <td><?=$dbPropertyDetail[0]['tv']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['stove'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Stove</p></td>
                    <td><?=$dbPropertyDetail[0]['stove']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['washing_machine'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Washing Machine</p></td>
                    <td><?=$dbPropertyDetail[0]['washing_machine']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['water_purifier'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Water Purifier</p></td>
                    <td><?=$dbPropertyDetail[0]['water_purifier']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['microwave'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Microwave</p></td>
                    <td><?=$dbPropertyDetail[0]['microwave']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['curtains'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Curtains</p></td>
                    <td><?=$dbPropertyDetail[0]['curtains']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['chimney'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Chimney</p></td>
                    <td><?=$dbPropertyDetail[0]['chimney']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['exhaust_fan'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Exhaust Fan</p></td>
                    <td><?=$dbPropertyDetail[0]['exhaust_fan']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['sofa'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Sofa</p></td>
                    <td><?=$dbPropertyDetail[0]['sofa']?></td>
                  </tr>
                  <?php }?>
                  <?php if(!empty($dbPropertyDetail[0]['dinning_table'])){?>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Dinning Table</p></td>
                    <td><?=$dbPropertyDetail[0]['dinning_table']?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Superbuilt up area of Property</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Plot Area</p></td>
                    <td><?=$dbPropertyDetail[0]['super_plot_area']?>
                      <?=$dbPropertyDetail[0]['super_plot_area_unit']?></td>
                  </tr>
                  <tr>
                    <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Construction Area</p></td>
                    <td><?=$dbPropertyDetail[0]['super_con_area']?>
                      <?=$dbPropertyDetail[0]['super_con_area_unit']?></td>
                  </tr>
                </table>
              </div>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Carpet Area of property</h3>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Plot Area</p></td>
                  <td><?=$dbPropertyDetail[0]['carpet_plot_area']?>
                    <?=$dbPropertyDetail[0]['carpet_plot_area_unit']?></td>
                </tr>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Construction Area</p></td>
                  <td><?=$dbPropertyDetail[0]['carpet_con_area']?>
                    <?=$dbPropertyDetail[0]['carpet_con_area_unit']?></td>
                </tr>
              </table>
              <?php if($dbProperty[0]['for_property']=='Sell'){?>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> For Sell </h3>
              <table class="table table-bordered table-striped mb-0">
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Offer Price : (In Rupees)</p></td>
                  <td><?php if(empty($dbPropertyDetail[0]['pricerequest'])){?><?=$dbPropertyDetail[0]['offer_price']?>
                    <?=$dbPropertyDetail[0]['offer_price_unit']?>  <?php  } else {?> Price on request <?php }?></td>
                </tr>
              </table>
              <?php }?>
              <?php if($dbProperty[0]['for_property']=='Rent'){?>
              <h3 class="font-16 text-uppercase mt-3 mb-2"> For Rent </h3>
              <table class="table table-bordered table-striped mb-0">
                <?php if(!empty($dbPropertyDetail[0]['expected_rent'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Expected rent per month (In Rupees)</p></td>
                  <td><?=$dbPropertyDetail[0]['expected_rent']?>
                    <?=$dbPropertyDetail[0]['expected_rent_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['rent_security'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Refundable Security deposit charges</p></td>
                  <td><?=$dbPropertyDetail[0]['rent_security']?>
                    <?=$dbPropertyDetail[0]['rent_security_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['maint_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Maintenance charges per month</p></td>
                  <td><?=$dbPropertyDetail[0]['maint_charge']?>
                    <?=$dbPropertyDetail[0]['maint_charge_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['tax_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Property tax charges per month approx</p></td>
                  <td><?=$dbPropertyDetail[0]['tax_charge']?>
                    <?=$dbPropertyDetail[0]['tax_charge_unit']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['other_charge'])){?>
                <tr>
                  <td class="w-40"><p class="font-bold m-0 font-14 pl-2">Other charges please specify</p></td>
                  <td><?=$dbPropertyDetail[0]['other_charge']?></td>
                </tr>
                <?php }?>
              </table>
              <?php }?>
            </div>
            <!--<div class="position-relative mb-5">
              <div class="tab-css2" id="tab3"></div>
              <h3 class="font-16 text-uppercase mt-4 mb-3">Nearby Localities</h3>
              <table class="table table-bordered table-striped">
                <tr class="w-40">
                  <td class="border-left"><p class="font-bold m-0 font-14 pl-2">School :</p></td>
                  <td><?=$dbPropertyDetail[0]['school']?></td>
                </tr>
                <?php if(!empty($dbPropertyDetail[0]['college'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">College :</p></td>
                  <td><?=$dbPropertyDetail[0]['college']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['hospital'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Hospital :</p></td>
                  <td><?=$dbPropertyDetail[0]['hospital']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['bank'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14 pl-2">Banks </p></td>
                  <td><?=$dbPropertyDetail[0]['bank']?></td>
                </tr>
                <?php }?>
              </table>
              <h3 class="font-16 text-uppercase mt-3 mb-2">Public transport details</h3>
              <table class="table table-bordered table-striped">
                <tr class="w-40">
                  <td><p class="font-bold m-0 font-14  pl-2">Near by BRTS stop :</p></td>
                  <td><?=$dbPropertyDetail[0]['brts_stop']?></td>
                </tr>
                <?php if(!empty($dbPropertyDetail[0]['r_station'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14  pl-2">Near by Railway Station :</p></td>
                  <td><?=$dbPropertyDetail[0]['r_station']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['m_station'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14  pl-2">Near by metro station :</p></td>
                  <td><?=$dbPropertyDetail[0]['m_station']?></td>
                </tr>
                <?php }?>
                <?php if(!empty($dbPropertyDetail[0]['airport'])){?>
                <tr>
                  <td><p class="font-bold m-0 font-14  pl-2">Near by Airport :</p></td>
                  <td><?=$dbPropertyDetail[0]['airport']?></td>
                </tr>
                <?php }?>
              </table>
            </div>-->
            <?php if(!empty($dbPropertyDetail[0]['google_map'])){?>
            <div class="position-relative">
              <div class="tab-css2" id="tab4"></div>
              <div class="embed-responsive embed-responsive-16by9 mt-3">
                <?=$dbPropertyDetail[0]['google_map']?>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
        <!--mobile-section-->
        <div class="clearfix"></div>
        <div id="div2">
          <div class="row mt-3 mb-4 btn-css-3">
            <div class="col-md-6 col-6 mb-2 pr-1">
              <?php if(!isset($_SESSION['user']['is_login'])) {?>
              <a data-toggle="modal" data-target="#myModal" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" style="cursor:pointer">
              <h3 class="font-14">ARRANGE A SITE VISIT</h3>
              </a>
              <?php }else{?>
              <a data-toggle="modal" data-target="#choose-a-time1" href="javascript:;" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100">
              <h3 class="font-14">ARRANGE A SITE VISIT</h3>
              </a>
              <?php }?>
            </div>
            <div class="col-md-6 col-6 mb-2 pl-1">
              <?php if(!empty($dbPropertyDetail[0]['call_us'])){?>
              <a href="tel:+91-<?=$dbPropertyDetail[0]['call_us']?>" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" style="cursor:pointer">
              <h3 class="font-14">Call Us -
                <?=$dbPropertyDetail[0]['call_us']?>
              </h3>
              </a>
              <?php }else{?>
              <a href="tel:+91-9723992200" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" style="cursor:pointer">
              <h3 class="font-14">Call Us - 9723992200 </h3>
              </a>
              <?php }?>
              <?php //}else{?>
              <!--<a href="<?=HTACCESS_URL?>make-an-offer/<?=$dbProperty[0]['id']?>/" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100">
              <h3 class="font-14">Make An offer</h3>
              </a>-->
              <?php //}?>
            </div>
            <div class="col-md-6 col-6 mb-2 pr-1 bt-css">
              <?php if(!isset($_SESSION['user']['is_login'])) {?>
              <a data-toggle="modal" data-target="#myModal" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" style="cursor:pointer">
              <h3 class="font-14">Ask a question</h3>
              </a>
              <?php }else{?>
              <!-- <a href="<?=HTACCESS_URL?>ask-a-question/<?=$dbProperty[0]['id']?>/" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100">
              <h3 class="font-14">Ask a question</h3>
              </a>--> 
              <a data-toggle="modal" data-target="#ask-a-question" href="javascript:;" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100">
              <h3 class="font-14">Ask a question</h3>
              </a>
              <?php }?>
            </div>
            <!--<div class="col-md-6 col-6 mb-2 pl-1 bt-css ">
              <?php if(!isset($_SESSION['user']['is_login'])) {?>
              <a data-toggle="modal" data-target="#myModal" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" style="cursor:pointer">
              <h3 class="font-14">DOWNLOAD BROCHURE</h3>
              </a>
              <?php }else{?>
              <?php if(!empty($dbPropertyDetail[0]['brochure'])){?>
              <a href="<?=HTACCESS_URL?>cms_images/property/brochure/<?=$dbPropertyDetail[0]['brochure']?>" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100" download>
              <h3 class="font-14">DOWNLOAD BROCHURE</h3>
              </a>
              <?php }else{?>
              <a href="#" class="btn btn-primary font-weight-bold text-center text-uppercase text-white border-0 w-100">
              <h3 class="font-14">DOWNLOAD BROCHURE</h3>
              </a>
              <?php }}?>
            </div>-->
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-lg-4 wow fadeInRight">
        <?php if(!empty($msg)) { ?>
        <center>
          <p style="color:#F00">
            <?=$msg?>
          </p>
        </center>
        <?php } ?>
        <div class="right-box">
          <div class="row m-0">
            <div class="col-6">
              <div class="themebg box2 text-center">
                <?php if(!isset($_SESSION['user']['is_login'])) {?>
                <a data-toggle="modal" data-target="#myModal" style="cursor:pointer">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-eye font-50 d-block"></i> ARRANGE A SITE VISIT</h3>
                </a>
                <?php }else{?>
                <a data-toggle="modal" data-target="#choose-a-time2" href="javascript:;">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-eye font-50 d-block"></i> ARRANGE A SITE VISIT</h3>
                </a>
                <?php }?>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="themebg box2">
                <?php if(!empty($dbPropertyDetail[0]['call_us'])){?>
                <a href="tel:+91-<?=$dbPropertyDetail[0]['call_us']?>">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-handshake-1 font-50 d-block mt-2"> </i> Call Us<br />
                  <?=$dbPropertyDetail[0]['call_us']?>
                </h3>
                </a>
                <?php }else{?>
                <a href="tel:+91-9723992200">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-handshake-1 font-50 d-block mt-2"> </i> Call Us<br />
                  9723992200 </h3>
                </a>
                <?php }?>
                <!-- <a href="<?=HTACCESS_URL?>ask-a-question/<?=$dbProperty[0]['id']?>/">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-question font-35 d-block"></i> Ask a question</h3>
                </a>-->
                <?php //}?>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="themebg box2">
                <?php if(!isset($_SESSION['user']['is_login'])) {?>
                <a href="" data-toggle="modal" data-target="#myModal">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-question font-35 d-block"></i> Ask a question </h3>
                </a>
                <?php }else{ ?>
                <!-- <a href="<?=HTACCESS_URL?>ask-a-question/<?=$dbProperty[0]['id']?>/">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-question font-35 d-block"></i>
                Ask a question</h3>
                </a>--> 
                <a data-toggle="modal" data-target="#ask-a-question1" href="javascript:;">
                <h3 class="font-16 text-uppercase text-white"> <i class="flaticon-question font-35 d-block"></i> Ask a question</h3>
                </a>
                <?php }?>
              </div>
            </div>
            <!--<div class="col-6 text-center">
              <div class="themebg box2">
                <?php if(!isset($_SESSION['user']['is_login'])) {?>
                <a href="<?=HTACCESS_URL?>sign-up/"><i class="d-block"> <img src="<?=HTACCESS_URL?>assets/img/download.png"></i>
                <h3 class="font-16 text-uppercase text-white text-center">DOWNLOAD<br>
                  BROCHURE </h3>
                </a>
                <?php }else{?>
                <?php if(!empty($dbPropertyDetail[0]['brochure'])){?>
                <a href="<?=HTACCESS_URL?>cms_images/property/brochure/<?=$dbPropertyDetail[0]['brochure']?>" download> 
                <i class="d-block"> <img src="<?=HTACCESS_URL?>assets/img/download.png"></i>
                <h3 class="font-16 text-uppercase text-white text-center">DOWNLOAD<br>
                  BROCHURE </h3>
                </a>
                <?php }else{?>
                <a href="#"><i class="d-block"> <img src="<?=HTACCESS_URL?>assets/img/download.png"></i>
                <h3 class="font-16 text-uppercase text-white text-center">DOWNLOAD<br>
                  BROCHURE </h3>
                </a>
                <?php }}?>
              </div>
            </div>-->
            <?php if(!empty($dbPropertyDetail[0]['contact_no'])){?>
            <div class="col-md-12">
              <h3 class="text-center mt-2"><i class="fa fa-phone font-25"></i> Call - <a href="tel:<?=$dbPropertyDetail[0]['contact_no']?>">
                <?=$dbPropertyDetail[0]['contact_no']?>
                </a> </h3>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php unset($_SESSION['siteVisit_msg']);?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>
<!--arrange-a-site-visit-->
<div class="modal fade" id="choose-a-time1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <!-- Modal body -->
      <div class="modal-body"> <a class="close-modal" data-dismiss="modal">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
          <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z" fill="#ffffff"></path>
        </svg>
        </a>
        <div style="width:100%;">
          <form method="post" id="SiteVisit1" action="/" onSubmit="return chkSiteVisit1();" autocomplete="off">
            <input type="hidden" name="mode" value="site_visit">
            <input type="hidden" name="property_id" value="<?=$dbProperty[0]['id']?>">
            <div class="datetimepicker3">
              <h6>Just let us know a time that suits you!</h6>
              <input type="text" name="site_visit_date_time" id="datetimepicker5" value="<?=date("Y-m-d H:i:s")?>"/>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="mobile_no" id="time_mobile_no1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onBlur="getSiteVisitOtp(this.value)" class="form-control font-16 input-css" placeholder="Mobile No" value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="time_otp" id="time_otp1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-16 input-css" placeholder="Otp" value="">
                </div>
              </div>
              <button type="submit" class="btn">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="choose-a-time2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <!-- Modal body -->
      <div class="modal-body"> <a class="close-modal" data-dismiss="modal">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
          <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z" fill="#ffffff"></path>
        </svg>
        </a>
        <div style="width:100%;">
          <form method="post" id="SiteVisit" action="/" onSubmit="return chkSiteVisit2();" autocomplete="off">
            <input type="hidden" name="mode" value="site_visit">
            <input type="hidden" name="property_id" value="<?=$dbProperty[0]['id']?>">
            <div class="datetimepicker3">
              <h6>Just let us know a time that suits you!</h6>
              <input type="text" name="site_visit_date_time" id="datetimepicker6" value="<?=date("Y-m-d H:i:s")?>"/>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="mobile_no" id="time_mobile_no2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onBlur="getSiteVisitOtp(this.value)" class="form-control font-16 input-css" placeholder="Mobile No" value="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="time_otp" id="time_otp2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-16 input-css" placeholder="Otp" value="">
                </div>
              </div>
              <button type="submit" class="btn">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--ask-a-question-->
<div class="modal fade" id="ask-a-question1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:none">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!--<div id="ask-a-question1" action="" method="post" style="display: none; width: 100%; max-width: 660px;" class="">-->
      <div class="container">
        <h3 class="font-16 text-uppercase text-dark mb-2"> Ask A Question</h3>
        <form action="/" id="askQuestion1" onSubmit="return chkAskQue1();" method="post" autocomplete="off">
          <input type="hidden" name="mode" value="ask_a_question">
          <input type="hidden" name="property_id" value="<?=$dbProperty[0]['id']?>">
          <input type="hidden" name="clientid" value="<?=$dbUser[0]['clientid']?>">
          <input type="hidden" name="user_id" value="<?=$dbUser[0]['id']?>">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control font-16 input-css" placeholder="Name" value="<?=$dbUser[0]['name']?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control font-16 input-css" placeholder="Email" value="<?=$dbUser[0]['email']?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="mobile_no" id="mobile_no" onBlur="getOtp(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-16 input-css" placeholder="Mobile" value="<?=$_SESSION['prop_ask']['mobile_no'] ?? ""?>">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea class="form-control font-16 input-css" name="question" id="question" rows="5" placeholder="Your question"><?=$_SESSION['prop_ask']['question'] ?? ""?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="ask_otp" id="ask_otp1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-16 input-css" placeholder="Otp" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now  submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ask-a-question">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:none">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!--<div id="ask-a-question" action="" method="post" style="display: none; width: 100%; max-width: 660px;" class="">-->
      <div class="container">
        <h3 class="font-16 text-uppercase text-dark mb-2"> Ask A Question</h3>
        <form action="/" method="post" id="askQuestion" onSubmit="return chkAskQue();" autocomplete="off">
          <input type="hidden" name="mode" value="ask_a_question">
          <input type="hidden" name="property_id" value="<?=$dbProperty[0]['id']?>">
          <input type="hidden" name="clientid" value="<?=$dbUser[0]['clientid']?>">
          <input type="hidden" name="user_id" value="<?=$dbUser[0]['id']?>">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control font-16 input-css" placeholder="Name" value="<?=$dbUser[0]['name']?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control font-16 input-css" placeholder="Email" value="<?=$dbUser[0]['email']?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="mobile_no" id="mobile_nos" onBlur="getOtp(this.value)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?=$_SESSION['prop_ask']['mobile_no'] ?? ""?>" class="form-control font-16 input-css" placeholder="Mobile">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea class="form-control font-16 input-css" name="question" id="questions" rows="5" placeholder="Your question"><?=$_SESSION['prop_ask']['question'] ?? ""?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="ask_otp" id="ask_otp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control font-16 input-css" placeholder="Otp" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now  submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--ask-a-question--> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script>
function chkAskQue1() {
	
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Name");
		return false;
	}
	
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Email");
		return false;
	}
	
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		//document.getElementById("errorpop1").innerHTML=(" Invalid Email ");
		alert("Invalid Email");
		return false;
	}

	if(isEmpty("Mobile No",document.getElementById("mobile_no").value)) {
		document.getElementById("mobile_no").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Mobile No");
		return false;
	}
	
	if(isEmpty("Question",document.getElementById("question").value)) {
		document.getElementById("question").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Question");
		return false;
	}
	
	if(isEmpty("Otp",document.getElementById("ask_otp1").value)) {
		document.getElementById("ask_otp1").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Otp");
		return false;
	}

	ajaxgetpAskQue1();
	//return true;
	return false;
} 

function ajaxgetpAskQue1() {
/*function ajaxgetpContact(id, obj) {*/

	 //var message = document.getElementById("message").value;
	//alert("ID: " + id);
            //val = obj.getAttribute('data-value');
            //alert(val);
    // Fetch form to apply custom Bootstrap validation
    var form = $("#askQuestion1")

	
	//alert(111);
		var form_data=$('#askQuestion1').serialize();
			$.ajax({
			url:"<?=HTACCESS_URL?>propertyController.php?mode=ask_a_question",
			data:form_data,
			cache:false,
			async:false,
			//data: {message: "message"},
			success: function(data) {
				//alert(data);
				if(data==1){
					//alert(data);
				//$('#myModal3').click();
				//$('#requestForm')[0].reset(); 
				$('#ask-a-question1').click();
				$('#openthankyou').click();
				
				}else if(data==2){
					alert("Invalid Otp");
				}
			}
			
			});
	
}



function chkAskQue() {
	
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Name");
		return false;
	}
	
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Email");
		return false;
	}
	
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		//document.getElementById("errorpop1").innerHTML=(" Invalid Email ");
		alert("Invalid Email");
		return false;
	}

	if(isEmpty("Mobile No",document.getElementById("mobile_nos").value)) {
		document.getElementById("mobile_nos").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Mobile No");
		return false;
	}
	
	if(isEmpty("Question",document.getElementById("questions").value)) {
		document.getElementById("questions").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Question");
		return false;
	}
	
	if(isEmpty("Otp",document.getElementById("ask_otp").value)) {
		document.getElementById("ask_otp").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Otp");
		return false;
	}

	ajaxgetpAskQue();
	//return true;
	return false;
} 
	 

function ajaxgetpAskQue() {
/*function ajaxgetpContact(id, obj) {*/

	 //var message = document.getElementById("message").value;
	//alert("ID: " + id);
            //val = obj.getAttribute('data-value');
            //alert(val);
    // Fetch form to apply custom Bootstrap validation
    var form = $("#askQuestion")

	
	//alert(111);
		var form_data=$('#askQuestion').serialize();
			$.ajax({
			url:"<?=HTACCESS_URL?>propertyController.php?mode=ask_a_question",
			data:form_data,
			cache:false,
			async:false,
			//data: {message: "message"},
			success: function(data) {
				//alert(data);
				if(data==1){
					//alert(data);
				//$('#myModal3').click();
				//$('#requestForm')[0].reset(); 
				$('#ask-a-question').click();
				$('#openthankyou').click();
				
				}else if(data==2){
					alert("Invalid Otp");
				}
			}
			
			});
	
}


function chkSiteVisit1() {

	if(isEmpty("Mobile No",document.getElementById("time_mobile_no1").value)) {
		document.getElementById("time_mobile_no1").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Mobile No");
		return false;
	}
	
	if(isEmpty("Otp",document.getElementById("time_otp1").value)) {
		document.getElementById("time_otp1").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Otp");
		return false;
	}

	ajaxgetpSiteVisit1();
	//return true;
	return false;
} 

function ajaxgetpSiteVisit1() {
/*function ajaxgetpContact(id, obj) {*/

	 //var message = document.getElementById("message").value;
	//alert("ID: " + id);
            //val = obj.getAttribute('data-value');
            //alert(val);
    // Fetch form to apply custom Bootstrap validation
    var form = $("#SiteVisit1")

	
		//alert(111);
		var form_data=$('#SiteVisit1').serialize();
			$.ajax({
			url:"<?=HTACCESS_URL?>propertyController.php?mode=site_visit",
			data:form_data,
			cache:false,
			async:false,
			//data: {message: "message"},
			success: function(data) {
				//alert(data);
				if(data==1){
					//alert(data);
				//$('#myModal3').click();
				//$('#requestForm')[0].reset(); 
				$('#choose-a-time1').click();
				$('#openthankyou').click();
				
				}else if(data==2){
					alert("Invalid Otp");
				}
			}
			
			});
	
}


function chkSiteVisit2() {

	if(isEmpty("Mobile No",document.getElementById("time_mobile_no2").value)) {
		document.getElementById("time_mobile_no2").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Mobile No");
		return false;
	}
	
	if(isEmpty("Otp",document.getElementById("time_otp2").value)) {
		document.getElementById("time_otp2").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Otp");
		return false;
	}

	ajaxgetpSiteVisit();
	//return true;
	return false;
} 


function ajaxgetpSiteVisit() {
/*function ajaxgetpContact(id, obj) {*/

	 //var message = document.getElementById("message").value;
	//alert("ID: " + id);
            //val = obj.getAttribute('data-value');
            //alert(val);
    // Fetch form to apply custom Bootstrap validation
    var form = $("#SiteVisit")

	
		//alert(111);
		var form_data=$('#SiteVisit').serialize();
			$.ajax({
			url:"<?=HTACCESS_URL?>propertyController.php?mode=site_visit",
			data:form_data,
			cache:false,
			async:false,
			//data: {message: "message"},
			success: function(data) {
				//alert(data);
				if(data==1){
					//alert(data);
				//$('#myModal3').click();
				//$('#requestForm')[0].reset(); 
				$('#choose-a-time2').click();
				$('#openthankyou').click();
				
				}else if(data==2){
					alert("Invalid Otp");
				}
			}
			
			});
	
}


function getOtp(MobileNo){
	//alert(itemCode);
	//itemCodes = utf8_encode(itemCode);
	 $.ajax({
			url:'<?=HTACCESS_URL?>propertyController.php?mode=get_ask_otp',
			data:'MobileNo='+MobileNo,
			success:function(response){
			//alert(response);
			//document.getElementById("itemDesc").value = response;
			if(response==1){
			alert("Otp send to your mobile no.");
			}
		}
		});
}


function getSiteVisitOtp(MobileNo){
	//alert(MobileNo);
	//itemCodes = utf8_encode(itemCode);
	 $.ajax({
			url:'<?=HTACCESS_URL?>propertyController.php?mode=get_site_visit_otp',
			data:'MobileNo='+MobileNo,
			success:function(response){
			//alert(response);
			//document.getElementById("org_otp").value = response;
			//document.getElementById("org_otp1").value = response;
			if(response==1){
			alert("Otp send to your mobile no.");
			}
		}
		});
}
</script> 
<!--arrange-a-site-visit--> 
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>assets/vendor/sliderengine/amazingslider.js"></script> 
<script src="<?=HTACCESS_URL?>assets/vendor/sliderengine/initslider-1.js"></script> 
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
if (window.pageYOffset > sticky) {
header.classList.add("sticky");
} else {
header.classList.remove("sticky");
}
}

$('#datetimepicker5').datetimepicker({
	inline:true,
	 allowTimes:[
  '10:00', '11:00', '12:00', 
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ]
});


$('#datetimepicker6').datetimepicker({
	inline:true,
	 allowTimes:[
  '10:00', '11:00', '12:00', 
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
 ]
});
</script>
<style>
/*.sticky2{display:none}*/
.sticky2.sticky2-show{display:block; margin-top:40px}
#topcontrol { display:none}
</style>
<script>
!function(e){"use strict";e('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var a=e(this.hash);if((a=a.length?a:e("[name="+this.hash.slice(1)+"]")).length)return e("html, body").animate({scrollTop:a.offset().top-54},1e3,"easeInOutExpo"),!1}}),e(".js-scroll-trigger").click(function(){e(".navbar-collapse").collapse("hide")}),e("body").scrollspy({target:"#mainNav",offset:56});function a(){100<e("#mainNav").offset().top?e("#mainNav").addClass("navbar-shrink"):e("#mainNav").removeClass("navbar-shrink")}a(),e(window).scroll(a)}(jQuery);
</script>
<style>
.tab-content>.tab-pane { padding:20px 0 0 0;}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
color:#fff;
background-color:#f20000;
border-color:0;
}

.nav-tabs .nav-link {  color:#fff;
background-color:#1c304e;
border-color:0;}

.bg-left {background:#1c304e;}
.submit2 { width:200px}
.list-css2 ol { margin:0 0 0 20px; padding:0}
.list-css2 li { line-height:30px; font-size:18px; color:#041d44; padding:0 0 0 15px}
.list-css2 li:before {
content: "\f108";
font-family: Flaticon;
position: absolute;
left:0;
color: #041d44;
}

.more{
	line-height: 25px;
	text-align:justify;
}
.morecontent span {
    display: none;
	text-align:justify;
}
.morelink {
    display: inline-block; background:#2272a9; color:#fff; padding:10px;float:right;margin-top: 5px;
}
</style>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 168;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more";
    var lesstext = "Read less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink btn-primary text-white">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
<style>
.at-resp-share-element .at-share-btn { margin-bottom:0!important}
</style>