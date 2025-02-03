function createAreaArr(a) {}

function getCookie(a) {}

function setCookieExp(a, b, c, d, e, f) {}

function setCookieExpInMs(a, b, c, d, e, f) {}

function getCookieVal(a) {}

function dontCheckIdle() {
    checkIdleFlag = !1
}

function setActionFlag() {
    isIdle = !1
}

function checkActionFlag() {}

function jumpToAnchor(a) {}

function adjustLayerSize(a) {}

function isInt(a) {}

function _toggle(a) {}

function isset(a) {
    return void 0 !== a && null !== a
}

function empty(a) {
    return !isset(a) || !a
}

function slider(a, b, c, d, e) {}

function sliderWithClass(a, b, c, d, e, f, g) {}

function circularSlider(a, b, c, d, e, f, g, h) {}

function slideCorousel(a, b, c, d) {}

function adjustCorousel(a, b) {}

function ImageRotationWithCanvas(a, b, c) {}

function logout() {}

function registerLogin() {}

function toTitleCase(a) {
    return a.replace(/\w\S*/g, function(a) {
        return a.charAt(0).toUpperCase() + a.substr(1).toLowerCase()
    })
}

function toProperCase(a) {}

function GA(a, b) {
    return a.getAttribute(b)
}

function SA(a, b, c) {
    return a.setAttribute(b, c)
}

function isNumber(a) {
    return !isNaN(parseFloat(a)) && isFinite(a)
}

function passwordMobileSimilarity(a) {
    var b = !1;
    return 0 != $("input[name='Mobile']").length ? a == $("input[name='Mobile']").val() && (b = !0) : 0 != $("input[name='Phone']").length && a == $("input[name='Phone']").val() && (b = !0), b
}

function checkiPad() {
    /iPhone|iPad|iPod/i.test(navigator.userAgent) && (window.isiPad = !0, $("body").css({
        cursor: "pointer"
    }))
}

function loginUnsticky() {
    !currentPageName || "XID_DETAIL_PAGE" != currentPageName && "Property Description" != currentPageName && "dif_landing_page" != currentPageName || ($("#upBanner").is(":visible") ? $("#genlayerloginHeader").css({
        left: "954px",
        top: "131px"
    }) : $("#genlayerloginHeader").css({
        left: "954px",
        top: "56px"
    }), $("#loginLayer").css({
        position: "",
        top: "0px"
    }))
}

function tracking_data(a, b, c) {}

function closeAllPrevious() {
    dontCheckIdle(), jsui.hideCurLyr(), pg.closeModalLayer()
}

function removeQueryLayer() {
    0 != $(".qfrm.m3").length && $(".qfrm.m3").remove()
}

function includeExternalJs(a, b, c) {
    var d = document.createElement("script");
    d.src = a, d.async = b || !0, c = c || document.body, c.appendChild(d)
}

function userAuthentication() {}

function userAuthenticationSuccess(a) {
    a = a.trim();
    doc.byId("userAuth").value;
    "1" != a && (doc.byId("userAuth").value = "1")
}

function setUserAuthencationFlag() {
    pg.userAuth = "1"
}

function checkUserAuthencation() {
    return userAuthentication(), "1" != doc.byId("userAuth").value || (window.location = "/property/login.php", !1)
}

function trackEventByGA(a, b, c, d) {
    return "undefined" != typeof currentPageName && "" != currentPageName || "undefined" == typeof pageName || (currentPageName = pageName), trackingCategory = void 0 !== d ? d : "undefined" != typeof currentPageName ? currentPageName : "UNKNOWN", actualAction = !1 === b ? a : a + "_" + b, "on" == getStorageValue("shwGATrck") && console.log("Category:" + trackingCategory + " Action:" + actualAction + " Value:" + c), null != trackingCategory && trackingCategory, _gaq.push(["_trackEvent", trackingCategory, actualAction, c]), !0
}

function trackECommByGA(a) {
    if (0 != hackSlider && void 0 != a) {}
}

function trackAnaWidget(a, b, c, d, e) {}

function trackClickAction(a, b, c, d) {}

function getCookieValue(a) {
    return currentcookie = document.cookie, currentcookie.length > 0 && (firstidx = currentcookie.indexOf(a + "="), -1 != firstidx) ? (firstidx = firstidx + a.length + 1, lastidx = currentcookie.indexOf(";", firstidx), -1 == lastidx && (lastidx = currentcookie.length), unescape(currentcookie.substring(firstidx, lastidx))) : " "
}

function findObj(a, b) {}

function showHideLayers() {
    var a, b, c, d = showHideLayers.arguments;
    for (a = 0; a < d.length - 2; a += 3) null != (c = findObj(d[a])) && (b = d[a + 2], c.style && (c = c.style, b = "show" == b ? "visible" : "hide" == b ? "hidden" : b), c.visibility = b)
}

function resizeHeight(a) {
    var b = doc.byId(a);
    try {
        "" != b.contentWindow.document.body[IH] && (b.height = b.contentWindow.document.body.scrollHeight)
    } catch (c) {}
}

function resizeHeight_Banner(a) {
    var b = doc.byId(a);
    try {
        "" != b.contentWindow.document.body.innerHTML && b.contentWindow.document.body.scrollHeight >= 50 && (b.height = b.contentWindow.document.body.scrollHeight)
    } catch (c) {}
}

function onSuccessZclassThankyouLayer(a, b) {}

function postZClassRegistration(a) {
    $(".signC").hide();
    var b = null;
    if (usrMgr.loginStatus && loginLib.updateLoginHeader(a.user), $("#registration_layer").length) var b = $("#registration_layer").parent();
    1 == usrMgr.verificationStatus || 0 == usrMgr.verificationSwitch ? onSuccessZclassThankyouLayer(a, b) : usrMgr.doVerification(a.validationlayer, b, a.validationData)
}

function topLogin() {}

function ffChangeBuyRentTab(a, b) {}

function autoSuggest() {
    this.aNames = new Array, this.aTypes = new Array, this.aId = new Array
}

function hideServerSideErrorMessages(a) {
    (idDiv = doc.byId(a)) && (idDiv.style.display = "none")
}

function hideAllServerSideErrorMessages(a) {
    var b = document[ELBN](a),
        c = b.length;
    if (c > 0)
        for (var d = 0; d < c; d++) b[d].style.display = "none"
}

function beacon_track(a, b) {
    b || (b = "beacon_img");
    var c = doc.byId(b);
    null != c && (c.src = a)
}

function dispCTView(a, b) {
    var c = 0 === b ? "none" : "block",
        d = 0 === b ? "block" : "none";
    a[PN][ATR]("ctv") && (a = a[PN]);
    for (var e = a.nextSibling; e;) {
        if (("DIV" == e.tagName || "div" == e.tagName) && e[ATR]("ph")) {
            e.style.display = c, a.style.display = d;
            break
        }
        e = e.nextSibling
    }
}

function DispContDetailForPrint() {
    trackEventByGA("CLICK", "PRINT");
    for (var a = document[ELBN]("contDetailForPrint[]"), b = 0; b < a.length; b++) {
        a.item(b).style.display = "inline"
    }
}

function mobileVerificationOTP() {}

function mobileVerificationMissCall() {}

function emailVerification() {}

function validateField(a) {
    var b = $(a).val(),
        c = /([^0-9])+/g;
    return c.test(b) ? (a.value = b.replace(c, ""), !0) : (isNumber(b), !1)
}

function submitVerifyForm(a, b) {
    if (a.preventDefault ? a.preventDefault() : a.returnValue = !1, void 0 === b && (b = this), "" === $(b).find("#OTP").val()) return $(b).find("#verificationErr").show(), $(b).find("#verificationErr").val("Empty Code"), $(b).find("#OTP").css({
        "border-color": "#ff0000"
    }), !1;
    var c = $(b).serialize();
    return mobObjMgr.doVerification(c, b), !1
}

function EditProfileMobileValidation(a, b) {}

function resendCode(a, b) {
    void 0 === b && (b = this);
    var c = $(b).closest("form"),
        d = $(c).serialize();
    return mobObjMgr.sendForVerification(d, b), !1
}

function afterSkipAction(a, b) {
    var c = $(b).closest("#verifyLayer");
    return mobObjMgr.afterSkipAction(c), !1
}

function performSkipAction(a, b, c) {
    mobObjMgr.performSkipAction(a, b, c)
}

function performSkipActionXid(a) {}

function hideShowPassword(a) {}

function scrollToElement(a, b, c, d) {
    scrollToEle = !0, b = void 0 !== b ? b : 1e3, d = d || document, c = void 0 !== c ? c : 0;
    var e = $(a),
        f = e.offset(),
        g = f.top + c;
    $("html, body", d).animate({
        scrollTop: g
    }, b)
}

function blink(a, b, c) {
    0 != b && (b % 2 == 0 ? $(a).animate({
        opacity: ".5"
    }, c) : $(a).animate({
        opacity: "1"
    }, c), blink(a, --b, c))
}

function blinkColors(a, b, c) {}

function isMapSrch() {
    return $("#map-canvas").length > 0
}

function doBeaconTrack() {
    if (null != doc.byId("beacon_src")) {}
}

function ComscorePhotonLayer(a) {}

function treeSrch(a, b) {
    for (var c = 0; c < a[CHN].length; c++) {
        var d = a[CHN][c];
        if (d.tagName == b) return d;
        var e = treeSrch(d, b);
        if (null != e) return e
    }
    return null
}

function _getPosition(a) {}

function _getSource(a) {}

function clickTrack_expired(a, b, c) {}

function _getFromSource(a) {
    var b = "";
    return "microsite" == a ? b = void 0 !== top.from_src ? "&from_src=" + top.from_src + "_DETVIEW_MICROSITE" : "&from_src=DETVIEW_MICROSITE" : void 0 !== top.from_src && (b = "&from_src=" + top.from_src), b
}

function getFlashMovieObject(a) {
    return window.document[a] ? window.document[a] : -1 != navigator.appName.indexOf("Microsoft Internet") ? doc.byId(a) : document.embeds && document.embeds[a] ? document.embeds[a] : void 0
}

function ReplayFlashBanner() {
    return !0
}

function showShoskele(a, b) {
    return !0
}

function ldImgFrHdr() {}

function toglTxtOnBtn(a, b, c) {
    c = void 0 !== c && c;
    var d = "string" == typeof b ? $("#" + b) : b;
    c ? d.val(a).prop("disabled", !1).removeClass("submitting") : ("submit_query" != b && "submit_query1" != b ? d.val(a).addClass("submitting") : d.val(a), $("#close_btn").hide(), setTimeout(function() {
        d.prop("disabled", "true")
    }, 0))
}

function _cur_lyr(a) {
    _cur_ && _cur_ != a && (_cur_.style.display = "none"), _cur_ = a
}

function timerComplete() {
    var a = doc.byId("zip_image_div"),
        b = doc.byId("refresh_timer"),
        c = doc.byId("cntdwn_div");
    a && (a.style.display = "none"), b && (b.style.display = "block"), c && (c.style.background = "#fcff94")
}

function closeAllLayersOnHtmlClk(a) {}

function appendDlrSrpTrackingParameters(a, b, c) {
    console.log(a.href);
    try {
        jsb9onUnloadTracking()
    } catch (d) {}
    url = a.href + b, c.preventDefault ? c.preventDefault() : c.returnValue = !1, window.open(url)
}

function getBusinessSegment() {
    var a = "none";
    return xid99.params && (+xid99.params.newBookingCount > 0 ? a = "NP" : +xid99.params.resalePropertyCount > 0 ? a = "RESALE" : +xid99.params.rentalPropertyCount > 0 && (a = "RENT")), a
}

function _load() {}

function bannerCssEdit(a) {}

function greyOutPage() {}

function isBannerLoaded(a) {}

function checkCSS3Support() {}

function genericAnimateSupport(a, b, c, d) {
    if (!1 === window.css3Prefix) $(a).animate(b, c, d);
    else {
        var e = 0 == window.css3Prefix ? "transition" : "Transition",
            f = window.css3Prefix + e;
        $(a).each(function() {
            $(this)[0].style[f].length > 2 ? ($(this).css(b), setTimeout(d, parseInt(c))) : ($(this).css(f, "all " + c.toString()), $(this).css(b), setTimeout(d, parseInt(c)))
        })
    }
}

function afterModifyAction(a, b) {}

function downldJGglePlsAtOnload() {}

function openAlertFeedbakLayer() {}

function tableCarouselSlider() {
    ! function() {
        $(window).resize(function(b) {
            a.funInit(10)
        }), $("[data-wrap= 'wrap'] .tabArrow").on("click", function(b) {
            var c = $(this).attr("data-arrow");
            a.funAnimate(c)
        });
        var a = {
            funInit: function(a) {
                var b = {
                        width: parseInt($('[data-wrap= "wrap"]').outerWidth() / a),
                        length: $('[data-wrap="table"] th').length
                    },
                    c = parseInt(b.width * b.length);
                $("[data-wrap='table'] td, [data-wrap='table'] th").css({
                    width: b.width + "px"
                }), $("[data-wrap='table']").css({
                    width: c + "px",
                    left: 0
                }), c > $('[data-wrap= "wrap"]').outerWidth() && ($("[data-wrap= 'wrap'] [data-arrow='right']").show(), $("[data-wrap= 'wrap'] [data-arrow='left']").hide())
            },
            funAnimate: function(a) {
                var b = $("[data-wrap='table']").outerWidth(),
                    c = $("[data-wrap= 'wrap']").outerWidth(),
                    d = parseInt($("[data-wrap='table']").css("left").split("px")[0]);
                switch (a) {
                    case "left":
                        if (d < 0)
                            if (parseInt(-d) > c) {
                                var e = parseInt(d + c);
                                $("[data-wrap='table']").css({
                                    left: e + "px"
                                })
                            } else {
                                var e = 0;
                                $("[data-wrap='table']").css({
                                    left: "-" + e + "px"
                                }), $("[data-wrap= 'wrap'] [data-arrow='left']").hide()
                            } $("[data-wrap= 'wrap'] [data-arrow='right']").show();
                        break;
                    case "right":
                        if (parseInt(b - (c - d)) > c) {
                            var e = parseInt(d + c);
                            $("[data-wrap='table']").css({
                                left: "-" + e + "px"
                            })
                        } else {
                            var e = parseInt(d - (b + d - c));
                            $("[data-wrap='table']").css({
                                left: e + "px"
                            }), $("[data-wrap= 'wrap'] [data-arrow='right']").hide()
                        }
                        $("[data-wrap= 'wrap'] [data-arrow='left']").show()
                }
            }
        };
        a.funInit(10)
    }()
}

function fireSRPCallGAEvent(a) {}

function logout() {}

function registerLogin() {}

function toggleSpl(a) {
    return a.hasClass("flipOpen") ? a.addClass("flipClose").removeClass("flipOpen") : a.removeClass("flipClose").addClass("flipOpen"), a = toggleArrows(a)
}

function toggleArrows(a) {
    return a.siblings(".dropDown").find(".iconS").hasClass("arrow-D-Icon") ? a.siblings(".dropDown").find(".iconS").addClass("arrow-b-up").removeClass("arrow-D-Icon") : a.siblings(".dropDown").find(".iconS").hasClass("arrow-b-up") ? a.siblings(".dropDown").find(".iconS").removeClass("arrow-b-up").addClass("arrow-D-Icon") : a.siblings(".dropDown").find(".arrow-down_gray").hasClass("arrow-down_gray") ? a.siblings(".dropDown").find(".arrow-down_gray").addClass("arrow-up_gray").removeClass("arrow-down_gray") : a.siblings(".dropDown").find(".arrow-up_gray").hasClass("arrow-up_gray") && a.siblings(".dropDown").find(".arrow-up_gray").removeClass("arrow-up_gray").addClass("arrow-down_gray"), a
}

function closeArrow(a) {
    a.siblings(".dropDown").find(".iconS").hasClass("arrow-b-up") ? a.siblings(".dropDown").find(".iconS").removeClass("arrow-b-up").addClass("arrow-D-Icon") : a.siblings(".dropDown").find(".arrow-up_gray").hasClass("arrow-up_gray") && a.siblings(".dropDown").find(".arrow-up_gray").removeClass("arrow-up_gray").addClass("arrow-down_gray"), $("#buyRent-dd .iconS").removeClass("arrow-D-Icon")
}

function searchBarFix() {}

function showHideAboutCityContent() {}

function referrerSections(a) {
    a = a && a.toLowerCase();
    var b = "";
    switch (a) {
        case "nri":
        case "cp1":
        case "sh":
            b = "SEARCHHEADER_SEARCH";
            break;
        case "nudge":
            b = "NUDGE_SEARCH";
            break;
        case "filter":
            b = "FILTER_SEARCH";
            break;
        case "ysf":
            b = "YSF_SEARCH";
            break;
        case "hp":
            b = "HOMEPAGE_SEARCH";
            break;
        default:
            b = "SEARCH_OTHERS"
    }
    return b
}

function getCookieVal(a) {
    return currentcookie = document.cookie, currentcookie.length > 0 && (firstidx = currentcookie.indexOf(a + "="), -1 != firstidx) ? (firstidx = firstidx + a.length + 1, lastidx = currentcookie.indexOf(";", firstidx), -1 == lastidx && (lastidx = currentcookie.length), unescape(currentcookie.substring(firstidx, lastidx))) : null
}

function noop() {}

function TrackingStore() {
    this._section = "", this._profileId = "", this._subscriptions = [], Object.defineProperties(this, {
        section: {
            get: function() {
                return this._section.concat("") || ""
            }
        },
        profileId: {
            get: function() {
                return this._profileId.concat("") || ""
            }
        }
    })
}

function tableCarouselSlider() {
    ! function() {
        $(window).resize(function(b) {
            a.funInit(10)
        }), $("[data-wrap= 'wrap'] .tabArrow").on("click", function(b) {
            var c = $(this).attr("data-arrow");
            a.funAnimate(c)
        });
        var a = {
            funInit: function(a) {
                var b = {
                        width: parseInt($('[data-wrap= "wrap"]').outerWidth() / a),
                        length: $('[data-wrap="table"] th').length
                    },
                    c = parseInt(b.width * b.length);
                $("[data-wrap='table'] td, [data-wrap='table'] th").css({
                    width: b.width + "px"
                }), $("[data-wrap='table']").css({
                    width: c + "px",
                    left: 0
                }), c > $('[data-wrap= "wrap"]').outerWidth() && ($("[data-wrap= 'wrap'] [data-arrow='right']").show(), $("[data-wrap= 'wrap'] [data-arrow='left']").hide())
            },
            funAnimate: function(a) {
                var b = $("[data-wrap='table']").outerWidth(),
                    c = $("[data-wrap= 'wrap']").outerWidth(),
                    d = parseInt($("[data-wrap='table']").css("left").split("px")[0]);
                switch (a) {
                    case "left":
                        if (d < 0)
                            if (parseInt(-d) > c) {
                                var e = parseInt(d + c);
                                $("[data-wrap='table']").css({
                                    left: e + "px"
                                })
                            } else {
                                var e = 0;
                                $("[data-wrap='table']").css({
                                    left: "-" + e + "px"
                                }), $("[data-wrap= 'wrap'] [data-arrow='left']").hide()
                            } $("[data-wrap= 'wrap'] [data-arrow='right']").show();
                        break;
                    case "right":
                        if (parseInt(b - (c - d)) > c) {
                            var e = parseInt(d + c);
                            $("[data-wrap='table']").css({
                                left: "-" + e + "px"
                            })
                        } else {
                            var e = parseInt(d - (b + d - c));
                            $("[data-wrap='table']").css({
                                left: e + "px"
                            }), $("[data-wrap= 'wrap'] [data-arrow='right']").hide()
                        }
                        $("[data-wrap= 'wrap'] [data-arrow='left']").show()
                }
            }
        };
        a.funInit(10)
    }()
}

function Banners(a) {
    var b = this,
        c = a.bannerParams;
    b.setpageId(c.pageId), b.setpageIdentifier(c.pageIdentifier), b.setResCom(c.resCom), b.setBannerIdentifier(c.bannerIdentifier), b.setMinBannersToDisplay(c.minBannersToDisplay), b.setFallBackFunction(c.fallBackFunction), b.setDisplayParams(a.displayParams), b.slider = $(".__slider-container"), b.lbheader = $("#leaderBoard")
}

function stripSlashes(a) {
    return a = a.replace(/\\'/g, "'"), a = a.replace(/\\"/g, '"')
}

function getRandomInt(a, b) {
    return Math.floor(Math.random() * (b - a)) + a
}
var console = console || {
        log: function(a) {},
        debug: function(a) {},
        info: function(a) {},
        warn: function(a) {}
    },
    IMG_BASE_URL = IMG_BASE_URL || "",
    show_bounzd = show_bounzd || "",
    show_lazy_load = show_lazy_load || "",
    isTchEnabled = "ontouchstart" in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0,
    clickEventStr = "click",
    mouseEnterStr = isTchEnabled ? "touchstart" : "mouseenter",
    mouseLeaveStr = "mouseleave",
    env = window.env = new function() {
        var a = navigator,
            b = a.userAgent,
            c = a.appVersion,
            d = this;
        d.debug = !1, d.safari = c.indexOf("Safari") >= 0;
        var e = b.indexOf("Gecko");
        return d.moz = e >= 0 && !d.khtml, d.ie = document.all && !d.opera, d.ieVer = parseFloat(c.substr(c.indexOf("MSIE") + 4)), d.oldIE = d.ie && d.ieVer < 6, d.mozVer = e >= 0 ? parseFloat(b.substr(b.indexOf("Firefox") + 8)) : 0, d.ver = parseFloat(c), d.ie6up = d.ie && d.ieVer >= 6, d.XH_IDS = ["Msxml2.XMLHTTP", "Microsoft.XMLHTTP", "Msxml2.XMLHTTP.4.0"], d.newXHO = function() {
            var a = null;
            try {
                a = new XMLHttpRequest
            } catch (d) {}
            if (!a)
                for (var b = 0; b < 3; ++b) {
                    var c = env.XH_IDS[b];
                    try {
                        a = new ActiveXObject(c)
                    } catch (d) {}
                    if (a) {
                        env.XH_IDS = [c];
                        break
                    }
                }
            return a
        }, d.keys = {
            LEFT_ARR: 37,
            RIGHT_ARR: 39,
            TAB: 9,
            ESCAPE: 27
        }, this
    },
    doc = document,
    w = window;
doc.byId = function(a) {
    return doc[ELBI] ? doc[ELBI](a) : doc.all ? doc.all[a] : null
};
var Base64 = {
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        encode: function(a) {
            var b, c, d, e, f, g, h, i = "",
                j = 0;
            for (a = Base64._utf8_encode(a); j < a.length;) b = a.charCodeAt(j++), c = a.charCodeAt(j++), d = a.charCodeAt(j++), e = b >> 2, f = (3 & b) << 4 | c >> 4, g = (15 & c) << 2 | d >> 6, h = 63 & d, isNaN(c) ? g = h = 64 : isNaN(d) && (h = 64), i = i + Base64._keyStr.charAt(e) + Base64._keyStr.charAt(f) + Base64._keyStr.charAt(g) + Base64._keyStr.charAt(h);
            return i
        },
        decode: function(a) {
            var b, c, d, e, f, g, h, i = "",
                j = 0;
            for (a = a.replace(/[^A-Za-z0-9\+\/\=]/g, ""); j < a.length;) e = Base64._keyStr.indexOf(a.charAt(j++)), f = Base64._keyStr.indexOf(a.charAt(j++)), g = Base64._keyStr.indexOf(a.charAt(j++)), h = Base64._keyStr.indexOf(a.charAt(j++)), b = e << 2 | f >> 4, c = (15 & f) << 4 | g >> 2, d = (3 & g) << 6 | h, i += String.fromCharCode(b), 64 != g && (i += String.fromCharCode(c)), 64 != h && (i += String.fromCharCode(d));
            return i = Base64._utf8_decode(i)
        },
        _utf8_encode: function(a) {
            a = a.replace(/\r\n/g, "\n");
            for (var b = "", c = 0; c < a.length; c++) {
                var d = a.charCodeAt(c);
                d < 128 ? b += String.fromCharCode(d) : d > 127 && d < 2048 ? (b += String.fromCharCode(d >> 6 | 192), b += String.fromCharCode(63 & d | 128)) : (b += String.fromCharCode(d >> 12 | 224), b += String.fromCharCode(d >> 6 & 63 | 128), b += String.fromCharCode(63 & d | 128))
            }
            return b
        },
        _utf8_decode: function(a) {
            for (var b = "", c = 0, d = c1 = c2 = 0; c < a.length;) d = a.charCodeAt(c), d < 128 ? (b += String.fromCharCode(d), c++) : d > 191 && d < 224 ? (c2 = a.charCodeAt(c + 1), b += String.fromCharCode((31 & d) << 6 | 63 & c2), c += 2) : (c2 = a.charCodeAt(c + 1), c3 = a.charCodeAt(c + 2), b += String.fromCharCode((15 & d) << 12 | (63 & c2) << 6 | 63 & c3), c += 3);
            return b
        }
    },
    ack = "All consts, js, jsevt, jsui, ajax - Thanks to agodika.com, parivaar.info",
    OW = "offsetWidth",
    OH = "offsetHeight",
    OL = "offsetLeft",
    OT = "offsetTop",
    CHN = "childNodes",
    PN = "parentNode",
    FC = "firstChild",
    LC = "lastChild",
    NS = "nextSibling",
    APP = "appendChild",
    ATR = "getAttribute",
    IH = "innerHTML",
    CN = "className",
    InW = "innerWidth",
    InH = "innerHeight",
    DOCEL = "documentElement",
    CW = "clientWidth",
    CH = "clientHeight",
    ELBI = "getElementById",
    ELBT = "getElementsByTagName",
    ELBN = "getElementsByName";
D = "disabled", CHK = "checkbox", RAD = "radio", C = "checked", S = "selected", LOADING_HTML = "<table style='height:100%'><tr><td class='b' style='vertical-align:middle;font-size:13px;'><img class='lf' width='50px' height='48px' src='" + IMG_BASE_URL + "> <span class='lf mt15'>Loading...</span></td></tr></table>";
var js = {
        body: function() {
            return doc.body || doc[ELBT]("BODY")[0]
        },
        cp: function(a, b) {
            var c = js.empty;
            for (var d in a)
                if (void 0 === c[d] || c[d] != a[d]) try {
                    b[d] = a[d]
                } catch (e) {}
        },
        dom: {
            find: function(a, b) {
                for (var c = a[CHN], d = 0; d < c.length; d++)
                    if (c[d].tagName == b) return c[d]
            },
            findParent: function(a, b) {
                for (var c = a; c = c[PN];)
                    if (c.tagName == b) return c
            },
            findAll: function(a, b) {
                try {
                    var c = a[CHN],
                        d = [];
                    js.isStr(b) && (b = [b]);
                    for (var e = 0; e < c.length; e++) 1 == c[e].nodeType && (Array.contains(b, c[e].tagName) && d.push(c[e]), d = d.concat(js.dom.findAll(c[e], b)));
                    return d
                } catch (f) {}
            },
            create: function(a, b, c) {
                var d = doc.createElement(a);
                return js.cp(b, d), js.cp(c, d.style), d
            },
            isNode: function(a) {
                return a.nodeType > 0
            },
            append: function(a, b) {
                return b.appendChild(a), a
            },
            add: function(a) {
                if (!env.ie || env.ieVer >= 8) return js.dom._add(a);
                if ("complete" == doc.readyState || w.domLoaded) return js.dom._add(a);
                if (doc.byId("ieLyrPrnt")) return js.dom.append(a, doc.byId("ieLyrPrnt"));
                throw "ie"
            },
            _add: function(a) {
                return js.body().appendChild(a), a
            },
            insert: function(a, b) {
                return b.parentNode.insertBefore(a, b), a
            },
            insertAfter: function(a, b) {
                return b.nextSibling ? b.parentNode.insertBefore(a, b.nextSibling) : b.parentNode.appendChild(a), a
            }
        },
        win: {
            size: function() {
                return "number" == typeof w[InW] ? {
                    wd: w[InW],
                    ht: w[InH]
                } : doc[DOCEL] && (doc[DOCEL][CW] || doc[DOCEL][CH]) ? {
                    wd: doc[DOCEL][CW],
                    ht: doc[DOCEL][CH]
                } : {
                    wd: doc.body[CW],
                    ht: doc.body[CH]
                }
            },
            scroll: function() {
                if ("number" == typeof window.pageYOffset) return {
                    y: window.pageYOffset,
                    x: window.pageXOffset
                };
                var a = doc[DOCEL];
                return {
                    y: a.scrollTop,
                    x: a.scrollLeft
                }
            }
        },
        pos: {
            toCoords: function(a) {
                for (var b = a, c = {
                        x: 0,
                        y: 0,
                        w: b[OW],
                        h: b[OH]
                    }; null != b;) {
                    var d = b[OL];
                    c.x += isNaN(d) ? 0 : d, d = b[OT], c.y += isNaN(d) ? 0 : d, b = b.offsetParent
                }
                return c
            },
            origin: function(a) {
                for (var b = {
                        x: 0,
                        y: 0
                    }, c = !1; null != a;) {
                    if (a = a.offsetParent, !c) try {
                        switch (jsui.getStyle(a).position) {
                            case "absolute":
                            case "relative":
                                c = !0
                        }
                    } catch (e) {}
                    if (a && c) {
                        var d = a[OL];
                        b.x += isNaN(d) ? 0 : d, d = a[OT], b.y += isNaN(d) ? 0 : d
                    }
                }
                return b
            }
        },
        isFP: function(a) {
            return a instanceof Function || "function" == typeof a
        },
        isStr: function(a) {
            return "string" == typeof a || a instanceof String
        },
        isArr: function(a) {
            return "array" == typeof a || a instanceof Array
        },
        isObj: function(a) {
            return "object" == typeof a || a instanceof Object
        },
        pick: function() {
            for (var a = arguments, b = 0; b < a.length; b++)
                if (null != a[b]) return a[b]
        },
        setTimeout: function(a, b, c) {
            a || (a = window), js.isStr(b) && (b = a[b]);
            for (var d = [], e = arguments, f = 3; f < e.length; f++) d.push(e[f]);
            return w.setTimeout(function() {
                b.apply(a, d)
            }, c)
        },
        empty: {}
    },
    JD = js.dom,
    F_APP = JD.append,
    F_CR = JD.create,
    jsevt = {
        setHandlers: function(a) {
            for (var b = 0; b < a.length; b++) jsevt.addListener.apply(jsevt, a[b])
        },
        addListener: function(a, b, c) {
            for (var d = [], e = arguments, f = 3; f < e.length; f++) d.push(e[f]);
            var g = function(b) {
                b || (b = window.event), b.target || (b.target = b.srcElement), b.stopPropagation || (b.stopPropagation = jsevt.cancel), b.preventDefault || (b.preventDefault = jsevt.prevent);
                var e = [b].concat(d);
                if (c) return c.apply(a, e)
            };
            if (a.attachEvent) a.attachEvent("on" + b, g);
            else if (a.addEventListener) a.addEventListener(b, g, !1);
            else if (b = "on" + b, "function" == typeof a[b]) {
                var h = a[b];
                a[b] = function(a) {
                    return h(a), g(a)
                }
            } else a[b] = g;
            return g
        },
        cancel: function() {
            this.cancelBubble = !0
        },
        prevent: function() {
            this.returnValue = !1
        },
        stopBubble: function(a) {
            if (!a) var a = window.event;
            try {
                a.cancelBubble = !0, a.stopPropagation()
            } catch (b) {}
        },
        stopDefault: function(a) {
            a || (a = window.event);
            try {
                a.returnValue = !1, a.preventDefault()
            } catch (b) {}
            return !1
        },
        stopEvt: function(a) {
            return jsevt.stopBubble(a), jsevt.stopDefault(a)
        },
        callFuncPtr: function() {
            for (var a = arguments, b = a[0], c = [], d = 1; d < a.length; d++) c.push(a[d]);
            return function() {
                b.apply(this, c)
            }
        }
    },
    ajax = window.ajax = {
        pool: {
            pool: [],
            get: function() {
                var a = this.pool;
                return a.length > 0 ? a.pop() : env.newXHO()
            },
            put: function(a) {
                this.pool.push(a)
            }
        },
        getText: function(a, b, c) {
            function d(d) {
                if (js.isFP(b)) try {
                    b.call(a.ctx, d.responseText)
                } catch (e) {
                    js.isFP(c) && c.call(a.ctx, -1, d ? d.responseText : "", a.params, e)
                }
            }
            return this.Request(a.url ? a.url : a, a.params, !a.sync, a.ctx, d, c, a.method ? a.method : "POST")
        },
        parseParams: function(a) {
            if (a) {
                if (js.isStr(a)) return a;
                var b = [],
                    c = js.empty;
                for (var d in a)
                    if (void 0 === c[d] && 0 == js.isFP(a[d])) {
                        var e = a[d];
                        if (js.isArr(e))
                            for (var f = 0; f < e.length; f++) b.push(d + "=" + escape(e[f]).replace(/\+/g, "%2B"));
                        else b.push(d + "=" + escape(e).replace(/\+/g, "%2B"))
                    } return b.join("&")
            }
            return null
        },
        postForm: function(a, b, c) {
            function d(a) {
                if (js.isFP(b)) try {
                    b.call(f, a.responseText)
                } catch (d) {
                    js.isFP(c) && c.call(f, -1, a ? a.responseText : "", i, d)
                }
            }
            for (var e = a.url ? a.url : a.thisfrm ? a.thisfrm.action : a.action, f = a.ctx ? a.ctx : a, a = a.thisfrm ? a.thisfrm : a, g = !!a.async && a.async, h = {}, i = js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "BUTTON"]), j = 0; j < i.length; j++)
                if (!i[j].disabled && i[j].value != GA(i[j], "defVal") && (i[j].type != RAD && i[j].type != CHK || i[j].checked)) {
                    var k = i[j].name,
                        l = i[j].value;
                    js.isArr(h[k]) ? h[k].push(l) : void 0 !== h[k] ? h[k] = [h[k], l] : h[k] = l
                } if (f == a)
                for (var m in jsval.ajxVlds)
                    if (jsval.ajxVlds[m]) return !1;
            if (h.from_ajax = "Y", "XID_EMAIL_TCO" === h.np_layout) {
                var n = TCOEOI.getPdfPriceListContent();
                h.tcoConfiguration = n[0], h.tcoTowerPhase = n[1], h.tcoProjectName = n[2], h.tcoProjectId = n[3], h.tcoResCom = n[4], h.tcoProjAddress = n[5], h.tcoAdvertiserName = n[6], h.costTable = n[7]
            }
            this.Request(e, h, g, f, d, c, "POST")
        },
        trackGAnCS: function(a) {
            return !1
        },
        Request: function(a, b, c, d, e, f, g) {
            function h() {
                if (4 == i.readyState) {
                    try {
                        i.status
                    } catch (a) {
                        return void(js.isFP(f) && f.call(d || i, -3, i.responseText, b))
                    }
                    switch (i.status) {
                        case 200:
                        case 304:
                            js.isFP(e) && e.call(d || i, i);
                            break;
                        default:
                            js.isFP(f) && f.call(d || i, i.status, i.responseText, b)
                    }
                    ajax.pool.put(i)
                }
            }
            var i = ajax.pool.get();
            if (i) {
                !1 !== c && (c = !0);
                var j = this.parseParams(b) + "&is_ajax=1";
                "GET" == g && null != j ? (a = a + "?" + j, j = null) : "POST" == g && null == j && (j = "dummy=1"), i.open(g, a, c), i.onreadystatechange = h, "POST" == g && i.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), i.send(j);
                return navigator.userAgent.toLowerCase().indexOf("chrome") > -1 || !env.moz || c || env.mozVer < "4" && h(), this.trackGAnCS(a), i
            }
            return null
        }
    },
    my99Tracking = {
        GA: function(a, b, c) {
            void 0 === c && (c = ""), trackEventByGA(a, b, c)
        }
    },
    jsui = {
        makeIframe: function(a) {
            var b;
            if (env.ie) {
                b = doc.createElement("IFRAME"), b.setAttribute("src", 'javascript:""'), b.setAttribute("style", "opacity:0;position:absolute;left:0px;top:0px; z-index:-1;filter: alpha(opacity=0);")
            } else b = F_CR("iframe", {}, {
                opacity: 0,
                position: "absolute",
                left: 0,
                top: 0
            }), b.src = 'javascript:""';
            return b.tabIndex = -1, a || js.dom.add(b), b
        },
        bg: {
            ieifrfix: function(a, b, c) {
                0 == c ? c = 0 : c || (c = .6);
                var d = a || jsui.bg.el;
                try {
                    var e = d.contentWindow || d.contentDocument;
                    e.document && (e = e.document), "undefined" != typeof currentPageName && "Property Description" == currentPageName && (b = "white"), e.body.style.backgroundColor = b || "#000"
                } catch (f) {
                    jsui.setOpacity(d, c)
                }
            },
            init: function(a, b) {
                0 == a ? a = 0 : a || (a = .3), void 0 == b && (b = "#000000");
                var c;
                env.ie && env.ieVer <= 6 ? (c = jsui.bg.el = jsui.makeIframe(), c.style.zIndex = 999997, js.setTimeout(w, jsui.bg.ieifrfix, 100, "", b, a)) : c = jsui.bg.el = js.dom.add(F_CR("DIV", {}, {
                    position: "fixed",
                    backgroundColor: b,
                    zIndex: 999997
                })), c.setAttribute("id", "layerBkg"), c.style.left = c.style.top = "0px", jsui.setOpacity(c, a)
            },
            greyOutDim: function(a, b, c) {
                var d = jsui;
                d.bg.el || d.bg.init(c), d.size(d.bg.el, {
                    w: doc.documentElement.scrollWidth,
                    h: doc.documentElement.scrollHeight
                }), d.show(d.bg.el, "block")
            },
            greyOut: function(a, b) {
                var c = jsui;
                c.bg.el || c.bg.init(a, b), c.size(c.bg.el, js.body()), c.show(c.bg.el, "block")
            },
            ungreyOut: function() {
                if (doc.byId("layerBkg")) {
                    var a = jsui;
                    a.removeDiv("layerBkg"), a.bg.el = null
                }
            }
        },
        removeDiv: function(a) {
            element = doc.byId(a), element.parentNode.removeChild(element)
        },
        setOpacity: function(a, b) {
            try {
                if (env.ie) {
                    a.style.opacity = b;
                    var b = "Alpha(Opacity=" + 100 * b + ")";
                    a.style.filter = b
                } else a.style.opacity = b
            } catch (c) {}
        },
        getStyle: function(a) {
            var b, c = doc.defaultView;
            return b = env.safari ? function(a) {
                var b = c.getComputedStyle(a, null);
                return !b && a.style && (a.style.display = "", b = c.getComputedStyle(a, null)), b || {}
            } : env.ie ? function(a) {
                return a.currentStyle
            } : function(a) {
                return c.getComputedStyle(a, null)
            }, (jsui.getStyle = b)(a)
        },
        showL: function(a, b) {
            return jsui.hide(jsui.curlyr), jsui.curlyr = a, jsui.b || (jsui.b = !0, jsevt.setHandlers([
                [js.body(), "click", site.bodyclick],
                [js.body(), "keyup", site.keyup]
            ])), jsui.show(a, b || "block")
        },
        hideL: function(a) {
            return a == jsui.curlyr && (jsui.curlyr = null), a && (a.style.display = "none"), a
        },
        hideCurLyr: function() {
            jsui.curlyr && (jsui.curlyr.style.display = "none"), jsui.curlyr = null
        },
        show: function(a, b) {
            return a ? (js.isStr(a) && (a = doc.byId(a)), a && (a.style.display = b), a) : null
        },
        showAll: function(a, b) {
            for (var c; c = a.pop();) jsui.show(c, b)
        },
        hide: function(a) {
            return a ? (a && (a.style.display = "none"), a) : null
        },
        styleByAttr: function(a, b, c, d, e) {
            for (var f = a[CHN], g = 0; g < f.length; g++) 1 == f[g].nodeType && f[g].getAttribute(b) == c && (f[g].style[d] = e)
        },
        showAt: function(a, b, c, d) {
            var e, f, g = js.pos.toCoords(b),
                h = js.pick(c, ["lb", "lt"]),
                i = js.pick(d, [0, 0]),
                j = js.pos.origin(a);
            switch (a[PN] == b ? g.x = g.y = 0 : (g.x -= j.x, g.y -= j.y), g.x += i[0], g.y += i[1], a.style.display = "block", h[0]) {
                case "lt":
                    e = g.x, f = g.y;
                    break;
                case "rb":
                    e = g.x + g.w, f = g.y + g.h;
                    break;
                case "rt":
                    e = g.x + g.w, f = g.y;
                    break;
                case "lb":
                default:
                    e = g.x, f = g.y + g.h
            }
            switch (h[1]) {
                case "rb":
                    e -= a[OW], f -= a[OH];
                    break;
                case "rt":
                    e -= a[OW];
                    break;
                case "lb":
                    f -= a[OH]
            }
            return jsui.showAtPt(a, {
                x: e,
                y: f
            })
        },
        showAtPt: function(a, b) {
            return isNaN(b.x) || (a.style.left = b.x + "px"), isNaN(b.x) || (a.style.top = b.y + "px"), a.pt = b, a
        },
        nodePosition: function(a, b, c) {
            if ("" != b || "" != c) {
                var d = js.win.size(),
                    e = js.win.scroll(),
                    f = a.style;
                return f.left = c || Math.max(e.x, (d.wd - a[OW]) / 2) + "px", f.top = b || Math.max(e.y, e.y + (d.ht - a[OH]) / 2) + "px", a
            }
            jsui.center(a)
        },
        center: function(a) {
            var b, c, d = js.win.size(),
                e = js.win.scroll(),
                f = a.style;
            return "fixed" == f.position ? (b = (d.wd - a[OW]) / 2 + "px", c = (d.ht - a[OH]) / 2 + "px") : (b = Math.max(e.x, (d.wd - a[OW]) / 2) + "px", c = Math.max(e.y, e.y + (d.ht - a[OH]) / 2) + "px"), f.left = b, f.top = c, a
        },
        grow: function(a, b) {
            a.style.height = a[OH] + b + "px", a.style.width = a[OW] + b + "px"
        },
        incBy: function(a, b) {
            isNaN(a[OH] + b.t) || a[OH] + b.t == 0 || (a.style.height = a[OH] + b.t + "px", a.style.width = a[OW] + b.l + "px")
        },
        offset: function(a, b) {
            var c = parseInt(a.style.top),
                d = parseInt(a.style.left);
            a.style.top = (isNaN(c) ? 0 : c) + b.t + "px", a.style.left = (isNaN(d) ? 0 : d) + b.l + "px"
        },
        shadow_resize: function(a, b) {
            var c = parseInt(a.style.width),
                d = parseInt(a.style.height);
            a.style.width = (isNaN(c) ? 0 : c) + b.w + "px", a.style.height = (isNaN(d) ? 0 : d) + b.h + "px"
        },
        size: function(a, b, c) {
            if (void 0 !== a) {
                var d = js.dom.isNode(b) ? js.pos.toCoords(b) : b,
                    e = a.style;
                c && !c.w || (e.width = d.w + "px"), c && !c.h || (e.height = d.h + "px")
            }
            return a
        },
        greyThis: function(a, b, c, d) {
            if (0 == c ? c = 0 : c || (c = .15), d || (d = "N"), a.bg || (env.ie ? (a.bg = jsui.makeIframe(!0), js.setTimeout(w, jsui.bg.ieifrfix, 100, a.bg, b, c)) : a.bg = F_CR("DIV", {
                    className: "N" == d ? "" : "shdw"
                }, {
                    position: "absolute",
                    backgroundColor: b || "#000",
                    zIndex: 1e3
                }), jsui.setOpacity(a.bg, c), F_APP(a.bg, a)), jsui.size(a.bg, a), "N" == d) {
                var e = a.bg.style;
                e.left = "-2px", e.top = "-2px"
            } else {
                var e = a.bg.style;
                e.left = "-5px", e.top = "-5px"
            }
            jsui.show(a.bg, "block")
        },
        ungreyThis: function(a) {
            a.bg && jsui.hide(a.bg)
        },
        dropShadow: function(a, b, c, d, e) {
            jsui.greyThis(a, c, d, e), a.bg.style.zIndex = "-1", env.ie && b && !b.skipIE ? jsui.incBy(a.bg, b || {
                l: 5,
                t: 5
            }) : jsui.offset(a.bg, b || {
                l: 3,
                t: 3
            })
        },
        toggleImgCheckBox: function(a) {
            var b = doc.byId(a);
            (" " + b.className + " ").indexOf(" checkBox ") > -1 ? b.className = "checkBoxClear" : b.className = "checkBox"
        },
        toggleImgCheckBoxClass: function(a) {
            $(a).hasClass("checkBoxClear") ? $(a).removeClass("checkBoxClear").addClass("checkBox") : $(a).hasClass("checkBox") && $(a).removeClass("checkBox").addClass("checkBoxClear")
        }
    },
    site = {
        bodyclick: function(a) {
            if (jsui.curlyr) {
                for (var b = a.target ? a.target : a.srcElement; null != b && b != js.body();) {
                    if (b == jsui.curlyr || b == jsui.bg.el) return;
                    b = b[PN]
                }
                jsui.curlyr.style.display = "none", $("#login").length > 0 && $("#login").removeClass("loginSel")
            }
        },
        keyup: function(evt) {
            evt.keyCode == env.keys.ESCAPE && ("undefined" != typeof cluster && cluster.hideCurLyr(), jsui.hideCurLyr(), $("#login").length > 0 && $("#login").removeClass("loginSel"), eval(pg.cf))
        },
        fixrc: function() {
            try {
                doc.all.rcfix.style.display = "block", doc.all.rcfix.style.display = "none"
            } catch (a) {}
        },
        fixLoadImg: function() {
            if (!w.domLoaded) {
                site._1 ? site._1 = 0 : site._1 = 1;
                try {
                    doc.all.pgldimg.style.bottom = site._1 + "px"
                } catch (a) {}
                window.setTimeout("site.fixLoadImg()", 100)
            }
        },
        hvrloop: function(a) {
            for (var b = 0; b < a[CHN].length; b++) {
                var c = a[CHN][b];
                1 == c.nodeType && (hf = c.getAttribute("iehf"), hf && (c._hf = hf, c.onmouseover = site.hover, c.onmouseout = site.hout), site.hvrloop(c))
            }
        },
        hover: function() {
            this.className += " " + this._hf + "hover"
        },
        hout: function() {
            this.className = this.className.replace(" " + this._hf + "hover", "")
        }
    };
7 == env.ieVer && window.setInterval("site.fixrc()", 100), env.ieVer < 7 && window.setTimeout("site.fixLoadImg()", 100);
var frmUtil = {
    getRadioElemsValue: function(a) {
        for (var b = 0; b < a.length; b++)
            if ("radio" == a[b].type && 1 == a[b].checked) return a[b].value
    },
    getFormData: function(a) {
        var b = [],
            c = js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "CTRL"]);
        for (var d in c) {
            var e = c[d];
            if (e && void 0 != e.type) {
                if (!e.name) continue;
                0 == e.disabled && (elName = e.name, elName && ("checkbox" == e.type ? e.checked && (b = this.populateFormElVal(e, b)) : "radio" == e.type ? e.checked && (b = this.populateFormElVal(e, b)) : b = this.populateFormElVal(e, b)))
            }
        }
        return b
    },
    populateFormElVal: function(a, b) {
        if (elName = a.name, null != elName.match(/\[\]/)) {
            elName = elName.replace(/\[\]/, "");
            var c = b[elName] ? b[elName].length : 0;
            "string" == typeof b[elName] && (b[elName] = new Array, c = 0), 0 == c && (b[elName] = new Array), b[elName][c] = a.value
        } else b[elName] = a.value;
        return b
    },
    addAutoComplete: function(a) {
        $("#" + a).find(".acoff").prop("autocomplete", "off")
    },
    refreshTabIndex: function(a) {
        var b, c = 0;
        $("#" + a).find(".frmEl").each(function() {
            b = $(this), b.is(":hidden") || b.prop("tabindex", ++c)
        })
    },
    blockkStickySubmit: function() {
        $(":submit").click(function(a) {
            if ((a.ctrlKey || a.shiftKey) && 1 == a.which) return !1
        })
    }
};
Array.contains = function(a, b) {
    for (var c = 0; c < a.length; c++)
        if (a[c] == b) return !0;
    return !1
}, Array.covertKeyCase = function(a, b) {
    for (var c = [], d = 0; d < a.length; d++) "LOWER" == b && (c[d.toLowerCase()] = a[d]), "UPPER" == b && (c[d.toUpperCase()] = a[d]), "TITLE" == b && (c[toTitleCase(d)] = a[d]);
    return c
}, Object.keys || (Object.keys = function() {
    "use strict";
    var a = Object.prototype.hasOwnProperty,
        b = !{
            toString: null
        }.propertyIsEnumerable("toString"),
        c = ["toString", "toLocaleString", "valueOf", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "constructor"],
        d = c.length;
    return function(e) {
        if ("function" != typeof e && ("object" != typeof e || null === e)) throw new TypeError("Object.keys called on non-object");
        var f, g, h = [];
        for (f in e) a.call(e, f) && h.push(f);
        if (b)
            for (g = 0; g < d; g++) a.call(e, c[g]) && h.push(c[g]);
        return h
    }
}()), isset(Object.reverse) || (Object.reverse = function(a) {
    var b, c = {};
    for (b in a) c[a[b]] = b;
    return c
}), Object.create || (Object.create = function() {
    function a() {}
    return function(b) {
        if (1 != arguments.length) throw new Error("Object.create implementation only accepts one parameter.");
        return a.prototype = b, new a
    }
}()), String.prototype.trim = function() {
    return this.replace(/^\s\s*/, "").replace(/\s\s*$/, "")
};
var valKeys = {
        integer: function(a) {
            var b = a.value.split("."),
                c = a.value;
            c = b[0];
            var d = /[^0-9]/g;
            return d.test(a.value) && (c = a.value.replace(d, "")), a.value != c && (a.value = c), a.value
        },
        numeric: function(a) {
            var b = /[^0-9.]/g;
            return b.test(a.value) && (a.value = a.value.replace(b, "")), a.value
        },
        toDecimal: function(a, b) {
            var c = 0,
                a = new String(a),
                d = a.replace(/\./g, function(a, b) {
                    return 0 == c++ ? "." : ""
                });
            return isNumber(d) ? (d = -1 != d.indexOf(".") ? parseFloat(d).toFixed(b) : d, d = -1 != d.indexOf(".") && d - parseInt(d) == 0 ? new String(Math.floor(d)) : d) : ""
        }
    },
    arr = {
        in_array: function(a, b) {
            for (var c in a)
                if (b == a[c]) return c;
            return !1
        },
        index_of: function(a, b) {
            for (var c = 0; c < a.length; c++)
                if (a[c] == b) return c;
            return -1
        },
        arr_diff: function(a, b) {
            for (var c = [], d = [], e = 0; e < a.length; e++) c[a[e]] = !0;
            for (m = 0; m < b.length; m++) c[b[m]] ? delete c[b[m]] : c[b[m]] = !0;
            for (n in c) d.push(n);
            return d
        },
        array_unique: function(a) {
            for (var b = [], c = a.length, d = 0; d < c; d++) {
                for (var e = d + 1; e < c; e++) a[d] === a[e] && (e = ++d);
                b.push(a[d])
            }
            return b
        },
        is_arr_obj: function(a) {
            return "array" == typeof a || "object" == typeof a
        },
        to_arr: function(a) {
            return arr.is_arr_obj(a) ? a : [a]
        },
        toObject: function(a) {
            var b = {};
            for (key in a) b[key] = a[key];
            return b
        },
        merge_objects: function(a, b) {
            var c = {};
            for (var d in a) c[d] = a[d];
            for (var d in b) c[d] = b[d];
            return c
        },
        objectToArr: function(a) {
            var b, c = new Array;
            for (b in a) c.push(a[b]);
            return c
        },
        remove: function(a, b) {
            var c = arr.index_of(a, b);
            return -1 !== c && a.splice(c, 1), a
        }
    },
    layers = {
        sizeShadow: function(a) {
            a || (a = this), jsui.size(a.bg, a);
            try {
                env.ie || jsui.shadow_resize(a.bg, {
                    w: 6,
                    h: 6
                })
            } catch (b) {}
            env.ie && jsui.incBy(a.bg, {
                l: 5,
                t: 5
            })
        },
        fixShadows: function() {
            if (jsui.curlyr) try {
                layers.sizeShadow(jsui.curlyr)
            } catch (a) {}
            if (pg.curMLyr) try {
                layers.sizeShadow(pg.curMLyr)
            } catch (a) {}
        }
    };
layers.doRegister = function(a, b) {
    if (jsval.vf(b)) {
        var c = b.name;
        if (c && void 0 != c) {
            var d = new Object;
            b.username && (d.username = b.username.value), b.password && (d.password = b.password.value), b.mobileno && (d.mobileno = b.mobileno.value), doc[ELBI]("loadingImage" + c) && (doc[ELBI]("loadingImage" + c)[IH] = "<img src=" + IMG_BASE_URL + "/images/99loaderDesktop.gif>")
        }
        return "shortlistReg" != c || (d.src = "register_login", ajax.postForm({
            url: "",
            params: d,
            thisfrm: b
        }, layers.postRegisterLogin), jsevt.stopEvt(a))
    }
    return jsval.inlineErrs(b), jsevt.stopEvt(a)
}, layers.postRegisterLogin = function(a) {
    "undefined" != $("#loginregisterlayer") && ($("#loginregisterlayer").find(".body").html(""), $("#loginregisterlayer").find(".body").html(a)), $("#sl_login").length <= 0 && (window.location = "")
}, layers.doLogin = function(a, b) {
    if (jsval.vf(b)) {
        var c = b.name;
        if (c && void 0 != c) {
            var d = new Object;
            b.username && (d.username = b.username.value), b.password && (d.password = b.password.value), doc[ELBI]("loadingImage" + c) && (doc[ELBI]("loadingImage" + c)[IH] = "<img src=" + IMG_BASE_URL + ">")
        }
        if ("sendEmailLoginForm" == c) {
            var e = doc.byId("sendLayer");
            e.target = b.target.value, ajax.postForm({
                url: "",
                ctx: e,
                thisfrm: b
            }, alerts.postLogin, hdr.onRcvLyrErr)
        } else if ("signInForm" == c) {
            var f = pg["l-login"];
            f.actionOnSuccess = f.action, level1 = doc.byId("level1").value, ajax.getText({
                url: "" + level1,
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else if ("signInFromHeader" == c) toglTxtOnBtn("Logging In...", "submit_query1"), ajax.getText({
            url: "",
            ctx: f,
            params: d
        }, layers.onRcvLogin);
        else if ("ViewPhoneNumber" == c) {
            var f = pg["l-viewphno"];
            f.actionOnSuccess = f.action, ajax.getText({
                url: "",
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else if ("signInBOSForm" == c) {
            var f = pg["l-loginbos"];
            f.actionOnSuccess = f.action, ajax.getText({
                url: "",
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else {
            if ("forgotpwd" != c && "forgotpwdfromHeader" != c) return !0;
            d.identifier = b.identifier.value, "forgotpwd" == c && ajax.getText({
                url: "",
                ctx: b,
                params: d
            }, pg.onRcv_data, pg.onRcvErr), "forgotpwdfromHeader" == c && (toglTxtOnBtn("Retrieving...", "submit_query1"), ajax.getText({
                url: "",
                ctx: b,
                params: d
            }, layers.onRcv_dataonHeader))
        }
        return jsevt.stopEvt(a)
    }
    return jsval.inlineErrs(b), jsevt.stopEvt(a)
}, layers.onLogin = function(a) {
    var b = a.user.class;
    if (shortlist.syncAsset(), "U" == b) {
        if (window.location.href.indexOf("advertiseproperty") > -1) location.reload();
        else if ($("#registration_layer").html("You have successfully logged in!"), lhdr.updateHdr(a.user.name, b), $("#sl_login").length > 0) return void location.reload()
    } else if (0 != $("#boostListingPage").length) {
        var c = getCookie("PROPLOGIN");
        if ($.isEmptyObject(c)) window.location.reload(!1);
        else {
            var d = $.isEmptyObject(a) ? "" : a.validationData.PROFILEID;
            if ($("#boostListingProfileId").val() != d || $.isEmptyObject(boostListing)) {
                try {
                    _gaq.push(["_trackEvent", "SRP_BOOST", "SRP_BOOST_LOGIN_FAILURE", boostListing.profileId, parseInt(boostListing.profileId)])
                } catch (f) {
                    console.log(f)
                }
                var e = window.location;
                window.location.href = e.protocol + "//" + e.host + "/"
            } else pg.closeModalLayer(), $("#" + boostListing.id).click(), trackEventByGA("SRP_BOOST_LOGIN_SUCCESS", !1, boostListing.profileId, "SRP_BOOST")
        }
    } else if (arr.in_array(["O", "A", "B", "Z"], b)) return pg.closeModalLayer(), arr.in_array(["O", "A", "B"], b) ? window.location = "" : "Z" == b && (window.location = ""), !1
}, layers.onRcv_dataonHeader = function(a) {
    var b = doc.byId("loginLayer");
    return b.style.width = "300px", b[IH] = a, jsevt.stopEvt(evt)
}, layers.onRcvLogin = function(a) {
    var b = doc.byId("loginLayer");
    if (b.style.width = "300px", -1 == a.indexOf("@@")) return "undefined" != b ? (doc.byId("lgndiv")[IH] = a, jsevt.stopEvt(event)) : jsevt.stopEvt(event);
    var c = a.split("@@"),
        d = c[2];
    if (hdr.hideLoggedOutDiv(), $("#sl_login").length > 0) {
        var e = c[1];
        return trackClickAction("LOGIN", e, "SHORTLISTBUBBLE", document.URL), pg.closeModalLayer(), void shortlist.redirectToViewShortlist(e)
    }
    if ("U" == d)
        if (window.location.href.indexOf("advertiseproperty") > -1) location.reload();
        else {
            var a = "You have successfully logged in!";
            b[IH] = a, lhdr.updateHdr(c[0], d)
        }
    else if (arr.in_array(["O", "A", "B", "Z"], d)) {
        if (void 0 == c[6]) return pg.closeModalLayer(), arr.in_array(["O", "A", "B"], d) ? window.location = "" : "Z" == d && (window.location = ""), jsevt.stopEvt(event);
        var a = c[5];
        b[IH] = a
    }
}, layers.onRcvLoginErr = function(a) {
    return !0
};
var slowly = {
        opacity: 99,
        fadein: function(a) {
            this.fadeLoop(a, this.opacity)
        },
        fadeLoop: function(a, b) {
            var c = doc.byId(a);
            b >= 5 ? (slowly.setOpacity(c, b), b -= 4, window.setTimeout("slowly.fadeLoop('" + a + "', " + b + ")", 150)) : c && (c.style.display = "none")
        },
        setOpacity: function(a, b) {
            a && (a.style.filter = "alpha(style=0,opacity:" + b + ")", a.style.KHTMLOpacity = b / 100, a.style.opacity = b / 100)
        }
    },
    pg = {
        userAuth: 0,
        cf: "pg.closeModalLayer()",
        validate: function(a, b, c, d) {
            return jsval.vf(b) ? (b.target && !c && (jsui.hideCurLyr(), pg.closeModalLayer()), !0) : (jsval.inlineErrs(b, pg.esdiv, d), jsevt.stopEvt(a))
        },
        setUpLayer: function(a) {
            $(".body").find("#modifyBtnId").length > 0 && $(".body").find("div[id*='identity_help']").remove();
            var b = a ? js.dom.findAll(a, ["SCRIPT"]) : pg.curMLyr[ELBT]("SCRIPT");
            for (var c in b)
                if (window.eval(b[c][IH]), !empty(b[c].src)) {
                    var d = doc.createElement("script");
                    d.type = "text/javascript", d.src = b[c].src, doc[ELBT]("head")[0].appendChild(d)
                }
        },
        resetDD: function() {
            var a = doc[ELBT]("select");
            for (var b in a) a[b].size = 1
        },
        openModalLayer: function(a, b, c, d, e) {
            if (void 0 !== c && "" != c || (c = !1), void 0 === e && (e = "lyrmodal fontTerbo"), c && (pg.prevMLyr = pg.curMLyr), "1" == pg.userAuth) {
                userAuthentication();
                if ("1" == doc.byId("userAuth").value) return window.location = "/property/login.php", !1
            }
            var f = "-36px -36px "; - 1 != a.id.indexOf("feedback_ajax") && (f = "-20px -20px "), dontCheckIdle();
            try {
                var g = pg["l-" + a.id];
                if (!g || captchaFactory.captchaStatus) {
                    captchaFactory.captchaStatus && (captchaFactory.captchaStatus = !1);
                    var h, i = "absolute";
                    "fixed" == a.position && (i = a.position), "noDefHead" == b ? (g = pg["l-" + a.id] = js.dom.add(F_CR("DIV", {
                        className: e
                    }, {
                        position: i,
                        border: "0px",
                        zIndex: 999999
                    })), "HOMEPAGE" == d ? h = "<img id='srpmodalCloseCrossBtn' class='floatr cpointer lyr_close' onclick='" + (a.cf ? a.cf : "pg.closeModalLayer();") + "' src='/images/i0.gif' style='position:absolute;z-index:11010;top:-232px;right:4px;'/>" : (h = "<div class='ttl' id='title-" + a.id + "'>", "undefined" == typeof noCross && (h += "<img id='srpmodalCloseCrossBtn' class='floatr cpointer lyr_close crossButton_lyr' onclick='" + (a.cf ? a.cf : "pg.closeModalLayer();") + "' src='/images/i0.gif' style='margin:" + f + " 0 0;'/>"), h += a.ttl + "</div>"), h += "<div class='body' id='body-" + a.id + "'  style='background-color:#fff;z-index:10;zoom:1;height: auto;'></div>", g[IH] = h) : (g = pg["l-" + a.id] = js.dom.add(F_CR("DIV", {
                        className: "lyrmodal fontTerbo"
                    }, {
                        position: "absolute",
                        zIndex: 999999
                    })), h = "<div class='ttl'>", "undefined" == typeof noCross && (h += "<img id='srpmodalCloseCrossBtn' class='floatr cpointer lyr_close' onclick='" + (a.cf ? a.cf : "pg.closeModalLayer()") + "' src='/images/i0.gif' style='margin:" + f + " 0 0;'/>"), h += a.ttl + "</div><div class='body' style='background-color:#fff;z-index:10;zoom:1;height: auto;'></div>", g[IH] = h), a.html && (g[CHN][1][IH] = a.html)
                }
                a.ttl_reload && (g[IH] = "<div class='ttl'><img id='srpmodalCloseCrossBtn' class='floatr cpointer lyr_close crossButton_lyr' onclick='" + (a.cf ? a.cf : "pg.closeModalLayer()") + "' src='/images/i0.gif' style='margin:" + f + " 0 0;'/>" + a.ttl + "</div><div class='body' style='background-color:#fff;z-index:10;zoom:1;height: auto;'></div>");
                var j = a.size ? a.size : {};
                return j.h ? "auto" != j.h && (j.h += "px") : j.h = "250", j.w ? "auto" != j.w && (j.w += "px") : j.w = "400", g.style.width = j.w, "undefined" == j.hc || empty(j.hc) || (g.style.height = j.hc + "px"), g[CHN][1].style.height = j.h, g.size = a.size, g.cbk = a.cbk, g.id = a.id, g.overlay = a.overlay, pg.cf = a.cf ? a.cf : "pg.closeModalLayer()", jsui.hideCurLyr(), c || pg.closeModalLayer(), a.closeOnEscape ? jsui.center(jsui.showL(g, "block")) : jsui.center(jsui.show(g, "block")), "noDefHead" != b || env.ie && env.ieVer <= 6 && ("greyDim" == a.bkg ? jsui.bg.greyOutDim(0) : "hide" != a.bkg && jsui.bg.greyOut(0)), a.eslyr && (pg.esdivmodal = g), pg.curMLyr = g, "true" == a.setDD && pg.resetDD(), !g.gotData || a.reload ? (g[CHN][1][IH] = a.html ? a.html : LOADING_HTML, a.dataUrl && ajax.getText({
                        url: a.dataUrl,
                        ctx: g,
                        params: a.params ? a.params : userActionParams
                    }, pg.onRcv, pg.onRcvErr)) : (a.size && a.size.h1 && (g[CHN][1].style.height = a.size.h1), g.style.width = "auto"), g.action = a.action, g.noHead = b, void 0 === a.pgid && (a.pgid = null), "HOMEPAGE" == d && jsui.bg.greyOut(.75, "black"),
                    ("undefined" != typeof currentPageName && "Property Description" == currentPageName || "greyOut" == a.bkg || null != a.bkgOpac && null != a.bkgColour) && (c ? (pg.prevMLyr.style.zIndex = "999997", g.style.zIndex = "999999", null != a.bkgOpac && null != a.bkgColour ? jsui.bg.greyOut(a.bkgOpac, a.bkgColour) : jsui.bg.greyOut(.75, "white")) : null != a.bkgOpac && null != a.bkgColour ? (pg.curMLyr.style.zIndex = "999999", jsui.bg.greyOut(a.bkgOpac, a.bkgColour)) : (pg.curMLyr.style.zIndex = "999999", jsui.bg.greyOut(.75, "white"))), "noDefHead" != b && jsui.size(g.bg, g), g
            } catch (k) {}
        },
        onRcv: function(txt) {
            try {
                var l = this;
                if (l.gotData = !0, void 0 != l.actionOnSuccess) {
                    var actionName = l.actionOnSuccess,
                        functionName = actionName + '("' + escape(txt) + '")';
                    eval(functionName), l.actionOnSuccess = null
                } else if (void 0 == l.actionOnSuccess) {
                    try {
                        try {
                            if (txt = eval("(" + txt + ")"), txt.showCaptcha) {
                                l[CHN][1][IH] = "";
                                var captchaKey = txt.captchaKey,
                                    ctx = l[CHN][1];
                                "true" == txt.captchaType ? (captchaFactory.url = "", captchaFactory.showNoCaptcha(ctx, captchaKey)) : (captchaFactory.url = "", captchaFactory.showCaptcha(ctx, captchaKey)), l.style.width = "auto"
                            }
                        } catch (err) {
                            l[CHN][1][IH] = txt, l.size && l.size.h1 && (l[CHN][1].style.height = l.size.h1)
                        }
                    } catch (er) {
                        l[IH] = txt, l.size && l.size.h1 && (l.style.height = l.size.h1)
                    }
                    if (l.style.minWidth = "265px", l.size && l.size.h1 && (l[CHN][1].style.height = l.size.h1), "noDefHead" != l.noHead && jsui.size(l.bg, l), "noDefHead" != l.noHead) {
                        var totalHeightOfLayer = l.offsetTop + l.offsetHeight,
                            layerSibling = l.nextSibling,
                            siblingHeight = layerSibling.offsetHeight;
                        totalHeightOfLayer > siblingHeight && (layerSibling.style.height = totalHeightOfLayer + "px"), adjustLayerSize(l)
                    }($("#my99Page").length > 0 || $("#SRP-listing").length > 0) && $(".dev_subscptnDrpDwn").length > 0 && boostListing.intializeBoostLayer(), $("#boostWorkFlow").length && boostWorkFlow.saveSubscription(), jsui.center(l)
                }
            } catch (e) {}
            try {
                l.cbk && l.cbk.call(l)
            } catch (ex) {}
        },
        onRcv_data: function(a) {
            try {
                var b = this;
                b = b[PN], b.gotData = !0, void 0 == b.actionOnSuccess && (b[IH] = a, b.size && b.size.h1 && (b[CHN][1].style.height = b.size.h1), "noDefHead" != b.noHead && jsui.size(b.bg, b), adjustLayerSize(b)), b.cbk && b.cbk.call(b)
            } catch (c) {}
        },
        onRcvErr: function(a, b) {
            if (null != this[CHN] || void 0 != this[CHN]) {

                this[CHN][1][IH] = b || "Error Occured. Try Again.";
                adjustLayerSize(this)
            }
        },
        adjustLayerHeight: function() {
            l = pg.curMLyr, l.size && l.size.h1 && (l[CHN][1].style.height = l.size.h1), jsui.size(l.bg, l)
        },
        closeModalLayer: function() {
            if (($("#my99Page").length > 0 || $("#SRP-listing").length > 0) && $(".dev_boostLayer").length > 0 && $(".dev_boostLayer").remove(), js.body().onkeyup = null, null != doc.byId("gstpendinglayer") && "Pending Payment" == currentPageName) {
                var a = "GSTIN" + document.getElementsByName("PROFILEID")[0].value,
                    b = document.getElementsByName("PROFILEID")[0].value,
                    c = new Date;
                c.setTime(c.getTime() + 15552e7);
                var d = "; expires=" + c.toUTCString();
                document.cookie = a + "=" + b + d + "; path = /", $("#gstpendinglayer").remove()
            }
            void 0 != doc.byId("section_location") && mapInteraction.removeErrorOnButton(), void 0 != doc.byId("sl_ty_lyr") && shortlist.closeThankYouLayerAction(), void 0 != doc.byId("xid_img_size") && (doc.byId("xid_img_size").src = "about:blank"), void 0 != doc.byId("show_video") && (doc.byId("show_video").src = "about:blank"), $("#repSpamPg").length && $("#repSpamPg").remove(), pg.curMLyr && (jsui.bg.ungreyOut(), "undefined" != typeof cluster && cluster.enableAll(), jsui.hide(pg.curMLyr)), void 0 !== pg.prevMLyr && (pg.curMLyr = pg.prevMLyr, pg.prevMLyr = null, jsui.bg.ungreyOut()), void 0 !== layerCloseOnClickBody && layerCloseOnClickBody.forceCloseLayers()
        },
        closeSideModalLayer: function() {
            pg.curMinMaxLyr && jsui.hide(pg.curMinMaxLyr)
        },
        minimizeModalLayer: function() {
            if (pg.curMinMaxLyr) {
                pg.curMinMaxLyr[CHN][1].style.display = "none", doc.byId("minButton").style.display = "none", doc.byId("maxButton").style.display = "inline"
            }
        },
        maximizeModalLayer: function() {
            if (pg.curMinMaxLyr) {
                pg.curMinMaxLyr[CHN][1].style.display = "block", doc.byId("minButton").style.display = "block", doc.byId("maxButton").style.display = "none"
            }
        }
    };
AIM = {
    frame: function(a) {
        var b = "f" + Math.floor(99999 * Math.random()),
            c = doc.createElement("DIV");
        c[IH] = '<iframe style="display:none" src="about:blank" id="' + b + '" name="' + b + '" onload="AIM.loaded(\'' + b + "')\"></iframe>", doc.body.appendChild(c);
        var d = doc.byId(b);
        return a && "function" == typeof a.onComplete && (d.onComplete = a.onComplete), b
    },
    form: function(a, b) {
        a.setAttribute("target", b)
    },
    submit: function(a, b) {
        return AIM.form(a, AIM.frame(b)), !b || "function" != typeof b.onStart || b.onStart(a)
    },
    loaded: function(a) {
        var b = doc.byId(a);
        if (b.contentDocument) var c = b.contentDocument;
        else if (b.contentWindow) var c = b.contentWindow.document;
        else var c = window.frames[a].document;
        "about:blank" != c.location.href && "function" == typeof b.onComplete && b.onComplete(c.body[IH])
    }
}, area_conversion = function(a, b, c) {
    var d = createAreaArr();
    if (1 == c) {
        if (a < 20 && 18 != a) {
            return b / d[a]
        }
        return 0
    }
    if (2 == c) {
        if (a < 20 && 18 != a) {
            return b * d[a]
        }
        return 0
    }
}, area_conversion_all = function(a, b, c) {
    var d = createAreaArr(),
        e = d.length;
    if (18 != a && 18 != c && a >= 1 && a <= e && c >= 1 && c <= e) {
        return b / d[a] * d[c]
    }
    return 0
}, setStorageValue = function(a, b, c) {
    null != localStorage && "undefined" != typeof localStorage && "unknown" != typeof localStorage ? localStorage.setItem(a, b) : null != sessionStorage && "undefined" != typeof sessionStorage ? sessionStorage.setItem(a, b) : setCookieExp(a, b, c)
}, getStorageValue = function(a) {
    if (null != localStorage && "undefined" != typeof localStorage && "unknown" != typeof localStorage) var b = localStorage.getItem(a) ? localStorage.getItem(a) : "";
    else if (null != sessionStorage && "undefined" != typeof sessionStorage) var b = sessionStorage.getItem(a) ? sessionStorage.getItem(a) : "";
    else var b = getCookieVal(a);
    return b
};
var checkIdleFlag = !0,
    isIdle = !0,
    idleCount = 1,
    showPopup = !1,
    contextMenuObj = {
        ulObj: null,
        createMenu: function(a) {
            this.ulObj = $("<ul class='" + a.ClassValue + "' id='" + a.IDValue + "' > </ul>"), $("body").append(this.ulObj)
        },
        addMenuItem: function(a) {
            this.ulObj.append("<li id='" + a.IDValue + "'>" + a.LableValue + "</li>")
        },
        addMultipleMenuItems: function(a) {
            var b = 0;
            for (b = 0; b < a.length; b++) this.addMenuItem(a[b])
        }
    },
    inputParams = {
        params: {},
        getParams: {},
        cookieParams: {},
        buildGetParams: function() {
            for (var a, b = {}, c = /\+/g, d = /([^&=]+)=?([^&]*)/g, e = function(a) {
                    return decodeURIComponent(a.replace(c, " "))
                }, f = window.location.search.substring(1); a = d.exec(f);) b[e(a[1])] = e(a[2]);
            return this.getParams = b, b
        },
        buildCookieParams: function() {
            var a, b, c, d = {},
                e = doc.cookie.split(";");
            for (a = 0; a < e.length; a++) b = e[a].substr(0, e[a].indexOf("=")).trim(), c = e[a].substr(e[a].indexOf("=") + 1), d[b] = unescape(c);
            return this.cookieParams = d, d
        },
        buildParams: function() {
            var a = {},
                b = this.buildGetParams(),
                c = this.buildCookieParams();
            return a = arr.merge_objects(c, b), this.params = a, a
        }
    };
inputParams.buildParams(), $(document).ready(function() {
    function a() {
        var a, b = navigator.userAgent,
            c = b.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        return /trident/i.test(c[1]) ? (a = /\brv[ :]+(\d+)/g.exec(b) || [], {
            name: "IE ",
            version: a[1] || ""
        }) : "Chrome" === c[1] && null != (a = b.match(/\bOPR\/(\d+)/)) ? {
            name: "Opera",
            version: a[1]
        } : (c = c[2] ? [c[1], c[2]] : [navigator.appName, navigator.appVersion, "-?"], null != (a = b.match(/version\/(\d+)/i)) && c.splice(1, 1, a[1]), {
            name: c[0],
            version: c[1]
        })
    }
    if (document.getElementById("jslogPath")) {
        var b = document.getElementById("jslogPath").value,
            c = [];
        window.onunload = function() {
            if (c.length > 0) {
                var a = new Image;
                a.src = b + "?data=" + encodeURIComponent(JSON.stringify(c)) + "&count=" + c.length, console.log(a.src)
            }
        }, window.onerror = function(d, e, f, g, h) {
            if (e) {
                var i = a(),
                    j = i.name + " " + i.version,
                    k = window.location.href,
                    l = "[" + (new Date).toString() + "] [JS Error]";
                l += d ? " " + d + " ~ " : "", l += f ? "error on line " + f : "", l += e ? " in " + e + "\n" : "", l += h ? " #Stack: " + h.stack + "\n" : "", l += k ? " #Page: " + k + "\n" : "", l += j ? " #Browser Info: " + j + "\n" : "", l += "#User Agent: " + navigator.userAgent + "\n";
                var m, n = 0,
                    o = 0;
                for (m in c) c.hasOwnProperty(m) && (o += c[m].length, n++);
                if (o + l.length > 2e3) {
                    var p = new Image;
                    p.src = b + "?data=" + encodeURIComponent(JSON.stringify(c)) + "&count=" + c.length, c = [], n = 0, console.log(p.src)
                }
                c[n] = l
            }
        }
    }
});
var check = {
        srchArea: function(a, b, c) {
            var d, e = a;
            return a = valKeys.numeric(b), c && "blur" == c.type && (parseInt(a) > 0 && (a = a.replace(/^0*/, "")), a && (d = a.split("."), d.length > 1 && (a = d.slice(0, 1) + "." + d.slice(1).join("")))), e != a && (b.value = a), !0
        },
        mobile: function(a, b) {
            if ("" == a && ("required" != b.getAttribute("required") || "mobileId" != b.id)) return !0;
            a = valKeys.integer(b);
            var c = $("#INTL_MOB_LENGTH").val();
            "" != c && void 0 != c || (c = 7);
            var d = $(b).parents("._CCSiblingDiv").siblings(".custSeldd");
            0 == d.length && (d = $(b).siblings(".custSeldd")), 0 == d.length && (d = $(b).parents(".disTable").siblings(".custSeldd")), 0 == d.length && (d = $(b).parents(".microCCFix").find(".custSeldd")), 0 == d.length && (d = $(b).parents(".IntrntionlPhn").find(".custSeldd")), 0 == d.length && (d = $(b).parent().siblings("._CCParentDiv").find(".custSeldd")), 0 == d.length && (d = $(b).parents("._ccParentSibling").siblings("._ccParent").find("select")), 0 == d.length && (d = $(b).siblings("#customerPropertyCityId")), 0 == d.length && (d = $(b).siblings("#customerPropertyCityIdPseudo")), "91" != $(d).find("#customerPropertyCityId").val() && "91" != $(d).find("#customerPropertyCityIdPseudo").val() && "91" != $(d).val() || (a = "+91" + a);
            var e = /^(\+91[1-9][0-9]{0,8}|\+91[1-9][0-9]{10,}|0091[1-9][0-9]{0,8}|0091[1-9][0-9]{10,}|\+910[0-9]{0,}|00910[0-9]{0,})$/;
            return mobregexStr = "^(91[1-9][0-9]{9}|91-[1-9][0-9]{9,13}|0091[1-9][0-9]{9,13}|0091-[1-9][0-9]{9,13}|\\+91[1-9][0-9]{9,13}|\\+91-[1-9][0-9]{9,13}|[1-9][0-9]{" + (c - 1) + ",13}|0[1-9][0-9]{" + (c - 1) + ",13}|00[1-9][0-9]{10,13}|\\+[1-9][0-9]{10,13})$", mobregex = new RegExp(mobregexStr), a.length > 16 || a.length < c ? 1002 : e.test(a) ? 1002 : !!mobregex.test(a) || 1002
        },
        mobileVal: function(a, b) {
            var c = /[oO]/gm;
            a = a.replace(/[^\da-zA-Z]/gm, "").replace(c, "0");
            var d = /[\d]{6,}/gm,
                e = "srvrval",
                f = a.match(d),
                g = "" + f;
            return null == f ? b.removeAttribute(e) : SA(b, e, g), !0
        },
        phoneNumValidation: function(a, b) {
            var c = /[?<=\\d) +(?=\\d]/g;
            a = a.replace(c, "");
            var d = /(?:\s+|)((0|(?:(\+|)91))(?:\s|-)*(?:(?:\d(?:\s|-)*\d{9})|(?:\d{2}(?:\s|-)*\d{8})|(?:\d{3}(?:\s|-)*\d{7}))|\d{10})(?:\s+|)/gm,
                e = "srvrval",
                f = a.match(d),
                g = "" + f;
            return null == f ? b.removeAttribute(e) : SA(b, e, g), !0
        },
        phone: function(a) {
            var b = /^0[1-8][0-9]{9}$/,
                c = /^0[1-8][1-9]{1,4}-[0-9]{5,8}$/;
            return !(11 != a.length || !b.test(a)) || (!(12 != a.length || !c.test(a)) || 1002)
        },
        email: function(a, b) {
            if ("mailId" == b.id && "" == a && "required" != b.getAttribute("required")) return !0;
            var c = /^[-_.a-z0-9]+@(([-_a-z0-9]+\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|asia|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mobi|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i;
            return a.length > 50 ? 2550 : a.length < 8 ? 2008 : !!c.test(a) || 1001
        },
        multipleemail: function(a) {
            for (var b = /^[-_.a-z0-9]+@(([-_a-z0-9]+\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|asia|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mobi|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i, c = a.split(","), d = c.length, e = 0, f = 0; f < d; f++) {
                if (c[f] = c[f].replace(/^\s*/, "").replace(/\s*$/, ""), c[f].length > 50) return 2550;
                if (c[f].length < 8) return 2008;
                if (!b.test(c[f])) return 1001;
                e++
            }
            if (e == d) return !0
        },
        phmob: function(a, b) {
            var c = check.mobile(a, b),
                d = check.phone(a);
            return !0 === c || !0 === d || (!0 !== c ? c : d)
        },
        pincode: function(a) {
            var b = /^[0-9]*$/;
            return a.length > 6 ? 2506 : a.length < 6 ? 2006 : !!b.test(a) || 1005
        },
        budget_minmax: function(a) {},
        my99_budget_minmax: function(a) {},
        minmax: function(a) {
            if (!a.mif) {
                var b = a.grp.flds,
                    c = jsval.find;
                a.mif = c(b, "name", GA(a, "minfld")), a.maf = c(b, "name", GA(a, "maxfld"))
            }
            var d = [],
                e = a.mif,
                f = a.maf,
                g = a.ff,
                h = e.value == GA(e, "defVal"),
                i = f.value == GA(f, "defVal");
            return h || i ? [] : (parseFloat(e.value) > parseFloat(f.value) && d.push({
                el: g,
                err: jsval.getInvalidMsg(a, 1010),
                code: 1010
            }), d)
        },
        details: function(a, b) {
            return a || -1 == $("#reasonId").val().indexOf("8") ? (jsval.clearerr(b), !0) : "Please let us know some details of the problem above."
        },
        reason: function(a) {
            return "" == $("#reasonId").val() ? "Please select at-least one problem type before submitting." : (jsval.clearerr(a), !0)
        },
        min_area: function(a, b, c) {
            if (!a) return !0;
            var a = valKeys.numeric(b);
            if (a >= se.minMax[GA(b, "name")].maxInteger + 1) return 2550;
            var d = doc.byId("area_max_id"),
                e = GA(d, "name").toUpperCase();
            e += "_ISVALID";
            var f = {
                el: d,
                err: se.errArr[e],
                code: e
            };
            return parseFloat(a) > parseFloat(d.value.replace(/[^0-9.]/g, "")) ? jsval.seterr(d, f) : jsval.clearerr(d), !0
        },
        max_area: function(a, b, c) {
            if (!a) return !0;
            var a = valKeys.numeric(b);
            if (a >= se.minMax[GA(b, "name")].maxInteger + 1) return 2550;
            var d = parseFloat(doc.byId("area_min_id").value.replace(/[^0-9.]/g, ""));
            return !("" != d && d > 0) || valKeys.toDecimal(parseFloat(a), 2) >= d
        },
        cstm_input_min_budget: function(a, b, c) {
            return valKeys.numeric(b), !0
        },
        cstm_input_max_budget: function(a, b, c) {
            return valKeys.numeric(b), !0
        },
        cstmValidateMe: function(a) {
            var b = doc.byId(a);
            b && b.validateMe(null, b)
        },
        min_budget: function(a, b, c) {
            var d, e = b.id.replace("min", "max"),
                f = doc.byId(e);
            if (b.id.indexOf("buy") > 0) var d = "buy";
            else var d = "rent";
            var g = GA(f, "name").toUpperCase();
            g += "_ISVALID";
            var h = {
                el: f,
                err: se.errArr[g],
                code: g
            };
            return ret = formUI.onSubmitValidateBudget(d), ret ? jsval.clearerr(f) : jsval.seterr(f, h), !0
        },
        max_budget: function(a, b, c) {
            var d, e = doc.byId("budgetgrp");
            if (b.id.indexOf("buy") > 0) var d = "buy";
            else var d = "rent";
            var f = formUI.onSubmitValidateBudget(d);
            return f && jsval.clearerr(e), f
        },
        dummy: {}
    },
    jsval = {
        ajxVlds: [],
        init: function() {
            for (var a = js.body()[ELBT]("FORM"), b = 0; b < a.length; b++) "sendemailsms_pseudoListing" != $(a[b]).attr("name") && (jsval.setupFrm(a[b]), a[b].onsubmit || jsevt.addListener(a[b], "submit", jsval.onFrm, a[b]), a[b].setAttribute("novalidate", "true"))
        },
        onFrm: function(a, b) {
            if (!jsval.vf(b)) return jsval.inlineErrs(b), jsevt.stopEvt(a)
        },
        setupFrm: function(a, b) {
            if ((!0 === b || GA(a, "errdisplay")) && !a.inited) {
                for (var c = js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "CTRL", "CUSTOM"]), d = 0; d < c.length; d++) {
                    if (!c[d]) return !0;
                    var e = c[d],
                        f = GA(e, "group");
                    f ? jsval.setupGrp(e, a.name + "." + f, c) : jsval.setupFld(c[d])
                }
                return a.inited = !0, c
            }
        },
        setupFld: function(a) {
            if (!a.vfn) {
                a.vfn = a.validateMe = jsval.vfld, jsevt.setHandlers([
                    [a, "change", jsval.vfld, a],
                    [a, "keyup", jsval.onkeyup, a],
                    [a, "blur", jsval.vfld, a],
                    [a, "focus", jsval.onfocus, a]
                ]);
                try {
                    a.ff = doc.byId(GA(a, "focus"))
                } catch (e) {}
                if ("true" == GA(a, "custom") && "" != a.value)
                    for (var b = a.value.split(","), c = 0; c < b.length; c++) {
                        var d = doc.byId(b[c]);
                        d && jsevt.setHandlers([
                            [d, "change", jsval.vfld, a],
                            [d, "keyup", jsval.onkeyup, a],
                            [d, "blur", jsval.vfld, a]
                        ])
                    }
            }
        },
        setupGrp: function(a, b, c) {
            if (jsval.setupFld(a), a.grp)
                for (var d in a.grp.flds)
                    if (GA(a, "group") == GA(a.grp.flds[d], "group")) return !0;
            if (a.grp = jsval["GRP." + b] || (jsval["GRP." + b] = {
                    flds: [],
                    rng: b,
                    ctrls: []
                }), a.validateMe = jsval.vgrp, "CTRL" == a.tagName) {
                var e = a.grp,
                    f = jsval.find;
                e.ctrls.push(a), a.ff = f(c, "name", GA(a, "focus")) || doc.byId(GA(a, "focus")), a.vfn = a.validateMe = jsval.vctrl
            } else a.vfn = a.validateMe = jsval.vfld, a.grp.flds.push(a), jsevt.setHandlers([
                [a, "change", jsval.vgrp, a],
                [a, "keyup", jsval.onkeyup, a],
                [a, "blur", jsval.vgrp, a]
            ])
        },
        fillForm: function(dataArr, errArr, id, cbk) {
            var layer = doc.byId(id),
                els = js.dom.findAll(layer, ["INPUT", "SELECT", "TEXTAREA"]);
            if (null == dataArr || 0 == dataArr) return !0;
            for (var j = 0; j < els.length; j++) {
                var el = els[j],
                    elName = el.name.toLowerCase(),
                    v = dataArr[elName];
                if (!el[D]) {
                    if ("prop_name" != elName || "" != v && !empty(v) || (v = "Property does not belong to a society / project"), "checkbox" == el.type) {
                        var dummyName = GA(el, "dummyName");
                        dummyName && (dummyName = dummyName.toLowerCase());
                        var boxnameVals = dataArr[dummyName] ? dataArr[dummyName].split(",") : null;
                        null != boxnameVals && arr.in_array(boxnameVals, el.value) ? (el.checked = !0, "function" == typeof el.onclick && el.onclick.apply(el)) : el.value == v ? el.checked = !0 : el.checked = !1
                    }
                    if (("text" == el.type || "select-one" == el.type || "textarea" == el.type || "hidden" == el.type || "number" == el.type) && v && void 0 !== v) {
                        el.value = v;
                        var t = $("#" + el.id).attr("clickSpl");
                        t ? (t += "(el)", eval(t)) : ("function" == typeof el.onkeyup && el.onkeyup.apply(el), "function" == typeof el.onchange && el.onchange.apply(el), "function" == typeof el.onblur && el.onblur.apply(el))
                    }
                    if ("select-one" == el.type && "-1" == el.selectedIndex && v && void 0 !== v)
                        for (var i = 0; i < el.options.length; i++)
                            if (el.options[i].text == v) {
                                el.options[i].selected = !0;
                                break
                            } if ("radio" == el.type && el.value == v && (el.checked = !0, "function" == typeof el.onclick && el.onclick.apply(el)), errArr && elName in errArr && !el[D]) {
                        var err = {
                            el: el,
                            err: errArr[elName],
                            code: 1105
                        };
                        jsval.seterr(el, err)
                    }
                    try {
                        cbk && cbk.call(void 0, dataArr, el)
                    } catch (ex) {}
                }
            }
        },
        aCf: function(a) {
            var b = this,
                c = b.el,
                d = b.formSubmitted;
            c.form || js.dom.findParent(c, "FORM");
            if (b == c.curctx) {
                try {
                    var e = $.parseJSON(a)
                } catch (i) {
                    e = a.split(":")
                }
                if (a.indexOf("success") < 0)
                    if ("showFrgtPswd" == GA(c, "cusgrp")) "1008" == e.msgNumber ? contact.frgtPasswdErrMobile(c, e) : contact.frgtPasswdErr(c, e);
                    else {
                        var f = {
                            el: c,
                            err: e[1],
                            code: e[0]
                        };
                        c.srvrVal = !1, c.msg = e[1], jsval.seterr(c, f)
                    }
                else {
                    if (jsval.clearerr(c, 1008), jsval.clearerr(c, 1007), ("true" == GA(c, "succ") || "true" == GA(c, "grpsucc")) && jsval.setsucc(c), c.srvrVal = !0, jsval.ajxVlds[c.name + "_" + c.id]) {
                        try {
                            delete jsval.ajxVlds[c.name + "_" + c.id]
                        } catch (i) {}
                        var g = !0;
                        for (var h in jsval.ajxVlds)
                            if (jsval.ajxVlds[h]) {
                                g = !1;
                                break
                            } g && 1 == d && c.form.onsubmit()
                    }
                    c && jsval.clearerr(c)
                }
            }
        },
        aEf: function(a) {
            var b = this,
                c = b.el,
                d = {
                    el: c,
                    err: "Server Validation Error (" + a + ")",
                    code: 1007
                };
            jsval.seterr(c, d), c.srvrVal = !1
        },
        vctrl: function(a, b) {
            b || (b = a), jsval.clearerr(b);
            var c = check[GA(b, "validate")](b);
            return !(c.length > 0) || (jsval.seterr(b.ff, c[0]), c)
        },
        vgrp: function(a, b, c) {
            b || (b = a);
            var d = [b],
                e = [];
            c || (d = d.concat(b.grp.ctrls));
            for (var f = 0; f < d.length; f++) {
                var g = d[f].vfn(a, d[f]);
                !0 !== g && (e = e.concat(g))
            }
            return 0 == e.length || e
        },
        vfld: function(a, b, c) {
            b || (b = a), b.h && (b[D] || a && "blur" == a.type) && (b.h.style.display = "none"), js.isStr(b) && (b = doc.byId(b));
            var d = jsval._vfld(b, a);
            if (void 0 == d || void 0 === d) return !0;
            if (!0 !== d) {
                $(b).siblings(".serverError") && $(b).siblings(".serverError").remove(), b.err = !0;
                var e = d.err ? d : {
                    el: b,
                    err: jsval.getInvalidMsg(b, d),
                    code: d
                };
                (d = []).push(e), c || jsval.seterr(b, e)
            } else {
                b && 1008 != b.code && jsval.clearerr(b), b.err = !1;
                var f, g = b.value;
                if ("true" != GA(b, "succ") && "true" != GA(b, "grpsucc") || "" == b.value.trim() || (GA(b, "grpsucc") ? jsval.setsucc(b, doc.byId(b.name + "grp")) : jsval.setsucc(b)), GA(b, "defVal") == b.value) return !0;
                if ((a && "blur" == a.type || c && !b.srvrVal) && (f = GA(b, "srvrval")) && "" != $("#advertiserNum").val() && "" != g.trim()) {
                    var e = {
                            el: b,
                            err: jsval.msgs[1008],
                            code: 1008
                        },
                        h = c ? 1 : 0;
                    c && (jsval.ajxVlds[b.name + "_" + b.id] = e), jsval.seterr(b, e);
                    var i = b.form || js.dom.findParent(b, "FORM");
                    window.setTimeout(function() {
                        ajax.postForm({
                            url: f,
                            ctx: b.curctx = {
                                el: b,
                                formSubmitted: c
                            },
                            thisfrm: i,
                            async: !0
                        }, jsval.aCf, jsval.aEf)
                    }, h), d = e
                }
            }
            try {
                c || layers.fixShadows()
            } catch (j) {}
            return d
        },
        _vfld: function(a, b) {
            if (!a) return !0;
            if (a[D]) return !0;
            if ("CTRL" == a.tagName) return !0;
            var c, d = "",
                e = a.value.trim();
            return (d = GA(a, "defVal")) && e == d && !GA(a, "required") ? (a.value = "", !0) : (b && "blur" == b.type && ("text" != a.type && "textarea" != a.type && "number" != a.type || (a.value = a.value.trim(), (d = GA(a, "defVal")) && "" == e && !GA(a, "required") && (a.value = d, a.className += " grey1"))), a.isvf = !0, "true" == GA(a, "checkMobile") && check.mobileVal(e, a), "true" == GA(a, "checkPhoneNum") && check.phoneNumValidation(e, a), c = !!(c = GA(a, "name")) && c.toUpperCase(), ("true" != GA(a, "requiredwithzero") && "required" != GA(a, "requiredwithzero") || "" != e) && ("true" != GA(a, "required") && "required" != GA(a, "required") || "" != e && "0" != e) && ("true" != GA(a, "attrequired") || "" != e && "0" != e) ? "true" == GA(a, "numeric") && isNaN(e) ? GA(a.form, "cuserr") ? c + "_ISNUM" : 1004 : !(d = GA(a, "valtype")) || !check[d] || check[d](e, a, b) : GA(a.form, "cuserr") ? c + "_REQUIRED" : 1e3)
        },
        vf: function(a) {
            if (js.isStr(a) && (a = doc.byId(a)), !a) return !0;
            var b, c = !0,
                d = [];
            b = a.inited ? js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "CTRL"]) : jsval.setupFrm(a, !0), a.errs = null, a.evtStatus = "invalidate";
            try {
                for (var e = 0; e < b.length; e++)
                    if (b[e]) {
                        b[e].validateMe || jsval.setupFld(b[e]);
                        var f = b[e].validateMe(null, b[e], !0);
                        b[e].err ? b[e].err : !(!b[e].ff || !b[e].ff.err) && b[e].ff.err;
                        !0 !== f && (d = d.concat(f), c = !1)
                    }
            } catch (g) {}
            try {
                layers.fixShadows()
            } catch (h) {}
            return a.errs = d, c || (a.evtStatus = ""), c
        },
        onkeyup: function(a, b) {
            return !b.isvf || (a.keyCode != env.keys.TAB ? b.validateMe(a, b) : void 0)
        },
        displayHelp: function(a, b, c, d) {
            b.h && b.h[PN].removeChild(b.h);
            var e = (b.id ? b.id : "") + "help";
            b.h = F_APP(F_CR("DIV", {
                className: "hintbox-new f11 grey",
                id: e
            }, {
                position: "absolute",
                zIndex: 200
            }), js.body()), js.dom.insertAfter(b.h, b);
            var f = ["rt", "lt"],
                g = [-2, -3];
            "top" == d ? (g = [-2, -30], arrowCls = "forarrow-new-up") : arrowCls = "forarrow-new", jsui.showAt(b.h, c || b, f, g), b.h[IH] = "<div class='new-new' style='position:relative;_margin-left:2px;!margin-left:2px;'><div class='" + arrowCls + "'></div>" + a + "</div></div>", b.h.style.display = "block", "top" == d && window.setTimeout(function() {
                b.h.style.display = "none"
            }, 3e4)
        },
        onfocus: function(a, b) {
            var c = $("#" + GA(b, "id")).siblings("div.inlineErr");
            if (c.length > 0 && !c.is(":hidden")) return !0;
            if (!b) return !0;
            if (void 0 !== se) var d = se.helpArr[GA(b, "name")];
            if (GA(b, "showDynHelp")) var d = GA(b, "dynMsg");
            var e = GA(b, "dynMsgAlign"),
                f = b.value;
            return (vt = GA(b, "defVal")) && b.value == vt && (b.value = "", b.className = b.className.replace(/\bgrey1\b/g, "")), d && (GA(b, "grphelp") ? jsval.displayHelp(d, b, doc.byId("true" == GA(b, "grphelp") ? b.name + "grp" : GA(b, "grphelp")), e) : jsval.displayHelp(d, b, "", e)), (vt = GA(b, "cusFoc")) && make[vt] ? make[vt](f, b, a) : void 0
        },
        setsucc: function(a, b) {
            var c = a.value;
            if (a.err) return !0;
            a.validateMe && GA(a, "defVal") != c && 0 != a.value && !GA(a, "lock") && (a.tick ? "none" == a.tick.style.display && js.dom.insertAfter(a.tick, b || a) : (a.tick = F_CR("DIV", {}, {
                marginLeft: "2px"
            }), a.tick[IH] = "<i class='ppf_sprite correct-new'></i>", a.tick.id = a.id + "tick", js.dom.insertAfter(a.tick, b || a)), a.tick.style.display = "inline", slowly.fadein(a.tick.id))
        },
        clearsucc: function(a) {
            a.tick && (a.tick.style.display = "none")
        },
        getDispName: function(a) {
            return GA(a, "nameinerr") || GA(a, "name")
        },
        getInvalidMsg: function(a, b) {
            var c, d = jsval.getDispName(a),
                e = !(!a.form || !GA(a.form, "cuserr"));
            if (b >= 2e3 && b < 2500) return e ? (c = d.toUpperCase(), c += "_MINLENGTH", se.errArr[c]) : d + " should be " + (b - 2e3) + " characters or more";
            if (b >= 2500 && b < 4e3) return e ? (c = d.toUpperCase(), c += "_MAXLENGTH", se.errArr[c]) : d + " should be " + (b - 2500) + " characters or less";
            if (11 == b && 1 == $("#homeLoanPage").length) return e ? (c += "_MAXLENGTH", se.errArr[c]) : "Numbers, special characters and spaces are not allowed.";
            if (e) return isNaN(b) || (b = d.toUpperCase() + "_ISVALID"), b in se.errArr ? se.errArr[b] : b;
            var f = jsval.msgs[b];
            if ("Location" == d && (f = jsval.msgs[1011]), !f) return d + " entered is invalid";
            if (js.isStr(f)) return f.replace(/\$nm/gi, d);
            try {
                return f.call(a, d)
            } catch (g) {}
        },
        msgs: {
            1000: "$nm is required",
            1003: "Special characters are not allowed in $nm",
            1004: "$nm should be numeric",
            1006: "At least one $nm is required",
            1007: "Server Validation Failed",
            1008: "Checking for validity ... ",
            1009: "Please wait ... ",
            1010: "Max $nm should be greater than Min $nm",
            1011: "At least a $nm is required.Can't find your Location? Type City",
            1012: "Only alphabets are allowed in a name"
        },
        hideFld: function(a) {
            if (!a) return !0;
            jsval.clearerr(a), jsui.hide(a)
        },
        showFld: function(a, b) {
            if (!a) return !0;
            a.isvf && jsval.vfld(a), a.style.display = b || "inline"
        },
        clearFrmErr: function(a) {
            if (null != a && js.isStr(a) && (a = doc.byId(a)), null != a && a.inited) {
                for (var b = js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "CTRL", "CUSTOM"]), c = 0; c < b.length; c++) {
                    if (!b[c]) return !0;
                    jsval.clearerr(b[c])
                }
                a.inited = !1
            }
        },
        clearerr: function(a, b) {
            if (!a) return !0;
            try {
                var c = a.ff || a;
                if ("custErr" == c[CN] && (c = a), c.err = !1, !b || c.code == b) {
                    c[CN] = c[CN].replace("valerr", ""), a.ep && ($(a.ep).parent().hasClass("sRow") && $(a.ep).parent().css("display", "none"), jsui.hide(a.ep)), a.ie && ($(a.ie).parent().hasClass("sRow") && $(a.ie).parent().css("display", "none"), a.ie.style.display = "none");
                    var d = GA(a, "attr");
                    doc.byId(d + "_ce") && (el1 = doc.byId(d + "_ce"), "text" == a.type && (a.style.backgroundColor = "white"), doc.byId(d + "_ceff").className = doc.byId(d + "_ceff").className.replace("valerr", ""), el1 && (jsui.hide(a.ie), el1.style.display = "none"))
                }
            } catch (e) {}
        },
        clearWait: function(a) {
            a.iw && (a.iw.style.display = "none")
        },
        setwait: function(a, b) {
            jsval._inlineWait(a, b)
        },
        seterr: function(a, b) {
            var c = GA(a, "errColor") ? GA(a, "errColor") : "red",
                d = b.err,
                e = b.code,
                f = !1,
                g = a.ff || a;
            if (g.err = !0, g.code = e, a.ep) {
                $(a.ep).parent().hasClass("sRow") && $(a.ep).parent().css("display", "block");
                var h = GA(a, "attr");
                if (doc.byId(h + "_ce")) {
                    a.ep.style.display = "none";
                    var i = h + "_ce";
                    a.ip[IH] = "<span class='" + c + " f12'>" + d + "</span>", doc.byId(i).innerHTML = a.ip[IH], doc.byId(i).style.display = "block";
                    var j = doc.byId(h + "_ceff").className;
                    "-1" == j.indexOf("valerr") && (doc.byId(h + "_ceff").className = j + " valerr"), a.style.background = "transparent"
                } else g[CN].indexOf("valerr") < 0 && (g[CN] = "valerr " + g[CN]), a.ep[FC][CHN][2][IH] = d, a.ep.style.display = "block", f = !0
            }
            if (a.ie) {
                $(a.ie).parent().hasClass("sRow") && $(a.ie).parent().css("display", "block");
                var h = GA(a, "attr");
                if (doc.byId(h + "_ce")) {
                    var h = GA(a, "attr"),
                        i = h + "_ce";
                    doc.byId(i).innerHTML = "<span class='" + c + " f12'>" + d + "</span>", doc.byId(i).style.display = "block";
                    var j = doc.byId(h + "_ceff").className;
                    "-1" == j.indexOf("valerr") && (doc.byId(h + "_ceff").className = j + " valerr"), a.style.background = "transparent"
                } else $(a.ie).parent().hasClass("Contactmod") || $(a.ie).parent().hasClass("Contactmod1") ? a[CN].indexOf("valerr") < 0 && (a[CN] = "valerr " + a[CN]) : g[CN].indexOf("valerr") < 0 && (g[CN] = "valerr " + g[CN]), a.ie[IH] = "<span class='" + c + " f12'>" + d + "</span>", a.ie.style.display = "block", f = !0
            }
            if (!f) {
                var k = a.form || js.dom.findParent(a, "FORM");
                switch (GA(a, "errDisplay") || GA(k, "errdisplay")) {
                    case "inline":
                        jsval._inline(a, d);
                        break;
                    case "inline_custom":
                        jsval._inline_custom(a, d);
                        break;
                    case "pop":
                        jsval._pop(a, d);
                        break;
                    case "lastchild":
                        jsval._last(a, d);
                        break;
                    case "errDiv":
                        jsval._div(a, d)
                }
            }
            jsval.clearsucc(a);
            var l = GA(a, "callback");
            null != l && "" != l && window.eval(l), "undefined" != typeof objtnm && objtnm.logError(e, "element")
        },
        find: function(a, b, c) {
            for (var d = 0; d < a.length; d++)
                if (GA(a[d], b) == c) return a[d];
            return !1
        },
        inlineErrs: function(a, b, c) {
            var d = $(a).attr("isscroll");
            void 0 == c && (c = void 0 === d || d);
            for (var e = a.errs, f = 0; f < e.length; f++) {
                var g = e[f].err,
                    h = e[f].el;
                switch (GA(h, "errDisplay") || GA(a, "errdisplay")) {
                    case "pop":
                        jsval._pop(h, g, b);
                        break;
                    case "inline_custom":
                        jsval._inline_custom(h, g);
                        break;
                    case "lastchild":
                        jsval._last(h, g);
                        break;
                    case "errDiv":
                        jsval._div(h, g);
                    default:
                        jsval._inline(h, g)
                }
            }
            if ("CTRL" == e[0].el.tagName) {
                var i = js.pos.toCoords(e[0].el[PN][PN]);
                c && "false" != c && window.scrollTo(i.x, i.y)
            } else if (c && "false" != c) try {
                scrollToElement($(e[0].el).get(0), 300, -140)
            } catch (j) {
                alert("er")
            }
        },
        _inlineWait: function(a, b) {
            if (!a.iw) {
                var c = GA(a, "errwd");
                c || a[OW];
                a.iw = F_CR("div", {
                    className: "inlineWait"
                }, {
                    position: "relative"
                }), js.dom.insertAfter(a.iw, a)
            }
            a.iw[IH] = "<span class='red' style='margin-left:10px;'>" + b + "</span>", a.iw.style.display = "block"
        },
        _div: function(el, msg) {
            var errdiv = eval(doc.byId(GA(el, "errdiv")));
            jsval._inline(el, msg), F_APP(el.ie, errdiv)
        },
        _inline: function(a, b) {
            var c, d, e, f, g;
            c = a.ff || a, $(c).parent().hasClass("Contactmod") || $(c).parent().hasClass("Contactmod1") ? a[CN].indexOf("valerr") < 0 && (a[CN] = "valerr " + a[CN]) : c[CN].indexOf("valerr") < 0 && (c[CN] = "valerr " + c[CN]), d = GA(a, "errColor") ? GA(a, "errColor") : "red", e = GA(a, "customizedErrClass") ? GA(a, "customizedErrClass") : "inlineErr", f = e || (env.ie ? "inlineErr_ie" : e), a.ie || (g = GA(a, "errwd"), wd = g || a[OW], a.ie = "custErr" == f ? F_CR("div", {
                className: f
            }) : F_CR("div", {
                className: f
            }, {
                position: "relative",
                marginTop: "1px"
            }), js.dom.insertAfter(a.ie, a.ff || a)), a.ie[IH] = "<span class='" + d + " f12'>" + b + "</span>", a.ie.style.display = "block", $(a.ie).parent().hasClass("sRow") && $(a.ie).parent().css("display", "block")
        },
        _inline_custom: function(a, b) {
            var c = GA(a, "attr"),
                d = c + "_ce";
            doc.byId(d).innerHTML = "<span class='red f12'>" + b + "</span>", doc.byId(d).style.display = "block";
            var e = doc.byId(c + "_ceff").className;
            "-1" == e.indexOf("valerr") && (doc.byId(c + "_ceff").className = e + " valerr"), "text" == a.type && (a.style.background = "transparent")
        },
        _last: function(a, b) {
            jsval._inline(a, b), F_APP(a.ie, a[PN])
        },
        errPops: function(a, b) {
            for (var c = a.errs, d = 0; d < c.length; d++) {
                var e = c[d].el;
                jsval._pop(e, c[d].err, b)
            }
            try {
                c[0].el.focus()
            } catch (f) {}

        },
        _pop: function(a, b, c) {
            var d = "<img src=''/>",
                e = ["lb", "lt"],
                f = [-2, 3];
            switch (GA(a, "errpos")) {
                case "top":
                    d = "<img src=''/>", e = ["lt", "lb"], f = [-2, -3];
                    break;
                case "right":
                    d = "<img src=''/>", e = ["rt", "lt"]
            }
            if (!a.ep) {
                var g = c || js.body();
                a.ep = F_APP(F_CR("DIV", {}, {
                    position: "absolute",
                    fontSize: "11px",
                    border: "solid 1px red",
                    zIndex: 2e4
                }), g), a.ep[IH] = "<div style='padding:2px;padding-right:25px;background-color:#fff'>" + d + "<img onclick='jsui.hide(this[PN][PN])' class='abs posrt' width='13' height='13' src='/images/icons/close.gif'/><span class='red'></span></div>"
            }
            if (a.ep[FC][CHN][2][IH] = b, jsui.showAt(a.ep, a.ff || a, e, f), jsui.dropShadow(a.ep), c) {
                var h = js.pos.toCoords(c);
                a.ep.style.left = a.ep.pt.x - h.x + "px", a.ep.style.top = a.ep.pt.y - h.y + "px"
            }
        },
        fixPlaceHolder: function(a) {
            this.isPlaceHolderSup() || a.find("[placeholder]").focus(function() {
                var a = $(this),
                    b = a.val();
                (b == a.attr("placeholder") || empty(b)) && a.val("").removeClass("placeholder")
            }).blur(function() {
                var a = $(this),
                    b = a.val();
                (empty(b) || b == a.attr("placeholder")) && a.addClass("placeholder").val(a.attr("placeholder"))
            }).blur()
        },
        remPlaceHolderVal: function(a) {
            a.find("[placeholder]").each(function() {
                var a = $(this);
                a.val() == a.attr("placeholder") && a.val("")
            })
        },
        isPlaceHolderSup: function() {
            if (navigator.userAgent.indexOf("MSIE") > 0) {
                if ("placeholder" in document.createElement("input") == 0) return !1
            }
            return !0
        },
        rstErrFld: function(a) {
            var b = doc.byId(a);
            b.ie && b.ie[PN].removeChild(b.ie), b.ie = "", b.vfn = "", jsval.setupFld(b)
        },
        destroyFrm: function(a) {
            for (var b = js.dom.findAll(a, ["INPUT", "SELECT", "TEXTAREA", "CTRL", "CUSTOM"]), c = 0; c < b.length; c++) {
                if (!b[c]) return !0;
                var d = b[c],
                    e = GA(d, "group");
                e ? jsval.destroyGrp(d, a.name + "." + e, b) : jsval.destroyFld(b[c])
            }
            a.inited = !1
        },
        destroyGrp: function(a, b, c) {
            if (jsval.destroyFld(a), void 0 == a.grp) return !0;
            var d = a.grp;
            "CTRL" == a.tagName ? d.ctrls = [] : d.flds = []
        },
        destroyFld: function(a) {}
    };
jsval.msgs[1e3] = function(a) {
    switch (GA(this, "valtype")) {
        case "name":
            return "Please enter your name.";
        case "email":
            return "Please specify Email ID.";
        case "phone":
        case "mobile":
        case "phmob":
            return "Please enter your contact number.";
        case "msg":
            return "Please enter your message.";
        case "city":
            return "Please select city.";
        case "budget":
            return "Please choose Budget Range.";
        case "budget_min":
            return "Please choose Min Budget.";
        case "budget_max":
            return "Please choose Max Budget.";
        case "username":
            return "Please specify your Username.";
        case "multipleemail":
            return "Please specify Email ID's.";
        case "company_description":
            return "Please describe your company, what you specialize in etc.";
        case "identity":
            return "<div style='white-space: nowrap;'>Please select are you an Individual or Dealer.</div>";
        case "reason":
            return "Please select at-least one problem type before submitting.";
        case "details":
            return "Please mention details of the problem to help us fix it"
    }
    return a + " is required"
}, check.identity = function(a, b) {
    var c = !1;
    return $(b).parent().parent().find("input[type=radio]").each(function() {
        "checked" == $(this).attr("checked") ? c = !0 : $("#comparePage").length > 0 && $("input[name = 'identityRadio']:checked").length && !c && (c = !0)
    }), c ? ($(b).parent().parent().parent().find(".lf .mr_5").removeClass("red"), c) : ($(b).parent().parent().parent().find(".lf  .mr_5").addClass("red"), 1e3)
}, check.name = function(a, b) {
    if ("nameId" == b.id && "" == a && "required" != b.getAttribute("required")) return !0;
    var c = b.name;
    if (!/^[a-zA-Z]+\.?\s?(([a-zA-Z]+)?\.?\s?)+[a-zA-Z\s]$/.test(a)) return 1012;
    var d = /([^\/\\a-zA-Z0-9 ,\'\-\.()[\]:"])+/g,
        e = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].minLength : 3,
        f = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].maxLength : 50;
    return d.test(a) && (b.value = a.replace(d, "")), a.length > f ? 2550 : !(a.length < e) || 2003
}, check.username_new = function(a, b) {
    var c = /([^a-zA-Z0-9\-_\.@])+/g,
        d = b.name,
        e = void 0 !== se && d in se.minMax ? se.minMax[GA(b, "name")].minLength : 6,
        f = void 0 !== se && d in se.minMax ? se.minMax[GA(b, "name")].maxLength : 50;
    return c.test(a) && (b.value = a.replace(c, "")), /^([0-9@\_\.\-])+/g.test(a) && (b.value = a.replace(/^([0-9@\_\.\-])+/g, "")), a.length > f ? 2550 : !(a.length < e) || 2006
}, check.sellerpincode = function(a, b) {
    if (0 == parseInt(a)) return !1;
    var c = doc.byId("isInternational");
    if (!c) return !0;
    var d = "" == c.value ? b.name : b.name + "_International",
        e = "" == c.value ? /[^0-9]/g : /([^\/a-zA-Z0-9\-\'\. ])+/g,
        f = void 0 !== se && d in se.minMax ? se.minMax[d].minLength : 3,
        g = void 0 !== se && d in se.minMax ? se.minMax[d].maxLength : 50;
    return e.test(a) && (b.value = a.replace(e, "")), a.length > g ? d.toUpperCase() + "_ISVALID" : !(a.length < f) || d.toUpperCase() + "_ISVALID"
}, check.company = function(a, b) {
    var c = b.name;
    if ("O" == se.userClass) return !0;
    var d = /([^\/\\a-zA-Z0-9 ,\'\-\.()[\]:&"])+/g;
    /^[a-zA-Z0-9]/.test(a) || (b.value = a.replace(/^[^a-zA-Z0-9]*/, ""));
    var e = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].minLength : 3,
        f = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].maxLength : 100;
    return d.test(a) && (b.value = a.replace(d, "")), a.length > f ? 2550 : a.length < e ? 2006 : (profile.company = a, profile.setCompanyProfile(), !0)
}, check.company_profile = function(a, b) {

    var c = b.name;
    if ("O" == se.userClass) return !0;
    var d = /([^\/\\a-zA-Z0-9 ,\'\-\.()[\]:\n\r;"\*+{}=!#$%~\^&|?])+/g;
    /^[a-zA-Z0-9]/.test(a) || (b.value = a.replace(/^[^a-zA-Z0-9]*/, ""));
    var e = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].minLength : 5,
        f = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].maxLength : 2e3;
    return d.test(a) && (b.value = a.replace(d, "")), a.length > f ? 2550 : !(a.length < e) || 2006
}, check.replaceUrlText = function(a, b) {
    var c = /([\w-]+\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mobi|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)+(\/[\w-:\.\/\?%&=]*)?$/,
        d = /(http|https):\/\/(\s)*/gm;
    a = a.replace(/\n/g, "#345$#"), a = a.replace(/\s/g, "#123$#"), a = a.split(/[#]/g);
    for (var e = "", f = 0; f < a.length; f++) d.test(a[f]) || c.test(a[f]) && (a[f] = a[f].replace(c, "http://" + a[f])), e += a[f].replace(/(123\$)/, " ").replace(/(345\$)/, "\n");
    return b.value = e, !0
}, check.password = function(a, b) {
    var c = b.name,
        d = /([^a-zA-Z0-9@_\-\.])+/g,
        e = /^[@_\.\-]/g,
        f = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].minLength : 6,
        g = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].maxLength : 50;
    return !d.test(a) && (!e.test(a) && (1 == passwordMobileSimilarity(a) ? "Password cannot be the same as mobile number" : a.length > g ? 2550 : !(a.length < f) || 2006))
}, check.cpassword = function(a, b) {
    var c = doc.byId("password"),
        d = doc.byId("UsernameId"),
        e = d ? d.value : "";
    return a.trim() == c.value.trim() && (e.trim() != a.trim() || b.name.toUpperCase() + "_MATCHES_USERNAME")
}, check.city_code = function(a, b) {
    var c = b.name;
    if ("" == a) return !0;
    var d = /[^0123456789]/;
    d.test(a) && (b.value = a.replace(d, ""));
    var e = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].minLength : 2,
        f = void 0 !== se && c in se.minMax ? se.minMax[GA(b, "name")].maxLength : 5;
    return a.length > f ? 2507 : !(a.length < e) || 2002
}, check.landline = function(a, b) {
    var c = "",
        d = "";
    if ("" == a) return "1" == GA(b, "ll") && (c = doc.byId("ll1a"), c.removeAttribute("required"), jsval.clearerr(c)), "2" == GA(b, "ll") && (c = doc.byId("ll2a"), c.removeAttribute("required"), jsval.clearerr(c)), !0;
    if (d = GA(b, "ll")) {
        if (!(c = doc.byId("ll" + d + "a"))) return !0;
        if ("" == c.value || c.value == GA(c, "defVal")) {
            c.setAttribute("required", !0), error_key = GA(c, "name").toUpperCase(), error_key += "_REQUIRED";
            var e = {
                el: c,
                err: se.errArr[error_key],
                code: error_key
            };
            return jsval.seterr(c, e), b.name.toUpperCase() + "_ISCITYCODE"
        }
    }
    var f = /[^0123456789]/g,
        g = b.name;
    f.test(a) && (b.value = a.replace(f, ""));
    var h = void 0 !== se && g in se.minMax ? se.minMax[GA(b, "name")].minLength : 5,
        i = void 0 !== se && g in se.minMax ? se.minMax[GA(b, "name")].maxLength : 10;
    return a < (void 0 !== se && g in se.minMax ? se.minMax[GA(b, "name")].minValue : 2e4) ? 1002 : a.length > i ? 2510 : a.length < h ? 2005 : 0 != parseInt(a) && "" != a || 1112
}, check.additional_comments = function(a, b) {
    if ("" == a) return !0;
    var c = /([^\/\\a-zA-Z0-9 ,\'\-\.():"\n\r])+/g;
    return c.test(a) && (b.value = a.replace(c, "")), check.detectContactError(a)
}, check.key_landmarks = function(a, b) {
    if ("" == a) return !0;
    var c = /([^\/\\a-zA-Z0-9 ,\'\-\.():"])+/g;
    return c.test(a) && (b.value = a.replace(c, "")), !0
}, check.propFloor = function(a, b) {
    var c = doc.byId("Total_FloorId"),
        d = GA(c, "name").toUpperCase();
    d += "_ISVALID";
    var e = {
        el: c,
        err: se.errArr[d],
        code: d
    };
    return parseInt(a) > parseFloat(c.value) ? jsval.seterr(c, e) : jsval.clearerr(c), !0
}, check.Floors = function(a, b) {
    var c = parseInt(b.options[b.selectedIndex].value),
        d = doc.byId("Floor_NumId");
    if (!d) return !0;
    var e = d.options[d.selectedIndex].value;
    return !(!isNaN(e) && !isNaN(c) && e > c)
}, check.amenties = function(a, b) {
    return "" == (a = valKeys.numeric(b)) || (!("" != a && a > 99.9) || b.name.toUpperCase() + "_ISNUM")
}, check.atleastonepostedby = function(a) {
    return found = check.atleastone(a), found ? [] : [{
        el: a.ff,
        err: jsval.getInvalidMsg(a.ff, 1e3),
        code: 1e3
    }]
}, check.atleastonecontact = function(a) {
    return found = check.atleastone(a), found ? [] : [{
        el: a.ff,
        err: jsval.getInvalidMsg(a.ff, 1006),
        code: 1006
    }]
}, check.atleastone = function(a) {
    for (var b = !1, c = a.grp, d = ["text", "hidden", "select-one"], e = 0; e < c.flds.length; e++) {
        var f = c.flds[e],
            g = f.value.trim();
        if (!f[D] && ("checkbox" == f.type && 1 == f.checked || arr.in_array(d, f.type) && "" != g && "0" != g && g != GA(f, "defVal"))) {
            b = !0;
            break
        }
    }
    return b
}, check.country_code = function(a) {
    return a.length > 5 ? 2505 : 0 == parseInt(a) || "" == a ? 1108 : !/[^0123456789]/.test(a) || 1109
}, check.username = function(a, b) {
    return a.length > 50 ? 2550 : a.length < 6 ? 2006 : !!/^[a-zA-Z][A-Z &a-z.,'`\/-]*$/.test(a) || 1005
}, check.sellername = function(a) {
    return a.length > 50 ? 2550 : a.length < 3 ? 2003 : /[\#"\\!@\$\%\^\&\*\?:~`\(\)_\+=\{\}\[\]\|<>;1234567890]/.test(a) ? 1114 : !/^[/\-\.\']/.test(a) || 1115
}, check.url = function(a) {
    return !a || !!/^(http|https):\/\/([\w-]+\.)+[\w-]+(\/[\w-:.\/\?%&=]*)?$/.test(a)
}, check.propcode = function(a) {
    return !!/^[A-Z][0-9]{6,}$/.test(a)
}, check.keyword = function(a) {
    return !(a && a.length > 0 && a.length < 3) || 2003
}, check.msg = function(a) {
    return a.length > 1e3 ? 3500 : !(a.length < 5) || 2005
}, check.phonegrp = function(a, b) {
    var c = a.split(",");
    if (ph = [doc.byId(c[0]), doc.byId(c[1]), doc.byId(c[2])], "" != ph[2].value && ("" == ph[0].value || "" == ph[1].value)) {
        var d = "";
        return "" == ph[0].value && (d = "Country Code"), "" == ph[1].value ? "" != d ? d += " and City Code are required." : d = "City Code is required." : d += " is required.", {
            el: b,
            err: d,
            code: 9006
        }
    }
    return !0
}, check.details = function(a, b) {
    return a.length < 30 && (-1 != $("#reasonId").val().indexOf("8") || -1 != $("#reasonId").val().indexOf("3") || -1 != $("#reasonId").val().indexOf("4") || -1 != $("#reasonId").val().indexOf("7")) ? 2030 : (jsval.clearerr(b), !0)
};
var contact = {
        el_m1: null,
        el_l1: null,
        mobile_count: 0,
        ll_count: 0,
        inited: !1,
        atTop: null,
        reset: function() {
            this.el_m1 = null, this.el_l1 = null, this.mobile_count = 0, this.ll_count = 0, this.atTop = null
        },
        setInitial: function(a) {
            this.reset(), this.updateContactElements(a), this.inited || (this.inited = !0, this.setAtTop(this.el_m1, "M"), this.updateCounter("M", "add", "", "")), a && toggle.addAddressLine2()
        },
        setAtTop: function(a, b) {
            doc.byId("firstContact")[IH] = a, "M" == b && (jsval.hideFld(doc.byId("mobileDiv1")), this.atTop = "M", doc.byId("m1contact")[IH] = "", doc.byId("l1contact")[IH] = this.el_l1), "L" == b && (jsval.hideFld(doc.byId("landlineDiv1")), this.atTop = "L", doc.byId("l1contact")[IH] = "", doc.byId("m1contact")[IH] = this.el_m1, jsval.setupFld(doc.byId("mobile1")));
            var c = doc.byId("mobile1").form;
            c.inited = !1, jsval.setupFrm(c)
        },
        updateContactElements: function(a) {
            this.el_m1 = doc.byId("m1contact")[IH], this.el_l1 = doc.byId("l1contact")[IH], a ? (jsval.hideFld(doc.byId("addM")), jsval.hideFld(doc.byId("addL")), this.freezeContactDD()) : (jsval.hideFld(doc.byId("mobileDiv1")), jsval.hideFld(doc.byId("mobileDiv2")), jsval.hideFld(doc.byId("mobileDiv3")), jsval.hideFld(doc.byId("landlineDiv1")), jsval.hideFld(doc.byId("landlineDiv2")))
        },
        addMobile: function() {
            "M" == this.atTop ? (1 == this.mobile_count ? jsval.showFld(doc.byId("mobileDiv2"), "block") : 2 == this.mobile_count && jsval.showFld(doc.byId("mobileDiv3"), "block"), this.updateCounter("M", "add", "", "")) : (0 == this.mobile_count ? jsval.showFld(doc.byId("mobileDiv2"), "block") : 1 == this.mobile_count ? jsval.showFld(doc.byId("mobileDiv3"), "block") : 2 == this.mobile_count && jsval.showFld(doc.byId("mobileDiv1"), "block"), this.updateCounter("M", "add", "", ""))
        },
        addLL: function() {
            "L" == this.atTop ? (jsval.showFld(doc.byId("landlineDiv2"), "block"), this.updateCounter("", "", "L", "add")) : (0 == this.ll_count ? jsval.showFld(doc.byId("landlineDiv2"), "block") : 1 == this.ll_count && jsval.showFld(doc.byId("landlineDiv1"), "block"), this.updateCounter("", "", "L", "add"))
        },
        toggleContact: function(a) {
            "M" == a.value && (this.setAtTop(this.el_m1, "M"), this.updateCounter("M", "add", "L", "substract"), this.toggleValidation("M", "apply", "L", "remove")), "L" == a.value && (this.setAtTop(this.el_l1, "L"), this.updateCounter("M", "substract", "L", "add"), this.toggleValidation("M", "remove", "L", "apply"))
        },
        toggleValidation: function(a, b, c, d) {
            return !0
        },
        toggleCountryCode: function(a) {
            if (!a.value) return !0;
            a.options[a.selectedIndex].text;
            doc.byId("Alt_Country").value = a.value
        },
        updateCounter: function(a, b, c, d) {
            a && "add" == b && (this.mobile_count += 1), a && "substract" == b && (this.mobile_count -= 1), c && "add" == d && (this.ll_count += 1), c && "substract" == d && (this.ll_count -= 1), this.checkForLinkstoDisplay()
        },
        checkForLinkstoDisplay: function() {
            this.mobile_count >= 3 && (jsval.hideFld(doc.byId("addM")), this.freezeContactDD()), this.ll_count >= 2 && (jsval.hideFld(doc.byId("addL")), this.freezeContactDD())
        },
        freezeContactDD: function() {
            doc.byId("phoneDD").disabled = !0
        }
    },
    se = {
        errArr: [],
        helpArr: [],
        minMax: [],
        displayHelp: !0,
        requestSent: {},
        getSellerConstants: function(a) {
            var b = a ? "" + a : "";
            void 0 === se.requestSent[b] && (se.requestSent[b] = $.ajax({
                url: b,
                method: "GET",
                success: se.sellerConstantsCallBack,
                error: se.failure
            }))
        },
        sellerConstantsCallBack: function(txt) {
            var inputArr = eval("(" + txt + ")");
            se.minMax = inputArr.sellerFieldsConstraints, se.errArr = inputArr.sellerErrMsgs, se.displayHelp && (se.helpArr = inputArr.sellerHelpMsgs), inputArr.propTypePhotoTypeMapping && (se.propTypePhotoTypeMapping = inputArr.propTypePhotoTypeMapping), se.preFillfromFloorPlansMap = inputArr.preFillfromFloorPlansMap, se.propTypeMapping = inputArr.propTypeMapping, se.constFlag = !0, "undefined" != typeof seller && seller.callBackSuccessTrigger()
        }
    };
! function(a) {
    a.fn.hoverIntent = function(b, c, d) {
        var e = {
            interval: 100,
            sensitivity: 6,
            timeout: 0
        };
        e = "object" == typeof b ? a.extend(e, b) : a.isFunction(c) ? a.extend(e, {
            over: b,
            out: c,
            selector: d
        }) : a.extend(e, {
            over: b,
            out: b,
            selector: c
        });
        var f, g, h, i, j = function(a) {
                f = a.pageX, g = a.pageY
            },
            k = function(b, c) {
                if (c.hoverIntent_t = clearTimeout(c.hoverIntent_t), Math.sqrt((h - f) * (h - f) + (i - g) * (i - g)) < e.sensitivity) return a(c).off("mousemove.hoverIntent", j), c.hoverIntent_s = !0, e.over.apply(c, [b]);
                h = f, i = g, c.hoverIntent_t = setTimeout(function() {
                    k(b, c)
                }, e.interval)
            },
            l = function(a, b) {
                return b.hoverIntent_t = clearTimeout(b.hoverIntent_t), b.hoverIntent_s = !1, e.out.apply(b, [a])
            },
            m = function(b) {
                var c = a.extend({}, b),
                    d = this;
                d.hoverIntent_t && (d.hoverIntent_t = clearTimeout(d.hoverIntent_t)), "mouseenter" === b.type ? (h = c.pageX, i = c.pageY, a(d).on("mousemove.hoverIntent", j), d.hoverIntent_s || (d.hoverIntent_t = setTimeout(function() {
                    k(c, d)
                }, e.interval))) : (a(d).off("mousemove.hoverIntent", j), d.hoverIntent_s && (d.hoverIntent_t = setTimeout(function() {
                    l(c, d)
                }, e.timeout)))
            };
        return this.on({
            "mouseenter.hoverIntent": m,
            "mouseleave.hoverIntent": m
        }, e.selector)
    }
}(jQuery);
var global_locality_ajax_flag_check = !1;
flgsHdlr = {
    shwGATrck: !1
}, onLoginClick = !1, window.isiPad = !1, TRACKING_AFTER_PAGE_LOAD = "undefined" != typeof TRACKING_AFTER_PAGE_LOAD && TRACKING_AFTER_PAGE_LOAD, scrollToEle = !1, greyOutIntervalId = null, showLBOnTop = !1, offsetAboveHeader = null, zedo_retry = 0;
var firing_marketing_tag = {
        fireMarketingTag: function(a, b) {
            tracking_data(a, b)
        },
        fireTagOnThankYouLayer: function(a) {
            var b = a.city,
                c = "";
            if (void 0 !== a.event && (c = a.event), "undefined" != typeof xes && xes.isMarketing) {
                for (var d = xes.confSlot.getNoOfSelectedAdvts(), e = 0; e < d; e++) firing_marketing_tag.fireMarketingTag(c, {
                    city: b
                });
                xes.isMarketing = !1
            } else firing_marketing_tag.fireMarketingTag(c, {
                city: b
            })
        }
    },
    plugins = {
        initToolTip: function() {
            var a = "";
            $('[data-toolpar="toolTipWrapper"]').hover(function(b) {
                var c = {
                        top: $(this).offset().top,
                        left: $(this).offset().left,
                        height: $(this).outerHeight(),
                        width: $(this).outerWidth()
                    },
                    d = {
                        scroll: $(window).scrollTop(),
                        left: $(window).scrollLeft(),
                        width: window.innerWidth,
                        height: window.innerHeight
                    },
                    e = {
                        width: $(this).find('[data-type="toolTipText"]').outerWidth(),
                        height: $(this).find('[data-type="toolTipText"]').outerHeight()
                    },
                    f = {
                        top: 0,
                        bottom: 0,
                        left: 0,
                        right: 0
                    };
                switch (c.width >= e.width && c.height >= e.height ? (f.top = c.top - d.scroll, f.right = 0, f.bottom = d.scroll + d.height - (c.top + c.height + 15), f.left = c.left - d.left) : (f.top = c.top - d.scroll, f.right = d.width + d.left - (c.left + c.width), f.bottom = d.scroll + d.height - (c.top + c.height + 15), f.left = c.left - d.left), !0) {
                    case f.bottom >= 0 && f.bottom >= f.top && f.bottom >= e.height:
                        c.left < (e.width - c.width) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top + c.height + 7 + "px",
                            left: f.left + "px"
                        }), $(this).find('[data-for="tooltipTop"]').css({
                            left: "5px"
                        }).show()) : d.width - (c.left + c.width) < (e.width - c.width) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top + c.height + 7 + "px",
                            left: f.left + c.width - e.width + "px"
                        }), $(this).find('[data-for="tooltipTop"]').css({
                            right: "5px"
                        }).show()) : ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top + c.height + 7 + "px",
                            left: f.left - (e.width - c.width) / 2 + "px"
                        }), $(this).find('[data-for="tooltipTop"]').addClass("horCenter").show());
                        break;
                    case f.top >= 0 && f.top >= f.bottom && f.top >= e.height:
                        c.left < (e.width - c.width) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top - e.height - 7 + "px",
                            left: f.left + "px"
                        }), $(this).find('[data-for="tooltipBottom"]').css({
                            left: "5px"
                        }).show()) : d.width - (c.left + c.width) < (e.width - c.width) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top - e.height - 7 + "px",
                            left: f.left + c.width - e.width + "px"
                        }), $(this).find('[data-for="tooltipBottom"]').css({
                            right: "5px"
                        }).show()) : ($(this).find('[data-type="toolTipText"]').css({
                            top: f.top - e.height - 7 + "px",
                            left: f.left - (e.width - c.width) / 2 + "px"
                        }), $(this).find('[data-for="tooltipBottom"]').addClass("horCenter").show());
                        break;
                    case f.right >= 0 && f.right >= f.left && f.right >= e.width:
                        c.top < (e.height - c.height) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left + c.width + 7 + "px",
                            top: f.top + "px"
                        }), $(this).find('[data-for="tooltipLeft"]').css({
                            top: "5px"
                        }).show()) : d.height - (c.top + c.height) < (e.height - c.height) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left + c.width + 7 + "px",
                            top: f.top - e.height + "px"
                        }), $(this).find('[data-for="tooltipLeft"]').css({
                            bottom: "5px"
                        }).show()) : ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left + c.width + 7 + "px",
                            top: f.top - (e.height - c.height) / 2
                        }), $(this).find('[data-for="tooltipLeft"]').addClass("verMiddle").show());
                        break;
                    default:
                        c.top < (e.height - c.height) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left - e.width - 7 + "px",
                            top: f.top + "px"
                        }), $(this).find('[data-for="tooltipRight"]').css({
                            top: "5px"
                        }).show()) : d.height - (c.top + c.height) < (e.height - c.height) / 2 ? ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left - e.width - 7 + "px",
                            top: f.top - e.height + "px"
                        }), $(this).find('[data-for="tooltipRight"]').css({
                            bottom: "5px"
                        }).show()) : ($(this).find('[data-type="toolTipText"]').css({
                            left: f.left - e.width - 7 + "px",
                            top: f.top - (e.height - c.height) / 2 + "px"
                        }), $(this).find('[data-for="tooltipRight"]').addClass("verMiddle").show())
                }
                a = $(this).find('[data-type="toolTipText"]').parent().html(), $("body").append(a), $('body > [data-type="toolTipText"]').css({
                    opacity: 1
                })
            }, function(a) {
                $(this).find('[data-type="toolTipText"],[data-type="tooltipArrow"]').removeAttr("style").removeAttr("class"), $(this).find('[data-type="toolTipText"]').css({
                    opacity: 0
                }), $('body > [data-type="toolTipText"]').length > 0 && $('body > [data-type="toolTipText"], body > .xid_tooltip1x').remove()
            })
        }
    },
    jsData = {
        dataLayerExist: function() {
            return void 0 !== parent.dataLayer || (parent.dataLayer = new Array, !1)
        },
        fireEvent: function(a, b) {
            this.dataLayerExist();
            var c = new Object;
            for (key in b) "function" != typeof b[key] && (c[key] = b[key]);
            parent.dataLayer.push(c), "contactAdvertiserClick" == a && (a = "contactDealerClick"), "" != a && parent.dataLayer.push({
                event: a
            })
        }
    },
    ats = {
        doTracking: function() {
            return !1
        },
        showDefaulF: function(a) {},
        showDefaultS: function(a) {
            var b = new Array;
            b = a.split(",");
            var c = new Array,
                d = b.length;
            b[d - 2], b[d - 1];
            try {
                for (var e = 0; e < d - 2; e++) {
                    var f = document.createElement("a");
                    if (f.className = "check", f.href = b[e], f.id = "n11" + e, f.innerHTML = b[e], f.style.display = "none", f.style.display = "none", document.body.appendChild(f), env.ie) {
                        var g = document.getElementById("n11" + e).currentStyle.color;
                        "#ff0000" == g && c.push(b[e])
                    } else {
                        var g = window.getComputedStyle(document.getElementById("n11" + e), null);
                        "rgb(255, 0, 0)" != g.getPropertyValue("color") && "#ff0000" != g.getPropertyValue("color") || c.push(b[e])
                    }
                }
            } catch (h) {}
            if (c.length) {
                c.join('","')
            }
        },
        showDefaulFVisited: function(a) {},
        showDefaultSVisited: function() {
            document.cookie = "ATS=1"
        }
    },
    np = {
        fix: function() {
            for (var a = 0, b = doc.byId("row0"); b;) np.fixRow(np.find(b, "details")), np.fixRow(np.find(b, "proj_name")), np.fixRow(np.find(b, "map_block")), np.fixRow(np.find(b, "cont_btn_block")), b = doc.byId("row" + a++)
        },
        find: function(a, b) {
            for (var c = a[ELBT]("DIV"), d = [], e = 0; e < c.length; e++) c[e].className.indexOf(b) >= 0 && d.push(c[e]);
            return d
        },
        fixRow: function(a) {
            for (var b = null, c = [], d = 0; b = a.pop();) c.push(b), b.style.height = "auto", d = Math.max(d, b.offsetHeight);
            for (; b = c.pop();) b.style.height = d + "px"
        }
    },
    budgetMinMax = {
        validateMinMax: function() {
            return flag = !1, BUYING_BUDGET_MIN_VALUE = 1, BUYING_BUDGET_MAX_VALUE = 99, MONTHLY_BUDGET_MIN_VALUE = 100, MONTHLY_BUDGET_MAX_VALUE = 199, refine_layer_exists = "N", null != doc.byId("refine_layer_exists") && (refine_layer_exists = doc.byId("refine_layer_exists").value), "Y" == refine_layer_exists ? (budget_min_select = "layer_budget_min", budget_max_select = "layer_budget_max", min_max_error_div = "layer_min_max_err") : null != doc.byId("modeL") || null != doc.byId("modeR") || null != doc.byId("modeP") ? (null != doc.byId("modeL") ? doc.byId("modeL")[S] ? (budget_min_select = "rent_budget_min", budget_max_select = "rent_budget_max") : (budget_min_select = "buy_budget_min", budget_max_select = "buy_budget_max") : null == doc.byId("modeR") && null == doc.byId("modeP") || (doc.byId("modeR")[S] || doc.byId("modeP")[S] ? (budget_min_select = "rent_budget_min", budget_max_select = "rent_budget_max") : (budget_min_select = "buy_budget_min", budget_max_select = "buy_budget_max")), min_max_error_div = "min_max_err") : (budget_min_select = "buy_budget_min", budget_max_select = "buy_budget_max", min_max_error_div = "min_max_err"), minIndexElem = doc.byId(budget_min_select), maxIndexElem = doc.byId(budget_max_select), minIndex = null != minIndexElem ? minIndexElem.value : 0, maxIndex = null != maxIndexElem ? maxIndexElem.value : 0, null != maxIndexElem && (maxIndexElem.disabled = !1), null != minIndexElem && (minIndexElem.disabled = !1), parseInt(minIndex) == BUYING_BUDGET_MIN_VALUE || parseInt(minIndex) == BUYING_BUDGET_MAX_VALUE || parseInt(minIndex) == MONTHLY_BUDGET_MIN_VALUE || parseInt(minIndex) == MONTHLY_BUDGET_MAX_VALUE ? (flag = !0, null != maxIndexElem && (maxIndexElem.value = 0, maxIndexElem.disabled = !0)) : parseInt(maxIndex) == BUYING_BUDGET_MIN_VALUE || parseInt(maxIndex) == BUYING_BUDGET_MAX_VALUE || parseInt(maxIndex) == MONTHLY_BUDGET_MIN_VALUE || parseInt(maxIndex) == MONTHLY_BUDGET_MAX_VALUE ? (flag = !0, null != minIndexElem && (minIndexElem.value = 0, minIndexElem.disabled = !0)) : (parseInt(maxIndex) > parseInt(minIndex) || 0 == parseInt(maxIndex)) && (flag = !0), void 0 == doc.byId(min_max_error_div) || (flag ? (doc.byId(min_max_error_div).style.display = "none", !0) : (doc.byId(min_max_error_div).style.display = "block", !1))
        },
        changeMinMaxPostReqSrc: function(a) {
            void 0 != doc.byId("min_max_PostReqSrc") && (doc.byId("min_max_PostReqSrc").value = a)
        },
        getLabel: function(a) {
            var b, c;
            if (min = "min" in a ? a.min : 0, max = "max" in a ? a.max : 0, min == max && (max = 0), b = Math.round(min / 1e7 * 100) / 100, c = Math.round(max / 1e7 * 100) / 100, !empty(min) || !empty(max)) {
                if (empty(min) || empty(max)) return empty(min) ? this.getPriceString(max) : this.getPriceString(min);
                if (b >= 1 && c >= 1) return b + " to " + c + " Cr";
                if (b <= 1 && c >= 1) return (b = Math.round(min / 1e5 * 100) / 100) >= 1 ? b + " Lac to " + c + " Cr" : (b = Math.round(min / 1e3 * 100) / 100, b >= 1 ? min + " to " + c + " Cr" : this.getPriceString(min) + " to " + this.getPriceString(max));
                if (!(b <= 1 && c <= 1)) return this.getPriceString(min) + " to " + this.getPriceString(max);
                if (b = Math.round(min / 1e5 * 100) / 100, c = Math.round(max / 1e5 * 100) / 100, b >= 1 && c >= 1) return b + " to " + c + " Lac";
                if (b <= 1) return c >= 1 ? min + " to " + c + " Lac" : this.getPriceString(min) + " to " + this.getPriceString(max)
            }
        },
        getPriceString: function(a) {
            var b, c, d = this.getNumZeroes(a);
            return d < 4 ? b = a : d >= 4 && d <= 5 ? (c = parseInt(a) / 1e3, c = c.toFixed(2), b = c + " K") : d >= 6 && d <= 7 ? (c = parseInt(a) / 1e5, c = c.toFixed(2), b = c + " Lac") : (c = parseInt(a) / 1e7, c = c.toFixed(2), b = c + " Cr"), b
        },
        getNumZeroes: function(a) {
            a = parseInt(a, 10);
            var b = 0;
            if (isNaN(a)) return b;
            do {
                b++, a = Math.floor(a / 10)
            } while (0 !== a);
            return b
        }
    },
    hackSlider = !0;
layers.doRegister = function(a, b) {
    if (jsval.vf(b)) {
        var c = b.name;
        if (c && void 0 != c) {
            var d = new Object;
            b.username && (d.username = b.username.value), b.password && (d.password = b.password.value), b.mobileno && (d.mobileno = b.mobileno.value), doc[ELBI]("loadingImage" + c) && (doc[ELBI]("loadingImage" + c)[IH] = "<img src=" + IMG_BASE_URL + "/images/99loaderDesktop.gif>")
        }
        return "shortlistReg" != c || (d.src = "register_login", ajax.postForm({
            url: "",
            params: d,
            thisfrm: b
        }, layers.postRegisterLogin), jsevt.stopEvt(a))
    }
    return jsval.inlineErrs(b), jsevt.stopEvt(a)
}, layers.postRegisterLogin = function(a) {
    "undefined" != $("#loginregisterlayer") && ($("#loginregisterlayer").find(".body").html(""), $("#loginregisterlayer").find(".body").html(a)), $("#sl_login").length <= 0 && (window.location = "")
}, layers.doLogin = function(a, b) {
    if (jsval.vf(b)) {
        var c = b.name;
        if (c && void 0 != c) {
            var d = new Object;
            b.username && (d.username = b.username.value), b.password && (d.password = b.password.value), doc[ELBI]("loadingImage" + c) && (doc[ELBI]("loadingImage" + c)[IH] = "<img src=" + IMG_BASE_URL + "/images/99loaderDesktop.gif>")
        }
        if ("sendEmailLoginForm" == c) {
            var e = doc.byId("sendLayer");
            e.target = b.target.value, ajax.postForm({
                url: "",
                ctx: e,
                thisfrm: b
            }, alerts.postLogin, hdr.onRcvLyrErr)
        } else if ("signInForm" == c) {
            var f = pg["l-login"];
            f.actionOnSuccess = f.action, level1 = doc.byId("level1").value, ajax.getText({
                url: "" + level1,
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else if ("signInFromHeader" == c) toglTxtOnBtn("Logging In...", "submit_query1"), ajax.getText({
            url: "",
            ctx: f,
            params: d
        }, layers.onRcvLogin);
        else if ("ViewPhoneNumber" == c) {
            var f = pg["l-viewphno"];
            f.actionOnSuccess = f.action, ajax.getText({
                url: "",
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else if ("signInBOSForm" == c) {
            var f = pg["l-loginbos"];
            f.actionOnSuccess = f.action, ajax.getText({
                url: "",
                ctx: f,
                params: d
            }, pg.onRcv, pg.onRcvErr)
        } else {
            if ("forgotpwd" != c && "forgotpwdfromHeader" != c) return !0;
            d.identifier = b.identifier.value, "forgotpwd" == c && ajax.getText({
                url: "",
                ctx: b,
                params: d
            }, pg.onRcv_data, pg.onRcvErr), "forgotpwdfromHeader" == c && (toglTxtOnBtn("Retrieving...", "submit_query1"), ajax.getText({
                url: "",
                ctx: b,
                params: d
            }, layers.onRcv_dataonHeader))
        }
        return jsevt.stopEvt(a)
    }
    return jsval.inlineErrs(b), jsevt.stopEvt(a)
}, layers.onLogin = function(a) {
    var b = a.user.class;
    if (shortlist.syncAsset(), "U" == b) {
        if (window.location.href.indexOf("advertiseproperty") > -1) location.reload();
        else if ($("#registration_layer").html("You have successfully logged in!"), lhdr.updateHdr(a.user.name, b), $("#sl_login").length > 0) return void location.reload()
    } else if (0 != $("#boostListingPage").length) {
        var c = getCookie("PROPLOGIN");
        if ($.isEmptyObject(c)) window.location.reload(!1);
        else {
            var d = $.isEmptyObject(a) ? "" : a.validationData.PROFILEID;
            if ($("#boostListingProfileId").val() != d || $.isEmptyObject(boostListing)) {
                try {
                    _gaq.push(["_trackEvent", "SRP_BOOST", "SRP_BOOST_LOGIN_FAILURE", boostListing.profileId, parseInt(boostListing.profileId)])
                } catch (f) {
                    console.log(f)
                }
                var e = window.location;
                window.location.href = e.protocol + "//" + e.host + "/"
            } else pg.closeModalLayer(), $("#" + boostListing.id).click(), trackEventByGA("SRP_BOOST_LOGIN_SUCCESS", !1, boostListing.profileId, "SRP_BOOST")
        }
    } else if (arr.in_array(["O", "A", "B", "Z"], b)) return pg.closeModalLayer(), arr.in_array(["O", "A", "B"], b) ? window.location = "" : "Z" == b && (window.location = ""), !1
}, layers.onRcv_dataonHeader = function(a) {
    var b = doc.byId("loginLayer");
    return b.style.width = "300px", b[IH] = a, jsevt.stopEvt(evt)
}, layers.onRcvLogin = function(a) {
    var b = doc.byId("loginLayer");
    if (b.style.width = "300px", -1 == a.indexOf("@@")) return "undefined" != b ? (doc.byId("lgndiv")[IH] = a, jsevt.stopEvt(event)) : jsevt.stopEvt(event);
    var c = a.split("@@"),
        d = c[2];
    if (hdr.hideLoggedOutDiv(), $("#sl_login").length > 0) {
        var e = c[1];
        return trackClickAction("LOGIN", e, "SHORTLISTBUBBLE", document.URL), pg.closeModalLayer(), void shortlist.redirectToViewShortlist(e)
    }
    if ("U" == d)
        if (window.location.href.indexOf("advertiseproperty") > -1) location.reload();
        else {
            var a = "You have successfully logged in!";
            b[IH] = a, lhdr.updateHdr(c[0], d)
        }
    else if (arr.in_array(["O", "A", "B", "Z"], d)) {
        if (void 0 == c[6]) return pg.closeModalLayer(), arr.in_array(["O", "A", "B"], d) ? window.location = "" : "Z" == d && (window.location = ""), jsevt.stopEvt(event);
        var a = c[5];
        b[IH] = a
    }
}, layers.onRcvLoginErr = function(a) {
    return !0
};
var alerts = {
        postLogin: function(a) {
            if ("_blank" == this.target) {
                var b = a.split(":");
                pg.closeEmailSMSLayer(), pg.closeModalLayer(), jsui.hideCurLyr(), self.location = b[0], lhdr.updateHdr(b[1], b[2], b[3])
            } else top.location = a
        }
    },
    hdr = {
        currentTab: "rent",
        changeCssAndDefaultText: function(a, b) {
            var c = doc.byId("keyword");
            null != c && (c.value == GA(c, "placeholder") && "C" == b ? (doc.byId(a.id).value = "", doc.byId(a.id).setAttribute("class", "f12")) : "" == doc.byId(a.id).value && "B" == b && (jsval.isPlaceHolderSup() || (c.value = GA(c, "placeholder")), c.setAttribute("class", c.className + " f12 grey")))
        },
        hideLoggedOutDiv: function() {
            var a = doc.byId("loggedOutDiv");
            a && (a.style.visibility = "hidden", a.style.display = "none")
        },
        chBudDD: function() {
            doc.byId("modeS").checked || doc.byId("modeS")[S] ? (jsval.clearerr(doc.byId("rent_budget_min")), jsval.clearerr(doc.byId("rent_budget_max")), jsui.hide(doc.byId("rent_budget_min")), jsui.show(doc.byId("buy_budget_min"), "block"), jsui.hide(doc.byId("rent_budget_max")), jsui.show(doc.byId("buy_budget_max"), "block"), jsui.hide(doc.byId("rent_budget_to")), jsui.show(doc.byId("buy_budget_to"), "block"), doc.byId("rent_budget_min")[D] = !0, doc.byId("buy_budget_min")[D] = !1, doc.byId("rent_budget_max")[D] = !0, doc.byId("buy_budget_max")[D] = !1, doc.byId("rent_budget_to")[D] = !0, doc.byId("buy_budget_to")[D] = !1) : (jsval.clearerr(doc.byId("buy_budget_min")), jsval.clearerr(doc.byId("buy_budget_max")), jsui.hide(doc.byId("buy_budget_min")), jsui.show(doc.byId("rent_budget_min"), "block"), jsui.hide(doc.byId("buy_budget_max")), jsui.show(doc.byId("rent_budget_max"), "block"), jsui.hide(doc.byId("buy_budget_to")), jsui.show(doc.byId("rent_budget_to"), "block"), doc.byId("rent_budget_min")[D] = !1, doc.byId("buy_budget_min")[D] = !0, doc.byId("rent_budget_max")[D] = !1, doc.byId("buy_budget_max")[D] = !0, doc.byId("rent_budget_to")[D] = !1,
                doc.byId("buy_budget_to")[D] = !0)
        },
        showL4Lyr: function(a, b) {
            closeAllPrevious();
            var c, d = doc.byId(b.id);
            return d.lyr || (doc.byId("genlayer" + b.id) && doc.byId("genlayer" + b.id).parentNode.removeChild(doc.byId("genlayer" + b.id)), d.lyr = hdr.createL4Lyr(b.ttl, b.size, b.cls, b.nodnarr), d.lyr.id = "genlayer" + b.id, b.html && (d.lyr[CHN][1][IH] = b.html), jsui.dropShadow(d.lyr, b.shOf, "#fff", 0, "Y"), d.lyr.shadow = layers.sizeShadow), !d.lyr.gotData || b.reload ? b.dataUrl && (d.lyr[CHN][1][IH] = "" == b.ttl ? ldImgFrHdr() : LOADING_HTML, "" == b.ttl && topLogin(), ajax.getText({
                url: b.dataUrl,
                ctx: d.lyr,
                params: b.params ? b.params : userActionParams
            }, hdr.onRcvLyr, hdr.onRcvLyrErr)) : (b.off && env.moz && (b.off[0] += -6), b.size && b.size.h1 && (d.lyr.style.height = b.size.h1)), c = void 0 !== b.off_pos ? b.off_pos : ["lb", "lt"], jsui.showAt(d.lyr, d, c, b.off), jsui.showL(d.lyr), d.lyr.shadow(), jsevt.stopEvt(a), d.lyr
        },
        onIntClick: function(a) {
            hdr.showL4Lyr(a, {
                id: "cityI",
                ttl: "<span class='dnarr b'>International </span>",
                nodnarr: !0,
                size: {
                    w: 185
                },
                shOf: {
                    l: 3,
                    t: 3
                },
                off: [-85, 4],
                cls: "l4ilyr",
                dataUrl: ""
            })
        },
        onL4SDClick: function(a) {},
        onL4PRClick: function(a) {},
        createL4Lyr: function(a, b, c, d, e) {
            cname = "" == a ? "l4lyr" : "srplayer " + (c || "l4lyr");
            var f = F_CR("DIV", {
                className: cname
            }, {
                backgroundColor: "#ccc",
                position: "absolute",
                zIndex: 11007
            });
            return e ? F_APP(f, e) : js.dom.add(f), b && (f.style.width = b.w ? b.w + "px" : "auto", f.size = b), f[IH] = "<div class ='ttltabshw' onclick='jsui.hide(this.parentNode)'><div class='ttltab'><nobr>" + a + "</nobr></div></div><div class='body' id='lgndiv' style='height:" + (b.h ? b.h - 6 + "px" : "96%") + ";z-index:10;zoom:1;min-width:282px;'></div>", f
        },
        RcvLData: function(a) {
            var b = doc.byId("loginLayer");
            return b.style.width = "300px", b[IH] = a, jsevt.stopEvt(evt)
        },
        createL4LyrLeft: function(a, b, c, d, e, f) {
            var g = F_CR("DIV", {
                className: "srplayer " + (c || "l4lyr")
            }, {
                backgroundColor: "#ccc",
                position: "absolute",
                zIndex: 1
            });
            return e ? F_APP(g, e) : js.dom.add(g), b && (g.style.width = b.w ? b.w + "px" : "auto", g.size = b), g[IH] = "<div class ='ttltablshw' style=\"margin-left:" + f + "px;\" onclick='jsui.hide(this.parentNode)'><div class='ttltab'><nobr>" + a + "</nobr></div></div><div class='body' style='height:" + (b.h ? b.h - 6 + "px" : "96%") + ";z-index:10;zoom:1;'></div>", g
        },
        onRcvLyr: function(txt) {
            var t = this;
            if (t.gotData = !0, usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = vpnEoi.registrationEOIHandler, usrMgr.onSuccessVerificationFunction = !1, usrMgr.postVerificationFunction = vpnEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = vpnEoi.loginEOIHandler, void 0 != t.actionOnSuccess) {
                var actionName = t.actionOnSuccess,
                    functionName = actionName + '("' + escape(txt) + '")';
                eval(functionName)
            } else if (void 0 == t.actionOnSuccess) {
                try {
                    if (txt = eval("(" + txt + ")"), txt.showCaptcha) {
                        t[CHN][1][IH] = "";
                        var captchaKey = txt.captchaKey,
                            ctx = t[CHN][1];
                        "true" == txt.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptcha(ctx, captchaKey)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptcha(ctx, captchaKey))
                    } else usrMgr.layerHtml = t[CHN][1], usrMgr.actionOrder = txt.actionOrder, usrMgr.processUser(txt)
                } catch (err) {
                    removeQueryLayer(), t[CHN][1][IH] = txt, $(".body").find("#modifyBtnId").length > 0 && $(".body").find("div[id*='identity_help']").remove(), 1 == onLoginClick && topLogin()
                }
                t.style.minWidth = "265px", t.size && t.size.h1 && (t[CHN][1].style.height = t.size.h1), t.size && t.size.w1 && (t.style.width = t.size.w1);
                var offset = $(window.parent).height() - $(t).height(),
                    header = $("#Header-Wrap"),
                    iframeOffset = 0;
                if (0 == header.length) {
                    header = $("#Header-Wrap", parent.document);
                    var iframe = $(".scroll_iframe_for_eoi", parent.document);
                    iframe.length > 0 && (iframeOffset = iframe.offset().top)
                }
                header.length > 0 && header.offset().top + header.height() < $(t).offset().top + iframeOffset - offset && scrollToElement(t, 500, iframeOffset - offset, parent.document), jsui.showL(t), 1 != onLoginClick && jsui.size(t.bg, t), env.ie && jsui.incBy(t.bg, {
                    l: 5,
                    t: 5
                })
            }
            pg.setUpLayer(t), 1 != onLoginClick && this.shadow(), jsval.init(), eoiMgr.checkIfBlocker();
            try {
                1 != onLoginClick && t.focus()
            } catch (ex) {}
            1 == onLoginClick && (onLoginClick = !1), loginUnsticky()
        },
        onRcvLyrErr: function(a, b) {
            this[CHN][1][IH] = b
        },
        showSwitchToMobile: function() {
            "1" == getCookieVal("fullsite") && $("body").prepend("<a href='/' id='switchToMobile' onclick=\"setCookieExp('fullsite','','-1','/');\">SWITCH TO MOBILE SITE</a>")
        }
    },
    areahdr = {
        set_area: function(a, b, c, d) {
            if ("area_src" == d) {
                document[ELBN]("area_unit").item(1).value = b
            } else doc.byId("area_unit").value = b;
            return doc.byId(d).value = c, jsui.hideCurLyr(), jsevt.stopEvt(a)
        },
        showarealayer: function(a, b) {
            hdr.showL4Lyr(a, {
                id: b,
                ttl: "<span class='dnarr b'>Sq.Ft.</span>",
                nodnarr: !0,
                size: {
                    w: 90
                },
                shOf: {
                    l: 3,
                    t: 3
                },
                off: [0, 7],
                cls: "",
                dataUrl: "" + b
            })
        }
    },
    ct = {
        onFocusEvent: function(a) {
            ("area_min" == a.name && "Min" == a.value || "area_max" == a.name && "Max" == a.value) && (a.value = "")
        },
        onBlurEvent: function(a) {
            "area_min" == a.name && "" == a.value ? a.value = "Min" : "area_max" == a.name && "" == a.value && (a.value = "Max")
        }
    },
    Homepage = {
        TabSelectorHp: function(a) {
            $(".tabs").each(function() {
                $(this).removeClass("sel")
            }), $("#" + a).addClass("sel")
        },
        hideCityErr: function() {
            $cityerr = $(".citysserr"), $cityerr.is(":visible") && $cityerr.hide()
        },
        hideFPPGBM: function() {
            if ($("#lcol").hide(), $(".rcol").hide(), $("#scroll_on_check").hide(), $("#city_fp_box").hide(), $("#fpHomePage").hide(), $(".fpContainFilter").hide(), $(".mt30").hide(), $("#fp_filter_label").hide(), $("#fp_layers_data").hide(), $banner = document.getElementById("Shoshkele-Pane"), $banner && "DIV" == $banner.nodeName && $("#Shoshkele-Pane").hide(), $("#pkb-wrapper").hide(), 0 !== $("#anaContentRent").length && 0 === $("#anaContentRent").html().length) {
                var a = $("#srchhdr_selCityAtHeader").val();
                $.ajax({
                    type: "POST",
                    data: {
                        tab: "rent",
                        cityCode: a
                    },
                    url: "",
                    success: function(a) {
                        $("#anaContentRent").html(a)
                    },
                    cache: !1
                }).done(function() {
                    0 === $("#anaContentRent").html().length && $(".questionsHead").hide()
                })
            }
            $("#anaContent").hide(), $("#anaContentRent").show();
            var b, c = $("#BG_Banner");
            4 == $("#selected_tab").val() && (b = "rent");
            var d = 0;
            "complete" === document.readyState && (d = 1);
            var e = window.screen.width > 1366 ? c.attr("data-big-url") : c.attr("data-small-url");
            1 !== d && (4 == $("#selected_tab").val() ? (rentbgurl = e, rentbid = $("#BG_Banner").attr("data-bid"), rentbt = $("#BG_Banner").attr("data-bt"), rentsmallUrl = $("#BG_Banner").attr("data-small-url"), rentbigUrl = $("#BG_Banner").attr("data-big-url")) : genericbgurl = e), "undefined" == typeof rentbgurl ? $.ajax({
                type: "GET",
                url: "",
                data: {
                    pid: $("#srchhdr_selCityAtHeader").val(),
                    rc: c.attr("data-rc"),
                    tab: b
                },
                success: function(a) {
                    if ("null" !== a.trim()) {
                        a = JSON.parse(a);
                        var b = a[Math.floor(Math.random() * a.length)];
                        rentbg = b, rentbgurl = window.screen.width > 1366 ? b.BIG_BG_IMAGE_URL : b.BG_IMAGE_URL, c.css({
                            "background-image": "url(" + rentbgurl + ")",
                            "background-position": "50% 0%",
                            "background-repeat": "no-repeat",
                            "background-size": "cover"
                        }), "undefined" != typeof rentbg && ($("#BG_Banner").attr("data-bid", rentbg.BANNER_ID), $("#BG_Banner").attr("data-bt", rentbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", rentbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", rentbg.BIG_BG_IMAGE_URL)), $("#BG_Banner").attr("data-bid", rentbg.BANNER_ID)
                    }
                }
            }) : (c.css({
                "background-image": "url(" + rentbgurl + ")",
                "background-position": "50% 0%",
                "background-repeat": "no-repeat",
                "background-size": "cover"
            }), "undefined" != typeof rentbg && ($("#BG_Banner").attr("data-bid", rentbg.BANNER_ID), $("#BG_Banner").attr("data-bt", rentbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", rentbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", rentbg.BIG_BG_IMAGE_URL)), "undefined" != typeof rentbid && ($("#BG_Banner").attr("data-bid", rentbid), $("#BG_Banner").attr("data-bt", rentbt), $("#BG_Banner").attr("data-small-url", rentsmallUrl), $("#BG_Banner").attr("data-big-url", rentbigUrl))), $("#Shoshkele-Pane").hide()
        },
        showFPPGBM: function() {
            $("#lcol").show(), $(".rcol").show(), $("#scroll_on_check").show(), $("#city_fp_box").show(), $("#fpHomePage").show(), $(".fpContainFilter").show(), $(".mt30").show(), $("#fp_filter_label").show(), $("#fp_layers_data").show(), $banner = document.getElementById("Shoshkele-Pane"), $banner && "DIV" == $banner.nodeName && $("#Shoshkele-Pane").show(), $("#pkb-wrapper").show(), $("#anaContent").show(), $(".questionsHead").show(), $("#anaContentRent").hide();
            var a = $("#BG_Banner"),
                b = 0;
            "complete" === document.readyState && (b = 1);
            var c = window.screen.width > 1366 ? a.attr("data-big-url") : a.attr("data-small-url");
            1 !== b && (4 == $("#selected_tab").val() ? rentbgurl = c : (genericbgurl = c, genericbid = $("#BG_Banner").attr("data-bid"), genericbt = $("#BG_Banner").attr("data-bt"), genericsmallUrl = $("#BG_Banner").attr("data-small-url"), genericbigUrl = $("#BG_Banner").attr("data-big-url"))), "undefined" == typeof genericbgurl ? $.ajax({
                type: "GET",
                url: "",
                data: {
                    pid: $("#srchhdr_selCityAtHeader").val(),
                    rc: a.attr("data-rc"),
                    tab: "notRent"
                },
                success: function(b) {
                    if ("null" !== b.trim()) {
                        b = JSON.parse(b);
                        var c = b[Math.floor(Math.random() * b.length)];
                        genericbg = c, genericbgurl = window.screen.width > 1366 ? c.BIG_BG_IMAGE_URL : c.BG_IMAGE_URL, a.css({
                            "background-image": "url(" + genericbgurl + ")",
                            "background-position": "50% 0%",
                            "background-repeat": "no-repeat",
                            "background-size": "cover"
                        }), $("#BG_Banner").attr("data-bid", genericbg.BANNER_ID), $("#BG_Banner").attr("data-bt", genericbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", genericbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", genericbg.BIG_BG_IMAGE_URL);
                        var d, e, f;
                        if (d = getCookieVal("99zedoParameters"), e = JSON.parse(d).preference, f = JSON.parse(d).rescom, "D" == c.BANNER_TYPE && "RENT" == e && "RES" == f) {
                            $("#Shoshkele-Pane").remove();
                            var g = '<a id="Shoshkele-Pane" style="filter:alpha(opacity=0);opacity:0" href="" target="_blank" class="clickTrackBG" data-track-args="' + genericbg.BANNER_ID + ',L"></a>';
                            $("#BG_Banner").append(g), $("#Shoshkele-Pane").attr("href", c.LANDING_URL)
                        }
                    }
                }
            }) : (a.css({
                "background-image": "url(" + genericbgurl + ")",
                "background-position": "50% 0%",
                "background-repeat": "no-repeat",
                "background-size": "cover"
            }), "undefined" != typeof genericbg && ($("#BG_Banner").attr("data-bid", genericbg.BANNER_ID), $("#BG_Banner").attr("data-bt", genericbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", genericbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", genericbg.BIG_BG_IMAGE_URL)), "undefined" != typeof genericbid && ($("#BG_Banner").attr("data-bid", genericbid), $("#BG_Banner").attr("data-bt", genericbt), $("#BG_Banner").attr("data-small-url", genericsmallUrl), $("#BG_Banner").attr("data-big-url", genericbigUrl))), $("#Shoshkele-Pane").show()
        },
        showRentCards: function() {
            if (0 !== $("#rent_cards").length && 0 === $("#rent_cards").html().length) {
                var a = $("#srchhdr_selCityAtHeader").val();
                $.ajax({
                    data: {
                        platform: "desktop"
                    },
                    url: "" + a,
                    success: function(b) {
                        b.length > 1 && trackEventByGA("RC_DISPLAY", !1, "RC_DISPLAY_" + a, "RC_DISPLAY"), $("#rent_cards").html(b)
                    },
                    cache: !1
                })
            }
            $(".__slider-container").hide(), $("#rent_cards").show(), $("#hp_footer_bnr").hide(), $(".scrollNextWrap").hide()
        },
        hideRentCards: function() {
            $("#rent_cards").hide(), $(".__slider-container").show(), $("#hp_footer_bnr").hide(), $(".scrollNextWrap").show()
        }
    },
    userActionParams = {
        lstAcn: "",
        lstAcnId: ""
    },
    preventCopy = {
        spanEl: null
    },
    googleConversion = {
        accounts: {
            locality_query_conversion: {
                google_conversion_id: 1060794886,
                google_conversion_label: "OtnbCJ7X1gIQhuTp-QM"
            },
            brand_query_conversion: {
                google_conversion_id: 1068840799,
                google_conversion_label: "-e5oCPXYpwQQ3-7U_QM"
            },
            content_query_conversion: {
                google_conversion_id: 1040511042,
                google_conversion_label: "FZx1CMLtpQQQwuCT8AM"
            },
            projects_query_conversion: {
                google_conversion_id: 1038116673,
                google_conversion_label: "OhoeCLOxtgQQwc6B7wM"
            }
        },
        doAction: function(a) {
            var b = (typeof a).toUpperCase();
            try {
                if ("STRING" == b) return this.callGoogle(a), !0;
                for (var c in this.accountTypes) this.callGoogle(c)
            } catch (d) {}
        },
        callGoogle: function(a) {
            google_conversion_id = this.accounts[a].google_conversion_id, google_conversion_label = this.accounts[a].google_conversion_label, google_conversion_language = this.accounts[a].google_conversion_language ? this.accounts[a].google_conversion_language : "en", google_conversion_color = this.accounts[a].google_conversion_color ? this.accounts[a].google_conversion_color : "ffffff", google_conversion_format = this.accounts[a].google_conversion_format ? this.accounts[a].google_conversion_format : 2, google_conversion_value = this.accounts[a].google_conversion_value ? this.accounts[a].google_conversion_value : 0, includeExternalJs("//www.googleadservices.com/pagead/conversion.js")
        }
    },
    pkb = {
        initialized: !1,
        lastScrlTop: 0,
        absTop: 0,
        fixTop: 0,
        id: "",
        pg: "",
        initialize: function(a) {
            this.id = a == this.getPageAttribute() ? "peek-in-banner" : "peek-in-ros-banner", this.loadBannerDiv(), zedo.loadZedoBanner(this.id, a), this.pg = a
        },
        loadBannerDiv: function() {
            if (pref = "", zedoParameters = getCookieVal("99zedoParameters"), "undefined" != typeof zedoParameters && null !== zedoParameters) {
                for (zedoParameters = zedoParameters.split(","), i = 0; i < zedoParameters.length; i++) zedoParameters[i].indexOf("preference") > -1 && (zpref = zedoParameters[i].split(":"), zedo_pref = zpref[1]);
                zedo_pref = zedo_pref.replace(/"/g, ""), "RENT" == zedo_pref && (pref = "style='display:none'")
            }
            pkbWrapper = "<div id='pkb-wrapper' " + pref + "  ><div id='" + this.id + "' class='rel'><i id='peek-in-close' class='iconS bBg-cross abs'></i></div></div>", $(pkbWrapper).appendTo("body")
        },
        displayBanner: function() {
            "Logout" == this.pg ? this._displayBannerOnLoad() : $(window).scroll(function() {
                pkb._displayBannerOnScroll($(window))
            }), $("#pkb-wrapper iframe").css("border", 0)
        },
        _displayBannerOnScroll: function(a) {
            var b, c = "peek-in-banner" != this.id ? a.height() : $(".homemain, .citymain").offset().top - 10,
                d = a.scrollTop(),
                e = $("#pkb-wrapper"),
                f = isPortraitDisplay() ? 1 : 1 * c - 20;
            pkb.fixTop = c / 2, pkb.absTop = isPortraitDisplay() ? 1 * c - 20 + pkb.fixTop : f + pkb.fixTop, !pkb.initialized && d >= f ? (e.css({
                top: pkb.fixTop,
                position: "fixed"
            }), pkb._animateBanner(), pkb.initialized = !0) : pkb.initialized && (b = e.css("position"), isPortraitDisplay() ? e.css({
                top: pkb.fixTop,
                position: "fixed"
            }) : f < d && "absolute" == b ? e.css({
                top: pkb.fixTop,
                position: "fixed"
            }) : f >= d && "fixed" == b && e.css({
                top: pkb.absTop,
                position: "absolute"
            })), pkb.showHidePeekIn()
        },
        _animateBanner: function() {
            var a = $("#pkb-wrapper");
            a.animate({
                opacity: "1",
                right: "0px"
            }, "slow", function(b) {
                $("#peek-in-close").css({
                    display: "block",
                    position: "absolute",
                    right: "0px",
                    top: "0px"
                }).click(function(b) {
                    return a.remove(), !1
                })
            })
        },
        showHidePeekIn: function() {
            st = qsSrp.getST(), rc = qsSrp.getRC(), pr = qsSrp.getPref(), pt = qsSrp.getPT(), "PROPERTY" == st && "S" != pr && "C" != pt ? $("#pkb-wrapper").hide() : $("#pkb-wrapper").show()
        },
        getPageAttribute: function() {
            var a = "",
                b = void 0 !== qsSrp ? qsSrp.getRC() : "";
            if ("undefined" != typeof currentPageName && "R" == b) switch (currentPageName) {
                case "Home":
                    a = "homepage";
                    break;
                case "NRI":
                    a = "nripage";
                    break;
                default:
                    a = "citypage"
            } else "C" == b && (a = "commercialpage");
            return a
        },
        _displayBannerOnLoad: function() {
            var a = $(window).height(),
                b = $("#pkb-wrapper"),
                c = a / 2 + 30;
            b.css({
                top: c,
                position: "fixed"
            }), pkb._animateBanner(), pkb.showHidePeekIn()
        }
    };
$(function() {
    vid = getCookieVal("GOOGLE_SEARCH_ID"), "" == getStorageValue(vid + "_sync_prop") && setStorageValue(vid + "_sync_prop", "false", "7"), "" == getStorageValue(vid + "_sync_np") && setStorageValue(vid + "_sync_np", "false", "7"), shortlist.syncAsset();
    var a = getStorageValue(vid + "sl_count");
    shortlist.setShortlistCount(a, "")
}), vid = getCookieVal("GOOGLE_SEARCH_ID");
var shortlist = {
        isIpad: !1,
        redirectToViewShortlist: function(a) {
            shortlist.syncAsset(a)
        },
        refreshShortlistCount: function(a, b) {
            var c = a;
            c = parseInt(c), shortlist.setShortlistCount(c, b)
        },
        getShortlistCount: function() {
            $.ajax({
                type: "GET",
                url: "",
                cache: !1,
                success: function(a) {
                    a = parseInt(a), -1 == a ? console.log("Shortlist Count Fetch Logical error") : shortlist.setShortlistCount(a, "")
                }
            })
        },
        insertShortlist: function(a) {
            vid = getCookieVal("GOOGLE_SEARCH_ID");
            var b = a.split("_"),
                c = b[0],
                d = b[1];
            "true" != getStorageValue(vid + "_sync_" + c) || shortlist.checkLogin() || setStorageValue(vid + "_sync_" + c, "false", "7"), 1 != $("#xidPages").length && 1 != $(".fullbg-SRP").length && 1 != $("#HeaderStickyHandler").length || $(".notify_wrpr").removeClass("clicked");
            var e = "",
                f = "";
            if ("undefined" != typeof currentPageName) var g = clickStream.doClickStreamMappingOfPages(currentPageName);
            else var g = clickStream.doClickStreamMappingOfPages();
            if ("prop" == c) e = "id=" + d, f = "";
            else if ("np" == c) {
                var h = b[2];
                $("#" + a).attr("proj_name");
                e = "id=" + d + "&res_com=" + h, f = ""
            }
            e += "&pageName=" + g, $.ajax({
                type: "GET",
                url: f,
                data: e,
                cache: !1,
                success: function(a) {
                    if ("" != a || "NaN" != a) {
                        if (shortlist.refreshShortlistCount(a, "Added to Shortlist"), "np" == c) {
                            var b = {
                                xid: h + d,
                                propId: 0
                            };
                            notify_dashboard.initNotificationData("SHORTLIST", b, "NP")
                        }
                    } else window.location.href = window.location.href;
                    return a
                }
            })
        },
        removeShortlistTuple: function(a) {
            var b = a.split("_")[1],
                c = $("#slwrap_" + b);
            c.animate({
                opacity: 0
            }, "3000", function() {
                c.remove(), window.location.href = window.location.href, "" == $(".sl_count").html() && $("#noslmsg").css("display", "block")
            })
        },
        refreshPage: function() {
            var a = document.getElementsByTagName("body")[0].scrollTop;
            window.location.href = window.location.href.split("?")[0] + "?page_y=" + a
        },
        removeShortlistFromBox: function(a) {
            var b = $(a).attr("id");
            shortlist.removeShortlist(b), shortlist.removeShortlistTuple(b)
        },
        removeShortlist: function(a) {
            vid = getCookieVal("GOOGLE_SEARCH_ID");
            var b = a.split("_"),
                c = b[0],
                d = b[1];
            "true" != getStorageValue(vid + "_sync_" + c) || shortlist.checkLogin() || setStorageValue(vid + "_sync_" + c, "false", "7");
            var e = "",
                f = "";
            if (1 != $("#xidPages").length && 1 != $(".fullbg-SRP").length && 1 != $("#HeaderStickyHandler").length || $(".notify_wrpr").removeClass("clicked"), "undefined" != typeof currentPageName) var g = clickStream.doClickStreamMappingOfPages(currentPageName);
            else var g = clickStream.doClickStreamMappingOfPages();
            if ("prop" == c) e = "id=" + d, f = "";
            else if ("np" == c) {
                var h = b[2];
                $("#" + a).attr("proj_name");
                e = "id=" + d + "&res_com=" + h, f = ""
            }
            e += "&pageName=" + g, $.ajax({
                type: "GET",
                url: f,
                data: e,
                cache: !1,
                success: function(a) {
                    if ("" != a || "NaN" != a) {
                        if (shortlist.refreshShortlistCount(a, "Removed from Shortlist"), "np" == c) {
                            var b = {
                                xid: h + d,
                                propId: 0
                            };
                            notify_dashboard.updateNotificationLayer("SHORTLIST", b, "NP")
                        }
                    } else window.location.href = window.location.href, console.log("SERVER IS NOT RESPONDING");
                    return a
                }
            })
        },
        syncAsset: function(a) {
            vid = getCookieVal("GOOGLE_SEARCH_ID");
            var b = getStorageValue(vid + "_sync_prop"),
                c = getStorageValue(vid + "_sync_np"),
                d = 0;
            if ("" != b && "" != c || (d = 1), "" == b || "" == c || "false" == b && (shortlist.checkLogin() || null != a) || "false" == c && (shortlist.checkLogin() || null != a)) {
                var e = "syncProp=" + b + "&syncProj=" + c + "&forceSync=" + d;
                $.ajax({
                    type: "GET",
                    url: "",
                    data: e,
                    async: !1,
                    success: function(d) {
                        if (-1 != d) {
                            if (1 == d ? setStorageValue(vid + "_sync_prop", "true", "7") : 2 == d ? setStorageValue(vid + "_sync_np", "true", "7") : 3 == d && (setStorageValue(vid + "_sync_prop", "true", "7"), setStorageValue(vid + "_sync_np", "true", "7")), null != a) {
                                if (window.location.href = "/shortlisted-properties", env.ie) return !1;
                                js.stopEvt(event)
                            }
                        } else "false" == b && setStorageValue(vid + "_sync_prop", "true", "7"), "false" == c && setStorageValue(vid + "_sync_np", "true", "7"), null != a && (setStorageValue(vid + "_sync_prop", "true", "7"), setStorageValue(vid + "_sync_np", "true", "7"), window.location.href = "/shortlisted-properties")
                    }
                })
            } else if (null != a) {
                if (window.location.href = "/shortlisted-properties", env.ie) return !1;
                js.stopEvt(event)
            }
        },
        slAction: function(a, b, c, d) {
            var e = $(a),
                f = (e.attr("class"), 0),
                g = e.closest(".srpWrap").attr("data-tupletype"),
                h = "srpnew" == g ? e.attr("id") : e.parent().attr("id");
            d = void 0 === d ? 0 : 1;
            var i, j, k = {
                0: {
                    title: "Remove from shortlist",
                    spanclass: "sl_star_container",
                    iclass: "lf uiIcon sl_star",
                    sltext: "Shortlisted"
                },
                1: {
                    title: "Shortlist this property",
                    spanclass: "sl_star_empty_container",
                    iclass: "lf uiIcon sl_star_empty",
                    sltext: "Shortlist"
                }
            };
            if ($(e).hasClass("sl_star_empty_container")) shortlist.insertShortlist(h), shortlist.trackAction("SHORTLIST", b, c), d && ("srpnew" == g ? shortlist.newSrptupletoggleStar(a, k[0]) : shortlist.toggleStar(a, k[0])), f = 1, "PROPDETVIEW_APR_16" != b && "PROPDETVIEW_STICKY" != b && "PROPDETVIEW" != b || (i = {
                xid: 0,
                propId: c
            }, j = "PLDPAGE" == currentPageName ? "PSEUDO" : "PD", notify_dashboard.initNotificationData("SHORTLIST", i, j)), "SRP" != b && "LADProfile_properties" != b && "MAPPROPCARD" != b && "MAP_PROPINFOBOX" != b && "ZRP" != b && "XIDLISTING" != b && "DEALER" != b && "MAPINFOCARD" != b && "VSP_SRP" != b && "VSP" != b && "listing rank" != b || (i = {
                xid: 0,
                propId: c
            }, notify_dashboard.initNotificationData("SHORTLIST", i, "SRP"));
            else if ($(e).hasClass("sl_star_container")) {
                if ("SL" == $("#pageid").val()) {
                    var l = $("#removeSLBox").html();
                    "np" == h.split("_")[0] && (l = l.replace("property", "project")), l += "<center><a class='removeSLbutton yellowSubmit' onclick='shortlist.removeShortlistFromBox(" + h + ");pg.closeModalLayer();jsevt.stopBubble(event);' style='float:none;width:50px;' href='javascript:void(0);'>Remove </a></center>", pg.openModalLayer({
                        id: "slremovelayer",
                        reload: !0,
                        ttl: "Remove From Shortlist",
                        size: {
                            w: 478,
                            h: 100,
                            h1: "auto"
                        },
                        html: l
                    }, "noDefHead")
                } else shortlist.removeShortlist(h), shortlist.trackAction("RSHORTLIST", b, c), f = 1;
                d && ("srpnew" == g ? shortlist.newSrptupletoggleStar(a, k[1]) : shortlist.toggleStar(a, k[1])), "PROPDETVIEW_APR_16" != b && "PROPDETVIEW_STICKY" != b && "PROPDETVIEW" != b || (i = {
                    xid: 0,
                    propId: c
                }, j = "PLDPAGE" == currentPageName ? "PSEUDO" : "PD", notify_dashboard.updateNotificationLayer("SHORTLIST", i, j)), "SRP" != b && "LADProfile_properties" != b && "MAPPROPCARD" != b && "MAP_PROPINFOBOX" != b && "ZRP" != b && "XIDLISTING" != b && "DEALER" != b && "MAPINFOCARD" != b && "VSP" != b && "VSP_SRP" != b && "listing rank" != b || (i = {
                    xid: 0,
                    propId: c
                }, notify_dashboard.updateNotificationLayer("SHORTLIST", i, "SRP"))
            }
            1 != f || d || (e.hide(), e.siblings().show())
        },
        setShortlistCount: function(a, b) {
            setStorageValue(vid + "sl_count", a, "7"), this.slAnimate(b);
            try {
                null !== parent.top.$(".sl_count") && parent.top.$(".sl_count").html("Shortlist"), 0 == a || isNaN(a) ? (null !== parent.top.$(".sl_count_as") && parent.top.$(".sl_count_as").html("Shortlist"), null !== parent.top.$(".sl_count_as.circ") && parent.top.$(".sl_count_as.circ").css("display", "none")) : (null !== parent.top.$(".sl_count_as") && parent.top.$(".sl_count_as").html(a), null !== parent.top.$(".sl_count_as.circ") && parent.top.$(".sl_count_as.circ").css("display", "inline"))
            } catch (c) {}
        },
        trackAction: function(a, b, c) {
            "listing rank" == b ? (actionSrc_VAM = _prop_pos[c.substring(1)], actionSrc_GA = "Property Search") : (actionSrc_VAM = b, actionSrc_GA = b), null != c && (trackClickAction(a, c.substring(1), actionSrc_VAM, document.URL), trackEventByGA(actionSrc_GA, !1, c.substring(1), a))
        },
        slPaging: function(a) {
            var b = parseInt($("#page").val());
            "nxt" == a ? b = ++b : "pre" == a && "1" != b && (b = --b), $("#page").val(b), slPageForm.submit()
        },
        closeThankYouLayerAction: function() {
            var a = window.location.href,
                b = /logout\/out/,
                c = /shortlisted/,
                d = $("#sl_ty_lyr #profileid").val();
            trackClickAction("REGISTER", d, "SHORTLISTBUBBLE", document.URL), b.test(a) ? window.location.href = "/" : c.test(a) ? shortlist.syncAsset(d) : window.location.href = window.location.href
        },
        checkLogin: function() {
            var a = getCookieVal("PROPLOGIN");
            return null != a && "0" != a
        },
        slAnimate: function(a) {
            var b = $("#shListTTPID i"),
                c = $("#_shrtlst_txt");
            b.length && (b.addClass("pulseMe"), "" != a && c.text(a).show(), setTimeout(function() {
                b.removeClass("pulseMe")
            }, 150), setTimeout(function() {
                c.hide()
            }, 1500))
        },
        toggleStar: function(a, b) {
            var c = $(a);
            c.attr("title", b.title), c.attr("class", b.spanclass), c.children("i").attr("class", b.iclass), void 0 !== c.children("span") && c.children("span").html(b.sltext)
        },
        newSrptupletoggleStar: function(a, b) {
            var c = $(a);
            c.attr("title", b.title), c.attr("class", b.spanclass + " " + b.iclass + " " + ("sl_star_container" == b.spanclass ? "srp_shrtlst sl_container" : "sl_container"))
        }
    },
    loginLib = {
        showLoginLayer: function() {
            pg.openModalLayer({
                id: "login_layer",
                ttl: "Login to 99acres",
                size: {
                    w: "auto",
                    h: "auto",
                    h1: "auto"
                },
                reload: !0,
                dataUrl: ""
            })
        },
        doLogin: function(evt, frm) {
            if (!jsval.vf(frm)) return jsval.inlineErrs(frm), jsevt.stopEvt(evt);
            var logWaitLoaderHtml = '<div id="logWaitLoaderHtml" class="r5 b f13" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: 0px 2px 10px 2px rgb(204, 204, 204); padding: 10px; top: 120px; position: absolute; z-index: 1001; left: 70%;"><img width="50px" height="48px" src="' + IMG_BASE_URL + '/images/99loaderDesktop.gif" id="prop_ldr" class="lf"> <span class="rf mt16"> &nbsp;&nbsp; Loggin.. </span></div>';
            $("#login_visibility").after(logWaitLoaderHtml), $("#login_visibility").parent().css({
                opacity: .5
            });
            var postData = $(frm).serializeArray();
            $.ajax({
                type: "POST",
                url: "",
                data: postData
            }).done(function(txt) {
                $("#logWaitLoaderHtml").remove(), $("#login_visibility").parent().css({
                    opacity: 1
                });
                var txt = eval("(" + txt + ")");
                if ("success" == txt.status) void 0 != $("#loggedIn") && $("#loggedIn").val("1"), isUserLoggedIn = 1, usrMgr.updateUserStatus(txt), usrDtl.init(txt.user), loginLib.updateLoginHeader(txt.user), 0 != usrMgr.onSuccessLoginFunction && (usrMgr.onSuccessLoginFunction ? usrMgr.onSuccessLoginFunction(txt) : usrMgr.onSuccessLogin(txt)), 0 != usrMgr.postLoginFunction && (usrMgr.postLoginFunction ? usrMgr.postLoginFunction(txt) : usrMgr.postLogin(txt));
                else if ($(frm).find("#login_layer_error").show(), $("#boostListingProfileId").length > 0 && !$.isEmptyObject(boostListing)) try {
                    _gaq.push(["_trackEvent", "SRP_BOOST", "SRP_BOOST_LOGIN_FAILURE", boostListing.profileId, parseInt(boostListing.profileId)])
                } catch (e) {
                    console.log(e)
                }
            })
        },
        changePassword: function(frm) {
            var postData = $(frm).serializeArray();
            $.ajax({
                type: "POST",
                url: "",
                data: postData
            }).done(function(txt) {
                var txt = eval("(" + txt + ")");
                if ("success" == txt.status) {
                    var thankyouHtml = '<ul class="bList rList lyR"><li class="b f16 vp10"></li><li><div class="okBox"><em class="uiIcon lf msgIcn"></em><div class="msgBox lf"><span class="green1 f14">Thank You, Your password was changed successfully.</span></div><div class="clr pdt10"></div></div></li><li class="clr"></li><li class="textC"><input type="submit" onclick="jsui.hideCurLyr();lhdr.updateHdr(&quot;ksdja ksjd&quot;,&quot;O&quot;,&quot;P&quot;);return jsevt.stopEvt(event);" value="Close" class="yellowSubmit f16 r5 b"></li><div class="clr mt10 pdt5"></div></ul>';
                    $("#frmprt").html(thankyouHtml)
                } else {
                    $(".serverError").remove();
                    var errorHtml = '<div class="inlineErr serverError" style="position: relative; margin-top: 1px; display: block;"><span class="red f12">' + txt.error + "</span></div>";
                    $('input[name="password"]').siblings(".inlineErr").remove(), $('input[name="password"]').after(errorHtml)
                }
            })
        },
        openForgotPasswdL1Lyr: function(a) {
            a.preventDefault ? a.preventDefault() : a.returnValue = !1, url = "", ajax.getText({
                url: url
            }, loginLib.RcvLData), !currentPageName || "XID_DETAIL_PAGE" != currentPageName && "Property Description" != currentPageName && "dif_landing_page" != currentPageName || ($("#upBanner").is(":visible") ? $("#genlayerloginHeader").css({
                left: "954px",
                top: "131px"
            }) : $("#genlayerloginHeader").css({
                left: "954px",
                top: "56px"
            }), $("#loginLayer").css({
                position: "",
                top: "0px"
            }))
        },
        RcvLData: function(a) {
            return $("#login_div_html").empty(), $("#login_div_html").html(a), jsevt.stopEvt(evt)
        },
        afterloginUser: function(a) {},
        updateLoginHeader: function(a) {
            if (void 0 != getCookieVal("PROPLOGIN")) try {
                lhdr.updateHdr(a.name, a.class, "P")
            } catch (b) {
                alert(b)
            }
            0 != $("#register_login_layer").length && $("#register_login_layer").show()
        }
    },
    registrationLib = {
        extraFieldDiv: null,
        showRegistrationLoginLayer: function(a, b) {
            if (0 != $("#registration_layer").length) {
                $("#registration_layer").remove();
                try {
                    qsDrpDwn.initiated = !1
                } catch (e) {
                    alert("qsdrpdwn error")
                }
            }
            var c = "Register for a FREE 99acres Account",
                d = "0";
            void 0 != b.titleMsg && (c = b.titleMsg), void 0 != b.skipFirstLayer && 1 == b.skipFirstLayer && (d = "1");
            pg.openModalLayer({
                id: "register_login_layer",
                ttl: c,
                position: "fixed",
                size: {
                    w: "950",
                    h: "auto"
                },
                reload: !0,
                dataUrl: "" + b.src + "&skipLayer=" + d,
                cbk: registrationLib.setUpRegLayer
            })
        },
        showRegistrationLoginLayerInLine: function(a, b) {
            0 != $("#registration_layer").length && $("#registration_layer").remove(), $.ajax({
                type: "POST",
                url: "" + b.src
            }).done(function(b) {
                if (b) {
                    usrMgr.bindHtml("RL", a, b)
                }
            })
        },
        showRegistrationLayer: function() {
            pg.openModalLayer({
                id: "register_layer",
                ttl: "Register for a FREE 99acres Account",
                size: {
                    w: "auto",
                    h: "auto",
                    h1: "auto"
                },
                reload: !0,
                dataUrl: ""
            })
        },
        displayRegistrationForm: function(a) {
            $(a).hide(), $("#profile_form").removeClass("hid"), 0 != $("#registration_layer").closest("#get_alert").length && ($("#login_visibility").hide(), $("#registration_div_html").parent().attr("style", "")), $(a).parent().remove()
        },
        registerZUser: function(a) {
            usrMgr.postRegistrationFunction = postZClassRegistration, usrMgr.postVerificationFunction = onSuccessZclassThankyouLayer, registrationLib.registerUser(a)
        },
        registerUser: function(form) {
            registrationLib.beforeRegAjaxCall(form), usrMgr.modifyButtonFunction = registrationLib.modifyRegistrationHandler;
            var postData = $(form).serializeArray(),
                action = "";
            void 0 != $(form).attr("action") && (action = $(form).attr("action")), $.ajax({
                type: "POST",
                url: action,
                data: postData
            }).done(function(txt) {
                registrationLib.afterRegAjaxResponse();
                var txt = eval("(" + txt + ")");
                "success" == txt.status ? (txt.validationData.VENDOR = "valueFirst,Knowlarity", void 0 != $("#loggedIn") && $("#loggedIn").val("1"), isUserLoggedIn = 1, usrDtl.init(txt.user), usrMgr.updateUserStatus(txt), loginLib.updateLoginHeader(txt.user), 0 != usrMgr.onSuccessRegistrationFunction && (usrMgr.onSuccessRegistrationFunction ? usrMgr.onSuccessRegistrationFunction(txt) : usrMgr.onSuccessRegistration(txt)), 0 != usrMgr.postRegistrationFunction && (usrMgr.postRegistrationFunction ? usrMgr.postRegistrationFunction(txt) : usrMgr.postRegistration(txt))) : registrationErrorLib.showRegistrationErrors(txt.error)
            })
        },
        beforeRegAjaxCall: function(a) {
            $(a).find("input").each(function(a, b) {
                b = $(b), b.attr("placeholder") && b.val(b.val() == b.attr("placeholder") ? "" : b.val())
            });
            var b = '<div id="regWaitLoaderHtml" class="r5 b f13" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: 0px 2px 10px 2px rgb(204, 204, 204); padding: 10px; top: 120px; position: absolute; z-index: 1001; left: 100px;"><img width="50px" height="48px" src="' + IMG_BASE_URL + '/images/99loaderDesktop.gif" id="prop_ldr" class="lf"> <span class="rf mt16"> &nbsp;&nbsp; Registration is on its way...  </span></div>';
            $("#registration_layer").after(b), $("#registration_layer").css({
                opacity: .5
            }), 0 != $("#RegButtonId").length && $("#RegButtonId").attr("disabled", "disabled"), 0 != $("#submitform1").length && $("#submitform1").attr("disabled", "disabled")
        },
        afterRegAjaxResponse: function() {
            $("#regWaitLoaderHtml").remove(), $("#registration_layer").css({
                opacity: 1
            }), 0 != $("#RegButtonId").length && $("#RegButtonId").removeAttr("disabled"), 0 != $("#submitform1").length && $("#submitform1").removeAttr("disabled")
        },
        onClassToggle: function(a, b) {
            $(a).siblings(".checked").removeClass("checked"), $(a).addClass("checked"), $(a).siblings("#" + b).click(), "radio_owner" != b ? (1 == $("#registration_extra_fields").is(":empty") && $("#registration_extra_fields").html(registrationLib.extraFieldDiv), $("#registration_extra_fields").show(), $("#login_visibility").hide()) : ($("#registration_extra_fields").hide(), $("#login_visibility").css("display", "inline"))
        },
        setUpTabIndex: function(a) {
            var b = 1;
            a.find("input,a.dropDown").each(function() {
                if ("hidden" != this.type) {
                    $(this).attr("tabindex", b), b++
                }
            })
        },
        setUpRegLayer: function(a) {
            var b = a ? js.dom.findAll(a, ["SCRIPT"]) : pg.curMLyr[ELBT]("SCRIPT");
            for (var c in b)
                if (window.eval(b[c][IH]), !empty(b[c].src)) {
                    var d = doc.createElement("script");
                    d.type = "text/javascript", d.src = b[c].src, doc[ELBT]("head")[0].appendChild(d)
                } 0 != $("#register_login_layer") && (jsui.center($("#register_login_layer").get(0)),
                jsui.center($("#register_login_layer").get(0)), "1" == $("#skipFirstLayer").val() && $("#RegisterButton").trigger("click"))
        },
        onPrimaryToggle: function(a) {
            $(".primaryNum").removeClass("checked"), $(a).addClass("checked")
        },
        addMobile: function() {
            "none" == doc.byId("mobileDiv1").style.display ? doc.byId("mobileDiv1").style.display = "" : "none" == doc.byId("mobileDiv2").style.display ? doc.byId("mobileDiv2").style.display = "" : "none" == doc.byId("mobileDiv3").style.display && (doc.byId("mobileDiv3").style.display = "", doc.byId("addM").style.display = "none")
        },
        addLL: function() {
            "none" == doc.byId("landlineDiv1").style.display ? doc.byId("landlineDiv1").style.display = "" : "none" == doc.byId("landlineDiv2").style.display && (doc.byId("landlineDiv2").style.display = "", doc.byId("addL").style.display = "none")
        },
        preprocessFormOnSubmit: function() {
            "O" == $("input[name='Class']:checked").val() && 0 != $("#registration_extra_fields").children().length && (registrationLib.extraFieldDiv = $("#registration_extra_fields").html(), $("#registration_extra_fields").empty())
        },
        modifyRegistrationHandler: function(a, b) {
            "Z" == usrMgr.registrationSource || "ANA" == usrMgr.registrationSource ? window.location.href = window.location.origin + "" : "BOS" == usrMgr.registrationSource && (window.location.href = window.location.origin + ""), usrMgr.modifyButtonFunction = null, usrMgr.registrationSource = null
        }
    },
    registrationErrorLib = {
        registrationSource: "",
        showRegistrationErrors: function(a) {
            $(".serverError").remove();
            for (var b in a) {
                var c = '<div class="inlineErr serverError" style="position: relative; margin-top: 1px; display: block;"><span class="red f12">' + a[b] + "</span></div>";
                $('input[name="Email"]').siblings(".inlineErr").remove(), $('input[name="' + b + '"]').after(c)
            }
            $("#RegButtonId") && $("#RegButtonId").attr("disabled", !1)
        }
    },
    localityElementBox, ls = {
        res_com: "R",
        project: "Y",
        mapsearch: 0,
        execLocality: function(a) {
            localityElementBox = doc.byId(a), localityElementBox && localityElementBox.value != GA(localityElementBox, "placeholder") && (localityElementBox.value = "", hdr.changeCssAndDefaultText(localityElementBox, "B")), ls.showLocalityInSearchSingleCall(a)
        },
        showLocalityInSearch: function(a) {
            localityElementBox = doc.byId(a);
            var b = ls.res_com;
            if (b = empty(b) ? "R" : b, !(doc.byId("city") && doc.byId("city").value > 0)) return !0;
            var c = doc.byId("city").value.trim(),
                d = "";
            d = d + "?q=" + c + "&res_com=" + b, ajax.getText({
                url: d,
                method: "GET"
            }, ls.getSubCities, ls.failure)
        },
        showLocalityInAlert: function(a, b, c) {
            localityElementBox = doc.byId(b), ls.project = c || "N";
            var d = "";
            d = d + "?q=" + a, void 0 !== a && ajax.getText({
                url: d,
                method: "GET"
            }, ls.getSubCities, ls.failure)
        },
        getSubCities: function(a) {
            var b = ls.res_com;
            b = empty(b) ? "R" : b;
            var c = a.replace(/,$/, "");
            if (void 0 !== c) {
                if ("Y" == ls.project) {
                    var d = "";
                    d = d + "?q=" + c + "&res_com=" + b
                } else {
                    var d = "";
                    d = d + "?q=" + c
                }
                1 == ls.mapsearch && (d += "&mapsearch=1"), d = d.split(" ").join(""), ajax.getText({
                    url: d,
                    method: "GET"
                }, ls.getLocalitiesAndBuildSearchData, ls.failure)
            }
        },
        getLocalities: function(a) {
            "@@@@@@" != a.trim() && (suggestionList = a.split("@@"), localityArray = suggestionList[0].split("|"), buildingArray = suggestionList[1].split("|"), idArray = suggestionList[2].split("|")), "undefined" == typeof Suggester99 && new autoComplete(localityArray, localityElementBox, doc.byId("locality_scroll_onSearch"), buildingArray, idArray)
        },
        showLocalityInSearchSingleCall: function(a) {
            localityElementBox = doc.byId(a);
            var b = ls.res_com;
            if (b = empty(b) ? "R" : b, !(doc.byId("city") && doc.byId("city").value > 0)) return !0;
            var c = doc.byId("city").value.trim(),
                d = "";
            d = d + "?q=" + c + "&res_com=" + b, 1 == ls.mapsearch && (d += "&mapsearch=1"), ajax.getText({
                url: d,
                method: "GET"
            }, ls.getLocalitiesAndBuildSearchData, ls.failure)
        },
        showLocalityInCustomSuggestion: function(a) {
            localityElementBox = doc.byId(a);
            var b = ls.res_com;
            if (b = empty(b) ? "R" : b, !(doc.byId("city") && doc.byId("city").value > 0)) return !0;
            var c = doc.byId("city").value.trim(),
                d = "";
            d = d + "?q=" + c + "&res_com=" + b, ajax.getText({
                url: d
            }, ls.getLocalitiesAndBuildSearchDataInCustom, ls.failure)
        },
        getLocalitiesAndBuildSearchDataInCustom: function(a) {
            void 0 != searchUtil && (searchUtil.buildSearchLocalitiesData(a), global_locality_ajax_flag_check = !0)
        },
        getLocalitiesAndBuildSearchData: function(a) {
            void 0 != searchUtil && (searchUtil.buildSearchLocalitiesData(a), "PROJECT" == qsSrp.search_type && ls.getLocalities(a), void 0 != SHOWCUSTOMSUGGESTOR && SHOWCUSTOMSUGGESTOR ? ($("#np_tab").attr("class").indexOf("qsSel") >= 0 && ls.getLocalities(a), void 0 != $("#commr_buy").attr("class") && $("#commr_buy").attr("class").indexOf("on") >= 0 && $("#nponly").is(":checked") && ls.getLocalities(a), void 0 != $("#buy").attr("class") && $("#buy").attr("class").indexOf("on") >= 0 && $("#nponly").is(":checked") && ls.getLocalities(a)) : ls.getLocalities(a))
        },
        failure: function(a, b) {
            this[IH] = b
        }
    };
pg.signInFunction = function(a) {
    if (-1 != a.indexOf("@@")) var b = a.split("@@"),
        c = unescape(b[0]),
        d = (b[1], b[2]),
        e = b[3];
    else var c = unescape(a);
    var f = document.location.href;
    for (len = blockUrl.length, i = 0; i < len; i++) match = f.match(blockUrl[i]), null != match && "1";
    if ("undefined" != typeof seller && !se.sellerLogin || "undefined" != typeof buyerForm && buyerForm.buyerLogin) return jsui.bg.greyOut(), window.location.reload(!0), !1;
    "undefined" != typeof seller && se.sellerLogin && (jsui.bg.greyOut(), contact.doRefresh()), hdr.hideLoggedOutDiv(), doc.byId("loggedIn").value = 1, "U" == d ? (pg.closeModalLayer(), alert("You have successfully logged in."), lhdr.updateHdr(c, d, "")) : arr.in_array(["O", "A", "B"], d) && "1" == e ? window.location = "" : "Z" == d && "1" == e ? window.location = "" : pg.closeModalLayer(), doc.byId("markBox") && srp.refreshMarkBox()
}, pg.sellerlogin = function(a) {
    pg.openModalLayer({
        id: "login",
        ttl: "Sign in",
        size: {
            w: 680,
            h: 175,
            h1: "auto"
        },
        dataUrl: "",
        action: "pg.signInFunction"
    });
    return jsevt.stopEvt(a)
}, pg.loginregister = function(a, b) {
    closeAllLayersOnHtmlClk(a);
    var c = "?frmsrc=" + b;
    pg.openModalLayer({
        id: "loginregisterlayer",
        ttl: "Login or Register",
        reload: !0,
        cache: !1,
        bkg: "hide",
        cbk: pg.setUpLayer,
        bkgOpac: .75,
        bkgColour: "#FFFFFF",
        position: "fixed",
        size: {
            w: 800,
            h: 175,
            h1: "auto"
        },
        dataUrl: "" + c,
        action: "pg.signInFunction"
    }, "noDefHead");
    return jsevt.stopEvt(a)
}, pg.login = function(a, b, c) {
    var d = "pg.signInFunction",
        e = "";
    if ("level1" == b) {
        d = "pg.signInFunction";
        var e = "?frmsrc=" + b
    } else isset(b) && "my99" == b ? (d = "pg.redirecttomy99", e = "?frmsrc=" + b) : isset(b) && "postingForm" == b ? se.sellerLogin = !0 : isset(b) && "Buyer" == b && (buyerForm.buyerLogin = !0);
    pg.openModalLayer({
        id: "login",
        ttl: "Sign in to My99acres",
        size: {
            w: 680,
            h: 175,
            h1: "auto"
        },
        dataUrl: "" + e,
        action: d
    }, c);
    return jsevt.stopEvt(a)
}, pg.redirecttomy99 = function(a) {
    return window.location = "", !1
}, pg.redirectToLogin = function(a) {
    return pg.login(a, "my99", "noDefHead")
}, pg.showImageLayer = function(a, b, c, d, e, f) {
    var g = doc.byId("status" + c);
    c == d ? b = b.replace("&disable=N", "&disable=F") : c == e && (b = b.replace("&disable=N", "&disable=L")), b = "Approve" == g.value ? b.replace("&status=Y", "&status=N") : b.replace("&status=N", "&status=Y");
    pg.openModalLayer({
        id: "photo",
        ttl: "Photo View Window",
        size: {
            w: 580,
            h: 330,
            h1: "auto"
        },
        dataUrl: b,
        reload: !0,
        cf: "refreshSearchPage()"
    }, f);
    return jsevt.stopEvt(a)
}, pg.register = function(a) {
    return window.location = "", !1
}, pg.isLoggedIn = function() {
    return !(!parseFloat(doc.byId("loggedIn").value) && !usrMgr.loginStatus)
}, pg.userClass = function() {
    var a = doc.byId("loggedUserClass").value;
    return arr.in_array(["Z", "U"], a) ? (userClass = a, !0) : void 0 != usrDtl.userClass && (userClass = usrDtl.userClass, "Z" == userClass || "U" == userClass)
}, pg.checkPreRequisiteForUpdationLayer = function(a, b) {
    return buyserv.contactUpdated ? 2 : !!pg.isLoggedIn() && (pg.userClass() ? (pg.openUpdateContactDetailsForm(a, b), 1) : 2)
}, pg.openUpdateContactDetailsForm = function(a, b) {
    return pg.openModalLayer({
        id: "typeUserLayer",
        ttl: "Update Contact Details. You can Later Edit them from my99acres.",
        reload: !0,
        size: {
            w: 970,
            h: "auto",
            h1: "auto"
        },
        dataUrl: "",
        cbk: pg.setUpLayer
    }, "noDefHead"), !0
}, pg.loginBuyOurServiceNew = function(evt, noHead) {
    var updateStatus = pg.checkPreRequisiteForUpdationLayer(evt, noHead);
    if (1 == updateStatus) return jsevt.stopEvt(evt);
    if (2 == updateStatus && (usrMgr.verificationStatus || !usrMgr.verificationSwitch)) return !0;
    if (null == evt.target) try {
        usrMgr.callerIdentity = evt.srcElement
    } catch (ex) {} else usrMgr.callerIdentity = evt.target;
    $.ajax({
        type: "POST",
        url: ""
    }).done(function(txt) {
        var data = eval("(" + txt + ")");
        usrMgr.callerAction = "submit", usrMgr.updateUserStatus(data), data.src = "BOS", usrMgr.initiate("", data), !usrMgr.loginStatus || !usrMgr.verificationStatus && usrMgr.verificationSwitch || usrMgr.onCompletion()
    })
}, pg.layerPHmore = function(a, b, c, d) {
    var e = "" + b + "&city=" + c;
    pg.openModalLayer({
        id: "login",
        reload: !0,
        ttl: d + "-Property Headline",
        size: {
            w: 680,
            h: 175,
            h1: "auto"
        },
        dataUrl: e
    });
    return jsevt.stopEvt(a)
}, pg.forgotpwd = function(a, b) {
    pg.openModalLayer({
        id: "fpp",
        reload: !0,
        ttl: "Forgot Password",
        size: {
            w: 350,
            h: 140,
            h1: "auto"
        },
        dataUrl: "",
        bkg: "greyOut",
        closeOnEscape: !0
    }, "noDefHead");
    return jsevt.stopEvt(a)
}, pg.forgotPasswdOption = function(a) {
    if (a) {
        for (var b = new Array("email", "username"), c = 0; c < 2; c++) doc[ELBI](b[c] + "Text").style.display = "none", doc[ELBI](b[c] + "fp").disabled = !0;
        doc[ELBI](b[a - 1] + "Text").style.display = "", doc[ELBI](b[a - 1] + "fp").disabled = !1
    }
}, pg.showESLyr = function(a, b) {
    closeAllPrevious();
    var c = pg.esdiv;
    if (void 0 == a.lalign && (a.lalign = "N"), void 0 == a.lshow && (a.lshow = "N"), "N" == a.lalign && "N" == a.lshow ? (c = pg.esdiv = hdr.createL4Lyr(a.ttl, a.size, a.cls, a.nodnarr), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow) : "y" == a.lshow && "N" == a.lalign && ((c = pg.esdivlshow) || (c = pg.esdivlshow = hdr.createL4Lyr(a.ttl, a.size, a.cls, a.nodnarr), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow)), "X" == a.lalign && ((c = pg.esdivl) || (c = pg.esdivl = hdr.createL4LyrLeft(a.ttl, a.size, a.cls, a.nodnarr, "", a.m_left), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow)), "Y" == a.lalign && ((c = pg.esdivy) || (c = pg.esdivy = hdr.createL4LyrLeft(a.ttl, a.size, a.cls, a.nodnarr, "", a.m_left), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow)), "R" == a.lalign && ((c = pg.esdivr) || (c = pg.esdivr = hdr.createL4LyrLeft(a.ttl, a.size, a.cls, a.nodnarr, "", a.m_left), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow)), "C" == a.lalign && ((c = pg.esdivc) || (c = pg.esdivc = hdr.createL4LyrLeft(a.ttl, a.size, a.cls, a.nodnarr, "", a.m_left), jsui.dropShadow(c, a.shOf, "#fff", 0, "Y"), c.shadow = layers.sizeShadow)), !c.gotData || a.reload) {
        c[CHN][1][IH] = LOADING_HTML;
        var d = {};
        void 0 !== top.from_src && (d.from_src = top.from_src), void 0 !== a.html ? c[CHN][1][IH] = a.html : ajax.getText({
            url: a.dataUrl,
            ctx: c,
            params: d
        }, hdr.onRcvLyr, pg.onRcvEmailSMSLayerErr)
    }
    return jsui.showAt(c, b, ["lb", "lt"], a.off), jsui.showL(c), c.shadow(), void 0 != b.id && "" != b.id && (id1 = b.id, jumpToAnchor("cont_adv_free" + id1)), c
}, pg.openEmailSMSLayer = function(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, x, y, z, A, B) {
    if (document.getElementById("boxContainer")) {
        var C = document.getElementById("boxContainer");
        C.parentNode.removeChild(C)
    }
    void 0 == A && (A = $("#preference").val()), "sid" == e && (e = $("#encrypted_input").attr("value")), void 0 != e && "undefined" != e || (e = _sid), dcpy = "Y" == s ? "Y" : "N", dontCheckIdle();
    var D = "610",
        E = "",
        F = "",
        y = y || {},
        G = void 0 !== y.layer ? y.layer : "inline";
    if (void 0 == o && (o = "N"), "y" == o) var D = "660";
    void 0 != p && "" != p || (p = "N"), "N" == p ? E = [-10, -8] : "R" == p && "y" != o ? (D = "610", E = [-375, -5], F = "-130") : "R" == p && "y" == o ? (E = [-320, -5], F = "-185") : "C" == p && "y" != o ? (D = "610", E = [-270, -5], F = "-235") : "C" == p && "y" == o ? (E = [-270, -5], F = "-235") : "X" == p ? (D = "610", E = [-10, -5], F = "-495") : (D = "610", E = [-380, -8], F = "-115");
    var H;
    if ("QS" == d) H = _getPosition(c);
    else if ("NP" == d) void 0 != w.np_layout ? ("xid_property_layout" != w.np_layout && "npsrp" != w.np_layout || (H = "npsrp"), H = H.toUpperCase()) : isMapSrch() ? (H = msrch.getEvtAcn(), w.np_layout = "npsrp", w.np_layout = "npsrp") : (H = "NPSRP", w.np_layout = "npsrp");
    else if ("LadSrch" == d) H = "DEALER_SEARCH";
    else if ("LADProfile" == d) H = c.substr(0, 1) >= "a" && c.substr(0, 1) <= "z" || c.substr(0, 1) >= "A" && c.substr(0, 1) <= "Z" ? "DEALER" : "DEALER_PROFILE";
    else if ("XIDPAGE" == d) {
        H = "XIDLISTING";
        var I = c.substr(0, 1);
        I >= "A" && I <= "Z" || (d = "NP")
    } else H = "DP" == d ? "PROPDETVIEW" : window.location.href.search("microsite") && "QS_CITY_FSL" != d && "LADProfile_properties" != d ? "MICSITE" : d;
    "PROPDETAILVIEW" == d && (d = "LadSrch", H = "TOP_DEALER_RECOMMENDATION");
    var J = "/load/sendemailsms/showLayer/" + c + "/" + d + "/" + H + "/" + userActionParams.lstAcn + "/" + userActionParams.lstAcnId + "?rc=" + g + "&sid=" + e + "&tFlag=" + t + "&mob=" + h + "&dcpy=" + dcpy + "&cntct=" + encodeURIComponent(i) + "&ownc=" + encodeURIComponent(j) + "&nm=" + encodeURIComponent(k) + "&addrc=" + encodeURIComponent(l) + "&url=" + encodeURIComponent(m) + "&city=" + encodeURIComponent(n) + "&lshow=" + o + "&compnm=" + encodeURIComponent(q) + "&cfrm=" + r + "&lalign=" + p + "&mask=" + x + "&preference=" + A;
    if ("" != v && "undefined" != v && void 0 !== v && (J = J + "&owner_profile_id=" + v), "NP" === d) {
        J += "&actn=MULT";
        var K, L = doc.byId("confIdProfileIdMap_" + g + c);
        L ? (z = z || "N", K = L.value, J = J + "&confIdProfileIdMap=" + K + "&layout_type=L&isOpenConfig=" + z) : J = J + "&from_src=NP" + c
    }
    empty(u) || (J = J + "&matched_xid_id=" + u), null != w.np_layout && (J = J + "&np_layout=" + w.np_layout), "modal" == G && (D = "610");
    var M = "Contact " + j + "<sup class='red b'> FREE</sup>";
    if ("REQUEST_PHOTOS" == B) {
        var M = "Request photos to the " + j;
        D = "auto", J += "&buyer_source=REQUEST_PHOTOS"
    }
    if ("REQUEST_BROCHURE" == B) {
        var M = "Request Brochure";
        D = "auto", J += "&buyer_source=REQUEST_BROCHURE"
    }
    if ("TOP_DEALERS" == B) {
        D = "auto";
        var M = "Contact Dealer";
        J += "&buyer_source=TOP_DEALERS"
    }
    if (isMapSrch()) pg.openModalLayer({
        id: "emailsmslayer_" + c,
        ttl: M,
        reload: !0,
        size: {
            w: 610,
            h: 278,
            h1: "auto"
        },
        dataUrl: J,
        eslyr: !0,
        pgid: d,
        cbk: pg.setUpLayer
    }, "noDefHead", "noCross", !0), msrchIB.modalLayerOpen = !0;
    else if ("modal" == G) {
        pg.openModalLayer({
            id: "emailsmslayer_" + c,
            ttl: M,
            reload: !0,
            size: {
                w: D,
                h: 278,
                h1: "auto"
            },
            dataUrl: J,
            eslyr: !0,
            pgid: d,
            cbk: pg.setUpLayer
        }, "noDefHead", "noCross", !0);
        try {
            jsui.bg.greyOut(.5, "white")
        } catch (N) {}
    } else {
        pg.showESLyr({
            ttl: M,
            cls: "eslyr",
            reload: !0,
            size: {
                w: D,
                h: 278,
                h1: "auto"
            },
            shOf: {
                l: 3,
                t: 3
            },
            dataUrl: J,
            lalign: p,
            lshow: o,
            off: E,
            m_left: F,
            cbk: pg.setUpLayer
        }, b)
    }
    try {
        isMapSrch() && jsui.bg.greyOut(.75, "white")
    } catch (N) {}
    return jsevt.stopEvt(a)
}, pg.onRcvEmailSMSLayerErr = function(a) {
    this[CHN][1][IH] = a + " Error Occurred. Please try again later."
}, pg.closeEmailSMSLayer = function() {
    jsui.hide(pg.esdiv), "" != pg.esdivlshow && jsui.hide(pg.esdivlshow), "" != pg.esdivl && jsui.hide(pg.esdivl), "" != pg.esdivc && jsui.hide(pg.esdivc), "" != pg.esdivy && jsui.hide(pg.esdivy), "" != pg.esdivr && jsui.hide(pg.esdivr), "" != pg.esdivmodal && pg.closeModalLayer()
}, pg.unimpl = function(a) {}, pg.closeVcard = function(a, b) {
    b.vcard && (b.vcard.timer = js.setTimeout(jsui, jsui.hide, 500, b.vcard))
}, pg.openVcard = function(a, b, c, d) {
    void 0 == d && (d = "N");
    var e = b.vcard;
    return "N" == d ? (e || (e = b.vcard = F_CR("DIV", {
        pid: c,
        className: "vcaard srplayer l4olyr"
    }, {}), e[IH] = "<div style='position:relative;width:360px;height:100px;background-color: #FFFFFF;'></div>", js.dom.add(e), jsevt.addListener(e, "mouseover", function() {}), jsevt.addListener(e, "mouseout", pg.closeVcard, b)), jsui.showAt(e, b, 0, [-7, 3])) : "Y" == d && (e = b.vcardlshow, e || (e = b.vcard = F_CR("DIV", {
        pid: c,
        className: "vcaard srplayer l4leftlyr"
    }, {
        position: "absolute",
        width: "360px",
        height: "100px",
        zIndex: 900,
        overflow: "visible"
    }), e[IH] = "<div style='position:relative;width:360px;height:100px;background-color: #FFFFFF;'></div>", js.dom.add(e), jsevt.addListener(e, "mouseover", function() {
        try {
            w.clearTimeout(e.timer)
        } catch (a) {}
    }), jsevt.addListener(e, "mouseout", pg.closeVcard, b)), jsui.showAt(e, b, 0, [-250, 3])), e.isLoaded || (e[FC][IH] = "<table style='height:100%'><tr><td class='b vcardLoading'><img width='50px' height='48px' src='" + IMG_BASE_URL + "><span class='rf mt15'> Loading...</span></td></tr></table>", ajax.getText({
        url: "/load/vcard/fetchVcard/" + c,
        ctx: e
    }, pg.onRcvVcard, pg.onRcvVcardErr)), jsui.showAt(e, b, 0, [-7, 3]), jsui.dropShadow(e, env.ie ? {
        l: 7,
        t: 7,
        skipIE: !0
    } : {
        l: 5,
        t: 5
    }, "#fff", 0, "Y"), jsevt.stopEvt(a)
}, pg.onRcvVcardErr = function(a) {
    this[FC][IH] = a + " Error Occurred. Please try again later."
}, pg.onRcvVcard = function(a) {
    var b = this;
    b.isLoaded = !0;
    try {
        b[FC].style.height = "auto", b.style.height = "auto"
    } catch (c) {}
    b[FC][IH] = a, jsui.size(b.bg, b)
}, pg.create_locality_dropdown = function(a, b, c) {
    var d, e = a.split("|"),
        f = e[0] + "location" + e[2],
        g = "";
    if (c) {
        var h = c.split(",");
        for (d = 0; d < h.length; d++) g += h[d] + "loc"
    }
    ajax.getText({
        url: "" + f + "/" + g
    }, pg.onRcvLocality, pg.onRcvLocalityErr)
}, pg.onRcvLocality = function(a) {
    a && (jsui.showAll(["locality", "locality_scroll"], "block"), doc.byId("locality_scroll")[IH] += a)
}, pg.onRcvLocalityErr = function() {}, pg.chkMsgChars = function(a, b, c) {
    var d = b.value.length;
    d > c && (b.value = b.value.substr(0, c), d = c);
    var e = b;
    for ($(b).parent().siblings("#numCharsLeftPD").text(c - d + " Chars"); e = e.nextSibling;) 1 == e.nodeType && "numCharsLeft" == e.getAttribute("type") && (e[IH] = c - d + " Chars")
}, pg.buyOurServSubmit = function(a) {
    pg.openModalLayer({
        id: "loading",
        reload: !0,
        ttl: "Buy Our Services",
        size: {
            w: 810,
            h1: "auto"
        },
        html: LOADING_HTML
    });
    ajax.postForm({
        url: "",
        ctx: pg.dummy,
        thisfrm: a
    }, pg.onbuyOurServfrm, pg.dummy)
}, pg.onbuyOurServfrm = function() {
    pg.openModalLayer({
        id: "reqconf",
        reload: !0,
        ttl: "Buy Our Services",
        size: {
            w: 810,
            h1: "auto"
        },
        dataUrl: ""
    });
    return jsevt.stopEvt(evt)
}, pg.dummy = function(a) {
    try {
        w.status = a
    } catch (b) {}
}, pg.openSendPropToMobileLayer = function(a, b, c, d, e, f, g, h) {
    null != h && void 0 != h || (h = "R");
    var i = "Get Property Details to my Mobile & Email ID",
        j = e.split(/~/),
        k = "send2mobile",
        l = "" + e + "/" + b + "/" + userActionParams.lstAcn + "/" + userActionParams.lstAcnId + "?sid=" + d + "&sms=" + f + "&tFlag=" + g + "&rc=" + h;
    if ("NP" == b) {
        k += "NP", i = "Get New Project Details to my Mobile & Email ID", e = e.split("~"), e = e[1];
        var m, n, o = doc.byId("confIdProfileIdMap_" + h + e);
        o && (m = o.value, l = l + "&confIdProfileIdMap=" + m, (n = doc.byId("layout_type_" + e)) && (l = l + "&layout_type=" + n.value))
    } else "profile_id" == j[0] && (k += "LAD", i = "Get Dealer's Details to my Mobile & Email ID");
    if (top != window) {
        top.pg.openModalLayer({
            id: k,
            reload: !0,
            ttl: i,
            size: {
                w: 620,
                h: 150,
                h1: "auto"
            },
            cbk: pg.setUpLayer,
            dataUrl: l
        }, "noDefHead")
    } else {
        pg.openModalLayer({
            id: k,
            reload: !0,
            ttl: i,
            size: {
                w: 620,
                h: 150,
                h1: "auto"
            },
            cbk: pg.setUpLayer,
            dataUrl: l
        }, "noDefHead")
    }
    return jsevt.stopEvt(a)
}, pg.onViewPhnoErr = function(a, b) {}, pg.trackGAC2V = function(a, b, c, d) {
    if ("XID_IMAGE_LAYER" == b) return void window.parent._gaq.push(["_trackEvent", "Query", "Query_XIDPhoton", c]);
    if ("PROP_IMAGE_LAYER" == b) return void window.parent._gaq.push(["_trackEvent", "Query", "Query_PropertyPhoton", c]);
    if (catgry = "1" == a ? "ViewContact" : "2" == a ? "SendToMobile" : "Query", getCookie("QryUsrData") || void 0 === d) {
        var e = c.substr(0, 1);
        e >= "A" && e <= "Z" && (c = c.substr(1, c.length)), "XID_CARD_LAYOUT" != b && "XID_PROPERTY_LAYOUT" != b || (b = "XIDSRP"), "listing rank" == b && (b = isMapSrch() ? msrch.getEvtAcn() : "SRP"), "XIDPAGELISTING" == b && (b = "XIDPAGE"), "MAPSEARCH" != b && "MAPSEARCH_NP" != b || (b = msrch.getEvtAcn()), "XIDDETVIEW" == b && (catgry = nnacres.isEmpty(xid99.cnfSlt) ? "QUERYSUBMIT" : xid99.cnfSlt.getGATrackingPrefix() + "QUERYSUBMIT_CONFIG", b = "XIDPAGE", c = xid99.params.RES_COM + xid99.params.PROJ_ID), "XID_SITEVISIT" == b && (catgry = nnacres.isEmpty(xid99.cnfSlt) ? "QUERYSUBMIT" : xid99.cnfSlt.getGATrackingPrefix() + "QUERYSUBMIT_SITEVISIT", b = "XIDPAGE", c = xid99.params.RES_COM + xid99.params.PROJ_ID), "XID_BROCHURE" == b && (catgry = "SUBMIT_BROCHURE", b = "XIDPAGE", c = xid99.params.RES_COM + xid99.params.PROJ_ID), "XIDLISTING" == b && "ViewContact" == catgry && "XID_DETAIL_PAGE" === currentPageName && (catgry = "C2VSUBMIT_LISTINGS", b = "XIDPAGE", c = xid99.params.RES_COM + xid99.params.PROJ_ID), "XIDLISTING" == b && "Query" == catgry && "XID_DETAIL_PAGE" === currentPageName && (catgry = "QUERYSUBMIT_LISTINGS", b = "XIDPAGE", c = xid99.params.RES_COM + xid99.params.PROJ_ID), "XIDPAGE" == b ? captchaFactory.captchaStatus ? captchaFactory.captchaStatus = !1 : xid99.doGATracking(catgry) : trackEventByGA(catgry, b, c, catgry)
    }
}, pg.removeCaptchaLayer = function(a) {
    var b = $("div#" + a);
    if (b) {
        var c = b.find("#body-" + a);
        c.length > 0 && ("" == c.html() || c.find("#captcha_form").length > 0) && (pg.closeModalLayer(), b.remove(), pg["l-" + a] = void 0, pg.curMLyr = void 0)
    }
}, pg.checkHungVpnForm = function(a) {
    var b = doc.byId(a),
        c = b.lyr;
    if (c) {
        var d = $(c).find(".body div form").not("#captcha_form");
        if (d.length > 0) {
            $(c).find("#captcha_form").remove();
            var e = d.find(".yellowSubmit").parent();
            e.siblings("b").remove(), e.show(), e.siblings().show(), d.show()
        }
    }
}, pg.submitForm = function(a, b) {
    try {
        doc.byId(b)[IH] = '<img width="50px" height="48px" src="' + IMG_BASE_URL + '/images/99loaderDesktop.gif">Submitting........ ', setTimeout(function() {
            ajax.postForm(a, pg.onSuccFunc, pg.onFrmErrFunc)
        }, 30)
    } catch (c) {}
}, pg.onSuccFunc = function(txt) {
    var arr = eval("eval(" + txt + ")"),
        pagetype = arr.pgtype,
        spid = arr.spid,
        label = "extendedForm_" + arr.prop_id,
        html = arr.html,
        width, parEl, lblParEl;
    try {
        void 0 !== arr.show_number && "Y" == arr.show_number ? (width = "373", "PROPDETVIEWTR" != arr.trckSrc || doc.byId(label) ? "PROPDETVIEWB" != arr.trckSrc || doc.byId(label) ? "R" == arr.align ? (width = "312", parEl = doc.byId(label)[PN][PN][PN], parEl.id || (parEl = parEl[PN]), parEl.style.width = "323px") : "XIDSLOT" == arr.trckSrc || (width = "405") : label = "extendedForm_bottom_" + arr.prop_id : label = "extendedForm_top_" + arr.prop_id, $("#" + label).parent().parent().width(width).html(html), $("div.shdw").remove()) : $("#" + label).html(html)
    } catch (e) {}
}, pg.onFrmErrFunc = function(a) {}, pg.trackC2Vextend = function(a, b, c) {
    userActionParams.curAcn = a, userActionParams.src = b, userActionParams.curAcnId = c, ajax.getText({
        url: "",
        ctx: this,
        params: userActionParams
    })
}, pg.changeLocHelp = function(a) {
    var b = doc.byId("identity_help_" + a);
    $("#help_" + a).css({
        left: b.offsetLeft + 185,
        top: b.offsetTop + 10
    })
}, pg.valRegFrm = function(a, b, c) {
    return pg.validate(a, b, null, c)
}, pg.closeRefineLayer = function() {
    doc.byId("refine_layer_exists").value = "N", pg.closeModalLayer()
}, pg.showGoogleLayer = function() {
    var a = {
        id: "model",
        lstAcn: userActionParams.lstAcn,
        lstAcnId: userActionParams.lstAcnId
    };
    pg.openModalLayer({
        id: "googleLayer",
        ttl: "Choose the city you are interested in",
        size: {
            w: 450,
            h: 200,
            h1: "auto"
        },
        dataUrl: "",
        params: a,
        action: ""
    }).id = ""
};
var usrDtl = {
        userClass: null,
        name: null,
        email: null,
        init: function(a) {
            for (var b in a) "class" == b ? usrDtl.userClass = a[b] : usrDtl[b] = a[b]
        }
    },
    usrMgr = {
        callerIdentity: null,
        callerAction: null,
        callerSource: null,
        registrationSource: null,
        registrationStatus: !1,
        verificationStatus: !1,
        verificationSwitch: !0,
        loginStatus: !1,
        captchaStatus: !1,
        isInline: !0,
        onRegistrationSuccessmsg: "successfully registered..",
        onVerificationSuccessmsg: "successfully verified...",
        onLoginSuccessmsg: "successfully logged in...",
        postLoginFunction: null,
        postRegistrationFunction: null,
        postVerificationFunction: null,
        onSuccessRegistrationFunction: null,
        onSuccessVerificationFunction: null,
        onSuccessLoginFunction: null,
        onFetchRegistrationFormViewFunction: null,
        onFetchVerificatitonFormViewFunction: null,
        onFetchLoginFormViewFunction: null,
        expireUpdateUserStatus: function() {
            setCookieExp("userstate", "expired", "365")
        },
        getUpdateUserStatus: function() {
            $.ajax({
                type: "POST",
                url: "",
                async: !1
            }).done(function(a) {
                statusArray = $.parseJSON(a), void 0 != statusArray && usrMgr.updateUserStatus(statusArray)
            })
        },
        updateUserStatus: function(a) {
            void 0 != a.verificationSwitch && (usrMgr.verificationSwitch = a.verificationSwitch), void 0 != a.verificationStatus && (usrMgr.verificationStatus = a.verificationStatus), void 0 != a.registerationStatus && (usrMgr.registrationStatus = a.registerationStatus), void 0 != a.loginStatus && (usrMgr.loginStatus = a.loginStatus), setCookieExp("userstate", "valid", "365")
        },
        init: function(a) {
            for (var b in a) usrMgr[b] = a[b];
            "expired" == getCookieVal("userstate") && usrMgr.getUpdateUserStatus()
        },
        initiate: function(a, b) {
            var c = empty(b.source) ? b.src : b.source;
            0 == usrMgr.registrationStatus || 0 == usrMgr.loginStatus ? usrMgr.doRegistrationLogin(a, b) : 0 == usrMgr.verificationSwitch ? usrMgr.onCompletion() : 0 == usrMgr.verificationStatus && usrMgr.doVerification(c, a, b)
        },
        onSuccessRegistration: function(a) {
            if (shortlist.syncAsset(), $("#sl_login").length > 0) return void location.reload()
        },
        postRegistration: function(a) {
            var b = null;
            if (usrMgr.loginStatus && loginLib.updateLoginHeader(a.user), $("#registration_layer").length) var b = $("#registration_layer").parent();
            1 == usrMgr.verificationStatus || 0 == usrMgr.verificationSwitch ? usrMgr.onCompletion() : usrMgr.doVerification(a.validationlayer, b, a.validationData)
        },
        onSuccessVerification: function() {
            if (usrMgr.isInline) {
                $("#verifyLayer").hide(), void 0 != $("#ThankyouBar .msgBox span") ? $("#ThankyouBar .msgBox span").html(usrMgr.onVerificationSuccessmsg) : void 0 != $("#verification_success") && $("#verification_success").show();
                try {
                    "Modify Profile" != currentPageName || void 0 !== $("input[name=screening_id]").val() || getCookie("PSEUDO_LOGIN") || (pg.closeModalLayer(), document.forms.profile_form.submit())
                } catch (a) {}
            } else $("form[id='verifyMobForm']").hide(), $("div[id='verifiedMsg']").show()
        },
        postVerification: function() {
            usrMgr.onCompletion()
        },
        onSuccessLogin: function(a) {
            usrMgr.isInline && ($("#login_div_html").hide(), void 0 != $("#ThankyouBar .msgBox span") && $("#ThankyouBar .msgBox span").html(usrMgr.onLoginSuccessmsg)), loginLib.updateLoginHeader(a.user)
        },
        postLogin: function(a) {
            1 == usrMgr.verificationStatus || 0 == usrMgr.verificationSwitch ? usrMgr.onCompletion() : usrMgr.doVerification(a.validationlayer, "", a.validationData)
        },
        bindHtml: function(a, b, c) {
            switch (a) {
                case "RL":
                    usrMgr.onFetchRegistrationFormViewFunction ? usrMgr.onFetchRegistrationFormViewFunction(c) : b && b.html(c);
                    break;
                case "V":
                    usrMgr.onFetchVerificationFormViewFunction ? usrMgr.onFetchVerificationFormViewFunction(c) : b ? b.html(c) : $("#registration_layer").parent().html(c), 0 != $("#register_login_layer").length && ($("#register_login_layer").width("520"), jsui.center($("#register_login_layer").get(0)));
                    break;
                case "VT":
                    $("#verifyLayer").html(c)
            }
        },
        updateActionStatus: function(a) {
            usrMgr.actionOrder[0] == a && usrMgr.actionOrder.shift()
        },
        doLogin: function(a, b) {
            registrationLib.showRegistrationLoginLayer()
        },
        doRegistrationLogin: function(a, b) {
            1 == usrMgr.registrationStatus && 1 == usrMgr.loginStatus || (a ? registrationLib.showRegistrationLoginLayerInLine(a, b) : (usrMgr.isInline = !1, registrationLib.showRegistrationLoginLayer(a, b)))
        },
        preVerification: function(a) {
            return mobObjMgr.sendForVerification(a)
        },
        doVerification: function(a, b, c) {
            if (0 == usrMgr.verificationSwitch || 1 == usrMgr.verificationStatus) return void usrMgr.onCompletion();
            c.source = a, c.knowlarityNo = usrMgr.preVerification(c), b ? mobObjMgr.showInLayer(a, b, c) : (usrMgr.isInline = !1, mobObjMgr.showInModal(a, b, c))
        },
        showCaptcha: function(a, b) {
            captcha.showcatpcha(layer, b)
        },
        onCompletion: function() {
            void 0 != usrMgr.callerIdentity && null != usrMgr.callerIdentity && usrMgr.callerAction ? $(usrMgr.callerIdentity).trigger(usrMgr.callerAction) : $("#registration_layer").is(":visible") && pg.closeModalLayer()
        }
    },
    MobileVerification = function() {};
MobileVerification.prototype.init = function() {}, MobileVerification.prototype.doVerification = function() {}, MobileVerification.prototype.showInLayer = function() {}, MobileVerification.prototype.showInPage = function() {}, MobileVerification.prototype.doValidation = function() {}, MobileVerification.prototype.afterSkipAction = function() {}, MobileVerification.prototype.performSkipAction = function() {}, MobileVerification.prototype.sendForVerification = function() {}, MobileVerification.prototype.showThankLayer = function() {}, MobileVerification.prototype.sendEmailVerification = function() {}, MobileVerification.prototype.showMissCallStartDiv = function() {}, $.extend(!0, mobileVerificationOTP, MobileVerification), $.extend(!0, mobileVerificationMissCall, MobileVerification), mobileVerificationMissCall.prototype.showMissCallStartDiv = function(a) {
    var b = "2:00";
    $(a).parents("._missCallAlertDiv").length > 0 ? actionEvent = "Missed_Call_Verification" : $(a).parents("._missCallFailedDiv").length > 0 && (actionEvent = "Missed_Call_Verification_Try_Again"), missCallVAMTracking(a, actionEvent), missCallObjMgr.setupInitialMissCallLayer(b);
    var c = {};
    c.profileId = $(a).parents("form").find("#profileId").val(), c.mobile = $(a).parents("form").find("#mobile").val(), $(a).parents("._missCallDiv").find(".missCallStartDiv").show(), $(a).parents("._missCallDiv").find("._missCallAlertDiv").hide(), missCallObjMgr.doVerification(c, a);
    var d, e = 125,
        f = getNumberOfSeconds(b),
        g = f / e;
    currentElement = a;
    var h;
    return progressBarAnim = function() {
        var c = 0;
        d = $.now(), interval = setInterval(function() {
            return c++, currentTime = $.now(), timeDiff = currentTime - d, counter = timeDiff / 125, h = $(currentElement).parents("form").find("._clockForMissCall").text(), h = missCallObjMgr.getUpdatedTime(timeDiff, f), f <= timeDiff ? (FailedMissCallhandler(a), void clearInterval(interval)) : counter >= g || $(currentElement).parents("#verifyMobForm").parents(":hidden").length > 0 || "block" != $(currentElement).parents("._missCallDiv").find(".missCallStartDiv").css("display") ? (clearInterval(interval), void missCallObjMgr.setupInitialMissCallLayer(b)) : (parentWidth = $(currentElement).parents("._missCallDiv").find("._progressBar2").parent().width(), $(currentElement).parents("form").find("._clockForMissCall").text(h), newWidth = counter * parentWidth / g, void $(a).parents("._missCallDiv").find("._progressBar2").width(newWidth))
        }, e, d)
    }, progressBarAnim(), !1
}, FailedMissCallhandler = function(a) {
    $("._missCallDiv").find("._progressBar2").width("0px"), $("._missCallDiv").find(".progressBarLine").hide(), $(currentElement).parents("._missCallDiv").find(".missCallStartDiv").hide(), actionEvent = "Missed_Call_Verification_Failed", missCallVAMTracking(a, actionEvent), $(currentElement).parents("._missCallDiv").find("._missCallFailedDiv").show()
}, missCallVAMTracking = function(a, b) {
    eventLabel = $(a).parents("form").find("#profileId").val(), actionId = $(a).parents("form").find("#mobile").val(), actionId = actionId.replace("-", ""), src = $(a).parents("form").find("#action_source").val(), trackClickAction(b, actionId, src, "EOI_VERIFICATION")
}, mobileVerificationMissCall.prototype.setupInitialMissCallLayer = function(a) {
    $("._missCallDiv").find("._missCallAlertDiv").css("display", "block"), $("._missCallDiv").find(".missCallStartDiv").css("display", "none"), $("._missCallDiv").find("._missCallFailedDiv").css("display", "none"), $("._missCallDiv").find("._progressBar2").width("0px"), $("._missCallDiv").find(".progressBarLine").show(), $("._missCallDiv").find("._clockForMissCall").text(a)
}, getNumberOfSeconds = function(a) {
    return timeArr = a.split(":"), 2 == timeArr.length ? seconds = 1e3 * (60 * timeArr[0] + 1 * timeArr[1]) : 3 == timeArr.length ? seconds = 1e3 * (3600 * timeArr[0] + 60 * timeArr[1] + 1 * timeArr[2]) : void 0
}, mobileVerificationMissCall.prototype.getUpdatedTime = function(a, b) {
    return timeLeft = b - a, timeLeft < 0 ? "0:00" : (hours = Math.floor(timeLeft / 36e5), leftMilliSeconds = timeLeft % 36e5, minutes = Math.floor(leftMilliSeconds / 6e4), leftMilliSeconds %= 6e4, seconds = Math.floor(leftMilliSeconds / 1e3), 60 == seconds && (minutes += 1, seconds -= 60), 0 == hours && (seconds < 10 && (seconds = "0" + seconds), timeLeft = minutes + ":" + seconds), timeLeft)
}, mobileVerificationMissCall.prototype.doVerification = function(a, b) {
    if (0 == $(b).parents("#verifyMobForm").parents(":hidden").length && "block" == $(b).parents("form").find(".missCallStartDiv").css("display") || "none" == $(b).parents("form").find("#missCallVerificationFailed").css("display") && "block" == $(b).parents("form").find("#missCallDiv").css("display")) {
        $.ajax({
            type: "POST",
            url: "",
            data: "profileId=" + a.profileId + "&mobile=" + a.mobile
        }).done(function(c) {
            if (c) {
                var d = $.parseJSON(c);
                !0 === d.verificationStatus ? (actionEvent = "Missed_Call_Verification_Successful", missCallVAMTracking(b, actionEvent), d.profileId = a.profileId, d.mobile = a.mobile, usrMgr.updateUserStatus(d), !1 !== usrMgr.onSuccessVerificationFunction && (usrMgr.onSuccessVerificationFunction ? usrMgr.onSuccessVerificationFunction(d) : (usrMgr.onVerificationSuccessmsg = " Your mobile number (+" + d.mobile + ") is successfully verified.", usrMgr.onSuccessVerification())),
                    !1 !== usrMgr.postVerificationFunction && (usrMgr.postVerificationFunction ? usrMgr.postVerificationFunction(d) : usrMgr.postVerification(d))) : setTimeout(function() {
                    missCallObjMgr.doVerification(a, b)
                }, 3e3)
            }
        })
    }
};
var captchaFactory = {
    captchaCtx: null,
    captchaHtml: "",
    captchaKey: "",
    captchaEvtId: "",
    captchaEvtAcn: "",
    prevCaptchaEvtId: "",
    captchaWithoutCross: "",
    captchaStatus: !1,
    url: "//www.google.com/recaptcha/api.js",
    showCaptchaInline: function(a, b) {
        captchaFactory.captachaKey = b, a[IH] = '<img id="captcha_loading" src="' + IMG_BASE_URL + '/images/99loaderDesktop.gif"> <div id="captchadiv"></div> <input type="hidden" name="captchaKey"  value="' + captchaFactory.captchaKey + '" /></div>', $.getScript(captchaFactory.url, captchaFactory.loadCaptcha), captchaFactory.captchaCtx = a, captchaFactory.captchaStatus = !1
    },
    showCaptcha: function(a, b) {},
    showNoCaptcha: function(a, b) {},
    showCaptchaFP: function(a, b, c) {},
    showNoCaptchaFP: function(a, b, c) {},
    loadCaptcha: function() {
        Recaptcha.create("6LfVAewSAAAAAHfjZ_qiDTGl1Z7FMNnMykgkCI_6", "captchadiv", {
            tabindex: 1,
            theme: "clean",
            callback: captchaFactory.onCaptchaViewLoad
        })
    },
    loadNoCaptcha: function() {
        $("#recaptcha_privacy,#captcha_loading").hide(), grecaptcha.render("captchadiv", {
            sitekey: "6LfEtwsTAAAAAMFkCNFXZfarugQ2UBHIDs1JMrH9",
            callback: captchaFactory.onNoCaptchaViewLoad
        })
    },
    verifyCaptcha: function() {
        var postData = $("#captcha_form").serializeArray();
        $.ajax({
            type: "POST",
            url: "",
            data: postData
        }).done(function(txt) {
            var txt = eval("(" + txt + ")");
            if ("true" == txt.status) {
                captchaFactory.captchaStatus = !0, captchaFactory.captchaCtx = null, captchaFactory.captchaHtml = "";
                try {
                    var n = doc.byId(captchaFactory.captchaEvtId);
                    n.lyr = null
                } catch (err) {}
                "click" == captchaFactory.captchaEvtAcn ? $("#" + captchaFactory.captchaEvtId)[0].click() : $("#" + captchaFactory.captchaEvtId).trigger(captchaFactory.captchaEvtAcn)
            } else captchaFactory.captchaStatus = !1, Recaptcha.reload(), $("#captcha_form").find('div[class="inlineErr"]').length || $('[name="SubmitCatpcha"]').before('<div class="inlineErr" style="position: relative; margin-top: 1px; display: block;"><span class="red f11" style="margin-left:5px">Captcha response is incorrect.</span></div>')
        })
    },
    verifyNoCaptcha: function() {
        var postData = $("#captcha_form").serializeArray();
        $.ajax({
            type: "POST",
            url: "",
            data: postData
        }).done(function(txt) {
            var txt = eval("(" + txt + ")");
            if ("true" == txt.status) {
                captchaFactory.captchaStatus = !0, captchaFactory.captchaCtx = null, captchaFactory.captchaHtml = "";
                try {
                    var n = doc.byId(captchaFactory.captchaEvtId);
                    n.lyr = null
                } catch (err) {}
                "click" == captchaFactory.captchaEvtAcn ? $("#" + captchaFactory.captchaEvtId)[0].click() : $("#" + captchaFactory.captchaEvtId).trigger(captchaFactory.captchaEvtAcn)
            } else captchaFactory.captchaStatus = !1, grecaptcha.reset(), $("#captcha_form").find('div[class="inlineErr"]').length || $('[name="SubmitCatpcha"]').before('<div class="inlineErr" style="position: relative; margin-top: 1px; display: block;"><span class="red f11" style="margin-left:5px">Captcha response is incorrect.</span></div>')
        })
    },
    onNoCaptchaViewLoad: function() {
        $("#captcha_afterload").show(), $("#recaptcha_privacy,#captcha_loading").hide(), $('[name="captchaKey"]').val(captchaFactory.captchaKey), $("#recaptcha_reload").click(function(a) {
            a.preventDefault(), grecaptcha.reset()
        }), $("#recaptcha_image").contentChange(function() {
            var a = $("#captcha_form").clone();
            a.find('div[class="inlineErr"]').remove(), captchaFactory.captchaHtml = $("<form></form>").html(a).html()
        })
    },
    onCaptchaViewLoad: function() {
        Recaptcha.focus_response_field(), $("#captcha_afterload").show(), $("#recaptcha_privacy,#captcha_loading").hide(), $('[name="captchaKey"]').val(captchaFactory.captchaKey), $("#recaptcha_response_field").keydown(function(a) {
            if (13 == a.keyCode) return captchaFactory.verifyCaptcha(), !1
        }), $("#recaptcha_reload").click(function(a) {
            a.preventDefault(), Recaptcha.reload()
        }), $("#recaptcha_switch_audio").click(function(a) {
            a.preventDefault(), Recaptcha.switch_type("audio")
        }), $("#recaptcha_switch_img").click(function(a) {
            a.preventDefault(), Recaptcha.switch_type("image")
        }), $("#recaptcha_image").contentChange(function() {
            var a = $("#captcha_form").clone();
            a.find('div[class="inlineErr"]').remove(), captchaFactory.captchaHtml = $("<form></form>").html(a).html()
        })
    },
    removeExistingCaptchaForm: function() {
        try {
            if ("" != captchaFactory.prevCaptchaEvtId) {
                doc.byId(captchaFactory.prevCaptchaEvtId).lyr = null
            }
        } catch (a) {}
        null != captchaFactory.captchaCtx && (captchaFactory.captchaCtx[IH] = "")
    }
};
mobileVerificationOTP.prototype.init = function() {}, mobileVerificationOTP.prototype.doVerification = function(a, b) {
    var c = a;
    c || (c = $(b).serialize()), $(b).val("Verifying"), $(b).find("#verifyBtnId").attr("disabled", !0), $.ajax({
        type: "POST",
        url: "",
        data: c
    }).done(function(a) {
        if ($(b).val("Verify"), $(b).find(".otpFallBack").remove(), $(b).find("#verifyBtnId").attr("disabled", !1), a) {
            var c = $.parseJSON(a);
            !0 === c.verificationStatus ? (usrMgr.updateUserStatus(c), !1 !== usrMgr.onSuccessVerificationFunction && (usrMgr.onSuccessVerificationFunction ? usrMgr.onSuccessVerificationFunction(c) : (usrMgr.onVerificationSuccessmsg = " Your mobile number (+" + c.mobile + ") is successfully verified.", usrMgr.onSuccessVerification())), !1 !== usrMgr.postVerificationFunction && (usrMgr.postVerificationFunction ? usrMgr.postVerificationFunction(c) : usrMgr.postVerification(c))) : ($(b).find("#verificationErr").show(), $(b).find("#OTP").css({
                "border-color": "#ff0000"
            }))
        }
    })
}, mobileVerificationOTP.prototype.showInModal = function(a, b, c) {
    if (void 0 === c) return !1;
    c.source = a;
    var d = c;
    $.ajax({
        type: "POST",
        url: "",
        data: d
    }).done(function(a) {
        if (txtObj = $.parseJSON(a), txtObj.html) {
            var b = "Register for a FREE 99acres Account";
            void 0 != c.titleMsg && (b = c.titleMsg);
            pg.openModalLayer({
                id: "verification_layer",
                ttl: b,
                position: "fixed",
                size: {
                    w: 410
                },
                html: txtObj.html
            })
        } else usrMgr.updateUserStatus(txtObj), !1 !== usrMgr.postVerificationFunction && (usrMgr.postVerificationFunction ? usrMgr.postVerificationFunction(txtObj) : usrMgr.postVerification(txtObj))
    })
}, mobileVerificationOTP.prototype.showMissCallStartDiv = function(a) {}, mobileVerificationOTP.prototype.showInLayer = function(a, b, c) {
    if (void 0 === c) return !1;
    c.source = a;
    var d = c;
    $.ajax({
        type: "POST",
        url: "",
        data: d
    }).done(function(a) {
        txtObj = $.parseJSON(a), txtObj.html ? (usrMgr.bindHtml("V", b, txtObj.html), mobObjMgr.init()) : (usrMgr.updateUserStatus(txtObj), !1 !== usrMgr.postVerificationFunction && (usrMgr.postVerificationFunction ? usrMgr.postVerificationFunction(txtObj) : usrMgr.postVerification(txtObj)))
    })
}, mobileVerificationOTP.prototype.showInPage = function(a) {
    if (void 0 === a) return !1;
    a.showPage = "true";
    $.ajax({
        type: "POST",
        url: "",
        data: $jsonData
    }).done(function(a) {
        if (a = $.parseJSON(a)) return a
    })
}, mobileVerificationOTP.prototype.afterSkipAction = function(a) {
    $(a).hide(), pg.closeModalLayer();
    var b = {
        skipVerification: !0
    };
    !1 !== usrMgr.postVerificationFunction && (usrMgr.postVerificationFunction ? usrMgr.postVerificationFunction(b) : usrMgr.postVerification(b))
}, mobileVerificationOTP.prototype.performSkipAction = function(a, b, c) {
    "xid" == c && performSkipActionXid(b)
}, mobileVerificationOTP.prototype.doValidation = function() {}, mobileVerificationOTP.prototype.sendForVerification = function(a, b) {
    var c;
    if (void 0 === a) return !1;
    $(b).html("Sending...");
    var d = a;
    return $.ajax({
        async: !1,
        type: "POST",
        url: "",
        data: d
    }).done(function(a) {
        a && (a = $.parseJSON(a), !1 === a.status ? $(b).html("Send Failed. Try Missed Call.") : !0 === a.status ? ($(b).next("#codesentId").show().css("color", "green"), $(b).next("#codesentId").fadeOut(3200), $(b).parent().siblings("#verificationErr").hide(), $(b).html("Request again"), c = a.KNOWLARITYNO) : "overflow" === a.status ? $(b).unbind() : "rejected_verification" === a.status && $(b).html("Rejected Verified"))
    }), c
}, mobileVerificationOTP.prototype.showThankLayer = function(a) {
    if (void 0 === a) return !1;
    var b = a;
    $.ajax({
        type: "POST",
        url: "",
        data: b
    }).done(function(a) {
        (a = $.parseJSON(a)) && usrMgr.bindHtml("VT", ctx, a)
    })
}, emailVerification.sendEmailVerification = function(a) {
    if (void 0 === a) return !1;
    var b = a;
    $.ajax({
        type: "POST",
        url: "",
        data: b
    }).done(function(a) {
        a = $.parseJSON(a)
    })
};
var verificationObjSingleton = function() {
        var a, b;
        return {
            getInstance: function(c) {
                return void 0 === c && (c = "mobile"), void 0 === a && "mobile" == c && (a = new mobileVerificationOTP), void 0 === b && "email" == c && (b = new emailVerification), "mobile" == c ? a : b
            }
        }
    }(),
    emailObjMgr = verificationObjSingleton.getInstance("email"),
    mobObjMgr = verificationObjSingleton.getInstance("mobile"),
    missCallObjMgr = new mobileVerificationMissCall,
    eoiMgr = {},
    fp_pgEoi = {
        currentLayer: "",
        form: null,
        removeModifyBtn: !1,
        registrationEOIHandler: function() {
            $("#registration_layer").prev("div.bdr1").remove(), $("#registration_layer").remove(), $("#ThankyouBar .msgBox span").length > 0 && ($("#ThankyouBar .msgBox span#ThankYouGreen").html(eoiMgr.registrationMsg), $("#ThankyouBar .msgBox span#ThankYouRest").hide())
        },
        verificationEOIHandler: function(a) {
            var b = eoiMgr.verificationMsg,
                c = b.replace("MOBILE", a.mobile);
            if (1 == eoiMgr.blocker) {
                var d = fp_pgEoi.currentLayer + " form";
                $(d).submit()
            } else $("#ThankyouBar .msgBox span").length > 0 && ($("#ThankyouBar .msgBox span#ThankYouGreen").html(c), $("#ThankyouBar .msgBox span#ThankYouRest").hide()), $("div.verifyForm").closest("div.bdr1.mt5.clr").remove(), $("div.eoiOR").remove(), $("div.verifyForm").remove(), $("#login_div_html").length > 0 && $("#login_div_html").remove()
        },
        loginEOIHandler: function() {
            if (1 == eoiMgr.blocker) {
                var a = fp_pgEoi.currentLayer + " form";
                $(a).submit()
            } else $("#ThankyouBar .msgBox span").length > 0 && ($("#ThankyouBar .msgBox span#ThankYouGreen").html(eoiMgr.loginMsg), $("#ThankyouBar .msgBox span#ThankYouRest").hide()), $("#login_div_html").remove(), $("div.eoiOR").remove(), $("div.verifyForm").length > 0 && $("div.verifyForm").remove()
        },
        saveCurrentLayer: function(a) {
            fp_pgEoi.currentLayer = "#frm_" + a
        },
        modifyEoiHandler: function(a, b) {
            var c = $(b).closest(".body").parent();
            return $(c).replaceWith($(fp_pgEoi.form).parent()), $(fp_pgEoi.form).parent().show(), infolayer.gStop = !1, a.stopPropagation(), usrMgr.modifyButtonFunction = null, !0
        }
    };
jQuery.fn.contentChange = function(a) {
    var b = jQuery(this);
    return b.each(function(b) {
        var c = jQuery(this);
        c.data("lastContents", c.html()), window.watchContentChange = window.watchContentChange ? window.watchContentChange : [], window.watchContentChange.push({
            element: c,
            callback: a
        })
    }), b
}, setInterval(function() {
    if (window.watchContentChange)
        for (i in window.watchContentChange) window.watchContentChange[i].element.data("lastContents") != window.watchContentChange[i].element.html() && (window.watchContentChange[i].callback.apply(window.watchContentChange[i].element), window.watchContentChange[i].element.data("lastContents", window.watchContentChange[i].element.html()))
}, 500), $(window).scroll(function() {
    if ("undefined" != typeof currentPageName && isset(currentPageName)) {
        if (currentPageName && ("XID_DETAIL_PAGE" == currentPageName || "Property Description" == currentPageName || "dif_landing_page" == currentPageName || "PLDPAGE" == currentPageName)) return $("#Header-Wrap").removeClass("stick"), $(".fullbg-SRP").css("position", "absolute"), void(showLBOnTop && $(window).scrollTop() <= offsetAboveHeader && $(".fullbg-SRP").css("position", "relative"));
        showLBOnTop && ($(window).scrollTop() > offsetAboveHeader + 55 ? $(".fullbg-SRP").css("position", "fixed") : $(".fullbg-SRP").css("position", "relative"))
    }
    var a, b, c = 55 + offsetAboveHeader,
        d = $("#Header-Wrap"),
        e = $(window).scrollTop(),
        f = $("#searchStickId");
    $("#HeaderStickyHandler").length > 0 && (b = $("#HeaderStickyHandler").offset().top), null != b && e > b ? (d.hasClass("NonStickyHeader") || d.addClass("stick"), $("#loginLayer").css("top", c + "px")) : (d.removeClass("stick"), $("#loginLayer").css("top", b + c + -e + "px"), $(".NonStickyHeader").removeClass("stick")), f.length > 0 && (a = f.offset().top, null != a && e + 56 > a ? ($("#srpSearchHeader").addClass("stickSpl"), d.addClass("noshad"), $("#searchBarFiller").removeClass("hidei").addClass("showi")) : (d.removeClass("noshad"), $("#searchBarFiller").removeClass("showi").addClass("hidei")))
});
var ffObj = {
    ffShowMoreUrls: function(a, b, c) {
        var d = "" != a ? $("#" + b + "_" + a + "_ul") : $("#" + b + "_ul"),
            e = d.children();
        for (i = 0; i < e.length; i++) e.eq(i).hasClass(b + "_hidnurl") && (e.eq(i).hasClass("hidei") ? e.eq(i).removeClass("hidei") : e.eq(i).addClass("hidei"));
        var f = c.innerText ? "innerText" : "innerHTML";
        "View More..." == c[f] ? c[f] = "View Less..." : c[f] = "View More..."
    },
    trackGAEventWrapper: function(a, b, c) {
        trackEventByGA(b, !1, a.href, c)
    },
    trackLinksImpression: function() {
        $(".ff_link_wrapper").each(function() {
            var a = $(this),
                b = a.attr("gaeventacn"),
                c = a.closest(".fFooter");
            trackEventByGA(b + "_I", !1, encodeURI(window.location.pathname), c.attr("trackcat") + "_I")
        })
    }
};
loadCSS = function(a) {
    a = IMG_BASE_URL + a;
    var b = $("<link>");
    $("head").append(b), b.attr({
        rel: "stylesheet",
        type: "text/css",
        href: a
    })
};
var preventCopy = {
        fun: function(a, b) {},
        disableCtrlKeyCombination: function(a, b) {
            try {
                var c = {
                        a: 0,
                        c: 0,
                        v: 0
                    },
                    d = window.event ? window.event.ctrlKey : a.ctrlKey,
                    e = window.event ? window.event.keyCode : a.which;
                e = String.fromCharCode(e).toLowerCase();
                var f = b.parentNode;
                empty(doc.byId("es_meg")) || (f = f.parentNode), this.spanEl || (this.spanEl = F_APP(F_CR("span", {
                    className: "inlineErr"
                }, {
                    display: "block"
                }), f));
                var g;
                return g = b.ff || b, d && e in c ? (g[CN].indexOf("valerr") < 0 && (g[CN] = g[CN] + " valerr"), this.spanEl[IH] = "<span class='red f13'>Copy-paste is disabled.</span>", f.appendChild(this.spanEl), !1) : (g[CN].indexOf("valerr") > 0 && (g[CN] = g[CN].replace("valerr", "")), this.spanEl[PN] && this.spanEl[PN].removeChild(this.spanEl), this.spanEl = null, !0)
            } catch (h) {}
        },
        rightClick: function(a, b) {
            try {
                var a = a || window.event,
                    c = b.parentNode;
                empty(doc.byId("es_meg")) || (c = c.parentNode), this.spanEl || (this.spanEl = F_APP(F_CR("span", {
                    className: "inlineErr"
                }, {
                    display: "block"
                }), c));
                var d;
                d = b.ff || b;
                if (3 == a.which || 2 == a.button) return d[CN].indexOf("valerr") < 0 && (d[CN] = d[CN] + " valerr"), this.spanEl[IH] = "<span class='red f13'>Copy-paste is disabled.</span>", c.appendChild(this.spanEl), !1;
                d[CN].indexOf("valerr") > 0 && (d[CN] = d[CN].replace("valerr", "")), this.spanEl[PN].removeChild(this.spanEl), this.spanEl = null
            } catch (e) {}
            return !0
        }
    },
    Homepage = {
        TabSelectorHp: function(a) {
            $(".tabs").each(function() {
                $(this).removeClass("sel")
            }), $("#" + a).addClass("sel")
        }
    },
    remSrch = {
        stMap: {
            PROPERTY: "P",
            PROJECT: "X",
            DEALER: "D"
        },
        getKeyMap: function() {
            return {
                res_com: "a",
                preference: "b",
                property_type: "c",
                city: "d",
                budget_min: "e",
                budget_max: "f",
                area_min: "g",
                area_max: "h",
                area_unit: "i",
                bedroom_num: "j",
                selected_tab: "k"
            }
        },
        getRevKeyMap: function() {
            return Object.reverse(this.getKeyMap())
        },
        getTypeKey: function(a) {
            return this.stMap[a]
        },
        getRevTypeKey: function(a) {
            return Object.reverse(this.stMap)[a]
        },
        getData: function(st) {
            var spd, m, i, data = [];
            if (m = this.getRevKeyMap(), spd = getCookie("spd"), empty(spd))
                for (i in m) data[m[i]] = null;
            else if (spd = eval("(" + spd + ")"), !empty(spd) && (spd = spd[this.getTypeKey(st)], !empty(spd))) {
                for (i in m) isset(spd[i]) && (data[m[i]] = spd[i]);
                return data
            }
            return data
        }
    },
    css = {
        updateCss: function(a) {
            var b = doc.byId("cssBox");
            if (!b) return !0;
            b.style.background = a.style.background, b.style.border = a.style.border
        },
        saveCss: function(a) {
            return ajax.postForm(a, this.cssSucc, this.cssFail), !1
        },
        cssSucc: function(txt) {
            txt = eval("(" + txt + ")"), "1" == txt.status && (document.getElementById("cssSuccDiv").style.display = "inline", slowly.fadein("cssSuccDiv"))
        },
        cssFail: function(a) {}
    },
    layerCloseOnClickBody = {
        flags: {},
        closeLayerFunctions: {},
        isEvntStpPropgtn: !1,
        currentOpenLyrs: [],
        init: function() {
            $(document).on(clickEventStr, "body", layerCloseOnClickBody.forceCloseLayers)
        },
        initializeEvents: function(a, b, c) {
            layerCloseOnClickBody.closeLayerFunctions[a] = {
                cf: b,
                ctx: c
            }, $(document).on(clickEventStr, a, function(b) {
                layerCloseOnClickBody.currentOpenLyrs.push(a)
            })
        },
        forceCloseLayers: function(a) {
            var b, c, d;
            for (c = layerCloseOnClickBody.currentOpenLyrs.length - 1; c >= 0; c--) b = layerCloseOnClickBody.currentOpenLyrs[c], void 0 !== a && 0 != $(a.target).closest(b).length || (layerCloseOnClickBody.currentOpenLyrs.splice(c, 1), d = a ? layerCloseOnClickBody.closeLayerFunctions[b].ctx || $(a.target) : layerCloseOnClickBody.closeLayerFunctions[b].ctx || $(window), layerCloseOnClickBody.closeLayerFunctions[b].cf.call(d, a));
            if (layerCloseOnClickBody.isEvntStpPropgtn) return a.stopPropagation(), layerCloseOnClickBody.isEvntStpPropgtn = !1, !1
        }
    };
layerCloseOnClickBody.init();
var zip_frm, zipdial = {
        skipVerification: function(a, b) {
            zip_frm = doc.byId(b);
            var c = doc.byId("lstAcn"),
                d = c.value,
                e = doc.byId("fp_pg_form"),
                f = e.value,
                g = "" + a + "/" + d + "/" + f;
            ajax.getText({
                url: g
            }, zipdial.onSkipverify, "")
        },
        onSkipverify: function() {
            doc.byId("lstAcn").value = "VERIFY_ABORT";
            var a = (doc.byId("zip_page"), doc.byId("submitting"));
            doc.byId("close_ziplyr");
            myId = doc.byId("pg_div_id").value, a.style.display = "block", infolayer.sendQuerySubmit(zip_frm, myId), timer.reset()
        },
        checkVerification: function(a) {
            var b = doc.byId("lstAcn"),
                c = b.value,
                d = doc.byId("fp_pg_form"),
                e = d.value;
            zip_frm = doc.byId(a), myId = doc.byId("pg_div_id");
            var f = doc.byId("trans_token").value,
                g = "" + f + "/" + c + "/" + e;
            ajax.getText({
                url: g
            }, zipdial.oncheckVerify, "")
        },
        oncheckVerify: function(a) {
            if ("Server Error" == a) doc.byId("serverErrCheck").style.display = "block", doc.byId("lstAcn").value = "VERIFY_ERR01";
            else if (1 == a) {
                doc.byId("lstAcn").value = "VERIFY_SUCCESS", myId = doc.byId("pg_div_id").value;
                var b = (doc.byId("zip_page"), doc.byId("submitting"));
                b.style.display = "block", doc.byId("notVerifiedErr").style.display = "none", myFrm.action = "", infolayer.sendQuerySubmit(zip_frm, myId), timer.reset()
            } else doc.byId("lstAcn").value = "VERIFY_ATTEMPT", doc.byId("notVerifiedErr").style.display = "block"
        },
        refreshImage: function(a) {
            var b = doc.byId("lstAcn"),
                c = b.value,
                d = doc.byId("fp_pg_form"),
                e = d.value;
            doc.byId("cntdwn_div").style.background = "";
            var f = "" + a + "/" + c + "/" + e;
            ajax.getText({
                url: f
            }, zipdial.onsuccess, "")
        },
        onsuccess: function(a) {
            if ("Server Error" == a) doc.byId("serverErr").style.display = "block", doc.byId("lstAcn").value = "VERIFY_ERR01";
            else {
                doc.byId("lstAcn").value = "VERIFY_REFRESH";
                var b = a.split("+");
                doc.byId("zip_image").src = b[0], doc.byId("trans_token").value = b[1], doc.byId("zip_image_div").style.display = "block", doc.byId("refresh_timer").style.display = "none", doc.byId("notVerifiedErr").style.display = "none", timer.reset(), timer.init("300", "cntdwn")
            }
        },
        closeForm: function(a) {
            doc.byId("close_ziplyr").style.display = "none";
            var b = doc.byId("lstAcn"),
                c = doc.byId("fp_pg_form");
            c.value;
            zip_frm = doc.byId(a), myId = doc.byId("pg_div_id").value;
            var d = b.value,
                e = "" + d;
            ajax.getText({
                url: e
            }, "", ""), _cur_lyr(null), infolayer.gStop = !1, infolayer.sendQuerySubmit(zip_frm, myId), timer.reset()
        }
    },
    myFrm, myId, infolayer = {
        arrAttr: "attr",
        offset: [0, 20],
        pos: ["lt", "lt"],
        zx: 10,
        qfrm: !1,
        gStop: !1,
        arr: "<em class='lArow'></em>",
        mouseoutFlag: !1,
        setup: function(a, b) {
            for (var c = doc.byId(a), d = js.dom.findAll(c, [b.itag ? b.itag : "LI"]), e = 0; e < d.length; e++) {
                var f = d[e];
                jsevt.setHandlers([
                    [f, "mouseover", b.onMOver ? b.onMOver : this.onMOver],
                    [f, "mouseleave", b.onMOut ? b.onMOut : this.onMOut]
                ]), f.buildLyr = b.buildLyr ? b.buildLyr : this.buildLyr, f.getData = b.getData, f.cancelGetData = this.cancelGetData, f.qfrm = b.qfrm, f.arr = b.arr ? b.arr : this.arr, f.trackLayer = b.trackLayer, f.linkId = f.getAttribute(b.idAttr), f.offset = b.offset ? b.offset : this.offset, f.pos = b.pos ? b.pos : this.pos
            }
        },
        buildLyr: function() {
            var a = this;
            a.lyr || "l" !== GA(a, "attr") ? a.lyr || (a.offset = [268, 0], a.lyr = js.dom.append(js.dom.create("DIV", {
                className: "fplayer",
                lyrof: a
            }, {
                position: "absolute",
                display: "none",
                backgroundColor: "#ccc",
                width: "230px",
                zIndex: 1e3,
                left: "605px",
                top: "150px"
            }), a), a.lyr.innerHTML = "<em class='lArow'></em><div class='body'><div class='p10'><img src='" + IMG_BASE_URL + "/images/99loaderDesktop.gif' ></img>&nbsp;&nbsp;<b>Loading...</b></div></div>") : (a.offset = [-236, 0], a.lyr = js.dom.append(js.dom.create("DIV", {
                className: "fplayer",
                lyrof: a
            }, {
                position: "absolute",
                display: "none",
                backgroundColor: "#ccc",
                width: "230px",
                zIndex: 1e3,
                attr: "l"
            }), a), a.lyr.innerHTML = "<em class='rArow'></em><div class='body'><div class='p10'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loading...&nbsp;&nbsp;<img src='" + IMG_BASE_URL + "/images/99loaderDesktop.gif' ></img></div></div>")
        },
        cancelGetData: function() {
            try {
                window.clearTimeout(this.timer)
            } catch (a) {}
            this.timer = 0
        },
        onRcvData: function(a) {
            var b = this;
            b.gotData = !0, b.lyr[CHN][1].innerHTML = a, layers.sizeShadow(b.lyr)
        },
        onRcvData1: function(a) {
            var b = this;
            fp_pgEoi.link = b;
            var c = "frm_" + b.linkId;
            jsui.show("arr_" + b.linkId, "block"), jsui.show("close_" + b.linkId, "block");
            var d = doc.byId(c);
            d && (d.style.display = "block", d[IH] = a.trim(), infolayer.gStop = !0, js.dom.find(d, "FORM").lnk = b, jsval.setupFrm(d[FC], !0)), layers.sizeShadow(b.lyr), fpHomePage.validateChecks(b.linkId), $("#CA_" + b.linkId).hide(), phoneNum.initialize();
            var e = $(b).children(".fplayer"),
                f = $(window).height() - e.height();
            $("#Header-Wrap").offset().top + $("#Header-Wrap").height() < e.offset().top - f && scrollToElement(e, 500, -1 * f), checkAndHideGdprSections && checkAndHideGdprSections()
        },
        bldQryFrm: function(a, b, c, d) {
            var e, f;
            b.style.visibility = "hidden", e = "PG" == d ? doc.byId(c) : js.dom.findParent(b, "LI"), f = e, f.lyr.style.width = "300px", ajax.getText({
                url: "/load/sendemailsms/showLayer/" + c + "/" + c + "/" + d + "/" + userActionParams.lstAcn + "/" + userActionParams.lstAcnId + "?frm_typ=" + d,
                ctx: f
            }, infolayer.onRcvData1, fp.onRcvDataErr)
        },
        stopLink: function(a, b) {
            if (infolayer.gStop = !1, jsui.hide(a[PN][PN]), "PG" == b.substring(0, 2)) {
                doc.byId("closenew1_" + b).style.display = "none";
                var c = doc.byId(b);
                c.lyr.style.width = "208px", doc.byId("CA_" + b).style.visibility = "visible", doc.byId("CA_" + b).style.display = "block"
            }
            if ("LI" == b.substring(0, 2)) {
                var d = doc.byId("closenew_" + b),
                    e = doc.byId("closenew_right" + b);
                d.style.display = "none", e.style.display = "none", doc.byId("CA_" + b).style.visibility = "visible", doc.byId("CA_" + b).style.display = "block";
                var c = js.dom.findParent(a, "LI");
                return c.lyr.style.width = "220px", "L" == GA(c, "attr") && (c.offset = [-236, 0]), b
            }
        },
        hideForm: function(a, b, c) {
            return $("#zip_" + a).html(""), $("#top_" + a + ", #viewDet_" + a + ", #contact_" + a).show(), $("#close_" + a + ", #frm_" + a + ", #arr_" + a).hide(), "Y" == b && (_cur_lyr(null), infolayer.gStop = !1), $("#CA_" + a).show(), a
        },
        checkMobileStatus: function(a, b) {
            myFrm = a, myId = b, js.dom.findAll(a, ["VAR"])[0].innerHTML = "<b>Submitting...&nbsp;&nbsp;&nbsp;</b>", ajax.postForm(myFrm, infolayer.oncheckMobileStatus, "")
        },
        oncheckMobileStatus: function(a) {
            a > 0 ? (myFrm.action = "", infolayer.sendQuerySubmit(myFrm, myId)) : (myFrm.action = "", infolayer.bldZipDialFrm(myFrm, myId))
        },
        bldZipDialFrm: function(a, b) {
            ajax.postForm(a, infolayer.onZipDialFrm, infolayer.onZipDialFrmErr)
        },
        onZipDialFrm: function(a) {
            if ("Server Error" == a) myFrm.action = "", infolayer.sendQuerySubmit(myFrm, myId);
            else {
                var b = this.lnk,
                    c = b.id;
                c || (c = myId);
                var d = "close_" + c,
                    e = doc.byId("top_" + c);
                e && (e.style.display = "none");
                var f = doc.byId("contact_" + c);
                f && (f.style.display = "none");
                var g = doc.byId("viewDet_" + c);
                g && (g.style.display = "none");
                var h = "frm_" + c;
                doc.byId(h).style.display = "none";
                var i = "zip_" + c;
                doc.byId(d).style.display = "none";
                var j = doc.byId(i);
                j && (j.style.display = "block", j[IH] = a, infolayer.gStop = !0, js.dom.find(j, "FORM").lnk = b, jsval.setupFrm(j[FC], !0)), layers.sizeShadow(b.lyr), timer.reset(), timer.init("300", "cntdwn")
            }
        },
        onzipDialFrmErr: function() {
            infolayer.gStop = !1, alert("error happened ")
        },
        sendQuerySubmit: function(a, b) {
            captchaFactory.captchaEvtId = a.id, captchaFactory.captchaEvtAcn = "submit", fp_pgEoi.removeModifyBtn = !0, fp_pgEoi.form = $(a).parent().parent().parent().parent().parent(), toglTxtOnBtn("Submitting...", "sbchtx" + b);
            var c = doc.byId("testId");
            c && (c.value = "300"), usrMgr.modifyButtonFunction = fp_pgEoi.modifyEoiHandler, ajax.postForm(a, infolayer.onSendQueryFrm, infolayer.onSendQueryFrmErr), infolayer.hideForm(b, "N")
        },
        onSendQueryFrm: function(txt) {
            var txtObj = {};
            try {
                txtObj = eval("(" + txt + ")")
            } catch (err) {}
            infolayer.gStop = !0;
            var t = this.lnk,
                emClass, emId, s = "",
                ofs, atr = t.getAttribute(fpHomePage.arrAttr);
            if (fp_pgEoi.saveCurrentLayer(t.linkId), eoiMgr.checkIfBlocker(), usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = fp_pgEoi.registrationEOIHandler, usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postVerificationFunction = fp_pgEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = fp_pgEoi.loginEOIHandler, "L" == atr ? (emClass = "rArow", emId = "thnk_rArow_" + t.linkId, s = "style='right:490px'") : (emClass = "lArow", emId = "thnk_lArow_" + t.linkId), ofs = "L" == atr ? [-516, 0] : t.offset, txtObj.showCaptcha) {
                var captchaKey = txtObj.captchaKey,
                    lyr = js.dom.append(js.dom.create("DIV", {
                        className: "fplayer",
                        lyrof: t
                    }, {
                        position: "absolute",
                        display: "none",
                        backgroundColor: "#FFF",
                        width: "500px",
                        zIndex: 1100
                    }), t);
                lyr[IH] = "<em class='" + emClass + "' id='" + emId + "'></em><em class='rCross' onclick=\"infolayer.hideForm('" + t.linkId + "','Y'); infolayer.rebuild_layer1('" + t.linkId + "');jsevt.stopBubble(event);\" " + s + "></em><div class='body'></div>";
                var ctx = lyr.getElementsByClassName("body")[0];
                "true" == txtObj.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptchaFP(ctx, captchaKey, t)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptchaFP(ctx, captchaKey, t))
            } else {
                var lyr = js.dom.append(js.dom.create("DIV", {
                    className: "fplayer",
                    lyrof: t
                }, {
                    position: "absolute",
                    display: "none",
                    backgroundColor: "#ccc",
                    width: "589px",
                    zIndex: 1100
                }), t);
                lyr[IH] = "<em class='" + emClass + "' id='" + emId + "'></em><em class='rCross' onclick=\"infolayer.hideForm('" + t.linkId + "','Y'); infolayer.rebuild_layer1('" + t.linkId + "');jsevt.stopBubble(event);\" " + s + "></em><div class='body'>" + txt + "</div>"
            }
            try {
                _cur_lyr(t[LC]), jsui.showAt(lyr, t, t.pos, ofs), $(lyr).find("#rCrossEoiCap").hide(), fp_pgEoi.removeModifyBtn && ($(lyr).find("#modifyBtnId").hide(), fp_pgEoi.removeModifyBtn = !1), js.setTimeout(lyr, _cur_lyr, 5e3, lyr), setTimeout(function() {
                    eoiMgr.checkIfBlocker()
                }, 3e3), eval($("#eCommTrackDiv script").html())
            } catch (e) {}
            infolayer.rebuild_layer1(t.linkId)
        },
        onSendQueryFrmErr: function(a, b, c, d) {
            infolayer.gStop = !1, alert("error happened " + a)
        },
        onMOver: function(a, b) {
            if (1 == infolayer.gStop) return !1;
            infolayer.mouseoutFlag = !1;
            var c = this;
            c.lyr ? infolayer.onMoverExpand(a, b, c) : setTimeout(function() {
                infolayer.mouseoutFlag || (c.buildLyr(), infolayer.onMoverExpand(a, b, c))
            }, 1e3)
        },
        onMOut: function(a, b) {
            if (1 == infolayer.gStop) return !1;
            var c = this;
            infolayer.mouseoutFlag = !0, c.cancelGetData(), b ? jsui.hideL(c.lyr) : _cur_lyr(null)
        },
        layer_expand: function(a, b, c, d) {
            var e, f;
            "PG" == d && ($("#closenew1_" + c).show(), trackEventByGA("CLICK", "CONTACT_DEALER-NEW", c)), "FPHOMEPAGE" == d && (e = js.dom.findParent(b, "LI"), "L" == GA(e, "attr") || "l" == GA(e, "attr") ? (e.offset = [-272, 0], f = "closenew_right" + c) : f = "closenew_" + c, $("#" + f).show(), trackEventByGA("CLICK", "CONTACT_DEALER-NEW", c))
        },
        rebuild_layer: function(a, b, c) {
            var d;
            "PG" == c && ($("#CA_" + b).css("visibility", "visible").show(), $("#closenew1_" + b).hide(), d = doc.byId(b), d.lyr.style.width = "208px"), "FPHOMEPAGE" == c && ($("#CA_" + b).css("visibility", "visible").show(), a.style.display = "none", d = js.dom.findParent(a, "LI"), d.lyr.style.width = "220px", "L" != GA(d, "attr") && "l" != GA(d, "attr") || (d.offset = [-222, 0]))
        },
        rebuild_layer1: function(a) {
            var b, c, d = a;
            "PG" == d.substring(0, 2) && ($("#CA_" + a).css("visibility", "visible").show(), $("#closenew1_" + a).hide(), c = doc.byId(a), c.lyr.style.width = "208px"), "LI" == d.substring(0, 2) && ($("#thnk_rArow_" + a).length > 0 ? (b = $("#closenew_right" + a), c = js.dom.findParent(b.get(0), "LI"), c.offset = [-222, 0]) : b = $("#closenew_" + a), $("#CA_" + a).css("visibility", "visible").show(), b.hide(), c = js.dom.findParent(b.get(0), "LI"), c.lyr.style.width = "220px")
        },
        onMoverExpand: function(a, b, c) {
            var d;
            (d = doc.byId("_" + c.linkId)) ? (c.tracked || (c.timer = js.setTimeout(c, c.trackLayer, 1e3)), c.gotData || (c.lyr[CHN][1].innerHTML = "", c.lyr[CHN][1].appendChild(d), c.gotData = !0)) : c.gotData || c.getData(), b ? jsui.showL(c.lyr) : _cur_lyr(c.lyr), jsui.showAt(c.lyr, c, c.pos, c.offset), jsui.greyThis(c.lyr, "#000", 0), jsui.grow(c.lyr.bg, env.ie ? 5 : 3), c.lyr.bg.style.zIndex = "0", propgallery.onMoverExpand(c)
        }
    },
    _cur_ = null,
    fp = {
        offset: [25, 20],
        idAttr: "linkid",
        zx: 200,
        qfrm: !0,
        setupFPHover: function() {
            infolayer.setup("fp", fp)
        },
        getData: function() {
            this.timer || (this.timer = js.setTimeout(this, fp._getData, 250))
        },
        _getData: function() {
            ajax.getText({
                url: "" + this.linkId,
                method: "GET",
                ctx: this
            }, infolayer.onRcvData, fp.onRcvDataErr), trackEventByGA("OnMouseOver", "FP_SUMMARY_LAYER", this.linkId)
        },
        onRcvDataErr: function(a) {
            alert("OnRcVError");
            var b = this,
                c = userActionParams.lstAcn,
                d = userActionParams.lstAcnId;
            b.lyr[CHN][1].innerHTML = "<a style='bLink' href='/property/redirect_links.php?" + this.linkId + "&from_src=" + this.linkId + "&lstAcn=" + c + "&lstAcnId=" + d + "&src=FP_LINK' > Click Here for more details about this project </a>"
        },
        trackLayer: function() {
            this.tracked || (userActionParams.curAcn = "FP_SUMMARY_LAYER", userActionParams.curAcnId = this.linkId, trackEventByGA("OnMouseOver", userActionParams.curAcn, userActionParams.curAcnId), this.tracked = !0)
        }
    },
    timer = {
        seconds: 0,
        elm: null,
        samay: null,
        sep: "secs",
        init: function(a, b) {
            this.seconds = a, this.elm = doc.byId(b), timer.start()
        },
        reset: function() {
            clearInterval(timer.samay), this.seconds = 0, this.elm = null, this.sep = "secs", this.samay = null
        },
        start: function() {
            this.samay = setInterval(this.doCountDown, 1e3)
        },
        doCountDown: function() {
            if (0 == timer.seconds) return clearInterval(timer.samay), void timerComplete();
            timer.seconds--, timer.updateTimer(timer.seconds)
        },
        updateTimer: function(a) {
            var b = this.elm;
            window.setTimeout(function() {
                b[IH] = a + " secs"
            }, 1)
        }
    },
    lhdr = {
        doStaticPageLoginXhr: null,
        updateHdr: function(a, b, c) {
            "undefined" == b && (b = doc.byId("dspclass").value), "undefined" == a && (a = doc.byId("dsplnme").value), ajax.getText({
                url: "" + a + "&userclass=" + b + "&super_sub=" + c
            }, lhdr.onRcvData)
        },
        onRcvData: function(a) {
            return doc.byId("loginHeader")[IH] = a, searchBarFix(), !0
        }
    },
    TPTracking99 = {
        onLoad: function() {
            TRACKING_AFTER_PAGE_LOAD && (this.gtm(), this.gamoogaEmbed(), this.crazyeggEmbed())
        },
        gtm: function() {
            $("#use_gtm_tracking").length && (jsData.google_tag_params = google_tag_params, jsData.currentPageName = currentPageName, "XID_DETAIL_PAGE" === jsData.currentPageName && (+xid99.params.MIN_PRICE && (jsData.minPrice = +xid99.params.MIN_PRICE), +xid99.params.MAX_PRICE && (jsData.maxPrice = +xid99.params.MAX_PRICE), jsData.localityName = jsData.locality, jsData.page = "XID", jsData.transactType = "none", jsData.class = "none", jsData.businessSegment = getBusinessSegment()), jsData.fireEvent("", jsData), function(a, b, c, d, e) {
                a[d] = a[d] || [], a[d].push({
                    "gtm.start": (new Date).getTime(),
                    event: "gtm.js"
                });
                var f = b.getElementsByTagName(c)[0],
                    g = b.createElement(c),
                    h = "dataLayer" != d ? "&l=" + d : "";
                g.async = !0, g.src = "//www.googletagmanager.com/gtm.js?id=" + e + h, f.parentNode.insertBefore(g, f)
            }(window, document, "script", "dataLayer", "GTM-TRVNRW"))
        },
        gamoogaEmbed: function() {
            $("#use_gamooga_embed").length && (_ss_track = {}, _ss_track.options = {}, _ss_track.id = "bc570cd5-b80b-4754-bbb7-48c0cc4b24f2", _ss_track.events = [], _ss_track.handlers = [], _ss_track.alarms = [], function() {
                var a = document.createElement("script");
                a.type = "text/javascript", a.async = !0, a.id = "__ss", a.src = "//cdn-jp.gsecondscreen.com/static/ssclient.min.js";
                var b = document.getElementsByTagName("script")[0];
                b.parentNode.insertBefore(a, b)
            }())
        },
        crazyeggEmbed: function() {
            $("#use_crazyegg_embed").length && setTimeout(function() {
                var a = document.createElement("script"),
                    b = document.getElementsByTagName("script")[0];
                a.src = document.location.protocol + "//script.crazyegg.com/pages/scripts/0056/6464.js?" + Math.floor((new Date).getTime() / 36e5), a.async = !0, a.type = "text/javascript", b.parentNode.insertBefore(a, b)
            }, 1)
        }
    };
$(window).load(function() {
    if ($("#adviceHdr") && $("#adviceHdr").removeClass("posSt"), $("#showGoogleLayer").length && (pg.showGoogleLayer(), greyOutIntervalId = setInterval("greyOutPage()", 100)), TPTracking99.onLoad(), ffObj.trackLinksImpression(), $("#beacon_src").length > 0 && doBeaconTrack(), "undefined" == typeof currentPageName || "Delhi" != currentPageName && "Bangalore" != currentPageName && "Chennai" != currentPageName && "Hyderabad" != currentPageName && "Pune" != currentPageName && "Kolkata" != currentPageName && "Ahmedabad" != currentPageName && "Chandigarh" != currentPageName && "Jaipur" != currentPageName && "Nagpur" != currentPageName && "Bhubaneswar" != currentPageName && "Coimbatore" != currentPageName && "Goa" != currentPageName && "Indore" != currentPageName && "Kerala" != currentPageName && "Lucknow" != currentPageName && "Surat" != currentPageName && "Vadodara" != currentPageName && "Dehradun" != currentPageName && "Patna" != currentPageName && "Nasik" != currentPageName && "Bhopal" != currentPageName && "Visakhapatnam" != currentPageName && "Kanpur" != currentPageName && "Varanasi" != currentPageName && "Vijayawada" != currentPageName && "Mysore" != currentPageName && "Ranchi" != currentPageName && "Raipur" != currentPageName && "Mangalore" != currentPageName && "Vapi" != currentPageName && "Rajkot" != currentPageName && "Trichy" != currentPageName && "Madurai" != currentPageName && "Hubli" != currentPageName && "Allahabad" != currentPageName && "Pondicherry" != currentPageName && "Agra" != currentPageName && "Ludhiana" != currentPageName && "Amritsar" != currentPageName && "Jalandhar" != currentPageName && "Udaipur" != currentPageName && "Jodhpur" != currentPageName && "Gwalior" != currentPageName && "Jabalpur" != currentPageName && "Aurangabad" != currentPageName || (mySlider("card-slider-1", 4, 4), lazyload()), $(".back-top-Wrap").on("click", function() {
            var a = $(this),
                b = a.attr("page"),
                c = a.attr("val");
            "XIDPAGE" === b ? xid99.doGATracking("BACK_TO_TOP") : trackEventByGA("BACK_TO_TOP", b, c)
        }), $("#footerWrap").on("click", "li", function() {
            var a = $(this),
                b = a.attr("trackval");
            void 0 !== b && b && trackEventByGA("CLICK", b, "")
        }), $(".scaleImg").length) try {
        "undefined" != typeof imageScale && imageScale.selectImages()
    } catch (b) {}
    if (1 == show_lazy_load && lazyload(), void 0 !== zedo && showLBOnTop && $("#leaderBoard").length && !zedo.deferZedoBannerLoad) {
        var a = "undefined" != typeof currentPageName ? currentPageName : "";
        zedo.loadZedoBanner("leaderBoard", a), bannerCssEdit("leaderBoard")
    }
}), lhdr.doStaticPageLogin = function() {
    if (!($("#my99Page").length > 0)) {
        var a, b, c = getCookieVal("PROPLOGIN"),
            d = {},
            e = getCookieVal("DISP_NAME"),
            f = $("#login");
        c && e && (a = e.length, e = a > 15 ? e.substring(0, 12) + "..." : e, b = f.clone(), f.removeClass("_login"), f.find("a").attr("href", "#"), f.find("div.caption").replaceWith('<div class="loginCaption">' + e + "</div>"), d.noCache = (new Date).getTime(), lhdr.oStaticPageLoginXhr = $.getJSON("", d, function(a) {
            1 == a.status ? (lhdr.onRcvData(a.layer), $("#loggedIn").val(1), $("#loggedUserClass").val(a.class)) : $("#login").replaceWith(b)
        }).fail(function() {
            $("#login").replaceWith(b)
        }))
    }
}, $(document).ready(function() {
    var a = $("#SRP-listing").length ? $("#SRP-listing") : $("#leaderBoard"),
        b = $(a).height(),
        c = $(a).length;
    offsetAboveHeader = 0 != c ? b : null, lhdr.doStaticPageLogin(), showLBOnTop = null != offsetAboveHeader, $(window).scrollTop() >= 55 + offsetAboveHeader && $(".fullbg-SRP").css("position", "fixed");
    var d = '<div style="width:168px;top:60px;cursor:text;" class="_actOnTip mTool-Tip"><div class="mTool-Tip-Content"><div class="mTool-inCont" style="width:100%;"></div><i class="arrow-up_wSmall"></i></div></div>';
    if (hdr.showSwitchToMobile(), $(".mn_hvr ,.hdr_hvr").mouseover(function() {
            var a, b = "",
                c = "",
                d = $(this).attr("id"),
                e = getCookieVal("PROPLOGIN");
            "tool_tip1" == d ? (a = "Navigation Menu", c = "icnLess") : "tool_tip3" == d ? a = 'Post Property for Sale or Rent <div class="redT"> FREE!</div>' : "tool_tip4" == d ? (a = empty(e) ? "Register to get <br/> e-mail alerts for latest properties" : "Post your requirements to get e-mail alerts for latest properties", c = "icnLess") : "tool_tip5" == d ? (a = "Our Product Offerings", b = "genIcon iKart iconS") : "tool_tip6" == d ? (a = "Check Out Hot Property Deals in Your City", b = "genIcon hot-deals iconS") : "tool_tip7" == d && (a = "View Property Price Trends", b = "genIcon iTrend iconS"), empty($("#" + d + " .mTool-Tip").attr("id")) ? $('<div onclick="return false;" style="cursor:text!important;" class="mTool-Tip tD ' + d + " " + c + '"  id="icon" ><div class="mTool-Tip-Content"><div class="mTool-icon"><i class=" ' + b + '"></i></div><div class="mTool-inCont">' + a + '</div><i class="genIcon arrBlkU toolTU iconS"></i></div></div>').appendTo("#" + d) : $("#" + $(this).attr("id") + " .mTool-Tip").show()
        }).mouseout(function() {
            $("#" + $(this).attr("id") + " .mTool-Tip").hide()
        }), $(".TrcDesk").click(function() {
            trackEventByGA($(this).attr("trc"), "", "", $(location).attr("href"))
        }), $(document).on(clickEventStr, "html", function(a) {
            closeAllLayersOnHtmlClk(a)
        }), $(document).on("touchstart", "#coverbgLyr", function(a) {
            return closeAllLayersOnHtmlClk(a), a.stopPropagation(), !1
        }), $("#loginHeader").click(function() {
            document.documentElement.scrollTop >= 0 && document.documentElement.scrollTop < $(".banner-container").height() && scrollToElement("#Header-Wrap", 300)
        }), $(document).on("mouseenter", ".verifyLbl", function() {
            $(this).children("div.infoTip2").show()
        }), $(document).on("mouseleave", ".verifyLbl", function() {
            $(this).children("div.infoTip2").hide()
        }), /iPhone|iPad|iPod/i.test(navigator.userAgent)) $(document).on("mouseenter", "#loginHeader", function() {
        $(this).find("#loggedinlayer").show(), $("#loginHeader").addClass("loginHoverColor")
    }), $(document).on("mouseleave", "#loginHeader", function() {
        $(this).find("#loggedinlayer").hide(), $("#loginHeader").removeClass("loginHoverColor")
    }), $(document).on("mouseenter", "#HM-Menu .hm_advice", function() {
        $(this).find(".row-list-menu,.menu-wrap").show()
    }), $(document).on("mouseleave", "#HM-Menu .hm_advice", function() {
        $(this).find(".row-list-menu").hide()
    });
    else {
        var e, f = $("#loginHeader"),
            g = $("#HM-Menu .hm_advice");
        f && f.length > 0 && f.hoverIntent(function() {
            $(this).find("#loggedinlayer").show(), f.addClass("loginHoverColor")
        }, function() {
            f.removeClass("loginHoverColor"), e = setTimeout(function() {
                $("#loggedinlayer").hide()
            }, 200)
        }), g && g.length && g.hoverIntent(function() {
            $(this).find(".row-list-menu,.menu-wrap").show()
        }, function() {
            e = setTimeout(function() {
                $("#HM-Menu .hm_advice .row-list-menu").hide()
            }, 200)
        }), $(document).on("mouseenter", "#loggedinlayer", function() {
            clearTimeout(e), $("#loggedinlayer").show()
        }), $(document).on("mouseleave", "#loggedinlayer", function() {
            clearTimeout(e), $("#loggedinlayer").hide()
        }), $(document).on("mouseenter", "#HM-Menu .hm_advice .row-list-menu", function() {
            clearTimeout(e), $("#HM-Menu .hm_advice .row-list-menu").show()
        }), $(document).on("mouseleave", "#HM-Menu .hm_advice .row-list-menu", function() {
            clearTimeout(e), $("#HM-Menu .hm_advice .row-list-menu").hide()
        })
    }
    $("#Android_switch").click(function() {
        $(this).addClass("dsply_blk"), $("#iOS_switch").removeClass("dsply_blk"), $(".Android_preview").css("display", "block"), $(".iOS_preview").css("display", "none")
    }), $("#iOS_switch").click(function() {
        $(this).addClass("dsply_blk"), $("#Android_switch").removeClass("dsply_blk"), $(".Android_preview").css("display", "none"), $(".iOS_preview").css("display", "block")
    }), $(document).on("mouseenter", ".breadCr", function(a) {
        var b = $(this).find("span .lyrUIw .ttl");
        if ("" == b.html()) {
            var c = $(this).find("span a"),
                d = c.attr("title"),
                e = c.children("span").html(),
                f = c.attr("href");
            b.html('<a href="' + f + '" target="_blank" title="' + d + '" class="ttlLink">' + e + ' <i class="uiSprite vmid arrow_black_up"></i></a>')
        }
        $(this).find("div").css("display", "block"), $(this).css("zIndex", "11007"), $(this).siblings().css("zIndex", "11000")
    }), $(document).on("mouseleave", ".breadCr", function(a) {
        $(this).find("div").css("display", "none"), $(this).css("zIndex", "1"), $(this).siblings().css("zIndex", "1")
    }), $(document).on("mouseenter", ".iconDiv", function() {
        var a = $(this).siblings(".LyrIcon");
        $(this).parents(".srpWrap").attr("title", "");
        var b = $(this).attr("attr").split(",");
        if ("" != a.html() && "none" == a.css("display")) a.fadeIn();
        else {
            var c = "";
            for (i = 0; i < b.length - 1; i++) c = c + "<div class='wrapIn'><i class='i" + b[i] + "'></i><i class='clr'>" + $(".i" + b[i]).attr("value") + " </i></div>";
            a.addClass("fc_icons fcInit wrapHvr hide"), a.html(c).fadeIn()
        }
    }), $(document).on("mouseleave", ".LyrIcon", function() {
        $(this).parents(".srpWrap").attr("title", "View property details"), $(".LyrIcon").fadeOut()
    }), $(".searchDummy").click(function() {
        $("#srpSearchHeader").removeClass("flipClose").addClass("flipOpen")
    }), $("#layerBkg").on("click", function(a) {
        a.stopPropagation()
    }), $(".mTool-inCont").click(function(a) {
        return a.preventDefault(), !1
    }), $("#homeCustomerServiceLnk").mouseover(function(a) {
        0 == $(this).children("._actOnTip").length && ($(d).appendTo($(this)), $(this).find("._actOnTip").css("top", "57px"), $(this).parent().find(".arrow-up_wSmall").removeClass("toolTpRotate"), $(this).find(".mTool-inCont").html('<div class="b">Contact us toll free</div><div>MON-SAT | 9:00AM-6:00PM</div>'), a.preventDefault())
    }), $("#advPropTTPID").mouseover(function(a) {
        0 == $(this).children("._actOnTip").length && ($(d).appendTo($(this)), $(this).find("._actOnTip").css("top", "57px"), $(this).parent().find(".arrow-up_wSmall").removeClass("toolTpRotate"), $(this).find(".mTool-inCont").html("Post property for  <br/> <b>Sell or Rent Free<sup>#</sup></b>"), a.preventDefault())
    }), $(" #setLoanTTPID").mouseover(function(a) {
        0 == $(this).children("._actOnTip").length && ($(d).appendTo($(this)), $(this).find("._actOnTip").css("top", "57px"), $(this).parent().find(".arrow-up_wSmall").removeClass("toolTpRotate"), $(this).find(".mTool-inCont").html('Powered by <br/> <img src="/images/icici.png"></img>'), a.preventDefault())
    }), $(" #setDealsTTPID").mouseover(function(a) {
        0 == $(this).children("._actOnTip").length && ($(d).appendTo($(this)), $(this).find("._actOnTip").css("top", "57px"), $(this).parent().find(".arrow-up_wSmall").removeClass("toolTpRotate"), $(this).find(".mTool-inCont").html("Check our best deals and offers"), a.preventDefault())
    }), /iPhone|iPad|iPod/i.test(navigator.userAgent) || ($(" #shListTTPID a").mouseover(function(a) {
        0 == $(this).parent().children("._actOnTip").length && ($(d).appendTo($(this).parent()), $(this).parent().find("._actOnTip").css("top", "-4px"), $(this).parent().find(".arrow-up_wSmall").addClass("toolTpRotate"), $(this).parent().find(".mTool-inCont").html("View your Shortlists here"), a.preventDefault(), a.stopPropagation())
    }), $(" #setAlertTTPID a").mouseover(function(a) {
        0 == $(this).parent().children("._actOnTip").length && ($(d).appendTo($(this).parent()), $(this).parent().find("._actOnTip").css("top", "-8px"), $(this).parent().find(".arrow-up_wSmall").addClass("toolTpRotate"), $(this).parent().find(".mTool-inCont").html("Register to Get E-mail Alerts</br> For latest Properties"), a.preventDefault(), a.stopPropagation())
    })), isTchEnabled || $("#HmMenuTTPID").mouseover(function(a) {
        0 == $(this).children("._actOnTip").length && ($(d).appendTo($(this)), $(this).find(".mTool-Tip-Content .genIcon").css({
            margin: "0px",
            left: "10px"
        }), $(this).find(".mTool-inCont").html("Navigation  Menu").css({
            padding: "5px"
        }), a.preventDefault())
    }), $("hmcontainer a").click(function(a) {
        trackEventByGA("Menu", !1, $(this).attr("trackVal"), "Hamburger")
    }), $("#shListTTPID a").click(function(a) {
        trackClickAction("SHORTLISTPAGE", "", "SHORTLISTBUBBLE", document.URL)
    }), $(".Logo a").click(function(a) {
        trackEventByGA("CLICK", "HDR|LOGO")
    }), $(".national ul li a").click(function(a) {
        trackEventByGA("CLICK", "City-HDR|" + $(this).attr("trackval"))
    }), $(".international ul li a").click(function(a) {
        var b = $(this).attr("trackval");
        empty(b) || trackEventByGA("CLICK", "City-HDR|" + b)
    }), $("#HM-Menu").on("click", function(a) {
        a.stopPropagation()
    }), $("#HmMenuTTPID").on(clickEventStr, function(a) {
        closeAllLayersOnHtmlClk(a), $("#p_code_ce").css({
            display: "none"
        }), $("#p_code_ceff").removeClass("valerr"), $("#HM-Menu").css({
            right: "0px"
        }), $(".fullbg").css({
            "z-index": "10000"
        }), layerCloseOnClickBody.isEvntStpPropgtn = !0
    }), layerCloseOnClickBody.initializeEvents("#HM-Menu, #HmMenuTTPID", function(a) {
        $("#HM-Menu").css({
            right: "-220px"
        }), $(".fullbg").css({
            "z-index": "1"
        }), jsval.clearFrmErr("PropCode")
    }), $("#HM-Menu div a").click(function(a) {
        var b = $(this),
            c = void 0 !== b.attr("trackVal") ? b.attr("trackVal") : $("#HM-Menu").attr("trackVal"),
            d = $(this).attr("trackAction"),
            e = "Hamburger";
        "adviceHdr" == b.parent().parent().attr("id") && (e = "Advice"), trackEventByGA(d, !1, c, e)
    }), $("#crossTTPID").click(function(a) {
        a.stopPropagation(), $("#HM-Menu").css({
            right: "-220px"
        }), $(".fullbg").css({
            "z-index": "1"
        }), jsval.clearFrmErr("PropCode")
    }), $("#feedclick").click(function(a) {
        return feedback.showLayer(a, "HOMEPAGE", "noDefHead", "custom")
    }), $("#PropCodeSubmit").click(function(a) {
        var b = $(this),
            c = void 0 !== b.attr("scrollOnErr") ? "false" != b.attr("scrollOnErr") : null,
            d = $("#PropCode")[0];
        pg.valRegFrm(a, d, c) && $("#PropCode").submit(), jsevt.stopEvt(a)
    }), $(document).on("click", "#feedbackButton", function(a) {
        1 != $("#xidPages").length && 1 != $(".fullbg-SRP").length && 1 != $("#HeaderStickyHandler").length || $(".notify_wrpr").removeClass("clicked");
        var b = $("#feedback_param").val();
        feedback.showLayer(a, b, "noDefHead")
    }), $(document).on("click", "#feedbackSubmit", function() {
        $("#feedbackForm").submit()
    }), $("form#PropCode").submit(function(a) {
        var b = $(this).attr("trackVal");
        trackEventByGA($(this).attr("trackAction"), !1, b, "Hamburger")
    }), $(".clickTrackGA").click(function() {
        var a = $(this),
            b = a.attr("data-track-args"),
            c = b.split(","),
            d = c.length;
        void 0 !== b && d > 0 && trackEventByGA(c[0], "false" != c[1], c[2], c[3])
    }), $("#setSeoStaticData").length && "undefined" != typeof search && search.buildSearchStaticData(), $("#keyword").click(function(a) {
        var b = $(this).offset(),
            c = a.clientX - b.left,
            d = $(this).width();
        if (d -= 10, !(c <= d)) {
            $('input[name="isvoicesearch"]').attr("value", "Y");
            var e = $("#keyword").val(),
                f = e.length;
            this.selectionStart = this.selectionEnd = f + 1;
            var g = e.slice(-1);
            " " != g && "" != g && $("#keyword").val(e + " ")
        }
    }), $("#keyword").change(function() {
        "Y" == $('[name="isvoicesearch"]').val() && trackEventByGA("voiceSearch", "", this.value)
    }), $(document).on("click", ".ClickParentJquery", function() {
        return $("this").children("span .bLink").click(), !1
    }), $(document).on("keydown", "body", function(a) {
        if (27 == a.keyCode) {
            if ($("#OTPLayer").length > 0) return !1;
            ($(".lyrmodal").length > 0 || $(".custom").length > 0) && pg.closeModalLayer(), $("#layerBkg").length > 0 && $("#layerBkg").remove(), $("#HM-Menu").css({
                right: "-220px"
            })
        }
    }), $("._showTip").mouseover(function(a) {
        var b = $(this),
            c = $(b.parent()),
            d = 0,
            e = b.offset(),
            f = 0;
        c.children("._actOnTip").css("display", "block").css("visibility", "hidden"), d = c.children("._actOnTip").width(), f = d / 2 + (c.outerWidth(!0) - b.innerWidth()) / 2 - 5, e.left < 100 ? (f = b.width() + 5, c.children("._actOnTip").css("left", "100%").css("marginLeft", -f).css("visibility", "visible").show().find(".toolTU").css("left", 10).css("margin", "0")) : (c.children("._actOnTip").css("left", "50%").css("marginLeft", -f).css("visibility", "visible").show(), $(this).parents(".headerFloatRight").length > 0 && c.children("._actOnTip").css("left", "50%").css("marginLeft", "-195px").css("visibility", "visible").show())
    }).click(function(a) {
        $($(this).parent()).children("._actOnTip").hide()
    }).mouseout(function(a) {
        $($(this).parent()).children("._actOnTip").hide()
    }), $("._lsClk").on(clickEventStr, function(a) {
        "block" == $(this).children("._lsAct").css("display") ? $(this).children("._lsAct").css("display", "none") : ($("._lsAct").css("display", "none"), $(this).children("._lsAct").css("display", "block"), $(this).addClass("ls-Sel"), "city-list" == $(this).attr("id") ? layerCloseOnClickBody.isEvntStpPropgtn = !0 : a.stopPropagation()), qsSrp.closeDrpDownsSpl("buyRent")
    }), $("#city-list a").on(clickEventStr, function(a) {
        var b = $(this);
        void 0 !== b.attr("href") && "" != b.attr("href") && b[0].click()
    }), layerCloseOnClickBody.initializeEvents("#city-list", function(a) {
        var b = $("#city-list");
        "block" == b.children("._lsAct").css("display") && b.children("._lsAct").css("display", "none")
    }), $("._login a").click(function(a) {
        if (!($("#my99Page").length > 0)) {
            if (lhdr.doStaticPageLoginXhr && 4 != lhdr.doStaticPageLoginXhr.readystate) lhdr.doStaticPageLoginXhr.abort();
            else {
                var b = new Object,
                    c = new Object;
                c.postLoginFunction = layers.onLogin, usrMgr.init(c), b.src = "Z", b.skipFirstLayer = !0, usrMgr.doRegistrationLogin("", b)
            }
            return !1
        }
    }), $(".ff_link_wrapper a").click(function() {
        var a, b = $(this),
            c = sectionId = "",
            d = b.get(0),
            e = b.hasClass("_showmore"),
            f = b.closest(".ff_link_wrapper");
        e ? (ffWrpElId = f.attr("id"), ffWrpElId.match(/buy/i) ? c = "buy" : ffWrpElId.match(/rent/i) && (c = "rent"), sectionId = ffWrpElId.replace(c, "").replace(/_$/, ""), ffObj.ffShowMoreUrls(c, sectionId, d)) : (a = b.closest(".fFooter"), ffObj.trackGAEventWrapper(d, f.attr("gaeventacn"), a.attr("trackcat")))
    }), void 0 !== phoneNum && phoneNum.initialize(), eoiMgr.verificationMsg = "yesIamInterested" == $("#showYesIamInterested").val() ? "Thanks for showing interest. We'll let you know as soon as New Booking Offers are available on this project." : "Your mobile number (+MOBILE) is successfully verified.<br/>Your message has been sent to Dealer of this property through Email & SMS.";
    var h = window.navigator.userAgent,
        j = h.indexOf("MSIE "),
        k = [];
    if (!getCookieVal("userfeedbackEOIsession") && j <= 0 && $.ajax({
            type: "GET",
            url: "",
            dataType: "JSON",
            success: function(a, b, c) {
                if ("TRUE" == a.status) {
                    pg.openModalLayer({
                        id: "EOI Feedback Form",
                        ttl: "Hey, Welcome Again! We would love to hear your feedback.",
                        size: {
                            w: 796,
                            h: 512,
                            h1: "auto"
                        },
                        html: a.html
                    });
                    try {
                        jsui.bg.greyOut(.65, "black")
                    } catch (g) {}
                    $(".visitPropCardFlip, .visitPropCardBack .visitPropCardClose ").click(function(a) {
                        var b = $(this).parents(".visitPropCards");
                        $(this).parents(".visitPropCards").find(".visitPropCardBack").find(".iconS").hide(), b.toggleClass("flipped")
                    }), $(".visitPropBack ").click(function(a) {
                        var b = $(this).parents(".visitPropCards");
                        $(this).parents(".visitPropCards").find(".visitPropCardBack").find(".iconS").show(), b.toggleClass("flipped")
                    }), $(".visitPropCardFormBtns").click(function(a) {
                        $(this).toggleClass("selected"), $(this).closest(".visitPropCardForm").find(".visitPropError").addClass("hide")
                    }), $(".visitPropCardFormSubmit").click(function(a) {
                        $(this).closest(".visitPropCardForm").submit()
                    }), $(".visitPropCardFront .visitPropCardClose").click(function(a) {
                        var b = 0;
                        $("#contentDiv").find(".visitPropCards").each(function(a) {
                            b++
                        }), $(this).closest(".visitPropCards").detach(), 1 == b && pg.closeModalLayer()
                    }), $(".visitPropCardComment").focusin(function(a) {
                        "Write comment..." == $(this).val() && $(this).val("")
                    }), $(".visitPropCardComment").focusout(function(a) {
                        "" == $(this).val() && $(this).val("Write comment...")
                    });
                    var d = function(a, b) {
                        var c = 0;
                        $("#contentDiv").find(".visitPropCards").each(function(a) {
                            c++
                        }), setTimeout(function() {
                            a.detach(), --c || pg.closeModalLayer()
                        }, b)
                    };
                    if ("PROPERTY" == a.formType) {
                        $(".visitPropYes").click(function(a) {
                            $(this).closest(".visitPropCards").find(".visitPropCardForm").find(".selected").each(function(a, b) {
                                $(this).removeClass("selected")
                            }), $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#correctInfodiv").addClass("selected"), $(this).closest(".visitPropCards").find(".visitPropCardForm").submit()
                        }), $(".visitPropNo").click(function(a) {
                            var b = $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#propIdInput").val();
                            if (-1 === k.indexOf(b)) {
                                var c = $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#profileIdInput").val(),
                                    d = $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#qidInput").val(),
                                    e = $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#eoiTypeInput").val();
                                $.ajax({
                                    url: "",
                                    type: "POST",
                                    data: {
                                        reasons: "13",
                                        PROP_ID: b,
                                        PROFILEID: c,
                                        PAGE: "ReturningUser_PopUp_Desktop",
                                        details: ""
                                    },
                                    success: function(a) {
                                        k.push(b), $.ajax({
                                            url: "",
                                            type: "POST",
                                            data: {
                                                QID: d,
                                                EOI_TYPE: e
                                            },
                                            success: function(a) {}
                                        })
                                    }
                                })
                            }
                        });
                        var e = function(a, b, c) {
                                $.ajax({
                                    url: "",
                                    type: "POST",
                                    data: {
                                        REASONS: c,
                                        PROVIDER_PROFILEID: b,
                                        DEALER_PROFILEID: a,
                                        SOURCE: "ReturningUser_PopUp_Desktop",
                                        DETAILS: ""
                                    },
                                    success: function(a) {}
                                })
                            },
                            f = function() {
                                $(".visitPropCardDislike").click(function(a) {
                                    var b = $(this).closest(".visitPropCards"),
                                        c = $(this).parents("#finalScreen").find("#dealerProfileId").val(),
                                        f = $(this).parents("#finalScreen").find("#reporterProfileId").val();
                                    $(this).parents(".visitPropCards").find("#finalScreen").html('<p class="f16 color333 m10 textc" style="text-align: center">Thankyou for submitting the response.</p>'), e(c, f, 16), d(b, 3e3)
                                }), $(".visitPropLike").click(function(a) {
                                    var b = $(this).closest(".visitPropCards"),
                                        c = $(this).parents("#finalScreen").find("#dealerProfileId").val(),
                                        f = $(this).parents("#finalScreen").find("#reporterProfileId").val();
                                    $(this).parents(".visitPropCards").find("#finalScreen").html('<p class="f16 color333 m10 textc" style="text-align: center">Thankyou for submitting the response.</p>'), e(c, f, 15), d(b, 3e3)
                                })
                            };
                        $(".visitPropCardForm").submit(function(a) {
                            var b = $(this).find("#propIdInput").val(),
                                c = $(this).find("#profileIdInput").val(),
                                e = $(this).find("#dealerProfileIdInput").val(),
                                g = "ReturningUser_PopUp_Desktop",
                                h = $(this).find("#detailsInput").val(),
                                i = $(this).find("#sellerClassInput").val(),
                                j = $(this).find("#qidInput").val(),
                                k = $(this).find("#eoiTypeInput").val();
                            "Write comment..." == h && (h = "");
                            var l = [];
                            if ($(this).find(".selected").each(function(a, b) {
                                    l.push($(this).attr("data-value"))
                                }), -1 != $.inArray("8", l) && "" == h) return $(this).find(".visitPropError").html("Please let us know some details of the problem above"), void $(this).find(".visitPropError").removeClass("hide");
                            if (l.length > 0) {
                                var m = "",
                                    n = $(this).closest(".visitPropCards");
                                $(this).find(".selected").each(function(a) {
                                    m += $.trim($(this).text()) + ","
                                }), m = m.substring(0, m.length - 1), $(this).find("input[type='hidden']").val(m);

                                var o = '<form action="javascript:void(0)" class="visitPropCardForm" id="visitPropCardDealerQues"><div class="visitPropCardDealerQuesArea"><p class="f16 color333 mt0 mb10">Would you like to recommend this dealer?</p><div class="visitPropCardBtnWrapper textc"><i class="iconS  visitPropLike"></i><i class="iconS ml30 visitPropCardDislike"></i></div></div><input type="hidden" id="dealerProfileId" value="' + e + '"><input type="hidden" id="reporterProfileId" value="' + c + '"></form>',
                                    p = "";
                                p = "A" != i ? '<p class="f16 color333 m10 textc" style="text-align: center">Thankyou for submitting the response.</p>' : o, "12" == l[0] ? $(this).parents(".visitPropCards").find(".visitPropCardFront").html('<div id="finalScreen">' + p + "</div>") : $(this).parents(".visitPropCardBack").html('<div id="finalScreen">' + p + "</div>"), "A" != i ? d(n, 3e3) : f();
                                var q = l.join();
                                $.ajax({
                                    url: "",
                                    type: "POST",
                                    data: {
                                        reasons: q,
                                        PROP_ID: b,
                                        PROFILEID: c,
                                        PAGE: g,
                                        details: h
                                    },
                                    success: function(a) {
                                        "12" == l[0] && $.ajax({
                                            url: "",
                                            type: "POST",
                                            data: {
                                                QID: j,
                                                EOI_TYPE: k
                                            },
                                            success: function(a) {}
                                        })
                                    }
                                })
                            } else $(this).find(".visitPropError").html("Please select atleast one reason from above!"), $(this).find(".visitPropError").removeClass("hide")
                        })
                    } else $(".visitPropYes").click(function(a) {
                        $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#feedbackQuestion").text("What satisfied you?"), $(this).closest(".visitPropCards").find(".visitPropCardForm").find(".visitPropCardFormBtns").each(function(a, b) {
                            -1 == ["5", "3", "4", "1", "2", "6"].indexOf($(this).attr("data-value")) ? $(this).css("display", "none") : $(this).css("display", "inline-block"), $(this).removeClass("selected")
                        })
                    }), $(".visitPropNo").click(function(a) {
                        $(this).closest(".visitPropCards").find(".visitPropCardForm").find("#feedbackQuestion").text("What can be improved?"), $(this).closest(".visitPropCards").find(".visitPropCardForm").find(".visitPropCardFormBtns").each(function(a, b) {
                            -1 == ["10", "7", "9", "8"].indexOf($(this).attr("data-value")) ? $(this).css("display", "none") : $(this).css("display", "inline-block"), $(this).removeClass("selected")
                        })
                    }), $(".visitPropCardForm").submit(function(a) {
                        var b = $(this).find("#emailIdInput").val(),
                            c = $(this).find("#profileIdInput").val(),
                            e = $(this).find("#dealerProfileIdInput").val(),
                            f = "ReturningUser_PopUp_Desktop",
                            g = $(this).find("#detailsInput").val();
                        "Write comment..." == g && (g = "");
                        var h = [];
                        if ($(this).find(".selected").each(function(a, b) {
                                h.push($(this).attr("data-value"))
                            }), (-1 != $.inArray("12", h) || -1 != $.inArray("14", h)) && "" == g) return $(this).find(".visitPropError").html("Please let us know some details of the problem above"), void $(this).find(".visitPropError").removeClass("hide");
                        if (h.length > 0) {
                            var i = "",
                                j = $(this).closest(".visitPropCards");
                            $(this).find(".selected").each(function(a) {
                                i += $.trim($(this).text()) + ","
                            }), i = i.substring(0, i.length - 1), $(this).find("input[type='hidden']").val(i);
                            $(this).parents(".visitPropCardBack").html('<div id="finalScreen">' + '<p class="f16 color333 m10 textc" style="text-align: center">Thankyou for submitting the response.</p>' + "</div>"), d(j, 3e3);
                            var k = h.join();
                            $.ajax({
                                url: "",
                                type: "POST",
                                data: {
                                    REASONS: k,
                                    PROVIDER_PROFILEID: c,
                                    DEALER_PROFILEID: e,
                                    SOURCE: f,
                                    DETAILS: g
                                },
                                success: function(a) {
                                    a.STATUS && $.ajax({
                                        url: "",
                                        type: "POST",
                                        data: {
                                            DEALER_PROFILEID: e,
                                            EMAIL: b
                                        },
                                        success: function(a) {}
                                    })
                                }
                            })
                        } else $(this).find(".visitPropError").html("Please select atleast one reason from above!"), $(this).find(".visitPropError").removeClass("hide")
                    })
                }
            }
        }), autoVerification.doAnyAction = null != $("#eoiCart") && $("#eoiCart").length > 0, 1 == $("#xidPages").length || 1 == $(".fullbg-SRP").length || 1 == $("#HeaderStickyHandler").length) {
        notify_dashboard.setPageLoad(), $(".notify_wrpr").on("click", function(a) {
            notify_dashboard.openNotificationLayer(), trackEventByGA("NOTIFICATION_CLICK", currentPageName, "BD", "BUYERDASHBOARD"), $(".notify_wrpr").hasClass("clicked") && clickStream.doClickStreamTracking({
                event: "CLICK",
                page: "BUYER_DASHBOARD"
            }), a.stopPropagation()
        }), $(".notify_wrpr").hover(function() {
            notify_dashboard.showNotificationCount(), trackEventByGA("NOTIFICATION_HOVER", currentPageName, "BD", "BUYERDASHBOARD")
        }), $(window).on("click", function(a) {
            $(".notify_wrpr").removeClass("clicked"), $(".arrow-up_wSmall").css({
                display: "none"
            })
        })
    }
});
var feedback_src = "",
    feedback = {
        ThankYouLayer: function(a, b, c) {
            pg.openModalLayer({
                id: "oklayer",
                size: {
                    w: 420,
                    h: 170,
                    h1: "auto"
                },
                dataUrl: ""
            }, "noDefHead", "", a, c)
        },
        DisplayFinalLayer: function() {
            pg.openModalLayer({
                id: "oklayer",
                reload: !0,
                ttl: "Feedback",
                size: {
                    w: 420,
                    h: 130,
                    h1: "auto"
                },
                html: '<div class="okbox"><div class="mainmsg">Thank you.<br/>We appreciate your feedback.</div></div><br><div align="center" class="pb10"><input class="ygonok b f12" value="OK" type="button" onclick="pg.closeModalLayer()"></div>'
            }, "noDefHead")
        },
        showLayer: function(a, b, c, d) {
            isset(this.curlyr) && ($(this.curlyr).find(".rCross").click(), this.curlyr = null), "" != feedback_src && "" == b && (b = feedback_src);
            var e = "feedback_ajax";
            "HOMEPAGE" == b && (e = "feedback_ajax_homePage");
            pg.openModalLayer({
                id: e,
                ttl: "Feedback Form",
                size: {
                    w: 420,
                    h: 175,
                    h1: "auto"
                },
                reload: !0,
                dataUrl: "" + b
            }, c, "", b, d);
            return jsevt.stopEvt(a)
        },
        submit_form: function(a, b, c, d) {
            try {
                doc.byId("submit_SES")[IH] = "";
                var e = document.createTextNode("Submitting...");
                doc.byId("submit_SES").setAttribute("class", "vm5 b"), doc.byId("submit_SES").appendChild(e), ajax.postForm({
                    url: "",
                    thisfrm: a
                }, feedback.showSuccess(b, c, d), feedback.showFailure)
            } catch (f) {}
            return !1
        },
        showSuccess: function(a, b, c) {
            "HOMEPAGE" == a ? (feedback.ThankYouLayer(a, b, c), trackEventByGA("Feedback", !1, currentPageName, "Hamburger")) : feedback.DisplayFinalLayer(a, b, c)
        },
        showFailure: function(a) {
            alert(a)
        }
    };
openSettings = function(a, b) {
    function c(a) {
        var b = a.split("|#|");
        $("#settingBox .content").html(b[1])
    }

    function d(a) {
        if (a.match("Unauth")) return window.location = "/property/login.php", !1;
        $("#settingBox .content").html(a)
    }

    function e(a) {
        $("#settingBox .content").html(a)
    }

    function f(b) {
        var f, g, h;
        return 1 == b ? (f = "", g = c, h = pg.onRcvErr) : 0 == b ? (f = "", g = e, h = pg.onRcvErr) : 2 == b && (f = "", g = d, h = my99_onRcvErr), ajax.getText({
            url: f
        }, g, h), $("#settingBox .content").html(), jsevt.stopEvt(a)
    }
    if ("user_P" == $(a).attr("id")) var g = '<ul class="tabs"><li data-type="0">Opt out Dealer Response</li><li data-type="1">Settings for My Leads</li><li data-type="2">Change Password</li></ul><div class="content"></div>';
    else var g = '<ul class="tabs"><li style="width:100%; text-align:left" data-type="2">Change Password</li></ul><div class="content"></div>';
    var h = {
        id: "settingBox",
        reload: !0,
        ttl: "",
        size: {
            w: 550,
            h: "auto",
            h1: "auto",
            bkgColour: "#f0f0f0",
            position: "fixed"
        },
        html: g,
        cbk: pg.setUpLayer
    };
    2 == b && (h = $.extend({}, {
        action: "showTopMessage"
    }, h));
    pg.openModalLayer(h, "noDefHead");
    $('#settingBox ul.tabs li[data-type="' + b + '"]').addClass("active"), f(b), $("#settingBox ul.tabs li").click(function(a) {
        $(this).siblings().removeClass("active"), $(this).addClass("active"), f($(this).data("type"))
    })
}, changePassword = function(a, b) {
    var c = {
        id: "login",
        reload: !0,
        ttl: "Change Password",
        size: {
            w: 470,
            h: "auto",
            h1: "auto"
        },
        dataUrl: d,
        cbk: pg.setUpLayer,
        action: "showTopMessage"
    };
    $("#loggedinlayer").hide();
    var d = "";
    return void 0 !== b && (d = d + "?subuser_id=" + b), ajax.getText({
        url: d,
        ctx: {
            lyr_props: c
        }
    }, my99_openModalLayer, my99_onRcvErr), jsevt.stopEvt(a)
}, my99_onRcvErr = function(a, b) {}, my99_openModalLayer = function(a) {
    if (a.match("Unauth")) return window.location = "/property/login.php", !1;
    pg.openModalLayer({
        id: this.lyr_props.id,
        reload: !0,
        ttl: this.lyr_props.ttl,
        size: this.lyr_props.size,
        html: a,
        action: this.lyr_props.action
    });
    return pg.setUpLayer(), jsevt.stopEvt(evt)
}, setCsReferrer = function(a) {
    void 0 !== document.referrer && (a.referrer = document.referrer)
}, setCsReferrerSection = function(a) {
    void 0 !== a && void 0 === a.referrer_section && (pageUrl = window.location.href, pageUrl.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(b, c, d) {
        "refSection" == c && (a.referrer_section = d)
    }))
}, validateChangePasswordForm = function(a, b) {
    if (jsval.vf(b)) {
        if (b.password.value != b.confirm_password.value) return alert("New password is not matching with confirmation."), jsevt.stopEvt(a);
        var c = (b.name, new Object);
        b.current_password && (c.current_password = b.current_password.value), b.new_password && (c.password = b.password.value), b.password && (c.password = b.password.value), b.confirm_password && (c.confirm_password = b.confirm_password.value), b.subuser_id && (c.subuser_id = b.subuser_id.value);
        var d = "body-settingBox" == $(a.target).parent().parent().parent().attr("id") ? pg["l-settingBox"] : pg["l-login"];
        return d.actionOnSuccess = d.action, "body-settingBox" == $(a.target).parent().parent().parent().attr("id") ? ajax.getText({
            url: "",
            ctx: d,
            params: c
        }, submitChangePassword_Success, handleLoginError) : ajax.getText({
            url: "",
            ctx: d,
            params: c
        }, submitChangePassword_Success, pg.onRcvErr), !1
    }
    return jsval.inlineErrs(b, pg.esdiv), jsevt.stopEvt(a)
}, handleLoginError = function(a, b) {
    var c = "<div>" + b + "</div>",
        d = $("#change_password_div .errorMsg"),
        e = $(c).find("div.red.m5").text();
    d.length ? $(d).html(e) : $("#change_password_div").prepend('<div class="errorMsg" style="color:red; font-weight:600; font-size:13px; margin-bottom:15px;">' + e + "</div>")
}, submitChangePassword_Success = function(a) {
    doc.byId("change_password_div")[IH] = a, layers.fixShadows()
};
var srp = {
        toggleBuyerType: function(a) {
            t = $(a), t.attr("checked", !0), t.siblings().attr("checked", !1), t.siblings().removeClass("b"), $(a).parent().find('div[class="inlineErr"]').each(function() {
                $(this).hide()
            })
        },
        removeIdentityInlineErrors: function(a) {
            $(a).parents(".customCheck.youAreWho").siblings(".inlineErr").hide()
        },
        changeCssAndDefaultText: function(a, b, c) {
            text = "NP" == c ? "Project" : "Property";
            var d = a.value,
                e = "";
            d.trim() == "I am interested in this " + text + "." && "C" == b ? (a.value = " ", "DP" != c && (a[CN].indexOf("valerr") > 0 && (e = " valerr"), a.setAttribute("class", "crvDrpDwn smail_in smail_mfd f13 frm_tara" + e))) : "" == d.trim() && "B" == b && (a.value = " I am interested in this " + text + ".", "DP" != c && (a[CN].indexOf("valerr") > 0 && (e = " valerr"), a.setAttribute("class", "crvDrpDwn smail_in smail_mfd f13 frm_tara grey" + e)))
        },
        onSubmitFromMarkBox: function() {
            doc.byId("SQOption") && (doc.byId("SQOption").checked || doc.byId("STMEMOption").checked || doc.byId("SPOption") && doc.byId("SPOption").checked) && (pg.curMLyr != doc.byId("markBoxOption1") && pg.curMLyr != doc.byId("markBoxOption2") && pg.curMLyr != doc.byId("markBoxOption3") || srp.clearMarkBoxProperties(!0))
        },
        getEoiBlockerStatus: function(a) {
            var b = $(a).closest("form").serialize();
            $.ajax({
                type: "POST",
                url: "",
                async: !1,
                data: b
            }).done(function(a) {
                var b = a.indexOf("true");
                eoiMgr.blocker = b >= 0
            })
        },
        changeDetails: function(a, b) {
            var c = vpnEoi.currentUrl,
                d = vpnEoi.currentLayer;
            "" == c && "" !== d ? ($("#" + d).siblings().not("#ajaxResponse").remove(), $("#" + d).siblings().children().remove(), $("#" + d).show()) : (c += "&is_edit=Y", $.ajax({
                type: "POST",
                url: c,
                async: !1
            }).done(function(a) {
                return $("#genlayer" + vpnEoi.currentLayer).length > 0 ? $("#genlayer" + vpnEoi.currentLayer).find("#lgndiv").html(a) : $("#body-" + vpnEoi.currentLayer).html(a), jsevt.stopEvt(b)
            }))
        },
        sendQuerySubmit: function(a, b, c) {
            if (null == c.target) try {
                captchaFactory.captchaEvtId = c.srcElement.id, captchaFactory.captchaEvtAcn = "submit"
            } catch (g) {} else captchaFactory.captchaEvtId = c.target.id, captchaFactory.captchaEvtAcn = "submit";
            0 == $(a).parent().parent().find("#captchaOnQuery").length && (eoiMgr.cachedEoiForm = $(a).parent().parent().clone(), eoiMgr.eoiSource = "query", $(eoiMgr.cachedEoiForm).find(".scrollbar1").css("height", "150px"), $(eoiMgr.cachedEoiForm).find(".scrollbar1").tinyscrollbar(), $(eoiMgr.cachedEoiForm).find(".viewport.ptnr").css("height", "150px"));
            try {
                if (null != doc.byId("submit_SES") && void 0 != doc.byId("submit_SES")) {
                    doc.byId("submit_SES")[IH] = "";
                    var d = document.createTextNode("Submitting...");
                    doc.byId("submit_SES").setAttribute("class", "b"), doc.byId("submit_SES").appendChild(d)
                } else null != doc.byId("submit_SRP_query") && void 0 != doc.byId("submit_SRP_query") ? (doc.byId("submit_queri").style.display = "none", null != doc.byId("close_btn") && void 0 != doc.byId("close_btn") && (doc.byId("close_btn").style.display = "none"), null != doc.byId("sbt_free") && void 0 != doc.byId("sbt_free") && (doc.byId("sbt_free").style.display = "none"), null != doc.byId("submitting_btn") && void 0 != doc.byId("submitting_btn") && (doc.byId("submitting_btn").style.display = "block", doc.byId("submitting_btn").style.color = "#7b7b7b")) : null != doc.byId("SendSmsEmailButtonId") && doc.byId("SendSmsEmailButtonId");
                if (queryEoi.evtTarget = c.target || c.srcElement, queryEoi.source = b, null != a[PN][PN] && (queryEoi.frmParent = a[PN][PN]), a.async = !0, "dif" == b) ajax.postForm(a, srp.onSendQueryDIFFrm, srp.onSendQueryFrmErr), usrMgr.modifyButtonFunction = pg.closeModalLayer;
                else if ("pd" == b) ajax.postForm(a, srp.onSendQueryPDFrm, srp.onSendQueryFrmErr);
                else {
                    if ("NP_EOI_LAYER_NEW" == b && (queryEoi.frmParent = a[PN], $(".npContactFormInner").find("#advCntct").val("Submitting Your Query..."), $("#datepicker").length > 0)) {
                        var e = $("#datepicker").val(),
                            f = "I am interested in visiting the site on " + e + ". Please arrange";
                        $(".npContactFormInner").find("textarea").val(f)
                    }
                    ajax.postForm(a, srp.onSendQueryFrm, srp.onSendQueryFrmErr), usrMgr.modifyButtonFunction = queryEoi.modifyEoiHandler
                }
            } catch (b) {}
        },
        onSendQueryPDFrm: function(txt) {
            1 == eoiMgr.blocker || 0 == eoiMgr.blocker && $(queryEoi.evtTarget).trigger("submit"), googleConversion.doAction("locality_query_conversion"), googleConversion.doAction("brand_query_conversion"), googleConversion.doAction("content_query_conversion"), googleConversion.doAction("projects_query_conversion"), usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = queryEoi.registrationEOIHandler, usrMgr.onSuccessVerificationFunction = !1, usrMgr.postVerificationFunction = queryEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = queryEoi.loginEOIHandler, mobObjMgr.init(), pg.openModalLayer({
                id: "PDSENDQUERY",
                ttl: "Contact Dealer",
                size: {
                    w: "auto",
                    h: "auto",
                    h1: "auto"
                },
                html: txt,
                cbk: pg.setUpLayer
            }, "noDefHead"), layers.fixShadows(), srp.onSubmitFromMarkBox();
            try {
                eval(doc.byId("jquery_scroll")[IH])
            } catch (ex) {}
        },
        sendQuerySubmitFromPD: function(frm, src, evt) {
            if (null == evt.target) try {
                captchaFactory.captchaEvtId = evt.srcElement.id, captchaFactory.captchaEvtAcn = "submit"
            } catch (ex) {} else captchaFactory.captchaEvtId = evt.target.id, captchaFactory.captchaEvtAcn = "submit";
            queryEoi.evtTarget = evt.target || evt.srcElement, queryEoi.form = frm, queryEoi.source = src, eoiMgr.checkIfScrollNeeded(), eoiMgr.checkIfSliderNeeded(), usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = queryEoi.registrationEOIHandler, usrMgr.onSuccessVerificationFunction = !1, usrMgr.postVerificationFunction = queryEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = queryEoi.loginEOIHandler;
            var data = $(frm).serialize();
            data += "&from_ajax=Y&inline_VSP=N", $.ajax({
                type: "POST",
                url: "",
                data: data
            }).done(function(txt) {
                var txtObj = {};
                try {
                    txtObj = eval("(" + txt + ")")
                } catch (err) {}
                if (txtObj.showCaptcha) srp.openCaptchaLayer(txtObj);
                else {
                    if (pg.closeModalLayer(), googleConversion.doAction("locality_query_conversion"), googleConversion.doAction("brand_query_conversion"), googleConversion.doAction("content_query_conversion"), googleConversion.doAction("projects_query_conversion"), txt) {
                        if ("microsite" == queryEoi.source) usrMgr.modifyButtonFunction = pg.closeModalLayer, "function" == typeof openThankMSGPopup ? openThankMSGPopup(txt, queryEoi.form) : pg.openModalLayer({
                            id: "CUSTOMISED",
                            ttl: "",
                            size: {
                                w: "auto",
                                h: "auto",
                                h1: "auto"
                            },
                            bkg: "greyOut",
                            html: txt
                        }, "noDefHead");
                        else if ("pd" == queryEoi.source) {
                            eoiMgr.eoiSource = "queryFromPd", usrMgr.modifyButtonFunction = queryEoi.modifyEoiHandler, $(".setAlerts").hide(), $(queryEoi.form).hide(), $(queryEoi.form).next().show().html(txt), $(".fadeSlider .abs.arrowDown").remove();
                            var eoiBlocker = $("#eoiBlocker");
                            void 0 !== eoiBlocker && "true" != eoiBlocker.val() && "BROCHURE_DOWNLOAD" == xid99.cnfSltLyrSrc && window.open($("#brochureurl").val(), "_blank");
                            var height = -1 * $(".dpSticky").outerHeight(),
                                pdPageNew = $(".pdPageNew");
                            pdPageNew.length > 0 && (height = -1 * $("div.stickyHead").outerHeight())
                        }
                        $(".rCross").remove()
                    }
                    eoiMgr.checkIfBlocker()
                }
            })
        },
        onSendQueryDIFFrm: function(txt) {
            var txtObj = {};
            try {
                txtObj = eval("(" + txt + ")")
            } catch (err) {}
            if (txtObj.showCaptcha) srp.openCaptchaLayer(txtObj);
            else {
                googleConversion.doAction("locality_query_conversion"), googleConversion.doAction("brand_query_conversion"), googleConversion.doAction("content_query_conversion"), googleConversion.doAction("projects_query_conversion"), queryEoi.saveCurrentLayer($("#lgndiv").html()), eoiMgr.checkIfScrollNeeded(), eoiMgr.checkIfSliderNeeded(), usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = queryEoi.registrationEOIHandler, usrMgr.onSuccessVerificationFunction = !1, usrMgr.postVerificationFunction = queryEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = queryEoi.loginEOIHandler, mobObjMgr.init(), pg.openModalLayer({
                    id: "DIFSENDQUERY",
                    ttl: "Contact Dealer",
                    size: {
                        w: "auto",
                        h: "auto",
                        h1: "auto"
                    },
                    bkg: "greyOut",
                    html: txt
                }, "noDefHead"), eval($("#eCommTrackDiv script").html()), setTimeout(function() {
                    eoiMgr.checkIfBlocker()
                }, 1500), layers.fixShadows(), srp.onSubmitFromMarkBox();
                try {
                    eval(doc.byId("jquery_scroll")[IH])
                } catch (ex) {}
            }
        },
        npQueryCallBack: function(a) {
            try {
                $(".openLayer2BarRight>div").children().hide(), $(".openLayer2BarRight>div").append(a), $("#confSlotLayerPage1 .npTuplContactType2").length > 0 && 0 == $("#confSlotLayerPage1 .skipVerification").length && xid99.checkEoiLayerOption(3), xid99.slider($(".vspCnFilm"), $(".vspCnTplSmall"), $(".vspCnTplLeftArr"), $(".vspCnTplRightArr"), {
                    visiblePackCnt: 2,
                    gaKey: xid99.cnfSlt.getGATrackingPrefix() + "SCROLL_CONFIG_VSP"
                })
            } catch (b) {}
        },
        onSendQueryFrm: function(txt) {
            var txtObj = {};
            try {
                txtObj = eval("(" + txt + ")")
            } catch (err) {}
            if (txtObj.showCaptcha) {
                var captchaKey = txtObj.captchaKey;
                $(queryEoi.frmParent).children().hide(), 0 != $(queryEoi.frmParent).find("#captchaOnQuery").length ? $(queryEoi.frmParent).find("#captchaOnQuery").show() : $(queryEoi.frmParent).append("<div id='captchaOnQuery'></div>");
                var ctx = $(queryEoi.frmParent).find("#captchaOnQuery").get(0);
                "true" == txtObj.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptcha(ctx, captchaKey)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptcha(ctx, captchaKey), "NP_EOI_LAYER_NEW" == queryEoi.source && ($("#captchaOnQuery").addClass("verifMod"), $("#captcha_afterload em").remove()))
            } else {
                if (googleConversion.doAction("locality_query_conversion"), googleConversion.doAction("brand_query_conversion"), googleConversion.doAction("content_query_conversion"), googleConversion.doAction("projects_query_conversion"), queryEoi.saveCurrentLayer($("#lgndiv").html()), "undefined" == typeof xid99 || "conadv" != xid99.queryType && "sitevisit" != xid99.queryType) try {
                    $(queryEoi.frmParent).html(txt)
                } catch (e) {} else srp.npQueryCallBack(txt);
                "NP_EOI_LAYER_NEW" == queryEoi.source && ($(".__eoiCapDiv").addClass("verifMod"), $("#confSlotLayerPage1 #rCrossEoiCap").remove(), $("#confSlotLayerPage1 .rCross").remove(), "DownloadCompare" == xid99.cnfSltLyrSrc && $("#confSlotLayerPage1 .npTuplContactType2").length > 0 && 0 == $("#confSlotLayerPage1 .skipVerification").length && (xid99.checkEoiLayerOption(3), $("#vspNpEoiLayer").hide(), $("#pdfdownload2").click())), "yesIamInterested" == $("#showYesIamInterested").val() && 0 == $("#rCrossEoiCap").length && $(".alertBox").hide(), eoiMgr.checkIfBlocker(), eoiMgr.checkIfScrollNeeded(), eoiMgr.checkIfSliderNeeded();
                for (var scripttext = $(".QUERY #np_fix_tuple script"), i = 0; i < scripttext.length; i++) eval($(scripttext[i]).html());
                eval($("#eCommTrackDiv script").html()), usrMgr.onSuccessRegistrationFunction = !1, usrMgr.postRegistrationFunction = queryEoi.registrationEOIHandler, usrMgr.onSuccessVerificationFunction = !1, usrMgr.postVerificationFunction = queryEoi.verificationEOIHandler, usrMgr.onSuccessLoginFunction = !1, usrMgr.postLoginFunction = queryEoi.loginEOIHandler, layers.fixShadows(), mobObjMgr.init(), srp.onSubmitFromMarkBox();
                try {
                    var link_brochure = doc.byId("brochure_link"),
                        originalli_a = document.getElementById("brochure_closed_a");
                    link_brochure && originalli_a && (originalli_a.href = link_brochure.href, $("#brochure_closed_a").removeAttr("onclick"), $("#brochure_closed_a").attr("onclick", "xid99.doGATracking('DOWNLOAD_PAYPLAN');")), document.getElementById("np_fix_tuple") && eval(document.getElementById("np_fix_tuple").innerHTML), eval(doc.byId("jquery_scroll")[IH])
                } catch (ex) {}
            }
        },
        onSendQueryFrmErr: function(a, b, c, d) {
            null != this[PN] && void 0 != this[PN][PN] && (this[PN][PN][IH] = b)
        },
        openCaptchaLayer: function(a) {
            var b = "CAPTCHALAYER";
            $("div#" + b).length > 0 && (pg.closeModalLayer(), $("div#" + b).remove(), pg["l-" + b] = void 0, pg.curMLyr = void 0), pg.openModalLayer({
                id: b,
                ttl: "Please fill this Captcha",
                size: {
                    w: 460,
                    h: 160,
                    h1: "auto",
                    w1: "auto"
                },
                bkg: "greyOut",
                html: '<div id="captchaOnQuery"></div>'
            }, "noDefHead");
            var c = $("div#" + b + " .body #captchaOnQuery").get(0),
                d = a.captchaKey;
            "true" == a.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptcha(c, d)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptcha(c, d))
        },
        sendAlertSubmit: function(a) {
            try {
                doc.byId("submit_SES")[IH] = "<b>Submitting...&nbsp;&nbsp;&nbsp;</b>", setTimeout(function() {
                    ajax.postForm(a, srp.onSendAlertFrm, srp.onSendAlertFrmErr)
                }, 50)
            } catch (b) {}
        },
        onSendAlertSaveSubmit: function(a) {
            try {
                (el = doc.byId("get_alert_loading")) && (el.style.display = "inline"), setTimeout(function() {
                    ajax.postForm(a, srp.onSendAlertSaveFrm, srp.onSendAlertFrmErr)
                }, 50)
            } catch (b) {}
        },
        onSendAlertSaveFrm: function(a) {
            (el = doc.byId("get_alert_loading")) && (el.style.display = "none");
            try {
                "Y" == a ? openEnhancedLayerForSaveAlert("GETALERTLAYER") : top != window ? top.pg.openModalLayer({
                    id: "EnhancedAlertThankYouLayer",
                    ttl: "Get Property Alert Mails ",
                    size: {
                        w: "auto",
                        h: "auto",
                        h1: "auto"
                    },
                    html: a
                }, "noDefHead") : pg.openModalLayer({
                    id: "EnhancedAlertThankYouLayer",
                    ttl: "Get Property Alert Mails ",
                    size: {
                        w: "auto",
                        h: "auto",
                        h1: "auto"
                    },
                    html: a
                }, "noDefHead")
            } catch (b) {}
        },
        sendSubmitForm: function(a, b) {
            try {
                if ("" !== b) var c = $("#" + b);
                formClass = $(a).attr("class"), "eoiLyr_form" == formClass ? c.children().val("Proceeding") : (c.children().hide(), c.append("<b> Submitting...&nbsp;&nbsp;&nbsp;</b>")), captchaFactory.captchaEvtId = b, captchaFactory.captchaEvtAcn = "submit", "newLayer" == vpnEoi.flow ? ajax.postForm(a, srp.onSendAlertNewFrm, srp.onSendAlertFrmErr) : (usrMgr.modifyButtonFunction = vpnEoi.modifyEoiHandler, ajax.postForm(a, srp.onSendAlertFrm, srp.onSendAlertFrmErr))
            } catch (d) {}
        },
        onSendAlertNewFrm: function(response) {
            var parentBody = window.parent.document.body;
            if ($(parentBody).find("#myframe").length > 0) var parentBody = "body";
            var thisLyr = this[PN][PN];
            $(parentBody).find("#" + thisLyr.id).find("#pdSetAlert").hide();
            try {
                if (txt = eval("(" + response + ")"), txt.showCaptcha) {
                    $(parentBody).find("#" + vpnEoi.currentLayer).append(' <div class="eoiLyr_paddingContainer"><div id="captchaDiv"></div>'), $(this).hide();
                    var captchaKey = txt.captchaKey,
                        ctx = $(parentBody).find("#" + vpnEoi.currentLayer).find("#captchaDiv")[0];
                    "true" == txt.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptcha(ctx, captchaKey)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptcha(ctx, captchaKey))
                }
            } catch (err) {
                var classNm = $(response).filter("#mainDivClass").val();
                if (void 0 != classNm && (thisLyr.className = classNm), thisLyr[IH] = response, "eoi_vspLayer" == classNm) {
                    vspSlider(thisLyr.id);
                    var parentElement = $(response).find("#mainDivClass").parent(),
                        propId = parentElement ? parentElement.attr("id") : vpnEoi.currentLayer;
                    propId = propId.replace("genlayerviewphno", ""), propId = propId.replace("_bottom", ""), trackTopDealerOnTy(propId), loadReactRecomOnEoiTy(thisLyr.id, propId), $(parentBody).find("#" + thisLyr.id).find("#pdSetAlert").hide()
                }
            }
        },
        onSendAlertFrm: function(txt) {
            try {
                var thisLyr = this[PN][PN],
                    thisPrnt = this[PN];
                try {
                    if (txt = eval("(" + txt + ")"), txt.showCaptcha) {
                        $(this).hide(), 0 != $(thisPrnt).find("#captchaOnC2V").length ? $(thisPrnt).find("#captchaOnC2V").show() : $(thisPrnt).append("<div id='captchaOnC2V'></div>");
                        var captchaKey = txt.captchaKey,
                            ctx = $(thisPrnt).find("#captchaOnC2V").get(0);
                        "true" == txt.captchaType ? (captchaFactory.url = "//www.google.com/recaptcha/api.js", captchaFactory.showNoCaptcha(ctx, captchaKey)) : (captchaFactory.url = "//www.google.com/recaptcha/api/js/recaptcha_ajax.js", captchaFactory.showCaptcha(ctx, captchaKey))
                    }
                } catch (err) {
                    if ("pseudoListing" == vpnEoi.flow) $("#" + vpnEoi.initButton).parents("form").hide(), $("#" + vpnEoi.initButton).parents("form").siblings().not("#ajaxResponse").remove(), $("#" + vpnEoi.initButton).parents("form").siblings().children().remove(), $("#" + vpnEoi.initButton).parents("form").parent().append(txt);
                    else if ("newLayer" == vpnEoi.flow) {
                        var classNm = $(txt).filter("#mainDivClass").val();
                        void 0 != classNm && (thisLyr.className = classNm), thisLyr[IH] = txt, "eoi_vspLayer" == classNm && vspSlider(thisLyr.id)
                    } else thisLyr[IH] = txt;
                    $(".body").find("#modifyBtnId").length > 0 && $(".body").find("div[id*='identity_help']").remove();
                    var tracking = $(txt).find(".C2V_tracking").val(),
                        propid = $(txt).find(".C2V_propid").val();
                    sliderWithClass("boxContainer_" + propid, "btn_prev_" + propid, "btn_nxt_" + propid, 2, "boxBodr", propid, tracking), eoiMgr.checkIfBlocker()
                }
                env.ie && env.ieVer <= 6 && (thisLyr.bg = null, jsui.greyThis(thisLyr, "#000", 0)), layers.fixShadows(), srp.onSubmitFromMarkBox(), "Y" == txt && openEnhancedLayerForSaveAlert("SAVESEARCHLAYER"), pg.setUpLayer(thisLyr)
            } catch (e) {}
        },
        onSendAlertFrmErr: function(a, b, c, d) {
            this[PN][PN][IH] = b
        },
        ifPropSelectedForProject: function(a, b) {
            if (void 0 === b || "" == b) return !1;
            var c = doc.byId("mult");
            if (void 0 === c.propids) return !1;
            var d = "",
                e = "",
                f = "",
                g = "",
                h = "",
                j = "",
                k = new Array(c.propids.length),
                l = new Array(c.propids.length),
                m = new Array(c.propids.length),
                n = new Array(c.propids.length),
                o = new Array(c.propids.length),
                p = new Array(c.propids.length);
            new Array(c.propids.length);
            prop1 = document[ELBN]("propid[]"), k = document[ELBN]("mob[]"), m = document[ELBN]("cntct[]"), n = document[ELBN]("ownc[]"), l = document[ELBN]("nm[]"), o = document[ELBN]("price[]"), p = document[ELBN]("prop_desc[]");
            var q = c.propids.join("-"),
                r = b.split("|"),
                s = !1,
                q = "";
            for (i = 0; i < prop1.length; i++) {
                var t = prop1[i].value;
                prop1[i].checked && Array.contains(r, t) && (s = !0, "" == g ? (q = t, e = k[i].value, d = l[i].value, f = m[i].value, g = n[i].value, j = o[i].value, h = p[i].value) : (q = q + "-" + t, e = e + "|" + k[i].value, d = d + "|" + l[i].value, f = f + "|" + m[i].value, g = g + "|" + n[i].value, j = j + "|" + o[i].value, h = h + "|" + p[i].value))
            }
            return !!s && (srp.openSmsEmailLayer(q, e, d, f, g, h, j), jsevt.stopEvt(a), !0)
        },
        hideMultiHint: function() {
            doc.byId("mult_hint").style.visibility = "hidden", doc.byId("mult1_hint").style.visibility = "hidden"
        },
        multContact: function(a, b, c) {
            try {
                if (void 0 == b.propids || b.propids.length <= 1) return doc.byId(b.id + "_hint").style.visibility = "visible", window.setTimeout(srp.hideMultiHint, 1e4), jsevt.stopEvt(a)
            } catch (q) {}
            var d = "",
                e = "",
                f = "",
                g = "",
                h = new Array(b.propids.length),
                j = new Array(b.propids.length),
                k = new Array(b.propids.length),
                l = new Array(b.propids.length),
                m = new Array(b.propids.length);
            m = null != c || void 0 != c ? document[ELBN]("propid-" + c + "[]") : document[ELBN]("propid[]"), h = document[ELBN]("mob[]"), k = document[ELBN]("cntct[]"), l = document[ELBN]("ownc[]"), j = document[ELBN]("nm[]");
            var n = b.propids.join("-"),
                o = b.tupledesc.join("|"),
                p = b.tuplers.join("|");
            for (i = 0; i < m.length; i++) m[i].checked && ("" == g ? (e = h[i].value, d = j[i].value, f = k[i].value, g = l[i].value) : (e = e + "|" + h[i].value, d = d + "|" + j[i].value, f = f + "|" + k[i].value, g = g + "|" + l[i].value));
            return srp.openSmsEmailLayer(n, e, d, f, g, o, p), jsevt.stopEvt(a)
        },
        openSmsEmailLayer: function(a, b, c, d, e, f, g) {
            url = "/load/sendemailsms/showLayer/" + a + "/" + _pid + "/0/" + userActionParams.lstAcn + "/" + userActionParams.lstAcnId + "?mult=true&sid=" + _sid + "&mob=" + b + "&nm=" + c + "&cntct=" + d + "&ownc=" + e + "&desc=" + f + "&rs=" + g, null != w.np_layout && (url = url + "&from_src=" + np_layout);
            pg.openModalLayer({
                id: "mult",
                ttl: "Contact Selected Advertisers Now - Free",
                reload: !0,
                size: {
                    w: 660,
                    h: 278,
                    h1: "auto"
                },
                dataUrl: url
            }, "noDefHead")
        },
        markBoxMultContact: function(a) {
            for (var b = document[ELBN]("markedPropIds[]"), c = document[ELBN]("contactDetails[]"), d = "", e = "", f = "", g = "", h = "", i = "", j = "", k = 0; k < b.length; k++) {
                d += "" == d ? b[k].value : "-" + b[k].value;
                var l = c[k].value,
                    m = l.split("|"),
                    n = doc.byId("markedPropDesc_" + b[k].value)[IH],
                    o = n.split(";");
                "" == i ? (i = o[0], j = o[1]) : (i = i + "|" + o[0], j = j + "|" + o[1]), "" == h ? (f = m[0], e = m[1], g = m[2], h = m[3]) : (f = f + "|" + m[0], e = e + "|" + m[1], g = g + "|" + m[2], h = h + "|" + m[3])
            }
            var p = "";
            if (doc.byId("SPOption") && doc.byId("SPOption").checked && (p = "&SPOFlag=true"), doc.byId("SQOption").checked) {
                var q = "";
                doc.byId("STMEMOption").checked && (q = "&STMEMFlag=true");
                var r = pg.openModalLayer({
                    id: "mult0",
                    reload: !0,
                    ttl: "Contact Selected Advertisers Now - Free",
                    reload: !0,
                    size: {
                        w: 660,
                        h: 278,
                        h1: "auto"
                    },
                    cbk: pg.setUpLayer,
                    dataUrl: "/load/markbox/showLayer/" + d + "/" + _pid + "/0/MBOX/0?from=markBox" + q + p + "&mult=true&sid=" + _sid + "&mob=" + f + "&nm=" + e + "&cntct=" + g + "&ownc=" + h + "&desc=" + j + "&rs=" + i + "&dcpy=Y"
                }, "noDefHead");
                r.id = "markBoxOption1"
            } else if (doc.byId("STMEMOption").checked) {
                var s = "",
                    t = "";
                doc.byId("SPOption") && doc.byId("SPOption").checked ? (s = "Set Property Alert/ Send to My Email & Mobile", t = "mult1") : (s = "Send to My Email & Mobile", t = "mult1next");
                var r = pg.openModalLayer({
                    id: t,
                    reload: !0,
                    ttl: s,
                    reload: !0,
                    size: {
                        w: 450,
                        h: 278,
                        h1: "auto"
                    },
                    dataUrl: "/load/markbox/showProfileLayer/" + d + "/" + _pid + "/0/MBOX/0?from=markBox" + p + "&mult=true&dcpy=Y"
                }, "noDefHead");
                r.id = "markBoxOption2"
            } else if (doc.byId("SPOption") && doc.byId("SPOption").checked) {
                var r = pg.openModalLayer({
                    id: "mult2",
                    reload: !0,
                    ttl: "Set Property Alert",
                    reload: !0,
                    size: {
                        w: 450,
                        h: 278,
                        h1: "auto"
                    },
                    dataUrl: "/load/markbox/showProfileLayer/" + d + "/" + _pid + "/0/MBOX/0?from=markBox&onlySPOFlag=true&mult=true&dcpy=Y"
                }, "noDefHead");
                r.id = "markBoxOption3"
            }
            return jsevt.stopEvt(a)
        },
        onTupleSelectPrivate: function(a, b, c) {
            var d, e, f, g = 0,
                h = [],
                i = [],
                j = [];
            if (b ? ((e = doc.byId(c)) || (e = {}), e[D] = !0, e[CN] = "yfreedis") : ((e = doc.byId("mult")) || (e = {}), (f = doc.byId("mult1")) || (f = {})), a) {
                d = a[ELBT]("INPUT");
                for (var k = "", l = "", m = 0; m < d.length; m++) {
                    var n = d[m];
                    n.type == CHK && n[C] && ((!b && g > 0 || b && 0 == g) && (b ? (e[D] = !1, e[CN] = "yfree") : (f[D] = e[D] = !1, f[CN] = e[CN] = "cpointer mailsms_act")), g++, h.push(n.value), k = doc.byId("desc_" + n.value), k && i.push(k.title), (l = doc.byId("rs_" + n.value)) && j.push(l[IH]))
                }
                var o = 5,
                    p = null;
                (p = doc.byId("maxNoOfProperties")) && (o = p[IH]);
                for (var m = 0; m < d.length; m++) {
                    var n = d[m];
                    n.type == CHK && (g != o || n[C] ? g < o && (n[D] = !1) : n[D] = !0)
                }
            }
            b ? (e.propids = h, e.tupledesc = i, e.tuplers = j) : (f.propids = e.propids = h, f.tupledesc = e.tupledesc = i, f.tuplers = e.tuplers = j)
        },
        onTupleSelect: function(a, b, c) {
            "undefined" != typeof refreshMarkBox && refreshMarkBox && (refreshMarkBox = !1), void 0 !== b && null != doc.byId("markBoxProperties") && void 0 != doc.byId("markBoxProperties") && "none" != doc.byId("markBox").style.display && srp.markBoxFill(b, c);
            var d = doc.byId("results");
            srp.onTupleSelectPrivate(d, !1, ""), jsevt.stopBubble(a)
        },
        showCountSelected: function(a, b) {
            var c = $("." + a + ":checked").length;
            $("#" + b).text(c + (0 === c || 1 === c ? " Property" : " Properties ") + " Selected ")
        },
        setQueryReceiver: function(a, b) {
            a = window.event || a;
            var c = a.target || a.srcElement;
            "multi_from_src[]" == b ? (b = "from_src[]", error_name = "xiderrDesc") : error_name = "errDesc";
            for (var d = document[ELBN](error_name), e = 0; e < d.length; e++) d[e].style.display = "none";
            var f = c.form,
                g = "",
                h = "",
                i = "";
            void 0 != f.ori_cntct && (g = f.ori_cntct.value), void 0 != f.ori_ownc && (h = f.ori_ownc.value), void 0 != f.ori_nm && (i = f.ori_nm.value);
            var j = g.split("|"),
                k = h.split("|"),
                l = i.split("|"),
                m = "",
                n = "",
                o = "",
                p = "",
                q = "",
                r = "",
                s = "",
                t = "",
                u = "",
                v = f[b];
            void 0 == v.length && void 0 != v.value && (v[0] = f[b], v.length = 1);
            for (var e = 0; e < v.length; e++) {
                var w = v[e];
                w.type == CHK && w[C] && (m = m + "-" + w.value, void 0 == w.getAttribute("ppc_bud_min") && null == w.getAttribute("ppc_bud_min") || (o = o + "-" + w.getAttribute("ppc_bud_min")), void 0 == w.getAttribute("ppc_bud_max") && null == w.getAttribute("ppc_bud_max") || (p = p + "-" + w.getAttribute("ppc_bud_max")), void 0 == w.getAttribute("ppc_xid") && null == w.getAttribute("ppc_xid") || (n = w.getAttribute("ppc_xid"), r = r + "|" + w.getAttribute("ppc_xid")), void 0 == w.getAttribute("ppc_config_profile_map") && null == w.getAttribute("ppc_config_profile_map") || (q = q + "|" + w.getAttribute("ppc_config_profile_map")), s = s + "|" + j[e], t = t + "|" + k[e], u = u + "|" + l[e])
            }
            if (m = m.substring(1), s = s.substring(1), t = t.substring(1), u = u.substring(1), min_bud_str = o.substring(1), max_bud_str = p.substring(1), ppc_config_profile_map_str = q.substring(1), ppc_xid_selected_str = r.substring(1), f.prop_id_mult.value = m, "" != n && (f.xid_id.value = n), "" != ppc_xid_selected_str && (f.xidSelected.value = ppc_xid_selected_str), "" != ppc_config_profile_map_str && (f.confIdProfileIdMap.value = ppc_config_profile_map_str), f.cntct.value = s, f.ownc.value = t, f.nm.value = u, "" == m)
                for (var e = 0; e < d.length; e++) d[e].style.display = "block";
            if ("" != min_bud_str && "" != max_bud_str) {
                var x = document.getElementById("xid_city_hidden").value;
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        xid_city: x,
                        bud_min: min_bud_str,
                        bud_max: max_bud_str
                    }
                }).done(function(a) {
                    f.encrypted_input.value = a
                })
            }
        },
        validateDescChkbx: function() {
            try {
                var a = 1,
                    b = new Array;
                if (b = document[ELBN]("from_src[]"), b.length > 0 && (void 0 != b || null != b)) {
                    a = 0;
                    for (var c = 0; c < b.length; c++) {
                        if (1 == document[ELBN]("from_src[]").item(c).checked) {
                            a = 1;
                            break
                        }
                    }
                }
                var d = document[ELBN]("xiderrDesc");
                if (0 == d.length) var d = document[ELBN]("errDesc");
                if (0 == a)
                    for (var c = 0; c < d.length; c++) d[c].style.display = "block";
                for (var c = 0; c < d.length; c++)
                    if ("block" == d[c].style.display) return !1;
                return !0
            } catch (e) {}
        },
        oneTimeRefreshMarkBox: function() {
            if (1 == showMarkBoxLayer && 1 == refreshMarkBox) {
                refreshMarkBox = !1;
                doc.byId("markBox")[CHN][1][IH] = '<img src="' + IMG_BASE_URL + '/images/99loaderDesktop.gif">', srp.refreshMarkBox()
            }
        },
        setMarkBoxRefreshParameter: function() {
            1 == showMarkBoxLayer && (refreshMarkBox = !0)
        },
        refreshMarkBox: function() {
            var a = doc.byId("markBox");
            ajax.getText({
                ctx: a
            }, pg.onMarkBoxRcv)
        },
        markBoxFill: function(a, b) {
            var c = b.split("#c#d#"),
                d = c[0],
                e = d.split("|"),
                f = c[1],
                g = c[2],
                h = e[0],
                i = e[1],
                j = a.value,
                k = doc.byId("MBPROP_" + j),
                l = doc.byId("numMarkProps"),
                m = parseInt(l[IH]);
            doc.byId("markBox");
            pg.maximizeModalLayer();
            var n = 5,
                o = null;
            if ((o = doc.byId("maxNoOfProperties")) && (n = o[IH]), a.checked) {
                if (!(m < n)) {
                    a.checked = !1;
                    return doc.byId("imgChkBox" + j).className = "checkBoxClear", void alert("You can only mark 5 properties at a time. Please delete a property from mark property section to add this property.")
                }
                var p = !0;
                if (void 0 == k || null == k) {
                    var q = ""; - 1 == i.indexOf("Request") && (q = '<span class="WebRupee f12">&#x20b9;</span>'), doc.byId("markBoxProperties")[IH] += '<div id="MBPROP_' + j + '"><table width="100%"><tr><td valign="top" align="left" class="bdr_bt_dot"><input type="hidden" name="markedPropIds[]" value="' + j + '"></input><input type="hidden" name="contactDetails[]" value="' + f + '"></input><input type="hidden" name="bucketIds[]" value="' + g + '"></input><a target="_blank" href="' + h + '">' + q + '<span id="markedPropDesc_' + j + '">' + i + '</span></a></td><td valign="top" align="right" style="vertical-align:middle" class="bdr_bt_dot"><img src="/images/newcross.gif" onClick=srp.markBoxPropDelete("' + j + '") class="cpointer"></td></tr></table></div>'
                } else p = !1;
                p && (l[IH] = m + 1, srp.markBoxContent(l[IH]), srp.markPropModify(j, 1, b))
            } else k && srp.markBoxPropDeleteCode(j)
        },
        markBoxPropDelete: function(a) {
            var b = doc.byId(a);
            if (isset(b)) {
                b.checked = !1;
                doc.byId("imgChkBox" + a).className = "checkBoxClear";
                var c = doc.byId("results");
                srp.onTupleSelectPrivate(c, !1, "")
            }
            srp.markBoxPropDeleteCode(a)
        },
        markBoxPropDeleteCode: function(a) {
            var b = doc.byId("MBPROP_" + a);
            b.parentNode.removeChild(b);
            var c = doc.byId("numMarkProps");
            c[IH] = parseInt(c[IH]) - 1, srp.markBoxContent(c[IH]), srp.markPropModify(a, 2, "", "")
        },
        markPropModify: function(a, b, c) {
            c = escape(c), ajax.getText({
                url: "" + a + "&action=" + b + "&data=" + c
            })
        },
        markBoxContent: function(a) {
            srp.changeMarkBoxHeader("", a), 0 == a && (doc.byId("markBoxDefault").style.display = "block", doc.byId("markBoxOptions").style.display = "none"), a > 0 && (doc.byId("markBoxDefault").style.display = "none", doc.byId("markBoxOptions").style.display = "block"), doc.byId("maxButton").style.display = "none", doc.byId("minButton").style.display = "block"
        },
        changeMarkBoxHeader: function(a, b) {
            if (void 0 == b || null == b) var c = doc.byId("numMarkProps"),
                b = parseInt(c[IH]);
            if ((1 == a && 0 == b || "" == a && 0 == b) && (doc.byId("numMarkPropsSpan").style.display = "none", doc.byId("defaultMarkProps").style.display = "inline"), -1 == a && 0 == b || b > 0) {
                doc.byId("numMarkPropsSpan").style.display = "inline";
                var d = doc.byId("propertyText");
                d[IH] = 1 == b ? "Property" : "Properties",
                    doc.byId("defaultMarkProps").style.display = "none"
            }
        },
        clearMarkBoxProperties: function(a) {
            void 0 != a && null != a || (a = !1);
            for (var b = document[ELBN]("markedPropIds[]"), c = b.length, d = [], e = 0; e < c; e++) d.push(b[e].value);
            for (var e = 0; e < c; e++) {
                var f = "";
                f = d[e];
                var g = doc.byId(f);
                if (isset(g)) {
                    g.checked = !1;
                    doc.byId("imgChkBox" + f).className = "checkBoxClear"
                }
            }
            doc.byId("markBoxProperties")[IH] = "";
            var h = doc.byId("results");
            srp.onTupleSelectPrivate(h, !1, "");
            var i = doc.byId("numMarkProps");
            i[IH] = 0, srp.markBoxContent(i[IH]), a || ajax.getText({})
        },
        showHideSubLoc: function(a, b, c) {
            if (1 == b) return !1;
            1 == c ? (doc.byId("subLocDisplay" + a).style.display = "block", doc.byId("subLocDisplay" + a).style.zIndex = 10001) : (doc.byId("subLocDisplay" + a).style.display = "none", doc.byId("subLocDisplay" + a).style.zIndex = 1)
        },
        changeCssAndDefaultTextRequestPh: function(a, b, c) {
            text = "Property";
            var d = a.value,
                e = "";
            "I am interested in checking out photos of this property. Please share them on my phone/email." == d.trim() && "C" == b ? (a.value = " ", "DP" != c && (a[CN].indexOf("valerr") > 0 && (e = " valerr"), a.setAttribute("class", "crvDrpDwn smail_in smail_mfd f13 frm_tara" + e))) : "" == d.trim() && "B" == b && (a.value = "I am interested in checking out photos of this property. Please share them on my phone/email.", "DP" != c && (a[CN].indexOf("valerr") > 0 && (e = " valerr"), a.setAttribute("class", "crvDrpDwn smail_in smail_mfd f13 frm_tara grey" + e)))
        }
    },
    phoneNum = {
        initiated: !1,
        getSourceList: function(a) {
            var b, c = [],
                d = {};
            return a.closest(".s_el").find("li label").each(function() {
                b = $(this), d = {
                    label: b.text(),
                    val: b.attr("val")
                }, c.push(d)
            }), c
        },
        hideSuggestor: function(a) {
            var b;
            a.find(".el_ac").val(""), a.find("i.sugestCross").hide(), a.find("ul.ui-autocomplete").empty().hide(), b = a.find("div.scrollbar1"), b.length > 0 && b.show().tinyscrollbar_update()
        },
        updateValue: function(a) {
            a.each(function() {
                var a = $(this),
                    b = a.closest(".s_el"),
                    c = a.closest(".el_wrap");
                if (c.parent().parent().children(".hid_el").val(a.attr("val")), b.hide(), a.parents(".intlNumBR").length > 0) {
                    var d = a.text().trim(),
                        e = d.split(" ");
                    qsSrp.setText(c.find("a span"), e[0] + "<br/>" + e[1])
                } else qsSrp.setText(c.find("a span"), a.text())
            })
        },
        initialize: function() {
            if (!($("#my99Page").length > 0)) {
                var a = this;
                void 0 !== qsSrp && qsSrp.initScrollPanes(), a.initiated || (a.initiated = !0, a.addEventsToDrpDowns())
            }
        },
        addEventsToDrpDowns: function() {
            $(document).on("click", "._top_parent a.dropDown", function(a) {
                var b, c, d, e, f, g, h = $(this),
                    i = h.attr("scrollel");
                if (h.hasClass("ddDisable")) return !0;
                try {
                    isset(i) && $("html,body").animate({
                        scrollTop: $("#" + i).offset().top - 15
                    }, 500)
                } catch (j) {}
                g = h.parent(), b = h.attr("htmlgrp"), $(".sWrpEl").css("z-index", 1), g.css("z-index", 10001), isset(b) && $("[htmlgrp='" + b + "']").parent().css("z-index", 10001), a.stopPropagation(), f = h.next(), "budget_wrap" == g.parent().attr("id") ? $("#budget_wrap").find(".custErr").hide() : (isErr = f.hasClass("custErr"), isErr && (f.hide(), f = f.next())), h.removeClass("valerr"), d = $("div.ddlst").not(f), e = void 0 == b ? d : d.not("[htmlgrp='" + b + "']"), e.hide(), c = f.toggle().find(".scrollbar1"), "undefined" != typeof currentPageName && "MICROSITE" == currentPageName && c.length ? c.tinyscrollbar() : c.length && c.tinyscrollbar_update(), phoneNum.hideSuggestor(g), g.find(".inSuggest:first").focus(), frmUtil.refreshTabIndex(qsSrp.frm_id), "undefined" != typeof autoSuggestorInstance && autoSuggestorInstance.hideSuggestionContainer()
            }), $("i.sugestCross").click(function() {
                var a = $(this),
                    b = a.prev("input.inSuggest");
                qsSrp.setInputEmpty(b), b.autocomplete("search", "")
            }), $(document).on("click", ".s_el ul li label", function() {
                phoneNum.updateValue($(this))
            }), $(document).on("keypress", ".el_ac", function(a) {
                if (13 == (a.keyCode ? a.keyCode : a.which)) return !1
            })
        },
        addCountryCode: function(a) {
            if (null == a || "" == a) return a;
            var b, c = a.split(","),
                d = "";
            for (b in c) a = c[b], a = a.replace("+", ""), a = -1 === a.indexOf("-") ? "+91-" + a : "+" + a, d += a + ",";
            return d.replace(/,$/, "")
        }
    };
$(function() {
    window.css3Prefix = checkCSS3Support()
}), $("._moresibling, ._lesssibling").click(function(a) {
    var b, c = $(this),
        d = "more",
        e = "less";
    c.hasClass("_lesssibling") && (d = "less", e = "more"), b = c.attr("opptext"), el = c.parent().prev("." + d + "content"), c.removeClass("_" + d + "sibling").addClass("_" + e + "sibling"), void 0 !== b && b ? (c.attr("opptext", c.text()), c.text(b)) : c.hide(), el.length && el.removeClass(d + "content").addClass(e + "content"), a.preventDefault()
}), $("._moreinline, ._lessinline").click(function(a) {
    var b, c, d, e, f = $(this),
        g = "more",
        h = "less";
    f.hasClass("_lessinline") && (g = "less", h = "more"), e = f.html(), oppText = f.attr("opptext"), "undefined" != typeof oppText && oppText ? f.removeClass("_" + g + "inline").addClass("_" + h + "inline").html(oppText).attr("opptext", e) : f.hide(), c = f.siblings(".less-text").eq(0), b = f.siblings(".more-text").eq(0), d = c.html(), "less" == g ? (b.hide(), d += "...") : (b.show(), d = d.replace(/\.\.\.$/, "")), c.html(d), a.preventDefault()
}), textChangeCCDiv = function() {
    var a = $(".s_el ul li label"),
        b = $(".rel.lf.sWrpEl.el_wrap").find("#country_code").text(),
        c = b.split(" (+")[1];
    if (void 0 !== c) var c = c.replace(")", "");
    var d = $('.s_el ul li label[val="' + c + '"]')[0];
    0 !== $(a).length && phoneNum.updateValue($(d))
};
var nnentropy = {
    xhrReq: null,
    validateJS: function(a) {
        if (!nnentropy.xhrReq) {
            var b, c;
            getCookieVal("__utid") || (b = $("#__utid"), void 0 !== (c = b.length > 0 ? b.val() : nnentropy.getUtidHeader()) && c && "" != c && (c = c.toLowerCase(), nnentropy.xhrReq = $.ajax({
                url: "",
                type: "POST",
                data: {
                    frameValue: c,
                    userAgent: navigator.userAgent,
                    url: window.location.hostname + window.location.pathname
                },
                success: function(a) {
                    setCookieExpInMs("__utid", Math.floor(10 * Math.random() + 1), 6e5)
                },
                complete: function(a, b) {
                    nnentropy.xhrReq = null
                }
            })))
        }
    },
    getUtidHeader: function() {
        if (0 == $("#comparePage").length) {
            var a, b = new XMLHttpRequest;
            return b.open("GET", "", !1), b.send(null), a = b.getResponseHeader("frame-value"), null == a && (a = "nnacres"), a
        }
    }
};
document.addEventListener("mousemove", nnentropy.validateJS), document.addEventListener("touchmove", nnentropy.validateJS);
var FeedbackReport = {
    reportListing: function(btn) {
        if (!($(btn).parents(".shareFbContainer").find('input[name="goodBad"]:checked').length <= 0)) {
            var goodBad = $(btn).parents(".shareFbContainer").find('input[name="goodBad"]:checked').val(),
                goodValue = $("#goodOptionValue").val(),
                badValue = $("#badOptionValue").val(),
                propId = $(btn).parents(".shareFbContainer").find("#propId").val(),
                page = $(btn).parents(".shareFbContainer").find("#page").val(),
                profileid = $(btn).parents(".shareFbContainer").find("#profileid").val(),
                selecedReasonIds = "";
            if (goodBad == badValue) {
                if ($(btn).parents(".shareFbContainer").find('input[name="buyerselectedreason"]:checked').each(function() {
                        selecedReasonIds += $(this).val() + ","
                    }), selecedReasonIds = selecedReasonIds.replace(/,\s*$/, ""), 0 == selecedReasonIds.length) return void $(btn).parents(".shareFbContainer").find("#nosel").show();
                $(btn).parents(".shareFbContainer").find("#nosel").hide();
                var details = $(btn).parents(".shareFbContainer").find("#descriptionArea").val();
                $.ajax({
                    type: "POST",
                    data: {
                        reasons: selecedReasonIds,
                        PROP_ID: propId,
                        PROFILEID: profileid,
                        PAGE: page,
                        details: details
                    },
                    async: !1,
                    success: function(result) {
                        response = eval("(" + result + ")"), 1 == response.status && ($(btn).parents(".shareFbContainer").find("#badOptions").hide(), $(btn).parents(".shareFbContainer").find('input[type="radio"]').each(function() {
                            $(this).attr("disabled", !0)
                        }), $(btn).parents(".shareFbContainer").find("#ThankFeedBackyouBar").show(), $(btn).parents(".shareFbContainer").find("[name='submitFB']").hide())
                    }
                })
            } else $(btn).parents(".shareFbContainer").find('input[type="radio"]').each(function() {
                $(this).attr("disabled", !0)
            }), $(btn).parents(".shareFbContainer").find("#ThankFeedBackyouBar").show(), $(btn).parents(".shareFbContainer").find("[name='submitFB']").hide()
        }
    },
    ChangeStyle: function(btn) {
        var toTrack = $(btn).parents(".shareFbContainer").find("#trackGoodBad").val(),
            goodBad = $(btn).parents(".shareFbContainer").find('input[name="goodBad"]:checked').val(),
            goodValue = $("#goodOptionValue").val(),
            badValue = $("#badOptionValue").val(),
            propId = $(btn).parents(".shareFbContainer").find("#propId").val(),
            page = $(btn).parents(".shareFbContainer").find("#page").val(),
            profileid = $(btn).parents(".shareFbContainer").find("#profileid").val();
        goodBad == badValue ? $(btn).parents(".shareFbContainer").find("#badOptions").show() : $(btn).parents(".shareFbContainer").find("#badOptions").hide();
        var details = $(btn).parents(".shareFbContainer").find("#descriptionArea").val();
        1 == toTrack && ($(btn).parents(".shareFbContainer").find("#trackGoodBad").val(0), $.ajax({
            type: "POST",
            data: {
                reasons: goodBad,
                PROP_ID: propId,
                PROFILEID: profileid,
                PAGE: page,
                details: details
            },
            async: !1,
            success: function(result) {
                response = eval("(" + result + ")"), response.status
            }
        }))
    },
    LoadUnloadTextArea: function(a) {
        $(a).parents(".shareFbContainer").find("#rptCheckBox8").is(":checked") ? ($(a).parents(".shareFbContainer").find("#descriptionArea").show(), $(a).parents(".shareFbContainer").find("#showcharcount").show()) : ($(a).parents(".shareFbContainer").find("#descriptionArea").hide(), $(a).parents(".shareFbContainer").find("#showcharcount").hide(), $(a).parents(".shareFbContainer").find("#descriptionArea").val(""))
    },
    countChars: function(a) {
        var b = $(a).parents(".shareFbContainer").find("#descriptionArea").val().length;
        $(a).parents(".shareFbContainer").find("#charcount").text(b)
    }
};
$("#eoiCart").on("mouseenter", function() {
    $(".srpInterestInTag").css("cursor", "pointer")
}), $("#eoiCart").on("mouseleave", function() {
    $(".srpInterestInTag").css("cursor", "")
});
var autoVerification = {
    isMouseOut: !1,
    doAnyAction: !1,
    getAutoVerificationPage: function(a) {
        var b = getCookie("QryUsrData"),
            c = getCookie("newRequirementsByUser");
        _gaq.push(["_trackEvent", "Auto Verification", "Open Verification layer", a]), $.ajax({
            context: this,
            type: "POST",
            async: !1,
            cache: !0,
            data: {
                dataStr: b,
                rids: c
            },
            success: function(a, b, c) {
                $("#layerForAutoVerificationOfLeads").html(a), $("#layerForAutoVerificationOfLeads").show(), autoVerification.showAutoVerificationLayer(), $("#eoiCart").hide(), document.body.style.overflow = "hidden", document.cookie = "showAutoVerificationLayer=0;path=/"
            }
        })
    },
    showEOICart: function() {
        var a = getCookie("newRequirementsByUser"),
            b = getCookie("QryUsrData"),
            c = getCookie("PROPLOGIN");
        if (void 0 === b && void 0 === c) "1" == getCookie("markRequirementsWaivedOnLeave") && (autoVerification.markUnseenReqsWaived(), document.cookie = "markRequirementsWaivedOnLeave=0;path=/"), document.cookie = "newRequirementsByUser=0;path=/";
        else if ("0" != a && "" !== a && void 0 !== a) {
            var d = a.split(","),
                e = d.length;
            0 == $(".lmsVerifSrp").is(":visible") && ($("#eoiCart").show(), document.body.style.overflow = "visible");
            var f = 1 == e ? " Requirement" : " Requirements";
            $("#newReqCount").html(e + f)
        } else document.cookie = "markRequirementsWaivedOnLeave=0;path=/", $("#eoiCart").hide()
    },
    showAutoVerificationLayer: function() {
        $(".lmsVerifSrp").animate({
            width: "100%",
            position: "fixed",
            left: 0
        }, {
            duration: 300,
            specialEasing: {
                width: "swing"
            }
        })
    },
    resizeAutoVerificationLayer: function() {
        $(".lmsVerifSrp").css("width", "100%"), $(".lmsVerifSrp").css("height", $(window).height() - 55 + "px")
    },
    clearVerifiedRequirements: function() {
        var a = getCookie("verifiedRequirementsByUser"),
            b = getCookie("newRequirementsByUser");
        if (void 0 != a && void 0 != b) {
            var c = b.split(","),
                d = a.split(","),
                e = $.grep(c, function(a) {
                    return -1 == $.inArray(a, d)
                });
            document.cookie = "newRequirementsByUser=" + e.join(",") + ";path=/", document.cookie = "verifiedRequirementsByUser=0;path=/"
        }
    },
    popUpOnPageLeave: function() {
        $("body").click(), $("#blockBackground").show(), pg.openModalLayer({
            id: "autoVerificationPopUp",
            reload: !0,
            ttl: "Requirements pending for verification",
            size: {
                w: 400,
                h: "auto",
                h1: "auto",
                bkgOpac: .75,
                bkgColour: "#FF666"
            },
            html: "<div style='padding: 20px 25px 10px 25px;font-size: 14px;'><span>We've noticed that you've not taken any action on a few requirements in your dashboard.</span><div style='margin-top: 10px;font-weight: bold;'>Would you like to take an action?</div><div style='margin-top: 10px;text-align: center;'><input type='button' value='Discard' class='b btn blue' style='margin: 15px;background: white;color: #3498db;border-color: #3498db;outline: 1px solid;border: 1px;' onclick='autoVerification.markUnseenReqsWaived();' /><input type='button' value='Take action' class='b btn blue' style='margin: 15px;' onclick='autoVerification.getAutoVerificationPage(\"popUp\");' /></div></div>",
            cbk: pg.setUpLayer,
            position: "fixed"
        }, "noDefHead"), $("#autoVerificationPopUp").find("#srpmodalCloseCrossBtn").on("click", function() {
            $("#blockBackground").hide()
        }), $("#blockBackground").on("click", function() {
            $("#srpmodalCloseCrossBtn").click()
        }), document.cookie = "showAutoVerificationLayer=0;path=/"
    },
    markUnseenReqsWaived: function() {
        $("#srpmodalCloseCrossBtn").click();
        var a = getCookie("verifiedRequirementsByUser"),
            b = getCookie("newRequirementsByUser"),
            c = [];
        if (void 0 != a && void 0 != b) {
            var d = b.split(","),
                e = a.split(",");
            c = $.grep(d, function(a) {
                return -1 == $.inArray(a, e)
            })
        } else void 0 != b && (c = b.split(","));
        var f = getCookie("QryUsrData");
        $.ajax({
            context: this,
            type: "POST",
            async: !1,
            data: {
                rids: c.join(","),
                dataStr: f
            }
        }), document.cookie = "newRequirementsByUser=0;path=/"
    }
};
$(window).mouseleave(function(a) {
    if (autoVerification.doAnyAction) {
        "1" == getCookie("showAutoVerificationLayer") && a.clientY <= 0 && autoVerification.getAutoVerificationPage("mouseLeave"), a.clientY <= 0 && (autoVerification.isMouseOut = !0)
    }
}), $(window).mouseenter(function(a) {
    autoVerification.isMouseOut = !1
}), $(window).load(function() {
    autoVerification.clearVerifiedRequirements()
}), $(window).unload("before", function(a) {
    return "1" == getCookie("markRequirementsWaivedOnLeave") && autoVerification.isMouseOut && (autoVerification.markUnseenReqsWaived(), document.cookie = "markRequirementsWaivedOnLeave=0;path=/"), !1
});
var autoRefreshEOICart = setInterval(function() {
    autoVerification.doAnyAction && (autoVerification.showEOICart(), null != $("#eoiCart") && 1 != $("#eoiCart").is(":visible") || (document.body.style.overflow = "visible"))
}, 2e3);
$(window).resize(function() {
    autoVerification.resizeAutoVerificationLayer()
});
var notify_dashboard = {
        createToastTrigger: 0,
        notificationCount: 0,
        eventType: "",
        isIframe: !1,
        setPageLoad: function() {
            this.getNotificationValue(), this.showNotificationCount()
        },
        initNotificationData: function(a, b, c) {
            this.eventType = a, this.increaseNotificationCount(), this.setStorageValue(b), this.showNotificationCount(), this.showToastTrigger(b)
        },
        updateNotificationLayer: function(a, b, c) {
            this.eventType = a, this.reduceNotificationCount(), this.unsetProjectHistory(b), this.showNotificationCount()
        },
        getStorageValue: function() {
            var a = getStorageValue("BD_" + this.eventType),
                b = {};
            return a && !empty(a) && (b = JSON.parse(a)), b
        },
        setStorageValue: function(a) {
            var b = {};
            if ("SHORTLIST" == this.eventType) {
                b = this.getStorageValue();
                var c = this.projCountCal(b);
                if (c >= 5)
                    for (var d in b) d < 4 ? (delete b[d], b[d] = b[parseInt(d) + 1]) : b[d] = a;
                else b[c] = a
            } else b[0] = a;
            setStorageValue("BD_" + this.eventType, JSON.stringify(b))
        },
        unsetProjectHistory: function(a) {
            var b = this.getStorageValue(),
                c = -1;
            for (var d in b)(b[d].xid == a.xid && a.xid || b[d].propId == a.propId && a.propId) && (c = d, delete b[c]), c > -1 && c != d && (b[d - 1] = b[d], delete b[d]);
            setStorageValue("BD_" + this.eventType, JSON.stringify(b))
        },
        increaseNotificationCount: function() {
            this.getNotificationValue(), this.notificationCount >= 0 ? this.notificationCount++ : void 0 == this.notificationCount && (this.notificationCount = 1), setStorageValue("bdNo", this.notificationCount)
        },
        reduceNotificationCount: function() {
            this.getNotificationValue(), this.notificationCount >= 0 && this.notificationCount--, setStorageValue("bdNo", this.notificationCount)
        },
        setNotificationValue: function() {
            setStorageValue("bdNo", this.notificationCount)
        },
        getNotificationValue: function() {
            this.notificationCount = getStorageValue("bdNo"), 0 != this.notificationCount && "" != this.notificationCount && -1 != this.notificationCount || (this.notificationCount = 0, this.setNotificationValue())
        },
        projCountCal: function(a) {
            var b = 0;
            for (var c in a) b++;
            return b
        },
        buyerDashboardRedirection: function(a) {
            var b = "";
            return "PROJECT" == a ? b = "SHORTLISTED_ENTITY" : "LINK" == a && (b = "SHORTLIST_LINK"), clickStream.doClickStreamTracking({
                event: "CLICK",
                page: "BUYER_DASHBOARD",
                Section: b
            }), this.flushAllNotificationHistory(), window.open("/dashboard", "_blank"), !1
        },
        flushAllNotificationHistory: function() {
            this.eventType = "SHORTLIST";
            var a = {};
            setStorageValue("BD_" + this.eventType, JSON.stringify(a)), this.notificationCount = 0, this.setNotificationValue(), this.showNotificationCount()
        },
        openNotificationLayer: function() {
            if ($(".notify_wrpr").toggleClass("clicked"), $(".notify_wrpr").hasClass("clicked") ? $(".arrow-up_wSmall").css({
                    display: "block"
                }) : $(".arrow-up_wSmall").css({
                    display: "none"
                }), shortlist.checkLogin()) {
                if ($("#buyerDashboard").length > 0) return $(".notify_content").html("No new notifications").addClass("noNotification"), $(".dev_shortListData , .notify_viewAll , .mTool-inCont. #noLayrShortlistHeadPrjtCnt , .notify_log_reg").css({
                    display: "none"
                }), !1;
                $(".notify_log_reg").css({
                    display: "none"
                }), $(".notify_btm").addClass("mt15")
            } else $(".notify_log_reg").css({
                display: "block"
            });
            0 == $("#buyerDashboard").length ? this.getDataForNotificationLayer() : $(".dev_shortListData , .notify_viewAll , .mTool-inCont. #noLayrShortlistHeadPrjtCnt").css({
                display: "none"
            })
        },
        getDataForNotificationLayer: function() {
            function a(a) {
                var b = JSON.parse(a);
                $.each(b, function(a, b) {
                    $("#noLayrShortlist").html(b[0])
                })
            }

            function b(a) {}
            if (this.eventType = "SHORTLIST", this.notificationCount > 0) {
                var c = this.getStorageValue(),
                    d = this.projCountCal(c),
                    e = c[d - 1];
                if (0 == d) $(".dev_shortListData , .mTool-inCont, .arrow-up_wSmall").css({
                    display: "none"
                });
                else {
                    this.showProjectPropertiesCount(c), $(".dev_shortListData , .mTool-inCont, .arrow-up_wSmall").css({
                        display: "block"
                    });
                    ajax.getText({
                        params: e,
                        method: "GET"
                    }, a, b)
                }
            }
        },
        showProjectPropertiesCount: function(a) {
            function b(a) {
                var b = JSON.parse(a);
                b.project && b.property ? d = "<span>" + (b.total - 1) + " more projects/properties shortlisted</span>" : b.project > 0 && 0 == b.property ? d = "<span>" + b.project + " Project has been shortlisted</span>" : b.property > 0 && 0 == b.project && (d = "<span>" + b.property + " Property has been shortlisted</span>"), $("#noLayrShortlistPrjtCnt").html(d)
            }

            function c(a) {}
            var d = "";
            ajax.getText({
                method: "GET"
            }, b, c)
        },
        showNotificationCount: function() {
            notify_dashboard.checkIsIframe(), $(".notify_wrpr").hasClass("clicked") || ($("#buyerDashboard").length > 0 ? (this.hideShortListData(), this.showHideToolTipLayer("none")) : this.notificationCount > 0 ? (notify_dashboard.isIframe ? ($("#noLayrShortlistHeadPrjtCnt, .notify_number", window.parent.document).html(this.notificationCount).css({
                display: "block"
            }), $("#noHoverLayrShortlistPrjtCnt", window.parent.document).html(this.notificationCount + " new")) : ($("#noLayrShortlistHeadPrjtCnt , .notify_number").html(this.notificationCount).css({
                display: "block"
            }), $("#noHoverLayrShortlistPrjtCnt").html(this.notificationCount + " new")), this.showHideToolTipLayer("block")) : 0 == this.notificationCount && (this.showHideToolTipLayer("none"), this.hideShortListData()))
        },
        checkIsIframe: function() {
            0 == $("#noLayrShortlistHeadPrjtCnt").length ? notify_dashboard.isIframe = !0 : notify_dashboard.isIframe = !1
        },
        showHideToolTipLayer: function(a) {
            notify_dashboard.isIframe ? $("#notificationLayer .mTool-inCont , #notificationLayer .arrow-up_wSmall", window.parent.document).css({
                display: a
            }) : $("#notificationLayer .mTool-inCont , #notificationLayer .arrow-up_wSmall").css({
                display: a
            })
        },
        hideShortListData: function() {
            notify_dashboard.isIframe ? $(".dev_shortListData , #noLayrShortlistHeadPrjtCnt", window.parent.document).css({
                display: "none"
            }) : $(".dev_shortListData, #noLayrShortlistHeadPrjtCnt").css({
                display: "none"
            })
        },
        showToastTrigger: function(a) {
            var b = "",
                c = getStorageValue("bdXidUsr");
            if (void 0 != c && "" != c || (c = 1), "undefined" != a && null != a) {
                if ("0" == notify_dashboard.createToastTrigger && !(window.parent.$("#toastTrigger").length > 0)) {
                    var d = '<div id="toastTrigger" class = "db_notifyTrigger"><div class = "db_notifyTriggerBox"><i class ="sprite_dashnotify starIcn"></i><span id = "toast_trigger_txt" class="db_notifyTriggerTxt"></span></div>';
                    "XID_DETAIL_PAGE" == currentPageName && c && (d += '<img id="toastTriggerImg" src="../images/buyerDashboard/Coachmark-dashboard-xid.png">'), d += "</div>", $(parent.document.body).append(d), notify_dashboard.createToastTrigger = 1
                }
                0 == a.xid ? (b = "Property added to your shortlist", window.parent.$("#toast_trigger_txt").html(b)) : 0 == a.propId && (b = "Project added to your shortlist", window.parent.$("#toast_trigger_txt").html(b)), "" != b && (setTimeout(function() {
                    window.parent.$(" #toastTrigger").css({
                        top: "65px"
                    })
                }, 1), setTimeout(function() {
                    window.parent.$(" #toastTrigger").css({
                        top: "-100%"
                    })
                }, 2e3)), "0" == c && $("#toastTriggerImg").remove(), c && "XID_DETAIL_PAGE" == currentPageName && (c = 0, setStorageValue("bdXidUsr", c))
            }
        }
    },
    thisCMM = null,
    debugFlag_thisCMM = !1,
    CityMenuModule = {
        cityMenuOpenBtn: null,
        cityMenuContainer: null,
        searchResultsContainer: null,
        searchInput: null,
        activeResultIndex: -1,
        searchTerm: "",
        citiesList: [],
        initCityMenuModule: function() {
            try {
                thisCMM = this, this.getCitiesList(), this.cityMenuOpenBtn = $("#city-list"), this.cityMenuContainer = $("#citylistheader"), this.searchInput = $(".cityListSearch"), this.searchResultsContainer = $(".citySearchResults"), this.cityMenuOpenBtn.on("click", this.onCityMenuBtnClick), this.searchInput.on("change paste keyup", this.onSearchTermChange), this.searchInput.on("focus", this.showResultsContainer), this.searchInput.focusout(this.hideResultsContainer), $(".citySearchContainer .searchCityIcn").on("click", this.searchFocus)
            } catch (a) {
                console.log(a)
            }
        },
        onCityMenuBtnClick: function(a) {
            try {
                a.stopPropagation(), "block" == thisCMM.cityMenuContainer.css("display") ? thisCMM.closeMenu(a) : (thisCMM.cityMenuContainer.css("display", "block"), $(document).on("click", thisCMM.closeMenu))
            } catch (b) {
                console.log(b)
            }
        },
        closeMenu: function(a) {
            try {
                thisCMM.isParentElement(thisCMM.cityMenuContainer, a.target) || (thisCMM.cityMenuContainer.css("display", "none"), $(document).off("click", thisCMM.closeMenu))
            } catch (b) {
                console.log(b)
            }
        },
        isParentElement: function(a, b) {
            try {
                var c = null;
                return c = a instanceof jQuery ? a.get()[0] : a, !(!1 === $.contains(c, b) && c !== b)
            } catch (d) {
                console.log(d)
            }
        },
        searchFocus: function(a) {
            try {
                $(".cityListSearch").focus(), a.preventDefault()
            } catch (b) {
                console.log(b)
            }
        },
        resultMouseIn: function() {
            try {
                $(this).addClass("activeResult"), thisCMM.activeResultIndex = parseInt($(this).data("index")), thisCMM.debug("resultMouseIn")
            } catch (a) {
                console.log(a)
            }
        },
        resultMouseLeave: function() {
            try {
                $(this).removeClass("activeResult"), thisCMM.activeResultIndex = -1, thisCMM.debug("resultMouseLeave")
            } catch (a) {
                console.log(a)
            }
        },
        onSearchTermChange: function() {
            try {
                var a = $(this).val();
                if (a !== thisCMM.searchTerm) {
                    thisCMM.searchTerm = a, thisCMM.searchResultsContainer.html("");
                    var b = 0;
                    if (a.length > 0)
                        for (var c = 0; c < thisCMM.citiesList.length; c++) {
                            var d = thisCMM.citiesList[c],
                                e = d.label.toLowerCase().indexOf(a.toLowerCase());
                            if (-1 !== e) {
                                var f = document.createElement("a");
                                f.setAttribute("class", "citySearchResult"), f.setAttribute("data-index", b), f.setAttribute("href", d.url), f.innerHTML = "<span>" + d.label.slice(0, e) + "<strong>" + d.label.slice(e, e + a.length) + "</strong>" + d.label.slice(e + a.length) + "</span>", thisCMM.searchResultsContainer[0].appendChild(f), b++
                            }
                        }
                    if (b - 1 < thisCMM.activeResultIndex && (thisCMM.activeResultIndex = -1), 0 == b && a.length > 0) {
                        var f = document.createElement("div");
                        f.setAttribute("class", "citySearchResult noResultTuple"), f.setAttribute("data-index", -1), f.innerHTML = "<span>No Results Found</span>", thisCMM.searchResultsContainer[0].appendChild(f), $(".citySearchResult.noResultTuple").on("mousedown", thisCMM.searchFocus), thisCMM.showResultsContainer()
                    } else b > 0 ? (thisCMM.showResultsContainer(), $(".citySearchResult").mouseenter(thisCMM.resultMouseIn), $(".citySearchResult").mouseleave(thisCMM.resultMouseLeave)) : thisCMM.hideResultsContainer()
                }
                thisCMM.debug("onSearchTermChange")
            } catch (g) {
                console.log(g)
            }
        },
        getCitiesList: function() {
            try {
                $.get("", function(a) {
                    a && (thisCMM.citiesList = JSON.parse(a))
                })
            } catch (a) {
                console.log(a)
            }
        },
        showResultsContainer: function() {
            try {
                "" !== thisCMM.searchResultsContainer.html() && thisCMM.searchResultsContainer.css("display", "block")
            } catch (a) {
                console.log(a)
            }
        },
        hideResultsContainer: function() {
            try {
                -1 === thisCMM.activeResultIndex && thisCMM.searchResultsContainer.css("display", "none")
            } catch (a) {
                console.log(a)
            }
        },
        hideResultsContainerOnClick: function(a) {
            try {
                thisCMM.isParentElement($(".citySearchContainer"), a.target) || (thisCMM.hideResultsContainer(), $(document).off("click", thisCMM.hideResultsContainerOnClick))
            } catch (b) {
                console.log(b)
            }
        },
        debug: function(a) {
            try {
                debugFlag_thisCMM && (console.log(a), console.log(thisCMM))
            } catch (b) {
                console.log(b)
            }
        }
    };
$(document).ready(function() {
    CityMenuModule.initCityMenuModule()
});
var _99ab = {
        abCookie: "a",
        getABCookie: function() {
            var a = qsSrp.readCookie();
            return 1 == $("#is_home").val() && a["99_ab"] <= 10 && (this.abCookie = "a"), this.abCookie
        },
        execFunc: function(a, b, c, d) {
            return b.apply(c, d)
        },
        bindFunc: function(a, b) {
            return b
        }
    },
    tabMap = {},
    stkyKey = !1,
    stkyPD = !1,
    clikTab = "",
    kywrd, submitButton, qsSrp = {
        search_type: "",
        clear_form: !1,
        selCityAtHeader: "",
        frm_id: "",
        data: "",
        defLbls: {
            res_com: "Residential",
            city: "* City",
            budget_min: "Min",
            budget_max: "Max",
            property_type: "All Residential",
            bedroom: "Bedroom",
            sharing: "Sharing",
            available_for: "Available for",
            area_unit: "Area unit",
            area_min: "Min",
            area_max: "Max",
            keyword: "Eg: Locality, Builder, Project",
            area: "Area",
            class: "All",
            availability: "Construction Status",
            preference: "Buy",
            np_search_type: "All"
        },
        btn: "",
        cityList: [],
        npCityList: [],
        flg: !1,
        strLocalityMap: "",
        strPhraseValueMap: "",
        strFullSuggestion: "",
        strProjectMap: "",
        strCityMap: "",
        strEntityMap: "",
        keywordText: "Type Location or Project",
        virtualCities: [],
        virtualCityMapping: {},
        citiesWithSecondaryParents: {},
        previousKeyword: "",
        previousCity: "",
        cookies: null,
        cityIdLabel: {
            QS: "PROPERTY",
            NPSEARCH: "PROJECT",
            DEALERSEARCH: "DEALER"
        },
        fldMap: {
            search_type: "handleST",
            res_com: "handleRC",
            preference: "handlePreference",
            area: "handleArea",
            bedroom: "handleBedroom",
            budget: "handleBudget",
            np_search_type: "handleNPsearchType",
            availability: "handleAvailability",
            class: "handleClass",
            sharing: "handleSharing",
            available_for: "handleAvailableFor"
        },
        fillFldMap: {
            city: "fillCity",
            preference: "fillPref",
            property_type: "fillPT",
            budget_min: "fillBudgetMin",
            budget_max: "fillBudgetMax",
            area_min: "fillAreaMin",
            area_max: "fillAreaMax",
            area_unit: "fillAreaUnit",
            bedroom_num: "fillBedroom",
            class: "fillClass",
            available_for: "fillAvailableFor",
            sharing: "fillSharing"
        },
        fillFldMapWPT: {
            budget_min: "fillBudgetMin",
            budget_max: "fillBudgetMax",
            area_min: "fillAreaMin",
            area_max: "fillAreaMax",
            area_unit: "fillAreaUnit",
            bedroom_num: "fillBedroom"
        },
        resetFldMap: {
            availability: "resetAvail",
            preference: "resetPref",
            budget: "resetBudget",
            area_min: "resetAreaMin",
            area_max: "resetAreaMax",
            area_unit: "resetAreaUnit",
            area: "resetArea",
            bedroom_num: "resetBedroom",
            class: "resetClass",
            np_search_type: "resetNpSearchType",
            sharing: "resetSharing",
            available_for: "resetAvailableFor"
        },
        isMapActive: function() {
            return !/iPhone|iPad|iPod/i.test(navigator.userAgent)
        },
        setVirtualCities: function(a) {
            a && (qsSrp.virtualCities = JSON.parse(a))
        },
        getVirtualCities: function() {
            return qsSrp.virtualCities
        },
        setVirtualCityMapping: function(a) {
            a && (qsSrp.virtualCityMapping = JSON.parse(a))
        },
        getVirtualCityMapping: function() {
            return qsSrp.virtualCityMapping
        },
        setCitiesWithSecondaryParents: function(a) {
            a && (qsSrp.citiesWithSecondaryParents = JSON.parse(a))
        },
        getCitiesWithSecondaryParents: function() {
            return qsSrp.citiesWithSecondaryParents
        },
        getCityValueMap: function() {
            if (qsSrp.strCityMap) {
                return JSON.parse(qsSrp.strCityMap)
            }
            return ""
        },
        setEntityValueMap: function(a) {
            qsSrp.strEntityMap = a || ""
        },
        getEntityValueMap: function() {
            if (qsSrp.strEntityMap) {
                return JSON.parse(qsSrp.strEntityMap)
            }
            return ""
        },
        getPhraseValueMap: function() {
            if (qsSrp.strPhraseValueMap) {
                return JSON.parse(qsSrp.strPhraseValueMap)
            }
            return ""
        },
        setLocalityValueMap: function(a) {
            qsSrp.strLocalityMap = a || ""
        },
        setProjectValueMap: function(a) {
            qsSrp.strProjectMap = a || ""
        },
        getProjectValueMap: function() {
            if (qsSrp.strProjectMap) {
                return JSON.parse(qsSrp.strProjectMap)
            }
            return ""
        },
        setPhraseValueMap: function(a) {
            qsSrp.strPhraseValueMap = a || ""
        },
        getFullSuggestion: function() {
            if (qsSrp.strFullSuggestion) {
                return JSON.parse(qsSrp.strFullSuggestion)
            }
            return ""
        },
        setFullSuggestion: function(a) {
            qsSrp.strFullSuggestion = a || ""
        },
        getPreviousKeyword: function() {
            return previousKeyword
        },
        setPreviousKeyword: function(a) {
            previousKeyword = a
        },
        getPreviousCity: function() {
            return previousCity
        },
        setPreviousCity: function(a) {
            previousCity = a
        },
        getPref: function() {
            var a = $("#preference").val();
            return "" != a ? a : "S"
        },
        setPref: function(a) {
            return $("#preference").val(a)
        },
        getRC: function() {
            var a = $("#res_com").val();
            return "" != a ? a : "R"
        },
        setRC: function(a) {
            return $("#res_com").val(a)
        },
        getPT: function() {
            return $("#property_type").val()
        },
        setPT: function(a) {
            return $("#property_type").val(a)
        },
        getST: function() {
            return this.search_type
        },
        setST: function(a) {
            this.search_type = a
        },
        setCity: function(a) {
            return $("#city").val(a)
        },
        getCity: function() {
            return $("#city").val()
        },
        setBudgetMin: function(a) {
            return $("#budget_min").val(a)
        },
        getBudgetMin: function() {
            return $("#budget_min").val()
        },
        setBudgetMax: function(a) {
            return $("#budget_max").val(a)
        },
        getBudgetMax: function() {
            return $("#budget_max").val()
        },
        setAreaMin: function(a) {
            return $("#area_min").val(a)
        },
        getAreaMin: function() {
            return $("#area_min").val()
        },
        setAreaMax: function(a) {
            return $("#area_max").val(a)
        },
        getAreaMax: function() {
            return $("#area_max").val()
        },
        setAreaUnit: function(a) {
            return $("#area_unit").val(a)
        },
        getAreaUnit: function() {
            return $("#area_unit").val()
        },
        setClass: function(a) {
            return $("#class").val(a)
        },
        getClass: function() {
            return $("#class").val()
        },
        setKeyword: function(a) {
            var b = $("#keyword");
            return empty(a) ? this.setInputEmpty(b) : b.val(a)
        },
        getKeyword: function() {
            return $("#keyword").val()
        },
        setBedroom: function(a) {
            return $("#bedroom_num").val(a)
        },
        setSharing: function(a) {
            return $("#sharing").val(a)
        },
        setAvailableFor: function(a) {
            return $("#available_for").val(a)
        },
        getBedroom: function() {
            return $("#bedroom_num").val()
        },
        setNpSearchType: function(a) {
            return $("#np_search_type").val(a)
        },
        getNpSearchType: function() {
            return $("#np_search_type").val()
        },
        setDefLbls: function(a) {
            qsSrp.defLbls = a
        },
        getDefLbl: function(a) {
            return this.defLbls[a]
        },
        getAvailableFor: function() {
            return $("#available_for").val()
        },
        getSharing: function() {
            return $("#sharing").val()
        },
        setText: function(a, b, c) {
            isset(c) || (c = !1), js.isStr(a) && (a = $(a)), a.html(b)
        },
        setDefLbl: function(a, b) {
            qsSrp.setText(a, b, !0)
        },
        handleBudget: function() {
            var a, b, c, d, e;
            a = this.getPref(), b = $("#buy_budget_max_wrap, #buy_budget_min_wrap"), c = $("#rent_budget_max_wrap, #rent_budget_min_wrap"), "S" == a ? (d = b, e = c) : (d = c, e = b), d.show(), e.hide()
        },
        handlePreference: function() {
            var a, b, c, d = this,
                e = qsSrp.getRC(),
                f = qsSrp.getPref(),
                g = Header.checkPropTyp(),
                h = !1;
            Header.selectOptionRadio(f, "DCprefopt"), $(".DCprefopt").hide(), c = a = d.getSelCurTab(), b = $("#tab-txt >span").text(), (g.R > 0 || "R" == e) && "Commercial" != b ? ("L" == f && (f = "R"), "DealerTab" != a && "Dealer" != b || ($(".DCprefRes").show(), h = !0), "Rent/PG" == b && ("S" == f && (f = "R"), h = !0, $(".DCprefrent").show()), "Buy" == b && qsSrp.setPref("S")) : ($(".DCprefCom").show(), qsSrp.setRC("C"), "R" != f && "P" != f || (f = "L"), h = !0), 1 == h && ("ResBuyTab" == c ? qsSrp.setPref("S") : /iPhone|iPad|iPod/i.test(navigator.userAgent) ? qsSrp.setPref(f) : $('#opt_pref .ddlist a[val="' + f + '"]').trigger("click"), qsSrp.setText($("#opt_pref a.dropDown div"), $('#opt_pref .ddlist a[val="' + f + '"]').text()))
        },
        handleArea: function() {
            var a, b, c, d, e = this;
            a = e.getRC(), d = e.getPT(), b = $("#area_wrap");
            var f = this.isStudioApt(d);
            "R" == a && "3" != d && 0 != f ? (b.hide(), c = !0) : (b.show(), c = !1), $("#area_unit, #area_min, #area_max").prop("disabled", c)
        },
        handleBedroom: function() {
            var a, b, c, d, e, f = this;
            a = f.getRC(), d = f.getPT(), b = $("#bedroom_num_wrap"), e = this.getPref();
            var g = this.isStudioApt(d);
            "R" == a && "3" != d && "90" != d && 0 != g && "P" !== e ? (b.show(), c = !1) : (b.hide(), c = !0), $("#bedroom_num").prop("disabled", c)
        },
        isStudioApt: function(a) {
            if (void 0 === a) return !1;
            var b = a.split(":");
            b = b.sort();
            var c = !0;
            return 2 == b.length && "3" == b[0] && "90" == b[1] && (c = !1), c
        },
        handleNPsearchType: function() {
            var a, b, c, d, e = this;
            a = e.getRC(),
                d = e.getPT(), b = $("#np_search_type_wrap"), "R" == a && "23" == d || "C" == a && "26" == d ? (b.show(), c = !1) : (b.hide(), c = !0);
            var f = $("#tab-txt >span").text();
            "NpTab" != $(".search-tabs .sel").attr("id") && "Projects" != f || ($("#referrer_section").length > 0 && (document.getElementById("referrer_section").value = "GNB"), b.hide(), c = !1), $("#np_search_type").prop("disabled", c)
        },
        handleAvailability: function() {
            var a, b, c, d, e, f = this;
            a = f.getRC(), d = f.getPT(), b = $("#avail_wrap"), e = f.getSelCurTab();
            var g = $("#tab-txt >span").text();
            $("#rent_op_wrap").hide(), "23" != d && "26" != d && "DealerTab" != e && "ResRentTab" != e && "Dealer" != g && "Rent/PG" != g ? (b.show(), c = !1) : (b.hide(), c = !0, "ResRentTab" != e && "Rent/PG" != g || "C" == a || $("#rent_op_wrap").show()), $("#availability").prop("disabled", c)
        },
        handleClass: function() {
            var a, b, c, d, e = this;
            e.getRC(), c = e.getPT(), a = $("#posted_by_wrap"), d = e.getSelCurTab();
            var f = $("#tab-txt >span").text();
            "23" != c && "26" != c && "DealerTab" != d && "Dealer" != f ? (a.show(), "P" === this.getPref() ? a.find("#p_b").hide() : a.find("#p_b").show(), b = !1) : (a.hide(), b = !0), $("#posted_by").prop("disabled", b)
        },
        handleSharing: function() {
            var a = this.getPref(),
                b = $("#sharing_wrap");
            "P" === a ? b.show() : b.hide()
        },
        handleAvailableFor: function() {
            var a = this.getPref(),
                b = $("#available_for_wrap");
            "P" === a ? b.show() : b.hide()
        },
        npdiv: function() {
            $("#Header-Wrap").addClass("NP_SRP"), $("#proptype_wrap a.FI-Tag").addClass("Cons_status");
            var a, b = this;
            b.setST("PROJECT"), $("#selected_tab").val("3"), isMapSrch() && msrch.overRideSearchType("PROJECT"), $("#" + b.frm_id).attr("action", b.xAcn).attr("search_type", "PROJECT"), b.setPref("S"), _99ab.execFunc(Header.togglePropertyTypDrpDwnAB, Header.togglePropertyTypDrpDwn, Header, ["N"]), $(".npOpts").hide(), a = "C" == qsSrp.getRC() ? $("#Commercial_op") : $("#Residential_op"), a.next(".npOpts").show(), _99ab.execFunc(Header.npclickAB, Header.npclick, Header, [a]), Header.selectDefaultNpPtTypes(), Header.DeactivatePreferenceDrpDwn(), "lvl5_form" == qsSrp.frm_id && _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#NPddli")]), Homepage.hideRentCards(), $(".mcol").removeClass("rent"), Homepage.showFPPGBM(), hpdif.showDIFSection(), hpdif.moveDIFSectionDown()
        },
        resdiv: function(a) {
            $("#Header-Wrap").removeClass("NP_SRP"), $("#proptype_wrap a.FI-Tag").removeClass("Cons_status");
            var b = void 0 !== a ? a : "B";
            $("#selected_tab").val("1"), $("#s_property_type").attr("active", !0), Header.retainOrigParam();
            var c = this;
            c.setST("PROPERTY"), isMapSrch() && msrch.overRideSearchType("PROPERTY"), $("#" + c.frm_id).attr("action", c.pAcn).attr("search_type", "PROPERTY"), _99ab.execFunc(Header.togglePropertyTypDrpDwnAB, Header.togglePropertyTypDrpDwn, Header, [b]), c.setPref("S"), Header.DeactivatePreferenceDrpDwn(), "" == $("#budget_min").val() && "" == $("#budget_max").val() && qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), "Budget", !0), Homepage.hideRentCards(), Homepage.showFPPGBM(), $(".mcol").removeClass("rent"), hpdif.showDIFSection(), hpdif.moveDIFSectionDown()
        },
        resalediv: function() {},
        dealsdiv: function() {
            qsSrp.toggleDealsForm(!0), $("#selected_tab").val("7"), Homepage.hideRentCards(), Homepage.showFPPGBM(), $(".mcol").removeClass("rent"), hpdif.showDIFSection(), hpdif.moveDIFSectionDown()
        },
        rentdiv: function() {
            $("#Header-Wrap").removeClass("NP_SRP"), $("#proptype_wrap a.FI-Tag").removeClass("Cons_status"), Header.retainOrigParam(), $("#selected_tab").val("4"), $("#s_property_type").attr("active", !0);
            var a, b = this;
            a = b.getPref(), b.setST("PROPERTY"), isMapSrch() && msrch.overRideSearchType("PROPERTY"), $("#" + b.frm_id).attr("action", b.pAcn).attr("search_type", "PROPERTY"), _99ab.execFunc(Header.togglePropertyTypDrpDwnAB, Header.togglePropertyTypDrpDwn, Header, ["R"]), a = $("#rent_op a>i.radio-Yes").parent().attr("val"), Header.DeactivatePreferenceDrpDwn(), a = empty(a) ? "R" : a, b.setPref(a), "" == $("#budget_min").val() && "" == $("#budget_max").val() && qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), "Budget", !0), trackEventByGA("RENT_HP", !1, "RENT_HP_" + $("#srchhdr_selCityAtHeader").val(), "RENT_HP"), Homepage.showRentCards(), Homepage.hideFPPGBM(), $(".mcol").addClass("rent"), hpdif.showDIFSection(), hpdif.moveDIFSectionDown(), $("#spacer_fp_bottom").hide()
        },
        dlrdiv: function() {
            $("#Header-Wrap").removeClass("NP_SRP"), $("#proptype_wrap a.FI-Tag").removeClass("Cons_status"), Header.retainOrigParam(), $("#selected_tab").val("6"), $("#s_property_type").attr("active", !0);
            var a, b = this;
            b.setST("DEALER"), _99ab.execFunc(Header.togglePropertyTypDrpDwnAB, Header.togglePropertyTypDrpDwn, Header, ["D"]), $("#" + b.frm_id).attr("action", b.dAcn).attr("search_type", "DEALER"), a = b.getRC(), "C" == a ? $("#suggesterCtx").removeClass("suggestWrapWide suggestWrap").addClass("suggestWrapCom suggestWrapDeal") : $("#suggesterCtx").removeClass("suggestWrapWide suggestWrapCom").addClass("suggestWrap"), $("#Header-Wrap").removeClass("osrch comsrch").addClass("dlrsrch"), $("#tabSrchIpBtn button.green").hide(), $('#tabSrchIpBtn input[type="submit"].blue').addClass("dealermrgn"), Header.ActivatePreferenceDrpDwn(), Homepage.hideRentCards(), $(".mcol").removeClass("rent"), hpdif.showDIFSection(), hpdif.moveDIFSectionUp(), Homepage.showFPPGBM()
        },
        initScrollPanesIE: function() {
            $(".scrollbar1,.lfscrollbar2,.scrollbar96,.scrollbarfp,.scrolldifhpfilter").each(function(a) {
                var b = $(this),
                    c = "";
                if (b.hasClass("scrollbar96") && (c = "ptnr"), !b.children("div .viewport").length && b.hasClass("flipClose")) {
                    b.removeClass("flipClose").addClass("hidei");
                    var d = !0
                }
                b.children("div .viewport").length || (b.children().wrapAll('<div class="viewport ' + c + '" style="height:' + b.css("height") + '"><div class="overview"></div></div>'), $('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>').prependTo(b), b.css("clear", "both"), b.tinyscrollbar()), setTimeout(function() {
                    d && (b.removeClass("hidei").addClass("flipClose"), d = !1)
                }, 200)
            })
        },
        initScrollPanes: function() {
            try {
                env.ie ? qsSrp.initScrollPanesIE() : $(".scrollbar1,.lfscrollbar2,.scrollbar96,.scrollbarfp,.scrolldifhpfilter").each(function(a) {
                    var b = $(this),
                        c = "";
                    b.hasClass("scrollbar96") && (c = "ptnr"), b.children("div .viewport").length || (b.children().wrapAll('<div class="viewport ' + c + '" style="height:' + b.css("height") + '"><div class="overview"></div></div>'), $('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>').prependTo(b), b.css("clear", "both"), b.tinyscrollbar())
                })
            } catch (a) {}
        },
        commrcldiv: function() {
            $("#Header-Wrap").removeClass("NP_SRP"), $("#proptype_wrap a.FI-Tag").removeClass("Cons_status");
            var a = this;
            a.setST("PROPERTY"), $("#selected_tab").val("5"), isMapSrch() && msrch.overRideSearchType("PROPERTY"), $("#" + a.frm_id).attr("action", a.pAcn).attr("search_type", "PROPERTY"), _99ab.execFunc(Header.togglePropertyTypDrpDwnAB, Header.togglePropertyTypDrpDwn, Header, ["C"]), a.setRC("C"), Header.ActivatePreferenceDrpDwn(), $("#suggesterCtx").removeClass("suggestWrapWide suggestWrap suggestWrapDeal").addClass("suggestWrapCom"), $("#Header-Wrap").removeClass("osrch dlrsrch").addClass("comsrch"), qsSrp.data.res_com_orig = qsSrp.data.res_com, qsSrp.data.res_com = "C", qsSrp.data.property_type_orig = qsSrp.data.property_type, qsSrp.data.property_type = "C", $(".DCresOpen").hide(), $(".DCcomOpen").show(), /iPhone|iPad|iPod/i.test(navigator.userAgent) || ($("#tabSrchIpBtn button.green").show(), $('#tabSrchIpBtn input[type="submit"].blue').removeClass("dealermrgn")), Homepage.hideRentCards(), $(".mcol").removeClass("rent"), hpdif.showDIFSection(), hpdif.moveDIFSectionDown(), Homepage.showFPPGBM()
        },
        handleRC: function() {
            var a, b, c, d, e, f, g, h, i;
            a = this.getST(), i = $("#np_search_type_wrap"), "PROPERTY" == a ? (i.hide(), b = this.getRC(), c = ["L"], d = ["R", "P"], "C" == b ? (e = c, f = d) : (e = d, f = c), $("#propSRPTab a").each(function() {
                h = $(this), g = h.attr("val"), arr.in_array(f, g) ? h.hide() : arr.in_array(e, g) && h.show()
            })) : "PROJECT" == a && (b = this.getRC(), c = ["L"], d = ["R", "P"], i.show(), "C" == b ? (e = c, f = d) : (e = d, f = c), $("#propSRPTab a").each(function() {
                h = $(this), g = h.attr("val"), arr.in_array(f, g) ? h.hide() : arr.in_array(e, g) && h.show()
            }))
        },
        handleFlds: function(a) {
            var b, c;
            for (b in a) c = this.fldMap[a[b]], isset(c) && this[c].apply(this);
            frmUtil.refreshTabIndex(this.frm_id)
        },
        setUpFrm: function(a) {
            frmUtil.addAutoComplete(a), frmUtil.refreshTabIndex(a)
        },
        initFrm: function() {
            this.fillFrm(), this.handleFlds(["area", "bedroom", "budget", "np_search_type", "availability", "class", "preference"]), this.initScrollPanes()
        },
        switchSrchTab: function(a) {
            this.setST(a), this.resetFrm(), this.resetCity(), this.fillFrm(), this.showSrchCurTb(), "PROJECT" === a && this.fillNpSearchType()
        },
        handleST: function() {
            this.getST()
        },
        fillFrm: function() {
            var a = this.getST();
            this.data = srchFormData.getSrchTypeData(a), empty(this.data) || (void 0 !== this.data.class && this.setClass(this.data.class), this._fillFrm())
        },
        fillFrmElsePT: function() {
            var a = this.getST();
            if (this.data = srchFormData.getSrchTypeData(a), !empty(this.data))
                for (var b in this.data) fFunc = this.fillFldMapWPT[b], isset(fFunc) && this[fFunc].apply(this)
        },
        resetFrm: function() {
            for (var a in this.resetFldMap) this.resetFld(a)
        },
        resetFlds: function(a) {
            for (var b in a) this.resetFld(a[b])
        },
        resetFld: function(a) {
            rFunc = this.resetFldMap[a], isset(rFunc) && this[rFunc].apply(this)
        },
        _fillFrm: function() {
            for (var a in this.data) fFunc = this.fillFldMap[a], isset(fFunc) && this[fFunc].apply(this)
        },
        fillCity: function() {
            var a;
            a = this.data.city, this.getST(), $("#city").val(a)
        },
        fillRC: function() {
            var a, b, c = this;
            b = c.getST(), a = c.data.res_com, "PROJECT" == b ? ($('#s_res_com ul li[val="' + a + '"]').click(), "lvl5_form" != c.frm_id && "" != c.getRC() || c.setRC(a)) : "DEALER" == b || "PROPERTY" == b && ("lvl5_form" != c.frm_id && "" != c.getRC() || c.setRC(a))
        },
        fillPref: function() {
            var a, b;
            b = this.getST(), a = this.data.preference, $.inArray(a, ["S", "P", "R", "L"]) < 0 && (a = this.data.preference = "S"), this.setPref(a), "PROPERTY" == b && $('#rent_op a[val="' + a + '"]').trigger("click")
        },
        fillPT: function() {
            $("#s_property_type").removeClass("flipOpen").addClass("flipClose");
            var a, b = this.data.property_type,
                c = qsSrp.getRC();
            if (b = arr.is_arr_obj(b) || void 0 === b ? b : b.split(/,|:/), empty(b)) "C" == c ? $(".DCcomOpen i.checked").length > 0 ? _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#comddli")]) : (_99ab.execFunc(Header.clickSplAB, Header.clickSpl, Header, [$("#comddli")]), _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#comddli")])) : $(".DCresOpen i.checked").length > 0 ? _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#resddli")]) : (_99ab.execFunc(Header.clickSplAB, Header.clickSpl, Header, [$("#resddli")]), _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#resddli")]), $("#s_property_type").removeClass("flipOpen").addClass("flipClose"));
            else if (qsSrp.resetPT(), "R" == b[0]) "ComTab" != $(".search-tabs a.sel").attr("id") && qsSrp.setRC("R"), $(".DCresOpen a i").removeClass("unchecked").addClass("checked"), qsSrp.setPT("R"), $(".DCresOpen").show(), _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#resddli")]);
            else if ("C" == b[0]) qsSrp.setRC("C"), $(".DCcomOpen a i").removeClass("unchecked").addClass("checked"), qsSrp.setPT("C"), $(".DCcomOpen").show(), _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#comddli")]);
            else if ("C" == qsSrp.data.res_com && "C" == c || "C" == qsSrp.data.res_com && "R" == c) {
                qsSrp.setRC("C");
                for (a in b) {
                    var d = $('.DCcomOpen.child a[val="' + b[a] + '"]');
                    d.children("i.iconS").removeClass("unchecked").addClass("checked"), _99ab.execFunc(Header.clickSplAB, Header.clickSpl, Header, [d])
                }
                _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#comddli")]), $(".DCcomOpen").show()
            } else if ("R" == qsSrp.data.res_com && "R" == c || "R" == qsSrp.data.res_com && "C" == c) {
                "ComTab" != $(".search-tabs a.sel").attr("id") && qsSrp.setRC("R");
                for (a in b) {
                    var d = $('.DCresOpen.child a[val="' + b[a] + '"]');
                    d.children("i.iconS").removeClass("unchecked").addClass("checked"), _99ab.execFunc(Header.clickSplAB, Header.clickSpl, Header, [d])
                }
                _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [$("#resddli")]), $(".DCresOpen").show()
            }
            _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"]), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []);
            try {
                var e = $(".DCresOpen").find("a[val='3']");
                "R" == qsSrp.getPref() ? (e.hide(), Header.updateTabText()) : (e.show(), Header.updateTabText())
            } catch (f) {}
        },
        fillBudgetMin: function() {
            this._fillBudget("min")
        },
        fillBudgetMax: function() {
            this._fillBudget("max")
        },
        _fillBudget: function(a) {
            var b, c, d = this,
                e = d.getPref();
            b = d.data["budget_" + a], empty(e) && (e = d.data.preference), c = arr.in_array(["R", "P", "L"], e) ? "rent" : "buy", Header.updateOtherPriceDD($(".combFI .ddlist a[val=" + b + "]"), c, a), this.updateBudget($("#s_" + c + "_budget_" + a + ' .ddlist a[val="' + b + '"]'), c, a)
        },
        fillAreaMin: function() {
            this._fillArea("min")
        },
        fillAreaMax: function() {
            this._fillArea("max")
        },
        _fillArea: function(a) {

            var b = this.data["area_" + a];
            /iPhone|iPad|iPod/i.test(navigator.userAgent) ? $("#area_" + a).val(b) : $("#area_" + a).val(b).trigger("blur")
        },
        fillAreaUnit: function() {
            var a = this.data.area_unit;
            /iPhone|iPad|iPod/i.test(navigator.userAgent) || $('#s_area_unit a[val="' + a + '"]').trigger("click")
        },
        fillAreaLbl: function() {
            var a, b = this,
                c = b.getAreaMin(),
                d = b.getAreaMax(),
                e = b.getAreaUnit();
            a = $('#s_area_unit a[val="' + e + '"]').text(), b.setDefLbl($("#area_lbl"), b.buildAreaDispLbl(c, d, a))
        },
        fillClass: function() {
            var a, b = this.getClass();
            if (empty(b) || (b = b.split(",")), 3 == b.length && "undefined" != typeof currentPageName && !arr.in_array(["QS", "NPSEARCH"], currentPageName) || "DEALERSEARCH" == currentPageName) return void this.resetClass();
            if (!empty(b)) {
                b = arr.is_arr_obj(b) ? b : b.split(/,/);
                for (a in b) $('#s_class .ddlist a[value="' + b[a] + '"]>i').addClass("checked").trigger("click")
            }
        },
        fillAvail: function() {
            var a = $("#availability").val();
            if (!empty(a) && "undefined" != typeof currentPageName && !arr.in_array(["QS", "NPSEARCH", "DEALERSEARCH"], currentPageName)) return void $("#availability").val("");
            empty(a) || $('#s_avail .ddlist a[val="' + a + '"]').click()
        },
        fillAvailableFor: function() {
            var a = this.getAvailableFor();
            if (!empty(a)) {
                a = arr.is_arr_obj(a) ? a : a.split(/,/);
                for (b in a) $('#s_available_for .ddlist a[val="' + a[b] + '"]>i').addClass("checked").trigger("click")
            }
        },
        fillSharing: function() {
            var a = this.getSharing();
            if (!empty(a)) {
                a = arr.is_arr_obj(a) ? a : a.split(/,/);
                for (b in a) $('#s_sharing .ddlist a[val="' + a[b] + '"]>i').addClass("checked").trigger("click")
            }
        },
        fillNpSearchType: function() {
            if (!/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                var a, b, c = this.data.np_search_type;
                if (!(empty(c) || "undefined" == typeof currentPageName || arr.in_array(["NPSEARCH"], currentPageName) && "PROJECT" == qsSrp.search_type)) return void(this.data.np_search_type = "");
                if (target = "C" == qsSrp.getRC() ? "s_np_search_type_com" : "s_np_search_type_res", empty(c)) b = "C" == qsSrp.getRC() ? $("#Commercial_op") : $("#Residential_op"), _99ab.execFunc(Header.npclickAB, Header.npclick, Header, [b]);
                else {
                    c = arr.is_arr_obj(c) ? c : c.split(/,/);
                    for (a in c) try {
                        var d = c[a];
                        "R" == d ? d = "R2M" : "N" == d && (d = "NL"), $("#" + target + '  a[val="' + d + '"]').trigger("click")
                    } catch (e) {}
                }
            }
        },
        fillBedroom: function() {
            if (!/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                var a, b = this.data.bedroom_num;
                if (!empty(b)) {
                    b = arr.is_arr_obj(b) ? b : b.split(/,/);
                    for (a in b) $('#s_bedroom_num .ddlist a[val="' + b[a] + '"]>i').addClass("checked").trigger("click")
                }
            }
        },
        fillKeyword: function() {
            var a = this,
                b = a.data.keyword;
            a.setKeyword(b)
        },
        showSrchCurTb: function() {
            var a, b, c, d, e;
            a = qsSrp.getRC(), b = qsSrp.getPref(), c = qsSrp.getST(), "S" == b && "PROPERTY" == c && "R" == a ? (e = "resdiv", d = "Buy") : "PROPERTY" == c && "R" == a ? (e = "rentdiv", d = "Rent/PG") : "PROPERTY" == c && "C" == a ? (e = "commrcldiv", d = "Commercial") : "PROJECT" == c ? (e = "npdiv", d = "Projects") : "DEALER" == c && (e = "dlrdiv", d = "Dealer"), window.qsSrp[e](), qsSrp.setText($("#tab-txt span"), d), "undefined" != typeof currentPageName && "DEALERSEARCH" != currentPageName && "NPSEARCH" != currentPageName && "QS" != currentPageName && "commrcldiv" == e && _99ab.execFunc(qsSrp.fillPTAB, qsSrp.fillPT, qsSrp, []), qsSrp.handleFlds(["area", "bedroom", "budget", "np_search_type", "availability", "class", "preference"])
        },
        showCurTb: function() {
            var a, b, c, d, e;
            a = this.getST(), c = this.getRC(), b = this.getPref(), this.getPT(), empty(clikTab) ? "PROPERTY" == a ? "R" == c ? (e = "S" == b ? "ResBuyTab" : "ResRentTab", d = "S" == b ? "resdiv" : "rentdiv") : (d = "commrcldiv", e = "ComTab") : "PROJECT" == a ? (d = "npdiv", e = "NpTab") : "DEALER" == a ? (d = "dlrdiv", e = "DealerTab") : (e = "R" == c ? "ResBuyTab" : "ComTab", d = "R" == c ? "resdiv" : "commrcldiv") : "Buy" == clikTab ? (e = "ResBuyTab", d = "resdiv") : "Com" == clikTab ? (e = "ComTab", d = "commrcldiv") : "Rent/PG" == clikTab ? (e = "ResRentTab", d = "rentdiv") : "Dealer" == clikTab ? (e = "DealerTab", d = "dlrdiv") : "NP" == clikTab ? (e = "NpTab", d = "npdiv") : (e = "R" == c ? "ResBuyTab" : "ComTab", d = "R" == c ? "resdiv" : "commrcldiv"), Homepage.TabSelectorHp(e), window.qsSrp[d](), "commrcldiv" == d && _99ab.execFunc(qsSrp.fillPTAB, qsSrp.fillPT, qsSrp, []), qsSrp.handleFlds(["area", "bedroom", "budget", "np_search_type", "availability", "class", "preference"])
        },
        updateCity: function(a) {
            qsSrp.getST(), qsSrp.getPT();
            a.each(function() {
                var a = $(this),
                    b = a.closest("form");
                b.find(".city").val(a.attr("val")), b.find(".s_city").hide(), qsSrp.setText(b.find(".city_wrap a span"), a.text())
            })
        },
        updateNPCity: function(a) {
            a.each(function() {
                var a = $(this);
                a.attr("val");
                $("#city").val(a.attr("val")), $("#s_np_city").hide(), qsSrp.setText($("#np_city_wrap a span"), a.text())
            })
        },
        updateAvailableFor: function(a) {
            $("#available_for").val(a)
        },
        updateSharing: function(a) {
            $("#sharing").val(a)
        },
        updateBudget: function(a, b, c) {
            a.length > 0 && ($("#budget_" + c).val(a.attr("val")), qsSrp.setText($("#" + b + "_budget_" + c + "_wrap .FI-Tag div"), a.text()), "min" == c ? qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), a.text() + "-" + $("#" + b + "_budget_max_wrap .FI-Tag div").text()) : "max" == c && qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), $("#" + b + "_budget_min_wrap .FI-Tag div").text() + "-" + a.text())), this.validateMinMax()
        },
        setPTtoDf: function() {
            var a, b, c, d, e;
            a = $("#s_property_type .child input:checkbox:checked:not(:disabled)").map(function() {
                return $(this).val()
            }).get().join(":"), b = a ? a.split(/:|,/) : [], $("#property_type").val(a), c = b.length, d = "1" == c ? $('#s_property_type .child input:checkbox[value="' + a + '"]').siblings("label").text() : "0" == c ? qsSrp.getDefLbl("property_type") : c + " Selected", 0 != c && c == $("#s_property_type .child").find("input:checkbox:not(:disabled)").length && (d = $("#s_property_type .child").siblings("input:checkbox:checked:not(:disabled)").next("label").text()), e = qsSrp.getDefLbl("property_type") == d, qsSrp.setText($("#property_type_wrap a span"), d, e)
        },
        validateMinMax: function() {
            BUYING_BUDGET_MIN_VALUE = 1, BUYING_BUDGET_MAX_VALUE = 99, MONTHLY_BUDGET_MIN_VALUE = 100, MONTHLY_BUDGET_MAX_VALUE = 199;
            var a = $("#budget_min"),
                b = $("#budget_max"),
                c = !1,
                d = this.getPref(),
                e = a.val(),
                f = b.val(),
                g = [BUYING_BUDGET_MIN_VALUE, BUYING_BUDGET_MAX_VALUE, MONTHLY_BUDGET_MIN_VALUE, MONTHLY_BUDGET_MAX_VALUE];
            return d = "S" == d ? "buy" : "rent", $("#budget_min, #budget_max").prop("disabled", !1), $("#" + d + "_budget_min_wrap , #" + d + "_budget_max_wrap").removeClass("ddDisable"), e = parseInt(empty(e) ? 0 : e), f = parseInt(empty(f) ? 0 : f), arr.in_array(g, e) ? (c = !0, $("#" + d + "_budget_max_wrap").addClass("ddDisable"), qsSrp.setDefLbl($("#" + d + "_budget_max_wrap a.FI-Tag div"), "Max"), $("#budget_max").val(0).prop("disabled", !0), qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), $("#s_budget .combFI #" + d + "_budget_min_wrap .dd-list-menu .ddlist a[val=" + e + "]").text())) : arr.in_array(g, f) ? (c = !0, $("#" + d + "_budget_min_wrap").addClass("ddDisable"), qsSrp.setDefLbl($("#" + d + "_budget_min_wrap a.FI-Tag div "), "Min"), $("#budget_min").val(0).prop("disabled", !0), qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), $("#s_budget .combFI #" + d + "_budget_min_wrap .dd-list-menu .ddlist a[val=" + f + "]").text())) : (f > e || 0 == f) && (c = !0), c
        },
        updateYsf: function() {},
        closeDrpDownsSpl: function(a) {
            "s_property_type" == a ? ($('div.ddlstSrp[id!="' + a + '"][id!="np_op"]').removeClass("flipOpen").addClass("flipClose").css("z-index", "0"), closeArrow($('div.ddlstSrp[id!="' + a + '"][id!="np_op"]'))) : "s_area_unit" == a ? ($('div.ddlstSrp[id!="' + a + '"][id!="s_area"]').removeClass("flipOpen").addClass("flipClose").css("z-index", "0"), closeArrow($('div.ddlstSrp[id!="' + a + '"][id!="s_area"]'))) : "s_budget" == a ? ($('div.ddlstSrp[id!="s_budget"][id!="s_budget"][id!="BudgetWrapSrp"]').removeClass("flipOpen").addClass("flipClose").css("z-index", "0"), closeArrow($('div.ddlstSrp[id!="s_budget"][id!="s_budget"][id!="BudgetWrapSrp"]'))) : ($('div.ddlstSrp[id!="' + a + '"]').removeClass("flipOpen").addClass("flipClose").css("z-index", "0"), closeArrow($('div.ddlstSrp[id!="' + a + '"]'))), $(".pList-wrap").css("z-index", "2"), $("#search-filter .FI-Box>.dd-list-menu").css("z-index", "-1"), qsSrp.closeDrpDowns(a)
        },
        closeDrpDowns: function(a) {
            "buyRent" != a && $("div.ddlst, #tab-items").hide(), $(".sWrpEl").css("z-index", 1);
            var b = $("#" + a).siblings("a.dropDown.FI-Tag"),
                c = b.hasClass("whiteFocus");
            $("#search-bar-Bg a.dropDown, #srpSearchHeader a.dropDown").removeClass("whiteFocus"), c ? b.removeClass("whiteFocus") : b.addClass("whiteFocus")
        },
        resetPref: function() {
            var a, b, c = this;
            a = $('#opt_pref a[val="S"],#rent_op a[val="R"]'), c.setPref("S"), /iPhone|iPad|iPod/i.test(navigator.userAgent) || a.trigger("click"), b = c.getSelCurTab(), "ResRentTab" == b && c.setPref("R"), 1 != $("#is_home").val() && "4" == $("#selected_tab").val() && c.setPref("R"), c.setText($("#opt_pref a.dropDown div"), c.getDefLbl("preference"))
        },
        resetAvail: function() {
            var a = this;
            $("#availability").val(""), $("#opt_pref a>.radio-Yes,#s_avail a>.radio-Yes").removeClass("radio-Yes").addClass("radio-No"), a.setText($("#avail_wrap a.dropDown div"), a.getDefLbl("availability"))
        },
        resetPT: function() {
            var a = this;
            a.setPT(""), "lead_search" == a.frm_id && (a.setDefLbl($("#property_type_wrap a span"), a.getDefLbl("property_type")), $("#s_property_type ul li").find("input[type=checkbox]:checked").removeAttr("checked"), $("#s_property_type ul li").removeClass("opa5")), $(".DCheadingOpt").each(function() {
                $(this).children("i").removeClass("checked p-of-checked").addClass("unchecked")
            }), $(".DCpropTypOpt").each(function() {
                $(this).children("i").removeClass("checked").addClass("unchecked")
            }), $(".DCcomOpen").hide(), $(".DCresOpen").hide()
        },
        resetCity: function() {
            var a = this;
            a.setCity(""), a.setInputEmpty($("#city_ac"))
        },
        resetDYM: function() {
            var a = this;
            a.setPreviousCity(""), a.setPreviousKeyword("")
        },
        resetBudget: function() {
            var a = this;
            a.resetBudgetMin(), a.resetBudgetMax(), $("#s_buy_budget_max a,#s_rent_budget_max a,#s_buy_budget_min a,#s_rent_budget_min a").show();
            qsSrp.getPref();
            qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), "Budget", !0), a.removeBudgetErr()
        },
        resetBudgetMin: function() {
            var a = this;
            a.setBudgetMin(""), $("#s_buy_budget_min a,#s_rent_budget_min a").show(), a.setDefLbl($("#buy_budget_min_wrap a.FI-Tag>div, #rent_budget_min_wrap a.FI-Tag>div"), a.getDefLbl("budget_min")), $("#buy_budget_min_wrap a.FI-Tag, #rent_budget_min_wrap a.FI-Tag").removeClass("ddDisable"), $("#budget_min").prop("disabled", !1)
        },
        resetBudgetMax: function() {
            var a = this;

            a.setBudgetMax(""), $("#s_buy_budget_max a,#s_rent_budget_max a").show(), a.setDefLbl($("#buy_budget_max_wrap a.FI-Tag>div, #rent_budget_max_wrap a.FI-Tag>div"), a.getDefLbl("budget_max")), $("#buy_budget_max_wrap a.FI-Tag, #rent_budget_max_wrap a.FI-Tag").removeClass("ddDisable"), $("#budget_max").prop("disabled", !1)
        },
        resetAreaMin: function() {
            this.setAreaMin("")
        },
        resetAreaMax: function() {
            this.setAreaMax("")
        },
        resetAreaUnit: function() {
            var a = this;
            a.setAreaUnit("1"), a.setDefLbl($("#area_unit_wrap a>div"), a.getDefLbl("area_unit"))
        },
        resetArea: function() {
            var a = this;
            a.setDefLbl($("#area_lbl"), a.getDefLbl("area"))
        },
        resetKeyword: function() {
            this.setKeyword(""), $("#locality_array[]").val(""), $("#" + qsSrp.frm_id + ' [name="locality_array[]"]').remove()
        },
        resetClass: function() {
            var a = this;
            a.setClass(""), a.setText($("#posted_by_wrap a.ddLClick div"), "Posted By", !0), a.setDefLbl($("#class_wrap a span"), a.getDefLbl("class")), $("#s_class a>i").removeClass("checked").addClass("unchecked")
        },
        resetBedroom: function() {
            var a = this;
            a.setBedroom(""), a.setDefLbl($("#bedroom_num_wrap a.ddLClick div"), a.getDefLbl("bedroom")), $("#s_bedroom_num a>i").removeClass("checked").addClass("unchecked")
        },
        resetSharing: function() {
            var a = "";
            $("#sharingLabel").text().indexOf("NEW") > -1 && (a = $("#sharingLabel").html());
            var b = this;
            b.setSharing(""), a || (a = b.getDefLbl("sharing")), b.setText($("#sharingLabel"), a), $("#s_sharing a>i").removeClass("checked").addClass("unchecked")
        },
        resetAvailableFor: function() {
            var a = this;
            a.setAvailableFor(""), a.setText($("#availableForLabel"), a.getDefLbl("available_for")), $("#s_available_for a>i").removeClass("checked").addClass("unchecked")
        },
        resetNpSearchType: function() {
            var a = this;
            a.setNpSearchType(""), a.setDefLbl($("#np_search_type_wrap a.ddLClick div"), a.getDefLbl("np_search_type")), $("#s_np_search_type a>i,#s_np_search_type_res a>i,#s_np_search_type_com a>i,#s_np_search_type_res div>i,#s_np_search_type_com div>i").removeClass("checked").addClass("unchecked")
        },
        removeBudgetErr: function() {},
        restCityErr: function(a) {
            $("#city").attr("focus", a), jsval.rstErrFld("city"), jsval.rstErrFld("city")
        },
        removeFpCheck: function() {
            $("#city_fp_box ul").find("input[type=checkbox]:checked").removeAttr("checked")
        },
        getCityList: function(a, b) {
            var c, d, e, f = [],
                g = {},
                h = this;
            return c = a ? "s_np_city" : "s_city", !a && h.cityList.length > 0 ? f = h.cityList : a && h.npCityList.length > 0 ? f = h.npCityList : (e = b.closest("form"), e.find("." + c + " li label").each(function() {
                d = $(this), g = {
                    label: d.text(),
                    val: d.attr("val"),
                    map: d.attr("map")
                }, f.push(g)
            }), a ? h.npCityList = f : h.cityList = f), f
        },
        isNpCityDD: function(a) {
            return "np_city_ac" == a
        },
        getSelCurTab: function() {
            return $("#search-bar-hp .search-tabs>a.sel").attr("id")
        },
        addCityAutoComplete: function() {
            $(".city_ac, .np_city_ac").autocomplete({
                minLength: 0,
                delay: 0,
                source: function(a, b) {
                    var c, d, e, f, g, h, i, j, k = [],
                        l = [],
                        m = {},
                        n = [],
                        o = this.element,
                        p = qsSrp.getST();
                    c = new RegExp("^" + $.ui.autocomplete.escapeRegex(a.term), "i"), d = new RegExp("(.)+" + $.ui.autocomplete.escapeRegex(a.term), "i"), g = o.hasClass("np_city_ac"), f = qsSrp.getCityList(g, o), h = isMapSrch(), i = !h || h && "PROPERTY" != p && "PROJECT" != p, $.grep(f, function(a) {
                        (j = i || "Y" == a.map) && (c.test(a.label) ? k.push(a) : d.test(a.label) && l.push(a))
                    }), e = k.concat(l), $.each(e, function(a, b) {
                        m[b.val] || (m[b.val] = !0, n.push(b))
                    }), b(n.slice(0, 10))
                },
                search: function(a, b) {
                    var c = $(this),
                        d = c.parent().parent(),
                        e = c.val();
                    if (empty(e) || e == c.attr("placeholder")) return qsSrp.hideCitySuggestor(d), !1;
                    d.find("div.scrollbar1").hide(), d.find("i.sugestCross").show(), d.find("ul.ui-autocomplete").addClass("child").show()
                },
                open: function(a, b) {
                    var c = $(this);
                    c.siblings(".ui-autocomplete").css("top", "0px").width(c.parent().parent().width() - 20)
                },
                select: function(a, b) {
                    if (b.item) {
                        var c, d, e, f, g = $(this);
                        c = g.hasClass("np_city_ac"), f = g.closest("form"), d = c ? "s_np_city" : "s_city", e = f.find($("." + d + ' ul li label[val="' + b.item.val + '"]')), c ? qsSrp.updateNPCity(e) : qsSrp.updateCity(e), qsSrp.execLocality()
                    }
                }
            }).keydown(function(a) {
                if (13 == a.which) {
                    var b, c = $(this),
                        d = c.val();
                    c.autocomplete("option");
                    empty(c) || (d = d.trim()), b = new RegExp("^" + $.ui.autocomplete.escapeRegex(d) + "$", "i"), c.autocomplete("widget").children(".ui-menu-item").each(function() {
                        var a = $(this).data("item.autocomplete");
                        if (b.test(a.label)) return $(this).click(), !1
                    })
                }
            })
        },
        hideCitySuggestor: function(a) {
            var b;
            a.find(".city_ac, .np_city_ac").val(""), a.find("i.sugestCross").hide(), a.find("ul.ui-autocomplete").empty().hide(), b = a.find("div.scrollbar1"), b.length > 0 && b.show().tinyscrollbar_update()
        },
        monkeyPatchAutocomplete: function() {
            $.ui.autocomplete.prototype._renderItem = function(a, b) {
                var c = b.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
                return $("<li></li>").data("item.autocomplete", b).append("<a>" + c + "</a>").appendTo(a)
            }
        },
        setInputEmpty: function(a) {
            return v = jsval.isPlaceHolderSup() ? "" : a.attr("placeholder"), a.val(v)
        },
        mainSrchLoadFunc: function(a, b) {
            var c, d = a,
                e = $(d).closest("form"),
                f = e.get(0),
                g = d.id,
                h = qsSrp.getST(),
                i = 0,
                j = (qsSrp.getCity(), e.find("#city").val()),
                k = e.find("#keyword").val(),
                l = -1 != e.attr("id").indexOf("lead_search"),
                m = !1,
                n = "",
                o = f.id,
                p = null;
            return qsSrp.closeDrpDowns(), Suggester99 && Suggester99.isAutoSuggesterSet() && Suggester99.getAutoSuggesterInstance().hideSuggestionContainer(!0), l && buyerSearchLoaderHandler.loadTupleLoader(), isMapSrch() && (toggleClusterView(b, "close"), 1 == $("#mapsearch").val() && (m = !0)), jsval.remPlaceHolderVal(e), j = $.trim(j), k = $.trim(k), qsSrp.flg || j ? qsSrp.validateMinMax() ? ("undefined" != typeof Suggester99 && Suggester99.performTask(m), jsval.vf(f) ? (isMapSrch() && 1 == $("#mapsearch").val() ? (Suggester99 && (Suggester99.isAutoSuggesterSet() && Suggester99.getAutoSuggesterInstance().hideSuggestionContainer(!0), Suggester99.hideSuggestions()), msrch.handleTab(qsSrp.getPref()), msrch.getSearchData(b)) : (p = getCookieVal("99_defsrch"), ("map_submit_query" == g && !submitButton.enterKeyPressedFlag || void 0 !== p && "m" == p && ("PROPERTY" == h || "PROJECT" == h) && "lvl5_form" == o) && (qsSrp.isMapActive() && $(f).append('<input type="hidden" name="mapsearch" value="1">'), i = 1)), $(f).append('<input type="hidden" name="searchform" value="1">'), m && (qsSrp.flg = !1), $(f).append('<input type="hidden" name="refSection" value="GNB">'), c = searchUtil.submitHeader5Form(f, i), l ? (Suggester99.removeTypeElement(), !0) : (c && "undefined" != typeof currentPageName && "DEALERSEARCH" != currentPageName && "NPSEARCH" != currentPageName && "QS" != currentPageName && trackEventByGA(qsSrp.getST(), "SUBMIT_CLICK_" + (i ? "MAPSEARCH" : "SEARCH"), "1"), c || i || isMapSrch() || ($("#city").val(""), qsSrp.flg = !1), c && qsSrp.onSrchExecTrck(e.attr("id"), i || 1 == $("#mapsearch").val()), c)) : (jsval.inlineErrs(f), jsevt.stopEvt(b))) : jsevt.stopEvt(b) : 0 == k.length || k == qsSrp.keywordText ? qsSrp.cityErr() : (qsSrp.btn = $(a), n = "", l || i || "PROJECT" == h || (n = "true"), qsSrp.queryQER(k, n), !1)
        },
        onSrchExecTrck: function(a, b) {
            var c = "PROJECT" == qsSrp.getST() ? "Project" : "Property",
                d = "res_form" == a ? "HP" : "Header",
                e = {
                    1: "_BUY",
                    2: "_RESALE",
                    3: "_PROJECTS",
                    4: "_RENT",
                    5: "_COMMERCIAL",
                    6: "_DEALERS"
                };
            c += b ? "_Map" : "_SRP", c += "_Enter", trackEventByGA("QS Action", "CLICK_HEADER", c), d += void 0 !== e[$("input[name=selected_tab]").val()] ? e[$("input[name=selected_tab]").val()] : "_OTHER", d += b ? "_MAPSEARCH" : "_SEARCH", d += "_" + qsSrp.getRC(), trackEventByGA("SrchTrk", d, "1")
        },
        execLocality: function() {
            ls.res_com = qsSrp.getRC(), ls.execLocality("keyword")
        },
        buildAreaDispLbl: function(a, b, c) {
            return empty(b) && !empty(a) && "Min" != a ? a + "-Max " + c : empty(a) && !empty(b) && "Max" != b ? "Min-" + b + " " + c : empty(a) || empty(b) ? this.getDefLbl("area") : a + "-" + b + " " + c
        },
        suggesterChecks: function() {
            Suggester99 && (Suggester99.resetSelf(), Suggester99.initializeAutoSuggestorInstance(), qsSrp.resetDYM(), qsSrp.resetCity())
        },
        remMapPrefOpt: function() {},
        buildMapPrefOpt: function() {
            var a, b, c, d = "",
                e = qsSrp.getRC(),
                f = qsSrp.getPref();
            a = {
                R: {
                    S: "Residential Buy",
                    R: "Residential Rent",
                    P: "Residential PG"
                },
                C: {
                    S: "Commercial Buy",
                    L: "Commercial Lease"
                }
            }, optList = a[e], selPrefLbl = optList[f], modeStr = "";
            for (b in optList) c = optList[b], cls = f == b ? "ssSel " : "", modeStr += '<li><a href="javascript:;" val="' + b + '" class="grey2 ' + cls + '">' + c + "</a></li>";
            d += '<ul class="nMenu r05" style="background:none; border:none;filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);"><li class="hasLyr zIdxLrge_mapn"><a href="javascript:void(0);" class="fnts13_mapn"><label class="propMapSRPTabSel grey2 lf">' + selPrefLbl + '</label><i class="mapUic2 moreFi"></i></a><div class="lyrUIw liP8"><span class="ttl nowrap fnts13_mapn"><label class="propMapSRPTabSel lf">' + selPrefLbl + '</label><i class="mapUic2 lessFi"></i></span><ul class="bList wid170_mapn" id="propMapSRPTab">' + modeStr + "</ul></div></li></ul>", $("#propMapSRPTab a").click(function() {
                var a, b, c = $(this);
                c.hasClass("ssSel") || (b = c.attr("val"), a = qsSrp.getPref(), arr.in_array(["R", "P"], b) && arr.in_array(["R", "P"], a) || qsSrp.resetFlds(["budget"]), qsSrp.setPref(b), c.parent().siblings().children().removeClass("ssSel"), c.addClass("ssSel"), $(".propMapSRPTabSel").html(c.html()), qsSrp.handleFlds(["property_type", "budget"]), Suggester99 && (Suggester99.resetSelf(), Suggester99.initializeAutoSuggestorInstance(), qsSrp.resetDYM()))
            })
        },
        isSubCity: function(a) {
            var b, c = !1;
            return b = $("#s_city .overview").find('label[val="' + a + '"]:first'), 1 == b.length && (c = !b.hasClass("subCatLi")), c
        },
        getFrmSrchData: function() {
            var a, b = [];
            a = frmUtil.getFormData($("#" + qsSrp.frm_id).get(0));
            for (key in remSrch.getKeyMap()) void 0 != typeof a[key] && (b[key] = a[key]);
            return b
        },
        getSelectedLocalities: function() {
            var a, b, c, d, e = [],
                f = 0,
                g = qsSrp.frm_id,
                h = [],
                i = [],
                j = 0;
            $("#" + g + " input[name='locality_array[]']").each(function() {
                e[f++] = $(this).val()
            }), e = arr.array_unique(e), h = $("#keyword").val().replace(/,*$/, "").replace(/-/g, " ").toLowerCase().split(",");
            try {
                for (b in e)
                    if (void 0 != (a = e[b]) && "" != a) {
                        c = search.city_locs["'" + a + "'"].LABEL.toLowerCase().replace(/-/g, " ");
                        for (d in h) h[d] == c && (i[j++] = a, h.splice(d, 1))
                    }
            } catch (k) {
                return e
            }
            return i
        },
        getSelectedBuildings: function() {
            var a, b = [];
            return a = $("#building_id").val(), empty(a) || (b = a.split(",")), b = arr.array_unique(b)
        },
        getSelectedLocalitiesName: function(a) {
            var b, c = [];
            try {
                for (b in a) loc = a[b], void 0 != loc && "" != loc && (locality_label = search.city_locs["'" + loc + "'"].LABEL.toLowerCase().replace(/-/g, " "), empty(locality_label) || c.push(locality_label))
            } catch (d) {}
            return c
        },
        getSelectedBuildingsName: function(a) {
            var b, c, d = [];
            for (b in a) void 0 != (c = a[b]) && "" != c && (building_label = $("#buldngCl a[val='" + c + "'] em").first().text(), empty(building_label) || d.push(building_label));
            return d
        },
        getCityName: function() {
            var a, b, c = $("#city").val();
            return a = $("#s_city .overview").find('label[val="' + c + '"]:first'), 1 == a.length && (b = a.text()), b
        },
        showMapActiveCities: function() {
            $("#s_city li label").each(function() {
                $(this).parent().show()
            })
        },
        queryQER: function(a, b) {
            ajax.getText({
                url: this.QERurl,
                ctx: qsSrp,
                params: {
                    keyword: a,
                    dym: b
                },
                method: "GET"
            }, qsSrp.success, qsSrp.failure)
        },
        success: function(a) {
            var b, c = JSON.parse(a);
            if ($.isArray(c) && 1 === c.length) {
                var d = c[0];
                b = $.isPlainObject(d) && d.city && $.isArray(d.city) ? parseInt(d.city[0]) : ""
            }
            if (!b) return qsSrp.cityErr(c);
            b = parseInt(b), $("#city").val(b), qsSrp.flg = !0;
            var e = qsSrp.btn;
            if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                var f = document.createEvent("HTMLEvents");
                f.initEvent("click", !0, !0), e[0].dispatchEvent(f)
            } else e.trigger("click")
        },
        failure: function() {},
        cityErr: function(a) {
            var b = '<div class="infoTip f12 ital tool_tip3 citysserr" id="bellIcn" style="display: block;z-index:10001;top:43px;width:354px;"></div>';
            if ($.isArray(a) && 0 !== a.length) {
                var c = "<ul>";
                $.each(a, function(a, b) {
                    b.city && $.isArray(b.city) && b.city.length > 0 && (c += "<li style='font-size:13px;display:inline-block;'><a id='sdym' href='javascript:void(0);' data-city=\"" + b.city[0] + '">' + b.entityLabel + "</a></li> ")
                }), c += "</ul>";
                var d = '<em class="upPin"></em><em class="text">Are you searching in cities: ' + c + "</em>"
            } else var d = '<em class="upPin"></em><em class="text" style="color:red;">Please enter a city or locality.</em>';
            return $(".citysserr").length <= 0 && $(".zhndle").append(b), $(".citysserr").html(d), $(".citysserr").show(), !1
        },
        readCookie: function() {
            if (null == this.cookies) {
                var a = document.cookie.split("; ");
                this.cookies = {};
                for (var b = a.length - 1; b >= 0; b--) {
                    var c = a[b].split("=");
                    this.cookies[c[0]] = c[1]
                }
            }
            return this.cookies
        },
        createCORSRequest: function(a, b) {
            var c = new XMLHttpRequest;
            return "withCredentials" in c ? c.open(a, b, !0) : "undefined" != typeof XDomainRequest ? (c = new XDomainRequest, c.open(a, b)) : c = null, c
        },
        sendSearchData: function(a, b) {
            a += b;
            var c = this.createCORSRequest("POST", a);
            c && c.send()
        },
        stringToArray: function(a, b) {
            var c = a ? a.split(",") : [];
            return b && c.length > 0 && (c = c.map(function(a) {
                return Number(a)
            })), c
        },
        intToStringArray: function(a, b) {
            return void 0 === a || 0 == a.length ? [] : (b || (a = a.split(",")), a.map(function(a, b, c) {
                return "" + a
            }), a)
        },
        getSelectedTuppleInfoForCSTrack: function(a, b) {
            var c = {};
            if (a) {
                for (var d = 0; a[d]; d++)
                    if (a[d].id == parseInt(b.id)) {
                        c[0] = a[d];
                        break
                    } return c
            }
        },
        getPDRecomTracking: function(a, b) {
            var c = {};
            c.page = "PROPERTY_LIST_LANDING_PAGE", c.stage = "FINAL", c.event = "PAGE_VIEW", c.referrer_section = $("#recom_referrer_section").attr("value"), void 0 !== a && "" != b && (c.event = "CLICK", c.section = a.toUpperCase());
            var d = {},
                e = {};
            if (e.recom_type = $("#pdRecom_type").attr("value"), e.entity_type = "PROPERTY", e.recom_entity = JSON.parse($("#pdRecom_data").val()), b) {
                var f = this.getSelectedTuppleInfoForCSTrack(e.recom_entity, b);
                $.isEmptyObject(f) || (e.selected_entity = f)
            }
            e.page = 1, e.res_com = $("#listingType").attr("value"), e.page_result_count = e.recom_entity.length, e.preference = $("#pref").attr("value"), d.recommendation = e;
            var g = {};
            g.action = c, g.payload = d, clickStream.doClickStreamTracking(g, !0)
        },
        collectSearchData: function(a, b, c, d, e, f) {
            var g = {},
                h = "1";
            if ("PROPERTY_LIST_LANDING_PAGE" == $("#recommPageName").attr("value")) this.getPDRecomTracking(a, c);
            else {
                if ($("span.pgdes").length > 0 && (h = $("span.pgdes")[0].getAttribute("value")), g.action = {
                        page: "SRP",
                        stage: "FINAL",
                        event: "SEARCH",
                        section: e
                    }, void 0 !== g.action.section && "" != g.action.section || (g.action.section = void 0, a && "search" != a && "recomm" != a && (g.action.section = a.toUpperCase())), f && $("#nudgeContainer").length > 0 && (g.custom_object = {
                        preSelectedNudges: findPreSelectedNudges()
                    }), g.action.referrer_section = referrerSections($("#search_location").val()), "undefined" == typeof _search_input) return;
                _search_input.media && (-1 === _search_input.media.indexOf("PHOTOS") && (_search_input.media = _search_input.media.replace("PHOTO", "PHOTOS")), -1 === _search_input.media.indexOf("VIDEOS") && (_search_input.media = _search_input.media.replace("VIDEO", "VIDEOS")));
                var i = {
                    amenities: qsSrp.stringToArray(_search_input.amenities ? _search_input.amenities + "," + _search_input.addamenities : _search_input.addamenities, !0) || [],
                    area_unit: _search_input.area_unit,
                    availability: qsSrp.stringToArray(_search_input.availability),
                    bedroom_num: qsSrp.stringToArray(_search_input.bedroom_num, !0),
                    building_id: qsSrp.stringToArray(_search_input.building_id, !0),
                    rera_status: qsSrp.stringToArray(_search_input.rera_status),
                    is_advertiser_rera_registered: "YES" == _search_input.is_poster_rera_registered ? "Y" : "",
                    sub_availability: qsSrp.stringToArray(_search_input.sub_availability, !0),
                    city: qsSrp.stringToArray(_search_input.city, !0),
                    furnish_type: qsSrp.stringToArray(_search_input.furnish, !0),
                    is_verified_selected: _search_input.verified,
                    locality: qsSrp.stringToArray(_search_input.locality_array, !0),
                    max_area: Number(_search_input.area_max),
                    max_floor_num: Number(_search_input.floor_max),
                    max_price: Number(_search_input.budget_max),
                    media_selected: qsSrp.stringToArray(_search_input.media),
                    min_area: Number(_search_input.area_min),
                    min_floor_num: Number(_search_input.floor_min),
                    min_price: Number(_search_input.budget_min),
                    posted_by: qsSrp.stringToArray(_search_input.class),
                    preference: qsSrp.stringToArray(_search_input.preference),
                    property_type: qsSrp.stringToArray(_search_input.property_type, !0),
                    res_com: qsSrp.stringToArray(_search_input.res_com),
                    transact_type: qsSrp.stringToArray(_search_input.transact_type, !0),
                    tenant_pref: qsSrp.stringToArray(_search_input.tenant_pref),
                    top_dealer: _search_input.topdealer || "",
                    sharing: qsSrp.intToStringArray(_search_input.sharing, !1),
                    capacity: qsSrp.intToStringArray(_search_input.capacity, !1),
                    attached_bathroom: _search_input.bathroomattached && _search_input.bathroomattached.value || "",
                    zero_brokerage: _search_input.brokerage && _search_input.brokerage.value || "",
                    sort_by: _search_input.sort_by,
                    page_size: 30
                };
                if (g.search = {
                        orig_filter: i || {},
                        result_count: parseInt($(".tpdlrd_h1 b")[0].innerHTML)
                    }, i && ("S" != i.preference || "C" == i.res_com)) try {
                    var j = $("#lf_prop_tab").text() && $("#lf_prop_tab").text().trim().split(" ")[0];
                    isNaN(j) ? g.search.result_count = 0 : g.search.result_count = parseInt(j)
                } catch (n) {
                    console.error("Caught", n)
                }
                if (g.payload = {
                        search_results: {
                            entity_tuples: "undefined" != typeof _prop_pos_array ? _prop_pos_array : [],
                            entity_type: "PROPERTY",

                            page: parseInt(h),
                            page_result_count: "undefined" != typeof _prop_pos_array ? Object.keys(_prop_pos_array).length : 0
                        }
                    }, c && (g.payload.search_results.selected_entity_tuples = [c], g.action.event = "CLICK"), d || clickStream.doClickStreamTracking(g, !0), $(".vspTuple").length && !c) {
                    for (var k = [], l = Object.keys(prop_ranks_2), m = 0; m < l.length; m++) k.push({
                        id: l[m],
                        rank: prop_ranks_2[l[m]],
                        attribute: ""
                    });
                    g.action.event = "SECTION_VIEW", g.action.section = "COLLABPROP", delete g.payload.search_results, g.payload.recommendation = {
                        recom_entity: k,
                        entity_type: "PROPERTY",
                        orig_entity_type: "PROPERTY",
                        res_com: _search_input.res_com,
                        recom_type: "VSP",
                        page: parseInt(h),
                        page_result_count: l.length
                    }, d && (g.action.event = "CLICK", g.payload.recommendation.selected_entity = [d]), clickStream.doClickStreamTracking(g, !0)
                }
                this.collectSpSearchData(a, b)
            }
        },
        collectSpSearchData: function(a, b) {
            var c = {};
            c.source = a, _dbsid && (c.search_id = _dbsid), _sid && (c.encrypted_data = _sid), c.front_search_type = void 0 !== tabMap[currentPageName] ? tabMap[currentPageName] : _pid;
            var d = "1";
            $("span.pgdes").length > 0 && (d = $("span.pgdes")[0].getAttribute("value")), c.pagenum = d;
            var e = this.readCookie();
            e.GOOGLE_SEARCH_ID && (c.visitor_id = e.GOOGLE_SEARCH_ID), e["99_ab"] && (c["99_ab"] = e["99_ab"]), _prop_pos && (c.prop_ranks = _prop_pos), "undefined" != typeof VSP_SRP_ranks && (c.prop_ranks_2 = VSP_SRP_ranks), e.PROP_SOURCE && (c.search_source = e.PROP_SOURCE), c.search_url = window.location.pathname;
            for (var f, g = /\+/g, h = /([^&=]+)=?([^&]*)/g, i = function(a) {
                    return decodeURIComponent(a.replace(g, " "))
                }, j = window.location.search.substring(1); f = h.exec(j);) c[i(f[1])] = i(f[2]);
            c.device = "desktop", "undefined" == typeof _searchPersonalisationData || $.isEmptyObject(_searchPersonalisationData) || (c.searchPersonalisationData = _searchPersonalisationData), c["user-agent"] = navigator.userAgent, "undefined" != typeof srpTrackRequestID && void 0 != srpTrackRequestID && (c["X-REQUEST-ID"] = srpTrackRequestID), void 0 !== b && (c.deselectedLocality = left_filters.deselectedLocality, c.suggestedLocality = left_filters.suggestedLocality, c.filterSource = "searchNudgesSimilarLocalities"), $("#lf_propCount").length && (c.propertyResultCount = parseInt(document.getElementById("lf_propCount").value)), "undefined" == typeof srp_click_tracking_url || empty(srp_click_tracking_url) || "QS" != currentPageName || this.sendSearchData(srp_click_tracking_url, "?paramjson=" + encodeURIComponent(JSON.stringify(c)))
        },
        initializeTabMap: function() {
            "undefined" != typeof currentPageName && (isset(tabMap[currentPageName]) || "undefined" == typeof _pid || (tabMap[currentPageName] = _pid))
        },
        removeHomeTransactType: function() {
            $("#srch_transact_type").remove()
        },
        toggleDealsForm: function(a) {
            a ? ($("#tabSrchIpBtn").css("display", "none"), $("#search-filter").hasClass("slideOpen") && ($("#search-filter").removeClass("slideOpen").addClass("slideClose").attr("data-toshow", "1"), $("#srpSearchHeader #search-filter").css({
                height: "0",
                padding: "0"
            })), $("#dealstabSrchIpBtn").css("display", "inline-block"), $("#srpSearchHeader #search-filter").length > 0 && $("#coverbgLyr").hide()) : ($("#tabSrchIpBtn").css("display", "inline-block"), $("#search-filter").hasClass("slideClose") && 1 == $("#search-filter").attr("data-toshow") && ($("#srpSearchHeader #search-filter").css({
                height: "auto",
                padding: "10px 10px 12px"
            }), $("#search-filter").removeClass("slideClose").addClass("slideOpen").attr("data-toshow", "0")), $("#dealstabSrchIpBtn").css("display", "none"), $("#srpSearchHeader #search-filter").length > 0 && $("#coverbgLyr").show())
        },
        homePageTabClick: function() {
            var a, b, c, d = $(this),
                e = d.attr("id"),
                f = qsSrp.getRC(),
                g = {};
            return g = {
                R: ["ResBuyTab", "ResRentTab", "NpTab", "DealerTab"],
                C: ["NpTab", "ComTab", "DealerTab"]
            }, !1 === arr.in_array(g[f], e) ? (window.location.href = d.attr("href"), !0) : !d.hasClass("sel") && (Homepage.TabSelectorHp(e), $(".custErr").remove(), a = qsSrp.getCity(), qsSrp.resetFrm(), qsSrp.removeHomeTransactType(), qsSrp.toggleDealsForm(!1), qsSrp.setKeyword(""), qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), "Budget", !0), empty(e) || (callBackFunc = $("#" + e).attr("callback")), c = callBackFunc.split("."), window[c[0]][c[1]](), "NpTab" != e && _99ab.execFunc(qsSrp.fillPTAB, qsSrp.fillPT, qsSrp, []), qsSrp.handleFlds(["area", "bedroom", "budget", "np_search_type", "availability", "class", "preference"]), qsSrp.fillFrmElsePT(), Suggester99 && (Suggester99.resetSelf(), Suggester99.initializeAutoSuggestorInstance(), qsSrp.resetDYM(), qsSrp.resetCity()), b = qsSrp.getCity(), "" != qsSrp.selCity && ls.showLocalityInAlert(qsSrp.selCity, "keyword", "Y"), empty(b) || !empty(a) && b == a || qsSrp.execLocality(), "DealerTab" == e ? ($("#suggesterCtx").removeClass("suggestWrapWide suggestWrapCom").addClass("suggestWrap"), $("#Header-Wrap").removeClass("osrch comsrch").addClass("dlrsrch")) : "ComTab" == e ? ($("#suggesterCtx").removeClass("suggestWrapWide suggestWrap suggestWrapDeal").addClass("suggestWrapCom"), $("#Header-Wrap").removeClass("osrch dlrsrch").addClass("comsrch")) : ($("#suggesterCtx").removeClass("suggestWrap suggestWrapCom suggestWrapDeal").addClass("suggestWrapWide"), $("#Header-Wrap").removeClass("comsrch dlrsrch").addClass("osrch"), /iPhone|iPad|iPod/i.test(navigator.userAgent) || ($("#tabSrchIpBtn button.green").show(), $('#tabSrchIpBtn input[type="submit"].blue').removeClass("dealermrgn"))), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []), !1)
        },
        getCityId: function(a) {
            var b, c = $("#srchhdr_srchFormData").length ? JSON.parse($("#srchhdr_srchFormData").val()) : "";
            return b = "" != c && "" != a && void 0 !== c[a] ? c[a] : "", void 0 === b || void 0 === b.city || empty(b.city) ? "" : "object" == typeof b.city ? b.city[0] : b.city
        },
        getBudgetAbsolute: function(a, b) {
            var c = this.getBudgetInWords(a, b);
            return "undefined " == typeof c || empty(c) ? "0" : this.getBudgetInNumber(c, a)
        },
        getBudgetInWords: function(a, b) {
            return "undefined " == typeof a || empty(a) || void 0 === b || empty(b) ? "" : $("[name='" + a + "'][val='" + b + "']").html()
        },
        getBudgetInNumber: function(a, b) {
            var c = "",
                d = void 0 === a || empty(a) ? "" : a.split(" ");
            if ("" != d) switch (d[1]) {
                case "Crores":
                case "Crore":
                    -1 == d[0].indexOf("+") && -1 == d[0].indexOf(".") ? c = d[0] + "0000000" : -1 != d[0].indexOf("+") ? c = 1e9 : -1 != d[0].indexOf(".") && (c = 15e6);
                    break;
                case "Lacs":
                    c = d[0] + "00000";
                    break;
                default:
                    "Min" == a ? c = "" : "Below 5 Lacs" == a && "budget_min" == b ? c = 0 : "Below 5 Lacs" == a && "budget_max" == b ? c = 5e5 : "On Request" == a && "budget_min" == b && (c = 0)
            }
            return c
        }
    },
    ptDrpDwn = {
        initiated: !1,
        initialize: function() {
            var a = this;
            a.initiated || (a.initiated = !0, a.addEventsToDrpDowns())
        },
        addEventsToDrpDowns: function() {
            $("._init_parent a.dropDown").live("click", function(a) {
                var b, c, d, e, f, g, h = $(this),
                    i = h.attr("scrollel");
                if (h.hasClass("ddDisable")) return !0;
                try {
                    isset(i) && $("html,body").animate({
                        scrollTop: $("#" + i).offset().top - 15
                    }, 500)
                } catch (j) {}
                g = h.parent(), b = h.attr("htmlgrp"), $(".sWrpEl").css("z-index", 1), g.css("z-index", 10001), isset(b) && $("[htmlgrp='" + b + "']").parent().css("z-index", 10001), a.stopPropagation(), f = h.next(), "budget_wrap" == g.parent().attr("id") || (isErr = f.hasClass("custErr"), isErr && (f.hide(), f = f.next())), h.removeClass("valerr"), d = $("div.ddlst").not(f), e = void 0 == b ? d : d.not("[htmlgrp='" + b + "']"), e.hide(), c = f.toggle().find(".scrollbar1"), c.length && c.tinyscrollbar_update()
            })
        }
    };
$(document).ready(function() {
    function a() {
        c = setInterval(function() {
            b()
        }, 500)
    }

    function b() {
        $("#pb_iframe7").ready(function() {
            var a, b = $("#rcol").height() + $("#sticky").height(),
                d = $("#results").height(),
                e = $("#pb_iframe7").height();
            e > d && (a = $("#fFooter").length > 0 ? $("#fFooter") : $("#pdStickyHandler"), a.css("margin-top", b - d + "px"), clearInterval(c))
        })
    }
    if (/iPhone|iPad|iPod/i.test(navigator.userAgent) && $(".headerFloatRight ._showTip").removeClass("_showTip"), showHideAboutCityContent(), 1 == $("#is_home").val() && $.isFunction(qsSrp.homeSrchBarLoad) ? qsSrp.homeSrchBarLoad() : qsSrp.SrpSrchBarLoad(), $("._get_alert_ajax").length > 0 && mma.loadMMAView(mma_pageid, "S", mma_trckSrc, mma_search_id, mma_encrypt_input, "SEARCH", mma_input_array, "#get_alert"), $(".FI-Box").click(function(a) {
            a.stopPropagation()
        }), $(window).resize(function() {
            searchBarFix()
        }), qsSrp.setPreviousCity($("#city").val()), qsSrp.setPreviousKeyword($("#keyword").val()), $(document).on("click", "#sdym", function() {
            $("#city").val($(this).data("city"));
            var a = $(this).closest("form");
            $("#submit_query", a).trigger("click")
        }), "undefined" == typeof currentPageName || "DEALERSEARCH" != currentPageName && "NPSEARCH" != currentPageName && "QS" != currentPageName || 0 != $("#map-canvas").length || ($(window).on("beforeunload", function() {
            removeSticky("", "0")
        }), $(window).on("load", function() {
            removeSticky("", "0")
        })), $("#back_to_top")[0] && $(".scrollup").live("click", function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 600), !1
        }), $(".back-top-Wrap").removeClass("hide"), $(window).scroll(function() {
            var a, b, c, d, e, f = ["#pdGalleryWidget", "#mapWidgetPD"],
                g = ["#feedbackButton", ".back-top-Wrap"];
            for (var c in g)
                if (d = g[c], showEl = "#feedbackButton" == d || $(this).scrollTop() > 100, e = $(d), e.length) {
                    elTop = e.offset().top, elBottom = elTop + e.height();
                    for (var h in f)
                        if (a = $(f[h]), a.length && (b = a.offset().top, sectionElBottom = b + a.height(), elTop > b && elTop < sectionElBottom || elBottom > b && elBottom < sectionElBottom)) {
                            showEl = !1;
                            break
                        }
                    "#feedbackButton" == d ? e.css("right", showEl ? "0" : "-30px") : ".back-top-Wrap" == d && (showEl ? e.css("opacity", 1) : e.css("opacity", 0))
                }
        }), "undefined" != typeof zeroprop && "true" == zeroprop) {
        setTimeout(function() {
            a()
        }, 2e3);
        var c
    }
    "Type Location or Project/Society or Keyword" == $("#keyword").val() && $("#keyword").val(""), $("#srpSearchHeader #search-filter").css({
        height: "0",
        padding: "0"
    }), "undefined" != typeof currentPageName && "NPSEARCH" === currentPageName && srpTracking.collectSearchData("npsearch"), qsSrp.initializeTabMap(), qsSrp.setVirtualCities($("#srchhdr_virtualCities").val()), qsSrp.setVirtualCityMapping($("#srchhdr_virtualCityMappings").val()), qsSrp.setCitiesWithSecondaryParents($("#srchhdr_citiesWithSecondaryParents").val()), $("#homeLoan").off("mouseover")
}), $(document).click(function(a) {
    stkyKey = !1, $("#cl_area #sft").length > 0 && $("#cl_area #sft").hide(), 0 == $(a.target).parents().hasClass("ddlstSrp") && 0 == $(a.target).parents().hasClass("_country") && "lead_search" != $(a.target).parents().closest("form").attr("id") && 0 == $(a.target).parents("#mma_budget_wrap").length && qsSrp.closeDrpDownsSpl(), 0 == $(a.target).parents().hasClass("ddlst") && qsSrp.closeDrpDowns(), $("#map-canvas").length > 0 && 1 == $(a.target).parents().hasClass("maplistcontainer") && toggleClusterView(a, "close"), $("#sort_lyr").length > 0 && "block" == $("#sort_lyr").css("display") && "price" != a.target.id && "ratesqft" != a.target.id && $("#sort_lyr").hide(), "block" == $(".LyrIcon").css("display") && $(".LyrIcon").hide();
    var b = a.target;
    $(b).closest("#search-bar-hp").length <= 0 && "search-filter" != b.id && 1 == $("#is_home").val() && $("#search-filter").removeClass("slideOpen").addClass("slideClose")
}).keydown(function(a) {
    27 === a.keyCode && (closeAllLayersOnHtmlClk(a), qsSrp.closeDrpDownsSpl(), qsSrp.closeDrpDowns(), $("#cl_area #sft").length > 0 && $("#cl_area #sft").hide(), $(".lyrUIw").length > 0 && $("#sort_lyr").remove(), $("#sort_lyr").length > 0 && "price" != a.target.id && "ratesqft" != a.target.id && $("#sort_lyr").hide()), 36 == a.keyCode || 35 === a.keyCode ? ("undefined" == typeof currentPageName || "DEALERSEARCH" != currentPageName && "NPSEARCH" != currentPageName && "QS" != currentPageName || 0 != $("#map-canvas").length || removeSticky("", "0"), stkyKey = !0) : stkyKey = !1, 33 == a.keyCode && (stkyPD = !0)
}).on("DOMMouseScroll mousewheel wheel", function(a) {
    stkyKey = !1
});
var srchFormData = {
        data: [],
        setData: function(a) {
            qsSrp.resetPT(), empty(a) || (this.data = a)
        },
        getData: function() {
            return this.data
        },
        getSrchTypeData: function(a) {
            return empty(this.data[a]) ? null : this.data[a]
        },
        setSrchTypeData: function(a, b) {
            empty(b) || (this.data[a] = b)
        }
    },
    qsDrpDwn = {
        initiated: !1,
        initialize: function() {
            var a = this;
            a.initiated || (a.initiated = !0, a.addEventsToDrpDowns(), a.addCityDropDownEvents(), a.addCountryCodeDropDownEvents())
        },
        addEventsToDrpDowns: function() {
            $("._init_parent a.dropDown").live("click", function(a) {
                var b, c, d, e, f, g, h = $(this),
                    i = h.attr("scrollel");
                if (h.hasClass("ddDisable")) return !0;
                try {
                    isset(i) && $("html,body").animate({
                        scrollTop: $("#" + i).offset().top - 15
                    }, 500)
                } catch (j) {}
                g = h.parent(), b = h.attr("htmlgrp"), $(".sWrpEl").css("z-index", 1), g.css("z-index", 10001), isset(b) && $("[htmlgrp='" + b + "']").parent().css("z-index", 10001), a.stopPropagation(), f = h.next(), "budget_wrap" == g.parent().attr("id") || (isErr = f.hasClass("custErr"), isErr && (f.hide(), f = f.next())), h.removeClass("valerr"), d = $("div.ddlst").not(f), e = void 0 == b ? d : d.not("[htmlgrp='" + b + "']"), e.hide(), c = f.toggle().find(".scrollbar1"), c.length && c.tinyscrollbar_update(), qsSrp.hideCitySuggestor(g), g.find(".inSuggest:first").focus(), frmUtil.refreshTabIndex(qsSrp.frm_id), "undefined" != typeof autoSuggestorInstance && autoSuggestorInstance.hideSuggestionContainer()
            }), $("i.sugestCross").click(function() {
                var a = $(this),
                    b = a.prev("input.inSuggest");
                qsSrp.setInputEmpty(b), b.autocomplete("search", "")
            }), $(".qSrch label.selectDrpDwnElement").live("click", function() {
                qsDrpDwn.onSelectUpdate($(this))
            })
        },
        addCityDropDownEvents: function() {
            $(".s_city ul li label").live("click", function() {
                qsSrp.updateCity($(this)), qsSrp.execLocality();
                var a = document.getElementById("keyword"),
                    b = a ? $.trim(a.value) : "";
                0 == supports_input_placeholder() && ("null" == b && (a.value = qsSrp.keywordText, b = qsSrp.keywordText), a && ("" == b || b == qsSrp.keywordText ? a.style.color = "#aaa" : a.style.color = "#000")), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "CITY")
            }), $(".s_np_city ul li label").live("click", function() {
                qsSrp.updateNPCity($(this)), qsSrp.execLocality();
                var a = document.getElementById("keyword"),
                    b = a ? $.trim(a.value) : "";
                0 == supports_input_placeholder() && ("null" == b && (a.value = qsSrp.keywordText, b = qsSrp.keywordText), "" == b || b == qsSrp.keywordText ? a.style.color = "#aaa" : a.style.color = "#000"), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "NP_CITY")
            }), $(".city_ac, .np_city_ac").live("keypress", function(a) {
                if (13 == (a.keyCode ? a.keyCode : a.which)) return !1
            })
        },
        addCountryCodeDropDownEvents: function() {
            $("#phoneNumberSelect ul li").click(function() {
                qsDrpDwn.updateSelect($(this)), qsDrpDwn.toggleCountryCode(this)
            })
        },
        updateSelect: function(a) {
            a.length > 0 && ($(a).closest(".phoneNumberSelect").siblings().filter(":input").val(a.attr("val")), qsSrp.setText($(a).closest(".phoneNumberSelect").siblings("a").children("span"), a.text()), $(a).closest(".phoneNumberSelect").hide())
        },
        toggleCountryCode: function(a) {
            for (var b = $(a).html(), c = 1; c < 6; c++) $("#cc" + c).html(b)
        },
        onSelectUpdate: function(a) {
            a.length > 0 && ($(a).closest(".ddlst").siblings().filter(":input").val(a.attr("val")), qsSrp.setText($(a).closest(".ddlst").siblings("a").children("span"), a.text()), $(a).closest(".ddlst").hide())
        }
    },
    Header = {
        srchBarLoad: function() {
            $("#lvl5_form #submit_query,#res_form #submit_query,#res_form #map_submit_query").on("click", function(a) {
                Header.TrimPT();
                var b = qsSrp.mainSrchLoadFunc(this, a);
                if (0 == b) {
                    if (0 == $("#lead_search").length) return trackEventByGA("TRIGGER", !1, "Enter", "Search_Box"), !1;
                    buyerSearchLoaderHandler.unloadTupleLoader(), $("#saveSearchFlag").val(0)
                }
                return 1 != $("#saveSearchFlag").val() && $("#sfd_save_search_flag").val("0"), $("#saveSearchFlag").val(0), trackEventByGA("TRIGGER", !1, "Enter", "Search_Box"), qsSrp.closeDrpDownsSpl(), b
            }), void 0 !== $("#keyword")[0] && ($("#keyword")[0].oninput = function() {
                $("#keyword").keyup()
            }), $("#lvl5_form, #res_form").keydown(function(a) {
                if (13 === a.which && !submitFlag) return !1;
                13 === a.which && void 0 !== submitButton ? submitButton.enterKeyPressedFlag = !0 : void 0 !== submitButton && (submitButton.enterKeyPressedFlag = !1)
            }), $("#clrAl").click(function() {
                qsSrp.resetFrm(), qsSrp.resetPT(), "C" == qsSrp.getRC() ? $(".DCcomOpen").show() : $(".DCresOpen").show(), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"]), Suggester99 && (Suggester99.resetSelf(), Suggester99.initializeAutoSuggestorInstance(), qsSrp.resetDYM(), qsSrp.resetCity()), qsSrp.handleBudget(), $("#s_buy_budget_max,#s_rent_budget_max,#s_buy_budget_min,#s_rent_budget_min,#deals_city").tinyscrollbar();
                qsSrp.getPref();
                qsSrp.clear_form = !0
            }), $("#keyword").keyup(function(a) {
                autoSuggest()
            }), $("#s_bedroom_num .ddlist a").click(function(a) {
                var b, c, d, e, f, g, h;
                f = $(this), b = $("#bedroom_num").val(), c = f.attr("val"), 0 == c ? (b = "", f.siblings().children("i").removeClass("checked").addClass("unchecked"), $("#bedroom_num").val("")) : (b = Header.toggleChkAndReturnValue(f, b, c, ","), $("#bedroom_num").val(b.join(","))), d = b.length, "1" == d || "2" == d ? (h = $.inArray("10", b), b[h] = "9+", e = b + " BHK") : e = "0" == d ? "Any" : b[0] + "," + b[1] + " BHK+", g = qsSrp.getDefLbl("bedroom") == e, qsSrp.setText($("#bedroom_num_wrap a.ddLClick div"), e, g), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "BEDROOM"), jsevt.stopBubble(a), a.stopPropagation()
            }), $("#s_class .ddlist a").click(function(a) {
                var b, c, d, e, f, g;
                d = $(this), f = $("#class").val(), g = d.attr("value"), f = Header.toggleChkAndReturnValue(d, f, g, ","), b = f.length, $("#class").val(f.join(",")), c = "1" == b ? $('#s_class .ddlist a[value="' + f[0] + '"]').text() : "2" == b ? "2 selected" : "All", e = qsSrp.getDefLbl("class") == c, qsSrp.setText($("#posted_by_wrap a.ddLClick div"), c, e)
            }), $("#buy_op input:radio").click(function() {}), $("#search-bar-Bg a.dropDown, #srpSearchHeader a.dropDown,#tab-txt").click(function(a) {
                closeAllLayersOnHtmlClk(a), $("#HM-Menu").css({
                    right: "-220px"
                }), Homepage.hideCityErr();
                qsSrp.getRC();
                $(".FI-Box").css("z-index", "0");
                var b, c, d, e, f, g = $(this),
                    h = 0;
                if (g.hasClass("ddDisable")) return !0;
                if (e = g.parent(), g.attr("htmlgrp"), $(".filter-item").css("z-index", 0), d = g.next(), "budget_wrap" == e.parent().attr("id") || (isErr = d.hasClass("custErr"), isErr && (d.hide(), d = d.next())), g.removeClass("valerr"), b = d.attr("id"), qsSrp.closeDrpDownsSpl(b), e.css("z-index", "2"), "s_property_type" == b) $(".propTypvariant").each(function() {
                    var a = $(this);
                    "true" == a.attr("active") && toggleSpl(a).find(".scrollbar96"), a.hasClass("scrollbar96") && a.tinyscrollbar_update()
                }), Header.makeScrollDynamic();
                else if (c = toggleSpl($("#" + b)).find(".scrollbar96"), c.length > 0)
                    for (h = 0; h < c.length; h++) f = c[h], $(f).tinyscrollbar_update();
                qsSrp.hideCitySuggestor(e), e.find(".inSuggest:first").focus(), frmUtil.refreshTabIndex(qsSrp.frm_id), Suggester99 && Suggester99.isAutoSuggesterSet() && Suggester99.getAutoSuggesterInstance().hideSuggestionContainer(!0), document.documentElement.scrollTop >= 0 && document.documentElement.scrollTop < $(".banner-container").height() && scrollToElement("#Header-Wrap"), a.stopPropagation()
            }), $("#s_area_unit a").click(function() {
                var a = $(this);
                $("#area_unit").val(a.attr("val")), qsSrp.setText($("#area_unit_wrap a.dropDown div"), a.text()), $("#s_area_unit").hide(), qsSrp.fillAreaLbl(), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "AREA")
            }), $("#s_available_for .ddlist a").click(function() {
                var a = [],
                    b = $(this),
                    c = $("#available_for").val(),
                    d = b.attr("val");
                c = Header.toggleChkAndReturnValue(b, c, d, ",");
                for (var e in c) console.log(c), a.push($('#s_available_for .ddlist a[val="' + c[e] + '"]').text());
                var f = a.join();
                f || (f = "Available for"), qsSrp.setText($("#available_for_wrap a.ddLClick div"), f), qsSrp.updateAvailableFor(c.join())
            }), $("#s_sharing .ddlist a").click(function() {
                var a = [],
                    b = !1;
                t = $(this), curVal = $("#sharing").val(), val = t.attr("val"), curVal = Header.toggleChkAndReturnValue(t, curVal, val, ",");
                for (var c in curVal) a.push($('#s_sharing .ddlist a[val="' + curVal[c] + '"]').text());
                var d = a.join();
                if (!d) {
                    d = "Sharing";
                    var b = !0
                }
                qsSrp.updateSharing(curVal.join()), qsSrp.setText($("#sharing_wrap a.ddLClick div"), d), b && $("#sharingLabel").append('<div style="position: absolute; color: #56AC6D; top: 1px; font-size: 10px; right: 18px; padding: 0px 5px; ">NEW</div>')
            }), $("#s_buy_budget_max .ddlist a").click(function(a) {
                $("#buy_budget_max_wrap").hasClass("ddDisable") || (qsSrp.updateBudget($(this), "buy", "max"), Header.updateOtherPriceDD($(this), "buy", "max"), qsSrp.validateMinMax(), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "BUY_MAX_BUDGET")), a.stopPropagation()
            }), $("#deals_city .ddlist a").click(function(a) {
                var b = $(this),
                    c = "" + (0 != b.attr("val") ? "/city/" + b.text() : "");
                qsSrp.setText($("#deals_city_wrap .FI-Tag div"), b.text()), $("#deals_city").hide(), $("#deals_submit_query").attr("href", c), a.stopPropagation()
            }), $("#deals_submit_query").click(function(a) {
                trackEventByGA("SrchTrk", "HP_DEALS_SEARCH", "1")
            }), $("#s_buy_budget_min .ddlist a").click(function(a) {
                $("#buy_budget_min_wrap").hasClass("ddDisable") || (qsSrp.updateBudget($(this), "buy", "min"), Header.updateOtherPriceDD($(this), "buy", "min"), qsSrp.validateMinMax(), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "BUY_MIN_BUDGET")), a.stopPropagation()
            }), $("#s_rent_budget_max .ddlist a").click(function() {
                $("#rent_budget_max_wrap").hasClass("ddDisable") || (qsSrp.updateBudget($(this), "rent", "max"), Header.updateOtherPriceDD($(this), "rent", "max"), qsSrp.validateMinMax(), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "RENT_MAX_BUDGET")), event.stopPropagation()
            }), $("#s_rent_budget_min .ddlist a").click(function(a) {
                $("#rent_budget_min_wrap").hasClass("ddDisable") || (qsSrp.updateBudget($(this), "rent", "min"), Header.updateOtherPriceDD($(this), "rent", "min"), qsSrp.validateMinMax(), $("#map-canvas").length > 0 && trackEventByGA(msrch.getEvtAcn(), "CLICK_HEADER", "RENT_MIN_BUDGET")), a.stopPropagation()
            }), $("#s_avail .ddlist a ").click(function() {
                var a, b = Header.setRadioBehaviour($(this));
                $("#availability").val(b), a = "" == b ? qsSrp.getDefLbl("availability") : $(this).text(), qsSrp.setText($("#avail_wrap a.dropDown div"), a)
            }), $("#rent_op a ,#opt_pref .ddlist a").click(function() {
                prevPref = qsSrp.getPref();
                var a = $(this);
                if (!a.children().hasClass("radio-Yes")) {
                    var b = Header.setRadioBehaviour($(this));
                    qsSrp.setPref(b), qsSrp.handleFlds(["bedroom", "available_for", "sharing", "class"]), a.hasClass("DCprefopt") && qsSrp.setText($("#opt_pref a.dropDown div"), a.text());
                    var c, d;
                    c = "S" == prevPref ? "price" : "rent", d = "S" == b ? "price" : "rent", c != d && qsSrp.setText($("#budget_sub_wrap>.FI-Tag>div"), "Budget", !0), qsSrp.handleFlds(["budget"]), ("S" != prevPref || "R" != b && "P" != b && "L" != b) && ("R" != prevPref && "P" != prevPref && "L" != prevPref || "S" != b) || qsSrp.resetBudget()
                }
            }), $(".DCheadingOpt").click(_99ab.bindFunc(function(a) {
                if (qsSrp.data.res_com = $(this).attr("val"), -1 == $(this).attr("href").search("tab=")) {
                    var b, c = $(".search-tabs a.sel").attr("id");
                    switch (c) {
                        case "ResBuyTab":
                            b = "Buy";
                            break;
                        case "ResRentTab":
                            b = "Rent/PG";
                            break;
                        case "NpTab":
                            b = "NP";
                            break;
                        case "DealerTab":
                            b = "Dealer"
                    }
                    $(this).prop("href", $(this).attr("href") + "?&tab=" + b)
                } else $(this).prop("href", $(this).attr("href"));
                return !0
            }, function(a) {
                a.stopPropagation();
                var b = $(this),
                    c = b && ("DCnpOpen" === b.attr("opencls") || b.hasClass("DCnpOpen") ? "PROJECT" : "PROPERTY");
                "inactive" == b.attr("activetab") ? (target = $('#s_property_type a.DCheadingOpt[activetab="active"]'), target.children("i").removeClass("checked p-of-checked").addClass("unchecked"), _99ab.execFunc(Header.activateCategoryAB, Header.activateCategory, Header, [b]), checked = $(this).children("i").hasClass("p-of-checked"), val = _99ab.execFunc(Header.openChildOptionsAB, Header.openChildOptions, Header, [$(this), a, checked]), finalVal = empty(checked) ? val : "", empty(finalVal) ? qsSrp.setPT("") : qsSrp.setPT(finalVal.join(":")), Header.UpdateResCom(b), Header.makeScrollDynamic()) : Header.performNormalHeadingClick(b), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"]), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []), Header.updatePrefSplCases(), qsSrp.handleFlds(["area", "bedroom", "preference", "availability", "np_search_type", "class", "sharing", "available_for"]), isMapSrch() && msrch.overRideSearchType(c), $("#s_property_type").removeClass("flipClose").addClass("flipOpen")
            })), $(".DCpropTypOpt").click(function(a) {
                a.stopPropagation();
                var b, c, d;
                b = $(this), c = $("#property_type").val(), d = b.attr("val"), curValUpdated = Header.toggleChkAndReturnValue(b, c, d, ":"), qsSrp.setPT(curValUpdated.join(":")), $("#s_property_type").attr("active", !0), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"]), Header.updatePrefSplCases(), qsSrp.handleFlds(["area", "bedroom"])
            }), $("#area_min, #area_max, #keyword").click(function() {
                $(this).removeClass("valerr").next(".custErr").hide()
            }), $("#area_min, #area_max").keyup(function(a) {
                var b = $(this);

                check.srchArea(b.val(), b.get(0), a)
            }), $("#area_min, #area_max").blur(function(a) {
                var b = $(this);
                check.srchArea(b.val(), b.get(0), a), qsSrp.fillAreaLbl()
            }), $(".ddlist a").click(function(a) {
                var b, c, d, e = [],
                    f = $(this),
                    g = f.parent(),
                    h = f.attr("id"),
                    i = g.attr("id");
                empty(h) || (e = h.split("_")), empty(i) || (Chk2 = i.split("_"), Chk2[1].search("price") > 0 && (b = 1));
                g.closest("#s_proptype");
                g.closest("#s_area_unit").length > 0 && (d = 1, $("#s_area_unit").removeClass("flipOpen").addClass("flipClose")), ("bd" != e[0] && "p" != e[0] && "srpPriceMinBuy" != g.attr("id") && "srpPriceMinRent" != g.attr("id") && ["s_sharing", "s_available_for", "s_np_search_type", "s_np_search_type_com", "s_np_search_type_res"].indexOf(g.parent().attr("id")) < 0 || "buy_minprice" == f.parent().attr("id")) && 1 != b && 1 != c && 1 != d && qsSrp.closeDrpDownsSpl()
            }), $("#np_op a.prnt").click(_99ab.bindFunc(function(a) {
                if (qsSrp.data.res_com = "23" == $(this).attr("val") ? "R" : "C", -1 == $(this).attr("href").search("tab=")) {
                    var b, c = $(".search-tabs a.sel").attr("id");
                    switch (c) {
                        case "ResBuyTab":
                            b = "Buy";
                            break;
                        case "ResRentTab":
                            b = "Rent/PG";
                            break;
                        case "NpTab":
                            b = "NP";
                            break;
                        case "DealerTab":
                            b = "Dealer"
                    }
                    $(this).prop("href", $(this).attr("href") + "?&tab=" + b)
                } else $(this).prop("href", $(this).attr("href"));
                return !0
            }, function(a) {
                _99ab.execFunc(Header.npclickAB, Header.npclick, Header, [$(this)]), Header.npSuggester(), a.stopPropagation(), jsevt.stopBubble(a), $(".npOpts").hide(), $(this).next(".npOpts").show(), $(".npOpts a i").removeClass("checked").addClass("unchecked"), $("#np_search_type").val(""), Header.selectDefaultNpPtTypes(), $("#np_op").removeClass("flipClose").addClass("flipOpen")
            })), $("#tab-items .ddlist>a").click(function() {
                var a, b, c, d, e, f;
                a = $(this), f = a.text(), b = a.attr("id"), $(".custErr").remove(), c = qsSrp.getCity(), qsSrp.setKeyword(""), qsSrp.setText($("#tab-txt span"), f), qsSrp.resetFrm(), Suggester99 && (Suggester99.resetSelf(), Suggester99.initializeAutoSuggestorInstance(), qsSrp.resetDYM(), qsSrp.resetCity()), empty(b) || (callBackFunc = $("#" + b).attr("callback")), e = callBackFunc.split("."), window[e[0]][e[1]](), d = qsSrp.getCity(), "" != qsSrp.selCity && ls.showLocalityInAlert(qsSrp.selCity, "keyword", "Y"), empty(d) || !empty(c) && d == c || qsSrp.execLocality(), "dlr-tab" == b ? ($("#suggesterCtx").removeClass("suggestWrapWide suggestWrapCom").addClass("suggestWrap"), $("#Header-Wrap").removeClass("osrch comsrch").addClass("dlrsrch")) : "com-tab" == b ? ($("#suggesterCtx").removeClass("suggestWrapWide suggestWrap suggestWrapDeal").addClass("suggestWrapCom"), $("#Header-Wrap").removeClass("osrch dlrsrch").addClass("comsrch")) : ($("#suggesterCtx").removeClass("suggestWrap suggestWrapCom suggestWrapDeal").addClass("suggestWrapWide"), $("#Header-Wrap").removeClass("dlrsrch comsrch").addClass("osrch")), "proj-tab" != b && 0 == qsSrp.clear_form && _99ab.execFunc(qsSrp.fillPTAB, qsSrp.fillPT, qsSrp, []), qsSrp.handleFlds(["area", "bedroom", "budget", "np_search_type", "availability", "class", "preference"]), 0 == qsSrp.clear_form && qsSrp.fillFrmElsePT(), searchBarFix()
            }), $("#search-bar-hp .search-tabs>a").click(qsSrp.homePageTabClick), $("#s_np_search_type .ddlist a").click(function() {
                var a, b, c, d, e, f;
                c = $(this), e = $("#np_search_type").val(), f = c.attr("val"), e = Header.toggleChkAndReturnValue(c, e, f, ","), a = e.length, $("#np_search_type").val(e.join(",")), b = "1" == a ? $('#s_np_search_type .ddlist a[val="' + e[0] + '"]').text() : "2" == a ? "2 selected" : "All", d = qsSrp.getDefLbl("np_search_type") == b, qsSrp.setText($("#np_search_type_wrap a.ddLClick div"), b, d)
            }), $("#s_np_search_type_res a,#s_np_search_type_com a,#s_np_search_type_res div,#s_np_search_type_com div").click(function() {
                var a, b, c = $(this),
                    d = $("#np_search_type").val(),
                    e = c.attr("val"),
                    f = c.parent();
                d = Header.toggleChkAndReturnValue(c, d, e, ","), a = parseInt(d.length), $("#np_search_type").val(d.join(",")), b = 1 == a ? f.find("a").filter('a[val="' + d[0] + '"]').text() : 2 == a ? "2 selected" : "Construction Status", qsSrp.setText($(".pList-wrap a.ddLClick div"), b, !1), qsSrp.setText($("#proptypeLabelFilter"), b, !1), isMapSrch() && (qsSrp.data.np_search_type = d.join(","))
            }), $(".DCprefopt").click(function() {
                Header.selectOptionRadio($(this).attr("val"), "DCprefopt")
            }), $(".DCpropTypradio").click(function() {
                var a, b = $(this);
                a = b.attr("val"), rc = 26 == a ? "C" : "R", Header.selectOptionNpPt(a, "DCpropTypradio"), qsSrp.setPT(a), qsSrp.setRC(rc), qsSrp.setText($("#pType-dd div"), b.text(), !1), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []), qsSrp.handleFlds(["area", "bedroom"])
            }), $("#keyword").focus(function(a) {
                $("#search-filter").hasClass("slideClose") && ($("#srpSearchHeader #search-filter").css({
                    height: "auto",
                    padding: "10px 10px 12px"
                }), $("#search-filter").removeClass("slideClose").addClass("slideOpen"), $("#srpSearchHeader #search-filter").length > 0 && $("#coverbgLyr").show())
            }), $("i.sugestCross").click(function() {
                var a = $(this),
                    b = a.prev("input.inSuggest");
                qsSrp.setInputEmpty(b), b.autocomplete("search", "")
            }), $(window).unload(function() {
                $("#submit_query").prop("disabled", !1)
            }), $(".searchDummy").click(function() {
                $("#srpSearchHeader").removeClass("flipClose").addClass("flipOpen")
            }), qsSrp.initFrm(), qsSrp.setUpFrm(qsSrp.frm_id), "lvl5_form" != qsSrp.frm_id ? (qsSrp.showCurTb(), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"]), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, []), qsSrp.fillClass()) : (qsSrp.showSrchCurTb(), qsSrp.fillAvail()), qsSrp.fillAvailableFor(), jsval.fixPlaceHolder($("#" + qsSrp.frm_id)), qsSrp.validateMinMax(), frmUtil.blockkStickySubmit(), qsSrp.removeFpCheck(), _99ab.execFunc(Header.updateHeadSelectionAB, Header.updateHeadSelection, Header, [])
        },
        toggleChkBox: function(a) {
            var b, c = a.children("i");
            return b = c.hasClass("unchecked"), empty(b) ? c.removeClass("checked").addClass("unchecked") : c.removeClass("unchecked").addClass("checked"), b
        },
        openChildOptions: function(a, b, c) {
            $(".DCheadingOpt").each(function() {
                $(this).children("i.iconS").removeClass("p-of-checked").addClass("unchecked"), $(this).siblings("div.child").each(function() {
                    $(this).hide()
                })
            }), empty(c) ? a.children("i").removeClass("unchecked").addClass("p-of-checked") : a.children("i").removeClass("p-of-checked").addClass("unchecked");
            var d = a.attr("openCls"),
                e = [];
            return $("." + d).each(function() {
                if ($(this).removeClass("hidei").show(), $(this).hasClass("DCnpOpen")) {
                    $(".DCpropTypradio i.iconS").removeClass("checked").addClass("unchecked");
                    var a = $(".defaultvalNp i.iconS");
                    empty(c) ? (a.removeClass("unchecked").addClass("checked"), e.push($(".defaultvalNp").attr("val")), qsSrp.setRC("R"), qsSrp.handleFlds(["area", "bedroom"])) : $(".DCnpOpen a.DCpropTypradio i.iconS").removeClass("checked").addClass("unchecked")
                } else selection = Header.checkSelectionPT(), 0 != $(this).children("a").children("i.checked").length && "allRes" != selection.text && "allCom" != selection.text || $(this).children("a.DCchildOpt").each(function() {
                    var a = $(this).children("i");
                    empty(c) ? (a.removeClass("unchecked").addClass("checked"), e.push($(this).attr("val"))) : a.removeClass("checked").addClass("unchecked")
                }), "some" == selection.text && selection.length > 0 && $(this).children("a.DCchildOpt").each(function() {
                    $(this).children("i").hasClass("checked") && e.push($(this).attr("val"))
                })
            }), $("#s_property_type").tinyscrollbar_update(), e
        },
        toggleChkAndReturnValue: function(a, b, c, d) {
            var e = Header.toggleChkBox(a);
            return b = b ? b.split(d) : [], e ? $.inArray(c, b) < 0 && b.push(c) : b.splice(arr.index_of(b, c), 1), b = $.unique(b), b.sort(function(a, b) {
                return a - b
            }), b
        },
        toggleAllCheckBox: function(a, b) {
            var c = [],
                d = Header.checkSelectionPT();
            return ("allRes" == d.text || "allCom" == d.text) && !a.hasClass("npOpts") || a.hasClass("npOpts") && 3 == b.split(/,/g).length ? (a.find("a").children("i").removeClass("checked").addClass("unchecked"), a.find("div[val='0']").children("i").removeClass("checked p-of-checked").addClass("unchecked")) : (a.find("a").each(function() {
                var a = $(this).attr("val");
                "0" != a && (c.push(a), $(this).children("i").removeClass("unchecked").addClass("checked"))
            }), a.find("div[val='0']").children("i").removeClass("unchecked p-of-checked").addClass("checked")), c
        },
        setRadioBehaviour: function(a) {
            var b, c, d = "",
                e = a.children("i");
            return e.hasClass("radio-No") ? (d = a.attr("val"), b = "radio-No", c = "radio-Yes", a.siblings().children("i").removeClass("radio-Yes").addClass("radio-No")) : (c = "radio-No", b = "radio-Yes"), e.removeClass(b).addClass(c), d
        },
        checkPropTyp: function() {
            var a = 0,
                b = 0,
                c = $('#s_property_type a.DCheadingOpt[activetab="active"]');
            return $(".DCresOpen a i.iconS").each(function() {
                $(this).hasClass("checked") && a++
            }), $(".DCcomOpen a i.iconS").each(function() {
                $(this).hasClass("checked") && b++
            }), a > 0 && "R" == c.attr("val") ? {
                R: a
            } : b > 0 && "C" == c.attr("val") ? {
                C: b
            } : {}
        },
        togglePropertyTypDrpDwn: function(a) {
            var b = [];
            $(".propTypvariant").attr("active", !1), $(".DCheadingOpt").hide(), $(".DCheadingOpt").next(".child").hide(), $(".DCcomOpen").hide();
            var c = qsSrp.getRC();
            "B" == a || "R" == a || "RESALE" == a ? ($("#s_property_type").attr("active", !0), $(".DCheadingOpt").show(), "R" != a && "RESALE" != a || ($("#NPddli").hide(), $(".DCnpOpen").hide()), "C" == c ? b = Header.ShowComDivPT() : "R" == c && ($("#resddli").next(".child").show(), $(".DCresOpen").children("a.DCpropTypOpt").each(function() {
                $(this).children("i.iconS").hasClass("checked") && b.push($(this).attr("val"))
            })), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"])) : "N" == a ? ($("#np_op").attr("active", !0), $("#np_op").children("a.prnt").each(function() {
                $(this).children("i.iconS").hasClass("checked") && b.push($(this).attr("val"))
            })) : "C" == a && "C" == c ? ($("#s_property_type").attr("active", !0), $("#comddli").show(), b = Header.ShowComDivPT()) : "D" == a && ($("#s_property_type").attr("active", !0), $("#NPddli").hide(), $(".DCnpOpen").hide(), "R" == c && ($("#resddli").show(), $("#resddli").next(".child").show(), $("#comddli").show(), $(".DCresOpen").children("a.DCpropTypOpt").each(function() {
                $(this).children("i.iconS").hasClass("checked") && b.push($(this).attr("val"))
            })), "C" == c && (b = Header.ShowComDivPT(), $("#resddli").show()), _99ab.execFunc(Header.updateTabTextAB, Header.updateTabText, Header, ["s_property_type"])), qsSrp.setPT(b.join(":"))
        },
        selectOptionRadio: function(a, b) {
            $("." + b).each(function() {
                $(this).children("i.iconS").removeClass("radio-Yes").addClass("radio-No"), $(this).attr("val") == a && $(this).children("i.iconS").removeClass("radio-No").addClass("radio-Yes")
            })
        },
        selectOptionNpPt: function(a, b) {
            $("." + b).each(function() {
                $(this).children("i.iconS").removeClass("checked").addClass("unchecked"), $(this).attr("val") == a && $(this).children("i.iconS").removeClass("unchecked").addClass("checked")
            })
        },
        ActivatePreferenceDrpDwn: function() {
            $("#opt_pref").show(), qsSrp.handlePreference()
        },
        DeactivatePreferenceDrpDwn: function() {
            $("#opt_pref").hide()
        },
        ShowComDivPT: function() {
            $("#comddli").show();
            var a = [];
            return $(".DCcomOpen").show(), $(".DCcomOpen").each(function() {
                $(this).children("a.DCpropTypOpt").each(function() {
                    $(this).children("i.iconS").hasClass("checked") && a.push($(this).attr("val"))
                })
            }), a
        },
        clickSpl: function(a) {
            a.children("i.iconS").hasClass("p-of-checked") || a.children("i.iconS").hasClass("checked") || a.click()
        },
        updateTabText: function(a) {
            var b, c, d = 0;
            target = $('#s_property_type a.DCheadingOpt[activetab="active"]'), $("." + target.attr("opencls")).children("a").children("i").each(function() {
                var a = $(this),
                    c = a.parent("a");
                a.hasClass("checked") && "block" == c.css("display") && (d++, b = c.text())
            }), allStatus = Header.checkSelectionPT(), "some" == allStatus.text && "PROJECT" == qsSrp.getST() || (c = "allRes" == allStatus.text ? "All Residential" : "allCom" == allStatus.text ? "All Commercial" : d >= 1 ? d > 1 ? d + " selected" : b : "Property Type", $("#pType-dd .addPdElip").text(c))
        },
        activateCategory: function(a) {
            $(".DCheadingOpt").each(function() {
                $(this).attr("activetab", "inactive")
            }), a.attr("activetab", "active")
        },
        checkSelectionPT: function() {
            var a = !0,
                b = !0,
                c = 0;
            return "active" == $("#resddli").attr("activeTab") ? ($(".DCresOpen a i.iconS").each(function() {
                $(this).hasClass("unchecked") ? a = !1 : $(this).hasClass("checked") && (c++, b = !1)
            }), a && !b ? {
                text: "allRes",
                length: c
            } : {
                text: "some",
                length: c
            }) : "active" == $("#comddli").attr("activeTab") ? ($(".DCcomOpen a i.iconS").each(function() {
                $(this).hasClass("unchecked") ? b = !1 : $(this).hasClass("checked") && (c++, a = !1)
            }), b && !a ? {
                text: "allCom",
                length: c
            } : {
                text: "some",
                length: c
            }) : "active" == $("#NPddli").attr("activeTab") ? (text = "", $(".DCpropTypradio").each(function() {
                $(this).children("i").hasClass("checked") && (text = $(this).text())
            }), {
                text: text
            }) : {}
        },
        TrimPT: function() {
            var a = [];
            if ("s_property_type" == $('.propTypvariant[active="true"]').attr("id")) {
                var b = $('#s_property_type a.DCheadingOpt[activetab="active"]').attr("opencls");
                if ("DCnpOpen" == b) $("." + b).children("a.DCchildOpt").children("i").each(function() {
                    if ($(this).hasClass("radio-Yes")) return void qsSrp.setPT($(this).parent("a.DCchildOpt").attr("val"))
                });
                else {
                    $("." + b).find("a.DCchildOpt").children("i").each(function() {
                        $(this).hasClass("checked") && a.push($(this).parent("a.DCchildOpt").attr("val"))
                    });
                    var c = Header.checkSelectionPT();
                    "allRes" == c.text && "DCresOpen" == b ? qsSrp.setPT("R") : "allCom" == c.text && "DCcomOpen" == b ? qsSrp.setPT("C") : qsSrp.setPT(a.join(":"))
                }
            }
        },
        performNormalHeadingClick: function(a) {
            var b = Header.checkSelectionPT(),
                c = [],
                d = qsSrp.getRC();
            "allRes" == b.text ? ($("#resddli i").removeClass("checked").removeClass("p-of-checked").addClass("unchecked"), $(".DCresOpen i").removeClass("checked").addClass("unchecked"), qsSrp.setPT(""), qsSrp.setRC("R")) : "allCom" == b.text ? ($("#comddli i").removeClass("checked").removeClass("p-of-checked").addClass("unchecked"), $(".DCcomOpen i").removeClass("checked").addClass("unchecked"), qsSrp.setPT(""), qsSrp.setRC("C")) : "Residential Projects" == b.text.trim() || "Commercial Projects" == b.text.trim() ? ($("#NPddli i").removeClass("p-of-checked").addClass("unchecked"), $(".DCnpOpen i").removeClass("checked").addClass("unchecked"), qsSrp.setPT("")) : "NPddli" == a.attr("id") ? "C" == d ? ($(".DCnpOpen a[val=26] i").removeClass("unchecked").addClass("checked"), qsSrp.setPT("26")) : ($(".DCnpOpen a[val=23] i").removeClass("unchecked").addClass("checked"), qsSrp.setPT("23")) : (Header.UpdateResCom(a), target = a.attr("opencls"), a.children("i").removeClass("unchecked").addClass("p-of-checked"), $("." + target + " i").each(function() {
                c.push($(this).parent("a").attr("val")), $(this).removeClass("unchecked").addClass("checked")
            }), qsSrp.setPT(c.join(":")))
        },
        UpdateResCom: function(a) {
            "comddli" == a.attr("id") ? qsSrp.setRC("C") : qsSrp.setRC("R")
        },
        updateHeadSelection: function() {
            var a = $('#s_property_type a.DCheadingOpt[activetab="active"]'),
                b = Header.checkSelectionPT();
            $(".DCheadingOpt i").removeClass("checked p-of-checked").addClass("unchecked"), "R" == a.attr("val") && ("allRes" == b.text ? a.children("i").removeClass("unchecked p-of-checked").addClass("checked") : b.length > 0 ? a.children("i").removeClass("unchecked checked").addClass("p-of-checked") : a.children("i").removeClass("p-of-checked checked").addClass("unchecked")), "C" == a.attr("val") && ("allCom" == b.text ? a.children("i").removeClass("unchecked p-of-checked").addClass("checked") : b.length > 0 ? a.children("i").removeClass("unchecked checked").addClass("p-of-checked") : a.children("i").removeClass("p-of-checked checked").addClass("unchecked")), "NPddli" == a.attr("id") && ("Residential Projects" == b.text.trim() || "Commercial Projects" == b.text.trim() ? a.children("i").removeClass("unchecked").addClass("p-of-checked") : a.children("i").removeClass("p-of-checked").addClass("unchecked"))
        },
        updatePrefSplCases: function() {
            var a, b;
            a = $("#search-bar-hp .search-tabs>a.sel").attr("id"), b = $("#rent_op .radio-Yes").parent().attr("val"), "ResRentTab" == a && ("C" == qsSrp.getRC() ? qsSrp.setPref("L") : qsSrp.setPref(b))
        },
        npSuggester: function() {
            Suggester99 && (Suggester99.resetSelf(), qsSrp.resetDYM(), Suggester99.initializeAutoSuggestorInstance(!0))
        },
        npclick: function(a) {
            var b;
            $("#np_op").find("a i.iconS").removeClass("radio-Yes").addClass("radio-No"), b = a.attr("val"), a.children("i.iconS").removeClass("radio-No").addClass("radio-Yes"), $("#pType-dd div.addPdElip").text(a.text()), "26" == b ? (qsSrp.setPT("26"), qsSrp.setRC("C")) : (qsSrp.setRC("R"), qsSrp.setPT("23")), qsSrp.handleFlds(["area", "bedroom", "preference"])
        },
        updateOtherPriceDD: function(a, b, c) {
            switch (feed = b + "-" + c, key = a.attr("val"), feed) {
                case "buy-min":
                    (key >= 1 && key <= 99 || 0 == key) && ($("#s_buy_budget_max a,#s_rent_budget_max a,#s_rent_budget_min a").show(), $("#s_buy_budget_max a").each(function() {
                        parseInt($(this).attr("val")) <= key && 0 != parseInt($(this).attr("val")) ? $(this).hide() : $(this).show()
                    }), $("#s_buy_budget_max").tinyscrollbar(), 1 != key && 100 != key || $("#s_buy_budget_min a").each(function() {
                        $(this).show()
                    }), $("#s_buy_budget_min").tinyscrollbar());
                    break;
                case "rent-min":
                    (key >= 100 && key <= 199 || 0 == key) && ($("#s_buy_budget_max a,#s_rent_budget_max a,#s_buy_budget_min a").show(), $("#s_rent_budget_max a").each(function() {
                        parseInt($(this).attr("val")) <= key && 0 != parseInt($(this).attr("val")) ? $(this).hide() : $(this).show()
                    }), $("#s_rent_budget_max").tinyscrollbar(), 1 != key && 100 != key || $("#s_rent_budget_min a").each(function() {
                        $(this).show()
                    }), $("#s_rent_budget_min").tinyscrollbar());
                    break;
                case "buy-max":
                    (key >= 1 && key <= 99 || 0 == key) && ($("#s_rent_budget_max a,#s_buy_budget_min a,#s_rent_budget_min a").show(), $("#s_buy_budget_min a").each(function() {
                        parseInt($(this).attr("val")) >= key && 0 != parseInt($(this).attr("val")) && 0 != key ? $(this).hide() : $(this).show()
                    }), $("#s_buy_budget_min").tinyscrollbar(), 99 != key && 199 != key || $("#s_buy_budget_max a").each(function() {
                        $(this).show()
                    }), $("#s_buy_budget_max").tinyscrollbar());
                    break;
                case "rent-max":
                    (key >= 100 && key <= 199 || 0 == key) && ($("#s_buy_budget_max a,#s_buy_budget_min a,#s_rent_budget_min a").show(), $("#s_rent_budget_min a").each(function() {
                        parseInt($(this).attr("val")) >= key && 0 != parseInt($(this).attr("val")) && 0 != key ? $(this).hide() : $(this).show()
                    }), $("#s_rent_budget_min").tinyscrollbar(), 99 != key && 199 != key || $("#s_rent_budget_max a").each(function() {
                        $(this).show()
                    }), $("#s_rent_budget_max").tinyscrollbar())
            }
        },
        retainOrigParam: function() {},
        makeScrollDynamic: function() {
            $("#s_property_type .overview").height(), $("#s_property_type .viewport").height();
            "block" == $("div.DCnpOpen").css("display") && "block" == $("#NPddli").css("display") ? $("#s_property_type").removeClass("DynHyt2 DynHyt3").addClass("DynHyt1") : $("#s_property_type").removeClass("DynHyt1 DynHyt3").addClass("DynHyt2"), "none" == $("#NPddli").css("display") && $("#s_property_type").removeClass("DynHyt2 DynHyt1").addClass("DynHyt3"), $("#s_property_type").tinyscrollbar_update()
        },
        selectDefaultNpPtTypes: function() {
            if ((qsSrp.data.np_search_type || empty(qsSrp.data.np_search_type)) && "lvl5_form" == qsSrp.frm_id) return void $("#s_np_search_type_res a:has(>i.checked),#s_np_search_type_com a:has(>i.checked)").click()
        },
        hideNpSearchTypePt: function() {
            $(".npOpts").hide()
        }
    },
    Homepage = {
        TabSelectorHp: function(a) {
            $(".tabs").each(function() {
                $(this).removeClass("sel")
            }), $("#" + a).addClass("sel")
        },
        hideCityErr: function() {
            $cityerr = $(".citysserr"), $cityerr.is(":visible") && $cityerr.hide()
        },
        hideFPPGBM: function() {
            if ($("#lcol").hide(), $(".rcol").hide(), $("#scroll_on_check").hide(), $("#city_fp_box").hide(), $("#fpHomePage").hide(), $(".fpContainFilter").hide(), $(".mt30").hide(), $("#fp_filter_label").hide(), $("#fp_layers_data").hide(), $banner = document.getElementById("Shoshkele-Pane"), $banner && "DIV" == $banner.nodeName && $("#Shoshkele-Pane").hide(), $("#pkb-wrapper").hide(), 0 !== $("#anaContentRent").length && 0 === $("#anaContentRent").html().length) {
                var a = $("#srchhdr_selCityAtHeader").val();
                $.ajax({
                    type: "POST",
                    data: {
                        tab: "rent",
                        cityCode: a
                    },
                    url: "",
                    success: function(a) {
                        $("#anaContentRent").html(a)
                    },
                    cache: !1
                }).done(function() {
                    0 === $("#anaContentRent").html().length && $(".questionsHead").hide()
                })
            }
            $("#anaContent").hide(), $("#anaContentRent").show();
            var b, c = $("#BG_Banner");
            4 == $("#selected_tab").val() && (b = "rent");
            var d = 0;
            "complete" === document.readyState && (d = 1);
            var e = window.screen.width > 1366 ? c.attr("data-big-url") : c.attr("data-small-url");
            1 !== d && (4 == $("#selected_tab").val() ? (rentbgurl = e, rentbid = $("#BG_Banner").attr("data-bid"), rentbt = $("#BG_Banner").attr("data-bt"), rentsmallUrl = $("#BG_Banner").attr("data-small-url"), rentbigUrl = $("#BG_Banner").attr("data-big-url")) : genericbgurl = e), "undefined" == typeof rentbgurl ? $.ajax({
                type: "GET",
                data: {
                    pid: $("#srchhdr_selCityAtHeader").val(),
                    rc: c.attr("data-rc"),
                    tab: b
                },
                success: function(a) {
                    if ("null" !== a.trim()) {
                        a = JSON.parse(a);
                        var b = a[Math.floor(Math.random() * a.length)];
                        rentbg = b, rentbgurl = window.screen.width > 1366 ? b.BIG_BG_IMAGE_URL : b.BG_IMAGE_URL, c.css({
                            "background-image": "url(" + rentbgurl + ")",
                            "background-position": "50% 0%",
                            "background-repeat": "no-repeat",
                            "background-size": "cover"
                        }), "undefined" != typeof rentbg && ($("#BG_Banner").attr("data-bid", rentbg.BANNER_ID), $("#BG_Banner").attr("data-bt", rentbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", rentbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", rentbg.BIG_BG_IMAGE_URL)), $("#BG_Banner").attr("data-bid", rentbg.BANNER_ID)
                    }
                }
            }) : (c.css({
                "background-image": "url(" + rentbgurl + ")",
                "background-position": "50% 0%",
                "background-repeat": "no-repeat",
                "background-size": "cover"
            }), "undefined" != typeof rentbg && ($("#BG_Banner").attr("data-bid", rentbg.BANNER_ID), $("#BG_Banner").attr("data-bt", rentbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", rentbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", rentbg.BIG_BG_IMAGE_URL)), "undefined" != typeof rentbid && ($("#BG_Banner").attr("data-bid", rentbid), $("#BG_Banner").attr("data-bt", rentbt), $("#BG_Banner").attr("data-small-url", rentsmallUrl), $("#BG_Banner").attr("data-big-url", rentbigUrl))), $("#Shoshkele-Pane").hide()
        },
        showFPPGBM: function() {
            if (!$("#search-bar-Bg.searchHeader").length) {
                $("#lcol").show(), $(".rcol").show(), $("#scroll_on_check").show(), $("#city_fp_box").show(), $("#fpHomePage").show(), $(".fpContainFilter").show(), $(".mt30").show(), $("#fp_filter_label").show(), $("#fp_layers_data").show(), $banner = document.getElementById("Shoshkele-Pane"), $banner && "DIV" == $banner.nodeName && $("#Shoshkele-Pane").show(), $("#pkb-wrapper").show(), $("#anaContent").show(), $(".questionsHead").show(), $("#anaContentRent").hide();
                var a = $("#BG_Banner"),
                    b = 0;
                "complete" === document.readyState && (b = 1);
                var c = window.screen.width > 1366 ? a.attr("data-big-url") : a.attr("data-small-url");
                1 !== b && (4 == $("#selected_tab").val() ? rentbgurl = c : (genericbgurl = c, genericbid = $("#BG_Banner").attr("data-bid"), genericbt = $("#BG_Banner").attr("data-bt"), genericsmallUrl = $("#BG_Banner").attr("data-small-url"), genericbigUrl = $("#BG_Banner").attr("data-big-url"))), "undefined" != typeof genericbgurl || $("#search-bar-Bg.searchHeader").length ? (a.css({
                    "background-image": "url(" + genericbgurl + ")",
                    "background-position": "50% 0%",
                    "background-repeat": "no-repeat",
                    "background-size": "cover"
                }), "undefined" != typeof genericbg && ($("#BG_Banner").attr("data-bid", genericbg.BANNER_ID), $("#BG_Banner").attr("data-bt", genericbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", genericbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", genericbg.BIG_BG_IMAGE_URL)), "undefined" != typeof genericbid && ($("#BG_Banner").attr("data-bid", genericbid), $("#BG_Banner").attr("data-bt", genericbt), $("#BG_Banner").attr("data-small-url", genericsmallUrl), $("#BG_Banner").attr("data-big-url", genericbigUrl))) : $.ajax({
                    type: "GET",
                    data: {
                        pid: $("#srchhdr_selCityAtHeader").val(),
                        rc: a.attr("data-rc"),
                        tab: "notRent"
                    },
                    success: function(b) {
                        if ("null" !== b.trim()) {
                            b = JSON.parse(b);
                            var c = b[Math.floor(Math.random() * b.length)];
                            genericbg = c, genericbgurl = window.screen.width > 1366 ? c.BIG_BG_IMAGE_URL : c.BG_IMAGE_URL, a.css({
                                "background-image": "url(" + genericbgurl + ")",
                                "background-position": "50% 0%",
                                "background-repeat": "no-repeat",
                                "background-size": "cover"
                            }), $("#BG_Banner").attr("data-bid", genericbg.BANNER_ID), $("#BG_Banner").attr("data-bt", genericbg.BANNER_TYPE), $("#BG_Banner").attr("data-small-url", genericbg.BG_IMAGE_URL), $("#BG_Banner").attr("data-big-url", genericbg.BIG_BG_IMAGE_URL);
                            var d, e, f;
                            if (d = getCookieVal("99zedoParameters"), e = JSON.parse(d).preference, f = JSON.parse(d).rescom, "D" == c.BANNER_TYPE && "RENT" == e && "RES" == f) {
                                $("#Shoshkele-Pane").remove();
                                var g = '<a id="Shoshkele-Pane" style="filter:alpha(opacity=0);opacity:0" href="" target="_blank" class="clickTrackBG" data-track-args="' + genericbg.BANNER_ID + ',L"></a>';
                                $("#BG_Banner").append(g), $("#Shoshkele-Pane").attr("href", c.LANDING_URL)
                            }
                        }
                    }
                }), $("#Shoshkele-Pane").show()
            }
        },
        showRentCards: function() {
            if (0 !== $("#rent_cards").length && 0 === $("#rent_cards").html().length) {
                var a = $("#srchhdr_selCityAtHeader").val();
                $.ajax({
                    data: {
                        platform: "desktop"
                    },
                    url: "" + a,
                    success: function(b) {
                        b.length > 1 && trackEventByGA("RC_DISPLAY", !1, "RC_DISPLAY_" + a, "RC_DISPLAY"), $("#rent_cards").html(b)
                    },
                    cache: !1
                })
            }
            $(".__slider-container").hide(), $("#rent_cards").show(), $("#hp_footer_bnr").hide(), $(".scrollNextWrap").hide()
        },
        hideRentCards: function() {
            $("#rent_cards").hide(), $(".__slider-container").show(), $("#hp_footer_bnr").hide(), $(".scrollNextWrap").show()
        }
    };
qsSrp.SrpSrchBarLoad = function() {
    $("#srpSearchHeader").length <= 0 || (qsSrp.initScrollPanes(), qsSrp.frm_id = "lvl5_form", qsSrp.setST($("#srchhdr_st").val()), qsSrp.setEntityValueMap(srpentityMap), qsSrp.setPhraseValueMap(srchhdr_strPhraseValueMap), srchFormData.setData($.parseJSON($("#srchhdr_srchFormData").val())), Header.srchBarLoad(), isMapSrch() && (qsSrp.showMapActiveCities(), "PROPERTY" == qsSrp.getST() && qsSrp.buildMapPrefOpt()))
};
var hpdif = {
    total_card_number_to_show: 0,
    filtermap: {},
    visible_cards: [],
    setup: function(a) {
        var b = "";
        "Buy" == a ? b = "TOP_PROPERTY_TYPES_BY_RES_SALE" : "Rent/PG" == a ? b = "TOP_PROPERTY_TYPES_BY_RES_RENT_PG" : "Projects" == a ? b = "Com" == clikTab ? "TOP_PROPERTY_TYPES_BY_COM_SALE" : "TOP_PROPERTY_TYPES_BY_RES_SALE" : "Dealer" == a ? b = "TOP_PROPERTY_TYPES" : "Commercial" == a && (b = "TOP_PROPERTY_TYPES");
        var c = this.filtermap,
            d = 0;
        $.each(dif_list, function(a, e) {
            $.each(e, function(a, e) {
                c[a] = {}, c[a].count = 0, void 0 != e[0] && $.each(e[0], function(e, f) {
                    0 != (d = f[b].length) && (c[a].count = c[a].count + 1)
                }), void 0 != e[999] && $.each(e[999], function(e, f) {
                    0 != (d = f[b].length) && (c[a].count = c[a].count + 1)
                }), 0 != c[a].count ? c[a].selected = !0 : c[a].selected = !1
            })
        })
    },
    showFilters: function() {
        var a = this.filtermap,
            b = "",
            c = 0,
            d = 0,
            e = Object.keys(a).sort(function(b, c) {
                return a[c].count - a[b].count
            });
        if ($.each(e, function(e, f) {
                if (0 != a[f].count) {
                    var g = "";
                    c > 4 && (g = ""), b += "<li class='" + g + "'><input type='checkbox'  attr='" + f + "' class='btn_city dif_city_filter' id='dif_city_filter" + f + "' name='rr'><label for='dif_city_filter" + f + "' title='" + f + "' class=mr5><span></span><div><div> " + f + " </div><i class='grey2'>(" + a[f].count + ")</i></div></label></li>", c++, d += a[f].count
                }
            }), hpdif.total_card_number_to_show = d, 0 != hpdif.total_card_number_to_show) {
            if (1 == c || 0 == c) return $(".difhpfilter").hide(), void $("#dif_showing_in_loc").hide();
            $(".difhpfilter").show(), $("#dif_showing_in_loc").show(), $("#dif_chklist").html(b), c <= 4 ? ($(".dif_cities_more").hide(), $(".difhpfilter").addClass("noDifScroll dhpColps")) : 5 === c ? ($(".difhpfilter").addClass("dhpFive"), $(".difhpfilter").addClass("noDifScroll dhpColps")) : $(".difhpfilter").addClass("dhpColps"), $(".dif_cities_more").on("click", function() {
                $(".difhpfilter").removeClass("dhpColps"), $(".scrolldifhpfilter").tinyscrollbar_update("0"), $(".difhpfilter .scrollbar").css("visibility", "visible")
            }), $(".scrolldifhpfilter .scrollbar").addClass("disable"), $(".dif_city_filter").on("change", function() {
                hpdif.updateFilterMap(), hpdif.showShowingInLocations(), hpdif.updateVisibleCards(), hpdif.showDIFCards()
            })
        }
    },
    updateFilterMap: function() {
        var a = this.filtermap,
            b = $(".dif_city_filter"),
            c = 0;
        $.each(b, function(b, d) {
            !0 === d.checked ? (c++, a[d.getAttribute("attr")].selected = !0) : a[d.getAttribute("attr")].selected = !1
        }), 0 === c && $.each(a, function(b, c) {
            a[b].selected = !0
        }), this.filtermap = a
    },
    showDIFCards: function() {
        var a = hpdif.getAllDIFCardsHtml();
        void 0 != a && ($("#dif_card_grid").html(a), show_lazy_load = !0), $("#dif_card_grid").animate({
            "margin-left": 0
        }, "slow", function() {
            hpdif.difcarousal.showHideNavigationArraow(), 1 == show_lazy_load && lazyload()
        })
    },
    showHeading: function() {
        var a = "",
            b = $("#selectcityheader").html();
        "" != b && void 0 != b && (a = "Featured Property Dealers - " + b), $("#dif_heading").html(a)
    },
    showShowingInLocations: function() {
        var a = this.filtermap,
            b = [],
            c = 0,
            d = Object.keys(a).sort(function(b, c) {
                return a[c].count - a[b].count
            });
        $.each(d, function(d, e) {
            !0 === a[e].selected && 0 != a[e].count ? b.push(e) : 0 != a[e].count && c++
        });
        var e = b.join(", ");
        void 0 !== e && ($("#dif_showing_in_loc").html(hpdif.addEllipsis("Showing Dealers in " + e, 130, !0)), $("#dif_showing_in_loc").css("visibility", "visible")), 0 === c && $("#dif_showing_in_loc").css("visibility", "hidden")
    },
    updateVisibleCards: function() {
        var a = this.filtermap,
            b = [];
        $.each(dif_list, function(c, d) {
            $.each(d, function(c, d) {
                1 == a[c].selected && (b.push.apply(b, d[0]), b.push.apply(b, d[999]))
            })
        }), this.visible_cards = hpdif.shuffleArray(b)
    },
    getAllDIFCardsHtml: function() {},
    getHtmlForDealerCard: function(a, b, c, d, e, f) {
        var g = 0,
            h = 0,
            i = "",
            j = "";
        1 == e ? (g = parseInt(f / 10), h = f % 10 + 1) : (g = 0, h = f < 5 ? 2 * f + 1 : f % 5 * 2 + 2), i = c + "_" + h + "_" + g, j = c + "_plink_" + h + "_" + g;
        var k = void 0 == a.LOCALITY ? "" : a.LOCALITY,
            l = a[b],
            m = "";
        return void 0 !== l && $.each(l, function(b, c) {}), "<a class='grid' onclick=\"window.open('" + a.dealer_seo_url + "?" + a.LINK_ID + "&from_src=IFLINK&lstAcn=&lstAcnId=&src=DIF_LINK');trackClickAction('" + i + "','','DIF_HOMEPAGE','');\" target='blank' ><div class='diflogo'><img class='lazy' data-original=" + a.DIF_LOGO_URL + " /></div><div class='cbody'><div class='dlrhead'>" + hpdif.addEllipsis(a.LABEL, 30, !1) + "</div><div class='dlrLoc'>" + k + "</div><div class='propDetail'><div class='pCount'>" + m + "</div></div></div></a>"
    },
    showDIFSection: function() {},
    moveDIFSectionUp: function() {},
    moveDIFSectionDown: function() {},
    addEllipsis: function(a, b, c) {
        var d = a.length > b,
            e = d ? a.substr(0, b - 1) : a;
        return e = c && d ? e.substr(0, e.lastIndexOf(" ")) : e, d ? e + "&hellip;" : e
    },
    shuffleArray: function(a) {
        for (var b = a.length - 1; b > 0; b--) {
            var c = Math.floor(Math.random() * (b + 1)),
                d = a[b];
            a[b] = a[c], a[c] = d
        }
        return a
    },
    difcarousal: {
        CARD_WIDTH: 170,
        MARGIN: 18,
        sliding: !1,
        padding: 20,
        configureCarousal: function() {
            var a = hpdif.total_card_number_to_show,
                b = this.CARD_WIDTH,
                c = this.MARGIN,
                d = this.padding;
            if (a <= 5) var e = (b + c) * a + d;
            else if (a <= 10)
                if ($(window).width() <= 1024 && $(window).height() <= 768) var e = 5 * (b + c) + d;
                else var e = 6 * (b + c) + d;
            else var e = (b + c) * Math.ceil(a / 2) + d;
            $("#dif_card_grid").width(e), $(".Previous").on("click", function() {
                hpdif.difcarousal.slide("right")
            }), $(".Next").on("click", function() {
                hpdif.difcarousal.slide("left");
                for (var a = 10; a < $(".diflogo").children("img").length; a++) {
                    var b = $(".diflogo").children("img")[a].getAttribute("data-original");
                    $(".diflogo").children("img")[a].setAttribute("src", b)
                }
            })
        },
        showHideNavigationArraow: function() {
            var a = parseInt($("#dif_card_grid").css("margin-left").replace("px", ""));
            this.checkStartFrame(a) ? $("#dif_carousal_div .Previous").hide() : $("#dif_carousal_div .Previous").show(), this.checkEndFrame(a) ? $("#dif_carousal_div .Next").hide() : $("#dif_carousal_div .Next").show()
        },
        checkEndFrame: function(a) {
            var b = hpdif.total_card_number_to_show,
                c = this.CARD_WIDTH,
                d = this.MARGIN;
            tcol = Math.ceil(b / 2), window.screen.width <= 1024 ? ncol_before_last_frame = tcol - 5 : ncol_before_last_frame = tcol - 6;
            var e = c * ncol_before_last_frame + d * ncol_before_last_frame;
            return !(Math.abs(a) < e)
        },
        checkStartFrame: function(a) {
            return 0 === a
        },
        slide: function(a) {
            var b = this.CARD_WIDTH,
                c = this.MARGIN,
                d = parseInt($("#dif_card_grid").css("margin-left").replace("px", "")),
                e = "",
                f = this.checkEndFrame(d),
                g = this.checkStartFrame(d);
            "left" === a && !0 !== f ? e = window.screen.width <= 1024 ? d - 5 * (b + c) : d - 6 * (b + c) : "right" === a && !0 !== g && (e = window.screen.width <= 1024 ? d + 5 * (b + c) : d + 6 * (b + c)), "" !== e && !1 === hpdif.difcarousal.sliding && (hpdif.difcarousal.sliding = !0, $("#dif_card_grid").animate({
                "margin-left": e
            }, "slow", function() {
                hpdif.difcarousal.sliding = !1, hpdif.difcarousal.showHideNavigationArraow()
            }))
        }
    }
};
! function(a) {
    function b(b, c) {
        function d() {
            return k.update(), f(), k
        }

        function e() {
            var a = t.toLowerCase();
            q.obj.css(s, u / o.ratio), n.obj.css(s, -u), w.start = q.obj.offset()[s], o.obj.css(a, p[c.axis]), p.obj.css(a, p[c.axis]), q.obj.css(a, q[c.axis])
        }

        function f() {
            x ? m.obj[0].ontouchstart = function(a) {
                1 === a.touches.length && (g(a.touches[0]), a.stopPropagation())
            } : (q.obj.bind("mousedown", g), p.obj.bind("mouseup", i)), c.scroll && window.addEventListener ? (l[0].addEventListener("DOMMouseScroll", h, !1), l[0].addEventListener("mousewheel", h, !1)) : c.scroll && (l[0].onmousewheel = h)
        }

        function g(b) {
            a("body").addClass("noSelect");
            var c = parseInt(q.obj.css(s), 10);
            w.start = r ? b.pageX : b.pageY, v.start = "auto" == c ? 0 : c, x ? (document.ontouchmove = function(a) {
                a.preventDefault(), i(a.touches[0])
            }, document.ontouchend = j) : (a(document).bind("mousemove", i), a(document).bind("mouseup", j), q.obj.bind("mouseup", j))
        }

        function h(b) {
            if (n.ratio < 1) {
                var d = b || window.event,
                    e = d.wheelDelta ? d.wheelDelta / 120 : -d.detail / 3;
                u -= e * c.wheel, u = Math.min(n[c.axis] - m[c.axis], Math.max(0, u)), q.obj.css(s, u / o.ratio), n.obj.css(s, -u), (c.lockscroll || u !== n[c.axis] - m[c.axis] && 0 !== u) && (d = a.event.fix(d), d.preventDefault())
            }
        }

        function i(a) {
            n.ratio < 1 && (c.invertscroll && x ? v.now = Math.min(p[c.axis] - q[c.axis], Math.max(0, v.start + (w.start - (r ? a.pageX : a.pageY)))) : v.now = Math.min(p[c.axis] - q[c.axis], Math.max(0, v.start + ((r ? a.pageX : a.pageY) - w.start))), u = v.now * o.ratio, n.obj.css(s, -u), q.obj.css(s, v.now))
        }

        function j() {
            a("body").removeClass("noSelect"), a(document).unbind("mousemove", i), a(document).unbind("mouseup", j), q.obj.unbind("mouseup", j), document.ontouchmove = document.ontouchend = null
        }
        var k = this,
            l = b,
            m = {
                obj: a(".viewport", b)
            },
            n = {
                obj: a(".overview", b)
            },
            o = {
                obj: a(".scrollbar", b)
            },
            p = {
                obj: a(".track", o.obj)
            },
            q = {
                obj: a(".thumb", o.obj)
            },
            r = "x" === c.axis,
            s = r ? "left" : "top",
            t = r ? "Width" : "Height",
            u = 0,
            v = {
                start: 0,
                now: 0
            },
            w = {},
            x = "ontouchstart" in document.documentElement;
        return this.update = function(a) {}, d()
    }
    a.tiny = a.tiny || {}, a.tiny.scrollbar = {
        options: {
            axis: "y",
            wheel: 40,
            scroll: !0,
            lockscroll: !0,
            size: "auto",
            sizethumb: "auto",
            invertscroll: !1
        }
    }, a.fn.tinyscrollbar = function(c) {
        var d = a.extend({}, a.tiny.scrollbar.options, c);
        return this.each(function() {
            a(this).data("tsb", new b(a(this), d))
        }), this
    }, a.fn.tinyscrollbar_update = function(b) {
        return a(this).data("tsb").update(b)
    }
}(jQuery);
var zedo = {},
    zedoLib = {},
    clickStream = {
        doClickStreamTracking: function(a, b) {},
        mapClickStreamParams: function(a) {
            var b = "CLICK",
                c = "",
                d = "",
                e = "",
                f = clickStream.doClickStreamMappingOfPages(a.page);
            return void 0 !== a && (void 0 !== a.SubPage && "" !== a.SubPage && (f = f + "_" + a.SubPage), void 0 !== a.Section && (c = a.Section), void 0 !== a.subSection && "" !== a.SubPage && (c = c + "." + a.subSection), void 0 !== a.event && (b = a.event), void 0 !== a.stage && (d = a.stage), void 0 !== a.profileId && (e = a.profileId)), {
                action: {
                    page: f,
                    event: b,
                    section: c,
                    stage: d
                },
                payload: {
                    user: {
                        profile_id: e
                    }
                }
            }
        },
        doClickStreamMappingOfPages: function(a) {
            return "NPSEARCH" == a ? "NPSRP" : "XID_DETAIL_PAGE" == a ? "XID" : "QS" == a && 0 == $("#mapContainer").length ? "SRP" : "Property Description" == a || "PLDPAGE" == a ? "PD" : "QS" == a && 1 == $("#mapContainer").length ? "MAP_SEARCH" : "DEALERSEARCH" == a ? "DEALER_SEARCH" : "dif_landing_page" == a ? "DEALER_DETAIL" : "BUYER_DASHBOARD" == a && 1 == $("#buyerDashboard").length ? "BUYER_DASHBOARD" : void 0 == a && 1 == $("#comparePage").length ? "COMPARE_PAGE" : a
        },
        isScrolledIntoView: function(a, b) {
            if (!($(a.elem).length <= 0)) {
                var c = a.elem,
                    d = a.flag,
                    e = a.time,
                    f = a.data;
                f && (f.action || (f.action = {}), f.action.stage = "FINAL", $(window).scroll(function(a) {
                    $(c).length && 0 == d && $(c).offset().top + $(c).height() <= $(window).scrollTop() + $(window).height() && $(c).offset().top >= $(window).scrollTop() && setTimeout(function() {
                        0 == d && $(c).offset().top + $(c).height() <= $(window).scrollTop() + $(window).height() && $(c).offset().top >= $(window).scrollTop() && (d = !0, clickStream.doClickStreamTracking(f, b))
                    }, e)
                }))
            }
        },
        getPageResultCount: function(a) {
            var b = $(".vsp-container").width(),
                c = $(".vsp-itemsFilm").css("marginLeft"),
                d = $(".vsp-item.showItem").outerWidth(!0);
            if (0 === d) return 0;
            var e = 0,
                f = 0;
            return e = b / d, e > a ? e = a : f = a - e, "0px" == c ? e : f
        },
        attributeMap: {
            "Genuine Options, Verified by 99acres": "VERIFIED",
            "Connect Directly with Owners": "OWNER",
            "Save more with Cheapest options": "BUDGET_RELAX",
            "X Recommended": "DEFAULT",
            "MORE DEALS": "MORE_DEALS",
            "CHEAPEST DEALS": "BUDGET_RELAX",
            "MOVE IN NOW": "MOVE_IN_NOW",
            "SAME PRICE, BIGGER PROPERTY": "UPGRADE_OPTION",
            "SAME PROJECT, MORE OPTIONS": "SAME_PROJECT",
            "PAY LESS FOR SIMILAR OPTIONS": "BUDGET_RELAX"
        },
        attributeMapFromId: {
            5: "MORE_DEALS",
            4: "BUDGET_RELAX",
            3: "MOVE_IN_NOW",
            6: "UPGRADE_OPTION",
            1: "SAME_PROJECT",
            2: "BUDGET_RELAX"
        },
        getRecomEntities: function() {
            var a = [],
                b = 1;
            return $("#thankYouEoiOrVsp .recommCard").each(function() {
                var c = clickStream.attributeMap[$(this).find(".tags")[0].innerHTML];
                $(this).find(".chkradCustom.eoiChkBox").each(function() {
                    var d = $(this).attr("data-propid");
                    a.push({
                        id: d.substr(1),
                        rank: b,
                        attribute: c
                    }), b++
                })
            }), a
        },
        getResaleEntities: function() {
            var a = [],
                b = 1;
            return $("#recmndCardSection .resale-recommCard").each(function() {
                var c = clickStream.attributeMap[$(this).find(".tags._mainHeadSpn")[0].innerHTML];
                $(this).find("._recommendCardTuple").each(function() {
                    var d = $(this).attr("data-propid");
                    a.push({
                        id: d.substr(1),
                        rank: b,
                        attribute: c
                    }), b++
                })
            }), a
        },
        getPage: function() {
            switch (currentPageName) {
                case "QS":
                    return "SRP";
                case "Property Description":
                    return "PD";
                case "dif_landing_page":
                    return "DIF";
                case "DEALERSEARCH":
                    return "DEALER_SRP"
            }
            return ""
        },
        _trackerId: 0,
        _batcher: null,
        initializeBatching: function(a, b) {},
        blacklistBatching: noop,
        removeFromBatchingBlacklist: noop
    };
window.trackingStore || (window.trackingStore = new TrackingStore), TrackingStore.prototype.setProfileId = function(a) {
        return this._profileId = a, this.emit(), this
    }, TrackingStore.prototype.removeProfileId = function() {
        return this._profileId = "", this.emit(), this
    }, TrackingStore.prototype.setSection = function(a) {
        return this._section = a, this.emit(), this
    }, TrackingStore.prototype.removeSection = function() {
        return this._section = "", this.emit(), this
    }, TrackingStore.prototype.subscribe = function(a) {
        var b = this._subscriptions.push(a);
        return function() {
            this._subscriptions.filter(function(a, c) {
                return c != b
            })
        }
    }, TrackingStore.prototype.emit = function() {
        var a = this;
        this._subscriptions.forEach(function(b) {
            b(a)
        })
    }, "function" != typeof Object.assign && Object.defineProperty(Object, "assign", {
        value: function(a, b) {
            "use strict";
            if (null == a) throw new TypeError("Cannot convert undefined or null to object");
            for (var c = Object(a), d = 1; d < arguments.length; d++) {
                var e = arguments[d];
                if (null != e)
                    for (var f in e) Object.prototype.hasOwnProperty.call(e, f) && (c[f] = e[f])
            }
            return c
        },
        writable: !0,
        configurable: !0
    }),
    function() {
        function a(a) {
            this.action = {
                page: a.page || "",
                section: a.section || "",
                event: a.event || "CLICK",
                stage: a.stage || "FINAL",
                referrer_section: a.referrer_section || "",
                source: a.source || ""
            }, a.workflow && (this.action.workflow = a.workflow), a.profileId && (this.payload = {
                user: {
                    profile_id: a.profileId || ""
                }
            }), a.custom_object && (this.custom_object = a.custom_object);
            var b = localStorage.getItem("workflowId");
            b && (this.custom_object ? this.custom_object.workflow_id = b : this.custom_object = {
                workflow_id: b
            }), this.payload = Object.assign({}, this.payload, a.payload), this.current_url = window.location.href
        }
        clickStream.factory = function b(c, d) {
            function e(a) {
                if (clickStream._batcher) clickStream._batcher.batch(a, clickStream.doClickStreamTracking);
                else try {
                    clickStream.doClickStreamTracking(a, !0)
                } catch (b) {
                    console.error("clickStream object not found")
                }
            }
            var f = {
                page: c,
                profileId: d
            };
            Object.defineProperties(this, {
                id: {
                    get: function() {
                        return clickStream._trackerId++
                    }
                }
            }), this.get = function(b) {
                return b ? new a(f)[b] : new a(f)
            }, this.click = function(b, c, d) {
                var g = Object.assign({}, f, {
                    section: b,
                    payload: Object.assign({}, f.payload, c)
                });
                return d && (g.custom_object = d), e(new a(g)), this
            }, this.focus = function(b, c, d) {
                var g = Object.assign({}, f, {
                    section: b,
                    payload: Object.assign({}, f.payload, c),
                    event: "FOCUS"
                });
                return d && (g.custom_object = d), e(new a(g)), this
            }, this.sectionView = function(b, c, d) {
                var g = Object.assign({}, f, {
                    section: b,
                    payload: Object.assign({}, f.payload, c),
                    event: "SECTION_VIEW"
                });
                return d && (g.custom_object = d), e(new a(g)), this
            }, this.setSection = function(a, b, c) {
                return window.trackingStore && a && window.trackingStore.setSection(a), this.sectionView(a, b, c)
            }, this.pageView = function(b, c) {
                var d = Object.assign({}, f, {
                    payload: Object.assign({}, f.payload, b),
                    event: "PAGE_VIEW"
                });
                return c && (d.custom_object = c), e(new a(d)), this
            }, this.decorate = function(a) {
                return a.payload = Object.assign({}, a.payload, f.payload), Object.assign(f, a), Object.assign(f, a.action), this
            }, this.generic = function(b, c, d) {
                var g = Object.assign({}, b, {
                    payload: Object.assign({}, f.payload, c)
                });
                return d && (g.custom_object = d), e(new a(g)), this
            }, this.setStage = function(a) {
                return f.stage = a, this
            }, this.resetStage = function() {
                return delete f.stage, this
            }, this.setSource = function(a) {
                return f.source = a, this
            }, this.resetSource = function() {
                return delete f.source, this
            }, this.setRefferer = function(a) {
                return f.referrer_section = a, this
            }, this.resetRefferer = function() {
                return delete f.referrer_section, this
            }, this.setProfileId = function(a) {
                return f.profileId = a, this
            }, this.resetProfileId = function() {
                return f.profileId = "", this
            }, this.setWorkflow = function(a) {
                return f.workflow = a, this
            }, this.resetWorkflow = function() {
                return f.workflow = "", this
            }, this.clone = function() {
                var a = new b(f.page, f.profileId);
                return a.decorate(f), a
            };
            var g = {},
                h = {};
            window.trackingStore.subscribe(function(a) {
                this.setProfileId(a.profileId)
            }.bind(this)), this.addListner = function(a, b, c) {
                function d(a) {
                    return function(b) {
                        for (var c = h[a].values(), d = null; d = c.next().value;)
                            if (b.target && b.target.matches && b.target.matches(d)) return;
                        for (var c = g[a].values(), d = null; d = c.next().value;) b.target && b.target.matches && b.target.matches(d) && this[a](e(window.trackingStore.section, b.target.name))
                    }
                }

                function e(a, b) {
                    return a.concat(a && b && ".").concat(b).toUpperCase()
                }
                return g[a] ? g[a].add(b) : g[a] = new Set(b), h[a] ? h[a].add(c) : h[a] = new Set(c), window.addEventListener(a, d(a).bind(this), !0), this
            }, this.whitelist = function(a, b) {
                return g[a] ? g[a].add(b) : g[a] = new Set([b]), this
            }, this.removeFromWhitelist = function(a, b) {
                return g[a] && g[a].delete(b), this
            }, this.blacklist = function(a, b) {
                return h[a] ? h[a].add(b) : h[a] = new Set([b]), this
            }, this.removeFromBlacklist = function(a, b) {
                return h[a] && h[a].delete(b), this
            }
        }
    }(),
    function() {
        function a() {
            var a = null;
            try {
                a = new XMLHttpRequest
            } catch (b) {
                console.error("XMLHttpRequest object not found")
            }
            return a
        }

        function b(b, c) {
            var d = a();
            if (d) {
                d.open("POST", b, !0);
                var e = c + "&is_ajax=1";
                d.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), d.send(e)
            }
        }
        clickStream.post = b
    }(),
    function() {
        "use strict"
    }(), $(function() {}), Banners.prototype.setpageId = function(a) {
        this.pageId = void 0 !== a ? a : null
    }, Banners.prototype.setpageIdentifier = function(a) {
        this.pageIdentifier = void 0 !== a ? a : null
    }, Banners.prototype.setBannerIdentifier = function(a) {
        this.bannerIdentifier = void 0 !== a ? a : null
    }, Banners.prototype.setMinBannersToDisplay = function(a) {
        this.minBannersToDisplay = void 0 !== a ? a : null
    }, Banners.prototype.setFallBackFunction = function(a) {
        this.fallBackFunction = void 0 !== a ? a : null
    }, Banners.prototype.setResCom = function(a) {
        this.resCom = void 0 !== a ? a : null
    }, Banners.prototype.setDisplayParams = function(a) {
        this.displayParams = void 0 !== a ? a : null
    }, Banners.prototype.loadBanner = function() {
        this.getBannerDetails()
    }, Banners.prototype.getBannerDetails = function() {
        var a = this;
        $.ajax({
            type: "GET",
            data: {
                pageId: a.pageId,
                bannerIdentifier: a.bannerIdentifier,
                pageIdentifier: a.pageIdentifier,
                resCom: a.resCom,
                minBannersToDisplay: a.minBannersToDisplay
            },
            success: function(b) {
                b ? a.successLoadBanner(b) : a.fallBackFunction()
            },
            failure: function() {
                console.log("")
            }
        })
    }, Banners.prototype.successLoadBanner = function(a) {
        var b = this,
            c = null != navigator.userAgent.match(/iPad/i),
            d = $(".__slider-container"),
            e = this.displayParams,
            f = "";
        if ("null" != (a = a.trim())) {
            a = JSON.parse(a);
            var g = a.length,
                h = getRandomInt(0, g),
                i = Number(localStorage.getItem("initialSlide")) || 0,
                j = a.splice(h),
                k = j.concat(a);
            e.initialSlide = g > i ? Number(i) : 0
        }
        c && "undefined" != typeof windowWidth && windowWidth <= 980 && d.width(990), g == e.slidesToShow && (e.initialSlide = 0), g ? (f = b.getBannerHTML(k), $(".__slider").html(f).show().cstSlider(e)) : b.fallBackFunction()
    }, Banners.prototype.getBannerHTML = function(a) {
        var b = "",
            c = this.bannerIdentifier;
        return $.each(a, function(a, d) {}), b
    }, $.fn.displayBanners = function(a) {
        new Banners(a).loadBanner()
    }, $(document).on("click", ".clickTrackBG", function(a) {
        allBanners.bannerClickTracking(a)
    });
var allBanners = {},
    modalLayerModule = function() {
        "use strict";

        function a() {}

        function b() {}

        function c() {}

        function d() {}

        function e(a) {}

        function f(a, b, c, d, f, g) {
            var a = a || 0,
                b = b || 0,
                c = c || "",
                d = d || "",
                h = {
                    a: a,
                    b: b,
                    title: d
                };
            l = g, $.isEmptyObject(f) || $.each(f, function(a, b) {
                h[a] = b
            }), $.ajax({
                url: c,
                type: "GET",
                cache: !1,
                data: h,
                success: e
            })
        }

        function g(a, b, d, e) {}

        function h(a, b, c, d) {}

        function i() {}

        function j() {}
        var k, l;
        if ($("#modal-window_id").length > 0) a();
        else {}
        k.modalBgDarkLayer.on("click", d);
        var m = b();
        return {
            getallInfo: f,
            callbackLayer: j,
            layerWithId: h,
            modalResize: i
        }
    }();
$(window).resize(function() {});
var riLayer = function(a, b, c, d, e) {},
    riCore = {};;