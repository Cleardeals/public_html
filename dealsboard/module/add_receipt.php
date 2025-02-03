<?php
login_check(); ///to check weatther user is login or not
access_check('add_receipt');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."receipt where id='".$id."' ";
$dbReceipt = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<style type="text/css">
input[type=text] {
	border: none;
	border-bottom: 1px solid black;
	width: 100%;
}
</style>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

<body class="fix-header card-no-border fix-sidebar">

<!-- ============================================================== --> 

<!-- Main wrapper - style you can find in pages.scss --> 

<!-- ============================================================== -->

<div id="main-wrapper"> 
  
  <!-- ============================================================== --> 
  
  <!-- Topbar header - style you can find in pages.scss --> 
  
  <!-- ============================================================== -->
  
  <?php include(ADMIN_INCLUDE_DIR.'header.php'); ?>
  
  <!-- ============================================================== --> 
  
  <!-- End Topbar header --> 
  
  <!-- ============================================================== --> 
  
  <!-- ============================================================== --> 
  
  <!-- Left Sidebar - style you can find in sidebar.scss  --> 
  
  <!-- ============================================================== -->
  
  <?php include(ADMIN_INCLUDE_DIR.'left_menu.php'); ?>
  
  <!-- ============================================================== --> 
  
  <!-- End Left Sidebar - style you can find in sidebar.scss  --> 
  
  <!-- ============================================================== --> 
  
  <!-- ============================================================== --> 
  
  <!-- Page wrapper  --> 
  
  <!-- ============================================================== -->
  
  <div class="page-wrapper"> 
    
    <!-- ============================================================== --> 
    
    <!-- Container fluid  --> 
    
    <!-- ============================================================== -->
    
    <div class="container-fluid"> 
      
      <!-- Start Page Content --> 
      
      <!-- ============================================================== -->
      
      <div class="row" id="main" style="margin-top:20px;">
        <div class="col-lg-6">
          <?php if(!empty($id)){?>
          <a href="#" onclick='printDiv();' style="font-size:16px;">Print</a>
          <?php }?>
        </div>
        <div class="col-lg-6"> 
          
          <!--<p style="text-align:right"><a href="index.php?mo=mnr"> Go Back</a></p>--> 
          
        </div>
        <div class="col-lg-12">
          <div class="panel panel-info" id="dvContents">
            <div class="panel-heading">
              <div style="float:left; width:50%"><img src="assets/images/logo.png" width="300"> <br />
                <br />
                <div style="font-size:12px; padding-left:10px;">From: ClearDeals Properties <br />
                  Satellite, Ahmedabad.</div>
              </div>
              <div style="float:right; text-align:center; color:#000; width:20%"><strong>RECEIPT NO:
                <?=$dbReceipt[0]['recep_no'] ?? ""?>
                </strong><br>
                <strong>DATE:
                <?=(!empty($dbReceipt[0]['recp_date']))?date('d-M-Y',strtotime($dbReceipt[0]['recp_date'])):''?>
                </strong> </div>
              <p style="clear:both;"></p>
            </div>
            <form action="receiptController.php" method="post" id="accForm" onSubmit="return ckhform()">
              <input type="hidden" name="mode" value="generatemnr"  />
              <input type="hidden" name="info[cgst]" id="cgst" value="0"  />
              <input type="hidden" name="info[sgst]" id="sgst" value="0"  />
              <input type="hidden" name="info[finaltotal]" id="finaltotal" value="<?=$dbReceipt[0]['finaltotal'] ?? ""?>"  />
              <input type="hidden" name="id" value="<?=$id?>"  />
              <div class="panel-body" >
                <div class="row" >
                  <div class="col-lg-4 ">RECEIVED WITH THANKS FROM</div>
                  <div class="col-lg-8 ">
                    <input  type="text" name="info[recfrom]" id="recfrom" value="<?=$dbReceipt[0]['recfrom'] ?? ""?>" placeholder="">
                  </div>
                </div>
                <br />
                <div class="row" >
                  <div class="col-lg-2 ">FORM NO</div>
                  <div class="col-lg-10 ">
                    <input  type="text" name="info[c_num]" id="c_num" value="<?=$dbReceipt[0]['c_num'] ?? ""?>"  placeholder="">
                  </div>
                </div>
                <br />
                <div class="row" >
                  <div class="col-lg-3 ">PROPERTY NAME</div>
                  <div class="col-lg-9 ">
                    <input  type="text" name="info[transno]" id="transno" value="<?=$dbReceipt[0]['transno'] ?? ""?>"  placeholder="">
                  </div>
                </div>
                <br />
                <div class="row" >
                  <div class="col-lg-3 ">THE SUM OF RUPEES</div>
                  <div class="col-lg-6 ">
                    <input  type="text" name="info[rateg]" id="rateg"  value="<?=$dbReceipt[0]['rateg'] ?? ""?>"  placeholder="">
                  </div>
                  <div class="col-lg-3 ">BY CHEQUE/CASH/DD</div>
                </div>
                <br />
                <div class="row" >
                  <div class="col-lg-3 ">REMARK</div>
                  <div class="col-lg-9 ">
                    <input  type="text" name="info[remark]" id="remark" value="<?=$dbReceipt[0]['remark'] ?? ""?>" placeholder="">
                  </div>
                </div>
                <div class="row" style="height:20px; clear:both;">&nbsp;</div>
                <div class="row" >
                  <div class="col-lg-3 ">
                    <div class="well">Rs. <span id="rst">
                      <?=$dbReceipt[0]['finaltotal'] ?? ""?>
                      </span></div>
                  </div>
                  <div class="col-lg-9 " style="text-align:right;">
                    <label>CGST 0%: </label>
                    <span id="cgstv">
                    <?=$dbReceipt[0]['cgst'] ?? ""?>
                    </span><br />
                    <label>SGST 0%: </label>
                    <span id="sgstv">
                    <?=$dbReceipt[0]['sgst'] ?? ""?>
                    </span><br />
                    <label>GSTIN/UIN :</label>
                    <span>
                    <input  type="text" name="info[cgstin]" id="cgstin" value="<?=$dbReceipt[0]['cgstin'] ?? ""?>" style="width:100px" placeholder="">
                    </span></div>
                </div>
                <p>
                  <input type="checkbox" onClick="calculate()"  />
                  Please click here to calculate Total.</p>
              </div>
              <div class="panel-footer">
                <div style="float:left; width:50%; text-align:left;">
                  <p><strong>Created By </strong></p>
                  <p style="border-bottom:solid 1px #000; padding-top:20px;">
                    <?=$dbReceipt[0]['createdby'] ?? ""?>
                  </p>
                </div>
                <div style="float:right; width:50%; text-align:right;">
                  <p><strong>&nbsp;</strong></p>
                  <p style="border-bottom:solid 1px #000;padding-top:20px;">This is online receipt and doesnot require a Signature</p>
                </div>
                <p style="clear:both;"></p>
                <div style="float:right; width:50%; text-align:right;">
                  <button type="submit" class="btn btn-info">Generate Receipt</button>
                </div>
                <p style="clear:both;"></p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="printing" class="w3-modal" style="display:none">
        <div class="w3-modal-content">
          <div class="w3-container">
            <div class="center-section-in" style="padding-top:10px;">
              <table width="800" cellpadding="5" align="center">
                <tr>
                  <th scope="col"><img src="<?=HTACCESS_URL?>assets/img/logo.png"></th>
                  <th scope="col" style="text-align:right"><b>RECEIPT NO:
                    <?=$dbReceipt[0]['recep_no'] ?? ""?>
                    </b><br />
                    DATE:
                    <?=(!empty($dbReceipt[0]['recp_date']))?date('d-M-Y',strtotime($dbReceipt[0]['recp_date'])):''?></th>
                </tr>
                <tr>
                  <td colspan="2"><p style="margin-top:15px;">From: ClearDeals Properties<br />
                      Satellite, Ahmedabad. </p></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>RECEIVED WITH THANKS FROM</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbReceipt[0]['recfrom'] ?? ""?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>FORM NO</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbReceipt[0]['c_num'] ?? ""?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>PROPERTY NAME</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbReceipt[0]['transno'] ?? ""?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>THE SUM OF RUPEES</strong><br />
                    <span style="display:block;width:100%;margin-bottom:5px;border-bottom:1px solid #000;">
                    <?=$dbReceipt[0]['rateg'] ?? ""?>
                    </span> <span style="display:block; width:100%; margin-bottom:25px;">BY CHEQUE/CASH/DD</span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>REMARKS</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbReceipt[0]['remark'] ?? ""?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><span style="display:block;width:100%;margin-bottom:25px;padding:25px 30px;border-radius:10px;border:2px solid #ccc;font-size:130%;font-weight:700">Rs.
                    <?=$dbReceipt[0]['finaltotal'] ?? ""?>
                    </span></td>
                </tr>
                <tr>
                  <td><label>
                      <input type="checkbox"/>
                      Please click here to calculate Total.</label></td>
                  <td style="text-align:right"><p style="margin-bottom:5px"><strong>CGST 0%:</strong> <span id="cgstv">
                      <?=$dbReceipt[0]['cgst'] ?? ""?>
                      </span></p>
                    <p style="margin-bottom:5px"><strong>SGST 0%:</strong> <span id="sgstv">
                      <?=$dbReceipt[0]['sgst'] ?? ""?>
                      </span></p>
                    <p><strong>GSTIN/UIN :</strong> <span style="border-bottom:1px solid #000000;">
                      <?=$dbReceipt[0]['cgstin'] ?? ""?>
                      </span></p></td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align:left"><hr />
                    <strong style="margin-bottom:15px; display:inline-block">Created By</strong></td>
                </tr>
                <tr style="border-bottom:1px solid #000">
                  <td><?=$dbReceipt[0]['createdby'] ?? ""?></td>
                  <td style="text-align:right"> This is online receipt and doesnot require a Signature </td>
                </tr>
                <!-- <tr>
                  <td colspan="2" style="text-align:right"><br />
                    <a href="" style="display:inline-block;padding:15px;border-radius:10px;border:2px solid #ccc;font-size:130%; font-weight:700" onclick='printDiv();'>Generate Receipt</a></td>
                </tr>-->
              </table>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- ============================================================== --> 
      
      <!-- End PAge Content --> 
      
      <!-- ============================================================== --> 
      
      <!-- ============================================================== --> 
      
      <!-- Right sidebar --> 
      
      <!-- ============================================================== --> 
      
      <!-- .right-sidebar --> 
      
      <!-- ============================================================== --> 
      
      <!-- End Right sidebar --> 
      
      <!-- ============================================================== --> 
      
    </div>
    
    <!-- ============================================================== --> 
    
    <!-- End Container fluid  --> 
    
    <!-- ============================================================== --> 
    
    <!-- ============================================================== --> 
    
    <!-- footer --> 
    
    <!-- ============================================================== -->
    
    <?php include(ADMIN_INCLUDE_DIR.'footer.php'); ?>
    
    <!-- ============================================================== --> 
    
    <!-- End footer --> 
    
    <!-- ============================================================== --> 
    
  </div>
  
  <!-- ============================================================== --> 
  
  <!-- End Page wrapper  --> 
  
  <!-- ============================================================== --> 
  
