<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$msg = base64_decode($_SESSION['review_msg'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='8'";
$dbSitecontent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."review where status='1' order by display_order";
$dbReview = $dbObj->SelectQuery();
?>

<div class="center-section-in">
  <div class="container justify-content-center">
    <?php $heading = explode(' ', $dbSitecontent[0]['heading'])?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5">
      <?=$heading[0] ?? ""?>
      <span class="themecolor">
      <?=$heading[1] ?? ""?>
      </span> </h2>
    <div class="careers pb-0">
      <?php if(!empty($msg)) { ?>
      <center>
        <p style="color:#F00">
          <?=$msg?>
        </p>
      </center>
      <?php } ?>
      <form action="<?=HTACCESS_URL?>reviewController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
        <input type="hidden" name="mode" value="add_review">
        <input type="hidden" name="id" value="<?=$id?>">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class='rating-stars text-center'>
              <label>Your Ratings</label>
              <br />
              <br />
              <ul id='stars'>
                <li class='star' title='Poor' data-value='1'> <i class='fa fa-star fa-fw'></i> </li>
                <li class='star' title='Fair' data-value='2'> <i class='fa fa-star fa-fw'></i> </li>
                <li class='star' title='Good' data-value='3'> <i class='fa fa-star fa-fw'></i> </li>
                <li class='star' title='Excellent' data-value='4'> <i class='fa fa-star fa-fw'></i> </li>
                <li class='star' title='WOW!!!' data-value='5'> <i class='fa fa-star fa-fw'></i> </li>
              </ul>
              <br />
            </div>
            <input type="hidden" name="info[rating]" id="text-message" value="<?=$_SESSION['reviews']['rating'] ?? ""?>">
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="info[name]" id="name" class="form-control font-16 input-css" placeholder="Name" value="<?=$_SESSION['reviews']['name'] ?? ""?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="info[email]" id="email" class="form-control font-16 input-css" placeholder="Email Address" value="<?=$_SESSION['reviews']['email'] ?? ""?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="info[designation]" id="designation" class="form-control font-16 input-css" placeholder="Designation" value="<?=$_SESSION['reviews']['designation'] ?? ""?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <textarea name="info[review]" id="review" class="form-control font-16 input-css" maxlength="500" placeholder="Review"><?=$_SESSION['reviews']['review'] ?? ""?></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="form-control text-center captcha"> 
              <img src="<?=HTACCESS_URL?>php_captcha.php" style="height:30px;width:50%;margin-top:-17px;"/></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="number" id="captcha" class="form-control font-16 input-css" placeholder="Enter Captcha">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="btn btn-primary subscribe-now  submit-re font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="SUBMIT Review">
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="bg-light pt-5 pb-5">
  <div class="container">
    <div class="owl-carousel owl-theme">
    <?php for($i=0;$i<count((array)$dbReview);$i++){?>
      <div class="item">
        <div class="box-css2 box-boder p-3">
          <p><?=$dbReview[$i]['review']?></p>
          <?php if($dbReview[$i]['rating']=='1'){?>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <?php }?>
           <?php if($dbReview[$i]['rating']=='2'){?>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <?php }?>
           <?php if($dbReview[$i]['rating']=='3'){?>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <?php }?>
           <?php if($dbReview[$i]['rating']=='4'){?>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star-o" aria-hidden="true"></i>
          <?php }?>
           <?php if($dbReview[$i]['rating']=='5'){?>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <i class="fa fa-star" aria-hidden="true"></i>
          <?php }?>
        </div>
        <div class="title-t">
          <h4><?=$dbReview[$i]['name']?> <span><?=$dbReview[$i]['designation']?></span> </h4>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
</div>
<?php //include('client-review.php');?>
<?php unset($_SESSION['review_msg']);?>
<style type="text/css">
/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:1.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}

</style>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>assets/js/jquery-3.4.1.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
   // if (ratingValue > 1) {
        msg =  ratingValue ;
   // }
   // else {
   //     msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    //}
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
	 document.getElementById("text-message").value = msg
  /*$('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");*/
}
</script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script>
function chkform() {
	if(isEmpty("Rating",document.getElementById("text-message").value)) {
		document.getElementById("text-message").focus();
		alert("Rating cannot be blank");
		return false;
	}
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		alert("Name cannot be blank");
		return false;
	}
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		alert("Email cannot be blank");
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		alert("'Invalid Email");
		return false;
	}
	if(isEmpty("Designation",document.getElementById("designation").value)) {
		document.getElementById("designation").focus();
		alert("Designation cannot be blank");
		return false;
	}
	if(isEmpty("Review",document.getElementById("review").value)) {
		document.getElementById("review").focus();
		alert("Review cannot be blank");
		return false;
	}
	if(isEmpty("Captcha",document.getElementById("captcha").value)) {
		document.getElementById("captcha").focus();
		alert("Captcha cannot be blank");
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
<?php include(INCLUDE_DIR.'footer.php'); ?>