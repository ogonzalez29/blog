<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
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
			do_action( 'blogotron_page_nav' );
		else : // if ( have_posts() )
			get_template_part( 'content', 'none' );
		endif; // if ( have_posts() ) ?>
	</div><!-- #content -->
<?php get_sidebar();
get_footer(); ?>