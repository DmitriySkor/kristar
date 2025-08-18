<?php

get_header();

?>
	
		<!-- Hero -->
		<div id="hero" class="error">
			<div id="hero-styles">
				<!-- Hero Caption -->
				<div id="hero-caption" class="content-full-width text-align-center height-title">
					<div class="inner text-align-center">
						<div class="404caption">
							<h1 class="hero-title caption-timeline primary-font-title"><span><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_error_title'), 'montoya_allowed_html' ); ?></span></h1>
							<div class="hero-subtitle caption-timeline"><span><?php echo wp_kses ( montoya_get_theme_options('clapat_montoya_error_info'), 'montoya_allowed_html' ); ?></span></div>

							<a class="button-box ajax-link error-button" href="<?php echo esc_url( montoya_get_theme_options('clapat_montoya_error_back_button_url') ); ?>" data-type="page-transition">
								<div class="clapat-button-wrap parallax-wrap hide-ball">
									<div class="clapat-button parallax-element">
										<div class="button-border rounded outline parallax-element-second">
											<span data-hover="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_error_back_button_hover_caption') ); ?>"><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_error_back_button'), 'montoya_allowed_html' ); ?></span>
										</div>
									</div>
								</div> 
							</a>

						</div>
					</div>
				</div>
				<!--/Hero Caption -->
			</div>
		</div>
		<!-- /Hero --> 

<?php

get_footer();

?>