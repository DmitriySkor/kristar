<?php

require_once ( get_template_directory() . '/include/defines.php' );

// Returns an array with published pages
if( !function_exists('montoya_list_published_pages') ){

	function montoya_list_published_pages(){
		
		$montoya_list_pages = array('' => esc_html__('None', 'montoya') );
		$montoya_wp_published_pages = get_pages();
		foreach( $montoya_wp_published_pages as $wp_published_page ){
			
			$montoya_list_pages[ $wp_published_page->ID ] = $wp_published_page->post_title;
		}
		
		return $montoya_list_pages;
	}
}

// Returns the default values for the social links
if( !function_exists('montoya_social_network_default') ) {

	function montoya_social_network_default( $idx ){

		if( $idx == 5 ){
			
			return "In"; // Instagram
		}
		else if( $idx == 3 ){
			
			return "Be"; // Behance
		}
		else if( $idx == 2 ){
			
			return "Tw"; // Twitter
		}
		else if( $idx == 1 ){
			
			return "Db"; // Dribbble
		}
		else {
			
			return "Fb"; // Facebook
		}
	}
}

if( !function_exists('montoya_social_network_url_default') ) {

	function montoya_social_network_url_default( $idx ){

		if( $idx == 5 ){
			
			return "https://www.instagram.com/clapat.themes/"; // Instagram
		}
		else if( $idx == 4 ){
			
			return "https://www.facebook.com/clapat.ro"; // Facebook
		}
		else if( $idx == 3 ){
			
			return "https://www.behance.com/clapat/"; // Behance
		}
		else if( $idx == 2 ){
			
			return "https://twitter.com/clapatdesign/"; // Twitter
		}
		else if( $idx == 1 ){
			
			return "https://dribbble.com/clapat/"; // Dribbble
		}
		else {
			
			return "";
		}
	}
}

// Metaboxes
require_once ( get_template_directory() . '/include/metabox-config.php');

// Customizer options
require_once( get_template_directory() . '/include/admin-config.php' );

// Load the default options
require_once( get_template_directory() . '/include/default-theme-options.php' );

if( !function_exists('montoya_get_theme_options') ){

	function montoya_get_theme_options( $option_id ){

		global $montoya_default_theme_options;

		$default_value = false;
		if ( isset( $montoya_default_theme_options ) && isset( $montoya_default_theme_options[$option_id] ) ){

			$default_value  = $montoya_default_theme_options[$option_id];

		}

		return get_theme_mod( $option_id, $default_value );

	}
}

if( !function_exists('montoya_get_post_meta') ){

	function montoya_get_post_meta( $opt_name = "", $thePost = array(), $meta_key = "", $def_val = "" ) {

		if( class_exists('Montoya\Core\Metaboxes\Meta_Boxes') ){

			return Montoya\Core\Metaboxes\Meta_Boxes::get_metabox_value( $thePost, $meta_key );
		}

		return "";
	}
}

if( !function_exists('montoya_get_current_query') ){

	function montoya_get_current_query(){

		global $montoya_posts_query;
		global $wp_query;
		if( $montoya_posts_query == null ){
			return $wp_query;
		}
		else{
			return $montoya_posts_query;
		}

	}
}

// Portfolio Next Project Image
if( !function_exists('montoya_portfolio_next_project_image') ){

	function montoya_portfolio_next_project_image( $portfolio_image_param = null ){

		global $montoya_portfolio_image_param;
		if( isset( $portfolio_image_param ) && ( $portfolio_image_param != null ) ){

			$montoya_portfolio_image_param = $portfolio_image_param;
		}

		return $montoya_portfolio_image_param;
	}
}

// Portfolio Thumbs List
if( !function_exists('montoya_portfolio_thumbs_list') ){

	function montoya_portfolio_thumbs_list( $portfolio_thumbs_param = null ){

		global $montoya_portfolio_thumbs_param;
		if( isset( $portfolio_thumbs_param ) && ( $portfolio_thumbs_param != null ) ){

			$montoya_portfolio_thumbs_param = $portfolio_thumbs_param;
		}

		return $montoya_portfolio_thumbs_param;
	}
}

