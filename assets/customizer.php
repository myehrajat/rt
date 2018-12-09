<?php

/**
 * Adds sections and settings to customizer
 * @param $wp_customize
 */

function rentit_true_customizer_init($wp_customize)
{
    //Panels
    $wp_customize->add_panel('panel_blog', array(
        'title' => esc_html__('Blog Settings', 'rentit'),
        'description' => esc_html__('Settings of the Blog', 'rentit'),
    ));

    $wp_customize->add_panel('panel_shop', array(
        'title' => esc_html__('Shop Settings', 'rentit'),
        'description' => esc_html__('Settings of the Blog', 'rentit'),
    ));
    /*******************************************************************
     * Location sidebar
     *******************************************************************/

    $tmp_sectionname = "rentit";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Location sidebar', 'rentit'),
        'priority' => 30,
        'panel' => 'panel_blog'));
    $tmp_tabel = 'sidebar_position';
    $tmp_settingname = $tmp_sectionname . '_' . $tmp_tabel;
    $wp_customize->add_setting($tmp_settingname, array('default' => 's1',
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Location sidebar', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'radio',
        'choices' => array(
            's1' => esc_html__('Sidebar Left', 'rentit'),
            's2' => esc_html__('Sidebar Right', 'rentit'),
        )));
    /*****
     * RELATED POSTS
     ****/
    

    $tmp_sectionname = "rentit_rp";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Related Posts', 'rentit'),
        'priority' => 30,
        'panel' => 'panel_blog'));
    $tmp_tabel = 'related_posts';
    $tmp_settingname = $tmp_sectionname . '_' . $tmp_tabel;
    $wp_customize->add_setting($tmp_settingname, array('default' => true,
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enable Related Posts?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));

    /*
     *About the author
     */
    $tmp_sectionname = "rentit_author";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('About the author', 'rentit'),
        'priority' => 30,
        'panel' => 'panel_blog'));
    $tmp_tabel = 'the_author';
    $tmp_settingname = $tmp_sectionname . '_' . $tmp_tabel;
    $wp_customize->add_setting($tmp_settingname, array('default' => true,
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enable About the author?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));

    /*
        *About  blog lis
     *
     */
    $tmp_sectionname = "rentit_blog_list";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Blog list', 'rentit'),
        'priority' => 30,
        'panel' => 'panel_blog'));
    $tmp_tabel = 'read_more';
    $tmp_settingname = $tmp_sectionname . '_' . $tmp_tabel;
    $wp_customize->add_setting($tmp_settingname, array('default' => esc_html__('Read More', 'rentit'),
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>esc_html__('text button  Read More', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text',
    ));

    /*******************************************************************
     * Social Networks
     *******************************************************************/
    $tmp_sectionname = "sotial_networks";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Social Networks', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('Enter url desired social networks so that they appear on the site', 'rentit')));

    /*short*/

    $tmp_settingname = $tmp_sectionname . '_control_social_shortcode';
    $wp_customize->add_setting($tmp_settingname, array('default' => '[rentit_social_links url="https://www.facebook.com/" class="fa-facebook"]
[rentit_social_links url="https://twitter.com/" class="fa-twitter"]
[rentit_social_links url="https://www.instagram.com/" class="fa-instagram"]
[rentit_social_links url="https://pinterest.com/" class="fa-pinterest"]',
        'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Insert Social shortcode ', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('its show in header', 'rentit'),
        'settings' => $tmp_settingname,
        'type' => 'textarea'
    ));

    /*Google */


    $tmp_settingname = $tmp_sectionname . '_control_google';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Google + url', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*facebook*/
    $tmp_settingname = $tmp_sectionname . '_control_facebook';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Facebook  url', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));
    /*instagram*/
    $tmp_settingname = $tmp_sectionname . '_control_PINTEREST';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('PINTEREST', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));
    /*twitter*/
    $tmp_settingname = $tmp_sectionname . '_control_twitter';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Twitter url', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    /*twitter*/
    $tmp_settingname = $tmp_sectionname . '_control_twitter';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Twitter url', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*twitter CONSUMER KEY*/

    $tmp_settingname = $tmp_sectionname . '_twitter_CONSUMER_KEY';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Twitter APP CONSUMER KEY', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*twitter CONSUMER_SECRET*/

    $tmp_settingname = $tmp_sectionname . '_twitter_CONSUMER_SECRET';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Twitter APP CONSUMER SECRET', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    /*facebook App ID*/

    $tmp_settingname = $tmp_sectionname . '_facebook_app_id';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Facebook App ID (get it developers.facebook.com)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*facebook v*/

    $tmp_settingname = $tmp_sectionname . '_facebook_app_secret';
    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Facebook App Secret (get it developers.facebook.com)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    /*******************************************************************
     * Fonts
     *******************************************************************/
    $wp_customize->add_panel('panel_fonts', array(
        'title' => esc_html__('Fonts', 'rentit'),
        'priority' => 29,
        'description' => esc_html__('Settings of the Blog', 'rentit'),
    ));
    /*---------------------------------- SECTION FONTS FOR H -------------------*/
    $tmp_sectionname = "fonts";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Fonts for h1 h2 h3 h4 h5 h6', 'rentit'),
        'priority' => 31,
        'panel' => 'panel_fonts',
        'description' => esc_html__('Enter the url font google and font name', 'rentit')));
    $tmp_settingname = $tmp_sectionname . '_url';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('url google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_name';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('name google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*---------------------SECTION FOR DEFAULT FONTS Raleway ---------------------*/

    $tmp_sectionname = "fonts_d";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Fonts  (default Raleway) ', 'rentit'),
        'priority' => 31,
        'panel' => 'panel_fonts',
        'description' => esc_html__('Enter the url font google and font name', 'rentit')));
    $tmp_settingname = $tmp_sectionname . '_url';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('url google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_name';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('name google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));
    /*---------------------SECTION FOR DEFAULT FONTS Raleway ---------------------*/

    $tmp_sectionname = "fonts_body";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Fonts for body (default Roboto) ', 'rentit'),
        'priority' => 31,
        'panel' => 'panel_fonts',
        'description' => esc_html__('Enter the url font google and font name', 'rentit')));
    $tmp_settingname = $tmp_sectionname . '_url';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('url google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_name';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('name google fonts', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    /*******************************************************************
     * mailchimp
     *******************************************************************/
    $tmp_sectionname = "mailchimp";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Mailchimp', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('Specify api key and ID list', 'rentit')));


    $tmp_settingname = $tmp_sectionname . 'id_list_control';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('ID list', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_api_control';
    $wp_customize->add_setting($tmp_settingname, array('default' => "",
                                                       'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('API key', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));
    /*****************************************************
     * enable RTL (beta)
     *******************************************************/
    $tmp_sectionname = "rentit_rlt";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Enable RTL (beta)', 'rentit'),
        'priority' => 31,
        'description' => ''));
    $tmp_settingname = $tmp_sectionname . '_control';
    $wp_customize->add_setting($tmp_settingname, array('default' => false,
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control('_control', array(
        'label' =>  esc_html__('Enable RTL (beta)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox'));


    /*******************************************************************
     * logo
     *******************************************************************/
    $wp_customize->add_section('themeslug_logo_section', array(
        'title' => esc_html__('Logo', 'rentit'),
        'priority' => 30,
        'description' =>  esc_html__('Upload a logo to replace the default site name and description in the header', 'rentit')
    ));
    $wp_customize->add_setting('themeslug_logo', array('sanitize_callback' =>
        'rentit_sanitize_temp'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
        'themeslug_logo', array(
            'label' => esc_html__('Logo', 'rentit'),
            'section' => 'themeslug_logo_section',
            'settings' => 'themeslug_logo',
        )));

    //footer

    /*******************************************************************
     * Map style
     *******************************************************************/

    $tmp_sectionname = "map";
    $tmp_default = "";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Map style', 'rentit'),
        'priority' => 30,
        'description' => esc_html__('Map style JSON config (see https://snazzymaps.com, http://www.mapstylr.com/showcase/ )', 'rentit')));
    $tmp_tabel = 'stylemap_json';
    $tmp_settingname = $tmp_sectionname . '_' . $tmp_tabel;
    $tmp_settingtitle = esc_html__('stylemap_json', 'rentit');
    $wp_customize->add_setting($tmp_settingname, array('default' => $tmp_default,
        'sanitize_callback' => 'rentit_sanitize_temp'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => $tmp_settingtitle,
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'textarea'));
    $wp_customize->add_setting('Coordinates_map', array('default' =>
        '35.126413,33.429858999999965', 'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control('Coordinates_map' . '_control', array(
        'label' => esc_html__('Coordinates map', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => 'Coordinates_map',
        'type' => 'text'));
    $wp_customize->add_setting('map_zoom_map', array('default' => 9,
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control('map_zoom_map' . '_control', array(
        'label' => esc_html__('Zoom map', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => 'map_zoom_map',
        'type' => 'text'));



    /*******************************************************************
     * Other
     *******************************************************************/
    $tmp_sectionname = "Other";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Other settings', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));


    /*Google */
    $tmp_settingname = $tmp_sectionname . '_control_phone';
    $wp_customize->add_setting($tmp_settingname, array('default' => '+90 555 444 66 33',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Phone', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_control_Helping-text';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'Helping Center',
        'sanitize_callback' => 'esc_attr'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Helping Center text', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    $tmp_settingname = $tmp_sectionname . '_control_urlsupport';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'https://www.zendesk.com/',
        'sanitize_callback' => 'esc_url'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Url to Helping Center', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    $tmp_settingname = $tmp_sectionname . '_date_format_calendar';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'MM/DD/YYYY H:mm ',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('the date format in the calendar', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('MM/DD/YYYY H:mm or DD-MM-YYYY H:mm !!!', 'rentit') ,
        'settings' => $tmp_settingname,
        'type' => 'text'));


    $tmp_settingname = $tmp_sectionname . '_date_format_lang';
    $wp_customize->add_setting($tmp_settingname, array('default' => 'en',
                                                       'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Select the calendar language', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'description' => esc_html__('insert language  for example ru or es  ', 'rentit') . "<a href='http://momentjs.com/#multiple-locale-support'> here</a>",
        'settings' => $tmp_settingname,
        'type' => 'text'));


    /*******************************************************************
     * add color site
     *******************************************************************/
    $tmp_sectionname = "Color_them";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Color theme', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_control_color';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control(new rentit_Customize_color_Control (
        $wp_customize,
        $tmp_settingname,
        array(
            'label' => esc_html__('Select color site', 'rentit'),
            'section' => $tmp_sectionname . "_section",
            'settings' => $tmp_settingname,

        )
    ));




    $wp_customize->add_setting('rentit_content_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'esc_attr'
    ));
 
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'content_color', array(
        'label' =>esc_html__('Custom color', 'rentit'),
        'section' => $tmp_sectionname . '_section',
        'settings' => 'rentit_content_color'
    ) ));





    /*******************************************************************
     * portfolio
     *******************************************************************/

    $tmp_sectionname = "rentit_portfolio";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Portfolio', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_view';

    $wp_customize->add_setting($tmp_settingname, array('default' => 'standard',
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Select type of portfolio', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            'standard' => esc_html__('standard', 'rentit'),
            '4col' => esc_html__('4 col', 'rentit'),
            'alt' => esc_html__('Description under the picture', 'rentit'),
        )));

    /*******************************************************************
     * Price filter
     *******************************************************************/

    $tmp_sectionname = "rentit_filter";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Filter', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit'),
        'panel' => 'panel_shop'
    ));

    $tmp_settingname = $tmp_sectionname . '_price_min';

    $wp_customize->add_setting($tmp_settingname, array('default' => '0',
        'sanitize_callback' => 'rentit_sanitize_to_int'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('min Price in slider', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    $tmp_settingname = $tmp_sectionname . '_price_max';

    $wp_customize->add_setting($tmp_settingname, array('default' => '300',
        'sanitize_callback' => 'rentit_sanitize_to_int'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('max Price in slider', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));



    $tmp_sectionname = "rentit_shop_view";
    $tmp_settingname = $tmp_sectionname . '_setting';
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Shop view', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit'),
        'panel' => 'panel_shop'
    ));

    $wp_customize->add_setting($tmp_settingname, array('default' => 'standard',
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Select type of shop view', 'rentit'),
        'section' =>  $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'select',
        'choices' => array(
            'standard' => esc_html__('standard', 'rentit'),
            'grid' => esc_html__('grid', 'rentit'),
            'grid3' => esc_html__('grid 3 items', 'rentit'),

        )));


	$posts_per_page = (int) sanitize_text_field( get_option( 'posts_per_page' ) );

	if ( get_theme_mod( 'rentit_shop_view_all_products' ) == true ) {
		$posts_per_page = 1000;
	}

    $tmp_settingname = $tmp_sectionname . '_per_page';
    $wp_customize->add_setting($tmp_settingname, array('default' => $posts_per_page,
        'sanitize_callback' => 'esc_attr'));


    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>   esc_html__('How many products display in shop?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text',
    ));



    $tmp_settingname = $tmp_sectionname . '_all_products';
    $wp_customize->add_setting($tmp_settingname, array('default' => false,
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>   esc_html__('show all product in page?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));


    /*******************************************************************
     * Shop
     *******************************************************************/


    $tmp_sectionname = "rentit_shop";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Location sidebar', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit'),
        'panel' => 'panel_shop'
    ));
    $tmp_settingname = $tmp_sectionname . '_sidebar_pos';
    $wp_customize->add_setting($tmp_settingname, array('default' => 's2',
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Location sidebar', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'radio',
        'choices' => array(
            's1' => esc_html__('Sidebar Left', 'rentit'),
            's2' => esc_html__('Sidebar Right', 'rentit'),
        )));


    /*
     * rentit text
     */
    $tmp_sectionname = "rentit_shop_other";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Other settings', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit'),
        'panel' => 'panel_shop'
    ));

    $tmp_settingname = $tmp_sectionname . '_renit_text';

    $wp_customize->add_setting($tmp_settingname, array('default' =>  esc_html__('Rent It', 'rentit'),
        'sanitize_callback' => 'esc_html'));
    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__(' Rent It text', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text'));

    /*******************************************************************
     * COMING SOON
     *******************************************************************/

    $tmp_sectionname = "rentit_COMING_SOON";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('COMING SOON', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_close';

    $wp_customize->add_setting($tmp_settingname, array('default' => false,
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enable COMING SOON  mode ?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));

    $tmp_settingname = $tmp_sectionname . '_y';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'rentit_sanitize_to_int'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enter Year (for example 2018)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text',
    ));
    $tmp_settingname = $tmp_sectionname . '_m';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'rentit_sanitize_to_int'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enter month (for example 12)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text',
    ));
    $tmp_settingname = $tmp_sectionname . '_d';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'rentit_sanitize_to_int'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enter day (for example 25)', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'text',
    ));


    /*******************************************************************
     * Performance
     *******************************************************************/

    $tmp_sectionname = "performance";
    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Performance', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_preloader';

    $wp_customize->add_setting($tmp_settingname, array('default' => true,
        'sanitize_callback' => 'esc_attr'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' =>  esc_html__('Enable preloader ?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));

    /*******************************************************************
     * footer copyright
     *******************************************************************/

    $tmp_sectionname = "footer";


    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Footer', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_copyright';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'wp_kses_post'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Footer copyright', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'textarea',
    ));

    $tmp_settingname = $tmp_sectionname . '_wigets';

    $wp_customize->add_setting($tmp_settingname, array('default' => false,
        'sanitize_callback' => 'wp_kses_post'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Enable Footer widgets on all pages?', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'checkbox',
    ));


    /*******************************************************************
     * contact form shortcode
     *******************************************************************/

    $tmp_sectionname = "rentit_c_form_s";


    $wp_customize->add_section($tmp_sectionname . '_section', array(
        'title' => esc_html__('Contact form shortcode', 'rentit'),
        'priority' => 31,
        'description' => esc_html__('', 'rentit')));

    $tmp_settingname = $tmp_sectionname . '_val';

    $wp_customize->add_setting($tmp_settingname, array('default' => '',
        'sanitize_callback' => 'wp_kses_post'));

    $wp_customize->add_control($tmp_settingname . '_control', array(
        'label' => esc_html__('Contact form shortcode', 'rentit'),
        'section' => $tmp_sectionname . "_section",
        'settings' => $tmp_settingname,
        'type' => 'textarea',
    ));



}

