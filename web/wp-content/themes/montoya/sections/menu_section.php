			<?php
				
				$montoya_menu_breakpoint = "1025";
				$montoya_menu_additional_text = "";
				if( ( montoya_get_theme_options( 'clapat_montoya_header_menu_type' ) != 'classic-burger-dots' ) &&
					( montoya_get_theme_options( 'clapat_montoya_header_menu_type' ) != 'classic-burger-lines' ) ){
					
					$montoya_menu_breakpoint = "10025";
				}
				
				$montoya_theme_location = '';
				if( has_nav_menu( 'primary-menu' ) ){
					
					$montoya_theme_location = 'primary-menu';
				}
				wp_nav_menu(array(
					'theme_location' 	=> $montoya_theme_location,
					'container' 		=> 'nav',
					'items_wrap' 		=> '<div class="nav-height"><div class="outer"><div class="inner"><ul id="%1$s" data-breakpoint="' . esc_attr( $montoya_menu_breakpoint ) . '" class="flexnav %2$s">%3$s</ul></div>' . wp_kses( $montoya_menu_additional_text, 'montoya_allowed_html' ) . '</div></div>'
				));

			?>
