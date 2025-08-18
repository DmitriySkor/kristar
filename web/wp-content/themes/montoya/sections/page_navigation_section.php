 <?php

	$montoya_next_page_nav_id			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-navigation-next-page' );
	$montoya_page_nav_enable				= !empty( $montoya_next_page_nav_id );
	$montoya_page_hover_caption			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-page-navigation-hover-caption' );
	$montoya_next_page_caption_width	= sanitize_html_class("content-full-width");
	$montoya_next_page_caption_align	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-navigation-caption-align' );
	
	$montoya_next_url	 = get_permalink( $montoya_next_page_nav_id );
	
	$montoya_hero_properties 			= new Montoya_Hero_Properties();
	$montoya_hero_properties->post_id	= $montoya_next_page_nav_id;
	$montoya_hero_properties->getProperties( get_post_type( $montoya_next_page_nav_id ) );
	$montoya_next_hero_title				= $montoya_hero_properties->caption_title;
	$montoya_next_hero_subtitle			= $montoya_hero_properties->caption_subtitle;
	if( !$montoya_hero_properties->enabled ){
		
		$montoya_next_hero_title 			= '<span>' . get_the_title( $montoya_next_page_nav_id ) . '</span>';
		$montoya_next_hero_subtitle		= "";
	}
	$montoya_url_class = "next-ajax-link-page";
	if( !$montoya_hero_properties->enabled && !montoya_get_theme_options( 'clapat_montoya_enable_page_title_as_hero' ) ){
		
		// This is a page without hero section so a seamless AJAX transition is not possible
		$montoya_url_class = "ajax-link";
	}
	
	// Get the next page title & subtitle captions; if they are empty use the hero section of the next page
	$montoya_page_caption_title			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-navigation-caption-title' );
	if( empty( $montoya_page_caption_title ) ){
		
		$montoya_page_caption_title = $montoya_next_hero_title;
	}
	else {
		
		$title_row	= $montoya_page_caption_title;
		$title_list	= preg_split('/\r\n|\r|\n/', $title_row);
		$montoya_page_caption_title	= "";
		foreach( $title_list as $title_bit ){
					
			$montoya_page_caption_title .= '<span>' . $title_bit . '</span>';
		}
	}
	
	$montoya_page_caption_subtitle		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-navigation-caption-subtitle' );
	if( empty( $montoya_page_caption_subtitle ) ){
		
		$montoya_page_caption_subtitle = $montoya_next_hero_subtitle;
	}
	else {
		
		$title_row	= $montoya_page_caption_subtitle;
		$title_list	= preg_split('/\r\n|\r|\n/', $title_row);
		$montoya_page_caption_subtitle	= "";
		foreach( $title_list as $title_bit ){
					
			$montoya_page_caption_subtitle .= '<span>' . $title_bit . '</span>';
		}
	}

	if( $montoya_page_nav_enable ){
?>
				<!-- Page Navigation --> 
				<div id="page-nav">
					<div class="page-nav-wrap">
						<div class="page-nav-caption height-title <?php echo esc_attr( $montoya_next_page_caption_width ); ?> <?php echo esc_attr( $montoya_next_page_caption_align ); ?>">
							<div class="inner">
								<?php if( !empty( $montoya_page_caption_subtitle ) ){ ?>
								<div class="next-hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_page_caption_subtitle, 'montoya_allowed_html' ); ?></div>
								<?php } ?>
								<a class="page-title <?php echo esc_attr( $montoya_url_class ); ?>" href="<?php echo esc_url( $montoya_next_url ); ?>" data-type="page-transition" data-centerline="<?php echo esc_attr( $montoya_page_hover_caption ); ?>">
									<div class="next-hero-title primary-font-title caption-timeline"><?php echo wp_kses( $montoya_page_caption_title, 'montoya_allowed_html' ); ?></div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!--/Page Navigation -->
<?php } ?>
