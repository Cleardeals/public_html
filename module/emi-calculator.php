<?php include(INCLUDE_DIR.'header-2.php') ?>
<?php
$loan = 100000;
$interest = 7;
$months = 20 * 12;

function pmt($interest, $months, $loan) {
   $months = $months;
   $interest = $interest / 1200;
   $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
   return number_format($amount, 2);
}

$amount = pmt($interest, $months, $loan);

$monthly = 25000;
$otheremi = 0;
$gross = ((($monthly *50/100) - ($otheremi))/$amount)*100000;



function emi_calculator($p, $r, $t) { 

    $emi; 
  
    // one month interest 
    $r = $r / (12 * 100); 
      
    // one month period 
    $t = $t * 12;  
      
    $emi = ($p * $r * pow(1 + $r, $t)) /  
                  (pow(1 + $r, $t) - 1); 
  
    return ($emi); 
} 
  
    // Driver Code 
    $principal = 2000000; 
    $rate = 7; 
    $time = 20; 
	$totalTime = $time * 12;
    $emi = emi_calculator($principal, $rate, $time); 
    //echo "Monthly EMI is = ", $emi;
	$Total = $emi *  $totalTime;
	$TotalIntrest = $Total - $principal;
	
	//echo $_GET['loan_eligibility'];
?>
<div class="center-section-in">
  <div class="container">
  
  <!--<div class="text-center mb-4 btn-2">  <a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank">Home  Loan EMI Calculator </a> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank"> Home Loan Eligiblity
    Calculator </a> <a href="<?=HTACCESS_URL?>contact/" class="btn text-white call-bt call-bt2 mb-2" target="_blank"> <i class="flaticon-phone"></i> Contact </a></div>-->
     <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2">Calculate Your Home Loan <span class="themecolor">Emi Now </span> </h2>
