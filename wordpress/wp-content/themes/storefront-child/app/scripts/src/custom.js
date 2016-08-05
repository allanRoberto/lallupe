(function($) {
	$(document).ready(function(){

	  $(".gfield_radio li input[type='radio']").trigger('click');
	  $(".gfield_radio li input[type='radio']").attr('checked',true);

	  $(document).ready(function() {
		$(".wc-default-select").select2();
		$('.dropdown-toggle').dropdown();

	  });
	  

	  $(".carousel-products .products").addClass('owl-carousel');

	  $(".single-product .related .products").addClass('owl-carousel');

	  $(".owl-carousel").owlCarousel({
	  	center: true,
	    items:5,
	    loop:true,
	    margin:10,
	    nav: true,
	    navContainerClass : 'navigation-carousel',
	    responsive : {
		    // breakpoint from 0 up
		    0 : {
		        items : 3,
		    },
		    480 : {
		        items : 2,
		    },
		    // breakpoint from 768 up
		    768 : {
		        items : 3,
		    },
		    980 : {
		        items : 5,
		    }
		}
	  });
	});
})(jQuery);
