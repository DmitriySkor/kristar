<?php
/*
Plugin Name: Montoya Core Plugin
Plugin URI: https://clapat.com/
Description: Shortcodes and Custom Post Types for Montoya WordPress Theme
Version: 1.3
Author: ClaPat
Author URI: https://clapat.com/
*/

if( !defined('MONTOYA_SHORTCODES_DIR_URL') ) define('MONTOYA_SHORTCODES_DIR_URL', plugin_dir_url(__FILE__));
if( !defined('MONTOYA_SHORTCODES_DIR') ) define('MONTOYA_SHORTCODES_DIR', plugin_dir_path(__FILE__));

// metaboxes
require_once( MONTOYA_SHORTCODES_DIR . '/metaboxes/init.php' );

// load plugin's text domain
add_action( 'plugins_loaded', 'montoya_shortcodes_load_textdomain' );
function montoya_shortcodes_load_textdomain() {
	load_plugin_textdomain( 'montoya_core_plugin_text_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/include/langs' );
}

// custom post types
require_once( MONTOYA_SHORTCODES_DIR . '/include/custom-post-types-config.php' );

// Montoya shortcodes
require_once( MONTOYA_SHORTCODES_DIR . '/include/shortcodes.php' );

?>
