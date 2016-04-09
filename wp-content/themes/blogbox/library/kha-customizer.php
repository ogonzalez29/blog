<?php
/**
 * blogbox Theme Customizer
 *
 * @package   blogBox WordPress Theme 
 * @copyright Copyright (C) YEAR, AUTHOR
 * @license	  http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author	  AUTHOR <www.author.site/contact/>
 * blogbox is distributed under the terms of the GNU GPL
 * 
 * ============ DO NOT REMOVE ===========================================================
 * This options setup is based upon the following :
 * KA WordPress Customize Setup, version 1.0
 * Copyright (C) 2015, Kevin Archibald kevinsspace.ca
 * This theme customizer setup file distributed under the GPL
 * http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * ============ END DO NOT REMOVE ========================================================
 * =======================================================================================
 *                                       Notes
 * =======================================================================================
 * customizer refers to Appearance=>Customize in the WordPress admin panel.
 * 
 * This script is really designed for theme developers who will have alot of options.
 * You can set up options in sections within panels in the customizer.
 * You can save options to the theme_mods_blogbox table or the theme_blogbox_options 
 * table in the options section of your WordPress database
 * theme_mods_blogbox - options saved here will need to be re-entered in a child theme
 * theme_blogbox_options - these options will also be used by child themes
 */
/** ==================== ADD HTML BLOCK to CUSTOMIZE PANEL ================================
 * 
 * This function adds a html block at the start of the options which allows an intro panel
 * ****************************************************************************************
 * Important replace panel1 in the add_action()with the name of the first panel you create
 * ****************************************************************************************
 * If you do not want this feature then delete the code
 * 
 */
add_action( 'customize_render_panel_blogbox_intro', 'blogbox_customizer_intro' );
function blogbox_customizer_intro(){

    echo '<li id="accordion-panel-general" class="blogbox-intro accordion-section control-section control-panel control-panel-default">'.
			'<h3 class="blogbox-intro-title">'.
				esc_html__('blogbox Theme Links','blogbox').
				'<span class="screen-reader-text">Press return or enter to expand</span>'.
			'</h3>'.
			//Author site
			'<a class="blogbox-intro-author button" href="//kevinsspace.ca/" title="//kevinsspace.ca/" target="_blank" >'.
			esc_html__('Author','blogbox').'</a>'.
			//Demo Site
			'<a class="blogbox-intro-demo button" href="//demo1.kevinsspace.ca/" title="//demo1.kevinsspace.ca/" target="_blank" >'.
			esc_html__('Demo','blogbox').'</a>'.
			//User Documentation Page for your theme
			'<a class="blogbox-intro-docs button" href="//demo1.kevinsspace.ca/wp-content/uploads/blogboxDocs/blogbox_Docs.html" title="blogbox User Documentation" target="_blank" >'.
			esc_html__('Docs','blogbox').'</a>'.
			// Donate Link
			'<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="D2Q328RQAC4XW">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>'.'<br/>'.
			'&nbsp;&nbsp;&nbsp;<span class="dashicons-before dashicons-update" style="color:red;">'.esc_html__(' - means Save and Reload to see changes.','blogbox').'</span>'.
		'</li>';
}
/** ===================== PANEL and SECTION ARRAY ========================================
 * 
 * This function sets up the panels and sub panels for the Theme Customizer
 * The first panel is named panel1 and this is the panel to use for your theme info links.
 * If you want to add theme info links:
 *     *********See the section above ADD HTML BLOCK to CUSTOMIZE PANEL*************
 * 
 * For demonstration purposes, this sets up an array with three panels.
 * Fill in your own information for your customizer options setup
 * 
 */
function blogbox_get_customizer_groups() {
	$groups = array (
		'blogbox_intro' => array(
			'name' => 'blogbox_intro',
			'title' => __( 'blogBox Intro','blogbox'),
			'description' => '',
			'priority' => 1,
			'sections' => array(
				'intro_intro' => array(
					'name' => 'intro_intro',
					'title' => __( 'blogBox Intro Links','blogbox'),
					'description' => '',
					'priority' => 1
				)
			)
		),
		'blogbox_general' => array( //you must have at least one panel
			'name' => 'blogbox_general',// id of the panel keep the same as the panel key above
			'title' => esc_html__( 'blogBox General','blogbox'),//title for the panel, for ex blogbox General Options
			'description' => '',
			'priority' => 1,//priority where the panels will go in the display
			'sections' => array(//must have at least one section
				'general_general' => array( //good practice to keep the array key the same as the name
					'name' => 'general_general',//name of the section that will be used where the options are set up
					'title' => esc_html__( 'General Options','blogbox'),//title that will appear for the section
					'description' => '',//you can add a description of what is in the section if you want
					'priority' => 1//priority where the section will list within the panel
				),
				'general_blog' => array(//repeat sections as you want
					'name' => 'general_blog',
					'title' => esc_html__( 'Blog Options','blogbox'),
					'description' => '',
					'priority' => 2
				),
				'general_header' => array(//repeat sections as you want
					'name' => 'general_header',
					'title' => esc_html__( 'Header Options','blogbox'),
					'description' => '',
					'priority' => 3
				),
				'general_footer' => array(//repeat sections as you want
					'name' => 'general_footer',
					'title' => esc_html__( 'Footer Options','blogbox'),
					'description' => '',
					'priority' => 4
				),
				'general_social' => array(//repeat sections as you want
					'name' => 'general_social',
					'title' => esc_html__( 'Social Options','blogbox'),
					'description' => '',
					'priority' => 5
				),
			),
		),
		'blogbox_styles' => array(//repeat panels as you want
			'name' => 'blogbox_styles',
			'title' => esc_html__( 'blogBox Styles','blogbox'),
			'description' => '',
			'priority' => 2,
			'sections' => array(
				'styles_skins' => array(
					'name' => 'styles_skins',
					'title' => esc_html__( 'Skins','blogbox'),
					'description' => '',
					'priority' => 1
				),
				'styles_background' => array(
					'name' => 'styles_background',
					'title' => esc_html__( 'Background Colors','blogbox'),
					'description' => '',
					'priority' => 2
				),
				'styles_text' => array(
					'name' => 'styles_text',
					'title' => esc_html__( 'Text Colors','blogbox'),
					'description' => '',
					'priority' => 3
				),
				'styles_post_formats' => array(
					'name' => 'styles_post_formats',
					'title' => esc_html__( 'Post Formats','blogbox'),
					'description' => '',
					'priority' => 4
				),
				'styles_fonts' => array(
					'name' => 'styles_fonts',
					'title' => esc_html__( 'Fonts','blogbox'),
					'description' => '',
					'priority' => 5
				),
			),
		),
		'blogbox_home' => array(
			'name' => 'blogbox_home',
			'title' => esc_html__( 'blogBox Home','blogbox'),
			'description' => '',
			'priority' => 3,
			'sections' => array(
				'home_feature' => array(
					'name' => 'home_feature',
					'title' => esc_html__( 'Feature Options','blogbox'),
					'description' => '',
					'priority' => 1
				),
				'home_section1' => array(
					'name' => 'home_section1',
					'title' => esc_html__( 'Section 1 Options','blogbox'),
					'description' => '',
					'priority' => 2
				),
				'home_section2' => array(
					'name' => 'home_section2',
					'title' => esc_html__( 'Section 2 Options','blogbox'),
					'description' => '',
					'priority' => 3
				),
				'home_section3' => array(
					'name' => 'home_section3',
					'title' => esc_html__( 'Section 3 Options','blogbox'),
					'description' => '',
					'priority' => 4
				),
			),
		),
		'blogbox_portfolio' => array(
			'name' => 'blogbox_portfolio',
			'title' => esc_html__( 'blogBox Portfolio','blogbox'),
			'description' => '',
			'priority' => 4,
			'sections' => array(
				'portfolio_a' => array(
					'name' => 'portfolio_a',
					'title' => esc_html__( 'Portfolio A','blogbox'),
					'description' => '',
					'priority' => 1
				),
				'portfolio_b' => array(
					'name' => 'portfolio_b',
					'title' => esc_html__( 'Portfolio B','blogbox'),
					'description' => '',
					'priority' => 2
				),
				'portfolio_c' => array(
					'name' => 'portfolio_c',
					'title' => esc_html__( 'Portfolio C','blogbox'),
					'description' => '',
					'priority' => 3
				),
				'portfolio_d' => array(
					'name' => 'portfolio_d',
					'title' => esc_html__( 'Portfolio D','blogbox'),
					'description' => '',
					'priority' => 4
				),
				'portfolio_e' => array(
					'name' => 'portfolio_e',
					'title' => esc_html__( 'Portfolio E','blogbox'),
					'description' => '',
					'priority' => 5
				),
			),
		)//note there is no comma for the last array
	);

	return apply_filters( 'blogbox_get_customizer_groups', $groups );
}

