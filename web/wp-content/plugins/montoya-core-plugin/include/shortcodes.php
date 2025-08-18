<?php
// Montoya shortcodes definitions


function clapat_core_get_image_url( $image_id, $image_url ){
	
	if( !empty( $image_id ) ){
		
		$image_info = wp_get_attachment_image_src( $image_id, 'full' );
		if( !empty( $image_info[0] ) ){
			
			return $image_info[0];
		} 
	}
	
	return $image_url;
}

/* Typo Elements */

//////////////////////////////////////////////////////////////////
// Button shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button', 'shortcode_button');
function shortcode_button($atts, $content = null) {

	$atts = shortcode_atts(array(
				'link'      		=> '',
				'target'    		=> '_blank',
				'type'      		=> 'normal',
				'rounded'      		=> 'yes',
				'background_color'	=> '',
				'text_color'		=> '',
				'animation' 		=> false,
				'animation_delay' 	=> '0',
				'extra_class_name' 	=> ''
			), $atts );

	$css_classes = '';
	$link_css_classes = '';
	$transition = '';
	if( $atts['type'] == 'outline' ){
		$css_classes .= ' outline';
	}
	if( $atts['rounded'] == 'yes' ){
		$css_classes .= ' rounded';
	}
	if( $atts['target'] == '_self' ){
		$link_css_classes .= ' ajax-link animation-link';
		$transition = ' data-type="page-transition"';
	}
	if( !empty( $atts['extra_class_name'] ) ){
		$css_classes .= '  ' . $atts['extra_class_name'];
	}
	
	$clapat_attributes = "";
	if( !empty( $atts['background_color'] ) ){
		
		$clapat_attributes .= ' data-btncolor="' . esc_attr( $atts['background_color'] ) . '"';
	}
	if( !empty( $atts['text_color'] ) ){
		
		$clapat_attributes .= ' data-btntextcolor="' . esc_attr( $atts['text_color'] ) . '"';
	}
	
	$out  = '<div class="button-box';
	
	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	
	$out  .= '<div class="clapat-button-wrap parallax-wrap hide-ball">';
	$out  .= '<div class="clapat-button parallax-element">';
	$out  .= '<div class="button-border parallax-element-second' . $css_classes . '"' . $clapat_attributes . '>';
	$out  .= '<a class="'  . $link_css_classes . '" href="' . $atts['link'] . '"' . $transition . ' target="' . $atts['target'] . '">';
	$out  .= '<span data-hover="' . esc_attr( $content ) . '">' . do_shortcode($content) . '</span>';
	$out  .= '</a>';
	$out  .= '</div>';
	$out  .= '</div>';
	$out  .= '</div>';
	$out  .= '</div>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Text Link shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button_link', 'shortcode_button_link');
