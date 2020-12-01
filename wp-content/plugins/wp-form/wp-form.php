<?php

/*
Plugin Name: WP-Form
Plugin URI: https://ismaeljouhari.com
Description: A simple contact form plugin.
Author: Ismaël Jouhari
Author URI: https://ismaeljouhari.com
Version: 1.0
*/

define( 'WPF_PLUGIN', __FILE__ );
define( 'WPF_PLUGIN_BASENAME', plugin_basename( WPF_PLUGIN ) );
define( 'WPF_PLUGIN_NAME', trim( dirname( WPF_PLUGIN_BASENAME ), '/' ) );
define( 'WPF_PLUGIN_DIR', untrailingslashit( dirname( WPF_PLUGIN ) ) );

require_once(WPF_PLUGIN_DIR . '/Controller/Admin.php');
require_once(WPF_PLUGIN_DIR . '/Controller/Process.php');

?>