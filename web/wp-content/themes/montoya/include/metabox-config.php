<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = 'clapat_' . MONTOYA_THEME_ID . '_theme_options';


if ( !function_exists( "montoya_add_metaboxes" ) ){

    function montoya_add_metaboxes( $metaboxes ) {

    $metaboxes = array();


    ////////////// Page Options //////////////
    $page_options = array();
    $page_options[] = array(
        'title'         => esc_html__('General', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning all page templates.', 'montoya'),
        'fields'        => array(

			array(
                'id'        => 'montoya-opt-page-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'montoya'),
				'desc'      => esc_html__('Background color for this page.', 'montoya'),
                'default'   => '#0c0c0c',
            ),
			
			array(
                'id'        => 'montoya-opt-page-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background Type', 'montoya'),
				'desc'      => esc_html__('Background type for this page.', 'montoya'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'montoya'),
                    'light-content' => esc_html__('Dark', 'montoya')

                ),
				'default'   => 'light-content',
            )
			
        ),
    );

	$page_options[] = array(
        'title'         => esc_html__('Hero Section', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-website',
        'desc'          => esc_html__('Options concerning Hero top section in pages.', 'montoya'),
        'fields'        => array(

			/**************************HERO SECTION OPTIONS**************************/
			array(
                'id'        => 'montoya-opt-page-enable-hero',
                'type'      => 'switch',
                'title'     => esc_html__('Display Hero Section', 'montoya'),
                'desc'      => esc_html__('Enable "hero" section displayed immediately below page header. Showcase and Carousel pages do not have a hero section.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      => esc_html__('No', 'montoya'),
                'default'   => false
            ),

			array(
				'id'        => 'montoya-opt-page-hero-img',
                'type'      => 'media',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
                'url'       => true,
                'title'     => esc_html__('Hero Image', 'montoya'),
                'desc'      => esc_html__('Upload hero background image. The hero image is the fullscreen image in hero section. Hero section is the intro section displayed at the top of the page.', 'montoya'),
                'default'   => array(),
            ),
			
			array(
				'id'        => 'montoya-opt-page-video',
				'type'      => 'switch',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
				'title'     => esc_html__('Video Hero', 'montoya'),
				'desc'   	=> esc_html__('Video displayed as hero section in project page. If you check this option set the Hero Image as the first frame image of the video to avoid flickering!', 'montoya'),
				'on'       	=> esc_html__('Yes', 'montoya'),
				'off'      	=> esc_html__('No', 'montoya'),
				'default'   => false
			),

			array(
				'id'        => 'montoya-opt-page-video-webm',
				'type'      => 'text',
				'title'     => esc_html__('Webm Video URL', 'montoya'),
				'desc'   	=> esc_html__('URL of the hero section background webm video. Webm format is previewed in Chrome and Firefox.', 'montoya'),
				'required'	=> array('montoya-opt-page-video', '=', true),
			),

			array(
				'id'        => 'montoya-opt-page-video-mp4',
				'type'      => 'text',
				'title'     => esc_html__('MP4 Video URL', 'montoya'),
				'desc'   	=> esc_html__('URL of the hero section background MP4 video. MP4 format is previewed in IE, Safari and other browsers.', 'montoya'),
				'required'	=> array('montoya-opt-page-video', '=', true),
			),
			
			array(
                'id'        => 'montoya-opt-page-hero-caption-title',
                'type'      => 'textarea',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Caption Title', 'montoya'),
                'desc'  	=> esc_html__('The title displayed over hero section. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'montoya'),
	        ),
			
			array(
                'id'        => 'montoya-opt-page-hero-caption-subtitle',
                'type'      => 'textarea',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Caption Subtitle', 'montoya'),
                'desc'  	=> esc_html__('Subtitle displayed over hero section, underneath the title. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'montoya'),
			),
			
			array(
                'id'        => 'montoya-opt-page-hero-scroll-caption',
                'type'      => 'text',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
				'title'     => esc_html__('Scroll Down Caption', 'montoya'),
                'desc'  	=> esc_html__('Scroll down caption displayed to the bottom right of the hero image indicating scrolling down to reveal the content. Leave empty for no scroll down button.', 'montoya'),
				'default'   => '',
	        ),
			
			array(
                'id'        => 'montoya-opt-page-hero-info-text',
                'type'      => 'text',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
                'title'     => esc_html__('Hero Info Text', 'montoya'),
                'desc'  	=> esc_html__('Additional info regarding this page.', 'montoya'),
	        ),
						
			array(
                'id'        => 'montoya-opt-page-hero-parallax-caption',
                'type'      => 'select',
                'title'     => esc_html__('Enable Parallax Caption', 'montoya'),
                'desc'      => esc_html__('Parallax scrolling effect on hero section title and subtitle. This only applies if there is no hero image assigned.', 'montoya'),
				'options'   => array(
                    'parallax-scroll-caption'	=> esc_html__('Yes', 'montoya'),
                    'normal-scroll-caption' => esc_html__('No', 'montoya')
                ),
                'default'   => 'parallax-scroll-caption'
            ),
			
			array(
                'id'        => 'montoya-opt-page-hero-caption-align',
                'type'      => 'select',
                'title'     => esc_html__('Caption Alignment', 'montoya'),
                'desc'      => esc_html__('The alignment of the hero caption (title and subtitle).', 'montoya'),
				'options'   => array(
                    'text-align-center'	=> esc_html__('Center', 'montoya'),
                    'text-align-left' => esc_html__('Left', 'montoya')
                ),
                'default'   => 'text-align-center'
            ),
			
			array(
				'id'        => 'montoya-opt-page-hero-caption-flip-effect',
				'type'      => 'switch',
				'required'  => array( 'montoya-opt-page-enable-hero', '=', true ),
				'title'     => esc_html__('Enable flip effect on hero caption', 'montoya'),
				'desc'   	=> esc_html__('With this setting enabled hero caption will flip to the left side on scroll. Works only if there is a background hero image set.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      	=> esc_html__('No', 'montoya'),
				'default'   => true
			)
			
			/**************************END - HERO SECTION OPTIONS**************************/
		),
	);
	
	$page_options[] = array(
        'title'         => esc_html__('Page Navigation', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-caret-right',
        'desc'          => esc_html__('Options concerning bottom page next navigation section.', 'montoya'),
        'fields'        => array(

			/**************************PAGE NAVIGATION SECTION**************************/
			array(
                'id'        => 'montoya-page-navigation-hover-caption',
                'type'      => 'text',
				'title'     => esc_html__('Navigation Hover Caption', 'montoya'),
                'desc'		=> esc_html__('Caption displayed when hovering over bottom navigation section.', 'montoya'),
				'default'   => esc_html__('Next Page', 'montoya'),
			),
			
			array(
                'id'        => 'montoya-opt-page-navigation-next-page',
                'type'      => 'select',
                'title'     => esc_html__('Next Page In Navigation', 'montoya'),
				'desc'      => esc_html__('The next page navigation displayed at the bottom of the current page.', 'montoya'),
                'options'   => montoya_list_published_pages(),
				'default'   => '',
            ),
			
			array(
                'id'        => 'montoya-opt-page-navigation-caption-title',
                'type'      => 'textarea',
                'title'     => esc_html__('Next Page Caption Title', 'montoya'),
                'desc'  	=> esc_html__('Leave it empty to display the next page hero title. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'montoya'),
	        ),
			
			array(
                'id'        => 'montoya-opt-page-navigation-caption-subtitle',
                'type'      => 'textarea',
                'title'     => esc_html__('Next Page Caption Subtitle', 'montoya'),
                'desc'  	=> esc_html__('Leave it empty to display the next page hero subtitle. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'montoya'),
			),
			
			array(
                'id'        => 'montoya-opt-page-navigation-caption-align',
                'type'      => 'select',
                'title'     => esc_html__('Next Page Caption Alignment', 'montoya'),
                'desc'      => esc_html__('The alignment of the next page navigation caption.', 'montoya'),
				'options'   => array(
                    'text-align-center'	=> esc_html__('Center', 'montoya'),
                    'text-align-left' => esc_html__('Left', 'montoya')
                ),
                'default'   => 'text-align-center'
            ),
			/**************************END - PAGE NAVIGATION SECTION**************************/
		),
	);
	
	$page_options[] = array(
        'title'         => esc_html__('All Portfolio Templates', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-folder-open',
        'desc'          => esc_html__('Options concerning only Portfolio templates (Creative Grid, Gallery).', 'montoya'),
        'fields'        => array(

			array(
                'id'        	=> 'montoya-opt-page-portfolio-filter-category',
                'type'      	=> 'text',
				'title'     	=> esc_html__('Category Filter', 'montoya'),
                'desc'  		=> esc_html__('Paste here the portfolio category slugs you want to include in the portfolio page templates separated by comma. Do not include spaces. For example photography,branding. It will exclude the rest of the categories. The portfolio category slugs can be found in Portfolio -> Categories.', 'montoya'),
				'default'  	=> '',
	        ),
						
			array(
				'id'        => 'montoya-opt-page-portfolio-thumb-to-fullscreen',
				'type'      => 'select',
				'title'     => esc_html__('Thumbnail To Fullscreen Animation', 'montoya'),
				'desc'      => esc_html__('Type of animation when navigating from a portfolio thumbnail to the portfolio hero section background image.', 'montoya'),
				'options'   => array(
								'webgl-fitthumbs' 	=> esc_html__('WebGL Animation', 'montoya'),
								'no-fitthumbs' => esc_html__('None', 'montoya')
							),
				'default'   => 'webgl-fitthumbs',
			),
			
			array(
				'id'        => 'montoya-opt-page-portfolio-thumb-to-fullscreen-webgl-type',
				'type'      => 'select',
				'title'     => esc_html__('WebGL Animation Type', 'montoya'),
				'desc'      => esc_html__('Type of animation when WebGL thumbnail to fullscreen effect is selected.', 'montoya'),
				'options'   => array(
								'fx-one' 	=> esc_html__('FX one', 'montoya'),
								'fx-two' 	=> esc_html__('FX two', 'montoya'),
								'fx-three' 	=> esc_html__('FX three', 'montoya'),
								'fx-four' 	=> esc_html__('FX four', 'montoya'),
								'fx-five' 	=> esc_html__('FX five', 'montoya'),
								'fx-six' 		=> esc_html__('FX six', 'montoya'),
								'fx-seven' => esc_html__('FX seven', 'montoya')
							),
				'default'   => 'fx-one',
			)			
		),
	);

	$page_options[] = array(
        'title'         => esc_html__('Portfolio Showcase Grid', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-folder-open',
        'desc'          => esc_html__('Options concerning only Portfolio Showcase Grid template.', 'montoya'),
        'fields'        => array(

			array(
                 'id'       	=> 'montoya-opt-page-portfolio-grid-content-position',
                 'type'     	=> 'select',
                 'title'    	=> esc_html__( 'Page Content Position', 'montoya'),
                 'desc' 		=> esc_html__( 'Available only for Portfolio Grid Template: page content position in relation with portfolio grid.', 'montoya'),
                 'options'   => array(
                    'after' 	=> esc_html__('After Portfolio Grid', 'montoya'),
					'before'	=> esc_html__('Before Portfolio Grid', 'montoya'),
                 ),
				 'default'	=> 'after',
            ),
			
		),
	);
		
	$page_options[] = array(
        'title'         => esc_html__('Portfolio Showcase Gallery', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-folder-open',
        'desc'          => esc_html__('Options concerning only Portfolio Showcase Gallery template.', 'montoya'),
        'fields'        => array(

			array(
                'id'        => 'montoya-opt-page-portfolio-gallery-enable-preview',
                'type'      => 'switch',
                'title'     => esc_html__('Enable Preview', 'montoya'),
                'desc'      => esc_html__('Enables preview mode as extra step before navigating to individual portfolio page after clicking the gallery slide.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      => esc_html__('No', 'montoya'),
                'default'   => true
            ),
						
			array(
                'id'        => 'montoya-opt-page-portfolio-gallery-enable-tilt',
                'type'      => 'switch',
                'title'     => esc_html__('Enable tilt effect', 'montoya'),
                'desc'      => esc_html__('Enables gallery tilt effect on mouse move.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      => esc_html__('No', 'montoya'),
                'default'   => true
            )
		),
	);
	
	$metaboxes[] = array(
        'id'            => 'clapat_' . MONTOYA_THEME_ID . '_page_options',
        'title'         => esc_html__( 'Page Options', 'montoya'),
        'post_types'    => array( 'page' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidsebar in the normal/advanced positions
        'sections'      => $page_options,
    );

    $blog_post_options = array();
    $blog_post_options[] = array(

        'title'         => esc_html__('General', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning blog post options.', 'montoya'),
        'fields'        => array(

			array(
                'id'        => 'montoya-opt-blog-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'montoya'),
				'desc'      => esc_html__('Background color for this blog post.', 'montoya'),
                'default'   => '#0c0c0c',
            ),
			
			array(
                'id'        => 'montoya-opt-blog-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background type', 'montoya'),
				'desc'      => esc_html__('Background type for this blog post.', 'montoya'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'montoya'),
                    'light-content' => esc_html__('Dark', 'montoya')

                ),
				'default'   => 'light-content',
            ),

			array(
                 'id'       	=> 'montoya-opt-blog-hero-caption-alignment',
                 'type'     	=> 'select',
                 'title'    	=> esc_html__( 'Header Caption Alignment', 'montoya'),
                 'desc' 		=> esc_html__( 'The alignment of the blog post caption.', 'montoya'),
                 'options'   => array(
                    'text-align-left' 	=> esc_html__('Left', 'montoya'),
					'text-align-center'	=> esc_html__('Center', 'montoya'),
                 ),
				 'default'	=> 'text-align-center',
            ),
          )
        );

	$blog_post_options[] = array(
		'title'         => esc_html__('', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
		'desc'          => '',
        'fields'        => array()
		);
		
    $metaboxes[] = array(
       'id'            => 'clapat_' . MONTOYA_THEME_ID . '_post_options',
       'title'         => esc_html__( 'Post Options', 'montoya'),
       'post_types'    => array( 'post' ),
       'position'      => 'normal', // normal, advanced, side
       'priority'      => 'high', // high, core, default, low
       'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
       'sections'      => $blog_post_options,
    );


    $portfolio_options = array();
	$portfolio_options[] = array(
		'title'         => esc_html__('General', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-wrench',
        'desc'          => esc_html__('Options concerning portfolio item options.', 'montoya'),
        'fields'        => array(

			array(
                'id'        => 'montoya-opt-portfolio-bknd-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Background color', 'montoya'),
				'desc'      => esc_html__('Background color for this portfolio item page.', 'montoya'),
                'default'   => '#0c0c0c',
            ),
			
			array(
                'id'        => 'montoya-opt-portfolio-bknd-color',
                'type'      => 'select',
                'title'     => esc_html__('Background type', 'montoya'),
				'desc'      => esc_html__('Background type for this portfolio item page.', 'montoya'),
                'options'   => array(
                    'dark-content' 	=> esc_html__('Light', 'montoya'),
                    'light-content' => esc_html__('Dark', 'montoya')

                ),
				'default'   => 'light-content',
            ),
			
			array(
                'id'        => 'montoya-opt-portfolio-curtain-color-code',
                'type'      => 'color-picker',
                'title'     => esc_html__('Thumbnail Curtain Color', 'montoya'),
				'desc'      => esc_html__('The color of the curtain effect applied over the thumbnail in portfolio grid page templates.', 'montoya'),
                'default'   => '#0c0c0c',
            ),
			
			array(
				'id'        => 'montoya-opt-portfolio-project-year',
				'type'      => 'text',
				'title'     => esc_html__('Project Year', 'montoya'),
				'desc'   	=> esc_html__('Year the portfolio project was implemented. Displayed in Parallax Panels, Showcase Grid and Archive List portfolio page templates.', 'montoya'),
				'default'	=> date("Y")
			),

			array(
				'id'        => 'montoya-opt-portfolio-view-all-projects-url',
				'type'      => 'text',
				'title'     => esc_html__('View All Projects URL', 'montoya'),
				'desc'   	=> esc_html__('This a an URL to a main projects page. It is displayed at the bottom of the portfolio project page, just above the next project navigation section. Leave empty for none.', 'montoya'),
				'default'	=> ""
			),
			
			array(
				'id'        => 'montoya-opt-portfolio-view-all-projects-caption',
				'type'      => 'text',
				'title'     => esc_html__('View All Projects Caption', 'montoya'),
				'desc'   	=> esc_html__('Caption of the main projects page URL.', 'montoya'),
				'default' => esc_html__('View All Projects', 'montoya'),
			),
        ),
    );
	
	$portfolio_options[] = array(
        'title'         => esc_html__('Hero Section', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-website',
        'desc'          => esc_html__('Options concerning Hero top section in individual portfolio pages.', 'montoya'),
        'fields'        => array(

			/**************************HERO SECTION OPTIONS**************************/
			array(
				'id'        => 'montoya-opt-portfolio-hero-img',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Hero Image', 'montoya'),
                'desc'      => esc_html__('Upload hero background image. The hero image is the fullscreen image in hero section. Hero section is the header section displayed at the top of the individual project page.', 'montoya'),
                'default'   => array(),
            ),
			
			array(
				'id'        => 'montoya-opt-portfolio-video',
				'type'      => 'switch',
				'title'     => esc_html__('Video Hero', 'montoya'),
				'desc'   	=> esc_html__('Video displayed as hero section in project page. If you check this option set the Hero Image as the first frame image of the video to avoid flickering!', 'montoya'),
				'on'       	=> esc_html__('Yes', 'montoya'),
				'off'      	=> esc_html__('No', 'montoya'),
				'default'   => false
			),

			array(
				'id'        => 'montoya-opt-portfolio-video-webm',
				'type'      => 'text',
				'title'     => esc_html__('Webm Video URL', 'montoya'),
				'desc'   	=> esc_html__('URL of the hero section background webm video. Webm format is previewed in Chrome and Firefox.', 'montoya'),
				'required'	=> array('montoya-opt-portfolio-video', '=', true),
			),

			array(
				'id'        => 'montoya-opt-portfolio-video-mp4',
				'type'      => 'text',
				'title'     => esc_html__('MP4 Video URL', 'montoya'),
				'desc'   	=> esc_html__('URL of the hero section background MP4 video. MP4 format is previewed in IE, Safari and other browsers.', 'montoya'),
				'required'	=> array('montoya-opt-portfolio-video', '=', true),
			),

			array(
				'id'        => 'montoya-opt-portfolio-hero-caption-title',
				'type'      => 'textarea',
				'title'     => esc_html__('Hero Caption Title', 'montoya'),
				'desc'  	=> esc_html__('Title displayed over hero section. The hero background image is set in the hero image set in preceding option. Words or phrases separated with Enter will be automatically wrapped in a span element.', 'montoya'),
			),
			
			array(
                'id'        => 'montoya-opt-portfolio-hero-caption-subtitle',
                'type'      => 'textarea',
                'title'     => esc_html__('Hero Caption Subtitle', 'montoya'),
                'desc'  	=> esc_html__('Subtitle displayed on Thumbnail Preview Mode below the title.', 'montoya'),
			),
			
			array(
                'id'        => 'montoya-opt-portfolio-hero-info-text',
                'type'      => 'textarea',
                'title'     => esc_html__('Hero Info Text', 'montoya'),
                'desc'  	=> esc_html__('Additional information about the project displayed underneath title and subtitle.', 'montoya'),
			),
									
			array(
                'id'        => 'montoya-opt-portfolio-hero-parallax-caption',
                'type'      => 'select',
                'title'     => esc_html__('Enable Parallax Caption', 'montoya'),
                'desc'      => esc_html__('Parallax scrolling effect on hero section title and subtitle. This only applies if there is no hero image assigned.', 'montoya'),
				'options'   => array(
                    'parallax-scroll-caption'	=> esc_html__('Yes', 'montoya'),
                    'normal-scroll-caption' => esc_html__('No', 'montoya')
                ),
                'default'   => 'parallax-scroll-caption'
            ),
			
			array(
                'id'        => 'montoya-opt-portfolio-hero-scroll-caption',
                'type'      => 'text',
				'title'     => esc_html__('Scroll Down Caption', 'montoya'),
                'desc'  => esc_html__('Scroll down caption displayed to the left of the hero image indicating scrolling down to reveal the content. Leave empty for no scroll down button.', 'montoya'),
				'default'   => '',
	        ),
			
			array(
				'id'        => 'montoya-opt-portfolio-hero-caption-flip-effect',
				'type'      => 'switch',
				'title'     => esc_html__('Enable flip effect on hero caption', 'montoya'),
				'desc'   	=> esc_html__('With this setting enabled hero caption will flip to the left side on scroll. Works only if there is a background hero image set.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      	=> esc_html__('No', 'montoya'),
				'default'   => true
			)
			/**************************END - HERO SECTION OPTIONS**************************/

		),
	);
	
	$portfolio_options[] = array(
        'title'         => esc_html__('Showcase Gallery', 'montoya'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-puzzle',
        'desc'          => esc_html__('Options concerning portfolio item thumbnails in showcase gallery page template.', 'montoya'),
        'fields'        => array(

			array(
                'id'        => 'montoya-opt-portfolio-thumb-gallery-offset',
                'type'      => 'select',
                'title'     => esc_html__('Gallery Thumbnail Offset', 'montoya'),
                'desc'      => esc_html__('The y axis offset (vertically) in Showcase Gallery template. How far from the top margin of the page the thumbnail is positioned.', 'montoya'),
				'options'   => array(
                    's0' => '0',
                    's25' => '25',
					's50' => '50',
					's75' => '75',
					's100' => '100'
                ),
                'default'   => 's0'
            ),
			
			array(
                'id'        => 'montoya-opt-portfolio-thumb-gallery-scale',
                'type'      => 'select',
                'title'     => esc_html__('Gallery Thumbnail Scale', 'montoya'),
                'desc'      => esc_html__('The thumbnail scale in Showcase Gallery template. How big the thumbnail is.', 'montoya'),
				'options'   => array(
                    'has-scale-small'	=> esc_html__('Small', 'montoya'),
                    'has-scale-medium' => esc_html__('Medium', 'montoya'),
					'has-scale-large' => esc_html__('Large', 'montoya')
                ),
                'default'   => 'has-scale-large'
            ),
			
			array(
                'id'        => 'montoya-opt-portfolio-gallery-enable-parallax',
                'type'      => 'switch',
                'title'     => esc_html__('Enable Parallax Effect', 'montoya'),
                'desc'      => esc_html__('Enable parallax for gallery slides.', 'montoya'),
				'on'       => esc_html__('Yes', 'montoya'),
				'off'      => esc_html__('No', 'montoya'),
                'default'   => true
            ),

		),
	);
	
    $metaboxes[] = array(
        'id'            => 'clapat_' . MONTOYA_THEME_ID . '_portfolio_options',
        'title'         => esc_html__( 'Portfolio Item Options', 'montoya'),
        'post_types'    => array( 'montoya_portfolio' ),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'high', // high, core, default, low
        'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'      => $portfolio_options,
    );

	return $metaboxes;
  }

}

if( class_exists('Montoya\Core\Metaboxes\Meta_Boxes') ){

	$metabox_definitions = array();
	$metabox_definitions = montoya_add_metaboxes( $metabox_definitions );
	do_action( 'montoya/core/add_metaboxes', $metabox_definitions );
}
