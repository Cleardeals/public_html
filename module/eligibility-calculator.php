<?php include(INCLUDE_DIR.'header-2.php') ?>
<?php
$loan = 100000;
$interest = 6.90;
$months = 20 * 12;

function pmt($interest, $months, $loan) {
   $months = $months;
   $interest = $interest / 1200;
   $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
   return number_format($amount, 2);
}

//$Emi = [P*R*(1+R)^N]/[(1+R)^N-1];


$amount = pmt($interest, $months, $loan);

$monthly = 25000;
$otheremi = 0;
$Income = ((($monthly *50/100) - ($otheremi))/$amount)*100000;
$gross = ceil($Income);

//$Emi1 = $gross*$interest(1+$interest)^$months;
//$Emi2 = (1+$interest)^$months-1;
//$EMI = $Emi1/$Emi2;


// Function to calculate EMI 
function emi_calculator($p, $r, $t)
{ 
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
    $principal = $Income; // 2 lakh 50 thousands as principal
    $rate = 6.90; // 9.25 as Rate of interest per annum
    $time = 20; // 2 years as Repayment period
    $emi = emi_calculator($principal, $rate, $time); 
    //echo "Monthly EMI is = ", $emi; 
?>
<div class="center-section-in">
<div class="container">

<!--<div class="text-center mb-4 btn-2">  <a href="<?=HTACCESS_URL?>emi-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank">Home  Loan EMI Calculator </a> <a href="<?=HTACCESS_URL?>eligibility-calculator/" class="btn text-white call-bt flashing call-bt-3 mb-2" target="_blank"> Home Loan Eligiblity
    Calculator </a> <a href="<?=HTACCESS_URL?>contact/" class="btn text-white call-bt call-bt2 mb-2" target="_blank"> <i class="flaticon-phone"></i> Contact </a></div>-->
    
     <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-2">Calculate Your Home Loan <span class="themecolor">Eligibility Now </span> </h2>
<br />
<form action="/" method="post" id="accFormEligibility" onsubmit="return chkformEli();" autocomplete="off">
<!--<form action="<?=HTACCESS_URL?>calculatorController.php" method="post">-->
  <div class="row">
    <div class="col-md-5 mb-4">
      <div class="row">
        <div class="col-md-8">
          <p class="m-0 pb-0 text-uppercase">Gross Income (Monthly) Rs.</p>
        </div>
        <div class="col-md-4">
          <div class="input-amount"> <span class="unit">₹</span>
            <input id="input-Amount" name="amount" value="25000" class="input-Amount custom-range">
          </div>
        </div>
        <div class="col-md-12 mt-1 mb-2">
          <input id="slide-range" type="range" min="10000" max="10000000" step="5000" class="slider" value="25000">
        </div>
        <div class="col-6 text-left mb-3">₹ 10 K</div>
        <div class="col-6 text-right mb-3"> ₹ 1 Cr</div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <p class="m-0 pb-0 text-uppercase">Tenure (Years)</p>
        </div>
        <div class="col-md-3">
          <div class="input-amount"> <!--<span class="unit">₹</span>-->
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
          <div class="input-amount"> <!--<span class="unit">₹</span>-->
            <input id="input-Amount3" name="rate" value="6.90%" class="input-Amount">
          </div>
        </div>
        <div class="col-md-12 mt-1 mb-2">
          <input id="slide-range3" type="range" min="0" max="15" step="0.01" class="slider" value="6.90">
        </div>
        <div class="col-6 text-left mb-3">0</div>
        <div class="col-6 text-right mb-3"> 15</div>
      </div>
      <div class="row">
        <div class="col-md-8 text-uppercase">Other Emis (Monthly)</div>
        <div class="col-md-4">
          <div class="input-amount"> <span class="unit">₹</span>
            <input id="input-Amount4" name="other_emi" value="0" class="input-Amount">
          </div>
        </div>
        <div class="col-md-12 mt-1 mb-2">
          <input id="slide-range4" type="range" min="0" max="10000000" step="1" class="slider" value="0">
        </div>
        <div class="col-6 text-left mb-3">₹ 0</div>
        <div class="col-6 text-right mb-3"> ₹ 1 Cr</div>
      </div>
    </div>
    <div class="col-md-7 mb-4 text-center">
    <div>
    
    <input type="hidden" name="loan_eligibility" id="Amount1" value="<?=$gross?>">
    <input type="hidden" name="monthly_emi" id="monthlyAmount1" value="<?=$emi?>">
    
      <!--<h2 class="font-20 text-uppercase text-center mb-3"> Calculate Home Loan Eligibility </h2>-->
      <!--<form action="/" method="post" id="accFormEligibility" onsubmit="return chkformEli();" autocomplete="off">-->
        <div class="row justify-content-center">
        <div class="col-md-10"><p id="erroreli1"></p></div>
          <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control font-15 input-css" placeholder="Name">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="mobile_no" id="mobile_no" class="form-control font-15 input-css" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
          </div>
           <div class="col-md-10">
            <div class="form-group">
              <input type="text" name="email" id="email" class="form-control font-15 input-css" placeholder="Email Id">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <select name="emi_purpose" id="emi_purpose" class="form-control font-15 input-css">
                <option value=""> Purpose of EMI Calculation</option>
                <option value="Looking for a Home Loan">Looking for a Home Loan </option>
                <option value="Just to Check">Just to Check</option>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <input type="submit" id="submitbut" class="btn btn-primary subscribe-now submit-re font-15 font-weight-bold text-uppercase themebg text-white border-0 rounded-0 w-100 montserrat submit" value="Calculate Now">
            </div>
          </div>
        </div>
     <!-- </form>-->
    </div>
      <!--<div style="background:#233859; padding:20px 30px; max-width:400px; margin:0 auto; border-radius:3px">
      <small class="text-uppercase text-center text-white">Your Home Loan Eligibility</small>
      <input type="hidden" name="loan_eligibility" id="Amount1" value="<?=$gross?>">
        <h2 class="text-center text-white" id="Amount"> <span class="unit">₹</span> <?=number_format($gross,2)?></h2>
        <small class="text-center text-white">Looking for more funding/ need some help?</small><br>
        <small class="text-uppercase text-center text-white"><a href="#" class="text-white"><i class='fa fa-comment'></i> 
        Chat with us</a></small> </div>
      <div class="clearfix"></div>
      <p class="text-center mt-4 d-block">Your Home Loan EMI will be</p>
      <input type="hidden" name="monthly_emi" id="monthlyAmount1" value="<?=number_format($emi,2)?>">
      <h3 class="text-center" id="monthlyAmount">₹  <?=number_format($emi,2)?>  / <small>monthly</small></h3>
      <div class="text-center mt-40">
      <button type="submit" class="theme-btn-boder2 btn mr-1 ml-1 text-uppercase"> Apply Now </button> 
      <a href="#" class="theme-btn-boder2 btn text-uppercase" target="_blank"> Let us Contact You </a> </div>-->
    </div>
    <div class="clearfix"></div>
  </div>
  </form>
  <div class="clearfix"></div>
</div>
</div>

<!----------------eligibility------------------->
<input type="hidden" class="btn btn-clear" data-toggle="modal" data-target="#thank-you" id="openthankyoueli"/>
<div id="thank-you" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content thank-you box-css">
      <button type="button" class="close" data-dismiss="modal" id="getaquoteclose">×</button>
      <div class="modal-body">
        <div>
          <div class="right-section form-sec">
            <div>
            
              <form action="/" method="post" id="accFormEligibilityOtp" onsubmit="return chkformEliOtp();" autocomplete="off">
              <input type="hidden" name="otpdata" id="otpdata">
              <!--<div id="otp"></div>-->
              <p class="text-center font">Enter Otp</p>
              <p id="erroreliotp1"></p>
              <p id="errorotpmsg"></p>
              <input type="text" name="checkotp" id="checkotp" class="form-control font-15 input-css" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
#erroreli1 {
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
#erroreliotp1{
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
#errorotpmsg{
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
</style>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script>
<script type="text/javascript">
//eligibility
function chkformEli() {
	
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		document.getElementById("erroreli1").innerHTML=(" Please Enter Name* ");
		return false;
	}
	
	if(isEmpty("Mobile Number",document.getElementById("mobile_no").value)) {
		document.getElementById("mobile_no").focus();
		document.getElementById("erroreli1").innerHTML=(" Please Enter Mobile No.* ");
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
				document.getElementById("erroreli1").innerHTML=('Please enter only 10 digits mobile number.');
				document.getElementById("mobile_no").value='';
				document.getElementById("mobile_no").focus();
				return false;
		  }
	}

	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("erroreli1").innerHTML=(" Please Enter Email* ");
		return false;
	}

	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("erroreli1").innerHTML=(" Invalid Email ");
		return false;
	}
	
	if(isEmpty("Purpose of EMI Calculation",document.getElementById("emi_purpose").value)) {
		document.getElementById("emi_purpose").focus();
		document.getElementById("erroreli1").innerHTML=(" Please Select Purpose of EMI Calculation* ");
		return false;
	}
	
	submit_host_eli();  

	return false;
}


