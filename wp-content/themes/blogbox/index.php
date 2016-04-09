<?php
/**
 * Master/Default template file
 *
 * This file is the master/default template file, used when no other file matches in
 * the {@link http://codex.wordpress.org/Template_Hierarchy Template Hierarchy}.
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
get_header();
/* Get the user choices for the theme options */
global $blogbox_options;
?>

<div id="widecolumn">

	<?php
		$exclude_categories = blogbox_exclude_categories();
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('cat='.$exclude_categories.'&paged='.$paged);
		if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
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
				<div class="left"><?php next_posts_link(esc_html__('&lt;&lt; older entries','blogbox') ); ?></div>
				<div class="right"><?php previous_posts_link(esc_html__(' newer entries &gt;&gt;','blogbox') ); ?></div>
				<br/>
			</div>
			<?php } ?>
			<?php $wp_query = null; $wp_query = $temp;?>
		<?php else : ?>
		<?php endif; ?>
		<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>