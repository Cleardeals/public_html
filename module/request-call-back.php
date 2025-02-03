<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['call_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."home where id='1'";
$dbHome = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."review where home_status='1' and admin_del='0' order by display_order LIMIT 5";
$dbReview = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."faq where request_callback='1' order by display_order";
$dbFaq = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."request_callback_links";
$dbLinks = $dbObj->SelectQuery();  

$dbObj->dbQuery="select * from ".PREFIX."testimonial_video where status='1' order by display_order LIMIT 3"; 
$dbVideo = $dbObj->SelectQuery();
?>
<style>
#error1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
}
.contact-thank-you {
	padding: 30px;
	border: solid 10px #1e70ab;
}
div#no-brokrage-form {
	background: #034fae;
}
.hMcaqy {
	word-break: break-word;
}
.iAjmsx:first-child {
	padding: 0px;
	border-right: none;
	font-weight: 600;
}
.iAjmsx {
	font-size: 14px;
	letter-spacing: 0.75px;
	line-height: 34px;
	color: white;
	margin-bottom: 20px;
	padding: 0px 12px;/*border-right: 1px solid white;*/
}
a.sc-132u5v8-4.iAjmsx:hover {
	color: #dd0c13;
}
</style>
<div class="center-section-in" style="padding-bottom: 0px;min-height: 0px;">
  <div class="container">
    <div class="container wow fadeInUp">
      <p> </p>
      <h1 class="font-30 font-extrabold text-center mb-5 wow fadeInUp"> The <span class="themecolor">No Brokerage</span> Real Estate Agents</h1>
    </div>
  </div>
</div>
<div class="center-section-in" id="no-brokrage-form">
  <div class="container">
    <div class="careers" style="box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important; padding:20px 20px 50px 20px!important;background: white;">
      <div>
        <h2 class="font-20  mb-5 text-center "> Request a Call Back to Sell your Home at <span class="themecolor">No Brokerage</span> </h2>
        <?php if(!empty($msg)) { ?>
        <center>
          <p style="color:#F00">
            <?=$msg?>
          </p>
        </center>
        <?php } ?>
        <p id="error1"></p>
        <form action="<?=HTACCESS_URL?>contactController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
          <input type="hidden" name="mode" value="request_call_back">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control font-16 input-css" placeholder="Name" value="<?=$_SESSION['request']['name'] ?? ""?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control font-16 input-css" placeholder="Email" value="<?=$_SESSION['request']['email'] ?? ""?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="mobile_no" id="mobile_no" class="form-control font-16 input-css" placeholder="Mobile" value="<?=$_SESSION['request']['mobile_no'] ?? ""?>">
              </div>
            </div>
            <?php $lookingfor = $_SESSION['request']['lookingfor'] ?? "";?>
            <div class="col-md-6">
              <div class="form-group">
                <select name="lookingfor" id="lookingfor" class="form-control font-16 input-css">
                  <option value="Sell Property" <?=($lookingfor=='Sell Property')?'selected':''?>>Looking to Sell Property</option>
                  <option value="Buy Property" <?=($lookingfor=='Buy Property')?'selected':''?>>Looking to Buy Property</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea class="form-control font-16 input-css" name="message" id="message" rows="5" placeholder="Your message"><?=$_SESSION['request']['message'] ?? ""?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <center>
                  <!--for local--> 
                  <!--<div class="g-recaptcha" data-sitekey="6LdHmlAUAAAAACf9TScqhLLm7m_o_4GazkdxNajG"></div>--> 
                  <!--for cleardeals-->
                  <div class="g-recaptcha" data-sitekey="6LdQg54UAAAAAEE_4Q6mf146BcexC3MJd8RBLLxm"></div>
                  <!-- <div class="g-recaptcha" data-sitekey="6LdQ5fccAAAAANQW0QfOLiOdowoTEBY5p8nb3y8l"></div> --> <!-- VR4C V2 -->
                </center>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="submit" class="btn btn-primary subscribe-now  submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT">
              </div>
            </div>
          </div>
        </form>
        <a data-fancybox="thank-you-popup" data-src="#thank-you-popup" href="javascript:;"></a>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="center-section-in" style="padding-bottom: 0px;min-height: 0px;">
  <div class="container">
    <div class="container wow fadeInUp">
      <h2 class="font-16 text-center mb-5 wow fadeInUp">Sell your Home through No Brokerage Real Estate Agents in Ahmedabad, Gandhinagar, Vadodara, and Surat</h2>
    </div>
  </div>