<br />
  
    <!--<form action="<?=HTACCESS_URL?>calculatorController.php" id="hostForm" method="post">-->
    <form action="/" method="post" id="accFormEmi" onsubmit="return chkformEmi();" autocomplete="off">
      <div class="row">
        <div class="col-md-5 mb-4">
          <div class="row">
            <div class="col-md-8">
              <p class="m-0 pb-0 text-uppercase">Loan Amount</p>
            </div>
            <div class="col-md-4">
              <div class="input-amount"> <span class="unit">₹</span>
                <input type="text" id="input-Amount" name="loan_eligibility" value="2000000" class="input-Amount custom-range">
              </div>
            </div>
            <div class="col-md-12 mt-1 mb-2">
              <input id="slide-range" type="range" min="100000" max="100000000" step="5000" class="slider" value="2000000">
            </div>
            <div class="col-6 text-left mb-3">₹ 1 Lac</div>
            <div class="col-6 text-right mb-3"> ₹ 10 Cr</div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <p class="m-0 pb-0 text-uppercase">Tenure (Years)</p>
            </div>
            <div class="col-md-3">
              <div class="input-amount">
                <!--<span class="unit">₹</span>-->
                <input id="input-Amount2" name="years" class="input-Amount" value="20">
              </div>
            </div>
            <div class="col-md-12 mt-1 mb-2">
              <input id="slide-range2" type="range" min="1" max="30" step="1" class="slider" value="20">
            </div>
            <div class="col-6 text-left mb-3"> 1</div>
            <div class="col-6 text-right mb-3"> 30</div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <p class="m-0 pb-0 text-uppercase">Interest Rate (% p.a.)</p>
            </div>
            <div class="col-md-3">
              <div class="input-amount">
                <!--<span class="unit">₹</span>-->
                <input id="input-Amount3" name="rate" value="7%" class="input-Amount">
              </div>
            </div>
            <div class="col-md-12 mt-1 mb-2">
              <input id="slide-range3" type="range" min="0" max="15" step="0.01" class="slider" value="7">
            </div>
            <div class="col-6 text-left mb-3">0</div>
            <div class="col-6 text-right mb-3"> 15</div>
          </div>
        </div>
        <div class="col-md-7 mb-4">
        <input type="hidden" name="monthly_emi" id="monthly_emi" value="<?=$emi?>">
        <input type="hidden" name="intrest" id="intrest" value="<?=$TotalIntrest?>">
        <input type="hidden" name="totalPay" id="totalPay" value="<?=$Total?>">
          <!--<div class="row">
            <div class="col-md-6 pl-5">
              <div class="pl-5">
                <div class="form-group"> <small>Monthly Home Loan EMI</small>
                  <input type="text" name="monthly_emi" id="monthly_emi" value="<?=number_format($emi)?>">
                  <h2><span id="Emi">₹
                    <?=number_format($emi)?>
                    </span></h2>
                </div>
                <div class="form-group"> <small style="color:#d40010">Principal Amount</small>
                  <h2 style="color:#d40010"><span id="Principal">₹
                    <?=number_format($principal)?>
                    </span></h2>
                </div>
                <div class="form-group"> <small style="color:#3d6fab">Interest Amount</small>
                  <input type="text" name="intrest" id="intrest" value="<?=number_format($TotalIntrest)?>">
                  <h2 style="color:#3d6fab"><span id="Intrest">₹
                    <?=number_format($TotalIntrest)?>
                    </span></h2>
                </div>
                <div class="form-group"> <small>Total Amount Payable</small>
                  <input type="text" name="totalPay" id="totalPay" value="<?=number_format($Total)?>">
                  <h2><span id="totalAmt">₹
                    <?=number_format($Total)?>
                    </span></h2>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <canvas id="oilChart" width="100" height="100"></canvas>
            </div>
            <div class="col-md-12">
              <div class="text-center mt-40">
                <button type="submit" class="theme-btn-boder2 btn mr-1 ml-1 text-uppercase"> Apply Now </button>
                <a href="#" class="theme-btn-boder2 btn text-uppercase" target="_blank"> Let us Contact You </a> </div>
            </div>
          </div>-->
      
        <div class="row justify-content-center">
        <div class="col-md-10"><p id="erroremi1"></p></div>
          <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="emi_name" id="emi_name" class="form-control font-15 input-css" placeholder="Name">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="emi_mobile_no" id="emi_mobile_no" class="form-control font-15 input-css" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="emi_email" id="emi_email" class="form-control font-15 input-css" placeholder="Email Id">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <select name="emi_purpose_cal" id="emi_purpose_cal" class="form-control font-15 input-css">
                <option value=""> Purpose of EMI Calculation</option>
                <option value="Looking for a Home Loan">Looking for a Home Loan </option>
                <option value="Just to Check">Just to Check</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="submit" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Calculate Now">
             <!--<a href="<?=HTACCESS_URL?>emi-calculator/" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit">Submit</a>-->
            </div>
          </div>
        </div>
      <!--</form>-->
        </div>
        <div class="clearfix"></div>
      </div>
    </form>
    <div class="clearfix"></div>
    <!--<div class="calculator-wrapper mt-3"><div class="table-content table-responsive">
      <div class="emi-calculated-table-title">
        <h2 class="mb-3 text-center">Home Loan Amortization Schedule</h2>
      </div>
      <table class="table">
        <thead>
          <tr class="success">
            <th>Year</th>
            <th>Opening Balance</th>
            <th>EMI*12</th>
            <th>Interest paid yearly</th>
            <th>Principal paid yearly</th>
            <th>Closing Balance</th>
          </tr>
        </thead>
        <tbody>
          <tr class="emi-calculator-odd">
            <td>1</td>
            <td>25,00,000</td>
            <td>2,30,792</td>
            <td>1,70,621</td>
            <td>60,172</td>
            <td>24,39,828</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>2</td>
            <td>24,39,828</td>
            <td>2,30,792</td>
            <td>1,66,335</td>
            <td>64,457</td>
            <td>23,75,371</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>3</td>
            <td>23,75,371</td>
            <td>2,30,792</td>
            <td>1,61,744</td>
            <td>69,048</td>
            <td>23,06,323</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>4</td>
            <td>23,06,323</td>
            <td>2,30,792</td>
            <td>1,56,826</td>
            <td>73,966</td>
            <td>22,32,357</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>5</td>
            <td>22,32,357</td>
            <td>2,30,792</td>
            <td>1,51,558</td>
            <td>79,234</td>
            <td>21,53,122</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>6</td>
            <td>21,53,122</td>
            <td>2,30,792</td>
            <td>1,45,915</td>
            <td>84,878</td>
            <td>20,68,244</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>7</td>
            <td>20,68,244</td>
            <td>2,30,792</td>
            <td>1,39,869</td>
            <td>90,923</td>
            <td>19,77,321</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>8</td>
            <td>19,77,321</td>
            <td>2,30,792</td>
            <td>1,33,393</td>
            <td>97,399</td>
            <td>18,79,922</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>9</td>
            <td>18,79,922</td>
            <td>2,30,792</td>
            <td>1,26,456</td>
            <td>1,04,336</td>
            <td>17,75,586</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>10</td>
            <td>17,75,586</td>
            <td>2,30,792</td>
            <td>1,19,025</td>
            <td>1,11,768</td>
            <td>16,63,818</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>11</td>
            <td>16,63,818</td>
            <td>2,30,792</td>
            <td>1,11,064</td>
            <td>1,19,728</td>
            <td>15,44,090</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>12</td>
            <td>15,44,090</td>
            <td>2,30,792</td>
            <td>1,02,536</td>
            <td>1,28,256</td>
            <td>14,15,834</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>13</td>
            <td>14,15,834</td>
            <td>2,30,792</td>
            <td>93,402</td>
            <td>1,37,391</td>
            <td>12,78,443</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>14</td>
            <td>12,78,443</td>
            <td>2,30,792</td>
            <td>83,616</td>
            <td>1,47,176</td>
            <td>11,31,267</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>15</td>
            <td>11,31,267</td>
            <td>2,30,792</td>
            <td>73,133</td>
            <td>1,57,659</td>
            <td>9,73,608</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>16</td>
            <td>9,73,608</td>
            <td>2,30,792</td>
            <td>61,904</td>
            <td>1,68,888</td>
            <td>8,04,719</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>17</td>
            <td>8,04,719</td>
            <td>2,30,792</td>
            <td>49,875</td>
            <td>1,80,917</td>
            <td>6,23,802</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>18</td>
            <td>6,23,802</td>
            <td>2,30,792</td>
            <td>36,989</td>
            <td>1,93,803</td>
            <td>4,29,999</td>
          </tr>
          <tr class="emi-calculator-odd">
            <td>19</td>
            <td>4,29,999</td>
            <td>2,30,792</td>
            <td>23,186</td>
            <td>2,07,606</td>
            <td>2,22,393</td>
          </tr>
          <tr class="emi-calculator-even">
            <td>20</td>
            <td>2,22,393</td>
            <td>2,30,792</td>
            <td>8,399</td>
            <td>2,22,393</td>
            <td>0</td>
          </tr>
        </tbody>
      </table>
      <div id="emi_data"></div>
    </div></div>-->
  </div>
