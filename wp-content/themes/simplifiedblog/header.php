<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
    <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="index" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>   
</head>

<body <?php body_class(); ?>>

<div class="hide">
	<p><a href="#content"><?php _e( 'Skip to content', 'simplifiedblog' ); ?></a></p>
</div>

<div class="tlo">

<div id="logo"> 
   	
		<?php if (get_theme_mod( 'simplifiedblog_logo' ) !='') { ?>         
        <a href="<?php echo site_url(); ?>"><img id="mainlogo" src="<?php echo esc_url( get_theme_mod( 'simplifiedblog_logo' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
		<?php } else { ?>
		<h1 class="site-title"><a href="<?php echo site_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php } ?>	

<?php if (get_theme_mod( 'simplifiedblog_logo' ) =='') { ?>         
<?php $description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_attr( $description );?></p> 
<?php endif; } ?>      
             	
</div>
<div class="clear"></div>



<?php
if ( has_nav_menu( 'primary' ) ) {
/*Only if there is menu in primary location*/
?>
<div id="menutoggle"><a href="javascript:toggleByClass('hidder-99');"><span class="fa fa-ellipsis-h"></span></a></div>
<?php
  wp_nav_menu( array(
    'theme_location'    => 'primary',
    'depth'             => '2',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => 'menuline',
	'menu_class'      => 'menu hidder-99',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => '',
	'items_wrap'      => '<nav><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
	'walker'          => ''
  ));
};
  ?>