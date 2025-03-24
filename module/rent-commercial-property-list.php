<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$msg = base64_decode($_SESSION['contact_msg'] ?? "");
$sortval = $dbObj->sc_mysql_escape($_REQUEST['sort'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$sortby = $dbObj->sc_mysql_escape($_REQUEST['sortby'] ?? "");
$serchtype = $dbObj->sc_mysql_escape($_REQUEST['serchtype'] ?? "");

$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");
$state = $dbObj->sc_mysql_escape($_REQUEST['state'] ?? "");
$city = str_replace('-', ' ', $_REQUEST['city'] ?? "");
$locationname = str_replace('-', ' ', $_REQUEST['locationname'] ?? "");
$property_type = str_replace('_', ' ', $_REQUEST['property_type'] ?? "");
$bedrooms = $_REQUEST['bedrooms'] ?? "";
$budget_min = str_replace('-', ' ', $_REQUEST['budget_min'] ?? "");
$minrent = explode(' ', $budget_min);
$budget_max = str_replace('-', ' ', $_REQUEST['budget_max'] ?? "");
$maxrent = explode(' ', $budget_max);

$cityUrl = $dbObj->sc_mysql_escape($_REQUEST['city'] ?? "");
$locationnameUrl = $_REQUEST['locationname'] ?? "";
$property_typeUrl = $_REQUEST['property_type'] ?? "";
$bedroomsUrl = $_REQUEST['bedrooms'] ?? "";
$budget_minUrl = $_REQUEST['budget_min'] ?? "";
$budget_maxUrl = $_REQUEST['budget_max'] ?? "";

$var_extra = 'rent-commercial-property-list/&sort='.$sortval.'&state='.$state.'&city='.$cityUrl.'&locationname='.$locationnameUrl.'&property_type='.$property_typeUrl.'&bedrooms='.$bedroomsUrl.'&budget_min='.$budget_minUrl.'&budget_max='.$budget_maxUrl;

if($sortval=='old'){
	  $sort = "id asc "; // default sort by id
  } else if($sortval=='new'){
	  //$sort = "membership desc, added_date desc "; // default sort by id
	  $sort = "id desc "; // default sort by id
  } else {
	  $sort = "id desc "; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."com_property where for_property='Rent' and status='1' and admin_del='0'"; // for total number of records for paging

if(!empty($state)){
	$dbObj->dbQuery.=" and State='".$state."'";
}

if(!empty($city)){
	$dbObj->dbQuery.=" and city='".$city."'";
}

if(!empty($locationname) && strlen($locationname)>3){
$dbObj->dbQuery .= " and location in (".$locationname.")";
}

/*if(!empty($propertyType) && strlen($propertyType)>3){
$dbObj->dbQuery .= " and property_type in (".$propertyType.")";
}*/

if(!empty($property_type)){
	$proptype = explode('-',$property_type);
	for($j=0;$j<count($proptype);$j++){
		$serchtype.= "'".$proptype[$j]."'";
		if($j!=count($proptype)-1)
		$serchtype.=",";
}
	$dbObj->dbQuery.=" and property_type in(".$serchtype.")";
}


if(!empty($bedrooms)){
	if($bedrooms=='1'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='100 - 300 sq. ft')";
	}elseif($bedrooms=='2'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='300 - 600 sq. ft')";
	}elseif($bedrooms=='3'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='600 - 1000 sq. ft')";
	}elseif($bedrooms=='4'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='1000 - 1500 sq. ft')";
	}elseif($bedrooms=='5'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='1500 - 2000 sq. ft')";
	}elseif($bedrooms=='6'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='2000 sq. ft ++')";
	}

}

if(isset($minrent[1]) && isset($maxrent[1])){
if(($minrent[1]=='Thousand') && ($maxrent[1]=='Thousand')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

	if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Thousand')";

}}

} elseif(($minrent[1]=='Thousand') && ($maxrent[1]=='Lacs')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand'  UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs' )";

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs')";

} }

}elseif(($minrent[1]=='Thousand') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand' UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}

}elseif(($minrent[1]=='Lacs') && ($maxrent[1]=='Lacs')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs')";

}}

} elseif(($minrent[1]=='Lacs') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs' UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}

}elseif(($minrent[1]=='Crores') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

	if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Crores')";

}

if(!empty($maxrent[0])){

	$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}
}
}
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];

require_once(PHP_FUNCTION_DIR.'property-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."com_property where for_property='Rent' and status='1' and admin_del='0'"; // for listing of records

if(!empty($state)){
	$dbObj->dbQuery.=" and State='".$state."'";	
}

if(!empty($city)){
	$dbObj->dbQuery.=" and city='".$city."'";
}

if(!empty($locationname) && strlen($locationname)>3){
	$dbObj->dbQuery .= " and location in (".$locationname.")";
}

/*if(!empty($propertyType) && strlen($propertyType)>3){
$dbObj->dbQuery .= " and property_type in (".$propertyType.")";
}*/

if(!empty($property_type)){
	$serchtype = '';
	$proptype = explode('-',$property_type);
	for($j=0;$j<count($proptype);$j++){
		$serchtype.= "'".$proptype[$j]."'";
		if($j!=count($proptype)-1)
		$serchtype.=",";
	}
	$dbObj->dbQuery.=" and property_type in(".$serchtype.")";
}

if(!empty($bedrooms)){
	if($bedrooms=='1'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='100 - 300 sq. ft')";
	}elseif($bedrooms=='2'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='300 - 600 sq. ft')";
	}elseif($bedrooms=='3'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='600 - 1000 sq. ft')";
	}elseif($bedrooms=='4'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='1000 - 1500 sq. ft')";
	}elseif($bedrooms=='5'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='1500 - 2000 sq. ft')";
	}elseif($bedrooms=='6'){
		$dbObj->dbQuery .=" and id in (select property_id from ".PREFIX."com_property_detail where no_of_bedrooms='2000 sq. ft ++')";
	}

}

