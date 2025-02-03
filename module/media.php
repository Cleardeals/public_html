<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['subscribe_msg'] ?? "");
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='18'";
$dbSitecontent = $dbObj->SelectQuery();
?>
<!-- Header -->
<div  class="center-section-in">
  <div class="container">
  <?php if(!empty($dbSitecontent[0]['title'])){?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInDown"> <span class="themecolor"><?=$dbSitecontent[0]['title']?></span> </h2>
    <?php }?>
    <div class="row justify-content-center">
    <div class="col-lg-12">
    <?=html_entity_decode(stripslashes($dbSitecontent[0]['content']))?>
    </div>
      <!--<div class="col-lg-8">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn">
            <div class="blog-text">
              <div class="blog-img"><a href="<?=HTACCESS_URL?>media-detail/"> <img src="<?=HTACCESS_URL?>assets/img/blog/blog1.jpg" alt="" title="" class="img-fluid"></a></div>
              <h3 class="mt-3 mb-1"><span class="font-14 font-weight-bold themecolor montserrat">12 July, 2019</span> <span class="text-gray font-14 font-weight-bold montserrat">-Cleardeals</span></h3>
              <h2 class="font-19 font-semibold mb-4 open-sans"><a href="<?=HTACCESS_URL?>media-detail/">Expensive First Time Seller Mistakes!</a></h2>
              <a href="" class="read-more font-14 themecolor font-weight-bold text-uppercase border-bubble d-block relative">Read More</a></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn">
            <div class="blog-text">
              <div class="blog-img"><a href="<?=HTACCESS_URL?>media-detail/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog2.jpg" alt="" title="" class="img-fluid"></a></div>
              <h3 class="mt-3 mb-1"><span class="font-14 font-weight-bold themecolor montserrat">12 July, 2019</span> <span class="text-gray font-14 font-weight-bold montserrat">-Cleardeals</span></h3>
              <h2 class="font-19 font-semibold mb-4 open-sans"><a  href="<?=HTACCESS_URL?>media-detail/">Expensive First Time Seller Mistakes!</a></h2>
              <a href="" class="read-more font-14 themecolor font-weight-bold text-uppercase border-bubble d-block relative">Read More</a></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn">
            <div class="blog-text">
              <div class="blog-img"><a href="<?=HTACCESS_URL?>media-detail/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog3.jpg" alt="" title="" class="img-fluid"></a></div>
              <h3 class="mt-3 mb-1"><span class="font-14 font-weight-bold themecolor montserrat">12 July, 2019</span> <span class="text-gray font-14 font-weight-bold montserrat">- Cleardeals</span></h3>
              <h2 class="font-19 font-semibold mb-4 open-sans"><a  href="<?=HTACCESS_URL?>media-detail/">Expensive First Time Seller Mistakes!</a></h2>
              <a href="" class="read-more font-14 themecolor font-weight-bold text-uppercase border-bubble d-block relative">Read More</a></div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn">
            <div class="blog-text">
              <div class="blog-img"><a href="<?=HTACCESS_URL?>media-detail/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog4.jpg" alt="" title="" class="img-fluid"></a></div>
              <h3 class="mt-3 mb-1"><span class="font-14 font-weight-bold themecolor montserrat">12 July, 2019</span> <span class="text-gray font-14 font-weight-bold montserrat">- Cleardeals</span></h3>
              <h2 class="font-19 font-semibold mb-4 open-sans"><a  href="<?=HTACCESS_URL?>media-detail/">Expensive First Time Seller Mistakes!</a></h2>
              <a href="" class="read-more font-14 themecolor font-weight-bold text-uppercase border-bubble d-block relative">Read More</a></div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12">
            <div class="text-right">
              <ul class="pagination float-right">
                <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"></i></span> <span class="sr-only">Previous</span> </a> </li>
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-angle-right"></i></span> <span class="sr-only">Next</span> </a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-7 wow fadeInRight">
        <div class="archives">
          <h2 class="font-20 montserrat font-weight-bold">Category</h2>
          <ul>
            <li><a href="">Lorem ipsum dolor </a></li>
            <li><a href="">Lorem ipsum dolor </a></li>
            <li><a href="">Lorem ipsum dolor </a></li>
            <li><a  href="">Lorem ipsum dolor </a></li>
          </ul>
        </div>
        <div class="row mt-3">
          <div class="col-md-6 col-6 pr-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum1.jpg" class="img-fluid" alt="" title="">
            <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt">SELL MY PROPERTy</h4>
            </a> </div>
          <div class="col-md-6 col-6 pl-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum2.jpg" class="img-fluid" alt="" title="">
            <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt">RENT MY PROPERTy</h4>
            </a> </div>
          <div class="col-md-6 col-6 pr-2 mb-3 text-center"> <a href="<?=HTACCESS_URL?>sell-property-listing/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum3.jpg" class="img-fluid" alt="" title="">
            <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt">Search properties</h4>
            </a> </div>
          <div class="col-md-6 col-6 pl-2 mb-3 text-center"> <a href="https://www.epropvalue.com/"><img src="<?=HTACCESS_URL?>assets/img/blog/blog-thum4.jpg" class="img-fluid" alt="" title="">
            <h4 class="font-13 text-center text-uppercase themebg text-white pt-3 pb-3 blog-right-bt">BOOK FREE VALUATION</h4>
            </a> </div>
        </div>
        <div class="newsletter-bg">
          <h3 class="text-white font-19 text-uppercase mb-2">Subscribe Newsletter</h3>
          <div class="form-group">
            <input type="text" class="form-control font-13" placeholder="Email Id">
          </div>
          <a href="" class="subscribe-now  font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">SUBSCRIBE NOW</a> </div>
      </div>
-->    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
