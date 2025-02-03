<?php 
login_check(); // to check admin is login
$msg = base64_decode($_REQUEST['msg']); // request mag variable and decode
$var_extra = "mo=category_list"; // to enable page link

if(!empty($_REQUEST['sort'])){
	$sort = $_REQUEST['sort'];
} else {
	$sort = "recordListingID ASC"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."category"; // to get total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php');// include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ;

$dbObj->dbQuery="select * from ".PREFIX."category"; // to show all records
$dbObj->dbQuery.=" order by $sort $page_limit";
$dbCategory = $dbObj->SelectQuery('logincheck.php','Blogs()');

?>
<style>

#contentLeft{
width:100%;
cursor: move;
}
#contentLeft li {
	list-style: none;
}
</style>

<script type="text/javascript" src="jquery-drag-n-drop/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery-drag-n-drop/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 					   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("updateDB.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});
});	
</script>
<form action="categoryController.php" method="post" >
  <input type="hidden" name="mode" value="delete_category" /> <!-- mode set to delete record-->
  <input type="hidden" name="counter" id="counter" value="<?=count($dbCategory)?>" />
  <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" style="padding-top:15px;"  >
    <tr>
      <td colspan="2" class="heading2" >Manage Category</td>
    </tr>
    <tr>
      <td colspan="2"><? if(!empty($errormsg)){ ?>
      <span class="message error"><?=$errormsg?></span><? } ?>
      <? if(!empty($infomsg)){ ?>
      <span class="message information"><?=$infomsg?></span><? } ?>
      </td>
    </tr>
   
    <tr>
      <td width="50%" class="error_msg">
      </td>
      <td width="50%" align="right">
      <div class="box-content">
      <a href="index.php?mo=add_category" class="button white"><span class="icon_text addnew"></span>add new</a>
      </div>
      </td>
    </tr>
    <?php if(count($dbCategory)>0){?>
    <!-- to check records are there or empty -->
    <tr>
      <td colspan="2"><table width="100%" cellpadding="6" cellspacing="1" border="0" bgcolor="#A3A0A0">
          <tr>
            <td width="4%" align="center" class="table_head" style="text-align:center" valign="middle"><input type="checkbox" id="select" onclick="return selectAll()"/></td>
            <td width="43%" class="table_head">Category Name</td>
            <td width="5%" class="table_head" style="text-align:center">Status</td>
            <td width="6%" class="table_head">Edit</td>
          </tr>
          
          
          <tr>
            <td align="left" colspan="4" style="padding:0; margin:0;">
            <div id="contentLeft">
			<ul style="padding:0; margin:0;">
			    <?php
				  $count= count($dbCategory);
				  for($i=0;$i<$count;$i++){?>
                <li id="recordsArray_<?=$dbCategory[$i]['id']?>">
                <table width="100%" cellpadding="2" cellspacing="1" border="0">
                <tr class="odd">
                <td width="7%" align="center" valign="middle">
                <input type="checkbox" id="c<?=$i?>" name="id[]"  value="<?=$dbCategory[$i]['id']?>"></td>
                <td class="content" width="74%" valign="top"><?=$dbCategory[$i]['cat_name']?></td>
                <td align="center" width="9%" valign="top"><input type="checkbox" id="image<?=$dbCategory[$i]['id']?>" name="image<?=$dbCategory[$i]['id']?>" value="<?=$dbCategory[$i]['id']?>" <?=($dbCategory[$i]['status']=='1')?'checked':''?> onclick="cat_status(<?=$dbCategory[$i]['id']?>)"/></td>
                <td class="content" valign="top"><a href="?mo=add_category&id=<?=$dbCategory[$i]['id']?>&page=<?=$page?>&set=<?=$set?>"><img src="images/edit.png" width="20" border="0" /></a></td>
                </tr>
                </table>
                </li>
				<?php } ?>
            </ul>
            </div>
            </td>
          </tr>
          
          <tr bgcolor="#ffffff"class="pagination">
            <td colspan="7" height="16">
				  <div class="paginationL"><?=$recmsg;?></div>
                  <div class="paginationR">
                  <ul><?=$page_link;?></ul>
                  </div>
             </td>
          </tr>
          <tr bgcolor="#ffffff">
            <td align="left" valign="top" colspan="6"><input type="submit"  value="Delete" class="button themed" onclick="javascript:return confirm('Are you sure you want to delete?')">
            </td>
          </tr>
        </table></td>
    </tr>
    <?php } else {?>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" class="not_found"> No record found </td>
    </tr>
    <?php } ?>
  </table>
</form>
<script type="text/javascript">
function selectAll()
{    var cnt=document.getElementById("counter").value;
	if(document.getElementById("select").checked==true)
		
	{
		for( var i=0;i<cnt;i++)
		{
			document.getElementById("c"+i).checked=true;
			
		}
	}
	if(document.getElementById("select").checked==false)
	{
		for( var i=0;i<cnt;i++)
		{
			document.getElementById("c"+i).checked=false;
			
		}
	}
}
</script>
<script type="text/javascript">
function cat_status(id){
	if(document.getElementById('image'+id).checked==true)
		window.location.href = 'categoryController.php?mode=categorystatus&id='+id+'&setval=1&page=<?=$page?>&set=<?=$set?>';
	else
		window.location.href = 'categoryController.php?mode=categorystatus&id='+id+'&setval=0&page=<?=$page?>&set=<?=$set?>';
}
</script>