if(isset($minrent[1]) && isset($maxrent[1])){
if(($minrent[1]=='Thousand') && ($maxrent[1]=='Thousand')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

	if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Thousand')";

}}

} elseif(($minrent[1]=='Thousand') && ($maxrent[1]=='Lacs')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand'  UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs' )";

		

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs')";

} }

}elseif(($minrent[1]=='Thousand') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand' UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Thousand')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}

}elseif(($minrent[1]=='Lacs') && ($maxrent[1]=='Lacs')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Lacs')";

}}

} elseif(($minrent[1]=='Lacs') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs' UNION select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

	} else {

if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Lacs')";

}

if(!empty($maxrent[0])){

		$dbObj->dbQuery.=" or id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}

}elseif(($minrent[1]=='Crores') && ($maxrent[1]=='Crores')){

	if(!empty($minrent[0]) && !empty($maxrent[0])){ 

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent_unit='Thousand' and expected_rent between $minrent[0] and  $maxrent[0])";

	}else {

	if(!empty($minrent[0])){

		$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent>=$minrent[0] and expected_rent_unit='Crores')";

}

if(!empty($maxrent[0])){

	$dbObj->dbQuery.=" and id in (select property_id from ".PREFIX."com_property_detail where expected_rent<=$maxrent[0] and expected_rent_unit='Crores')";

}}
}
}
//echo $dbObj->dbQuery;
$dbObj->dbQuery.=" order by $sort $page_limit";
$dbProperty = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;
$cntH = count((array)$dbProperty);

$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."city where status='1' order by display_order";
$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select distinct(location) from ".PREFIX."location where city='".$city."'"; // for listing of records
$dbLocation = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='20'";
$dbSitecontent = $dbObj->SelectQuery();