function submit_host_eli(){
	
		var form_data=$('#accFormEligibility').serialize();
		
		$.ajax({
			url:"<?=HTACCESS_URL?>calculatorController.php?mode=eligibility",
			data:form_data,
			cache:false,
			async:false,
			success: function(data) {
					//alert(data);
					$('#openthankyoueli').click();
					$('#otpdata').val(data);

			}
			});
}


function chkformEliOtp() {
	
	//alert(1111111);
	
	if(isEmpty("Otp",document.getElementById("checkotp").value)) {
		document.getElementById("checkotp").focus();
		document.getElementById("erroreliotp1").innerHTML=(" Please Enter Otp* ");
		document.getElementById("errorotpmsg").style.display = 'none';
		document.getElementById("erroreliotp1").style.display = 'block';
		return false;
	}
	
	submit_host_eli_otp();  

	return false;
}


function submit_host_eli_otp(){
	
		var form_data=$('#accFormEligibilityOtp').serialize();
		
		$.ajax({
			url:"<?=HTACCESS_URL?>calculatorController.php?mode=eligibilityOtp",
			data:form_data,
			cache:false,
			async:false,
			success: function(data) {
					//alert(data);
					if(data==2){
					$("#errorotpmsg").html("Invalid Otp.");
					document.getElementById("erroreliotp1").style.display = 'none';
					document.getElementById("errorotpmsg").style.display = 'block';
					return false;
					}else{
						//alert(data);
						window.location.href = '<?=HTACCESS_URL?>eligibility-detail/'+data+'/';
						//location.reload();
						}
			}
			});
}
</script>
<script>
//pmt function
function PMT(ir, np, pv, fv, type) {
    /*
     * ir   - interest rate per month
     * np   - number of periods (months)
     * pv   - present value
     * fv   - future value
     * type - when the payments are due:
     *        0: end of the period, e.g. end of month (default)
     *        1: beginning of period
     */
    var pmt, pvif;

    fv || (fv = 0);
    type || (type = 0);

    if (ir === 0)
        return -(pv + fv)/np;

    pvif = Math.pow(1 + ir, np);
    pmt = - ir * pv * (pvif + fv) / (pvif - 1);

    if (type === 1)
        pmt /= (1 + ir);

    return pmt;
}


