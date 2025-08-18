<?php
/**
 * Montoya Theme Config File
 */

if ( ! function_exists( 'montoya_options_config' ) ) {

	function montoya_options_config( $wp_customize ){

		$montoya_before_default_section = 40;
		
		/*** General Settings section ***/
		$wp_customize->add_section(
			'general_settings',
			array(
				'title'    => esc_html__( 'General Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 8),
			)
		);
	
		// Enable AJAX
		$wp_customize->add_setting(
			'clapat_montoya_enable_ajax',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_ajax',
			array(
				'label'   		=> esc_html__( 'Load Pages With Ajax', 'montoya' ),
				'description'  	=> esc_html__( 'When navigates to another page it loads the target content without reloading the current page.', 'montoya' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Enable Smooth Scroll
		$wp_customize->add_setting(
			'clapat_montoya_enable_smooth_scrolling',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_smooth_scrolling',
			array(
				'label'   		=> esc_html__( 'Enable Smooth Scrolling', 'montoya' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
				
		// Enable Magic Cursor
		$wp_customize->add_setting(
			'clapat_montoya_enable_magic_cursor',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_magic_cursor',
			array(
				'label'   		=> esc_html__( 'Enable Magic Cursor', 'montoya' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Primary color for magic cursor
		$wp_customize->add_setting(
			'clapat_montoya_primary_color',
			array(
				'default'           	=> '#8c6144',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'clapat_montoya_primary_color', 
			array(
				'label'      => esc_html__( 'Magic Cursor Primary Color', 'montoya' ),
				'description' => esc_html__('Set the primary color for magic cursor.', 'montoya'),
				'section'    => 'general_settings'
			)
		));
		
		// Enable Uppercase Text
		$wp_customize->add_setting(
			'clapat_montoya_rounded_borders',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_rounded_borders',
			array(
				'label'   		=> esc_html__( 'Enable rounded borders around common elements', 'montoya' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
				
		// Global background page type
		$wp_customize->add_setting(
			'clapat_montoya_default_page_bknd_type',
			array(
				'default'           	=> 'light-content',
				'sanitize_callback' 	=> 'montoya_sanitize_default_page_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_default_page_bknd_type',
			array(
				'label'   		=> esc_html__('Default Background Type', 'montoya'),
				'description'	=> esc_html__('Default background type for pages, posts and category pages. The background type set in page options will overwrite this option.', 'montoya'),
				'section' 		=> 'general_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'dark-content' => esc_html__('White', 'montoya'),
										'light-content' => esc_html__('Black', 'montoya') ),
			)
		);
		
		// Enable page title as hero caption
		$wp_customize->add_setting(
			'clapat_montoya_enable_page_title_as_hero',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_page_title_as_hero',
			array(
				'label'   		=> esc_html__( 'Display Page Title When Hero Section Is Disabled', 'montoya' ),
				'section' 		=> 'general_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		/*** End General Settings section ***/
		
		/*** Preloader Settings section ***/
		$wp_customize->add_section(
			'preloader_settings',
			array(
				'title'    => esc_html__( 'Preloader Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 7),
			)
		);
		
		// Enable Preloader
		$wp_customize->add_setting(
			'clapat_montoya_enable_preloader',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_preloader',
			array(
				'label'   		=> esc_html__( 'Enable Preloader', 'montoya' ),
				'description'  	=> esc_html__( 'Enable preloader mask while the page is loading.', 'montoya' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Preloader
		$wp_customize->add_setting(
			'clapat_montoya_preloader_hover_line',
			array(
				'default'           	=> esc_html__( 'Loading', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_preloader_hover_line',
			array(
				'label'   		=> esc_html__( 'Preloader Hover Text', 'montoya' ),
				'description'	=> esc_html__( 'Mouse ball cursor text displayed on hover during preloading.', 'montoya' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_preloader_text',
			array(
				'default'           	=> esc_html__( 'Please wait, content is loading', 'montoya' ),
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_preloader_text',
			array(
				'label'   		=> esc_html__( 'Preloader text', 'montoya' ),
				'description'	=> esc_html__( 'More detailed text displayed while preloader is shown.', 'montoya' ),
				'section' 		=> 'preloader_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Preloader Settings section ***/
		
		/*** Header Settings section ***/
		$wp_customize->add_section(
			'header_settings',
			array(
				'title'    => esc_html__( 'Header Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 6),
			)
		);
		
		// Logo (default)
		$wp_customize->add_setting(
			'clapat_montoya_logo',
			array(
				'default'           	=> get_template_directory_uri() . '/images/logo.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_montoya_logo', 
			array(
				'label'      => esc_html__( 'Header Logo', 'montoya' ),
				'description' => esc_html__('Upload your logo to be displayed at the left side of the header menu.', 'montoya'),
				'section'    => 'header_settings'
			)
		));
		
		// Logo (light version)
		$wp_customize->add_setting(
			'clapat_montoya_logo_light',
			array(
				'default'           	=> get_template_directory_uri() . '/images/logo-white.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_montoya_logo_light', 
			array(
				'label'      => esc_html__( 'Header Logo Light', 'montoya' ),
				'description' => esc_html__('Light logo displayed on dark backgrounds.', 'montoya'),
				'section'    => 'header_settings'
			)
		));
		
		// Enable Fullscreen Menu
		$wp_customize->add_setting(
			'clapat_montoya_header_menu_type',
			array(
				'default'           	=> 'classic-burger-lines',
				'sanitize_callback' 	=> 'montoya_sanitize_menu_header_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_header_menu_type',
			array(
				'label'   		=> esc_html__('Desktop Menu Type', 'montoya'),
				'description'	=> esc_html__('The type of the header menu on desktop.', 'montoya'),
				'section' 		=> 'header_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'classic-burger-dots' => esc_html__('Classic - Responsive Burger Menu Dots', 'montoya'),
										'classic-burger-lines' => esc_html__('Classic - Responsive Burger Menu Lines', 'montoya'),
										'fullscreen-burger-dots' => esc_html__('Fullscreen - Burger Menu Dots', 'montoya'),
										'fullscreen-burger-lines' => esc_html__('Fullscreen - Burger Menu Lines', 'montoya') ),
			)
		);
		
		// Menu button caption
		$wp_customize->add_setting(
			'clapat_montoya_menu_btn_caption',
			array(
				'default'           	=> esc_html__( 'Menu', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_menu_btn_caption',
			array(
				'label'   		=> esc_html__( 'Menu button caption', 'montoya' ),
				'description'	=> esc_html__( 'Text preceding the burger menu button.', 'montoya' ),
				'section' 		=> 'header_settings',
				'type'    		=> 'text',
			)
		);
		
		// Menu background color
		$wp_customize->add_setting(
			'clapat_montoya_menu_background_color',
			array(
				'default'           	=> '#0c0c0c',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'clapat_montoya_menu_background_color', 
			array(
				'label'      => esc_html__( 'Menu Background Color', 'montoya' ),
				'description' => esc_html__('Set the background color for fullscreen or classic responsive menu.', 'montoya'),
				'section'    => 'header_settings'
			)
		));
		
		// Menu background color type
		$wp_customize->add_setting(
			'clapat_montoya_menu_background_type',
			array(
				'default'           	=> 'invert-header',
				'sanitize_callback' 	=> 'montoya_sanitize_menu_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_menu_background_type',
			array(
				'label'   		=> esc_html__('Menu Background Type', 'montoya'),
				'description'	=> esc_html__('Set background type for for fullscreen or classic responsive menu.', 'montoya'),
				'section' 		=> 'header_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'inherit-header' => esc_html__('Dark', 'montoya'),
										'invert-header' => esc_html__('Light', 'montoya') ),
			)
		);
		/*** End Header Settings section ***/
		
		
		/*** Footer Settings section ***/
		$wp_customize->add_section(
			'footer_settings',
			array(
				'title'    => esc_html__( 'Footer Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 5),
			)
		);
		
		// Enable Back To Top button
		$wp_customize->add_setting(
			'clapat_montoya_enable_back_to_top',
			array(
				'default'          		=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_enable_back_to_top',
			array(
				'label'   		=> esc_html__( 'Enable Back To Top Button', 'montoya' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_back_to_top_caption',
			array(
				'default'          		=> esc_html__( 'Back Top', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_back_to_top_caption',
			array(
				'label'   		=> esc_html__( 'Back To Top Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption displayed next to the back to top button in the footer.', 'montoya' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'text',
			)
		);
		
		// Copyright
		$wp_customize->add_setting(
			'clapat_montoya_footer_copyright',
			array(
				'default'           	=> wp_kses( __('2024 © <a class="link" target="_blank" href="https://www.clapat-themes.com/">ClaPat</a>. All rights reserved.', 'montoya'), 'montoya_allowed_html' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_footer_copyright',
			array(
				'label'   		=> esc_html__( 'Copyright text', 'montoya' ),
				'description'	=> esc_html__( 'This is the copyright text displayed in the footer.', 'montoya' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'textarea',
			)
		);
		
		// Social links
		$wp_customize->add_setting(
			'clapat_montoya_footer_social_links_prefix',
			array(
				'default'           	=> esc_html__( 'Follow Us', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_footer_social_links_prefix',
			array(
				'label'   		=> esc_html__( 'Social Links Prefix', 'montoya' ),
				'description'	=> esc_html__('Text preceding the social links.', 'montoya'),
				'section' 		=> 'footer_settings',
				'type'    		=> 'text',
			)
		);
		
		// Social Links Display
		$wp_customize->add_setting(
			'clapat_montoya_social_links_icons',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_social_links_icons',
			array(
				'label'   		=> esc_html__( 'Display Social Links As Fontawesome Icons', 'montoya' ),
				'description'  	=> esc_html__( 'If unchecked will display the social networks acronyms.', 'montoya' ),
				'section' 		=> 'footer_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		global $montoya_social_links;
		$social_network_ids = array_keys( $montoya_social_links );
		for( $idx = 1; $idx <= MONTOYA_MAX_SOCIAL_LINKS; $idx++ ){

			$wp_customize->add_setting(
				'clapat_montoya_footer_social_' . $idx,
				array(
					'default'           	=> montoya_social_network_default( $idx ),
					'sanitize_callback' 	=> 'montoya_sanitize_social_links',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_footer_social_' . $idx,
				array(
					'label'   		=>  esc_html__('Social Network Name ', 'montoya' ) . $idx,
					'section' 		=> 'footer_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_social_links,
				)
			);
			
			$wp_customize->add_setting(
				'clapat_montoya_footer_social_url_' . $idx,
				array(
					'default'           	=> montoya_social_network_url_default( $idx ),
					'sanitize_callback' 	=> 'esc_url_raw',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_footer_social_url_' . $idx,
				array(
					'label'   		=>  esc_html__('Social Link URL ', 'montoya' ) . $idx,
					'section' 		=> 'footer_settings',
					'type'    		=> 'url',
				)
			);
			
		}
		/*** End Footer Settings section ***/
		
		/*** Portfolio Settings section ***/
		$wp_customize->add_section(
			'portfolio_settings',
			array(
				'title'    => esc_html__( 'Portfolio Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 4),
			)
		);
		
		// Custom portfolio slug
		$wp_customize->add_setting(
			'clapat_core_portfolio_custom_slug',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'montoya_sanitize_slug_field',
				'transport'         	=> 'postMessage',
			)
		);
		
		$wp_customize->add_control(
			'clapat_core_portfolio_custom_slug',
			array(
				'label'   		=> esc_html__( 'Custom Slug', 'montoya' ),
				'description'	=> esc_html__('If you want your portfolio post type to have a custom slug in the url, please enter it here. You will still have to refresh your permalinks after saving this! This is done by going to Settings > Permalinks and clicking save.', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Portfolio Enable Portfolio Autotrigger
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_nav_autotrigger',
			array(
				'default'           	=> 1,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_nav_autotrigger',
			array(
				'label'   		=> esc_html__( 'Portfolio Auto Navigate On End Scroll', 'montoya' ),
				'description'	=> esc_html__( 'When reaching the bottom of each portfolio page, automatically navigates to the next page.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// Portfolio Enable Hero Autoscroll
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_autoscroll_hero',
			array(
				'default'           	=> 0,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_autoscroll_hero',
			array(
				'label'   		=> esc_html__( 'Autoscroll Hero Image', 'montoya' ),
				'description'	=> esc_html__( 'When entering the portfolio page, slightly scroll down the hero image.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'checkbox',
			)
		);
		
		// View Project caption
		$wp_customize->add_setting(
			'clapat_montoya_view_project_caption',
			array(
				'default'           	=> esc_html__( 'VIEW', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_view_project_caption',
			array(
				'label'   		=> esc_html__( 'View Project Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption displayed on hover in portfolio gallery, showcase or carousel templates when the portfolio link opens the thumbnails grid preview with the current item highlighted.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Open Project caption
		$wp_customize->add_setting(
			'clapat_montoya_open_project_caption',
			array(
				'default'           	=> esc_html__( 'OPEN', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_open_project_caption',
			array(
				'label'   		=> esc_html__( 'Open Project Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption displayed on hover in portfolio gallery, showcase or carousel templates when the portfolio links opens the project page.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// 'All' portfolio category caption
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_filter_all_caption',
			array(
				'default'           	=> esc_html__('All', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_filter_all_caption',
			array(
				'label'   		=> esc_html__('All Category Caption', 'montoya'),
				'description'	=> esc_html__('The caption the All category displaying all portfolio items in portfolio page templates.', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Show Filters caption
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_show_filters_caption',
			array(
				'default'           	=> esc_html__( 'Filters', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_show_filters_caption',
			array(
				'label'   		=> esc_html__( 'Portfolio Templates - Filters Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption of the Show Filters button displayed in Portfolio layouts.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Next Project caption
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_next_caption_first_line',
			array(
				'default'           	=> esc_html__('Next', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_next_caption_first_line',
			array(
				'label'   		=> esc_html__( 'Next Project Caption - First Line', 'montoya' ),
				'description'	=> esc_html__('Caption of the next project in portfolio navigation displayed on hover - on two lines.', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_next_caption_second_line',
			array(
				'default'           	=> esc_html__('Project', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_next_caption_second_line',
			array(
				'label'   		=> esc_html__( 'Next Project Caption - Second Line', 'montoya' ),
				'description'	=> esc_html__('Caption of the next project in portfolio navigation displayed on hover - on two lines.', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Scroll and drag caption
		$wp_customize->add_setting(
			'clapat_montoya_showcase_scroll_drag_caption',
			array(
				'default'           	=> esc_html__( 'Scroll or Drag', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_showcase_scroll_drag_caption',
			array(
				'label'   		=> esc_html__( 'Showcase Scroll Caption', 'montoya' ),
				'description'	=> esc_html__( 'Short text indicating the scroll action.', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Showcase portfolio next & prev captions
		$wp_customize->add_setting(
			'clapat_montoya_showcase_gallery_next_caption',
			array(
				'default'           	=>  esc_html__( 'NEXT', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				'transport'         	=> 'postMessage',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_showcase_gallery_next_caption',
			array(
				'label'   			=> esc_html__( 'Showcase Gallery - Next Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption of the Next navigation button in Portfolio Showcase Gallery template', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    			=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_showcase_gallery_prev_caption',
			array(
				'default'           	=>  esc_html__( 'PREV', 'montoya' ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				'transport'         	=> 'postMessage',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_showcase_gallery_prev_caption',
			array(
				'label'   			=> esc_html__( 'Showcase Gallery - Prev Caption', 'montoya' ),
				'description'	=> esc_html__( 'Caption of the Prev navigation button in Portfolio Showcase Gallery template', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    			=> 'text',
			)
		);
		
		// Portfolio Share Social Networks caption
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_share_social_networks_caption',
			array(
				'default'           	=> esc_html__('Share Project:', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_share_social_networks_caption',
			array(
				'label'   		=> esc_html__( 'Share This Project Caption', 'montoya' ),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);
		
		// Portfolio Share Social Networks list
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_share_social_networks',
			array(
				'default'           	=> 'facebook,twitter,pinterest',
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_share_social_networks',
			array(
				'label'   		=> esc_html__( 'Share This Project On', 'montoya' ),
				'description'	=> esc_html__('This is a list of social networks you can share the project on, displayed at the bottom right of the hero image. Leave this field empty if you do not want to show it. Type in the social lower case social networks names, separated by comma (,). The list of available networks: twitter, facebook, googleplus, linkedin, pinterest, email, stumbleupon, whatsapp, telegram, line, viber, pocket, messenger, vkontakte, rss', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'text',
			)
		);	
			
		// Portfolio navigation order
		$wp_customize->add_setting(
			'clapat_montoya_portfolio_navigation_order',
			array(
				'default'           	=> 'forward',
				'sanitize_callback' 	=> 'montoya_sanitize_portfolio_navigation_order',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_portfolio_navigation_order',
			array(
				'label'   		=> esc_html__('Portfolio Items Navigation Order', 'montoya'),
				'section' 		=> 'portfolio_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'forward' => esc_html__('Forward in time (next item is newer or loops to the oldest if current item is the newest)', 'montoya'),
											  'backward' => esc_html__('Backward in time (next item is older or loops to the newest if current item is the oldest)', 'montoya') ),
			)
		);
		/*** End Portfolio Settings section ***/
		
		/*** Blog Settings section ***/
		$wp_customize->add_section(
			'blog_settings',
			array(
				'title'    => esc_html__( 'Blog Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 3),
			)
		);
		
		// Blog pages navigation type
		$wp_customize->add_setting(
			'clapat_montoya_blog_navigation_type',
			array(
				'default'           	=> 'blog-nav-classic',
				'sanitize_callback' 	=> 'montoya_sanitize_blog_navigation_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_navigation_type',
			array(
				'label'   		=> esc_html__('Blog Pages Navigation Type', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'blog-nav-classic' => esc_html__('Classic', 'montoya'),
										'blog-nav-minimal' => esc_html__('Minimal', 'montoya') )
			)
		);
		
		// Navigation caption
		$wp_customize->add_setting(
			'clapat_montoya_blog_next_post_caption',
			array(
				'default'           	=> esc_html__('Next', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_next_post_caption',
			array(
				'label'   		=> esc_html__('Next Post Caption', 'montoya'),
				'description'	=> esc_html__('Caption of the button linking to the next single blog post page.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_blog_prev_post_caption',
			array(
				'default'           	=> esc_html__('Prev', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_prev_post_caption',
			array(
				'label'   		=> esc_html__('Prev Post Caption', 'montoya'),
				'description'	=> esc_html__('Caption of the button linking to the previous single blog post page.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_blog_no_posts_caption',
			array(
				'default'           	=> esc_html__('No more posts', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_no_posts_caption',
			array(
				'label'   		=> esc_html__('No Posts Page Caption', 'montoya'),
				'description'	=> esc_html__('Caption displayed if there are no posts in the next or previous post from blog post page navigation.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_blog_read_more_caption',
			array(
				'default'           	=> esc_html__('Read Article', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_read_more_caption',
			array(
				'label'   		=> esc_html__('Read Article Caption', 'montoya'),
				'description'	=> esc_html__('Caption of the button linking to the single blog post page from the blog index.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_blog_prev_posts_caption',
			array(
				'default'           	=> esc_html__('Prev', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_prev_posts_caption',
			array(
				'label'   		=> esc_html__('Previous Posts Page Caption', 'montoya'),
				'description'	=> esc_html__('Caption of the button linking to the previous blog posts page.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		$wp_customize->add_setting(
			'clapat_montoya_blog_next_posts_caption',
			array(
				'default'           	=> esc_html__('Next', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_next_posts_caption',
			array(
				'label'   		=> esc_html__('Next Posts Page Caption', 'montoya'),
				'description'	=> esc_html__('Caption of the button linking to the next blog posts page.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		// Blog pages default title
		$wp_customize->add_setting(
			'clapat_montoya_blog_default_title',
			array(
				'default'           	=> esc_html__('Blog', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_default_title',
			array(
				'label'   		=> esc_html__('Default Posts Page Title', 'montoya'),
				'description'	=> esc_html__('Title of the default blog posts page. The default blog posts page is the page displaying blog posts when there is no front page set in Settings -> Reading.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'text',
			)
		);
		
		// Scroll effects
		$wp_customize->add_setting(
			'clapat_montoya_blog_scroll_effect_type',
			array(
				'default'           	=>  'clapat-blog-effect-scroll-none',
				'sanitize_callback' 	=> 'montoya_sanitize_blog_effect_scroll_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_blog_scroll_effect_type',
			array(
				'label'   		=> esc_html__('Scroll Effects', 'montoya'),
				'description'	=> esc_html__('Type of dynamic effects on scroll in archive / blog pages.', 'montoya'),
				'section' 		=> 'blog_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'clapat-blog-effect-scroll-none' => esc_html__('None', 'montoya'),
										'clapat-blog-expand-on-scroll' => esc_html__('Expand On Scroll', 'montoya'),
										'clapat-blog-fade-in-on-scroll' => esc_html__('Fade In On Scroll', 'montoya') )
			)
		);
		/*** End Blog Settings section ***/
		
		/*** Map Settings section ***/
		$wp_customize->add_section(
			'map_settings',
			array(
				'title'    => esc_html__( 'Map Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 2),
			)
		);
		
		// Map address
		$wp_customize->add_setting(
			'clapat_montoya_map_address',
			array(
				'default'           	=>  esc_html__('775 New York Ave, Brooklyn, Kings, New York 11203', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_address',
			array(
				'label'   		=> esc_html__('Google Map Address', 'montoya'),
				'description'  	=> esc_html__('Example: 775 New York Ave, Brooklyn, Kings, New York 11203. Or you can enter latitude and longitude for greater precision. Example: 41.40338, 2.17403 (in decimal degrees - DDD)', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Map marker image
		$wp_customize->add_setting(
			'clapat_montoya_map_marker',
			array(
				'default'           	=> get_template_directory_uri() . '/images/marker.png',
				'sanitize_callback' 	=> 'esc_url_raw',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( 
			$wp_customize, 
			'clapat_montoya_map_marker', 
			array(
				'label'      => esc_html__( 'Map Marker', 'montoya' ),
				'description' => esc_html__('Please choose an image file for the marker.', 'montoya'),
				'section'    => 'map_settings'
			)
		));
		
		// Map zoom
		$wp_customize->add_setting(
			'clapat_montoya_map_zoom',
			array(
				'default'           	=> 16,
				'sanitize_callback' 	=> 'absint',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_zoom',
			array(
				'label'   		=> esc_html__( 'Map Zoom Level', 'montoya' ),
				'description'  	=> esc_html__('Higher number will be more zoomed in.', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'number',
				'input_attrs' 	=> array( 'min' => 0, 'max' => 30, 'step'  => 1 )
			)
		);
		
		// Pop-up marker title
		$wp_customize->add_setting(
			'clapat_montoya_map_company_name',
			array(
				'default'           	=> esc_html__('montoya', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_company_name',
			array(
				'label'   		=> esc_html__('Pop-up marker title', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Pop-up marker text
		$wp_customize->add_setting(
			'clapat_montoya_map_company_info',
			array(
				'default'           	=> esc_html__('Here we are. Come to drink a coffee!', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_company_info',
			array(
				'label'   		=> esc_html__('Pop-up marker text', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		
		// Map type
		$wp_customize->add_setting(
			'clapat_montoya_map_type',
			array(
				'default'           	=> 'satellite',
				'sanitize_callback' 	=> 'montoya_sanitize_map_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_type',
			array(
				'label'   		=> esc_html__('Map Type', 'montoya'),
				'description'	=> esc_html__('Set the map type as road map or satellite.', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'satellite' => esc_html__('Satellite', 'montoya'),
										'roadmap' => esc_html__('Roadmap', 'montoya') ),
			)
		);
		
		// Google maps API key
		$wp_customize->add_setting(
			'clapat_montoya_map_api_key',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_map_api_key',
			array(
				'label'   		=> esc_html__('Google Maps API Key', 'montoya'),
				'description'	=> esc_html__('Without it, the map may not be displayed. If you have an api key paste it here. More information on how to obtain a google maps api key: https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key', 'montoya'),
				'section' 		=> 'map_settings',
				'type'    		=> 'text',
			)
		);
		/*** End Map Settings section ***/
		
		/*** Error Page section ***/
		$wp_customize->add_section(
			'error_page_settings',
			array(
				'title'    => esc_html__( 'Error Page Settings', 'montoya' ),
				'priority' => ($montoya_before_default_section - 1),
			)
		);
		
		// Error page title
		$wp_customize->add_setting(
			'clapat_montoya_error_title',
			array(
				'default'           	=> esc_html__('404', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_title',
			array(
				'label'   		=> esc_html__('Error Page Title', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error page info
		$wp_customize->add_setting(
			'clapat_montoya_error_info',
			array(
				'default'           	=> esc_html__('The page you are looking for could not be found.', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_info',
			array(
				'label'   		=> esc_html__('Error Page Info Text', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button
		$wp_customize->add_setting(
			'clapat_montoya_error_back_button',
			array(
				'default'           	=> esc_html__('Home Page', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_back_button',
			array(
				'label'   		=> esc_html__('Back Button Caption', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button - caption on hover
		$wp_customize->add_setting(
			'clapat_montoya_error_back_button_hover_caption',
			array(
				'default'           	=> esc_html__('Go Back', 'montoya'),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_back_button_hover_caption',
			array(
				'label'   		=> esc_html__('Back Button Caption On Hover', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// Error back button url
		$wp_customize->add_setting(
			'clapat_montoya_error_back_button_url',
			array(
				'default'           	=> esc_url( get_home_url() ),
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_back_button_url',
			array(
				'label'   		=> esc_html__('Back Button URL', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'text',
			)
		);
		
		// 404 page background type
		$wp_customize->add_setting(
			'clapat_montoya_error_page_bknd_type',
			array(
				'default'           	=> 'light-content',
				'sanitize_callback' 	=> 'montoya_sanitize_error_page_bknd_type',
			)
		);
		
		$wp_customize->add_control(
			'clapat_montoya_error_page_bknd_type',
			array(
				'label'   		=> esc_html__('Background Type', 'montoya'),
				'description'	=> esc_html__('Background type for the 404 error page.', 'montoya'),
				'section' 		=> 'error_page_settings',
				'type'    		=> 'select',
				'choices'   	=> array( 'dark-content' 	=> esc_html__('White', 'montoya'),
										'light-content' => esc_html__('Black', 'montoya') ),
			)
		);
		/*** End Error Page Settings section ***/
		
		if( function_exists("is_woocommerce") ){
			
			/*** Shop Page section ***/
			$wp_customize->add_section(
				'shop_settings',
				array(
					'title'    => esc_html__( 'Shop Settings', 'montoya' ),
					'priority' =>  ($montoya_before_default_section - 1),
				)
			);
			
			// Shop Custom Grid
			$wp_customize->add_setting(
				'clapat_montoya_shop_enable_custom_grid',
				array(
					'default'           	=> 0,
					'sanitize_callback' 	=> 'absint',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_shop_enable_custom_grid',
				array(
					'label'   		=> esc_html__( 'Enable Custom Grid In Shop Page', 'montoya' ),
					'description'  	=> esc_html__( 'Display products list in a customized grid rather than the default.', 'montoya' ),
					'section' 		=> 'shop_settings',
					'type'    		=> 'checkbox',
				)
			);
			
			// Sticky Shop Product Caption
			$wp_customize->add_setting(
				'clapat_montoya_sticky_shop_product_caption',
				array(
					'default'           	=> 0,
					'sanitize_callback' 	=> 'absint',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_sticky_shop_product_caption',
				array(
					'label'   		=> esc_html__('Sticky Product Caption', 'montoya'),
					'description'	=> esc_html__('Enables sticky product summary in product page.', 'montoya'),
					'section' 		=> 'shop_settings',
					'type'    		=> 'checkbox',
				)
			);
			
			// Product Page Background Type and Color
			$wp_customize->add_setting(
				'clapat_montoya_shop_product_page_bknd_type',
				array(
					'default'           	=> 'light-content',
					'sanitize_callback' 	=> 'montoya_sanitize_error_page_bknd_type',
					)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_shop_product_page_bknd_type',
				array(
					'label'   		=> esc_html__('Product Page Background Type', 'montoya'),
					'description'	=> esc_html__('Background type for the product page.', 'montoya'),
					'section' 		=> 'shop_settings',
					'type'    		=> 'select',
					'choices'   	=> array( 'dark-content' 	=> esc_html__('White', 'montoya'),
											'light-content' => esc_html__('Black', 'montoya') ),
				)
			);
			
			// Primary color for magic cursor
			$wp_customize->add_setting(
				'clapat_montoya_shop_product_page_bknd_color',
				array(
					'default'           	=> '#0c0c0c',
					'sanitize_callback' 	=> 'sanitize_hex_color',
				)
			);
			
			$wp_customize->add_control( new WP_Customize_Color_Control( 
				$wp_customize, 
				'clapat_montoya_shop_product_page_bknd_color', 
				array(
					'label'      => esc_html__( 'Product Page Background Color', 'montoya' ),
					'description' => esc_html__('Set the background color for the product page.', 'montoya'),
					'section'    => 'shop_settings'
				)
			));
				
			/*** End Shop Page Settings section ***/
		}
			
		/*** Typography section ***/
		$montoya_typography_setting_desc = esc_html__( 'Select custom fonts for your site. You can create custom fonts variations in Appearance -> Custom Fonts.', 'montoya' );
		if( !class_exists( 'Bsf_Custom_Fonts_Taxonomy' ) ){
			
			$montoya_typography_setting_desc = wp_kses( __('To change default typography please install recommended plugins <a class="link" target="_blank" href="https://wordpress.org/plugins/custom-fonts/">Custom Fonts</a> and then create at least one font variation in Appearance -> Custom Fonts.', 'montoya'), 'montoya_allowed_html' );
		};
		
		$wp_customize->add_section(
			'typography_page_settings',
			array(
				'title'    		=> esc_html__( 'Typography', 'montoya' ),
				'description' 	=> $montoya_typography_setting_desc,
				'priority' 		=> ($montoya_before_default_section - 1),
			)
		);
		
		$montoya_custom_fonts = array( '' => esc_html__( 'Select custom font', 'montoya' ) );
		$montoya_custom_fonts = apply_filters('montoya_custom_fonts_customizer', $montoya_custom_fonts);
			
		// Typography portfolio title
		$wp_customize->add_setting(
			'clapat_montoya_typography_primary_font_title',
			array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'montoya_sanitize_text_field',
			)
		);
			
		$wp_customize->add_control(
			'clapat_montoya_typography_primary_font_title',
			array(
				'label'   		=> esc_html__('Primary Font Title', 'montoya'),
				'section' 		=> 'typography_page_settings',
				'type'    		=> 'select',
				'choices'   	=> $montoya_custom_fonts
			)
		);
			
		if( class_exists( 'Bsf_Custom_Fonts_Taxonomy' ) ){
			
			// Typography portfolio subtitle
			$wp_customize->add_setting(
				'clapat_montoya_typography_main_subtitle',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_main_subtitle',
				array(
					'label'   		=> esc_html__('Main Subtitle', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography headings
			$wp_customize->add_setting(
				'clapat_montoya_typography_headings',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_headings',
				array(
					'label'   		=> esc_html__('Headings', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography paragraph
			$wp_customize->add_setting(
				'clapat_montoya_typography_paragraph',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_paragraph',
				array(
					'label'   		=> esc_html__('Paragraph', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography body
			$wp_customize->add_setting(
				'clapat_montoya_typography_body',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_body',
				array(
					'label'   		=> esc_html__('Body', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography inputs
			$wp_customize->add_setting(
				'clapat_montoya_typography_inputs',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_inputs',
				array(
					'label'   		=> esc_html__('Inputs', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography fullscreen menu
			$wp_customize->add_setting(
				'clapat_montoya_typography_fullscreen_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_fullscreen_menu',
				array(
					'label'   		=> esc_html__('Fullscreen Menu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography fullscreen submenu
			$wp_customize->add_setting(
				'clapat_montoya_typography_fullscreen_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_fullscreen_submenu',
				array(
					'label'   		=> esc_html__('Fullscreen Submenu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography fullscreen submenu
			$wp_customize->add_setting(
				'clapat_montoya_typography_fullscreen_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_fullscreen_submenu',
				array(
					'label'   		=> esc_html__('Fullscreen Submenu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography classic menu
			$wp_customize->add_setting(
				'clapat_montoya_typography_classic_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_classic_menu',
				array(
					'label'   		=> esc_html__('Classic Menu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography classic submenu
			$wp_customize->add_setting(
				'clapat_montoya_typography_classic_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_classic_submenu',
				array(
					'label'   		=> esc_html__('Classic Submenu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography responsive menu
			$wp_customize->add_setting(
				'clapat_montoya_typography_responsive_menu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_responsive_menu',
				array(
					'label'   		=> esc_html__('Responsive Menu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
			
			// Typography classic submenu
			$wp_customize->add_setting(
				'clapat_montoya_typography_responsive_submenu',
				array(
					'default'           	=> '',
					'sanitize_callback' 	=> 'montoya_sanitize_text_field',
				)
			);
			
			$wp_customize->add_control(
				'clapat_montoya_typography_responsive_submenu',
				array(
					'label'   		=> esc_html__('Responsive Submenu', 'montoya'),
					'section' 		=> 'typography_page_settings',
					'type'    		=> 'select',
					'choices'   	=> $montoya_custom_fonts
				)
			);
		}
		/*** Typography section ***/
	}

	add_action( 'customize_register', 'montoya_options_config' );
}

/**
 * Sanitize a text or textarea field
 *
 * @param string $input - the text
 */
function montoya_sanitize_text_field( $input ) {
	
	return wp_kses( $input, 'montoya_allowed_html' );
}

/**
 * Sanitize a custom slug field
 *
 * @param string $input - the input slug
 */
function montoya_sanitize_slug_field( $input ) {
	
	return sanitize_title( $input );
}


/**
 * Sanitize the social network options.
 *
 * @param string $input social network id.
 */
function montoya_sanitize_social_links( $input ) {
	
	global $montoya_social_links;
	$valid = array_keys( $montoya_social_links );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'Fb';
}


/**
 * Sanitize the portfolio navigation order.
 *
 * @param string $input - portfolio navigation order
 */
function montoya_sanitize_portfolio_navigation_order( $input ) {
	
	$valid = array( 'forward', 'backward' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog layout types.
 *
 * @param string $input - blog layout type
 */
function montoya_sanitize_blog_pages_layout( $input ) {
	
	$valid = array( 'blog-classic', 'blog-minimal' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog navigation types.
 *
 * @param string $input - blog layout type
 */
function montoya_sanitize_blog_navigation_type( $input ) {
	
	$valid = array( 'blog-nav-classic', 'blog-nav-minimal' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'forward';
}

/**
 * Sanitize the blog excerpt types.
 *
 * @param string $input - blog excerpt type
 */
function montoya_sanitize_blog_excerpt_type( $input ) {
	
	$valid = array( 'blog-excerpt-none', 'blog-excerpt', 'blog-excerpt-full' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'blog-excerpt-none';
}

/**
 * Sanitize the blog excerpt types.
 *
 * @param string $input - blog excerpt type
 */
function montoya_sanitize_blog_effect_scroll_type( $input ) {
	
	$valid = array( 'clapat-blog-effect-scroll-none', 'clapat-blog-expand-on-scroll', 'clapat-blog-fade-in-on-scroll' );
		
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'clapat-blog-effect-scroll-none';
}

/**
 * Sanitize the showcase transition pattern settings.
 *
 * @param string $input - showcase transition
 */
function montoya_sanitize_showcase_transition_pattern_image( $input ) {
	
	global $montoya_slide_transitions;
	$valid = array_keys( $montoya_slide_transitions );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'first';
}

/**
 * Sanitize the map type
 *
 * @param string $input - map type
 */
function montoya_sanitize_map_type( $input ) {
	
	$valid = array( 'satellite', 'roadmap' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'satellite';
}

/**
 * Sanitize the global page background type
 *
 * @param string $input - background type
 */
function montoya_sanitize_default_page_bknd_type( $input ) {
	
	$valid = array( 'dark-content', 'light-content' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light-content';
}

/**
 * Sanitize the error page background type
 *
 * @param string $input - background type
 */
function montoya_sanitize_error_page_bknd_type( $input ) {
	
	$valid = array( 'dark-content', 'light-content' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light-content';
}

/**
 * Sanitize the header menu type
 *
 * @param string $input - header menu type
 */
function montoya_sanitize_menu_header_type( $input ) {
	
	$valid = array( 'classic-burger-dots', 'classic-burger-lines', 'fullscreen-burger-dots', 'fullscreen-burger-lines' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'classic-burger-dots';
}

/**
 * Sanitize the menu background type
 *
 * @param string $input - background type
 */
function montoya_sanitize_menu_bknd_type( $input ) {
	
	$valid = array( 'invert-header', 'inherit-header' );
	
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'invert-header';
}