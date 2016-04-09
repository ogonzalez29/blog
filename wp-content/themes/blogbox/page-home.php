<?php
/**
 * Template Name: Home Page
 * 
 * The template for displaying the theme's static home page.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
get_header();
global $blogbox_options;
?>

<div id="fullwidth-home">

	<?php if(sanitize_text_field($blogbox_options['bB_home1feature_options']) !== "No feature") blogbox_feature_slider(); ?>
	
	
		<?php if (have_posts()) : while (have_posts()) : the_post();
			if( !empty($post->post_content)) { ?>
				<div id="home1post">
					<div class="post">
						<div class="entry">
							<?php the_content('Read more'); ?>
						</div>
					</div>
				</div>
			<?php  }
 		endwhile; else : endif; ?>
	
	
	<?php blogbox_home_sections(); ?>

</div>

<?php get_footer(); ?>