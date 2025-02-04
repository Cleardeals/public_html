<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."review where home_status='1' and admin_del='0' order by display_order";
$dbReview = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='1'";
$dbHomecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='12'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package where id='1' and property_type='sell' and status='1'";
$dbSellPackage = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package where id='2' and property_type='rent' and status='1'";
$dbRentPackage = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."home where id='1'";
$dbHome = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."sold_property where status='1' order by display_order";
$dbSoldProperty = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."testimonial_video where status='1' order by display_order LIMIT 5";
$dbVideo = $dbObj->SelectQuery();
?>

<!--preloader-->

<!--<div id="preloader"><img src="<?=HTACCESS_URL?>assets/img/preload.gif" class="preload-img"/></div>-->

<!-- preloader-->

<!-- Header -->

<?php if($dbSettings[0]['commstatus']==1){?>

<div id="sticky">
  <div class="position-relative">
    <div id="hide" class="div-close"><img src="<?=HTACCESS_URL?>assets/img/close.svg" width="15"> </div>
    <div class="clearfix"></div>
    <div id="counter">
      <div class="counter-value text-center" data-count="<?=$dbSettings[0]['commin']?>" style="display:none">0</div>
      <div class="counter-value text-center font-weight-bold rupee" data-count="<?=$dbSettings[0]['commax']?>">
        <?=$dbSettings[0]['commin']?>
      </div>
      <p class="mt-2 mb-0">Commission<br>
        saved till date</p>
    </div>
  </div>
</div>
<?php }?>
<header class="masthead"> <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHomecontent[0]['image']?>" class="img-fluid w-100">
  <div class="container-fluid d-flex align-items-center">
    <div class="cloud">
      <div class="mx-auto text-center container" id="banner_top">
        <h1 class="text-white mx-auto wow fadeInDown montserrat font-weight-bolder">
          <?=$dbHomecontent[0]['title']?>
        </h1>
        <h2 class="text-white font-italic wow fadeIn">
          <?=$dbHomecontent[0]['heading']?>
          <span class="themecolor"> </span> </h2>
        <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="btn themebg text-white theme-btn mb-3 wow fadeIn"> Sell  Property <i class="flaticon-play-button"></i></a> &nbsp; <a href="<?=HTACCESS_URL?>search-property-thumb/" class="wow fadeIn btn blue-bg text-white theme-btn mb-3"> Buy Property <i class="flaticon-play-button"></i></a>
        <div class="clearfix"></div>
        <?php if(!empty($dbHome[0]['h_video'])){?>
        <a data-fancybox="" href="<?=$dbHome[0]['h_video']?>" class="btn text-white border theme-btn-boder wow fadeIn font-14" >Watch Video <i class="flaticon-play-button font-14"></i></a>
        <?php }?>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="clearfix"></div>
