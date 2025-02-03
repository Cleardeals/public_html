<script>
  fbq('track', 'Lead', {
    value: 1,
    currency: '1',
  });
</script>
<?php include(INCLUDE_DIR.'header-2.php') ?>
<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id']?? "");

$dbObj->dbQuery="select * from ".PREFIX."home_loan_enquiry where id='".$id."'";
$dbLoanEmi = $dbObj->SelectQuery();

$balance = $dbLoanEmi[0]['loan_eligibility'];
$pmtNo = $dbLoanEmi[0]['years'] * 12;
$rate = $dbLoanEmi[0]['rate'] / 1200;
$emi = $dbLoanEmi[0]['monthly_emi'];
?>
<div class="center-section-in">
  <div class="container">
  
  <!--<div class="text-center mb-4 btn-2">  <a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank">Home  Loan EMI Calculator </a> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank"> Home Loan Eligiblity
    Calculator </a> <a href="<?=HTACCESS_URL?>contact/" class="btn text-white call-bt call-bt2 mb-2" target="_blank"> <i class="flaticon-phone"></i> Contact </a></div>-->
    
     <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2">Your Home Loan <span class="themecolor">Emi Result </span> </h2>
<br />
  
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="row">
          <div class="col-md-2 pl-5"></div>
            <div class="col-md-4 pl-5 pr-0" style="padding-top: 25px;">
              <div class="pl-5">
                <div class="form-group"> <small>Monthly Home Loan EMI</small>
                  <h2><span id="Emi">₹
                    <?=moneyFormatIndia(round($dbLoanEmi[0]['monthly_emi']))?>
                    </span></h2>
                </div>
                <div class="form-group"> <small style="color:#d40010; position:relative;">  
                
                   <div class="price-1"></div>
                
                Principal Amount</small>
                  <h2 style="color:#d40010"><span id="Principal">₹
                    <?=moneyFormatIndia(round($dbLoanEmi[0]['loan_eligibility']))?>
                    </span></h2>
                </div>
                <div class="form-group"> <small style="color:#3d6fab; position:relative;">
                
                <div class="price-2"></div>
                
                Interest Amount</small>
                  <h2 style="color:#3d6fab"><span id="Intrest">₹
                    <?=moneyFormatIndia(round($dbLoanEmi[0]['intrest']))?>
                    </span></h2>
                </div>
                <div class="form-group"> <small>Total Amount Payable</small>
                  <h2><span id="totalAmt">₹
                    <?=moneyFormatIndia(round($dbLoanEmi[0]['totalPay']))?>
                    </span></h2>
                </div>
              </div>
            </div>
            <div class="col-md-3" style="margin-top:65px;">
              <!--<canvas id="oilChart" width="100" height="100"></canvas>-->
              <div class="div2"><canvas id="canvas" height="240" width="240"></canvas></div>
              <br />
              <p class="text-center">Contact us on 9723992226 for Home Loan Requirements</p>
            </div>
            <div class="col-md-2 pl-5"></div>
            <!--<div class="col-md-12">
              <div class="text-center mt-40">
                <a href="#" class="theme-btn-boder2 btn mr-1 ml-1 text-uppercase"> Apply Now </a> 
                <button type="submit" class="theme-btn-boder2 btn mr-1 ml-1 text-uppercase"> Apply Now </button>
                <a href="#" class="theme-btn-boder2 btn text-uppercase" target="_blank"> Let us Contact You </a> </div>
            </div>-->
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    <div class="clearfix"></div>
    <div class="calculator-wrapper mt-3"><div class="table-content table-responsive">
      <div class="emi-calculated-table-title">
        <h2 class="mb-3 text-center">Home Loan Amortization Schedule</h2>
      </div>
      <table class="table">
        <thead>
          <tr class="success">
            <th>Pmt No.</th>
            <th>Beginning Balance (Rs.)</th>
            <th>Scheduled Payment (Rs.)</th>
            <th>Principal (Rs.)</th>
            <th>Interest (Rs.)</th>
            <th>Ending Balance (Rs.)</th>
            <th>Cumulative Interest (Rs.)</th>
          </tr>
        </thead>
        <tbody>
        <?
        for($i=0;$i<$pmtNo;$i++){
			$no = $i+1;
			
			 $interest = str_replace( ',', '', $balance) * $rate;
             $principal = str_replace( ',', '', $emi) - $interest;
			 $endingBalance = str_replace( ',', '', $balance) - $principal;
			 //$comInterest = $interest + $interest;
			 $comInterest += $interest;
		?>
          <tr class="emi-calculator-odd">
            <td><?=$no?></td>
            <td><?=number_format($balance,2)?></td>
            <td><?=number_format($emi,2)?></td>
            <td><?=number_format($principal,2)?></td>
            <td><?=number_format($interest,2)?></td>
            <td>
			<? if($endingBalance>0){?>
			<?=number_format($endingBalance,2)?>
            <? }else{?>
            -
            <? }?>
            </td>
            <td>
			<?=number_format($comInterest,2)?>
            </td>
          </tr>
          <? 
		  $balance -= $principal;
		  }?>
        </tbody>
      </table>
      <div id="emi_data"></div>
    </div></div>
  </div>
</div>
<script type="text/javascript" src="<?=HTACCESS_URL?>assets/js/chart/dummy.js"></script>
<link rel="stylesheet" type="text/css" href="<?=HTACCESS_URL?>assets/js/chart/result-light.css">
<script type="text/javascript" src="<?=HTACCESS_URL?>assets/js/chart/Chart.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<style>
#slide-range { width:100%}
.input-Amount { width:90%; border-left:0; border-right:0; border-top:0; text-align:right}
 
.slider {
  -webkit-appearance: none;
  width: 100%;
  height:6px;
  background: #e30000;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #fff;
  cursor: pointer; border:solid 1px #c4c4c4; border-radius:100%
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #ffffff;
  cursor: pointer; border:solid 1px #c4c4c4; border-radius:100%
}
#canvas{
-ms-transform: rotate(-75.2deg); /* IE 9 */
-webkit-transform: rotate(-75.2deg); /* Chrome, Safari, Opera */
transform: rotate(-75.2deg);
}
</style>
<script>
openRate = [
            {
                value: <?=round($dbLoanEmi[0]['loan_eligibility'])?>,
				//value: 2500000,
                color: "#d40010",
                highlight: "rgba(234, 39, 53, 0.44)",
            },
            {
                value: <?=round($dbLoanEmi[0]['intrest'])?>,
				//value: 8879997,
                color: "#3d6fab",
                highlight: "rgba(69, 133, 209, 0.82)"
            }
        ];

var ctx=document.getElementById('canvas').getContext("2d");
var chart=new Chart(ctx).Pie(openRate);
</script>