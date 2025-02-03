<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$dbObj->dbQuery="select * from ".PREFIX."payment_receipt where user_id='".$_SESSION['user']['userid']."' and status='1' order by id desc";
$dbUserProp = $dbObj->SelectQuery();
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border wow fadeIn"> Billing <span class="themecolor"> 
          Invoice</span></h2>
          <div class="row justify-content-md-center">
          <?php if(count((array)$dbUserProp)>0){?>
            <div class="table-responsive">
              <table width="100%" class="table table-bordered table-striped m-0 pricing-2">
                <tr>
                  <th class="text-center"><h4>Title</h4></th>
                  <!--<th class="text-center"><h4>For Property</h4></th>-->
                  <th class="text-center"><h4>Invoice</h4></th>
                </tr>
                <?php for($i=0;$i<count((array)$dbUserProp);$i++){?>
                <tr>
                  <td class="text-center"><p class="m-0 pl-3">
                      <?=$dbUserProp[$i]['title']?>
                    </p></td>
                 <!-- <td class="text-center"><p class="m-0 pl-3">
                      <?=$dbUserProp[$i]['for_property']?>
                    </p></td>-->
                  <td class="text-center">
                  <a href="<?=HTACCESS_URL?>cms_images/payment_receipt/<?=$dbUserProp[$i]['upload_file']?>" target="_blank" class="btn themebg text-white theme-btn mr-3 mb-1 theme-btn2">View Invoice</a>
                  <!--<a data-fancybox="invoice-popup<?=$dbUserProp[$i]['id']?>" data-src="#invoice-popup<?=$dbUserProp[$i]['id']?>" href="javascript:;" class="btn themebg text-white theme-btn mr-3 mb-1 theme-btn2"> View Invoice </a>--></td>
                </tr>
                <?php }?>
              </table>
            </div>
            <?php }else{?>
            <p style="color:#F00;text-align:center;">No Record Found</p>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--invoice-popup-start-->
<?php for($i=0;$i<count((array)$dbUserProp);$i++){ 
 	 
	 	//get user detail
		$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbUserProp[$i]['user_id']."'";
		$dbUser = $dbObj->SelectQuery();
		
		if(!empty($dbUserProp[$i]['state'])){
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."state WHERE id='".$dbUserProp[$i]['state']."'";
		$dbState = $dbObj->SelectQuery();
		}
		
		// generate reciept number
		$znum=sprintf("%05s", $dbUserProp[$i]['id']);
		$recieptNo="CDC".$znum."";//exit;
 	
 ?>
<input type='hidden' id="is_home" value="1">
<!--contact-us-popup-->
<div id="invoice-popup<?=$dbUserProp[$i]['id']?>" style="display:none;width:100%;max-width:900px;">
  <div class="center-section-in" style="padding-top:10px;" id="invoice<?=$dbUserProp[$i]['id']?>">
    <table width="800" cellpadding="5" align="center">
      <tr>
        <th scope="col"><img src="<?=HTACCESS_URL?>assets/img/logo.png"></th>
        <th scope="col" style="text-align:right"><b>RECEIPT NO:
          <?=$recieptNo?>
          </b><br />
          DATE:
          <?=date('d-M-Y')?></th>
      </tr>
      <tr>
        <td colspan="2"><p style="margin-top:15px;">From: ClearDeals Properties<br />
            52, 1st Floor, Stadium House, 
            Navrangpura, Ahmedabad</p></td>
      </tr>
      <tr>
        <td colspan="2"><strong>RECEIVED WITH THANKS FROM</strong><br />
          <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
          <?=$dbUser[0]['name']?>
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><strong>FORM NO</strong><br />
          <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
          <?=$dbUserProp[$i]['form_no']?>
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><strong>PROPERTY NAME</strong><br />
          <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
          <?php if(!empty($dbUserProp[$i]['property_name'])){?>
          <?=$dbUserProp[$i]['property_name']?>
          <?php }?>
          <?php if(!empty($dbUserProp[$i]['prop_add'])){?>
          ,
          <?=$dbUserProp[$i]['prop_add']?>
          <?php }?>
          <?php if(!empty($dbUserProp[$i]['city'])){?>
          ,
          <?=$dbUserProp[$i]['city']?>
          <?php }?>
          <?php if(!empty($dbUserProp[$i]['state'])){?>
          ,
          <?=$dbState[0]['state_name']?>
          <?php }?>
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><strong>THE SUM OF RUPEES</strong><br />
          <span style="display:block;width:100%;margin-bottom:5px;border-bottom:1px solid #000;">
          <?=number_format($dbUserProp[$i]['amount'],2)?>
          </span> <span style="display:block; width:100%; margin-bottom:25px;">BY CHEQUE/CASH/DD</span></td>
      </tr>
      <tr>
        <td colspan="2"><strong>REMARKS</strong><br />
          <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
          <?=$dbUserProp[$i]['prop_remark']?>
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><span style="display:block;width:100%;margin-bottom:25px;padding:25px 30px;border-radius:10px;border:2px solid #ccc;font-size:130%;font-weight:700">Rs.
          <?=number_format($dbUserProp[$i]['amount'],2)?>
          </span></td>
      </tr>
      <tr>
        <td><label>
            <input type="checkbox"/>
            Please click here to calculate Total.</label></td>
        <td style="text-align:right"><p style="margin-bottom:5px"><strong>CGST 0%:</strong> 0.00</p>
          <p style="margin-bottom:5px"><strong>SGST 0%:</strong> 0.00</p>
          <p><strong>GSTIN/UIN :</strong> <span style="border-bottom:1px solid #000000;">
            <?=number_format($dbUserProp[$i]['amount'],2)?>
            </span></p></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left"><hr />
          <strong style="margin-bottom:15px; display:inline-block">Created By</strong></td>
      </tr>
      <tr style="border-bottom:1px solid #000">
        <td> ClearDeals Properties </td>
        <td style="text-align:right"> This is online receipt and doesnot require a Signature </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right"><br />
          <a href="" style="display:inline-block;padding:15px;border-radius:10px;border:2px solid #ccc;font-size:130%;font-weight:700" onclick='printDiv();'>Generate Receipt</a></td>
      </tr>
    </table>
  </div>
</div>
<script>
function printDiv() 
{
var divToPrint=document.getElementById('invoice<?=$dbUserProp[$i]['id']?>');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},10);
}
</script>
<?php }?>
<!--invoice-popup-end-->

<?php unset($_SESSION['find_msg']);?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>