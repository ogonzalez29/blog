<?php
/**
 * Template part file that contains the right sidebar content
 *
 * This file is called by page-right_sidebar.php
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<div id="sidebar">
	<?php if ( !dynamic_sidebar('Right-Sidebar') ) : ?>
		<h2><?php esc_html_e('Right Sidebar','blogbox') ?></h2>
		<p><?php esc_html_e('Go to Appearance => Widgets and drag a widget over to this sidebar.','blogbox') ?></p>
	<?php endif; ?>
</div>