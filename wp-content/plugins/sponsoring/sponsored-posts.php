<?php

/*
Plugin Name: Sponsored Posts
Plugin URI: https://ismaeljouhari.com
Description: This plugin allows you to create sponsored posts and contents.
Author: Ismaël Jouhari
Version: 1.0
Author URI: https://ismaeljouhari.com
*/

include_once('SponsoMetaBox.php');
SponsoMetaBox::register();

register_activation_hook(__FILE__, function () {
    // Je suis activé
    touch(__DIR__ . '/sponsored');
 });

 register_deactivation_hook(__FILE__, function () {
    // Je suis désactivé
    unlink(__DIR__ . '/sponsored'); 
 });

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

add_action('admin_enqueue_scripts', function()
{
    wp_enqueue_style('admin_ninetyninetyone', get_template_directory_uri() . '/assets/admin-min.css');
});


?>


