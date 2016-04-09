<?php
/**
 * Template Name: Archives
 * 
 * The template for displaying Archive pages.
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="widecolumn">

	<div class="archivespage">
		<h2><?php esc_html_e('Archives by Month:','blogbox'); ?></h2>
		<ul class="list-cog">
				<?php wp_get_archives('type=monthly'); ?>
		</ul>

		<h2><?php esc_html_e('Archives by Category:','blogbox'); ?></h2>
		<ul class="list-dot">
			 <?php wp_list_categories("title_li="); ?>
		</ul>
		
		<h2><?php esc_html_e('Archives by Author:','blogbox'); ?></h2>
		<ul class="list-arrow">
			 <?php wp_list_authors(); ?>
		</ul>
		<br/><br/><br/>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>