</header>
<div class="center-section">
  <div class="container container2">
    <div class="sell-your-property">
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn">Do You Struggle To <span class="themecolor">Sell Your Property?</span></h2>
      <div class="row">
        <div class="col-md-5 wow fadeIn">
          <ul>
            <li>Is your property taking too long to sell?</li>
            <li>Are you struggling to get buyers?</li>
            <li>Is Internet marketing of your property upto mark?</li>
            <li>Are you promoting your property at a wrong market price?</li>
          </ul>
        </div>
        <div class="col-md-7 wow fadeIn">
          <ul>
            <li>Has your agent done enough homework before putting your property on market?</li>
            <li>Are you burning your hard earned money on Brokerages?</li>
            <li>Is delay in home-selling hurting your next big moves?</li>
            <li>Is it time to improve on existing efforts?</li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-40"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder2 btn mr-1 ml-1"> Sell my Property <i class="flaticon-clipboard-with-pencil"></i></a> 
        
        <!--<a href="<?=HTACCESS_URL?>home-loan-calculator/" class="theme-btn-boder2 btn" target="_blank"> Home Loan Calculator </a> --> 
        
      </div>
    </div>
  </div>
  
  <div class="founder">

    <div class="container text-center wow fadeInUp">

      <h3 class="font-35 mb-3">In India, Traditional Estate Agencies charge<br>

        too much for too little services!</h3>

      <h5 class="font-17 themecolor mt-2">Nikunj Adeshra, <span class="font-italic font-semibold">Founder</span></h5>

    </div>

  </div>
  
  <?php if(!empty($dbHomecontent[0]['content'])){?>
  <div class="brokerage">
    <div class="container text-center wow fadeInUp"> 
      
      <h2> "We save home-sellers from the cost of brokerage, yet deliver the quickest, 

        hassle-free and affordable real estate services you love"</h2>

      <p> We at Cleardeals feel your pain of paying high "Brokerages" for the property deals. We understand how it feels to deal with the circumstances that may arise from a home deal that goes wrong due to amateur traditional estate agency. That's why we have designed an alternate solution to provide you with a highly professional and "no brokerage" real estate service for your home selling. </p>
      
      <!-- <?=html_entity_decode(stripslashes($dbHomecontent[0]['content']))?> -->
      <?= nl2br(html_entity_decode(stripslashes(str_replace(array("\\r\\n", "\\n\\r", "\\n", "\\r", "\\"), '', $dbHomecontent[0]['content'])))) ?>

      
       <a class="theme-btn-boder2 btn font-13 pt-0 pb-0 montserrat font-bold" href="<?=HTACCESS_URL?>about/"> Continue Reading 

      <i class="fa fa-long-arrow-right font-18"></i></a> 
      
    </div>
  </div>
  <?php }?>
  <div class="fastest-growing">
    <div class="container text-center text-white wow fadeIn">
      <h2>Cleardeals is "India's 1<sup>st</sup> and fastest growing amazingly affordable <span>"Online Estate Agents"! </span></h2>
    </div>
  </div>
  <div class="benefits">
    <div class="container">
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeInUp"> <span class="themecolor">Benefits</span> of using our services </h2>
    </div>
    <div class="container-fluid pl-5 pr-5">
      <div class="row justify-content-center">
        <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/discount.svg" width="60">
          <h3>Achieve the best price</h3>
          <p> Our local experts guide you to market your property at the right price and helps you achieve upto 98% of your asking price.</p>
        </div>
        <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/teamwork.svg" width="60">
          <h3>Millions of Buyers</h3>
          <p> Property promotion on major online
            
            portals leading to a lot of buyers for your property.</p>
        </div>
        <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/customer-service.svg" width="60">
          <h3> Here when you need help</h3>
          <p> We have a strong backend team to send you filtered buyers and handle all your queries. </p>
        </div>
        <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/house.svg" width="60">
          <h3>Sell your home quickly</h3>
          <p>Our strong completion team reduce the deal fall-throughs.</p>
        </div>
        <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/like.svg" width="60">
          <h3> We do it all</h3>
          <p> We also provide other related services like Home Loans, Conveyancing services, Movers and packers and all other boring stuff for you, on your request. </p>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="text-center wow fadeInUp"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder3 btn font-extrabold font-20"><span>Sell my </span> property</a></div>
    </div>
  </div>
  <div class="three-color">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6 wow fadeIn"> <img src="<?=HTACCESS_URL?>assets/img/join.png" class="img-fluid">
          <h3 class="themecolor">Join the<br>
            Revolution </h3>
          <p>Get filtered buyers to sell property quickly</p>
        </div>
        <div class="col-md-4 col-sm-6 wow fadeIn"> <img src="<?=HTACCESS_URL?>assets/img/sells.png" class="img-fluid">
          <h3 class="themecolor">Use the services that sells &
            
            save brokerage </h3>
          <p>You don't have to deal with traditional estate agents and burn your money</p>
        </div>
        <div class="col-md-4 col-sm-6 wow fadeIn"> <img src="<?=HTACCESS_URL?>assets/img/home-seller.png" class="img-fluid">
          <h3 class="themecolor">Become the Actual<br>
            Home-Seller </h3>
          <p>You'll have a proven services to sell your <br>
            property. </p>
        </div>
      </div>
    </div>
  </div>
  <div class="testimonial">
    <div class="container wow fadeIn">
      <div class="text-center mb-40"> <img src="<?=HTACCESS_URL?>assets/img/logo.png" class="img-fluid"></div>
      <div class="owl-carousel1 owl-carousel owl-theme">
        <?php for($i=0;$i<count((array)$dbReview);$i++){?>
        <div class="item">
          <div class="box-css2">
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
      <div class="text-center"> <a href="<?=HTACCESS_URL?>review-us-form/" class="btn themebg text-white theme-btn mb-3 mt-4 font-14"> REVIEW US <i class="fa fa-long-arrow-right font-16"></i></a></div>
    </div>
  </div>
  <?php /*?><div class="three-color">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-4 wow fadeInUp"> Video <span class="themecolor"> Testimonials</span> </h2>
        </div>
        <div class="container">
          <div>
            <div class="owl-carousel-2 owl-carousel owl-theme">
              <?php for($i=0;$i<count((array)$dbVideo);$i++){?>
              <?php $loadClass = "lazy-fast"; if($i > 1) $loadClass = "lazy"; ?>
              <div class="item fancybox-3"> <a data-fancybox href="<?=$dbVideo[$i]['pop_url']?>"></a>
                <iframe class="<?php echo $loadClass; ?>" width="100%" height="300" data-src="https://www.youtube.com/embed/<?=$dbVideo[$i]['embed_code']?>" src="javascript:;" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
              </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><?php */?>
  <div class="estimated-property">
    <div class="container text-center">
      <div class="center-div">
        <h2 class="font-30 text-uppercase text-center font-extrabold header-border wow fadeInUp"> How much could you save as <span class="themecolor">brokerage?</span></h2>
        <div class="row">
          <div class="col-md-6 col-sm-6 col-7 font-20 font-weight-bold text-blue2 mt-3 text-left"> Estimated Property Value:</div>
          <div class="col-md-6 col-sm-6 col-5 font-30 themecolor font-weight-bold text-right">₹ <!--<span id="demo"></span>--><input id="demo" name="amount" value="3500000" class="input-Amount custom-range" style="display: inline-block;width: 80%;border: 0;height: 30px;color:#e30000;font-weight:700;"> </span></div>
        </div>
        <div class="slidecontainer">
          <!--<input type="range" min="1000000" max="50000000" step="50000" value="3500000" class="slider" id="myRange">-->
          <input id="myRange" type="range" min="1000000" max="50000000" step="50000" class="slider" value="3500000">
        </div>
        <p class="font-16">Based on a Traditional Estate Agents Commission Fee of 1.5% <span class="themecolor">* </span></p>
        <h3 class="mt-3 font-30 text-blue open-sans">You Save: ₹ <span id="demo1"></span></h3>
        <a href="<?=HTACCESS_URL?>book-free-valuation/" class="theme-btn-boder2 btn mt-4 montserrat font-15">Book FREE VALUATION <i class="fa fa-long-arrow-right font-16"></i></a></div>
    </div>
  </div>
  <div class="testimonial sold-property-2">
    <div class="container wow fadeIn">
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"> <span class="themecolor">Just Sold </span> properties </h2>
      <div class="owl-carousel2 owl-carousel owl-theme">
       <?php ?> <?php for($i=0;$i<count((array)$dbSoldProperty);$i++){?>
        <div class="item"> <img src="<?=HTACCESS_URL?>cms_images/sold-property/thumb/<?=$dbSoldProperty[$i]['image']?>" class="img-fluid">
          <div class="property-css2">
            <div class="title-t">
              <h4>
                <?=$dbSoldProperty[$i]['property_name']?>
              </h4>
            </div>
            <p>
              <?=nl2br($dbSoldProperty[$i]['content'])?>
            </p>
          </div>
        </div>
        <?php }?><?php ?>
      </div>
      
      <div class="text-center"> <a href="<?=HTACCESS_URL?>review-us-form/" class="btn themebg text-white theme-btn mb-3 mt-4 font-14">Read More <i class="fa fa-long-arrow-right font-16"></i></a></div> 
      
    </div>
  </div>
  <div class="we-make">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php $hTitle = explode(" ",$dbHome[0]['h_title'],2)?>
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-4 wow fadeInUp">
            <?=$hTitle[0]?>
            <span class="themecolor">
            <?=$hTitle[1]?>
            </span> </h2>
          <p class="text-center mb-40">
            <?=$dbHome[0]['h_subtitle']?>
          </p>
        </div>
        <div class="col-lg-3 col-md-6  col-sm-6  mb-1 wow fadeInLeft">
          <div class="box-4">
            <div class="text-center mb-3">
              <?php if(!empty($dbHome[0]['image1'])){?>
              <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image1']?>" width="55" height="55">
              <?php }?>
            </div>
            <h3 class="montserrat">
              <?=$dbHome[0]['h_title1']?>
            </h3>
            <?php $hDetail1 = explode(" ",$dbHome[0]['h_detail1'],2)?>
            <h2><span class="open-sans font-47">
              <?=$hDetail1[0]?>
              </span><span class="font-italic font-weight-normal">
              <?=$hDetail1[1]?>
              </span></h2>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-1 wow fadeInLeft">
          <div class="box-4">
            <div class="text-center mb-3">
              <?php if(!empty($dbHome[0]['image2'])){?>
              <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image2']?>" width="55" height="55">
              <?php }?>
            </div>
            <h3 class="montserrat">
              <?=$dbHome[0]['h_title2']?>
            </h3>
            <?php $hDetail2 = explode(" ",$dbHome[0]['h_detail2'],2)?>
            <h2><span class="open-sans font-47">
              <?=$hDetail2[0]?>
              </span><span class="font-weight-normal">
              <?=$hDetail2[1]?>
              </span></h2>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-1 wow fadeInLeft">
          <div class="box-4">
            <div class="text-center mb-3">
              <?php if(!empty($dbHome[0]['image3'])){?>
              <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image3']?>" width="55" height="55">
              <?php }?>
            </div>
            <h3 class="montserrat">
              <?=$dbHome[0]['h_title3']?>
            </h3>
            <?php $hDetail3 = explode(" ",$dbHome[0]['h_detail3'],2)?>
            <h2><span class="open-sans font-47">
              <?=$hDetail3[0]?>
              </span><span class="font-italic font-weight-normal">
              <?=$hDetail3[1]?>
              </span></h2>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 mb-1 wow fadeInLeft">
          <div class="box-4">
            <div class="text-center mb-3">
              <?php if(!empty($dbHome[0]['image4'])){?>
              <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image4']?>" width="55" height="55">
              <?php }?>
            </div>
            <h3>
              <?=$dbHome[0]['h_title4']?>
            </h3>
            <?php $hDetail4 = explode(" ",$dbHome[0]['h_detail4'],3)?>
            <h2><span class="open-sans font-47">
              <?=$hDetail4[0] ?? ""?>
              </span><span class="font-italic font-weight-normal">
              <?=$hDetail4[1] ?? ""?>
              </span></h2>
            <h4 class="mt-2">
              <?=$hDetail4[2] ?? ""?>
            </h4>
          </div>
        </div>
        <div class="col-md-12 text-center wow fadeIn"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder2 btn mt-4"> Sell my Property <i class="flaticon-clipboard-with-pencil ml-2 font-18"></i></a> </div>
      </div>
    </div>
  </div>
  <div class="discover-how">
    <div class="container">
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInUp"> Discover how <span class="themecolor">Cleardeals services </span> has helped<br>
        home-sellers like you to sell property!</h2>
    </div>
    <div class="container-fluid pl-5 pr-5">
      <div class="row justify-content-center">
        <div class="col-lg col-md-4  text-center box-css5 wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/book-a-free.png" class="img-fluid">
          <h3 class="montserrat">Book a Free Online Valuation</h3>
          <p> You can book a free valuation with your Local Property Expert at a time and date to suit you. In your personalised valuation we'll share you comparable prices, and our thoughts on the best selling strategy.</p>
        </div>
        <div class="col-lg col-md-4 text-center box-css5 wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/pro-list.png" class="img-fluid">
          <h3 class="montserrat">Optimise your property listing</h3>
          <p>We'll prepare photos, description and then list your home on all the top property portals.</p>
        </div>
        <div class="col-lg col-md-4 text-center box-css5 wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/expert.png" class="img-fluid">
          <h3 class="montserrat">We leave viewings to experts</h3>
          <p>You! Because no-one knows your home better.</p>
        </div>
        <div class="col-lg col-md-4 text-center box-css5 wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/we-mamage.png" class="img-fluid">
          <h3 class="montserrat">We manage Your Buyers</h3>
          <p> Our Relationship managers from our back office handle any interest from buyers and helps you in negotiations and progress to sale.</p>
        </div>
        <div class="col-lg col-md-4 text-center box-css5 wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/getting-ypur.png" class="img-fluid">
          <h3 class="montserrat">Getting you over the finish line</h3>
          <p>Our support doesn't stop once you've accepted the offer. Our Post-Sales support team will guide you throughout the sale and  be on hand to assist with any questions.</p>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 text-center"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder2 btn mt-4 wow fadeIn">Sell my Property <i class="flaticon-clipboard-with-pencil ml-2 font-18"></i></a> </div>
    </div>
  </div>
  <div class="package">
    <div class="container">
      <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInDown">
        <?=$heading[0] ?? ""?>
        <span class="themecolor">
        <?=$heading[1] ?? ""?>
        </span> </h2>
      <div class="center-div2 row">
        <div class="col-md-6 wow fadeInLeft">
          <div class="package1 text-center">
            <h2><sup class="rs">₹</sup>
              <?=number_format($dbRentPackage[0]['cost'])?>
              <sup class="star">*</sup></h2>
            <span class="text-blue font-12 font-medium">Plus GST</span>
            <p>PER Property</p>
            <div class="validity">
              <h3 class="font-17 text-uppercase font-medium montserrat"><span> Validity:</span> 3 MONTHS
                <?php //$dbRentPackage[0]['validity']?>
              </h3>
              <h4 class="text-uppercase font-21 montserrat font-weight-bold"> Premium Package</h4>
              
              <a data-fancybox="packages-pop1" data-src="#packages-pop1" href="javascript:;" class="font-16 click-more text-uppercase font-900 montserrat">CLICK MORE <i class="fa fa-long-arrow-right font-16"></i></a>
              
              <br>
              <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" class="btn border-0 font-16 text-uppercase font-900 montserrat rent-my-property text-white">Rent my property <i class="flaticon-play-button"></i></a> </div>
          </div>
        </div>
        <?php 
		
		if($dbSellPackage[0]['onhome']=='plan1'){
			
			$planprice = number_format($dbSellPackage[0]['cost']);
			$planvaliduty = $dbSellPackage[0]['validity'];
			$plantext = $dbSellPackage[0]['plan1'];
			
		} else if($dbSellPackage[0]['onhome']=='plan2'){
			
			$planprice = number_format($dbSellPackage[0]['cost_premium']);
			$planvaliduty = $dbSellPackage[0]['validity_premium'];
			$plantext = $dbSellPackage[0]['plan2'];
			
		} else if($dbSellPackage[0]['onhome']=='plan3'){
			
			$planprice = number_format($dbSellPackage[0]['cost_split']);
			$planvaliduty = $dbSellPackage[0]['validity_split'];
			$plantext = $dbSellPackage[0]['plan3'];
			
		}
		
		?>
        <div class="col-md-6 wow fadeInRight">
          <div class="package2 text-center">
            <h2><sup class="rs">₹</sup>
              <?=$planprice?>
              <sup class="star">*</sup></h2>
            <span class="themecolor font-12 font-medium">Plus GST</span>
            <p>PER Property</p>
            <div class="validity2">
              <h3 class="font-17 text-uppercase font-medium montserrat"><span> Validity:</span> <?php echo $planvaliduty;?> </h3>
              <h4 class="text-uppercase font-21 montserrat font-weight-bold">
                <?=$plantext?>
              </h4>
              
              <a data-fancybox="packages-pop2" data-src="#packages-pop2" href="javascript:;" class="font-16 click-more2 text-uppercase font-900 montserrat">CLICK MORE <i class="fa fa-long-arrow-right font-16"></i></a>
              
              <br>
              <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="btn border-0 font-16 text-uppercase font-900 montserrat sell-my-property text-white">SELL my property <i class="flaticon-play-button"></i></a> </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="joining-with-us wow fadeIn"> Don't postpone your decision of joining with us. You've worked too hard to earn money don't waste them on Brokerages!</div>
  <div class="avoid">
    <div class="container">
      <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-5 themecolor wow fadeInUp"> Avoid </h2>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 text-center wow fadeInLeft">
          <div class="text-center"> <img src="<?=HTACCESS_URL?>assets/img/negative.jpg" class="img-fluid"> </div>
          <h3 class="font-17 montserrat">Negative consequences of dealing with an amateur real estate agent.</h3>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center wow fadeInLeft">
          <div class="text-center"> <img src="<?=HTACCESS_URL?>assets/img/losing.jpg" class="img-fluid"> </div>
          <h3 class="font-17 montserrat"> Losing your hard earned money on brokerage fees.</h3>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center wow fadeInRight">
          <div class="text-center"> <img src="<?=HTACCESS_URL?>assets/img/opportunity.jpg" class="img-fluid"> </div>
          <h3 class="font-17 montserrat">Opportunity costs for
            
            delayed selling of property. </h3>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center wow fadeInRight">
          <div class="text-center"> <img src="<?=HTACCESS_URL?>assets/img/advantage.jpg" class="img-fluid"> </div>
          <h3 class="font-17 montserrat">Feeling taken advantage of.</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="gateway wow fadeIn">
    <div class="container text-center"> Cleardeals is "Your Gateway to a Richer Life"</div>
  </div>
  <?php //include('partner-detail.php');?>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>


<!-- Your existing home.php content -->

<!-- Popup Modal -->
<div id="homepopupModal" class="home-popup-modal">
    <div class="home-popup-content">
        <!-- Close Button -->
        <span id="homecloseBtn" class="home-close-btn">&times;</span>
        <!-- Image inside the modal -->
        <img src="<?=HTACCESS_URL?>assets\img\gandhinagar.jpg" alt="Popup Image" class="home-popup-image">
    </div>
</div>

<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Your Custom Script -->
<script src="script.js"></script>

<script>
$(document).ready(function(){
  $(".div-close").click(function(){
    $("#sticky").hide();
  });
});



// script.js or inside a <script> tag in home.php

// $(document).ready(function() {
//     // Show the popup after the page loads (can add delay if needed)
//     $('#homepopupModal').fadeIn();

//     // Close the popup when the close button is clicked
//     $('#homecloseBtn').click(function() {
//         $('#homepopupModal').fadeOut();
//     });

//     // Close the popup when clicking outside the modal (on the background)
//     $(window).click(function(event) {
//         if ($(event.target).is('#homepopupModal')) {
//             $('#homepopupModal').fadeOut();
//         }
//     });
// });


$(document).ready(function() {
    $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0" });

    setTimeout(() => {
        $('#homepopupModal').css({ "visibility": "visible", "opacity": "1" });
    }, 2000);

    $('#homecloseBtn').click(function() {
        $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0" });
    });

    $(window).click(function(event) {
        if ($(event.target).is('#homepopupModal')) {
            $('#homepopupModal').css({ "visibility": "hidden", "opacity": "0" });
        }
    });
});



</script> 


 <style> 
#homepopupModal{
  /* display: none;
  position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);

    display: flex;
    justify-content: center;
    align-items: center; */

    visibility: hidden; 
    opacity: 0; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease-in-out; 
}

