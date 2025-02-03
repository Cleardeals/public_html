<script>
  fbq('track', 'Lead', {
    value: 1,
    currency: '1',
  });
</script>
<?php include(INCLUDE_DIR.'header-2.php') ?>
<?php
//unset($_SESSION['eligibility']);
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."home_loan_enquiry where id='".$id."'";
$dbLoanEli = $dbObj->SelectQuery();
?>
<div class="center-section-in">
<div class="container">
<!--<div class="text-center mb-4 btn-2">  <a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank">Home  Loan EMI Calculator </a> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank"> Home Loan Eligiblity
    Calculator </a> <a href="<?=HTACCESS_URL?>contact/" class="btn text-white call-bt call-bt2 mb-2" target="_blank"> <i class="flaticon-phone"></i> Contact </a></div>-->
    
     <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2">Your Home Loan <span class="themecolor">Eligibility Result </span> </h2>
<br />
<form action="/" method="post" id="accFormEligibility" onsubmit="return chkformEli();" autocomplete="off">
<!--<form action="<?=HTACCESS_URL?>calculatorController.php" method="post">-->
  <div class="row">
    <div class="col-md-12 mb-4 text-center">
      <div style="background:#233859; padding:20px 30px; max-width:400px; margin:0 auto; border-radius:3px">
      <small class="text-uppercase text-center text-white">Your Home Loan Eligibility</small>
        <h2 class="text-center text-white" id="Amount"> <span class="unit">Rs.</span> <?=round($dbLoanEli[0]['loan_eligibility'])?>/-</h2>
        <small class="text-center text-white">Contact us on 9723992226 for Home Loan <br />Requirements</small><br>
       <!-- <small class="text-uppercase text-center text-white"><a href="#" class="text-white"><i class='fa fa-comment'></i> 
        Chat with us</a></small>--> </div>
      <div class="clearfix"></div>
      <p class="text-center mt-4 d-block">Your Home Loan EMI will be</p>
      <h3 class="text-center" id="monthlyAmount">Rs.  <?=round($dbLoanEli[0]['monthly_emi'])?>/ <small>per month</small></h3>
      <div class="text-center mt-40">
      <!--<button type="submit" class="theme-btn-boder2 btn mr-1 ml-1 text-uppercase"> Apply Now </button> 
      <a href="#" class="theme-btn-boder2 btn text-uppercase" target="_blank"> Let us Contact You </a>--> </div>
    </div>
    <div class="clearfix"></div>
  </div>
  </form>
  <div class="clearfix"></div>
</div>
</div>
<?php include(INCLUDE_DIR.'footer.php'); ?>