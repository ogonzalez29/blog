<?php
/**
 * The template for displaying all single posts.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile; // while ( have_posts() ) : the_post();
			do_action( 'blogotron_post_nav' );
			comments_template();
		endif; // if ( have_posts() ) ?>
	</div><!-- #content -->
<?php get_sidebar();
get_footer(); ?>