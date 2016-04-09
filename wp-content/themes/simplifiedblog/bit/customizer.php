<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class simplifiedblog_Customize {
   /**
    * This hooks into 'customize_register' and allows
    * you to add new sections and controls to the Theme Customize screen.
    */
   public static function simplifiedblog_register ( $wp_customize ) {

        // Simplifiedblog Logo
        $wp_customize->add_section( 'simplifiedblog_logo' , array(
        'title'      => __( 'Logo', 'simplifiedblog' ),
        'priority'   => 25,
		));
		
        // Container Width
        $wp_customize->add_section( 'simplifiedblog_container_width' , array(
        'title'      => __( 'Width', 'simplifiedblog' ),
        'priority'   => 30,
        ));
		
        // Layout
        $wp_customize->add_section( 'simplifiedblog_layout', array(
        'title'      => __('Layout Options', 'simplifiedblog'),
        'priority'   => 40,
        ));
		
        // Font Options
        $wp_customize->add_section( 'simplifiedblog_fonts' , array(
        'title'      => __( 'Font Options', 'simplifiedblog' ),
        'priority'   => 50,
        ));
		
        // Meta Options
        $wp_customize->add_section( 'simplifiedblog_meta' , array(
        'title'      => __( 'Meta Options', 'simplifiedblog' ),
        'priority'   => 60,
        ));
		
        // -----------------------------------------------------------------------------

        /**
        * Show/Hide meta for posts
        */
        $wp_customize->add_setting( 'simplifiedblog_show_meta', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_meta',
          array(
            'description' => __( 'Both single and blog views', 'simplifiedblog' ),
            'type' => 'checkbox',
            'label' => __( 'HIDE ALL meta info for posts', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
            'std' => '0',
        ));
        // -----------------------------------------------------------------------------

        /**
        * Show/Hide meta for pages
        */
        $wp_customize->add_setting( 'simplifiedblog_show_meta_pages', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_meta_pages',
          array(
            'description' => __( 'If checked - no meta info for pages.', 'simplifiedblog' ),
            'type' => 'checkbox',
            'label' => __( 'HIDE ALL meta info for pages', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
            'std' => '0',
        ));
        // -----------------------------------------------------------------------------
		
        /**
        * Show/Hide categories on posts
        */
        $wp_customize->add_setting( 'simplifiedblog_show_cat', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_cat',
          array(
            'type' => 'checkbox',
            'label' => __( 'Hide categories in post meta', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
            'std' => '1',
        ));
        // -----------------------------------------------------------------------------

        /**
        * Show/Hide date on posts
        */
        $wp_customize->add_setting( 'simplifiedblog_show_date', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_date',
          array(
            'type' => 'checkbox',
            'label' => __( 'Hide date in post meta', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
        ));
        // -----------------------------------------------------------------------------
       
	    /**
        * Show/Hide tags on posts
        */
        $wp_customize->add_setting( 'simplifiedblog_show_tags', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_tags',
          array(
            'type' => 'checkbox',
            'label' => __( 'Hide tags in post meta', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
        ));
        // -----------------------------------------------------------------------------
	    
		/**
        * Show/Hide comment count on posts
        */
        $wp_customize->add_setting( 'simplifiedblog_show_comm', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_show_comm',
          array(
            'type' => 'checkbox',
            'label' => __( 'Hide comment link in post meta', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
        ));
        // -----------------------------------------------------------------------------
		
		/**
        * Show/Hide author on posts
        */
        $wp_customize->add_setting( 'simplifiedblog_autho', array(
            'sanitize_callback' => 'simplifiedblog_sanitize_checkbox',
        ));

        $wp_customize->add_control(
          'simplifiedblog_autho',
          array(
            'type' => 'checkbox',
            'label' => __( 'Hide author in post meta', 'simplifiedblog' ),
            'section' => 'simplifiedblog_meta',
        ));
        // -----------------------------------------------------------------------------
        
		/**
        * Link hover color
        */
        $wp_customize->add_setting( 'sheet_color' , array(
            'default'     => '#FFF',
            'transport'   => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
            ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simplifiedblog_sheet_color', array(
            'label'        => __( 'Blogging area Color', 'simplifiedblog' ),
            'section'    => 'colors',
            'settings'   => 'sheet_color',
        )));      
		// -----------------------------------------------------------------------------	
        
		/**
        * Primary color
        */
        $wp_customize->add_setting( 'primary_color' , array(
            'default'     => '#000000',
            'transport'   => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
            ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simplifiedblog_primary_color', array(
            'label'        => __( 'Text Color', 'simplifiedblog' ),
            'section'    => 'colors',
            'settings'   => 'primary_color',
        )));
        // -----------------------------------------------------------------------------
		
        /*
        * Heading Link Color
        */ 
        $wp_customize->add_setting( 'heading_linkcolor', 
            array(
                'default' => '#333', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'postMessage', 
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );      
            
        $wp_customize->add_control( new WP_Customize_Color_Control( 
            $wp_customize, 
            'simplifiedblog_heading_linkcolor',
            array(
                'label' => __( 'Headings Color', 'simplifiedblog' ), 
                'section' => 'colors', 
                'settings' => 'heading_linkcolor', 
                'priority' => 10,
            ) 
        ));
        // -----------------------------------------------------------------------------
        
		/*
        * Link Color
        */ 
        $wp_customize->add_setting( 'link_textcolor', 
            array(
            'default' => '#9b0000',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options', 
            'sanitize_callback' => 'sanitize_hex_color',
        ));           

        $wp_customize->add_control( new WP_Customize_Color_Control( 
            $wp_customize, 
            'simplifiedblog_link_textcolor', 
            array(
            'label' => __( 'Links Color', 'simplifiedblog' ), 
            'section' => 'colors', 
            'settings' => 'link_textcolor', 
            'priority' => 10, 
            ) 
        ));     
	    // -----------------------------------------------------------------------------
      
	    /**
        * Link hover color
        */
        $wp_customize->add_setting( 'hover_color' , array(
            'default'     => '#F00',
            'sanitize_callback' => 'sanitize_hex_color',
            ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simplifiedblog_hover_color', array(
            'label'        => __( 'Hover Color', 'simplifiedblog' ),
            'section'    => 'colors',
            'settings'   => 'hover_color',
        )));
        // -----------------------------------------------------------------------------		
	    
		/**
        * Tagline color
        */
        $wp_customize->add_setting( 'tagline_color' , array(
            'default'     => '#888',
            'transport'   => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
            ));

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simplifiedblog_tagline_color', array(
            'label'        => __( 'Misc Color', 'simplifiedblog' ),
            'section'    => 'colors',
			'description' => __( 'Post meta, menu items and some other interface elements use it.', 'simplifiedblog' ),
            'settings'   => 'tagline_color',
        )));
        // -----------------------------------------------------------------------------
        
		/*
        * Blog Layout
        */
        $wp_customize->add_setting('bloglayout', array(
            'default'        => 'right',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'sanitize_callback' => 'simplifiedblog_sanitize_layout',
        ));

        $wp_customize->add_control('simplifiedblog_option_bloglayout', array(
            'label'      => __('Blog layout', 'simplifiedblog'),
            'section'    => 'simplifiedblog_layout',
            'settings'   => 'bloglayout',
            'description' => '',
            'type'       => 'radio',
            'choices'    => array(
                'left' => __('Left Sidebar', 'simplifiedblog'),
                'full_width' => __('Full Width / No sidebar', 'simplifiedblog'),
                'right'   => __('Right Sidebar', 'simplifiedblog')
                ),
        ));
        // -----------------------------------------------------------------------------
        
		/*
        * Post Layout
        */
        $wp_customize->add_setting('postlayout', array(
            'default'        => 'right',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'sanitize_callback' => 'simplifiedblog_sanitize_layout',
        ));

        $wp_customize->add_control('simplifiedblog_option_postlayout', array(
            'label'      => __('Single post layout', 'simplifiedblog'),
            'section'    => 'simplifiedblog_layout',
            'settings'   => 'postlayout',
            'description' => '',
            'type'       => 'radio',
            'choices'    => array(
                'left' => __('Left Sidebar', 'simplifiedblog'),
                'full_width' => __('Full Width / No sidebar', 'simplifiedblog'),
                'right'   => __('Right Sidebar', 'simplifiedblog')
                ),
        ));
        // -----------------------------------------------------------------------------
       
	    /*
        * Page Layout
        */
        $wp_customize->add_setting('pagelayout', array(
            'default'        => 'right',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'sanitize_callback' => 'simplifiedblog_sanitize_layout',
        ));

        $wp_customize->add_control('simplifiedblog_option_pagelayout', array(
            'label'      => __('Single page layout', 'simplifiedblog'),
            'section'    => 'simplifiedblog_layout',
            'settings'   => 'pagelayout',
            'description' => '',
            'type'       => 'radio',
            'choices'    => array(
                'left' => __('Left Sidebar', 'simplifiedblog'),
                'full_width' => __('Full Width / No sidebar', 'simplifiedblog'),
                'right'   => __('Right Sidebar', 'simplifiedblog')
                ),
        ));
        // -----------------------------------------------------------------------------
        
		/**
        * Site width
        */
        $wp_customize->add_setting('container_width', array(
            'default'        => '980px',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'sanitize_callback' => 'simplifiedblog_sanitize_width',
            ));

        $wp_customize->add_control('simplifiedblog_option_container_width', array(
            'label'      => __('Width', 'simplifiedblog'),
            'section'    => 'simplifiedblog_container_width',
            'settings'   => 'container_width',
            'description' => __('Choose max site width (in pixels).', 'simplifiedblog'),
            'type'       => 'radio',
            'choices'    => array(
			    '980px' => __('980', 'simplifiedblog'),
                '1280px' => __('1280', 'simplifiedblog'),
                '1400px' => __('1400', 'simplifiedblog'),
                '1600px' => __('1600', 'simplifiedblog'),
                '1920px' => __('1920', 'simplifiedblog')
                ),
        ));
        // -----------------------------------------------------------------------------
       
	    /**
        * Headings
        */
        $wp_customize->add_setting('headings_font', array(
            'default'        => 'Merriweather Sans',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'transport' => 'postMessage', 
            'sanitize_callback' => 'simplifiedblog_sanitize_fontfamily',
            ));

        $wp_customize->add_control('simplifiedblog_headings_font', array(
            'label'      => __('Heading Font', 'simplifiedblog'),
            'section'    => 'simplifiedblog_fonts',
            'settings'   => 'headings_font',
            'description' => __('Pick a font for headings (save and press F5 to see changes)', 'simplifiedblog'),
            'type'       => 'select',
            'choices'    => array(
                'Open Sans' => 'Open Sans',
                'Merriweather Sans' => 'Merriweather Sans',
                'Noto Serif' => 'Noto Serif',
                'Noto Sans' => 'Noto Sans',
				'PT Sans' => 'PT Sans',
                'Arial' => 'Arial',
                'Verdana' => 'Verdana',
                'Times New Roman' => 'Times New Roman',
                'Monospace' => 'Monospace',
                'Neucha' => 'Neucha',
                'Lobster' => 'Lobster',
				),
        ));
        // -----------------------------------------------------------------------------	
      
	    /**
        * Body Font
        */
        $wp_customize->add_setting('body_font', array(
            'default'        => 'Open Sans',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            'sanitize_callback' => 'simplifiedblog_sanitize_fontfamily',
            ));

        $wp_customize->add_control('simplifiedblog_body_font', array(
            'label'      => __('Body Font', 'simplifiedblog'),
            'section'    => 'simplifiedblog_fonts',
            'settings'   => 'body_font',
            'description' => __('Pick a font for body text (save and press F5 to see changes', 'simplifiedblog'),
            'type'       => 'select',
            'choices'    => array(
                'Open Sans' => 'Open Sans',
                'Merriweather Sans' => 'Merriweather Sans',
                'Noto Serif' => 'Noto Serif',
                'Noto Sans' => 'Noto Sans',
				'PT Sans' => 'PT Sans',
                'Arial' => 'Arial',
                'Verdana' => 'Verdana',
                'Times New Roman' => 'Times New Roman',
                'Monospace' => 'Monospace',
                'Neucha' => 'Neucha',
                'Lobster' => 'Lobster',
				),
            ));	
        // -----------------------------------------------------------------------------	
       
	    /**
        * Headings
        */
        $wp_customize->add_setting('headings_weight', array(
            'default'        => '400',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'transport' => 'postMessage', 
            'sanitize_callback' => 'simplifiedblog_sanitize_weight',
            ));

        $wp_customize->add_control('simplifiedblog_headings_weight', array(
            'label'      => __('Heading weight', 'simplifiedblog'),
            'section'    => 'simplifiedblog_fonts',
            'settings'   => 'headings_weight',
            'description' => __('Bold or normal headings?', 'simplifiedblog'),
            'type'       => 'select',
            'choices'    => array(
                '400' => __('Normal', 'simplifiedblog'),
                '800' => __('Bold', 'simplifiedblog'),
                ),
            ));	
        // -----------------------------------------------------------------------------
 
        
		/**
        logo
        */
        $wp_customize->add_setting( 'simplifiedblog_logo', array(
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simplifiedblog_logo_option', array(
        'label'    => __( 'Logo', 'simplifiedblog' ),
        'section'  => 'simplifiedblog_logo',
        'settings' => 'simplifiedblog_logo',
        )));
       	// -----------------------------------------------------------------------------
       
	    /**
        logo (or title) alignment
        */
        $wp_customize->add_setting('logo_alignment', array(
            'default'        => 'center',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'sanitize_callback' => 'simplifiedblog_sanitize_align',
            ));

        $wp_customize->add_control('simplifiedblog_logo_alignment', array(
            'label'      => __('Logo alignment', 'simplifiedblog'),
            'section'    => 'simplifiedblog_logo',
            'settings'   => 'logo_alignment',
            'description' => __( 'Where will the logo be?', 'simplifiedblog' ),
            'type'       => 'radio',
            'choices'    => array(
                'left' => __( 'Left', 'simplifiedblog' ),
                'center' => __( 'Center', 'simplifiedblog' ),
                'right' => __( 'Right', 'simplifiedblog' ),
                ),
            ));	
        // -----------------------------------------------------------------------------
       
	    /**
        footer copyright text
        */
        $wp_customize->add_setting('footer_copyright', array(
            'default'        => '',
            'capability'     => 'edit_theme_options',
            'type'           => 'theme_mod',
            'transport'      => 'refresh',
            'sanitize_callback' => 'simplifiedblog_sanitize_footer',
            ));

        $wp_customize->add_control('simplifiedblog_footer_copyright', array(
            'label'      => __('Footer Copyright', 'simplifiedblog'),
            'section'    => 'title_tagline',
            'settings'   => 'footer_copyright'
        ));
        // -----------------------------------------------------------------------------           



		//Upgrade to PRO Section
		$wp_customize->add_section( 'simplified_pro_add', array(
			  'priority'       => 1001,
			  'title'          => __('Upgrade to Simplified PRO', 'simplifiedblog'),
			  'description'    => __('<p>
			  Do you like Simplified theme? You can update to Simplified Pro to support the developer and get even more exciting features:</p>
				<ul style="font-weight:bold;padding-left:10px;">
				<li>Premium widget pack. Pixel perfect and designed to look great with your theme.</li>
				<li>Breadcrumbs navigation support</li>
				<li>30+ Google fonts</li>
				<li>Featured image support for posts and pages</li>
				<li>Lifetime updates for Simplified Pro theme</li>
				<li>Premium support for 1 year!</li>			
				</ul>		  
			  <h2 style="padding-left:10px;">
			  <a href="http://www.poisonedcoffee.com/simplifiedpro/">Read More</a>
			  </h2>
			  <h2 style="padding-left:10px;"><a href="http://www.poisonedcoffee.com/forums/">Support forums</a>
			  </h2>
			  ', 'simplifiedblog'),
			));
		// -----------------------------------------------------------------------------
		$wp_customize->add_setting('simplified_pro_info', array(
          'sanitize_callback' => 'simplifiedblog_no_sanitize',
		  'type' => 'info_control',
		  'capability' => 'edit_theme_options',
		  )
		);
		$wp_customize->add_control( 'simplified_pro_info_control', array(
			'section' => 'simplified_pro_add',
			'settings' => 'simplified_pro_info',
			'priority' => 10,
            'type'       => 'radio',
			'style' => 'display: none;',
			)
		);
		// ----------------------------------------------------------------------------- 

		// Stuff that uses live preview JS
        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
        $wp_customize->get_setting( 'heading_linkcolor' )->transport = 'postMessage';
        $wp_customize->get_setting( 'primary_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'tagline_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
        $wp_customize->get_setting( 'headings_weight' )->transport = 'postMessage';
        $wp_customize->get_setting( 'headings_font' )->transport = 'postMessage';
        $wp_customize->get_setting( 'body_font' )->transport = 'postMessage';
   }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * Used by hook: 'wp_head'
    */
   public static function simplifiedblog_header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
 
		  <?php 			
		  if (get_theme_mod('simplifiedblog_show_date') == '1'){ ?>
			  .s_date {display: none;} <?php }		
		  if (get_theme_mod('simplifiedblog_show_tags') == '1'){ ?>
			  .s_tags {display: none;} <?php }			
		  if (get_theme_mod('simplifiedblog_show_cat') == '1'){ ?>
			  .s_category {display: none;} <?php }		
		  if (get_theme_mod('simplifiedblog_show_comm') == '1'){ ?>
			  .s_comm {display: none;} <?php }		
		  if (get_theme_mod('simplifiedblog_autho') == '1'){ ?>
			  .s_auth {display: none;} <?php } 						

self::simplifiedblog_generate_css('#logo', 'text-align', 'logo_alignment');  
self::simplifiedblog_generate_css('.tlo', 'max-width', 'container_width');
self::simplifiedblog_generate_css('body, input, textarea, .site-description', 'font-family', 'body_font');
self::simplifiedblog_generate_css('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1, h2, h3, h4, h5, h6', 'font-family', 'headings_font');
self::simplifiedblog_generate_css('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1, h2, h3, h4, h5, h6, .site-description', 'font-weight', 'headings_weight');
self::simplifiedblog_generate_css('input:hover, textarea:hover, input:focus, textarea:focus, .sticky', 'border-color', 'link_textcolor');
self::simplifiedblog_generate_css('h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1, h2, h3, h4, h5, h6', 'color', 'heading_linkcolor');
self::simplifiedblog_generate_css('body, input, textarea', 'color', 'primary_color'); 
self::simplifiedblog_generate_css('input, textarea, .wp-editor-area, #menuline ul.sub-menu, #menuline nav ul, .menu-item-has-children', 'border-color', 'tagline_color');
self::simplifiedblog_generate_css('.postline, footer.postline a, .archive-title, .format-status .postcontent, .format-quote .postcontent .quote, .fa-quote-left, .reply, .reply a, .comment-meta a', 'color', 'tagline_color');
self::simplifiedblog_generate_css('a', 'color', 'link_textcolor');
self::simplifiedblog_generate_css('.tlo, input, textarea, #menuline ul.sub-menu', 'background-color', 'sheet_color');
self::simplifiedblog_generate_css('a:active, a:focus, a:hover, footer.postline a:hover', 'color', 'hover_color');
?>
 	
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
   Outputs the javascript needed to automate the live settings preview.
    */
   public static function simplifiedblog_live_preview() {
      wp_enqueue_script( 'theme-customizer', get_template_directory_uri() . '/bit/theme-customizer.js', array(  'jquery', 'customize-preview' ), '', true);
   }

    /**
	Generate a line of CSS for use in header output. If the setting ($mod_name) has no defined value, the CSS will not be output.
     */
   public static function simplifiedblog_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
	$mod = esc_attr( get_theme_mod($mod_name) );
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'simplifiedblog_Customize' , 'simplifiedblog_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'simplifiedblog_Customize' , 'simplifiedblog_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'simplifiedblog_Customize' , 'simplifiedblog_live_preview' ) );
?>