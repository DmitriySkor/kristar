							<!-- Filters -->
							<div class="filters-options-wrapper">
								<a id="all" href="#" data-filter="" class="filter-option is_active">
									<span class="link" data-hover="<?php echo esc_attr( montoya_get_theme_options( 'clapat_montoya_portfolio_filter_all_caption' ) ); ?>">
										<?php echo wp_kses( montoya_get_theme_options( 'clapat_montoya_portfolio_filter_all_caption' ), 'montoya_allowed_html' ); ?>
									</span>
								</a>
								<?php
										
									// check if the category filter is specified in page options
									$montoya_portfolio_category_filter	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-filter-category' );

									$montoya_portfolio_category = null;
									if( !empty( $montoya_portfolio_category_filter ) ){
					
										$montoya_portfolio_category = array();
										$montoya_category_slugs = explode( ",", $montoya_portfolio_category_filter );
										foreach( $montoya_category_slugs as $montoya_category_slug ){
														
											$montoya_category_object = get_term_by( 'slug', $montoya_category_slug, 'portfolio_category' );
											if( $montoya_category_object ){
															
												array_push( $montoya_portfolio_category, $montoya_category_object );
											}
										}
									}
									else {

										$montoya_portfolio_category = get_terms('portfolio_category', array( 'hide_empty' => 0 ));
									}

									if( $montoya_portfolio_category ){

										foreach( $montoya_portfolio_category as $portfolio_cat ){

								?>
								<a class="filter-option" href="#" data-filter="<?php echo sanitize_title( $portfolio_cat->slug ); ?>">
									<span class="link" data-hover="<?php echo esc_attr( $portfolio_cat->name ); ?>">
										<?php echo wp_kses( $portfolio_cat->name, 'montoya_allowed_html' ); ?>
									</span>
								</a>
								<?php
								
										}
									}

								?>	
							</div>
							<!-- Filters -->