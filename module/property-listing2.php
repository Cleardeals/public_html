<!-- Header -->

<div  class="center-section-in">
  <div class="container">
    <div>
      <ul id="property-tab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
        <li class="nav-item flex-sm-fill"> <a id="home-tab" href="<?=HTACCESS_URL?>property-listing2/"  class="nav-link border-0 text-uppercase font-weight-bold active btn">For Sell</a> </li>
        <li class="nav-item flex-sm-fill"> <a id="profile-tab"  href="<?=HTACCESS_URL?>for-rent-list/" class="nav-link border-0 text-uppercase font-weight-bold btn">For rent</a> </li>
      </ul>
      <div class="property-form">
        <div class="tab-content">
          <div id="tab1" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade show active">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 pr-12">
                <div class="selectdiv">
                  <label>
                  <select>
                    <option selected="">State</option>
                    <option>State</option>
                    <option>State</option>
                  </select>
                  </label>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                <div class="selectdiv">
                  <label>
                  <select>
                    <option selected="">City</option>
                    <option>City</option>
                    <option>City</option>
                  </select>
                  </label>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
                <select class="select2 mb-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose Location">
                  <optgroup label="Ahmedabad">
                  <option value="AM">Ambli</option>
                  <option value="AN">Anand Nagar, Satellite</option>
                  <option value="AS">Ashram Road </option>
                  <option value="BA">Bodakdev</option>
                  <option value="CG">C.G. Road, Navrangpura</option>
                  <option value="DR">Drive In Road</option>
                  <option value="GU">Gurukul</option>
                  <option value="IS">Iscon-Ambli Road</option>
                  <option value="JO">Jodhpur, Satellite</option>
                  <option value="ME">Memnagar, Gurukul</option>
                  <option value="NA">Naranpura</option>
                  <option value="NA">Nava Vadaj</option>
                  <option value="NA">Navrangpura</option>
                  <option value="NI">Nirnay Nagar</option>
                  <option value="PA">Paldi</option>
                  <option value="PR">Prernatirth Derasar Road, Satellite</option>
                  <option value="RA">Ramdev Nagar, Satellite</option>
                  </optgroup>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pr-12">
                <select id="multi-select2" multiple="multiple" class="select-css form-control">
                  <option> Flat/Apartments</option>
                  <option> House/Bunglow </option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                <select id="multi-select3" multiple="multiple" class="select-css form-control">