$('#slide-range').on('input',function () {
  //$('#slide-range').val($(this).val())
  var newVal = $(this).val();
  
  var otheremi = document.getElementById('input-Amount4').value;
  var tenure = document.getElementById('input-Amount2').value;
  var rate = document.getElementById('input-Amount3').value;
  //alert(otheremi);
  
   var newRate = rate.replace('%', ''); 
  
   ir = newRate / 1200;
   np = tenure * 12;
   pv = 100000;
   pmt = PMT(ir, np, pv).toFixed(2);
   //payoff = pmt * np;
 
  //alert(pmt);
  
  var gross = newVal *50/100;
  var grossIncome = gross - otheremi;
  //var loanEli = grossIncome/pmt;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  
  //monthly emi
  var top = Math.pow((1+ir),np);
  var bottom = top - 1;
  var ratio = top/bottom;
  var EMI = newVal * ir * ratio;
  //alert(lastt);
  
  //emi
  var P1 = lastt;
  var rate1 = newRate; // pick the form input value..
  var n1 = tenure; // pick the form input value..
  var r1 = rate1/(12*100); // to calculate rate percentage..
  var prate1 = (P1 * r1 * Math.pow((1+r1),n1*12))/(Math.pow((1+r1),n1*12)-1); // to calculate compound interest..
  var emi1 = Math.ceil(prate1 * 100) / 100; // to parse emi amount..
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(lastt);
  
  if (lastt > 0) {
   var loanAmt = lastt;
  }else{
	 var loanAmt = '0'; 
	 }
  
   //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(emi1);
  
  if (lastt > 0) {
  var monthlyAmt = emi1;
  }else{
	  var monthlyAmt = '0';
	  }
	
 
  $("#input-Amount").val(newVal);
  document.getElementById("input-Amount").defaultValue = newVal;
  document.getElementById("Amount1").defaultValue = loanAmt;
  document.getElementById("monthlyAmount1").defaultValue = monthlyAmt;
  //$("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(monthlyAmt);
  
  if (lastt > 0) {
	}else{
		//alert("We are unable to show you any offers currently as your current EMIs amount is very high.");
		}
});

