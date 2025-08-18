			<?php
			if ( function_exists( 'elementor_theme_do_location' ) ){
				
				elementor_theme_do_location( 'footer' );
			}
			?>
			<!-- Footer -->
			<footer class="hidden">
				<div id="footer-container">

				<?php if( montoya_get_theme_options( 'clapat_montoya_enable_back_to_top' ) ){?>
					<?php if( montoya_display_back_to_top() ){ ?>
					<div id="backtotop" class="button-wrap left">
						<div class="icon-wrap parallax-wrap">
							<div class="button-icon parallax-element">
								<i class="fa-solid fa-angle-up"></i>
							</div>
						</div>
						<div class="button-text sticky left"><span data-hover="<?php echo esc_attr( montoya_get_theme_options( 'clapat_montoya_back_to_top_caption' ) ); ?>"><?php echo wp_kses( montoya_get_theme_options( 'clapat_montoya_back_to_top_caption' ), 'montoya_allowed_html' ); ?></span></div>
					</div>
					<?php } ?>
				<?php } ?>

				<?php if( montoya_display_copyright() ){
					if( montoya_get_theme_options('clapat_montoya_footer_copyright') ){ ?>
					<div class="footer-middle"><div class="copyright"><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_footer_copyright'), 'montoya_allowed_html' ); ?></div></div>
				<?php }
				}	?>

				<?php if( is_page_template('portfolio-showcase-gallery-page.php') ) {

						get_template_part('sections/showcase_gallery_navigation_section');
					} 
				?>
				
				<?php
					if( display_footer_social_links_section() ){

						get_template_part('sections/footer_social_links_section');
					}
				?>

				</div>
			</footer>
			<!--/Footer -->

		</div>