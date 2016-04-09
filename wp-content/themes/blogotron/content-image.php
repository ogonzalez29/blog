<?php
/**
 * The template used for displaying image content in image.php
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header class="post-header">
			<h1 class="post-title">
				<?php if ( is_attachment() || is_single() ) :
					the_title();
				else : // if ( is_attachment() || is_single() ) ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php endif; // if ( is_attachment() || is_single() ) ?>
			</h1><!-- .post-title -->
		</header><!-- .post-header -->
		<?php if ( ! is_attachment() ) : ?>
			<div class="post-meta"><?php _e( 'Posted on', 'blogotron' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time( 'j F, Y' ); ?></a>
				<?php if ( has_category() ) :
					printf( '%s ', __( 'in', 'blogotron' ) ) . the_category( ', ' );
				endif; // if ( has_category() )
				edit_post_link( __( '[Edit]', 'blogoton' ), ' ' ); ?>
			</div><!-- .post-meta -->
		<?php endif; // if ( ! is_attachment() ) ?>
		<div class="post-content">
			<?php if ( is_search() && has_excerpt() ) :
				the_excerpt();
			else: // if ( is_search() && has_excerpt() )
				if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail-wrapper">
						<?php the_post_thumbnail( 'post-featured-image' );
						do_action( 'blogotron_the_thumbnail_caption' ); ?>
					</div><!-- .thumbnail-wrapper -->
				<?php endif; // if ( has_post_thumbnail() )
				if ( is_attachment() ) : ?>
					<nav id="image-nav" role="navigation">
						<div id="prev-image"><?php previous_image_link( false, __( '&laquo; Previous Image', 'blogotron' ) ); ?></div>
						<div id="next-image"><?php next_image_link( false, __( 'Next Image &raquo;', 'blogotron' ) ); ?></div>
					</nav><!-- #image-nav -->
					<?php do_action( 'blogotron_the_attachment' );
				endif; // if ( is_attachment() )
				the_content();
				wp_link_pages( array( 'before' => '<nav class="nav-post-page">' . __( 'Pages:', 'blogotron' ), 'after' => '</nav><!-- .nav-post-page -->' ) );
			endif; // if ( is_search() && has_excerpt() ) ?>
		</div><!-- .post-content -->
		<?php if ( has_tag() ) : ?>
			<footer class="post-footer">
				<div class="post-tags">
					<?php the_tags( __( 'Tags: ', 'blogotron' ), ', ', '<br />' ); ?>
				</div><!-- .post-tags -->
			</footer><!-- .post-footer -->
		<?php endif; // if ( has_tag() ) ?>
	</article><!-- .post -->
