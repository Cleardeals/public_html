<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$from = $dbObj->sc_mysql_escape($_REQUEST['from'] ?? "");
$msg = base64_decode($_SESSION['location_error_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."city where status='1'";
$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."location";
$dbLocation = $dbObj->SelectQuery();

$cityName = $dbObj->sc_mysql_escape($_REQUEST['cityName'] ?? ""); 
if(!empty($cityName)){
  $dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityName."'";
  $dbLocation = $dbObj->SelectQuery(); 
  
  for($i=0;$i<count($dbLocation);$i++){
       $data.='"'.$dbLocation[$i]['location'].'",';
  }
  $newdata = substr($data, 0, -1);
  $newdata;
}

$dbObj->dbQuery="select * from ".PREFIX."valuation_comment where status='1'";
$dbComment = $dbObj->SelectQuery();
$comment = count((array)$dbComment);

$dbObj->dbQuery="select * from ".PREFIX."book_free_valuation_content where id='1'";
$dbBlogDetail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."location where city='Ahmedabad' ORDER BY location";
$ahmedabad = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."location where city='Gandhinagar' ORDER BY location";
$Gandhinagar = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."location where city='Vadodara' ORDER BY location";
$Vadodara = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."location where city='Surat' ORDER BY location";
$Surat = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."land where city='Ahmedabad' ORDER BY land";
$AhmedabadLand = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."faq where valuation_status='1' order by display_order";
$dbFaq = $dbObj->SelectQuery();
?>
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/style.css" rel="stylesheet">
<link href="<?=HTACCESS_URL?>assets/epropvalue/css/responsive.css" rel="stylesheet">
<style>
#logo {
	margin-top: 60px;
	width: 280px;
	height: 68px;
}
#other-page-heaer-logo {
	display: flow-root;
}
 @media (max-width:768px) {
#logo {
	width: 215px;
}
}
.themecolor {
	font-size: 20px;
}
.center-section-in {
	min-height: 0px!important;
}
form#accForm {
	margin-bottom: 13px;
}
.select-property {
	margin-top: 20px;
}
</style>
<style>
.vl {
	border-left: 6px solid #e00813;
	height: 83px;
	float: right;
}
</style>
<style>
table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width: 100%;
}
td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}
tr:nth-child(even) {
	background-color: #dddddd;
}
</style>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu" id="mainNav">
  <div class="container-fluid" id="other-page-heaer-logo">
    <div class="row">
      <div class="container"> <a href="<?=HTACCESS_URL?>">
        <center>
          <img src="<?=HTACCESS_URL?>assets/img/logo.webp" id="logo"  widh="280" height="68">
        </center>
        </a> </div>
    </div>
  </div>