</div>
<div class="benefits">
  <div class="container">
    <h2 class="font-24  text-center font-extrabold header-border wow fadeInUp"> Benefits of using <span class="themecolor">No Brokerage</span> - Real Estate Agent services of Cleardeals </h2>
  </div>
  <div class="container-fluid pl-5 pr-5">
    <div class="row justify-content-center">
      <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/discount.svg" width="60" height="60" alt="achive the best price while selling your property throuth no broker real estate agents ahmedabad" loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
        <h3>Achieve the best price</h3>
        <p> Our expert real estate agents near you guide you through marketing your property at the right price and achieving up to 98% of your asking price. </p>
      </div>
      <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/teamwork.svg" width="60" height="60"  alt="gets buyers for your property and sell your property fast throgh no broker real estate agents ahmedabad" loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
        <h3>1000’s of Home Buyers</h3>
        <p> The blend of our “Online Marketing strategy” and “No Broker” real estate agent services helps you get thousands of home buyers interested in your property. </p>
      </div>
      <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/customer-service.svg" width="60" height="60"  alt="best real estate agents who help you to sell your home quickly at no brokrage " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
        <h3> 24 x 7 at your help</h3>
        <p> Our strong team of Real estate brokers near you take care of your property inquiries and send only the filtered home buyers saving a lot of your time and efforts. </p>
      </div>
      <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/house.svg" width="60" height="60"  alt="sell your home quickly through no brokrage real estate agents in ahmedabad" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
        <h3>Sell your home quickly</h3>
        <p>Our average home selling period is 45* days. By providing “No Brokerage” Real Estate agent services to Home Sellers and Buyers we can help you to sell your home quickly in cities like Ahmedabad, Gandhinagar, Vadodara, and Surat.</p>
      </div>
      <div class="col-lg col-md-4 col-sm-6 text-center box-css wow fadeInLeft"> <img src="<?=HTACCESS_URL?>assets/img/like.svg" width="60" height="60"  alt="Home lone services in ahmedabad " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
        <h3> We do it all</h3>
        <p> Our team of real estate brokers near you provides related services like Home Loans, Legal Services, Movers, and packers to reduce the deal fall-off.</p>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="text-center wow fadeInUp"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder3 btn font-extrabold font-20" ><span>Sell my </span> property</a></div>
  </div>
</div>
<div class="" style="padding: 65px 0 70px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>
          <?php $hTitle = explode(" ",$dbHome[0]['h_title'],2)?>
        </h3>
        <p class="font-24   text-center header-border mb-4 wow fadeInUp">
          <?=$hTitle[0]?>
          <?=$hTitle[1]?>
        </p>
        <p class="text-center mb-40">
          <?=$dbHome[0]['h_subtitle']?>
        </p>
      </div>
      <div class="col-lg-3 col-md-6  col-sm-6  mb-1 wow fadeInLeft">
        <div class="box-4">
          <div class="text-center mb-3">
            <?php if(!empty($dbHome[0]['image1'])){?>
            <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image1']?>" width="55" height="55" alt="<?=$dbHome[0]['h_title1']?>" loading="lazy" alt="sell your property quickly through cleardeals at no brokrage" alt="Home lone services in ahmedabad " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
            <?php }?>
          </div>
          <h3 class="montserrat">
            <?=$dbHome[0]['h_title1']?>
          </h3>
          <?php $hDetail1 = explode(" ",$dbHome[0]['h_detail1'],2)?>
          <p style="color: #1c88a1;"><span class="open-sans font-47">
            <?=$hDetail1[0]?>
            </span><span class="font-italic font-weight-normal">
            <?=$hDetail1[1]?>
            </span> </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mb-1 wow fadeInLeft">
        <div class="box-4">
          <div class="text-center mb-3">
            <?php if(!empty($dbHome[0]['image2'])){?>
            <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image2']?>" width="55" height="55" alt="<?=$dbHome[0]['h_title2']?>" loading="lazy" alt="the best real estate agents in ahmedabad with 2600+ customers" alt="Home lone services in ahmedabad " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
            <?php }?>
          </div>
          <h3 class="montserrat">
            <?=$dbHome[0]['h_title2']?>
          </h3>
          <?php $hDetail2 = explode(" ",$dbHome[0]['h_detail2'],2)?>
          <p style="color: #1c88a1;"><span class="open-sans font-47">
            <?=$hDetail2[0]?>
            </span><span class="font-weight-normal">
            <?=$hDetail2[1]?>
            </span> </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 mb-1 wow fadeInLeft">
        <div class="box-4">
          <div class="text-center mb-3">
            <?php if(!empty($dbHome[0]['image3'])){?>
            <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image3']?>" width="55" height="55" alt="<?=$dbHome[0]['h_title3']?>" loading="lazy" alt="the best real estate agents in ahmedabad who has sold maximum home in ahmedabad" alt="Home lone services in ahmedabad " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
            <?php }?>
          </div>
          <h3 class="montserrat">
            <?=$dbHome[0]['h_title3']?>
          </h3>
          <?php $hDetail3 = explode(" ",$dbHome[0]['h_detail3'],2)?>
          <p style="color: #1c88a1;"><span class="open-sans font-47">
            <?=$hDetail3[0] ?? ""?>
            </span><span class="font-italic font-weight-normal">
            <?=$hDetail3[1] ?? ""?>
            </span> </p>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6 mb-1 wow fadeInLeft">
        <div class="box-4">
          <div class="text-center mb-3">
            <?php if(!empty($dbHome[0]['image4'])){?>
            <img src="<?=HTACCESS_URL?>cms_images/pages/original/<?=$dbHome[0]['image4']?>" width="55" height="55" alt="<?=$dbHome[0]['h_title4']?>" loading="lazy" alt="NO Brokrage realtor ahmedabad saved millions of rupees in brokerage " alt="Home lone services in ahmedabad " loading="lazy" title="Sell your property at No Brokerage in Ahmedabad, Gandhinagar, Vadodara and Surat.">
            <?php }?>
          </div>
          <h3>
            <?=$dbHome[0]['h_title4']?>
          </h3>
          <?php $hDetail4 = explode(" ",$dbHome[0]['h_detail4'],3)?>
          <p style="color: #1c88a1;"><span class="open-sans font-47">
            <?=$hDetail4[0] ?? ""?>
            </span><span class="font-italic font-weight-normal">
            <?=$hDetail4[1] ?? ""?>
            </span> </p>
          <h4 class="mt-2">
            <?=$hDetail4[2] ?? ""?>
          </h4>
        </div>
      </div>
      <!--<div class="col-md-12 text-center wow fadeIn"> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="theme-btn-boder2 btn mt-4"> Sell my Property <i class="flaticon-clipboard-with-pencil ml-2 font-18"></i></a> </div>--> 
    </div>
  </div>
