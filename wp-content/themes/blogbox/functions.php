<?php
/*
 * Main functions file
 * 
 * This file is WordPress functions file, which which contains many of the functions 
 * for set up and operation of the theme
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* ========================================================================================================
 *                 Set Up
 * ======================================================================================================== */
 
/* ---- load files ---------------*/ 
require(get_template_directory() . '/library/blogbox_post_functions.php');
require(get_template_directory() . '/widgets/blogbox_social_widget.php');

/**
 * Customizer additions.
 */
require get_template_directory() . '/library/kha-customizer.php';

/* ---- Set content width --------*/
if(!isset( $content_width )) $content_width = 600;

function blogbox_theme_supports(){
	//enable translation
    load_theme_textdomain('blogbox', get_template_directory() . '/language');
	/* ------------editor-style -------------------- */
 	add_editor_style();
	// ADD POST FORMATS
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	//Custom Backgrounds 
	add_theme_support('custom-background');
	//custom header
	$bB_header_args = array(
		'flex-width' => true,
		'width' => 960,
		'flex-height' => true,
		'height' => 320,
		'header-text' => false,
		'default-image' => '',
		'uploads' => true,
	);
	add_theme_support('custom-header',$bB_header_args);
	//feeds
	add_theme_support('automatic-feed-links');
	//thumbnails
	add_theme_support('post-thumbnails');
	add_image_size('wide_thumbnail',180,120);
	add_theme_support('title-tag');
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}
add_action('after_setup_theme', 'blogbox_theme_supports');
  
/*
********* Set up Menu in Dashboard under Appearance **************
*/
function blogbox_register_menu() {
	register_nav_menu('primary-nav','Primary Menu');
}
add_action( 'init', 'blogbox_register_menu' );

/**
 * Register Side bars
 * Thanks to Justin Tadlock for the post on sidebars 
 * @link http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress
 */

