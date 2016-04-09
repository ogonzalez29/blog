<?php
/**
 * The template for displaying image attachments.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" class="content-attachment" role="main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'image' );
			endwhile; // while ( have_posts() ) : the_post();
			comments_template();
		endif; // if ( have_posts() ) ?>
	</div><!-- #content -->
<?php get_footer(); ?>