<?php

//namespace App;

function ninetyninetyone_supports()
{
    /** Automatic feed link*/
    add_theme_support( 'automatic-feed-links' );

    /** Tag-title **/
    add_theme_support( 'title-tag' );

    /** Post formats */
    $post_formats = array( 'aside','image','gallery','video','audio','link','quote','status' );
    add_theme_support( 'post-formats', $post_formats);

    /** Post thumbnail **/
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-thumbnail', 350, 215, true);
 
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
    ) );
}

add_action( 'after_setup_theme', 'ninetyninetyone_supports' );

function ninetyninetyone_registerassets()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/scss/custom.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], null, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', false, true);

    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

add_action( 'after_setup_theme', 'ninetyninetyone_registerassets' );



// Change title separator
function nineninetyone_title_separator()
{
    return '|';
}

function nineninetyone_title_parts($title)
{
    unset($title['tagline']);
    return $title;
}

// Adapt to Bootstrap structure
function nineninetyone_menu_class($classes): array
{
    $classes[] = 'nav-item';
    return $classes;
}

function nineninetyone_menu_links_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function nineninetyone_pagination()
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


// Filters
add_filter( 'document_title_separator', 'nineninetyone_title_separator');
add_filter( 'document_title_parts', 'nineninetyone_title_parts');
add_filter( 'nav_menu_link_attributes', 'nineninetyone_menu_links_class');

/**
 * @param WP_Query $query
 */
function ninetyninetyone_pre_get_posts(WP_Query $query)
{
    if(is_admin() )
    {
        return;
    }

}
add_action('pre_get_posts', 'ninetyninetyone_pre_get_posts');



function atg_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'secondary') {
      $classes[] = 'list-inline-item';
    }
    return $classes;
  }

  add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

?>
