<?php
	// enqueue parent theme styles
	function montoya_child_enqueue_styles() {

		$content_style = 'montoya-content';
		$showcase_style = 'montoya-showcase';
		$portfolio_style = 'montoya-portfolio';
		$blog_style = 'montoya-blog';
		$shortcodes_style = 'montoya-shortcodes';
		$assets_style = 'montoya-assets';
		$wp_style = 'montoya-style-wp';
		$page_builders_style = 'montoya-page-builders';
		$parent_style = 'parent-style';
				
		wp_enqueue_style( $content_style, get_template_directory_uri() . '/css/content.css' );
		wp_enqueue_style( $showcase_style, get_template_directory_uri() . '/css/showcase.css' );
		wp_enqueue_style( $portfolio_style, get_template_directory_uri() . '/css/portfolio.css' );
		wp_enqueue_style( $blog_style, get_template_directory_uri() . '/css/blog.css' );
		wp_enqueue_style( $shortcodes_style, get_template_directory_uri() . '/css/shortcodes.css' );
		wp_enqueue_style( $assets_style, get_template_directory_uri() . '/css/assets.css' );
		wp_enqueue_style( $wp_style, get_template_directory_uri() . '/css/style-wp.css' );
		wp_enqueue_style( $page_builders_style, get_template_directory_uri() . '/css/page-builders.css' );
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
			
	}
	add_action( 'wp_enqueue_scripts', 'montoya_child_enqueue_styles' );

	// allowable HTML tags in theme options - add here more than the ones already accepted by the theme
	if( !function_exists('montoya_child_kses_allowed_html') ){

		function montoya_child_kses_allowed_html($tags, $context) {
				
			switch($context) {
				case 'montoya_allowed_html':
					$tags = array(
						'a' => array(
									'id' => array(),
									'href' => array(),
									'title' => array(),
									'rel' => array(),
									'target' => array(),
									'class' => array(),
									'data-type' => array(),
									'data-filter' => array()
								),
						'div' => array(
									'id' => array(),
									'class' => array()
									),
						'span' => array(
									'id' => array(),
									'class' => array(),
									'data-hover' => array()
									),
						'img' => array(
									'src' => array(),
									'alt' => array(),
									'width' => array(),
									'height' => array(),
									'class' => array()
									),
						'h1' => array(),
						'h2' => array(),
						'h3' => array(),
						'h4' => array(),
						'h5' => array(),
						'h6' => array(),
						'ul' => array(),
						'li' => array(),
						'br' => array(),
						'em' => array(),
						'strong' => array(),
						'b' => array(),
						'i' => array(),
						'u' => array(),
						'p' => array(),
						'hr' => array(),
						'figure' => array()
					);
					return $tags;
				default: 
					return $tags;
			}

		}

		add_filter( 'wp_kses_allowed_html', 'montoya_child_kses_allowed_html', 9, 2 );

	}
?>