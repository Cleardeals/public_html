<style>
.wrapper {
	cursor: pointer;
}
.wrapper .tip table {
	/* background-color: green; */
	width: 250px;
	text-align: left;
	box-shadow: 0px 0px 8px #a0a0a0ab;
	border: 0px solid #fff;
}
.wrapper .tip table tr {
	border: none;
	background-color: rgb(247, 247, 247);
}
.wrapper .tip table tr:last-child {
	background-color: #fff;
}
.wrapper .tip table td {
	padding: 3% 0% 3% 5%;
	border: none;
}
.wrapper .tip {
	position: absolute;
	font-size: 0.8rem;
	text-transform: none;
	font-weight: bold;
	margin-top: 4%;
	margin-left: 5%;
	/* left: 5px; */
  /* bottom: 5px; */
  /* top: 100%; */
	border: none;
	opacity: 0;
	pointer-events: none;/* min-width: 50%; */
}
.wrapper:hover .tip {
	opacity: 1;
	pointer-events: auto;
	z-index: 9999;
}
.wrapper .tip:before {
	position: absolute;
	content: "";
	height: 20px;
	width: 20px;
	background: rgb(247, 247, 247);
	top: 23px;
	/* bottom: 100px; */
	left: 50%;
	transform: translateX(-50%) rotate(45deg);
}
@media (max-width: 768px) {
.wrapper .tip table {
	width: 200px;
}
.wrapper .tip table td {
	padding: 4% 0% 4% 3%;
	border: none;
}
.wrapper .tip {
	position: absolute;
	top: 10%;
	left: 30%;
	right: 30%;
	margin-top: 0px;
	font-size: 0.5rem;
	text-transform: none;
	font-weight: bold;
	bottom: 30px;
	border: none;
}
.wrapper .tip:before {
	position: absolute;
	content: "";
	height: 17px;
	width: 17px;
	background: rgb(247, 247, 247);
	top: 25px;
	left: 50%;
	transform: translateX(-50%) rotate(45deg);
}
}
</style>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."package where id='2' and property_type='rent' and status='1'";
$dbPackage = $dbObj->SelectQuery();

$value = $dbPackage[0]['video'];

setcookie("TestCookie", $value);

//setcookie("TestCookie", $value, time()+3600);  /* expire in 1 hour */
//setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);

$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='4'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."faq where rent_status='1' order by display_order";
$dbFaq = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."review where rent_status='1' order by display_order";
$dbReview = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package_list where package='Rent' and status='1' order by display_order desc";
$dbPackageList = $dbObj->SelectQuery();
?>
<?php if(empty($_COOKIE["TestCookie"])){?>
<a id="consolPopup" data-fancybox href="<?=$dbPackage[0]['video']?>"></a>
<?php }?>

