<?php

class OptionsHandler
{
    /**
     * Constructor
     */
    public function __construct()
    {
        //Register admin scripts
        add_action( 'admin_enqueue_scripts', array( &$this, 'registerPluginAdminScripts' ) );
        add_action( 'admin_enqueue_scripts', array( &$this, 'registerPluginAdminStyles' ) );

        //Create admin menu for settings page
        add_action( 'admin_menu', array( &$this, 'scrollupOptionsAdminMenu' ) );

        //Set up admin options in settings page
        add_action( 'admin_init', array( &$this, 'scrollupOptionsInit' ) );

        //Options Page
        include_once plugin_dir_path( __FILE__ ) . '/IconsHandler.php';
    }

    /**
     * This function registers scripts on the backend
     */
    function registerPluginAdminScripts()
    {
        $currentScreen = get_current_screen();
        if ( $currentScreen->id === "settings_page_smooth-scroll-up" ) {

            //Add JQuery support
            wp_enqueue_script( 'jquery' );

            //Add media support
            wp_enqueue_media();

            //Add jQuery UI support
            wp_enqueue_script( 'jquery-ui-slider' );
            wp_enqueue_script( 'jquery-ui-dialog' );

            wp_register_script(
                'smooth-scrollup-js', plugins_url( SMTH_SCRL_UP_PLUGIN_DIR . '/js/smooth-scroll-up.js' ), '', '', true
            );
            wp_enqueue_script( 'smooth-scrollup-js' );
        }
    }

    /**
     * This function registers scripts on the backend
     */
    function registerPluginAdminStyles()
    {

        $currentScreen = get_current_screen();
        if ($currentScreen->id === "settings_page_smooth-scroll-up" ) {

            //Add jQuery UI support
            wp_enqueue_style( 'wp-jquery-ui-dialog' );

            wp_register_style(
                'font-awesome', plugins_url( SMTH_SCRL_UP_PLUGIN_DIR . '/css/font-awesome.min.css' )
            );
            wp_enqueue_style( 'font-awesome' );

            wp_register_style(
                'scrollup-css', plugins_url( SMTH_SCRL_UP_PLUGIN_DIR . '/css/scrollup-admin.css' )
            );
            wp_enqueue_style( 'scrollup-css' );
        }
    }

    /**
     * This function adds the menu item in admin menu
     */
    function scrollupOptionsAdminMenu() {
        add_options_page(
            'Smooth Scroll Up',
            'Smooth Scroll Up',
            'manage_options',
            'smooth-scroll-up',
            array( &$this, 'scrollUpOptionsPageInit' )
        );
    }

    /**
     * This function prints the options page
     */
    function scrollUpOptionsPageInit() {

        $availableTabs = array(
            'basic'          => array(
                'slug'  => 'basic',
                'title' => __( 'Basic', 'smooth-scroll-up' )
            ),
            'display'     => array(
                'slug'  => 'display',
                'title' => __( 'Display', 'smooth-scroll-up' )
            ),
            'advanced'       => array(
                'slug'  => 'advanced',
                'title' => __( 'Advanced', 'smooth-scroll-up' )
            )
        );
        $availableTabs = apply_filters( 'scrollup_filter_settings_tabs', $availableTabs );
        ?>

        <form action='options.php' method='post'>

            <div class="wrap">

                <h1><?php echo __( 'Smooth Scroll Up Options', 'smooth-scroll-up' ); ?></h1>

                <?php
                foreach ( $availableTabs as $currentTab ) {
                    do_action( "scrollup_action_settings_{$currentTab['slug']}_section" );
                    do_action( "scrollup_action_settings_{$currentTab['slug']}_fields" );
                }

                settings_fields( 'scrollUpOptionsPage' );
                do_settings_sections( 'scrollUpOptionsPage' );
                submit_button();

                ?>
            </div>

        </form>

        <?php



    }

