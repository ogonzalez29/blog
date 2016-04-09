<?php
/**
 * blogbox Post Format Link
 *
 * The Link Post Format is basically the same as the Standard Post Format. The styling 
 * identifies the <a> tag and presents it in a more stylish way.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogbox_options;

$display_post_icon = $blogbox_options['bB_use_post_format_icons'];
?>	

<h2 class="post-title">		
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="fa fa-link" title="Link"></i></span>';
		} 
	?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	<?php if ( comments_open()) {
		$post_comments = get_comments( array ( 'type' => 'comment', 'post_id' => $post->ID )); ?>
		<span class="comments"><a href="<?php comments_link(); ?>"><i class="fa fa-comment" title="Comments"></i>&nbsp;<?php echo count($post_comments); ?></a></span>
	<?php } ?>
</h2>

<div class="clearfix"></div>

<?php blogbox_post_metatop(); ?>
	
<div class="clearfix"></div>

<?php  if (has_post_thumbnail()) {
	the_post_thumbnail(array(600,600));
} ?>

<div class="link-entry">
	<?php the_content(esc_html__('Read more','blogbox')); ?>
</div>

<div class="clearfix"></div>

<?php blogbox_post_metabottom('link') ?>

<div class="clearfix"></div>