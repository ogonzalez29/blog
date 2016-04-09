<?php
/**
 * Custom fonts file
 *
 * This file is called by functions.php and loads the user selections for fonts
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php 
 /* Get the user choices for the theme options */
global $blogbox_options;

if($blogbox_options['bB_use_google_header'] && $blogbox_options['bB_use_google_header'] == true){
	$header_font = sanitize_text_field( $blogbox_options['bB_google_header_font'] );
	switch ($header_font) {
		case "'Cabin', Helvetica, Arial, sans-serif" :
           	wp_enqueue_style( 'google_cabin', '//fonts.googleapis.com/css?family=Cabin:400,400italic');
			break;
		case "'Raleway', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_raleway', '//fonts.googleapis.com/css?family=Raleway:100');
			break;
		case "'Allerta', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_allerta', '//fonts.googleapis.com/css?family=Allerta');
			break;
		case "'Arvo', Georgia, Times, serif" :
			wp_enqueue_style( 'google_arvo', '//fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic');
			break;
		case "'PT Sans', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_pt_sans', '//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic');
			break;
		case "'Molengo', Georgia, Times, serif" :
			wp_enqueue_style( 'google_molengo', '//fonts.googleapis.com/css?family=Molengo');
			break;
		case "'Lekton', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_lekton', '//fonts.googleapis.com/css?family=Lekton:400,400italic');
			break;
		case "'Droid Serif', Georgia, Times, serif" :
			wp_enqueue_style( 'google_droid_serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic');
			break;
		case "'Droid Sans', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_droid_sans', '//fonts.googleapis.com/css?family=Droid+Sans:400,700');
			break;
		case "'Corben', Georgia, Times, serif" :
			wp_enqueue_style( 'google_corben', '//fonts.googleapis.com/css?family=Corben');
			break;
		case "'Nobile', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_nobile', '//fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic');
			break;
		case "'Ubuntu', Helvetica, Arial, sans-serif" :
			wp_enqueue_style( 'google_ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:400,400italic');
			break;
		case "'Vollkorn', Georgia, Times, serif" :
			wp_enqueue_style( 'google_vollkorn', '//fonts.googleapis.com/css?family=Vollkorn:400,400italic');
			break;
	}
} else {
	$header_font = sanitize_text_field( $blogbox_options['bB_header_font'] );
}
if($blogbox_options['bB_use_google_body'] && $blogbox_options['bB_use_google_body'] == true){
	$body_font = sanitize_text_field( $blogbox_options['bB_google_body_font'] );
	if($blogbox_options['bB_google_header_font'] || $blogbox_options['bB_google_header_font'] !== $blogbox_options['bB_google_body_font'])
		switch ( $body_font ) {
			case "'Cabin', Helvetica, Arial, sans-serif" :
	           	wp_enqueue_style( 'google_cabin', '//fonts.googleapis.com/css?family=Cabin:400,400italic');
				break;
			case "'Raleway', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_raleway', '//fonts.googleapis.com/css?family=Raleway:100');
				break;
			case "'Allerta', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_allerta', '//fonts.googleapis.com/css?family=Allerta');
				break;
			case "'Arvo', Georgia, Times, serif" :
				wp_enqueue_style( 'google_arvo', '//fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic');
				break;
			case "'PT Sans', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_pt_sans', '//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic');
				break;
			case "'Molengo', Georgia, Times, serif" :
				wp_enqueue_style( 'google_molengo', '//fonts.googleapis.com/css?family=Molengo');
				break;
			case "'Lekton', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_lekton', '//fonts.googleapis.com/css?family=Lekton:400,400italic');
				break;
			case "'Droid Serif', Georgia, Times, serif" :
				wp_enqueue_style( 'google_droid_serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic');
				break;
			case "'Droid Sans', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_droid_sans', '//fonts.googleapis.com/css?family=Droid+Sans:400,700');
				break;
			case "'Corben', Georgia, Times, serif" :
				wp_enqueue_style( 'google_corben', '//fonts.googleapis.com/css?family=Corben');
				break;
			case "'Nobile', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_nobile', '//fonts.googleapis.com/css?family=Nobile:400,400italic,700,700italic');
				break;
			case "'Ubuntu', Helvetica, Arial, sans-serif" :
				wp_enqueue_style( 'google_ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:400,400italic');
				break;
			case "'Vollkorn', Georgia, Times, serif" :
				wp_enqueue_style( 'google_vollkorn', '//fonts.googleapis.com/css?family=Vollkorn:400,400italic');
				break;
		}
	} else {
		$body_font = sanitize_text_field( $blogbox_options['bB_body_font'] );
	}
?>
<style type="text/css" >
	body {font-size:<?php echo sanitize_text_field( $blogbox_options['bB_base_font_size'] ); ?>;}
	<?php if ( $header_font != "Default" ) { ?>
		h1, h2, h3, h4, h5, h6 {font-family:<?php echo $header_font; ?>;}
		#slogan1 h1 {font-family:<?php echo $header_font; ?>;}
		#slogan2 p.slogan2line1 {font-family:<?php echo $header_font; ?>;}
		#slogan2 p.slogan2line2 {font-family:<?php echo $header_font; ?>;}
		.listhead{font-family:<?php echo $header_font; ?>;}
		.main-nav {font-family:<?php echo $header_font; ?>;}
	<?php } ?>
	<?php if ($body_font != "Default" ) { ?>
		body {font-family:<?php echo $body_font; ?>;}
	<?php } ?>
</style>