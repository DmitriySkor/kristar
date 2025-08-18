<?php
/*
Template name: Portfolio Showcase Gallery
*/
get_header();

if ( have_posts() ){

the_post();

$montoya_portfolio_tax_query = null;
$montoya_portfolio_category_filter = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-filter-category' );

$montoya_gallery_enable_preview = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-gallery-enable-preview' );
$montoya_gallery_enable_tilt = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-gallery-enable-tilt' );

$montoya_portfolio_thumb_to_fullscreen	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-thumb-to-fullscreen' );
if( !montoya_get_theme_options('clapat_montoya_enable_ajax') ){
	
	$montoya_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
}
$montoya_portfolio_thumb_to_fullscreen_webgl_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-thumb-to-fullscreen-webgl-type' );

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

// Select all portfolio items
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

montoya_portfolio_thumbs_list( $montoya_portfolio_items );

wp_reset_postdata();

?>

			<!-- Main -->
			<div id="main">
			
				<!-- Main Content -->
				<div id="main-content">
				
					<!-- Showcase Slider Holder -->
					<div id="itemsWrapperLinks">
						<!-- Showcase Columns -->
						<div id="itemsWrapper" class="<?php echo sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen ); ?> <?php echo sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen_webgl_type ); ?>">
                            
                           	<!-- ClaPat Slider -->
							<div class="clapat-slider-wrapper showcase-gallery<?php if( $montoya_gallery_enable_preview ) { echo ' preview-mode-enabled'; } ?><?php if( $montoya_gallery_enable_tilt ){ echo ' tilt-gallery'; } ?>">
								<div class="clapat-slider">
                                      	
									<!-- ClaPat Main Slider -->
									<div class="clapat-slider-viewport">

									<?php

									$montoya_portfolio_items = montoya_portfolio_thumbs_list();

									if( !empty( $montoya_portfolio_items ) ){
											
										$montoya_current_item_count = 1;

										foreach( $montoya_portfolio_items as $montoya_portfolio_item ){

											$montoya_thumb_offset = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-thumb-gallery-offset' );
											$montoya_thumb_scale = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-thumb-gallery-scale' );
											$montoya_gallery_enable_parallax = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-gallery-enable-parallax' );
											$montoya_background_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $montoya_portfolio_item->post_id, 'montoya-opt-portfolio-bknd-color' );
											
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
										<div class="clapat-slide <?php echo sanitize_html_class( $montoya_thumb_offset ); ?>">
											<div class="slide-events <?php echo sanitize_html_class( $montoya_thumb_scale ); ?><?php if( $montoya_gallery_enable_parallax ) echo ' speed-50'; ?>">
												<div class="slide-inner <?php echo esc_attr( $montoya_item_classes ); ?>" data-centerLine="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_view_project_caption') ); ?>">
													<div class="slide-moving">
														<div class="trigger-item <?php echo sanitize_html_class( $montoya_change_header ); ?>" data-centerLine="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_open_project_caption') ); ?>">
															<div class="img-mask">
																<a class="slide-link" data-type="page-transition" href="<?php echo esc_url( $item_url ); ?>">
																	<div class="parallax-wrap">
																		<div class="parallax-element">
																			<i class="fa-solid fa-arrow-up-right-from-square"></i>
																		</div>
																	</div>
																</a>
																<div class="section-image trigger-item-link">
																	<img src="<?php echo esc_url( $montoya_portfolio_item->image['url'] ); ?>" class="item-image grid__item-img" alt="<?php echo esc_attr( montoya_get_image_alt(  $montoya_portfolio_item->image['id'] ) ); ?>">
																	<?php if( $montoya_portfolio_item->video ){ ?>
																		<div class="hero-video-wrapper">
																			<video loop muted playsinline class="bgvid">
																			<?php if( !empty( $montoya_portfolio_item->video_mp4 ) ){ ?>
																				<source src="<?php echo esc_url( $montoya_portfolio_item->video_mp4 ); ?>" type="video/mp4">
																			<?php } ?>
																			<?php if( !empty( $montoya_portfolio_item->video_webm ) ){ ?>
																				<source src="<?php echo esc_url( $montoya_portfolio_item->video_webm ); ?>" type="video/webm">
																			<?php } ?>
																			</video>
																		</div>
																		<?php } ?>
																</div> 
																<img src="<?php echo esc_url( $montoya_portfolio_item->image['url'] ); ?>" class="grid__item-img grid__item-img--large" alt="<?php echo esc_attr( montoya_get_image_alt(  $montoya_portfolio_item->image['id'] ) ); ?>">
															</div>
														</div>
														<div class="slide-caption">
															<div class="slide-title"><?php echo wp_kses( $montoya_portfolio_item->caption_title, 'montoya_allowed_html' ); ?></div>
															<div class="slide-cat"><span><?php echo wp_kses( $montoya_item_categories, 'montoya_allowed_html' ); ?></span></div>
														</div>
													</div>
												</div>
											</div>
										</div>
											
									<?php

											$montoya_current_item_count++;
										}

									}
									
									?>
										
									</div>
									<!-- /ClaPat Main Slider -->
									<?php
									$montoya_hero_properties = new Montoya_Hero_Properties();
									$montoya_hero_properties->getProperties( get_post_type( get_the_ID() ) );
									?>
									<div class="slider-fixed-content">
										<div id="slide-inner-temporary" class="fadeout-element">
											<div id="slide-inner-caption" class="content-full-width text-align-center height-title">
												<div class="inner">
													<h1 class="slide-hero-title caption-timeline primary-font-title"><?php echo wp_kses( $montoya_hero_properties->caption_title, 'montoya_allowed_html' ); ?></h1>
													<div class="slide-hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_hero_properties->caption_subtitle, 'montoya_allowed_html' ); ?></div>
												</div>
											</div> 
										</div>
									</div>

								</div>
								
								<div class="gallery-zoom-wrapper"></div>
								<div class="gallery-thumbs-wrapper"></div>
								<div class="gallery-close-thumbs"></div>

							</div>
							<!-- /ClaPat Slider -->

						</div>
						<!--/Showcase Columns -->
					</div>
					<!--/Showcase Slider Holder -->

				</div>
				<!-- /Main Content -->
				
			</div>
			<!--/Main -->
<?php

}

get_footer();

?>