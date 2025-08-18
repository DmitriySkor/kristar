<?php

if( !isset( $montoya_default_theme_options ) ){

	$montoya_default_theme_options = array();

	// General Settings
	$montoya_default_theme_options['clapat_montoya_enable_ajax'] = 0;
	$montoya_default_theme_options['clapat_montoya_enable_smooth_scrolling'] = 0;
	$montoya_default_theme_options['clapat_montoya_enable_magic_cursor'] = 0;
	$montoya_default_theme_options['clapat_montoya_primary_color'] ='#8c6144';
	$montoya_default_theme_options['clapat_montoya_enable_preloader'] = 1;
	$montoya_default_theme_options['clapat_montoya_preloader_hover_line'] = esc_html__( 'Loading', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_preloader_text'] = esc_html__( 'Please wait, content is loading', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_rounded_borders'] = 1;
	$montoya_default_theme_options['clapat_montoya_default_page_bknd_type'] = 'light-content';
	$montoya_default_theme_options['clapat_montoya_enable_page_title_as_hero'] = 1;
	
	// Header Settings
	$montoya_default_theme_options['clapat_montoya_logo'] = esc_url( get_template_directory_uri() . '/images/logo.png' );
	$montoya_default_theme_options['clapat_montoya_logo_light'] = esc_url( get_template_directory_uri() . '/images/logo-white.png' );
	$montoya_default_theme_options['clapat_montoya_enable_fullscreen_menu'] = 0;
	$montoya_default_theme_options['clapat_montoya_header_menu_type'] = 'classic-burger-lines';
	$montoya_default_theme_options['clapat_montoya_menu_btn_caption'] = esc_html__( 'Menu', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_menu_background_color'] = '#0c0c0c';
	$montoya_default_theme_options['clapat_montoya_menu_background_type'] = 'invert-header';
	
	// Footer Settings
	$montoya_default_theme_options['clapat_montoya_enable_back_to_top'] = 1;
	$montoya_default_theme_options['clapat_montoya_back_to_top_caption'] = esc_html__( 'Back Top', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_footer_copyright'] = wp_kses( __('2024 © <a class="link" target="_blank" href="https://www.clapat-themes.com/">ClaPat</a>. All rights reserved.', 'montoya'), 'montoya_allowed_html' );
	$montoya_default_theme_options['clapat_montoya_footer_social_links_prefix'] = esc_html__( 'Follow Us', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_social_links_icons'] = 0;
	global $montoya_social_links;
	$social_network_ids = array_keys( $montoya_social_links );
	for( $idx = 1; $idx <= MONTOYA_MAX_SOCIAL_LINKS; $idx++ ){

		$montoya_default_theme_options['clapat_montoya_footer_social_' . $idx] = montoya_social_network_default( $idx );
		$montoya_default_theme_options['clapat_montoya_footer_social_url_' . $idx] = montoya_social_network_url_default( $idx );
	}
	
	// Portfolio Settings
	$montoya_default_theme_options['clapat_core_portfolio_custom_slug'] = '';
	$montoya_default_theme_options['clapat_montoya_portfolio_nav_autotrigger'] = 1;
	$montoya_default_theme_options['clapat_montoya_portfolio_autoscroll_hero'] = 1;
	$montoya_default_theme_options['clapat_montoya_view_project_caption'] = esc_html__('VIEW', 'montoya');
	$montoya_default_theme_options['clapat_montoya_open_project_caption'] = esc_html__('OPEN', 'montoya');
	$montoya_default_theme_options['clapat_montoya_portfolio_filter_all_caption'] = esc_html__('All', 'montoya');
	$montoya_default_theme_options['clapat_montoya_portfolio_show_filters_caption'] = esc_html__( 'Filters', 'montoya' );
	$montoya_default_theme_options['clapat_montoya_portfolio_next_caption_first_line'] = esc_html__('Next', 'montoya');
	$montoya_default_theme_options['clapat_montoya_portfolio_next_caption_second_line'] = esc_html__('Project', 'montoya');
	$montoya_default_theme_options['clapat_montoya_showcase_gallery_next_caption'] = esc_html__('NEXT', 'montoya');
	$montoya_default_theme_options['clapat_montoya_showcase_gallery_prev_caption'] = esc_html__('PREV', 'montoya');
	$montoya_default_theme_options['clapat_montoya_showcase_scroll_drag_caption'] = esc_html__('Scroll or Drag', 'montoya');
	$montoya_default_theme_options['clapat_montoya_portfolio_share_social_networks_caption'] = esc_html__('Share Project:', 'montoya');
	$montoya_default_theme_options['clapat_montoya_portfolio_share_social_networks'] = 'facebook,twitter,pinterest';
	$montoya_default_theme_options['clapat_montoya_portfolio_navigation_order'] = 'forward';
									
	// Blog Settings
	$montoya_default_theme_options['clapat_montoya_blog_navigation_type'] = 'blog-nav-classic';
	$montoya_default_theme_options['clapat_montoya_blog_next_post_caption'] = esc_html__('Next', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_prev_post_caption'] = esc_html__('Prev', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_read_more_caption'] = esc_html__('Read Article', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_no_posts_caption'] = esc_html__('No more posts', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_prev_posts_caption'] = esc_html__('Prev', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_next_posts_caption'] = esc_html__('Next', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_default_title'] = esc_html__('Blog', 'montoya');
	$montoya_default_theme_options['clapat_montoya_blog_scroll_effect_type'] = 'clapat-blog-effect-scroll-none';
	
	// Map Settings
	$montoya_default_theme_options['clapat_montoya_map_address'] = esc_html__('775 New York Ave, Brooklyn, Kings, New York 11203', 'montoya');
	$montoya_default_theme_options['clapat_montoya_map_marker'] = esc_url( get_template_directory_uri() . '/images/marker.png');
	$montoya_default_theme_options['clapat_montoya_map_zoom'] = 16;
	$montoya_default_theme_options['clapat_montoya_map_company_name'] = esc_html__('montoya', 'montoya');
	$montoya_default_theme_options['clapat_montoya_map_company_info'] = esc_html__('Here we are. Come to drink a coffee!', 'montoya');
	$montoya_default_theme_options['clapat_montoya_map_type'] = 'satellite';
	$montoya_default_theme_options['clapat_montoya_map_api_key'] = '';
	
	// Error Page
	$montoya_default_theme_options['clapat_montoya_error_title'] = esc_html__('404', 'montoya');
	$montoya_default_theme_options['clapat_montoya_error_info'] = esc_html__('The page you are looking for could not be found.', 'montoya');
	$montoya_default_theme_options['clapat_montoya_error_back_button'] = esc_html__('Home Page', 'montoya');
	$montoya_default_theme_options['clapat_montoya_error_back_button_hover_caption'] = esc_html__('Go Back', 'montoya');
	$montoya_default_theme_options['clapat_montoya_error_back_button_url'] = esc_url( get_home_url() );
	$montoya_default_theme_options['clapat_montoya_error_page_bknd_type'] = 'light-content';
	
	// Shop
	$montoya_default_theme_options['clapat_montoya_shop_enable_custom_grid'] = 0;
	$montoya_default_theme_options['clapat_montoya_sticky_shop_product_caption'] = 0;
	$montoya_default_theme_options['clapat_montoya_shop_product_page_bknd_type'] = 'light-content';
	$montoya_default_theme_options['clapat_montoya_shop_product_page_bknd_color'] = '#0c0c0c';
}

if( !class_exists('Clapat\Montoya\Metaboxes\Meta_Boxes') ){

	$montoya_default_meta_options = array (
									"montoya-opt-page-bknd-color-code" => "#0c0c0c",
									"montoya-opt-page-bknd-color" => "light-content",
									"montoya-opt-page-enable-hero" => "",
									"montoya-opt-page-hero-img" => "",
									"montoya-opt-page-video" => false,
									"montoya-opt-page-video-webm" => "",
									"montoya-opt-page-video-mp4" => "",
									"montoya-opt-page-hero-caption-title" => "",
									"montoya-opt-page-hero-caption-subtitle" => "",
									"montoya-opt-page-hero-info-text" => "",
									"montoya-opt-page-hero-scroll-caption" => esc_html__('Scroll to navigate', 'montoya'),
									"montoya-opt-page-hero-parallax-caption" => "parallax-scroll-caption",
									"montoya-opt-page-hero-caption-align" => "text-align-center",
									"montoya-opt-page-hero-caption-flip-effect" => true,
									"montoya-opt-page-navigation-hover-caption" => esc_html__('Next Page', 'montoya'),
									"montoya-opt-page-navigation-caption-title" => "",
									"montoya-opt-page-navigation-caption-subtitle" => "",
									"montoya-opt-page-navigation-next-page" => "", 
									"montoya-opt-page-portfolio-filter-category" => "",
									"montoya-opt-page-portfolio-grid-layout" => "parallax-grid",
									"montoya-opt-page-portfolio-thumb-to-fullscreen" => "webgl-fitthumbs",
									"montoya-opt-page-portfolio-thumb-to-fullscreen-webgl-type" => "fx-one",
									"montoya-opt-page-portfolio-grid-content-position" => "after",									
									"montoya-opt-page-portfolio-grid-layout-type" => "layout-one",
									"montoya-opt-page-portfolio-gallery-enable-preview" => true,
									"montoya-opt-page-portfolio-gallery-enable-tilt" => true,
									"montoya-opt-blog-bknd-color-code" => "#0c0c0c",
									"montoya-opt-blog-bknd-color" => "light-content",
									"montoya-opt-blog-caption-alignment" => "text-align-center",
									"montoya-opt-portfolio-bknd-color-code" => "#0c0c0c",
									"montoya-opt-portfolio-bknd-color" => "light-content",
									"montoya-opt-portfolio-curtain-color-code" => "#0c0c0c",
									"montoya-opt-portfolio-project-year" => date("Y"),
									"montoya-opt-portfolio-hero-img" => "",
									"montoya-opt-portfolio-video" => false,
									"montoya-opt-portfolio-video-webm" => "",
									"montoya-opt-portfolio-video-mp4" => "",
									"montoya-opt-portfolio-hero-caption-title" => "",
									"montoya-opt-portfolio-hero-parallax-caption" => "parallax-scroll-caption",
									"montoya-opt-portfolio-hero-scroll-caption" => "",
									"montoya-opt-portfolio-hero-caption-flip-effect" => true,
									"montoya-opt-portfolio-thumb-gallery-offset" => "0",
									"montoya-opt-portfolio-thumb-gallery-scale" => "has-scale-large",
									"montoya-opt-portfolio-gallery-enable-parallax" => true,
								);
}

?>
