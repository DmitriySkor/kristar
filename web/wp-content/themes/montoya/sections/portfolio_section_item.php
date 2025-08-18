<?php

$montoya_current_item_count = get_query_var('montoya_query_var_item_count');
$montoya_portfolio_items = montoya_portfolio_thumbs_list();

// validate the current portfolio index
if( array_key_exists( $montoya_current_item_count-1, $montoya_portfolio_items ) ) {
	
	$montoya_portfolio_item = $montoya_portfolio_items[$montoya_current_item_count-1];
	
	$montoya_hero_properties = new Montoya_Hero_Properties();
	$montoya_hero_properties->post_id = $montoya_portfolio_item->post_id;
	$montoya_hero_properties->getProperties( 'montoya_portfolio' );
	
	$montoya_hero_image 		= $montoya_hero_properties->image;
	$montoya_background_type 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-bknd-color' );
	$montoya_caption_title		= $montoya_hero_properties->caption_title;
	$montoya_project_year		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-project-year' );
	
	$montoya_curtain_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-curtain-color-code' );
	
	$montoya_item_classes = "";
	$montoya_item_categories = '';
	$montoya_item_cats = get_the_terms( $montoya_portfolio_item->post_id, 'portfolio_category' );
	if($montoya_item_cats){

		foreach($montoya_item_cats as $item_cat) {
			
			$montoya_item_classes .= $item_cat->slug . ' ';
			$montoya_item_categories .= $item_cat->name . ', ';
		}

		$montoya_item_categories = rtrim( $montoya_item_categories, ', ');

	}
		
	$item_url = get_the_permalink( $montoya_portfolio_item->post_id );
	
	$montoya_change_header = "";
	$montoya_current_page_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-bknd-color' );
	if( $montoya_background_type  == 'dark-content' ){
							
		$montoya_change_header = "change-header";
	}
	
?>
						<div class="clapat-item<?php if( ($montoya_current_item_count % 6 == 2) || ($montoya_current_item_count % 6 == 4) ){ echo ' vertical-parallax'; } ?> <?php echo esc_attr( $montoya_item_classes ); ?>">
							<div class="slide-inner trigger-item <?php echo sanitize_html_class( $montoya_change_header ); ?>" data-centerLine="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_open_project_caption') ); ?>">
								<div class="img-mask">
									<div class="curtains" data-curtain-color="<?php echo esc_attr( $montoya_curtain_color ); ?>">
										<div class="curtain-row"></div>
									</div>
									<a class="slide-link" data-type="page-transition" href="<?php echo esc_url( $item_url ); ?>"></a>
										<div class="section-image trigger-item-link">
											<img src="<?php echo esc_url( $montoya_hero_image['url'] ); ?>" class="item-image grid__item-img" alt="<?php echo esc_attr( montoya_get_image_alt(  $montoya_hero_image['id'] ) ); ?>">
											<?php if( $montoya_hero_properties->video ){ ?>
											<div class="hero-video-wrapper">
												<video loop muted playsinline class="bgvid">
												<?php if( !empty( $montoya_hero_properties->video_mp4 ) ){ ?>
													<source src="<?php echo esc_url( $montoya_hero_properties->video_mp4 ); ?>" type="video/mp4">
												<?php } ?>
												<?php if( !empty( $montoya_hero_properties->video_webm ) ){ ?>
													<source src="<?php echo esc_url( $montoya_hero_properties->video_webm ); ?>" type="video/webm">
												<?php } ?>
												</video>
											</div>
											<?php } ?>
										</div>
										<img src="<?php echo esc_url( $montoya_hero_image['url'] ); ?>" class="grid__item-img grid__item-img--large" alt="<?php echo esc_attr( montoya_get_image_alt(  $montoya_hero_image['id'] ) ); ?>">
								</div>
								<div class="slide-caption trigger-item-link-secondary">
									<div class="slide-title"><?php echo wp_kses( $montoya_caption_title, 'montoya_allowed_html' ); ?></div>
									<div class="slide-date"><span><?php echo wp_kses( $montoya_project_year, 'montoya_allowed_html' ); ?></span></div>
									<div class="slide-cat"><span><?php echo wp_kses( $montoya_item_categories, 'montoya_allowed_html' ); ?></span></div>
								</div>
							</div>
						</div>
<?php

}
?>
