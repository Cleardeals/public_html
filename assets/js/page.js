

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



$(document).ready(function() {
    new WOW().init();
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
})(jQuery);