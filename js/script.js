/**
 * Theme main script.
 *
 * @package CarListings
 */

// Run when the DOM ready.
jQuery( function ( $ ) {
	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';

	/**
	 * Scroll to top
	 */
	function scrollToTop() {
		var $button = $( '.scroll-to-top' );

		$window.scroll( function() {
			$button[$window.scrollTop() > 100 ? 'removeClass' : 'addClass']( 'hidden' );
		} );
		$button.on( 'click', function( e ) {
			e.preventDefault();
			$( 'body, html' ).animate( {
				scrollTop: 0
			}, 500 );
		} );
	}

	function toggleMobileMenu() {
		var $body = $( 'body' ),
			mobileClass = 'mobile-menu-open',
			clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
			transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

		// Click to show mobile menu.
		$( '.menu-toggle' ).on( 'click', function( event ) {
			event.preventDefault();
			event.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			if ( $body.hasClass( mobileClass ) ) {
				return;
			}
			$body.addClass( mobileClass );
		} );

		// When mobile menu is open, click on page content will close it.
		$( '.site' )
			.on( clickEvent, function( event ) {
				if ( ! $body.hasClass( mobileClass ) ) {
					return;
				}
				event.preventDefault();
				$body.removeClass( mobileClass ).addClass( 'animating' );
			} )
			.on( transitionEnd, function() {
				$body.removeClass( 'animating' );
			} );
	}

	/**
	 * Add toggle dropdown icon for mobile menu.
	 *
	 * @param $container
	 */
	function initMobileNavigation( $container ) {
		// Add dropdown toggle that displays child menu items.
		var $dropdownToggle = $( '<i class="dropdown-toggle icofont icofont-rounded-down"></i>' );

		$container.find( '.menu-item-has-children > a' ).after( $dropdownToggle );

		// Toggle buttons and sub menu items with active children menu items.
		$container.find( '.current-menu-ancestor > .sub-menu' ).show();
		$container.find( '.current-menu-ancestor > .dropdown-toggle' ).addClass( 'toggled-on' );
		$container.on( clickEvent, '.dropdown-toggle', function( e ) {
			e.preventDefault();
			$( this ).toggleClass( 'toggled-on' );
			$( this ).next( 'ul' ).toggle();
		});
	}

	$window.on( 'resize', function() {
		if ( $window.width() > 992 ) {
			$body.removeClass( 'mobile-menu-open' );
		}
	} );

	/**
	 * Move tag html in search form.
	 */
	function moveTagSearchForm() {
		$( '.search-content .odometer' ).prependTo( '.search-content .area-wrap' );
		$( '.search-content .condition-wrap' ).prependTo( '#auto-listings-search' );
		$( '.search-content .search-form__title' ).prependTo( '#auto-listings-search' );
	}

	/**
	 * Homepage featured content slider.
	 */
	function initFeaturedContentSlider() {
		var $slider = $( '.featured-post__content.slider' ),
			$sliderSpeed = $slider.data( 'speed' );

		$( '.featured-posts' ).removeClass( 'is-hidden' );
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
	initMobileNavigation( $( '.mobile-menu' ) );
	initFeaturedContentSlider();
	moveTagSearchForm();
} );