if(isset($_SESSION['user']['is_login'])) {
$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();
}
?>
<style>
.contact-thank-you {
	padding: 30px;
	border: solid 10px #1e70ab;
}
.activemin {
	background-color:#e30000;
	color:#fff;
	padding: 5px;
	width: 75%;
}
</style>
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script>
<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-4 wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;"> Commercial <span class="themecolor"> Listing </span> </h2>
    <div>
      <ul id="property-tab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
        <li class="nav-item flex-sm-fill"> <a id="home-tab" href="<?=HTACCESS_URL?>commercial-property/" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold  btn">For Sell</a> </li>
        <li class="nav-item flex-sm-fill"> <a id="profile-tab" data-toggle="tab" href="<?=HTACCESS_URL?>rent-commercial-property/" class="nav-link border-0 text-uppercase font-weight-bold btn active">For rent</a> </li>
      </ul>
      <div class="property-form">
        <div class="tab-content">
          <div class="dropdown">
            <div id="tab2" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade show active">
              <form action="<?=HTACCESS_URL?>commercialpropertyController.php" method="post">
                <input type="hidden" name="mode" value="search_for_rent_listing">
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6 pr-12">
                    <div class="selectdiv">
                      <label>
                      <select name="state" id="state" onChange="getstate(this.value)">
                        <option value="">State</option>
                        <?php for($i=0;$i<count((array)$dbState);$i++){?>
                        <option value="<?=$dbState[$i]['id']?>" <?=($state==$dbState[$i]['id'])?'selected':''?>>
                        <?=$dbState[$i]['state_name']?>
                        </option>
                        <?php }?>
                      </select>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                    <div class="selectdiv">
                      <label>
                      <?php if(!empty($city)){?>
                      <select name="city" id="selectcity" onChange="getcity(this.value)">
                        <?php for($i=0;$i<count((array)$dbCity);$i++){?>
                        <option value="<?=$dbCity[$i]['city_name']?>" <?=($city==$dbCity[$i]['city_name'])?'selected':''?>>
                        <?=$dbCity[$i]['city_name']?>
                        </option>
                        <?php }?>
                      </select>
                      <?php }else{?>
                      <select name="city" id="selectcity" onChange="getcity(this.value)">
                        <option value="">City</option>
                      </select>
                      <?php }?>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                    <?php if(!empty($city)){?>
                    <select class="select2 mb-10 select2-multiple" style="width:100%" multiple="multiple" data-placeholder="Choose Location" name="location[]" id="selectlocation">
                      <?php
							$locationval = str_replace("'",'',$locationname);
						  	$locationarray = explode(',',$locationval);
							?>
                      <?php for($i=0;$i<count((array)$dbLocation);$i++){?>
                      <option value="<?=$dbLocation[$i]['location']?>" <?=(in_array($dbLocation[$i]['location'],$locationarray))?'selected':''?>>
                      <?=$dbLocation[$i]['location']?>
                      </option>
                      <?php }?>
                    </select>
                    <?php }else{?>
                    <select class="select2 mb-10 select2-multiple" style="width:100%" multiple="multiple" data-placeholder="Choose Location" name="location[]" id="selectlocation">
                    </select>
                    <?php }?>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 pr-12 mb-2">
                    <select class="select-css form-control mb-2" name="property_type">
                      <option value="">Property Type</option>
                      <option value="Shops-Showrooms-Office Space-Factories" <?=($property_type=='Shops-Showrooms-Office Space-Factories')?'selected':''?>> Shops/Showrooms/Office Space/Factories</option>
                      <option value="Industrial Sheds-Wearhouse-Commercial Land-Co Working Space" <?=($property_type=='Industrial Sheds-Wearhouse-Commercial Land-Co Working Space')?'selected':''?>>Industrial Sheds/Wearhouse/Commercial Land/Co Working Space </option>
                      <option value="Godowns-Basement" <?=($property_type=='Godowns-Basement')?'selected':''?>> Godowns/Basement</option>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                    <select class="select-css form-control" name="no_of_bedrooms">
                      <option value="">Sq. Feet Area</option>
                      <option value="1" <?=($bedrooms=='1')?'selected':''?>>100 - 300 sq. ft</option>
                      <option value="2" <?=($bedrooms=='2')?'selected':''?>>300 - 600 sq. ft</option>
                      <option value="3" <?=($bedrooms=='3')?'selected':''?>>600 - 1000 sq. ft</option>
                      <option value="4" <?=($bedrooms=='4')?'selected':''?>>1000 - 1500 sq. ft</option>
                      <option value="5" <?=($bedrooms=='5')?'selected':''?>>1500 - 2000 sq. ft</option>
                      <option value="6" <?=($bedrooms=='6')?'selected':''?>>2000 sq. ft ++</option>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
                    <div id="min-max-price-range1" class="form-control dropdown-new"  data-toggle="dropdown">
                      <?php if((!empty($budget_min)) && (!empty($budget_max))){?>
                      <div id="minimum-price" class="pull-left mr-3">
                        <?=$budget_min?>
                      </div>
                      <div id="maxmum-price" class="pull-left">-
                        <?=$budget_max?>
                      </div>
                      <?php }else{?>
                      <div id="minimum-price" class="pull-left mr-3">Price Range</div>
                      <div id="maxmum-price" class="pull-left"></div>
                      <?php }?>
                    </div>
                    <div class="dropdown-menu dropdown-menu-new" style="padding:15px;">
                      <div class="row">
                        <div class="col-6 mb-2">
                          <input class="form-control price-label" placeholder="Min" name="budget_min" id="budget_min" data-dropdown-id="price-min" value="<?=$budget_min?>">
                        </div>
                        <div class="col-6 mb-2">
                          <input class="form-control price-label-max" placeholder="Max" name="budget_max" id="budget_max" data-dropdown-id="price-max" value="<?=$budget_max?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="row scroll-new">
                        <div class="col-6">
                          <ul id="price-min" class="price-range text-left list-unstyled dropdown-new">
                            <?php if($budget_min=='5 Thousand'){?>
                            <li data-value="5 Thousand" class="activemin">5 Thousand</li>
                            <?php }else{?>
                            <li data-value="5 Thousand">5 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='10 Thousand'){?>
                            <li data-value="10 Thousand" class="activemin">10 Thousand</li>
                            <?php }else{?>
                            <li data-value="10 Thousand">10 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='15 Thousand'){?>
                            <li data-value="15 Thousand" class="activemin">15 Thousand</li>
                            <?php }else{?>
                            <li data-value="15 Thousand">15 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='20 Thousand'){?>
                            <li data-value="20 Thousand" class="activemin">20 Thousand</li>
                            <?php }else{?>
                            <li data-value="20 Thousand">20 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='25 Thousand'){?>
                            <li data-value="25 Thousand" class="activemin">25 Thousand</li>
                            <?php }else{?>
                            <li data-value="25 Thousand">25 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='30 Thousand'){?>
                            <li data-value="30 Thousand" class="activemin">30 Thousand</li>
                            <?php }else{?>
                            <li data-value="30 Thousand">30 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='35 Thousand'){?>
                            <li data-value="35 Thousand" class="activemin">35 Thousand</li>
                            <?php }else{?>
                            <li data-value="35 Thousand">35 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='40 Thousand'){?>
                            <li data-value="40 Thousand" class="activemin">40 Thousand</li>
                            <?php }else{?>
                            <li data-value="40 Thousand">40 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='45 Thousand'){?>
                            <li data-value="45 Thousand" class="activemin">45 Thousand</li>
                            <?php }else{?>
                            <li data-value="45 Thousand">45 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='50 Thousand'){?>
                            <li data-value="50 Thousand" class="activemin">50 Thousand</li>
                            <?php }else{?>
                            <li data-value="50 Thousand">50 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='55 Thousand'){?>
                            <li data-value="55 Thousand" class="activemin">55 Thousand</li>
                            <?php }else{?>
                            <li data-value="55 Thousand">55 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='60 Thousand'){?>
                            <li data-value="60 Thousand" class="activemin">60 Thousand</li>
                            <?php }else{?>
                            <li data-value="60 Thousand">60 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='65 Thousand'){?>
                            <li data-value="65 Thousand" class="activemin">65 Thousand</li>
                            <?php }else{?>
                            <li data-value="65 Thousand">65 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='70 Thousand'){?>
                            <li data-value="70 Thousand" class="activemin">70 Thousand</li>
                            <?php }else{?>
                            <li data-value="70 Thousand">70 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='75 Thousand'){?>
                            <li data-value="75 Thousand" class="activemin">75 Thousand</li>
                            <?php }else{?>
                            <li data-value="75 Thousand">75 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='80 Thousand'){?>
                            <li data-value="80 Thousand" class="activemin">80 Thousand</li>
                            <?php }else{?>
                            <li data-value="80 Thousand">80 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='85 Thousand'){?>
                            <li data-value="85 Thousand" class="activemin">85 Thousand</li>
                            <?php }else{?>
                            <li data-value="85 Thousand">85 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='90 Thousand'){?>
                            <li data-value="90 Thousand" class="activemin">90 Thousand</li>
                            <?php }else{?>
                            <li data-value="90 Thousand">90 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='95 Thousand'){?>
                            <li data-value="95 Thousand" class="activemin">95 Thousand</li>
                            <?php }else{?>
                            <li data-value="95 Thousand">95 Thousand</li>
                            <?php }?>
                            <?php if($budget_min=='1 Lacs'){?>
                            <li data-value="1 Lacs" class="activemin">1 Lacs</li>
                            <?php }else{?>
                            <li data-value="1 Lacs">1 Lacs</li>
                            <?php }?>
                          </ul>
                        </div>
                        <div class="col-6">
                          <ul id="price-max" class="price-range text-left list-unstyled dropdown-new">
                            <?php if($budget_max=='5 Thousand'){?>
                            <li data-value="5 Thousand" class="activemin">5 Thousand</li>
                            <?php }else{?>
                            <li data-value="5 Thousand">5 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='10 Thousand'){?>
                            <li data-value="10 Thousand" class="activemin">10 Thousand</li>
                            <?php }else{?>
                            <li data-value="10 Thousand">10 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='15 Thousand'){?>
                            <li data-value="15 Thousand" class="activemin">15 Thousand</li>
                            <?php }else{?>
                            <li data-value="15 Thousand">15 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='20 Thousand'){?>
                            <li data-value="20 Thousand" class="activemin">20 Thousand</li>
                            <?php }else{?>
                            <li data-value="20 Thousand">20 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='25 Thousand'){?>
                            <li data-value="25 Thousand" class="activemin">25 Thousand</li>
                            <?php }else{?>
                            <li data-value="25 Thousand">25 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='30 Thousand'){?>
                            <li data-value="30 Thousand" class="activemin">30 Thousand</li>
                            <?php }else{?>
                            <li data-value="30 Thousand">30 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='35 Thousand'){?>
                            <li data-value="35 Thousand" class="activemin">35 Thousand</li>
                            <?php }else{?>
                            <li data-value="35 Thousand">35 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='40 Thousand'){?>
                            <li data-value="40 Thousand" class="activemin">40 Thousand</li>
                            <?php }else{?>
                            <li data-value="40 Thousand">40 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='45 Thousand'){?>
                            <li data-value="45 Thousand" class="activemin">45 Thousand</li>
                            <?php }else{?>
                            <li data-value="45 Thousand">45 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='50 Thousand'){?>
                            <li data-value="50 Thousand" class="activemin">50 Thousand</li>
                            <?php }else{?>
                            <li data-value="50 Thousand">50 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='55 Thousand'){?>
                            <li data-value="55 Thousand" class="activemin">55 Thousand</li>
                            <?php }else{?>
                            <li data-value="55 Thousand">55 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='60 Thousand'){?>
                            <li data-value="60 Thousand" class="activemin">60 Thousand</li>
                            <?php }else{?>
                            <li data-value="60 Thousand">60 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='65 Thousand'){?>
                            <li data-value="65 Thousand" class="activemin">65 Thousand</li>
                            <?php }else{?>
                            <li data-value="65 Thousand">65 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='70 Thousand'){?>
                            <li data-value="70 Thousand" class="activemin">70 Thousand</li>
                            <?php }else{?>
                            <li data-value="70 Thousand">70 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='75 Thousand'){?>
                            <li data-value="75 Thousand" class="activemin">75 Thousand</li>
                            <?php }else{?>
                            <li data-value="75 Thousand">75 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='80 Thousand'){?>
                            <li data-value="80 Thousand" class="activemin">80 Thousand</li>
                            <?php }else{?>
                            <li data-value="80 Thousand">80 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='85 Thousand'){?>
                            <li data-value="85 Thousand" class="activemin">85 Thousand</li>
                            <?php }else{?>
                            <li data-value="85 Thousand">85 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='90 Thousand'){?>
                            <li data-value="90 Thousand" class="activemin">90 Thousand</li>
                            <?php }else{?>
                            <li data-value="90 Thousand">90 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='95 Thousand'){?>
                            <li data-value="95 Thousand" class="activemin">95 Thousand</li>
                            <?php }else{?>
                            <li data-value="95 Thousand">95 Thousand</li>
                            <?php }?>
                            <?php if($budget_max=='1 Lacs'){?>
                            <li data-value="1 Lacs" class="activemin">1 Lacs</li>
                            <?php }else{?>
                            <li data-value="1 Lacs">1 Lacs</li>
                            <?php }?>
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="btnClear"> <a href="javascript:void(0)" onClick="clearPrice();" class="btn btn-link">Clear</a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 pr-12"> </div>
                  <div class="col-lg-4 col-md-6 div-n"> </div>
                  <div class="col-lg-4 col-md-6 pr-12">
                    <button class="pt-2 pb-2 font-16 font-bold text-white blue-bg btn d-block border-0 rounded-0 text-uppercase text-center" style="width:100%"> Search <i class="flaticon-magnifier"></i> </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="col-lg-2 col-md-3 text-right mb-3 float-right">
          <div class="selectdiv">
            <label>
            <select onChange="sortme(this.value)">
              <option value="new" <?=($sortval=='new')?'selected':''?>> New to Old</option>
              <option value="old" <?=($sortval=='old')?'selected':''?>> Old to New</option>
            </select>
            </label>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-8">
        <h2 class="font-16 mb-4 title2">
          <?=$dbResult[0]["total"]?>
          Properties Found </h2>
        <h2 class="font-21 text-uppercase mb-4 title2">
          <?=$dbSitecontent[0]['heading']?>
        </h2>
        <?php if(!empty($msg)) { ?>
        <p style="color:#F00">
          <?=$msg?>
        </p>
        <?php } ?>
      </div>
      <div class="col-md-4 col-4 text-right btn-list"><a  href="<?=HTACCESS_URL?>search-property-thumb/" class="active btn">Residential Properties</a> <a href="<?=HTACCESS_URL?>rent-commercial-property/" class="btn"> <i class="fa fa-th-large" aria-hidden="true"></i></a> <a href="<?=HTACCESS_URL?>rent-commercial-property-list/" class="btn active"> <i class="fa fa-list" aria-hidden="true"> </i> </a> </div>
    </div>
    <?php if($cntH>0){?>
    <div class="row">
      <?php for($i=0;$i<$cntH;$i++){

		$propertyName = str_replace(' ','-',$dbProperty[$i]['property_name']);

		$dbObj->dbQuery="select * from ".PREFIX."com_property_detail where property_id='".$dbProperty[$i]['id']."'";
		$dbPropertDetail = $dbObj->SelectQuery();

		$dbObj->dbQuery="select * from ".PREFIX."com_property_images where property_id='".$dbProperty[$i]['id']."' and front_status='1'";
		$dbPropertImages = $dbObj->SelectQuery();
		
		if(isset($_SESSION['user']['is_login'])) {
		$dbObj->dbQuery="select * from ".PREFIX."favourite where property_id='".$dbProperty[$i]['id']."' and user_id='".$_SESSION['user']['userid']."'";
		$dbFav = $dbObj->SelectQuery();
		}
	?>
      <div class="col-12 row properties-div2 m-0 wow fadeIn">
        <div class="col-lg-4 col-md-4">
          <?php if(!empty($dbPropertImages[0]['image'])){?>
          <div class="img-pro text-center"><a data-fancybox="gallery" href="<?=HTACCESS_URL?>cms_images/property/original/<?=$dbPropertImages[0]['image']?>"> <img src="<?=HTACCESS_URL?>cms_images/property/thumb/<?=$dbPropertImages[0]['image']?>" class="img-fluid"></a> </div>
          <?php }?>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="properties-name pt-3 pl-3 pr-3 pb-0">
            <div class="row">
              <div class="col-md-7">
                <div style="font-weight:bold">Views :
                  <?php if(!empty($dbProperty[$i]['hit'])){?>
                  <?=$dbProperty[$i]['hit']?>
                  <?php }else{?>
                  0
                  <?php }?>
                </div>
                <?php if (!empty($dbPropertDetail[0]['custom_tag'])) { ?>
                <div class="custom-tag float-left">
                 <?=$dbPropertDetail[0]['custom_tag']?>
                </div>
                 <?php } ?>
                <div class="for-sell">for Rent</div>
                <span class="montserrat font-semibold text-blue font-18 float-left">
                <?php if(!empty($dbPropertDetail[0]['expected_rent'])){?>
                ₹
                <?=$dbPropertDetail[0]['expected_rent']?>
                <?php if($dbPropertDetail[0]['expected_rent_unit']=='Crores'){?>
                Cr
                <?php }else{?>
                <?=$dbPropertDetail[0]['expected_rent_unit']?>
                <?php }}?>
                </span>
                <p class="float-left pl-3"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <?=$dbProperty[$i]['location']?>
                  <?php if(!empty($dbProperty[$i]['city'])){?>
                  ,
                  <?=$dbProperty[$i]['city']?>
                  <?php }?>
                </p>
              </div>
              <div class="col-md-5">
                <div class="heart heart2">
                  <div class="row m-0">
                    <!-- <div class="col-lg-9 col-6 mt-3 mt-3">
                      <p> <strong>Post Date:</strong>
                        <?=date('d/m/Y', strtotime($dbPropertDetail[0]['post_date']))?>
                      </p>
                    </div> -->
                    <div class="col-lg-3 col-6">
                      <?php /*?><?php if(!isset($_SESSION['user']['is_login'])) {?>
                      <div class="heart"><a href="" data-toggle="modal" data-target="#myModal"> <i class="fa fa-heart"></i></a></div>
                      <?php }else{?>
                      <?php if($dbFav[0]['favourite']==1){?>
                      <a href="<?=HTACCESS_URL?>userController.php?mode=remove_favourite_rlist&property_id=<?=$dbProperty[$i]['id']?>"> <i class="fa fa-heart" style="color:#e30000;"></i></a>
                      <?php }else{?>
                      <a href="<?=HTACCESS_URL?>userController.php?mode=add_favourite_rlist&property_id=<?=$dbProperty[$i]['id']?>&id=<?=$dbFav[0]['id']?>"> <i class="fa fa-heart"></i></a>
                      <?php }}?><?php */?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="float-left">
              <div class="for-sell float-n bg2css">
                <?=$dbProperty[$i]['property_type']?>
              </div>
            </div>
            <h4 class="font-semibold mt-1 mb-3 pl-3"> <a href="<?=HTACCESS_URL?>commercial-property-detail/<?=$dbProperty[$i]['id']?>/<?=$propertyName?>/">
              <?=$dbProperty[$i]['property_name']?>
              </a> </h4>
            <div class="clearfix"></div>
            <p class="mb-4" style="margin-bottom:5px!important">
              <?=substr($dbProperty[$i]['content'],0,123)?>
            </p>
            <a data-toggle="collapse" class="pro-read" data-target="#demo<?=$dbProperty[$i]['id']?>">Read More</a>
            <div class="position-relative">
              <div id="demo<?=$dbProperty[$i]['id']?>" class="collapse mb-4 div-1">
                <?=html_entity_decode(stripslashes($dbProperty[$i]['content']))?>
              </div>
            </div>
            <div class="row m-0">
              <div class="col-md-6 p-0">
                <div class="list2">
                  <ul>
                    <li><i class="flaticon-hotel-sign"></i>
                      <?=$dbPropertDetail[0]['no_of_bedrooms']?>
                    </li>
                    <li><i class="flaticon-bath-tub"></i>
                      <?=$dbPropertDetail[0]['no_of_bathrooms']?>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>commercial-property-detail/<?=$dbProperty[$i]['id']?>/<?=$propertyName?>/" class="btn themebg text-white theme-btn mr-3">Show Details</a>
                <?php if(!isset($_SESSION['user']['is_login'])) {?>
                <a href="" data-toggle="modal" data-target="#myModal" class="btn themebg text-white theme-btn">Contact Us</a>
                <?php }else{?>
                <!--<a data-fancybox="contact-us-popup<?=$dbProperty[$i]['id']?>" data-src="#contact-us-popup<?=$dbProperty[$i]['id']?>"  href="javascript:;" class="btn themebg text-white theme-btn">Contact Us</a>-->
                <a data-toggle="modal" data-target="#myModals<?=$dbProperty[$i]['id']?>" class="btn themebg text-white theme-btn" style="color:#fff;">Contact Us</a>
                <?php }?>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clerfix"></div>
      <div class="modal fade" id="myModals<?=$dbProperty[$i]['id']?>" role="dialog">
        <div class="modal-dialog" style="max-width:600px;min-height:400px">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="bs-example">
                  <form action="/" method="post" id="accFormmodifyClient<?=$i?>" onSubmit="return chkContact<?=$i?>();" autocomplete="off">
                    <input type="hidden" name="mode" value="rent_property_list_contact">
                    <input type="hidden" name="exe_email" value="<?=$dbPropertDetail[0]['exe_email']?>">
                    <input type="hidden" name="property_id" value="<?=$dbProperty[$i]['id']?>">
                    <input type="hidden" name="clientid" value="<?=$dbUser[0]['clientid']?>">
                    <input type="hidden" name="name" value="<?=$dbUser[0]['name']?>">
                    <input type="hidden" name="email" value="<?=$dbUser[0]['email']?>">
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-10"> <br />
                        <div class="row">
                          <div class="col-md-6"> <strong>Name -</strong>
                            <?=$dbUser[0]['name']?>
                          </div>
                          <div class="col-md-6"> <strong>Email -</strong>
                            <?=$dbUser[0]['email']?>
                          </div>
                          <br />
                          <br />
                          <!--<div class="col-md-6"> <strong>Contact No -</strong>

							  <? //=$dbUser[0]['mobile_no']?>

                            </div>-->
                          <div class="col-md-12">
                            <div class="form-group" style="margin:0">
                              <input type="text" class="form-control" name="mobile_no" id="mobile_no<?=$i?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Mobile No" onBlur="getOtp(this.value)" value="<?=$_SESSION['prop_listing']['mobile_no']?>">
                            </div>
                          </div>
                          <div class="col-md-12" style="margin-top:10px;">
                            <div class="form-group" style="margin:0">
                              <textarea class="form-control" name="message" id="message<?=$i?>" placeholder="Message"><?=$_SESSION['prop_listing']['message']?></textarea>
                            </div>
                          </div>
                          <div class="col-md-12" style="margin-top:10px;">
                            <div class="form-group">
                              <input type="text" class="form-control" name="contact_otp" id="contact_otp<?=$i?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Otp">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1"></div>
                    </div>
                    <p class="mb-0 text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </p>
                  </form>
                  <p class="text-center">Call Our Relationship Manager - 9723992200</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script>
function chkContact<?=$i?>() {

	if(isEmpty("Mobile No",document.getElementById("mobile_no<?=$i?>").value)) {
		document.getElementById("mobile_no<?=$i?>").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Mobile No");
		return false;
	}

	if(isEmpty("Message",document.getElementById("message<?=$i?>").value)) {
		document.getElementById("message<?=$i?>").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Message");
		return false;
	}

	if(isEmpty("Otp",document.getElementById("contact_otp<?=$i?>").value)) {
		document.getElementById("contact_otp<?=$i?>").focus();
		//document.getElementById("errorcon1").innerHTML=(" Please Enter Mobile No* ");
		alert("Please Enter Otp");
		return false;
	}

	contact_us<?=$i?>();
	//return true;
	return false;
} 

function contact_us<?=$i?>(){

var form_data=$('#accFormmodifyClient<?=$i?>').serialize();

//$("form#accFormmodifyClient<?=$i?>").submit(function(e) {
	//$("form#accForms").onclick(function(e) {
//alert(1111);
    $.ajax({
        url: "<?=HTACCESS_URL?>commercialpropertyController.php?mode=rent_property_list_contact",
        data:form_data,
		cache:false,
		async:false,
        success: function (data) {
			//alert(data);
			if(data==1) {
			$('#myModals<?=$dbProperty[$i]['id']?>').modal('hide');
			$("#thank-you-popup").fancybox().trigger('click');
			}else if(data==2) {
			alert("Invalid Otp");
			}
        },
    });
//});
}
</script>
      <?php }?>
    </div>
    <div class="text-center"></div>
    <div class="col-12-md text-center">
      <ul class="pagination2 mt-3">
        <?=$page_link;?>
      </ul>
    </div>
    <?php }else{?>
    <p style="color:#F00;text-align:center;">No Record Found</p>
    <?php }?>
  </div>
