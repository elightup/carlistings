/**
 */
(function($){

	auto_listings_view_switcher();
	auto_listings_buy_sell();

	/**
	 * Search box
	 */
	if( $( '.auto-listings-search' ).length > 0 ) {
		auto_listings_search_box();
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

		$( '.has-sidebar .auto-listings-view-switcher div' ).click( function() {
			var view = $( this ).attr( 'id' );
			set_cookie( view );
			switch_view( view );
		});

		if( get_cookie( 'view' ) == 'grid') { switch_view( 'grid' ); }

		function switch_view( to ) {

			var from = ( to == 'list' ) ? 'grid' : 'list';

			var listings = $('.has-sidebar .auto-listings-items li');
			$.each( listings, function( index, listing ) {
				$( '.has-sidebar .auto-listings-items' ).removeClass( from + '-view' );
				$( '.has-sidebar .auto-listings-items' ).addClass( to + '-view' );
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
	 * Search box
	 */
	function auto_listings_search_box() {

		$('#auto-listings-search select').SumoSelect({
		});

		$('.auto-listings-search').on( 'click', 'a.refine', function( e ) {
			$('.extras-wrap').slideToggle( 200 );
			$( this ).toggleClass( 'shown' );
		});

	}

})(jQuery);
