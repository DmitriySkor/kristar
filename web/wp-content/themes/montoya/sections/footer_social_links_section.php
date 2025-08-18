<?php

if( !function_exists('montoya_render_footer_social_links' ) )
{
	function montoya_render_footer_social_links(){

		global $montoya_social_links_icons;
		$montoya_social_links = "";
		for( $idx = 1; $idx <= MONTOYA_MAX_SOCIAL_LINKS; $idx++ ){

			$social_name = montoya_get_theme_options( 'clapat_montoya_footer_social_' . $idx );
			$social_url  = montoya_get_theme_options( 'clapat_montoya_footer_social_url_' . $idx );

			if( $social_url ){

				if( montoya_get_theme_options( 'clapat_montoya_social_links_icons' ) ){
					
					$montoya_social_links .= '<li><span class="parallax-wrap"><a class="parallax-element" href="' . esc_url( $social_url ) . '" target="_blank"><i class="fa-brands fa-'. esc_attr( $montoya_social_links_icons[ $social_name ] ) . '"></i></a></span></li>';
				}
				else {
					
					$montoya_social_links .= '<li><span class="parallax-wrap"><a class="parallax-element" href="' . esc_url( $social_url ) . '" target="_blank">' . wp_kses( $social_name, 'montoya_allowed_html' ) . '</a></span></li>';
				}

			}

		}
		
		if( !empty( $montoya_social_links ) ){
?>
						<div class="socials-wrap">
							<div class="socials-icon"><i class="fa-solid fa-share-nodes"></i></div>
							<div class="socials-text"><?php echo wp_kses( montoya_get_theme_options( 'clapat_montoya_footer_social_links_prefix' ), 'montoya_allowed_html' ); ?></div>
							<ul class="socials">
								<?php echo wp_kses( $montoya_social_links, 'montoya_allowed_html' ); ?>
							</ul>
						</div>
<?php			
		
		}

	}
}

montoya_render_footer_social_links();

?>