<option>1 RK</option>
<option>1 BHK</option>
<option>1.5 BHK</option>
<option>2 BHK</option>
<option>2.5 BHK</option>
<option>3 BHK</option>
<option>3.5 BHK</option>
<option>4 BHK</option>
<option>4.5 BHK</option>
<option>5 BHK</option>
<option>5 +BHK</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
                <div class="form-group">
                  <section id="search-bar-Bg" class="boxSize">
                    <form id='res_form' method='post' novalidate search_type='PROPERTY' class='chkradCustom'  name='search_form'>
                      <input name="budget_min" value="" class="acoff" id="budget_min" type="hidden" nameinerr='Min Budget'/>
                      <input name="budget_max" value="" class="acoff" id="budget_max" type="hidden" nameinerr="Max Budget" />
                      <div id = 'searchBg'>
                        <div class="tab-items">
                          <div class="vShadow"></div>
                          <div id="search-fld-wraper">
                            <div  class='searchCtrlBox'>
                              <div class="ptype-input-wrap">
                                <div class="filter-item lf" id="budget_wrap">
                                  <div id="budget_sub_wrap" class="FI-Box"> <a class="FI-Tag ddLClick toggle-link dropDown frmEl" > <i class="setMid"></i>
                                    <div class="priceLbl">Price Range</div>
                                    <i class="arrow-D-Icon arrow-down_gray arrow1"></i> </a>
                                    <div id="s_budget" class="dd-list-menu ddlistOpen ddlstSrp showi  priceDrop flipClose" >
                                      <div class="combFI">
                                        <div id="buy_budget_min_wrap" class="FI-Box"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                          <div class="hyphen">Min</div>
                                          <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                          <div id="s_buy_budget_min" class="dd-list-menu ddlistOpen  showi" style="width:100%;">
                                            <div class="cScroll scrollbar96 mti5" style="height:200px">
                                              <div class="ddlist" id="buy_minprice"> <a val="2">5 Lacs</a><a val="3">10 Lacs</a><a val="4">15 Lacs</a><a val="5">20 Lacs</a><a val="6">25 Lacs</a><a val="7">30 Lacs</a><a val="8">40 Lacs</a><a val="9">50 Lacs</a><a val="10">60 Lacs</a><a val="11">75 Lacs</a><a val="12">90 Lacs</a><a val="13">1 Crore</a><a val="14">1.5 Crores</a><a val="15">2 Crores</a><a val="16">3 Crores</a><a val="17">5 Crores</a><a val="18">10 Crores</a><a val="19">20 Crores</a><a val="20">30 Crores</a><a val="21">40 Crores</a><a val="22">50 Crores</a><a val="23">60 Crores</a><a val="24">70 Crores</a><a val="25">80 Crores</a><a val="26">90 Crores</a><a val="27">100 Crores</a><a val="28">100+ Crores</a> </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div id="rent_budget_min_wrap" class="FI-Box" style="display:none;"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                          <div class="budget_inner_title hyphen">Min</div>
                                          <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                          <div id="s_rent_budget_min" class="dd-list-menu ddlistOpen  showi  " style="width:100%;">
                                            <div class="cScroll scrollbar96 mti5" style="height:200px" >
                                              <div class="ddlist" id="buy_minprice"> <a val="101">5,000</a><a val="102">10,000</a><a val="103">15,000</a><a val="104">20,000</a><a val="105">25,000</a><a val="106">30,000</a><a val="107">40,000</a><a val="108">50,000</a><a val="109">60,000</a><a val="110">75,000</a><a val="111">90,000</a><a val="112">1 Lac</a><a val="113">1.5 Lacs</a><a val="114">2 Lacs</a><a val="115">5 Lacs</a><a val="116">10 Lacs</a><a val="117">10+ Lacs</a> </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="FI-Box" id="buy_budget_max_wrap" style="margin-left:-3px"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                          <div>Max</div>
                                          <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                          <div id="s_buy_budget_max" class="dd-list-menu ddlistOpen  showi" style="margin-top:1px;width:100%;">
                                            <div class="cScroll scrollbar96 mti5" style="height:200px;">
                                              <div class="ddlist" id="buy_maxprice"> <a val="2">5 Lacs</a><a val="3">10 Lacs</a><a val="4">15 Lacs</a><a val="5">20 Lacs</a><a val="6">25 Lacs</a><a val="7">30 Lacs</a><a val="8">40 Lacs</a><a val="9">50 Lacs</a><a val="10">60 Lacs</a><a val="11">75 Lacs</a><a val="12">90 Lacs</a><a val="13">1 Crore</a><a val="14">1.5 Crores</a><a val="15">2 Crores</a><a val="16">3 Crores</a><a val="17">5 Crores</a><a val="18">10 Crores</a><a val="19">20 Crores</a><a val="20">30 Crores</a><a val="21">40 Crores</a><a val="22">50 Crores</a><a val="23">60 Crores</a><a val="24">70 Crores</a><a val="25">80 Crores</a><a val="26">90 Crores</a><a val="27">100 Crores</a><a val="28">100+ Crores</a> </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="FI-Box" id="rent_budget_max_wrap" style="display:none;margin-left: -3px;"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                          <div>Max</div>
                                          <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                          <div id="s_rent_budget_max" class="dd-list-menu ddlistOpen  showi" style="width:100%;  margin-top: 1px;">
                                            <div class="cScroll scrollbar96 mti5" style="height:200px;">
                                              <div class="ddlist" id="buy_maxprice"> <a val="101">5,000</a><a val="102">10,000</a><a val="103">15,000</a><a val="104">20,000</a><a val="105">25,000</a><a val="106">30,000</a><a val="107">40,000</a><a val="108">50,000</a><a val="109">60,000</a><a val="110">75,000</a><a val="111">90,000</a><a val="112">1 Lac</a><a val="113">1.5 Lacs</a><a val="114">2 Lacs</a><a val="115">5 Lacs</a><a val="116">10 Lacs</a><a val="117">10+ Lacs</a> </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="clr"></div>
                    </form>
                  </section>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 pr-12">
                <div class="form-group">
                  <select id="multi-select4" multiple="multiple" class="select-css form-control">
                 
                  
                   
                    <option>Resale</option>
                    <option>New Booking</option>
                   </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 div-n"> </div>
              <div class="col-lg-4 col-md-6 pr-12"> <a href="" class="pt-2 pb-2 font-16 font-bold text-white blue-bg btn d-block border-0 rounded-0 text-uppercase text-center"> Search <i class="flaticon-magnifier"></i> </a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="col-lg-2 col-md-3   text-right mb-3 float-right">
          <div class="selectdiv">
            <label>
            <select>
              <option selected="">New to Old</option>
              <option>Old to New</option>
            </select>
            </label>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-8">
        <h2 class="font-21 text-uppercase mb-4 title2">Listed <span class="themecolor">800+</span> Properties so far worth rs. <span class="themecolor">400+</span> crores</h2>
      </div>
      <div class="col-md-4 col-4 text-right btn-list"> <a href="<?=HTACCESS_URL?>property-listing/" class="btn"> <i class="fa fa-th-large" aria-hidden="true"></i></a> <a href="<?=HTACCESS_URL?>property-listing2/" class="btn active"><i class="fa fa-list" aria-hidden="true"> </i></a> </div>
    </div>
    <div class="row">
      <div class="col-12 row properties-div2 m-0 wow fadeIn">
        <div class="col-lg-4 col-md-4">
          <div class="img-pro text-center"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-1.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a> </div>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="properties-name pt-3 pl-3 pr-3 pb-0">
            <div class="row">
              <div class="col-md-7">
                <div class="for-sell">for SELL</div>
                <span class="montserrat font-semibold text-blue font-18 float-left">₹ 50 Lacs</span>
                <p class="float-left pl-3"><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
              </div>
              <div class="col-md-5">
                <div class="heart heart2">
                  <div class="row m-0">
                    <div class="col-lg-9 col-6 mt-3 mt-3">
                      <p> <strong>Post Date:</strong> 30/11/2019</p>
                    </div>
                    <div class="col-lg-3 col-6"><i class="fa fa-heart"></i></div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <h4 class="font-semibold mt-1 mb-3 float-left pr-3"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a> </h4>
            <div class="tag-css mb-3">FLAT</div>
            <div class="clearfix"></div>
            <p class="mb-4">This 2 BHK flat in Gota, Ahmedabad North is available for sale. It is a west facing property and a part of 
              Suyash Homes.</p>
            <div class="row m-0">
              <div class="col-md-6 p-0">
                <div class="list2">
                  <ul>
                    <li><i class="flaticon-hotel-sign"></i>02</li>
                    <li><i class="flaticon-bath-tub"></i>03</li>
                    <li><i class="flaticon-sports-car"></i>01</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>property-detail/" class="btn themebg text-white theme-btn mr-3">Show Details</a><a href="<?=HTACCESS_URL?>contact/" class="btn themebg text-white theme-btn">Contact Us</a></div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clerfix"></div>
      <div class="col-12 row properties-div2 m-0 wow fadeIn">
        <div class="col-lg-4 col-md-4">
          <div class="img-pro text-center"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-2.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a></div>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="properties-name pt-3 pl-3 pr-3 pb-0">
            <div class="row">
              <div class="col-md-7">
                <div class="for-sell">for SELL</div>
                <span class="montserrat font-semibold text-blue font-18 float-left">₹ 50 Lacs</span>
                <p class="float-left pl-3"><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
              </div>
              <div class="col-md-5">
                <div class="heart heart2">
                  <div class="row m-0">
                    <div class="col-lg-9 col-6 mt-3 mt-3">
                      <p> <strong>Post Date:</strong> 30/11/2019</p>
                    </div>
                    <div class="col-lg-3 col-6"><i class="fa fa-heart"></i></div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <h4 class="font-semibold mt-1 mb-3 float-left pr-3"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a> </h4>
            <div class="tag-css mb-3">FLAT</div>
            <div class="clearfix"></div>
            <p class="mb-4">This 2 BHK flat in Gota, Ahmedabad North is available for sale. It is a west facing property and a part of 
              Suyash Homes.</p>
            <div class="row m-0">
              <div class="col-md-6 p-0">
                <div class="list2">
                  <ul>
                    <li><i class="flaticon-hotel-sign"></i>02</li>
                    <li><i class="flaticon-bath-tub"></i>03</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>property-detail/" class="btn themebg text-white theme-btn mr-3">Show Details</a><a href="<?=HTACCESS_URL?>contact/" class="btn themebg text-white theme-btn">Contact Us</a></div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clerfix"></div>
      <div class="col-12 row properties-div2 m-0 wow fadeIn">
        <div class="col-lg-4 col-md-4">
          <div class="img-pro text-center"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-3.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="properties-name pt-3 pl-3 pr-3 pb-0">
            <div class="row">
              <div class="col-md-7">
                <div class="for-sell">for SELL</div>
                <span class="montserrat font-semibold text-blue font-18 float-left">₹ 50 Lacs</span>
                <p class="float-left pl-3"><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
              </div>
              <div class="col-md-5">
                <div class="heart heart2">
                  <div class="row m-0">
                    <div class="col-lg-9 col-6 mt-3 mt-3">
                      <p> <strong>Post Date:</strong> 30/11/2019</p>
                    </div>
                    <div class="col-lg-3 col-6"><i class="fa fa-heart"></i></div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <h4 class="font-semibold mt-1 mb-3 float-left pr-3"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a> </h4>
            <div class="tag-css mb-3">FLAT</div>
            <div class="clearfix"></div>
            <p class="mb-4">This 2 BHK flat in Gota, Ahmedabad North is available for sale. It is a west facing property and a part of 
              Suyash Homes.</p>
            <div class="row m-0">
              <div class="col-md-6 p-0">
                <div class="list2">
                  <ul>
                    <li><i class="flaticon-hotel-sign"></i>02</li>
                    <li><i class="flaticon-bath-tub"></i>03</li>
                    <li><i class="flaticon-sports-car"></i>01</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>property-detail/" class="btn themebg text-white theme-btn mr-3">Show Details</a><a href="<?=HTACCESS_URL?>contact/" class="btn themebg text-white theme-btn">Contact Us</a></div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clerfix"></div>
      <div class="col-12 row properties-div2 m-0 wow fadeIn">
        <div class="col-lg-4 col-md-4">
          <div class="img-pro text-center"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-4.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-4.jpg" alt="" title="" class="img-fluid"></a></div>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="properties-name pt-3 pl-3 pr-3 pb-0">
            <div class="row">
              <div class="col-md-7">
                <div class="for-sell">for SELL</div>
                <span class="montserrat font-semibold text-blue font-18 float-left">₹ 50 Lacs</span>
                <p class="float-left pl-3"><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
              </div>
              <div class="col-md-5">
                <div class="heart heart2">
                  <div class="row m-0">
                    <div class="col-lg-9 col-6 mt-3 mt-3">
                      <p> <strong>Post Date:</strong> 30/11/2019</p>
                    </div>
                    <div class="col-lg-3 col-6"><i class="fa fa-heart"></i></div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <h4 class="font-semibold mt-1 mb-3 float-left pr-3"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a> </h4>
            <div class="tag-css mb-3">FLAT</div>
            <div class="clearfix"></div>
            <p class="mb-4">This 2 BHK flat in Gota, Ahmedabad North is available for sale. It is a west facing property and a part of 
              Suyash Homes.</p>
            <div class="row m-0">
              <div class="col-md-6 p-0">
                <div class="list2">
                  <ul>
                    <li><i class="flaticon-hotel-sign"></i>02</li>
                    <li><i class="flaticon-bath-tub"></i>03</li>
                    <li><i class="flaticon-sports-car"></i>01</li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 p-0 list"> <a href="<?=HTACCESS_URL?>property-detail/" class="btn themebg text-white theme-btn mr-3">Show Details</a> <a href="<?=HTACCESS_URL?>contact/" class="btn themebg text-white theme-btn">Contact Us</a> </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clerfix"></div>
    </div>
    <div class="text-center"></div>
    <div class="col-12-md text-center">
      <ul class="pagination2">
        <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"></i></span> <span class="sr-only">Previous</span> </a> </li>
        <li class="page-item active"><a class="page-link" href="#">01</a></li>
        <li class="page-item"><a class="page-link" href="#">02</a></li>
        <li class="page-item"><a class="page-link" href="#">03</a></li>
        <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-angle-right"></i></span> <span class="sr-only">Next</span> </a> </li>
      </ul>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/vendor/price/jquery-min.js"></script>
<script>
$(document).ready(function () {
    $('.toggle-link').on('click',function(){
        $('.dd-list-menu').toggleClass('bring');
    });

});
</script>
<script src="<?=HTACCESS_URL?>assets/vendor/price/min.d.js"></script>
<script src="<?=HTACCESS_URL?>assets/vendor/price/home.min.js"></script>
<script src="<?=HTACCESS_URL?>assets/vendor/price/sugstcore.min.js"></script>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
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
<script>
    $(function() {
      
        // For select 2
        $(".select3").select2();
        
         
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
$('#multi-select4').multiselect({nonSelectedText: 'Booking Type'});



});
</script>
<input type='hidden' id="is_home" value="1">
