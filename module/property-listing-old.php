<!-- Header -->
<div class="center-section-in">
  <div class="container">
    <div>
      <ul id="property-tab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
        <li class="nav-item flex-sm-fill"> <a id="home-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active btn">For Sale</a> </li>
        <li class="nav-item flex-sm-fill"> <a id="profile-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold btn">For rent</a> </li>
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
                <select id="multi-select-demo" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>Area Location</option>
                  <option> Adalaj</option>
                  <option>Ambawadi</option>
                  <option>Ambli</option>
                  <option>Amraiwadi</option>
                  <option>Kolat</option>
                  <option>Kotarpur</option>
                  <option>Koteshwar</option>
                  <option>Lapkaman</option>
                  <option>Makarba</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pr-12">
                <select id="multi-select2" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>Property Type</option>
                  <option> Flat/Apartments</option>
                  <option> House/Bunglow </option>
                  
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                <select id="multi-select3" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>No. of Bedrooms</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
               <div class="form-group"> <section id="search-bar-Bg" class="boxSize">
                  <form id='res_form' method='post' novalidate search_type='PROPERTY' class='chkradCustom'  name='search_form'>
                    <input name="budget_min" value="" class="acoff" id="budget_min" type="hidden" nameinerr='Min Budget'/>
                    <input name="budget_max" value="" class="acoff" id="budget_max" type="hidden" nameinerr="Max Budget" />
                    <input name="tenant_pref" value="" class="acoff" id="available_for" type="hidden" />
                    <input name="sharing" value="" class="acoff" id="sharing" type="hidden" />
                    <input type="hidden" class='acoff' name="search_type" value ="QS"/>
                    <input type="hidden" class='acoff' name="refSection" value ="GNB"/>
                    <input type="hidden" class='acoff' name="search_location" value ="HP"/>
                    <input type="hidden" class='acoff' name=lstAcn value='HP_R'/>
                    <input type="hidden" class='acoff' name=lstAcnId value='0'/>
                    <input type="hidden" class='acoff' name=src id="src" value="L5"/>
                    <input name="preference" id="preference" class="acoff" type="hidden" value='S'/>
                    <input name="selected_tab" id="selected_tab" class="acoff" type="hidden" value='1'/>
                    <input name="city" id="city" type="text" class="acoff hide city"  required='true' nameinerr='City' focus='city_wrap_a'  customizedErrClass='custErr'/>
                    <input type="hidden" id='res_com' value='R' name="res_com" class="acoff" />
                    <input name="property_type" class="acoff hide" id="property_type" type="text" required="true" nameinerr="Property Type" focus="property_type_wrap_a" customizederrclass="custErr" autocomplete="off">
                    <div id = 'searchBg'>
                      <div class="tab-items">
                        <div class="vShadow"></div>
                        <div id="search-fld-wraper">
                          <div  class='  searchCtrlBox'>
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
                                            <div class="ddlist" id="buy_minprice"> <a val='0'>Min</a> <a val="2">5 Lacs</a><a val="3">10 Lacs</a><a val="4">15 Lacs</a><a val="5">20 Lacs</a><a val="6">25 Lacs</a><a val="7">30 Lacs</a><a val="8">40 Lacs</a><a val="9">50 Lacs</a><a val="10">60 Lacs</a><a val="11">75 Lacs</a><a val="12">90 Lacs</a><a val="13">1 Crore</a><a val="14">1.5 Crores</a><a val="15">2 Crores</a><a val="16">3 Crores</a><a val="17">5 Crores</a><a val="18">10 Crores</a><a val="19">20 Crores</a><a val="20">30 Crores</a><a val="21">40 Crores</a><a val="22">50 Crores</a><a val="23">60 Crores</a><a val="24">70 Crores</a><a val="25">80 Crores</a><a val="26">90 Crores</a><a val="27">100 Crores</a><a val="28">100+ Crores</a> </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="rent_budget_min_wrap" class="FI-Box" style="display:none;"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                        <div class="budget_inner_title hyphen">Min</div>
                                        <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                        <div id="s_rent_budget_min" class="dd-list-menu ddlistOpen  showi  " style="width:100%;">
                                          <div class="cScroll scrollbar96 mti5" style="height:200px" >
                                            <div class="ddlist" id="buy_minprice"> <a val='0'>Min</a> <a val="101">5,000</a><a val="102">10,000</a><a val="103">15,000</a><a val="104">20,000</a><a val="105">25,000</a><a val="106">30,000</a><a val="107">40,000</a><a val="108">50,000</a><a val="109">60,000</a><a val="110">75,000</a><a val="111">90,000</a><a val="112">1 Lac</a><a val="113">1.5 Lacs</a><a val="114">2 Lacs</a><a val="115">5 Lacs</a><a val="116">10 Lacs</a><a val="117">10+ Lacs</a> </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="FI-Box" id="buy_budget_max_wrap" style="margin-left:-3px"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                        <div>Max</div>
                                        <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                        <div id="s_buy_budget_max" class="dd-list-menu ddlistOpen  showi" style="margin-top:1px;width:100%;">
                                          <div class="cScroll scrollbar96 mti5" style="height:200px;">
                                            <div class="ddlist" id="buy_maxprice"> <a val='0'>Max</a> <a val="2">5 Lacs</a><a val="3">10 Lacs</a><a val="4">15 Lacs</a><a val="5">20 Lacs</a><a val="6">25 Lacs</a><a val="7">30 Lacs</a><a val="8">40 Lacs</a><a val="9">50 Lacs</a><a val="10">60 Lacs</a><a val="11">75 Lacs</a><a val="12">90 Lacs</a><a val="13">1 Crore</a><a val="14">1.5 Crores</a><a val="15">2 Crores</a><a val="16">3 Crores</a><a val="17">5 Crores</a><a val="18">10 Crores</a><a val="19">20 Crores</a><a val="20">30 Crores</a><a val="21">40 Crores</a><a val="22">50 Crores</a><a val="23">60 Crores</a><a val="24">70 Crores</a><a val="25">80 Crores</a><a val="26">90 Crores</a><a val="27">100 Crores</a><a val="28">100+ Crores</a> </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="FI-Box" id="rent_budget_max_wrap" style="display:none;margin-left: -3px;"> <a class="FI-Tag ddLClick  frmEl"> <i class="setMid"></i>
                                        <div>Max</div>
                                        <i class="arrow-D-Icon arrow-down_gray arrow2"></i> </a>
                                        <div id="s_rent_budget_max" class="dd-list-menu ddlistOpen  showi" style="width:100%;  margin-top: 1px;">
                                          <div class="cScroll scrollbar96 mti5" style="height:200px;">
                                            <div class="ddlist" id="buy_maxprice"> <a val='0'>Max</a> <a val="101">5,000</a><a val="102">10,000</a><a val="103">15,000</a><a val="104">20,000</a><a val="105">25,000</a><a val="106">30,000</a><a val="107">40,000</a><a val="108">50,000</a><a val="109">60,000</a><a val="110">75,000</a><a val="111">90,000</a><a val="112">1 Lac</a><a val="113">1.5 Lacs</a><a val="114">2 Lacs</a><a val="115">5 Lacs</a><a val="116">10 Lacs</a><a val="117">10+ Lacs</a> </div>
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
                </section></div>
              </div>
              <div class="col-lg-4 col-md-6 pr-12">
               <div class="form-group"> 
                <select class="form-control select-css font-14">
                  <option selected>Booking Type</option>
                  <option>Resale</option>
                  <option>New Booking</option>
                </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 div-n"> </div>
              <div class="col-lg-4 col-md-6 pr-12"> <a href="" class="pt-2 pb-2 font-16 font-bold text-white blue-bg btn d-block border-0 rounded-0 text-uppercase text-center"> Search <i class="flaticon-magnifier"></i> </a> </div>
            </div>
          </div>
          <div id="tab2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade">
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
                <select id="multi-select4" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>Area Location</option>
                  <option> Adalaj</option>
                  <option>Ambawadi</option>
                  <option>Ambli</option>
                  <option>Amraiwadi</option>
                  <option>Kolat</option>
                  <option>Kotarpur</option>
                  <option>Koteshwar</option>
                  <option>Lapkaman</option>
                  <option>Makarba</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pr-12">
                <select id="multi-select5" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>Property Type</option>
                  <option> Flat/Apartments</option>
                  <option> House/Bunglow </option>
                  
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12 pr-12">
                <select id="multi-select6" multiple="multiple" class="select-css form-control">
                  <option value="jQuery" selected>No. of Bedrooms</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
                <div class="span2 investRange">
                  <div class="btn-group">
                    <button id="min-max-price-range2" class="form-control selectpicker select-btn  dropdown-toggle searchParams" href="#" data-toggle="dropdown" tabindex="6">
                    <div class="filter-option pull-left span_price"> <span id="price_range12"> </span> <span id="price_range22">Price Range</span> </div>
                    <span class="bs-caret" ><span class="caret"></span></span> </button>
                    <!--<div class="dropdown-menu ddRange" role="menu">
                      <div class="rangemenu">
                        <div class="freeformPrice">
                          <div class="row">
                            <div class="col-md-6">
                              <input name="min_price" type="text" class="min_input form-control" placeholder="Select Minimum">
                            </div>
                            <div class="col-md-6">
                              <input name="max_price" type="text" class="max_input form-control" placeholder="Select Maximum">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
                <div class="col-md-4"> </div>
              <div class="col-md-4"> </div>
              <div class="col-md-4 pr-12"> <a href="" class="pt-2 pb-2 font-16 font-bold text-white blue-bg btn d-block border-0 rounded-0 text-uppercase text-center"> Search <i class="flaticon-magnifier"></i> </a> </div>
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
      <div class="col-md-4 col-4 text-right btn-list"> <a href="<?=HTACCESS_URL?>property-listing/" class="btn active"> <i class="fa fa-th-large" aria-hidden="true"></i></a> <a href="<?=HTACCESS_URL?>property-listing2/" class="btn"> <i class="fa fa-list" aria-hidden="true"></i></a> </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-1.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
              <div class="clearfix"></div>
            <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-2.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
              <div class="clearfix"></div>
            <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-3.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
             <div class="clearfix"></div>
            <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-4.jpg"><img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
              
              
            </div>
            <div class="clearfix"></div>
            <p> <strong>Post Date:</strong> 30/11/2019</p>
            
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-2.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                  <li><i class="flaticon-sports-car"></i>01</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
            <div class="clearfix"></div>
                <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-3.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                  <li><i class="flaticon-sports-car"></i>01</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
            <div class="clearfix"></div>
                <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-1.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
            <div class="clearfix"></div>
                <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-2.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a> </div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                  <li><i class="flaticon-sports-car"></i>01</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
            <div class="clearfix"></div>
                <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a data-fancybox="gallery" href="<?=HTACCESS_URL?>assets/img/property/property-3.jpg"> <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
          <div class="properties-name">
            <div class="float-left">
              <div class="for-sell">for SELL</div>
              <span class="montserrat font-semibold text-blue font-18">₹ 2.2 Cr</span></div>
            <div class="float-right">
              <div class="bungalow">Bungalow</div>
            </div>
            <div class="clearfix"></div>
            <h3 class="font-18 font-semibold"><a href="<?=HTACCESS_URL?>property-detail/">Property Name</a></h3>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Ambawadi, Ahmedabad</p>
            <div class="border-top">
              <div class="sq">
                <ul>
                  <li><i class="flaticon-hotel-sign"></i>05</li>
                  <li><i class="flaticon-bath-tub"></i>03</li>
                </ul>
              </div>
              <div class="heart"><i class="fa fa-heart"></i></div>
            </div>
            <div class="clearfix"></div>
                <p> <strong>Post Date:</strong> 30/11/2019</p>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center"></div>
    <div class="col-12-md text-center">
      <ul class="pagination2">
        <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"></i></span> <span class="sr-only">Previous</span> </a> </li>
        <li class="page-item active"><a class="page-link" href="#">01</a></li>
        <li class="page-item"><a class="page-link" href="#">02</a></li>
        <li class="page-item"><a class="page-link" href="#">03</a></li>
        <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true"> <i class="fa fa-angle-right"></i></span> <span class="sr-only">Next</span> </a> </li>
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


<script type="text/javascript">
    var jq = $.noConflict();
</script>

<?php include(INCLUDE_DIR.'footer.php'); ?>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>

<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?=HTACCESS_URL?>assets/vendor/select/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#multi-select-demo').multiselect();
$('#multi-select2').multiselect();
$('#multi-select3').multiselect();


$('#multi-select4').multiselect();
$('#multi-select5').multiselect();
$('#multi-select6').multiselect();

$('#multi-select7').multiselect();
$('#multi-select8').multiselect();



});
</script>
<input type='hidden' id="is_home" value="1">
