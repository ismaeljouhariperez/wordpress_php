<?php

namespace App;


function ninetyninetyone_supports()
{
    /** Automatic feed link*/
    add_theme_support( 'automatic-feed-links' );

    /** Tag-title **/
    add_theme_support( 'title-tag' );

    /** Post formats */
    $post_formats = array('aside','image','gallery','video','audio','link','quote','status');
    add_theme_support( 'post-formats', $post_formats);

    /** pPst thumbnail **/
    add_theme_support( 'post-thumbnails' );

    /** HTML5 support **/
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    /** Refresh widgest **/
    add_theme_support( 'customize-selective-refresh-widgets' );
}

function ninetyninetyone_registerassets()
{
    wp_register_style('bootstrap', 'custom.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], null, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function nineninetyone_title_separator()
{
    return '|';
}

function nineninetyone_title_parts($title)
{
    unset($title['tagline']);
    return $title;
}


add_action('after_setup_theme', 'App\ninetyninetyone_supports' );
add_action('after_setup_theme', 'App\ninetyninetyone_registerassets' );
add_filter('document_title_separator', 'App\nineninetyone_title_separator');
add_filter('document_title_parts', 'App\nineninetyone_title_parts')


?>