</div>
<?php unset($_SESSION['contact_msg']);?>
<a data-fancybox="thank-you-popup" data-src="#thank-you-popup" href="javascript:;"></a>
<input type='hidden' id="is_home" value="1">
<!--contact-us-popup-->
<div id="thank-you-popup" style="display:none;width:100%;max-width:660px;" class="contact-thank-you">
  <div class="right-section form-sec">
    <div>
      <h1 class="text-dark text-center text-uppercase font-weight-bolder">Thank You</h1>
      <p class="text-center mb-0">Your request for contact us send to admin.</p>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/vendor/price/jquery-min.js"></script>
<style>
.close-btn {
	width:30px;height:30px;
	cursor:pointer;
	position:absolute;
	z-index:999;
	right:-4px;
	color:#e30000!important;
	border-radius:50px;
	text-align:center;
	top:0px;
	cursor:pointer;
}

.close-btn {
	background:none!important;
}

.toggle-link{
	cursor:pointer;
}
</style>
<script>
$(document).ready(function () {
   $('.toggle-link').click(function(){
      $('.dd-list-menu').addClass('bring');
	  });
});

$(document).ready(function () {
   $('.close-btn').click(function(){
      $('.dd-list-menu').removeClass('bring');
	  });
});

function getOtp(MobileNo){
	//alert(itemCode);
	//itemCodes = utf8_encode(itemCode);
	 $.ajax({
			url:'<?=HTACCESS_URL?>commercialpropertyController.php?mode=get_otp_rent_list',
			data:'MobileNo='+MobileNo,
			success:function(response){
			//alert(response);
			//document.getElementById("itemDesc").value = response;
			if(response==1){
			alert("Otp send to your mobile no.");
			}
		}
	});
}
</script>
<!--<script src="<?=HTACCESS_URL?>assets/vendor/price/min.d.js"></script> 

