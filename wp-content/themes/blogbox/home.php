<?php
/**
 * home.php file
 *
 * This file is the blog template file, it is used in all cases to display the blog.
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (C) 2015, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

/* Get the user choices for the theme options */
global $blogbox_options;

$layout_option = $blogbox_options['bB_blog_layout_option'];

if( $layout_option == 'fullwidth-no slider or home sections') {
	get_template_part( '/template-parts/blog', 'fullwidth' );
} else if($layout_option == 'feature slider plus home sections' ) {
	get_template_part( '/template-parts/blog', 'feature' );
} else {
	get_template_part( '/template-parts/blog', 'normal' );
}