</nav>
<!-- Header -->
<style type="text/css">
  pre {
  white-space: pre-wrap;
  word-wrap: break-word;
  text-align: justify;
}
</style>
<div class="center-section-in" style="padding:0;">
  <header class="masthead2">
    <div class="container text-center">
      <h1 class="mb-1 blue-text montserrat"><b>Property Valuation Calculator 2023</b></h1>
      <h2 class="themecolor">Calculate your House Valuation Online with the help of Property Valuation Calculator 2023 </h2>
      <br>
      <span style="color:#FF0000;" id="messageemail"></span>
      <form method="post" action="<?=HTACCESS_URL?>valuationController.php" id="accForm" onsubmit="return chklocation();">
        <input type="hidden" name="mode" value="step_1">
        <input type="hidden" name="id" value="">
        <div class="clearfix"></div>
        <div class="search-div">
          <div class="input-group">
            <select class="form-control bg-transparent border-0 rounded-0" name="info[city]" id="city" onchange="getcity(this.value)">
              <option value="">Select City</option>
              <?php for($i=0;$i<count((array)$dbCity);$i++){ ?>
              <option value="<?=$dbCity[$i]['city_name']?>" <?=($cityName==$dbCity[$i]['city_name'])?'selected':''?>>
              <?=$dbCity[$i]['city_name']?>
              </option>
              <?php }?>
            </select>
          </div>
        </div>
        <?php if(!empty($cityName)){?>
        <div class="search-div" id="show">
          <div class="input-group">
            <div class="ui-widget">
              <input id="tags" placeholder="Type location area of your property" class="bg-transparent border-0 rounded-0 ui-autocomplete-input" name="info[location]" onkeypress="myFunction()" value="<?=$_SESSION['prop']['location'] ?? ""?>" onclick="showflat();" required="" autocomplete="off">
            </div>
          </div>
        </div>
        <?php }?>
        <div id="showMe" style="display:none;">
          <div class="select-property">
            <p style="font-size: 20px;"><b>Select Property Type</b></p>
          </div>
          <?php $property_type = $_SESSION['prop']['property_type'] ?? "";?>
          <div class="search-div2 flat-div">
            <div id="ck-button">
              <label class="btn rounded-0">
              <input type="checkbox" name="info[property_type]" value="1" onclick="javascript:ShowHideDiv(this.value,this.checked)" <?=($property_type==1)?'checked':''?>>
              <div id="ck-in-btn"><img src="<?=HTACCESS_URL?>assets/img/flat.png">Flat </div>
              </label>
            </div>
            <div id="ck-button" class="border-0">
              <label class="btn rounded-0">
                <input type="checkbox" name="info[property_type]" value="2" data-fancybox="" data-src="#popup1" href="javascript:;" <?=($property_type==2)?'checked':''?>>
                <img src="<?=HTACCESS_URL?>assets/img/house.png"> Home/Villa/Bunglow </label>
            </div>
          </div>
        </div>
        <div id="div-show" style="display:none;">
          <div class="select-property">
            <p style="font-size: 20px;"><b>Superbuilt up Area of Property</b></p>
          </div>
          <div class="search-div">
            <div class="row m-0">
              <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="input-group boder1">
                  <input type="text" name="info[area]" value="<?=$_SESSION['prop']['area'] ?? ""?>" class="form-control bg-transparent border-right rounded-0" placeholder="Enter SuperBuiltup Area" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="">
                </div>
                <!-- <div class="col-lg-12 p-0"><span style="color:rgb(217, 0, 25);font-weight:bold; text-align:left; display:block; margin-bottom:10px; margin-top:10px"> &nbsp; Ex:100</span> </div> --> 
              </div>
              <?php $sqf = $_SESSION['prop']['sqf'] ?? "";?>
              <div class="col-lg-6 col-md-6 col-sm-6 p-0 boder2" id="demo" style="height:66px">
                <select class="form-control bg-transparent border-0" name="info[sqf]" id="mySelect" onchange="ChangeColor();" required="">
                  <option value="">Select</option>
                  <option value="1" <?=($sqf==1)?'selected':''?>>Sq.Feet </option>
                  <option value="2" <?=($sqf==2)?'selected':''?>>Sq.Yard </option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" name="wizard-submit" class="btn check-now">Check NOW <img src="<?=HTACCESS_URL?>assets/img/check.png"></button>
        </div>
      </form>
    </div>
  </header>
  <div class="clearfix"></div>
</div>
<div class="col-lg-8 blog-post-text wow fadeIn"> </div>
<div class="center-section-in">
  <div class="container">
    <?=html_entity_decode(stripslashes($dbBlogDetail[0]['content']))?>
  </div>
