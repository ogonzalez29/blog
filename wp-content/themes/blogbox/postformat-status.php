<?php
/**
 * blogbox Post Format Status
 *
 * The Status Post Format is a short status update, similar to a Twitter status update.
 * Included in this format is a time stamp, author avatar and a author name. Comments are 
 * permitted. 
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogbox_options;

$display_post_icon = $blogbox_options['bB_use_post_format_icons'];
?>
<div class="status-entry">
	<?php if ( $display_post_icon == 1 ) {
		echo '<span class="post-icon"><i class="fa fa-bullhorn" title="Status"></i></span>';
	} ?>
	<span class="timestamp"><?php the_time(get_option('date_format')); ?></span>
	<?php if ( comments_open()) {
		$post_comments = get_comments( array ( 'type' => 'comment', 'post_id' => $post->ID )); ?>
		<span class="comments"><a href="<?php comments_link(); ?>"><i class="fa fa-comment" title="Comments"></i>&nbsp;<?php echo count($post_comments); ?></a></span>
	<?php } ?>
	<div class="clearfix"></div>
	<?php
		$has_valid_avatar = blogbox_validate_gravatar(get_the_author_meta('user_email'));
		if ( $has_valid_avatar == 1 ) echo get_avatar( get_the_author_meta('ID'), 50 );
	?>
	<?php the_content(esc_html__('Read more','blogbox')); ?>
	<span class="author"><?php the_author_posts_link(); ?></span>
</div>

<div class="clearfix"></div>
		
<?php blogbox_post_metabottom('status') ?>

<div class="clearfix"></div>