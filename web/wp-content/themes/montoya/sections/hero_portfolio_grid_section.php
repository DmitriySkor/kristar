<?php
/**
 * Created by Clapat.
 * Date: 26/03/24
 * Time: 1:34 PM
 */
 
$montoya_hero_properties = new Montoya_Hero_Properties();
$montoya_hero_properties->getProperties( get_post_type() );

$montoya_hero_styles = $montoya_hero_properties->width;

if( !empty( $montoya_hero_properties->alignment ) ){
		
	$montoya_hero_styles .= " " . $montoya_hero_properties->alignment;
}
if( !empty( $montoya_hero_properties->scroll_position ) ){
		
	$montoya_hero_styles .= " " . $montoya_hero_properties->scroll_position;
}

$montoya_hero_title = $montoya_hero_properties->caption_title;
if( !$montoya_hero_properties->enabled ){
	
	$montoya_hero_title = get_the_title();
} 
?>
					
		<?php if( $montoya_hero_properties->image && !empty( $montoya_hero_properties->image['url'] ) && $montoya_hero_properties->enabled ){ ?>
		<!-- Hero Section -->
		<div id="hero" class="has-image">
			<div id="hero-styles">
				<div id="hero-caption" class="<?php echo esc_attr( $montoya_hero_styles ); ?> height-title">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><?php echo wp_kses( $montoya_hero_title, 'montoya_allowed_html' ); ?></h1>
						<?php if( !empty( $montoya_hero_properties->caption_subtitle ) ){ ?>
						<div class="hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_hero_properties->caption_subtitle, 'montoya_allowed_html' ); ?></div>
						<?php } ?>
					</div>
				</div>
				<div id="hero-footer" class="has-border">
					<div class="hero-footer-left">
						<div class="button-wrap right scroll-down">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="fa-solid fa-angle-down"></i>
								</div>
							</div>
							<?php if( $montoya_hero_properties->scroll_down_caption ){ ?>
							<div class="button-text sticky right">
								<span data-hover="<?php echo esc_attr( $montoya_hero_properties->scroll_down_caption ); ?>"><?php echo wp_kses( $montoya_hero_properties->scroll_down_caption, 'montoya_allowed_html' ); ?></span>
							</div>
							<?php } ?>
						</div>	
                     </div>
					<div class="hero-footer-right">
                
						<?php get_template_part('sections/portfolio_grid_filters_section');  ?>
                                    
					</div>
				</div>
			</div>
		</div>
		<div id="hero-image-wrapper">
			<div id="hero-background-layer" class="parallax-scroll-image">
				<div id="hero-bg-image" style="background-image:url(<?php echo esc_url( $montoya_hero_properties->image['url'] ); ?>)">
				<?php if( $montoya_hero_properties->video ){ ?>
					<div class="hero-video-wrapper">
						<video loop muted playsinline class="bgvid">
						<?php if( !empty( $montoya_hero_properties->video_mp4 ) ){ ?>
							<source src="<?php echo esc_url( $montoya_hero_properties->video_mp4 ); ?>" type="video/mp4">
						<?php } ?>
						<?php if( !empty( $montoya_hero_properties->video_webm ) ){ ?>
							<source src="<?php echo esc_url( $montoya_hero_properties->video_webm ); ?>" type="video/webm">
						<?php } ?>
						</video>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		<?php } else { ?>
		<!-- Hero Section -->
		<div id="hero" <?php if( !$montoya_hero_properties->enabled && !montoya_get_theme_options( 'clapat_montoya_enable_page_title_as_hero' ) ){ echo 'class="hero-hidden"'; } ?>>
			<div id="hero-styles">
				<div id="hero-caption" class="height-title <?php echo esc_attr( $montoya_hero_styles ); ?>">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><?php echo wp_kses( $montoya_hero_title, 'montoya_allowed_html' ); ?></h1>
						<?php if( !empty( $montoya_hero_properties->caption_subtitle ) ){ ?>
						<div class="hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_hero_properties->caption_subtitle, 'montoya_allowed_html' ); ?></div>
						<?php } ?>
					</div>
				</div>
				<div id="hero-footer" class="has-border">
					<div class="hero-footer-left">
						<div class="button-wrap right scroll-down">
							<div class="icon-wrap parallax-wrap">
								<div class="button-icon parallax-element">
									<i class="fa-solid fa-angle-down"></i>
								</div>
							</div>
							<?php if( $montoya_hero_properties->scroll_down_caption ){ ?>
							<div class="button-text sticky right">
								<span data-hover="<?php echo esc_attr( $montoya_hero_properties->scroll_down_caption ); ?>"><?php echo wp_kses( $montoya_hero_properties->scroll_down_caption, 'montoya_allowed_html' ); ?></span>
							</div>
							<?php } ?>
						</div>	
                     </div>
					<div class="hero-footer-right">
                
						<?php get_template_part('sections/portfolio_grid_filters_section');  ?>
                                    
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		<?php } ?>
