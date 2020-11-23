<?php

/*
Plugin Name: After Hours
Plugin URI: https://ismaeljouhari.com
Description: This plugin allows you to create a submenu in your backend administration (settings) in order to add your opening hours.
Author: Ismaël Jouhari
Version: 1.7.2
Author URI: https://ismaeljouhari.com
*/

require_once('AgenceMenuPage.php');
AgenceMenuPage::register();

register_activation_hook(__FILE__, function () {
    // Je suis activé
    touch(__DIR__ . '/menu');
});

register_deactivation_hook(__FILE__, function () {
    // Je suis désactivé
    unlink(__DIR__ . '/menu'); 
});


?>