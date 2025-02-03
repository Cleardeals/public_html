<!-- Header -->
<div  class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> Billing address </span> </h2>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-12 order-md-1">
        <form class="needs-validation" novalidate="">
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control font-14 input-css" id="firstName" placeholder="First name" value="">
              <div class="invalid-feedback"> Valid first name is required. </div>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control font-14 input-css" id="lastName" placeholder="Last name" value="" required="">
              <div class="invalid-feedback"> Valid last name is required. </div>
            </div>
            <div class="col-md-6 mb-3">
              <input type="email" class="form-control font-14 input-css" id="email" placeholder="Email">
              <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control font-14 input-css" id="address" placeholder="Address" required="">
              <div class="invalid-feedback"> Please enter your shipping address. </div>
            </div>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control font-14 input-css" id="address2" placeholder="Address 2 (Optional)">
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <select class="custom-select d-block w-100 form-control rounded-0" id="country" required="">
                <option value="">Country</option>
                <option>United States</option>
              </select>
              <div class="invalid-feedback"> Please select a valid country. </div>
            </div>
            <div class="col-md-4 mb-3">
              <select class="custom-select d-block w-100 form-control rounded-0" id="state" required="">
                <option value="">State</option>
                <option>State</option>
              </select>
              <div class="invalid-feedback"> Please provide a valid state. </div>
            </div>
            <div class="col-md-3 mb-3">
              <input type="text" class="form-control font-14 input-css" id="zip" placeholder="Zip" required="">
              <div class="invalid-feedback"> Zip code required. </div>
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="save-info">
            <label class="custom-control-label" for="save-info">Save this information for next time</label>
          </div>
          <hr class="mb-4">
          <h4 class="mb-3">Payment</h4>
          <div class="my-3 row m-0">
            <div class="custom-control custom-radio col-lg-2 col-md-3 col-sm-4">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio col-lg-2 col-md-3  col-sm-4">
              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
              <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio col-lg-2 col-md-3 col-sm-4">
              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
              <label class="custom-control-label" for="paypal">Paypal</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control font-14 input-css" id="cc-name" placeholder="Name on card" required="">
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback"> Name on card is required </div>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control font-14 input-css" id="cc-number" placeholder="Credit card number" required="">
              <div class="invalid-feedback"> Credit card number is required </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <input type="text" class="form-control font-14 input-css" id="cc-expiration" placeholder="Expiration" required="">
              <div class="invalid-feedback"> Expiration date required </div>
            </div>
            <div class="col-md-3 mb-3">
              <input type="text" class="form-control font-14 input-css" id="cc-cvv" placeholder="CVV" required="">
              <div class="invalid-feedback"> Security code required </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary subscribe-now  submit font-16 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100" type="submit" data-fancybox="thank-you" data-src="#thank-you" href="javascript:;">Payment</button>
        </form>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</div>
<div id="thank-you" style="display:none;">
  <h2 class="mb-3  mt-3 font-35 text-uppercase text-center font-bold">Thank You! </h2>
  <p class="text-center mb-3 mt-3"> Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>