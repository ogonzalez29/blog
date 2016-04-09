<?php
/**
 * The template used for displaying page content in page.php
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
global $wp_query; 
$count = $wp_query->current_post + 1; 
?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header class="post-header">
			<h1 class="post-title">
				<?php if ( is_page() ) :
					the_title();
				else : // if ( is_page() ) ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php endif; // if ( is_page() ) ?>
			</h1><!-- .post-header -->
		</header><!-- .post-header -->
		<?php if ( current_user_can( 'edit_post', get_the_id() ) ) : ?>
			<div class="post-meta">
				<?php edit_post_link( __( '[Edit]', 'blogotron' ) ); ?>
			</div><!-- .post-meta -->
		<?php endif; // if ( current_user_can( 'edit_post', get_the_id() ) ) ?>
		<div class="post-content">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="thumbnail-wrapper">	
					<?php the_post_thumbnail( 'post-featured-image' );
					do_action( 'blogotron_the_thumbnail_caption' ); ?>
				</div><!-- .thumbnail-wrapper -->
			<?php endif; // if ( has_post_thumbnail() )
			the_content();
			wp_link_pages( array( 'before' => '<nav class="nav-post-page">' . __( 'Pages:', 'blogotron' ), 'after' => '</nav><!-- .nav-post-page -->' ) ); ?>
		</div><!-- .post-content -->
		<?php if ( ! is_page() ) : ?>
			<footer class="post-footer">
				<?php if ( $count > 1 || comments_open() ) : ?>
					<div class="post-bottom">
						<?php if ( $count > 1 ) : ?>
							<a class="scroll-top" href="#" title="Scroll to top"><?php printf( __( '[Top]', 'blogotron' ) ); ?></a>
						<?php endif; // if ( $count > 1 )
						if ( comments_open() ) : ?>
							<div class="comments-info">
								<?php comments_popup_link( __( '0 comments', 'blogotron' ) . ' &#187;', __( '1 comment', 'blogotron' ) . ' &#187;', '% ' . __( 'comments', 'blogotron' ) . ' &#187;' ); ?>
							</div><!-- .comments-info -->
						<?php endif; // if ( comments_open() ) ?>
					</div><!-- .post-bottom -->
				<?php endif; // if ( $count > 1 || comments_open() ) ?>
			</footer><!-- .post-footer -->
		<?php endif; // if ( ! is_page() ) ?>
	</article><!-- .post -->