</div>

<!---------------emi---------------------->
<input type="hidden" class="btn btn-clear" data-toggle="modal" data-target="#thank-youemi" id="openthankyouemi"/>
<div id="thank-youemi" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div>
              <form action="/" method="post" id="accFormEmiOtp" onsubmit="return chkformEmiOtp();" autocomplete="off">
             
              <!--<div id="otp"></div>-->
              <p class="text-center font">Enter Otp</p>
              <p id="erroremiotp1"></p>
              <p id="errorotpmsgemi"></p>
              <input type="text" name="checkemiotp" id="checkemiotp" class="form-control font-15 input-css" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
              <br />
              <input type="submit" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Submit">
              </form>
              <hr>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<script src='<?=HTACCESS_URL?>assets/js/Chart.min.js'></script>
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
#erroremi1 {
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
#erroremiotp1{
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
#errorotpmsgemi{
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
#thank-youemi .close {
    position: absolute;
    right: 10px;
    top: 7px;
}
</style>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script>
<script type="text/javascript">
//Emi
function chkformEmi() {
	
	if(isEmpty("Name",document.getElementById("emi_name").value)) {
		document.getElementById("emi_name").focus();
		document.getElementById("erroremi1").innerHTML=(" Please Enter Name* ");
		return false;
	}
	
	if(isEmpty("Mobile Number",document.getElementById("emi_mobile_no").value)) {
		document.getElementById("emi_mobile_no").focus();
		document.getElementById("erroremi1").innerHTML=(" Please Enter Mobile No.* ");
		return false;
	}

	if(document.getElementById("emi_mobile_no").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("emi_mobile_no").value;  
		  if(document.getElementById("emi_mobile_no").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;
		  }
		  
		  if(i==2){
				document.getElementById("erroremi1").innerHTML=('Please enter only 10 digits mobile number.');
				document.getElementById("emi_mobile_no").value='';
				document.getElementById("emi_mobile_no").focus();
				return false;
		  }
	}

	if(isEmpty("Email",document.getElementById("emi_email").value)) {
		document.getElementById("emi_email").focus();
		document.getElementById("erroremi1").innerHTML=(" Please Enter Email* ");
		return false;
	}

	if(!validateEmail("Email",document.getElementById("emi_email").value)) {
		document.getElementById("emi_email").focus();
		document.getElementById("erroremi1").innerHTML=(" Invalid Email ");
		return false;
	}
	
	if(isEmpty("Purpose of EMI Calculation",document.getElementById("emi_purpose_cal").value)) {
		document.getElementById("emi_purpose_cal").focus();
		document.getElementById("erroremi1").innerHTML=(" Please Select Purpose of EMI Calculation* ");
		return false;
	}
	
	submit_host_emi();  

	return false;
}


