



"use strict";

jQuery(window).on('load', function() {



// will first fade out the loading animation

jQuery("#status").fadeOut();

// will fade out the whole DIV that covers the website.

jQuery("#preloader").delay(500).fadeOut("slow");



})







 	

$(document).ready(function() {

$('.owl-carousel1').owlCarousel({

loop: true,

autoplay:true,

autoplayTimeout:2000,

autoplayHoverPause:true,

margin: 10,

responsiveClass: true,

responsive: {

0: {

items: 1,

dots:false,

nav: true

},

600: {

items: 2,

dots:false,

nav: false

},

991: {

items: 2,

nav: true,

dots:false,

loop: false,

margin: 20

},

1280: {

items: 2,

nav: true,

dots:false,

loop: false,

margin: 20

}





}

})

})

 
 
 
 
 
 
 
 $(document).ready(function() {

$('.owl-carousel2').owlCarousel({

loop: true,

autoplay:true,

autoplayTimeout:2000,

autoplayHoverPause:true,

margin: 10,

responsiveClass: true,

responsive: {

0: {

items: 1,

dots:false,

nav: true

},

600: {

items: 2,

dots:false,

nav: false

},

991: {

items: 2,

nav: true,

dots:false,

loop: false,

margin: 20

},

1280: {

items: 3,

nav: true,

dots:false,

loop: false,

margin: 20

}





}

})

})
 
 
 
 
 
 
 
 
 
 





$(document).ready(function(){

  $("#hide").on('click', function (){

    $("#top-div-1").hide();

  });

  

  $("#show").on('click', function (){

    $("#top-part-1").show();

  });

  

});





$(document).ready(function(){

  $(".close").click(function(){

    $("#page-top").addClass("intro");

  });

});











$(document).ready(function(){

  $(".close").click(function(){

    $("#sidebarCollapse").addClass("intro2");

  });

});







(function($){

	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {

	  if (!$(this).next().hasClass('show')) {

		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");

	  }

	  var $subMenu = $(this).next(".dropdown-menu");

	  $subMenu.toggleClass('show');



	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {

		$('.dropdown-submenu .show').removeClass("show");

	  });



	  return false;

	});

})(jQuery)














$(document).ready(function() {

$('.owl-carousel-2').owlCarousel({

loop: true,

autoplay:true,

autoplayTimeout:2000,

autoplayHoverPause:true,

margin: 10,

responsiveClass: true,

responsive: {

0: {

items: 1,

dots:false,

nav: true

},

600: {

items:1,

dots:false,

nav: false

},

991: {

items: 2,

nav: true,

dots:false,

loop: false,

margin: 20

},

1280: {

items: 2,

nav: true,

dots:false,

loop: false,

margin: 20

}





}

})

})
