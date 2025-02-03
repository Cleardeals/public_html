<?php
$dbObj->dbQuery="select * from ".PREFIX."blog_footer_links_category";
$dbBlogCategory = $dbObj->SelectQuery(); 
?>
<style type="text/css">
.margin-bottom {
	margin-bottom: 10px;
}
.text-uppercase {
	margin-bottom: 15px!important;
}
.text-dark {
	text-decoration: underline!important;
}
</style>
<br>
<footer class="bg-light text-center text-lg-start"> 
  <!-- Grid container -->
  <div class="container p-4"> 
    <!--Grid row-->
    <div class="row"> 
      <!--Grid column-->
      <?php for($i=0;$i<count((array)$dbBlogCategory);$i++){?>
      <div class="col-lg-2 col-md-6">
        <p class="text-uppercase"><b>
          <?=$dbBlogCategory[$i]['category']?>
          </b></p>
        <?php
			$dbObj->dbQuery="select * from ".PREFIX."blog_footer_links where link_category_id='".$dbBlogCategory[$i]['id']."'"; 
			$dbBlogLinks = $dbObj->SelectQuery();
			?>
        <ul class="list-unstyled">
          <?php for($j=0;$j<count((array)$dbBlogLinks);$j++){?>
          <li class="margin-bottom"> <a href="<?=$dbBlogLinks[$j]['link']?>" class="text-dark">
            <?=$dbBlogLinks[$j]['name']?>
            </a> </li>
          <?php }?>
        </ul>
      </div>
      <?php }?>
    </div>
    <!--Grid row--> 
  </div>
</footer>