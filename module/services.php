<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='5'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."services where status='1'";
$dbServices = $dbObj->SelectQuery();
?>
<div class="center-section-in">
  <div class="container">
    <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInDown">
      <?=$heading[0]?>
      <span class="themecolor">
      <?=$heading[1]?>
      </span> </h2>
    <div>
      <?php for($i=0;$i<count((array)$dbServices);$i++){?>
      
      <h2 class="text-center">
        <?php $title = explode(' ',$dbServices[$i]['title'],2);?>
        <a href="#tab<?=$dbServices[$i]['id']?>" class="btn font-20 text-uppercase font-bold ">
        <?=$title[0]?>
        <span class="themecolor">
        <?=$title[1]?>
        </span></a></h2>
      <div class="myTabContent position-relative">
        <div><span id="propertyservice<?=$dbServices[$i]['id']?>" style="position:absolute;top:-200px;display:block">
        </span>
          <div class="row">
            <div class="col-md-4 text-center"><img src="<?=HTACCESS_URL?>cms_images/services/original/<?=$dbServices[$i]['image']?>" class="img-fluid tab-img w-100"></div>
            <div class="col-md-8">
              <h3 class="font-20 themecolor mb-3">
                <?=$dbServices[$i]['title']?>
              </h3>
              <div class="tab-list">
                <?=html_entity_decode(stripslashes($dbServices[$i]['content']))?>
                <!--<ul>
                  <li class="border-l"><span>Step 1.</span>Get an all inclusive price quote from our experts</li>
                  <li class="border-l"><span>Step 2.</span> Make your payment, and move with ZERO hassle</li>
                  <li><span>Step 3.</span>Complete the initial forms and get going. We will setup your file intantly, and start conducting searches.</li>
                </ul>--> 
              </div>
              <div class="row">
              <div class="col-md-6" style="max-width:41%;">
               <?php if(!isset($_SESSION['user']['is_login'])) {?>
               <a data-toggle="modal" data-target="#myModal" href="" class="btn font-15 text-uppercase font-bold tab-btn">Get free advice now <i class="flaticon-long-right-arrow"></i></a>
               <?php }else{?>
              <form method="post" action="<?=HTACCESS_URL?>contactController.php">
              <input type="hidden" name="mode" value="get_free_advice">
              <input type="hidden" name="service" value="<?=$dbServices[$i]['title']?>">
             
              <button type="submit" class="btn font-15 text-uppercase font-bold tab-btn">
              Get free advice now <i class="flaticon-long-right-arrow"></i></button>
              </form>
                <?php }?>
              </div>
              <!--<div class="col-md-6">
              <form method="post" action="<?=HTACCESS_URL?>contactController.php">
              <input type="hidden" name="mode" value="services_enquiry">
              <input type="hidden" name="service" value="<?=$dbServices[$i]['title']?>">
              <button class="btn font-15 text-uppercase font-bold tab-btn2" href="<?=HTACCESS_URL?>enquiry-form/">
              Enquiry Form <i class="flaticon-paper-plane"></i></button> 
              </form>
              </div>-->
              </div>
              </div>
          </div>
        </div>
      </div>
      
      <?php }?>
    </div>
  </div>
  <div class="with-cleardeals wow fadeIn">
    <div class="text-center col-12">
      <?=$dbSitecontent[0]['short_desc']?>
    </div>
  </div>
  <?php include('partner-detail.php');?>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>