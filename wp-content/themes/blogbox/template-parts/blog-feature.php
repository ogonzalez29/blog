<?php
/**
 * Template Part, blog with feature slider and home page sections
 *
 * used in home.php
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
global $blogbox_options;
?>
<?php get_header(); ?>

<div id="fullwidth">
	
	<?php if( sanitize_text_field($blogbox_options['bB_home1feature_options']) !== "No feature" ) blogbox_feature_slider(); ?>
	
	<?php blogbox_home_sections(); ?>
	
	<div id="full_divider"></div>
	
	<div id="widecolumn">
	
	<?php
		$exclude_categories = blogbox_exclude_categories();
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('cat='.$exclude_categories.'&paged='.$paged);
		if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
					global $more; 
      				$more = 0;
					blogbox_post_format(); 
				?>
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
</div>

<?php get_footer(); ?>