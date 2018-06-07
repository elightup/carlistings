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


	scrollToTop();
	toggleMobileMenu();
	initMobileNavigation($('.mobile-menu'));
	placeholderComment();
} );
