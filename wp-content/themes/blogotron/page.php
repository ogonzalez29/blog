<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );
			endwhile; // while ( have_posts() ) : the_post();
			comments_template();
		endif; // if ( have_posts() ) ?>
	</div><!-- #content -->
<?php get_sidebar();
get_footer(); ?>