<?php
/**
 * The template for displaying Search Results pages.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" role="main">
		<h1 class="search-result">
			<?php printf( '<span>%1$s</span>%2$s', __( 'Search Results For: ', 'blogotron' ), get_search_query() ); ?>
		</h1><!-- .search-result -->
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