<?php

$content_type = array( 'dark', 'light' );					
$text_align = array('text-align-left', 'text-align-center', 'text-align-right' );


$clapat_shortcodes = array(

	//columns
    'one_half' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'one_third' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'one_fourth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'one_fifth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'one_sixth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'two_third' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'two_fifth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'three_fourth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'three_fifth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'four_fifth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),

    'five_sixth' => array(
        'name' => __('Column', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'last' => array( 'title' => __('Last Column?', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
            'text_align' => array( 'title' => __('Text Alignment', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => $text_align
            )
        ),
        'has_content' => true,
        'default_content' => __('Content goes here', 'montoya_core_plugin_text_domain')
    ),
    // end columns
     
	// typo elements
	'title' => array(
        'name' => __('Title', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            'size' => array( 'title' => __('Title Size', 'montoya_core_plugin_text_domain'),
                'desc' => '',
                'type' => 'select',
                'values' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6')
            ),
            'underline' => array( 'title' => __('Has Underline?', 'montoya_core_plugin_text_domain'),
                'desc' => __('If the title is underlined or not', 'montoya_core_plugin_text_domain'),
                'type' => 'select',
                'values' => array('no', 'yes')
            ),
			'big' => array( 'title' => __('Big Title?', 'montoya_core_plugin_text_domain'),
                'desc' => __('This parameter applies only for H1 headings. If the title is normal or bigger title font size', 'montoya_core_plugin_text_domain'),
                'type' => 'select',
                'values' => array('no', 'yes')
            )
        ),
        'has_content' => true,
        'default_content' => __('Title', 'montoya_core_plugin_text_domain')
    ),
    
    'button' => array(
        'name' => __('Button', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            "link" => array(    "title" => __("Button Link", 'montoya_core_plugin_text_domain'),
                "desc"  => __("URL for the button", 'montoya_core_plugin_text_domain'),
                "type"  => "text",
                "default" => "http://"
            ),
			"hover_caption" => array(    "title" => __("Hover Caption", 'montoya_core_plugin_text_domain'),
                "desc"  => __("Caption displayed when hovering over", 'montoya_core_plugin_text_domain'),
                "type"  => "text",
                "default" =>__("Hover Title", 'montoya_core_plugin_text_domain')
            ),
            "target" => array(  "title" => __("Target Window", 'montoya_core_plugin_text_domain'),
                "desc" => __("Button link opens in a new or current window", 'montoya_core_plugin_text_domain'),
                "type" => "select",
                "values" => array("_blank", "_self")
            ),
            "type" => array( "title" => __("Button type", 'montoya_core_plugin_text_domain'),
                "desc" => "",
                "type" => "select",
                "values" => array("normal", "outline")
            ),
			 "rounded" => array( "title" => __("Rounded border", 'montoya_core_plugin_text_domain'),
                "desc" => "",
                "type" => "select",
                "values" => array("yes", "no")
            )
        ),
        'has_content' => true,
		'default_content' => __('Button Caption', 'montoya_core_plugin_text_domain')
    ),
	
	'text_link' => array(
        'name' => __('Text Link', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            "caption" => array(    "title" => __("Caption", 'montoya_core_plugin_text_domain'),
                "desc"  => __("Caption displayed over the link", 'montoya_core_plugin_text_domain'),
                "type"  => "text",
                "default" =>__("Read More", 'montoya_core_plugin_text_domain')
            ),
			 "link" => array(    "title" => __("Button Link", 'montoya_core_plugin_text_domain'),
                "desc"  => __("URL for the button", 'montoya_core_plugin_text_domain'),
                "type"  => "text",
                "default" => "http://"
            ),
            "target" => array(  "title" => __("Target Window", 'montoya_core_plugin_text_domain'),
                "desc" => __("Button link opens in a new or current window", 'montoya_core_plugin_text_domain'),
                "type" => "select",
                "values" => array("_blank", "_self")
            )
        ),
        'has_content' => false
    ),
	
	'marquee_content' => array(
        'name' => __('Marquee Content', 'montoya_core_plugin_text_domain'),
        'has_content' => true
    ),
	// end typo elements
    
	'accordion' => array(
        'name' => __('Accordion', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'accordion_item' => array(  'name' => __('Accordion Item', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
                    'title' => array( 'title' => __('Title', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => __('Accordion Title', 'montoya_core_plugin_text_domain')
                    )
                ),
                'has_content' => true,
                'default_content' => __('Accordion Content Here', 'montoya_core_plugin_text_domain')
            )
        ),
        'has_content' => false
    ),
	
    'list_rotator' => array(
        'name' => __('List Rotator', 'montoya_core_plugin_text_domain'),
		'attributes' => array(
                    'title' => array( 'title' => __('Title', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => __('List Rotator Title', 'montoya_core_plugin_text_domain')
                    )
                ),
        'sub_items' => array(
            'list_rotator_item' => array(  
				'name' => __('List Rotator Item', 'montoya_core_plugin_text_domain'),
                'has_content' => true,
                'default_content' => __('List Rotator Content Here', 'montoya_core_plugin_text_domain')
            )
        ),
        'has_content' => false
    ),
	
	'flex_list' => array(
        'name' => __('Flex List', 'montoya_core_plugin_text_domain'),
		'sub_items' => array(
            'flex_list_item' => array(  
				'name' => __('Flex List Item', 'montoya_core_plugin_text_domain'),
				'attributes' => array(
					"first_column" => array(  "title" => __("First Column", 'montoya_core_plugin_text_domain'),
						"desc" => __("Content of the first column in the list", 'montoya_core_plugin_text_domain'),
						"type" => "text",
						"default" => ""
					),
					"second_column" => array(  "title" => __("Second Column", 'montoya_core_plugin_text_domain'),
						"desc" => __("Content of the second column in the list", 'montoya_core_plugin_text_domain'),
						"type" => "text",
						"default" => ""
					),
					"third_column" => array(  "title" => __("Third Column", 'montoya_core_plugin_text_domain'),
						"desc" => __("Content of the third column in the list", 'montoya_core_plugin_text_domain'),
						"type" => "text",
						"default" => ""
					),
				),
                'has_content' => false
            )
        ),
        'has_content' => false
    ),
	
	'icon_box' => array(
        'name' => __('Icon Box', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            "icon" => array(  "title" => __("Icon", 'montoya_core_plugin_text_domain'),
                "desc" => __("Icon displayed within contact box", 'montoya_core_plugin_text_domain'),
                "type" => "icon",
                "default" => ""
            ),
            "title" => array(  "title" => __("Title", 'montoya_core_plugin_text_domain'),
                "desc" => __("Title of the contact box", 'montoya_core_plugin_text_domain'),
                "type" => "text",
                "default" => ""
            )
        ),
        'require_icon' => true,
        'has_content' => true,
        'default_content' => __('Box content', 'montoya_core_plugin_text_domain')
    ),
	
	'clapat_collage' => array(
        'name' => __('Image Collage', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'clapat_collage_image' => array(  'name' => __('Collage Image', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
					'thumb_img_url' => array( 'title' => __('Thumbnail Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => __('Image thumbnail included in carousel', 'montoya_core_plugin_text_domain'),
                        'type' => 'text',
                        'default' => ''
                    ),
                    'img_url' => array( 'title' => __('Collage Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                    'alt' => array( 'title' => __('Image ALT', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
					'info' => array( 'title' => __('Collage Image Caption', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                ),
                'has_content' => false
            )
        ),
        'has_content' => false
    ),
	
	'clapat_video' => array(
        'name' => __('Video hosted', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
            "cover_img_url" => array(  "title" => __("Cover Image", 'montoya_core_plugin_text_domain'),
                "desc" => __("Cover image of the still video", 'montoya_core_plugin_text_domain'),
                "type" => "text",
                "default" => ""
            ),
            "webm_url" => array(  "title" => __("Webm URL", 'montoya_core_plugin_text_domain'),
                "desc" => __("Url of the video in webm format", 'montoya_core_plugin_text_domain'),
                "type" => "text",
                "default" => ""
            ),
			"mp4_url" => array(  "title" => __("Mp4 URL", 'montoya_core_plugin_text_domain'),
                "desc" => __("Url of the video in mp4 format", 'montoya_core_plugin_text_domain'),
                "type" => "text",
                "default" => ""
            )
        ),
        'require_icon' => false,
        'has_content' => false
    ),
	
	// end elements
    	
    //sliders
    'general_slider' => array(
        'name' => __('Normal Image Slider', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'general_slide' => array(  'name' => __('Slide', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
                    'img_url' => array( 'title' => __('Slider Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                    'alt' => array( 'title' => __('Image ALT', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                ),
                'has_content' => false
            )
        ),
        'has_content' => false
    ),
	
	'carousel_slider' => array(
        'name' => __('Carousel Image Slider', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'carousel_slide' => array(  'name' => __('Slide', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
					'img_url' => array( 'title' => __('Slider Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                    'alt' => array( 'title' => __('Image ALT', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                ),
                'has_content' => false
            )
        ),
        'has_content' => false
    ),
	//end sliders

	'clapat_parallax_image' => array(
        'name' => __('Parallax Image', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
			'img_url' => array( 'title' => __('Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
            'video_url' => array( 'title' => __('Video URL - MP4 format, for video parallax', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
			"text_size" => array( "title" => __("Text Size", 'montoya_core_plugin_text_domain'),
                "desc" => "",
                "type" => 'select',
                "values" => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
				'default' => 'h2'
            ),
			"text_alignment" => array( "title" => __("Text Alignment", 'montoya_core_plugin_text_domain'),
                "desc" => "",
                "type" => 'select',
                "values" => array('text-align-center', 'text-align-left'),
				'default' => 'text-align-center'
            ),
        ),
        'has_content' => true
    ),
	
	'clapat_clipped_image' => array(
        'name' => __('Clipped Image', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
			'img_url' => array( 'title' => __('Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
            'video_url' => array( 'title' => __('Video URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
			"text_size" => array( "title" => __("Text Size", 'montoya_core_plugin_text_domain'),
                "desc" => "",
                "type" => 'select',
                "values" => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
				'default' => 'h2'
            ),
			'text_color' => array( 'title' => __('Text Color (hex code)', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => '#0c0c0c'
            ),
        ),
        'has_content' => true
    ),
	
	'clapat_popup_image' => array(
        'name' => __('Popup Image', 'montoya_core_plugin_text_domain'),
        'attributes' => array(
			'thumb_url' => array( 'title' => __('Thumbnail Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
            'img_url' => array( 'title' => __('Zoom Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
        ),
        'has_content' => false
    ),
	
	'clapat_captioned_image' => array(
        'name' => __('Captioned Image', 'montoya_core_plugin_text_domain'),
		'attributes' => array(
			'img_url' => array( 'title' => __('Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
			'alt' => array( 'title' => __('ALT attribute', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
			'caption' => array( 'title' => __('Image Caption', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
            ),
        ),
        'has_content' => false
    ),
	
	// team members
	'team_members' => array(
        'name' => __('Team Members List', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'team_member' => array(  'name' => __('Team Member', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
					'img_url' => array( 'title' => __('Team Member Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                    'name' => array( 'title' => __('Team Member Name', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
					'position' => array( 'title' => __('Team Member Position', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                ),
                'has_content' => true,
                'require_icon' => false
            )
        ),
        'has_content' => false,
    ),
	// end testimonials
	
	// Clients
	'clients' => array(
        'name' => __('Clients List', 'montoya_core_plugin_text_domain'),
        'sub_items' => array(
            'client_item' => array(  'name' => __('Client', 'montoya_core_plugin_text_domain'),
                'attributes' => array(
                    'img_url' => array( 'title' => __('Client Logo Image URL', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
					'name' => array( 'title' => __('Client Name', 'montoya_core_plugin_text_domain'),
                        'desc' => '',
                        'type' => 'text',
                        'default' => ''
                    ),
                ),
                'has_content' => true,
                'require_icon' => false
            )
        ),
        'has_content' => false,
    ),
	// end clients
	
);

?>