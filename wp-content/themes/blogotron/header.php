<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-wrapper">
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-wrapper">
		<?php if ( get_header_image() ) : ?>
			<header id="main-header" role="banner" style="height: <?php echo get_custom_header()->height . 'px;'; ?>">
			<a href="<?php echo esc_url( 'http://servitalleres.com' ); ?>"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		<?php else : ?>
			<header id="main-header" role="banner">
		<?php endif; ?>
		<hgroup class="header-group">
			<h1 class="site-title"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup ><!-- .header-group -->
		</header><!-- #main-header -->
	<div id="nav-wrapper">
		<nav id="main-nav" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main', 'container_class' => 'main-menu', 'menu_class' => has_nav_menu( 'main' ) ? 'custom-main-menu' : 'main-menu' ) ); ?>
		</nav><!-- #main-nav -->
	</div><!-- #nav-wrapper -->
	<div id="content-wrapper">