<script src="<?=HTACCESS_URL?>assets/vendor/price/home.min.js"></script> 

<script src="<?=HTACCESS_URL?>assets/vendor/price/sugstcore.min.js"></script> -->
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>
<link href="<?=HTACCESS_URL?>assets/vendor/multiselect/css/select2.min.css" rel="stylesheet" />
<script src="<?=HTACCESS_URL?>assets/vendor/multiselect/js/select2.full.min.js" type="text/javascript"></script>
<script>
$(function() {

	  // For select 2
	  $(".select2").select2();
	  $(".ajax").select2({

		  ajax: {
			  url: "https://api.github.com/search/repositories",
			  dataType: 'json',
			  delay: 250,
			  data: function(params) {

				  return {
					  q: params.term, // search term
					  page: params.page
				  };

			  },
			  processResults: function(data, params) {

				  // parse the results into the format expected by Select2
				  // since we are using custom formatting functions we do not need to
				  // alter the remote JSON data, except to indicate that infinite
				  // scrolling can be used
				  params.page = params.page || 1;
				  return {
					  results: data.items,
					  pagination: {
						  more: (params.page * 30) < data.total_count
					  }
				  };
			  },
			  cache: true
		  },

		  escapeMarkup: function(markup) {
			  return markup;
		  }, // let our custom formatter work

		  minimumInputLength: 1,
		  templateResult: formatRepo, // omitted for brevity, see the source of this page
		  templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
	  });
});
</script>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#multi-select2').multiselect({nonSelectedText: 'Property Type'});
	$('#multi-select3').multiselect({nonSelectedText: 'No. of Bedrooms'});
});
</script>
<script>
function getstate(stateID){

	 $.ajax({
			url:'<?=HTACCESS_URL?>commercialpropertyController.php?mode=getcity',
			data:'stateID='+stateID,
			success:function(response){
			//alert(response);
			$('#selectcity').html(response);
		}
	});
}


