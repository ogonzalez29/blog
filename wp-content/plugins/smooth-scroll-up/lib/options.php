<?php
add_action('admin_menu', 'scrollup_add_admin_menu');
add_action('admin_init', 'scrollup_settings_init');


function scrollup_add_admin_menu(  ) 
{ 

    add_options_page('Smooth Scroll Up', 'Smooth Scroll Up', 'manage_options', 'smooth_scroll_up', 'scroll_up_options_page');

}


function scrollup_settings_exist(  ) 
{ 

    if(false == get_option('scroll_up_settings') ) { 

        add_option('scroll_up_settings');

    }

}


function scrollup_settings_init(  ) 
{ 

    register_setting('scrollup_options_page', 'scrollup_settings');
    
    add_settings_section(
        'scrollup_options_section', 
        __('Options', 'smooth-scroll-up'), 
        'scrollup_options_section_callback', 
        'scrollup_options_page'
    );

    add_settings_section(
        'scrollup_show_options_section', 
        __('Show Options', 'smooth-scroll-up'), 
        'scrollup_show_options_callback', 
        'scrollup_options_page'
    );
    
    add_settings_section(
        'scrollup_advanced_options_section', 
        __('Advanced Options', 'smooth-scroll-up'), 
        'scrollup_advanced_options_callback', 
        'scrollup_options_page'
    );
    
    add_settings_field( 
        'scrollup_text', 
        __('Text', 'smooth-scroll-up'), 
        'scrollup_text_render', 
        'scrollup_options_page', 
        'scrollup_options_section' 
    );

    add_settings_field( 
        'scrollup_type', 
        __('Type', 'smooth-scroll-up'), 
        'scrollup_type_render', 
        'scrollup_options_page', 
        'scrollup_options_section' 
    );

    add_settings_field( 
        'scrollup_custom_image', 
        __('Image', 'smooth-scroll-up'), 
        'scrollup_custom_image_render', 
        'scrollup_options_page', 
        'scrollup_options_section' 
    );

    add_settings_field( 
        'scrollup_position', 
        __('Position', 'smooth-scroll-up'), 
        'scrollup_position_render', 
        'scrollup_options_page', 
        'scrollup_options_section' 
    );

    add_settings_field( 
        'scrollup_show', 
        __('Show in homepage', 'smooth-scroll-up'), 
        'scrollup_show_render', 
        'scrollup_options_page', 
        'scrollup_show_options_section' 
    );

    add_settings_field( 
        'scrollup_specific_ids', 
        __('Show/hide scroll up element from specific posts or pages', 'smooth-scroll-up'), 
        'scrollup_specific_ids_render', 
        'scrollup_options_page', 
        'scrollup_show_options_section' 
    );

    add_settings_field( 
        'scrollup_mobile', 
        __('Show in mobile devices', 'smooth-scroll-up'), 
        'scrollup_mobile_render', 
        'scrollup_options_page', 
        'scrollup_show_options_section' 
    );
    
    add_settings_field( 
        'scrollup_animation', 
        __('Show animation', 'smooth-scroll-up'), 
        'scrollup_animation_render', 
        'scrollup_options_page', 
        'scrollup_show_options_section' 
    );

    add_settings_field( 
        'scrollup_distance', 
        __('Distance from top before showing scroll up element', 'smooth-scroll-up'), 
        'scrollup_distance_render', 
        'scrollup_options_page', 
        'scrollup_show_options_section' 
    );

    add_settings_field( 
        'scrollup_attr', 
        __('Onclick event', 'smooth-scroll-up'), 
        'scrollup_attr_render', 
        'scrollup_options_page', 
        'scrollup_advanced_options_section' 
    );

}


function scrollup_text_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<input type='text' name='scrollup_settings[scrollup_text]' value='<?php echo $options['scrollup_text']; ?>'>
    <?php

}


function scrollup_type_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<select id='scrollup_type' name='scrollup_settings[scrollup_type]'>
		<option value='image' <?php selected($options['scrollup_type'], 'image'); ?>><?php _e('Image', 'smooth-scroll-up'); ?></option>
		<option value='link' <?php selected($options['scrollup_type'], 'link'); ?>><?php _e('Text link', 'smooth-scroll-up'); ?></option>
		<option value='pill' <?php selected($options['scrollup_type'], 'pill'); ?>><?php _e('Pill', 'smooth-scroll-up'); ?></option>
		<option value='tab' <?php selected($options['scrollup_type'], 'tab'); ?>><?php _e('Tab', 'smooth-scroll-up'); ?></option>
	</select>

<?php

}


