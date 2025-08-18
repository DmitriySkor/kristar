<?php
/**
 * Created by Clapat.
 * Date: 22/07/23
 * Time: 6:21 AM
 */

// register navigation menus
if ( ! function_exists( 'montoya_register_nav_menus' ) ){
	
	function montoya_register_nav_menus() {
		
	  register_nav_menus(
		array(
		  'primary-menu' => esc_html__( 'Primary Menu', 'montoya')
		)
	  );
	}
}
add_action( 'init', 'montoya_register_nav_menus' );
 
// theme setup
if ( ! function_exists( 'montoya_theme_setup' ) ){

	function montoya_theme_setup() {

		// Set content width
		if ( ! isset( $content_width ) ) $content_width = 1180;

		// add support for multiple languages
		load_theme_textdomain( 'montoya', get_template_directory() . '/languages' );
			
	}

} // montoya_theme_setup

/**
 * Tell WordPress to run montoya_theme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'montoya_theme_setup' );