<!-- Header -->
<div class="center-section-in">
  <div class="container">
    <?php $title = explode(' ',$dbSitecontent[0]['title'],2); ?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-4 wow fadeInDown">
      <?=$title[0] ?? ""?>
      <span class="themecolor">
      <?=$title[1] ?? ""?>
      </span> </h2>
    
    <!--<h2><a href="<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent">Rent My Property</a> </h2>-->
    
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div>
          <h2 class="font-28 text-uppercase text-center font-extrabold mb-4 mt-4">
            <?=$dbSitecontent[0]['heading']?>
          </h2>
          <?php //=html_entity_decode(stripslashes($dbPackage[0]['content']))?>
          <div class="table-responsive">
            <table width="100%" class="table table-bordered table-striped m-0 pricing-2">
              <tr class="heading-bg">
                <td><h2 class="text-white font-26  mt-1  mb-1">Pricing and Plans</span></h2></td>
                <td><div class="wrapper">
                    <div class="tip">
                      <table>
                        <tr>
                          <td>Plan Price :</td>
                          <td><img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="11" alt="">&nbsp;
                            <?=number_format($dbPackage[0]['cost'])?></td>
                        </tr>
                        <tr>
                          <td>GST @ 18% :</td>
                          <td><img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="11" alt="">&nbsp;
                            <?=number_format((18/100)*$dbPackage[0]['cost'])?></td>
                        </tr>
                        <hr>
                        <tr>
                          <td>Amount Payable :</td>
                          <td><img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="11" alt="">&nbsp;
                            <?=number_format(((18/100)*$dbPackage[0]['cost'])+$dbPackage[0]['cost'])?></td>
                        </tr>
                      </table>
                    </div>
                    <div class="content">
                      <h2 class="text-white font-26  mt-1  mb-1">Basic Package</span></h2>
                      <h3 class="text-white font-26 mb-1 mt-1">Rs.
                        <?=number_format($dbPackage[0]['cost'])?>
                        /- *&nbsp;<img src="<?=HTACCESS_URL?>assets/img/Question.png" width="18" alt="" style="border:1px solid #fff;padding:3px 4px;border-radius:50%;"> </h3>
                    </div>
                  </div>
                  <h2 class="font-20 text-uppercase text-center font-extrabold btn bg-theme">
                    <?php if(!isset($_SESSION['user']['is_login'])) {?>
                    <a data-toggle="modal" data-target="#myModal" class="text-white" style="cursor:pointer"> Rent My House</a>
                    <?php }else{?>
                    <a href="<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent&type=Basic Package" class="text-white"> Rent My Property</a>
                    <?php }?>
                  </h2></td>
              </tr>
              <?php for($i=0;$i<count((array)$dbPackageList);$i++){?>
              <tr>
                <td><p class="m-0 pl-3">
                    <?=$dbPackageList[$i]['title']?>
                  </p></td>
                <td class="text-center"><?php if($dbPackageList[$i]['basic_package']=='no_basic'){?>
                  <i class="fa fa-times tick-2" aria-hidden="true"></i>
                  <?php }else?>
                  <?php if($dbPackageList[$i]['basic_package']=='check_basic'){?>
                  <i class="fa fa-check tick-2" aria-hidden="true"></i>
                  <?php }?>
                  <?php if($dbPackageList[$i]['basic_package']=='input_box_basic'){?>
                  <strong>
                  <?=$dbPackageList[$i]['textbox_basic']?>
                  </strong>
                  <?php }?></td>
              </tr>
              <?php }?>
              <tr class="bg-white">
                <td>&nbsp;</td>
                <td class="text-center"><h2 class="font-20 text-uppercase text-center font-extrabold btn bg-theme text-white">
                    <?php if(!isset($_SESSION['user']['is_login'])) {?>
                    <a data-toggle="modal" data-target="#myModal" class="text-white" style="cursor:pointer"> Rent My Property</a>
                    <?php }else{?>
                    <a href="<?=HTACCESS_URL?>userController.php?mode=sell_property&for_property=rent&type=Basic Package" class="text-white"> Rent My Property</a>
                    <?php }?>
                  </h2></td>
              </tr>
            </table>
          </div>
          <p class="text-center mt-3 mb-3">
            <?=html_entity_decode(stripslashes($dbPackage[0]['note']))?>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="container-fluid bg-light pt-2 pb-2 mb-5 mt-5">
    <div class="container">
      <h2 class="font-30 text-uppercase text-center font-extrabold header-border mt-4">client <span class="themecolor">reviews</span> </h2>
      <div class="bg-light pt-5 pb-5">
        <div class="container">
          <div class="owl-carousel1 owl-carousel owl-theme owl-loaded owl-drag">
            <?php for($i=0;$i<count((array)$dbReview);$i++){?>
            <div class="item">
              <div class="box-css2 box-boder p-3">
                <p>
                  <?=$dbReview[$i]['review']?>
                </p>
                <?php if($dbReview[$i]['rating']=='1'){?>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php }?>
                <?php if($dbReview[$i]['rating']=='2'){?>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php }?>
                <?php if($dbReview[$i]['rating']=='3'){?>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php }?>
                <?php if($dbReview[$i]['rating']=='4'){?>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php }?>
                <?php if($dbReview[$i]['rating']=='5'){?>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>
                <?php }?>
              </div>
              <div class="title-t">
                <h4>
                  <?=$dbReview[$i]['name']?>
                  <span>
                  <?=$dbReview[$i]['designation']?>
                  </span> </h4>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">Rent Property <span class="themecolor">FAQ</span> </h2>
    <div id="accordion">
      <?php for($i=0;$i<count((array)$dbFaq);$i++){?>
      <?php if($i==0){?>
      <button class="ff_faq_header btn btn-link montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id'] ?? ""?>" aria-expanded="true" aria-controls="ff_item_<?=$dbFaq[$I]['id'] ?? ""?>">
      <?=$dbFaq[$i]['question']?>
      </button>
      <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse show" data-parent="#accordion">
        <div class="ff_faq_item">
          <?=$dbFaq[$i]['answer']?>
        </div>
      </div>
      <?php }else{?>
      <button class="ff_faq_header btn btn-link collapsed montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="false" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
      <?=$dbFaq[$i]['question']?>
      </button>
      <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse montserrat" data-parent="#accordion">
        <div class="ff_faq_item">
          <?=$dbFaq[$i]['answer']?>
        </div>
      </div>
      <?php }}?>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
</div>
<br />
<br />
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script>
$(document).ready(function () {
$("#consolPopup").fancybox({
    'overlayShow': true
}).trigger('click');
});
</script>
<style>
@media (min-width:991px) {
.fancybox-slide--video .fancybox-content{ width:55%!important; height:54%!important;}
}
</style>