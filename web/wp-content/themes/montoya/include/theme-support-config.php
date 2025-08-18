<?php
/**
 * Created by Clapat.
 * Date: 31/08/19
 * Time: 5:51 AM
 */

// Featured images support
add_theme_support( 'post-thumbnails', array( 'post' ) );
// Automatic feed links support
add_theme_support( 'automatic-feed-links' );
// title
add_theme_support( 'title-tag' );
// image wide or full alignment
add_theme_support( 'align-wide' );
// support for responsive embeds
add_theme_support( 'responsive-embeds' );
// editor styles
add_theme_support( 'editor-styles' );
//woocommerce support
add_theme_support( 'woocommerce' );
add_theme_support( 'post-thumbnails', array( 'product' ) );

// Support for theme locations in Elementor
if( !function_exists('montoya_register_elementor_locations') ){
	
	function montoya_register_elementor_locations( $elementor_theme_manager ) {

		$elementor_theme_manager->register_location( 'header' );
		$elementor_theme_manager->register_location( 'footer' );

	}
}
add_action( 'elementor/theme/register_locations', 'montoya_register_elementor_locations' );
?>