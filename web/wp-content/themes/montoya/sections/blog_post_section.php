<?php
$montoya_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
					<div class="article-wrap">
						<div class="article-head">
							<?php if( $montoya_post_image  ){ ?>
							<a class="article-link-img ajax-link-post" data-type="page-transition" href="<?php the_permalink(); ?>">
								<div class="article-img-wrap">
									<div class="article-img">
										<img src="<?php echo esc_url( $montoya_post_image[0] ); ?>" alt="<?php esc_attr_e("Post Image", "montoya"); ?>">
									</div>
								</div>
							</a>
							<?php } ?>
						</div>
						<div class="article-content">
							<a class="post-title hide-ball ajax-link" href="<?php echo esc_url( the_permalink() ); ?>" data-type="page-transition"><?php the_title(); ?></a>
							<ul class="entry-meta entry-date">
								<li class="link"><a class="ajax-link" href="<?php the_permalink(); ?>"><span data-hover="<?php the_date(); ?>"><?php echo get_the_date(); ?></span></a></li>
							</ul>
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
							<div class="button-box">
								<a class="ajax-link" data-type="page-transition" href="<?php the_permalink(); ?>">
									<div class="clapat-button-wrap parallax-wrap hide-ball">
										<div class="clapat-button parallax-element">
											<div class="button-border outline rounded parallax-element-second">
												<span data-hover="<?php echo esc_attr( montoya_get_theme_options( 'clapat_montoya_blog_read_more_caption' ) ); ?>"><?php echo wp_kses( montoya_get_theme_options( 'clapat_montoya_blog_read_more_caption' ), 'montoya_allowed_html' ); ?></span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="page-links">
							<?php
								wp_link_pages();
							?>
							</div>
						</div>
						<?php
						if( montoya_get_theme_options('clapat_montoya_blog_excerpt_type') != 'blog-excerpt-none' ) {
						?>
						<div class="blog-excerpt">
							<?php
							if( montoya_get_theme_options('clapat_montoya_blog_excerpt_type') == 'blog-excerpt-full' ) {
								
								the_content( esc_html__('Continue Reading...', 'montoya') );
							}
							else {
								
								the_excerpt();
							}
						?>
						</div>
						<?php
						}
						?>
					</div>
				</article>
				<!--/Article -->