</div>
<div class="testimonial">
  <div class="container wow fadeIn">
    <div class="text-center mb-40"> 
      <!--  <img src="<?=HTACCESS_URL?>assets/img/logo.png" class="img-fluid"> -->
      <h4 class="font-30">Cleardeals Reviews</h4>
    </div>
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
    <div class="text-center"> <a href="<?=HTACCESS_URL?>review-us-form/" class="btn themebg text-white theme-btn mb-3 mt-4 font-14"> REVIEW US <i class="fa fa-long-arrow-right font-16"></i></a> </div>
  </div>
</div>
<div class="three-color">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h5 class="font-24 text-uppercase text-center font-extrabold header-border mb-4 wow fadeInUp"> Cleardeals Video Testimonials </h5>
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
        <div class="center-section-in" style="min-height:auto;">
          <h5 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">Sell Property FAQ's <span class="themecolor"></span> </h5>
          <div id="accordion">
            <?php for($i=0;$i<count((array)$dbFaq);$i++){?>
            <?php if($i==0){?>
            <button class="ff_faq_header btn btn-link montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="true" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
            <h6>
              <?=$dbFaq[$i]['question']?>
            </h6>
            </button>
            <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse show" data-parent="#accordion">
              <div class="ff_faq_item" style="text-align: left;">
                <?=$dbFaq[$i]['answer']?>
              </div>
            </div>
            <?php }else{?>
            <button class="ff_faq_header btn btn-link collapsed montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="false" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
            <h6>
              <?=$dbFaq[$i]['question']?>
            </h6>
            </button>
            <div id="ff_item_<?=$dbFaq[$i]['id']?>" class="collapse montserrat" data-parent="#accordion">
              <div class="ff_faq_item" style="text-align: left;">
                <?=$dbFaq[$i]['answer']?>
              </div>
            </div>
            <?php }}?>
          </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container" style="background: #044db7;padding: 25px;">
    <div class="sc-132u5v8-3 hMcaqy"> <a href="javascript::void(0);" class="sc-132u5v8-4 iAjmsx"><b>Calculators:</b></a> <br>
      <?php
         foreach ($dbLinks as $key => $value) {
            if($value['is_calculator'] == 1){
      ?>
      <a href="<?php print_r($value['link']); ?>" target="_blank" class="sc-132u5v8-4 iAjmsx"><? print_r($value['name']);?></a> <br>
      <?php
            }
      }
      ?>
    </div>
    <br>
    <br>
    <div class="sc-132u5v8-3 hMcaqy"> <a href="javascript::void(0);" class="sc-132u5v8-4 iAjmsx"><b>Other Links:</b></a> <br>
      <?php
         foreach ($dbLinks as $calculator_key => $calculator_value) { 
            if($calculator_value['is_calculator'] == 0){
      ?>
      <a href="<?php print_r($calculator_value['link']); ?>" target="_blank" class="sc-132u5v8-4 iAjmsx"><? print_r($calculator_value['name']);?></a> <br>
      <?php
            }
         
      }
      ?>
      <br>
    </div>
  </div>
