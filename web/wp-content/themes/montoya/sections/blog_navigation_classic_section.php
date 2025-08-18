				<!-- Blog Page Nav-->
				<div id="blog-page-nav" class="content-full-width primary-font-title">
					<div id="blog-page-nav-wrap">

						<div class="blog-navigation has-animation">
							<?php
							$big = 999999999; // need an unlikely integer

							$montoya_current_query = montoya_get_current_query();
							if ( get_query_var( 'paged' ) ) { $montoya_current_page = get_query_var( 'paged' ); }
							elseif ( get_query_var( 'page' ) ) { $montoya_current_page = get_query_var( 'page' ); }
							else { $montoya_current_page = 1; }
							
							$montoya_paginate_links = paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'type' => 'list',
								'format' => '?paged=%#%',
								'current' => $montoya_current_page,
								'total' => $montoya_current_query->max_num_pages,
								'prev_text' => wp_kses_post( montoya_get_theme_options('clapat_montoya_blog_prev_posts_caption') ),
								'next_text' => wp_kses_post( montoya_get_theme_options('clapat_montoya_blog_next_posts_caption') )
							) );
							
							if( montoya_get_theme_options( 'clapat_montoya_enable_ajax' ) ){
								
								$montoya_paginate_links = str_replace( 'a class="prev page-numbers"', 'a class="prev page-numbers ajax-link" data-type="page-transition"', $montoya_paginate_links ); 
								$montoya_paginate_links = str_replace( 'a class="page-numbers"', 'a class="page-numbers ajax-link" data-type="page-transition"', $montoya_paginate_links ); 
								$montoya_paginate_links = str_replace( 'a class="next page-numbers"', 'a class="next page-numbers ajax-link" data-type="page-transition"', $montoya_paginate_links ); 
							}
								
							echo wp_kses_post( $montoya_paginate_links ); 
							
							?>
						</div>
						
					</div>
				</div>
				<!-- /Blog Page Nav-->