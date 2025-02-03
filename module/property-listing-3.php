<!-- Header -->
<div class="center-section-in">
  <div class="container">
    <div>
      <ul id="property-tab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
        <li class="nav-item flex-sm-fill"> <a id="home-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active btn">For Sell</a> </li>
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
                <div class="span2 investRange">
                  <div class="btn-group">
                    <button id="min-max-price-range" class="form-control selectpicker select-btn  dropdown-toggle searchParams" href="#" data-toggle="dropdown" tabindex="6">
                    <div class="filter-option pull-left span_price"> <span id="price_range1"> </span>
                    <span id="price_range2">Price Range</span> </div>
                    <span class="bs-caret" ><span class="caret"></span></span> </button>
                    <div class="dropdown-menu ddRange" role="menu">
                      <div class="rangemenu">
                        <div class="freeformPrice">
                          <div class="row">
                            <div class="col-md-6">
                          <input name="min_price" type="text" class="min_input form-control" placeholder="Min Price">
                            </div>
                            <div class="col-md-6">
                          <input name="max_price" type="text" class="max_input form-control" placeholder="Max Price">
                            </div>
                          </div>
                        </div>
                        <div class="row m-0">
                          <div class="price_Ranges rangesMax col-md-6" style="overflow-y:scroll; height:200px"> 
                        <a class="max_value" value="" href="javascript:void(0)">Any Max</a> 
<a class="max_value" value="10lakhs" href="javascript:void(0)">10 lakhs</a> 
<a class="max_value" value="25lakhs" href="javascript:void(0)">25 lakhs</a> 
<a class="max_value" value="50lakhs" href="javascript:void(0)">50 lakhs</a> 
<a class="max_value" value="1cr" href="javascript:void(0)">1 cr</a> 
<a class="max_value" value="5cr" href="javascript:void(0)">5 cr</a> 
<a class="max_value" value="10cr<" href="javascript:void(0)">10 cr</a> 
<a class="max_value" value="50cr" href="javascript:void(0)">50 cr</a> 
<a class="max_value" value="100cr" href="javascript:void(0)">100 cr</a> 
<a class="max_value" value="200cr" href="javascript:void(0)">200 cr</a> 
<a class="max_value" value="500cr" href="javascript:void(0)">500 cr</a> 
                          </div>
                          <div class="price_Ranges rangesMin col-md-6" style="overflow-y:scroll; height:200px"> 
                       <a class="min_value" value="" href="javascript:void(0)">Any Max</a> 
<a class="min_value" value="10lakhs" href="javascript:void(0)">10 lakhs</a> 
<a class="min_value" value="25lakhs" href="javascript:void(0)">25 lakhs</a> 
<a class="min_value" value="50lakhs" href="javascript:void(0)">50 lakhs</a> 
<a class="min_value" value="1cr" href="javascript:void(0)">1 cr</a> 
<a class="min_value" value="5cr" href="javascript:void(0)">5 cr</a> 
<a class="min_value" value="10cr<" href="javascript:void(0)">10 cr</a> 
<a class="min_value" value="50cr" href="javascript:void(0)">50 cr</a> 
<a class="min_value" value="100cr" href="javascript:void(0)">100 cr</a> 
<a class="min_value" value="200cr" href="javascript:void(0)">200 cr</a> 
<a class="min_value" value="500cr" href="javascript:void(0)">500 cr</a> 

                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              
              
<div class="col-md-4 pr-12">
          
                <select class="form-control select-css font-14"> 
<option selected>Booking Type</option>
<option>Resale</option>
<option>New Booking</option>

                </select> </div>
<div class="col-md-4"> </div>               
<div class="col-md-4 pr-12"> <a href="" class="pt-2 pb-2 font-16 font-bold text-white blue-bg btn d-block border-0 rounded-0 text-uppercase text-center"> Search <i class="flaticon-magnifier"></i> </a> </div>
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
<option>1 BHK</option>
<option>2 BHK</option>
<option>3 BHK</option>
<option>4 BHK</option>
<option>5 BHK</option>
<option>6 BHK</option>
<option>7 BHK</option>
                </select>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 pl-12">
                <div class="span2 investRange">
                  <div class="btn-group">
                    <button id="min-max-price-range2" class="form-control selectpicker select-btn  dropdown-toggle searchParams" href="#" data-toggle="dropdown" tabindex="6">
                    <div class="filter-option pull-left span_price"> <span id="price_range12"> </span> 
                    <span id="price_range22">Price Range</span> </div>
                    <span class="bs-caret" ><span class="caret"></span></span> </button>
                    <div class="dropdown-menu ddRange" role="menu">
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
                        <div class="row m-0">
                          <div class="price_Ranges rangesMax col-md-6" style="overflow-y:scroll; height:200px"> 
                    
