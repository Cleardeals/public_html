<?php
login_check(); ///to check weatther user is login or not
access_check('add_gst_receipt');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."gst_receipt where id='".$id."' ";
$dbReceipt = $dbObj->SelectQuery('edithome.php','aboutEdit()');

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."gst_receipt order by id desc";
$dbInvoice = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<style type="text/css">
.form-control {
	border-radius: 0!important;
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
}
@media print {
body {
	font-family: Arial, Helvetica, sans-serif;
}
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
            <form action="gstReceiptController.php" method="post" id="accForm" onSubmit="return ckhform()">
              <input type="hidden" name="mode" value="generatemnr" />
              <input type="hidden" name="id" value="<?=$id?>" />
              <table width="60%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:solid 2px #0c0b0b">
                <tr>
                  <td><table align="center" cellpadding="5" cellspacing="0"  width="100%">
                      <tr height="21">
                        <td width="2087" height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>&nbsp;</td>
                              <td width="53%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="47%" align="center"><img  src="assets/images/logo-main.png" alt="" /></td>
                              <td><h2 style="margin:0; padding:0; font-size:25px; line-height:35px">Proptech Cleardeals    Private Limited</h2>
                                <strong style="margin:0; padding:0; font-size:14px">208,    Aditya Plaza Complex, Jodhpur Gam Road to Jodhpur Cross Roads, </strong><br>
                                <strong style="margin:0; padding:0; font-size:14px">Satellite, Ahmedabad    380015</strong> <br>
                                <strong style="margin:0; padding:0; font-size:14px">Tel: +919723992200                <br>
                                Web : cleardeals.co.in</strong> <br>
                                <strong style="margin:0; padding:0; font-size:14px">GSTIN : 24AALCP6823C1ZJ</strong></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr bgcolor="#c5e0b2" >
                        <td height="20px" bgcolor="#FFFFFF"></td>
                      </tr>
                      <tr bgcolor="#c5e0b2" style="border-top:solid 2px #000;">
                        <td height="20px"></td>
                      </tr>
                      <tr bgcolor="#c5e0b2">
                        <td><h3 style="text-align:center; margin:0; padding:0;">Bill of Supply</h3></td>
                      </tr>
                      <tr bgcolor="#c5e0b2" style="border-bottom:solid 2px #000;">
                        <td height="20px"></td>
                      </tr>
                      <tr>
                        <td height="20px"></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:solid 2px #000; border-bottom:solid 2px #000;">
                            <tr>
                              <td width="52%">&nbsp;</td>
                              <td width="48%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" style=" border-top:solid 2px #000; border-right:solid 2px #000; line-height:50px"><h4>&nbsp;&nbsp;Detail of Receiver (Billed to)</h4></td>
                              <td align="left" style=" border-top:solid 2px #000;"><h4>&nbsp;&nbsp;Invoice Details</h4></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="0"  class="table-css">
                            <tr>
                              <td colspan="2" style="line-height:30px;"><label>&nbsp;&nbsp;&nbsp;&nbsp;Name:</label></td>
                              <td colspan="2"><div class="form-group" style="line-height:30px;">
                                  <input type="text"   name="info[name]" id="name" value="<?=$dbReceipt[0]['name'] ?? ""?>">
                                </div></td>
                              <td width="14%" style="line-height:30px;"><label>&nbsp;&nbsp;&nbsp;Invoice No :</label></td>
                              <td width="35%"><div class="form-group" style="line-height:30px;">
                                  <?php /*?><? $invoice = $dbInvoice[0]['id']+1; ?>
                                  <? if(empty($id)){?>
                                  <?='CD00'.$invoice?>
                                  <? }else{?>
                                  <?=$dbReceipt[0]['invoice_no']?>
                                  <? }?><?php */?>
                                  <input type="text" name="info[invoice_no]" id="invoice_no" value="<?=$dbReceipt[0]['invoice_no'] ?? ""?>">
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;Address:</label></td>
                              <td colspan="2"><div class="form-group">
                                  <textarea name="info[address]" id="address" cols="" rows="4"><?=$dbReceipt[0]['address'] ?? ""?></textarea>
                                </div></td>
                              <td><label style="margin-top: 50px;">&nbsp;&nbsp;&nbsp;Invoice Date :</label></td>
                              <td><div class="form-group" style="margin-top: 50px;">
                                  <input type="text" name="info[invoice_date]" id="invoice_date"  value="<?php if(!empty($dbReceipt[0]['invoice_date'])){?><?=$dbReceipt[0]['invoice_date']?><? }else{?><?=date('Y-m-d')?><?php }?>" >
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;GSTIN/UIN:</label></td>
                              <td colspan="2"><div class="form-group">
                                  <input type="text" name="info[gstin]" id="gstin" value="<?=$dbReceipt[0]['gstin'] ?? ""?>" >
                                </div></td>
                              <td><label>&nbsp;&nbsp;&nbsp;&nbsp;State:</label></td>
                              <td><div class="form-group">
                                  <input type="text" name="info[invoice_state_code]" id="invoice_state_code"  value="<?=$dbReceipt[0]['invoice_state_code'] ?? ""?>" >
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;Code:</label></td>
                              <td colspan="2"><div class="form-group">
                                  <input type="text" name="info[code]" id="code" value="<?=$dbReceipt[0]['code'] ?? ""?>" >
                                </div></td>
                              <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                              <td><div class="form-group">
                                  <input type="hidden">
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="4">&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                              <td width="5%" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;&nbsp;Sr.No</strong></td>
                              <td width="34%" height="50" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  Goods  
                                Description</strong></td>
                              <td width="18%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  HSN Code</strong></td>
                              <td width="13%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  QTY</strong></td>
                              <td width="16%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  Rate</strong></td>
                              <td width="14%" align="center" bgcolor="#c5e0b2"><strong>Amount</strong></td>
                            </tr>
                            <tr>
                              <td align="center" bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" bgcolor="#ffffff">1</td>
                              <td bgcolor="#ffffff"><input placeholder="" type="text"  name="info[desc]" id="desc"  value="<?=$dbReceipt[0]['desc'] ?? ""?>"></td>
                              <td align="center" bgcolor="#ffffff"><input style="width:100px" placeholder="" type="text"  name="info[hsn_code]" id="hsn_code"  value="<?=$dbReceipt[0]['hsn_code'] ?? ""?>" ></td>
                              <td align="center" bgcolor="#ffffff"><input style="width:100px" placeholder="" type="text"  name="info[qty]" id="qty"  value="<?=$dbReceipt[0]['qty'] ?? ""?>" ></td>
                              <td align="center" bgcolor="#ffffff"><input style="width:100px" placeholder="" type="text"  name="info[rate]" id="rate"  value="<?=$dbReceipt[0]['rate'] ?? ""?>"></td>
                              <td align="center" bgcolor="#ffffff"><input style="width:100px" placeholder="" type="text"  name="info[amount]" id="amount"  value="<?=$dbReceipt[0]['amount'] ?? ""?>" onBlur="getAmount(this.value)"></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                              <td bgcolor="#ffffff">&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="50" colspan="3" align="left" bgcolor="#c5e0b2"><strong>&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                              <td bgcolor="#c5e0b2">&nbsp;</td>
                              <td bgcolor="#c5e0b2">&nbsp;</td>
                              <td bgcolor="#c5e0b2"><div id="amtt">
                                  <?=$dbReceipt[0]['amount'] ?? ""?>
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center"><strong style="font-size:20px">Declaration:- &quot;Composition taxable person, not eligible to collect tax on supplies”</strong></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td><strong>&nbsp;&nbsp;Total Invoice Amount (In words):- </strong></td>
                            </tr>
                            <tr>
                              <td><div class="form-group">
                                  <input placeholder="" type="text" name="info[amount_word]" id="amount_word"  style="width:100%" value="<?=$dbReceipt[0]['amount_word'] ?? ""?>">
                                </div></td>
                            </tr>
                          </table>
                          <br></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="40" bgcolor="#c5e0b2"><strong>&nbsp;&nbsp;&nbsp;Bank Details</strong></td>
                              <td bgcolor="#c5e0b2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" style="padding-bottom:70px"><table width="98%" cellpadding="0" cellspacing="0" align="center">
                                  <tr>
                                    <td colspan="5" > Bank Name: </td>
                                    <td width="70%">Axis Bank 
                                      <!--<input type="text" name="info[bank_name]" id="bank_name"  value="<?=$dbReceipt[0]['bank_name']?>">--></td>
                                  </tr>
                                  <tr>
                                    <td colspan="5">Bank A/C: </td>
                                    <td>921020001375848 
                                      <!--<input  type="text" name="info[account_no]" id="account_no"  value="<?=$dbReceipt[0]['account_no']?>">--></td>
                                  </tr>
                                  <tr>
                                    <td colspan="5"><label>Bank IFSC:</label></td>
                                    <td colspan="5">UTIB0000032 
                                      <!--<input  type="text" name="info[ifsc_code]" id="ifsc_code"  value="<?=$dbReceipt[0]['ifsc_code']?>">--></td>
                                  </tr>
                                  <tr>
                                    <td colspan="7" rowspan="5" height="15" width="500">Terms & conditions:- As mentioned on our website.</td>
                                  </tr>
                                  <tr> </tr>
                                  <tr height="4"> </tr>
                                  <tr> </tr>
                                  <tr height="21"> </tr>
                                </table></td>
                              <td align="center"><table cellspacing="0" cellpadding="0" width="100%">
                                  <tr>
                                    <td width="376" colspan="5" align="center"><p style="font-size:12px;padding-top:15px;">Ceritified that the particulars given above are    true and correct</p></td>
                                  </tr>
                                  <tr>
                                    <td colspan="5" align="center" >For Proptech Cleardeals Private Limited</td>
                                  </tr>
                                  <tr>
                                    <td >&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="5" align="center">This is a computarised receipt and doesn't require a signature.</td>
                                  </tr>
                                  <tr height="4">
                                    <td height="4">&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td >&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr height="21">
                                    <td colspan="5" height="21">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
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
      </div>
      <div id="printing" class="w3-modal" style="display:none">
        <table width="60%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:solid 2px #0c0b0b">
          <tr>
            <td><table align="center" cellpadding="5" cellspacing="0" width="100%">
                <tr height="21">
                  <td width="2087" height="21"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td width="53%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="47%" align="center"><img src="assets/images/logo-main.png" alt="" /></td>
                        <td><h2 style="margin:0; padding:0; font-size:24px; line-height:35px">Proptech Cleardeals Private Limited</h2>
                          <strong style="margin:0; padding:0; font-size:14px">208,Aditya Plaza Complex, Jodhpur Gam Road to Jodhpur Cross Roads, </strong><br>
                          <strong style="margin:0; padding:0; font-size:14px">Satellite, Ahmedabad  380015</strong> <br>
                          <strong style="margin:0; padding:0; font-size:14px">Tel: +919723992200                <br>
                          Web : cleardeals.co.in</strong> <br>
                          <strong style="margin:0; padding:0; font-size:14px">GSTIN : 24AALCP6823C1ZJ</strong></td>
                      </tr>
                    </table></td>
                </tr>
                <tr style="background-color:#c5e0b2;">
                  <td height="20px" bgcolor="#FFFFFF"></td>
                </tr>
                <tr style="border-top:solid 2px #000;background-color:#c5e0b2;">
                  <td height="20px"></td>
                </tr>
                <tr style="background-color:#c5e0b2;">
                  <td><h3 style="text-align:center; margin:0; padding:0;">Bill of Supply</h3></td>
                </tr>
                <tr style="border-bottom:solid 2px #000;background-color:#c5e0b2;">
                  <td height="20px"></td>
                </tr>
                <tr>
                  <td height="20px"></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:solid 2px #000; border-bottom:solid 2px #000;">
                      <tr>
                        <td width="52%">&nbsp;</td>
                        <td width="48%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr bgcolor="#c7e1b2">
                        <td align="left" height="40" valign="middle" style=" border-top:solid 2px #000; border-right:solid 2px #000; background:#c7e1b2">&nbsp;&nbsp;<strong style="background:#c7e1b2">Detail of Receiver (Billed to)</strong></td>
                        <td align="left" height="40" valign="middle"  style=" border-top:solid 2px #000; background:#c7e1b2"><strong>&nbsp;&nbsp;Invoice Details</strong></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="5" cellpadding="0"  class="table-css">
                      <tr>
                        <td colspan="2" style="line-height:30px;"><label style="width:220px; display:block">&nbsp;&nbsp;&nbsp;&nbsp;Name:</label></td>
                        <td colspan="2"><div class="form-group" style="line-height:30px;">
                            <input style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:250px" type="text" name="info[name]" id="name" value="<?=$dbReceipt[0]['name'] ?? ""?>">
                          </div></td>
                        <td style="line-height:30px;"><label style="width:220px; display:block">&nbsp;&nbsp;&nbsp;Invoice No :</label></td>
                        <td width="29%"><div class="form-group" style="line-height:30px;">
                            <?php /*?> <? $invoice = $dbInvoice[0]['id']+1; ?>
                                  <? if(empty($id)){?>
                                  <?='CD00'.$invoice?>
                                  <? }else{?>
                                  <?=$dbReceipt[0]['invoice_no']?>
                                  <? }?><?php */?>
                            <input style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:250px" type="text" name="info[invoice_no]" id="invoice_no" value="<?=$dbReceipt[0]['invoice_no'] ?? ""?>">
                          </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;Address:</label></td>
                        <td colspan="2"><div class="form-group">
                            <textarea  style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:100%" name="info[address]" id="address" cols="" rows=""><?=$dbReceipt[0]['address'] ?? ""?></textarea>
                          </div></td>
                        <td><label>&nbsp;&nbsp;&nbsp;Invoice Date :</label></td>
                        <td><div class="form-group">
                            <input type="text"  style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;width:100%" name="info[invoice_date]" id="invoice_date"  value="<?php if(!empty($dbReceipt[0]['invoice_date'])){?><?=$dbReceipt[0]['invoice_date']?><?php }else{?><?=date('Y-m-d')?><?php }?>" >
                          </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;GSTIN/UIN:</label></td>
                        <td colspan="2"><div class="form-group">
                            <input  type="text" style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:250px" name="info[gstin]" id="gstin" value="<?=$dbReceipt[0]['gstin'] ?? ""?>" >
                          </div></td>
                        <td><label>&nbsp;&nbsp;&nbsp;&nbsp;State:</label></td>
                        <td><div class="form-group">
                            <input type="text" style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:250px" name="info[invoice_state_code]" id="invoice_state_code"  value="<?=$dbReceipt[0]['invoice_state_code'] ?? ""?>" >
                          </div></td>
                      </tr>
                      <tr>
                        <td colspan="2"><label>&nbsp;&nbsp;&nbsp;&nbsp;Code:</label></td>
                        <td colspan="2"><div class="form-group">
                            <input style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;width:250px" type="text" name="info[code]" id="code"  value="<?=$dbReceipt[0]['code'] ?? ""?>">
                          </div></td>
                        <td><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                        <td><div class="form-group">&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                      <tr>
                        <td width="5%" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;&nbsp;Sr.No</strong></td>
                        <td width="34%" height="50" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  Goods  
                          Description</strong></td>
                        <td width="18%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  HSN Code</strong></td>
                        <td width="13%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  QTY</strong></td>
                        <td width="16%" align="center" bgcolor="#c5e0b2"><strong style="color:#000; font-size:15px">&nbsp;  Rate</strong></td>
                        <td width="14%" align="center" bgcolor="#c5e0b2"><strong>Amount</strong></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#ffffff">1</td>
                        <td bgcolor="#ffffff"><input style="width:320px;border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;" placeholder="" type="text" name="info[desc]" id="desc"  value="<?=$dbReceipt[0]['desc'] ?? ""?>"></td>
                        <td  align="center" bgcolor="#ffffff"><input style="width:100px; border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px" placeholder="" type="text"  name="info[hsn_code]" id="hsn_code"  value="<?=$dbReceipt[0]['hsn_code'] ?? ""?>"></td>
                        <td align="center" bgcolor="#ffffff"><input style="width:100px; border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px" placeholder="" type="text"  name="info[qty]" id="qty"  value="<?=$dbReceipt[0]['qty'] ?? ""?>"></td>
                        <td align="center" bgcolor="#ffffff"><input style="width:100px; border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px" placeholder="" type="text"  name="info[rate]" id="rate"  value="<?=$dbReceipt[0]['rate'] ?? ""?>"></td>
                        <td align="center" bgcolor="#ffffff"><input style="width:100px; border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px" placeholder="" type="text"  name="info[amount]" id="amount"  value="<?=$dbReceipt[0]['amount'] ?? ""?>" onBlur="getAmount(this.value)"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="50" colspan="3" align="left" bgcolor="#c5e0b2"><strong>&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                        <td bgcolor="#c5e0b2">&nbsp;</td>
                        <td bgcolor="#c5e0b2">&nbsp;</td>
                        <td bgcolor="#c5e0b2"><div id="amtt">
                            <?=$dbReceipt[0]['amount'] ?? ""?>
                          </div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><strong style="font-size:20px">Declaration:- &quot;Composition taxable person, not eligible to collect tax on supplies"</strong></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td><strong>&nbsp;&nbsp;Total  Invoice Amount (In words):- </strong></td>
                      </tr>
                      <tr>
                        <td><div class="form-group">
                            <input placeholder="" type="text"  name="info[amount_word]" id="amount_word"  style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px; width:700px" value="<?=$dbReceipt[0]['amount_word'] ?? ""?>">
                          </div></td>
                      </tr>
                    </table>
                    <br></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="40" bgcolor="#c5e0b2"><strong>&nbsp;&nbsp;&nbsp;Bank Details</strong></td>
                        <td bgcolor="#c5e0b2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" style="padding-bottom:70px"><table width="98%" cellpadding="0" cellspacing="0" align="center">
                            <tr>
                              <td colspan="5">&nbsp;</td>
                              <td width="77%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="5"><div style="width:150px">Bank Name: </div></td>
                              <td width="77%"><div class="">Axis Bank 
                                  <!--<input  type="text" name="info[bank_name]" style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;"  id="bank_name"  value="<?=$dbReceipt[0]['bank_name']?>">--> 
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="5"><div style="width:150px">Bank A/C:</div></td>
                              <td><div class="">921020001375848 
                                  <!--<input  type="text" name="info[account_no]" id="account_no" style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;"  value="<?=$dbReceipt[0]['account_no']?>">--> 
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="5" ><div style="width:150px">
                                  <label>Bank IFSC:</label>
                                </div></td>
                              <td colspan="5" ><div class="">UTIB0000032 
                                  <!--<input  type="text" name="info[ifsc_code]" id="ifsc_code"  style="border-left:0; border-right:0; border-top:0; border-bottom:solid 1px #000; padding-bottom:5px;"  value="<?=$dbReceipt[0]['ifsc_code']?>">--> 
                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="6" rowspan="5" height="15">Terms & conditions:- As mentioned on our website.</td>
                            </tr>
                            <tr> </tr>
                            <tr height="4"> </tr>
                            <tr> </tr>
                            <tr height="21"> </tr>
                          </table></td>
                        <td align="center"><table cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                              <td width="376" colspan="5" align="center"><p style="font-size:12px;">Ceritified that the particulars given above are    true and correct</p></td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center" >For Proptech Cleardeals Private Limited</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center">This is a computarised receipt and doesn't require a signature.</td>
                            </tr>
                            <tr height="4">
                              <td height="4">&nbsp;</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr height="21">
                              <td colspan="5" height="21">&nbsp;</td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
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

	if(isEmpty("Name",document.getElementById("name").value)){
		document.getElementById("name").focus();
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
</script> 
<script>
function getAmount(amt){
	//alert(itemId);
	var amount = amt;
	document.getElementById("amtt").innerHTML = amount;
}
</script> 