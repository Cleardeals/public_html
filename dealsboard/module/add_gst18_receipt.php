<?php
login_check(); ///to check weatther user is login or not
// access_check('add_gst_receipt');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

$dbObj->dbQuery = "SELECT * FROM clear_gst18_receipt where id='".$id."' ";
$dbReceipt = $dbObj->SelectQuery('edithome.php','aboutEdit()');

$dbObj->dbQuery = "SELECT * FROM clear_gst18_receipt order by id desc";
$dbInvoice = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<style type="text/css">
.form-control {
	border-radius: 0 !important;
}
input[type=text] {
	border: none;
	border-bottom: 1px solid black;
	width: 95%;
}
table {
	font-size: 15px;
}
textarea {
	border: none;
	border-bottom: 1px solid black;
	width: 95%;
}
form label {
	margin-bottom: 0;
}
/* print styles */
@media print {
.text-css {
	line-height: 40px;
}
table {
	font-family: Arial, Helvetica, sans-serif;
}
body {
	font-family: Arial, Helvetica, sans-serif;
}
input[type=text], input[type=number] {
	border: none !important;
	outline: none !important;
}
}
</style>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            <form action="gst18ReceiptController.php" method="post" id="accForm" onSubmit="return ckhform()">
              <input type="hidden" name="mode" value="generatemnr" />
              <input type="hidden" name="id" value="<?=$id?>" />
              <table width="1010px" border="0" cellspacing="0" cellpadding="0" align="center" style="border:solid 2px #0c0b0b">
                <tr>
                  <td><table align="center" cellpadding="5" cellspacing="0" width="100%">
                      <tr height="21">
                        <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>&nbsp;</td>
                              <td width="53%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="100%"><img src="assets/images/logo-main.png" style="float:left;margin-left:15px;" width="150px" alt="" />
                                <h2 style="margin-left:40%;">TAX INVOICE</h2></td>
                              
                              <!-- <td width="30%" align="center" style="font-size:25px;font-weight:600;">TAX INVOICE </td> --> 
                              
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <!-- <tr>
                                <td>&nbsp;</td>
                                <td width="53%">&nbsp;</td>
                            </tr> -->
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td width="53%">&nbsp;</td>
                            </tr>
                            <tr style="border-top:solid 2px #000;" bgcolor="#c5e0b2">
                              <td width="100%" align="center" style="padding:2% 0%;"><h2 style="margin:0; padding:0; font-size:25px; line-height:35px"> Proptech Cleardeals Private Limited</h2>
                                <strong style="margin:0; padding:0; font-size:14px">208,
                                
                                Aditya Plaza Complex, Jodhpur Gam
                                
                                Road, </strong><br>
                                <strong style="margin:0; padding:0; font-size:14px">Satellite,
                                
                                Ahmedabad 380015</strong> <br>
                                <strong style="margin:0; padding:0; font-size:14px">GSTIN
                                
                                : 24AALCP6823C1ZJ</strong></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
                <tr style="border-bottom: solid 2px #000;">
                  <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr>
                              <td>&nbsp;<strong>Bill To :</strong> &nbsp;&nbsp;</td>
                              <td bgcolor="#ffffff"><textarea style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-top:20px; width:100%"  name="info[name]" id="name" rows="4"><?=$dbReceipt[0]['name'] ?? ""?> </textarea></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr>
                              <td>&nbsp;<strong>GSTIN No : </strong>&nbsp;&nbsp;</td>
                              <td bgcolor="#ffffff"><input type="text" name="info[gstin]" id="gstin" value="<?=$dbReceipt[0]['gstin'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td><table>
                            <tr>
                              <td width="30%">&nbsp;&nbsp;<strong>Place of Supply : </strong></td>
                              <td width="50%"><textarea style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-top:20px; width:100%" name="info[address]" id="address" rows="4"><?=$dbReceipt[0]['address'] ?? ""?></textarea></td>
                              <td width="5%">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><h5><strong>Invoice No.</strong></h5></td>
                      </tr>
                      <tr style="border-bottom:solid 1px #000;">
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center" style="margin:5%;">
                        <td><input type="text" style="width:110px;text-align:center;" name="info[invoice_no]" id="invoice_no" value="<?=$dbReceipt[0]['invoice_no'] ?? ""?>"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><h5><strong>Dated</strong></h5></td>
                      </tr>
                      <tr style="border-bottom:solid 1px #000;">
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><input type="text" style="width:100px;text-align:center;" name="info[invoice_date]" id="invoice_date" value="<?php if(!empty($dbReceipt[0]['invoice_date'])){?><?=$dbReceipt[0]['invoice_date']?><?php }else{?><?=date('Y-m-d')?><?php }?>"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
                <tr style="font-weight:600;border-bottom:solid 1px #000;">
                  <td width="30%" style="border-right:solid 1px #000;padding:1% 0%;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;&nbsp;&nbsp;<strong>Description of Goods</strong></td>
                      </tr>
                    </table></td>
                  <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center">
                      <tr height="100%">
                        <td width="40%" align="center">HSN CODE</td>
                        <td width="25%" align="center">QTY</td>
                        <td width="25%" align="center">Units</td>
                        <td width="10%" align="center">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="15%" style="border-right:solid 1px #000;" align="center"> RATE&nbsp;&nbsp;&nbsp;<img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="13" alt=""></td>
                  <td width="15%" style="border-right:solid 1px #000;" align="center"> Amount (Rs) </td>
                </tr>
              </table>
              <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
                <tr>
                  <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                            <tr>
                              <td>&nbsp;&nbsp;<input placeholder="" type="text" name="info[desc]" id="desc" style="width: 250px;" value="<?=$dbReceipt[0]['desc'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="font-weight:600;">
                        <td><table>
                            <tr>
                              <td>&nbsp;&nbsp;Taxable Value</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="font-weight:600;">
                        <td><table>
                            <tr>
                              <td>&nbsp;&nbsp;ADD CGST 9%</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="font-weight:600;">
                        <td><table>
                            <tr>
                              <td>&nbsp;&nbsp;ADD SGST 9%</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr>
                              <td>&nbsp;&nbsp;Rounding (Rs.)</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="vertical-align: middle;">
                        <td><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                            <tr height="100%">
                              <td width="40%" align="center"><input style="width:80px;text-align: center;" placeholder="" type="text" name="info[hsn_code]" id="hsn_code" value="<?=$dbReceipt[0]['hsn_code'] ?? ""?>"></td>
                              <td width="25%" align="center"><input style="width:80px;text-align: center;" placeholder="" type="text" name="info[qty]" id="qty" value="<?=$dbReceipt[0]['qty'] ?? ""?>"></td>
                              <td width="25%" align="center"><input style="width:80px;text-align: center;" placeholder="" type="text" name="info[units]" id="units" value="<?=$dbReceipt[0]['units'] ?? ""?>"></td>
                              <td width="10%" align="center"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><input style="width:80px;text-align:center;" placeholder="" type="text" name="info[rate]" id="rate" value="<?=$dbReceipt[0]['rate'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td>9%</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td>9%</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><!-- <?php  // $i = $dbReceipt[0]['rate']*$dbReceipt[0]['qty']*$dbReceipt[0]['units']; ?> -->
                                
                                <input style="width:80px;text-align:center;margin-bottom: 12px;" placeholder="" type="text" name="info[multiplication]" class="amount" value="<?=$dbReceipt[0]['multiplication'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><input style="width:80px;text-align:center;" placeholder="" type="text" name="info[multiplication]" class="amount" value="<?=$dbReceipt[0]['multiplication'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      
                      <!-- <tr> <td>&nbsp;</td></tr> -->
                      
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><!-- <?php //$x = ($dbReceipt[0]['amount']*9)/100;?> -->
                                
                                <input style="width:80px;text-align:center;" placeholder="" type="text" name="info[gst9]" class="gst" value="<?=$dbReceipt[0]['gst9'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><input style="width:80px;text-align:center;" placeholder="" type="text" name="info[gst9]" class="gst" value="<?=$dbReceipt[0]['gst9'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><!-- <?php
                                                           // $y = $x*2 + $i; 
                                                          //  $total = round($y);
                                                        ?> -->
                          
                          <input style="width:80px;text-align:center;" placeholder="" type="text" name="info[rounding]" id="total" value="<?=$dbReceipt[0]['rounding'] ?? ""?>"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr style="border-top:solid 2px #000;" bgcolor="#c5e0b2">
                  <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="10%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><h4>Total&nbsp;&nbsp;&nbsp;<img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="13" alt=""></h4></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  <td width="20%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr align="center">
                        <td><table>
                            <tr>
                              <td><input style="width:80px;background-color:transparent;text-align:center;" placeholder="" type="text" name="info[amount]" id="final" value="<?=$dbReceipt[0]['amount'] ?? ""?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
                <tr>
                  <td width="70%"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr>
                              <td>&nbsp;&nbsp;Amount Chargeable (in words) </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr style="font-weight:600;">
                        <td>&nbsp;&nbsp;Rupees : <br>
                          &nbsp;
                          <textarea style="font-weight:400;border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-top:10px; width:500px;" name="info[amount_word]" id="amount_word" rows="2"><?=$dbReceipt[0]['amount_word'] ?? ""?></textarea></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr style="font-weight:600;">
                              <td>&nbsp;&nbsp;PAN : AALCP6823C</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="30%" style="border-right:solid 1px #000;border-left:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr align="center">
                              <td> Ceritified that the particulars given above are true
                                
                                and correct. </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr style="border-bottom:solid 1px #000;">
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td><table>
                            <tr align="center">
                              <td> For Proptech Cleardeals Private Limited </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr style="border-bottom:solid 1px #000;">
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table>
                            <tr align="center">
                              <td> This is a computarised receipt and doesn't require a
                                
                                signature. </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <div style="text-align:center"> <br>
                <br>
                <button type="submit" class="btn btn-info">Generate Receipt</button>
                <br>
                <br>
              </div>
            </form>
          </div>
        </div>
        <div id="printing" class="w3-modal" style="display:none">
          <table width="1010px" border="0" cellspacing="0" cellpadding="0" align="center" style="border:solid 2px #0c0b0b">
            <tr>
              <td><table align="center" cellpadding="5" cellspacing="0" width="100%">
                  <tr height="21">
                    <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;</td>
                          <td width="53%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="100%"><img src="assets/images/logo-main.png" style="float:left;margin-left:15px;" width="150px" alt="" />
                            <h2 style="margin-left:40%;">TAX INVOICE</h2></td>
                          
                          <!-- <td width="30%" align="center" style="font-size:25px;font-weight:600;">TAX INVOICE </td> --> 
                          
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <!-- <tr>
                              <td>&nbsp;</td>
                              <td width="53%">&nbsp;</td>
                          </tr> -->
                        
                        <tr>
                          <td>&nbsp;</td>
                          <td width="53%">&nbsp;</td>
                        </tr>
                        <tr style="border-top:solid 2px #000;" bgcolor="#c5e0b2">
                          <td width="100%" align="center" style="padding:2% 0%;"><h2 style="margin:0; padding:0; font-size:25px; line-height:35px"> Proptech Cleardeals Private Limited</h2>
                            <strong style="margin:0; padding:0; font-size:14px">208,
                            
                            Aditya Plaza Complex, Jodhpur Gam Road, </strong><br>
                            <strong style="margin:0; padding:0; font-size:14px">Satellite,
                            
                            Ahmedabad 380015</strong> <br>
                            <strong style="margin:0; padding:0; font-size:14px">GSTIN
                            
                            : 24AALCP6823C1ZJ</strong></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
            <tr style="border-bottom: solid 2px #000;">
              <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr>
                          <td>&nbsp;<strong>Bill To :</strong> &nbsp;&nbsp;</td>
                          <td><textarea style="font-family: Arial, Helvetica, sans-serif;border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-top:20px; width:100%" name="info[name]" id="name" rows="4"><?=$dbReceipt[0]['name'] ?? ""?></textarea></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr>
                          <td>&nbsp;<strong>GSTIN No : </strong>&nbsp;&nbsp;</td>
                          <td><input type="text" name="info[gstin]" style="border: none;" id="gstin" value="<?=$dbReceipt[0]['gstin'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td><table>
                        <tr>
                          <td width="30%">&nbsp;&nbsp;<strong>Place of Supply : </strong></td>
                          <td width="50%"><textarea style="font-family: Arial, Helvetica, sans-serif;border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-top:20px; width:100%" name="info[address]" id="address" rows="4"><?=$dbReceipt[0]['address'] ?? ""?></textarea></td>
                          <td width="5%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><h5><strong>Invoice No.</strong></h5></td>
                  </tr>
                  <tr style="border-bottom:solid 1px #000;">
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center" style="margin:5%;">
                    <td><input type="text" style="width:110px;text-align:center;border: none;" name="info[invoice_no]" id="invoice_no" value="<?=$dbReceipt[0]['invoice_no'] ?? ""?>"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><h5><strong>Dated</strong></h5></td>
                  </tr>
                  <tr style="border-bottom:solid 1px #000;">
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><input type="text" style="width:100px;text-align:center;border: none;" name="info[invoice_date]" id="invoice_date" value="<?php if(!empty($dbReceipt[0]['invoice_date'])){?><?=$dbReceipt[0]['invoice_date']?><?php }else{?><?=date('Y-m-d')?><?php }?>"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
            <tr style="font-weight:600;border-bottom:solid 1px #000;">
              <td width="30%" style="border-right:solid 1px #000;padding:1% 0%;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;&nbsp;&nbsp;<strong>Description of Goods</strong></td>
                  </tr>
                </table></td>
              <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="40%" align="center">HSN CODE</td>
                    <td width="25%" align="center">QTY</td>
                    <td width="25%" align="center">Units</td>
                    <td width="10%" align="center">&nbsp;</td>
                  </tr>
                </table></td>
              <td width="15%" style="border-right:solid 1px #000;" align="center"> RATE&nbsp;&nbsp;&nbsp;<img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="13" alt=""></td>
              <td width="15%" style="border-right:solid 1px #000;" align="center"> Amount (Rs) </td>
            </tr>
          </table>
          <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
            <tr>
              <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                        <tr>
                          <td>&nbsp;&nbsp;
                            <input placeholder="" type="text" name="info[desc]" id="desc" style="width: 250px;margin-top: 21px;border: none;" value="<?=$dbReceipt[0]['desc'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr style="font-weight:600;">
                    <td><table>
                        <tr>
                          <td>&nbsp;&nbsp;Taxable Value</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr style="font-weight:600;">
                    <td><table>
                        <tr>
                          <td>&nbsp;&nbsp;ADD CGST 9%</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr style="font-weight:600;">
                    <td><table>
                        <tr>
                          <td>&nbsp;&nbsp;ADD SGST 9%</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr>
                          <td>&nbsp;&nbsp;Rounding (Rs.)</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr style="vertical-align: middle;">
                    <td><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                        <tr height="100%">
                          <td width="40%" align="center"><input style="width:80px;text-align: center;border: none;" placeholder="" type="text" name="info[hsn_code]" id="hsn_code" value="<?=$dbReceipt[0]['hsn_code'] ?? ""?>"></td>
                          <td width="25%" align="center"><input style="width:80px;text-align: center;border: none;" placeholder="" type="text" name="info[qty]" id="qty" value="<?=$dbReceipt[0]['qty'] ?? ""?>"></td>
                          <td width="25%" align="center"><input style="width:80px;text-align: center;border: none;" placeholder="" type="text" name="info[units]" id="units" value="<?=$dbReceipt[0]['units'] ?? ""?>"></td>
                          <td width="10%" align="center"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><input style="width:80px;text-align:center;margin-top: 11px;border: none;" placeholder="" type="text" name="info[rate]" id="rate" value="<?=$dbReceipt[0]['rate'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td>9%</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td>9%</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="15%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><!-- <?php 
										 //   $i = $dbReceipt[0]['rate']*$dbReceipt[0]['qty']*$dbReceipt[0]['units'];
										?> -->
                            
                            <input style="width:80px;text-align:center;margin-bottom:18px;border: none;" placeholder="" type="text" name="info[multiplication]" class="amount" value="<?=$dbReceipt[0]['multiplication'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><input style="width:80px;text-align:center;border: none;" placeholder="" type="text" name="info[multiplication]" class="amount" value="<?=$dbReceipt[0]['multiplication'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  
                  <!-- <tr>
                      <td>&nbsp;</td>
                  </tr> -->
                  
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><!-- <?php
									   // $x = ($dbReceipt[0]['amount']*9)/100;
									?> -->
                            
                            <input style="width:80px;text-align:center;border: none;" placeholder="" type="text" name="info[gst9]" class="gst" value="<?=$dbReceipt[0]['gst9'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><input style="width:80px;text-align:center;border: none;" placeholder="" type="text" name="info[gst9]" class="gst" value="<?=$dbReceipt[0]['gst9'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><!-- <?php
								//  $y = $x*2 + $i; 
								  //$total = round($y);
							  ?> -->
                      
                      <input style="width:80px;text-align:center;border: none;" placeholder="" type="text" name="info[rounding]" id="total" value="<?=$dbReceipt[0]['rounding'] ?? ""?>"></td>
                  </tr>
                  
                  <!-- <tr>
                      <td>&nbsp;</td>
                  </tr> -->
                  
                </table></td>
            </tr>
            <tr style="border-top:solid 2px #000;" bgcolor="#c5e0b2">
              <td width="30%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="40%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="10%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><h4>Total&nbsp;&nbsp;&nbsp;<img src="<?=HTACCESS_URL?>assets/img/rupee.png" width="13" alt=""></h4></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              <td width="20%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr align="center">
                    <td><table>
                        <tr>
                          <td><input style="width:80px;background-color:transparent;text-align:center;border: none;margin-bottom:16px;" placeholder="" type="text" name="info[amount]" id="final" value="<?=$dbReceipt[0]['amount'] ?? ""?>"></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <table width="1010px" cellspacing="0" cellpadding="0" align="center" style="border-left:solid 2px #0c0b0b;border-right:solid 2px #0c0b0b;border-bottom:solid 2px #0c0b0b;">
            <tr>
              <td width="70%" style="border-right:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr>
                          <td>&nbsp;&nbsp;Amount Chargeable (in words) </td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr style="font-weight:600;">
                    <td>&nbsp;&nbsp;Rupees : <br>
                      &nbsp;
                      <textarea style="font-weight:400;border:none; padding-top:10px; width:500px;" name="info[amount_word]" id="amount_word" rows="2"><?=$dbReceipt[0]['amount_word'] ?? ""?></textarea></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr style="font-weight:600;">
                          <td>&nbsp;&nbsp;PAN : AALCP6823C</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td width="30%" style="border-right:solid 1px #000;border-left:solid 1px #000;"><table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr align="center">
                          <td> Ceritified that the particulars given above are true and
                            
                            correct. </td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr style="border-bottom:solid 1px #000;">
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td><table>
                        <tr align="center">
                          <td> For Proptech Cleardeals Private Limited </td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr style="border-bottom:solid 1px #000;">
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table>
                        <tr align="center">
                          <td> This is a computarised receipt and doesn't require a
                            
                            signature. </td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>
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
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css" />
<script src="assets/vendors/sticky-sidebar/stickySidebar.js"></script> 
<script>
function printDiv() {
	var divToPrint = document.getElementById('printing');
	var newWin = window.open('', 'Print-Window');
	newWin.document.open();
	newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
	newWin.document.close();
	setTimeout(function () { newWin.close(); }, 10);
}
</script> 
<script>
$(document).ready(function () {
  $('#sidebar').stickySidebar({
	  sidebarTopMargin: 0,
	  footerThreshold: 100
  });
});
</script> 
<script>
$(document).ready(function () {

	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function () {
		$(this).prev(".card-header").find(".fa").addClass("fa-caret-up").removeClass("fa-caret-down");
	});

	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function () {
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
	}).on('hide.bs.collapse', function () {
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
	});
});
</script> 
<script type="text/javascript">
function ckhform() {

	if (isEmpty("Name", document.getElementById("name").value)) {
		document.getElementById("name").focus();
		return false;
	}

	return true;
}

function submit_host() {
	if (ckhform() == true) {
		document.getElementById("accForm").submit();
	}
}

function calculate() {

	var amount = document.getElementById('rateg').value;
	var cgstin = document.getElementById('cgstin').value;

	if (cgstin == '') {

		var rst = Number(amount);
		document.getElementById('rst').innerHTML = rst.toFixed(2);
		document.getElementById('finaltotal').value = rst.toFixed(2);

	} else {

		var cgst = (Number(amount) * 0) / 100;
		var sgst = (Number(amount) * 0) / 100;
		var rst = Number(amount) + Number(cgst) + Number(sgst);

		document.getElementById('cgstv').innerHTML = cgst.toFixed(2);
		document.getElementById('sgstv').innerHTML = sgst.toFixed(2);
		document.getElementById('rst').innerHTML = rst.toFixed(2);

		document.getElementById('cgst').value = cgst.toFixed(2);
		document.getElementById('sgst').value = sgst.toFixed(2);
		document.getElementById('finaltotal').value = rst.toFixed(2);
	}
}
</script> 
<script>
function getAmount(amt) {
	//alert(itemId);
	var amount = amt;
	document.getElementById("amtt").innerHTML = amount;
}
</script> 
<script>
$(document).ready(function () {
	$("#qty,#rate,#total").keyup(function () {
		// alert("Hello");
		var amount = 0;
		var q = Number($("#qty").val());
		var r = Number($("#rate").val());
		var rounding = Number($("#total").val());
		var amount = q * r;
		var gst = (amount * 9) / 100;
		// var total = amount + (gst * 2);
		var final = amount + (gst * 2) + rounding;
		$(".amount").val(amount);
		$(".gst").val(gst);
		// $("#total").val(total);
		$("#final").val(final);
	});
});
</script>