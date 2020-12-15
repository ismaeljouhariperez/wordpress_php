<?php

/*
Plugin Name: Post Type Register
Plugin URI: https://ismaeljouhari.com
Description: This plugin allows you to create a new post type.
Author: Ismaël Jouhari
Version: 1.0
Author URI: https://ismaeljouhari.com
*/

register_activation_hook(__FILE__, function () {
    // Activated
    touch(__DIR__ . '/pope');
 });

 register_deactivation_hook(__FILE__, function () {
    // Deactivated
    unlink(__DIR__ . '/pope'); 
 });

 add_action('init', function() 
 {
   register_post_type('pin', 
   [
      'label' => 'Types',
      'public' => true,
      'menu_position' => 3,
      'menu_icon' => 'dashicons-building',
      'supports' => ['title', 'editor', 'thumbnail'],
      'show_in_rest' => true,
      'has_archive' => true,
   ]);
});

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


?>
