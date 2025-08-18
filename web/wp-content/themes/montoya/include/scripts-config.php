<?php
/**
 * Created by Clapat.
 * Date: 22/07/23
 * Time: 7:26 AM
 */

if ( ! function_exists( 'montoya_load_scripts' ) ){

	function montoya_load_scripts() {

		// Force load Elementor styles on non-Elementor pages if AJAX page transitions are turned on
		if ( class_exists( '\Elementor\Frontend' ) && !montoya_post_is_built_with_elementor() && montoya_get_theme_options( "clapat_montoya_enable_ajax" ) ) {

			\Elementor\Frontend::instance()->enqueue_styles();
		}

		// Enqueue css files
		wp_enqueue_style( 'montoya-content', get_template_directory_uri() . '/css/content.css' );

		wp_enqueue_style( 'montoya-showcase', get_template_directory_uri() . '/css/showcase.css' );

		wp_enqueue_style( 'montoya-portfolio', get_template_directory_uri() . '/css/portfolio.css' );

		wp_enqueue_style( 'montoya-blog', get_template_directory_uri() . '/css/blog.css' );

		wp_enqueue_style( 'montoya-shortcodes', get_template_directory_uri() . '/css/shortcodes.css' );

		wp_enqueue_style( 'montoya-assets', get_template_directory_uri() . '/css/assets.css' );
		
		wp_enqueue_style( 'montoya-shop', get_template_directory_uri() . '/css/shop.css' );
		
		wp_enqueue_style( 'montoya-style-wp', get_template_directory_uri() . '/css/style-wp.css' );
		
		wp_enqueue_style( 'montoya-page-builders', get_template_directory_uri() . '/css/page-builders.css' );

		wp_enqueue_style( 'montoya-theme', get_stylesheet_uri(), array('montoya-content', 'montoya-showcase', 'montoya-portfolio', 'montoya-blog', 'montoya-shortcodes', 'montoya-assets', 'montoya-style-wp', 'montoya-page-builders') );

		$montoya_typography_css = montoya_typography_css();
		if( empty( !$montoya_typography_css ) ){
			
			wp_add_inline_style( 'montoya-theme', $montoya_typography_css );
		}
		
		if ( class_exists( '\Elementor\Plugin' ) ) {

			wp_enqueue_style( 'elementor-icons-fa-brands' ); // FontAwesome 5 Brands from Elementor
			wp_enqueue_style( 'elementor-icons-fa-solid' ); // FontAwesome 5 Solid from Elementor
		}

		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/all.min.css' );

		// enqueue standard font style
		$montoya_main_font_url  = '';
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'montoya') ) {
			$montoya_main_font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,500,600,700' ), "//fonts.googleapis.com/css" );
			$montoya_secondary_font_url = add_query_arg( array( 'family' => urlencode( 'Six Caps' ),
																'display' => 'swap' ), "//fonts.googleapis.com/css" );
		}
		wp_enqueue_style( 'montoya-main-font', $montoya_main_font_url, array(), '1.0.0' );
		wp_enqueue_style( 'montoya-secondary-font', $montoya_secondary_font_url, array(), '1.0.0' );

		// Force load Elementor scripts on non-Elementor pages if AJAX page transitions are turned on
		if ( class_exists( '\Elementor\Frontend' ) && !montoya_post_is_built_with_elementor() && montoya_get_theme_options( "clapat_montoya_enable_ajax" ) ) {

			\Elementor\Frontend::instance()->enqueue_scripts();
		}

		// enqueue scripts
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

			// Register scripts
			wp_enqueue_script(
            'modernizr',
            get_template_directory_uri() . '/core/js/modernizr.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-flexnav',
            get_template_directory_uri() . '/core/js/jquery.flexnav.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-waitforimages',
            get_template_directory_uri() . '/core/js/jquery.waitforimages.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'jquery-justifiedgallery',
            get_template_directory_uri() . '/core/js/jquery.justifiedGallery.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script( 'imagesloaded' );

		wp_enqueue_script(
            'three',
            get_template_directory_uri() . '/core/js/three.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
            'clapatwebgl',
            get_template_directory_uri() . '/core/js/clapatwebgl.js',
            array('jquery'),
            false,
            true
		);
		
		wp_enqueue_script(
            'clapatslider',
            get_template_directory_uri() . '/core/js/clapatslider.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
			'gsap',
			get_template_directory_uri() . '/core/js/gsap.min.js',
			array('jquery'),
			false,
			true
		);
		
		wp_enqueue_script(
            'scroll-trigger',
            get_template_directory_uri() . '/core/js/scrolltrigger.min.js',
            array('jquery'),
            false,
            true
		);

		wp_enqueue_script(
			'gsap-flip',
			get_template_directory_uri() . '/core/js/flip.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'js-socials',
			get_template_directory_uri() . '/core/js/jssocials.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'grid-to-fullscreen',
			get_template_directory_uri() . '/core/js/gridtofullscreen.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'smooth-scrollbar',
			get_template_directory_uri() . '/core/js/smooth-scrollbar.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'montoya-common',
			get_template_directory_uri() . '/core/js/common.js',
			array('jquery'),
			false,
			true
		);
		
		wp_enqueue_script(
			'montoya-contact',
			get_template_directory_uri() . '/core/js/contact.js',
			array('jquery'),
			false,
			true
		);
		
		wp_enqueue_script(
			'montoya-scripts',
			get_template_directory_uri() . '/js/scripts.js',
			array('jquery'),
			false,
			true
		);

		wp_localize_script( 'montoya-common',
						'ClapatThemeOptions',
						array( 	"share_social_network_list" => montoya_get_theme_options('clapat_montoya_portfolio_share_social_networks') )
						);
					
		wp_localize_script( 'montoya-scripts',
                    'ClapatMontoyaThemeOptions',
                    array( 	"enable_preloader" 	=> montoya_get_theme_options('clapat_montoya_enable_preloader') )
					);

		wp_localize_script( 'montoya-contact',
							'ClapatMapOptions',
							array(  "map_marker_image"	=> esc_js( esc_url ( montoya_get_theme_options("clapat_montoya_map_marker") ) ),
									"map_address"		=> montoya_get_theme_options('clapat_montoya_map_address'),
									"map_zoom"			=> montoya_get_theme_options('clapat_montoya_map_zoom'),
									"marker_title"		=> montoya_get_theme_options('clapat_montoya_map_company_name'),
									"marker_text"		=> montoya_get_theme_options('clapat_montoya_map_company_info'),
									"map_type" 			=> montoya_get_theme_options('clapat_montoya_map_type'),
									"map_api_key"		=> montoya_get_theme_options('clapat_montoya_map_api_key') ) );

	}

}

