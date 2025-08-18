<?php

if ( ! class_exists( 'Montoya_Hero_Properties' ) ) {

	class Montoya_Hero_Properties
	{
		public $post_id;
		public $enabled;
		public $share;
		public $caption_title;
		public $caption_subtitle;
		public $desc;
		public $scroll_position;
		public $alignment;
		public $width;
		public $image;
		public $foreground;
		public $video;
		public $video_webm;
		public $video_mp4;
		public $scroll_down_caption;
		public $info_text;
		public $item_no;
		public $view_all_projects_url;
		public $view_all_projects_caption;
		
		public function __construct(){

			$this->post_id = "";
			$this->enabled = false;
			$this->share = false;
			$this->caption_title = "";
			$this->caption_subtitle = "";
			$this->desc = "";
			$this->scroll_position = sanitize_html_class("parallax-scroll-caption");
			$this->alignment = sanitize_html_class("text-align-center");
			$this->width = sanitize_html_class("content-full-width");
			$this->image = true;
			$this->foreground = sanitize_html_class('light-content');
			$this->video = false;
			$this->video_webm = "";
			$this->video_mp4 = "";
			$this->scroll_down_caption = "";
			$this->info_text = "";
			$this->item_no = 1;
			$this->view_all_projects_url = "";
			$this->view_all_projects_caption = "";
			$this->caption_flip = true;
		}

		public function getProperties( $post_type ){

			if( empty( $this->post_id ) ){
				
				$this->post_id = get_the_ID();
			}

			if( $post_type == 'montoya_portfolio' ){

				$this->enabled 		= true; // in portfolio projects hero is always enabled and the hero image will be displayed in showcase slider
				$this->share 		= true;
				$this->image		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-img' );
				$title_row				= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-caption-title' );
				$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
				$this->caption_title	= "";
				foreach( $title_list as $title_bit ){
					
					$this->caption_title .= $this->titleWrap( $title_bit );
				}
				$subtitle_row			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-caption-subtitle' );
				$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
				$this->caption_subtitle	= "";
				foreach( $subtitle_list as $subtitle_bit ){
					
					$this->caption_subtitle .= $this->subtitleWrap( $subtitle_bit );
				}
				$this->info_text = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-info-text' );
				$this->scroll_position 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-parallax-caption' );
				if( $this->image && !empty( $this->image['url'] ) ){
					
					$this->scroll_position = "";
				}
				$this->alignment 		= esc_attr("text-align-center");
				$this->width				= esc_attr("content-full-width");
				$this->foreground 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-bknd-color' );
				$this->video 			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-video' );
				$this->video_webm 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-video-webm' );
				$this->video_mp4 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-video-mp4' );
				$this->scroll_down_caption = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-scroll-caption' );
				$this->view_all_projects_url = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-view-all-projects-url' );
				$this->view_all_projects_caption = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-view-all-projects-caption' );
				$this->caption_flip = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-portfolio-hero-caption-flip-effect' );
				
			} else if( $post_type == 'post' ){

				$this->enabled = true; // the hero section is always enabled in case of blog posts, displaying post title and categories
				$this->caption_title 	= get_the_title();
				$this->caption_subtitle	= montoya_blog_post_hero_caption();
				$this->alignment 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-blog-hero-caption-alignment' );
				$this->foreground 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-blog-bknd-color' );
				$this->image		 	= null;

			} 
			else if( !empty( $post_type ) ){

				$this->enabled 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-enable-hero' );

				$this->image		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-img' );
				$title_row				= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-caption-title' );
				$title_list				= preg_split('/\r\n|\r|\n/', $title_row);
				$this->caption_title	= "";
				foreach( $title_list as $title_bit ){
					
					$this->caption_title .= $this->titleWrap( $title_bit );
				}
				$subtitle_row		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-caption-subtitle' );
				$subtitle_list			= preg_split('/\r\n|\r|\n/', $subtitle_row);
				$this->caption_subtitle	= "";
				foreach( $subtitle_list as $subtitle_bit ){
					
					$this->caption_subtitle .= $this->subtitleWrap( $subtitle_bit );
				}
				$this->scroll_position 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-parallax-caption' );
				if( $this->image && !empty( $this->image['url'] ) ){
					
					$this->scroll_position = "";
				}
				$this->alignment 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-caption-align' );
				$this->foreground 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-bknd-color' );
				$this->video 			= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-video' );
				$this->video_webm 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-video-webm' );
				$this->video_mp4 	= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-video-mp4' );
				$this->scroll_down_caption = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-scroll-caption' );
				$this->info_text 		= montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-info-text' );
				$this->caption_flip = montoya_get_post_meta( MONTOYA_THEME_OPTIONS, $this->post_id, 'montoya-opt-page-hero-caption-flip-effect' );
			}
			
		}

		protected function titleWrap( $title ){
			
			if( !empty( $title ) ){
					
				$title	= '<span>' . $title . '</span>';
			}
			
			return $title;
		}
		
		protected function subtitleWrap( $subtitle ){
			
			if( !empty( $subtitle ) ){
					
				$subtitle	= '<span>' . $subtitle . '</span>';
			}
			
			return $subtitle;
		}
	}
}

$montoya_hero_properties = new Montoya_Hero_Properties();

?>
