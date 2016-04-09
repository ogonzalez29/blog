<?php
/**
 * Category Page template file
 *
 * This file is the Category Page template file, which is output whenever
 * a Category Link link is clicked
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>
<div id="widecolumn">
	<h1 class="listhead"><?php esc_html_e('Post by Category : ','blogbox'); ?><?php single_cat_title(); ?></h1>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php blogbox_post_format(); ?>
		</div>
		<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) {
 				echo '<div class="postpagenav">';
 					wp_pagenavi();
				echo '</div>';
			} else { ?>
			<div class="postpagenav">
				<div class="left"><?php next_posts_link('&lt;&lt; older entries'); ?></div>
				<div class="right"><?php previous_posts_link(' newer entries &gt;&gt;'); ?></div>
			<br/>
			</div>
			<?php } ?>
	<?php else : ?>
		<!-- search found nothing -->
		<div class="nosearch">
			<h2><?php esc_html_e('Sorry about that but we didn\'t find anything posted by that category!','blogbox'); ?></h2>
			<p><?php esc_html_e('You may want to try another author.','blogbox'); ?></p>
			<h2><?php esc_html_e('Something to read?','blogbox'); ?></h2>
			<p><?php esc_html_e('Want to read something else? These are the latest posts:','blogbox'); ?><br/><br/></p>
			<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
		</div>
	<?php endif; ?>
	<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>