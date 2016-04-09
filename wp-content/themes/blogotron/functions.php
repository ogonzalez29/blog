<?php
/**
 * Blogotron functions and definitions.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 *
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 540;

// Sets up main settings.
function blogotron_setup() {
	// Makes Blogotron available for translation.
	load_theme_textdomain( 'blogotron', get_template_directory() . '/languages' );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// Adds support for a custom header image.
	add_theme_support( 'custom-header', 
		array(
			// Text color and image (empty to use none).
			'default-text-color'     => '333333',
			'default-image'          => '',
			// Set height and width, with a maximum value for the width.
			'height'                 => 128,
			'width'                  => 960,
			'max-width'              => 960,
			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => false,
			// Random image rotation off by default.
			'random-default'         => false,
			// Callbacks for styling the header and the admin preview.
			'wp-head-callback'       => 'blogotron_header_style',
			'admin-head-callback'    => 'blogotron_admin_header_style',
			'admin-preview-callback' => 'blogotron_admin_header_image'
		)
	);
	
	// This theme supports custom background color and image
	add_theme_support( 'custom-background', 
		array(
			'default-color' => 'f5f5f5'
		)
	);
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main', __( 'Main Menu', 'blogotron' ) );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-featured-image', 528, 9999 ); // Unlimited height, soft crop
	// Adds support Shortcodes in sidebar widgets.
	add_filter( 'widget_text', 'do_shortcode' );
}

// Registers main widget area area.
function blogotron_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'blogotron' ),
		'id'            => 'main-sidebar',
		'description'   => __( 'Widgets for the sidebar.', 'blogotron' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
}

// Enqueues scripts and styles for front-end.
function blogotron_scripts_styles() {
	// Loads our main stylesheet.
	wp_enqueue_style( 'blogotron-style', get_template_directory_uri() . '/style.css', false, NULL );
	//Adds main JavaScript.
	wp_enqueue_script( 'blogotron-core-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), NULL, false );
	// Enqueue JavaScript translated variables.
	wp_enqueue_script( 'blogotron-variables', blogotron_script_variables() );
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'blogotron-ie-style', get_template_directory_uri() . '/styles/ie.css', false, NULL );
	wp_style_add_data( 'blogotron-ie-style', 'conditional', 'lt IE 9' );
	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// Sets up translated text for variables JavaScript.
function blogotron_script_variables() { ?>
	<script type="text/javascript">
		var iFileBrowse = '<?php _e( 'Choose file...', 'blogotron' ); ?>',
			iFileNotSelected = '<?php _e( 'File is not selected.', 'blogotron' ); ?>'
			iSearchText = '<?php _e( 'Enter search keyword', 'blogotron' ); ?>'
	</script>
<?php }

// Style the header text displayed on the blog.
function blogotron_header_style() {
	$text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	// If we get this far, we have custom styles. ?>
	<style type="text/css" id="blogotron-header-css">
	<?php // Has the text been hidden?
	if ( ! display_header_text() ) : ?>
		#main-header .header-group {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php // If the user has set a custom color for the text, use that.
	else : ?>
		#main-header .site-title a,
		#main-header .site-description {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
<?php }

//Style the header image displayed on the Appearance > Header admin panel.
function blogotron_admin_header_style() { ?>
	<style type="text/css" id="blogotron-admin-header-css">
		@font-face {
			font-family: 'Open Sans';
			src: url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Regular.eot' );
			src: url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Regular.eot?#iefix' ) format( 'embedded-opentype' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Regular.woff' ) format( 'woff' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Regular.ttf' ) format( 'truetype' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Regular.svg#open_sansregular' ) format( 'svg' );
			font-weight: 400;
			font-style: normal;
		}
		
		@font-face {
			font-family: 'Open Sans';
			src: url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Bold.eot' );
			src: url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Bold.eot?#iefix' ) format( 'embedded-opentype' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Bold.woff' ) format( 'woff' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Bold.ttf' ) format( 'truetype' ),
				  url( '<?php echo get_template_directory_uri(); ?>/fonts/OpenSans-Bold.svg#open_sansbold' ) format( 'svg' );
			font-weight: 700;
			font-style: normal;
		}
		
		.appearance_page_custom-header #custom-header {
			position: relative;
			width: 960px;
			min-height: 128px;
			font-family: 'Open Sans';
		}
		
		#custom-header .group {
			position: relative;
			padding: 32px 10px 35px;
			z-index: 1;
		}
		
		#custom-header .header-image {
			position: absolute;
			max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
		}
		
		#custom-header .site-title,
		#custom-header .site-description {
			margin: 0;
			padding: 0;
			line-height: normal;
		}
		#custom-header .site-title {
			font-size: 26px;
			font-weight: 700;
		}
		
		#custom-header .site-title a {
			text-decoration: none;
			color: #333;
		}
		
		#custom-header .site-title a:hover {
			color: #999 !important;
		}
		
		#custom-header .site-description {
			font-size: 13px;
			font-weight: 400;
			color: #999;
			margin: 7px 0 0 0;
			word-spacing: 1px;
			text-shadow: none;
		}
	</style>
<?php }

// Output markup to be displayed on the Appearance > Header admin panel.
function blogotron_admin_header_image() { ?>
	<?php if ( get_header_image() ) : ?>
		<div id="custom-header" style="height: <?php echo get_custom_header()->height . 'px;'; ?>">
		<img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" />
	<?php else : ?>
		<div id="custom-header">
	<?php endif;
	if ( ! display_header_text() )
		$style = ' style="display:none;"';
	else
		$style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="group">
			<h1 class="site-title displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc" class="site-description displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }

// Customize pages title format
function blogotron_title( $title ) {
	global $paged, $page;
	$title = substr( $title, 2 );
	$separator = "|";
	if ( is_home() || is_front_page() ) {
		// Sets up the title for home page or front page.
		$title = get_bloginfo( 'name' ) . " $separator " . get_bloginfo( 'description', 'display' );
	} else if( is_single() ) {
		// Sets up the title for single posts.
		$title = get_bloginfo( 'name' ) . " $separator " . $title;
	} elseif( is_page() ) {
		// Sets up the title for all pages.
		$title = get_bloginfo( 'name' ) . " $separator " . $title;
	} elseif( is_archive() ) {
		// Sets up the title for archives pages.
		if ( is_day() ) {
			// Title for daily archives.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Archives for: ', 'blogotron' ) . get_the_date( 'd F Y' );
		} elseif ( is_month() ) {
			// Title for monthly archives.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Archives for: ', 'blogotron' ) . get_the_date( 'F Y' );
		} elseif ( is_year() ) {
			// Title for yearly archives.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Archives for: ', 'blogotron' ) . get_the_date( 'Y' );
		} else if( is_category() ) {
			// Sets up the title for category pages.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Category: ', 'blogotron' ) . single_cat_title( '', false );
		} elseif( is_tag() ) {
			// Sets up the title for tag pages.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Tag: ', 'blogotron' ) . single_tag_title( '', false );
		} else {
			// Default title for archives.
			$title = get_bloginfo( 'name' ) . " $separator " . __( 'Archives', 'blogotron' );
		}
	} elseif( is_search() ) {
		// Sets up the title for search pages.
		$title = get_bloginfo( 'name' ) . " $separator " . __( 'Search Results For: ', 'blogotron' ) . get_search_query();
	} elseif( is_404() ) {
		// Sets up the title for 404 page.
		$title = get_bloginfo( 'name' ) . " $separator " . __( 'Page Not Found', 'blogotron' );
	}
	// Display current page number in title.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $separator " . sprintf( __( 'Page %s', 'blogotron' ), max( $paged, $page ) );
	}
	return $title;
}

// Customize comments classes.
function blogotron_comment_class ( $classes ) {
	foreach( $classes as $key => $class ) {
		if ( strstr ( $class, 'bypostauthor' ) || strstr ( $class, 'byuser' ) || strstr ( $class, 'comment-author-' ) ) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}

// Show pages navigation.
function blogotron_page_nav() {
if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
	<nav id="page-nav">
		<div id="prev-page"><?php previous_posts_link( __( '&laquo; Previous Page' , 'blogotron' ) ); ?></div>
		<div id="next-page"><?php next_posts_link( __( 'Next Page &raquo;', 'blogotron' ) ); ?></div>
	</nav><!-- #page-nav -->
<?php endif;
}

// Show posts navigation.
function blogotron_post_nav() {
if( get_next_post() || get_previous_post() ): ?>
	<nav id="post-nav" role="navigation">
		<?php next_post_link( '<div id="next-post">%link</div>', '&laquo; %title' );
		previous_post_link( '<div id="prev-post">%link</div>', '%title &raquo;' ); ?>
	</nav><!-- #post-nav -->
<?php endif;
}

// Sets up title format on archive template.
function blogotron_archive_title() {
	if ( is_day() ) :
		printf( '<span>%1$s</span>%2$s', __( 'Archives for: ', 'blogotron' ), get_the_date( 'd F Y' ) );
	elseif ( is_month() ) :
		printf( '<span>%1$s</span>%2$s', __( 'Archives for: ', 'blogotron' ), get_the_date( 'F Y' ) );
	elseif ( is_year() ) :
		printf( '<span>%1$s</span>%2$s', __( 'Archives for: ', 'blogotron' ), get_the_date( 'Y' ) );
	elseif ( is_category() ) :
		printf( '<span>%1$s</span>%2$s', __( 'Category: ', 'blogotron' ), single_cat_title( '', false ) );
	elseif ( is_tag() ) :
		printf( '<span>%1$s</span>%2$s', __( 'Tag: ', 'blogotron' ), single_tag_title( '', false ) );
	 else :
		printf( '<span>%s</span>', __( 'Archives', 'blogotron' ) );
	endif;
}

// Show caption to featured images, if it exists.
function blogotron_the_thumbnail_caption() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment' ) );
	if ( ! empty( $thumbnail_image[0]->post_excerpt ) ) {
		printf( '<p class="wp-caption-text">%s</p>', $thumbnail_image[0]->post_excerpt );
	}
}

// Get attachment image, caption and metadata.
function blogotron_the_attachment() {
	global $post;
	$attachment = wp_prepare_attachment_for_js( get_the_id() ); ?>
	<div class="post-attachment">
		<img src="<?php echo $attachment[ 'url' ]; ?>" alt="<?php echo $attachment[ 'title' ]; ?>" title="<?php echo $attachment[ 'title' ]; ?>"/>
			<?php if( isset( $attachment[ 'caption' ] ) ) {
				// Show caption to attachment images, if it exists.
				printf( '<p class="wp-caption-text">%s</p>', $attachment[ 'caption' ] );
			} ?>
	</div>
	<div class="post-attachment-meta">
		<?php _e( 'Published', 'blogotron' ); ?> <?php echo $attachment[ 'dateFormatted' ]; ?> <?php _e( 'at', 'blogotron' ); ?> <a href="<?php echo $attachment[ 'url' ] ?>" title="Link to full-size image"><?php echo $attachment[ 'width' ]; ?> x <?php echo $attachment[ 'height' ]; ?></a> <?php _e( 'in', 'blogotron' ); ?> <a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Return to <?php echo get_the_title( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a>
		<?php edit_post_link( __( '[Edit]', 'blogotron' ), ' ' ); ?>
	</div>
<?php }

// Template for comments and pingbacks.
function blogotron_get_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'blogotron' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '[Edit]', 'blogotron' ) ); ?></p>
		<?php break;
		default :
		// Proceed with normal comments.
		global $post; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-author vcard">
				<?php echo get_avatar( $comment, 53 );
				printf( '<cite class="fn">%1$s %2$s</cite>',
					get_comment_author_link(),
					// If current post author this is comment author, mark nick by star.
					( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor" title="' . __( 'Post Author', 'blogotron' ) . '">*</span>' : '' );	?>
				<div class="comment-meta commentmetadata">
					<?php printf( '<a href="%1$s">%2$s</a> ',
					esc_url( get_comment_link( $comment->comment_ID ) ),
					// translators: 1: date, 2: time.
					sprintf( __( '%1$s at %2$s', 'blogotron' ), get_comment_date(), get_comment_time() ) );
					edit_comment_link( __( '[Edit]', 'blogotron' ) ); ?>
				</div><!-- .comment-meta -->
			</header><!-- .comment -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'blogotron' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
			</section><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'blogotron' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php break;
	endswitch; // $comment->comment_type
}

add_action( 'after_setup_theme', 'blogotron_setup' );
add_action( 'widgets_init', 'blogotron_sidebar' );
add_action( 'wp_enqueue_scripts', 'blogotron_scripts_styles' );
add_filter( 'wp_title', 'blogotron_title' );
add_filter( 'comment_class', 'blogotron_comment_class' );
add_action( 'blogotron_page_nav', 'blogotron_page_nav' );
add_action( 'blogotron_post_nav', 'blogotron_post_nav' );
add_action( 'blogotron_archive_title', 'blogotron_archive_title' );
add_action( 'blogotron_the_thumbnail_caption', 'blogotron_the_thumbnail_caption' );
add_action( 'blogotron_the_attachment', 'blogotron_the_attachment' );