</div>
<div class="center-section-in">
  <div class="container">
    <h3 class="text-uppercase text-center mb-3">Property Rates in Ahmedabad, Gujarat</h3>
    <h4 class="text-uppercase text-center mb-5">Latest Property Price for Flats and Apartments in Ahmedabad.</h4>
    <table>
      <tr>
        <th>Sr. No</th>
        <th>Area</th>
        <th>Price (Min.) Rs./sq.ft</th>
        <th>Price (Max.) Rs./sq.ft</th>
      </tr>
      <?php
  foreach ($ahmedabad as $key => $value) {
  if($key > 3){
    ?>
      <tr class="blogBox moreBox" style="display: none;">
        <?php
  }else{
  ?>
      <tr class="blogBox moreBox">
        <?php
  } 
  ?>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $value['location']; ?></td>
        <td><?php echo $value['price_min_sq']; ?></td>
        <td><?php echo $value['price_max_sq']; ?></td>
      </tr>
      <?php
   } 
  ?>
    </table>
    <div id="loadMoreAhmedabad" style=""> <a href="#" style="color: #de0c15"><b>Show More..</b></a> </div>
    <div class="clearfix"></div>
  </div>
  <br>
  <br>
  <div class="container">
    <h3 class="text-uppercase text-center mb-3">Property Rates in Gandhinagar, Gujarat</h3>
    <h4 class="text-uppercase text-center mb-5">Latest Property Price for Flats and Apartments in Gandhinagar.</h4>
    <table>
      <tr>
        <th>Sr. No</th>
        <th>Area</th>
        <th>Price (Min.) Rs./sq.ft</th>
        <th>Price (Max.) Rs./sq.ft</th>
      </tr>
      <?php
  foreach ($Gandhinagar as $key => $value) {
  if($key > 3){
    ?>
      <tr class="blogBoxGandhinagar moreBoxGandhinagar" style="display: none;">
        <?php
  }else{
  ?>
      <tr class="blogBoxGandhinagar moreBoxGandhinagar">
        <?php
  } 
  ?>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $value['location']; ?></td>
        <td><?php echo $value['price_min_sq']; ?></td>
        <td><?php echo $value['price_max_sq']; ?></td>
      </tr>
      <?php
   } 
  ?>
    </table>
    <div id="loadMoreGandhinagar" style=""> <a href="#" style="color: #de0c15"><b>Show More..</b></a> </div>
    <div class="clearfix"></div>
  </div>
  <br>
  <br>
  <div class="container">
    <h3 class="text-uppercase text-center mb-3">Property Rates in Vadodara, Gujarat</h3>
    <h4 class="text-uppercase text-center mb-5">Latest Property Price for Flats and Apartments in Vadodara.</h4>
    <table>
      <tr>
        <th>Sr. No</th>
        <th>Area</th>
        <th>Price (Min.) Rs./sq.ft</th>
        <th>Price (Max.) Rs./sq.ft</th>
      </tr>
      <?php
  foreach ($Vadodara as $key => $value) {
  if($key > 3){
    ?>
      <tr class="blogBoxvadodara moreBoxvadodara" style="display: none;">
        <?php
  }else{
  ?>
      <tr class="blogBoxvadodara moreBoxvadodara">
        <?php
  } 
  ?>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $value['location']; ?></td>
        <td><?php echo $value['price_min_sq']; ?></td>
        <td><?php echo $value['price_max_sq']; ?></td>
      </tr>
      <?php
   } 
  ?>
    </table>
    <div id="loadMorevadodara" style=""> <a href="#" style="color: #de0c15"><b>Show More..</b></a> </div>
    <div class="clearfix"></div>
  </div>
  <br>
  <br>
  <div class="container">
    <h3 class="text-uppercase text-center mb-3">Property Rates in Surat, Gujarat</h3>
    <h4 class="text-uppercase text-center mb-5">Latest Property Price for Flats and Apartments in Surat.</h4>
    <table>
      <tr>
        <th>Sr. No</th>
        <th>Area</th>
        <th>Price (Min.) Rs./sq.ft</th>
        <th>Price (Max.) Rs./sq.ft</th>
      </tr>
      <?php
  foreach ($Surat as $key => $value) {
  if($key > 3){
    ?>
      <tr class="blogBoxSurat moreBoxSurat" style="display: none;">
        <?php
  }else{
  ?>
      <tr class="blogBoxSurat moreBoxSurat">
        <?php
  } 
  ?>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $value['location']; ?></td>
        <td><?php echo $value['price_min_sq']; ?></td>
        <td><?php echo $value['price_max_sq']; ?></td>
      </tr>
      <?php
   } 
  ?>
    </table>
    <div id="loadMoreSurat" style=""> <a href="#" style="color: #de0c15"><b>Show More..</b></a> </div>
    <div class="clearfix"></div>
  </div>
  <br>
  <br>
  <div class="container">
    <h4 class="text-uppercase text-center mb-5">Land Rates in Ahmedabad, Gujarat.</h4>
    <table>
      <tr>
        <th>Sr. No</th>
        <th>Area Name</th>
        <th>Land Prices (Rs per sq.yard)</th>
      </tr>
      <?php
  foreach ($AhmedabadLand as $key => $value) {
  if($key > 3){
    ?>
      <tr class="blogBoxLandRates moreBoxLandRates" style="display: none;">
        <?php
  }else{
  ?>
      <tr class="blogBoxLandRates moreBoxLandRates">
        <?php
  } 
  ?>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $value['land']; ?></td>
        <td><?php echo $value['price_min_sq_yrd']; ?></td>
      </tr>
      <?php
   } 
  ?>
    </table>
    <div id="loadMoreLandRates" style=""> <a href="#" style="color: #de0c15"><b>Show More..</b></a> </div>
    <div class="clearfix"></div>
  </div>
