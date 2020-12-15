<?php

namespace Admin;

class App
{ 
    /**
    * Adds Wordpress functionalities

    * @method add_supports Adds Wordpress theme supports
    * @method register_assets Registers all CSS and JS assets
    * @method add_google_fonts Adds Google Fonts support
    * @method my_page_login Configures Wordpress login page
    * @method add_title_separator Adds title separator
    * @method unset_tagline Unset tagline in blog title
    * @method customize_header Allow to change header background
    */

    public function __construct() 
    {
        add_action( 'theme_supports', array( $this, 'add_supports') );
        add_action( 'after_setup_theme', array( $this, 'register_assets') );
        add_action( 'wp_enqueue_scripts', array( $this, 'add_google_fonts') );
        add_action( 'login_enqueue_scripts', array( $this, 'my_page_login') );        
        add_filter( 'document_title_separator', array( $this,'add_title_separator'));
        add_filter( 'document_title_parts', array( $this,'unset_tagline'));
        add_action( 'customize_register' , array( $this, 'register' ), 970 );
    }

    public function add_supports()
    {
        /** Automatic feed link*/
        add_theme_support( 'automatic-feed-links' );
        /** Show excerpt*/
        add_post_type_support( 'page', 'excerpt' );
        /** Tag-title **/
        add_theme_support( 'title-tag' );
        /** Post formats */
        $post_formats = array( 'aside','image','gallery','video','audio','link','quote','status' );
        add_theme_support( 'post-formats', $post_formats);
        /** Post thumbnail **/
        add_theme_support( 'post-thumbnails' );

        add_image_size( 'post-thumbnail', 350, 215, true);
        add_image_size( 'homepage-thumb', 270, 175, false );
        add_image_size( 'screen', 2000, 1000, true);
        // remove width & height attributes from images
        
        add_filter( 'post_thumbnail_html', 'remove_img_attr' );
        /** HTML5 support **/
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        /** Refresh widgest **/
        add_theme_support( 'customize-selective-refresh-widgets' );
        /** Custom background **/
        $bg_defaults = array(
            'default-image'          => '',
            'default-preset'         => 'default',
            'default-size'           => 'cover',
            'default-repeat'         => 'no-repeat',
            'default-attachment'     => 'scroll',
        );
        add_theme_support( 'custom-background', $bg_defaults );
    
        /** Custom header **/
        $header_defaults = array(
            'default-image'          => '',
            'width'                  => 300,
            'height'                 => 60,
            'flex-height'            => true,
            'flex-width'             => true,
            'default-text-color'     => '',
            'header-text'            => true,
            'uploads'                => true,
        );
        add_theme_support( 'custom-header', $header_defaults );

        /** Custom menus **/
        add_theme_support('menus', $header_defaults );
        register_nav_menu('header', 'En-tête du menu');
        register_nav_menu('footer', 'Pied de page');
    
        /** Custom log **/
        add_theme_support( 'custom-logo', array(
            'height'      => 60,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ));
    }

    public function register_assets()
    {
        wp_register_style('bootstrap', get_template_directory_uri() . '/scss/custom.css', array(), rand(111,9999), 'all');
        wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
        wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], null, true);
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.js', false, true);
        if (!is_customize_preview()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
        }
        wp_enqueue_style('bootstrap');
        wp_enqueue_script('bootstrap');
        wp_deregister_script('select');

        if(is_admin())
        {
            wp_deregister_style('bootstrap');
        };
    }

    public function add_title_separator()
    {
        return '|';
    }

    public function unset_tagline($title)
    {
        unset($title['tagline']);
        return $title;
    }

    function add_google_fonts() 
    {
        wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Slab&display=swap', false ); 
    }
    
    public function my_page_login() 
    {
        wp_enqueue_style( 
            'custom_login', 
            get_template_directory_uri() . '/assets/custom-login.css', 
            array( 'login' )        );
    }

    /**
     * 
     * @param object $wp_customize An instance of the WP_Customize_Manager class.
     */
    public function register( $wp_customize ) 
    {
        $wp_customize->add_section('apparence', [
            'title' => 'Appearance customization',
        ]);
    
        $wp_customize->add_setting('header_background', [
            'default' => 'transparent',
            'sanitize_callback' => 'sanitize_hex_color'
        ]);
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'header_background', [
            'section' => 'apparence',
            'label' => 'Header background'
        ]));
        add_action( 'customize_preview_init' , array( $this, 'live_preview' ) );
    
    }

    public function live_preview()
    {
        wp_register_script('header_appearance', get_template_directory_uri() . '/js/header.js', array('jquery', 'customize-preview'), rand(111,9999), 'all');

        wp_enqueue_script('header_appearance', get_template_directory_uri() . '/js/header.js', array('jquery', 'customize-preview'), '', true);     
  
    }

}


new App;

?>