// Fetch Portfolio Items
if( !function_exists('montoya_fetch_portfolio_items') ){

	function montoya_fetch_portfolio_items(){

		$montoya_portfolio_tax_query = null;
		$montoya_portfolio_category_filter	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-filter-category' );

		$montoya_array_terms = null;
		if( !empty( $montoya_portfolio_category_filter ) ){

			$montoya_array_terms = explode( ",", $montoya_portfolio_category_filter );
			$montoya_portfolio_tax_query = array(
												array(
													'taxonomy' 	=> 'portfolio_category',
													'field'		=> 'slug',
													'terms'		=> $montoya_array_terms,
													),
											);
		}

		$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$montoya_args = array(
							'post_type' => 'montoya_portfolio',
							'paged' => $montoya_paged,
							'tax_query' => $montoya_portfolio_tax_query,
							'posts_per_page' => 1000,
						);

		$montoya_portfolio = new WP_Query( $montoya_args );

		$montoya_portfolio_items = array();
								
		// collect the posts first
		$montoya_current_item_count = 1;
		while( $montoya_portfolio->have_posts() ){

			$montoya_portfolio->the_post();

			$montoya_hero_properties = new Montoya_Hero_Properties();
			$montoya_hero_properties->getProperties( get_post_type( get_the_ID() ) );
			$montoya_hero_properties->item_no = $montoya_current_item_count;
			$montoya_portfolio_items[] = $montoya_hero_properties;
								
			$montoya_current_item_count++;
		}

		wp_reset_postdata();

		montoya_portfolio_thumbs_list( $montoya_portfolio_items );
	}
}

// Display Back to Top Button
if( !function_exists('montoya_display_back_to_top') ){

	function montoya_display_back_to_top(){

		if( !is_page_template('portfolio-showcase-gallery-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Display Copyright
if( !function_exists('montoya_display_copyright') ){

	function montoya_display_copyright(){

		if(	!is_page_template('portfolio-showcase-gallery-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Display Social Links
if( !function_exists('display_footer_social_links_section') ){

	function display_footer_social_links_section(){

		if( !is_page_template('portfolio-showcase-gallery-page.php') ){

			return true;
		} else {

			return false;
		}
	}
}

// Check if the current post/page is built using Elementor
if( !function_exists('montoya_post_is_built_with_elementor') ){

	function montoya_post_is_built_with_elementor( $post_id = null ) {

		if ( ! class_exists( '\Elementor\Plugin' ) ) {

			return false;
		}

		if ( $post_id == null ) {

			$post_id = get_the_ID();
		}

		if ( is_singular() && \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ) {

			return true;
		}

		return false;
	}

}

// Hero properties
require_once ( get_template_directory() . '/include/hero-properties.php');

// Support for automatic plugin installation
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/required_plugins.php');

// Merlin setup wizzard
require_once( get_template_directory() . '/components/merlin/vendor/autoload.php' );
require_once( get_template_directory() . '/components/merlin/class-merlin.php' );
require_once( get_template_directory() . '/components/merlin/merlin-config.php' );
require_once( get_template_directory() . '/components/merlin/merlin-filters.php' );

// Widgets
require_once(  get_template_directory() . '/components/widgets/widgets.php');

// Util functions
require_once ( get_template_directory() . '/include/util_functions.php');

// Add theme support
require_once ( get_template_directory() . '/include/theme-support-config.php');

// Theme setup
require_once ( get_template_directory() . '/include/setup-config.php');

// Enqueue scripts
require_once ( get_template_directory() . '/include/scripts-config.php');

// Hooks
require_once ( get_template_directory() . '/include/hooks-config.php');

// Blog comments and pagination
require_once ( get_template_directory() . '/include/blog-config.php');

// Editor styles
add_editor_style( 'style-editor.css' );
?>
