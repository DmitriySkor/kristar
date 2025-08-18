<?php

get_header();

while ( have_posts() ){

	the_post();

	$montoya_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	// hero section container properties
	$montoya_hero_properties = new Montoya_Hero_Properties();
$montoya_hero_properties->getProperties( get_post_type() );
	
?>
	
	<!-- Main -->
	<div id="main">
	
		<!-- Hero Section -->
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="content-max-width text-align-center <?php echo sanitize_html_class( $montoya_hero_properties->alignment ); ?>">
					<div class="inner">
						<ul class="entry-meta entry-date">
							<li class="link"><a href="<?php the_permalink(); ?>"><span data-hover="<?php the_date(); ?>"><?php echo get_the_date(); ?></span></a></li>
						</ul>
						<h1 class="hero-title caption-timeline primary-font-title"><span><?php the_title(); ?></span></h1>
						<div class="entry-meta entry-categories">
							<ul class="post-categories">
							<?php 
								$montoya_categories = get_the_category();
								if ( ! empty( $montoya_categories ) ) {
												
									foreach( $montoya_categories as $montoya_category ) {
													
										echo '<li class="link">';
										echo wp_kses( '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_category_link( $montoya_category->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $montoya_category->name ) . '">' . esc_html( $montoya_category->name ) . '</span></a>', 'montoya_allowed_html' );
										echo '</li>';
									}
								}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
				
		<!-- Main Content -->
		<div id="main-content" >
			<!-- Post -->
			<div id="blog-post-content">
				
				<?php if( $montoya_post_image ){ ?>
				<div id="post-image">
					<img src="<?php echo esc_url( $montoya_post_image[0] ); ?>" alt="<?php esc_attr_e("Post Image", "montoya"); ?>">
				</div>
				<?php } ?>
				<!-- Post Content -->
				<div id="post-content">
                	<div class="post-max-width">
					
						<?php the_content(); ?>
                                    
                        <div class="page-links">
                        <?php
                            wp_link_pages();
                        ?>
                        </div>
                    
                    </div>
				</div>
				<!--/Post Content -->
				
				<!-- Post Meta Data -->
				<div id="post-meta-data">
                	<div class="post-max-width">
						<?php if ( has_tag() ) {
                            
                            echo '<ul class="entry-meta entry-tags"><li>' . esc_html__('Tags:', 'montoya') .'</li>';
                            $montoya_tags = get_the_tags();
                            if ( ! empty( $montoya_tags ) ) {
                                            
                                foreach( $montoya_tags as $montoya_tag ) {
                                                
                                    echo '<li class="link">';
                                    echo wp_kses( '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_tag_link( $montoya_tag->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $montoya_tag->name ) . '">' . esc_html( $montoya_tag->name ) . '</span></a>', 'montoya_allowed_html' );
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                            
                        } ?>
                    </div>
				</div>
				<!--/Post Meta Data -->
				
				<!-- Post Navigation -->
				<div id="post-navigation">
                	<div class="post-max-width">
                        <?php next_post_link( 'blog-post', montoya_get_theme_options( 'clapat_montoya_blog_prev_post_caption' ) ); ?>
                        <?php previous_post_link( 'blog-post', montoya_get_theme_options( 'clapat_montoya_blog_next_post_caption' ) ); ?>
                    </div>
				</div>
				<!--/Post Navigation -->
				
				<?php comments_template(); ?>
				
			</div>
			<!-- /Post -->
		</div>
		<!-- /Main Content -->
	</div>
	<!-- /Main -->
<?php

}

get_footer();

?>
