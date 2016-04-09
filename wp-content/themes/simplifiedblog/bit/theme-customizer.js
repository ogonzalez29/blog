/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. 
 */
( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#logo h1' ).html( newval );
		} );
	} );
	
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );


	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'heading_linkcolor', function( value ) {
		value.bind( function( newval ) {
			$('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a').css('color', newval );
		} );
	} );

	wp.customize( 'headings_weight', function( value ) {
		value.bind( function( newval ) {
			$('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1, h2, h3, h4, h5, h6, .site-description').css('font-weight', newval );
		} );
	} );

	wp.customize( 'primary_color', function( value ) {
		value.bind( function( newval ) {
			$('body, input, textarea').css('color', newval );
		} );
	} );

	wp.customize( 'sheet_color', function( value ) {
		value.bind( function( newval ) {
			$('.tlo, input, textarea, #menuline ul.sub-menu').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'tagline_color', function( value ) {
		value.bind( function( newval ) {
			$('input, textarea, .wp-editor-area, #menuline ul.sub-menu, #menuline nav ul, .menu-item-has-children').css('border-color', newval );
			$('.postline, footer.postline a, .archive-title, .format-status .postcontent, .format-quote .postcontent .quote, .fa-quote-left, .reply, .reply a, .comment-meta a').css('color', newval );
		} );
	} );

	wp.customize( 'headings_font', function( value ) {
		value.bind( function( newval ) {
			$('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1, h2, h3, h4, h5, h6').css('font-family', newval );
		} );
	} );

	wp.customize( 'body_font', function( value ) {
		value.bind( function( newval ) {
			$('body, .site-description').css('font-family', newval );
		} );
	} );
	
} )( jQuery );