<a class="max_value" value="" href="javascript:void(0)">Any Max</a> 
<a class="max_value" value="10lakhs" href="javascript:void(0)">10 lakhs</a> 
<a class="max_value" value="25lakhs" href="javascript:void(0)">25 lakhs</a> 
<a class="max_value" value="50lakhs" href="javascript:void(0)">50 lakhs</a> 
<a class="max_value" value="1cr" href="javascript:void(0)">1 cr</a> 
<a class="max_value" value="5cr" href="javascript:void(0)">5 cr</a> 
<a class="max_value" value="10cr<" href="javascript:void(0)">10 cr</a> 
<a class="max_value" value="50cr" href="javascript:void(0)">50 cr</a> 
<a class="max_value" value="100cr" href="javascript:void(0)">100 cr</a> 
<a class="max_value" value="200cr" href="javascript:void(0)">200 cr</a> 
<a class="max_value" value="500cr" href="javascript:void(0)">500 cr</a> 
                    
                    
               
                          </div>
                          <div class="price_Ranges rangesMin col-md-6" style="overflow-y:scroll; height:200px"> 
                         
<a class="min_value" value="" href="javascript:void(0)">Any Max</a> 
<a class="min_value" value="10lakhs" href="javascript:void(0)">10 lakhs</a> 
<a class="min_value" value="25lakhs" href="javascript:void(0)">25 lakhs</a> 
<a class="min_value" value="50lakhs" href="javascript:void(0)">50 lakhs</a> 
<a class="min_value" value="1cr" href="javascript:void(0)">1 cr</a> 
<a class="min_value" value="5cr" href="javascript:void(0)">5 cr</a> 
<a class="min_value" value="10cr<" href="javascript:void(0)">10 cr</a> 
<a class="min_value" value="50cr" href="javascript:void(0)">50 cr</a> 
<a class="min_value" value="100cr" href="javascript:void(0)">100 cr</a> 
<a class="min_value" value="200cr" href="javascript:void(0)">200 cr</a> 
<a class="min_value" value="500cr" href="javascript:void(0)">500 cr</a> 

                      
                          </div>
                        </div>
                      </div>
                       
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 pr-12">
          
                <select class="form-control select-css font-14"> 
<option selected>Booking Type</option>
<option>Resale</option>
<option>New Booking</option>

                </select> </div>
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
      <div class="clearfix"></div>
      <div class="col-md-8 col-8">
        <h2 class="font-21 text-uppercase mb-4 title2">Listed <span class="themecolor">800+</span> 
        Properties so far worth rs. <span class="themecolor">400+</span> crores</h2>
      </div>
      <div class="col-md-4 col-4 text-right btn-list"> 
      <a href="<?=HTACCESS_URL?>property-listing/" class="btn active">
      <i class="fa fa-th-large" aria-hidden="true"></i></a>
      <a href="<?=HTACCESS_URL?>property-listing2/" class="btn">
      <i class="fa fa-list" aria-hidden="true"></i></a> </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-1.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-2.jpg" alt="" title="" class="img-fluid"></a>
          </div>
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
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 wow fadeIn">
        <div class="properties-div">
          <div class="img-pro"> <a href="<?=HTACCESS_URL?>property-detail/">
          <img src="<?=HTACCESS_URL?>assets/img/property/property-3.jpg" alt="" title="" class="img-fluid"></a></div>
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
          </div>
        </div>
      </div>
    </div>
    <div class="text-center"></div>
    <div class="col-12-md text-center">
      <ul class="pagination2">
        <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> 
        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span> <span class="sr-only">Previous</span> 
        </a> </li>
        <li class="page-item active"><a class="page-link" href="#">01</a></li>
        <li class="page-item"><a class="page-link" href="#">02</a></li>
        <li class="page-item"><a class="page-link" href="#">03</a></li>
        <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">
        <i class="fa fa-angle-right"></i></span> <span class="sr-only">Next</span> </a> </li>
      </ul>
    </div>
  </div>