function scrollup_custom_image_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    $options['scrollup_custom_image'] = ( isset($options['scrollup_custom_image']) ? $options['scrollup_custom_image'] : plugins_url(SMTH_SCRL_UP_PLUGIN_DIR . '/img/scrollup.png'));
    ?>
	<div id='scrollup_custom_image_section'>
	<input type='text' class='widefat' style="width:500px!important;" id='scrollup_upload_image' name='scrollup_settings[scrollup_custom_image]' value='<?php echo $options['scrollup_custom_image']; ?>'>
	<input type='button' class='button scrollup_upload_image_button' name='scrollup_upload_image_button' value='<?php _e('Select Image', 'smooth-scroll-up'); ?>'>
    <?php
    echo '<span style="font-size:11px;font-style:italic;">';
    echo sprintf(__('Selected image should be 38x38 pixels.', 'smooth-scroll-up'));
    echo '</span>';
    ?>
	<div style="margin-top: 5px;"><img src='' id='scrollup_upload_image_preview' style='width:38px;height38px;' /></div>
	</div>
<?php

}


function scrollup_position_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<select name='scrollup_settings[scrollup_position]'>
		<option value='left' <?php selected($options['scrollup_position'], 'left'); ?>><?php _e('Left', 'smooth-scroll-up'); ?></option>
		<option value='right' <?php selected($options['scrollup_position'], 'right'); ?>><?php _e('Right', 'smooth-scroll-up'); ?></option>
		<option value='center' <?php selected($options['scrollup_position'], 'center'); ?>><?php _e('Center', 'smooth-scroll-up'); ?></option>
	</select>

<?php

}


function scrollup_show_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<select name='scrollup_settings[scrollup_show]'>
		<option value='0' <?php selected($options['scrollup_show'], '0'); ?>><?php _e('No', 'smooth-scroll-up'); ?></option>
		<option value='1' <?php selected($options['scrollup_show'], '1'); ?>><?php _e('Yes', 'smooth-scroll-up'); ?></option>
	</select>

<?php

}


function scrollup_mobile_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<select name='scrollup_settings[scrollup_mobile]'>
		<option value='0' <?php selected($options['scrollup_mobile'], '0'); ?>><?php _e('No', 'smooth-scroll-up'); ?></option>
		<option value='1' <?php selected($options['scrollup_mobile'], '1'); ?>><?php _e('Yes', 'smooth-scroll-up'); ?></option>
	</select>

<?php

}


function scrollup_distance_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<input type='text' name='scrollup_settings[scrollup_distance]' value='<?php echo $options['scrollup_distance']; ?>'>
	<span style="font-size:11px;font-style:italic;">px</span>
    <?php

}

function scrollup_specific_ids_render(  ) 
{

    $options = get_option('scrollup_settings');
    ?>
	<select name='scrollup_settings[scrollup_specific_ids_show_hide]'>
		<option value='hide' <?php selected($options['scrollup_specific_ids_show_hide'], 'hide'); ?>><?php _e('Hide from', 'smooth-scroll-up'); ?></option>
		<option value='show' <?php selected($options['scrollup_specific_ids_show_hide'], 'show'); ?>><?php _e('Show only in', 'smooth-scroll-up'); ?></option>
	</select>
	<input type='text' name='scrollup_settings[scrollup_specific_ids]' value='<?php echo $options['scrollup_specific_ids']; ?>'>
    <?php
    echo '<span style="font-size:11px;font-style:italic;">';
    echo sprintf(__('Specify IDs of posts or pages (seperated by commas) and select to show or hide scroll up element', 'smooth-scroll-up'));
    echo '</span>';
}


function scrollup_animation_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<select name='scrollup_settings[scrollup_animation]'>
		<option value='none' <?php selected($options['scrollup_animation'], 'none'); ?>><?php _e('None', 'smooth-scroll-up'); ?></option>
		<option value='fade' <?php selected($options['scrollup_animation'], 'fade'); ?>><?php _e('Fade', 'smooth-scroll-up'); ?></option>
		<option value='slide' <?php selected($options['scrollup_animation'], 'slide'); ?>><?php _e('Slide', 'smooth-scroll-up'); ?></option>
	</select>

<?php
}


function scrollup_attr_render(  ) 
{ 

    $options = get_option('scrollup_settings');
    ?>
	<input type='text' name='scrollup_settings[scrollup_attr]' value='<?php echo $options['scrollup_attr']; ?>'>
    <?php
    echo '<span style="font-size:11px;font-style:italic;">';
    echo sprintf(__('example: type %s in order to add an event %s', 'smooth-scroll-up'), '<code>exit()</code>', '<code>exit()</code>');
    echo '</span>';
}


function scrollup_options_section_callback() { 
    echo __('This section contains basic options for Smooth Scroll Up plugin', 'smooth-scroll-up');
}

function scrollup_show_options_callback(){ 
    echo __('This section contains show options for Smooth Scroll Up plugin', 'smooth-scroll-up');
}

function scrollup_advanced_options_callback(){ 
    echo __('This section contains advanced options for Smooth Scroll Up plugin', 'smooth-scroll-up');
}

function scroll_up_options_page(  ) 
{ 

    ?>
	<form action='options.php' method='post'>
		
		<h1><?php echo __('Smooth Scroll Up', 'smooth-scroll-up'); ?></h1>
		
    <?php
    settings_fields('scrollup_options_page');
    do_settings_sections('scrollup_options_page');
    submit_button();
    ?>
		
	</form>
    <?php

}

?>
