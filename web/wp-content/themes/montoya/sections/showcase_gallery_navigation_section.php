					<?php

						$montoya_nav_next_caption = montoya_get_theme_options('clapat_montoya_showcase_gallery_next_caption');
						$montoya_nav_prev_caption = montoya_get_theme_options('clapat_montoya_showcase_gallery_prev_caption');

					?>
							
							<div class="cp-button-prev clapat-button">
								<div class="icon-wrap-scale">
									<div class="icon-wrap parallax-wrap">
										<div class="button-icon parallax-element">
											<i class="fa-solid fa-arrow-left"></i>
										</div>
									</div>
								</div>
								<div class="button-text sticky left">
									<span data-hover="<?php echo esc_attr( $montoya_nav_prev_caption ) ?>"><?php echo wp_kses( $montoya_nav_prev_caption, 'montoya_allowed_html'); ?></span>
								</div>
							</div>

							<div class="progress-info fadeout-element">
								<div class="progress-info-fill"><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_showcase_scroll_drag_caption'), 'montoya_allowed_html') ?></div>
								<div class="progress-info-fill-2"><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_showcase_scroll_drag_caption'), 'montoya_allowed_html') ?></div>
							</div>

							<div class="cp-button-next clapat-button">
								<div class="icon-wrap-scale">
									<div class="icon-wrap parallax-wrap">
										<div class="button-icon parallax-element">
											<i class="fa-solid fa-arrow-right"></i>
										</div>
									</div>
								</div>
								<div class="button-text sticky right">
									<span data-hover="<?php echo esc_attr( $montoya_nav_next_caption ) ?>"><?php echo wp_kses( $montoya_nav_next_caption, 'montoya_allowed_html'); ?></span>
								</div>
							</div>