function supports_input_placeholder() {
    return "placeholder" in document.createElement("input")
}
var BASE_RES_PROP_TYPE_URL_STR = "property",
    BASE_COM_PROP_TYPE_URL_STR = "commercial-property",
    BASE_RES_LAND_PROP_TYPE_URL_STR = "residential-land",
    BASE_COM_LAND_PROP_TYPE_URL_STR = "commercial-land",
    BASE_RES_DEALER_URL_STR = "",
    BASE_COM_DEALER_URL_STR = "commercial",
    BASE_LAND_DEALER_URL_STR = "land",
    SEO_LAND_AREA_TYPE_VAL = "2",
    SEO_COM_AREA_TYPE_VAL = "1",
    SEO_RES_AREA_TYPE_VAL = "1",
    BASE_PG_PROP_TYPE_URL_STR = "paying-guest-pg",
    search = {
        search_type: "",
        log_message: 0,
        seo_url: "",
        query_data: [],
        input_data: [],
        canonical_url: "",
        prop_type_map: [],
        res_com_prop_type_map: [],
        land_prop_types: [],
        city_locs: [],
        default_keyword_text: "Type Locality, Builder, Project...",
        area_seo_str_map: {
            1: "sq-ft",
            2: "sq-yard"
        },
        getUrlFieldsMap: function() {
            var a;
            return "PROPERTY" == this.search_type || "PROJECT" == this.search_type ? a = {
                res_com: {
                    static: 1
                },
                preference: {
                    method: "populatePreferenceData",
                    static: 1
                },
                bedroom_num: {
                    method: "populateBedroomData",
                    static: 1
                },
                property_type: {
                    method: "populatePropertyTypeData",
                    static: 1
                },
                locality: {
                    static: 1
                },
                city: {
                    method: "populateLocalityCityData",
                    static: 1
                },
                area_min: {
                    method: "populateAreaData",
                    static: 1
                },
                area_max: {
                    static: 1
                },
                area_unit: {
                    static: 1
                },
                price_min: {
                    method: "populatePriceData",
                    static: 1
                },
                price_max: {
                    static: 1
                },
                mapsearch: {
                    static: 1
                }
            } : "DEALER" == this.search_type && (a = {
                res_com: {
                    static: 1
                },
                preference: {
                    method: "populatePreferenceData",
                    static: 1
                },
                property_type: {
                    method: "populatePropertyTypeData",
                    static: 1
                },
                locality: {
                    static: 1
                },
                city: {
                    method: "populateLocalityCityData",
                    static: 1
                },
                mapsearch: {
                    static: 1
                }
            }), a.is_land_prop_type = {
                static: 1
            }, a
        },
        populateSeoData: function(a, b) {
            return this.resetVariables(a, b) && this.sanitizeData() && this.populateQueryStringFields() && this.buildCanonicalUrl() && this.buildStaticUrl()
        },
        sanitizeData: function() {
            this.populateSeoResComData(), void 0 != this.input_data.keyword && this.input_data.keyword == this.default_keyword_text && (this.input_data.keyword = ""), "" == this.input_data.keyword.trim() && delete this.input_data.keyword;
            var a = void 0 != this.input_data.locality ? this.input_data.locality : "";
            "" != a && arr.is_arr_obj(a) && (this.input_data.locality = arr.array_unique(a));
            var b = void 0 != this.input_data.bedroom_num ? this.input_data.bedroom_num : "";
            "" == b || arr.is_arr_obj(b) || (this.input_data.bedroom_num = b.split(","));
            var c = void 0 != this.input_data.area_min ? this.input_data.area_min : "",
                d = void 0 != this.input_data.area_max ? this.input_data.area_max : "";
            return (isNaN(c) || 0 == c) && (c = this.input_data.area_min = ""), (isNaN(d) || 0 == d) && (d = this.input_data.area_max = ""), "" != c && "" != d && parseInt(c) > parseInt(d) && (this.input_data.area_max = c, this.input_data.area_min = d), !0
        },
        populateQueryStringFields: function() {
            var a = this.getUrlFieldsMap();
            queryData = [];
            for (key in this.input_data) {
                var b = this.input_data[key];
                void 0 != a[key] && 1 == a[key].static || (queryData[key] = b && arr.is_arr_obj(b) ? b.join(",") : b)
            }
            return this.query_data = queryData, !0
        },
        buildCanonicalUrl: function() {
            var a = this.getUrlFieldsMap();
            for (fieldName in a)
                if (fieldData = a[fieldName], void 0 != fieldData && null != fieldData) {
                    var b = void 0 != fieldData.method ? fieldData.method : "";
                    if ("" == b) continue;
                    var c = this[b].apply(this);
                    if (void 0 == c || 0 == c || null == c) return this.logMessage("Calling Url Creation Method " + b + " Failed"), !1
                } return this.canonical_url = this.canonical_url.toLowerCase(), this.canonical_url = this.canonical_url.replace(/-$/, ""), this.canonical_url += "-ffid", !0
        },
        buildStaticUrl: function() {
            var a = "";
            for (key in this.query_data) {
                if ("strEntityMap" == key) var b = Base64.encode(this.query_data[key]);
                else var b = this.query_data[key];
                "" != b && 0 != b && (a += key + "=" + encodeURIComponent(b) + "&")
            }
            return a = a.replace(/&$/, ""), this.seo_url = "" == a ? this.canonical_url : this.canonical_url + "?" + a, !0
        },
        populatePreferenceData: function() {
            var a, b, c, d;
            return a = void 0 != this.input_data.preference ? this.input_data.preference : "", c = void 0 != this.input_data.mapsearch ? this.input_data.mapsearch : "", d = this.search_type, b = arr.in_array(["R", "P", "L"], a) ? "rent-" : "", "DEALER" != d && "1" == c && (b += "map-view-"), this.canonical_url += b, !0
        },
        populateBedroomData: function() {
            var a = void 0 != this.input_data.bedroom_num ? this.input_data.bedroom_num : "";
            if ("" == a) return !0;
            if (a = arr.to_arr(a), a.length > 1 || "P" === this.input_data.preference) this.query_data.bedroom_num = a;
            else {
                if (bedroomNum = a[0], "" == bedroomNum || 0 == parseInt(bedroomNum)) return !0;
                this.canonical_url += bedroomNum < 10 ? bedroomNum + "-BHK-" : "9-plus-BHK-"
            }
            return !0
        },
        populatePropertyTypeData: function() {
            var a = void 0 != this.input_data.property_type ? this.input_data.property_type : [];
            a = arr.to_arr(a), resCom = this.input_data.res_com, isLandPropType = this.input_data.is_land_prop_type;
            var b = Array();
            if ("PROJECT" == this.search_type) {
                var c = arr.in_array(["C", "COM"], this.input_data.res_com) ? "26" : "23",
                    d = this.getPropTypeSeoUrlStr(c);
                for (var e in a) arr.in_array(["23", "26", "R", "C"], a[e]) || (b[e] = a[e]);
                b.length > 0 && (this.query_data.property_type = b.join(","))
            } else if ("PROPERTY" == this.search_type)
                if ("P" === this.input_data.preference) {
                    var d = BASE_PG_PROP_TYPE_URL_STR;
                    this.query_data.property_type = a.join(",")
                } else if (a.length > 1) {
                var d = "R" == resCom ? 0 == isLandPropType ? BASE_RES_PROP_TYPE_URL_STR : BASE_RES_LAND_PROP_TYPE_URL_STR : 0 == isLandPropType ? BASE_COM_PROP_TYPE_URL_STR : BASE_COM_LAND_PROP_TYPE_URL_STR;
                this.query_data.property_type = a.join(",")
            } else var d = this.getPropTypeSeoUrlStr(a[0]);
            else if ("DEALER" == this.search_type) {
                var d = 0 != isLandPropType ? BASE_LAND_DEALER_URL_STR : "R" == resCom ? BASE_RES_DEALER_URL_STR : BASE_COM_DEALER_URL_STR;
                d += "" != d ? "-real-estate-agents" : "real-estate-agents";
                for (var e in a) arr.in_array(["R", "C"], a[e]) || (b[e] = a[e]);
                b.length > 0 && (this.query_data.property_type = b.join(","))
            }
            return this.canonical_url += d + "-", !0
        },
        populateLocalityCityData: function() {
            var a = void 0 != this.input_data.city ? this.input_data.city : "",
                b = void 0 != this.input_data.locality ? this.input_data.locality : [];
            if (b = arr.to_arr(b), "" == a) return !1;
            if (1 == b.length) var c = this.getLocalitySeoUrlStr(b[0]);
            else {
                b.length > 1 && (this.query_data.locality = b.join(","));
                var c = this.getCitySeoUrlStr(a)
            }
            return void 0 != c && null != c && "" != c && (this.canonical_url += "in-" + c + "-", !0)
        },
        populateAreaData: function() {
            var a = void 0 != this.input_data.area_min ? this.input_data.area_min : "",
                b = void 0 != this.input_data.area_max ? this.input_data.area_max : "",
                c = void 0 != this.input_data.area_unit ? this.input_data.area_unit : "";
            if (a = isNaN(a) ? "" : a, b = isNaN(b) ? "" : b, "" == a || "" == b || "" == c) "" != a && (this.query_data.area_min = a), "" != b && (this.query_data.area_max = b), "" != c && (this.query_data.area_unit = c);
            else {
                var d = (this.input_data.res_com, this.input_data.is_land_prop_type),
                    e = 0 != d ? SEO_LAND_AREA_TYPE_VAL : SEO_RES_AREA_TYPE_VAL;
                c != e ? (this.query_data.area_unit = c, minAreaCon = this.convertArea(a, c, e), maxAreaCon = this.convertArea(b, c, e)) : (minAreaCon = a, maxAreaCon = b), minAreaCon = Math.round(minAreaCon), maxAreaCon = Math.round(maxAreaCon), 0 == minAreaCon || 0 == maxAreaCon ? (this.query_data.area_min = a, this.query_data.area_max = b) : (areaSeoStr = this.getAreaSeoUrlStr(e), this.canonical_url += minAreaCon + "-" + areaSeoStr + "-to-" + maxAreaCon + "-" + areaSeoStr + "-")
            }
            return !0
        },
        populatePriceData: function() {
            var a = void 0 != this.input_data.price_min ? this.input_data.price_min : "",
                b = void 0 != this.input_data.price_max ? this.input_data.price_max : "";
            if ("" == a || "" == b) "" != a && (this.query_data.price_min = a), "" != b && (this.query_data.price_max = b);
            else {
                var c = this.getPriceSeoUrlStr(a),
                    d = this.getPriceSeoUrlStr(b);
                this.canonical_url += c + "-to-" + d
            }
            return !0
        },
        populateSeoResComData: function() {
            var a = void 0 == this.input_data.property_type || "" == this.input_data.property_type ? [] : this.input_data.property_type;
            if (a = arr.to_arr(a), a.length <= 0) {
                var b = this.getResComByCookie();
                b = void 0 != b ? b : void 0 != this.input_data.res_com ? this.input_data.res_com : "R";
                var c = !1
            } else {
                var c = !0;
                for (key in a)
                    if (propType = a[key], 0 == (c = c && this.isLandPropType(propType))) break;
                var b = this.getResComByPropertyType(a[0])
            }
            return this.input_data.res_com = b, this.input_data.is_land_prop_type = c, !0
        },
        getPriceSeoUrlStr: function(a) {
            return this.getPriceStr(a).toString().replace(".", "-point-")
        },
        getPriceStr: function(a) {
            var b, c, d = "string" != typeof a ? a.toString() : a,
                e = d.length;
            return 8 == e || 9 == e || 10 == e ? (c = (a / 1e7).toString(), b = c + "-crore" + ("1" == c ? "" : "s")) : 6 == e || 7 == e ? (c = (a / 1e5).toString(), b = c + "-lakh" + ("1" == c ? "" : "s")) : 4 != e && 5 != e || (c = (a / 1e3).toString(), b = c + "-thousand"), b
        },
        getAreaSeoUrlStr: function(a) {
            return this.area_seo_str_map[a]
        },
        getPropTypeSeoUrlStr: function(a) {
            var b = this.prop_type_map;
            for (var c in b)
                if (c == a) {
                    var d = b[c];
                    return d.SEO_URL_STRING
                } return ""
        },
        getCitySeoUrlStr: function(a) {
            var b = this.city_map;
            for (var c in b)
                if (c == a) {
                    var d = b[c];
                    return d.SEO_URL_STRING
                } return ""
        },
        getLocalitySeoUrlStr: function(a) {
            a = a.toString();
            var b = this.city_locs["'" + a + "'"];
            return void 0 != b ? b.SEO_URL_STRING : ""
        },
        isLandPropType: function(a) {
            landPropertyTypes = this.land_prop_types;
            for (var b in landPropertyTypes)
                if (landPropertyTypes[b] == a) return !0;
            return !1
        },
        getResComByPropertyType: function(a) {
            if (arr.in_array(["23", "R"], a)) return "R";
            if (arr.in_array(["26", "C"], a)) return "C";
            var b = this.res_com_prop_type_map;
            for (resCom in b) {
                var c = b[resCom];
                if (arr.in_array(c, a)) return resCom
            }
            return ""
        },
        convertArea: function(a, b, c) {
            return areaSqFt = area_conversion(b, a, 1), a = area_conversion(c, areaSqFt, 2)
        },
        logMessage: function(a) {
            1 == this.log_message && console.log(a)
        },
        resetVariables: function(a, b) {
            return this.search_type = a, this.input_data = b, this.query_data = null, this.canonical_url = "", this.seo_url = "", !0
        },
        getResComByCookie: function() {
            var a = getCookieVal("RES_COM");
            return void 0 == a ? void 0 : arr.in_array(["C", "COM"], a) ? "C" : "R"
        },
        buildSearchStaticData: function() {
            ajax.getText({
                url: "/do/common/setSearchStaticData",
                method: "GET"
            }, search.setSearchStaticData, search.failure)
        },
        setSearchStaticData: function(txt) {
            var data = eval("(" + txt + ")");
            for (var searchParam in data) search[searchParam] = data[searchParam]
        },
        failure: function(a, b) {}
    },
    searchUtil = {
        rdio_map: ["res_buy", "res_com_rd", "rent_pg", "resdlr", "comdlr", "commr_buy"],
        submitHeader5Form: function(a, b) {
            var c, d, e;
            if (c = GA(a, "search_type"), d = frmUtil.getFormData(a), void 0 === d.preference && (d.preference = "S"), isset(d.class) && arr.is_arr_obj(d.class) && (d.class = d.class.join(",")), "PROJECT" == c) f = this.getNpFormPropType(a);
            else var f = void 0 != a.property_type ? a.property_type.value : null;
            if (d.property_type = null != f ? f.replace(/:/g, ",").replace(/,$/, "").split(",") : null, d = this.formatSearchData(d, c), -1 != $(a).attr("id").indexOf("lead_search")) return "1" == $("#lead_search #removeLocalitySearch").val() && (d.locality = 0, $("#lead_search #removeLocalitySearch").val("0")), leadSrch.displayResults(d), !0;
            for (e in this.rdio_map) delete d[this.rdio_map[e]];
            if ("" == $(a).find("#availability").val() && $(a).find("#availability").remove(), "" == $(a).find("#class").val() && $(a).find("#class").remove(), 0 == searchUrl.populateSearchData(c, d)) return !1;
            if (SA(a, "action", "/" + searchUrl.seo_url), $("#boostWorkFlow").length) {
                var g = '<input type="hidden" name="propid" value="' + boostWorkFlow.propId + '" />';
                $(a).append(g)
            }
            return void 0 !== b && 0 != b || $("#search-bar-Bg.searchHeader").length || toglTxtOnBtn("Searching...", "submit_query"), !0
        },
        getNpFormPropType: function(a) {
            var b, c;
            return "np_landing" == a.id ? c = frmUtil.getRadioElemsValue(a.res_com) : void 0 !== a.res_com && void 0 !== a.res_com.value && arr.in_array(["R", "C"], a.res_com.value) ? c = a.res_com.value : (b = void 0 !== a.property_type ? a.property_type.value : null, b = null !== b ? b.replace(/:/g, ",").replace(/,$/, "").split(",") : null, c = search.getResComByPropertyType(b[0])), b = "C" == c ? "26" : "23"
        },
        formatSearchData: function(a, b) {
            if (a.hasOwnProperty("property_type") && a.property_type || "PROJECT" == b || (a.hasOwnProperty("type") && (a.property_type = a.type, delete a.type), a.hasOwnProperty("orig_property_type") && (a.property_type = a.orig_property_type), a.hasOwnProperty("res_com") && (a.property_type = a.res_com)), a.hasOwnProperty("property_type") && "PROPERTY" == b && a.property_type.length > 1 && (arr.in_array(a.property_type, "23") && a.property_type.splice(arr.index_of(a.property_type, "23")), arr.in_array(a.property_type, "26") && a.property_type.splice(arr.index_of(a.property_type, "26"))), void 0 == a.property_type || "" == a.property_type) {
                var c = search.getResComByCookie();
                a.property_type = void 0 != c ? c : "R"
            }
            return result = this.buildLocalityKeywordData(a.keyword, a.locality_array, a.src), a.keyword = result.keyword, a.locality = result.locality, delete a.locality_array, void 0 != a.budget_min && (a = this.populatePriceFromBudgetValue(a, "min")), void 0 != a.budget_max && (a = this.populatePriceFromBudgetValue(a, "max")), a
        },
        submitForm: function(a) {
            var b = GA(a, "search_type"),
                c = frmUtil.getFormData(a);
            return c = this.formatSearchData(c, b), 0 != searchUrl.populateSearchData(b, c) && (SA(a, "action", "/" + searchUrl.seo_url), !0)
        },
        submitDidYouMeanForm: function(a) {
            els = a.option_chosen_from_dym;
            for (var b = 0; b < els.length; b++)
                if (1 == els[b].checked) {
                    var c = els[b];
                    break
                } var d = GA(c, "search_url");
            return d = d.replace(/^\//, ""), SA(a, "action", "/" + d), !0
        },
        buildSearchLocalitiesData: function(a) {
            if (suggestionList = a.split("@@"), nameArr = suggestionList[0].split("|"), typeArr = suggestionList[1].split("|"), idArr = suggestionList[2].split("|"), seoStringArr = suggestionList[3].split("|"), nameArr && typeArr && idArr && seoStringArr)
                for (var b in nameArr)
                    if (typeArr[b] && "locality" == typeArr[b].toLowerCase()) {
                        var c = new Object;
                        c.ID = idArr[b], c.SEO_URL_STRING = seoStringArr[b], c.LABEL = nameArr[b], search.city_locs["'" + idArr[b] + "'"] = c
                    }
        },
        populateCityLocsFromCluster: function(cityLocsSeo) {
            var cityLocsSeo = eval("(" + this.stripSlashes(cityLocsSeo) + ")");
            for (var i in cityLocsSeo) {
                cityLocSeo = cityLocsSeo[i];
                var cityLoc = new Object;
                cityLoc.ID = cityLocSeo.ID, cityLoc.SEO_URL_STRING = cityLocSeo.SEO_URL_STRING, cityLoc.LABEL = cityLocSeo.LABEL, search.city_locs["'" + cityLocSeo.ID + "'"] = cityLoc
            }
        },
        stripSlashes: function(a) {
            return a.replace(/\\(.)/gm, "$1")
        },
        populatePriceFromBudgetValue: function(a, b) {
            var c = a["budget_" + b];
            return arr.in_array(["0", "28", "99", "199", "1", "100", "117"], c) || (a["price_" + b] = this.getPriceFromBudgetValue(c), delete a["budget_" + b]), a
        },
        getPriceFromBudgetValue: function(a) {
            return null == a || "" == a ? null : search.budget_map[a].MIN_VALUE
        },
        buildLocalityKeywordData: function(a, b, c) {
            if ("CLUSTER" != (c = void 0 != c ? c : "") && void 0 != a && a != search.default_keyword_text) {
                keyword_arr = a.replace(/,*$/, "").replace(/-/g, " ").toLowerCase().split(","), locality_arr = arr.array_unique(arr.to_arr(b));
                var d = [],
                    e = 0;
                for (var f in locality_arr)
                    if (loc = locality_arr[f], void 0 != loc && "" != loc && void 0 != search.city_locs["'" + loc + "'"].LABEL) {
                        var g = search.city_locs["'" + loc + "'"].LABEL.toLowerCase().replace(/-/g, " ");
                        for (var h in keyword_arr) {
                            var a = keyword_arr[h];
                            a == g && (d[e++] = loc, keyword_arr.splice(h, 1))
                        }
                    } return a = keyword_arr.join(","), {
                    locality: d,
                    keyword: a
                }
            }
            return "CLUSTER" != c && void 0 != a && a == search.default_keyword_text ? {
                keyword: "",
                locality: []
            } : (a = void 0 == a || a == search.default_keyword_text ? "" : a, b = void 0 == b ? [] : arr.array_unique(arr.to_arr(b)), {
                locality: b,
                keyword: a.replace(/,*$/, "")
            })
        }
    },
    AutoSuggestorConfig = {
        SUGGESTION_CONTAINER_STYLE_CLASS: "suggestion-box liveState",
        SUGGESTION_SELECT_STYLE_CLASS: "suggestion-box-active-option",
        SUGGESTION_DEFAULT_STYLE_CLASS: "suggestion-box-normal-option",
        SUGGESTION_NOT_SHOWN_REACH_MAX: 1,
        SUGGESTION_NOT_SHOWN_NOT_REACH_MAX: 2,
        SUGGESTION_SHOWN_SUGGESTION_PICKED: 3,
        SUGGESTION_SHOWN_SUGGESTION_NOT_PICKED: 4,
        HIGHLIGHT_TAG_PREFIX_HTML: "<strong>",
        HIGHLIGHT_TAG_SUFFIX_HTML: "</strong>",
        HIGHLIGHT_TAG_PREFIX_TOKEN: "###",
        HIGHLIGHT_TAG_SUFFIX_TOKEN: "@@@",
        BACKSPACE_KEY_CODE: 8,
        DOWN_ARROW_KEY_CODE: 40,
        DELETE_KEY_CODE: 46,
        UP_ARROW_KEY_CODE: 38,
        ESCAPE_KEY_CODE: 27,
        ENTER_KEY_CODE: 13,
        RIGHT_KEY_CODE: 39,
        END_KEY_CODE: 35,
        SEPARATOR: ";",
        TIMER: "0"
    },
    defaultConfig = {
        SHOW_DROPDOWN_SUGGESTIONS: !0,
        TYPE_AHEAD: !1,
        HIGHLIGHT_SUGGESTIONS: !0,
        SUGGESTIONS_COUNT: 10,
        MIN_INPUT_LENGTH_FOR_SUGGESTION: 2,
        MAX_SUGGESTION_FROM_EACH_BUCKET: 3,
        SUGGESTION_BATCH_SIZE: 100,
        MINIMUM_RESULT_COUNT_FOR_SOLR_CALL: 5,
        HIDE_TYPE_AHEAD_ON_MOUSE_CLICK: !1,
        SOLR_QUERY_TYPE: "prefix"
    },
    AutoSuggestorHelper = function() {
        function a(a) {
            var b = !1;
            return "object" == typeof a && a.length && (b = !0), b
        }

        function b(a, b) {
            return b.length - a.length
        }

        function c(a, b) {
            return a.length - b.length
        }

        function d(a, d, e) {
            switch (void 0 == d && (d = "default"), d) {
                case "length":
                    return "desc" == e ? a.sort(b) : a.sort(c);
                case "default":
                default:
                    return a.sort()
            }
        }

        function e(a, b) {
            if (a = a.sort(), b = b.sort(), a.length != b.length) return !1;
            for (var c = 0; c < b.length; c++) {
                if (a[c].compare && !a[c].compare(b[c])) return !1;
                if (a[c] !== b[c]) return !1
            }
            return !0
        }
        var f = function(a) {
                return void 0 != a && null != a && "" != a && "string" == typeof a ? a.replace(/^\s+/, "") : ""
            },
            g = function(a) {
                return void 0 != a && null != a && "" != a && "string" == typeof a ? a.replace(/^\s+|\s+$/g, "") : ""
            },
            h = function(a) {
                return void 0 != a && null != a && "" != a && "string" == typeof a ? a.replace(/\s+$/, "") : ""
            },
            j = function(a, b) {
                var c = !1;
                if (b.length > 0)
                    for (i in b)
                        if (b[i].length > 0 && a.length > 0) {
                            c = !0;
                            break
                        } return c
            },
            k = function(a, b) {
                for (var c = [], d = 0; d < a.length; d++)
                    if ("string" == b) {
                        var e = g(a[d]);
                        j(e, c) || c.push(e)
                    } else j(a[d], c) || c.push(a[d]);
                return c
            },
            l = function(a) {
                return n()
            },
            m = function(a) {
                var b = "all";
                void 0 != a && (b = a);
                var c = l(b);
                c = c[0];
                var d = [];
                for (var e in c) {
                    var f = c[e];
                    for (var g in f) j(f[g], d) || d.push(f[g])
                }
                return d.length
            },
            n = function() {
                return []
            },
            o = function() {
                return ["other", "others", "all"]
            },
            p = function() {
                return [".", "-"]
            },
            q = function(a, b, c, d) {
                if (c = c || "\n", b = b || 75, d = d || !1, !a) return a;
                var e = ".{1," + b + "}(\\s|$)" + (d ? "|.{" + b + "}|.+$" : "|\\S+?(\\s|$)");
                return a.match(RegExp(e, "g")).join(c)
            },
            r = function(a) {
                var b = 0;
                if (a.offsetParent)
                    for (; a.offsetParent;) b += a.offsetLeft, a = a.offsetParent;
                else a.x && (b += a.x);
                return b
            },
            s = function(a) {
                var b = 0;
                if (a.offsetParent)
                    for (b += a.offsetHeight; a.offsetParent;) b += a.offsetTop, a = a.offsetParent;
                else a.y && (b += a.y, b += a.height);
                return b
            },
            t = function(a) {
                var b = [];
                for (var c in a) a.hasOwnProperty(c) && b.push(c);
                return b
            },
            u = function(a, b, c) {
                var d = new RegExp(b, "g");
                return a.replace(d, c)
            };
        return {
            ltrim: function(a) {
                return f(a)
            },
            rtrim: function(a) {
                return h(a)
            },
            trim: function(a) {
                return g(a)
            },
            in_array: function(a, b) {
                return j(a, b)
            },
            unique: function(a, b) {
                return k(a, b)
            },
            getSuggestionOrder: function(a) {
                return l(a)
            },
            wordwrap: function(a, b, c, d) {
                return q(a, b, c, d)
            },
            getStopWordsForSuggestions: function() {
                return o()
            },
            findPosX: function(a) {
                return r(a)
            },
            findPosY: function(a) {
                return s(a)
            },
            getStopCharactersForSuggestions: function() {
                return p()
            },
            getDictionaryKeys: function(a) {
                return t(a)
            },
            is_array: function(b) {
                return a(b)
            },
            sort: function(a, b, c) {
                return d(a, b, c)
            },
            compareArray: function(a, b) {
                return e(a, b)
            },
            getMaxSuggestionsPossible: function(a) {
                return m(a)
            },
            replaceAll: function(a, b, c) {
                return u(a, b, c)
            }
        }
    }(),
    AutoSuggestorDataProcessingComponent = function(a, b) {
        this.solr_query_type = void 0 != b ? b : a.InnerSuggestorConfig.SOLR_QUERY_TYPE
    };
AutoSuggestorDataProcessingComponent.prototype = {
    processRawSuggestions: function(a) {
        switch (this.solr_query_type) {
            case "prefix":
                return this.processRawSuggestionForPrefix(a);
            default:
                return []
        }
    },
    processRawSuggestionForPrefix: function(a) {
        var b = {};
        if (a.suggest)
            for (key in a.suggest) {
                var c = a.suggest[key],
                    d = [];
                d[c[1]] = c[0] + "~" + c[2], b[key] = d
            }
        return b
    },
    getDropDownSuggestions: function(a, b, c, d) {
        a = AutoSuggestorHelper.trim(a);
        var e = [],
            f = {},
            g = this.prepareSuggestionsFromAchievedWordsAndSuggestions(b, c, d);
        return e = g.suggestions, f = g.suggestions_dict, {
            suggestions: e,
            suggestions_dict: f
        }
    },
    prepareSuggestionsFromAchievedWordsAndSuggestions: function(a, b, c) {
        var d = [],
            e = {};
        for (key in a)
            for (key2 in a[key]) {
                var f = {
                    suggestion: a[key][key2],
                    id: key2
                };
                d.push(f)
            }
        return {
            suggestions: d,
            suggestions_dict: e
        }
    }
};
var AutoSuggestorSolrComponent = function(a, b) {
    this.autoSuggestorObj = a, this.solr_query_type = void 0 != b ? b : this.autoSuggestorObj.InnerSuggestorConfig.SOLR_QUERY_TYPE
};
AutoSuggestorSolrComponent.prototype = {
    getSuggestions: function(a, b, c, d, e, f, g, h, i, j, k, l) {
        switch (this.solr_query_type) {
            case "prefix":
            default:
                this.getSuggestionsUsingPrefix(a, b, c, d, e, f, g, h, i, j, k, l)
        }
    },
    getSuggestionsUsingPrefix: function(a, b, c, d, e, f, g, h, i, j, k, l) {
        var m = "?term=" + encodeURIComponent(b);
        f && null != f && "" != f && (m = m + "&CITY=" + encodeURIComponent(f)), "" != AutoSuggestorHelper.trim(g) && null != g && (m = m + "&BEDROOM=" + encodeURIComponent(g)), "" != AutoSuggestorHelper.trim(h) && null != h && (m = m + "&PROPTYPE=" + encodeURIComponent(h)), "" != AutoSuggestorHelper.trim(i) && null != i ? m = m + "&PREFERENCE=" + encodeURIComponent(i) : m += "&PREFERENCE=S", "" != AutoSuggestorHelper.trim(j) && null != j && (m = m + "&RESCOM=" + encodeURIComponent(j)), "" != AutoSuggestorHelper.trim(l) && null != l && (m = m + "&COUNT=" + l);
        var n = k;
        m = m + "&SEARCH_TYPE=" + encodeURIComponent(n);
        var o = a.InnerSuggestorConfig.AUTOSUGGESTOR_URL;
        a.lastAjaxCallSuccessful = !1, a.lastAjaxCallNumberResults = 0, this.makeSolrCall(o, m, b, e, a, a.handleGetSuggestionCallback)
    },
    createCORSRequest: function(a, b) {
        var c = new XMLHttpRequest;
        return "withCredentials" in c ? c.open(a, b, !0) : "undefined" != typeof XDomainRequest ? (c = new XDomainRequest, c.open(a, b)) : c = null, c
    },
    makeSolrCall: function(theURL, params, text, newRequiredFilters, autoSuggestorThisPointerRef, callbackFunction) {
        theURL += params;
        var request = this.createCORSRequest("get", theURL);
        request && (request.onload = function() {
            var jsonObject = "";
            request.responseText && (jsonObject = eval("(" + request.responseText + ")")), callbackFunction && (void 0 != jsonObject.suggest && autoSuggestorThisPointerRef.autosuggestor_cache_obj.storeCacheDataForTerm(text, jsonObject.suggest), callbackFunction(jsonObject, autoSuggestorThisPointerRef, text, newRequiredFilters))
        }, request.send())
    }
};
var AutoSuggestorUIComponent = function(a) {
    this.autoSuggestorObj = a
};
AutoSuggestorUIComponent.prototype = {
    showSuggestionContainer: function(a, b, c) {
        if (this.autoSuggestorObj.InnerSuggestorConfig.SHOW_DROPDOWN_SUGGESTIONS) {
            this.hideSuggestionContainer(c, !0);
            for (var d = 0; d < a.length; ++d) this.createSuggestionRow(d, a[d], b, c);
            this.setSuggestionContainerVisibility(c, b, "block"), c.children.length > 0 && c.children[0].setAttribute("style", "")
        }
        "undefined" != typeof mma && mma.updateScrollbar()
    },
    setSuggestionContainerVisibility: function(a, b, c) {
        a.style.position = "absolute", a.style.display = c, a.setAttribute("class", this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_CONTAINER_STYLE_CLASS), a.className = this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_CONTAINER_STYLE_CLASS
    },
    createSuggestionRow: function(a, b, c, d) {
        var e = document.createElement("a"),
            f = b.suggestion.split("~")[0];
        e.title = f, e.id = b.id;
        var g = this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS;
        e.setAttribute("class", g), e.className = g;
        var h = document.createElement("span");
        h.innerHTML = this.hightLightText(f, c), e.appendChild(h), e.onclick = this.handleMouseClick, e.onmouseover = this.handleMouseOver, e.onmouseout = this.handleMouseOut, e.onkeydown = this.handleDownKeyPressed, e.onKeyup = this.handleUpKeyPressed, e.autoSuggestorThisPointerRef = this.autoSuggestorObj, e.autoSuggestorUIComponentRef = this, e.activeChildNo = this.autoSuggestorObj.active_child, e.number = a, d.appendChild(e)
    },
    handleMouseClick: function(a) {
        var b = a || window.event || evt || "";
        if (b.target || (b.target = b.srcElement), this.autoSuggestorThisPointerRef.search_box_element.value.indexOf(this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SEPARATOR) < 0) this.autoSuggestorThisPointerRef.textEnteredTillSuggestionPicked = this.autoSuggestorThisPointerRef.search_box_element.value;
        else {
            var c = this.autoSuggestorThisPointerRef.search_box_element.value.lastIndexOf(this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SEPARATOR);
            this.autoSuggestorThisPointerRef.textEnteredTillSuggestionPickedLocality = this.autoSuggestorThisPointerRef.search_box_element.value.substring(c + 1)
        }
        if (this.autoSuggestorThisPointerRef.type_ahead = this.autoSuggestorThisPointerRef.InnerSuggestorConfig.HIDE_TYPE_AHEAD_ON_MOUSE_CLICK, this.autoSuggestorThisPointerRef.search_box_element.focus(), this.autoSuggestorThisPointerRef.handleMouseClick(b, this.number), this.autoSuggestorUIComponentRef.updateInputBoxValue(this.autoSuggestorThisPointerRef.search_box_element, this.title, this.number), this.autoSuggestorThisPointerRef.hideSuggestionContainer(), a || (a = window.event), a.cancelBubble ? a.cancelBubble = !0 : a.stopPropagation && a.stopPropagation(), "function" == typeof this.autoSuggestorThisPointerRef.rowHandlers.click) {
            var d = {};
            d = this.autoSuggestorThisPointerRef.getDataForTracking(), this.autoSuggestorThisPointerRef.rowHandlers.click(d, this.autoSuggestorThisPointerRef.userInput, b)
        }
    },
    handleMouseOver: function(a) {
        var b = a || window.event || evt || "";
        if (b.target || (b.target = b.srcElement), this.parentNode.hasChildNodes()) {
            for (var c = 0; c < this.parentNode.childNodes.length; c++) this.parentNode.childNodes[c].setAttribute("class", this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS), this.parentNode.childNodes[c].className = this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS;
            this.setAttribute("class", this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_SELECT_STYLE_CLASS), this.className = this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_SELECT_STYLE_CLASS, this.style.cursor = "pointer"
        }
        if ("function" == typeof this.autoSuggestorThisPointerRef.rowHandlers.mouseover) {
            var d = this.autoSuggestorThisPointerRef.getDataForTracking();
            this.autoSuggestorThisPointerRef.rowHandlers.mouseover(d, this.autoSuggestorThisPointerRef.userInput, b)
        }
    },
    handleMouseOut: function(a) {
        var b = a || window.event || evt || "";
        if (b.target || (b.target = b.srcElement), this.parentNode && this.parentNode.hasChildNodes())
            for (var c = 0; c < this.parentNode.childNodes.length; c++) this.parentNode.childNodes[c].setAttribute("class", this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS), this.parentNode.childNodes[c].className = this.autoSuggestorThisPointerRef.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS;
        if ("function" == typeof this.autoSuggestorThisPointerRef.rowHandlers.mouseout) {
            var d = this.autoSuggestorThisPointerRef.getDataForTracking();
            this.autoSuggestorThisPointerRef.rowHandlers.mouseout(d, this.autoSuggestorThisPointerRef.userInput, b)
        }
    },
    hideSuggestionContainer: function(a, b) {
        if (void 0 != a && null != a) {
            for (; a.hasChildNodes();) {
                var c = a.firstChild;
                a.removeChild(c)
            }
            b ? submitFlag = !1 : "none" == a.style.display ? submitFlag = !0 : submitFlag = !1, a.style.display = "none", "undefined" != typeof mma && mma.updateScrollbar()
        }
    },
    handleDownKeyPressed: function(a, b, c, d) {
        var e = {};
        if (-1 == d && this.autoSuggestorObj.search_box_element.value.indexOf(this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR) < 0) this.autoSuggestorObj.textEnteredTillSuggestionPicked = this.autoSuggestorObj.search_box_element.value;
        else {
            var f = this.autoSuggestorObj.search_box_element.value.lastIndexOf(this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR);
            "" == this.autoSuggestorObj.search_box_element.value.substr(f + 1) ? "" == this.autoSuggestorObj.textEnteredTillSuggestionPickedLocality && (this.autoSuggestorObj.textEnteredTillSuggestionPickedLocality = this.autoSuggestorObj.textEnteredTillSuggestionPicked) : this.autoSuggestorObj.textEnteredTillSuggestionPickedLocality = this.autoSuggestorObj.search_box_element.value.substr(f + 1)
        }
        return a.length > 0 && d <= a.length - 1 && this.isSuggestionContainerVisible(c) && (d >= 0 && this.setDropDownStyle(c, d, "deselect"), d == a.length - 1 && (d = -1), this.setDropDownStyle(c, ++d, "select"), e = this.autoSuggestorObj.getDataForTracking(d), this.updateInputBoxValue(b, c.childNodes[d].firstChild, d)), "function" == typeof this.autoSuggestorObj.rowHandlers.keydown && this.autoSuggestorObj.rowHandlers.keydown(e, this.autoSuggestorObj.userInput), d
    },
    handleUpKeyPressed: function(a, b, c, d) {
        var e = {};
        return a.length > 0 && d > 0 && this.isSuggestionContainerVisible(c) && (d >= 1 ? (this.setDropDownStyle(c, d, "deselect"), this.setDropDownStyle(c, --d, "select"), e = this.autoSuggestorObj.getDataForTracking(d), this.updateInputBoxValue(b, c.childNodes[d].firstChild, d)) : (this.setDropDownStyle(c, d, "deselect"), b.focus(), d--)), "function" == typeof this.autoSuggestorObj.rowHandlers.keyup && this.autoSuggestorObj.rowHandlers.keyup(e, this.autoSuggestorObj.userInput), d
    },
    setDropDownStyle: function(a, b, c) {
        "select" == c ? (a.childNodes[b].setAttribute("class", this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_SELECT_STYLE_CLASS), a.childNodes[b].className = this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_SELECT_STYLE_CLASS) : (a.childNodes[b].setAttribute("class", this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS), a.childNodes[b].className = this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_DEFAULT_STYLE_CLASS)
    },
    isSuggestionContainerVisible: function(a) {
        return !("none" == a.style.display || a.childNodes.length <= 0)
    },
    processRightKeyPressed: function(a, b, c) {
        a.length > 0 && -1 == c && void 0 != autoSuggestorInstance.final_dropdown_suggestions[autoSuggestorInstance.final_suggestion_no_picked] && autoSuggestorInstance.search_box_localities.push(autoSuggestorInstance.final_dropdown_suggestions[autoSuggestorInstance.final_suggestion_no_picked])
    },
    showTypeAheadSuggestion: function(a, b, c) {
        if (b.createTextRange || b.setSelectionRange) {
            var d = this.getInputBoxValue(b),
                e = d.length,
                f = c.length,
                g = e - f;
            if ("" != AutoSuggestorHelper.trim(a)) var h = a.toLowerCase().indexOf(c.toLowerCase(), g);
            h -= g, e < a.length && 0 === h && (this.updateInputBoxValue(b, a), this.selectRange(b, e, a.length))
        }
    },
    selectRange: function(a, b, c) {
        if (a.createTextRange) {
            var d = a.createTextRange();
            d.moveStart("character", b), d.moveEnd("character", c - this.getInputBoxValue(a).length), d.select()
        } else a.setSelectionRange && a.setSelectionRange(b, c);
        a.focus()
    },
    hightLightText: function(a, b) {
        var c = AutoSuggestorHelper.trim(this.getInputBoxValue(b));
        if (c.indexOf(this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR) > 0) {
            var d = c.lastIndexOf(this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR);
            c = AutoSuggestorHelper.trim(c.substr(d + 1))
        }
        var e = a;
        if (this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_SUGGESTIONS) {
            for (var f = c.split(" "), g = 0; g < f.length; g++) {
                var h = AutoSuggestorHelper.trim(f[g]),
                    i = h.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1"),
                    j = new RegExp(i, "i");
                e = e.replace(j, this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_PREFIX_TOKEN + h + this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_SUFFIX_TOKEN)
            }
            e = AutoSuggestorHelper.replaceAll(e, this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_PREFIX_TOKEN, this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_PREFIX_HTML), e = AutoSuggestorHelper.replaceAll(e, this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_SUFFIX_TOKEN, this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_SUFFIX_HTML)
        }
        return e
    },
    updateInputBoxValue: function(a, b, c) {
        if ("string" != typeof b) var d = b.textContent || b.innerText || b.nodeValue;
        else var d = b;
        a.value.slice(-1), this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR;
        var e = a.value.lastIndexOf(this.autoSuggestorObj.InnerSuggestorConfig.SEPARATOR);
        d = d.split(this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_PREFIX_HTML).join(""), d = d.split(this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_SUFFIX_HTML).join(""), d = d.split(this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_PREFIX_HTML.toUpperCase()).join(""), d = d.split(this.autoSuggestorObj.InnerSuggestorConfig.HIGHLIGHT_TAG_SUFFIX_HTML.toUpperCase()).join(""), -1 != e && AutoSuggestorHelper.trim(a.value.substr(e + 1))
    },
    getInputBoxValue: function(a) {
        var b = "";
        window.getSelection ? (b = window.getSelection().toString(), b = AutoSuggestorHelper.trim(b)) : document.selection && (b = document.selection.createRange().text, b = AutoSuggestorHelper.trim(b));
        var c = a.value;
        if ("" != b) var c = c.replace(b, "");
        return c
    },
    setSuggestionContainerStyle: function(a, b) {
        void 0 != a && (void 0 != b ? (a.setAttribute("class", b), a.className = b) : (a.setAttribute("class", this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_CONTAINER_STYLE_CLASS), a.className = this.autoSuggestorObj.InnerSuggestorConfig.SUGGESTION_CONTAINER_STYLE_CLASS))
    }
};
var AutoSuggestorCacheComponent = function() {
        this.cacheData = [], this.storeCacheDataForTerm = function(a, b, c) {
            void 0 == c && (c = "solr"), a = AutoSuggestorHelper.trim(a), a = a.toLowerCase();
            for (index in b) {
                var d = this.cacheData.length + 1;
                d < 1e3 ? this.cacheData.push({
                    term: a,
                    id: b[index][1],
                    val: b[index][0] + "~" + b[index][2],
                    postion: d
                }) : (this.cacheData.splice(0, 1), this.cacheData.push({
                    term: a,
                    id: b[index][1],
                    val: b[index][0] + "~" + b[index][2],
                    postion: d
                }))
            }
        }, this.getCachedDataForTerm = function(a) {
            a = AutoSuggestorHelper.trim(a), a = a.toLowerCase();
            var b = [];
            for (index in this.cacheData) this.cacheData[index].term == a && b.push({
                id: this.cacheData[index].id,
                val: this.cacheData[index].val
            });
            return b.length >= 10 && b
        }
    },
    AutoSuggestor = function(a, b, c, d, e) {
        userConfig = a.userConfig || {};
        var f = $.extend(AutoSuggestorConfig, defaultConfig, userConfig);
        this.userInput = a || {}, this.InnerSuggestorConfig = f, this.search_input_box_id = null, this.search_box_element = null, this.search_box_city = null, this.search_box_bedroom = null, this.search_box_propType = null,
            this.search_box_preference = null, this.search_box_rescom = null, this.search_box_localities = [], this.suggestion_container_id = null, this.suggestion_container_element = null, this.suggestionsType = "", this.suggestionsCount = "", this.type_ahead = !1, this.current_key_pressed = -1, this.autosuggestor_ui_obj = null, this.active_child = -1, this.filters_achieved = [], this.words_achieved = [], this.suggestions = [], this.suggestions_dict = {}, this.exact_suggestions_dict = {}, this.suggestion_order_type = "all", this.suggestion_container_class = e, this.text_input_by_user = "", this.final_dropdown_suggestions = [], this.final_suggestion_no_picked = -1, this.words_achieved_before_selection = [], this.words_achieved_after_selection = [], this.final_action_taken = "", this.callBackFunctionOnKeyPressed = a.autoSuggestorCallbackHandler.onKeyPressed, this.callBackFunctionOnEnterPressed = a.autoSuggestorCallbackHandler.onEnterPressed, this.callBackFunctionOnMouseClick = a.autoSuggestorCallbackHandler.onMouseClick, this.callBackFunctionOnRightKeyPressed = null, this.callBackFunctionOnInputKeysPressed = a.autoSuggestorCallbackHandler.onInputKeysPressed, this.maxLevelOfSuggestions, this.originalTypeAhead = !1, this.chosenSuggestion = "", this.textEnteredTillSuggestionPicked = "", this.textEnteredTillSuggestionPickedLocality = "", this.lastAjaxCallSuccessful = !1, this.lastAjaxCallNumberResults = 0, this.rowHandlers = a.rowHandlers;
        var g = this,
            h = $(a.keyword).get(0);
        "undefined" != h && (this.search_box_element = h), "undefined" != a.type && (this.suggestionsType = a.type), a.city && (this.search_box_city = a.city), a.bedroom && (this.search_box_bedroom = a.bedroom), a.preference && (this.search_box_preference = a.preference), a.propType && (this.search_box_propType = a.propType), a.rescom && (this.search_box_rescom = a.rescom), void 0 != b && (this.suggestions_container_id = b);
        var i = $(this.suggestions_container_id).get(0);
        "undefined" != i && (this.suggestion_container_element = i), this.originalTypeAhead = void 0 != c ? c : this.InnerSuggestorConfig.TYPE_AHEAD, this.type_ahead = this.originalTypeAhead, void 0 != d && (this.suggestion_order_type = d), this.maxLevelOfSuggestions = AutoSuggestorHelper.getMaxSuggestionsPossible(this.suggestion_order_type);
        var g = this;
        this.autosuggestor_ui_obj = new AutoSuggestorUIComponent(this), this.autosuggestor_solrcall_obj = new AutoSuggestorSolrComponent(this, this.InnerSuggestorConfig.SOLR_QUERY_TYPE), this.autosuggestor_data_processing_obj = new AutoSuggestorDataProcessingComponent(this, this.InnerSuggestorConfig.SOLR_QUERY_TYPE), this.autosuggestor_cache_obj = new AutoSuggestorCacheComponent, this.refreshCache = function() {
            this.autosuggestor_cache_obj = new AutoSuggestorCacheComponent
        }, this.handleInputKeys = function(a) {
            function b() {
                clearTimeout(c.InnerSuggestorConfig.TIMER), c.InnerSuggestorConfig.TIMER = setTimeout(function() {
                    c.getSearchSuggestions()
                }, 100)
            }
            if ("keyup" != a.type) {
                var c = this,
                    d = a || window.event,
                    e = d.keyCode ? d.keyCode : d.charCode;
                if (this.current_key_pressed = e, this.type_ahead = this.originalTypeAhead, this.current_key_pressed < 32 || this.current_key_pressed >= 33 && this.current_key_pressed <= 46 || this.current_key_pressed >= 112 && this.current_key_pressed <= 123) {
                    var f = this.autosuggestor_ui_obj.getInputBoxValue(this.search_box_element);
                    switch (this.current_key_pressed) {
                        case this.InnerSuggestorConfig.BACKSPACE_KEY_CODE:
                            f.length > this.InnerSuggestorConfig.MIN_INPUT_LENGTH_FOR_SUGGESTION ? b() : this.hideSuggestionContainer(!0);
                            break;
                        case this.InnerSuggestorConfig.DOWN_ARROW_KEY_CODE:
                            this.processDownKeyPressed(d);
                            break;
                        case this.InnerSuggestorConfig.DELETE_KEY_CODE:
                            f.length > this.InnerSuggestorConfig.MIN_INPUT_LENGTH_FOR_SUGGESTION ? b() : this.hideSuggestionContainer(!0);
                            break;
                        case this.InnerSuggestorConfig.UP_ARROW_KEY_CODE:
                            this.processUpKeyPressed(d);
                            break;
                        case this.InnerSuggestorConfig.ESCAPE_KEY_CODE:
                            this.processEscapeKeyPressed(d);
                            break;
                        case this.InnerSuggestorConfig.RIGHT_KEY_CODE:
                        case this.InnerSuggestorConfig.END_KEY_CODE:
                            break;
                        case this.InnerSuggestorConfig.ENTER_KEY_CODE:
                            this.processEnterKeyPressed(d);
                            break;
                        case "0":
                            f.length >= this.InnerSuggestorConfig.MIN_INPUT_LENGTH_FOR_SUGGESTION ? b() : this.hideSuggestionContainer(!0)
                    }
                } else this.text_input_by_user = this.autosuggestor_ui_obj.getInputBoxValue(this.search_box_element), this.words_achieved_before_selection = this.words_achieved, b();
                this.processInputKeyPressed(d)
            }
        }, this.setCity = function(a) {
            void 0 == a && null == a || (this.search_box_city = a)
        }, this.getSearchSuggestions = function() {
            if (this.autosuggestor_ui_obj.getInputBoxValue(this.search_box_element).length >= this.InnerSuggestorConfig.MIN_INPUT_LENGTH_FOR_SUGGESTION) {
                var a = this.getTextToBeSearchedFromInput(),
                    b = this.filters_achieved,
                    c = this.words_achieved,
                    d = [];
                this.autosuggestor_cache_obj.getCachedDataForTerm(a), this.autosuggestor_solrcall_obj.getSuggestions(g, a, b, c, d, this.search_box_city, this.search_box_bedroom, this.search_box_propType, this.search_box_preference, this.search_box_rescom, this.suggestionsType, this.suggestionsCount)
            }
        };
        var j = this.search_box_element,
            k = this;
        $(j).off("keydown"), $(j).on("keydown", function(a) {
            k.handleInputKeys(a)
        }), this.set_search_box_rescom = function(a) {
            this.search_box_rescom = a
        }, this.getFieldsForSearchOperation = function(a, b) {
            var c = [];
            if (a.length > 0)
                for (filterIndex in a) {
                    var d = a[filterIndex];
                    for (orderIndex in b) AutoSuggestorHelper.in_array(parseInt(orderIndex), c) || (b[orderIndex][filterIndex] instanceof Array ? AutoSuggestorHelper.in_array(d, b[orderIndex][filterIndex]) || c.push(parseInt(orderIndex)) : b[orderIndex][filterIndex] != d && c.push(parseInt(orderIndex)))
                }
            for (var e = [], f = 0; f < b.length; f++) AutoSuggestorHelper.in_array(f, c) || e.push(f);
            e = AutoSuggestorHelper.unique(e);
            var g = {};
            g.fields_array = [], g.fields = [];
            for (var h = [], i = 0; i < e.length; i++) {
                var j = e[i];
                g.fields_array.push(b[j]);
                var k = a.length;
                if (void 0 != b[j][k])
                    if (b[j][k] instanceof Array)
                        for (var l = 0; l < b[j][k].length; l++) AutoSuggestorHelper.in_array(b[j][k][l], a) || h.push(b[j][k][l]);
                    else AutoSuggestorHelper.in_array(b[j][k], a) || h.push(b[j][k])
            }
            return g.fields = AutoSuggestorHelper.unique(h), g
        }, this.getTextToBeSearchedFromInput = function() {
            return this.autosuggestor_ui_obj.getInputBoxValue(this.search_box_element)
        }, this.isTextExactAndOnlySuggestion = function(a, b) {
            var c = {};
            c.exact_match = !1, c.partial_match = !1;
            var d = !1;
            for (key in a)
                if (!c.partial_match || !d)
                    for (var e = 0; e < a[key].length; e++)
                        if (b.toLowerCase() != a[key][e].toLowerCase() || d) {
                            var f = a[key][e].toLowerCase().indexOf(b.toLowerCase());
                            f >= 0 && (c.partial_match = !0)
                        } else c.exact_match = !0, c.filter = key, c.word = a[key][e], d = !0, this.exact_suggestions_dict[key] = a[key][e];
            return c
        }, this.isTextPartialSuggestion = function(a, b) {
            var c = {};
            c.partial_match = !1;
            var d = !1;
            for (key in a)
                if (!d) {
                    textInput = AutoSuggestorHelper.trim(b);
                    for (var e = 0; e < a[key].length; e++) {
                        var f = a[key][e],
                            g = textInput.toLowerCase().indexOf(f.toLowerCase()),
                            h = g + f.length;
                        if (0 === g && (" " == textInput.charAt(h).toString() || "" == textInput.charAt(h).toString())) {
                            textInput = textInput.substring(h, textInput.length), c.text = textInput, c.filter = key, c.word = f, c.partial_match = !0, d = !0;
                            break
                        }
                    }
                } return c
        }, this.getProperWordsFromPreviousExactSuggestionDictionary = function(a, b) {
            var c = {};
            c.words = [], c.filters = [];
            var d = AutoSuggestorHelper.trim(b),
                e = this.exact_suggestions_dict;
            for (key in e) {
                d = AutoSuggestorHelper.trim(b);
                var f = e[key],
                    g = d.toLowerCase().indexOf(f.toLowerCase()),
                    h = g + f.length;
                0 === g && (" " != d.charAt(h).toString() && "" != d.charAt(h).toString() || (d = d.substring(h, d.length), c.words.push(f), c.filters.push(key)))
            }
            for (var i = 0; i < c.filters.length; i++) {
                var j = c.filters[i];
                delete this.exact_suggestions_dict[j]
            }
            return c.text = d, c
        }, this.getTextForSearch = function() {
            var a = this.search_box_element,
                b = this.autosuggestor_ui_obj.getInputBoxValue(a),
                c = this.words_achieved;
            this.filters_achieved;
            if (c.length > 0)
                for (var d = 0; d < c.length; d++) {
                    var e = c[d];
                    b = AutoSuggestorHelper.ltrim(b);
                    var f = b.toLowerCase().indexOf(e.toLowerCase()),
                        g = f + e.length;
                    if (0 !== f) break;
                    " " != b.charAt(g).toString() && "" != b.charAt(g).toString() || (b = b.substring(g, b.length))
                }
            return b
        }, this.handleGetSuggestionCallback = function(a, b, c, d) {
            var e = a,
                f = b.autosuggestor_data_processing_obj.processRawSuggestions(e),
                g = "Filters achieved: <b>" + b.filters_achieved + " </b><br/>Words achieved: <b>" + b.words_achieved + "</b><br/>";
            g = g.replace(",", " , "), document.getElementById("solr_filters") && (document.getElementById("solr_filters").innerHTML = g), c = b.getTextToBeSearchedFromInput(), b.words_achieved_after_selection = b.words_achieved;
            var h = b.getFieldsForSearchOperation(b.filters_achieved, AutoSuggestorHelper.getSuggestionOrder(b.suggestion_order_type)),
                i = h.fields,
                j = "Currently searching in: <b>" + i.toString() + "</b><br/>";
            j = j.replace(",", " , "), document.getElementById("solr_filters_order") && (document.getElementById("solr_filters_order").innerHTML = j);
            var k = b.autosuggestor_data_processing_obj.getDropDownSuggestions(c, f, b.words_achieved, i),
                l = k.suggestions,
                m = k.suggestions_dict;
            if (b.lastAjaxCallSuccessful = !0, b.lastAjaxCallNumberResults = l.length, b.suggestions = l, b.suggestions_dict = m, b.active_child = -1, l.length > 0) {
                if (b.final_dropdown_suggestions = l, b.autosuggestor_ui_obj.showSuggestionContainer(l, b.search_box_element, b.suggestion_container_element), b.autosuggestor_ui_obj.setSuggestionContainerStyle(b.suggestion_container_element, b.suggestion_container_class), b.type_ahead && b.current_key_pressed != b.InnerSuggestorConfig.BACKSPACE_KEY_CODE) {
                    var n = b.getTextForSearch();
                    b.autosuggestor_ui_obj.showTypeAheadSuggestion(l[0], b.search_box_element, n)
                }
            } else b.hideSuggestionContainer(!0), "" == AutoSuggestorHelper.trim(c) && b.words_achieved_after_selection.length > b.words_achieved_before_selection.length && (b.maxLevelOfSuggestions, b.words_achieved_after_selection.length)
        }, this.processEscapeKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement), this.hideSuggestionContainer()
        }, this.processDownKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement);
            var c = {};
            this.words_achieved_before_selection = this.words_achieved, this.active_child = this.autosuggestor_ui_obj.handleDownKeyPressed(this.suggestions, this.search_box_element, this.suggestion_container_element, this.active_child), this.getTextToBeSearchedFromInput(), this.final_action_taken = "dkp", this.final_suggestion_no_picked = this.active_child, this.words_achieved_after_selection = this.words_achieved, "function" == typeof this.callBackFunctionOnKeyPressed && (c = this.getDataForTracking(), this.callBackFunctionOnKeyPressed(c, this.userInput, b))
        }, this.processUpKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement);
            var c = {};
            this.words_achieved_before_selection = this.words_achieved, this.active_child = this.autosuggestor_ui_obj.handleUpKeyPressed(this.suggestions, this.search_box_element, this.suggestion_container_element, this.active_child), this.getTextToBeSearchedFromInput(), this.final_action_taken = "ukp", this.final_suggestion_no_picked = this.active_child, this.words_achieved_after_selection = this.words_achieved, "function" == typeof this.callBackFunctionOnKeyPressed && (c = this.getDataForTracking(), this.callBackFunctionOnKeyPressed(c, this.userInput, b))
        }, this.processRightKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement);
            var c = {};
            this.words_achieved_before_selection = this.words_achieved, this.autosuggestor_ui_obj.processRightKeyPressed(this.suggestions, this.search_box_element, this.active_child), this.getTextToBeSearchedFromInput(this.suggestions_dict), this.final_suggestion_no_picked = 0, this.words_achieved_after_selection = this.words_achieved, this.final_action_taken = "rkp", "function" == typeof this.callBackFunctionOnKeyPressed && (c = this.getDataForTracking(), this.callBackFunctionOnKeyPressed(c, this.userInput, b)), "function" == typeof this.callBackFunctionOnRightKeyPressed && (c = this.getDataForTracking(), this.callBackFunctionOnRightKeyPressed(c, this.userInput, b))
        }, this.processEnterKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement);
            var c = {};
            this.final_suggestion_no_picked = this.active_child, this.final_action_taken = "ep";
            var d = this.suggestionsShownData(this.final_suggestion_no_picked);
            "function" == typeof this.callBackFunctionOnEnterPressed && (c = this.getDataForTracking(), c.suggestion_shown = d, this.callBackFunctionOnEnterPressed(c, this.userInput, b)), this.hideSuggestionContainer()
        }, this.processInputKeyPressed = function(a) {
            var b = a || window.event || evt || "";
            b.target || (b.target = b.srcElement), "function" == typeof this.callBackFunctionOnInputKeysPressed && (trackingData = this.getDataForTracking(), this.callBackFunctionOnInputKeysPressed(trackingData, this.userInput, b))
        }, this.handleMouseClick = function(a, b) {
            var c = a || window.event || evt || "";
            c.target || (c.target = c.srcElement), this.final_suggestion_no_picked = b, this.final_action_taken = "mc";
            var d = {};
            "function" == typeof this.callBackFunctionOnMouseClick && (d = this.getDataForTracking(), this.callBackFunctionOnMouseClick(d, this.userInput, c))
        }, this.hideSuggestionContainer = function(a) {
            this.autosuggestor_ui_obj.hideSuggestionContainer(this.suggestion_container_element, a), this.suggestions = [], this.suggestions_dict = {}, this.active_child = -1
        }, this.getDataForTracking = function(a) {
            var b = {};
            if (void 0 != this.final_dropdown_suggestions) {
                var c = this.final_dropdown_suggestions[this.final_suggestion_no_picked];
                void 0 != c && (this.chosenSuggestion = c.suggestion, b.val = c.suggestion, b.id = c.id, b.final_action_taken = this.final_action_taken, b.final_dropdown_suggestions = this.final_dropdown_suggestions, b.final_suggestion_no_picked = void 0 != a ? a : this.final_suggestion_no_picked, b.textEnteredTillSuggestionPicked = this.textEnteredTillSuggestionPicked, b.textEnteredTillSuggestionPickedLocality = this.textEnteredTillSuggestionPickedLocality, b.text_input_by_user = this.text_input_by_user, b.text_in_the_input_box = this.search_box_element.value)
            }
            return b
        }, this.suggestionsShownData = function(a) {
            var b = !1;
            this.suggestions.length > 0 && (b = !0);
            var c = -1;
            return !b && this.words_achieved.length >= this.maxLevelOfSuggestions && (c = this.InnerSuggestorConfig.SUGGESTION_NOT_SHOWN_REACH_MAX), !b && this.words_achieved.length < this.maxLevelOfSuggestions && (c = this.InnerSuggestorConfig.SUGGESTION_NOT_SHOWN_NOT_REACH_MAX), b && this.words_achieved.length < this.maxLevelOfSuggestions && (c = a >= 0 ? this.InnerSuggestorConfig.SUGGESTION_SHOWN_SUGGESTION_PICKED : this.InnerSuggestorConfig.SUGGESTION_SHOWN_SUGGESTION_NOT_PICKED), c
        }
    },
    SHOWCUSTOMSUGGESTOR = !1,
    qsAvail = "undefined" != typeof qsSrp,
    suggesterSingleton = function() {
        function a() {
            function a() {
                X(), $(wa, qa).remove(), ua.val(""), Ja = [], Na = [], Oa = [], Pa = [], Qa = [], Ra = [], submitFlag = !1
            }

            function b() {
                $(wa, qa).remove(), Oa = [], Ja = [], Pa = [], Na = [], Qa = []
            }

            function c() {
                return qa
            }

            function d(a) {
                $("#city").val(a)
            }

            function e(a) {
                a && (Aa = a)
            }

            function f(a, b) {
                var c, d = a.split(",");
                for (i = 0; i < d.length; i++) {
                    var e = $.trim(d[i]);
                    if (b) {
                        if ("PROJECT" == e.substr(0, 7)) {
                            c = e.substr(8);
                            break
                        }
                    } else if ("LOCALITY" === e.substr(0, 8)) {
                        c = e.substr(9);
                        break
                    }
                }
                return c
            }

            function g() {
                return !!ma
            }

            function h() {
                return ma
            }

            function m() {
                var a = "locality_array[]",
                    b = "building_id[]";
                if (void 0 != ma) {
                    for (var c = document.getElementsByName(b), d = document.getElementsByName(a), e = c.length, g = 0; g < e; g++) {
                        var h = c[0];
                        h.parentNode.removeChild(h)
                    }
                    e = d.length;
                    for (var g = 0; g < e; g++) {
                        var h = d[0];
                        h.parentNode.removeChild(h)
                    }
                    if (0 != Oa.length || 0 != Qa.length) {
                        var i = Oa,
                            j = "locality_array[]",
                            k = !1;
                        Qa.length > 1 && (i = Qa, j = "building_id[]", k = !0);
                        for (var m = [], o = 0; o < i.length; o++) {
                            localityOrProjectArrayElementObj = i[o];
                            for (l in localityOrProjectArrayElementObj) {
                                var p = localityOrProjectArrayElementObj[l];
                                break
                            }
                            if (p) {
                                var q = p[1],
                                    r = f(q, k);
                                if (void 0 == r) continue;
                                var s = j,
                                    t = $("#" + va, qa);
                                if (t.length > 0) {
                                    var u = t.get(0).form.id,
                                        v = document.createElement("input");
                                    v.setAttribute("type", "hidden"), v.setAttribute("name", s), v.setAttribute("value", r), document.getElementById(u).appendChild(v)
                                }
                            }
                            n(Qa, "building_id[]", !0), (Qa.length <= 1 || isMapSrch() || qsAvail && qsSrp.isMapActive() && "dealer" != $.trim(qsSrp.getST().toLowerCase())) && n(Oa, "locality_array[]", !1), q && m.push(q)
                        }
                    }
                    x("refine_results", "Y"), x("Refine_Localities", "Refine Localities"), x("action", "/do/quicksearch/search"), x("src", "CLUSTER")
                }
            }

            function n(a, b, c) {
                for (var d, e, g, h, i, j, k = 0; k < a.length; k++) {
                    d = a[k];
                    for (l in d) {
                        e = d[l];
                        break
                    }
                    if (e) {
                        if (g = e[1], void 0 == (h = f(g, c))) continue;
                        j = document.getElementById(va).form.id, i = document.createElement("input"), i.setAttribute("type", "hidden"), i.setAttribute("name", b), i.setAttribute("value", h), document.getElementById(j).appendChild(i)
                    }
                }
            }

            function o(a) {
                for (var b = [], c = 0; c < a.length; c++) {
                    var d = a[c];
                    for (key in d) {
                        b.push(key);
                        break
                    }
                }
                return b
            }

            function p(a, b) {
                for (var c = b, d = 0; d < a.length; d++)
                    for (var e = 0; e < c.length; e++) {
                        var f = c[e];
                        for (var g in f)
                            if (a[d] == g) {
                                c.splice(e, 1), e--;
                                break
                            }
                    }
                return c
            }

            function q(a) {
                for (var b = 0; b < a.length; b++) {
                    var c = a[0],
                        d = !1;
                    for (ele in c)
                        if ("type" == ele) {
                            d = !0, a.splice(0, 1);
                            break
                        } if (!d) break
                }
            }

            function r() {
                Qa.length > 0 && q(Qa), Oa.length > 0 && q(Oa), Ra.length > 0 && q(Ra)
            }

            function s() {
                r();
                var a = [];
                Qa.length > 0 ? a = o(Qa) : Oa.length > 0 ? a = o(Oa) : Ra.length > 0 && (a = o(Ra));
                for (var b = [], c = [], d = [], e = [], f = 0; f < Pa.length; f++) {
                    var g = Pa[f];
                    for (var h in g) {
                        e.push(g[h]), u(h, a) && (u(g[h], c) ? d.push(h) : (b.push(g), c.push(g[h])));
                        break
                    }
                }
                if (Pa.length > 0)
                    for (var j in Pa[0]) Ua = Pa[0][j];
                Pa = b;
                var k = "";
                for (i = 0; i < Pa.length; i++) {
                    var l = Pa[i];
                    for (h in l) {
                        k += l[h] + ";";
                        break
                    }
                }
                if (e = e.join(";"), $("#" + va, qa).val(k), Qa.length > 0) {
                    Sa = p(d, Qa);
                    var m = Sa[0];
                    "type" in m || Sa.unshift({
                        type: "project"
                    })
                } else if (Oa.length > 0) {
                    Sa = p(d, Oa);
                    var m = Sa[0];
                    "type" in m || Sa.unshift({
                        type: "locality"
                    })
                } else if (Ra.length > 0) {
                    Sa = p(d, Ra);
                    var m = Sa[0];
                    "type" in m || Sa.unshift({
                        type: "city"
                    })
                }
                var n = 0 === Sa.length ? JSON.stringify("") : JSON.stringify(Sa);
                x("fullSelectedSuggestions", e), x("strEntityMap", n), x("texttypedtillsuggestion", Ta)
            }

            function t(a) {
                for (var b = [], c = 0; c < a.length; c++) {
                    var d = a[c];
                    for (var e in d) {
                        b.push(d[e]);
                        break
                    }
                }
                return b.join(";")
            }

            function u(a, b) {
                for (var c in b)
                    if (b[c] == a) return !0;
                return !1
            }

            function v() {
                if (0 === Sa.length) {
                    var a = qsAvail ? qsSrp.getEntityValueMap() : "",
                        b = "";
                    if (a.length > 0) {
                        for (var c = 0; c < a.length; c++) {
                            if (!("type" in a[c])) break;
                            b = a.splice(0, 1)[0].type
                        }
                        "project" === b ? Qa = a : "locality" === b ? Oa = a : "city" === b && (Ra = a)
                    }
                }
                if (0 === Pa.length) {
                    var e = qsAvail ? qsSrp.getPhraseValueMap() : "";
                    Pa = e || []
                }
                if (R(), 0 === $(".suggestion-tag", qa).length) return "undefined" != typeof kywrd && "" == ua.val() && ua.val(kywrd), void d("");
                $(".wordbox", qa).css("width", "auto"), $(".wordbox input", qa).addClass("wordInp"), $("#" + ta, qa).removeAttr("x-webkit-speech lang"), $(".sCount", qa).removeClass("hide"), $(".bubblePack", qa).css("width", "98%"), $(".sCount", qa).html($(".suggestion-tag", qa).length);
                var f = $("#city").val();
                if (f) {
                    var g = parseInt(f),
                        h = g;
                    if (g in Ia) {
                        var i = Ia[g];
                        h = Ha[i]
                    } else
                        for (key in Ha) {
                            if ("string" == typeof Ha[key]) {
                                var j = Ha[key].split(",");
                                if (u(g, j)) {
                                    if (void 0 != Ha[g]) var i = g;
                                    else var i = key;
                                    h = Ha[i];
                                    break
                                }
                            }
                            h = g
                        }
                    d(g), ma.search_box_city = h
                }
            }

            function w(a) {
                if (void 0 != a && !1 === $.isEmptyObject(a)) {
                    var b = a.id;
                    if (b) {
                        var c = Z(b),
                            e = $(oa).val();
                        "-1" == e && (e = "");
                        var f = parseInt(c),
                            g = ma.search_box_city || "";
                        if (1 === $(wa, qa).length)
                            if (f in Ia) {
                                var h = Ia[f];
                                g = Ha[h]
                            } else
                                for (key in Ha) {
                                    if ("string" == typeof Ha[key]) {
                                        var i = Ha[key].split(",");
                                        if (u(f, i)) {
                                            var h = key;
                                            g = Ha[h];
                                            break
                                        }
                                    }
                                    g = f
                                } else if (f != e)
                                    for (key in Ha) {
                                        if ("string" == typeof Ha[key]) {
                                            var i = Ha[key].split(",");
                                            if (u(f, i) && u(e, i)) {
                                                f = key, g = Ha[f];
                                                break
                                            }
                                        }
                                        g = f
                                    }
                        f && (d(f), ma.search_box_city = g)
                    }
                }
            }

            function x(a, b) {
                var c, d = $("#" + va, qa);
                if (d.length > 0) c = d.get(0).form.id;
                else {
                    var e = $("#" + ta, qa);
                    c = e.length > 0 ? e.get(0).form.id : document.getElementById("property_type").form.id
                }
                if (void 0 != document.getElementById(c).elements.namedItem(a) && "locality_array[]" != a) document.getElementById(c).elements.namedItem(a).value = b;
                else {
                    var f = document.createElement("input");
                    f.setAttribute("type", "hidden"), f.setAttribute("id", a), f.setAttribute("name", a), f.setAttribute("value", b), document.getElementById(c).appendChild(f)
                }
            }

            function y(a, b) {
                var c = new Array;
                c.push(b);
                var d = new Object;
                d[c[0]] = a, Pa.push(d)
            }

            function z(a, b, c) {
                var d = new Array;
                d.push(c), obj = new Object, obj[d[0]] = [a, b], A(b) ? Qa.push(obj) : B(b) ? Oa.push(obj) : C(b) && Ra.push(obj)
            }

            function A(a) {
                var b = !1;
                if (a)
                    for (var c = a.split(","), d = c.length, e = 0; e < d; e++) {
                        var f = $.trim(c[e]);
                        if ("PROJECT" == f.substr(0, 7)) {
                            b = !0;
                            break
                        }
                    }
                return b
            }

            function B(a) {
                var b = !1;
                if (a)
                    for (var c = a.split(","), d = c.length, e = 0; e < d; e++) {
                        var f = $.trim(c[e]);
                        if ("LOCALITY" == f.substr(0, 8)) {
                            b = !0;
                            break
                        }
                    }
                return b
            }

            function C(a) {
                var b = !1;
                if (a)
                    for (var c = a.split(","), d = c.length, e = 0; e < d; e++) {
                        var f = $.trim(c[e]);
                        if ("CITY" == f.substr(0, 4)) {
                            b = !0;
                            break
                        }
                    }
                return b
            }

            function D(a, b) {
                a && H(a, "suggest_up_key")
            }

            function E(a, b) {
                a && H(a, "suggest_down_key")
            }

            function F(a, b) {
                if (a && a.val) {
                    var c = Q(),
                        d = a.val,
                        e = a.id,
                        f = d.split("~")[0];
                    P(f, c, e), w(a);
                    1 === $(wa, qa).length && (ma.refreshCache(), ma.suggestionsType = "projectlocality", Ta = ma.textEnteredTillSuggestionPicked), z(f, e, c), y(f, c), G(f, c, e)
                }
            }

            function G(a, b, c) {
                if ($("#lead_search").length > 0 && 1 == b) {
                    ma.suggestionsCount = "50";
                    var d = la(),
                        e = d.split(",")[0];
                    "none" === $("#localitySuggestions").css("display") ? showLeadSearchLocalitySuggestions(e, null, a) : removeLeadSearchLocalitySuggestion(c, !0)
                }
            }

            function H(a, b) {
                if (void 0 != a && 0 == $.isEmptyObject(a)) {
                    var c = a.final_suggestion_no_picked;
                    if (a.final_dropdown_suggestions) var d = a.final_dropdown_suggestions.length;
                    if (a.val) var e = a.val.split("~")[0];
                    var f = a.text_in_the_input_box,
                        g = "";
                    f && (g = f.indexOf(";") < 0 ? a.textEnteredTillSuggestionPicked : a.textEnteredTillSuggestionPickedLocality), trackEventByGA(c + "_" + d, b, g + "_" + e + "_AB~~", "Search Suggestor")
                }
            }

            function I(a, b) {}

            function J(a, b) {
                Ja.push(a)
            }

            function K(a, b) {
                if (a && a.val) {
                    var c = Q();
                    H(a, "suggest_enter_key");
                    var d = {};
                    if (d.id = a.id, d.val = a.val, d.suggestion_shown = a.suggestion_shown, N(d, c), La = d, Ja.push(d), void 0 !== a.suggestion_shown && (Ka = d.suggestion_shown), a.val) var e = a.val.split("~")[0];
                    e && (P(e, c, a.id), y(e, c))
                }
                if (a) {
                    w(a);
                    if (1 === $(wa, qa).length && (ma.refreshCache(), ma.suggestionsType = "projectlocality", Ta = ma.textEnteredTillSuggestionPicked), a.val) {
                        z(a.val.split("~")[0], a.id, c), G(e, c, a.id)
                    } else ma.hideSuggestionContainer(!0)
                }
            }

            function L(a, b) {
                H(a, "suggest_mouse_click");
                var c = {};
                c.id = a.id, c.val = a.val;
                var d, e = $(".suggestion-tag", qa).last().data("number");
                d = e ? e + 1 : 1, N(c, d), Ja.push(c)
            }

            function M() {
                var a = !1;
                Qa.length > 0 ? (Na.push(Qa[0]), a = !0) : Oa.length > 0 ? Na.push(Oa[0]) : Ra.length > 0 && Na.push(Ra[0]);
                var b = Na[0];
                if (void 0 != b)
                    for (ele in b) var c = b[ele];
                if (void 0 != c) {
                    var e = c[1],
                        f = c[0],
                        g = $("#" + va, qa);
                    if (g.length > 0) {
                        var h = g.val();
                        if (commaSeparatedText = h.split(";"), -1 !== commaSeparatedText[0].indexOf(f) && void 0 != e) {
                            var i = e.split(",");
                            for (key in i) {
                                var j = i[key].replace(/^\s+|\s+$/g, "");
                                if ("CITY" == j.substr(0, 4))
                                    if (qsAvail && qsSrp.getCity() > 0);
                                    else {
                                        var k = j.substr(5);
                                        d(k)
                                    } if ("PROJECT" == j.substr(0, 7)) {
                                    x("building_id[]", j.substr(8)), x("refine_results", "Y"), x("Refine_Localities", "Refine Localities"), x("action", "/do/quicksearch/search"), x("src", "CLUSTER")
                                }
                                if ("LOCALITY" == j.substr(0, 8)) {
                                    if (a) continue;
                                    x("locality_array[]", j.substr(9)), x("refine_results", "Y"), x("Refine_Localities", "Refine Localities"), x("action", "/do/quicksearch/search"), x("src", "CLUSTER")
                                }
                            }
                            x("suggestion", e)
                        }
                    }
                }
                var l, m = $("#property_type"),
                    n = qsAvail ? qsSrp.getRC() : "";
                if ("" == m.val() && (l = n, "C" == l ? ($("#lead_search").length <= 0 && Header.clickSpl($("#comddli")), qsAvail && qsSrp.setPT("C")) : ($("#lead_search").length <= 0 && Header.clickSpl($("#resddli")), qsAvail && qsSrp.setPT("R")), $(".sSrch").length > 0))
                    if (qsAvail && "DEALER" == qsSrp.getST()) {
                        var l = "R";
                        $("#dealers .onoffWrap .on").length > 0 ? l = "res_dlr" == $("#dealers .onoffWrap .on").attr("id") ? "R" : "C" : $("#dealerSRPTab").length > 0 && (l = $("#dealerSRPTab a.ssSel").attr("val")), $('#s_property_type li input:checkbox[value="' + l + '"]').prop("checked", !0).change()
                    } else $('#s_property_type li input:checkbox[value="' + l + '"]').prop("checked", !0).change()
            }

            function N(a, b) {
                if (!(Na.length > 0)) {
                    var b = b,
                        c = [];
                    c.push(b);
                    var d = a.id;
                    if (void 0 != a.val) {
                        var e = a.val.split("~")[0],
                            f = d;
                        for (i = 0; i < c.length; i++) {
                            var g = new Object;
                            g[c[i]] = [e, f], Na.push(g)
                        }
                        var h = a.val.split("~")[0]
                    }
                    var j = d;
                    for (i = 0; i < c.length; i++) {
                        var g = new Object;
                        g[c[i]] = [h, j], Ma.push(g)
                    }
                }
            }

            function O() {
                if (sa.css("display", "none"), void 0 != document.getElementById(pa)) var a = document.getElementById(pa);
                var b = document.getElementById(na);
                if (void 0 != b) var c = b.value;
                u(c, Ea) && void 0 != Ha[c] && (c = Ha[c]);
                void 0 != document.getElementById("res_com") && void 0 != a && "C" != document.getElementById("res_com").value && a.value;
                var d;
                if (void 0 != document.getElementById(ya)) {
                    if (d = document.getElementById(ya).value, propTypeArr = d.split(":"), "" != propTypeArr) {
                        propTypeArrCommaSeparated = propTypeArr.join(","), void 0 != document.getElementById("res_com") && (propTypeArrCommaSeparated == Ga && "R" == document.getElementById("res_com").value || propTypeArrCommaSeparated == Fa && "C" == document.getElementById("res_com").value) && (propTypeArr = []);
                        for (var e = 0; e < propTypeArr.length; e++) void 0 != document.getElementById("res_com") && (propTypeArr[e] = document.getElementById("res_com").value + ":" + propTypeArr[e])
                    }
                    propTypeArr.join(",")
                }
                Ca = $(".suggestion-tag", qa).length > 0 ? "projectlocality" : "";
                var f;
                if (void 0 != document.getElementById(za) && (f = document.getElementById(za).value), void 0 != document.getElementById("res_com")) var g = document.getElementById("res_com").value;
                "undefined" == typeof autoSuggestURL && (autoSuggestURL = "");
                var h = {
                    city: "",
                    bedroom: "",
                    propType: "",
                    preference: f,
                    keyword: ua,
                    rescom: g,
                    type: Ca,
                    userConfig: {
                        MIN_INPUT_LENGTH_FOR_SUGGESTION: 2,
                        AUTOSUGGESTOR_URL: autoSuggestURL
                    },
                    rowHandlers: {
                        click: F,
                        keyup: D,
                        keydown: E
                    },
                    autoSuggestorCallbackHandler: {
                        onKeyPressed: J,
                        onMouseClick: L,
                        onEnterPressed: K,
                        onInputKeysPressed: I
                    }
                };
                ma = new AutoSuggestor(h, sa, !0), ma.refreshCache()
            }

            function P(a, b, c) {
                var d;
                a = $.trim(a);
                var e = a.split(",")[0];
                d = e.length > 30 ? '<span class ="suggestion-tag" data-id="' + c + '" data-number="' + b + '" title="' + a + '" style="width:98%;"><em style="width:90%">' + e + '</em><i class="suggestion-cross bb-cross iconS"></i></span>' : '<span class ="suggestion-tag" data-id="' + c + '" data-number="' + b + '" title="' + a + '"><em>' + e + '</em><i class="suggestion-cross bb-cross iconS"></i></span>', $(".wordbox", qa).before(d), $(".wordbox", qa).css("width", "auto"), $(".wordbox input", qa).addClass("wordInp"), $("#" + ta, qa).removeAttr("x-webkit-speech lang"), $(".bubblePack", qa).css("width", "98%"), ua.attr("placeholder", Ba), $("#" + ta, qa).val("")
            }

            function Q() {
                var a = $(wa, qa).last().data("number");
                return a ? a + 1 : 1
            }

            function R() {
                $suggestion_tag = $(".suggestion-tag", qa), $suggestion_tag.length > 0 && (ua.attr("placeholder", Ba), ua.val() == Aa && ua.val(Ba), jsval.fixPlaceHolder(ua)), $(".initBubble", qa).hasClass("hidei") && $suggestion_tag.hasClass("hidei") && $suggestion_tag.removeClass("hidei");
                var a = T($suggestion_tag);
                $(".bubbleCounter", qa).attr("title", a)
            }

            function S() {
                $(".zhndle", qa).css("z-index", "2");
                for (var a = $(".suggestion-tag", qa), b = 0, c = 0; c < a.length; c++) b += $(a[c], qa).outerWidth(), b += parseInt($(a[c], qa).css("margin-left")), b += parseInt($(a[c], qa).css("margin-right"));
                var d = $(".wordbox", qa).outerWidth(),
                    e = $("#SelectBox", qa).width(),
                    f = $("#SelectBox", qa).css("padding-right"),
                    g = $("#SelectBox", qa).css("padding-left");
                d + b + parseInt(f) + parseInt(g) + 2 < e || a.is(":visible") && a.slideUp(500, function() {
                    var b = $.trim($(".suggestion-tag em", qa).first().text());
                    $(".initBubble", qa).text(b).attr("title", b).removeClass("hidei").show();
                    var c = T(a);
                    a.length > 1 && $(".bubbleCounter", qa).text("+" + (a.length - 1) + " More").removeClass("hidei").attr("title", c).show()
                })
            }

            function T(a) {
                var b = "",
                    c = "•",
                    d = 1;
                for (d; d < a.length - 1; d++) b += c + " " + $.trim($(a[d]).text()) + "\r";
                return b += c + " " + $.trim($(a[d]).text())
            }

            function U(a, b) {
                var c = new RegExp("[?&]" + a + "=([^&#]*)").exec(b);
                return null == c ? null : decodeURIComponent(c[1]) || 0
            }

            function V(a, b, c) {
                var d = null,
                    e = "",
                    f = a.split("?"),
                    g = f[0],
                    h = f[1],
                    j = "";
                if (h) {
                    var k = h.split("#"),
                        l = k[0];
                    for (d = k[1], d && (h = l), f = h.split("&"), i = 0; i < f.length; i++) f[i].split("=")[0] != b && (e += j + f[i], j = "&")
                } else {
                    var k = g.split("#"),
                        l = k[0];
                    d = k[1], l && (g = l)
                }
                return d && (c += "#" + d), g + "?" + e + j + b + "=" + c
            }

            function W() {
                function a() {
                    $cityerr = $(".citysserr"), $cityerr.is(":visible") && $cityerr.hide()
                }
                O(), jsval.fixPlaceHolder(ua), $(document).on("click", function(b) {
                    a();
                    var c = b.target.id;
                    c != ra && c != ta && void 0 !== ma && ma.hideSuggestionContainer(!0);
                    var d = $(b.target);
                    if (!d.parents().hasClass("suggestion-tag")) return d.is("#SelectBox") ? void ua.trigger("focus") : void(d.parents().is("#SelectBox") ? ua.trigger("focus") : S())
                }), $("._init_parent a.dropDown").click(function() {
                    a(), S()
                }), qa.on("focus", "#" + ta, function() {
                    Da = !1, qsAvail && qsSrp.closeDrpDowns(), a(), $(".zhndle").css("z-index", "2"), $suggestion_tag = $(".suggestion-tag", qa).removeClass("hidei"), $(".initBubble", qa).html("").attr("title", "").addClass("hidei"), $(".bubbleCounter", qa).html("").addClass("hidei"), $suggestion_tag.is(":hidden") && $suggestion_tag.slideDown(500)
                }), $(".sRTabs a,.priceRange a,.buditem a,#mapview,#srp_tab_dtl .side-bar-tabs a").on("click", function() {
                    var a = $(this);
                    if (void 0 == a.attr("id") && !a.hasClass("sRSel") && "xid_tab_properties" != a.attr("id") && "xid_tab_rental" != a.attr("id")) {
                        var b = a.attr("href");
                        if (Qa.length > 0) {
                            Sa = Qa;
                            var c = Sa[0];
                            "type" in c || Sa.unshift({
                                type: "project"
                            })
                        } else if (Oa.length > 0) {
                            Sa = Oa;
                            var c = Sa[0];
                            "type" in c || Sa.unshift({
                                type: "locality"
                            })
                        } else if (Ra.length > 0) {
                            Sa = Ra;
                            var c = Sa[0];
                            "type" in c || Sa.unshift({
                                type: "city"
                            })
                        }
                        var d = 0 === Sa.length ? JSON.stringify("") : JSON.stringify(Sa),
                            e = b + "&strEntityMap=" + Base64.encode(d),
                            f = $("#keyword").val();
                        f = $.trim(f), f != Aa && f != Ba || (f = "");
                        var g = t(Pa),
                            h = U("fss", e);
                        return null == h ? e += "&fss=" + encodeURIComponent(g) : h != h && (e = V(e, "fss", h)), window.location = e, !1
                    }
                }), $(".lyrUIw").on("mouseover", function() {
                    S(), $(".zhndle").css("z-index", "4")
                }), $(".lyrUIw").on("mouseout", function() {
                    $(".zhndle").css("z-index", "2")
                }), qa.on("click", xa, function(a) {
                    a.stopPropagation();
                    var b = $(this).parent("span").data("number");
                    $(this).parent("span").remove(), Y(b);
                    var c = $(wa, qa);
                    if (1 === c.length || 0 !== c.length && ba()) {
                        var e = _();
                        for (i in e) {
                            var f = e[i],
                                g = f[1];
                            if (g) {
                                var h = Z(g),
                                    j = parseInt(h);
                                $(oa).val();
                                d(j);
                                break
                            }
                        }
                    }
                    if ($("#lead_search").length > 0 && 1 === c.length) {
                        var k = la(),
                            l = k.split(",")[0],
                            g = $(this).parent("span").data("id"),
                            m = g.indexOf("LOCALITY");
                        "" === l ? hideLeadSearchLocalitySuggestions() : m > 0 && void 0 !== c[0] ? showLeadSearchLocalitySuggestions(l, c, c[0].title) : void 0 !== c[0] && removeLeadSearchLocalitySuggestion(g, !1)
                    }
                    0 === c.length && X()
                }), qa.on("blur", "#" + ta, function() {
                    Da = !1
                }), qa.on("change paste", "#" + ta, function(a) {
                    0 == $(wa, qa).length && "" == $.trim(ua.val()) && d("")
                }), qa.on("keydown", "#" + ta, function(b) {
                    a()
                }), qa.on("keyup", "#" + ta, function(a) {
                    if (8 == a.keyCode) {
                        if (0 === $(this).val().length) {
                            if (!Da) return void(Da = !0);
                            Da = !1;
                            var b = $(wa, qa);
                            if (b.length > 0) {
                                var c = $(".suggestion-tag:last", qa),
                                    e = c.data("number");
                                if (c.remove(), Y(e), b = $(wa, qa), 1 == b.length || 0 !== b.length && ba()) {
                                    var f = _();
                                    for (i in f) {
                                        var g = f[i],
                                            h = g[1];
                                        if (h) {
                                            var j = Z(h),
                                                k = parseInt(j);
                                            $(oa).val();
                                            d(k);
                                            break
                                        }
                                    }
                                }
                                0 === b.length && X()
                            }
                        }
                    } else Da && (Da = !1)
                }), $(".dislin").on("click", function(a) {
                    if ($(this).data("clicked")) return !1;
                    $(this).data("clicked", "true")
                })
            }

            function X() {
                ma.suggestionsType = "", Ta = "", d(""), ma.setCity(""), $(".wordbox", qa).css("width", "100%"), $(".wordbox input", qa).removeClass("wordInp"), $(".bubblePack", qa).css("width", "100%"), $("#" + ta, qa).attr("x-webkit-speech", ""), ua.attr("placeholder", Aa), ua.val() == Ba && ua.val(Aa), jsval.fixPlaceHolder(ua.parents("form:first")), $(".initBubble", qa).html("").attr("title", "").addClass("hidei"), $(".bubbleCounter", qa).html("").addClass("hidei"), $("#lead_search").length > 0 && hideLeadSearchLocalitySuggestions()
            }

            function Y(a) {
                for (i = 0; i < Na.length; i++) {
                    var b = Na[i];
                    if (a in b) {
                        Na.splice(i, 1);
                        break
                    }
                }
                for (i = 0; i < Oa.length; i++) {
                    var b = Oa[i];
                    if (a in b) {
                        Oa.splice(i, 1);
                        break
                    }
                }
                for (i = 0; i < Qa.length; i++) {
                    var b = Qa[i];
                    if (a in b) {
                        Qa.splice(i, 1);
                        break
                    }
                }
                for (i = 0; i < Ra.length; i++) {
                    var b = Ra[i];
                    if (a in b) {
                        Ra.splice(i, 1);
                        break
                    }
                }
                for (i = 0; i < Pa.length; i++) {
                    if (a in Pa[i]) {
                        Pa.splice(i, 1);
                        break
                    }
                }
            }

            function Z(a) {
                var b = a.split(",");
                for (i = 0; i < b.length; i++) {
                    var c = $.trim(b[i]);
                    if ("CITY" === c.substr(0, 4)) {
                        return c.substring(5)
                    }
                }
            }

            function _() {
                return Ra.length > 0 ? Ra[0] : Oa.length > 0 ? Oa[0] : Qa.length > 0 ? Qa[0] : []
            }

            function aa() {
                for (var a = [], b = 0; b < arguments.length; b++)
                    for (var c = arguments[b], d = 0; d < c.length; d++) a.push(c[d]);
                return a
            }

            function ba() {
                for (var a = aa(Ra, Oa, Qa), b = [], c = 0; c < a.length; c++) {
                    var d = a[c];
                    for (k in d) {
                        var e = d[k];
                        break
                    }
                    var f = e[1];
                    city = parseInt(Z(f)), b.push(city);
                    var g = b.length;
                    if (g > 1 && b[g - 1] != b[g - 2]) return !1
                }
                return !0
            }

            function ca() {
                return Na
            }

            function da() {
                return Oa
            }

            function ea() {
                return Ra
            }

            function fa() {
                return Sa
            }

            function ga() {
                return Qa
            }

            function ha() {
                return Pa
            }

            function ia() {
                return Ua
            }

            function ja() {
                return Ha
            }

            function ka(a) {
                a = void 0 !== a && a, s(), m(), M()
            }

            function la() {
                for (var a, b, c, d = Suggester99.getLocalityArray(), e = [], f = 0; f < d.length; f++) {
                    for (a = JSON.stringify(d[f]), b = a.split(","), j = 0; j < b.length; j++) b[j].indexOf("LOCALITY") > -1 && (c = b[j].split("_")[1]);
                    e.push(c)
                }
                return e.toString()
            }
            qsAvail = "undefined" != typeof qsSrp;
            var ma, na = "city",
                oa = "#city",
                pa = "bedroom_num",
                qa = $("#suggesterCtx"),
                ra = "suggestions_custom",
                sa = $("#suggestions_custom", qa),
                ta = "keyword",
                ua = $("#keyword", qa),
                va = "keyword_suggest",
                wa = ".suggestion-tag",
                xa = ".suggestion-cross",
                ya = "property_type",
                za = "preference",
                Aa = "Type Location or Project/Society or Keyword",
                Ba = "Add More ...",
                Ca = "",
                Da = !1,
                Ea = qsAvail ? qsSrp.getVirtualCities() : "",
                Fa = "6,82,7,9,10,83,11,12,13,14,15,17,18,19,21,81",
                Ga = "1,4,2,3,90,5,22,80",
                Ha = qsAvail ? qsSrp.getVirtualCityMapping() : "",
                Ia = qsAvail ? qsSrp.getCitiesWithSecondaryParents() : "",
                Ja = [],
                Ka = -1,
                La = "",
                Ma = [],
                Na = [],
                Oa = [],
                Pa = [],
                Qa = [],
                Ra = [],
                Sa = [],
                Ta = "",
                Ua = "";
            return {
                performTask: ka,
                initializeAutoSuggestorInstance: O,
                suggestions_container: ra,
                fullSuggestion: Na,
                localityArray: Oa,
                phraseValueMap: Pa,
                populateFilters: M,
                populateLocalitiesOrProject: m,
                bindHandlers: W,
                isAutoSuggesterSet: g,
                getAutoSuggesterInstance: h,
                customDataForSuggester: s,
                setCustomData: v,
                getFullSuggestion: ca,
                getPhraseValueMap: ha,
                getLocalityArray: da,
                getLocalityId: la,
                resetSelf: a,
                getvirtualCityMapping: ja,
                getProjectArray: ga,
                getCityArray: ea,
                getEntityArray: fa,
                hideSuggestions: S,
                setSuggesterCity: d,
                getContext: c,
                removeTypeElement: r,
                resetLocalities: b,
                getFirstPhraseForSearch: ia,
                setKeywordText: e,
                updateEntitiesAfterAddingSuggestions: z,
                getNewDataNumberForSuggestion: Q,
                addSuggestionToContainer: P
            }
        }
        var b;
        return {
            getInstance: function() {
                return b || (b = a()), b
            }
        }
    }(),
    Suggester99;
