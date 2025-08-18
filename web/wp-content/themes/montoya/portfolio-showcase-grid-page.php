<?php
/*
Template name: Portfolio Showcase Grid
*/
get_header();

if ( have_posts() ){

the_post();

$montoya_portfolio_tax_query = null;
$montoya_portfolio_category_filter = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-filter-category' );

$montoya_content_position	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-grid-content-position' );

$montoya_portfolio_thumb_to_fullscreen	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-thumb-to-fullscreen' );
if( !montoya_get_theme_options('clapat_montoya_enable_ajax') ){
	
	$montoya_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
}
$montoya_portfolio_thumb_to_fullscreen_webgl_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-portfolio-thumb-to-fullscreen-webgl-type' );

$montoya_array_terms = null;
if( !empty( $montoya_portfolio_category_filter ) ){

	$montoya_array_terms = explode( ",", $montoya_portfolio_category_filter );
	$montoya_portfolio_tax_query = array(
										array(
											'taxonomy' 	=> 'portfolio_category',
											'field'		=> 'slug',
											'terms'		=> $montoya_array_terms,
											),
									);
}

// Select all portfolio items
$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$montoya_args = array(
					'post_type' => 'montoya_portfolio',
					'paged' => $montoya_paged,
					'tax_query' => $montoya_portfolio_tax_query,
					'posts_per_page' => 1000,
					 );

$montoya_portfolio = new WP_Query( $montoya_args );

$montoya_portfolio_items = array();

// collect the posts first
$montoya_current_item_count = 1;
while( $montoya_portfolio->have_posts() ){

	$montoya_portfolio->the_post();

	$montoya_hero_properties = new Montoya_Hero_Properties();
	$montoya_hero_properties->getProperties( get_post_type( get_the_ID() ) );
	$montoya_hero_properties->item_no = $montoya_current_item_count;
	$montoya_portfolio_items[] = $montoya_hero_properties;

	$montoya_current_item_count++;

}

montoya_portfolio_thumbs_list( $montoya_portfolio_items );

wp_reset_postdata();

?>

			<!-- Main -->
			<div id="main">
			
				<?php
		
				// display hero section
				get_template_part('sections/hero_portfolio_grid_section'); 
		
				?>
			
				<!-- Main Content -->
				<div id="main-content">
				
					<!-- Main Page Content -->
					<div id="main-page-content">

						<!-- Showcase Slider Holder -->
						<div id="itemsWrapperLinks">
							<!-- Showcase Columns -->
							<div id="itemsWrapper" class="<?php echo sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen ); ?> <?php echo sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen_webgl_type ); ?>">
								
								<?php 
									if( $montoya_content_position == "before" ){
										the_content();
									} 
								?>
								
								<!-- ClaPat Portfolio -->
								<div class="showcase-portfolio">

									<?php
											
										$montoya_portfolio_items = montoya_portfolio_thumbs_list();
											
										if( !empty( $montoya_portfolio_items ) ){
											
											$montoya_current_item_count = 1;
	
											foreach( $montoya_portfolio_items as $montoya_portfolio_item ){

												set_query_var('montoya_query_var_item_count', $montoya_current_item_count);

												get_template_part('sections/portfolio_section_item');
												
												$montoya_current_item_count++;
											}

										}
										?>
										
								</div>
								<!-- /ClaPat Portfolio -->
								
								<?php 
									if( $montoya_content_position == "after" ){
										the_content();
									} 
								?>
								
							</div>
							<!--/Showcase Columns -->
						</div>
						<!--/Showcase Slider Holder -->
					
					 </div>
					 <!-- /Main Page Content -->
					 <?php
		
					// display next page navigation section
					get_template_part('sections/page_navigation_section'); 
		
					?>
					
				</div>
				<!-- /Main Content -->
			</div>
			<!--/Main -->
<?php

}

get_footer();

?>