/* .home-popup-modal {
    display: none; 
   
} */

.home-popup-content {
    position: relative;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    text-align: center;
    width: 40%;
    height: 40%;
}


.home-close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    font-weight: bold;
    color: #000;
    cursor: pointer;
}


.home-popup-image {
  width: 80%;
  height: 100%;
}


</style> 

<!--rangeslider in home page-->
<!--<script src="<?=HTACCESS_URL?>assets/vendor/rangeslider/rangeslider2.js"></script>-->
<link href="<?=HTACCESS_URL?>assets/vendor/rangeslider/rangeslider.css" rel="stylesheet">
<!--<script src="<?=HTACCESS_URL?>assets/vendor/rangeslider/rangeslider.js"></script> 
<script src="<?=HTACCESS_URL?>assets/vendor/rangeslider/script.js"></script> -->

<!--rangeslider in home page-->
<script type="text/javascript">

var slider = document.getElementById("myRange");

var output = document.getElementById("demo");

var res = document.getElementById("demo1");

output.value = slider.value;

res.innerHTML = slider.value*1.5/100;



slider.oninput = function() {

  output.value = this.value;

  var res = slider.value*1.5/100;

  var resFinal = Math.ceil(res); 

  document.getElementById("demo1").innerHTML = resFinal;

}