$('#input-Amount').on('input', function(){
  //console.log($(this).val())
  $('#slide-range').val($(this).val())
  var newVal = $(this).val();
  
  var otheremi = document.getElementById('input-Amount4').value;
  var tenure = document.getElementById('input-Amount2').value;
  var rate = document.getElementById('input-Amount3').value;
  
  var newRate = rate.replace('%', ''); 
  
  ir = newRate/1200;
 np = tenure * 12;
 pv = 100000;
 pmt = PMT(ir, np, pv).toFixed(2);
 //payoff = pmt * np;
  
  var gross = newVal *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  //alert(pmt);
  
  //emi
  var P1 = lastt;
  var rate1 = newRate; // pick the form input value..
  var n1 = tenure; // pick the form input value..
  var r1 = rate1/(12*100); // to calculate rate percentage..
  var prate1 = (P1 * r1 * Math.pow((1+r1),n1*12))/(Math.pow((1+r1),n1*12)-1); // to calculate compound interest..
  var emi1 = Math.ceil(prate1 * 100) / 100; // to parse emi amount..
  //alert(prate1);
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //output = nfObject.format(lastt);
  
  if (lastt > 0) {
  var loanAmt = lastt;
  }else{
  var loanAmt = '0';
	  }
   
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(emi1);
  
  if (lastt > 0) {
  var monthlyAmt = emi1;
  }else{
	 var monthlyAmt = '0'; 
	 }
   
  document.getElementById("input-Amount").defaultValue = newVal;
  document.getElementById("Amount1").defaultValue = loanAmt;
  document.getElementById("monthlyAmount1").defaultValue = monthlyAmt;
  //$("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(monthlyAmt);
  
  if (lastt > 0) {
	}else{
		//alert("We are unable to show you any offers currently as your current EMIs amount is very high.");
		}
  
});
</script>
<script>
$('#slide-range2').on('input',function () {
  
	var tenure = $(this).val();
	
	var otheremi = document.getElementById('input-Amount4').value;
	var income = document.getElementById('input-Amount').value;
	var rate = document.getElementById('input-Amount3').value;
  
   var newRate = rate.replace('%', ''); 
  
   ir = newRate / 1200;
   np = tenure * 12;
   pv = 100000;
   pmt = PMT(ir, np, pv).toFixed(2);
   //payoff = pmt * np;
 
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  
   //emi
  var P1 = lastt;
  var rate1 = newRate; // pick the form input value..
  var n1 = tenure; // pick the form input value..
  var r1 = rate1/(12*100); // to calculate rate percentage..
  var prate1 = (P1 * r1 * Math.pow((1+r1),n1*12))/(Math.pow((1+r1),n1*12)-1); // to calculate compound interest..
  var emi1 = Math.ceil(prate1 * 100) / 100; // to parse emi amount..
  
  
   //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //output = nfObject.format(lastt);
  
  var loanAmt = '₹ ' +lastt;
  
  //comma as thousand separator
 // nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(income);
  
  var newVals = '₹ ' +income+ ' / monthly';

  $("#input-Amount2").val(tenure);
  document.getElementById("input-Amount2").defaultValue = tenure;
  document.getElementById("Amount1").defaultValue = lastt;
  //document.getElementById("monthlyAmount1").defaultValue = outputs;
  $("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
});
$('#input-Amount2').on('input', function(){
  //console.log($(this).val())
  $('#slide-range2').val($(this).val());
  var tenure = $(this).val();
   var otheremi = document.getElementById('input-Amount4').value;
  var income = document.getElementById('input-Amount').value;
  var rate = document.getElementById('input-Amount3').value;
  var newRate = rate.replace('%', ''); 
   ir = newRate / 1200;
 np = tenure * 12;
 pv = 100000;
 pmt = PMT(ir, np, pv).toFixed(2);
 //payoff = pmt * np;
 //alert(pmt);
 
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  
   //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //output = nfObject.format(lastt);
  
   var loanAmt = '₹ ' +lastt;
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(income);
  
  var newVals = '₹ ' +income+ ' / monthly';

 // $("#input-Amount2").val(tenure);
 document.getElementById("input-Amount2").defaultValue = tenure;
 document.getElementById("Amount1").defaultValue = lastt;
  //document.getElementById("monthlyAmount1").defaultValue = outputs;
  $("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
});
</script>
<script>
$('#slide-range3').on('input',function () {
  
  var rate = $(this).val();
  
  var otheremi = document.getElementById('input-Amount4').value;
  var income = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  
  var newRate = rate.replace('%', ''); 
  
  ir = newRate / 1200;
  np = tenure * 12;
  pv = 100000;
  pmt = PMT(ir, np, pv).toFixed(2);
  //payoff = pmt * np;
  //alert(pmt);
  
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(lastt);
  
  var loanAmt = '₹ ' +output;
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(income);
  
  var newVals = '₹ ' +income+ ' / monthly';
  var rates = rate+ '%';

  $("#input-Amount3").val(rates);
  document.getElementById("input-Amount3").defaultValue = rates;
  document.getElementById("Amount1").defaultValue = lastt;
  //document.getElementById("monthlyAmount1").defaultValue = outputs;
  $("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
});
$('#input-Amount3').on('input', function(){
  //console.log($(this).val())
  $('#slide-range3').val($(this).val());
  var rate = $(this).val();
  //alert(rate);
  var otheremi = document.getElementById('input-Amount4').value;
  var income = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  
  var newRate = rate.replace('%', '');
  
  ir = parseFloat(newRate) / 1200;
  np = tenure * 12;
  pv = 100000;
  pmt = PMT(ir, np, pv).toFixed(2);
  //payoff = pmt * np;
  //alert(pmt);
  
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  //alert(lastt);
  
   //comma as thousand separator
  nfObject = new Intl.NumberFormat('en-US'); 
  output = nfObject.format(lastt);
  
   var loanAmt = '₹ ' +output;
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(income);
  
  var newVals = income;
  var rates = rate+ '%';
  
  $("#input-Amount3").val(rate);
  document.getElementById("input-Amount3").defaultValue = rate;
  document.getElementById("Amount1").defaultValue = lastt;
  //document.getElementById("monthlyAmount1").defaultValue = outputs;
  $("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
});
</script>
<script>
$('#slide-range4').on('input',function () {
  
  var otheremi = $(this).val();
  
  var rate = document.getElementById('input-Amount3').value;
  var income = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  
  var newRate = rate.replace('%', '');
  
  ir = newRate / 1200;
  np = tenure * 12;
  pv = 100000;
  pmt = PMT(ir, np, pv).toFixed(2);
  //payoff = pmt * np;
  //alert(pmt);
  
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  //alert(lastt);
  
    //emi
  var P1 = lastt;
  var rate1 = newRate; // pick the form input value..
  var n1 = tenure; // pick the form input value..
  var r1 = rate1/(12*100); // to calculate rate percentage..
  var prate1 = (P1 * r1 * Math.pow((1+r1),n1*12))/(Math.pow((1+r1),n1*12)-1); // to calculate compound interest..
  var emi1 = Math.ceil(prate1 * 100) / 100; // to parse emi amount..
  
    //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //output = nfObject.format(lastt);
  if (lastt > 0) {
   var loanAmt = lastt;
  }else{
	var loanAmt = '0';  
	 }
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //outputs = nfObject.format(emi1);
  
   if (lastt > 0) {
  var newVals = emi1;
   }else{
	  var newVals = '0'; 
	  }
  document.getElementById("input-Amount4").defaultValue = otheremi;
  document.getElementById("Amount1").defaultValue = loanAmt;
  document.getElementById("monthlyAmount1").defaultValue = newVals;
  $("#input-Amount4").val(otheremi);
  //$("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
  
  if (lastt > 0) {
	}else{
		//alert("We are unable to show you any offers currently as your current EMIs amount is very high.");
		}
 
});
$('#input-Amount4').on('input', function(){
  //console.log($(this).val())
  $('#slide-range4').val($(this).val());
  
  var otheremi = $(this).val();
  
  var rate = document.getElementById('input-Amount3').value;
  var income = document.getElementById('input-Amount').value;
  var tenure = document.getElementById('input-Amount2').value;
  
  var newRate = rate.replace('%', '');
  
  ir = newRate / 1200;
  np = tenure * 12;
  pv = 100000;
  pmt = PMT(ir, np, pv).toFixed(2);
  //payoff = pmt * np;
  //alert(pmt);
  
  var gross = income *50/100;
  var grossIncome = gross - otheremi;
  var loanEli = grossIncome/pmt;
  var Last = loanEli * 100000 * -1;
  var lastt = Last.toFixed(2);
  //var lastt = Math.ceil(Last);
  //alert(lastt);
  
   //emi
  var P1 = lastt;
  var rate1 = newRate; // pick the form input value..
  var n1 = tenure; // pick the form input value..
  var r1 = rate1/(12*100); // to calculate rate percentage..
  var prate1 = (P1 * r1 * Math.pow((1+r1),n1*12))/(Math.pow((1+r1),n1*12)-1); // to calculate compound interest..
  var emi1 = Math.ceil(prate1 * 100) / 100; // to parse emi amount..
  
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US'); 
  //output = nfObject.format(lastt);
  if (lastt > 0) {
  var loanAmt = lastt;
  }else{
	  var loanAmt = '0';
	 }
  
  //comma as thousand separator
  //nfObject = new Intl.NumberFormat('en-US');
  //outputs = nfObject.format(emi1);
  if (lastt > 0) {
  var newVals = emi1;
  }else{
   var newVals = '0'; 
	}
  document.getElementById("input-Amount4").defaultValue = otheremi;
  document.getElementById("Amount1").defaultValue = loanAmt;
  document.getElementById("monthlyAmount1").defaultValue = newVals;
  //$("#Amount").html(loanAmt);
  //$("#monthlyAmount").html(newVals);
  if (lastt > 0) {
	}else{
		//alert("We are unable to show you any offers currently as your current EMIs amount is very high.");
		}
});

</script>

