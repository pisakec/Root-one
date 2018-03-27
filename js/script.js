WebFont.load({
	google: {
		families: ['Lato:300,400,700,900','Montserrat:300,400,500,700,800,900']
	}
});

jQuery(document).ready(function ($) {
	$('.col-right-news').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: !0,
		dot: !1,
		vertical: !0,
		autoplaySpeed: 1000,
		infinite: !0,
		prevArrow: null,
		nextArrow: null,
		speed: 1000,
		adaptiveHeight: !0,
		responsive: [{
			breakpoint: 640,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: !0,
				vertical: !1,
				dots: !1,
				arrows: !1
			}
		}]
	})
});
jQuery(document).ready(function ($) {
	$('.related-post').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: !0,
		dot: !1,
		autoplaySpeed: 1000,
		infinite: !0,
		prevArrow: null,
		nextArrow: null,
		speed: 300,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: !0,
				dots: !1,
				arrows: !1
			}
		}, {
			breakpoint: 768,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		}, {
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}]
	})
});

jQuery(document).ready(function ($) {
	$("#contact-menu").mmenu({
		extensions: ["pagedim"],
		"offCanvas": {
			"zposition": "front",
			"position": "right"
		},
		navbar: {
        title: "my custom title"
    },
	})
});
jQuery(document).ready(function ($) {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 5) {
			$('body').addClass("sticky-header")
		} else {
			$('body').removeClass("sticky-header")
		}
	})
});
jQuery(window).scroll(function () {
	if (jQuery(this).scrollTop() > 100) {
		jQuery('#back-to-top').addClass('scrolled')
	} else if (jQuery(this).scrollTop() < 100) {
		jQuery('#back-to-top').removeClass('scrolled')
	}
});
jQuery('#back-to-top').click(function () {
	jQuery('html, body').animate({
		scrollTop: 0
	}, 800);
	return !1
});
jQuery(document).ready(function ($) {
/*	$("#mobile-nav").mmenu({
		extensions: ["pagedim"],
		navbar: {
        title: "my custom title"
    },
	})*/
	var $menu = $("#mobile-nav").mmenu({
   //   options
});
var $icon = $("#my-icon");
var API = $menu.data( "mmenu" );

$icon.on( "click", function() {
   API.open();
});

API.bind( "open:finish", function() {
   setTimeout(function() {
      $icon.addClass( "is-active" );
   }, 100);
});
API.bind( "close:finish", function() {
   setTimeout(function() {
      $icon.removeClass( "is-active" );
   }, 100);
});
});