</div>

<!-- ============================================================== --> 

<!-- End Wrapper --> 

<!-- ============================================================== --> 

<!-- ============================================================== --> 

<!-- All Jquery --> 

<!-- ============================================================== --> 

<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css"/>
<script src="assets/vendors/sticky-sidebar/stickySidebar.js"></script> 
<script>
function printDiv(){
var divToPrint=document.getElementById('printing');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},10);
}
</script> 
<script>
$(document).ready(function() {
	$('#sidebar').stickySidebar({
		sidebarTopMargin: 0,
		footerThreshold: 100
	});
});
</script> 
<script>
$(document).ready(function(){

	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").find(".fa").addClass("fa-caret-up").removeClass("fa-caret-down");
	});

	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
	});
});
</script> 
<script type="text/javascript">
function ckhform(){

	if(isEmpty("RECEIVED WITH THANKS FROM",document.getElementById("recfrom").value)){
		document.getElementById("recfrom").focus();
		return false;
	}

	if(isEmpty("FORM NUMBER",document.getElementById("c_num").value)){
		document.getElementById("c_num").focus();
		return false;
	}

	if(isEmpty("PROPERTY NAME",document.getElementById("transno").value)){
		document.getElementById("transno").focus();
		return false;
	}

	if(isEmpty("THE SUM OF RUPEES",document.getElementById("rateg").value)){
		document.getElementById("rateg").focus();
		return false;
	}

	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}