function rentit_sanitize_to_int($value)
{
    return (int)$value;
}


function rentit_sanitize_temp($value)
{
    return $value;
}

///add color controller site
if (class_exists('WP_Customize_Control')):
    class rentit_Customize_color_Control extends WP_Customize_Control
    {
        public $type = 'textarea';

        public function render_content()
        {
            ?>
            <label>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif;
                if (!empty($this->description)) : ?>
                    <span
                        class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></span>
                <?php endif; ?>
                <div class="colors-theme"></div>
                <input class="color_value" type="hidden" <?php $this->input_attrs(); ?>
                       value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            </label>

            <?php
        }
    }
endif;


/**
 *Plug in  script to customize
 */
function rentit_custom_customize_enqueue()
{
    wp_enqueue_script('custom-customize', get_template_directory_uri() .
        '/js/custom.customize.js', array('jquery', 'customize-controls'), false,
        true);
    wp_enqueue_script('rentit_theme-config-js', get_template_directory_uri() .
        '/js/admin/theme-config.js', array('jquery', 'customize-controls'), false,
        true);
    wp_enqueue_style('rentit_theme-config', get_template_directory_uri() .
        '/css/admin/theme-config.css');
}


add_action('customize_controls_enqueue_scripts',
    'rentit_custom_customize_enqueue');
add_action('customize_register', 'rentit_true_customizer_init');











?>