    /**
     * This function initializes the options page
     */
    function scrollupOptionsInit() {
        register_setting( 'scrollUpOptionsPage', 'scrollup_settings' );

        //Options actions
        add_action( 'scrollup_action_settings_basic_section', array( $this, 'scrollUpOptionsPageSectionBasic' ), 99 );
        add_action( 'scrollup_action_settings_display_section', array( $this, 'scrollUpOptionsPageSectionDisplay' ), 99 );
        add_action( 'scrollup_action_settings_advanced_section', array( $this, 'scrollUpOptionsPageSectionAdvanced' ), 99 );
    }

    /**
     * This function prints the basic options page
     */
    function scrollupBasicOptionsSectionCallback() {
        echo __( 'This section contains basic options for Smooth Scroll Up plugin', 'smooth-scroll-up' );
    }

    /**
     * This function prints the display options page
     */
    function scrollupDisplayOptionsSectionCallback(){
        echo __( 'This section contains display options for Smooth Scroll Up plugin', 'smooth-scroll-up' );
    }

    /**
     * This function prints the advanced options page
     */
    function scrollupAdvancedOptionsSectionCallback(){
        echo __( 'This section contains advanced options for Smooth Scroll Up plugin', 'smooth-scroll-up' );
    }

    function scrollUpOptionsPageSectionBasic() {

        $settings_section = array(
            'scrollupBasicOptionsSection',
            __( 'Basic', 'smooth-scroll-up' ),
            array(&$this, 'scrollupBasicOptionsSectionCallback' ),
            'scrollUpOptionsPage'
        );

        call_user_func_array( 'add_settings_section',$settings_section);

        add_settings_field(
            'scrollup_type',
            __( 'Type', 'smooth-scroll-up' ),
            array(&$this, 'scrollupTypeRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );

        add_settings_field(
            'scrollup_text',
            __( 'Text', 'smooth-scroll-up' ),
            array(&$this, 'scrollupTextRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );

        add_settings_field(
            'scrollup_custom_icon',
            __( 'Icon', 'smooth-scroll-up' ),
            array(&$this, 'scrollupIconRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );

        add_settings_field(
            'scrollup_custom_icon_size',
            __( 'Icon Size', 'smooth-scroll-up' ),
            array(&$this, 'scrollupIconSizeRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );

        add_settings_field(
            'scrollup_custom_image',
            __( 'Image', 'smooth-scroll-up' ),
            array(&$this, 'scrollupCustomImageRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );

        add_settings_field(
            'scrollup_position',
            __( 'Position', 'smooth-scroll-up' ),
            array(&$this, 'scrollupPositionRender' ),
            'scrollUpOptionsPage',
            'scrollupBasicOptionsSection'
        );
    }

    function scrollupTypeRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_type'] = ( isset($options['scrollup_type']) ? $options['scrollup_type'] : 'icon' );
        ?>
        <select id='scrollup_type' name='scrollup_settings[scrollup_type]'>
            <option value='image' <?php selected($options['scrollup_type'], 'image' ); ?>><?php _e( 'Image', 'smooth-scroll-up' ); ?></option>
            <option value='icon' <?php selected($options['scrollup_type'], 'icon' ); ?>><?php _e( 'Icon', 'smooth-scroll-up' ); ?></option>
            <option value='link' <?php selected($options['scrollup_type'], 'link' ); ?>><?php _e( 'Text link', 'smooth-scroll-up' ); ?></option>
            <option value='pill' <?php selected($options['scrollup_type'], 'pill' ); ?>><?php _e( 'Pill', 'smooth-scroll-up' ); ?></option>
            <option value='tab' <?php selected($options['scrollup_type'], 'tab' ); ?>><?php _e( 'Tab', 'smooth-scroll-up' ); ?></option>
        </select>

    <?php
    }

    function scrollupTextRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_text'] = ( isset($options['scrollup_text']) ? $options['scrollup_text'] : '' );
        ?>
        <div id='scrollup_custom_text_section'>
        <input type='text' name='scrollup_settings[scrollup_text]' placeholder='Scroll to top' value='<?php echo $options['scrollup_text']; ?>'>
        </div>
        <?php
    }

    function scrollupCustomImageRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_custom_image'] = ( isset($options['scrollup_custom_image']) ? $options['scrollup_custom_image'] : plugins_url(SMTH_SCRL_UP_PLUGIN_DIR . '/img/scrollup.png' ));
        ?>
        <div id='scrollup_custom_image_section'>
        <input type='text' class='hidden' id='scrollup_upload_image' name='scrollup_settings[scrollup_custom_image]' value='<?php echo $options['scrollup_custom_image']; ?>'>
        <?php
        ?>
        <div><img src='' id='scrollup_upload_image_preview' /></div>
        <input type='button' class='button scrollup_upload_image_button' name='scrollup_upload_image_button' value='<?php _e( 'Select Image', 'smooth-scroll-up' ); ?>'>
        </div>
    <?php
    }

    function scrollupIconRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_custom_icon'] = ( isset($options['scrollup_custom_icon']) ? $options['scrollup_custom_icon'] : 'fa-arrow-circle-up' );
        $options['scrollup_custom_icon_size'] = ( isset($options['scrollup_custom_icon_size']) ? $options['scrollup_custom_icon_size'] : 'fa-2x' );
        ?>
        <div class='scrollup_custom_icon_section'>
        <input type='text' class='hidden' id='scrollup_custom_icon' name='scrollup_settings[scrollup_custom_icon]' value='<?php echo $options['scrollup_custom_icon']; ?>'>
        <?php
        ?>
        <div><i id="scrollup_custom_icon_preview" class="fa <?php echo $options['scrollup_custom_icon']; ?> <?php echo $options['scrollup_custom_icon_size']; ?> "></i>
        </div>
        <input type='button' class='button' id='scrollup_custom_icon_button' name='scrollup_custom_icon_button' value='<?php _e( 'Select Icon', 'smooth-scroll-up' ); ?>'>
        </div>

        <div id="scrollup_custom_icon_dialog" class="scrollup-custom-icon-dialog">
            <?php
                $icons = IconsHandler::getIcons();
                $current = '';
                echo '<ul>';
                foreach ( $icons as $icon ) {
                    printf(
                        '
                        <li class="scrollup-custom-icon-list-item"><a class="scrollup-custom-icon-list-icon" name="%s" href="#"><i class="fa %s %s"></i>&nbsp;&nbsp;%s</a></li>',
                        esc_attr($icon),
                        esc_attr($icon),
                        'fa-lg',
                        esc_attr($icon)
                    );
                }
                echo '</ul>';
            ?>
        </div>

    <?php
    }

    function scrollupIconSizeRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_custom_icon_size'] = ( isset($options['scrollup_custom_icon_size']) ? $options['scrollup_custom_icon_size'] : 'fa-2x' );
        ?>

        <div class='scrollup_custom_icon_section'>
        <select id='scrollup_custom_icon_size' name='scrollup_settings[scrollup_custom_icon_size]'>
            <option value='' <?php selected($options['scrollup_custom_icon_size'], '' ); ?>><?php _e( 'Tiny', 'smooth-scroll-up' ); ?></option>
            <option value='fa-lg' <?php selected($options['scrollup_custom_icon_size'], 'fa-lg' ); ?>><?php _e( 'Small', 'smooth-scroll-up' ); ?></option>
            <option value='fa-2x' <?php selected($options['scrollup_custom_icon_size'], 'fa-2x' ); ?>><?php _e( 'Normal', 'smooth-scroll-up' ); ?></option>
            <option value='fa-3x' <?php selected($options['scrollup_custom_icon_size'], 'fa-3x' ); ?>><?php _e( 'Large', 'smooth-scroll-up' ); ?></option>
            <option value='fa-4x' <?php selected($options['scrollup_custom_icon_size'], 'fa-4x' ); ?>><?php _e( 'Extra Large', 'smooth-scroll-up' ); ?></option>
            <option value='fa-5x' <?php selected($options['scrollup_custom_icon_size'], 'fa-5x' ); ?>><?php _e( 'Huge', 'smooth-scroll-up' ); ?></option>
        </select>
        </div>

    <?php
    }

    function scrollupPositionRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_position'] = ( isset($options['scrollup_position']) ? $options['scrollup_position'] : 'right' );
        ?>
        <select name='scrollup_settings[scrollup_position]'>
            <option value='left' <?php selected($options['scrollup_position'], 'left' ); ?>><?php _e( 'Left', 'smooth-scroll-up' ); ?></option>
            <option value='right' <?php selected($options['scrollup_position'], 'right' ); ?>><?php _e( 'Right', 'smooth-scroll-up' ); ?></option>
            <option value='center' <?php selected($options['scrollup_position'], 'center' ); ?>><?php _e( 'Center', 'smooth-scroll-up' ); ?></option>
        </select>
    <?php
    }

    function scrollUpOptionsPageSectionDisplay() {

        $settings_section = array(
            'scrollupDisplayOptionsSection',
            __( 'Display', 'smooth-scroll-up' ),
            array(&$this, 'scrollupDisplayOptionsSectionCallback' ),
            'scrollUpOptionsPage'
        );

        call_user_func_array( 'add_settings_section',$settings_section);

        add_settings_field(
            'scrollup_show',
            __( 'Display in homepage', 'smooth-scroll-up' ),
            array(&$this, 'scrollupDisplayRender' ),
            'scrollUpOptionsPage',
            'scrollupDisplayOptionsSection'
        );

        add_settings_field(
            'scrollup_specific_ids',
            __( 'Display/hide scroll up element from specific posts or pages', 'smooth-scroll-up' ),
            array(&$this, 'scrollupSpecificIdsRender' ),
            'scrollUpOptionsPage',
            'scrollupDisplayOptionsSection'
        );

        add_settings_field(
            'scrollup_mobile',
            __( 'Display in mobile devices', 'smooth-scroll-up' ),
            array(&$this, 'scrollupMobileRender' ),
            'scrollUpOptionsPage',
            'scrollupDisplayOptionsSection'
        );

        add_settings_field(
            'scrollup_animation',
            __( 'Display animation', 'smooth-scroll-up' ),
            array(&$this, 'scrollupAnimationRender' ),
            'scrollUpOptionsPage',
            'scrollupDisplayOptionsSection'
        );

        add_settings_field(
            'scrollup_distance',
            __( 'Distance from top before displaying scroll up element', 'smooth-scroll-up' ),
            array(&$this, 'scrollupDistanceRender' ),
            'scrollUpOptionsPage',
            'scrollupDisplayOptionsSection'
        );
    }

    function scrollupDisplayRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_show'] = ( isset($options['scrollup_show']) ? $options['scrollup_show'] : '0' );
        ?>
        <select name='scrollup_settings[scrollup_show]'>
            <option value='0' <?php selected($options['scrollup_show'], '0' ); ?>><?php _e( 'No', 'smooth-scroll-up' ); ?></option>
            <option value='1' <?php selected($options['scrollup_show'], '1' ); ?>><?php _e( 'Yes', 'smooth-scroll-up' ); ?></option>
        </select>
    <?php
    }


    function scrollupMobileRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_mobile'] = ( isset($options['scrollup_mobile']) ? $options['scrollup_mobile'] : '0' );
        ?>
        <select name='scrollup_settings[scrollup_mobile]'>
            <option value='0' <?php selected($options['scrollup_mobile'], '0' ); ?>><?php _e( 'No', 'smooth-scroll-up' ); ?></option>
            <option value='1' <?php selected($options['scrollup_mobile'], '1' ); ?>><?php _e( 'Yes', 'smooth-scroll-up' ); ?></option>
        </select>
    <?php
    }


    function scrollupDistanceRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_distance'] = ( isset($options['scrollup_distance']) ? $options['scrollup_distance'] : '' );
        ?>
        <input type='text' name='scrollup_settings[scrollup_distance]' placeholder='300' value='<?php echo $options['scrollup_distance']; ?>'>
        <span class='scrollup-help-text'>px</span>
        <?php
    }

    function scrollupSpecificIdsRender() {
        $options = get_option( 'scrollup_settings' );
        $options['scrollup_specific_ids_display_hide'] = ( isset($options['scrollup_specific_ids_display_hide']) ? $options['scrollup_specific_ids_display_hide'] : 'hide' );
        $options['scrollup_specific_ids'] = ( isset($options['scrollup_specific_ids']) ? $options['scrollup_specific_ids'] : '' );
        ?>
        <select name='scrollup_settings[scrollup_specific_ids_display_hide]'>
            <option value='hide' <?php selected($options['scrollup_specific_ids_display_hide'], 'hide' ); ?>><?php _e( 'Hide from', 'smooth-scroll-up' ); ?></option>
            <option value='display' <?php selected($options['scrollup_specific_ids_display_hide'], 'display' ); ?>><?php _e( 'Display only in', 'smooth-scroll-up' ); ?></option>
        </select>
        <input type='text' name='scrollup_settings[scrollup_specific_ids]' placeholder='1,2,5' value='<?php echo $options['scrollup_specific_ids']; ?>'>
        <?php
        echo '<span class="scrollup-help-text">';
        echo sprintf(__( 'Specify IDs of posts or pages (seperated by commas) and select to display or hide scroll up element', 'smooth-scroll-up' ));
        echo '</span>';
    }


    function scrollupAnimationRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_animation'] = ( isset($options['scrollup_animation']) ? $options['scrollup_animation'] : 'none' );
        ?>
        <select name='scrollup_settings[scrollup_animation]'>
            <option value='none' <?php selected($options['scrollup_animation'], 'none' ); ?>><?php _e( 'None', 'smooth-scroll-up' ); ?></option>
            <option value='fade' <?php selected($options['scrollup_animation'], 'fade' ); ?>><?php _e( 'Fade', 'smooth-scroll-up' ); ?></option>
            <option value='slide' <?php selected($options['scrollup_animation'], 'slide' ); ?>><?php _e( 'Slide', 'smooth-scroll-up' ); ?></option>
        </select>

    <?php
    }