add_action('wp_enqueue_scripts', 'montoya_load_scripts');

if ( ! function_exists( 'montoya_admin_load_scripts' ) ){

    function montoya_admin_load_scripts() {

		// enqueue standard font style
		$montoya_main_font_url  = '';
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'montoya') ) {
			$montoya_main_font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,600,700' ), "//fonts.googleapis.com/css" );
		}
		wp_enqueue_style( 'montoya-main-font', $montoya_main_font_url, array(), '1.0.0' );
	}
}
add_action('admin_enqueue_scripts', 'montoya_admin_load_scripts');

if ( ! function_exists( 'montoya_typography_css' ) ){

	function montoya_typography_css() {
		
		$montoya_typography_css = '';
		
		// If custom fonts plugin is installed
		if ( class_exists( 'Bsf_Custom_Fonts_Render' ) ){
			
			$arr_custom_fonts = array();
			
			// if custom fonts plugin is installed
			$bsf_instance = Bsf_Custom_Fonts_Render::get_instance();
			
			if( method_exists( $bsf_instance, 'get_existing_font_posts' ) ){

				$all_fonts = $bsf_instance->get_existing_font_posts();

				if ( empty( $all_fonts ) || ! is_array( $all_fonts ) ) {
					
					return;
				}
				
				foreach ( $all_fonts as $font => $id ) {
					
					$font_family    = get_the_title( $id );
					$font_data      = get_post_meta( $id, 'fonts-data', true );

					if ( ! empty( $font_data['variations'] ) ) {
						
						foreach ( $font_data['variations'] as $variation ) {
							
							$font_label = $font_family;
							
							$font_weight = "";
							if( !empty( $variation['font_weight'] ) ){
								
								$font_weight = $variation['font_weight'];
							}
							
							$font_style = "";
							if( !empty( $variation['font_style'] ) ){
								
								$font_style = $variation['font_style'];
							}
							
							$arr_custom_fonts[ $id.$variation['id'] ] = array( 'name' => $font_family, 'weight' => $font_weight,  'style' => $font_style );
						}
					}
					else{
						
						$arr_custom_fonts[ $id ] = array( 'name' => $font_family );
					}
				}
			}
			else {
				
				// Get the custom fonts installed
				$font_terms = get_terms(
								Bsf_Custom_Fonts_Taxonomy::$register_taxonomy_slug,
								array(
									'hide_empty' => false,
								)
							);
							
				if ( ! empty( $font_terms ) ) {
					
					foreach ( $font_terms as $term ) {
						
						$font_props = Bsf_Custom_Fonts_Taxonomy::get_font_links( $term->term_id );
						foreach ( $font_props as $font_prop_id => $font_prop_value  ) {
							
							if ( strpos( $font_prop_id , 'weight' ) !== false ) {
															
								$arr_custom_fonts[ $term->term_id.$font_prop_id ] = array( 'name' => $term->name, 'weight' => $font_prop_value );
							}
						}
					}
				}
			}
			
			// Portfolio primary font title
			if( montoya_get_theme_options( 'clapat_montoya_typography_primary_font_title' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_primary_font_title' ) ){
						
						$montoya_typography_css .= '   .primary-font-title, .hero-title, .next-hero-title, .post-template-content .hero-title {';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Portfolio subtitle
			if( montoya_get_theme_options( 'clapat_montoya_typography_main_subtitle' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_main_subtitle' ) ){
						
						$montoya_typography_css .= ' .hero-subtitle, .next-hero-subtitle, .slide-subtitle, .slide-hero-subtitle, .slide-cat, .slide-date, .percentage-intro { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Headings
			if( montoya_get_theme_options( 'clapat_montoya_typography_headings' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_headings' ) ){
						
						$montoya_typography_css .= ' h1, h2, h3, h4, h5, h6 { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Paragraph
			if( montoya_get_theme_options( 'clapat_montoya_typography_paragraph' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_paragraph' ) ){
						
						$montoya_typography_css .= ' p,  #ball p, .accordion .accordion-content, .hero-text, #filters li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Body
			if( montoya_get_theme_options( 'clapat_montoya_typography_body' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_body' ) ){
						
						$montoya_typography_css .= ' html, body { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Inputs
			if( montoya_get_theme_options( 'clapat_montoya_typography_inputs' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_inputs' ) ){
						
						$montoya_typography_css .= ' input, textarea, input[type="submit"] { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Fullscreen Menu
			if( montoya_get_theme_options( 'clapat_montoya_typography_fullscreen_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_fullscreen_menu' ) ){
						
						$montoya_typography_css .= ' @media all and (min-width: 1025px) { .fullscreen-menu .flexnav li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Fullscreen Submenu
			if( montoya_get_theme_options( 'clapat_montoya_typography_fullscreen_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_fullscreen_submenu' ) ){
						
						$montoya_typography_css .= ' @media all and (min-width: 1025px) { .fullscreen-menu .flexnav li ul li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Classic Menu
			if( montoya_get_theme_options( 'clapat_montoya_typography_classic_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_classic_menu' ) ){
						
						$montoya_typography_css .= ' @media all and (min-width: 1025px) { .classic-menu .flexnav li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Classic Submenu
			if( montoya_get_theme_options( 'clapat_montoya_typography_classic_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_classic_submenu' ) ){
						
						$montoya_typography_css .= ' @media all and (min-width: 1025px) { .classic-menu .flexnav li ul li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Responsive Menu
			if( montoya_get_theme_options( 'clapat_montoya_typography_responsive_menu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_responsive_menu' ) ){
						
						$montoya_typography_css .= ' @media all and (max-width: 1024px) { .flexnav li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
			
			// Responsive Submenu
			if( montoya_get_theme_options( 'clapat_montoya_typography_responsive_submenu' ) ){
				
				// Find the font
				foreach( $arr_custom_fonts as $custom_font_id => $custom_font_props ){
					
					if( $custom_font_id == montoya_get_theme_options( 'clapat_montoya_typography_responsive_submenu' ) ){
						
						$montoya_typography_css .= ' @media all and (max-width: 1024px) { .flexnav li ul li a { ';
						$montoya_typography_css .= 'font-family: "' . $custom_font_props['name'] . '"; ';
						if( !empty( $custom_font_props['weight'] ) ){
							
							$montoya_typography_css .= 'font-weight: ' . $custom_font_props['weight'] . '; ';
						}
						if( !empty( $custom_font_props['style'] ) ){
							
							$montoya_typography_css .= 'font-style: ' . $custom_font_props['style'] . '; ';
						}
						$montoya_typography_css .= '} ';
						$montoya_typography_css .= '}';
						break;
					}
				}
			}
		}
		
		return $montoya_typography_css;
	}
}