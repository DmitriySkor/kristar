<?php
/**
 * Available filters for extending Merlin WP.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

/**
 * Filter the home page title from your demo content.
 * If your demo's home page title is "Home", you don't need this.
 *
 * @param string $output Home page title.
 */
function montoya_merlin_content_home_page_title( $output ) {
	return 'Portfolio';
}
add_filter( 'merlin_content_home_page_title', 'montoya_merlin_content_home_page_title' );

/**
 * Child theme screenshot
 */
function montoya_merlin_generate_child_screenshot() {
	return get_template_directory() . '/components/merlin/assets/images/screenshot.png';
}
add_filter( 'merlin_generate_child_screenshot', 'montoya_merlin_generate_child_screenshot' );

	
/**
 * Define the demo import files (remote files).
 *
 * To define imports, you just have to add the following code structure,
 * with your own values to your theme (using the 'merlin_import_files' filter).
 */
function montoya_merlin_import_files() {
	return array(
		array(
			'import_file_name'           => 'Demo Import Gutenberg',
			'import_file_url'            => 'http://clapat-themes.com/demo-data/montoya/gutenberg/import.xml',
			'import_widget_file_url'     => 'http://clapat-themes.com/demo-data/montoya/gutenberg/widgets.wie',
			'import_customizer_file_url' => 'http://clapat-themes.com/demo-data/montoya/gutenberg/customizer.dat',
			'import_notice'              => __( 'Demo built with Gutenberg.', 'montoya' ),
			'preview_url'                => 'http://clapat-themes.com/wordpress/montoya/',
		)
	);
}
add_filter( 'merlin_import_files', 'montoya_merlin_import_files' );

/**
 * Execute custom code after the whole import has finished.
 */
function montoya_merlin_after_import_setup() {
	
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$query = new WP_Query(
												array(
													'post_type'              				=> 'page',
													'title'                  					=> 'Overlapping Gallery',
													'post_status'            				=> 'all',
													'posts_per_page'         			=> 1,
													'no_found_rows'          			=> true,
													'ignore_sticky_posts'    		=> true,
													'update_post_term_cache' 	=> false,
													'update_post_meta_cache' 	=> false,
													'orderby'                				=> 'post_date ID',
													'order'                  				=> 'ASC',
												)
											);
					 
	$front_page_id = null;
		
	if ( ! empty( $query->post ) ) {
			
		$front_page_id = $query->post;
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	
	// Update CPT Support for Elementor
	$cpt_support = get_option( 'elementor_cpt_support' );

	if ( ! $cpt_support ) {
		
		$cpt_support = array( 'page', 'post', 'montoya_portfolio' );
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'arts_portfolio_item', $cpt_support ) ) {
		
		$cpt_support[] = 'montoya_portfolio';
		update_option( 'elementor_cpt_support', $cpt_support );
	}

}
add_action( 'merlin_after_all_import', 'montoya_merlin_after_import_setup' );
