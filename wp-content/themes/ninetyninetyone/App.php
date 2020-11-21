<?php

namespace Admin;

class App
{
    const my_theme = 'agence_options';
    
    /**
     * Constructor
     */
    public function __construct() 
    {
        add_action( 'after_setup_theme', array( $this, 'ninetyninetyone_supports') );
        add_action( 'wp_pagination', array( $this, 'nineninetyone_pagination') );

        add_action( 'after_setup_theme', array( $this, 'ninetyninetyone_registerassets') );
        add_action( 'pre_get_posts', array( $this, 'ninetyninetyone_pre_get_posts'));
        add_action( 'wp_enqueue_scripts', array( $this, 'wpb_add_google_fonts') );
        add_action( 'login_enqueue_scripts', array( $this, 'my_login_logo') );

        add_filter( 'document_title_separator', array( $this,'nineninetyone_title_separator'));
        add_filter( 'document_title_parts', array( $this,'nineninetyone_title_parts'));
        //add_filter( 'nav_menu_link_attributes', array( $this,'nineninetyone_menu_links_class'));
    }

    public function ninetyninetyone_supports()
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
        add_image_size( 'screen', 2000, 1000, true);
        // remove width & height attributes from images
        function remove_img_attr ($html)
        {
            return preg_replace('/(width|height)="\d+"\s/', "", $html);
        }
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

    public function ninetyninetyone_registerassets()
    {
        wp_register_style('bootstrap', get_template_directory_uri() . '/scss/custom.css', array(), rand(111,9999), 'all');
        wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
        wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], null, true);
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', false, true);

        wp_enqueue_style('bootstrap');
        wp_enqueue_script('bootstrap');

        if(is_admin())
        {
            wp_deregister_style('bootstrap');
        };
    }

    // Change title separator
    public function nineninetyone_title_separator()
    {
        return '|';
    }

    public function nineninetyone_title_parts($title)
    {
        unset($title['tagline']);
        return $title;
    }

    public function nineninetyone_pagination()
    {
        $pages = paginate_links(['type' => 'array']);
        if ($pages === null)
        {
            return;
        }
        echo '<nav aria-label="Page navigation" class="my-4" >';
        echo '<ul class="pagination">';
        foreach($pages as $page)
        {
            $active = strpos($page, 'current') !== false;
            $class = 'page-item';
            if ($active)
            {
                $class .= ' active ';
            }
            echo '<li class="' . $class .'  ">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }

    function wpb_add_google_fonts() 
    {
        wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Lora:ital,wght@0,400;0,500;1,400&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Slab&display=swap', false ); 
    }
    
    public function my_login_logo() 
    {
        wp_enqueue_style( 
            'custom-login', 
            get_template_directory_uri() . '/assets/custom-login.css', 
            array( 'login' ) 
        );
    }


    /**
     * @param WP_Query $query
     */
    /*
    function ninetyninetyone_pre_get_posts(WP_Query $query)
    {
        if(is_admin() )
        {
            return;
        }
    }*/

}

$app = new App;

?>