function getcity(cityID){

	 $.ajax({
			url:'<?=HTACCESS_URL?>commercialpropertyController.php?mode=getlocation',
			data:'cityID='+cityID,
			success:function(response){
			//alert(response);
			$('#selectlocation').html(response);
		}
	});
}

function sortme(sortval){
	window.location.href="<?=HTACCESS_URL.$var_extra.'&sort='?>"+sortval+'/';
}
</script>
<style>
.pro-read{
	background: #008be3;
	text-transform: uppercase;
	font-size: 12px;
	font-weight: 600;
	color: #fff!important;
	padding: 5px 15px;
	position: relative;
	border:0;
	margin-bottom:10px;
	display:inline-block;
}

.pro-read:hover{
	background:#e30000;
	color:#fff;
}

.div-1{
	position: absolute;
	z-index: 999;
	background: #fff;
	border: solid 1px #ccc;
	padding: 10px;
}
</style>
<script type="text/javascript">
//clear price
function clearPrice(){

	document.getElementById('budget_min').value = '';
	document.getElementById('budget_max').value = '';

	$( "#price-min li" ).removeClass( "activemin" );
	$( "#price-max li" ).removeClass( "activemin" );

	document.getElementById('minimum-price').style.display = 'none';
	document.getElementById('maxmum-price').style.display = 'none';
}

