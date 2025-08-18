<?php
/**
 * The template for displaying Category Search Results pages
 */

get_header();

$montoya_navigation_type = montoya_get_theme_options( 'clapat_montoya_blog_navigation_type' );

?>
		
	<!-- Main -->
	<div id="main">
		
		<!-- Hero Section -->
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="content-full-width parallax-scroll-caption text-align-center">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><span><?php single_cat_title('', true); ?></span></h1>
						<div class="hero-subtitle caption-timeline"><span><?php echo esc_html__( 'Category Results', 'montoya'); ?></span></div>
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		
		<!-- Main Content -->
		<div id="main-content">
			<!-- Blog-->
			<div id="blog-page-content">
				<!-- Blog-Content-->
				<div id="blog-effects" class="<?php echo sanitize_html_class( montoya_get_theme_options( 'clapat_montoya_blog_scroll_effect_type' ) ); ?>" data-fx="1">
				<?php 
						
					// the loop
					if( have_posts() ){
					
						while( have_posts() ){

							the_post();

							get_template_part( 'sections/blog_post_minimal_section' );
							
						}
					}
					else {
						
						echo '<h4 class="search_results">' . esc_html__('No posts found in this category', 'montoya') . '</h4>';
					}
				?>
			
				<!-- /Blog-Content-->
				</div>
				
			</div>
			<!-- /Blog-->
			<?php
					
				montoya_pagination( null, $montoya_navigation_type );

			?>
			
		</div>
		<!--/Main Content-->
	</div>
	<!-- /Main -->
<?php

get_footer();

?>