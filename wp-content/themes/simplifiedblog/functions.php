<?php
function simplifiedblog_widgets_init() {
	// Sidebar Widget
	// Location: the sidebar on mainpage
	register_sidebar(array('name'=>'Sidebar',
		'description'   => __( 'Main sidebar', 'simplifiedblog' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget-side %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Footer Widget
	// Location: at the end of the frontpage
	register_sidebar(array('name'=>'Footer',
		'description'   => __( 'Footer sidebar', 'simplifiedblog' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget-foot %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}	
add_action( 'widgets_init', 'simplifiedblog_widgets_init' );

if ( ! isset( $content_width ) ) {
	$content_width = 580;
}

if ( ! function_exists( 'simplifiedblog_scripts' ) ) :	
	function simplifiedblog_scripts() {
	
		global $wp_styles;
	
		// CSS
		wp_enqueue_style( 'simplifiedblog_main_css', get_stylesheet_uri() );
		
		// JavaScript
		wp_enqueue_script('simplifiedblog_menu_js', get_template_directory_uri() . "/bit/menus4.js", array( 'jquery' ));
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); }
		
		//Google fonts
		if (get_theme_mod('headings_font') == 'Open Sans'|get_theme_mod('body_font') == 'Open Sans') {
				wp_enqueue_style('open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,cyrillic' );
		} 
		
		if (get_theme_mod('headings_font') == 'Lobster'|get_theme_mod('body_font') == 'Lobster') {
				wp_enqueue_style('lobster', 'http://fonts.googleapis.com/css?family=Lobster&subset=cyrillic,latin' );
		}	
		
		if (get_theme_mod('headings_font') == 'Merriweather Sans'|get_theme_mod('body_font') == 'Merriweather Sans') {
				wp_enqueue_style('merri_sans', 'http://fonts.googleapis.com/css?family=Merriweather+Sans' );
		} 

		if (get_theme_mod('headings_font') == 'PT Sans'|get_theme_mod('body_font') == 'PT Sans') {
				wp_enqueue_style('ptsans', 'https://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' );
		} 
		
		if (get_theme_mod('headings_font') == 'Noto Serif'|get_theme_mod('body_font') == 'Noto Serif') {
				wp_enqueue_style('noto_serif', 'http://fonts.googleapis.com/css?family=Noto+Serif&subset=latin,cyrillic' );
		} 	
		
		if (get_theme_mod('headings_font') == 'Noto Sans'|get_theme_mod('body_font') == 'Noto Sans') {
				wp_enqueue_style('noto_sans', 'http://fonts.googleapis.com/css?family=Noto+Sans&subset=cyrillic,latin' );
		} 	
		
		if (get_theme_mod('headings_font') == 'Neucha'|get_theme_mod('body_font') == 'Neucha') {
				wp_enqueue_style('neucha', 'http://fonts.googleapis.com/css?family=Neucha&subset=latin,cyrillic' );
		} 
	}
endif;

add_action('wp_enqueue_scripts','simplifiedblog_scripts'); //script enqueue ends


if ( ! function_exists( 'simplifiedblog_setup' ) ) :
	function simplifiedblog_setup() {
		// Translations can be filed in the /lang/ directory
		load_theme_textdomain( 'simplifiedblog', get_template_directory() . '/lang/' );
		add_editor_style();	//editor styles
		add_theme_support( 'title-tag' );	
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'status',  'quote' ) ); 	//post formats support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') ); //enable html5
    	add_theme_support( 'custom-background', array('default-color' => 'eee',)); //built-in custom background
		//add image sizes
		add_image_size( 'simplifiedblog-list-thumb', 70, 70, true ); //thumbs for list view
		//menus
		register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simplifiedblog' ),
		) );	//one menu below the logo
	}
endif;

add_action( 'after_setup_theme', 'simplifiedblog_setup' ); //setup ends

// category id in body and post class
	function simplifiedblog_category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	}
add_filter('post_class', 'simplifiedblog_category_id_class');

// Copyright in footer
function simplifiedblog_footer(){
  $simplifiedblog_footer = get_theme_mod('footer_copyright');

  if(empty($simplifiedblog_footer)){
    echo 'Built on <a class="footer-credits" href="'.esc_url('http://poisonedcoffee.com/simplified/').'">Simplified theme</a>';
  } else {
    echo esc_attr( $simplifiedblog_footer );
  }
}

//Customizer stuff
require get_template_directory() . '/bit/customizer.php';
require get_template_directory() . '/bit/customizer-sanitize.php';
?>