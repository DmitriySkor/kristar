<?php
/**
 * Created by Clapat.
 * Date: 15/03/24
 * Time: 1:34 PM
 */
$montoya_hero_properties = new Montoya_Hero_Properties();
$montoya_hero_properties->getProperties( get_post_type() );

$hero_styles = $montoya_hero_properties->width;

if( !empty( $montoya_hero_properties->alignment ) ){
	
	$hero_styles .= " " . $montoya_hero_properties->alignment;
}
if( !empty( $montoya_hero_properties->scroll_position ) ){
	
	$hero_styles .= " " . $montoya_hero_properties->scroll_position;
}
if( !$montoya_hero_properties->caption_flip ){
	
	$hero_styles .= " no-flip-title";
}

if( $montoya_hero_properties->enabled ){

?>

		<?php if( $montoya_hero_properties->image && !empty( $montoya_hero_properties->image['url'] ) ){ ?>
		<!-- Hero Section -->
		<div id="hero" class="has-image<?php if( montoya_get_theme_options( 'clapat_montoya_portfolio_autoscroll_hero' ) ){ echo " autoscroll"; } ?>">
			<div id="hero-styles">
				<div id="hero-caption" class="height-title <?php echo esc_attr( $hero_styles ); ?>">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><?php echo wp_kses( $montoya_hero_properties->caption_title, 'montoya_allowed_html' ); ?></h1>
						<?php if( !empty( $montoya_hero_properties->caption_subtitle ) && !is_singular( 'montoya_portfolio' ) ){ ?>
						<div class="hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_hero_properties->caption_subtitle, 'montoya_allowed_html' ); ?></div>
						<?php } ?>
					</div>
				</div>
				<?php if( !empty( $montoya_hero_properties->info_text ) && is_singular( 'montoya_portfolio' ) ){ ?>
				<div id="hero-description" class="content-full-width">
					<div class="inner">
						<?php echo wp_kses( $montoya_hero_properties->info_text, 'montoya_allowed_html' ); ?>
					</div>
				</div>
				<?php }	else {
					
					if( is_singular( 'montoya_portfolio' ) ){
				?>
				<div id="hero-description" class="description-empty content-full-width text-align-center"></div>
				<?php
					}
				}
				?>
				<div id="hero-footer">
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
					<?php if( $montoya_hero_properties->share && is_singular( 'montoya_portfolio' ) ){ ?>
					<div class="hero-footer-right">
						<div id="share" class="page-action-content" data-text="<?php echo esc_attr( montoya_get_theme_options( 'clapat_montoya_portfolio_share_social_networks_caption' ) ); ?>"></div>
					</div>
					<?php } else  if( !empty( $montoya_hero_properties->info_text ) ){ ?>
					<div class="hero-footer-right">
						<div id="info-text"><?php echo wp_kses( $montoya_hero_properties->info_text, 'montoya_allowed_html' ); ?></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if ( is_front_page() ) { ?>
		<div  class="shedule_btn" style="position: sticky; position: -webkit-sticky; z-index: 10000; Border: solid 1px; color: #000000; background:#ffffff; padding: 5px; margin: auto; font-family: Tahoma; font-size: 33px; width: 300px; text-align: center; margin-top: -80px; margin-bottom: 100px; cursor:pointer;"><a style="color:#000000" href="/schedule/">SCHEDULE</a></div>
		<?php }?>
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
		<div id="hero">
			<div id="hero-styles">
				<div id="hero-caption" class="height-title <?php echo esc_attr( $hero_styles ); ?>">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><?php echo wp_kses( $montoya_hero_properties->caption_title, 'montoya_allowed_html' ); ?></h1>
						<?php if( !empty( $montoya_hero_properties->caption_subtitle ) && !is_singular( 'montoya_portfolio' ) ){ ?>
						<div class="hero-subtitle caption-timeline"><?php echo wp_kses( $montoya_hero_properties->caption_subtitle, 'montoya_allowed_html' ); ?></div>
						<?php } ?>
					</div>
				</div>
				<div id="hero-footer">
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
					<?php if( !empty( $montoya_hero_properties->info_text ) ){ ?>
					<div class="hero-footer-right">
						<div id="info-text"><?php echo wp_kses( $montoya_hero_properties->info_text, 'montoya_allowed_html' ); ?></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!--/Hero Section -->
		<?php } ?>

<?php
}
?>
