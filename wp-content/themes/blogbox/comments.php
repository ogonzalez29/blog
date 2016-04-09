<?php
/**
 * Category Page template file
 *
 * This file delivers all the comments, pingbacks, trackbacks, and the 
 * comment form when called. It is the default file called in the comments_template() call
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
global $blogbox_options;
$use_post_icons = intval( $blogbox_options['bB_use_post_format_icons'] );

if( $use_post_icons == '1' ){ ?>
	<div class="comments-wrap-icons">
<?php }else{ ?>
	<div class="comments-wrap-no-icons">
<?php } 

	 if ( have_comments() ) { ?>

		<h4 class="comments-title">
			<?php 
				$number_comments = get_comments_number();
				If( $number_comments == 0 ){
					 esc_html_e( 'No Comments Yet' , 'blogbox');
				}elseif( $number_comments == 1 ){
					esc_html_e( '1 Comment' , 'blogbox') ;
				}else{
					echo $number_comments.' '.esc_html__( 'Comments' , 'blogbox');
				} 
			?>
		</h4>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
					'avatar_size'=> 50,
				) );
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="commentnav" role="navigation">
				<div class="left"><?php previous_comments_link( '<i class="fa fa-caret-left" ></i> ' . esc_html__( 'Older Comments', 'blogbox') ); ?></div>
				<div class="right"><?php next_comments_link( esc_html__( 'Newer Comments', 'blogbox' ) . ' <i class="fa  fa-caret-right" ></i>' ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php } // Check for comment navigation. ?>

	<?php } // have_comments() ?>
	
	<?php if ( comments_open() != true ) { ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blogbox' ); ?></p>
	<?php } ?>

	<?php comment_form(); ?>

</div><!-- #comments -->