function submit_host_emi(){
	
		var form_data=$('#accFormEmi').serialize();
		
		$.ajax({
			url:"<?=HTACCESS_URL?>calculatorController.php?mode=emi",
			data:form_data,
			cache:false,
			async:false,
			success: function(data) {
					//alert(data);
					$('#openthankyouemi').click();
					//$('#otpdataEmi').val(data);

			}
			});
}

function chkformEmiOtp() {
	
	//alert(1111111);
	
	if(isEmpty("Otp",document.getElementById("checkemiotp").value)) {
		document.getElementById("checkemiotp").focus();
		document.getElementById("erroremiotp1").innerHTML=(" Please Enter Otp* ");
		document.getElementById("errorotpmsgemi").style.display = 'none';
		document.getElementById("erroremiotp1").style.display = 'block';
		return false;
	}
	
	submit_host_emi_otp();  

	return false;
}

function submit_host_emi_otp(){
	
		var form_data=$('#accFormEmiOtp').serialize();
		//alert(form_data);
		
		$.ajax({
			url:"<?=HTACCESS_URL?>calculatorController.php?mode=emiOtp",
			data:form_data,
			cache:false,
			async:false,
			success: function(data) {
					//alert(data);
					if(data==2){
					$("#errorotpmsgemi").html("Invalid Otp.");
					document.getElementById("erroremiotp1").style.display = 'none';
					document.getElementById("errorotpmsgemi").style.display = 'block';
					return false;
					} else {
						window.location.href = '<?=HTACCESS_URL?>emi-details/'+data+'/';
						//location.reload();
						}
			}
			});
}
</script>

<script>
/*var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 12;

 var oilData = {	
    datasets: [
        {
            data: [<?=$TotalIntrest?>, <?=$principal?>],
            backgroundColor: [
                "#3d6fab",
                "#d40010"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
	toolTip:{
   enabled: false,
 },
  type: 'pie',
  data: oilData
});*/


//slider 1
$('#slide-range').on('input',function () {
  //$('#slide-range').val($(this).val())
  //alert(newVal);
  var newVal = $(this).val();
  
  var tenure = document.getElementById('input-Amount2').value;
  var rate = document.getElementById('input-Amount3').value;
  
  var newRate = rate.replace('%', ''); 
  
   var interest = newRate/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMI*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Total - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
   //alert(InterestAmt);  
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US');
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
  
  var TotalAmt = '₹ ' +output3;
   
  document.getElementById("input-Amount").defaultValue = newVal;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#input-Amount").val(newVal);
  //$("#Emi").html(emi);
  //$("#Principal").html(loanAmt);
  //$("#Intrest").html(InterestAmount);
  //$("#totalAmt").html(TotalAmt);
  
  /*var loan_eligibility = document.getElementById('input-Amount').value;
  
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:rate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });*/
  
  
});

