<?php
/**
 * Error 404 Page template file
 *
 * This file is the Error 404 Page template file, which is output whenever
 * the server encounters a "404 - file not found" error.
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<div id="widecolumn">
	<div class="not_found_404">
		<i class="red fa fa-frown-o fa-4x"></i>
		<h1><?php esc_html_e('Sorry - Page Not Found','blogbox'); ?></h1><br/><br/>
		<h2><?php esc_html_e('Sorry but we can\'t find what you were looking for.','blogbox'); ?>
		<?php esc_html_e('Can you refine your search and try again?','blogbox'); ?>&nbsp;<i class="green fa fa-smile-o fa-2x"></i></h2>
	</div>
</div>
<?php get_sidebar('404'); ?>
<?php get_footer(); ?>