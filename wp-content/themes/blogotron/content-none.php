<?php
/**
 * The template for displaying if no content.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
	<article id="post-0" class="post no-results not-found">
		<header class="post-header">
			<h1 class="post-title"><?php _e( 'Nothing found', 'blogotron' ); ?></h1><!-- .post-title -->
		</header><!-- .post-header -->
		<div class="post-content">
			<p><?php _e( 'Sorry, but your search returned no results. Try to change your search and repeat again.', 'blogotron' ); ?></p>
			<p><?php get_search_form(); ?></p>
		</div><!-- .post-content -->
	</article><!-- .post -->