function shortcode_button_link($atts, $content = null) {

	$atts = shortcode_atts(array(
				'link'      		=> '',
				'target'    		=> '_blank',
				'caption'			=> '',
				'position'			=> 'left',
				'type'				=> 'arrow',
				'size'				=> 'small-btn',
				'animation' 		=> false,
				'animation_delay' 	=> '0',
				'extra_class_name' 	=> ''
			), $atts );

	$out  = '<div class="button-wrap ' . $atts['size'] . ' ' . $atts['position'];
	if( $atts['type'] == 'bullet' ){
		
		$out .= ' button-link';
	}
	
	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	
	
	$out  .= '<div class="icon-wrap parallax-wrap">';
	$out  .= '<div class="button-icon parallax-element">';
	if( $atts['type'] == 'arrow' ){
		$out  .= '<i class="arrow-icon-down"></i>';
	}
	else {
		$out  .= '<i class="fa-solid fa-arrow-right"></i>';
	}
	$out  .= '</div>';
	$out  .= '</div>';
	$out  .= '<a target="' . esc_attr( $atts['target'] ) . '" href="' . esc_attr( $atts['link'] ) . '">';
	$out  .= '<div class="button-text sticky ' . $atts['position'] . '"><span data-hover="' . esc_attr( $atts['caption'] ) . '">' . wp_kses_post( $atts['caption'] ) . '</span></div>';
	$out  .= '</a>';
	$out  .= '</div>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Marquee Content
//////////////////////////////////////////////////////////////////
add_shortcode('marquee_content', 'shortcode_marquee_content');
function shortcode_marquee_content($atts, $content = null) {

	$atts = shortcode_atts(array(
		'direction' => 'fw',
		'extra_class_name' => ''
	), $atts );
	
	$out = '<div class="marquee-text-wrapper ' . sanitize_html_class( $atts['extra_class_name'] ) . '">';
	$out .= '<h1 class="marquee-text big-title ' . sanitize_html_class( $atts['direction'] ) . '">' . wp_kses_post( $content ) . '</h1>';
	$out .= '</div>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Moving Title
//////////////////////////////////////////////////////////////////
add_shortcode('moving_title', 'shortcode_moving_title');
function shortcode_moving_title($atts, $content = null) {

	$atts = shortcode_atts(array(
		'direction' => 'title-moving-forward',
		'extra_class_name' => ''
	), $atts );
	
	$out = '<div class="title-moving-outer ' . sanitize_html_class( $atts['extra_class_name'] ) . '">';
	$out .= '<h1 class="' . esc_attr( $atts['direction'] ) . '">' . wp_kses_post( $content ) . '</h1>';
	$out .= '</div>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Moving Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_moving_gallery', 'shortcode_clapat_moving_gallery');
function shortcode_clapat_moving_gallery($atts, $content = null) {

	$atts = shortcode_atts( array(
								'direction' => 'fw-gallery',
								'randomize' => 'no',
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="moving-gallery ' . $atts['direction'];
	if( $atts['randomize'] == 'yes' ){
		
		$str .= ' random-sizes';
	}
	$str .= ' ' . $atts['extra_class_name'] . '">';
	$str .= '<ul class="wrapper-gallery">';
	$str .= do_shortcode( $content );
	$str .= '</ul>';
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_moving_gallery_image', 'shortcode_clapat_moving_gallery_image');
function shortcode_clapat_moving_gallery_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'    => ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Moving gallery image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$str = '<li>';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</li>';

	return $str;

}

//////////////////////////////////////////////////////////////////
// Horizontal Scrolling Panels
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_scrolling_panels', 'shortcode_clapat_scrolling_panels');
function shortcode_clapat_scrolling_panels($atts, $content = null) {

	$atts = shortcode_atts( array(
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="panels';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	$str .= '<div class="panels-container">';
	$str .= do_shortcode( $content );
	$str .= '</div>';
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_scrolling_panels_image', 'shortcode_clapat_scrolling_panels_image');
function shortcode_clapat_scrolling_panels_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'    => ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Scrolling panels image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$str = '<div class="panel">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</div>';

	return $str;

}

//////////////////////////////////////////////////////////////////
// Zoom Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_zoom_gallery', 'shortcode_clapat_zoom_gallery');
function shortcode_clapat_zoom_gallery($atts, $content = null) {

	$atts = shortcode_atts( array(
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="zoom-gallery';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	$str .= '<ul class="zoom-wrapper-gallery">';
	$str .= do_shortcode( $content );
	$str .= '</ul>';
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_zoom_gallery_image', 'shortcode_clapat_zoom_gallery_image');
function shortcode_clapat_zoom_gallery_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'	=> '',
		'zoom'	=> 'no'
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Zoom gallery image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	if( $atts['zoom'] == 'yes' ){
	
		$str = '<li class="zoom-center">';
	}
	else {
		
		$str = '<li>';
	}
	$str .= '<div class="zoom-img-wrapper">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</div>';
	$str .= '</li>';

	return $str;

}

//////////////////////////////////////////////////////////////////
// Slowed Text Pin
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_slowed_text_pin', 'shortcode_clapat_slowed_text_pin');
function shortcode_clapat_slowed_text_pin( $atts, $content = null ) {

	$atts = shortcode_atts( array(
								'extra_class_name' => '',
								'pre_title_text' => '',
								'title_text' => '',
								'subtitle_text' => ''
							), $atts );

	$str = '<div class="slowed-pin';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	$str .= '<div class="slowed-text">';
	$str .= '<h5>' . wp_kses_post( $atts[ pre_title_text ] ) . '</h5>';
	$str .= '<h1 class="big-title">' . wp_kses_post( $atts[ title_text ] ) . '</h1>';
	$str .= '<hr>';
	$str .= '<h5>' . wp_kses_post( $atts[ subtitle_text ] ) . '</h5>';
	$str .= '</div>';
	$str .= '<div class="slowed-images">';
	$str .= do_shortcode( $content );
	$str .= '</div>';
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_slowed_text_pin_image', 'shortcode_clapat_slowed_text_pin_image');
function shortcode_clapat_slowed_text_pin_image( $atts, $content = null ) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Slowed text pin gallery image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$str = '<div class="slowed-image">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</div>';
	
	return $str;

}

//////////////////////////////////////////////////////////////////
// Pinned Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_pinned_gallery', 'shortcode_clapat_pinned_gallery');
function shortcode_clapat_pinned_gallery($atts, $content = null) {

	$atts = shortcode_atts( array(
								'randomize' => 'no',
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="pinned-gallery';
	if( $atts['randomize'] == 'yes' ){
		
		$str .= ' random-img-ratation';
	}
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	$str .= do_shortcode( $content );
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_pinned_gallery_image', 'shortcode_clapat_pinned_gallery_image');
function shortcode_clapat_pinned_gallery_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Pinned gallery image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$str = "";
	$str .= '<div class="pinned-image">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</div>';
	
	return $str;

}

//////////////////////////////////////////////////////////////////
// Reveal Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_reveal_gallery', 'shortcode_clapat_reveal_gallery');
function shortcode_clapat_reveal_gallery($atts, $content = null) {

	$atts = shortcode_atts(array(
		'left_img_url'		=> '',
		'left_img_id'  		=> '',
		'center_img_url'	=> '',
		'center_img_id'    	=> '',
		'right_img_url'		=> '',
		'right_img_id'  	=> '',
		'extra_class_name'	=> ''
	), $atts );

	$out = "";
	
	$left_img_url = clapat_core_get_image_url($atts['left_img_id'], $atts['left_img_url']);
	$center_img_url = clapat_core_get_image_url($atts['center_img_id'], $atts['center_img_url']);
	$right_img_url = clapat_core_get_image_url($atts['right_img_id'], $atts['right_img_url']);
	
	if( empty( $atts['left_img_id'] ) ){
		$left_alt_text = "Reveal gallery image";
	}
	else{
		$left_alt_text = trim( strip_tags( get_post_meta( $atts['left_img_id'], '_wp_attachment_image_alt', true ) ) );
	}
	
	if( empty( $atts['center_img_id'] ) ){
		$center_alt_text = "Reveal gallery image";
	}
	else{
		$center_alt_text = trim( strip_tags( get_post_meta( $atts['center_img_id'], '_wp_attachment_image_alt', true ) ) );
	}
	
	if( empty( $atts['right_img_id'] ) ){
		$right_alt_text = "Reveal gallery image";
	}
	else{
		$right_alt_text = trim( strip_tags( get_post_meta( $atts['right_img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$out = '<div class="reveal-gallery';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$out .= ' ' . $atts['extra_class_name'];
	}
	$out .= '">';
	
	// Left image
	$out .= '<div class="reveal-img">';
	$out .= '<img src="' . esc_url ( $left_img_url ) . '" alt="' . esc_attr( $left_alt_text ) . '" />';
	$out .= '</div>';
	// Center image
	$out .= '<div class="reveal-img-fixed">';
	$out .= '<img src="' . esc_url ( $center_img_url ) . '" alt="' . esc_attr( $center_alt_text ) . '" />';
	$out .= '</div>';
	// Right image
	$out .= '<div class="reveal-img">';
	$out .= '<img src="' . esc_url ( $right_img_url ) . '" alt="' . esc_attr( $right_alt_text ) . '" />';
	$out .= '</div>';
	
	$out .= '</div>';
	
	return $out;
}
/* End Typo Elements */


/* Elements */

//////////////////////////////////////////////////////////////////
// Accordion
//////////////////////////////////////////////////////////////////
add_shortcode('accordion', 'shortcode_accordion');
function shortcode_accordion($atts, $content = null) {
	
	$atts = shortcode_atts( array(
							'type' => 'small-acc',
							'animation' => false,
							'animation_delay' => '0',
							'extra_class_name' => ''
							), $atts );

	$str = '<dl class="accordion ' . $atts['type'];
	
	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	if( $clapat_animation ){
		
		$str .= ' has-animation';
	}
	$str .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$str .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$str .= '>';
	
	$str .= do_shortcode( $content );
	$str .= '</dl>';

	return $str;
}

add_shortcode('accordion_item', 'shortcode_accordion_item');
function shortcode_accordion_item($atts, $content = null) {

	$atts = shortcode_atts(
					array(
					'title' => ''
					), $atts );

	$str = '<dt>';
	$str .= '<span class="link">' .  wp_kses_post( $atts['title'] ) . '</span>';
	$str .= '<div class="acc-icon-wrap parallax-wrap">';
	$str .= '<div class="acc-button-icon parallax-element">';
	$str .= '<i class="fa fa-arrow-right"></i>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</dt>';
	$str .= '<dd class="accordion-content">' . do_shortcode( $content ) . '</dd>';

	return $str;
}

//////////////////////////////////////////////////////////////////
// List Rotator
//////////////////////////////////////////////////////////////////
add_shortcode('list_rotator', 'shortcode_list_rotator');
function shortcode_list_rotator($atts, $content = null) {
	
	$atts = shortcode_atts( array(
							'title' => '',
							'extra_class_name' => ''
							), $atts );

	$str = '<div class="list-rotator-wrapper';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	
    $str .= '<div class="list-rotator-title has-mask-fill">' . wp_kses_post( $atts['title'] ) . '</div>';
	$str .= '<div class="list-rotator-height">';
	$str .= '<div class="list-rotator-pin">';
	$str .= '<ul class="list-rotator">';
	$str .= do_shortcode( $content );
	$str .= '</ul>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';
	return $str;
}

add_shortcode('list_rotator_item', 'shortcode_list_rotator_item');
function shortcode_list_rotator_item($atts, $content = null) {

	$atts = shortcode_atts(
					array(), $atts );

	$str = '<li>' . do_shortcode( $content ) . '</li>';

	return $str;
}

//////////////////////////////////////////////////////////////////
// Moving Thumbs Grid
//////////////////////////////////////////////////////////////////
add_shortcode('moving_thumbs_grid', 'shortcode_moving_thumbs_grid');
function shortcode_moving_thumbs_grid($atts, $content = null) {
	
	$atts = shortcode_atts( array(
							'title' => '',
							'extra_class_name' => ''
							), $atts );

	$str = '<div class="<div class="move-thumbs-wrapper';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	
	// Title
	$str .= '<div class="start-thumbs-caption">';
	$str .= wp_kses_post( $atts['title'] );
	$str .= '</div>';
	
	$str .= '<div class="start-thumbs-wrapper">';
	$str .= do_shortcode( $content );
	$str .= '</div>';
	
	$str .= '</div>';
	return $str;
}

add_shortcode('moving_thumbs_grid_image', 'shortcode_moving_thumbs_grid_image');
function shortcode_moving_thumbs_grid_image($atts, $content = null) {

	$atts = shortcode_atts(array(
								'img_url'	=> '',
								'img_id'    => ''
							), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		
		$alt_text = "Move thumbs grid image";
	}
	else{
		
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$str = '<div class="start-move-thumb">';
	$str .= '<div class="move-thumb-inner">';
	$str .= '<div class="section-image">';
	$str .= '<img class="item-image" src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';

	return $str;
}

//////////////////////////////////////////////////////////////////
// Flex List
//////////////////////////////////////////////////////////////////
add_shortcode('flex_list', 'shortcode_flex_list');
function shortcode_flex_list($atts, $content = null) {
	
	$atts = shortcode_atts( array(
							'extra_class_name' => ''
							), $atts );

	$str = '<ul class="flex-lists-wrapper';
	if( !empty( $atts['extra_class_name'] ) ){
		
		$str .= ' ' . $atts['extra_class_name'];
	}
	$str .= '">';
	
	$str .= do_shortcode( $content );
		
	$str .= '</ul>';
	return $str;
}

add_shortcode('flex_list_item', 'shortcode_flex_list_item');
function shortcode_flex_list_item($atts, $content = null) {

	$atts = shortcode_atts( array(
							'first_column' => '',
							'second_column' => '',
							'third_column' => ''
							), $atts );
							
	$str = '<li class="flex-list link has-animation">';
	$str .= '<span class="flex-list-left">' . wp_kses_post( $atts['first_column'] ) . '</span>';
    $str .= '<span class="flex-list-center">' . wp_kses_post( $atts['second_column'] ) . '</span>';
    $str .= '<span class="flex-list-right">' . wp_kses_post( $atts['third_column'] ) . '</span>';
	$str .= '</li>';

	return $str;
}

//////////////////////////////////////////////////////////////////
// Collage
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_collage', 'shortcode_clapat_collage');
function shortcode_clapat_collage($atts, $content = null) {

	$atts = shortcode_atts( array(
								'extra_class_name' => ''
							), $atts );
							
	$str = '<div class="justified-grid ' . $atts['extra_class_name'] . '">';
	$str .= do_shortcode( $content );
	$str .= '</div>';

	return $str;
}

add_shortcode('clapat_collage_image', 'shortcode_clapat_collage_image');
function shortcode_clapat_collage_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'thumb_img_url'	=> '',
		'thumb_img_id'	=> '',
		'img_url'	=> '',
		'img_id'	=> '',
		'alt'		=> '',
		'info' => ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	$thumb_img_url = clapat_core_get_image_url($atts['thumb_img_id'], $atts['thumb_img_url']);

	$str = '<div class="collage-thumb">';
	$str .= '<a class="image-link" href="' . esc_url( $img_url ) . '">';
	$str .= '<img src="' . esc_url( $thumb_img_url ) . '" alt="' . esc_attr( $atts['alt'] ) . '" />';
	$str .= '<div class="thumb-info">' . wp_kses_post( $atts['info'] ) . '</div>';
	$str .= '</a>';
	$str .= '</div>';

	return $str;

}

//////////////////////////////////////////////////////////////////
// Self Hosted Video
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_video', 'shortcode_clapat_video');
function shortcode_clapat_video($atts, $content = null) {

	$atts = shortcode_atts(array(
		'cover_img_url'	=> '',
		'cover_img_id'	=> '',
		'webm_url'    => '',
		'mp4_url'	=> '',
		'extra_class_name' => ''
	), $atts );

	$cover_img_url = clapat_core_get_image_url($atts['cover_img_id'], $atts['cover_img_url']);
	
	$str = '<!-- Video Player -->';
	$str .= '<div class="video-wrapper ' . $atts['extra_class_name'] . '">';
	$str .= '<div class="video-cover" data-src="' . esc_url( $cover_img_url ) . '"></div>';
	$str .= '<video class="bgvid" controls preload="auto" >';
	if( !empty( $atts['webm_url'] ) ){
	$str .= '<source src="' . esc_url( $atts['webm_url'] ) . '" />';
	}
	if( !empty( $atts['mp4_url'] ) ){
	$str .= '<source src="' . esc_url( $atts['mp4_url'] ) . '" />';
	}
	$str .= '</video>';

	$str .= '<div class="control">';
	$str .= '<div class="btmControl">';
	$str .= '<div class="progress-bar">';
	$str .= '<div class="progress">';
	$str .= '<span class="bufferBar"></span>';
	$str .= '<span class="timeBar"></span>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '<div class="video-btns">';
	$str .= '<div class="sound sound2 btn" title="Mute/Unmute sound">';
	$str .= '<i class="fa fa-volume-up" aria-hidden="true"></i>';
	$str .= '<i class="fa fa-volume-off" aria-hidden="true"></i>';
	$str .= '</div>';
	$str .= '<div class="btnFS btn" title="Switch to full screen">';
	$str .= '<i class="fa fa-expand" aria-hidden="true"></i>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';

	$str .= '</div>';                    
	$str .= '<!--/Video Player -->';

	return $str;

}

/* End Elements */


/* Sliders */

//////////////////////////////////////////////////////////////////
// General Slider
//////////////////////////////////////////////////////////////////
add_shortcode('general_slider', 'shortcode_general_slider');
function shortcode_general_slider($atts, $content = null) {

	$atts = shortcode_atts( array(
								'slider_dots' => 'yes',
								'autocenter' => 'yes',
								'cursor' => 'light-cursor',
								'animation' => false,
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="clapat-slider-wrapper content-slider'; 
	if( $atts['animation'] ){
		
		$str .= 'has-animation'; 
	}
	if( $atts['slider_dots'] == 'no' ){
		
		$str .= ' disabled-slider-dots';
	}
	if( $atts['autocenter'] == 'no' ){
		
		$str .= ' autocenter';
	}
	$str .= ' ' . $atts['cursor'];
	$str .= '<div class="clapat-slider">';
	$str .= '<div class="clapat-slider-viewport">';
	$str .= do_shortcode( $content ); 
	$str .= '</div>';
	$str .= '</div>';
                                    
	$str .= '<div class="clapat-controls">';
	$str .= '<div class="clapat-button-next slider-button-next"></div>';
	$str .= '<div class="clapat-button-prev slider-button-prev"></div>';
	$str .= '<div class="clapat-pagination"></div>';
	$str .= '</div>';
	$str .= '</div>';
	
	return $str;
}

add_shortcode('general_slide', 'shortcode_general_slide');
function shortcode_general_slide($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'    => '',
		'alt'       => '',
	), $atts );

	$str = "";
	
	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	if( empty( $img_url ) ){
		
		return $str;
	}
	$str = '<div class="clapat-slide">';
	$str .= '<div class="slide-img">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $atts['alt'] ) . '" />';
	$str .= '</div>';
	$str .= '</div>';

	return $str;
}

//////////////////////////////////////////////////////////////////
// Carousel Slider
//////////////////////////////////////////////////////////////////
add_shortcode('carousel_slider', 'shortcode_carousel_slider');
function shortcode_carousel_slider($atts, $content = null) {

	$atts = shortcode_atts( array(
								'slider_dots' => 'yes',
								'size' => 'looped-carousel',
								'autocenter' => 'yes',
								'cursor' => 'light-cursor',
								'animation' => false,
								'extra_class_name' => ''
							), $atts );

	$str = '<div class="clapat-slider-wrapper content-slider'; 
	$str .= ' ' . $atts['size'];
	if( $atts['animation'] ){
		
		$str .= ' has-animation'; 
	}
	if( $atts['slider_dots'] == 'no' ){
		
		$str .= ' disabled-slider-dots';
	}
	if( $atts['autocenter'] == 'no' ){
		
		$str .= ' autocenter';
	}
	$str .= ' ' . $atts['cursor'];
	$str .= '<div class="clapat-slider">';
	$str .= '<div class="clapat-slider-viewport">';
	$str .= do_shortcode( $content ); 
	$str .= '</div>';
	$str .= '</div>';
                                    
	$str .= '<div class="clapat-controls">';
	$str .= '<div class="clapat-button-next slider-button-next"></div>';
	$str .= '<div class="clapat-button-prev slider-button-prev"></div>';
	$str .= '<div class="clapat-pagination"></div>';
	$str .= '</div>';
	$str .= '</div>';
	
	return $str;
}

add_shortcode('carousel_slide', 'shortcode_carousel_slide');
function shortcode_carousel_slide($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'    => '',
		'alt'       => '',
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	$str = "";
	if( empty( $img_url ) ){
		
		return $str;
	}
	$str = '<div class="clapat-slide">';
	$str .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $atts['alt'] ) . '" />';
	$str .= '</div>';

	return $str;
}
/* End Sliders */

/* Google Map */
add_shortcode('clapat_map', 'shortcode_clapat_map');
function shortcode_clapat_map($atts, $content = null) {

	$str = '<!-- Map -->';
	$str .= '<div id="map_canvas"></div>';
	$str .= '<!--/Map -->';

	return $str;
}
/* End Google Map */


//////////////////////////////////////////////////////////////////
// Icon Box
//////////////////////////////////////////////////////////////////
add_shortcode('icon_box', 'shortcode_icon_box');
function shortcode_icon_box($atts, $content = null) {

	$atts = shortcode_atts( array(
								'title' => '',
								'icon' => '',
								'type' => 'inline-boxes',
								'extra_class_name' => ''
							), $atts );

	$out = '';

	$out .= '<div class="box-icon-wrapper ' . sanitize_html_class( $atts['type'] ) . ' ' . esc_attr( $atts['extra_class_name'] ) . '">';
	$out .= '<div class="box-icon">';
	$out .= '<i class="' . wp_kses_post( $atts['icon'] ) . ' fa-2x" aria-hidden="true"></i>';
	$out .= '</div>';
	$out .= '<div class="box-icon-content">';
	$out .= '<h6 class="no-margins">' . do_shortcode( $content ) . '</h6>';
	$out .= '<p>' . wp_kses_post( $atts['title'] ) . '</p>';
	$out .= '</div>';
	$out .= '</div>';
	
	return $out;
	
}

//////////////////////////////////////////////////////////////////
// Counter
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_counter', 'shortcode_clapat_counter');
function shortcode_clapat_counter($atts, $content = null) {

	$atts = shortcode_atts(array(
		'data_start'		=> '1000',
		'data_target'		=> '3000',
		'data_symbol'	=> '',
		'text_size'			=> 'h1',
		'animation' 		=> false,
		'animation_delay' 	=> '0',
		'extra_class_name' 	=> ''
	), $atts );

	$clapat_animation = false;
	if( !empty( $atts['animation'] ) ){
		
		$clapat_animation = $atts['animation'];
	}
	
	$out = '<' . esc_attr( $atts['text_size'] ) . ' class="number-counter no-margins';
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= ' data-target="' . esc_attr( $atts['data_target'] ) . '"  data-symbol="' . esc_attr( $atts['data_symbol'] ) . '">' . esc_attr( $atts['data_start'] ) . '</' . esc_attr( $atts['text_size'] ) . '>';
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Clipped Image
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_clipped_image', 'shortcode_clapat_clipped_image');
function shortcode_clapat_clipped_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'			=> '',
		'img_id'				=> '',
		'video_url'			=> '',
		'text_size'			=> 'h2',
		'text_color'		=> '#0c0c0c',
		'extra_class_name' 	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		$alt_text = "clipped image";
	}
	else{
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$out = '<div class="clipped-image-wrapper';
	if( !empty( $atts['extra_class_name'] ) ){

		$out .= ' ' . $atts['extra_class_name'];
	}
	$out .= '">';
	
	
	$out .= '<div class="clipped-image-pin">';
	$out .= '<div class="clipped-image">';
	$out .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '">';

	if( !empty( trim( $atts['video_url'] ) ) ){

		$out .= '<div class="content-video-wrapper">';
		$out .= '<video loop muted playsinline class="bgvid">';
		$out .= '<source src="' . esc_url( $atts['video_url'] ) . '" type="video/mp4">';
		$out .= '</video>';
		$out .= '</div>';
	}
											
	$out .= '<div class="clipped-image-gradient"></div>';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '<div class="clipped-image-content text-align-center content-full-width" data-bgcolor="' . esc_attr( $atts['text_color'] ) . '">';
	$out .= '<' . $atts['text_size'] . ' class="has-mask-fill">';
	$out .= do_shortcode( $content );
	$out .= '</' . $atts['text_size'] . '>';
	$out .= '</div>';
	
	$out .= '<div>';	
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Parallax Image
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_parallax_image', 'shortcode_clapat_parallax_image');
function shortcode_clapat_parallax_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'			=> '',
		'img_id'				=> '',
		'video_url'			=> '',
		'text_size'			=> 'h1',
		'caption_alignment' => 'text-align-center',
		'animation' 		=> false,
		'animation_delay' 	=> '0',
		'extra_class_name' 	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		$alt_text = "parallax image";
	}
	else{
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	$out = '<figure class="has-parallax has-parallax-content';
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	
	$out .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '">';
	if( !empty( $atts['video_url'] ) ){
		
		$out .= '<div class="content-video-wrapper">';
		$out .= '<video loop muted playsinline class="bgvid">';
		$out .= '<source src="' . esc_url( $atts['video_url'] ) . '" type="video/mp4">';
		$out .= '</video>';
		$out .= '</div>';
	}
	$out .= '<div class="parallax-image-content content-max-width ' . esc_attr( $atts['caption_alignment'] ) . '">';
	$out .= '<div class="outer">';
	$out .= '<div class="inner">';
	$out .= '<' . $atts['text_size'] . ' class="has-mask">';
	$out .= do_shortcode( $content );
	$out .= '</' . $atts['text_size'] . '>';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</figure>';
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Pinned Section
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_pinned_section', 'shortcode_clapat_pinned_section');
function shortcode_clapat_pinned_section($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'			=> '',
		'img_id'			=> '',
		'img_alignment' 	=> 'right',
		'animation' 		=> false,
		'animation_delay' 	=> '0',
		'extra_class_name' 	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['img_id'] ) ){
		$alt_text = "Pinned section image";
	}
	else{
		$alt_text = trim( strip_tags( get_post_meta( $atts['img_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	$out = '<div class="pinned-section';
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	
	$pinned_element_class = "pinned-element";
	$scrolling_element_class = "scrolling-element";
	$html_scrolling_image = '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $alt_text ) . '">';
	
	// Left panel
	$out .= '<div class="left ';
	if( $atts['img_alignment'] == 'left' ) {
		
		$out .= $scrolling_element_class;
		$out .= '">';
		$out .= $html_scrolling_image;
	}
	else {

		$out .= $pinned_element_class;
		$out .= '">';
		$out .= do_shortcode( $content );
	}
	$out .= '</div>';
	
	// Right panel
	$out .= '<div class="right ';
	if( $atts['img_alignment'] == 'right' ) {

		$out .= $scrolling_element_class;
		$out .= '">';
		$out .= $html_scrolling_image;
	}
	else {
		
		$out .= $pinned_element_class;
		$out .= '">';
		$out .= do_shortcode( $content );
	}
	$out .= '</div>';
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Popup Image & Video
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_popup_image', 'shortcode_clapat_popup_image');
function shortcode_clapat_popup_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'thumb_url'		=> '',
		'thumb_id'  	=> '',
		'img_url'		=> '',
		'img_id'    	=> '',
		'animation' 	=> 'none',
		'animation_delay' => '0',
		'parallax'		=> 'no',
		'start_parallax' => '0.0',
		'end_parallax'	=> '0.0',
		'extra_class_name' => ''
	), $atts );

	$out = "";
	
	if( $atts['parallax'] == 'yes' ){
		
		$out .= '<div class="vertical-parallax" data-startparallax="' . esc_attr( $atts['start_parallax'] ) . '" data-endparallax="' . esc_attr( $atts['end_parallax'] ) . '">';
	}
	
	$thumb_url = clapat_core_get_image_url($atts['thumb_id'], $atts['thumb_url']);
	$img_url = clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	if( empty( $atts['thumb_id'] ) ){
		$alt_text = "popup image";
	}
	else{
		$alt_text = trim( strip_tags( get_post_meta( $atts['thumb_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$clapat_image_caption = wp_get_attachment_caption( $atts['thumb_id'] );

	$clapat_animation = $atts['animation'];
	$clapat_animation_delay = $atts['animation_delay'];
	
	$out .= '<figure class="';
	if( $clapat_animation == "fade" ){
		
		$out .= 'has-animation';
	}
	else if( $clapat_animation == "cover" ){
		
		$out .= 'has-animation has-cover';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation != "none" ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	$out .= '<a class="image-link" href="' . esc_url( $img_url ) . '">';
	$out .= '<img src="' . esc_url ( $thumb_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$out .= '</a>';
	$out .= '<figcaption>' . wp_kses_post( $clapat_image_caption ) . '</figcaption>';
	$out .= '</figure>';

	if( $atts['parallax'] == 'yes' ){
		
		$out .= '</div>';
	}
	
	return $out;
}

add_shortcode('clapat_popup_video', 'shortcode_clapat_popup_video');
function shortcode_clapat_popup_video($atts, $content = null) {

	$atts = shortcode_atts(array(
		'thumb_url'		=> '',
		'thumb_id'  	=> '',
		'video_url'		=> '',
		'animation' 	=> 'none',
		'animation_delay' => '0',
		'extra_class_name' => ''
	), $atts );

	$thumb_url = clapat_core_get_image_url($atts['thumb_id'], $atts['thumb_url']);
	
	if( empty( $atts['thumb_id'] ) ){
		$alt_text = "popup video thumbnail image";
	}
	else{
		$alt_text = trim( strip_tags( get_post_meta( $atts['thumb_id'], '_wp_attachment_image_alt', true ) ) );
	}

	$clapat_image_caption = wp_get_attachment_caption( $atts['thumb_id'] );

	$clapat_animation = $atts['animation'];
	$clapat_animation_delay = $atts['animation_delay'];
	
	$out = '<figure class="';
	if( $clapat_animation == "fade" ){
		
		$out .= 'has-animation';
	}
	else if( $clapat_animation == "cover" ){
		
		$out .= 'has-animation has-cover';
	}
	$out .= ' ' . $atts['extra_class_name'] . '"';
	if( $clapat_animation != "none" ){
		
		$out .= ' data-delay="'. $atts['animation_delay'] . '"';
	}
	$out .= '>';
	$out .= '<a class="video-link" href="' . esc_url( $atts['video_url'] ) . '">';
	$out .= '<img src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( $alt_text ) . '" />';
	$out .= '</a>';
	$out .= '</figure>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Captioned Image
//////////////////////////////////////////////////////////////////
add_shortcode('clapat_captioned_image', 'shortcode_clapat_captioned_image');
function shortcode_clapat_captioned_image($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'		=> '',
		'alt'			=> '',
		'caption'	=> '',
		'extra_class_name' => ''
	), $atts );

	$img_url 	= clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
						
	$out = '';
	$out .= '<figure class="wp-block-image ' . esc_attr( $atts['extra_class_name'] ) . '">';
	$out .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $atts['alt'] ) . '" />';
	$out .= '<figcaption>' . wp_kses_post( $atts['caption'] ) . '</figcaption>';
	$out .= '</figure>';

	return $out;
}

//////////////////////////////////////////////////////////////////
// Team Members
//////////////////////////////////////////////////////////////////
add_shortcode('team_members', 'shortcode_team_members');
function shortcode_team_members($atts, $content = null) {

	$atts = shortcode_atts(array(
		'extra_class_name' => ''
	), $atts );
	
	$out = '<ul class="team-members-list ' . esc_attr( $atts['extra_class_name'] ) . '" data-fx="1">';
	$out .= do_shortcode( $content );
	$out .= '</ul>';

	return $out;
}

add_shortcode('team_member', 'shortcode_team_member');
function shortcode_team_member($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'	=> '',
		'img_id'    => '',
		'since' 		=> '',
		'name' 		=> '',
		'position' 	=> ''
	), $atts );

	$img_url = clapat_core_get_image_url( $atts['img_id'], $atts['img_url'] );

	$out = '';

	$out .= '<li class="link has-hover-image" data-img="' . esc_url( $img_url ) . '">';
	$out .= '<div class="team-member has-animation"><span>' . wp_kses_post( $atts['since'] ) . '</span><div class="primary-font-title">' . wp_kses_post( $atts['name'] ) . '</div><span>' . wp_kses_post( $atts['position'] ) . '</span></div>';
	$out .= '</li>';
		
	return $out;
}
// end team members

//////////////////////////////////////////////////////////////////
// Clients
//////////////////////////////////////////////////////////////////
add_shortcode('clients', 'shortcode_clients');
function shortcode_clients($atts, $content = null) {

	$atts = shortcode_atts(array(
		'has_borders'   => 'yes',
		'animation' 	=> 'none',
		'animation_delay' => '0',
		'extra_class_name' => ''
	), $atts );
	
	$clapat_animation = $atts['animation'];
	if( $clapat_animation == 'no'){
		
		$clapat_animation = false;
	}
	
	$clapat_has_borders = $atts['has_borders'];
	if( $clapat_has_borders == 'no'){
		
		$clapat_has_borders = false;
	}
	
	$out = '<ul class="clients-table';
	if( $clapat_has_borders ){
		
		$out .= ' has-borders';
	}
	if( $clapat_animation ){
		
		$out .= ' has-animation';
	}
	$out .= ' ' . esc_attr( $atts['extra_class_name'] ) . '"';
	if( $clapat_animation ){
		
		$out .= ' data-delay="'. esc_attr( $atts['animation_delay'] ) . '"';
	}
	$out .= '>';
	$out .= do_shortcode( $content );
	$out .= '</ul>';

	return $out;
}

add_shortcode('client_item', 'shortcode_client_item');
function shortcode_client_item($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'		=> '',
		'img_id'    	=> '',
		'client_url'	=> ''
	), $atts );

	$img_url 	= clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	$client_url = $atts['client_url'];
	
	$out = '';
	$out .= '<li class="link">';
	if( !empty( $client_url ) ){
	
		$out .= '<a target="_blank" href="' . esc_url( $client_url ) . '">';
	}
	$out .= '<img src="' . esc_url( $img_url ) . '" alt="client image" />';
	$out .= '<div class="overlay"></div>';
	if( !empty( $client_url ) ){
		
		$out .= '</a>';
	}
	$out .= '</li>';

	return $out;
	
}

add_shortcode('clapat_clients_moving_gallery_item', 'shortcode_clients_moving_gallery_item');
function shortcode_clients_moving_gallery_item($atts, $content = null) {

	$atts = shortcode_atts(array(
		'img_url'		=> '',
		'img_id'    	=> '',
		'client_name'	=> '',
		'client_url'	=> ''
	), $atts );

	$img_url 	= clapat_core_get_image_url($atts['img_id'], $atts['img_url']);
	
	$client_url = $atts['client_url'];
	$client_name = $atts['client_name'];
	
	$out = '';
	$out .= '<li class="link">';
	if( !empty( $client_url ) ){
	
		$out .= '<a target="_blank" href="' . esc_url( $client_url ) . '">';
	}
	$out .= '<img src="' . esc_url( $img_url ) . '" alt="client image" />';
	if( !empty( $client_url ) ){
		
		$out .= '</a>';
	}
	if( !empty( $client_name ) ){
		
		$out .= '<div class="moving-gallery-caption">' . wp_kses_post( $client_name ) . '</div>';
	}
	$out .= '</li>';

	return $out;
	
}
// end testimonials

//////////////////////////////////////////////////////////////////
// Portfolio Grid
//////////////////////////////////////////////////////////////////
if ( ! class_exists( 'Montoya_Portfolio_Item' ) ) {

	class Montoya_Portfolio_Item {
		
		public $post_id;
	}
}

add_shortcode('montoya_portfolio_grid', 'shortcode_montoya_portfolio_grid');
function shortcode_montoya_portfolio_grid($atts, $content = null) {

	$atts = shortcode_atts(array(
		'items_no'				=> '',
		'filter_category'			=> '',
		'thumbs_effect'			=> 'webgl-fitthumbs',
		'thumbs_effect_webgl'	=> 'fx-one',
	), $atts );

	$montoya_portfolio_tax_query = null;
	$montoya_portfolio_category_filter = $atts['filter_category'];

	$montoya_portfolio_thumb_to_fullscreen = $atts['thumbs_effect'];
	$montoya_portfolio_thumb_webgl = $atts['thumbs_effect_webgl'];
	$montoya_enable_ajax = false;
	if( function_exists( 'montoya_get_theme_options' ) ){
		
		$montoya_enable_ajax = montoya_get_theme_options( 'clapat_montoya_enable_ajax' );
	}
		
	if( !$montoya_enable_ajax ){
		
		$montoya_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
	}

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

	$out = "";
	
	// add the wrapper links divs only if they don't exist already in the page, otherwise it will inherit the existing divs
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
	
		$out .=	'<!-- Showcase List Holder -->';
		$out .=	'<div id="itemsWrapperLinks">';
		$out .=	'<!-- Showcase List -->';
		$out .=	'<div id="itemsWrapper" class="' .  sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen ) . ' ' . sanitize_html_class( $montoya_portfolio_thumb_webgl ) . '">';
	}
	
	$out .= '<!-- ClaPat Portfolio -->';
	$out .= '<div class="showcase-portfolio">';
	
	$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$montoya_items_no = 1000;
	if( !empty( $atts['items_no'] ) ){
	
		$montoya_items_no = $atts['items_no'];
	}
	
	$montoya_args = array(
									'post_type' => 'montoya_portfolio',
									'paged' => $montoya_paged,
									'tax_query' => $montoya_portfolio_tax_query,
									'posts_per_page' => $montoya_items_no
									 );

	$montoya_portfolio = new WP_Query( $montoya_args );

	$montoya_portfolio_items = array();
	
	$montoya_current_item_count = 1;
	while( $montoya_portfolio->have_posts() ){

		$montoya_portfolio->the_post();
		
		$montoya_portfolio_item = new Montoya_Portfolio_Item();
		$montoya_portfolio_item->post_id = get_the_ID();
		$montoya_portfolio_items[] = $montoya_portfolio_item;

		$full_image = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-img' );
		$montoya_background_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color' );
		$montoya_background_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color-code' );
		$title_row = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-title' );
		$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
		$montoya_item_title		= "";
		foreach( $title_list as $title_bit ){

			$montoya_item_title .= '<span>' . $title_bit . '</span>';
		}
		$subtitle_row 			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-subtitle' );
		$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
		$montoya_item_subtitle	= "";
		foreach( $subtitle_list as $subtitle_bit ){

			$montoya_item_subtitle .= '<span>' . $subtitle_bit . '</span>';
		}
		$montoya_background_navigation 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-navigation-cursor-color' );
		$montoya_page_caption_first_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_first' );
		$montoya_page_caption_second_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_second' );
		$montoya_project_year	=  montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-project-year' );
		
		if( $full_image && isset( $full_image['url'] ) ){

			$montoya_item_classes = '';
					
			$montoya_item_categories 	= '';
			$montoya_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
			if($montoya_item_cats){

				foreach($montoya_item_cats as $item_cat) {
					
					$montoya_item_classes 	.= $item_cat->slug . ' ';
					$montoya_item_categories 	.= $item_cat->name . ', ';
				}

				$montoya_item_categories = rtrim($montoya_item_categories, ', ');

			}
			
			$montoya_image_alt_text = __('Portfolio Image', 'montoya_core_plugin_text_domain');
			if( !empty( $full_image['id'] ) ){
				
				$montoya_image_alt_text = trim( strip_tags( get_post_meta( $full_image['id'], '_wp_attachment_image_alt', true ) ) );
				
			}
			
			$montoya_curtain_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-curtain-color-code' );
			
			$montoya_change_header = "";
			if( $montoya_background_type  == 'dark-content' ){
									
				$montoya_change_header = "change-header";
			}
	
			$item_url = get_the_permalink();
			
			$out .= '<div class="clapat-item ';
			if( ($montoya_current_item_count % 6 == 2) || ($montoya_current_item_count % 6 == 4) ){
			
				$out .= 'vertical-parallax ';
			}
			$out .= esc_attr( $montoya_item_classes ) . '">';
			$out .= '<div class="slide-inner trigger-item ' . sanitize_html_class( $montoya_change_header ) . '" data-centerLine="' . esc_attr( montoya_get_theme_options('clapat_montoya_open_project_caption') ) . '">';
			$out .= '<div class="img-mask">';
			$out .= '<div class="curtains" data-curtain-color="' . esc_attr( $montoya_curtain_color ) . '">';
			$out .= '<div class="curtain-row"></div>';
			$out .= '</div>';
			$out .= '<a class="slide-link" data-type="page-transition" href="' . esc_url( $item_url ) . '"></a>';
			$out .= '<div class="section-image trigger-item-link">';
			$out .= '<img src="' . esc_url( $full_image['url'] ) . '" class="item-image grid__item-img" alt="' . esc_attr( $montoya_image_alt_text ) . '">';
			if( montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video' ) ){

				$montoya_video_webm_url = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-webm' );
				$montoya_video_mp4_url 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-mp4' );
				
				$out .= '<div class="hero-video-wrapper">';
				$out .= '<video loop muted class="bgvid">';
				if( !empty( $montoya_video_mp4_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_mp4_url ) . '" type="video/mp4">';
				}
				if( !empty( $montoya_video_webm_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_webm_url ) . '" type="video/webm">';
				}
				$out .= '</video>';
				$out .= '</div>';
			}
			$out .= '</div>';
			$out .= '<img class="grid__item-img grid__item-img--large" src="' . esc_url( $full_image['url'] ) . '" alt="' . esc_attr( $montoya_image_alt_text ) . '" />';
			$out .= '</div>';
			$out .= '<div class="slide-caption trigger-item-link-secondary">';
			$out .= '<div class="slide-title">' . wp_kses( $montoya_item_title, 'montoya_allowed_html' ) . '</div>';
			$out .= '<div class="slide-date"><span>' . wp_kses( $montoya_project_year, 'montoya_allowed_html' ) . '</span></div>';
			$out .= '<div class="slide-cat"><span>' . wp_kses( $montoya_item_categories, 'montoya_allowed_html' ) . '</span></div>';
			$out .= '<div class="slide-icon"><i class="arrow-icon-down"></i></div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
            
		}
		
		$montoya_current_item_count++;

	}

	wp_reset_postdata();
	
	if( function_exists( 'montoya_portfolio_thumbs_list' ) ){
		
		// add the portfolio items from the list to the existing items
		$montoya_global_portfolio_items  = montoya_portfolio_thumbs_list();
		if( empty( $montoya_global_portfolio_items ) ){
			
			$montoya_global_portfolio_items = array();
		}
		
		montoya_portfolio_thumbs_list( array_merge($montoya_global_portfolio_items, $montoya_portfolio_items) );
	}
	
	$out .=	 '</div>';
	$out .=	 '<!--/Clapat Portfolio-->';
		
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
		
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List-->';
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List Holder-->';
	}
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Portfolio Overlapping Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('montoya_portfolio_overlapping_gallery', 'shortcode_montoya_portfolio_overlapping_gallery');
function shortcode_montoya_portfolio_overlapping_gallery($atts, $content = null) {

	$atts = shortcode_atts(array(
		'items_no'					=> '',
		'filter_category'			=> '',
		'thumbs_effect'			=> 'webgl-fitthumbs',
		'thumbs_effect_webgl'	=> 'fx-one',
	), $atts );

	$montoya_portfolio_tax_query = null;
	$montoya_portfolio_category_filter = $atts['filter_category'];

	$montoya_portfolio_thumb_to_fullscreen = $atts['thumbs_effect'];
	$montoya_portfolio_thumb_webgl = $atts['thumbs_effect_webgl'];
	$montoya_enable_ajax = false;
	if( function_exists( 'montoya_get_theme_options' ) ){
		
		$montoya_enable_ajax = montoya_get_theme_options( 'clapat_montoya_enable_ajax' );
	}
		
	if( !$montoya_enable_ajax ){
		
		$montoya_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
	}

	$montoya_array_terms = null;
	if( !empty( $montoya_portfolio_category_filter ) ){

		$montoya_array_terms = explode( ",", $montoya_portfolio_category_filter );
		$montoya_portfolio_tax_query = array(
											array(
												'taxonomy'	=> 'portfolio_category',
												'field'		=> 'slug',
												'terms'	=> $montoya_array_terms,
												),
										);
	}

	$out = "";
	
	// add the wrapper links divs only if they don't exist already in the page, otherwise it will inherit the existing divs
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
	
		$out .=	'<!-- Showcase List Holder -->';
		$out .=	'<div id="itemsWrapperLinks">';
		$out .=	'<!-- Showcase List -->';
		$out .=	'<div id="itemsWrapper" class="' .  sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen ) . ' ' . sanitize_html_class( $montoya_portfolio_thumb_webgl ) . '">';
	}
	
	$out .= '<!-- Overlapping Gallery -->';
	$out .= '<div class="overlapping-gallery">';
	
	$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$montoya_items_no = 1000;
	if( !empty( $atts['items_no'] ) ){
	
		$montoya_items_no = $atts['items_no'];
	}
	
	$montoya_args = array(
									'post_type' => 'montoya_portfolio',
									'paged' => $montoya_paged,
									'tax_query' => $montoya_portfolio_tax_query,
									'posts_per_page' => $montoya_items_no
									 );

	$montoya_portfolio = new WP_Query( $montoya_args );

	$montoya_portfolio_items = array();
	
	$montoya_current_item_count = 1;
	while( $montoya_portfolio->have_posts() ){

		$montoya_portfolio->the_post();
		
		$montoya_portfolio_item = new Montoya_Portfolio_Item();
		$montoya_portfolio_item->post_id = get_the_ID();
		$montoya_portfolio_items[] = $montoya_portfolio_item;

		$full_image = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-img' );
		$montoya_background_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color' );
		$montoya_background_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color-code' );
		$title_row = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-title' );
		$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
		$montoya_item_title	= "";
		foreach( $title_list as $title_bit ){

			$montoya_item_title .= '<span>' . $title_bit . '</span>';
		}
		$subtitle_row 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-subtitle' );
		$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
		$montoya_item_subtitle	= "";
		foreach( $subtitle_list as $subtitle_bit ){

			$montoya_item_subtitle .= '<span>' . $subtitle_bit . '</span>';
		}
		$montoya_background_navigation	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-navigation-cursor-color' );
		$montoya_page_caption_first_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_first' );
		$montoya_page_caption_second_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_second' );
		$montoya_project_year	=  montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-project-year' );
		
		if( $full_image && isset( $full_image['url'] ) ){

			$montoya_item_categories 	= '';
			$montoya_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
			if($montoya_item_cats){

				foreach($montoya_item_cats as $item_cat) {
					
					$montoya_item_categories 	.= $item_cat->name . ', ';
				}

				$montoya_item_categories = rtrim($montoya_item_categories, ', ');

			}
			
			$montoya_image_alt_text = __('Portfolio Image', 'montoya_core_plugin_text_domain');
			if( !empty( $full_image['id'] ) ){
				
				$montoya_image_alt_text = trim( strip_tags( get_post_meta( $full_image['id'], '_wp_attachment_image_alt', true ) ) );
				
			}
			
			$item_url = get_the_permalink();
			
			$montoya_change_header = "";
			$montoya_current_page_bknd_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-bknd-color' );
			if( $montoya_background_type  == 'dark-content' ){
									
				$montoya_change_header = " change-header";
			}
			
			$out .= '<div class="overlapping-image">';
			$out .= '<div class="overlapping-image-inner trigger-item' . $montoya_change_header . '" data-centerLine="' . esc_attr( montoya_get_theme_options('clapat_montoya_open_project_caption') ) . '">';
			$out .= '<div class="img-mask">';
			$out .= '<a class="slide-link" data-type="page-transition" href="' . esc_url( $item_url ) . '"></a>';
			$out .= '<div class="section-image trigger-item-link">';
			$out .= '<img src="' . esc_url( $full_image['url'] ) . '" class="item-image grid__item-img" alt="' . esc_attr( $montoya_image_alt_text ) . '">';
			
			if( montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video' ) ){

				$montoya_video_webm_url = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-webm' );
				$montoya_video_mp4_url 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-mp4' );
				
				$out .= '<div class="hero-video-wrapper">';
				$out .= '<video loop muted class="bgvid">';
				if( !empty( $montoya_video_mp4_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_mp4_url ) . '" type="video/mp4">';
				}
				if( !empty( $montoya_video_webm_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_webm_url ) . '" type="video/webm">';
				}
				$out .= '</video>';
				$out .= '</div>';
			}

			$out .= '<img class="grid__item-img grid__item-img--large" src="' . esc_url( $full_image['url'] ) . '" alt="' . esc_attr( $montoya_image_alt_text ) . '" />';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="slide-caption trigger-item-link-secondary">';
			$out .= '<div class="slide-title primary-font-title">' . wp_kses( $montoya_item_title, 'montoya_allowed_html' ) . '</div>';
			$out .= '<div class="slide-date"><span>' . wp_kses( $montoya_project_year, 'montoya_allowed_html' ) . '</span></div>';
			$out .= '<div class="slide-cat"><span>' . wp_kses( $montoya_item_categories, 'montoya_allowed_html' ) . '</span></div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
            
		}
		
		$montoya_current_item_count++;

	}

	wp_reset_postdata();
	
	$out .=	 '</div>';
	$out .=	 '<!--/Overlapping Gallery-->';
		
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
		
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List-->';
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List Holder-->';
	}
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Portfolio Parallax Gallery
//////////////////////////////////////////////////////////////////
add_shortcode('montoya_portfolio_parallax_gallery', 'shortcode_montoya_portfolio_parallax_gallery');
function shortcode_montoya_portfolio_parallax_gallery($atts, $content = null) {

	$atts = shortcode_atts(array(
		'items_no'					=> '',
		'filter_category'			=> '',
		'thumbs_effect'			=> 'webgl-fitthumbs',
		'thumbs_effect_webgl'	=> 'fx-one',
	), $atts );

	$montoya_portfolio_tax_query = null;
	$montoya_portfolio_category_filter = $atts['filter_category'];

	$montoya_portfolio_thumb_to_fullscreen = $atts['thumbs_effect'];
	$montoya_portfolio_thumb_webgl = $atts['thumbs_effect_webgl'];
	$montoya_enable_ajax = false;
	if( function_exists( 'montoya_get_theme_options' ) ){
		
		$montoya_enable_ajax = montoya_get_theme_options( 'clapat_montoya_enable_ajax' );
	}
		
	if( !$montoya_enable_ajax ){
		
		$montoya_portfolio_thumb_to_fullscreen = 'no-fitthumbs';
	}

	$montoya_current_page_bknd_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-page-bknd-color' );
	
	$montoya_array_terms = null;
	if( !empty( $montoya_portfolio_category_filter ) ){

		$montoya_array_terms = explode( ",", $montoya_portfolio_category_filter );
		$montoya_portfolio_tax_query = array(
											array(
												'taxonomy'	=> 'portfolio_category',
												'field'		=> 'slug',
												'terms'	=> $montoya_array_terms,
												),
										);
	}

	$out = "";
	
	// add the wrapper links divs only if they don't exist already in the page, otherwise it will inherit the existing divs
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
	
		$out .=	'<!-- Showcase List Holder -->';
		$out .=	'<div id="itemsWrapperLinks">';
		$out .=	'<!-- Showcase List -->';
		$out .=	'<div id="itemsWrapper" class="' .  sanitize_html_class( $montoya_portfolio_thumb_to_fullscreen ) . ' ' . sanitize_html_class( $montoya_portfolio_thumb_webgl ) . '">';
	}
	
	$out .= '<!-- Parallax Gallery -->';
	$out .= '<div class="snap-slider-holder">';
	$out .= '<div class="snap-slider-container">';
	
	$captions = "";
	$out .= '<div class="snap-slider-images">';
			
	$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$montoya_items_no = 1000;
	if( !empty( $atts['items_no'] ) ){
	
		$montoya_items_no = $atts['items_no'];
	}
	
	$montoya_args = array(
									'post_type' => 'montoya_portfolio',
									'paged' => $montoya_paged,
									'tax_query' => $montoya_portfolio_tax_query,
									'posts_per_page' => $montoya_items_no
									 );

	$montoya_portfolio = new WP_Query( $montoya_args );

	$montoya_portfolio_items = array();
	
	$montoya_current_item_count = 1;
	while( $montoya_portfolio->have_posts() ){

		$montoya_portfolio->the_post();
		
		$montoya_portfolio_item = new Montoya_Portfolio_Item();
		$montoya_portfolio_item->post_id = get_the_ID();
		$montoya_portfolio_items[] = $montoya_portfolio_item;

		$full_image = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-img' );
		$montoya_background_type = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color' );
		$montoya_background_color = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-bknd-color-code' );
		$title_row = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-title' );
		$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
		$montoya_item_title	= "";
		foreach( $title_list as $title_bit ){

			$montoya_item_title .= '<span>' . $title_bit . '</span>';
		}
		$subtitle_row 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-hero-caption-subtitle' );
		$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
		$montoya_item_subtitle	= "";
		foreach( $subtitle_list as $subtitle_bit ){

			$montoya_item_subtitle .= '<span>' . $subtitle_bit . '</span>';
		}
		$montoya_background_navigation	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-navigation-cursor-color' );
		$montoya_page_caption_first_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_first' );
		$montoya_page_caption_second_line	= montoya_get_theme_options( 'clapat_montoya_view_project_caption_second' );
		$montoya_project_year	=  montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-project-year' );
		
		if( $full_image && isset( $full_image['url'] ) ){

			$montoya_item_categories 	= '';
			$montoya_item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
			if($montoya_item_cats){

				foreach($montoya_item_cats as $item_cat) {
					
					$montoya_item_categories 	.= $item_cat->name . ', ';
				}

				$montoya_item_categories = rtrim($montoya_item_categories, ', ');

			}
			
			$montoya_image_alt_text = __('Portfolio Image', 'montoya_core_plugin_text_domain');
			if( !empty( $full_image['id'] ) ){
				
				$montoya_image_alt_text = trim( strip_tags( get_post_meta( $full_image['id'], '_wp_attachment_image_alt', true ) ) );
				
			}
			
			$item_url = get_the_permalink();
			
			$montoya_change_header = "";
			if( $montoya_background_type  == 'dark-content' ){
									
				$montoya_change_header = " change-header";
			}
			
			$out .= '<div class="snap-slide trigger-item';
			if( (($montoya_current_page_bknd_type == 'light-content') && ($montoya_background_type == 'dark-content')) ||
				(($montoya_current_page_bknd_type == 'dark-content') && ($montoya_background_type == 'light-content')) ){
				
				$out .= ' change-header-color';
			}
			$out .= '">';
			$out .= '<div class="img-mask">';
			$out .= '<div class="section-image trigger-item-link">';
			$out .= '<img src="' . esc_url( $full_image['url'] ) . '" class="item-image grid__item-img" alt="' . esc_attr( $montoya_image_alt_text ) . '">';
			if( montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video' ) ){

				$montoya_video_webm_url = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-webm' );
				$montoya_video_mp4_url 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, get_the_ID(), 'montoya-opt-portfolio-video-mp4' );
				
				$out .= '<div class="hero-video-wrapper">';
				$out .= '<video loop muted class="bgvid">';
				if( !empty( $montoya_video_mp4_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_mp4_url ) . '" type="video/mp4">';
				}
				if( !empty( $montoya_video_webm_url ) ) {
					
					$out .= '<source src="' . esc_url( $montoya_video_webm_url ) . '" type="video/webm">';
				}
				$out .= '</video>';
				$out .= '</div>';
			}
			$out .= '</div>';
			$out .= '<img class="grid__item-img grid__item-img--large" src="' . esc_url( $full_image['url'] ) . '" alt="' . esc_attr( $montoya_image_alt_text ) . '" />';
			$out .= '</div>';
			$out .= '</div>';
			
			$captions .= '<div class="snap-slide-caption' . $montoya_change_header . '" data-centerLine="' . esc_attr( montoya_get_theme_options('clapat_montoya_open_project_caption') ) . '">';
			$captions .= '<div class="outer">';
			$captions .= '<div class="inner">';
			$captions .= '<div class="slide-title-wrapper">';
			$captions .= '<div class="slide-title primary-font-title"><span>' . wp_kses( $montoya_item_title, 'montoya_allowed_html' ) . '</span></div>';
			$captions .= '<a class="slide-link" data-type="page-transition" href="' . esc_url( $item_url ) . '"></a>';
			$captions .= '</div>';
			$captions .= '<div class="slide-subtitle"><span>' . wp_kses( $montoya_project_year, 'montoya_allowed_html' ) . '</span> <span>' . wp_kses( $montoya_item_categories, 'montoya_allowed_html' ) . '</span></div>';
			$captions .= '</div>';
			$captions .= '</div>';
			$captions .= '</div>';
			
		}
		
		$montoya_current_item_count++;

	}

	wp_reset_postdata();
	
	$out .= '</div>';
	
	$out .= '<div class="snap-slider-captions">';
	$out .= '<div class="snap-slider-captions-wrapper content-full-width">';

	$out .= $captions;

	$out .= '</div>';
	$out .= '</div>';
	
	$out .=	 '</div>';
	$out .=	 '</div>';
	$out .=	 '<!--/Parallax Gallery-->';
		
	if( !is_page_template('portfolio-showcase-grid-page.php') ){
		
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List-->';
		$out .=	 '</div>';
		$out .=	 '<!--/Showcase List Holder-->';
	}
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// News List
//////////////////////////////////////////////////////////////////
add_shortcode('montoya_news', 'shortcode_montoya_news');
function shortcode_montoya_news($atts, $content = null) {

	$atts = shortcode_atts(array(
		'items_no'			=> '4',
		'filter_category'   => ''
	), $atts );

	$montoya_max_items		= $atts['items_no'];
	if( empty($montoya_max_items) ){

		$montoya_max_items = 1000;
	}
		
	$montoya_blog_tax_query = null;
	$montoya_blog_category_filter	= $atts['filter_category'];

	$montoya_portfolio_tax_query = null;

	$montoya_enable_ajax = false;
	if( function_exists( 'montoya_get_theme_options' ) ){

		$montoya_enable_ajax = montoya_get_theme_options( 'clapat_montoya_enable_ajax' );
	}

	$montoya_array_terms = null;
	if( !empty( $montoya_blog_category_filter ) ){

		$montoya_array_terms = explode( ",", $montoya_blog_category_filter );
		$montoya_portfolio_tax_query = array(
											array(
												'taxonomy' 	=> 'category',
												'field'		=> 'slug',
												'terms'		=> $montoya_array_terms,
												),
										);
	}

	$out = '';
	$out .= '<div class="news-shortcode">';
	$out .= '<div id="blog-effects" class="' . sanitize_html_class( montoya_get_theme_options( 'clapat_montoya_blog_scroll_effect_type' ) ) . '" data-fx="1">';
		
	$montoya_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$montoya_args = array(
										'post_type' => 'post',
										'paged' => $montoya_paged,
										'tax_query' => $montoya_portfolio_tax_query,
										'posts_per_page' => $montoya_max_items,
										 );

	$montoya_portfolio = new WP_Query( $montoya_args );

	$montoya_current_item_count = 1;
	while( $montoya_portfolio->have_posts() ){

		$montoya_portfolio->the_post();
		
		$post_classes = get_post_class( 'post', get_the_ID() );
			
		$montoya_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

		$montoya_post_title = get_the_title();
		if( empty( $montoya_post_title ) ){
				
			$montoya_post_title = esc_html__("Post has no title", "montoya");
		}

		$out .= '<!-- Article -->';
		$out .= '<article id="post-'. get_the_ID() . '" class="news-post ' . esc_attr( implode( ' ', $post_classes ) ) . '">';
		$out .= '<div class="article-bg content-full-width">';
                        	
		$out .= '<div class="article-content content-full-width">';

		// Post categories
		$out .= '<div class="entry-meta-wrap">';
		$out .= '<div class="entry-meta entry-categories">';
		$out .= '<ul class="post-categories">';
		$montoya_categories = get_the_category();
		if ( ! empty( $montoya_categories ) ) {

			foreach( $montoya_categories as $montoya_category ) {

				$out .= '<li class="link">';
				$out .= wp_kses( '<a class="ajax-link" data-type="page-transition" href="' . esc_url( get_category_link( $montoya_category->term_id ) ) . '" rel="category tag"><span data-hover="' . esc_attr( $montoya_category->name ) . '">' . esc_html( $montoya_category->name ) . '</span></a>', 'montoya_allowed_html' );
				$out .= '</li>';
			}
		}
		$out .= '</ul>';
		$out .= '</div>';
		$out .= '</div>';

		// Post date
		$out .= '<div class="entry-meta-wrap">';
		$out .= '<ul class="entry-meta entry-date">';
		$out .= '<li class="link"><a class="ajax-link" href="' . get_permalink() . '"><span data-hover="' . get_the_date() . '">' . get_the_date() . '</span></a></li>';
		$out .= '</ul>';
		$out .= '</div>';
							
		$out .= '</div>';

		$out .= '<div class="article-wrap">';
							
		// Post image
		$out .= '<div class="article-show-image">';
		if( $montoya_post_image  ){
				
			$out .= '<div class="hover-reveal">';
			$out .= '<div class="hover-reveal__inner">';
			$out .= '<div class="hover-reveal__img">';
			$out .= '<a class="ajax-link" href="' . esc_url( get_permalink() ) . '" data-type="page-transition">';
			$out .= '<img src="' . esc_url( $montoya_post_image[0] ) . '" alt="' . esc_attr__("Post Image", "montoya") . '"';
			$out .= '</a>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
		} // if post image
                                
		// Post link
		$out .= '<a class="post-title ajax-link hide-ball" href="' . esc_url( get_permalink() ) . '" data-type="page-transition">' . wp_kses( $montoya_post_title, 'montoya_allowed_html' ) . '</a>';
                            
		$out .= '</div>';

		$out .= '<div class="article-links">';
		$out .= '<div class="button-box">';
		$out .= '<a class="ajax-link" data-type="page-transition" href="' . get_permalink() . '">';
		$out .= '<div class="clapat-button-wrap parallax-wrap hide-ball">';
		$out .= '<div class="clapat-button parallax-element">';
		$out .= '<div class="button-border outline rounded parallax-element-second">';
		$out .= '<span data-hover="' . esc_attr__('Read Article', 'montoya') . '">' . esc_html__('Read Article', 'montoya') . '</span>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</a>';
		$out .= '</div>';
        $out .= '</div>';

		// Post Read More button
		$out .= '<div class="button-box">';
		$out .= '<a class="ajax-link" href="' . esc_url( get_permalink() ) . '" data-type="page-transition">';
		$out .= '<div class="clapat-button-wrap parallax-wrap hide-ball">';
		$out .= '<div class="clapat-button parallax-element">';
		$out .= '<div class="button-border outline rounded parallax-element-second">';
		$out .= '<span data-hover="' . esc_attr( montoya_get_theme_options( 'clapat_montoya_blog_read_more_caption' ) ) . '">' . wp_kses( montoya_get_theme_options( 'clapat_montoya_blog_read_more_caption' ), 'montoya_allowed_html' ) . '</span>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</a>';
		$out .= '</div>';
		

		$out .= '</div>';

		$out .= '</div>';
		$out .= '</article>';
		$out .= '<!--/Article -->';
					
		$montoya_current_item_count++;

	}

	wp_reset_postdata();
		
	$out .= '</div>';
	$out .= '</div>';
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Add shortcodes buttons to tinyMCE
//////////////////////////////////////////////////////////////////

add_action('init',          'init_shortcodes_menu');
add_action('admin_init',    'admin_init_shortcodes_menu');
	
function init_shortcodes_menu(){
	
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	
	// register the tinyMCE buttons in case visual composer is not installed 
	// otherwise just use the shortcodes from there
	if( function_exists('vc_map') ){

		return;
	}

	if ( get_user_option('rich_editing') == 'true' )
	{
		add_filter( 'mce_external_plugins', 'add_shortcode_plugins' );
		add_filter( 'mce_buttons', 'register_shortcode_menu_buttons' );
	}
}
	
function add_shortcode_plugins( $plugin_array ){

	$plugin_array['MontoyaCoreShortcodes'] = MONTOYA_SHORTCODES_DIR_URL . '/include/shortcodes.js';
	return $plugin_array;
}
	
function register_shortcode_menu_buttons( $buttons ){
	
	array_push( $buttons, "|", 'clapat_shortcode_button' );
	return $buttons;
}
	
function admin_init_shortcodes_menu(){
	
	wp_localize_script( 'jquery', 'ShortcodeAttributes', array('shortcode_folder' => MONTOYA_SHORTCODES_DIR_URL . '/include' ) );
}