if (!function_exists ( 'blogbox_register_sidebars' )) {
	function blogbox_register_sidebars() {
	// Sidebars and footer areas
    register_sidebar(array(
    					'id' => 'blogbox_default_sidebar',
    					'name'=>'Default-Sidebar',
    					'description' => esc_html__( 'Default sidebar', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_header_sidebar',
						'name'=>'Header-Sidebar',
						'description' => esc_html__( 'Placed in upper right hand corner of header', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_feature',
						'name'=>'Feature Area',
						'description' => esc_html__( 'Feature widgetized area', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_left_sidebar',
						'name'=>'Left-Sidebar',
						'description' => esc_html__( 'Sidebar for left side of page', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_left_sidebar_2',
						'name'=>'Left-Sidebar 2',
						'description' => esc_html__( 'Sidebar for left side page 2', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_right_sidebar',
						'name'=>'Right-Sidebar',
						'description' => esc_html__( 'Sidebar for right side of page', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_right_sidebar_2',
						'name'=>'Right-Sidebar 2',
						'description' => esc_html__( 'Sidebar for right side page 2', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_contact_sidebar',
						'name'=>'Contact-Sidebar',
						'description' => esc_html__( 'Sidebar for contact page', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_404_sidebar',
						'name'=>'Sidebar-404',
						'description' => esc_html__( 'Sidebar for 404 page', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);								
	register_sidebar(array(
						'id' => 'blogbox_footer_a',
						'name'=>'Footer A',
						'description' => esc_html__( 'Use this for the first footer column', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_footer_b',
						'name'=>'Footer B',
						'description' => esc_html__( 'Use this for the second footer column', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	register_sidebar(array(
						'id' => 'blogbox_footer_c',
						'name'=>'Footer C',
						'description' => esc_html__( 'Use this for the third footer column', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);				
	register_sidebar(array(
						'id' => 'blogbox_footer_d',
						'name'=>'Footer D',
						'description' => esc_html__( 'Use this for the fourth footer column', 'blogbox' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>'
						)
					);
	}

	add_action( 'widgets_init', 'blogbox_register_sidebars' );
}

/* ========================================================================================================
 *                 Scripts and Styles
 * ======================================================================================================== */
if ( !function_exists ('blogbox_load_js')){
	function blogbox_load_js() {
		if(!is_admin()){
			global $blogbox_options;

			wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/nivo-slider/jquery.nivo.slider.pack.js', array( 'jquery' ), '' );
			wp_enqueue_script( 'blogbox_custom', get_template_directory_uri() . '/js/doc_ready_scripts.js', array( 'jquery' ), '' );
			
			if ( $blogbox_options['bB_disable_fitvids'] != 1 ) {
				wp_enqueue_script( 'blogbox_fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '' );
				wp_enqueue_script( 'blogbox_fitvids_doc_ready', get_template_directory_uri() . '/js/fitvids-doc-ready.js', array( 'jquery' ), '' );
			}
			
			wp_enqueue_script( 'mobile_doc_ready', get_template_directory_uri() . '/js/mobile-doc-ready.js', array( 'jquery' ), '' );

			if ( $blogbox_options['bB_disable_colorbox'] != 1 ) {
				wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array( 'jquery' ), '' );
				wp_enqueue_script( 'colorbox_doc_ready', get_template_directory_uri() . '/js/colorbox/colorbox_doc_ready.js', array( 'jquery' ), '' );
			}
		}
	}
	add_action('init', 'blogbox_load_js');
}

if ( !function_exists ('blogbox_styles')) {
	function blogbox_styles() {
		global $blogbox_options;

		wp_enqueue_style( 'blogbox_main_style' , get_stylesheet_uri() ); 
		wp_enqueue_style( 'nivo_style',get_template_directory_uri() . '/js/nivo-slider/nivo-slider.css',array()  );
		wp_enqueue_style( 'nivo_style_theme',get_template_directory_uri() . '/js/nivo-slider/themes/default/default.css',array()  );
		wp_enqueue_style( 'superfish_style',get_template_directory_uri() . '/js/superfish/superfish.css',array()  );
		wp_enqueue_style( 'font_awesome_style',get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css',array()  );
		
		if ( $blogbox_options['bB_disable_colorbox'] != 1 ) {
			wp_register_style( 'colorbox_style',get_template_directory_uri() . '/js/colorbox/colorbox.css',array() );
			wp_enqueue_style( 'colorbox_style' );
		}
	}
	add_action('wp_enqueue_scripts', 'blogbox_styles');
}

if ( !function_exists ('blogbox_setup')){// load custom styles and fonts
	function blogbox_setup(){ 
         include( get_template_directory() . '/library/custom-fonts.php' );
         include( get_template_directory() . '/library/custom-styles.php' );
	 }
	add_action( 'wp_print_styles', 'blogbox_setup' );
}

/* ========================================================================================================
 *              Comments and Pingbacks
 * ======================================================================================================== */
/**
 * Javascript setup for threaded comments
 */
if ( !function_exists ('blogbox_enqueue_comment_reply_script')){//enque of enque reply script as per http://make.wordpress.org/themes/tag/guidelines/
	function blogbox_enqueue_comment_reply_script() {
		if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'blogbox_enqueue_comment_reply_script' );
}

if ( !function_exists ('blogbox_cleanPings')){// clean pingbacks and trackbacks
	function blogbox_cleanPings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		echo '<li>';
		echo comment_author_link().'&nbsp;&nbsp;';
		edit_comment_link('Edit');
		echo '</li><br/>';
	}
}

/* ========================================================================================================
 *              Filters
 * ======================================================================================================== */

 /* THE_EXCERT modified from http://wordpress.org/support/topic/dynamic-the_excerpt?replies=22 */
if ( !function_exists ('blogbox_the_excerpt_dynamic')){// Outputs an excerpt of variable length (in characters)
	function blogbox_the_excerpt_dynamic($length) { 
		
		global $post;
		$text = $post->post_excerpt;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]>', $text);
		}
		//I'm checking for my own conatct-pizazz plug-in here so that you can include the shortcodes I know about.
		if (function_exists('content_pizazz_list_func()')) {
			$text = do_shortcode($text);
		} else {
			strip_shortcodes($text);
		}
		
		$text = strip_tags($text,'<p></p><i></i><ol></ol><ul></ul><br/><br /><li></li>');
		
		$output = strlen($text);
		if($output > $length ) {
			$break_pos = strpos($text, ' ', $length);//find next space after desired length
			if($break_pos == '')$break_pos = $length;
			$text = substr($text,0,$break_pos);
			$text = $text.' <a href="'. get_permalink($post->ID) . '" > [...]</a>';
			$text = force_balance_tags($text);
		}
	
		echo apply_filters('the_excerpt',$text);
	}
}

if ( !function_exists ('blogbox_portfolio_titles')){//function to limit characters in portfolio titles
	function blogbox_portfolio_titles($content,$limit){
		$content = strip_tags($content);
		if(strlen($content) > $limit){
	    	$visible = substr($content, 0, $limit);
			$visible = $visible.'&nbsp;...';
		} else {
			$visible = $content;
		}
		//return $visible;
		echo strip_tags(apply_filters('the_excerpt',$visible));
	}
}

if ( !function_exists ('blogbox_portfolio_feature_description')){//function to limit characters in portfolio titles
	function blogbox_portfolio_feature_description($content,$limit){
		$content = do_shortcode($content);
		$content = strip_tags($content,'<p></p><i></i><ol></ol><ul></ul><br/><li></li>');
		if(strlen($content) > $limit){
			$break_pos = strpos($content, ' ', $limit);//find next space after desired length
			if($break_pos == '')$break_pos = $limit;
	    	$visible = substr($content, 0, $break_pos);
			$visible = $visible.'&nbsp;...';
			$visible = force_balance_tags($visible);
		} else {
			$visible = $content;
		}
		echo apply_filters('the_content',$visible);
	}
}

/* ========================================================================================================
 *              Miscelaneous
 * ======================================================================================================== */

/**
 * blogbox exclude categories
 *
 * This helper function is used in page-home-blog.php and index.php.
 * It returns an exclusion string for $wp-query, and is based on user settings to
 * eclude the Feature and Portfolio categories.
 * 
 * @return $exclude_categories
 */
if ( !function_exists ('blogbox_exclude_categories')){//Exclude categories helper
	function blogbox_exclude_categories () { 
	 	global $blogbox_options;
		$exclude_categories = "'";
		$feature_cat_ID = get_cat_ID('Feature');
		$portfolioA_cat_ID = get_cat_ID(sanitize_text_field($blogbox_options['bB_portfolioA_category']));
		$portfolioB_cat_ID = get_cat_ID(sanitize_text_field($blogbox_options['bB_portfolioB_category']));
		$portfolioC_cat_ID = get_cat_ID(sanitize_text_field($blogbox_options['bB_portfolioC_category']));
		$portfolioD_cat_ID = get_cat_ID(sanitize_text_field($blogbox_options['bB_portfolioD_category']));
		$portfolioE_cat_ID = get_cat_ID(sanitize_text_field($blogbox_options['bB_portfolioE_category']));
		if ($feature_cat_ID !== 0 && $blogbox_options['bB_showfeaturepost'] == 0) $exclude_categories = $exclude_categories . "-" . $feature_cat_ID;
		if ($portfolioA_cat_ID !== 0 && $blogbox_options['bB_showfeatureApost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioA_cat_ID;
		}
		elseif ($portfolioA_cat_ID !== 0 && $blogbox_options['bB_showfeatureApost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioA_cat_ID;
		}
		if ($portfolioB_cat_ID !== 0 && $blogbox_options['bB_showfeatureBpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioB_cat_ID;
		}
		elseif ($portfolioB_cat_ID !== 0 && $blogbox_options['bB_showfeatureBpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioB_cat_ID;
		}
		if ($portfolioC_cat_ID !== 0 && $blogbox_options['bB_showfeatureCpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioC_cat_ID;
		}
		elseif ($portfolioC_cat_ID !== 0 && $blogbox_options['bB_showfeatureCpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioC_cat_ID;
		}
		if ($portfolioD_cat_ID !== 0 && $blogbox_options['bB_showfeatureDpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioD_cat_ID;
		}
		elseif ($portfolioD_cat_ID !== 0 && $blogbox_options['bB_showfeatureDpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioD_cat_ID;
		}
		if ($portfolioE_cat_ID !==0 && $blogbox_options['bB_showfeatureEpost'] == 0 && $exclude_categories !== "'") {
			 $exclude_categories = $exclude_categories . ",-" . $portfolioE_cat_ID;
		}
		elseif ($portfolioE_cat_ID !== 0 && $blogbox_options['bB_showfeatureEpost'] == 0 && $exclude_categories == "'") {
			 $exclude_categories = $exclude_categories . "-" . $portfolioE_cat_ID;
		}
		$exclude_categories = $exclude_categories . "'"	;
	
		return $exclude_categories;
	}
}

if ( !function_exists ('blogbox_feature_slider')){    
	function blogbox_feature_slider() {
		global $blogbox_options;
		$feature_option = sanitize_text_field($blogbox_options['bB_home1feature_options']);
		$use_feature_widget_area = $blogbox_options['bB_use_feature_widget'];
		echo '<div id="feature-area">';
		if( $feature_option == "Full feature slides" ) {
			echo '<div class="slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="full-slider">';
		} elseif ( $feature_option == "Full feature slides-thumbnails" ) {
			echo '<div class="slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="full-slider-thumb">';
		} elseif ( $feature_option == "Full feature slides-nonav" ) {
			echo '<div class="slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="full-slider-nonav">';
		} elseif ( $feature_option == "Small slides and feature text box" ) {
			echo '<div class="half-slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="half-slider">';
		} elseif ( $feature_option == "Small slides and feature text box-thumbnails" ) {
			echo '<div class="half-slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="half-slider-thumb">';
		} elseif ( $feature_option == "Small slides and feature text box-nonav" ) {
			echo '<div class="half-slider-wrapper theme-default">';
				echo '<div class="ribbon"></div>';
				echo '<div id="half-slider-nonav">';
		} elseif ( $feature_option == "Small single image and feature text box" ) {
			$category_ID = get_cat_ID('Feature');
			global $post;
			$args = array('category'=>$category_ID,'numberposts'=>1);
			$custom_posts = get_posts($args);
			if ($category_ID !== 0 && $custom_posts){
				$post = $custom_posts[0];
				echo '<div id="single-image">';
					if (has_post_thumbnail()) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
						$image_url = $thumb[0];
						$title = get_post(get_post_thumbnail_id())->post_excerpt;
	 					echo '<a href="';
	 				 			the_permalink(); echo '"';
						 		echo ' title="';the_title_attribute(); echo '" >';
	 							echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
						echo '</a>';
					} else {
						echo '<div class="error">';
						echo '<h3>'.esc_html__('Error: There were no feature images found?','blogbox').'</h3>';
						echo '</div>';
						return;
					}
				echo '</div>';
			} else {
				echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="" title="" />';
			}
		} elseif ( $feature_option == "Full single image" ) {
			$category_ID = get_cat_ID('Feature');
			global $post;
			$args = array('category'=>$category_ID,'numberposts'=>1);
			$custom_posts = get_posts($args);
			if ($category_ID !== 0 && $custom_posts){
				$post = $custom_posts[0];
				echo '<div id="full-single-image">';
					if (has_post_thumbnail()) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
						$image_url = $thumb[0];
						$title = get_post(get_post_thumbnail_id())->post_excerpt;
	 					echo '<a href="';
	 				 			the_permalink(); echo '"';
						 		echo ' title="';the_title_attribute(); echo '" >';
	 							echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
						echo '</a>';
					} else {
						echo '<div class="error">';
						echo '<h3>'.esc_html__('Error: There were no feature images found?','blogbox').'</h3>';
						echo '</div>';
						return;
					}
				echo '</div>';
			} else {
				echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
			}
		}
		if ( $feature_option != 'Small single image and feature text box' && $feature_option != 'Full single image') {
					$category_ID = get_cat_ID('Feature');
					global $post;
					$args = array('category'=>$category_ID,'numberposts'=>999);
					$custom_posts = get_posts($args);
					if ($category_ID !== 0 && $custom_posts){
						foreach($custom_posts as $post) : setup_postdata($post);
							if (has_post_thumbnail()) {
								if ($feature_option == 'Small slides and feature text box-thumbnails' || $feature_option == 'Full feature slides-thumbnails')	{
									$thumb1 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'wide_thumbnail') ;
									$thumb_url = $thumb1[0];
								}
								
								$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full') ;
								$image_url = $thumb2[0];
								$title = get_post(get_post_thumbnail_id())->post_excerpt;
								
			 					echo '<a href="';
										the_permalink();
										echo '" title="';the_title_attribute(); echo '" >';
										
									if( $feature_option == "Full feature slides" || $feature_option == "Small slides and feature text box" ) {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
									} elseif( $feature_option == "Full feature slides-thumbnails" || $feature_option == "Small slides and feature text box-thumbnails" ) {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" data-thumb="'.$thumb_url.'" />';
									} else {
										echo '<img src="'.$image_url.'" title="'.$title.'" alt="'.$title.'" />';
									}
								echo '</a>';
							}
						endforeach;
					} else {
						if( $feature_option == "Full feature slides" || $feature_option == "Full feature slides-thumbnails" ) {
							echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
						} else {
							echo '<img src="'. get_template_directory_uri() . '/images/feature_slider/defaultslide.jpg" alt="Default Feature Slide" title="Default Feature Slide" />';
						}
					}
				echo '</div>';
			echo '</div>';
		}
		if( $feature_option == "Small slides and feature text box" || $feature_option == "Small slides and feature text box-thumbnails" || $feature_option == "Small single image and feature text box" || $feature_option == "Small slides and feature text box-nonav" ) {
			echo '<div id="leftfeature">';
				if( $use_feature_widget_area != 1 ) {
					echo "<h1>".esc_html( stripslashes($blogbox_options['bB_left_feature_title'] ) )."</h1>";
					echo "<span>".wp_kses_post(stripcslashes($blogbox_options['bB_left_feature_text']))."</span>";
				} else {
					if ( !dynamic_sidebar('Feature Area') ) :
					endif;
				}
			echo '</div>';
		}
		echo '</div>';
	}
}
			
if ( !function_exists ('blogbox_home_sections')){    
	function blogbox_home_sections() {
		global $blogbox_options;
		if ($blogbox_options['bB_home1section1_onoroff'] == 1) { ?>
			<div id="home1section1">
				<div id="slogan1">
					<h2><?php echo esc_html( stripslashes( $blogbox_options['bB_home1section1_slogan'] ) ); ?></h2>
				</div>
				<div id="homebuttonbox">
					<a class="button1" href="<?php if( $blogbox_options['bB_contact_link'] == "" ){ echo'#'; }else{ echo esc_url( $blogbox_options['bB_contact_link'] );}?>"><?php echo esc_html(stripslashes($blogbox_options['bB_contact_label'])); ?></a>
				</div>
			</div>
		<?php }
		if ($blogbox_options['bB_home1section2_onoroff'] == 1) { ?>
			<div id="homesection2">
				<div id="servicebox1" class="bB_column_1" onclick="window.location='<?php echo esc_url( $blogbox_options['bB_home1service1_link'] ); ?>'">
					<?php if( $blogbox_options['bB_home1service1_image'] !== "") echo '<span class="service1image"><img class="servicebox" src="'.esc_url($blogbox_options['bB_home1service1_image']).'" alt="Service 1 Image" /></span>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service1_title'] ) !== "" ) echo '<h4>'.esc_html( stripslashes( $blogbox_options['bB_home1service1_title'] ) ).'</h4>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service1_text'] ) !== "" ) echo '<p>'.wp_kses_post( stripslashes( $blogbox_options['bB_home1service1_text'] ) ).'</p>'; ?>
				</div>
				<div id="servicebox2" class="bB_column_1" onclick="window.location='<?php echo esc_url( $blogbox_options['bB_home1service2_link'] ); ?>'">
					<?php if( $blogbox_options['bB_home1service2_image'] !== "" ) echo '<span class="service2image"><img class="servicebox" src="'.esc_url( $blogbox_options['bB_home1service2_image'] ).'" alt="Service 2 Image" /></span>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service2_title'] ) !== "" ) echo '<h4>'.esc_html( stripslashes( $blogbox_options['bB_home1service2_title'] ) ).'</h4>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service2_text'] ) !== "" ) echo '<p>'.wp_kses_post( stripslashes( $blogbox_options['bB_home1service2_text'] ) ).'</p>'; ?>
				</div>
				<div id="servicebox3" class="bB_column_1" onclick="window.location='<?php echo esc_url($blogbox_options['bB_home1service3_link']); ?>'">
					<?php if( $blogbox_options['bB_home1service3_image'] !== "") echo '<span class="service3image"><img class="servicebox" src="'.esc_url( $blogbox_options['bB_home1service3_image'] ).'" alt="Service 3 Image" /></span>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service3_title'] ) !== "" ) echo '<h4>'.esc_textarea( stripslashes( $blogbox_options['bB_home1service3_title'] ) ).'</h4>'; ?>
					<?php if( stripslashes( $blogbox_options['bB_home1service3_text'] ) !== "" ) echo '<p>'.wp_kses_post( stripslashes( $blogbox_options['bB_home1service3_text'] ) ).'</p>'; ?>
				</div>
			</div>
		<?php }
		if ($blogbox_options['bB_home1section3_onoroff'] == 1) { ?>
			<div id="slogan2">
				<p class="slogan2line1"><?php echo esc_textarea( stripslashes( $blogbox_options['bB_home1section3_slogan'] ) ); ?></p>
				<p class="slogan2line2"><?php echo esc_textarea( stripslashes( $blogbox_options['bB_home1section3_subslogan'] ) ); ?></p>
			</div>
		<?php }
	}
}

/**
 * Header Menu Function
 * 
 * This function sets up the menu for the header. The menu can be set up left, right, 
 * or centered with and without a border
 * 
 * WordPress Functions - See the Codex
 * @uses has_nav_menu() @uses wp_nav_menu()
 */
 
if( !function_exists( 'blogbox_header_menu' ) ) {
	function blogbox_header_menu() {
		
		global $blogbox_options;
		
		if ( $blogbox_options['bB_menu_loc'] == 'right' ) {
			if(has_nav_menu('primary-nav')){
				wp_nav_menu(
					array(
						'theme_location' => 'primary-nav',
						'container_class' => 'main-nav',
						'container_id' => 'main-menu-right-noborder',
						'menu_class' => 'sf-menu',
						'menu_id' => 'main_menu_ul',
						'fallback_cb' => 'wp_page_menu'
					)
				);
			}
		} else if ( $blogbox_options['bB_menu_loc'] == 'left' ) {
			if(has_nav_menu('primary-nav')){
				wp_nav_menu(
					array(
						'theme_location' => 'primary-nav',
						'container_class' => 'main-nav',
						'container_id' => 'main-menu-left-noborder',
						'menu_class' => 'sf-menu',
						'menu_id' => 'main_menu_ul',
						'fallback_cb' => 'wp_page_menu'
					)
				);
			}			
		} else {
			If ( $blogbox_options['bB_menu_border'] == 'menu only' ) {
				if(has_nav_menu('primary-nav')){
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container_class' => 'main-nav',
							'container_id' => 'main-menu-center-border',
							'menu_class' => 'sf-menu',
							'menu_id' => 'main_menu_ul',
							'fallback_cb' => 'wp_page_menu'
						)
					);
				}
			} else {
				if(has_nav_menu('primary-nav')){
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container_class' => 'main-nav',
							'container_id' => 'main-menu-center-noborder',
							'menu_class' => 'sf-menu',
							'menu_id' => 'main_menu_ul',
							'fallback_cb' => 'wp_page_menu'
						)
					);
				}	
			}
		}
		
					
	}
}

//Add title attribute back to gallery images
function blogbox_image_titles($atts,$img) {
	$atts['title'] = trim(strip_tags( $img->post_excerpt ));
	return $atts;
}
add_filter('wp_get_attachment_image_attributes','blogbox_image_titles',10,2);