</div>
<br>
<div class="clearfix"></div>
<?php unset($_SESSION['call_msg']);?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
   function controlBorderColor() {
   
     //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
   
    // else { 
   
     this.style.borderColor = "#ced4da"; 
   
     //}
   
   }
   
   
   
   function chkform() {
   
   
   
    if(isEmpty("Name",document.getElementById("name").value)) {
   
      document.getElementById("name").focus();
   
      document.getElementById("error1").innerHTML=(" Please Enter Name* ");
   
      document.getElementById('name').style.borderColor  = '#FF0000';
   
      document.getElementById("name").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("name").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
    if(isEmpty("Looging to Sell/Buy Property",document.getElementById("lookingfor").value)) {
   
      document.getElementById("lookingfor").focus();
   
      document.getElementById("error1").innerHTML=(" Please select option to Sell/But property* ");
   
      document.getElementById('lookingfor').style.borderColor  = '#FF0000';
   
      document.getElementById("lookingfor").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("lookingfor").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
   
   
    if(isEmpty("Email",document.getElementById("email").value)) {
   
      document.getElementById("email").focus();
   
      document.getElementById("error1").innerHTML=(" Please Enter Email* ");
   
      document.getElementById('email').style.borderColor  = '#FF0000';
   
      document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
   
   
    if(!validateEmail("Email",document.getElementById("email").value)) {
   
      document.getElementById("email").focus();
   
      document.getElementById("error1").innerHTML=(" Invalid Email ");
   
      document.getElementById('email').style.borderColor  = '#FF0000';
   
      document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
   
   
    if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
   
      document.getElementById("mobile_no").focus();
   
      document.getElementById("error1").innerHTML=(" Please Enter Mobile No.* ");
   
      document.getElementById('mobile_no').style.borderColor  = '#FF0000';
   
      document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
   
   
    if(document.getElementById("mobile_no").value!=''){ 
   
        var phoneno = /^\d{10}$/; 
   
        var i;
   
        var inputtxt = document.getElementById("mobile_no").value;  
   
        if(document.getElementById("mobile_no").value.match(phoneno)) {  
   
          i = 1;
   
        } else {
   
          i = 2;  
   
        }
   
   
   
        if(i==2){
   
   
   
          document.getElementById('mobile_no').style.borderColor  = '#FF0000';
   
          document.getElementById("mobile_no").addEventListener("keydown", controlBorderColor, false);
   
          document.getElementById("mobile_no").addEventListener("keyup", controlBorderColor, false);
   
          document.getElementById("error1").innerHTML=('Please enter only 10 digits mobile number.');
   
          document.getElementById("mobile_no").value='';
   
          document.getElementById("mobile_no").focus();
   
          return false;    
   
        }
   
    }
   
   
   
    if(isEmpty("Message",document.getElementById("message").value)) {
   
      document.getElementById("message").focus();
   
      document.getElementById("error1").innerHTML=(" Please Enter Message* ");
   
      document.getElementById('message').style.borderColor  = '#FF0000';
   
      document.getElementById("message").addEventListener("keydown", controlBorderColor, false);
   
      document.getElementById("message").addEventListener("keyup", controlBorderColor, false);
   
      return false;
   
    }
   
    return true;
   
   }
   
   
   
   
   
   function submit_host(){
   
    if(chkform() == true){
   
      document.getElementById("accForm").submit();
   
    }
   
   }
   
</script>
<input type='hidden' id="is_home" value="1">
<!--contact-us-popup-->
<div id="thank-you-popup" style="display:none;width:100%;max-width:660px;" class="contact-thank-you">
  <div class="right-section form-sec">
    <div>
      <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
      <p class="text-center mb-0">Thank You For Request Call Back.</p>
      <p class="text-center font">We will get back to you soon.</p>
      <hr>
      <!--<h4 class="text-center">You can instant contact using details</h4>--> 
      <!--<div class="contact-text">
            <div class="text-center"><i class="fa fa-mobile-alt" aria-hidden="true"> </i>&nbsp; +1 23 567 8596 
            
              &nbsp;&nbsp; <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@example.com">info@example.com</a> </div>
            
            </div>--> 
    </div>
  </div>
</div>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>