    function scrollUpOptionsPageSectionAdvanced() {

        $settings_section = array(
            'scrollupAdvancedOptionsSection',
            __( 'Advanced', 'smooth-scroll-up' ),
            array(&$this, 'scrollupAdvancedOptionsSectionCallback' ),
            'scrollUpOptionsPage'
        );

        call_user_func_array( 'add_settings_section',$settings_section);

        add_settings_field(
            'scrollup_custom_css',
            __( 'Custom CSS Code', 'smooth-scroll-up' ),
            array(&$this, 'scrollupCustomCSSRender' ),
            'scrollUpOptionsPage',
            'scrollupAdvancedOptionsSection'
        );

        add_settings_field(
            'scrollup_custom_js',
            __( 'Custom Javascript Code', 'smooth-scroll-up' ),
            array(&$this, 'scrollupCustomJSRender' ),
            'scrollUpOptionsPage',
            'scrollupAdvancedOptionsSection'
        );

        add_settings_field(
            'scrollup_attr',
            __( 'Onclick event', 'smooth-scroll-up' ),
            array(&$this, 'scrollupAttrRender' ),
            'scrollUpOptionsPage',
            'scrollupAdvancedOptionsSection'
        );
    }

    function scrollupCustomCSSRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_custom_css'] = ( isset($options['scrollup_custom_css']) ? $options['scrollup_custom_css'] : '' );
        ?>
        <textarea name='scrollup_settings[scrollup_custom_css]' placeholder='Add your CSS code here' rows="4" cols="50"><?php echo $options['scrollup_custom_css']; ?></textarea>
        <?php
    }

    function scrollupCustomJSRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_custom_js'] = ( isset($options['scrollup_custom_js']) ? $options['scrollup_custom_js'] : '' );
        ?>
        <textarea name='scrollup_settings[scrollup_custom_js]' placeholder='Add your JS code here' rows="4" cols="50"><?php echo $options['scrollup_custom_js']; ?></textarea>
        <?php
    }

    function scrollupAttrRender() {

        $options = get_option( 'scrollup_settings' );
        $options['scrollup_attr'] = ( isset($options['scrollup_attr']) ? $options['scrollup_attr'] : '' );
        ?>
        <input type='text' name='scrollup_settings[scrollup_attr]' placeholder='exit()' value='<?php echo $options['scrollup_attr']; ?>'>
        <?php
        echo '<span class="scrollup-help-text">';
        echo sprintf(__( 'example: type %s in order to add an event %s', 'smooth-scroll-up' ), '<code>exit()</code>', '<code>exit()</code>' );
        echo '</span>';
    }

}
