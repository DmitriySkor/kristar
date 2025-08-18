<?php
/**
 * Created by Clapat.
 * Date: 29/03/24
 * Time: 11:33 AM
 */

// hero section container properties
$montoya_hero_properties = new Montoya_Hero_Properties();
$montoya_hero_properties->getProperties( get_post_type() );

if( $montoya_hero_properties->enabled ){

	get_template_part('sections/hero_section_container');
}
else {
	
	$montoya_hero_styles = $montoya_hero_properties->width . " " . $montoya_hero_properties->scroll_position . " " . $montoya_hero_properties->alignment;
	
?>
		<!-- Hero Section -->
		<div id="hero" <?php if( !montoya_get_theme_options( 'clapat_montoya_enable_page_title_as_hero' ) ){ echo 'class="hero-hidden"'; } ?>>
			<div id="hero-styles">
				<div id="hero-caption" class="height-title <?php echo esc_attr( $montoya_hero_styles ); ?>">
					<div class="inner">
						<h1 class="hero-title caption-timeline primary-font-title"><span><?php the_title(); ?></span></h1>
					</div>
				</div>
			</div>
		</div>
		<!--/Hero Section -->   
		
<?php

}

?>
