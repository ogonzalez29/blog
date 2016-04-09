<?php
/**
 * The template for displaying Archive pages.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" role="main">
		<h1 class="archive-title"><?php do_action( 'blogotron_archive_title' ); ?></h1>
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