$(document).ready(function() {
    -1 == $("#city").val() && $("#city").val("");
    var a = window.suggesterSingleton;
    Suggester99 = a.getInstance(), Suggester99.bindHandlers(), Suggester99.setCustomData()
});
var searchUrl = {
    search_type: "",
    input_data: [],
    canonical_url: "",
    seo_url: "",
    query_data: [],
    populateSearchData: function(a, b) {
        return this.resetVariables(a, b) && this.sanitizeData() && this.populateQueryStringFields() && this.buildSearchUrl() && this.buildStaticUrl()
    },
    resetVariables: function(a, b) {
        return this.search_type = a, this.input_data = b, this.query_data = null, this.canonical_url = "", this.seo_url = "", !0
    },
    sanitizeData: function() {
        void 0 != this.input_data.keyword && this.input_data.keyword == search.default_keyword_text && (this.input_data.keyword = ""), void 0 != this.input_data.keyword && "" == this.input_data.keyword.trim() && delete this.input_data.keyword;
        var a = void 0 != this.input_data.locality ? this.input_data.locality : "";
        "" != a && arr.is_arr_obj(a) && (this.input_data.locality = arr.array_unique(a));
        var b = void 0 != this.input_data.bedroom_num ? this.input_data.bedroom_num : "";
        "" == b || arr.is_arr_obj(b) || (this.input_data.bedroom_num = b.split(","));
        var c = void 0 != this.input_data.area_min ? this.input_data.area_min : "",
            d = void 0 != this.input_data.area_max ? this.input_data.area_max : "";
        return (isNaN(c) || 0 == c) && (c = this.input_data.area_min = ""), (isNaN(d) || 0 == d) && (d = this.input_data.area_max = ""), "" != c && "" != d && parseInt(c) > parseInt(d) && (this.input_data.area_max = c, this.input_data.area_min = d), !0
    },
    populateQueryStringFields: function() {
        var a, b = [];
        for (a in this.input_data) {
            var c = this.input_data[a];
            b[a] = c && arr.is_arr_obj(c) ? c.join(",") : c
        }
        return this.query_data = b, !0
    },
    buildSearchUrl: function() {
        return this.initSearchUrl(), this.appendSearchTypeToUrl(), this.appendPreferenceToUrl(), this.appendPropTypeToUrl(), this.appendLocalityCityToUrl(), !0
    },
    buildStaticUrl: function() {
        var a = "";
        for (key in this.query_data) {
            if ("strEntityMap" == key) var b = Base64.encode(this.query_data[key]);
            else var b = this.query_data[key];
            "" != b && (a += key + "=" + encodeURIComponent(b) + "&")
        }
        return a = a.replace(/&$/, ""), this.seo_url = "" == a ? this.canonical_url : this.canonical_url + "?" + a, !0
    },
    initSearchUrl: function() {
        var a = this.search_type,
            b = void 0 != this.input_data.mapsearch ? this.input_data.mapsearch : "";
        return "DEALER" != a && "1" == b ? (this.canonical_url += "search/map", this.query_data.mapsearch = "1") : this.canonical_url += "search", !0
    },
    appendSearchTypeToUrl: function() {
        var a = "",
            b = this.search_type,
            c = void 0 != this.input_data.property_type ? this.input_data.property_type : [],
            d = {
                DEALER: "dealer",
                PROPERTY: "property",
                PROJECT: "project"
            },
            a = "/" + d[b];
        return "PROPERTY" == b && 1 == c.length && arr.in_array(["23", "26"], c[0]) && (a = "/project"), this.canonical_url += a, !0
    },
    appendPreferenceToUrl: function() {
        var a, b, c = "";
        return a = void 0 != this.input_data.preference ? this.input_data.preference : "", b = {
            R: "/rent",
            P: "/rent",
            L: "/lease",
            S: "/buy"
        }, c = b[a], this.canonical_url += c, this.query_data.preference = a, !0
    },
    appendPropTypeToUrl: function() {
        var a = "",
            b = void 0 != this.input_data.property_type ? this.input_data.property_type : [];
        b = arr.to_arr(b);
        var c = this.input_data.res_com,
            d = Array();
        if ("DEALER" != this.search_type && "PROJECT" != this.search_type || (arr.in_array(["C", "COM"], this.input_data.res_com) ? a += "commercial" : a += "residential"), "PROJECT" == this.search_type) {
            arr.in_array(["C", "COM"], this.input_data.res_com);
            for (var e in b) arr.in_array(["23", "26", "R", "C"], b[e]) || (d[e] = b[e]);
            this.query_data.property_type = d.join(",")
        } else if ("PROPERTY" == this.search_type) {
            if ("P" === this.input_data.preference) {
                var f = "residential";
                a = f
            } else if (b.length > 1) {
                var f = "R" == c ? "residential-all" : "commercial-all";
                a = f
            } else if (1 == b.length) {
                var f;
                "23" == b[0] ? a = "residential" : "26" == b[0] ? a = "commercial" : (f = this.getPropTypeLabel(b[0]), a = f)
            }
            this.query_data.property_type = b.join(",")
        } else if ("DEALER" == this.search_type) {
            for (var e in b) arr.in_array(["R", "C"], b[e]) || (d[e] = b[e]);
            this.query_data.property_type = d.join(",")
        }
        return this.canonical_url += a ? "/" + a : "", !0
    },
    appendLocalityCityToUrl: function() {
        var a = void 0 != this.input_data.city ? this.input_data.city : "",
            b = void 0 != this.input_data.locality ? this.input_data.locality : [],
            c = this.input_data.cityLocalitySeoStr;
        if (b.length > 0 && arr.is_arr_obj(b) && (this.query_data.locality = b.join(",")), this.query_data.city = a, !c && void 0 !== suggesterSingleton) {
            c = suggesterSingleton.getInstance().getFirstPhraseForSearch()
        }
        return void 0 != c && null != c && "" != c || (c = this.input_data.keyword), this.appendKeywordsToUrl(c), !0
    },
    appendKeywordsToUrl: function(a) {
        var b;
        return b = $.trim(a).replace(/[\W_]+/g, "-").replace(/^-+|-+$/g, "").toLowerCase(), this.canonical_url += b ? "/" + b : "", !0
    },
    getPropTypeLabel: function(a) {
        var b = {
                R: "residential-all",
                C: "commercial-all"
            },
            c = b[a];
        return c = void 0 !== c ? c : search.getPropTypeSeoUrlStr(a)
    }
};;