//price dropdown
$('#min-max-price-range1').click(function (event) {
    setTimeout(function(){ $('.price-label').first().focus();	},0); 
	setTimeout(function(){ $('.price-label-max').first().focus();	},0);    
});

var priceLabelObj;
$('.price-label').focus(function (event) {
    priceLabelObj=$(this);
    $('.dropdown').addClass('show');
    $('#'+$(this).data('dropdownId')).removeClass('hide');
});

var maxpriceLabelObj;
$('.price-label-max').focus(function (event) {
    maxpriceLabelObj=$(this);
    //$('.price-range').addClass('hide');
    $('#'+$(this).data('dropdownId')).removeClass('hide');
});

$("#price-min li").click(function(){
   priceLabelObj.attr('value', $(this).attr('data-value'));
   var minimum = $(this).closest('li').data('value');
    var curElmIndex=$( ".price-label" ).index( priceLabelObj );
    var nextElm=$( ".price-label" ).eq(curElmIndex+1);
	//alert(minimum);
	$( "#price-min li" ).removeClass( "activemin" ); //assuming that it has to be removed from other li's, else remove this line
    $( this ).addClass( "activemin" );
	document.getElementById("minimum-price").innerHTML = minimum;
	document.getElementById('minimum-price').style.display = 'block';
	document.getElementById('budget_min').value = minimum;

    /*if(nextElm.length){
        $( ".price-label" ).eq(curElmIndex+1).focus();
		document.getElementById("minimum-price").innerHTML = minimum;
		document.getElementById("maxmum-price").innerHTML = minimum;
    }else{
        $('#min-max-price-range').dropdown('toggle');
    }*/

	//$('.dropdown').addClass('show');
	//openDropdown.classList.add('show'); 
});