function calculate(){
	var amount = document.getElementById('rateg').value;
	var cgstin = document.getElementById('cgstin').value;
	
	if(cgstin==''){
		var rst = Number(amount);
		document.getElementById('rst').innerHTML = rst.toFixed(2);
		document.getElementById('finaltotal').value = rst.toFixed(2);
	} else {
		var cgst = (Number(amount)*0)/100;
		var sgst = (Number(amount)*0)/100;
		var rst = Number(amount)+Number(cgst)+Number(sgst);

		document.getElementById('cgstv').innerHTML = cgst.toFixed(2);
		document.getElementById('sgstv').innerHTML = sgst.toFixed(2);
		document.getElementById('rst').innerHTML = rst.toFixed(2);
		document.getElementById('cgst').value = cgst.toFixed(2);
		document.getElementById('sgst').value = sgst.toFixed(2);
		document.getElementById('finaltotal').value = rst.toFixed(2);
	}
}

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});

function getstate(stateID){
	 $.ajax({
		  url:'propertyController.php?mode=getcity',
		  data:'stateID='+stateID,
		  success:function(response){
		  //alert(response);
		  $('#selectcity').html(response);
		}
	});
}

function getcity(cityID){
	 $.ajax({
		  url:'propertyController.php?mode=getlocation',
		  data:'cityID='+cityID,
		  success:function(response){
		  //alert(response);
		  $('#selectlocation').html(response);
		}
	});
}

function specifyTiming(dropval){
	if(dropval== 'specify Timing'){
		document.getElementById('userdiv').style.display = 'block';
	}else{
		document.getElementById('userdiv').style.display = 'none';
	}
};

function forProperty(dropval){
	if(dropval== 'Rent'){
		document.getElementById('accordion8').style.display = 'block';
		document.getElementById('accordion7').style.display = 'none';
	} else if(dropval== 'Sell'){
		document.getElementById('accordion8').style.display = 'none';
		document.getElementById('accordion7').style.display = 'block';
	}else{
		document.getElementById('accordion8').style.display = 'none';
		document.getElementById('accordion7').style.display = 'block';
	}
};
</script> 
<script>
$(document).ready(function() {
$('#example-getting-started').multiselect({
includeSelectAllOption: true,
maxHeight: 400,
dropUp: true
});
});


$(document).ready(function() {
$('#example-getting-started1').multiselect({
includeSelectAllOption: true,
maxHeight: 400,
dropUp: true
});
});
</script>