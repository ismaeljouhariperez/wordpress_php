<?php

/*
Plugin Name: Taxonomy Register
Plugin URI: https://ismaeljouhari.com
Description: This plugin allows you to create a new taxonomy.
Author: Ismaël Jouhari
Version: 1.0
Author URI: https://ismaeljouhari.com
*/

register_activation_hook(__FILE__, function () {
    // Je suis activé
    touch(__DIR__ . '/taxo');
 });

 register_deactivation_hook(__FILE__, function () {
    // Je suis désactivé
    unlink(__DIR__ . '/taxo'); 
 });

 function ninetyninetyone_register_sport() {
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
}
add_action('init', 'ninetyninetyone_register_sport');


?>