</div>
</div>
<br>
<div class="center-section-in">
  <div class="container">
    <h5 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">FAQ’s <span class="themecolor"></span> </h5>
    <div id="accordion">
      <?php for($i=0;$i<count((array)$dbFaq);$i++){?>
      <?php if($i==0){?>
      <button class="ff_faq_header btn btn-link montserrat" data-toggle="collapse" data-target="#ff_item_<?=$dbFaq[$i]['id']?>" aria-expanded="true" aria-controls="ff_item_<?=$dbFaq[$i]['id']?>">
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
  <div class="clearfix"></div>
</div>
<h5 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">Speak Your Mind <span class="themecolor"></span> </h5>
<!-- Wrapper container -->
<div class="container py-4"> 
  <!-- Bootstrap 5 starter form --> 
  <!-- <form id="contactForm" data-sb-form-api-token="API_TOKEN">
    <div class="row">
      <div class="col-sm-6">
        <div class="mb-3"> 
          <input class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" /> 
        </div>
      </div>
      <div class="col-sm-6">
        <div class="mb-3"> 
          <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required, email" /> 
        </div>
      </div>
    </div> 
    <div class="mb-6"> 
      <textarea class="form-control" id="message" type="text" placeholder="Write Comment" style="height: 10rem;" data-sb-validations="required"></textarea>
      <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
    </div> 
    <br> 
    <div class="d-grid">
      <button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Post Comment</button>
    </div>

  </form> -->
  <div class="comment">
    <div class="comment-css">
      <h4 class="font-17 font-weight-bold text-uppercase mb-5">
        <?=$comment?>
        comment</h4>
      <?php for($i=0;$i<$comment;$i++){?>
      <div class="row">
        <div class="col-md-2 text-center"><img src="<?=HTACCESS_URL?>assets/img/blog/user.jpg" class="img-circle img-fluid"></div>
        <div class="col-md-10 pl-0">
          <h3 class="font-18 font-weight-bold">
            <?=$dbComment[$i]['name']?>
          </h3>
          <?php $commentDate = explode(' ',$dbComment[$i]['comment_date']);?>
          <h5 class="font-12 text-gray font-weight-bold">
            <?=date('j M Y',strtotime($commentDate[0]))?>
          </h5>
          <p class="m-0">
            <?=$dbComment[$i]['comment']?>
          </p>
        </div>
      </div>
      <div class="col-md-12 p-0 mt-5 mb-5"> </div>
      <?php  if($dbComment[$i]['admin_comment'] != null){ ?>
      <div class="row">
        <div class="col-md-1 text-center">
          <div class="vl"></div>
        </div>
        <div class="col-md-2 text-center"><img src="<?=HTACCESS_URL?>assets/img/blog/user.jpg" class="img-circle img-fluid"></div>
        <div class="col-md-9 pl-0">
          <h3 class="font-18 font-weight-bold"> Cleardeals </h3>
          <p class="m-0">
            <?=$dbComment[$i]['admin_comment']?>
          </p>
        </div>
      </div>
      <div class="col-md-12 p-0 mt-5 mb-5">
        <hr>
      </div>
      <?php  } ?>
      <?php }?>
      <div class="comment">
        <h4 class="font-16 text-uppercase">Leave a COMMENT</h4>
        <p id="error1"></p>
        <form action="<?=HTACCESS_URL?>commentController.php" method="post" id="comment_form" onSubmit="return chkformforcomment();" autocomplete="off">
          <input type="hidden" name="mode" value="valuation_comment">
          <div class="row">
            <div class="col-md-6">
              <input class="form-control font-13" id="name" name="name" placeholder="Name" value="<?=$dbUser[0]['name'] ?? ""?>">
            </div>
            <div class="col-md-6">
              <input class="form-control font-13" id="email" name="email" placeholder="Email" value="<?=$dbUser[0]['email'] ?? ""?>">
            </div>
          </div>
          <div class="mt-3">
            <textarea class="form-control font-13" id="comment" name="comment" placeholder="Comments" rows="3"></textarea>
          </div>
          <button type="submit" class="subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">POST REPLY </button>
        </form>
        <!--<div class="new-user">
              <h4 class="font-16 text-uppercase font-extrabold mb-3">NEW USER?</h4>
              <a data-fancybox="hello" data-src="#blog-1" href="javascript:;" class="subscribe-now  font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 blue-bt2">
              SIGNUP TO REPLY FOR THE POST</a> </div>--> 
      </div>
    </div>
  </div>
</div>

<!-- SB Forms JS --> 
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<div style="display:none; width:1063px;" id="popup1" class="fancybox-content">
  <div class="popup-2">
    <p class="text-center text-dark"> The value of your <span> Home/Villa/Bunglow </span> is not possible<br>
      without inspecting your property.</p>
    <p class="text-dark text-center">Please book a free personal valuation appointment with our representative.</p>
    <center>
      <p style="color:#FF0000;" id="msg1">
        <?=base64_decode($_SESSION['msg1'] ?? "")?>
        <?php unset($_SESSION['msg1'])?>
      </p>
      <p style="color:#FF0000;" id="error1"></p>
    </center>
  </div>
  <form action="/" method="post" id="accForms" autocomplete="off">
    <!-- <input type="hidden" name="mode" value="add_appointment">
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="from" value="<?=$from?>">-->
    <div class="row search-div4">
      <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
        <input class="form-control" name="name" id="name" placeholder="Name" type="text">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
        <input class="form-control" name="email" id="email" placeholder="Email" type="text">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
        <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <select class="form-control" name="purpose_of_valuation" id="purpose_of_valuation">
          <option value="">Purpose of Valuation </option>
          <option value="Looking to sell property">Looking to sell property</option>
          <option value="Only to check the value of my property">Only to check the value of my property</option>
        </select>
      </div>
    </div>
    <div class="row search-div4">
      <div class="col-lg-2 col-md-2 col-sm-2 mb-2"></div>
      <div class="col-lg-8 col-md-8 col-sm-8 mb-2">
        <div class="datetimepicker3">
          <p>Just let us know a time that suits you!</p>
          <input type="text" name="app_date" id="datetimepicker3"/>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 mb-2"></div>
    </div>
    <div class="row search-div4">
      <div class="col-lg-3 col-md-3 col-sm-3 mb-2"></div>
      <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
        <div class="inputBox bordered text-center"> <img src="<?=HTACCESS_URL?>php_captcha.php" style="height:50px;width:70%;"/> </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
        <input class="form-control" name="number" id="captcha" type="text" placeholder="Captcha">
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 mb-2"></div>
    </div>
    <div class="text-center">
      <button type="button" onClick="return chkcapcha()" class="btn btn-submit">Submit Now</button>
    </div>
  </form>
</div>
<?php
$id = $_REQUEST['id'] ?? "";
$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';
$pageurl = $_REQUEST['url'] ?? "";

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."contact_detail where id='1'";
$dbContact = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."social_links";
$dbSocial = $dbObj->SelectQuery();
?>
<!-- Footer -->
<style>
.bring {
  max-height:inherit!important;
  visibility:visible!important
}
</style>
<div class="footer" style="background-color:#e9ecf0;color:#1c304e;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 text1">
        <div class="logo"><img src="<?=HTACCESS_URL?>assets/img/logo.webp" width="250"></div>
        <?=html_entity_decode(stripslashes($dbContact[0]['content']))?>
        <div class="social-media">
          <?php if($dbSocial[0]['status']=='1') {?>
          <a href="<?=$dbSocial[0]['link']?>" target="<?=$dbSocial[0]['target']?>"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[1]['status']=='1') {?>
          <a href="<?=$dbSocial[1]['link']?>" target="<?=$dbSocial[1]['target']?>"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[2]['status']=='1') {?>
          <a href="<?=$dbSocial[2]['link']?>" target="<?=$dbSocial[2]['target']?>"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
          <?php }?>
          <?php if($dbSocial[3]['status']=='1') {?>
          <a href="<?=$dbSocial[3]['link']?>" target="<?=$dbSocial[3]['target']?>"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
          <?php }?>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row m-0">
          <div class="col-lg-4 col-md-3 col-sm-4 p-0">
            <p>Quick Links</p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>about/" target="_blank">
                <?=$dbSiteContent[1]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>services/" target="_blank">
                <?=$dbSiteContent[4]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing/" target="_blank">
                <?=$dbSiteContent[11]['menu_name']?>
                </a></li>
              <li> <a href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Search property</a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank">
                <?=$dbSiteContent[2]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" target="_blank">
                <?=$dbSiteContent[3]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>emi-calculator/" target="_blank"> Home Loan EMI Calculator </a></li>
              <li><a href="<?=HTACCESS_URL?>eligibility-calculator/" target="_blank"> Home Loan Eligibility Calculator </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 p-0">
            <p>Useful links</p>
            <ul class="list-css">
              <li><a href="<?=HTACCESS_URL?>contact/" target="_blank">
                <?=$dbSiteContent[8]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>terms-nd-conditions/" target="_blank">
                <?=$dbSiteContent[12]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>privacy-policy/" target="_blank">
                <?=$dbSiteContent[13]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>service-agreement/" target="_blank">
                <?=$dbSiteContent[14]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>website-disclaimer/" target="_blank">
                <?=$dbSiteContent[15]['menu_name']?>
                </a></li>
              <li><a href="<?=HTACCESS_URL?>faq/" target="_blank">
                <?=$dbSiteContent[6]['menu_name']?>
                </a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-4 p-0">
            <p>Contact Details</p>
            <ul class="contact-details">
              <?php if(!empty($dbContact[0]['address'])){?>
              <li class="montserrat font-18"> <i class="flaticon-maps-and-flags"></i>
                <p>
                  <?=substr($dbContact[0]['address'],0,28)?>
                  <span>
                  <?=substr($dbContact[0]['address'],28)?>
                  </span></p>
              </li>
              <?php }?>
              <?php if(!empty($dbContact[0]['contact_no'])){?>
              <li><i class="flaticon-phone-call-button"></i> <span class="font-bold">Phone</span> - <a href="tel:+91-<?=$dbContact[0]['contact_no']?>">
                <?=$dbContact[0]['contact_no']?>
                </a></li>
              <?php }?>
              <?php if(!empty($dbContact[0]['email'])){?>
              <li><i class="flaticon-new-email-button"></i> <span class="font-bold">Email</span> - <a href="mailto:<?=$dbContact[0]['email']?>">
                <?=$dbContact[0]['email']?>
                </a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="copyright">
  <div class="container"> <!--Created by <a href="<?php //=$dbContact[0]['link']?>" target="_blank">
   <?php //=$dbContact[0]['created_by']?></a>-->
    <?=$dbContact[0]['copyright']?>
  </div>
</div>
<div class="overlay"></div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you" id="openthankyou"/>
<div id="thank-you" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Thank You For Enquiry.</p>
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
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you1" id="openthankyou1"/>
<div id="thank-you1" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Thank you for your registration.</p>
              <!--<p class="text-center font">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--> 
              <!--<hr>--> 
              <!--<h4 class="text-center">You can instant contact using details</h4>--> 
              <!--<div class="contact-text">
               <div class="text-center"><i class="fa fa-mobile-alt" aria-hidden="true"> </i>&nbsp; +1 23 567 8596 
                 &nbsp;&nbsp; <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@example.com">info@example.com</a> </div>
             </div>--> 
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Thank you Popup Script -->
<input type="hidden"  class="btn btn-clear" data-toggle="modal" data-target="#thank-you2" id="openthankyou2"/>
<div id="thank-you2" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content thank-you box-css"> 
      <!--<button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>-->
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div> 
              <!--<div class="text-center mb-2"><img src="assets/imgs/icons/email.svg" width="60"></div>-->
              <p class="text-dark text-center text-uppercase font-weight-bolder">Thank You</p>
              <p class="text-center mb-0">Signin here to continue.</p>
              <!-- <p class="text-center font">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--> 
              <!--<br />--> 
              <!--<center><a href="" class="btn themebg text-white theme-btn mb-3 wow fadeIn" onclick="forceReload();"> Close</a></center>--> 
              <!--<hr>--> 
              <!--<h4 class="text-center">You can instant contact using details</h4>--> 
              <!--<div class="contact-text">
               <div class="text-center"><i class="fa fa-mobile-alt" aria-hidden="true"> </i>&nbsp; +1 23 567 8596 
                 &nbsp;&nbsp; <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@example.com">info@example.com</a> </div>
             </div>--> 
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/vendor/jquery/jquery.min.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function chkform() {
  if(isEmpty("Name",document.getElementById("name").value)) {
    document.getElementById("name").focus();
    document.getElementById("msg1").innerHTML=('Please enter name.');
    return false;
  }
  if(isEmpty("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("msg1").innerHTML=('Please enter email.');
    return false;
  }
  if(!validateEmail("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("msg1").innerHTML=('Invalid email.');
    return false;
  }
  if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
    document.getElementById("mobile_no").focus();
    document.getElementById("msg1").innerHTML=('Please enter mobile no.');
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
        //alert("Please enter only 10 digits mobile number.");  
        document.getElementById("msg1").innerHTML=('Please enter only 10 digits mobile number.');
        document.getElementById("mobile_no").value='';
        document.getElementById("mobile_no").focus();
        return false;    
      }
  }
  if(isEmpty("Purpose of Valuation",document.getElementById("purpose_of_valuation").value)) {
    document.getElementById("purpose_of_valuation").focus();
    document.getElementById("msg1").innerHTML=('Please select purpose of valuation.');
    return false;
  }
  if(isEmpty("Captcha",document.getElementById("captcha").value)) {
    document.getElementById("captcha").focus();
    document.getElementById("msg1").innerHTML=('Please enter captcha.');
    return false;
  }
  return true;

}

function chkcapcha(){
  
  if(chkform() == true){
  //alert(2);
  var form_data=$('#accForms').serialize();
  //alert(form_data);
  $.ajax({
  url:"<?=HTACCESS_URL?>valuationController.php?mode=checkcap",
  data:form_data,
  cache:false,
  async:false,
  success: function(data) {
  if(data==1){
    //$('#myModalHorizontal').click();
    //window.location.href = '<?=HTACCESS_URL?>login/';
    //alert("Invalid security code.");
    document.getElementById("msg1").innerHTML=("Invalid security code.");
    document.getElementById("captcha").reset();
  }else{
  //if(data==0){
    
    //window.location.href = '<?=HTACCESS_URL?>thanks-you/';
    //alert("Invalid");
    document.getElementById("accForms").reset();  
    window.location.href = '<?=HTACCESS_URL?>thankyou-app/';
  }
  }
  });
  }
  }
  
  
function chklocation() {
  
  var tags = document.getElementById("tags").value;
  
      $.ajax({
                url:"<?=HTACCESS_URL?>valuationController.php?mode=checkloc&tags="+tags,
        cache:false,
        async:true,
                //data:"tags =" + tags,
                    success:function(data){
          //alert(data);
                    
          if(data==0){
            $("#messageemail").html("Location not found. Try with a nearby location.");
            return false; 
            
          } 
                    else{
            //alert('1')
            //$("#message").html("Username/Email available");
            //return true;
            document.getElementById("accForm").submit();
                       
                    }
                }
             });
  
  
    return false;
  }
</script> 
<script type="text/javascript">
function ShowHideDiv(val,is_check){
var setval=(is_check==true)?1:0;
//var color = '#fff';
if(setval==1){
document.getElementById('div-show').style.display = 'block';
document.getElementById('ck-button').style.backgroundColor = '#d90019';
//document.body.style.backgroundColor = "red";
}
else if(setval==0){
document.getElementById('div-show').style.display = 'none';
}
}

function showflat(){
  var hiddenDiv = document.getElementById('showMe');
  //div.innerHTML = div.innerHTML + input.value;
   hiddenDiv.style.display = "block"; 
}

function ChangeColor() {
document.getElementById('demo').style.backgroundColor = '#d90019';
//document.getElementById('mySelect').style.color = '#ffffff';
var dropdown = document.getElementById("mySelect");
if(dropdown.value=="1"){
  //alert("Sq Feet range - 25 to 250")
  //alert('"The Area Unit selection seems wrong" Please check.')
}
if(dropdown.value=="2"){
  //alert("Sq Yard range - 410  to 4000")
  //alert('"The Area Unit selection seems wrong" Please check.')
}
}
</script> 

<!-- Bootstrap core JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="<?=HTACCESS_URL?>assets/vendor/jquery-easing/jquery.easing.min.js"></script> 

<!-- Custom scripts for this template --> 
<script src="<?=HTACCESS_URL?>assets/js/grayscale.min.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/home.js"></script> 

<!--owlcarousel--> 
<script src="<?=HTACCESS_URL?>assets/vendor/owlcarousel/owl.carousel.js"></script> 
<!--owlcarousel--> 

<!--fancybox--> 
<script src="<?=HTACCESS_URL?>assets/vendor/fancybox/jquery.fancybox.min.js"></script> 
<!--fancybox--> 

<!--animation--> 
<script src="<?=HTACCESS_URL?>assets/js/wow/wow.js"></script> 
<!--animation--> 

<!--scrolltopcontrol--> 
<script src="<?=HTACCESS_URL?>assets/js/scrolltopcontrol.js"></script> 
<!--scrolltopcontrol-->

<link rel="stylesheet" href="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.css">
<script src="<?=HTACCESS_URL?>cms_js/auto-search/jquery-ui.js"></script> 
<script>
//var citydata = 'ddd'; 
function getcity(cityName){ 
window.location.href = "<?=HTACCESS_URL?>property-valuation-calculator/"+cityName+"/";
}


function myFunction(){

  var input = document.getElementById('tags')

  //var hiddenDiv = document.getElementById('showMe');

  //div.innerHTML = div.innerHTML + input.value;

   //hiddenDiv.style.display = (this.value == "") ? "none":"block";

}



$( function() {

// Custom autocomplete instance.

$.widget( "app.autocomplete", $.ui.autocomplete, {

  // Which class get's applied to matched text in the menu items.

  options: {

    highlightClass: "ui-state-highlight"

  },

  _renderItem: function( ul, item ) {

    // Replace the matched text with a custom span. This

    // span uses the class found in the "highlightClass" option.

    var re = new RegExp( "(" + this.term + ")", "gi" ),

      cls = this.options.highlightClass,

      template = "<span class='" + cls + "'>$1</span>",

      label = item.label.replace( re, template ),

      $li = $( "<li/>" ).appendTo( ul );

    

    // Create and return the custom menu item content.

    $( "<a/>" ).attr( "href", "#" )

           .html( label )

           .appendTo( $li );

    return $li;

  }

});

var availableTags =  [ <?=$newdata?>];


$( "#tags" ).autocomplete({

  highlightClass: "bold-text",

  source: availableTags

});

} );


function forceReload() {
    window.location.reload(true);
}

</script>
<link rel="stylesheet" type="text/css" href="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.css"/>
<script src="<?=HTACCESS_URL?>assets/vendor/calander/jquery.datetimepicker.full.js"></script> 
<script>
/*$('#datetimepicker3').datetimepicker({
  inline:true,
  minDate: "+1",
  allowTimes:[

  '10:00', '11:00', '12:00', 

  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'

 ],
});*/

jQuery('#datetimepicker3').datetimepicker({
   onGenerate:function( ct ){
    jQuery(this).find('.xdsoft_date')
      .toggleClass('xdsoft_disabled');
  },
  inline:true,
  maxDate:'+2',
  allowTimes:[

  '10:00', '11:00', '12:00', 

  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'

 ],
});
</script> 
<script src="<?=HTACCESS_URL?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script>
$( document ).ready(function () {
  $(".moreBox").slice(0, 3).show();
    if ($(".blogBox:hidden").length != 0) {
      $("#loadMoreAhmedabad").show();
    }   
    $("#loadMoreAhmedabad").on('click', function (e) {
      e.preventDefault();
      $(".moreBox:hidden").slice(0, 10).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMoreAhmedabad").fadeOut('slow');
      }
    });
  });
$( document ).ready(function () {
  $(".moreBoxGandhinagar").slice(0, 3).show();
    if ($(".blogBoxGandhinagar:hidden").length != 0) {
      $("#loadMoreGandhinagar").show();
    }   
    $("#loadMoreGandhinagar").on('click', function (e) {
      e.preventDefault();
      $(".moreBoxGandhinagar:hidden").slice(0, 10).slideDown();
      if ($(".moreBoxGandhinagar:hidden").length == 0) {
        $("#loadMoreGandhinagar").fadeOut('slow');
      }
    });
  });
$( document ).ready(function () {
  $(".moreBoxvadodara").slice(0, 3).show();
    if ($(".blogBoxvadodara:hidden").length != 0) {
      $("#loadMorevadodara").show();
    }   
    $("#loadMorevadodara").on('click', function (e) {
      e.preventDefault();
      $(".moreBoxvadodara:hidden").slice(0, 10).slideDown();
      if ($(".moreBoxvadodara:hidden").length == 0) {
        $("#loadMorevadodara").fadeOut('slow');
      }
    });
  });
$( document ).ready(function () {
  $(".moreBoxSurat").slice(0, 3).show();
    if ($(".blogBoxSurat:hidden").length != 0) {
      $("#loadMoreSurat").show();
    }   
    $("#loadMoreSurat").on('click', function (e) {
      e.preventDefault();
      $(".moreBoxSurat:hidden").slice(0, 10).slideDown();
      if ($(".moreBoxSurat:hidden").length == 0) {
        $("#loadMoreSurat").fadeOut('slow');
      }
    });
  });
$( document ).ready(function () {
  $(".moreBoxLandRates").slice(0, 3).show();
    if ($(".blogBoxLandRates:hidden").length != 0) {
      $("#loadMoreLandRates").show();
    }   
    $("#loadMoreLandRates").on('click', function (e) {
      e.preventDefault();
      $(".moreBoxLandRates:hidden").slice(0, 10).slideDown();
      if ($(".moreBoxLandRates:hidden").length == 0) {
        $("#loadMoreLandRates").fadeOut('slow');
      }
    });
  });
</script> 
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function chkformforcomment() {
  if(isEmpty("Name",document.getElementById("name").value)) {
    document.getElementById("name").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Name* ");
    return false;
  }
  if(isEmpty("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Email* ");
    return false;
  }
  if(!validateEmail("Email",document.getElementById("email").value)) {
    document.getElementById("email").focus();
    document.getElementById("error1").innerHTML=(" Invalid Email ");
    return false;
  }
  if(isEmpty("Comment",document.getElementById("comment").value)) {
    document.getElementById("comment").focus();
    document.getElementById("error1").innerHTML=(" Please Enter Comment* ");
    return false;
  }
  return true;
}

function submit_host(){
  if(chkformforcomment() == true){
    document.getElementById("comment_form").submit();
  }
}
</script> 