/** ===================== OPTIONS ARRAY ========================================
 * This function sets up the array with the option parameters
 * 
 * format 
 * 
 * 'themeslug_id' => array(
 *		'name' => 'themeslug_id',//keep the name the same as the option key. ALL OPTION NAMES MUST BE UNIQUE
 *		'title' => __('Title of Option','themeslug'),//title to show in option
 * 		'option_type' => 'text',//text, textarea, checkbox, radio, select, range, image, color, upload, scat, stag
 * 		'setting_type' => 'option', //option->saves to separate table called themeslug_customize_options[]
 * 							        //	  ->will not be changed in child theme
 * 									//theme-mod->saves to theme options table called theme_mods_themeslug[]
 * 									//		 ->will have to be re-entered for child theme
 * 		'description' => __("Description of option",'themeslug'), //additional documentation for option
 *		'section' => 'panel1_section1', //panel you want the option to appear under
 *		'priority' => 1, // order within the section that the option is displayed
 *		'default' => '', // sane default, what default do you want to use if the user does not update this option
 *		'transport' => 'refresh', // refresh-> page must be reloaded to use the option
 * 								  // postMessage-> you have custom Javascript to instantly update the preview window
 *		'sanitize' => 'is_email'// sanitize callback function you want to use, see recommended below
 * 							    // checkbox=>themeslug_validate_checkbox,
 * 								// text(email) => is_email,text(nohtml)=>sanitize_text_field,
 * 								// text(html allowed)=>wp_kses_post,text(link) => esc_url_raw,
 * 								// textarea(no html allowed)=>esc_html,textarea(html allowed)=> wp_kses_post
 * 								// radio=>sanitize_text_field,select=>sanitize_text_field,
 * 								// image=>esc_url_raw,upload=>esc_url_raw,
 * 								// range=>sanitize_text_field,color=>sanitize_hex_color,
 * 								// scat=>sanitize_text_field,stag=>sanitize_text_field
 *	),
 * 
 * for select and radio lists and the range slider there is a choices array to also set up, see the defaults below
 * 
 * NOTE: Panel 1 Section 1 contains a comlete set of option examples available for this script
 * Simply cut and paste to add the option of your choice
 */
