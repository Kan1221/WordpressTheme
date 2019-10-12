<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'redux_demo',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
       /*define custom fiekld*/
       $redux_top_bar_options = array(
                'search' => __( 'Search', 'redux-framework-demo' ),
                'language' => __( 'Language selector (WPML or Polylang Required)', 'redux-framework-demo' ),
            );
        $redux_social_options = array(
                                    'twitter' => 'Twitter',
                                    'facebook' => 'Facebook',
                                    'google-plus' => 'Google Plus',
                                    'instagram' => 'Instagram',
                                    'linkedin' => 'LinkedIn',
                                    'tumblr' => 'Tumblr',
                                    'pinterest' => 'Pinterest',
                                    'github' => 'Github',
                                    'dribbble' => 'Dribbble',
                                    'reddit' => 'reddit',
                                    'flickr' => 'Flickr',
                                    'skype' => 'Skype',
                                    'youtube' => 'YouTube',
                                    'vimeo-square' => 'Vimeo',
                                    'soundcloud' => 'SoundCloud',
                                    'wechat' => 'WeChat',
                                    'weibo' => 'Weibo',
                                    'renren' => 'Renren',
                                    'qq' => 'QQ',
                                    'xing' => 'XING',
                                    'rss' => 'RSS',
                                    'vk' => 'VK',
                                    'behance' => 'Behance',
                                    'foursquare' => 'Foursquare',
                                    'steam' => 'Steam',
                                    'twitch' => 'Twitch',
                                    'houzz' => 'Houzz',
                                    'yelp' => 'Yelp',

                                );
            $redux_align_selection = array(
                'left' => __( 'Left', 'redux-framework-demo' ),
                'center' => __( 'Center', 'redux-framework-demo' ),
                'right' => __( 'Right', 'redux-framework-demo' ),
            );

            $redux_align_selection_extra = array(
                'left' => __( 'Left', 'redux-framework-demo' ),
                'center' => __( 'Center', 'redux-framework-demo' ),
                'right' => __( 'Right', 'redux-framework-demo' ),
            );

            $redux_background_type = array(
                'transparent' => __( 'None', 'redux-framework-demo' ),
                'colored' => __( 'Background', 'redux-framework-demo' ),
                'advanced' => __( 'Stretched Background', 'redux-framework-demo' ),
            );
            $redux_retina_support_selection = array(
                'default' => __( 'Theme Defined Images Only', 'redux-framework-demo' ),
                'full' => __( 'Full', 'redux-framework-demo' ),
                'disabled' => __( 'Disabled', 'redux-framework-demo' ),
            );
            $redux_blog_columns_selection_mobile = array(
                '1' => '1',
                '2' => '2',
            );

            $redux_top_bar_options = array(
                'search' => __( 'Search', 'redux-framework-demo' ),
                'language' => __( 'Language selector (WPML or Polylang Required)', 'redux-framework-demo' ),
            );
            $redux_blog_social_options = array(
                'twitter' => 'Twitter',
                'facebook' => 'Facebook',
                'linkedin' => 'LinkedIn',
                'google-plus' => 'Google Plus',
                'eut-likes' => '(Euthemians) Likes',
            );

            $redux_menu_animations = array(
                'none' => __( 'None', 'redux-framework-demo' ),
                'fade-in' => __( 'Fade in', 'redux-framework-demo' ),
                'fade-in-up' => __( 'Fade in Up', 'redux-framework-demo' ),
                'fade-in-down' => __( 'Fade in Down', 'redux-framework-demo' ),
                'fade-in-left' => __( 'Fade in Left', 'redux-framework-demo' ),
                'fade-in-right' => __( 'Fade in Right', 'redux-framework-demo' ),
            );
            $redux_menu_pointers = array(
                'none' => __( 'None', 'redux-framework-demo' ),
                'arrow' => __( 'Arrow', 'redux-framework-demo' ),
            );

            $redux_color_selection = array(
                'dark' => __( 'Dark', 'redux-framework-demo' ),
                'light' => __( 'Light', 'redux-framework-demo' ),
                'primary-1' => __( 'Primary 1', 'redux-framework-demo' ),
                'primary-2' => __( 'Primary 2', 'redux-framework-demo' ),
                'primary-3' => __( 'Primary 3', 'redux-framework-demo' ),
                'primary-4' => __( 'Primary 4', 'redux-framework-demo' ),
                'primary-5' => __( 'Primary 5', 'redux-framework-demo' ),
            );

            $redux_bg_color_selection = array(
                'none' => __( 'None', 'redux-framework-demo' ),
                'dark' => __( 'Dark', 'redux-framework-demo' ),
                'light' => __( 'Light', 'redux-framework-demo' ),
                'primary-1' => __( 'Primary 1', 'redux-framework-demo' ),
                'primary-2' => __( 'Primary 2', 'redux-framework-demo' ),
                'primary-3' => __( 'Primary 3', 'redux-framework-demo' ),
                'primary-4' => __( 'Primary 4', 'redux-framework-demo' ),
                'primary-5' => __( 'Primary 5', 'redux-framework-demo' ),
            );

            $redux_sidebar_style_selection = array(
                'simple' => __( 'Simple', 'redux-framework-demo' ),
                'box' => __( 'Box', 'redux-framework-demo' ),
            );

            $redux_menu_responsibe_style_selection = array(
                '1' => __( 'Style 1', 'redux-framework-demo' ),
                '2' => __( 'Style 2', 'redux-framework-demo' ),
            );

            $redux_menu_responsibe_toggle_selection = array(
                'icon' => __( 'Icon', 'redux-framework-demo' ),
                'text' => __( 'Text', 'redux-framework-demo' ),
            );
             $redux_footer_column_selection = array(
                'footer-1' => array('alt' => __( 'Footer 1', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-1.png' ),
                'footer-2' => array('alt' => __( 'Footer 2', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-2.png' ),
                'footer-3' => array('alt' => __( 'Footer 3', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-3.png' ),
                'footer-4' => array('alt' => __( 'Footer 4', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-4.png' ),
                'footer-5' => array('alt' => __( 'Footer 5', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-5.png' ),
                'footer-6' => array('alt' => __( 'Footer 6', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-6.png' ),
                'footer-7' => array('alt' => __( 'Footer 7', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-7.png' ),
                'footer-8' => array('alt' => __( 'Footer 8', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-8.png' ),
                'footer-9' => array('alt' => __( 'Footer 9', 'redux-framework-demo' ), 'img' => get_template_directory_uri() . '/inc/admin/images/footer/footer-9.png' ),
            );
            $redux_opacity_selection = array(
                '0'    => '0%',
                '0.05' => '5%',
                '0.10' => '10%',
                '0.15' => '15%',
                '0.20' => '20%',
                '0.25' => '25%',
                '0.30' => '30%',
                '0.35' => '35%',
                '0.40' => '40%',
                '0.45' => '45%',
                '0.50' => '50%',
                '0.55' => '55%',
                '0.60' => '60%',
                '0.65' => '65%',
                '0.70' => '70%',
                '0.75' => '75%',
                '0.80' => '80%',
                '0.85' => '85%',
                '0.90' => '90%',
                '0.95' => '95%',
                '1'    => '100%',
            );
            $redux_layout_selection = array(
                'none' => array('alt' => __( 'Full Width', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                'left' => array('alt' => __( 'Left Sidebar', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                'right' => array('alt' => __( 'Right Sidebar', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
            );
            $redux_sidebar_style_selection = array(
                'simple' => __( 'Simple', 'redux-framework-demo' ),
                'box' => __( 'Box', 'redux-framework-demo' ),
            );
            $redux_blog_style_selection = array(
                'large-media' => __( 'Large Media', 'redux-framework-demo' ),
                'small-media' => __( 'Small Media', 'redux-framework-demo' ),
                'masonry' => __( 'Masonry' , 'redux-framework-demo' ),
                'grid' => __( 'Grid' , 'redux-framework-demo' ),
            );
            $redux_blog_image_mode_selection = array(
                'auto' => __( 'Auto Crop', 'redux-framework-demo' ),
                'resize' => __( 'Resize', 'redux-framework-demo' ),
                'large' => __( 'Resize ( Large )', 'redux-framework-demo' ),
                'medium_large' => __( 'Resize ( Medium Large )', 'redux-framework-demo' ),
                'medium' => __( 'Resize ( Medium )', 'redux-framework-demo' ),
            );
            $redux_blog_masonry_image_mode_selection = array(
                'large' => __( 'Resize ( Large )', 'redux-framework-demo' ),
                'medium_large' => __( 'Resize ( Medium Large )', 'redux-framework-demo' ),
                'medium' => __( 'Resize ( Medium )', 'redux-framework-demo' ),
            );

            $redux_blog_columns_selection = array(
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
            );
            $redux_blog_columns_selection_mobile = array(
                '1' => '1',
                '2' => '2',
            );

            $redux_layout_selection = array(
                'none' => array('alt' => __( 'Full Width', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                'left' => array('alt' => __( 'Left Sidebar', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                'right' => array('alt' => __( 'Right Sidebar', 'redux-framework-demo' ), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
            );
            $redux_enable_selection = array(
                'no' => __( 'No', 'redux-framework-demo' ),
                'yes' => __( 'Yes', 'redux-framework-demo' ),
            );
            $redux_header_menu_options = array(
                'search' => __( 'Search', 'redux-framework-demo' ),
                'cart' => esc_html__( 'Shopping Cart (WooCommerce Required)', 'redux-framework-demo' ),
                'language' => __( 'Language selector (WPML or Polylang Required)', 'redux-framework-demo' ),
            );
            $redux_gmap_api_key_link = '<a href="//developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">' . esc_html__( 'Generate Google Map API Key', 'redux-framework-demo' ) . '</a>';

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
 /*   $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );*/

    // Panel Intro text -> before the form
    /*if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );
*/
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Genral Options', 'redux-framework-demo' ),
        'id'               => 'basic',
        'desc'             => __( 'These are really basic fields!', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'customizer' => false,
        'customizer' => false,
        'fields'           => array(
            array(
                'id'       => 'theme_layout',
                'type'     => 'radio',
                'title'    => __( 'Theme Layout', 'redux-framework-demo' ),
                'subtitle' => __( 'Select the theme layout.', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Stretched',
                    '2' => 'Boxed',
            ),
            'default'  => '1'
            ),
            array(
                        'id'       => 'content_background',
                        'type'     => 'background',
                        'title'    => __( 'Theme Background', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select a background for the theme.', 'redux-framework-demo' ),
                        'transparent' => false,
                        'background-color' => true,
                        'background-repeat' => true,
                        'background-attachment' => true,
                        'background-clip' => false,
                        'background-size' => true,
                        'output'    => '#eut-body',
                        'default' => array (
                            'background-color' => '#ffffff',
                        ),
                    ),
                    array(
                        'id'=>'theme_loader',
                        'type' => 'switch',
                        'title' => __( 'Theme Loader', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or Disable Theme Loader.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'back_to_top_enabled',
                        'type' => 'switch',
                        'title' => __( 'Back to Top', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or Disable the Back to Top button.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'replace_admin_logo',
                        'type' => 'checkbox',
                        'title' => __( 'Replace Admin Logo', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to replace admin logo with company logo.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id'       => 'admin_logo',
                        'type'     => 'media',
                        'title' => __( 'Admin Logo', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the image for your company logo. ( If empty, Logo Default will be used instead )', 'redux-framework-demo' ),
                        'required' => array( 'replace_admin_logo', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'admin_logo_height',
                        'type' => 'text',
                        'default' => '84',
                        'title' => __( 'Admin Logo Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter the company logo height in px (Default is 84).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                        'required' => array( 'replace_admin_logo', 'equals', '1' ),
                    ),
        )
      ));
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Topbar Option', 'redux-framework-demo' ),
        'id'               => 'basic-topbar',
        'subsection'       => false,
        'customizer_width' => '500px',
        'desc'             => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) ,
        'customizer' => false,
        'customizer' => false,
        'fields'           => array(
                   array(
                        'id'=>'top_bar_enabled',
                        'type' => 'switch',
                        'title' => __( 'Top Bar Area', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or Disable TopBar Area to show above your header.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'top_bar_height',
                        'type' => 'text',
                        'default' => '40',
                        'title' => __( 'Top Bar Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter the Top Bar height in px (Default is 50).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'top_bar_section_type',
                        'type' => 'select',
                        'title' => __( 'Top Bar Full Width', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you like a full-width Top Bar Area.', 'redux-framework-demo' ),
                        'options' => array(
                            'fullwidth-background' => __( 'No', 'redux-framework-demo' ),
                            'fullwidth-element' => __( 'Yes', 'redux-framework-demo' ),
                        ),
                        'default' => 'fullwidth-background',
                        'validate' => 'not_empty',
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'   => 'info_top_bar_left',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Left Top Bar Area', 'redux-framework-demo' ),
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'=>'top_bar_left_enabled',
                        'type' => 'switch',
                        'title' => __( 'Left Area', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or Disable the Left TopBar Area.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'top_bar_left_options',
                        'type' => 'checkbox',
                        'title' => __( 'Left Area Elements', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enable / Disable the elements you like to show in the Left TopBar Area.', 'redux-framework-demo' ),
                        'options' => $redux_top_bar_options,
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_left_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id' => 'top_bar_left_text',
                        'type' => 'text',
                        'title' => __( 'Left Area Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Place the text you wish for your Left TopBar Area.', 'redux-framework-demo' ),
                        'default' => '',
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_left_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id'=>'top_bar_left_social_visibility',
                        'type' => 'switch',
                        'title' => __( 'Left Area Social Icons Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable and add social icons for the Left TopBar Area.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_left_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id' => 'top_bar_left_social_options',
                        'type' => 'checkbox',
                        'title' => __( 'Left Area Social Icons', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your social icons.', 'redux-framework-demo' ),
                        'desc' => '',
                        'label' => true,
                        'options' => $redux_social_options,
                        'class' => 'eut-redux-columns',
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_left_enabled', 'equals', '1' ),
                            array( 'top_bar_left_social_visibility', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id'   => 'info_top_bar_right',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Right Top Bar Area', 'redux-framework-demo' ),
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'=>'top_bar_right_enabled',
                        'type' => 'switch',
                        'title' => __( 'Right Area', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or Disable the Right TopBar Area.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array( 'top_bar_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'top_bar_right_options',
                        'type' => 'checkbox',
                        'title' => __( 'Right Area Elements', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enable / Disable the elements you like to show in the Right TopBar Area.', 'redux-framework-demo' ),
                        'options' => $redux_top_bar_options,
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_right_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id' => 'top_bar_right_text',
                        'type' => 'text',
                        'title' => __( 'Right Area Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Place the text you wish for your Right TopBar Area.', 'redux-framework-demo' ),
                        'default' => '',
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_right_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id'=>'top_bar_right_social_visibility',
                        'type' => 'switch',
                        'title' => __( 'Right Area Social Icons Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable and add social icons for the Right TopBar Area.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_right_enabled', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id' => 'top_bar_right_social_options',
                        'type' => 'checkbox',
                        'title' => __( 'Right Area Social Icons', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your social icons.', 'redux-framework-demo' ),
                        'desc' => '',
                        'label' => true,
                        'options' => $redux_social_options,
                        'class' => 'eut-redux-columns',
                        'required' => array(
                            array( 'top_bar_enabled', 'equals', '1' ),
                            array( 'top_bar_right_enabled', 'equals', '1' ),
                            array( 'top_bar_right_social_visibility', 'equals', '1' ),
                        ),
                    ),
    
         )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Topbar Option Color', 'redux-framework-demo' ),
        'id'         => 'basic-topbar-Color',
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/color/" target="_blank">docs.reduxframework.com/core/fields/color/</a>',
        'subsection' => true,
        'customizer' => false,
        'fields' => array(
                    //Top Bar Color Settings
                    array(
                        'id'          => 'top_bar_bg_color',
                        'type'        => 'color',
                        'title'       => __( 'Top Bar Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Background color for your Top Bar.', 'redux-framework-demo' ),
                        'default'     => '#303030',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'top_bar_font_color',
                        'type'        => 'color',
                        'title'       => __( 'Top Bar Font Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Font color for your Top Bar.', 'redux-framework-demo' ),
                        'default'     => '#c9c9c9',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'top_bar_link_color',
                        'type'        => 'color',
                        'title'       => __( 'Top Bar Link Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Link color for your Top Bar.', 'redux-framework-demo' ),
                        'default'     => '#c9c9c9',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'top_bar_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Top Bar Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Hover color for your Top Bar.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'top_bar_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Border color for your Top Bar.', 'redux-framework-demo' ),
                        'default'     => '#4f4f4f',
                        'transparent' => false,
                    ),
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header Options', 'redux-framework-demo' ),
        'id'         => 'basic-header-option',
        'subsection' => false,
        'customizer' => false,
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ),
        'fields' => array(
                    array(
                        'id' => 'header_fullwidth',
                        'type' => 'checkbox',
                        'title' => __( 'Full Width', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to show your header full width or inside the container.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id' => 'header_height',
                        'type' => 'text',
                        'default' => '80',
                        'title' => __( 'Header Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter Header height in px (Default is 90).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                    ),
                     array(
                        'id'       => 'header_background_color',
                        'type'     => 'color',
                        'title'    => __( 'Background Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a background color for the header.', 'redux-framework-demo' ),
                        'default'  => '#ffffff',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'header_background_color_opacity',
                        'type' => 'select',
                        'title' => __('Background Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the background of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '1',
                    ),
                    array(
                        'id'          => 'header_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Header Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a border color for the header.', 'redux-framework-demo' ),
                        'default'     => '#e0e0e0',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'header_border_color_opacity',
                        'type' => 'select',
                        'title' => __('Border Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the border of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '1',
                    ),
                    array(
                        'id'   => 'info_default_logo_options',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Logo options for the Default Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'logo',
                        'url' => true,
                        'type' => 'media',
                        'title' => __( 'Logo', 'redux-framework-demo' ),
                        'read-only' => false,
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logos/logo-default.png', 'width' => '280', 'height' => '70' ),
                        'subtitle' => __( 'Upload your logo here.', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'logo_height',
                        'type' => 'text',
                        'default' => '30',
                        'title' => __( 'Logo Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter logo height in px (Default is 30).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                    ),
                    array(
                        'id' => 'logo_align',
                        'type' => 'select',
                        'title' => __( 'Logo Alignment', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the position of your logo.', 'redux-framework-demo' ),
                        'options' => $redux_align_selection,
                        'default' => 'left',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id'   => 'info_menu_options',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Menu options for the Default Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'menu_type',
                        'type' => 'select',
                        'title' => __( 'Menu Type', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select the type of the default Menu.', 'redux-framework-demo' ),
                        'options' => array(
                            'simply' => __( 'Simple', 'redux-framework-demo' ),
                            'hidden' => __( 'Hidden', 'redux-framework-demo' ),
                        ),
                        'default' => 'simply',
                    ),
                    array(
                        'id' => 'menu_align',
                        'type' => 'select',
                        'title' => __( 'Menu Alignment', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the position of your menu.', 'redux-framework-demo' ),
                        'options' => $redux_align_selection_extra,
                        'default' => 'right',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'submenu_pointer',
                        'type' => 'select',
                        'title' => __( 'Sub Menu Pointer', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Choose pointer for the submenu.', 'redux-framework-demo' ),
                        'options' => $redux_menu_pointers,
                        'default' => 'none',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'submenu_animation',
                        'type' => 'select',
                        'title' => __( 'Sub Menu Animation', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Choose animation effect for the submenu.', 'redux-framework-demo' ),
                        'options' => $redux_menu_animations,
                        'default' => 'none',
                        'validate' => 'not_empty',
                    ),
                    //Menu Color Settings
                    array(
                        'id'          => 'menu_text_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu text.', 'redux-framework-demo' ),
                        'default'     => '#757575',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'menu_text_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the hover menu text.', 'redux-framework-demo' ),
                        'default'     => '#bdbdbd',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'menu_line_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Line Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu line.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_bg_color',
                        'type'        => 'color',
                        'title'       => __( 'Sub Menu Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a background color for the sub menu.', 'redux-framework-demo' ),
                        'default'     => '#1c1c1c',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_text_color',
                        'type'        => 'color',
                        'title'       => __( 'Sub Menu Text Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the sub menu text.', 'redux-framework-demo' ),
                        'default'     => '#8e8e8e',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_text_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Sub Menu Text Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the hover sub menu text.', 'redux-framework-demo' ),
                        'default'     => '#e0e0e0',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_title_color',
                        'type'        => 'color',
                        'title'       => __( 'Title Color for Mega Menu', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the titles of the mega menu columns.', 'redux-framework-demo' ),
                        'default'     => '#ffffff',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_active_bg_color',
                        'type'        => 'color',
                        'title'       => __( 'Sub Menu Active Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a background color for the active sub menu.', 'redux-framework-demo' ),
                        'default'     => '#151515',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'submenu_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Sub Menu Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a border color for the sub menu.', 'redux-framework-demo' ),
                        'default'     => '#383838',
                        'transparent' => false,
                    ),
                    array(
                        'id'   => 'info_menu_elements',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Menu Elements options for the Default Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'header_menu_options_enabled',
                        'type' => 'switch',
                        'title' => __( 'Menu Elements', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable or disable the use of various elements in your header like socials, search, language selector.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'header_menu_options',
                        'type' => 'checkbox',
                        'title' => __( 'Menu Elements Options', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enable / Disable various menu elements options.', 'redux-framework-demo' ),
                        'options' => $redux_header_menu_options,
                        'required' => array( 'header_menu_options_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'=>'header_menu_social_visibility',
                        'type' => 'switch',
                        'title' => __( 'Menu Social Icons Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable and add social icons in your header.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array( 'header_menu_options_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'header_menu_social_options',
                        'type' => 'checkbox',
                        'title' => __( 'Menu Social Icons', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the social icons.', 'redux-framework-demo' ),
                        'desc' => '',
                        'label' => true,
                        'options' => $redux_social_options,
                        'class' => 'eut-redux-columns',
                        'required' => array(
                            array( 'header_menu_options_enabled', 'equals', '1' ),
                            array( 'header_menu_social_visibility', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id' => 'header_menu_options_align',
                        'type' => 'select',
                        'title' => __( 'Various Elements Alignment', 'redux-framework-demo' ),
                        'subtitle' => __( 'Set the alignment of your header elements.', 'redux-framework-demo' ),
                        'options' => $redux_align_selection,
                        'default' => 'right',
                        'validate' => 'not_empty',
                        'required' => array( 'header_menu_options_enabled', 'equals', '1' ),
                    ),

                    array(
                        'id'   => 'info_responsive_menu_options',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Responsive Menu options for the Default Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'menu_responsive_toggle_selection',
                        'type' => 'select',
                        'title' => __( 'Responsive Menu Toggle Button Selection', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the toggle button content for your responsive menu.', 'redux-framework-demo' ),
                        'options' => $redux_menu_responsibe_toggle_selection,
                        'default' => 'icon',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'menu_responsive_toggle_text',
                        'type' => 'text',
                        'title' => __( 'Responsive Menu Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter the text for your responsive menu.', 'redux-framework-demo' ),
                        'default' => 'Menu',
                        'required' => array( 'menu_responsive_toggle_selection', 'equals', 'text' ),
                    ),
                   
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Sticky Header Options', 'redux-framework-demo' ),
        'desc'             => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/text/" target="_blank">docs.reduxframework.com/core/fields/text/</a>',
        'id'               => 'basic-sticky-header-option',
        'subsection'       => true,
        'customizer' => false,
        'customizer_width' => '700px',
        'fields' => array(
                    array(
                        'id'=>'header_sticky_enabled',
                        'type' => 'switch',
                        'title' => __( 'Sticky Header', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable the Sticky Header when scrolling down the page.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'header_sticky_type',
                        'type' => 'select',
                        'title' => __( 'Sticky Header Type', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select the type for the Sticky Header.', 'redux-framework-demo' ),
                        'options' => array(
                            'simply' => __( 'Simple', 'redux-framework-demo' ),
                            'advanced' => __( 'Advanced', 'redux-framework-demo' ),
                            'shrink' => __( 'Shrink', 'redux-framework-demo' ),
                        ),
                        'default' => 'simply',
                        'validate' => 'not_empty',
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'   => 'info_logo_sticky',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Logo Settings for the Sticky Header', 'redux-framework-demo' ),
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'logo_sticky',
                        'url'=> true,
                        'type' => 'media',
                        'title' => __( 'Logo Sticky Header', 'redux-framework-demo' ),
                        'read-only' => false,
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logos/logo-sticky.png', 'width' => '280', 'height' => '70' ),
                        'subtitle' => __( 'Upload your logo for the Sticky Header.', 'redux-framework-demo' ),
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    //Sticky Header Color Settings
                    array(
                        'id'       => 'header_sticky_background_color',
                        'type'     => 'color',
                        'title'    => __( 'Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a background color for the header.', 'redux-framework-demo' ),
                        'default'  => '#ffffff',
                        'transparent' => false,
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'header_sticky_background_color_opacity',
                        'type' => 'select',
                        'title' => __('Background Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the background of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '0.95',
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'header_sticky_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Header Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a border color for the header.', 'redux-framework-demo' ),
                        'default'     => '#000000',
                        'transparent' => false,
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'header_sticky_border_color_opacity',
                        'type' => 'select',
                        'title' => __('Border Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the border of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '0.10',
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    //Menu Color Settings
                    array(
                        'id'          => 'sticky_menu_text_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu text.', 'redux-framework-demo' ),
                        'default'     => '#757575',
                        'transparent' => false,
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'sticky_menu_text_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the hover menu text.', 'redux-framework-demo' ),
                        'default'     => '#bdbdbd',
                        'transparent' => false,
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'sticky_menu_line_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Line Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu line.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                        'required' => array( 'header_sticky_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id'=>'header_device_sticky_enabled',
                        'type' => 'switch',
                        'title' => __( 'Devices Sticky Header', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable the Sticky Header on small devices ( Tablet Portrait and Mobiles ).', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Light Header Options', 'redux-framework-demo' ),
        'id'         => 'basic-Multi Text',
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/multi-text/" target="_blank">docs.reduxframework.com/core/fields/multi-text/</a>',
        'subsection' => true,
        'customizer' => false,
        'fields' => array(
                    array(
                        'id'   => 'info_logo_light',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Logo Settings for the Light Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'logo_light',
                        'url'=> true,
                        'type' => 'media',
                        'title' => __( 'Logo', 'redux-framework-demo' ),
                        'read-only' => false,
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logos/logo-light.png', 'width' => '280', 'height' => '70' ),
                        'subtitle' => __( 'Upload your logo for the Light Header.', 'redux-framework-demo' ),
                    ),
                    //Menu Color Settings
                    array(
                        'id'          => 'light_menu_text_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu text.', 'redux-framework-demo' ),
                        'default'     => '#e0e0e0',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'light_menu_text_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the hover menu text.', 'redux-framework-demo' ),
                        'default'     => '#ffffff',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'light_menu_line_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Line Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu line.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'header_light_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Header Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a border color for the header.', 'redux-framework-demo' ),
                        'default'     => '#ffffff',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'header_light_border_color_opacity',
                        'type' => 'select',
                        'title' => __('Border Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the border of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '0.30',
                    ),
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Dark Header Options', 'redux-framework-demo' ),
        'id'         => 'basic-Password',
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ),
        'subsection' => true,
        'customizer' => false,
        'fields' => array(
                    array(
                        'id'   => 'info_logo_dark',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Logo Settings for the Dark Header', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'logo_dark',
                        'url' => true,
                        'type' => 'media',
                        'title' => __( 'Logo', 'redux-framework-demo' ),
                        'read-only' => false,
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logos/logo-dark.png', 'width' => '280', 'height' => '70' ),
                        'subtitle' => __( 'Upload your logo for the Dark Header.', 'redux-framework-demo' ),
                    ),
                    //Menu Color Settings
                    array(
                        'id'          => 'dark_menu_text_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu text.', 'redux-framework-demo' ),
                        'default'     => '#212121',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'dark_menu_text_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Text Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the hover menu text.', 'redux-framework-demo' ),
                        'default'     => '#000000',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'dark_menu_line_color',
                        'type'        => 'color',
                        'title'       => __( 'Menu Line Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for the menu line.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                    ),
                    array(
                        'id'          => 'header_dark_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Header Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a border color for the header.', 'redux-framework-demo' ),
                        'default'     => '#000000',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'header_dark_border_color_opacity',
                        'type' => 'select',
                        'title' => __('Border Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for the border of the header.', 'redux-framework-demo' ),
                        'options' => $redux_opacity_selection,
                        'default' => '0.10',
                    ),
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Option', 'redux-framework-demo' ),
        'id'         => 'editor-wordpress',
        //'icon'  => 'el el-home'
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/editor/" target="_blank">docs.reduxframework.com/core/fields/editor/</a>',
        'subsection' => false,
        'customizer' => false,
        'fields' => array(
                    array(
                        'id' => 'sticky_footer',
                        'type' => 'checkbox',
                        'title' => __( 'Sticky Footer', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want a sticky footer.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id'       => 'footer_background',
                        'type'     => 'background',
                        'title'    => __( 'Footer Background Image', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select a background image for the footer.', 'redux-framework-demo' ),
                        'background-color' => false,
                        'background-repeat' => false,
                        'background-attachment' => false,
                        'background-clip' => false,
                        'background-size' => false,
                        'default'  => array(
                            'background-position' => 'center center',
                        ),
                    ),
                    /*footer widget*/
                    array(
                        'id'   => 'info_footer_widgets',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Footer Widgets Settings', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'footer_widgets_visibility',
                        'type' => 'switch',
                        'title' => __( 'Footer Widgets Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable the Footer Area to show the widget areas of the footer.', 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'footer_widgets_layout',
                        'type' => 'image_select',
                        'title' => __( 'Footer Column Layout', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select Footer column layout.', 'redux-framework-demo' ),
                        'options' => $redux_footer_column_selection,
                        'default' => 'footer-1',
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'footer_section_type',
                        'type' => 'select',
                        'title' => __( 'Footer Full Width', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select Yes if you like a full-width Footer Area.', 'redux-framework-demo' ),
                        'options' => array(
                            'fullwidth-background' => __( 'No', 'redux-framework-demo' ),
                            'fullwidth-element' => __( 'Yes', 'redux-framework-demo' ),
                        ),
                        'default' => 'fullwidth-background',
                        'validate' => 'not_empty',
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'             => 'footer_widgets_spacing',
                        'type'           => 'spacing',
                        'output'         => array('#eut-footer-area'),
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'left'           => 'false',
                        'right'          => 'false',
                        'title'          => __( 'Spacing', 'redux-framework-demo' ),
                        'subtitle'       => __( 'Set the spacing of Footer Area.', 'redux-framework-demo' ),
                        'desc'           => __( 'Set spacing Top, Bottom in px.', 'redux-framework-demo'),
                        'default'        => array(
                            'padding-top'     => '100px',
                            'padding-bottom'  => '100px',
                            'units'           => 'px',
                        ),
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                     //Footer Area Color Settings
                    array(
                        'id'          => 'footer_widgets_bg_color',
                        'type'        => 'color',
                        'title'       => __( 'Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Background color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#1c1c1c',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_widgets_headings_color',
                        'type'        => 'color',
                        'title'       => __( 'Headings Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Headings color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#616161',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_widgets_font_color',
                        'type'        => 'color',
                        'title'       => __( 'Font Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Font color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#bababa',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_widgets_link_color',
                        'type'        => 'color',
                        'title'       => __( 'Link Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Link color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#bababa',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_widgets_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Hover color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_widgets_border_color',
                        'type'        => 'color',
                        'title'       => __( 'Border Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Border color for your Footer Area.', 'redux-framework-demo' ),
                        'default'     => '#383838',
                        'transparent' => false,
                        'required' => array( 'footer_widgets_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'   => 'info_footer_bar',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Footer Bar Settings', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'footer_bar_visibility',
                        'type' => 'switch',
                        'title' => __( 'Footer Bar Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable the Footer Bar Area for the copyright, bottom menu and socials.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'footer_bar_section_type',
                        'type' => 'select',
                        'title' => __( 'Footer Bar Full Width', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select Yes if you like a full-width Footer Bar Area.', 'redux-framework-demo' ),
                        'options' => array(
                            'fullwidth-background' => __( 'No', 'redux-framework-demo' ),
                            'fullwidth-element' => __( 'Yes', 'redux-framework-demo' ),
                        ),
                        'default' => 'fullwidth-background',
                        'validate' => 'not_empty',
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                        //Footer Bar Color Settings
                    array(
                        'id'          => 'footer_bar_bg_color',
                        'type'        => 'color',
                        'title'       => __( 'Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Background color for your Footer Bar Area.', 'redux-framework-demo' ),
                        'default'     => '#151515',
                        'transparent' => false,
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_bar_bg_color_opacity',
                        'type'        => 'select',
                        'title'       => __('Background Opacity', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Select opacity for your Footer Bar Area.', 'redux-framework-demo' ),
                        'options'     => $redux_opacity_selection,
                        "default"     => '1',
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_bar_font_color',
                        'type'        => 'color',
                        'title'       => __( 'Font Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Font color for your Footer Bar Area.', 'redux-framework-demo' ),
                        'default'     => '#5c5c5c',
                        'transparent' => false,
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_bar_link_color',
                        'type'        => 'color',
                        'title'       => __( 'Link Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Link color for your Footer Bar Area.', 'redux-framework-demo' ),
                        'default'     => '#5c5c5c',
                        'transparent' => false,
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'          => 'footer_bar_hover_color',
                        'type'        => 'color',
                        'title'       => __( 'Hover Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Hover color for your Footer Bar Area.', 'redux-framework-demo' ),
                        'default'     => '#FA4949',
                        'transparent' => false,
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'footer_bar_align_center',
                        'type' => 'select',
                        'title' => __( 'Footer Bar Center', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if the Footer Bar elements will be centered.', 'redux-framework-demo' ),
                        'options' => array(
                            'no' => __( 'No', 'redux-framework-demo' ),
                            'yes' => __( 'Yes', 'redux-framework-demo' ),
                        ),
                        'default' => 'yes',
                        'validate' => 'not_empty',
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'             => 'footer_bar_spacing',
                        'type'           => 'spacing',
                        'output'         => array('#eut-footer-bar'),
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'left'           => 'false',
                        'right'          => 'false',
                        'title'          => __( 'Spacing', 'redux-framework-demo' ),
                        'subtitle'       => __( 'Set the spacing of Footer Bar Area.', 'redux-framework-demo' ),
                        'desc'           => __( 'Set spacing Top, Bottom in px.', 'redux-framework-demo'),
                        'default'        => array(
                            'padding-top'     => '20px',
                            'padding-bottom'  => '20px',
                            'units'           => 'px',
                        ),
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id'=>'footer_copyright_visibility',
                        'type' => 'switch',
                        'title' => __( 'Footer Copyright Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable the Footer Copyright Area. Edit it as you wish.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'footer_copyright_text',
                        'type' => 'editor',
                        'title' => __( 'Copyright Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Type your copyright text or anything else you want.', 'redux-framework-demo' ),
                        'default' => 'With <i class="eut-color-primary-1 fa fa-heart-o"></i> for WordPress',
                        'required' => array(
                            array( 'footer_bar_visibility', 'equals', '1' ),
                            array( 'footer_copyright_visibility', 'equals', '1' ),
                        ),
                    ),
                    array(
                        'id'=>'second_area_visibility',
                        'type' => 'button_set',
                        'title' => __( 'Second Footer Area', 'redux-framework-demo' ),
                        'subtitle'=> __( 'This is the second position in the Footer Bar Area. You can easily add the Bottom Menu or socials.', 'redux-framework-demo' ),
                        'options' => array(
                            '1' => __( 'Hide', 'redux-framework-demo' ),
                            '2' => __( 'Menu', 'redux-framework-demo' ),
                            '3' => __( 'Socials', 'redux-framework-demo' ),
                        ),
                        'default' => '1',
                        'required' => array( 'footer_bar_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'footer_social_display',
                        'type' => 'select',
                        'title' => __( 'Footer Social Display', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select how you want to display your social items.', 'redux-framework-demo' ),
                        'options' => array(
                            'text' => __( 'Text', 'redux-framework-demo' ),
                            'icon' => __( 'Icons', 'redux-framework-demo' ),
                        ),
                        'default' => 'text',
                        'validate' => 'not_empty',
                        'required' => array(
                            array( 'footer_bar_visibility', 'equals', '1' ),
                            array( 'second_area_visibility', 'equals', '3' ),
                        ),
                    ),
                    array(
                        'id' => 'footer_social_options',
                        'type' => 'checkbox',
                        'title' => __( 'Footer Social items', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your social icons.', 'redux-framework-demo' ),
                        'desc' => '',
                        'label' => true,
                        'options' => $redux_social_options,
                        'class' => 'eut-redux-columns',
                        'required' => array(
                            array( 'footer_bar_visibility', 'equals', '1' ),
                            array( 'second_area_visibility', 'equals', '3' ),
                        ),
                    ),
                )
        
    ) );
    Redux::setSection( $opt_name, array(
            'title'      => __( 'Blog Options', 'redux-framework-demo' ),
            'id'         => 'blog-option',
            'icon'  => 'el el-edit',
            'subsection' => false,
            'customizer' => false,
            'desc'       => __( 'For full documentation on the this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/ace-editor/" target="_blank">docs.reduxframework.com/core/fields/ace-editor/</a>',
            'fields' => array(
                    array(
                        'id' => 'blog_layout',
                        'type' => 'image_select',
                        'title' => __( 'Blog Layout', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the layout for the assigned blog page. Choose among Full Width, Left Sidebar or Right Sidebar.', 'redux-framework-demo' ),
                        'options' => $redux_layout_selection,
                        'default' => 'right',
                    ),
                    array(
                        'id' => 'blog_sidebar',
                        'type' => 'select',
                        'title' => __( 'Blog Sidebar', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the sidebar for the assigned blog page.', 'redux-framework-demo' ),
                        'data' => 'sidebar',
                        'default' => 'eut-default-sidebar',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'blog_sidebar_style',
                        'type' => 'select',
                        'title' => __( 'Blog Sidebar Style', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the style for the sidebar of the assigned blog page.', 'redux-framework-demo' ),
                        'options' => $redux_sidebar_style_selection,
                        'default' => 'simple',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id'=>'blog_title',
                        'type' => 'select',
                        'title' => __( 'Blog Title', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to use the site name and tagline as blog title or hide it.', 'redux-framework-demo' ),
                        'options' => array(
                            'sitetitle' => __( 'Site Title / Tagline', 'redux-framework-demo' ),
                            'custom' => __( 'Custom Title / Description', 'redux-framework-demo' ),
                            'none' => __( 'None', 'redux-framework-demo' ),
                        ),
                        'default' => 'sitetitle',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'blog_custom_title',
                        'type' => 'text',
                        'default' => '',
                        'title' => __( 'Custom Title', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter blog custom title.', 'redux-framework-demo' ),
                        'required' => array( 'blog_title', 'equals', 'custom' ),
                    ),
                    array(
                        'id' => 'blog_custom_description',
                        'type' => 'text',
                        'default' => '',
                        'title' => __( 'Custom Description', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter blog custom description.', 'redux-framework-demo' ),
                        'required' => array( 'blog_title', 'equals', 'custom' ),
                    ),
                    array(
                        'id' => 'blog_title_height',
                        'type' => 'text',
                        'default' => '200',
                        'title' => __( 'Blog Title Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter blog title height in px (Default is 200).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                    ),
                    array(
                        'id' => 'blog_title_alignment',
                        'type' => 'select',
                        'title' => __( 'Blog Title Alignment', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select your alignment for the blog title.', 'redux-framework-demo' ),
                        'options' => array(
                            'left' => __( 'Left', 'redux-framework-demo' ),
                            'right' => __( 'Right', 'redux-framework-demo' ),
                            'center' => __( 'Center', 'redux-framework-demo' ),
                        ),
                        'default' => 'left',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id'       => 'blog_title_background',
                        'type'     => 'background',
                        'title'    => __( 'Blog Title Background Image', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select a background image for the blog title.', 'redux-framework-demo' ),
                        'background-color' => false,
                        'background-repeat' => false,
                        'background-attachment' => false,
                        'background-clip' => false,
                        'background-size' => false,
                        'default'  => array(
                            'background-position' => 'center center',
                        ),
                    ),
                    array(
                        'id'   => 'info_style_blog_settings',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Blog Style and Basic Blog Settings', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Set the style and basic settings for the default blog.', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'blog_style',
                        'type' => 'select',
                        'title' => __( 'Blog Style', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select blog style.', 'redux-framework-demo' ),
                        'options' => $redux_blog_style_selection,
                        'default' => 'large-media',
                    ),
                    array(
                        'id' => 'blog_mode',
                        'type' => 'select',
                        'title' => __( 'Blog Mode', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the Blog Mode', 'redux-framework-demo' ),
                        'options' =>array(
                            'no-shadow-mode' => __( 'Without Shadow', 'redux-framework-demo' ),
                            'shadow-mode' => __( 'With Shadow', 'redux-framework-demo' ),
                        ),
                        'default' => 'no-shadow-mode',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_item_spinner',
                        'type' => 'select',
                        'title' => __( 'Enable Loader', 'redux-framework-demo' ),
                        'subtitle'=> __( 'If selected, this will enable a graphic spinner before load.', 'redux-framework-demo' ),
                        'options' => array(
                            'no' => __( 'No', 'redux-framework-demo' ),
                            'yes' => __( 'Yes', 'redux-framework-demo' ),
                        ),
                        'default' => 'no',
                        'validate' => 'not_empty',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_image_mode',
                        'type' => 'select',
                        'title' => __( 'Blog Image Mode', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your Blog Image Mode', 'redux-framework-demo' ),
                        'options' => $redux_blog_image_mode_selection,
                        'default' => 'auto',
                        'required' => array( 'blog_style','!=', 'masonry' ),
                    ),
                    array(
                        'id' => 'blog_masonry_image_mode',
                        'type' => 'select',
                        'title' => __( 'Blog Masonry Image Mode', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your Blog Masonry Image Mode', 'redux-framework-demo' ),
                        'options' => $redux_blog_masonry_image_mode_selection,
                        'default' => 'large',
                        'required' => array( 'blog_style','equals', 'masonry' ),
                    ),
                    array(
                        'id' => 'blog_image_prio',
                        'type' => 'select',
                        'title' => __( 'Blog Featured Image Priority', 'redux-framework-demo' ),
                        'subtitle' => __( 'If enabled, Featured image is displayed instead of media element', 'redux-framework-demo' ),
                        'options' => $redux_enable_selection,
                        'default' => 'no',
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => __( 'Blog Columns', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the Blog Columns', 'redux-framework-demo' ),
                        'options' => $redux_blog_columns_selection,
                        'default' => '4',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_columns_tablet_landscape',
                        'type' => 'select',
                        'title' => __( 'Blog Tablet Landscape Columns', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select responsive column on tablet devices, landscape orientation.', 'redux-framework-demo' ),
                        'options' => $redux_blog_columns_selection,
                        'default' => '4',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_columns_tablet_portrait',
                        'type' => 'select',
                        'title' => __( 'Blog Tablet Portrait Columns', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select responsive column on tablet devices, portrait orientation.', 'redux-framework-demo' ),
                        'options' => $redux_blog_columns_selection,
                        'default' => '2',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_columns_mobile',
                        'type' => 'select',
                        'title' => __( 'Blog Mobile Columns', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select responsive column on mobile devices.', 'redux-framework-demo' ),
                        'options' => $redux_blog_columns_selection_mobile,
                        'default' => '1',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_auto_excerpt',
                        'type' => 'switch',
                        'title' => __( 'Auto Excerpt', 'redux-framework-demo' ),
                        'subtitle'=> __( "Adds automatic excerpt to all posts. If auto excerpt is off, blog will show all content, a desired 'cut-off' can be inserted in each post with more quicktag.", 'redux-framework-demo' ),
                        'default' => '0',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                        'required' => array( 'blog_style', 'equals', 'large-media' ),
                    ),
                    array(
                        'id'=>'blog_excerpt_length',
                        'type' => 'text',
                        'default' => '55',
                        'title' => __( 'Excerpt Length', 'redux-framework-demo' ),
                        'subtitle' => __( 'Type how many words you want to display in your post excerpts (Default is 55).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                        'required' => array(
                            array( 'blog_auto_excerpt', 'equals', '1' ),
                            array( 'blog_style', 'equals', 'large-media' ),
                        ),
                    ),
                    array(
                        'id'=>'blog_excerpt_length_small',
                        'type' => 'text',
                        'default' => '30',
                        'title' => __( 'Excerpt Length', 'redux-framework-demo' ),
                        'subtitle' => __( 'Type how many words you want to display in your post excerpts (Default is 30).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                        'required' => array(
                            array( 'blog_style','!=', 'large-media' ),
                            array( 'blog_style','!=', 'small-media' ),
                        ),
                    ),
                    array(
                        'id' => 'blog_excerpt_more',
                        'type' => 'switch',
                        'title' => __( 'Read More', 'redux-framework-demo' ),
                        'subtitle'=> __( "Adds a read more button after the excerpt or more quicktag.", 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'blog_comments_visibility',
                        'type' => 'switch',
                        'title' => __( 'Comments Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Easily disable the comments of your blog.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'blog_date_visibility',
                        'type' => 'switch',
                        'title' => __( 'Date Field Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Easily disable the date field of your blog.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'blog_author_visibility',
                        'type' => 'switch',
                        'title' => __( 'Author Field Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Easily disable the author field of your blog.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                )
        ) );
    Redux::setSection( $opt_name, array(
            'title'      => __( 'Single Post Settings', 'redux-framework-demo' ),
            'id'         => 'single-post-option',
            'icon'  => 'el el-edit',
            'subsection' => true,
            'customizer' => false,
            'desc'       => __( 'For full documentation on the this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/ace-editor/" target="_blank">docs.reduxframework.com/core/fields/ace-editor/</a>',
            'fields' => array(
                    array(
                        'id' => 'post_layout',
                        'type' => 'image_select',
                        'title' => __( 'Post Layout', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the layout for the single post format. Choose among Full Width, Left Sidebar or Right Sidebar.', 'redux-framework-demo' ),
                        'options' => $redux_layout_selection,
                        'default' => 'right',
                    ),
                    array(
                        'id' => 'post_sidebar',
                        'type' => 'select',
                        'title' => __( 'Post Sidebar', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the sidebar for the single posts.', 'redux-framework-demo' ),
                        'data' => 'sidebar',
                        'default' => 'eut-default-sidebar',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'post_sidebar_style',
                        'type' => 'select',
                        'title' => __( 'Post Sidebar Style', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select style of your sidebar in single posts.', 'redux-framework-demo' ),
                        'options' => $redux_sidebar_style_selection,
                        'default' => 'simple',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'blog_social',
                        'type' => 'checkbox',
                        'title' => __( 'Social Share', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enable / Disable post social shares for the single posts.', 'redux-framework-demo' ),
                        'options' => $redux_blog_social_options,
                        'default' => 0,
                    ),
                    array(
                        'id' => 'post_feature_image_visibility',
                        'type' => 'switch',
                        'title' => __( 'Featured Image Visibility (Standard Post)', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Toggle Featured Image on or off.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'post_tag_visibility',
                        'type' => 'switch',
                        'title' => __( 'Post Tags Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable / Disable the post tags.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'post_category_visibility',
                        'type' => 'switch',
                        'title' => __( 'Post Categories Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable / Disable the post categories.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'post_author_visibility',
                        'type' => 'switch',
                        'title' => __( 'Author Info Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable / Disable the Author Info field.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'post_related_visibility',
                        'type' => 'switch',
                        'title' => __( 'Related Posts Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable / Disable the visibility of the related posts.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id'=>'post_nav_visibility',
                        'type' => 'switch',
                        'title' => __( 'Posts Navigation Visibility', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Enable / Disable the visibility of the posts navigation.', 'redux-framework-demo' ),
                        'default' => '1',
                        'on' => __( 'On', 'redux-framework-demo' ),
                        'off' => __( 'Off', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'post_nav_same_term',
                        'type' => 'checkbox',
                        'title' => __( 'Post Navigation Same Term', 'redux-framework-demo' ),
                        'subtitle'=> __( 'If selected, only navigation items from the current taxonomy term will be displayed.', 'redux-framework-demo' ),
                        'default' => 0,
                        'required' => array( 'post_nav_visibility', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'post_backlink',
                        'type' => 'select',
                        'title' => __( 'Post Backlink', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the overview page for your post backlink.', 'redux-framework-demo' ),
                        'data' => 'page',
                        'default' => '',
                        'required' => array( 'post_nav_visibility', 'equals', '1' ),
                    ),
                )
    ));
    Redux::setSection( $opt_name, array(
            'title'      => __( 'Page Options', 'redux-framework-demo' ),
            'id'         => 'page-option',
            'icon'  => 'el el-edit',
            'subsection' => false,
            'customizer' => false,
            'desc'       => __( 'For full documentation on the this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/ace-editor/" target="_blank">docs.reduxframework.com/core/fields/ace-editor/</a>',
            'fields' => array(
                    array(
                        'id' => 'page_layout',
                        'type' => 'image_select',
                        'title' => __( 'Page Layout', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the layout for the pages. Choose among Full Width, Left Sidebar or Right Sidebar.', 'redux-framework-demo' ),
                        'options' => $redux_layout_selection,
                        'default' => 'none',
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'select',
                        'title' => __( 'Page Sidebar', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the default sidebar for the pages in case you do not use full width layout.', 'redux-framework-demo' ),
                        'data' => 'sidebar',
                        'default' => 'eut-default-sidebar',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id' => 'page_sidebar_style',
                        'type' => 'select',
                        'title' => __( 'Page Sidebar Style', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select the style for your sidebar in pages.', 'redux-framework-demo' ),
                        'options' => $redux_sidebar_style_selection,
                        'default' => 'simple',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id'   => 'info_style_page_title',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Page Title Settings', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Set the style for the default page title.', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'page_title_height',
                        'type' => 'text',
                        'default' => '200',
                        'title' => __( 'Page Title Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter Page title height in px (Default is 200).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                    ),
                    array(
                        'id' => 'page_title_alignment',
                        'type' => 'select',
                        'title' => __( 'Page Title Alignment', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select your alignment for the default page title.', 'redux-framework-demo' ),
                        'options' => array(
                            'left' => __( 'Left', 'redux-framework-demo' ),
                            'right' => __( 'Right', 'redux-framework-demo' ),
                            'center' => __( 'Center', 'redux-framework-demo' ),
                        ),
                        'default' => 'left',
                        'validate' => 'not_empty',
                    ),
                    array(
                        'id'       => 'page_title_background',
                        'type'     => 'background',
                        'title' => __( 'Page Title Background Image', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select a background image for the default page title.', 'redux-framework-demo' ),
                        'background-color' => false,
                        'background-repeat' => false,
                        'background-attachment' => false,
                        'background-clip' => false,
                        'background-size' => false,
                        'default'  => array(
                            'background-position' => 'center center',
                        ),
                    ),
                    array(
                        'id'   => 'info_style_page_anchor_menu',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Anchor Menu Bar Settings', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Define your preferences for the Anchor Menu Bar where you can place a custom sticky menu per page.', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'page_anchor_menu_height',
                        'type' => 'text',
                        'default' => '70',
                        'title' => __( 'Anchor Menu Height', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter Anchor Menu height in px (Default is 70).', 'redux-framework-demo' ),
                        'validate' => 'numeric',
                    ),
                    array(
                        'id' => 'page_anchor_menu_highlight_current',
                        'type' => 'checkbox',
                        'title' => __( 'Highlight current anchor menu', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to highlight current anchor menu.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id' => 'page_anchor_menu_incontainer',
                        'type' => 'checkbox',
                        'title' => __( 'In Container', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to show your anchor menu inside the container instead of full width.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id' => 'page_anchor_menu_center',
                        'type' => 'checkbox',
                        'title' => __( 'Center', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to show your anchor menu centered.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                )
        ) );
     // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'desc'   => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
        'icon'   => 'el el-font',
        'customizer' => false,
        'google'   => true,
        'fields' => array(
                    array(
                        'id'   => 'info_body_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Main Body Fonts', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'body_font',
                        'type' => 'typography',
                        'title' => __( 'Body Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height'=> true,
                        'text-align'=> true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'default' => array(
                            'font-size' => '16px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '400',
                            'letter-spacing' => '',
                            'line-height' => '30px',
                        ),
                       
                    ),
                    array(
                        'id'   => 'info_logo_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Logo as text Fonts', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'logo_font',
                        'type' => 'typography',
                        'title' => __( 'Logo Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the logo font properties.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height'=> true,
                        'text-align'=> true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-size' => '18px',
                            'font-family' => 'Lato',
                            'font-weight' => '700',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_menu_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Main Menu Fonts', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'main_menu_font',
                        'type' => 'typography',
                        'title' => __( 'Menu Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the menu font properties.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '16px',
                            'font-weight' => '700',
                            'text-transform' => 'capitalize',
                            'letter-spacing' => '1px',
                        ),
                        
                    ),
                    array(
                        'id' => 'sub_menu_font',
                        'type' => 'typography',
                        'title' => __( 'Submenu Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the submenu font properties.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '14px',
                            'font-weight' => '700',
                            'text-transform' => 'capitalize',
                            'letter-spacing' => '',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_headers_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Headers Fonts', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'title' => __( 'H1 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H1 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '40px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '53px',
                        ),
                       
                    ),
                    array(
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'title' => __( 'H2 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H2 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '36px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '46px',
                        ),
                       
                    ),
                    array(
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'title' => __( 'H3 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H3 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '30px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '40px',
                        ),
                        
                    ),
                    array(
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'title' => __( 'H4 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H4 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '24px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '32px',
                        ),
                        
                    ),
                    array(
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'title' => __( 'H5 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H5 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '20px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '26px',
                        ),
                       
                    ),
                    array(
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'title' => __( 'H6 Font', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the H6 font.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '18px',
                            'font-weight' => '700',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '24px',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_page_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Page/Blog Typography', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'page_title',
                        'type' => 'typography',
                        'title' => __( 'Page Title', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the default page titles.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '30px',
                            'font-weight' => '900',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '40px',
                        ),
                        
                    ),
                    array(
                        'id' => 'page_description',
                        'type' => 'typography',
                        'title' => __( 'Page Description', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify font for the page description.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '20px',
                            'font-weight' => '400',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '26px',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_post_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Single Post Typography', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'post_title',
                        'type' => 'typography',
                        'title' => __( 'Single Post Title', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the single post titles.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '30px',
                            'font-weight' => '900',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '40px',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_portfolio_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Portfolio Typography', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'portfolio_title',
                        'type' => 'typography',
                        'title' => __( 'Portfolio Title', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the default single portfolio titles.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '30px',
                            'font-weight' => '900',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '40px',
                        ),
                        
                    ),
                    array(
                        'id' => 'portfolio_description',
                        'type' => 'typography',
                        'title' => __( 'Portfolio Description', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the default single portfolio description.', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '20px',
                            'font-weight' => '400',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '26px',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_feature_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Feature Section Typography', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'custom_title',
                        'type' => 'typography',
                        'title' => __( 'Custom Title', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the custom title in the feature section. (Custom Title, Custom Size Slider Title)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '64px',
                            'font-weight' => '900',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '72px',
                        ),
                       
                    ),
                    array(
                        'id' => 'custom_description',
                        'type' => 'typography',
                        'title' => __( 'Custom Description', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the custom description in the feature section. (Custom Description, Custom Size Slider Description)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '36px',
                            'font-weight' => '400',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '40px',
                        ),
                        
                    ),
                    array(
                        'id' => 'fullscreen_custom_title',
                        'type' => 'typography',
                        'title' => __( 'Custom Title for Fullscreen Section', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the custom title in the feature section in case you use full screen mode. (Custom Title, Custom Size Slider Title)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '90px',
                            'font-weight' => '900',
                            'text-transform' => 'none',
                            'letter-spacing' => '',
                            'line-height' => '96px',
                        ),
                        
                    ),
                    array(
                        'id' => 'fullscreen_custom_description',
                        'type' => 'typography',
                        'title' => __( 'Custom Description for Fullscreen Section', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the font for the custom description in the feature section in case you use full screen mode. (Custom Description, Custom Size Slider Description)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '40px',
                            'font-weight' => '400',
                            'text-transform' => 'none',
                            'font-style' => '',
                            'letter-spacing' => '',
                            'line-height' => '46px',
                        ),
                        
                    ),
                    array(
                        'id'   => 'info_special_typography',
                        'type' => 'info',
                        'class' => 'eut-redux-sub-info',
                        'title' => __( 'Special Text Typography', 'redux-framework-demo' ),
                    ),
                    array(
                        'id' => 'leader_text',
                        'type' => 'typography',
                        'title' => __( 'Leader Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the style for the leader text.  This is used in various elements (Text block, Testimonial...)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Open Sans',
                            'font-size' => '24px',
                            'font-weight' => '300',
                            'text-transform' => '',
                            'letter-spacing' => '',
                            'line-height' => '38px',
                        ),
                        
                    ),
                    array(
                        'id' => 'subtitle_text',
                        'type' => 'typography',
                        'title' => __( 'Subtitle Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the style for the subtitle text.  This is used in various elements (Slogan Subtitle...)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => true,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '14px',
                            'font-weight' => '400',
                            'text-transform' => '',
                            'letter-spacing' => '0.5px',
                            'line-height' => '24px',
                        ),
                       
                    ),
                    array(
                        'id' => 'small_text',
                        'type' => 'typography',
                        'title' => __( 'Small Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the style for the small text. This is used in various elements (Tags, Post Meta...)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => false,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Open Sans',
                            'font-size' => '13px',
                            'font-weight' => '400',
                            'text-transform' => '',
                            'letter-spacing' => '',
                        ),
                      
                    ),
                    array(
                        'id' => 'link_text',
                        'type' => 'typography',
                        'title' => __( 'Link Text', 'redux-framework-demo' ),
                        'subtitle' => __( 'Specify the style for the link text. This is used in various elements (Buttons, Read More...)', 'redux-framework-demo' ),
                        'google' => true,
                        'line-height' => false,
                        'text-align' => true,
                        'letter-spacing' => true,
                        'color'=> true,
                        'text-transform' => true,
                        'default' => array(
                            'font-family' => 'Open Sans',
                            'font-size' => '13px',
                            'font-weight' => '600',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '0.5px',
                        ),
                        
                    ),
                )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'CSS / JS Options', 'redux-framework-demo' ),
        'id'         => 'editor-ace',
        'icon'  => 'el el-edit',
        'subsection' => false,
        'desc'       => __( 'For full documentation on the this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/ace-editor/" target="_blank">docs.reduxframework.com/core/fields/ace-editor/</a>',
        'customizer' => false,
        'fields'     => array(
            array(
                'id'       => 'opt-ace-editor-css',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_blank">' . 'http://' . 'ace.c9.io/</a>.',
                'default'  => "#header{\n   margin: 0 auto;\n}"
            ),
            array(
                'id'       => 'opt-ace-editor-js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_blank">' . 'http://' . 'ace.c9.io/</a>.',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
            array(
                'id'         => 'opt-ace-editor-php',
                'type'       => 'ace_editor',
                'full_width' => true,
                'title'      => __( 'PHP Code', 'redux-framework-demo' ),
                'subtitle'   => __( 'Paste your PHP code here.', 'redux-framework-demo' ),
                'mode'       => 'php',
                'theme'      => 'chrome',
                'desc'       => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_blank">' . 'http://' . 'ace.c9.io/</a>.',
                'default'    => '<?php
    echo "PHP String";'
            ),


        )
    ) );

    // -> START Color Selection
    Redux::setSection( $opt_name, array(
        'title' => __( 'Style Option', 'redux-framework-demo' ),
        'id'    => 'color',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-brush',
        'customizer' => false,
        'fields' => array(
                    array(
                        'id'       => 'theme_body_background_color',
                        'type'     => 'color',
                        'title'    => __( 'Background Color', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a background color.', 'redux-framework-demo' ),
                        'default'  => '#ffffff',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_heading_color',
                        'type'     => 'color',
                        'title'    => __( 'Headings Text Color (h1-h6)', 'redux-framework-demo' ),
                        'subtitle'    => __( 'Pick a color for headings text.', 'redux-framework-demo' ),
                        'default'  => '#000000',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_text_color',
                        'type'     => 'color',
                        'title'    => __( 'Text Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for the text.', 'redux-framework-demo' ),
                        'default'  => '#676767',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_text_link_color',
                        'type'     => 'color',
                        'title'    => __( 'Link Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for the links.', 'redux-framework-demo' ),
                        'default'  => '#999999',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_text_link_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for hover text.', 'redux-framework-demo' ),
                        'default'  => '#666666',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_border_color',
                        'type'     => 'color',
                        'title'    => __( 'Border Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a border color.', 'redux-framework-demo' ),
                        'default'  => '#E6E6E6',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_1_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 1 Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 1.', 'redux-framework-demo' ),
                        'default'  => '#FA4949',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_1_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 1 Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 1 hover.', 'redux-framework-demo' ),
                        'default'  => '#da2929',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_2_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 2 Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 2.', 'redux-framework-demo' ),
                        'default'  => '#039be5',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_2_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 2 Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 2 hover.', 'redux-framework-demo' ),
                        'default'  => '#0278dc',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_3_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 3 Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 3.', 'redux-framework-demo' ),
                        'default'  => '#00bfa5',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_3_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 3 Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 3 hover.', 'redux-framework-demo' ),
                        'default'  => '#00a986',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_4_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 4 Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 4.', 'redux-framework-demo' ),
                        'default'  => '#ff9800',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_4_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 4 Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 4 hover.', 'redux-framework-demo' ),
                        'default'  => '#ff7400',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_5_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 5 Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 5.', 'redux-framework-demo' ),
                        'default'  => '#ad1457',
                        'transparent' => false,
                    ),
                    array(
                        'id'       => 'body_primary_5_hover_color',
                        'type'     => 'color',
                        'title'    => __( 'Primary 5 Hover Color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color for primary 5 hover.', 'redux-framework-demo' ),
                        'default'  => '#900d39',
                        'transparent' => false,
                    ),
                )
    ) );
    // -> START Design Fields
    Redux::setSection( $opt_name, array(
        'title' => __( 'Social Media', 'redux-framework-demo' ),
        'id'    => 'design',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el-icon-cloud',
        'customizer' => false,
        'fields' => array(
                    array(
                        'id' => 'social_options',
                        'type' => 'sortable',
                        'title' => __( 'Social URLs', 'redux-framework-demo' ),
                        'subtitle' => __( 'Define and reorder your social URLs. Clear the input field for any social link you do not wish to display.', 'redux-framework-demo' ),
                        'desc' => '',
                        'label' => true,
                        'options' => $redux_social_options,
                    ),
                )
    ) );

    // -> START Media Uploads
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Slides', 'redux-framework-demo' ),
        'id'         => 'additional-slides',
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/slides/" target="_blank">docs.reduxframework.com/core/fields/slides/</a>',
        'subsection' => false,
        'customizer' => false,
        'fields'     => array(
            array(
                'id'          => 'opt-slides',
                'type'        => 'slides',
                'title'       => __( 'Slides Options', 'redux-framework-demo' ),
                'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'redux-framework-demo' ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                    'color'=> true,
                ),
            ),
        )
    ) );

    // -> START Presentation Fields
    Redux::setSection( $opt_name, array(
        'title' => __( 'Map Options', 'redux-framework-demo' ),
        'id'    => 'presentation',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el-icon-map-marker',
        'icon_class' => 'el-icon-large',
        'customizer' => false,
        'fields' => array(
                    array(
                        'id'=>'map_api_mode',
                        'type' => 'button_set',
                        'title' => esc_html__( 'Map API', 'redux-framework-demo' ),
                        'subtitle'=> esc_html__( 'Select the map API', 'redux-framework-demo' ),
                        'options' => array(
                            'google-maps' => esc_html__( 'Google Maps', 'redux-framework-demo' ),
                            'openstreetmap' => esc_html__( 'OpenStreetMap', 'redux-framework-demo' ),
                        ),
                        'default' => 'google-maps',
                    ),
                    array(
                        'id'=>'map_tile_url',
                        'type' => 'text',
                        'title' => esc_html__( 'Tile Layer URL', 'redux-framework-demo' ),
                        'subtitle' => esc_html__( 'Define the Tile Layer. Used to load and display tile layers on the map.', 'redux-framework-demo' ),
                        'desc' => sprintf( '%1$s: <a href="//wiki.openstreetmap.org/wiki/Tile_servers" target="_blank"> %2$s </a>', esc_html__('See more tile servers', 'redux-framework-demo'), esc_html__('here', 'redux-framework-demo') ),
                        "default" => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                        'required' => array( 'map_api_mode', 'equals', 'openstreetmap' ),
                    ),
                    array(
                        'id'=>'map_tile_url_subdomains',
                        'type' => 'text',
                        'title' => esc_html__( 'Tile Layer Subdomains', 'redux-framework-demo' ),
                        'subtitle'=> esc_html__( 'Define the Tile Layer subdomains.', 'redux-framework-demo' ),
                        "default" => "abc",
                        'required' => array( 'map_api_mode', 'equals', 'openstreetmap' ),
                    ),
                    array(
                        'id'=>'map_tile_attribution',
                        'type' => 'text',
                        'title' => esc_html__( 'Tile Layer Attribution', 'redux-framework-demo' ),
                        'subtitle' => esc_html__( 'Enter the Tile Layer attribution', 'redux-framework-demo' ),
                        "default" => '&copy; <a href="//www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        'required' => array( 'map_api_mode', 'equals', 'openstreetmap' ),
                    ),
                    array(
                        'id'       => 'gmap_api_key',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Google API Key', 'redux-framework-demo' ),
                        'subtitle' => $redux_gmap_api_key_link,
                        'default'  => '',
                        'required' => array( 'map_api_mode', 'equals', 'google-maps' ),
                    ),
                    array(
                        'id' => 'gmap_hue_enabled',
                        'type' => 'checkbox',
                        'title' => __( 'Enable Hue', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if hue is used.', 'redux-framework-demo' ),
                        'default' => 0,
                        'required' => array( 'map_api_mode', 'equals', 'google-maps' ),
                    ),
                    array(
                        'id'       => 'gmap_hue',
                        'type'     => 'color',
                        'title'    => __( 'Hue color', 'redux-framework-demo' ),
                        'subtitle' => __( 'Pick a color as Hue', 'redux-framework-demo' ),
                        'default'  => '#ffffff',
                        'transparent' => false,
                        'validate' => 'color',
                        'required' => array( 'gmap_hue_enabled', 'equals', '1' ),
                    ),
                    array(
                        'id' => 'gmap_saturation',
                        'type' => 'slider',
                        'title' => __('Saturation', 'redux-framework-demo' ),
                        'subtitle' => __('Saturation of map.', 'redux-framework-demo' ),
                        'desc' => __('Min: -100, max: 100, default value: 0', 'redux-framework-demo' ),
                        'default' => 0,
                        "min" => -100,
                        "step" => 1,
                        "max" => 100,
                        'resolution' => 1,
                        'display_value' => 'text',
                        'required' => array( 'map_api_mode', 'equals', 'google-maps' ),
                    ),
                    array(
                        'id' => 'gmap_lightness',
                        'type' => 'slider',
                        'title' => __('Lightness', 'redux-framework-demo' ),
                        'subtitle' => __('Lightness of map.', 'redux-framework-demo' ),
                        'desc' => __('Min: -100, max: 100, default value: 0', 'redux-framework-demo' ),
                        'default' => 0,
                        "min" => -100,
                        "step" => 1,
                        "max" => 100,
                        'resolution' => 1,
                        'display_value' => 'text',
                        'required' => array( 'map_api_mode', 'equals', 'google-maps' ),
                    ),
                    array(
                        'id' => 'gmap_gamma',
                        'type' => 'slider',
                        'title' => __('Gamma', 'redux-framework-demo' ),
                        'subtitle' => __('Gamma of map.', 'redux-framework-demo' ),
                        'desc' => __('Min: -100, max: 100, default value: 1.0', 'redux-framework-demo' ),
                        'default' => 1.0,
                        "min" => 0.01,
                        "step" => 0.01,
                        "max" => 10.0,
                        'resolution' => 0.01,
                        'display_value' => 'text',
                        'required' => array( 'map_api_mode', 'equals', 'google-maps' ),
                    ),
                )
    ) );
    // -> START Switch & Button Set
    Redux::setSection( $opt_name, array(
        'title' => __( '404 Page', 'redux-framework-demo' ),
        'id'    => '404-page',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon' => 'el-icon-error',
        'icon_class' => 'el-icon-large',
        'subtitle' => __( 'You can find the settings for the 404 page here.', 'redux-framework-demo' ),
        'customizer' => false,
        'fields' => array(
                    array(
                        'id' => 'page_404_content',
                        'type' => 'editor',
                        'title' => __( 'Page 404 Content', 'redux-framework-demo' ),
                        'subtitle' => __( 'Type the content of your 404 page, you can use also shortcodes.', 'redux-framework-demo' ),
                        'default' => "<small>404 ERROR</small><h2>Hey There! This Is Not The Page You Are Looking For...</h2><p class='eut-subtitle'>Sorry for the inconvenience!</p>",
                    ),
                    array(
                        'id' => 'page_404_search',
                        'type' => 'checkbox',
                        'title' => __( 'Show Search Box', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to show a search box.', 'redux-framework-demo' ),
                        'default' => 0,
                    ),
                    array(
                        'id' => 'page_404_home_button',
                        'type' => 'checkbox',
                        'title' => __( 'Show Back to home Button', 'redux-framework-demo' ),
                        'subtitle'=> __( 'Select if you want to show a back to home button.', 'redux-framework-demo' ),
                        'default' => 1,
                    ),
                )
    ) );

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
   /* if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }*/

