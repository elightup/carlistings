/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package CarListings
 */

( function( $ ) {
	var options = {
		'blogname': '.site-title a',
		'blogdescription': '.site-description',
		'search_section': '.section--search',
		'allcar_title': '.all-car__title',
		'allcar_description': '.all-car__description',
		'allcar_button_text': '.all-car__button',
		'cta_title': '.cta-title',
		'cta_description': '.cta-description',
		'cta_button_text': '.section-cta__right a'
	};

	// Use each to resolve closure problem.
	$.each( options, function ( setting, selector ) {
		wp.customize( setting, function ( value ) {
			value.bind( function ( to ) {
				$( selector ).html( to );
			} );
		} );
	} );

	// All cars section button URL.
	wp.customize( 'allcar_button_url', function ( value ) {
		value.bind( function ( to ) {
			$( '.all-car__button' ).attr( 'href', to );
		} );
	} );

	// CTA button URL.
	wp.customize( 'cta_button_url', function ( value ) {
		value.bind( function ( to ) {
			$( '.section-cta__right a' ).attr( 'href', to );
		} );
	} );
} )( jQuery );
