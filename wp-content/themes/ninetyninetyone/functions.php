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

function ninetyninetyone_registeritems()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
    ]);

    register_post_type('pin', [
        'label' => 'Types',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true,
    ]);
}


// Actions
add_action( 'init', 'ninetyninetyone_registeritems');
add_action( 'after_setup_theme', 'ninetyninetyone_supports' );
add_action( 'after_setup_theme', 'ninetyninetyone_registerassets' );
add_action('admin_enqueue_scripts', function()
{
    wp_enqueue_style('admin_ninetyninetyone', get_template_directory_uri() . '/assets/admin-min.css');
});


// Filters
add_filter( 'document_title_separator', 'nineninetyone_title_separator');
add_filter( 'document_title_parts', 'nineninetyone_title_parts');
add_filter( 'nav_menu_css_class', 'nineninetyone_menu_class');
add_filter( 'nav_menu_link_attributes', 'nineninetyone_menu_links_class');

add_filter( 'manage_pin_posts_columns', function($columns)
{
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});

add_filter( 'manage_pin_posts_custom_column', function($column, $postId)
{
    if($column === "thumbnail")
    {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);

add_filter('manage_post_posts_columns', function ($columns) {
    $newColumns = [];
    foreach($columns as $k => $v) {
        if ($k === 'date') {
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});

add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        if (!empty(get_post_meta($postId, SponsoMetaBox::META_KEY, true))) {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);


require_once('metaboxes/sponso.php');
SponsoMetaBox::register();
require_once('options/agence.php');
AgenceMenuPage::register();





?>
