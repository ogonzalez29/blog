/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * 
 * @package   blogBox WordPress Theme 
 * @copyright Copyright (C) 2015, Kevin Archibald
 * @license	  http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author	  Kevin Archibald <www.kevinsspace.ca/contact/>
 * blogbox is distributed under the terms of the GNU GPL
 * 
 */
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	/* --------------- Copyright Text ------------------------------------- */
	//left
	wp.customize( 'theme_blogbox_options[bB_left_copyright_text]', function( value ) {
		value.bind( function( newval ) {
			$( '.copyright_c1' ).html( newval );
		} );
	} );
	//center
	wp.customize( 'theme_blogbox_options[bB_middle_copyright_text]', function( value ) {
		value.bind( function( newval ) {
			$( '.copyright_c2' ).html( newval );
		} );
	} );
	//right
	wp.customize( 'theme_blogbox_options[bB_right_copyright_text]', function( value ) {
		value.bind( function( newval ) {
			$( '.copyright_c3' ).html( newval );
		} );
	} );
	/* --------------- Background Colors ---------------------------------- */
	//outside background color
	wp.customize( 'theme_blogbox_options[bB_outside_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css('background-color', newval);
		} );
	} );
	//background gradient
	wp.customize( 'theme_blogbox_options[bB_select_gradient]', function( value ) {
		value.bind( function( newval ) {
			if ( newval == 'Dark Gradient'){
				$( 'body' ).css( 'background-image' , 'linear-gradient(to bottom, rgba(0,0,0,0) , rgba(0,0,0,0.2) 50% , rgba(0,0,0,0.3 ))' );
			} else if( newval == 'Light Gradient' ) {
				$( 'body' ).css( 'background-image' , 'linear-gradient(to bottom, rgba(255,255,255,0.3) , rgba(255,255,255,0.1) 50% , rgba(255,255,255,0))' );
			} else {
				$( 'body' ).css( 'background-image' , 'none' );
			}
		} );
	} );
	//header background color
	wp.customize( 'theme_blogbox_options[bB_header_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#header' ).css('background-color', newval);
		} );
	} );
	//header - top border color
	wp.customize( 'theme_blogbox_options[bB_header_top_border_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#header' ).css('border-top', '2px solid ' + newval);
		} );
	} );
	//header - bottom border color
	wp.customize( 'theme_blogbox_options[bB_header_bottom_border_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'nav' ).css('border-bottom', '2px solid ' + newval);
		} );
	} );
	//menu border color
	wp.customize( 'theme_blogbox_options[bB_menu_border_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.thin-border' ).css('border-top', '1px solid ' + newval);
			$( '#main-menu-center-border' ).css('border-top', '1px solid ' + newval);
			$( '#main-menu-center-border' ).css('border-bottom', '1px solid ' + newval);
		} );
	} );
	//menu background color
	wp.customize( 'theme_blogbox_options[bB_nav_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'nav' ).css('background-color', newval);
		} );
	} );
	//menu dropdown background color
	wp.customize( 'theme_blogbox_options[bB_nav_drop_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.sub-menu li,.sf-menu ul ul li' ).css('background-color', newval);
		} );
	} );
	//bB_nav_drop_background_hover_color, hover state to be reloaded
	//bB_nav_dropdown_arrows - won't work must be reloaded
	//feature area background color
	wp.customize( 'theme_blogbox_options[bB_feature_area_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#feature-area' ).css('background-color', newval);
		} );
	} );
	//main area background color
	wp.customize( 'theme_blogbox_options[bB_main_area_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'body #pagewrap,#widecolumn,#fullwidth,#sidebar' ).css('background-color', newval);
		} );
	} );
	//home page post area background color
	wp.customize( 'theme_blogbox_options[bB_home1_post_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#home1post' ).css('background-color', newval);
		} );
	} );
	//home page first slogan area background color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan1_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#home1section1' ).css('background-color', newval);
		} );
	} );
	//home page first slogan area button color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan1_button_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#home1section1 a.button1,#home1section1 a.button1:hover' ).css('background-color', newval);
		} );
	} );
	//home page second slogan area background color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan2_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#slogan2' ).css('background-color', newval);
		} );
	} );
	//footer background color
	wp.customize( 'theme_blogbox_options[bB_footer_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#footer' ).css('background-color', newval);
		} );
	} );
	//copyright background color
	wp.customize( 'theme_blogbox_options[bB_copyright_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#copyright' ).css('background-color', newval);
		} );
	} );
	/* ---------------------- Text Colors ------------------------------------------ */
	//header text color, some widget text colors
	wp.customize( 'theme_blogbox_options[bB_header_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#header,table#wp-calendar td#today,table#wp-calendar th' ).css('color', newval);
		} );
	} );
	//header link color
	wp.customize( 'theme_blogbox_options[bB_header_link_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#header a h1' ).css('color', newval);
		} );
	} );
	//bB_header_hover_color-reload
	//bB_nav_text_color
	wp.customize( 'theme_blogbox_options[bB_nav_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.sf-menu li a' ).css('color', newval);
		} );
	} );
	//bB_nav_text_hover_color-reload
	//bB_nav_drop_text_color
	wp.customize( 'theme_blogbox_options[bB_nav_drop_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.sub-menu li a' ).css('color', newval);
		} );
	} );
	//bB_nav_drop_hover_text_color-reload
	//bB_feature_text_color
	wp.customize( 'theme_blogbox_options[bB_feature_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#feature-area' ).css('color', newval);
		} );
	} );
	//bB_home1_slogan1_text_color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan1_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#home1section1' ).css('color', newval);
		} );
	} );
	//bB_home1_slogan1_button_text_color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan1_button_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'a.button1,a.button1:hover' ).css('color', newval );
		} );
	} );
	//bB_home1_slogan2_text_color
	wp.customize( 'theme_blogbox_options[bB_home1_slogan2_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#slogan2' ).css('color', newval);
		} );
	} );
	//bB_main_text_color
	wp.customize( 'theme_blogbox_options[bB_main_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( 'body #pagewrap,#homesection2 h1' ).css('color', newval);
		} );
	} );
	//bB_main_link_color
	wp.customize( 'theme_blogbox_options[bB_main_link_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#feature-area a,#widecolumn a,#widecolumn-right a,#fullwidth a,#fullwidth-home a,#fullwidth-blog a' ).css('color', newval);
		} );
	} );
	//bB_main_hover_color-reload
	//bB_footer_text_color
	wp.customize( 'theme_blogbox_options[bB_footer_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#footer,#footer h1' ).css('color', newval);
		} );
	} );
	//bB_footer_link_color
	wp.customize( 'theme_blogbox_options[bB_footer_link_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#footer a' ).css('color', newval);
		} );
	} );
	//bB_footer_hover_color
	//bB_copyright_text_color
	wp.customize( 'theme_blogbox_options[bB_copyright_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#copyright' ).css('color', newval);
		} );
	} );
	//bB_copyright_link_color
	wp.customize( 'theme_blogbox_options[bB_copyright_link_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#copyright a' ).css('color', newval);
		} );
	} );
	//bB_copyright_hover_color
	
	/* ---------------------- Post Formats ----------------------------------------- */
	//bB_aside_background_top - not done, too difficult a script
	//bB_aside_background_bottom - not done, too difficult a script
	//bB_aside_text_color
	wp.customize( 'theme_blogbox_options[bB_aside_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.aside-entry' ).css('color', newval);
		} );
	} );
	//bB_aside_author_color
	wp.customize( 'theme_blogbox_options[bB_aside_author_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#pagewrap .aside-entry .author a' ).css('color', newval);
		} );
	} );
	//bB_aside_author_hover_color-reload
	//bB_audio_background_color
	wp.customize( 'theme_blogbox_options[bB_audio_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.audio-entry .audio-wrap' ).css('background-color', newval);
		} );
	} );
	//bB_audio_text_color
	wp.customize( 'theme_blogbox_options[bB_audio_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.audio-entry .audio-wrap' ).css('color', newval);
		} );
	} );
	//bB_chat_background_color
	wp.customize( 'theme_blogbox_options[bB_chat_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.chat-entry' ).css('background-color', newval);
		} );
	} );
	//bB_link_post_background_color
	wp.customize( 'theme_blogbox_options[bB_link_post_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.link-entry a' ).css('background-color', newval);
		} );
	} );
	//bB_link_post_text_color
	wp.customize( 'theme_blogbox_options[bB_link_post_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.link-entry a' ).css('color', newval);
			$( '.link-entry a' ).css('border', '2px solid ' + newval);
		} );
	} );
	//bB_link_post_hover_text_color-reload
	//bB_status_background_color
	wp.customize( 'theme_blogbox_options[bB_status_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.status-entry' ).css('background-color', newval);
		} );
	} );
	//bB_status_text_color
	wp.customize( 'theme_blogbox_options[bB_status_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.status-entry' ).css('color', newval);
		} );
	} );
	//bB_status_meta_color
	wp.customize( 'theme_blogbox_options[bB_status_meta_color]', function( value ) {
		value.bind( function( newval ) {
			$( '#pagewrap .status-entry .timestamp,#pagewrap .status-entry .comments,#pagewrap .status-entry a' ).css('color', newval);
		} );
	} );
	//bB_quote_background_color
	wp.customize( 'theme_blogbox_options[bB_quote_background_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.quote-entry blockquote' ).css('background-color', newval);
		} );
	} );
	//bB_quote_border_color
	wp.customize( 'theme_blogbox_options[bB_quote_border_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.quote-entry blockquote' ).css('border','5px solid' + newval);
		} );
	} );
	//bB_quote_text_color
	wp.customize( 'theme_blogbox_options[bB_quote_text_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.quote-entry blockquote,.quote-entry blockquote a' ).css('color', newval);
		} );
	} );
	/* ---------------------- Fonts ------------------------------------------------ */
	//bB_base_font_size
	wp.customize( 'theme_blogbox_options[bB_base_font_size]', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css('font-size', newval);
		} );
	} );
	//bB_header_font
	wp.customize( 'theme_blogbox_options[bB_header_font]', function( value ) {
		value.bind( function( newval ) {
			if ( newval != 'Default') {
				$( 'h1, h2, h3, h4, h5, h6,#slogan1 h1,#slogan2 p.slogan2line1,#slogan2 p.slogan2line2,.listhead,.main-nav' ).css('font-family', newval);
			} else {
				$( 'h1, h2, h3, h4, h5, h6,#slogan1 h1,#slogan2 p.slogan2line1,#slogan2 p.slogan2line2,.listhead,.main-nav' ).css('font-family', 'auto');
			}
		} );
	} );
	//bB_use_google_header - not used
	//bB_google_header_font
	wp.customize( 'theme_blogbox_options[bB_google_header_font]', function( value ) {
		value.bind( function( newval ) {
			if( newval == "'Allerta', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Arvo', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Cabin', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Corben', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Corben' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Droid Sans', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Droid Serif', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Lekton', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Lekton:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Molengo', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Nobile', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'PT Sans', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Raleway', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Ubuntu', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Vollkorn', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Vollkorn:400,400italic' rel='stylesheet' type='text/css'>");
			}	
			$( 'h1, h2, h3, h4, h5, h6,#slogan1 h1,#slogan2 p.slogan2line1,#slogan2 p.slogan2line2,.listhead,.main-nav' ).css('font-family', newval);
		} );
	} );
	//bB_body_font
	wp.customize( 'theme_blogbox_options[bB_body_font]', function( value ) {
		value.bind( function( newval ) {
			if ( newval != 'Default') {
				$( 'body' ).css('font-family', newval);
			} else {
				$( 'body' ).css('font-family', 'auto');
			}
		} );
	} );
	//bB_use_google_body - not used
	//bB_google_body_font
	wp.customize( 'theme_blogbox_options[bB_google_body_font]', function( value ) {
		value.bind( function( newval ) {
			if( newval == "'Allerta', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Arvo', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Cabin', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Corben', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Corben' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Droid Sans', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Droid Serif', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Lekton', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Lekton:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Molengo', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Nobile', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'PT Sans', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Raleway', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Ubuntu', Helvetica, Arial, sans-serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,400italic' rel='stylesheet' type='text/css'>");
			} else if( newval == "'Vollkorn', Georgia, Times, serif" ) {
				$("head").append("<link href='https://fonts.googleapis.com/css?family=Vollkorn:400,400italic' rel='stylesheet' type='text/css'>");
			}	
			$( 'body' ).css('font-family', newval);
		} );
	} );
	/* ---------------------- Home Page ------------------------------------------------ */
	/* --- Feature Area --- */
	//bB_left_feature_title
	wp.customize( 'theme_blogbox_options[bB_left_feature_title]', function( value ) {
		var useWidget = wp.customize('theme_blogbox_options[bB_use_feature_widget]').get();
		if( useWidget == false ){
			value.bind( function( to ) {
				$( '#leftfeature h1' ).text( to );
			} );
		}
	} );
	//bB_left_feature_text
	wp.customize( 'theme_blogbox_options[bB_left_feature_text]', function( value ) {
		var useWidget = wp.customize('theme_blogbox_options[bB_use_feature_widget]').get();
		if( useWidget == false ){
			value.bind( function( newval ) {
				$( '#leftfeature span' ).html( newval );
			} );
		}
	} );
	/* --- Home Section 1 --- */
	//bB_home1section1_onoroff - refresh but used below
	//bB_home1section1_slogan
	wp.customize( 'theme_blogbox_options[bB_home1section1_slogan]', function( value ) {
		var enableSectionOne = wp.customize('theme_blogbox_options[bB_home1section1_onoroff]').get();
		if( enableSectionOne == true ){
			value.bind( function( to ) {
				$( '#slogan1 h2' ).text( to );
			} );
		}
	} );
	//bB_contact_link - refresh
	//bB_contact_label
	wp.customize( 'theme_blogbox_options[bB_contact_label]', function( value ) {
		var enableSectionOne = wp.customize('theme_blogbox_options[bB_home1section1_onoroff]').get();
		if( enableSectionOne == true ){
			value.bind( function( to ) {
				$( '#homebuttonbox a' ).text( to );
			} );
		}
	} );
	/* --- Home Section 2 --- */
	//bB_home1section2_onoroff - refresh
	//bB_home1service1_image
	wp.customize( 'theme_blogbox_options[bB_home1service1_image]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '.service1image' ).html( '<img class="servicebox" src="' + newval + '" alt="Service 1 Image" />' );
				} else {
					$( '.service1image' ).html( '' );
				}
			} );
		}
	} );
	//bB_home1service1_title
	wp.customize( 'theme_blogbox_options[bB_home1service1_title]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( to ) {
				$( '#servicebox1 h4' ).text( to );
			} );
		}
	} );
	//bB_home1service1_link - refresh
	//bB_home1service1_text
	wp.customize( 'theme_blogbox_options[bB_home1service1_text]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '#servicebox1 p' ).html( newval );
				} else {
					$( '#servicebox1 p' ).html( '' );
				}
			} );
		}
	} );
	//bB_home1service2_image
	wp.customize( 'theme_blogbox_options[bB_home1service2_image]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '.service2image' ).html( '<img class="servicebox" src="' + newval + '" alt="Service 2 Image" />' );
				} else {
					$( '.service2image' ).html( '' );
				}
			} );
		}
	} );
	//bB_home1service2_title
	wp.customize( 'theme_blogbox_options[bB_home1service2_title]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( to ) {
				$( '#servicebox2 h4' ).text( to );
			} );
		}
	} );
	//bB_home1service2_link - refresh
	//bB_home1service2_text
	wp.customize( 'theme_blogbox_options[bB_home1service2_text]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '#servicebox2 p' ).html( newval );
				} else {
					$( '#servicebox2 p' ).html( '' );
				}
			} );
		}
	} );
	//bB_home1service3_image
	wp.customize( 'theme_blogbox_options[bB_home1service3_image]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '.service3image' ).html( '<img class="servicebox" src="' + newval + '" alt="Service 3 Image" />' );
				} else {
					$( '.service3image' ).html( '' );
				}
			} );
		}
	} );
	//bB_home1service3_title
	wp.customize( 'theme_blogbox_options[bB_home1service3_title]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( to ) {
				$( '#servicebox3 h4' ).text( to );
			} );
		}
	} );
	//bB_home1service3_link - refresh
	//bB_home1service3_text
	wp.customize( 'theme_blogbox_options[bB_home1service3_text]', function( value ) {
		var enableSectionTwo = wp.customize('theme_blogbox_options[bB_home1section2_onoroff]').get();
		if( enableSectionTwo == true ){
			value.bind( function( newval ) {
				if(newval != ''){
					$( '#servicebox3 p' ).html( newval );
				} else {
					$( '#servicebox3 p' ).html( '' );
				}
			} );
		}
	} );
	/* --- Home Section 3 --- */
	//bB_home1section3_onoroff
	//bB_home1section3_slogan
	wp.customize( 'theme_blogbox_options[bB_home1section3_slogan]', function( value ) {
		var enableSectionThree = wp.customize('theme_blogbox_options[bB_home1section3_onoroff]').get();
		if( enableSectionThree == true ){
			value.bind( function( to ) {
				$( '.slogan2line1' ).text( to );
			} );
		}
	} );
	//bB_home1section3_subslogan
	wp.customize( 'theme_blogbox_options[bB_home1section3_subslogan]', function( value ) {
		var enableSectionThree = wp.customize('theme_blogbox_options[bB_home1section3_onoroff]').get();
		if( enableSectionThree == true ){
			value.bind( function( to ) {
				$( '.slogan2line2' ).text( to );
			} );
		}
	} );
	
} )( jQuery );