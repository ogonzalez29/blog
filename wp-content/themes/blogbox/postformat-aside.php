<?php
/**
 * blogbox Post Format Aside
 *
 * The Aside Post Format is typically styled without a title. Similar to a Facebook note update.
 * In my case I have excluded all links, meta (except author), and the title. Only content is shown.
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
<br/>
<div class="aside-entry">
	<?php 	
		if ( $display_post_icon == 1 ) {
			echo '<span class="post-icon"><i class="fa fa-info-circle" title="Aside"></i></span>';
		}
	?>
	<?php the_content(esc_html__('Read more','blogbox')); ?>
	<span class="author"><?php the_author_posts_link(); ?></span>
</div>

<div class="clearfix"></div>
			
<?php blogbox_post_metabottom('aside') ?>
	
<div class="clearfix"></div>