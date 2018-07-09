// Run when the DOM ready
jQuery( function ( $ ) {
	'use strict';

	var $window = $(window),
	$body = $('body'),
	clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

	/**
	 * Scroll to top
	 */
	 function scrollToTop() {
	 	var $window = $(window),
	 	$button = $('.scroll-to-top');
	 	$window.scroll(function() {
	 		$button[$window.scrollTop() > 100 ? 'removeClass' : 'addClass']('hidden');
	 	});
	 	$button.on('click', function(e) {
	 		e.preventDefault();
	 		$('body, html').animate({
	 			scrollTop: 0
	 		}, 500);
	 	});
	 }

	 function toggleMobileMenu() {
	 	var $body = $('body'),
	 	mobileClass = 'mobile-menu-open',
	 	clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
	 	transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

		// Click to show mobile menu.
		$('.menu-toggle').on(clickEvent, function(event) {
			event.preventDefault();
			event.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			if ($body.hasClass(mobileClass)) {
				return;
			}
			$body.addClass(mobileClass);
		});

		// When mobile menu is open, click on page content will close it.
		$('.site')
		.on(clickEvent, function(event) {
			if (!$body.hasClass(mobileClass)) {
				return;
			}
			event.preventDefault();
			$body.removeClass(mobileClass).addClass('animating');
		})
		.on(transitionEnd, function() {
			$body.removeClass('animating');
		});
	}

	/**
	 * Add toggle dropdown icon for mobile menu.
	 * @param $container
	 */
	 function initMobileNavigation($container) {
		// Add dropdown toggle that displays child menu items.
		var $dropdownToggle = $('<i class="dropdown-toggle icofont icofont-rounded-down"></i>');

		$container.find('.menu-item-has-children > a').after($dropdownToggle);

		// Toggle buttons and sub menu items with active children menu items.
		$container.find('.current-menu-ancestor > .sub-menu').show();
		$container.find('.current-menu-ancestor > .dropdown-toggle').addClass('toggled-on');
		$container.on(clickEvent, '.dropdown-toggle', function(e) {
			e.preventDefault();
			$(this).toggleClass('toggled-on');
			$(this).next('ul').toggle();
		});
	}

	$window.on( 'resize', function() {
		if( $window.width() > 992 ) {
			$body.removeClass('mobile-menu-open');
		}
	} )

	/**
	 * Add placeholder to input Comment.
	 */
	 function placeholderComment() {
	 	$("#author").attr("placeholder", "Full Name *");
	 	$("#email").attr("placeholder", "Mail Address *");
	 	$("#url").attr("placeholder", "Website URL");
	 	$("#comment").attr("placeholder", "Write Your Comments Here...");
	 }

	/**
	 * Move tag html in search form.
	 */
	 function moveTagSearchForm() {

	 	$(".search-content .odometer ").prependTo(".search-content .area-wrap");
	 	$(".search-content .condition-wrap ").prependTo("#auto-listings-search");
	 	$(".search-content .search-form__title ").prependTo("#auto-listings-search");
	 }


	 /**
     * Buy/Sell option
     */
     function auto_listings_buy_sell() {
     	$( '.auto-listings-search' ).on( 'change', 'select.purpose', function() {
     		$( this ).closest( 'form' ).submit();
     	});
     }


    /**
     * View switcher
     */
     function auto_listings_view_switcher() {

     	if( ! get_cookie( 'view' ) ) { switch_view( default_view ); }

     	$( '.auto-listings-view-switcher div' ).click( function() {
     		var view = $( this ).attr( 'id' );
     		set_cookie( view );
     		switch_view( view );
     	});

     	if( get_cookie( 'view' ) == 'grid') { switch_view( 'grid' ); }

     	function switch_view( to ) {

     		var from = ( to == 'list' ) ? 'grid' : 'list';

     		var listings = $('.auto-listings-items li');
     		$.each( listings, function( index, listing ) {
     			$( '.auto-listings-items' ).removeClass( from + '-view' );
     			$( '.auto-listings-items' ).addClass( to + '-view' );
     		});
     	}

     	function set_cookie( value ) {
            var days = 30; // set cookie duration
            if (days) {
            	var date = new Date();
            	date.setTime(date.getTime()+(days*24*60*60*1000));
            	var expires = "; expires="+date.toGMTString();
            }
            else var expires = "";
            document.cookie = "view="+value+expires+"; path=/";
        }

        function get_cookie( name ) {
        	var value = "; " + document.cookie;
        	var parts = value.split("; " + name + "=");
        	if (parts.length == 2) return parts.pop().split(";").shift();
        }

    }

     /**
     * Ordering
     */
     function auto_listings_ordering() {
     	$('.auto-listings-ordering select.orderby').SumoSelect();
     	$( '.auto-listings-ordering' ).on( 'change', 'select.orderby', function() {
     		$( this ).closest( 'form' ).submit();
     	});
     }
    /**
	 * Homepage featured content slider.
	 */
	 function initFeaturedContentSlider() {
	 	var $slider = $( '.featured-post__content' );
	 	var $sliderSpeed = $slider.data( 'speed' );
	 	$slider.slick( {

	 		speed: 1000,
	 		autoplay: true,
	 		autoplaySpeed: $sliderSpeed,
	 		arrows: true,
	 		fade: true,
	 		dots: false,
	 		nextArrow: '',
	 		prevArrow: '',
	 		pauseOnHover: false,
	 		cssEase: 'linear',
	 		adaptiveHeight: false
	 	} );
	 	if ( $sliderSpeed == 0 ) {
	 		$slider.slick( 'pause' );
	 		$slider.find( $( '.slick-arrow' ) ).hide();
	 	}
	 }


	 scrollToTop();
	 toggleMobileMenu();
	 initMobileNavigation($('.mobile-menu'));
	 placeholderComment();
	 auto_listings_buy_sell();
	 auto_listings_view_switcher();
	 auto_listings_ordering();
	 initFeaturedContentSlider();
	 moveTagSearchForm();
	} );