</div>
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
<script>
      $('.dropdown-menu.ddRange')
        .click(function(e) {
          e.stopPropagation();
        });

      function disableDropDownRangeOptions(max_values, minValue) {
        if (max_values) {
          max_values.each(function() {
            var maxValue = $(this).attr("value");

            if (parseInt(maxValue) < parseInt(minValue)) {
              $(this).addClass('disabled');
            } else {
              $(this).removeClass('disabled');
            }
          });
        }
      }

      function setuinvestRangeDropDownList(min_values, max_values, min_input, max_input, clearLink, dropDownControl) {
        min_values.click(function() {
          var minValue = $(this).attr('value');
          min_input.val(minValue);
          document.getElementById('price_range1').innerHTML = minValue;

          disableDropDownRangeOptions(max_values, minValue);

          validateDropDownInputs();
        });

        max_values.click(function() {
          var maxValue = $(this).attr('value');
          max_input.val(maxValue);
          document.getElementById('price_range2').innerHTML = maxValue;

          toggleDropDown();
        });

        clearLink.click(function() {
          min_input.val('');
          max_input.val('');

          disableDropDownRangeOptions(max_values);

          validateDropDownInputs();
        });

        min_input.on('input',
          function() {
            var minValue = min_input.val();

            disableDropDownRangeOptions(max_values, minValue);
            validateDropDownInputs();
          });

        max_input.on('input', validateDropDownInputs);

        max_input.blur('input',
          function() {
            toggleDropDown();
          });

        function validateDropDownInputs() {
          var minValue = parseInt(min_input.val());
          var maxValue = parseInt(max_input.val());

          if (maxValue > 0 && minValue > 0 && maxValue < minValue) {
            min_input.addClass('inputError');
            max_input.addClass('inputError');

            return false;
          } else {
            min_input.removeClass('inputError');
            max_input.removeClass('inputError');

            return true;
          }
        }

        function toggleDropDown() {
          if (validateDropDownInputs() &&
            parseInt(min_input.val()) > 0 &&
            parseInt(max_input.val()) > 0) {

            // auto close if two values are valid
            dropDownControl.dropdown('toggle');
          }
        }
      }

      setuinvestRangeDropDownList(
        $('.investRange .min_value'),
        $('.investRange .max_value'),
        $('.investRange .freeformPrice .min_input'),
        $('.investRange .freeformPrice .max_input'),
        $('.investRange .btnClear'),
        $('.investRange .dropdown-toggle'));

</script> 
<script>
      $('.dropdown-menu.ddRange')
        .click(function(e) {
          e.stopPropagation();
        });

      function disableDropDownRangeOptions(max_values, minValue) {
        if (max_values) {
          max_values.each(function() {
            var maxValue = $(this).attr("value");

            if (parseInt(maxValue) < parseInt(minValue)) {
              $(this).addClass('disabled');
            } else {
              $(this).removeClass('disabled');
            }
          });
        }
      }

      function setuinvestRangeDropDownList(min_values, max_values, min_input, max_input, clearLink, dropDownControl) {
        min_values.click(function() {
          var minValue = $(this).attr('value');
          min_input.val(minValue);
          document.getElementById('price_range12').innerHTML = minValue;

          disableDropDownRangeOptions(max_values, minValue);

          validateDropDownInputs();
        });

        max_values.click(function() {
          var maxValue = $(this).attr('value');
          max_input.val(maxValue);
          document.getElementById('price_range22').innerHTML = maxValue;

          toggleDropDown();
        });

        clearLink.click(function() {
          min_input.val('');
          max_input.val('');

          disableDropDownRangeOptions(max_values);

          validateDropDownInputs();
        });

        min_input.on('input',
          function() {
            var minValue = min_input.val();

            disableDropDownRangeOptions(max_values, minValue);
            validateDropDownInputs();
          });

        max_input.on('input', validateDropDownInputs);

        max_input.blur('input',
          function() {
            toggleDropDown();
          });

        function validateDropDownInputs() {
          var minValue = parseInt(min_input.val());
          var maxValue = parseInt(max_input.val());

          if (maxValue > 0 && minValue > 0 && maxValue < minValue) {
            min_input.addClass('inputError');
            max_input.addClass('inputError');

            return false;
          } else {
            min_input.removeClass('inputError');
            max_input.removeClass('inputError');

            return true;
          }
        }

        function toggleDropDown() {
          if (validateDropDownInputs() &&
            parseInt(min_input.val()) > 0 &&
            parseInt(max_input.val()) > 0) {

            // auto close if two values are valid
            dropDownControl.dropdown('toggle');
          }
        }
      }

      setuinvestRangeDropDownList(
        $('.investRange .min_value'),
        $('.investRange .max_value'),
        $('.investRange .freeformPrice .min_input'),
        $('.investRange .freeformPrice .max_input'),
        $('.investRange .btnClear'),
        $('.investRange .dropdown-toggle'));

</script>