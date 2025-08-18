	<?php if( montoya_get_theme_options('clapat_montoya_enable_preloader') ){ ?>
		<!-- Preloader -->
		<div class="preloader-wrap" data-centerLine="<?php echo esc_attr( montoya_get_theme_options('clapat_montoya_preloader_hover_line') ); ?>">
			<div class="outer">
				<div class="inner">
					<div class="trackbar">
						<div class="preloader-intro"></div>
						<div class="loadbar"></div>
						<div class="percentage-wrapper"><div class="percentage" id="precent"></div></div>
					</div>
                    
					<div class="percentage-intro"><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_preloader_text'), 'montoya_allowed_html' ); ?></div>
				</div>
			</div>
		</div>
		<!--/Preloader -->
	<?php } ?>