<?php
/**
 * The template for displaying 404 page (Not Found).
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
get_header(); ?>
	<div id="content" role="main">
		<h1 class="error-404">
			<span><?php _e( 'Page Not Found', 'blogotron' ); ?></span>
		</h1><!-- .error-404 -->
		<article id="post-0" class="post no-results not-found">
			<header class="post-header">
				<h1 class="post-title"><?php _e( 'Error 404', 'blogotron' ); ?></h1>
			</header><!-- .post-header -->
			<div class="post-content">
				<p><?php _e( 'Something has gone wrong? Try to use the search.', 'blogotron' ); ?></p>
				<p><?php get_search_form(); ?></p>
			</div><!-- .post-content -->
		</article><!-- .post -->
	</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>