function blogbox_get_customizer_option_partameters() {
	$options = array (
		/* Panel:General Section:General */

		/* Panel:blogbox_intro Section:intro_intro */
		'bB_intro_text' => array(
			'name' => 'bB_intro_text',
			'title' => __('blogBox Theme Intro Text','blogBox'),
			'option_type' => 'text', 
			'setting_type' => 'option',
			'description' => '',
			'section' => 'intro_intro',
			'priority' => 1,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_contact_email' => array(
			'name' => 'bB_contact_email',
			'title' => esc_html__('Email address for contact page','blogbox'),
			'option_type' => 'text', 
			'setting_type' => 'option',
			'description' => esc_html__("Must be a valid email address",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_general',
			'priority' => 1,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'is_email'
		),
		'bB_disable_colorbox' => array(
			'name' => 'bB_disable_colorbox',
			'title' => esc_html__('Disable Colorbox jQuery plugin','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to disable this plugin','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_general',
			'priority' => 7,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_disable_fitvids' => array(
			'name' => 'bB_disable_fitvids',
			'title' => esc_html__('Disable fitvids','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Fitvids is a jquery plugin that makes embeded video responsive','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_general',
			'priority' => 8,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:General Section:Blog
		'bB_blog_layout_option' => array(
			'name' => 'bB_blog_layout_option',
			'title' => esc_html__('Blog Layout Option','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'normal-no slider or home sections' => esc_html__( 'normal-no slider or home sections' , 'blogbox' ),
				'fullwidth-no slider or home sections' => esc_html__( 'fullwidth-no slider or home sections' , 'blogbox' ),
				'feature slider plus home sections' => esc_html__( 'feature slider plus home sections' , 'blogbox' )
			),
			'description' => esc_html__('Select the layout you want','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 1,
			'default' => 'normal-no slider or home sections',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_use_post_format_icons' => array(
			'name' => 'bB_use_post_format_icons',
			'title' => esc_html__('Use post format icons','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to include the different post icons','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 2,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_exclude_timestamp' => array(
			'name' => 'bB_exclude_timestamp',
			'title' => esc_html__('Exclude timestamp in posts','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to exclude','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_exclude_author' => array(
			'name' => 'bB_exclude_author',
			'title' => esc_html__('Exclude author in posts','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to exclude','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_exclude_category' => array(
			'name' => 'bB_exclude_category',
			'title' => esc_html__('Exclude categories in posts','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to exclude','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_exclude_tags' => array(
			'name' => 'bB_exclude_tags',
			'title' => esc_html__('Exclude tags in posts','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to exclude','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_use_fullwidth_single_post' => array(
			'name' => 'bB_use_fullwidth_single_post',
			'title' => esc_html__('Use fullwidth for single post','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to use fullwidth','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_blog',
			'priority' => 7,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:General Section:Header
		'bB_use_banner_image' => array(
			'name' => 'bB_use_banner_image',
			'title' => esc_html__('Use full width banner','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Title,description, and social strip will be displayed above the banner. Suggest banner 960 x 200px.','blogbox').
								'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 1,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_show_blog_title' => array(
			'name' => 'bB_show_blog_title',
			'title' => esc_html__('Show Blog Title','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show blog title in header','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 1,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_show_blog_description' => array(
			'name' => 'bB_show_blog_description',
			'title' => esc_html__('Show Blog Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show description under logo','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 2,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_show_social_strip' => array(
			'name' => 'bB_show_social_strip',
			'title' => esc_html__('Show Social Strip','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show social strip in header','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 3,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_menu_loc' => array(
			'name' => 'bB_menu_loc',
			'title' => esc_html__('Header menu location','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'center' => esc_html__( 'center' , 'blogbox' ),
				'left' => esc_html__( 'left' , 'blogbox' ),
				'right' => esc_html__( 'right' , 'blogbox' )
			),
			'description' => esc_html__('left,right or center','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 4,
			'default' => 'center',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_menu_border' => array(
			'name' => 'bB_menu_border',
			'title' => esc_html__('Menu border options','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'full width' => esc_html__( 'full width' , 'blogbox' ),
				'menu only' => esc_html__( 'menu only' , 'blogbox' ),
				'no border' => esc_html__( 'no border' , 'blogbox' )
			),
			'description' => esc_html__('menu only setting applies only to centered menu','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_header',
			'priority' => 5,
			'default' => 'center',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		//Panel:General Section:Footer
		'bB_show_footer' => array(
			'name' => 'bB_show_footer',
			'title' => esc_html__('Show Footer','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Click to include footer','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_footer',
			'priority' => 1,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_footer_columns' => array(
			'name' => 'bB_footer_columns',
			'title' => esc_html__('Footer Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'4' => '4',
				'3' => '3'
			),
			'description' => esc_html__('Default is 4 Footer Columns','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_footer',
			'priority' => 2,
			'default' => '4',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_show_copyright_strip' => array(
			'name' => 'bB_show_copyright_strip',
			'title' => esc_html__('Show Copywright Strip','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Click to include copywright strip','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_footer',
			'priority' => 5,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_left_copyright_text' => array(
			'name' => 'bB_left_copyright_text',
			'title' => esc_html__('Copyright left text','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Some HTML allowed, suggest : &#38;copy; copyright &#60;a href="#"&#62;www.yoursite.url&#60;/a&#62;','blogbox'),
			'section' => 'general_footer',
			'priority' => 6,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		'bB_middle_copyright_text' => array(
			'name' => 'bB_middle_copyright_text',
			'title' => esc_html__('Copyright middle text','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Some HTML allowed, suggest : site by &#38;nbsp; &#60;a href="#"&#62;www.developer.url&#60;/a&#62;','blogbox'),
			'section' => 'general_footer',
			'priority' => 7,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		'bB_right_copyright_text' => array(
			'name' => 'bB_right_copyright_text',
			'title' => esc_html__('Copyright right text','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Some HTML allowed, suggest : &#60;a href="#"&#62;sitemap&#60;/a&#62;','blogbox'),
			'section' => 'general_footer',
			'priority' => 8,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		//Panel:General Section Social
		'bB_header_facebook' => array(
			'name' => 'bB_header_facebook',
			'title' => esc_html__('Facebook Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://www.facebook.com/your_profile/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 1,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_twitter' => array(
			'name' => 'bB_header_twitter',
			'title' => esc_html__('Twitter Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://twitter.com/your_twitter/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 2,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_rss' => array(
			'name' => 'bB_header_rss',
			'title' => esc_html__('RSS Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://your.feed.url/feed/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 3,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_linkedin' => array(
			'name' => 'bB_header_linkedin',
			'title' => esc_html__('Linkedin Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://ca.linkedin.com/profile link/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 4,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_delicious' => array(
			'name' => 'bB_header_delicious',
			'title' => esc_html__('Delicious Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://www.delicious.com/save/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 5,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_digg' => array(
			'name' => 'bB_header_digg',
			'title' => esc_html__('Digg Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://digg.com/user','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 6,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_pinterest' => array(
			'name' => 'bB_header_pinterest',
			'title' => esc_html__('Pinterest Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://pinterest.com/username/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 7,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_google_plus' => array(
			'name' => 'bB_header_google_plus',
			'title' => esc_html__('Google Plus Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:https://plus.google.com/your_page_number/posts','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 8,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_myspace' => array(
			'name' => 'bB_header_myspace',
			'title' => esc_html__('My Space Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://www.myspace.com/your_link','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 10,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_header_tumblr' => array(
			'name' => 'bB_header_tumblr',
			'title' => esc_html__('Tumblr Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://www.tumblr.com/your_link/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'general_social',
			'priority' => 11,
			'default' => '#',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		//Panel:Styles Section:Skins
		'bB_use_skin' => array(
			'name' => 'bB_use_skin',
			'title' => esc_html__('Use Skin For Colors','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Use a skin for background and text colors?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_skins',
			'priority' => 1,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_select_skin' => array(
			'name' => 'bB_select_skin',
			'title' => esc_html__('Skin For Theme','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'Blue' 		=> esc_html__( 'Blue' , 'blogbox' ),
				'Brown' 	=> esc_html__( 'Brown' , 'blogbox' ),
				'Dark Gray' => esc_html__( 'Dark Gray' , 'blogbox' ),
				'Gray' 		=> esc_html__( 'Gray' , 'blogbox' ),
				'White' 	=> esc_html__( 'White' , 'blogbox' ),
				'Wine' 		=> esc_html__( 'Wine' , 'blogbox' )
			),
			'description' => esc_html__('Select a skin to use','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_skins',
			'priority' => 2,
			'default' => 'Blue',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		//Panel:Styles Section:Background
		'bB_outside_background_color' => array(
			'name' => 'bB_outside_background_color',
			'title' => esc_html__('Outside Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #FFFFFF',
			'section' => 'styles_background',
			'priority' => 1,
			'default' => '#FFFFFF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_select_gradient' => array(
			'name' => 'bB_select_gradient',
			'title' => esc_html__('Background Gradient','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'No Gradient' 		=> esc_html__( 'No Gradient' , 'blogbox' ),
				'Dark Gradient' 	=> esc_html__( 'Dark Gradient' , 'blogbox' ),
				'Light Gradient'	=> esc_html__( 'Light Gradient' , 'blogbox' )
			),
			'description' => esc_html__('Select a gradient','blogbox'),
			'section' => 'styles_background',
			'priority' => 2,
			'default' => 'No Gradient',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_header_background_color' => array(
			'name' => 'bB_header_background_color',
			'title' => esc_html__('Header Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #576C9C',
			'section' => 'styles_background',
			'priority' => 3,
			'default' => '#576C9C',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_header_top_border_color' => array(
			'name' => 'bB_header_top_border_color',
			'title' => esc_html__('Header Top Border Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_background',
			'priority' => 4,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_header_bottom_border_color' => array(
			'name' => 'bB_header_bottom_border_color',
			'title' => esc_html__('Header Bottom Border Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_background',
			'priority' => 5,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_menu_border_color' => array(
			'name' => 'bB_menu_border_color',
			'title' => esc_html__('Menu Border Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #758ab7',
			'section' => 'styles_background',
			'priority' => 7,
			'default' => '#758ab7',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_background_color' => array(
			'name' => 'bB_nav_background_color',
			'title' => esc_html__('Navigation Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #576C9C',
			'section' => 'styles_background',
			'priority' => 8,
			'default' => '#576C9C',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_drop_background_color' => array(
			'name' => 'bB_nav_drop_background_color',
			'title' => esc_html__('Navigation Dropdown Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #758ab7',
			'section' => 'styles_background',
			'priority' => 9,
			'default' => '#758ab7',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_drop_background_hover_color' => array(
			'name' => 'bB_nav_drop_background_hover_color',
			'title' => esc_html__('Navigation Dropdown Background Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__('default:','blogbox').' #091C47'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_background',
			'priority' => 10,
			'default' => '#091C47',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_dropdown_arrows' => array(
			'name' => 'bB_nav_dropdown_arrows',
			'title' => esc_html__('Navigation dropdown arrow colors','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'white'			=> esc_html__( 'white' , 'blogbox' ),
				'black' 		=> esc_html__( 'black' , 'blogbox' ),
				'black-white' 	=> esc_html__( 'black-white' , 'blogbox' ),
				'white-black'	=> esc_html__( 'white-black' , 'blogbox' ),
				'gray'			=> esc_html__( 'gray' , 'blogbox' )
			),
			'description' => esc_html__('Select a nav dropdown arow','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_background',
			'priority' => 11,
			'default' => 'white',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_feature_area_background_color' => array(
			'name' => 'bB_feature_area_background_color',
			'title' => esc_html__('Feature Area Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_background',
			'priority' => 12,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_main_area_background_color' => array(
			'name' => 'bB_main_area_background_color',
			'title' => esc_html__('Main Area Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_background',
			'priority' => 13,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_post_background_color' => array(
			'name' => 'bB_home1_post_background_color',
			'title' => esc_html__('Home Page Post Area Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_background',
			'priority' => 14,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan1_background_color' => array(
			'name' => 'bB_home1_slogan1_background_color',
			'title' => esc_html__('Home Page Slogan 1 Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #c1c1c1',
			'section' => 'styles_background',
			'priority' => 15,
			'default' => '#c1c1c1',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan1_button_color' => array(
			'name' => 'bB_home1_slogan1_button_color',
			'title' => esc_html__('Home Page Slogan 1 Button Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #A6A6A6',
			'section' => 'styles_background',
			'priority' => 15,
			'default' => '#A6A6A6',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan2_background_color' => array(
			'name' => 'bB_home1_slogan2_background_color',
			'title' => esc_html__('Home Page Slogan 2 Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #C6D8FF',
			'section' => 'styles_background',
			'priority' => 16,
			'default' => '#C6D8FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_footer_background_color' => array(
			'name' => 'bB_footer_background_color',
			'title' => esc_html__('Footer Section Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_background',
			'priority' => 17,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_copyright_background_color' => array(
			'name' => 'bB_copyright_background_color',
			'title' => esc_html__('Copyright Section Background Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_background',
			'priority' => 18,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		//Panel:Styles Section:Text
		'bB_header_text_color' => array(
			'name' => 'bB_header_text_color',
			'title' => esc_html__('Header Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 1,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_header_link_color' => array(
			'name' => 'bB_header_link_color',
			'title' => esc_html__('Header Link Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 2,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_header_hover_color' => array(
			'name' => 'bB_header_hover_color',
			'title' => esc_html__('Header Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 3,
			'default' => '#F4F7FF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_text_color' => array(
			'name' => 'bB_nav_text_color',
			'title' => esc_html__('Navigation Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__('default:','blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 4,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_text_hover_color' => array(
			'name' => 'bB_nav_text_hover_color',
			'title' => esc_html__('Navigation Text Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__('default:','blogbox').' #FFFFFF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 5,
			'default' => '#FFFFFF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_drop_text_color' => array(
			'name' => 'bB_nav_drop_text_color',
			'title' => esc_html__('Navigation Dropdown Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__('default:','blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 5,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_nav_drop_hover_text_color' => array(
			'name' => 'bB_nav_drop_hover_text_color',
			'title' => esc_html__('Navigation Dropdown Hover Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #FFFFFF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 6,
			'default' => '#FFFFFF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_feature_text_color' => array(
			'name' => 'bB_feature_text_color',
			'title' => esc_html__('Feature Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_text',
			'priority' => 7,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan1_text_color' => array(
			'name' => 'bB_home1_slogan1_text_color',
			'title' => esc_html__('Home Page Slogan 1 Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #353535',
			'section' => 'styles_text',
			'priority' => 8,
			'default' => '#353535',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan1_button_text_color' => array(
			'name' => 'bB_home1_slogan1_button_text_color',
			'title' => esc_html__('Home Page Slogan 1 Button Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #ffffff',
			'section' => 'styles_text',
			'priority' => 8,
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_home1_slogan2_text_color' => array(
			'name' => 'bB_home1_slogan2_text_color',
			'title' => esc_html__('Home Page Slogan 2 Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #353535',
			'section' => 'styles_text',
			'priority' => 9,
			'default' => '#353535',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_main_text_color' => array(
			'name' => 'bB_main_text_color',
			'title' => esc_html__('Main Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #091C47',
			'section' => 'styles_text',
			'priority' => 10,
			'default' => '#091C47',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_main_link_color' => array(
			'name' => 'bB_main_link_color',
			'title' => esc_html__('Main Link Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__('default:','blogbox').' #576C9C',
			'section' => 'styles_text',
			'priority' => 11,
			'default' => '#576C9C',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_main_hover_color' => array(
			'name' => 'bB_main_hover_color',
			'title' => esc_html__('Main Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #8E7763'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 12,
			'default' => '#8E7763',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_footer_text_color' => array(
			'name' => 'bB_footer_text_color',
			'title' => esc_html__('Footer Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 13,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_footer_link_color' => array(
			'name' => 'bB_footer_link_color',
			'title' => esc_html__('Footer Link Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #C6D8FF',
			'section' => 'styles_text',
			'priority' => 14,
			'default' => '#C6D8FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_footer_hover_color' => array(
			'name' => 'bB_footer_hover_color',
			'title' => esc_html__('Footer Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 15,
			'default' => '#F4F7FF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_copyright_text_color' => array(
			'name' => 'bB_copyright_text_color',
			'title' => esc_html__('Copyright Text Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF',
			'section' => 'styles_text',
			'priority' => 16,
			'default' => '#F4F7FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_copyright_link_color' => array(
			'name' => 'bB_copyright_link_color',
			'title' => esc_html__('Copyright Link Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #C6D8FF',
			'section' => 'styles_text',
			'priority' => 17,
			'default' => '#C6D8FF',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_copyright_hover_color' => array(
			'name' => 'bB_copyright_hover_color',
			'title' => esc_html__('Copyright Hover Color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F4F7FF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_text',
			'priority' => 18,
			'default' => '#F4F7FF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		//Panel:Styles Section:Post Formats
		'bB_aside_background_top' => array(
			'name' => 'bB_aside_background_top',
			'title' => esc_html__('Aside Post top color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #B7997B'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_post_formats',
			'priority' => 1,
			'default' => '#B7997B',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_aside_background_bottom' => array(
			'name' => 'bB_aside_background_bottom',
			'title' => esc_html__('Aside Post bottom color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #7F6851'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_post_formats',
			'priority' => 2,
			'default' => '#7F6851',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_aside_text_color' => array(
			'name' => 'bB_aside_text_color',
			'title' => esc_html__('Aside Post text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F9F9F9',
			'section' => 'styles_post_formats',
			'priority' => 3,
			'default' => '#F9F9F9',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_aside_author_color' => array(
			'name' => 'bB_aside_author_color',
			'title' => esc_html__('Aside Post Author text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F9F9F9',
			'section' => 'styles_post_formats',
			'priority' => 3,
			'default' => '#F9F9F9',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_aside_author_hover_color' => array(
			'name' => 'bB_aside_author_hover_color',
			'title' => esc_html__('Aside Post Author hover text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #FFFFFF'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_post_formats',
			'priority' => 3,
			'default' => '#FFFFFF',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_audio_background_color' => array(
			'name' => 'bB_audio_background_color',
			'title' => esc_html__('Audio Post background color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #E5F9C7',
			'section' => 'styles_post_formats',
			'priority' => 4,
			'default' => '#E5F9C7',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_audio_text_color' => array(
			'name' => 'bB_audio_text_color',
			'title' => esc_html__('Audio Post text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #000000',
			'section' => 'styles_post_formats',
			'priority' => 5,
			'default' => '#000000',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_chat_background_color' => array(
			'name' => 'bB_chat_background_color',
			'title' => esc_html__('Chat Post background color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #ECEDEA',
			'section' => 'styles_post_formats',
			'priority' => 6,
			'default' => '#ECEDEA',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_link_post_background_color' => array(
			'name' => 'bB_link_post_background_color',
			'title' => esc_html__('Link Post background color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #938F8F',
			'section' => 'styles_post_formats',
			'priority' => 7,
			'default' => '#938F8F',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_link_post_text_color' => array(
			'name' => 'bB_link_post_text_color',
			'title' => esc_html__('Link Post text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #f9f9f9',
			'section' => 'styles_post_formats',
			'priority' => 8,
			'default' => '#f9f9f9',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_link_post_hover_text_color' => array(
			'name' => 'bB_link_post_hover_text_color',
			'title' => esc_html__('Link Post hover color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #E2DEDE'.'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'styles_post_formats',
			'priority' => 9,
			'default' => '#E2DEDE',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_status_background_color' => array(
			'name' => 'bB_status_background_color',
			'title' => esc_html__('Status Post background color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #F5F970',
			'section' => 'styles_post_formats',
			'priority' => 10,
			'default' => '#F5F970',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_status_text_color' => array(
			'name' => 'bB_status_text_color',
			'title' => esc_html__('Status Post text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #664B0D',
			'section' => 'styles_post_formats',
			'priority' => 11,
			'default' => '#664B0D',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_status_meta_color' => array(
			'name' => 'bB_status_meta_color',
			'title' => esc_html__('Status Post date,comment,author color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #664B0D',
			'section' => 'styles_post_formats',
			'priority' => 12,
			'default' => '#664B0D',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_quote_background_color' => array(
			'name' => 'bB_quote_background_color',
			'title' => esc_html__('Quote Post background color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #EAEAEA',
			'section' => 'styles_post_formats',
			'priority' => 13,
			'default' => '#EAEAEA',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_quote_border_color' => array(
			'name' => 'bB_quote_border_color',
			'title' => esc_html__('Quote Post border color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #ffffff',
			'section' => 'styles_post_formats',
			'priority' => 14,
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		'bB_quote_text_color' => array(
			'name' => 'bB_quote_text_color',
			'title' => esc_html__('Quote Post text color','blogbox'),
			'option_type' => 'color',
			'setting_type' => 'option',
			'description' => esc_html__("default:",'blogbox').' #303030',
			'section' => 'styles_post_formats',
			'priority' => 15,
			'default' => '#303030',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_hex_color'
		),
		//Panel:Styles Section:Fonts
		'bB_base_font_size' => array(
			'name' => 'bB_base_font_size',
			'title' => esc_html__('Base font size','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'85%' 	=> '85%',
				'90%' 	=> '90%',
				'95%' 	=> '95%',
				'100%' 	=> '100%',
				'105%' 	=> '105%',
				'110%' 	=> '110%',
				'115%' 	=> '115%'
			),
			'description' => esc_html__('Select a base font size for your website','blogbox'),
			'section' => 'styles_fonts',
			'priority' => 1,
			'default' => '100%',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_header_font' => array(
			'name' => 'bB_header_font',
			'title' => esc_html__('Font for Headers','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				"Default" 												=> esc_html__( "Default" , 'blogbox' ),
				"Arial, Helvetica, sans-serif" 							=> "Arial",
				"'Book Antiqua', 'Palatino Linotype', Palatino, serif" 	=> "Book Antiqua",
				"Cambria, Georgia, serif" 								=> "Cambria",
				"'Comic Sans MS', sans-serif" 							=> "Comic Sans MS",
				"Georgia, serif" 										=> "Georgia",
				"Tahoma, Geneva, sans-serif" 							=> "Tahoma",
				"'Times New Roman', Times, serif" 						=> "Times New Roman",
				"'Trebuchet MS', Helvetica, sans-serif" 				=> "Trebuchet MS",
				"Verdana, Geneva, sans-serif" 							=> "Verdana"
			),
			'description' => esc_html__('Select a font for headers (default: Verdana)','blogbox'),
			'section' => 'styles_fonts',
			'priority' => 2,
			'default' => "Verdana, Geneva, sans-serif",
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_use_google_header' => array(
			'name' => 'bB_use_google_header',
			'title' => esc_html__('Use Google Header Font','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Use a Google Font for Headers?','blogbox').'<span style="color:red;"> '
							.esc_html__('Google fonts can be previewed but this box must be checked to use them.','blogbox').'</span>',
			'section' => 'styles_fonts',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_google_header_font' => array(
			'name' => 'bB_google_header_font',
			'title' => esc_html__('Google Font for Headers','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				"'Allerta', Helvetica, Arial, sans-serif" 		=> "Allerta",
				"'Arvo', Georgia, Times, serif" 				=> "Arvo",
				"'Cabin', Helvetica, Arial, sans-serif" 		=> "Cabin",
				"'Corben', Georgia, Times, serif" 				=> "Corben",
				"'Droid Sans', Helvetica, Arial, sans-serif" 	=> "Droid Sans",
				"'Droid Serif', Georgia, Times, serif" 			=> "Droid Serif",
				"'Lekton', Helvetica, Arial, sans-serif" 		=> "Lekton",
				"'Molengo', Georgia, Times, serif" 				=> "Molengo",
				"'Nobile', Helvetica, Arial, sans-serif" 		=> "Nobile",
				"'PT Sans', Helvetica, Arial, sans-serif" 		=> "PT Sans",
				"'Raleway', Helvetica, Arial, sans-serif" 		=> "Raleway",
				"'Ubuntu', Helvetica, Arial, sans-serif" 		=> "Ubuntu",
				"'Vollkorn', Georgia, Times, serif" 			=> "Vollkorn"
			),
			'description' => esc_html__('Select a Google font for headers (default: Droid Serif)','blogbox'),
			'section' => 'styles_fonts',
			'priority' => 4,
			'default' => "'Droid Serif', Georgia, Times, serif",
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_body_font' => array(
			'name' => 'bB_body_font',
			'title' => esc_html__('Font for Body Text','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				"Default" 												=> esc_html__( "Default" , 'blogbox' ),
				"Arial, Helvetica, sans-serif" 							=> "Arial",
				"'Book Antiqua', 'Palatino Linotype', Palatino, serif" 	=> "Book Antiqua",
				"Cambria, Georgia, serif" 								=> "Cambria",
				"'Comic Sans MS', sans-serif" 							=> "Comic Sans MS",
				"Georgia, serif" 										=> "Georgia",
				"Tahoma, Geneva, sans-serif" 							=> "Tahoma",
				"'Times New Roman', Times, serif" 						=> "Times New Roman",
				"'Trebuchet MS', Helvetica, sans-serif" 				=> "Trebuchet MS",
				"Verdana, Geneva, sans-serif" 							=> "Verdana"
			),
			'description' => esc_html__('Select a font for body text (default: Book Antiqua)','blogbox'),
			'section' => 'styles_fonts',
			'priority' => 5,
			'default' => "'Book Antiqua', 'Palatino Linotype', Palatino, serif",
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_use_google_body' => array(
			'name' => 'bB_use_google_body',
			'title' => esc_html__('Use Google Body Font','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Use a Google Font for Body Text?','blogbox').'<span style="color:red;"> '
							.esc_html__('Google fonts can be previewed but this box must be checked to use them.','blogbox').'</span>',
			'section' => 'styles_fonts',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_google_body_font' => array(
			'name' => 'bB_google_body_font',
			'title' => esc_html__('Google Font for Body','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				"'Allerta', Helvetica, Arial, sans-serif" 		=> "Allerta",
				"'Arvo', Georgia, Times, serif" 				=> "Arvo",
				"'Cabin', Helvetica, Arial, sans-serif" 		=> "Cabin",
				"'Corben', Georgia, Times, serif" 				=> "Corben",
				"'Droid Sans', Helvetica, Arial, sans-serif" 	=> "Droid Sans",
				"'Droid Serif', Georgia, Times, serif" 			=> "Droid Serif",
				"'Lekton', Helvetica, Arial, sans-serif" 		=> "Lekton",
				"'Molengo', Georgia, Times, serif" 				=> "Molengo",
				"'Nobile', Helvetica, Arial, sans-serif" 		=> "Nobile",
				"'PT Sans', Helvetica, Arial, sans-serif" 		=> "PT Sans",
				"'Raleway', Helvetica, Arial, sans-serif" 		=> "Raleway",
				"'Ubuntu', Helvetica, Arial, sans-serif" 		=> "Ubuntu",
				"'Vollkorn', Georgia, Times, serif" 			=> "Vollkorn"
			),
			'description' => esc_html__('Select a Google font for Body Text (default: Droid Sans)','blogbox'),
			'section' => 'styles_fonts',
			'priority' => 7,
			'default' => "'Droid Serif', Georgia, Times, serif",
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		//Panel:Home Section:Feature
		'bB_home1feature_options' => array(
			'name' => 'bB_home1feature_options',
			'title' => esc_html__('Home Page Feature Options','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'Small slides and feature text box' 	=> esc_html__( 'Small slides and feature text box' , 'blogbox' ),
				'Small slides and feature text box-thumbnails' 	=> esc_html__( 'Small slides and feature text box-thumbnails' , 'blogbox' ),
				'Small slides and feature text box-nonav' 	=> esc_html__( 'Small slides and feature text box-nonav' , 'blogbox' ),
				'Small single image and feature text box' 	=> esc_html__( 'Small single image and feature text box' , 'blogbox' ),
				'Full feature slides' 	=> esc_html__( 'Full feature slides' , 'blogbox' ),
				'Full feature slides-thumbnails' 	=> esc_html__( 'Full feature slides-thumbnails' , 'blogbox' ),
				'Full feature slides-nonav' 	=> esc_html__( 'Full feature slides-nonav' , 'blogbox' ),
				'Full single image' 	=> esc_html__( 'Full single image' , 'blogbox' ),
				'No feature' 	=> esc_html__( 'No feature' , 'blogbox' )
			),
			'description' => esc_html__('Select the feature option','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_feature',
			'priority' => 1,
			'default' => 'Small slides and feature text box',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_use_feature_widget' => array(
			'name' => 'bB_use_feature_widget',
			'title' => esc_html__('Use Feature Widget','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Use widgetized area instead of Title and Textbox','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>'.
								'<span style="color:red;">'.esc_html__('This box must be unchecked to preview Feature Title and Feature Text below','blogbox').'</span>',
			'section' => 'home_feature',
			'priority' => 2,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_left_feature_title' => array(
			'name' => 'bB_left_feature_title',
			'title' => esc_html__('Feature Title','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter a title for the Feature Text Box, no HTML','blogbox'),
			'section' => 'home_feature',
			'priority' => 3,
			'default' => 'Welcome to blogbox',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_left_feature_text' => array(
			'name' => 'bB_left_feature_text',
			'title' => esc_html__('Feature Text','blogbox'),
			'option_type' => 'textarea',
			'setting_type' => 'option',
			'description' => esc_html__("Keep under 200 characters,HTML allowed",'blogbox'),
			'section' => 'home_feature',
			'priority' => 4,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		'bB_showfeaturepost' => array(
			'name' => 'bB_showfeaturepost',
			'title' => esc_html__('Show Feature Posts','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to include Feature Posts in Blog','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_feature',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:Home Section:Section 1
		'bB_home1section1_onoroff' => array(
			'name' => 'bB_home1section1_onoroff',
			'title' => esc_html__('Enable Section 1','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to display Section 1','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>'.
								'<span style="color:red;">'.esc_html__('This box must be checked to preview items in this section','blogbox').'</span>',
			'section' => 'home_section1',
			'priority' => 1,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_home1section1_slogan' => array(
			'name' => 'bB_home1section1_slogan',
			'title' => esc_html__('Home Section 1 Slogan','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter your text for your slogan.','blogbox'),
			'section' => 'home_section1',
			'priority' => 2,
			'default' => 'blogbox offers many features and options',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_contact_link' => array(
			'name' => 'bB_contact_link',
			'title' => esc_html__('Contact Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://your.website.url/contact/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section1',
			'priority' => 3,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_contact_label' => array(
			'name' => 'bB_contact_label',
			'title' => esc_html__('Contact Link Label','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Default is Contact Me','blogbox'),
			'section' => 'home_section1',
			'priority' => 4,
			'default' => esc_html__('Contact Me','blogbox'),
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		
		//Panel:Home Section:Section 2
		'bB_home1section2_onoroff' => array(
			'name' => 'bB_home1section2_onoroff',
			'title' => esc_html__('Enable Section 2','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to display Section 2','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section2',
			'priority' => 1,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_home1service1_image' => array(
			'name' => 'bB_home1service1_image',
			'title' => esc_html__('Service Box 1 Image','blogbox'),
			'option_type' => 'image',
			'setting_type' => 'option',
			'description' => 'Upload image for Service Box 1',
			'section' => 'home_section2',
			'priority' => 2,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service1_title' => array(
			'name' => 'bB_home1service1_title',
			'title' => esc_html__('Service Box 1 Title','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter a title for Service Box 1','blogbox'),
			'section' => 'home_section2',
			'priority' => 3,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_home1service1_link' => array(
			'name' => 'bB_home1service1_link',
			'title' => esc_html__('Service Box 1 Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://your.website.url/page/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section2',
			'priority' => 4,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service1_text' => array(
			'name' => 'bB_home1service1_text',
			'title' => esc_html__('Service Box 1 Text','blogbox'),
			'option_type' => 'textarea',
			'setting_type' => 'option',
			'description' => esc_html__("Enter text for your service box - html allowed",'blogbox'),
			'section' => 'home_section2',
			'priority' => 5,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		'bB_home1service2_image' => array(
			'name' => 'bB_home1service2_image',
			'title' => esc_html__('Service Box 2 Image','blogbox'),
			'option_type' => 'image',
			'setting_type' => 'option',
			'description' => esc_html__('Upload image for Service Box 2','blogbox'),
			'section' => 'home_section2',
			'priority' => 6,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service2_title' => array(
			'name' => 'bB_home1service2_title',
			'title' => esc_html__('Service Box 2 Title','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter a title for Service Box 2','blogbox'),
			'section' => 'home_section2',
			'priority' => 7,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_home1service2_link' => array(
			'name' => 'bB_home1service2_link',
			'title' => esc_html__('Service Box 2 Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://your.website.url/page/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section2',
			'priority' => 8,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service2_text' => array(
			'name' => 'bB_home1service2_text',
			'title' => esc_html__('Service Box 2 Text','blogbox'),
			'option_type' => 'textarea',
			'setting_type' => 'option',
			'description' => esc_html__("Enter text for your service box - html allowed",'blogbox'),
			'section' => 'home_section2',
			'priority' => 9,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		'bB_home1service3_image' => array(
			'name' => 'bB_home1service3_image',
			'title' => esc_html__('Service Box 3 Image','blogbox'),
			'option_type' => 'image',
			'setting_type' => 'option',
			'description' => 'Upload image for Service Box 3',
			'section' => 'home_section2',
			'priority' => 10,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service3_title' => array(
			'name' => 'bB_home1service3_title',
			'title' => esc_html__('Service Box 3 Title','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter a title for Service Box 3','blogbox'),
			'section' => 'home_section2',
			'priority' => 11,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_home1service3_link' => array(
			'name' => 'bB_home1service3_link',
			'title' => esc_html__('Service Box 3 Link','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Suggested Format:http://your.website.url/page/','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section2',
			'priority' => 12,
			'default' => '',
			'transport' => 'refresh',
			'sanitize' => 'esc_url_raw'
		),
		'bB_home1service3_text' => array(
			'name' => 'bB_home1service3_text',
			'title' => esc_html__('Service Box 3 Text','blogbox'),
			'option_type' => 'textarea',
			'setting_type' => 'option',
			'description' => esc_html__("Enter text for your service box - html allowed",'blogbox'),
			'section' => 'home_section2',
			'priority' => 13,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'wp_kses_post'
		),
		//Panel:Home Section:Section 3
		'bB_home1section3_onoroff' => array(
			'name' => 'bB_home1section3_onoroff',
			'title' => esc_html__('Enable Section 3','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to display Section 3','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'home_section3',
			'priority' => 1,
			'default' => 1, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_home1section3_slogan' => array(
			'name' => 'bB_home1section3_slogan',
			'title' => esc_html__('Section 3 Slogan','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter your text for your slogan','blogbox'),
			'section' => 'home_section3',
			'priority' => 2,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_home1section3_subslogan' => array(
			'name' => 'bB_home1section3_subslogan',
			'title' => esc_html__('Section 3 Sub Slogan','blogbox'),
			'option_type' => 'text',
			'setting_type' => 'option',
			'description' => esc_html__('Enter your text for your sub slogan','blogbox'),
			'section' => 'home_section3',
			'priority' => 3,
			'default' => '',
			'transport' => 'postMessage',
			'sanitize' => 'sanitize_text_field'
		),
		//Panel:Portfolio Section:Portfolio A
		'bB_portfolioA_cols' => array(
			'name' => 'bB_portfolioA_cols',
			'title' => esc_html__('Portfolio Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'1'	=>	'1',
				'2'	=>	'2',
				'3'	=>	'3',
				'4'	=>	'4'
			),
			'description' => esc_html__('How many columns do you want?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 1,
			'default' => '1',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioA_category' => array(
			'name' => 'bB_portfolioA_category',
			'title' => esc_html__('Portfolio Post Category','blogbox'),
			'option_type' => 'scat',
			'setting_type' => 'option',
			'description' => esc_html__("Enter Post Category for Portfolio",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 2,
			'default' => 'Portfolio A',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioA_content' => array(
			'name' => 'bB_portfolioA_content',
			'title' => esc_html__('Show Post Content','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('note: content is always shown in 1 column portfolios','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioA_feature_caption' => array(
			'name' => 'bB_portfolioA_feature_caption',
			'title' => esc_html__('Show Feature Image Caption','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image caption','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioA_feature_description' => array(
			'name' => 'bB_portfolioA_feature_description',
			'title' => esc_html__('Show Feature Image Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image description','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_showfeatureApost' => array(
			'name' => 'bB_showfeatureApost',
			'title' => esc_html__('Show Posts in Blog','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Include Portfolio posts in blog?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_a',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:Portfolio Section:Portfolio B
		'bB_portfolioB_cols' => array(
			'name' => 'bB_portfolioB_cols',
			'title' => esc_html__('Portfolio Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'1'	=>	'1',
				'2'	=>	'2',
				'3'	=>	'3',
				'4'	=>	'4'
			),
			'description' => esc_html__('How many columns do you want?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 1,
			'default' => '1',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioB_category' => array(
			'name' => 'bB_portfolioB_category',
			'title' => esc_html__('Portfolio Post Category','blogbox'),
			'option_type' => 'scat',
			'setting_type' => 'option',
			'description' => esc_html__("Enter Post Category for Portfolio",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 2,
			'default' => 'Portfolio B',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioB_content' => array(
			'name' => 'bB_portfolioB_content',
			'title' => esc_html__('Show Post Content','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('note: content is always shown in 1 column portfolios','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioB_feature_caption' => array(
			'name' => 'bB_portfolioB_feature_caption',
			'title' => esc_html__('Show Feature Image Caption','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image caption','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioB_feature_description' => array(
			'name' => 'bB_portfolioB_feature_description',
			'title' => esc_html__('Show Feature Image Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image description','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_showfeatureBpost' => array(
			'name' => 'bB_showfeatureBpost',
			'title' => esc_html__('Show Posts in Blog','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Include Portfolio posts in blog?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_b',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:Portfolio Section:Portfolio C
		'bB_portfolioC_cols' => array(
			'name' => 'bB_portfolioC_cols',
			'title' => esc_html__('Portfolio Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'1'	=>	'1',
				'2'	=>	'2',
				'3'	=>	'3',
				'4'	=>	'4'
			),
			'description' => esc_html__('How many columns do you want?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 1,
			'default' => '1',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioC_category' => array(
			'name' => 'bB_portfolioC_category',
			'title' => esc_html__('Portfolio Post Category','blogbox'),
			'option_type' => 'scat',
			'setting_type' => 'option',
			'description' => esc_html__("Enter Post Category for Portfolio",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 2,
			'default' => 'Portfolio C',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioC_content' => array(
			'name' => 'bB_portfolioC_content',
			'title' => esc_html__('Show Post Content','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('note: content is always shown in 1 column portfolios','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioC_feature_caption' => array(
			'name' => 'bB_portfolioC_feature_caption',
			'title' => esc_html__('Show Feature Image Caption','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image caption','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioC_feature_description' => array(
			'name' => 'bB_portfolioC_feature_description',
			'title' => esc_html__('Show Feature Image Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image description','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_showfeatureCpost' => array(
			'name' => 'bB_showfeatureCpost',
			'title' => esc_html__('Show Posts in Blog','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Include Portfolio posts in blog?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_c',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:Portfolio Section:Portfolio D
		'bB_portfolioD_cols' => array(
			'name' => 'bB_portfolioD_cols',
			'title' => esc_html__('Portfolio Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'1'	=>	'1',
				'2'	=>	'2',
				'3'	=>	'3',
				'4'	=>	'4'
			),
			'description' => esc_html__('How many columns do you want?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 1,
			'default' => '1',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioD_category' => array(
			'name' => 'bB_portfolioD_category',
			'title' => esc_html__('Portfolio Post Category','blogbox'),
			'option_type' => 'scat',
			'setting_type' => 'option',
			'description' => esc_html__("Enter Post Category for Portfolio",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 2,
			'default' => 'Portfolio D',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioD_content' => array(
			'name' => 'bB_portfolioD_content',
			'title' => esc_html__('Show Post Content','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('note: content is always shown in 1 column portfolios','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioD_feature_caption' => array(
			'name' => 'bB_portfolioD_feature_caption',
			'title' => esc_html__('Show Feature Image Caption','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image caption','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioD_feature_description' => array(
			'name' => 'bB_portfolioD_feature_description',
			'title' => esc_html__('Show Feature Image Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image description','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_showfeatureDpost' => array(
			'name' => 'bB_showfeatureDpost',
			'title' => esc_html__('Show Posts in Blog','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Include Portfolio posts in blog?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_d',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		//Panel:Portfolio Section:Portfolio E
		'bB_portfolioE_cols' => array(
			'name' => 'bB_portfolioE_cols',
			'title' => esc_html__('Portfolio Columns','blogbox'),
			'option_type' => 'select',
			'setting_type' => 'option',
			'choices' => array( 
				'1'	=>	'1',
				'2'	=>	'2',
				'3'	=>	'3',
				'4'	=>	'4'
			),
			'description' => esc_html__('How many columns do you want?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 1,
			'default' => '1',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioE_category' => array(
			'name' => 'bB_portfolioE_category',
			'title' => esc_html__('Portfolio Post Category','blogbox'),
			'option_type' => 'scat',
			'setting_type' => 'option',
			'description' => esc_html__("Enter Post Category for Portfolio",'blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 2,
			'default' => 'Portfolio E',
			'transport' => 'refresh',
			'sanitize' => 'sanitize_text_field'
		),
		'bB_portfolioE_content' => array(
			'name' => 'bB_portfolioE_content',
			'title' => esc_html__('Show Post Content','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('note: content is always shown in 1 column portfolios','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 3,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioE_feature_caption' => array(
			'name' => 'bB_portfolioE_feature_caption',
			'title' => esc_html__('Show Feature Image Caption','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image caption','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 4,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_portfolioE_feature_description' => array(
			'name' => 'bB_portfolioE_feature_description',
			'title' => esc_html__('Show Feature Image Description','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Check to show feature image description','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 5,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		),
		'bB_showfeatureEpost' => array(
			'name' => 'bB_showfeatureEpost',
			'title' => esc_html__('Show Posts in Blog','blogbox'),
			'option_type' => 'checkbox',
			'setting_type' => 'option',
			'description' => esc_html__('Include Portfolio posts in blog?','blogbox').'&nbsp;&nbsp;<span class="dashicons dashicons-update" title="Save and Reload" ></span>',
			'section' => 'portfolio_e',
			'priority' => 6,
			'default' => 0, // 0 for off
			'transport' => 'refresh',
			'sanitize' => 'wp_validate_boolean'
		)

	);
	return apply_filters( 'blogbox_get_customizer_option_parameters', $options );
}
 
/**
 * Register set up the options
*/
function blogbox_customize_register( $wp_customize ) {
	global $wp_customize;
	//Start by adding custom controls
	blogbox_add_custom_controls ();
	//Set up Customizer Panels and Sections
	blogbox_setup_panels_sections();
	
	//set up the options
	
	$blogbox_options = blogbox_get_customizer_option_partameters();

	foreach( $blogbox_options as $blogbox_option ) {
		
		if($blogbox_option['setting_type'] == 'option') {
			//add option setting
			blogbox_add_setting_option( $blogbox_option );
			//Add controls
			blogbox_add_control_option($blogbox_option);
		} else {
			//add option setting
			blogbox_add_setting_theme_mod( $blogbox_option );
			//add option control
			blogbox_add_control_theme_mod($blogbox_option);
		}
	}
}
add_action( 'customize_register', 'blogbox_customize_register' );

/** ===================== SETUP PANELS AND SECTIONS =====================
 * 
 * This helper function sets up panels and sections for Theme Customizer
 * 
 * 
 * 
 */
function blogbox_setup_panels_sections(){
	global $wp_customize;
	$groups = array();
	$group = array();
	$groups = blogbox_get_customizer_groups();
	
	foreach( $groups as $group ) {
		//add panel
		
		$wp_customize->add_panel( $group['name'], array(
			'priority'			=> $group['priority'],
			'capability'		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'				=> $group['title'],
			'description'		=> $group['description']
		) );
		
		//add sections in panel
		foreach( $group['sections'] as $section ){
			$wp_customize->add_section( $section['name'] , array(
				'priority'			=> $section['priority'],
				'capability'		=> 'edit_theme_options',
				'theme_supports'	=> '',
				'title'				=> $section['title'],
				'description'		=> $section['description'],
				'panel'				=> $group['name']
			));
		}
	}
}

/** ========================== ADD SETTING OPTION TABLE ==============================
 * 
 * This helper function loads adds a setting in Theme Customizer
 * 
 * This setting function applies to options with 'setting_type'=>'option'
 * 
 */
function blogbox_add_setting_option( $blogbox_option ){
	global $wp_customize;
	//add_setting for option
	$wp_customize->add_setting( 'theme_blogbox_options['.$blogbox_option['name'].']' , array(
		'default'				=> $blogbox_option['default'],
		'type'					=> $blogbox_option['setting_type'],
		'capability'			=> 'edit_theme_options',
		'theme_supports'		=> '',
		'transport'				=> $blogbox_option['transport'],
		'sanitize_callback'		=> $blogbox_option['sanitize'],
		//'sanitize_js_callback'	=> '',
	));
}

/** ========================== ADD SETTING THEME MOD TABLE ==============================
 * 
 * This helper function loads adds a setting in Theme Customizer
 * 
 * This setting function applies to options with 'setting_type'=>'theme_mod' 
 * 
 */
function blogbox_add_setting_theme_mod( $blogbox_option ){
	global $wp_customize;
	
	//add_setting for option
	$wp_customize->add_setting( $blogbox_option['name'] , array(
		'default'				=> $blogbox_option['default'],
		'type'					=> $blogbox_option['setting_type'],
		'capability'			=> 'edit_theme_options',
		'theme_supports'		=> '',
		'transport'				=> $blogbox_option['transport'],
		'sanitize_callback'		=> $blogbox_option['sanitize'],
		//'sanitize_js_callback'	=> '',
	));
}

/** ========================== ADD CONTROL OPTION TABLE ==============================
 * 
 * This helper function adds a control for Theme Customizer
 * 
 * This function applies to options with 'setting_type'=>'option'
 * 
 */
function blogbox_add_control_option($blogbox_option){
	global $wp_customize;
	if( $blogbox_option['option_type'] == 'text' ) {
			$wp_customize->add_control($blogbox_option['name'] , array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'textarea' ) {
			$wp_customize->add_control( $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'checkbox' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'radio' ) {
			$wp_customize->add_control($blogbox_option['name'] , array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'choices'		=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'select' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'choices'		=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'range' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'input_attrs'	=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'color' ) {
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,$blogbox_option['name'], array(
				'label'		=> $blogbox_option['title'],
				'section'	=> $blogbox_option['section'],
				'settings'	=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'		=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'	=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'image' ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,$blogbox_option['name'], array(
				'label'		=> $blogbox_option['title'],
				'section'	=> $blogbox_option['section'],
				'settings'	=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'		=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'	=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'upload' ) {
			$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize,$blogbox_option['name'], array(
				'label'		=> $blogbox_option['title'],
				'section'	=> $blogbox_option['section'],
				'settings'	=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'		=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'	=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'scat' ) {
			$wp_customize->add_control( new blogbox_Category_Dropdown_Custom_Control( $wp_customize, $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'stag' ) {
			$wp_customize->add_control( new blogbox_Tags_Dropdown_Custom_Control( $wp_customize, $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> 'theme_blogbox_options['.$blogbox_option['name'].']',
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		}
}

/** ========================== ADD CONTROL THEME MOD TABLE ==============================
 * 
 * This helper function adds a control for Theme Customizer
 * 
 * This function applies to options with 'setting_type'=>'theme_mod'
 * 
 */
function blogbox_add_control_theme_mod($blogbox_option){
	global $wp_customize;
	if( $blogbox_option['option_type'] == 'text' ) {
			$wp_customize->add_control($blogbox_option['name'] , array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'textarea' ) {
			$wp_customize->add_control( $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'checkbox' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			));
		} elseif( $blogbox_option['option_type'] == 'radio' ) {
			$wp_customize->add_control($blogbox_option['name'] , array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'choices'		=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'select' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'choices'		=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'range' ) {
			$wp_customize->add_control($blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
				'input_attrs'	=> $blogbox_option['choices'],
			));
		} elseif( $blogbox_option['option_type'] == 'color' ) {
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,$blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'image' ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,$blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'upload' ) {
			$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize,$blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'scat' ) {
			$wp_customize->add_control( new blogbox_Category_Dropdown_Custom_Control( $wp_customize, $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		} elseif( $blogbox_option['option_type'] == 'stag' ) {
			$wp_customize->add_control( new blogbox_Tags_Dropdown_Custom_Control( $wp_customize, $blogbox_option['name'], array(
				'label'			=> $blogbox_option['title'],
				'section'		=> $blogbox_option['section'],
				'settings'		=> $blogbox_option['name'],
				'type'			=> $blogbox_option['option_type'],
				'description'	=> $blogbox_option['description'],
				'priority'		=> $blogbox_option['priority'],
			)));
		}
}
/** ===================== CUSTOM CONTROLS ========================================
 * 
 * This helper function loads the Custom Controls for Theme Customizer
 * 
 * 
 * 
 */
function blogbox_add_custom_controls (){

	 /**
     * Class to create a custom category control
	  * source https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
     */
	if (class_exists('WP_Customize_Control')) {
		class blogbox_Category_Dropdown_Custom_Control extends WP_Customize_Control {
			public function render_content() {
				?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<select <?php $this->link(); ?>>
							<?php
								$args = array();
								$cats = get_categories($args);
								foreach ( $cats as $cat ) {
									//echo '<option value="'.$cat->term_id.'"'.selected($this->value(), $cat->term_id).'>'.$cat->name.'</option>';
									echo '<option value="'.$cat->name.'"'.selected($this->value(), $cat->name).'>'.$cat->name.'</option>';
								}
							?>
						</select>
					</label>
				<?php }
		}
	}
	
	 /**
     * Class to create a custom tags control
	  * modified from  https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
     */
	if (class_exists('WP_Customize_Control')) {
	    class blogbox_Tags_Dropdown_Custom_Control extends WP_Customize_Control {
          /**
           * Render the content on the theme customizer page
           */
          public function render_content() {
                ?>
                    <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                      <select <?php $this->link(); ?>>
                      <?php
                      		$tags = get_tags();
							foreach ( $tags as $tag ) {
                            	echo '<option value="'.$tag->name.'" '.selected($this->value, $tag->name).'>'.$tag->name.'</option>';
                          	}
                        ?>
                      </select>
                    </label>
                <?php
           }
    	}
	}
}

/**
 * This function sets up the option array where all 
 * the options are stored for the theme.
 * The function checks both the theme_blogbox_options table and the 
 * theme_mods_blogbox table for custom options. If the option is not there 
 * a default is loaded.
 * 
 * To use the options just add global $blogbox_options; to your function
 * and $blogbox_options['option_name'] to retrieve the option
*/
function blogbox_setup_options() {
	global $blogbox_options;
	$blogbox_stored_options = get_option('theme_blogbox_options',array());
	$blogbox_option_data = blogbox_get_customizer_option_partameters();
	$blogbox_options = array();
	foreach( $blogbox_option_data as $option_item ) {
		$name = $option_item['name'];
		$setting_type = $option_item['setting_type'];
		
		if( $setting_type == 'option' ){
			if( isset($blogbox_stored_options[ $name ]) && $blogbox_stored_options[ $name ] !== NULL ) {
				$blogbox_options[ $name ] = $blogbox_stored_options[ $name ];
			} else {
				$blogbox_options[ $name ] = $option_item[ 'default' ];
			}
		} else {
			$blogbox_options[ $name ] = get_theme_mod( $name , $option_item[ 'default' ] );
		}
	}
}
add_action( 'after_setup_theme' , 'blogbox_setup_options' );

/**
 * This function adds some styles to the WordPress Customizer
 * 
*/
function blogbox_customizer_styles() { ?>
    <style>
       	.customize-control{
        	display:block;
    		width: 100%;
    		padding: 5px 0 10px 0;
    		border-bottom: 2px solid #dbdbdb;
    		margin: 0;
        }
        .customize-control-title {
        	display: block;
        }
        .customize-control label,.customize-control-title {
		    font-size: 12px;
		    font-weight: 600;
		    line-height: 16px;
		}
		.customize-control input,
		.customize-control textarea,
		.customize-control .description,
		.customize-control select
		 {
			font-size: 12px;
		    font-weight: normal;
		    line-height: 16px;
		    margin: 5px 0 5px 0;
		}
		.blogbox-intro {
			margin: 0;
			padding: 0;
			background-color: #ffffff;
		}
		.blogbox-intro-title{
			margin: 0 0 5px 5px!important;
		}
		
		.blogbox-intro-docs {
			clear: both;
		}
		.blogbox-intro-author,
		.blogbox-intro-demo,
		.blogbox-intro-docs{
			margin: 0 0 0 5px!important;
		}
		.blogbox-intro form{
			margin: 0 0 0 0;
			display: inline-block;
		}
    </style>
    <?php
}
add_action( 'customize_controls_print_styles', 'blogbox_customizer_styles', 999 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogbox_customize_register_postmessage_support( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	//wp_die($wp_customize->get_setting( 'bB_header_background_color' )->transport);
}
add_action( 'customize_register', 'blogbox_customize_register_postmessage_support' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogbox_customize_preview_js() {
	wp_enqueue_script( 'blogbox_customizer_js', get_template_directory_uri() . '/js/kha-customizer.js', array( 'jquery','customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'blogbox_customize_preview_js' );
