<?php
/**
 * The sidebar containing the main widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, these widgets will be shown by default.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
	<div id="sidebar" role="complementary">
		<?php if( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
			<aside id="search" class="widget">
				<?php get_search_form(); ?>
			</aside><!-- #search -->
			<aside id="recent-posts" class="widget">
				<h3 class="widget-title"><?php _e( 'recent posts', 'blogotron' ); ?></h3>
				<ul>
					<?php foreach( wp_get_recent_posts( array( 'numberposts' => '5', 'orderby' => 'post_date', 'post_status' => 'publish' ), ARRAY_A ) as $post ) : ?>
						<li><a href="<?php echo get_permalink( $post[ 'ID' ] ); ?>"><?php echo esc_attr( $post[ 'post_title' ] ); ?></a></li>
					<?php endforeach; // foreach( wp_get_recent_posts() ) ?>
				</ul><!-- ul -->
			</aside><!-- #recent-posts -->
			<aside id="recent-comments" class="widget">
				<h3 class="widget-title"><?php _e( 'recent comments', 'blogotron' ); ?></h3>
				<ul>
					<?php foreach( get_comments( array( 'status' => 'approve', 'number' => 5 ) ) as $comment ) : ?>
						<li><a href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author; ?></a> <?php _e( 'on', 'blogotron' ); ?> <a href="<?php echo get_permalink($comment->ID)."#comment-" . $comment->comment_ID ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a></li>
					<?php endforeach; // foreach( get_comments() ) ?>
				</ul><!-- ul -->
			</aside><!-- #recent-comments -->
			<aside id="archives" class="widget">
				<h3 class="widget-title"><?php _e( 'archives', 'blogotron' ); ?></h3>
				<ul><?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?></ul><!-- ul -->
			</aside><!-- #archives -->
			<aside id="categories" class="widget">
				<h3 class="widget-title"><?php _e( 'categories', 'blogotron' ); ?></h3>
				<ul><?php wp_list_categories( array( 'hierarchical' => 0, 'show_count' => 0, 'title_li' => '' ) ); ?></ul><!-- ul -->
			</aside><!-- #categories -->
		<?php endif // if( !dynamic_sidebar( 'main-sidebar' ) ) ?>
	</div><!-- #sidebar -->