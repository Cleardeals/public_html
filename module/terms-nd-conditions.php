<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='13'";
$dbSitecontent = $dbObj->SelectQuery();
?>
<div class="center-section-in">
  <div class="container">
  <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> <?=$heading[0] ?? ""?> <span class="themecolor"><?=$heading[1] ?? ""?></span> </h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
       <?=html_entity_decode(stripslashes($dbSitecontent[0]['content']))?>
      </div>
    </div>
    <div class="clearfix"></div>
    <div>
      <h1>Terms and Conditions</h1>
      <br>
      <p>Last Updated: 8.2.2025</p>
      <p>These Terms and Conditions ("Terms") form a legally binding agreement between you ("User" or "you") and Proptech Cleardeals Private Limited ("Company", "we", "us" or "our"). By accessing or using our website <a href="https://www.cleardeals.co.in/" style="color: blue" target="_blank">(www.cleardeals.co.in)</a> and related services ("Services"), you agree to these Terms in full. If you do not agree, please do not use our Services.</p>
    </div>
    <br>
    <div>
      <h2>1. Acceptance of Terms</h2>
      <br>
       <ul class="ul-terms">
       <li class="li-terms">You must read and accept these Terms before using our Services.</li>
         <li class="li-terms">Your continued access constitutes your acceptance of these Terms</li>
       </ul>
    </div>
    <br>
    <div>
      <h2>2. Description of Our Services</h2>
      <br>
       <ul class="ul-terms">
       <li class="li-terms">We are an online estate agent that provides property marketing, lead generation, and related support services.</li>
         <li class="li-terms">Our service model is based on a “no brokerage” concept. We charge a nominal service fee (upfront) as specified in our pricing packages.
         </li>
         <li class="li-terms">Our service model is based on a “no brokerage” concept. We charge a nominal service fee (upfront) as specified in our pricing packages.
         <li class="li-terms">We do not guarantee that your property will be sold.
       </ul>
    </div>
    <br>
    <div>
      <h2>3. User Obligations</h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">You must provide accurate, complete, and current information during registration.
       </li>
         <li class="li-terms">You agree to use our Services only for lawful purposes.
         </li>
         <li class="li-terms">You are responsible for maintaining the confidentiality of your account details.</li>

         <li class="li-terms">You agree not to misuse or interfere with our website or Services</li>
       </ul>
    </div>
    <br>
    <div>
      <h2>4. Pricing, Payment, and Non-Refundable Policy</h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">Our pricing packages are displayed on our website. 
       </li>
         <li class="li-terms"> All fees, including the GST portion, are non-refundable unless expressly stated below. </li>
         <li class="li-terms"> Once you register for our Services, you cannot cancel your registration.</li>

         <li class="li-terms">If you pay only 50% of the pricing plan (or any part payment), no portion of the service fee shall be refundable. </li>
         <li class="li-terms">For customers registering under the Quick Sell Money Back plan with full payment, a 50% refund (of the service fee, exclusive of GST) may be provided only if your property remains unsold within the service validity period.</li>
         <li class="li-terms">In all cases, the GST amount shall not be refunded.</li>

       </ul>
    </div>
    <br>
    <div>
      <h2>5. Disclaimers and Limitation of Liability
      </h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">Our Services are provided on an "as is" and "as available" basis without any express or implied warranties.
       </li>
         <li class="li-terms">We do not guarantee a sale or any specific outcome for your property.
         </li>
         <li class="li-terms">Under no circumstances shall the Company be liable for any direct, indirect, or consequential damages arising from the use of our Services.
         </li>

         <li class="li-terms">You accept that your use of our Services is at your sole risk.
         </li>
       </ul>
    </div>
    <br>

    <div>
      <h2>6. Cancellation and Termination</h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">Once you register for our Services, you are not permitted to cancel your registration.

       </li>
         <li class="li-terms">No refund will be provided for any cancellation requests, except as described under the Quick Sell Money Back plan.
         </li>
         <li class="li-terms">We reserve the right to suspend or terminate your access to our Services if you breach these Terms.
         </li>
       </ul>
    </div>
    <br>

    <div>
      <h2>7. Governing Law and Dispute Resolution
      </h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">Terms shall be governed by and construed in accordance with the laws of India. </li>
         <li class="li-terms">Any dispute arising out of or relating to these Terms or the use of our Services shall first be attempted to be resolved amicably.
         </li>
         <li class="li-terms">If a resolution cannot be reached, the dispute shall be referred to arbitration.         </li>

         <li class="li-terms">All disputes shall be subject to the exclusive jurisdiction of the courts in Ahmedabad, Gujarat.
         </li>

       </ul>
    </div>
    <br>

    <div>
      <h2>8. Miscellaneous
      </h2>
      <br>
       <ul class="ul-terms">

       <li class="li-terms">These Terms, together with our Privacy Policy, constitute the entire agreement between you and the Company.
       </li>
         <li class="li-terms">If any provision of these Terms is found to be invalid or unenforceable, the remaining provisions shall continue in full force.
         </li>
         <li class="li-terms">Our failure to enforce any right or provision of these Terms will not constitute a waiver of such right or provision.
         </li>

         <li class="li-terms">We reserve the right to modify these Terms at any time. Updated Terms will be posted on our website, and your continued use of our Services constitutes acceptance of those changes.
         </li>
       </ul>
    </div>
    <br>

    <div>
      <h2> 9. Contact Information</h2>
      <br>
      <p>For any questions or concerns about these Terms, please contact us at:
      </p>
       <ul class="ul-terms">

       <li class="li-terms"><strong>Email:</strong> contact@cleardeals.co.in

       </li>
         <li class="li-terms"><strong>Phone:</strong>+91 9723992226         </li>
         <li class="li-terms"><strong>Address:</strong>  208 SF Aditya Plaza, Nr. Karnavati Club, Jodhpur Gam Road, Satellite, Ahmedabad, Gujarat – 380015, India
         </li>
      <li class="li-terms"> </li>
      <li class="li-terms"> </li>

       </ul>
    </div>
    <br>

   






    



   
    
  </div>
  <div class="clearfix"></div>
</div>


  <style>
  .ul-terms {
    margin-left: 20px !important;
  }

 .li-terms {
    position: relative;
    padding-left: 12px !important;
    display: block !important;
}

.li-terms::before {
    content: "•"; /* Unicode bullet */
    position: absolute;
    left: 0;
    color: black; /* Change color if needed */
    font-size: 16px; /* Adjust bullet size */
    font-weight: bold;
}

</style>


<!-- <style>
  .more-content {
    display: none; /* Hide the extra content initially */
}

.read-more-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
}

.read-more-btn:hover {
    background-color: #0056b3;
}

</style> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script>
   $(document).ready(function () {
    $(".read-more-btn").click(function (event) {
        event.preventDefault(); // Prevents any unintended default behavior

        let moreContent = $(this).prev(".more-content");

        if (moreContent.is(":visible")) {
            moreContent.slideUp(); // Hide content with animation
            $(this).text("Read More");
        } else {
            moreContent.slideDown(); // Show content with animation
            $(this).text("Read Less");
        }
    });
});

</script> -->

<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>