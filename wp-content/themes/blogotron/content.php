<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.40
 */
global $wp_query; 
$count = $wp_query->current_post + 1; 
?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header class="post-header">
			<h1 class="post-title">
				<?php if ( is_sticky() ) : ?>
					<img class="sticky-ico" src="<?php echo get_template_directory_uri(); ?>/images/sticky-ico.png" alt="<?php _e( 'Sticky post', 'blogotron' ); ?>" title="<?php _e( 'Sticky post', 'blogotron' ); ?>">
				<?php endif; // if ( is_sticky() )
				if ( is_single() ) :
					the_title();
				else : // if ( is_single() ) ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php endif; // if ( is_single() ) ?>
			</h1><!-- .post-title -->
		</header><!-- .post-header -->
		<div class="post-meta">
			<?php _e( 'Publicado el', 'blogotron' ); ?> <a href="<?php the_permalink(); ?>"><?php the_time( 'j F, Y' ); ?></a>
			<?php if ( has_category() ) :
				printf( '%s ', __( 'en', 'blogotron' ) ) . the_category( ', ' );
			endif; // if ( has_category() )
			edit_post_link( __( '[Edit]', 'blogotron' ), ' ' ); ?>
		</div><!-- .post-meta -->
		<div class="post-content">
			<?php if ( is_search() ) :
				the_excerpt();
			else : // if ( is_search() )
				if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail-wrapper">
						<?php the_post_thumbnail( 'post-featured-image' );
						do_action( 'blogotron_the_thumbnail_caption' ); ?>
					</div><!-- .thumbnail-wrapper -->
				<?php endif; // if ( has_post_thumbnail() )
				the_content( __( 'Leer más... &raquo;', 'blogotron' ) );
				wp_link_pages( array( 'before' => '<nav class="nav-post-page">' . __( 'Pages:', 'blogotron' ), 'after' => '</nav><!-- .nav-post-page -->' ) );
			endif; // if ( is_search() ) ?>
		</div><!-- .post-content -->
		<?php if ( is_home() || is_front_page() || is_search() || is_archive() ) : ?>
			<footer class="post-footer">
				<?php if ( $count > 1 || comments_open() ) : ?>
					<div class="post-bottom">
						<?php if ( $count > 1 ) : ?>
							<a class="scroll-top" href="#" title="Scroll to top"><?php printf( __( '[Top]', 'blogotron' ) ); ?></a>
						<?php endif; // if ( $count > 1 )
						if ( comments_open() ) : ?>
							<div class="comments-info"><?php comments_popup_link( __( '0 comments', 'blogotron' ) . ' &#187;', __( '1 comment', 'blogotron' ) . ' &#187;', '% ' . __( 'comments', 'blogotron' ) . ' &#187;' ); ?></div>
						<?php endif; // if ( comments_open() ) ?>
					</div><!-- .post-bottom -->
				<?php endif; // if ( $count > 1 || comments_open() ) ?>
			</footer><!-- .post-footer -->
		<?php endif; // if ( is_home() || is_front_page() || is_search() || is_archive() )
		if ( has_tag() ) : ?>
			<div class="post-tags">
				<?php the_tags( __( 'Tags: ', 'blogotron' ), ', ', '<br />' ); ?>
			</div><!-- .post-tags -->
		<?php endif; // if ( has_tag() ) ?>
	</article><!-- .post -->