$('#input-Amount').on('input', function(){
  //console.log($(this).val())
  $('#slide-range').val($(this).val())
  var newVal = $(this).val();
  //alert(newVal);
  var tenure = document.getElementById('input-Amount2').value;
  var rate = document.getElementById('input-Amount3').value;
  
  
  var newRate = rate.replace('%', ''); 
  
   var interest = newRate/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   //alert(ratio);
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMI*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Total - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
  //alert(newRate); 
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
  
  var TotalAmt = '₹ ' +output3;
   
  document.getElementById("input-Amount").defaultValue = newVal;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#Emi").html(emi);
  $("#Principal").html(loanAmt);
  $("#Intrest").html(InterestAmount);
  $("#totalAmt").html(TotalAmt);
  
  /*var loan_eligibility = document.getElementById('input-Amount').value;
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:rate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });*/
  
});
</script>
<script>
$('#slide-range2').on('input',function () {
  
  var tenure = $(this).val();
  
  var newVal = document.getElementById('input-Amount').value;
  var rate = document.getElementById('input-Amount3').value;
  //alert(otheremi);
  
  var newRate = rate.replace('%', ''); 
  
   var interest = newRate/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMIS*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Total - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
   //alert(InterestAmt);  
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
 
  var TotalAmt = '₹ ' +output3;
   
  document.getElementById("input-Amount2").defaultValue = tenure;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#input-Amount2").val(tenure);
  $("#Emi").html(emi);
  $("#Principal").html(loanAmt);
  $("#Intrest").html(InterestAmount);
  $("#totalAmt").html(TotalAmt);

/*var oilData = {
    datasets: [
        {
            data: [InterestAmt, newVal],
            backgroundColor: [
                "#3d6fab",
                "#d40010"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});
*/

/*var loan_eligibility = document.getElementById('input-Amount').value;
  
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:rate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });*/
  
});
$('#input-Amount2').on('input', function(){
  //console.log($(this).val())
  $('#slide-range2').val($(this).val());
  var tenure = $(this).val();
  var newVal = document.getElementById('input-Amount').value;
  var rate = document.getElementById('input-Amount3').value;
  //alert(otheremi);
  
  var newRate = rate.replace('%', ''); 
  
   var interest = newRate/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMIS*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Totals - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
   //alert(InterestAmt);  
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
 
  var TotalAmt = '₹ ' +output3;
   
  document.getElementById("input-Amount2").defaultValue = tenure;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#Emi").html(emi);
  $("#Principal").html(loanAmt);
  $("#Intrest").html(InterestAmount);
  $("#totalAmt").html(TotalAmt);

/*var oilData = {
    datasets: [
        {
            data: [InterestAmt, newVal],
            backgroundColor: [
                "#3d6fab",
                "#d40010"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});*/

/*var loan_eligibility = document.getElementById('input-Amount').value;
  
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:rate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });*/
 
});
</script>
<script>
$('#slide-range3').on('input',function () {
  
  var rate = $(this).val();
  
  var newVal = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  //alert(otheremi);
  
   var newRate = rate.replace('%', ''); 
  
   var interest = parseFloat(newRate)/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMIS*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Totals - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
   
   //alert(InterestAmt);  
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
 
  var TotalAmt = '₹ ' +output3;
  
  var Rates = rate+ '%';
   
  document.getElementById("input-Amount3").defaultValue = rate;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#input-Amount3").val(Rates);
  $("#Emi").html(emi);
  $("#Principal").html(loanAmt);
  $("#Intrest").html(InterestAmount);
  $("#totalAmt").html(TotalAmt);

/*var oilData = {
    datasets: [
        {
            data: [InterestAmt, newVal],
            backgroundColor: [
                "#3d6fab",
                "#d40010"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});*/

/*var loan_eligibility = document.getElementById('input-Amount').value;
  
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:newRate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });
*/
});
$('#input-Amount3').on('input', function(){
  //console.log($(this).val())
  $('#slide-range3').val($(this).val());
  var rate = $(this).val();
  
  var newVal = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  //alert(otheremi);
  
  var newRate = rate.replace('%', ''); 
  
   var interest = parseFloat(newRate)/1200;
   var term = tenure * 12;
   var top = Math.pow((1+interest),term);
   var bottom = top - 1;
   var ratio = top/bottom;
   var EMIS = newVal * interest * ratio;
   var EMI = EMIS.toFixed(2);
   var Totals = EMIS*term;
   var Total = Totals.toFixed(2);
   var InterestAmts = Totals - newVal;
   var InterestAmt = InterestAmts.toFixed(2);
   
   //alert(InterestAmt);  
  
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(EMI);
  
  var emi = '₹ ' +output;
   
  //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output1 = nfObject.format(Math.ceil(newVal));
  
  var loanAmt = '₹ ' +output1;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output2 = nfObject.format(InterestAmt);
  
  var InterestAmount = '₹ ' +output2;
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output3 = nfObject.format(Total);
 
  var TotalAmt = '₹ ' +output3;
   
  document.getElementById("input-Amount3").defaultValue = rate;
  document.getElementById("monthly_emi").defaultValue = EMI;
  document.getElementById("intrest").defaultValue = InterestAmt;
  document.getElementById("totalPay").defaultValue = Total;
  $("#Emi").html(emi);
  $("#Principal").html(loanAmt);
  $("#Intrest").html(InterestAmount);
  $("#totalAmt").html(TotalAmt);

/*var oilData = {
    datasets: [
        {
            data: [InterestAmt, newVal],
            backgroundColor: [
                "#3d6fab",
                "#d40010"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});*/

/*var loan_eligibility = document.getElementById('input-Amount').value;
  
  $.ajax({
         url: '<?=HTACCESS_URL?>calculatorController.php?mode=fetch_table',
         type: 'post',
         data:{loan_eligibility:loan_eligibility, years:tenure, rate:newRate, emi:output},
		 //data:{form_data},
         success: function(response){
				//alert(response);
           $('#emi_data').html(response);
         } 
       });*/

});
</script>