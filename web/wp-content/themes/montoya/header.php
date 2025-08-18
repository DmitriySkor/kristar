<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-primary-color="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_primary_color') ); ?>">
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

	<main>
	<?php
		// display header section
		get_template_part('sections/preloader_section');
	?>
	
		<!--Cd-main-content -->
		<div class="cd-index cd-main-content">

		<?php
		$montoya_bknd_color = "";
		if( is_singular( 'montoya_portfolio' ) ){

			$montoya_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color' );
			$montoya_bknd_color_attribute = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color-code' );
		}
		else if( is_singular( 'post' ) ){

			$montoya_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-blog-bknd-color' );
			$montoya_bknd_color_attribute = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-blog-bknd-color-code' );
		}
		else if( is_404() ){

			$montoya_bknd_color = montoya_get_theme_options( 'clapat_montoya_error_page_bknd_type' );
			$montoya_bknd_color_attribute = "#ffffff";
			if( $montoya_bknd_color == "light-content" ){

				$montoya_bknd_color_attribute = "#0c0c0c";
			}

		}
		else if( is_page() ){

			$montoya_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-bknd-color' );
			$montoya_bknd_color_attribute = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-bknd-color-code' );
		}
		else if( function_exists( "is_woocommerce" ) ){
			
			if( is_shop() ){
						
				$page_id = wc_get_page_id('shop');
				$montoya_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $page_id, 'montoya-opt-page-bknd-color' );
				$montoya_bknd_color_attribute = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $page_id, 'montoya-opt-page-bknd-color-code' );
			}
			else if( is_product() ){
				
				$montoya_bknd_color = montoya_get_theme_options( 'clapat_montoya_shop_product_page_bknd_type' );
				$montoya_bknd_color_attribute =  montoya_get_theme_options( 'clapat_montoya_shop_product_page_bknd_color' );
			}
			
		}
		
		if( empty( $montoya_bknd_color ) ){

			$montoya_bknd_color = montoya_get_theme_options( 'clapat_montoya_default_page_bknd_type' );
			
			$montoya_bknd_color_attribute = "#ffffff";
			if( $montoya_bknd_color == "light-content" ){

				$montoya_bknd_color_attribute = "#0c0c0c";
			}
		}

		?>

		<?php $montoya_page_content_classes = "clapat-class-id-" . get_the_ID(); ?>

		<?php
		// Check if Elementor is installed and activated
		if ( did_action( 'elementor/loaded' ) ) {

			if( !empty( $montoya_page_content_classes ) ){

				$montoya_page_content_classes .= " ";
			}

			$montoya_page_content_classes	.= "with-elementor";
		}
		?>
		
		<?php 
		$montoya_is_woocommerce = false;
		if( function_exists( "is_woocommerce" ) ){
			
			if( is_woocommerce() ){
				
				$montoya_is_woocommerce = true;
				
				if( is_shop() ){
					
					if( montoya_get_theme_options( 'clapat_montoya_shop_enable_custom_grid' ) ){
						
						$montoya_page_content_classes .= " clapat-shop-grid";
					}
				}
				if( is_product() ){
					
					if( montoya_get_theme_options( 'clapat_montoya_sticky_shop_product_caption' ) ){
						
						$montoya_page_content_classes .= " clapat-shop-product-summary-sticky";
					}
				}
			}
		}
		?>
		
		<?php if( ( is_page_template( 'blog-page.php' ) || is_home() || is_archive() || is_search() ) && !$montoya_is_woocommerce ){ ?>
			<!-- Page Content -->
			<div id="clapat-page-content" class="blog-template-content <?php echo sanitize_html_class( $montoya_bknd_color ); if( !montoya_get_theme_options( 'clapat_montoya_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $montoya_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $montoya_bknd_color_attribute ); ?>" >
		<?php } else if( is_singular( 'post' ) ){ ?>
			<!-- Page Content -->
			<div id="clapat-page-content" class="post-template-content <?php echo sanitize_html_class( $montoya_bknd_color ); if( !montoya_get_theme_options( 'clapat_montoya_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $montoya_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $montoya_bknd_color_attribute ); ?>" >
		<?php } else { ?>
			<!-- Page Content -->
			<div id="clapat-page-content" class="<?php echo sanitize_html_class( $montoya_bknd_color ); if( !montoya_get_theme_options( 'clapat_montoya_enable_magic_cursor' ) ){ echo " magic-cursor-disabled"; } ?> <?php echo esc_attr( $montoya_page_content_classes ); ?>" data-bgcolor="<?php echo esc_attr( $montoya_bknd_color_attribute ); ?>" >
		<?php } ?>

		<?php
			// display header section
			get_template_part('sections/header_section');
		?>