output.oninput = function() {

  document.getElementById("myRange").value = this.value;

  var res = output.value*1.5/100;

  var resFinal = Math.ceil(res); 

  document.getElementById("demo1").innerHTML = resFinal;

}




$('#myRange').on('input',function () {
  //$('#slide-range').val($(this).val())
  var newVal = $(this).val();
  
  document.getElementById('demo').value = newVal;
  
  var res = slider.value*1.5/100;

  var resFinal = Math.ceil(res); 

  document.getElementById("demo1").innerHTML = resFinal;
  
});

$('#demo').on('input', function(){
  //console.log($(this).val())
  var newVal = $(this).val();
  
  document.getElementById('myRange').value = newVal;
  
  var res = slider.value*1.5/100;

  var resFinal = Math.ceil(res); 

  document.getElementById("demo1").innerHTML = resFinal;
  
});


$(document).ready(function() {
    new WOW().init();
});
</script>
<?php //if(isset($_SESSION['user']['is_login'])) {?>
<!--Start of Tawk.to Script--> 
<!--<script type="text/javascript" src="https://chatterpal.me/build/js/chatpal.js?7.33" crossorigin="anonymous" data-cfasync="false"></script> --> 
<!--<script>--> 
<!--var chatPal = new ChatPal({embedId: 'ujXUVEeUMm28', remoteBaseUrl: 'https://chatterpal.me/', version: '7.33'});--> 
<!--</script> --> 
<!--End of Tawk.to Script-->
<?php //}?>