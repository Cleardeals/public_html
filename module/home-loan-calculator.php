<?php include(INCLUDE_DIR.'header-2.php') ?>

<div class="center-section-in">
  <div class="container"> 
  
<!--<div class="text-center mb-4 btn-2">  <a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank">Home  Loan EMI Calculator </a> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank"> Home Loan Eligiblity
    Calculator </a> <a href="<?=HTACCESS_URL?>contact/" class="btn text-white call-bt call-bt2 mb-2" target="_blank"> <i class="flaticon-phone"></i> Contact </a></div>-->
    
    
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2"> Home Loan <span class="themecolor">Eligibility Calculator </span> </h2>
    <p class="mb-5"> Home Loan eligibility is dependent on factors such as your monthly income, current age, credit score, fixed monthly financial obligations, credit history, retirement age etc. Get the peace of mind by knowing all the details about your loan using Cleardeal's Home Loan Eligibility Calculator</p>
    
    <h5 class="font-20 text-uppercase text-left font-extrabold   mb-4 mt-5"> Home Loan <span class="themecolor"> Eligibility Criteria </span> </h5>
    
    <div class="list-css3 mb-4">
      <ul>
        <li>Present Age and Remaining Working Years: The age of the applicant plays a major role in determining home loan eligibility. The maximum loan term is generally capped at 30 years.</li>
        <li>Age Limit for Salaried Individuals: 21 to 65 years .</li>
        <li>Age Limit for Self-Employed Individuals: 21 to 65 years.</li>
        <li>Minimum Salary: ₹10,000 p.m.</li>
        <li>Minimum business income: ₹2 lac p.a.</li>
        <li>Maximum Loan Term: 30 years.</li>
        <li>Financial Position: The present and the future income of applicant(s) has a significant impact on determining the loan amount.</li>
        <li>Past and Present Credit History and Credit Score: A clean repayment record is considered positive.</li>
        <li>Other Financial Obligations: Existing liabilities such as a car loan, credit card debt, etc.</li>
      </ul>
    </div>
    <div class="clearfix"></div>
    <div>
      <!--<h2 class="font-20 text-uppercase text-center mb-3"> Calculate Home Loan Eligibility </h2>-->
      <!--<p id="erroreli1"></p>
      <form action="/" method="post" id="accFormEligibility" onsubmit="return chkformEli();" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control font-15 input-css" placeholder="Name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="mobile_no" id="mobile_no" class="form-control font-15 input-css" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="email" id="email" class="form-control font-15 input-css" placeholder="Email Id">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select name="emi_purpose" id="emi_purpose" class="form-control font-15 input-css">
                <option value=""> Purpose of EMI Calculation</option>
                <option value="Looking for a Home Loan">Looking for a Home Loan </option>
                <option value="Just to Check">Just to Check</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <input type="submit" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Submit">
             
            </div>
          </div>
        </div>
      </form>-->
      <div class="text-center"> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="theme-btn-boder2 btn mr-1 mt-4 ml-1"> Calculate Home Loan Eligibility </a></div>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2 mt-5"> Home Loan <span class="themecolor">EMI Calculator</span> </h2>
    <p class="mb-5">Cleardeal's home loan calculator helps you calculate your Home Loan Emi with ease. Cleardeals offers home loans with EMIs starting from ₹659 per lac and interest rates starting from 6.90%* p.a. with additional features such as flexible repayment options and top-up loan. With a low-interest rate and long repayment tenure, Cleardeal’s ensures a comfortable home loan EMI for you. With our reasonable EMIs, Home loan is lighter on your pocket. Calculate the EMI that you will be required to pay for your home loan with our easy to understand. </p>
    <div>
      <!--<h2 class="font-20 text-uppercase text-center mb-3"> Calculate Home Loan EMI </h2>-->
      <!--<p id="erroremi1"></p>
      <form action="/" method="post" id="accFormEmi" onsubmit="return chkformEmi();" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="emi_name" id="emi_name" class="form-control font-15 input-css" placeholder="Name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="emi_mobile_no" id="emi_mobile_no" class="form-control font-15 input-css" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="emi_email" id="emi_email" class="form-control font-15 input-css" placeholder="Email Id">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select name="emi_purpose_cal" id="emi_purpose_cal" class="form-control font-15 input-css">
                <option value=""> Purpose of EMI Calculation</option>
                <option value="Looking for a Home Loan">Looking for a Home Loan </option>
                <option value="Just to Check">Just to Check</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <input type="submit" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Submit">
             <!--<a href="<?=HTACCESS_URL?>emi-calculator/" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit">Submit</a>
            </div>
          </div>
        </div>
      </form>-->
      <div class="text-center"> <a href="<?=HTACCESS_URL?>emi-calculator/" class="theme-btn-boder2 btn mr-1 ml-1"> Calculate Home Loan EMI </a></div>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2 mt-5">FAQ’s</h2>
    <h4>What is Home Loan EMI Calculator?</h4>
    <p>Home Loan EMI Calculator assists in calculation of the loan installment i.e. EMI towards your home loan. It an easy to use calculator and acts as a financial planning tool for a home buyer.</p>
    <h4>What is Home Loan EMI?</h4>
    <p>EMI stands for Equated Monthly Installment. It includes repayment of the principal amount and payment of the interest on the outstanding amount of your home loan. A longer loan tenure (for a maximum period of 30 years) helps in reducing the EMI.</p>
    <h4>How does EMI calculation help in planning the home purchase?</h4>
    <p>Cleardeal’s Home Loan EMI calculator gives a clear understanding of the amount that needs to be paid towards the EMIs and helps make an informed decision about the outflow towards the housing loan every month. This helps estimate the loan amount that can be availed and helps in assessing the own contribution requirements and cost of the property. Therefore knowing the EMI is crucial for calculation of home loan eligibility and planning your home buying journey better.</p>
    <h4>How is Home Loan eligibility calculated?</h4>
    <p>Housing loan eligibility is primarily dependent on the income and repayment capacity of the individual(s).There are other factors that determine the eligibility of home loans such as age, financial position, credit history, credit score, other financial obligations etc.</p>
  </div>
  <div class="clearfix"></div>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>