$("#price-max li").click(function(){    
   maxpriceLabelObj.attr('value', $(this).attr('data-value'));
   var maxmum = $(this).closest('li').data('value');
    var curElmIndex=$( ".price-label" ).index( maxpriceLabelObj );
    var nextElm=$( ".price-label" ).eq(curElmIndex+1);
	//alert(maxmum);
	$( "#price-max li" ).removeClass( "activemin" ); //assuming that it has to be removed from other li's, else remove this line
    $( this ).addClass( "activemin" );
	document.getElementById("maxmum-price").innerHTML = '- '+maxmum;
	document.getElementById('maxmum-price').style.display = 'block';
	document.getElementById('budget_max').value = maxmum;

    /*if(nextElm.length){
        $( ".price-label" ).eq(curElmIndex+1).focus();
		document.getElementById("minimum-price").innerHTML = minimum;
		document.getElementById("maxmum-price").innerHTML = minimum;
    }else{
        $('#min-max-price-range').dropdown('toggle');
    }*/

	$('#min-max-price-range1').dropdown('toggle');
});
</script>

<style>
	.custom-tag {
    background: orange;
    background: red;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 600;
    height: 22px;
    padding: 2px 10px;
    margin-right: 20px;
    position: relative;
} 

.custom-tag:before {
    border-top: 11px solid transparent;
    border-bottom: 11px solid transparent;
    border-left: 5px red;
    content: "";
    position: absolute;
    right: -5px;
    top: 0;
}
</style>