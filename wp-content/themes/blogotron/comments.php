<?php
/**
 * The comments template
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 *
 * Do not show comments if current post is protected by a password and the visitor has not yet
 * entered the password
 */
if ( post_password_required() )
	return;
?>
	<h4 class="comments-counter">
		<?php if ( 'open' == $post->comment_status ) :
			comments_number( __( '0 comments:', 'blogotron' ), __( '1 comment:', 'blogotron' ), '% ' . __( 'comments:', 'blogotron' ) );
		else: // if ( 'open' == $post->comment_status )
			_e( 'Comments are closed.', 'blogotron' );
		endif; // if ( 'open' == $post->comment_status ) ?>
	</h4><!-- .comments-counter -->
	<?php if ( have_comments() ) : ?>
		<div id="comments" class="comments-container">
			<ol class="comment-list">
				<?php wp_list_comments( array( 'style' => 'ol', 'callback' => 'blogotron_get_comments' ) ); ?>
			</ol><!-- .comment-list -->
		</div><!-- #comments -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comments-nav" role="navigation">
				<div id="prev-comments"><?php previous_comments_link( __( '&laquo; Previous Comments', 'blogotron' ) ); ?></div>
				<div id="next-comments"><?php next_comments_link( __( 'Next Comments &raquo;', 'blogotron' ) ); ?></div>
			</nav><!-- #comments-nav -->
		<?php endif; // if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )
	endif; // if ( have_comments() )
comment_form(); ?>