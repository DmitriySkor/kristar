<?php
/*
Template name: Blog Template
*/
get_header();

while ( have_posts() ){

the_post();

$montoya_navigation_type = montoya_get_theme_options( 'clapat_montoya_blog_navigation_type' );

?>
			
	<!-- Main -->
	<div id="main">
	
	<?php 
		
		// display hero section, if any
		get_template_part('sections/hero_section'); 
		
	?>
		<!-- Main Content -->
		<div id="main-content">
			<!-- Blog-->
			<div id="blog-page-content">
				<!-- Blog-Content-->
				<div id="blog-effects" class="<?php echo sanitize_html_class( montoya_get_theme_options( 'clapat_montoya_blog_scroll_effect_type' ) ); ?>" data-fx="1">
				<?php 
						
					$montoya_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					
					$montoya_args = array(
						'post_type' => 'post',
						'paged' => $montoya_paged
					);
					$montoya_posts_query = new WP_Query( $montoya_args );

					// the loop
					while( $montoya_posts_query->have_posts() ){

						$montoya_posts_query->the_post();

						get_template_part( 'sections/blog_post_minimal_section' );
												
					}
							
				?>
				</div>
				<!-- /Blog-Content -->
				
			</div>
			<!-- /Blog-->
			
			<?php
						
				montoya_pagination( $montoya_posts_query, $montoya_navigation_type );

				wp_reset_postdata();
			?>
		</div>
		<!--/Main Content-->
	
	<!-- /Main -->
	</div>
	
<?php

}

get_footer();

?>
