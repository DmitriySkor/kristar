<?php

get_header();

if ( have_posts() ){

$montoya_navigation_type = montoya_get_theme_options( 'clapat_montoya_blog_navigation_type' );

?>
	
	<!-- Main -->
	<div id="main">
	
		<!-- Hero Section -->
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="height-title content-full-width text-align-center parallax-scroll-caption">
					<div class="inner">
						<h1 class="hero-title primary-font-title caption-timeline"><span><?php echo wp_kses( montoya_get_theme_options('clapat_montoya_blog_default_title'), 'montoya_allowed_html' ); ?></span></h1> 
						<div class="hero-arrow link caption-timeline"><span><i class="arrow-icon"></span></i></div>
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
					while( have_posts() ){

						the_post();

						get_template_part( 'sections/blog_post_minimal_section' );
											
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

}

get_footer();

?>