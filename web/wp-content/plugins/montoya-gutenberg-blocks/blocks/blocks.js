/**
 * Montoya Shortcodes Gutenberg Blocks
 *
 */
( function( blocks, blockEditor, i18n, element, components ) {
	var el = element.createElement;
	var __ = i18n.__;
	var RichText = blockEditor.RichText;
	var PlainText = blockEditor.PlainText;
	var MediaPlaceHolder = blockEditor.MediaPlaceHolder;
	var TextControl = components.TextControl;
	var TextareaControl = components.TextareaControl;
	var RangeControl = components.RangeControl;
	var ColorPaletteControl = components.ColorPalette;
	var ColorPickerControl = components.ColorPicker;
	var SelectControl = components.SelectControl;
	var InspectorControls = blockEditor.InspectorControls;
	var MediaUpload = blockEditor.MediaUpload;
	var InnerBlocks = blockEditor.InnerBlocks;
	var AlignmentToolbar = blockEditor.AlignmentToolbar;
	var BlockControls = blockEditor.BlockControls;
 	
	/** Utils **/
	function normalizeUndef( x ){
		
		if (typeof x === 'undefined'){
			
			 return '';
		}
		else{
			
			return x;
		}
	}
	
	/** Generic Templates **/
	const HTML_ELEMENT_TEMPLATE = [
				[ 'core/html', {} ],
			];
	
	/** Button **/
	blocks.registerBlockType( 'montoya-gutenberg/button', {
		title: __( 'Montoya: Button Box', 'montoya-gutenberg' ),
		icon: 'editor-removeformatting',
		category: 'montoya-block-category',
		attributes: {
			caption: {
				type: 'string',
				default: __( 'Caption', 'montoya-gutenberg' )
			},
			background_color: {
				type: 'string',
				default: ''
			},
			text_color: {
				type: 'string',
				default: ''
			},
			link: {
				type: 'string',
				default: 'http://'
			},
			target: {
				type: 'string',
				default: '_blank'
			},
			type: {
				type: 'string',
				default: 'normal'
			},
			rounded: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'button', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			const colorsBackground = [ 
				{ name: 'Default', color: '#ffffff' }
			];
			
			const colorsText = [ 
				{ name: 'Default', color: '#000000' }
			];
			
			return [
				
				 el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-button-box is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-editor-removeformatting' } ),
									),
									__('Montoya Button Box', 'montoya-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						el( PlainText,
						{
							className: 'clapat-inline-content',
							value: props.attributes.link,
							onChange: ( value ) => { props.setAttributes( { link: value } ); },
						}),
						
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( 'strong', {}, __('Select Background Color:',  'montoya-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colorsBackground,
											value: props.attributes.background_color,
											onChange: ( value ) => { 
												props.setAttributes( { background_color: value === undefined ? '' : value } ); 
											},
										} )
									),
									
								el( 'strong', {}, __('Select Text Color:',  'montoya-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colorsText,
											value: props.attributes.text_color,
											onChange: ( value ) => { 
												props.setAttributes( { text_color: value === undefined ? '' : value } ); 
											},
										} )
									),
									
								el( SelectControl, {
									label: __('Type', 'montoya-gutenberg'),
									value: props.attributes.type,
									options : [
										{ label: __('Normal', 'montoya-gutenberg'), value: 'normal' },
										{ label: __('Outline',  'montoya-gutenberg'), value: 'outline' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
								el( SelectControl, {
									label: __('Rounded', 'montoya-gutenberg'),
									value: props.attributes.rounded,
									options : [
										{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
										{ label: __('No',  'montoya-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { rounded: value } ); },
								} ),
								el( SelectControl, {
									label: __('Link Target', 'montoya-gutenberg'),
									value: props.attributes.target,
									options: [
										{ label: 'Blank', value: '_blank' },
										{ label: 'Self', value: '_self' },
									],
									onChange: ( value ) => { props.setAttributes( { target: value } ); },
								} ),
								el( SelectControl, {
									label: __('Has animation', 'montoya-gutenberg'),
									value: props.attributes.has_animation,
									options : [
										{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
										{ label: __('No',  'montoya-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
								} ),
								el( 'div', { className : 'clapat-range-control' }, 
									el( RangeControl, {
										label: __('Animation delay',  'montoya-gutenberg'),
										value: props.attributes.animation_delay,
										onChange: ( value ) => { 
											if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							),
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[button link="' + props.attributes.link + '" target="' + props.attributes.target + '" type="' + props.attributes.type + '" rounded="' + props.attributes.rounded + '" background_color="' + props.attributes.background_color + '" text_color="' + props.attributes.text_color + '" animation="' + props.attributes.has_animation + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"]' + props.attributes.caption + '[/button]'; 
		},
	} );
	
	/** Text Link **/
	blocks.registerBlockType( 'montoya-gutenberg/button-link', {
		title: __( 'Montoya: Button Link', 'montoya-gutenberg' ),
		icon: 'admin-links',
		category: 'montoya-block-category',
		attributes: {
			caption: {
				type: 'string',
				default: __( 'Read More', 'montoya-gutenberg' )
			},
			link: {
				type: 'string',
				default: 'http://'
			},
			target: {
				type: 'string',
				default: '_blank'
			},
			position: {
				type: 'string',
				default: 'left'
			},
			type: {
				type: 'string',
				default: 'arrow'
			},
			size: {
				type: 'string',
				default: 'small-btn'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'button', 'montoya-gutenberg' ), __( 'link', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-button-link is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-admin-links' } ),
									),
									__('Montoya Button Link', 'montoya-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						el( PlainText,
						{
							className: 'clapat-inline-content',
							value: props.attributes.link,
							onChange: ( value ) => { props.setAttributes( { link: value } ); },
						}),
						
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Link Target', 'montoya-gutenberg'),
									value: props.attributes.target,
									options: [
										{ label: 'Blank', value: '_blank' },
										{ label: 'Self', value: '_self' },
									],
									onChange: ( value ) => { props.setAttributes( { target: value } ); },
								} ),
								el( SelectControl, {
									label: __('Position', 'montoya-gutenberg'),
									value: props.attributes.position,
									options: [
										{ label: 'Left', value: 'left' },
										{ label: 'Right', value: 'right' },
									],
									onChange: ( value ) => { props.setAttributes( { position: value } ); },
								} ),
								el( SelectControl, {
									label: __('Type', 'montoya-gutenberg'),
									value: props.attributes.type,
									options: [
										{ label: 'Arrow', value: 'arrow' },
										{ label: 'Bullet', value: 'bullet' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
								el( SelectControl, {
									label: __('Size', 'montoya-gutenberg'),
									value: props.attributes.size,
									options: [
										{ label: 'Small', value: 'small-btn' },
										{ label: 'Large', value: 'large-btn' },
									],
									onChange: ( value ) => { props.setAttributes( { size: value } ); },
								} ),
								el( SelectControl, {
									label: __('Has animation', 'montoya-gutenberg'),
									value: props.attributes.has_animation,
									options : [
										{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
										{ label: __('No',  'montoya-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
								} ),
								el( 'div', { className : 'clapat-range-control' }, 
									el( RangeControl, {
										label: __('Animation delay',  'montoya-gutenberg'),
										value: props.attributes.animation_delay,
										onChange: ( value ) => { 
											if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							),
							
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[button_link link="' + props.attributes.link + '" target="' + props.attributes.target + '" caption="' + props.attributes.caption + '" position="' + props.attributes.position + '" type="' + props.attributes.type + '" size="' + props.attributes.size + '" animation="' + props.attributes.has_animation + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/button_link]'; 
		},
	} );
	
	/** Marquee Content **/
	blocks.registerBlockType( 'montoya-gutenberg/marquee-content', {
		title: __( 'Montoya: Marquee Content', 'montoya-gutenberg' ),
		icon: 'editor-textcolor',
		category: 'montoya-block-category',
		attributes: {
			direction: {
				type: 'string',
				default: 'fw'
			},
			text_size: {
				type: 'string',
				default: 'h1'
			},
			big_title: {
				type: 'string',
				default: 'no'
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'marquee text', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
					el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-marquee-text is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-editor-textcolor' } ),
								),
								__('Montoya Marquee Content', 'montoya-gutenberg' ) ),
						
						el( InnerBlocks, {
								template:HTML_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Direction', 'montoya-gutenberg'),
									value: props.attributes.direction,
									options : [
										{ label: __('Forward', 'montoya-gutenberg'), value: 'fw' },
										{ label: __('Backward',  'montoya-gutenberg'), value: 'bw' },
									],
									onChange: ( value ) => { props.setAttributes( { direction: value } ); },
								} ),
								
								el( SelectControl, {
									label: __('Text Size', 'montoya-gutenberg'),
									value: props.attributes.text_size,
									options: [
										{ label: 'H1', value: 'h1' },
										{ label: 'H2', value: 'h2' },
										{ label: 'H3', value: 'h3' },
										{ label: 'H4', value: 'h4' },
										{ label: 'H5', value: 'h5' },
										{ label: 'H6', value: 'h6' },
									],
									onChange: ( value ) => { props.setAttributes( { text_size: value } ); },
								} ),
								
								el( SelectControl, {
									label: __('Big Title', 'montoya-gutenberg'),
									value: props.attributes.big_title,
									options : [
										{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
										{ label: __('No',  'montoya-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { big_title: value } ); },
								} ),
							),
						),
					
					)
			]
		},
		save: function( props ) {
			
			let blockClasses = 'marquee-text-wrapper';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let marqueeClasses = 'marquee-text no-margins';
			marqueeClasses += ' ' + props.attributes.direction;
			if( props.attributes.big_title !== 'no' ) { marqueeClasses += ' big-title'; }
			
			return el( 'div', { className: blockClasses },
						el( props.attributes.text_size, { className: marqueeClasses }, InnerBlocks.Content() ) );
		},			
			
	} );
	
	/** Moving Title **/
	blocks.registerBlockType( 'montoya-gutenberg/moving-title', {
		title: __( 'Montoya: Moving Title', 'montoya-gutenberg' ),
		icon: 'editor-textcolor',
		category: 'montoya-block-category',
		attributes: {
			direction: {
				type: 'string',
				default: 'title-moving-forward'
			},
			text_size: {
				type: 'string',
				default: 'h1'
			}
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'moving title', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
					el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-moving-title is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-editor-textcolor' } ),
								),
								__('Montoya Moving Title', 'montoya-gutenberg' ) ),
						
						el( InnerBlocks, {
								template:HTML_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
							
								el( SelectControl, {
									label: __('Direction', 'montoya-gutenberg'),
									value: props.attributes.direction,
									options : [
										{ label: __('Forward', 'montoya-gutenberg'), value: 'title-moving-forward' },
										{ label: __('Backward',  'montoya-gutenberg'), value: 'title-moving-backward' },
									],
									onChange: ( value ) => { props.setAttributes( { direction: value } ); },
								} ),
								
								el( SelectControl, {
									label: __('Text Size', 'montoya-gutenberg'),
									value: props.attributes.text_size,
									options: [
										{ label: 'H1', value: 'h1' },
										{ label: 'H2', value: 'h2' },
										{ label: 'H3', value: 'h3' },
										{ label: 'H4', value: 'h4' },
										{ label: 'H5', value: 'h5' },
										{ label: 'H6', value: 'h6' },
									],
									onChange: ( value ) => { props.setAttributes( { text_size: value } ); },
								} ),
								
							),
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = 'title-moving-outer';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = ' ' + props.attributes.className;
			}
			
			return el('div', { className: addClassName },
							el( props.attributes.text_size, { className: props.attributes.direction },  InnerBlocks.Content() ) );
		},			
			
	} );

	/** Moving Gallery **/
	const template_clapat_moving_gallery = [
	  [ 'montoya-gutenberg/moving-gallery-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/moving-gallery', {
		title: __( 'Montoya: Moving Gallery', 'montoya-gutenberg' ),
		icon: 'images-alt2',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/moving-gallery-image'],
		attributes: {
			direction: {
				type: 'string',
				default: 'fw-gallery'
			},
			randomize: {
				type: 'string',
				default: 'no'
			}
		}, 
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'moving gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-moving-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt2' } ),
									),
									__('Montoya Moving Gallery', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/moving-gallery-image'], template: template_clapat_moving_gallery} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Direction', 'montoya-gutenberg'),
										value: props.attributes.direction,
										options : [
											{ label: __('Forward', 'montoya-gutenberg'), value: 'fw-gallery' },
											{ label: __('Backward', 'montoya-gutenberg'), value: 'bw-gallery' },
										],
										onChange: ( value ) => { props.setAttributes( { direction: value } ); },
									} ),
									el( SelectControl, {
										label: __('Randomize gallery images size?', 'montoya-gutenberg'),
										value: props.attributes.randomize,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { randomize: value } ); },
									} )
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'moving-gallery';
			blockClasses += ' ' + props.attributes.direction;
			if( props.attributes.randomize !== 'no' ) { blockClasses += ' random-sizes'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'ul', { className: 'wrapper-gallery' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/moving-gallery-image', {
		title: __( 'Montoya: Moving Gallery Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/moving-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_moving_gallery_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_moving_gallery_image]'; 

		},
	} );
	
	/** Moving Thumbs Grid **/
	const template_clapat_moving_thumbs_grid = [
		[ 'montoya-gutenberg/moving-thumbs-grid-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/moving-thumbs-grid', {
		title: __( 'Montoya: Moving Thumbs Grid', 'montoya-gutenberg' ),
		icon: 'images-alt2',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/moving-thumbs-grid-image'],
		attributes: {
			title_size: {
				type: 'string',
				default: 'h1'
			},
			
			grid_title: {
				type: 'string',
				default: ''
			},
			
			grid_subtitle: {
				type: 'string',
				default: ''
			}
		}, 
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'moving thumbs grid', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-moving-thumbs-grid is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt2' } ),
									),
									__('Montoya Moving Thumbs Grid', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {template: template_clapat_moving_thumbs_grid} ),
							
							/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								
								el( SelectControl, {
									label: __('Grid Title Size', 'montoya-gutenberg'),
									value: props.attributes.title_size,
									options: [
										{ label: 'H1', value: 'h1' },
										{ label: 'H2', value: 'h2' },
										{ label: 'H3', value: 'h3' },
										{ label: 'H4', value: 'h4' },
										{ label: 'H5', value: 'h5' },
										{ label: 'H6', value: 'h6' },
									],
									onChange: ( value ) => { props.setAttributes( { title_size: value } ); },
								} ),
								
								el( TextareaControl, {
									label: __('Grid Title', 'montoya-gutenberg'),
									value: props.attributes.grid_title,
									onChange: ( value ) => { props.setAttributes( { grid_title: value } ); },
								} ),
								
								el( TextareaControl, {
									label: __('Grid Subtitle', 'montoya-gutenberg'),
									value: props.attributes.grid_subtitle,
									onChange: ( value ) => { props.setAttributes( { grid_subtitle: value } ); },
								} ),
							),
						),
					);

		},

		save: function( props ) {
			
			let blockClasses = 'move-thumbs-wrapper';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses },
					el( 'div', { className: 'start-thumbs-caption' }, 
						el( props.attributes.title_size, { className: 'primary-font-title big-title has-mask-fil' }, props.attributes.grid_title ),
						el( 'p', { }, props.attributes.grid_subtitle ) ),
					el( 'div', { className: 'start-thumbs-wrapper' }, InnerBlocks.Content() ) );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/moving-thumbs-grid-image', {
		title: __( 'Montoya: Moving Thumb', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/moving-thumbs-grid' ],

		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Thumb Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumb Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[moving_thumbs_grid_image img_url="' + props.attributes.thumb_image + '" img_id="' + props.attributes.thumb_image_id + '"][/moving_thumbs_grid_image]'; 

		},
	} );
	
	/** Horizontal Scrolling Panels **/
	const template_clapat_scrolling_panels = [
	  [ 'montoya-gutenberg/scrolling-panels-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/scrolling-panels', {
		title: __( 'Montoya: Horizontal Scrolling Panels', 'montoya-gutenberg' ),
		icon: 'slides',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/scrolling-panels-image'],
		attributes: {
			
			aspect_ratio: {
				type: 'number',
				default: 0.4
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'horizontal', 'montoya-gutenberg' ), __( 'scrolling panels', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-scrolling-panels is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Montoya Horizontal Scrolling Panels', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/scrolling-panels-image'], template: template_clapat_scrolling_panels} ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Aspect Ratio',  'montoya-gutenberg'),
											value: props.attributes.aspect_ratio,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { aspect_ratio: value } ); 
											},
											type: 'number',
											step: 0.1,
											min: 0.4,
											max: 1
										} ) ),
								),
								
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'panels';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses, 'data-widthratio': props.attributes.aspect_ratio }, 
						el( 'div', { className: 'panels-container' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/scrolling-panels-image', {
		title: __( 'Montoya: Horizontal Scrolling Panels Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/scrolling-panels' ],

		attributes: {
			panel_image: {
				type: 'string',
				default: ''
			},
			panel_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					panel_image: media.url,
					panel_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.panel_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.panel_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.panel_image_id ? i18n.__( 'Upload Panel Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.panel_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Panel Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_scrolling_panels_image img_url="' + props.attributes.panel_image + '" img_id="' + props.attributes.panel_image_id + '"][/clapat_scrolling_panels_image]';

		},
	} );
	
	/** Zoom Gallery **/
	const template_clapat_zoom_gallery = [
	  [ 'montoya-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/zoom-gallery-image', {} ] // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/zoom-gallery', {
		title: __( 'Montoya: Zoom Gallery', 'montoya-gutenberg' ),
		icon: 'welcome-view-site',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/zoom-gallery-image'],
		attributes: {
			
			aspect_ratio: {
				type: 'number',
				default: 0.4
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'zoom', 'montoya-gutenberg' ), __( 'gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-zoom-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-welcome-view-site' } ),
									),
									__('Montoya Zoom Gallery', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/zoom-gallery-image'], template: template_clapat_zoom_gallery} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Aspect Ratio',  'montoya-gutenberg'),
											value: props.attributes.aspect_ratio,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { aspect_ratio: value } ); 
											},
											type: 'number',
											step: 0.1,
											min: 0.4,
											max: 1
										} ) ),
								),
								
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'zoom-gallery';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let thumb_el = el( 'div', { className: 'zoom-wrapper-thumb' } );
			return el( 'div', { className: blockClasses }, 
						el( 'ul', { className: 'zoom-wrapper-gallery', 'data-heightratio': props.attributes.aspect_ratio }, InnerBlocks.Content() ),
						thumb_el
					);
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/zoom-gallery-image', {
		title: __( 'Montoya: Zoom Gallery Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/zoom-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			},
			zoom: {
				type: 'string',
				default: 'no'
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					el( SelectControl,
					{
						value: props.attributes.zoom,
						className: 'clapat-inline-content',
						label: __('Zoom to fullscreen',  'montoya-gutenberg'),
						options : [
									{ label: __('No', 'montoya-gutenberg'), value: 'no' },
									{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
								],
						onChange: ( value ) => { props.setAttributes( { zoom: value } ); },
					}),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_zoom_gallery_image zoom="' + props.attributes.zoom + '" img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_zoom_gallery_image]';

		},
	} );
	
	/** Pinned Gallery **/
	const template_clapat_pinned_gallery = [
	  [ 'montoya-gutenberg/pinned-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/pinned-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/pinned-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/pinned-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/pinned-gallery-image', {} ] // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/pinned-gallery', {
		title: __( 'Montoya: Pinned Gallery', 'montoya-gutenberg' ),
		icon: 'images-alt',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/pinned-gallery-image'],
		attributes: {
			randomize: {
				type: 'string',
				default: 'no'
			}
		}, 
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'pinned', 'montoya-gutenberg' ), __( 'gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-pinned-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt' } ),
									),
									__('Montoya Pinned Gallery', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/pinned-gallery-image'], template: template_clapat_pinned_gallery} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Randomize gallery image rotation?', 'montoya-gutenberg'),
										value: props.attributes.randomize,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { randomize: value } ); },
									} )
								),
							),
							
						);

		},

		save: function( props ) {
			
			let blockClasses = 'pinned-gallery';
			if( props.attributes.randomize !== 'no' ) { blockClasses += ' random-img-ratation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/pinned-gallery-image', {
		title: __( 'Montoya: Pinned Gallery Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/pinned-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_pinned_gallery_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_pinned_gallery_image]';

		},
	} );
	
	/** Reveal Gallery **/
	blocks.registerBlockType( 'montoya-gutenberg/reveal-gallery', {
		title: __( 'Montoya: Reveal Gallery', 'montoya-gutenberg' ),
		icon: 'tickets-alt',
		category: 'montoya-block-category',
		
		attributes: {
			left_image: {
				type: 'string',
				default: ''
			},
			left_image_id: {
				type: 'number',
			},
			center_image: {
				type: 'string',
				default: ''
			},
			center_image_id: {
				type: 'number',
			},
			right_image: {
				type: 'string',
				default: ''
			},
			right_image_id: {
				type: 'number',
			},
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'reveal', 'montoya-gutenberg' ), __( 'gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectLeftImage = function( media ) {
				return props.setAttributes( {
					left_image: media.url,
					left_image_id: media.id,
				} );
			};
			var onSelectCenterImage = function( media ) {
				return props.setAttributes( {
					center_image: media.url,
					center_image_id: media.id,
				} );
			};
			var onSelectRightImage = function( media ) {
				return props.setAttributes( {
					right_image: media.url,
					right_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-reveal-gallery is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-tickets-alt' } ),
						),
						__('Montoya Reveal Gallery', 'montoya-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectLeftImage,
							type: 'image',
							value: props.attributes.left_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.left_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.left_image_id ? i18n.__( 'Upload Left Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.left_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Left Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectCenterImage,
							type: 'image',
							value: props.attributes.center_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.center_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.center_image_id ? i18n.__( 'Upload Center Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.center_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Center (Fixed) Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectRightImage,
							type: 'image',
							value: props.attributes.right_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.right_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.right_image_id ? i18n.__( 'Upload Right Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.right_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Right Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' }, 
							el( SelectControl, {
								label: __('Animation Type', 'montoya-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'None', value: 'none' },
									{ label: 'Cover', value: 'cover' },
									{ label: 'Fade', value: 'fade' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'montoya-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							
							el( SelectControl, {
								label: __('Has Parallax', 'montoya-gutenberg'),
								value: props.attributes.parallax,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { parallax: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Start Parallax. A value between 0 and 1 representing the top parallax translation.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.parallax_start,
								onChange: ( value ) => { props.setAttributes( { parallax_start: value } ); },
							} ),
							
							el( TextControl, {
								label: __('End Parallax. A value between 0 and 1 representing the bottom parallax translation.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.parallax_end,
								onChange: ( value ) => { props.setAttributes( { parallax_end: value } ); },
							} ),
							
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_reveal_gallery left_img_url="' + props.attributes.left_image + '" left_img_id="' + props.attributes.left_image_id + '" center_img_url="' + props.attributes.center_image + '" center_img_id="' + props.attributes.center_image_id + '" right_img_url="' + props.attributes.right_image + '" right_img_id="' + props.attributes.right_image_id + '" extra_class_name="' + addClassName + '"][/clapat_reveal_gallery]'; 

		},
	} );
	
	/** Slowed Text Pin **/
	const template_clapat_slowed_text_pin_gallery = [
	  [ 'montoya-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'montoya-gutenberg/slowed-text-pin-gallery-image', {} ] // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/slowed-text-pin-gallery', {
		title: __( 'Montoya: Slowed Text Pin Gallery', 'montoya-gutenberg' ),
		icon: 'welcome-widgets-menus',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/slowed-text-pin-gallery-image'],
		
		attributes: {
			pre_title_text: {
				type: 'string',
				default: ''
			},
			title_text: {
				type: 'string',
				default: ''
			},
			subtitle_text: {
				type: 'string',
				default: ''
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'slowed text pin', 'montoya-gutenberg' ), __( 'gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slowed-text-pin-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-welcome-widgets-menus' } ),
									),
									__('Montoya Slowed Text Pin Gallery', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/slowed-text-pin-gallery-image'], template: template_clapat_slowed_text_pin_gallery} ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' },
								
									el( TextareaControl, {
										label: __('Pre Title', 'montoya-gutenberg'),
										value: props.attributes.pre_title_text,
										onChange: ( value ) => { props.setAttributes( { pre_title_text: value } ); },
									} ),
									
									el( TextareaControl, {
										label: __('Title', 'montoya-gutenberg'),
										value: props.attributes.title_text,
										onChange: ( value ) => { props.setAttributes( { title_text: value } ); },
									} ),
									
									el( TextareaControl, {
										label: __('Sub Title', 'montoya-gutenberg'),
										value: props.attributes.subtitle_text,
										onChange: ( value ) => { props.setAttributes( { subtitle_text: value } ); },
									} ),
									
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'slowed-pin';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'div', { className: 'slowed-text' },
							el( 'h5', {}, props.attributes.pre_title_text ),
							el( 'h1', { className: 'big-title' }, props.attributes.title_text ),
							el( 'hr' ),
							el( 'h5', {}, props.attributes.subtitle_text ),
						),
						el( 'div', { className: 'slowed-images' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/slowed-text-pin-gallery-image', {
		title: __( 'Montoya: Slowed Text Pin Gallery Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/slowed-text-pin-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_slowed_text_pin_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_slowed_text_pin_image]';

		},
	} );
	
	/** Accordion **/
	const template_clapat_accordion = [
	  [ 'montoya-gutenberg/accordion-item', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/accordion', {
		title: __( 'Montoya: Accordion', 'montoya-gutenberg' ),
		icon: 'editor-justify',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/accordion-item'],
		attributes: {
			type: {
				type: 'string',
				default: 'small-acc'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			}
		}, 

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'accordion', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-accordion is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-editor-justify' } ),
								),
								__('Montoya Accordion', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/accordion-item'], template: template_clapat_accordion} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Type', 'montoya-gutenberg'),
										value: props.attributes.type,
										options : [
											{ label: __('Small Accordion', 'montoya-gutenberg'), value: 'small-acc' },
											{ label: __('Big Accordion',  'montoya-gutenberg'), value: 'bigger-acc' },
										],
										onChange: ( value ) => { props.setAttributes( { type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'montoya-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'montoya-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						)	

		},

		save: function( props ) {
			
			let blockClasses = 'accordion';
			blockClasses += ' ' + props.attributes.type;
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'dl', { className: blockClasses, 'data-delay': props.attributes.animation_delay }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/accordion-item', {
		title: __( 'Montoya: Accordion Item', 'montoya-gutenberg' ),
		icon: 'editor-justify',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/accordion' ],

		attributes: {
			title: {
				type: 'string',
				default: __( 'Accordion Title. Click to edit it.', 'montoya-gutenberg')
			},
			content: {
				type: 'string',
				default: __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non est nec orci ultricies fringilla. Nam ultrices sem in odio scelerisque, sed mollis magna tincidunt.', 'montoya-gutenberg')
			}
		},

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.title,
						onChange: ( value ) => { props.setAttributes( { title: value } ); },
					}),
					
					el( PlainText, {
						className: 'clapat-inline-content',
						value: props.attributes.content,
						onChange: ( value ) => { props.setAttributes( { content: value } ); },
					} ),
				),
				
			];
		},

		save: function( props ) {
			
			return '[accordion_item title="' + props.attributes.title + '"]' + props.attributes.content + '[/accordion_item]'; 

		},
	} );
	
	/** List Rotator **/
	const template_clapat_list_rotator = [
	  [ 'montoya-gutenberg/list-rotator-item', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/list-rotator', {
		title: __( 'Montoya: List Rotator', 'montoya-gutenberg' ),
		icon: 'controls-repeat',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/list-rotator-item'],
		attributes: {
			title: {
				type: 'string',
				default:  __( 'Title here', 'montoya-gutenberg')
			}
		}, 

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'list rotator', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-list-rotator is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-controls-repeat' } ),
								),
								__('Montoya Rotator List', 'montoya-gutenberg' ) ),
							el( PlainText,
							{
								className: 'clapat-inline-caption montoya-rotator-list-title',
								value: props.attributes.title,
								onChange: ( value ) => { props.setAttributes( { title: value } ); },
							}),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/list-rotator-item'], template: template_clapat_list_rotator} ),
						)	

		},

		save: function( props ) {
			
			let blockClasses = 'list-rotator-wrapper';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
							el( 'div', { className: 'list-rotator-title' }, props.attributes.title ),
							el('div', { className: 'list-rotator-pin' },
								el('ul', { className: 'list-rotator primary-font-title' }, InnerBlocks.Content() ) ) );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/list-rotator-item', {
		title: __( 'Montoya: List Rotator Item', 'montoya-gutenberg' ),
		icon: 'controls-repeat',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/list-rotator' ],

		attributes: { 
			content: {
				type: 'string',
				default:  __( 'Content here', 'montoya-gutenberg')
			}
		},
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-list-rotator-item is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('List Rotator Item', 'montoya-gutenberg' ) ),
							el( PlainText,
							{
								className: 'clapat-inline-caption montoya-rotator-list-content',
								value: props.attributes.content,
								onChange: ( value ) => { props.setAttributes( { content: value } ); },
							}),
				
				),
				
			];
		},

		save: function( props ) {
			
			return el( 'li', {}, props.attributes.content );
	

		},
	} );
	
	/** Flex List **/
	const template_clapat_flex_list = [
	  [ 'montoya-gutenberg/flex-list-item', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/flex-list', {
		title: __( 'Montoya: Flex List', 'montoya-gutenberg' ),
		icon: 'text',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/list-rotator-item'],
		attributes: {	}, 

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'list rotator', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-flex-list is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-text' } ),
								),
								__('Montoya Flex List', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/flex-list-item'], template: template_clapat_flex_list} ),
						)	

		},

		save: function( props ) {
			
			let blockClasses = 'flex-lists-wrapper';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'ul', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/flex-list-item', {
		title: __( 'Montoya: Flex List Item', 'montoya-gutenberg' ),
		icon: 'text',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/flex-list' ],

		attributes: { 
			
			first_column: {
				type: 'string',
				default: __( 'Edit first column', 'montoya-gutenberg')
			},
			second_column: {
				type: 'string',
				default: __( 'Edit second column', 'montoya-gutenberg')
			},
			third_column: {
				type: 'string',
				default: __( 'Edit third column', 'montoya-gutenberg')
			},
		},
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-flex-list-item is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('Flex List Item', 'montoya-gutenberg' ) ),
							el( PlainText,
							{
								className: 'clapat-inline-caption montoya-flex-list-column',
								value: props.attributes.first_column,
								onChange: ( value ) => { props.setAttributes( { first_column: value } ); },
							}),
							el( PlainText,
							{
								className: 'clapat-inline-caption montoya-flex-list-column',
								value: props.attributes.second_column,
								onChange: ( value ) => { props.setAttributes( { second_column: value } ); },
							}),
							el( PlainText,
							{
								className: 'clapat-inline-caption montoya-flex-list-column',
								value: props.attributes.third_column,
								onChange: ( value ) => { props.setAttributes( { third_column: value } ); },
							}),
				),
				
			];
		},

		save: function( props ) {
			
			return el( 'li', { className: 'flex-list link has-animation' }, 
							el('span', { className: 'flex-list-left' },  props.attributes.first_column ),
							el('span', { className: 'flex-list-center' },  props.attributes.second_column ),
							el('span', { className: 'flex-list-right' },  props.attributes.third_column )	);
	

		}
		
	} );
	
	/** Icon Box **/
	blocks.registerBlockType( 'montoya-gutenberg/icon-box', {
		title: __( 'Montoya: Icon Box', 'montoya-gutenberg' ),
		icon: 'admin-generic',
		category: 'montoya-block-category',
		attributes: {
			icon: {
				type: 'string',
				default: __( 'fa fa-envelope', 'montoya-gutenberg')
			},
			title: {
				type: 'string',
				default: __( 'Icon Box Title. Click to edit it.', 'montoya-gutenberg')
			},
			type: {
				type: 'string',
				default: 'inline-boxes'
			},
			content: {
				type: 'string',
				default: __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non est nec orci ultricies fringilla. Nam ultrices sem in odio scelerisque, sed mollis magna tincidunt.', 'montoya-gutenberg')
			},
			
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ),  __( 'icon box', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-icon-box is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-admin-generic' } ),
								),
								__('Montoya Icon Box', 'montoya-gutenberg' ) ),
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.icon,
						onChange: ( value ) => { props.setAttributes( { icon: value } ); },
					}),
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.title,
						onChange: ( value ) => { props.setAttributes( { title: value } ); },
					}),
					
					el( PlainText, {
						className: 'clapat-inline-content',
						value: props.attributes.content,
						onChange: ( value ) => { props.setAttributes( { content: value } ); },
					} ),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Type', 'montoya-gutenberg'),
									value: props.attributes.type,
									options : [
										{ label: __('Inline', 'montoya-gutenberg'), value: 'inline-boxes' },
										{ label: __('Block',  'montoya-gutenberg'), value: 'block-boxes' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
							),
						),
					
				),
				 
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[icon_box icon="' + props.attributes.icon + '" title="' + props.attributes.title + '" type="' + props.attributes.type + '" extra_class_name="' + addClassName + '"]' + props.attributes.content + '[/icon_box]';
		},
	} );
	
	/** Image Collage **/
	const template_clapat_collage = [
	  [ 'montoya-gutenberg/collage-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/collage', {
		title: __( 'Montoya: Collage', 'montoya-gutenberg' ),
		icon: 'layout',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/collage-image'],
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'collage', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-collage is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Montoya Collage', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/collage-image'], template: template_clapat_collage} )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'justified-grid';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/collage-image', {
		title: __( 'Montoya: Collage Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/collage' ],

		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			full_image: {
				type: 'string',
				default: ''
			},
			full_image_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
			info: {
				type: 'string',
				default: __( 'Caption Text', 'montoya-gutenberg' )
			},
		},

		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					full_image: media.url,
					full_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Thumbnail Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.full_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.full_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.full_image_id ? i18n.__( 'Upload Popup Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.full_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Full Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'montoya-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
						
						el( TextControl, {
							label: __( 'Collage Image Info', 'montoya-gutenberg' ),
							value: props.attributes.info,
							onChange: ( value ) => { props.setAttributes( { info: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[clapat_collage_image thumb_img_url="' + props.attributes.thumb_image + '" img_url="' + props.attributes.full_image + '" alt="' + props.attributes.alt + '" info="' + props.attributes.info + '"][/clapat_collage_image]'; 

		},
	} );
	
	/** Image Carousel **/
	const template_clapat_image_carousel = [
	  [ 'montoya-gutenberg/carousel-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/carousel', {
		title: __( 'Montoya: Image Carousel', 'montoya-gutenberg' ),
		icon: 'slides',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/carousel-image'],
		attributes: {
			size: {
				type: 'string',
				default: 'looped-carousel'
			},
			cursor_type: {
				type: 'string',
				default: 'light-cursor'
			},
			autocenter: {
				type: 'string',
				default: 'yes'
			},
			enable_dots_nav: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'carousel', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	[
							el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slider is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Montoya Carousel', 'montoya-gutenberg' ) ),
								el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/carousel-image'], template: template_clapat_image_carousel} )
							),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Size', 'montoya-gutenberg'),
										value: props.attributes.size,
										options : [
											{ label: __('Big', 'montoya-gutenberg'), value: 'looped-carousel' },
											{ label: __('Small',  'montoya-gutenberg'), value: 'small-looped-carousel' },
										],
										onChange: ( value ) => { props.setAttributes( { size: value } ); },
									} ),
									el( SelectControl, {
										label: __('Cursor Type', 'montoya-gutenberg'),
										value: props.attributes.cursor_type,
										options : [
											{ label: __('Light', 'montoya-gutenberg'), value: 'light-cursor' },
											{ label: __('Dark',  'montoya-gutenberg'), value: 'dark-cursor' },
										],
										onChange: ( value ) => { props.setAttributes( { cursor_type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Autocenter', 'montoya-gutenberg'),
										value: props.attributes.autocenter,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { autocenter: value } ); },
									} ),
									el( SelectControl, {
										label: __('Enable Dots Nav', 'montoya-gutenberg'),
										value: props.attributes.enable_dots_nav,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { enable_dots_nav: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'montoya-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'montoya-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						];
		},

		save: function( props ) {
			
			let blockClasses = 'clapat-slider-wrapper content-slider';
			blockClasses += ' ' + props.attributes.cursor_type;
			blockClasses += ' ' + props.attributes.size;
			if( props.attributes.autocenter !== 'no' ) { blockClasses += ' autocenter'; }
			if( props.attributes.enable_dots_nav !== 'yes' ) { blockClasses += ' disabled-slider-dots'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let viewport_el = el( 'div', { className: 'clapat-slider-viewport' }, InnerBlocks.Content() );
			let inner_el = el( 'div', { className: 'clapat-slider' }, viewport_el );
			
			let button_next_el =  el( 'div', { className: 'clapat-button-next slider-button-next' } );
			let button_prev_el =  el( 'div', { className: 'clapat-button-prev slider-button-prev' } );
			let dots_nav =  el( 'div', { className: 'clapat-pagination' } );
			let slider_controls =  el( 'div', { className: 'clapat-controls' }, button_next_el, button_prev_el, dots_nav );
			
			return el( 'div', { 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay
							}, inner_el, slider_controls );
			
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/carousel-image', {
		title: __( 'Montoya: Carousel Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/carousel' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Carousel Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Carousel Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'montoya-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[carousel_slide img_url="' + props.attributes.img_url + '" alt="' + props.attributes.alt + '"][/carousel_slide]'; 

		},
	} );
	
	/** Image Slider **/
	const template_clapat_image_slider = [
	  [ 'montoya-gutenberg/slider-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/slider', {
		title: __( 'Montoya: Image Slider', 'montoya-gutenberg' ),
		icon: 'images-alt2',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/slider-image'],
		
		attributes: {
			cursor_type: {
				type: 'string',
				default: 'light-cursor'
			},
			autocenter: {
				type: 'string',
				default: 'yes'
			},
			enable_dots_nav: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'slider', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slider is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt2' } ),
									),
									__('Montoya Slider', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/slider-image'], template: template_clapat_image_slider} ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Cursor Type', 'montoya-gutenberg'),
										value: props.attributes.cursor_type,
										options : [
											{ label: __('Light', 'montoya-gutenberg'), value: 'light-cursor' },
											{ label: __('Dark',  'montoya-gutenberg'), value: 'dark-cursor' },
										],
										onChange: ( value ) => { props.setAttributes( { cursor_type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Autocenter', 'montoya-gutenberg'),
										value: props.attributes.autocenter,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { autocenter: value } ); },
									} ),
									el( SelectControl, {
										label: __('Enable Dots Nav', 'montoya-gutenberg'),
										value: props.attributes.enable_dots_nav,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { enable_dots_nav: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'montoya-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'montoya-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
									
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'clapat-slider-wrapper content-slider';
			blockClasses += ' ' + props.attributes.cursor_type;
			if( props.attributes.autocenter !== 'no' ) { blockClasses += ' autocenter'; }
			if( props.attributes.enable_dots_nav !== 'yes' ) { blockClasses += ' disabled-slider-dots'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let viewport_el = el( 'div', { className: 'clapat-slider-viewport' }, InnerBlocks.Content() );
			let inner_el = el( 'div', { className: 'clapat-slider' }, viewport_el );
			
			let button_next_el =  el( 'div', { className: 'clapat-button-next slider-button-next' } );
			let button_prev_el =  el( 'div', { className: 'clapat-button-prev slider-button-prev' } );
			let dots_nav =  el( 'div', { className: 'clapat-pagination' } );
			let slider_controls =  el( 'div', { className: 'clapat-controls' }, button_next_el, button_prev_el, dots_nav );
			
			return el( 'div', { 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay
							}, inner_el, slider_controls );
				
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/slider-image', {
		title: __( 'Montoya: Slider Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/slider' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Slider Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Slider Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'montoya-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[general_slide img_url="' + props.attributes.img_url + '" alt="' + props.attributes.alt + '"][/general_slide]'; 

		},
	} );
	
	/** Counter **/
	blocks.registerBlockType( 'montoya-gutenberg/counter', {
		title: __( 'Montoya: Counter', 'montoya-gutenberg' ),
		icon: 'performance',
		category: 'montoya-block-category',
		
		attributes: {
			data_start: {
				type: 'string',
				default: '1000'
			},
			data_target: {
				type: 'string',
				default: '3000'
			},
			data_symbol: {
				type: 'string',
				default: ''
			},
			text_size: {
				type: 'string',
				default: 'h1'
			},
			animation_type: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'counter', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-counter is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-performance' } ),
						),
						__('Montoya Counter', 'montoya-gutenberg' ) ),
					
					el ( props.attributes.text_size, { className: 'clapat-inline-value' }, props.attributes.data_start ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Start Value', 'montoya-gutenberg'),
								type: "number",
								value: props.attributes.data_start,
								onChange: ( value ) => { props.setAttributes( { data_start: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Target Value', 'montoya-gutenberg'),
								type: "number",
								value: props.attributes.data_target,
								onChange: ( value ) => { props.setAttributes( { data_target: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Symbol (example: %, +)', 'montoya-gutenberg'),
								type: "string",
								value: props.attributes.data_symbol,
								onChange: ( value ) => { props.setAttributes( { data_symbol: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Text Size', 'montoya-gutenberg'),
								value: props.attributes.text_size,
								options: [
									{ label: 'H1', value: 'h1' },
									{ label: 'H2', value: 'h2' },
									{ label: 'H3', value: 'h3' },
									{ label: 'H4', value: 'h4' },
									{ label: 'H5', value: 'h5' },
									{ label: 'H6', value: 'h6' },
								],
								onChange: ( value ) => { props.setAttributes( { text_size: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Has Animation', 'montoya-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'montoya-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_counter data_start="' + props.attributes.data_start + '" data_target="' + props.attributes.data_target + '" data_symbol="' + props.attributes.data_symbol + '" text_size="' + props.attributes.text_size + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/clapat_counter]';

		},
	} );
	
	/** Clipped Image **/
	blocks.registerBlockType( 'montoya-gutenberg/clipped-image', {
		title: __( 'Montoya: Clipped Image', 'montoya-gutenberg' ),
		icon: 'image-flip-horizontal',
		category: 'montoya-block-category',
		
		attributes: {
			clipped_image: {
				type: 'string',
				default: ''
			},
			clipped_image_id: {
				type: 'number',
			},
			clipped_image_alt: {
				type: 'string',
			},
			clipped_video: {
				type: 'string',
				default: ''
			},
			clipped_width: {
				type: 'string',
				default: 'content-full-width'
			}
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'clipped image', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
		
			const colorsText = [ 
				{ name: 'Default', color: '#0c0c0c' }
			];
			
			var onSelectClippedImage = function( media ) {
				return props.setAttributes( {
					clipped_image: media.url,
					clipped_image_id: media.id,
					clipped_image_alt: media.alt,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-clipped-image is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Montoya Clipped Image', 'montoya-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectClippedImage,
							type: 'image',
							value: props.attributes.clipped_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.clipped_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.clipped_image_id ? i18n.__( 'Upload Clipped Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.clipped_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Clipped Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					el( InnerBlocks, {} ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' },

							el( TextControl, {
								label: __('Video URL. Self-hosted video URL (usually in .mp4 format) to have a clipped video.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.clipped_video,
								onChange: ( value ) => { props.setAttributes( { clipped_video: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Content Width', 'montoya-gutenberg'),
								value: props.attributes.clipped_width,
								options: [
									{ label: 'Full Width', value: 'content-full-width' },
									{ label: 'Boxed Width', value: 'content-max-width' }
								],
								onChange: ( value ) => { props.setAttributes( { clipped_width: value } ); },
							} ),
							
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'clipped-image-wrapper';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
						
			let clippedClasses = 'clipped-image-content';
			clippedClasses += ' ' + props.attributes.clipped_width;
			
			let elClippedVideo = null;
			if( props.attributes.clipped_video ){
				
				elClippedVideo = el('div', { className: 'content-video-wrapper' },
									el( 'video', {className: 'bgvid', 'loop':true, 'muted':true, 'playsinline':true },
									el('source', {'src':props.attributes.clipped_video, 'type':'video/mp4'} ) ) );
			}
			let elClippedImage = el( 'div', { className: 'clipped-image' },
									el('img', { 'src': props.attributes.clipped_image, 'alt': props.attributes.clipped_image_alt } ), elClippedVideo, el('div', {className: 'clipped-image-gradient'} ) );
			let elImagePin = el( 'div', { className: 'clipped-image-pin' }, elClippedImage );
			let elContent = el( 'div', { className: clippedClasses }, InnerBlocks.Content() );
			
			return el( 'div', { className: blockClasses }, elImagePin, elContent );

		},
	} );
	
	/** Parallax Image **/
	blocks.registerBlockType( 'montoya-gutenberg/parallax-image', {
		title: __( 'Montoya: Parallax Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		
		attributes: {
			parallax_image: {
				type: 'string',
				default: ''
			},
			parallax_image_id: {
				type: 'number',
			},
			parallax_image_alt: {
				type: 'string',
				default: ''
			},
			parallax_video_url: {
				type: 'string',
				default: ''
			},
			parallax_width: {
				type: 'string',
				default: 'content-full-width'
			},
			caption_alignment: {
				type: 'string',
				default: 'text-align-center'
			},
			animation_type: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'parallax', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					parallax_image: media.url,
					parallax_image_id: media.id,
					parallax_image_alt: media.alt,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-parallax-image is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Montoya Parallax Image', 'montoya-gutenberg' ) ),
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.parallax_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.parallax_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.parallax_image_id ? i18n.__( 'Upload Parallax Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.parallax_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Parallax Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					el( InnerBlocks, {} ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Video URL - for parallax videos. MP4 Format.', 'montoya-gutenberg'),
								value: props.attributes.parallax_video_url,
								onChange: ( value ) => { props.setAttributes( { parallax_video_url: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Caption Alignment', 'montoya-gutenberg'),
								value: props.attributes.caption_alignment,
								options: [
									{ label: 'Center', value: 'text-align-center' },
									{ label: 'Left', value: 'text-align-left' },
								],
								onChange: ( value ) => { props.setAttributes( { caption_alignment: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Content Width', 'montoya-gutenberg'),
								value: props.attributes.parallax_width,
								options: [
									{ label: 'Full Width', value: 'content-full-width' },
									{ label: 'Boxed Width', value: 'content-max-width' }
								],
								onChange: ( value ) => { props.setAttributes( { parallax_width: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Has Animation', 'montoya-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'montoya-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'has-parallax has-parallax-content';
			if( props.attributes.animation_type !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
						
			let contentClasses = 'parallax-image-content';
			contentClasses += ' ' + props.attributes.parallax_width;
			contentClasses += ' ' + props.attributes.caption_alignment;
			
			let elParallaxVideo = null;
			if( props.attributes.parallax_video_url ){
				
				elParallaxVideo = el('div', { className: 'content-video-wrapper' },
									el( 'video', {className: 'bgvid', 'loop':true, 'muted':true, 'playsinline':true },
									el('source', {'src':props.attributes.parallax_video_url, 'type':'video/mp4'} ) ) );
			}
			let elParallaxImage = el('img', { 'src': props.attributes.parallax_image, 'alt': props.attributes.parallax_image_alt } );
			
			let elContent = el( 'div', { className: contentClasses }, 
										el( 'div', { className: 'outer' },
											el( 'div', {className: 'inner' }, InnerBlocks.Content() ) ) );
			
			return el( 'figure', { className: blockClasses, 'data-delay': props.attributes.animation_delay }, elParallaxImage, elParallaxVideo, elContent );

		},
	} );
	
	/** Popup Image **/
	blocks.registerBlockType( 'montoya-gutenberg/popup-image', {
		title: __( 'Montoya: Popup Image', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		
		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			full_image: {
				type: 'string',
				default: ''
			},
			full_image_id: {
				type: 'number',
			},
			animation_type: {
				type: 'string',
				default: 'none'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
			parallax: {
				type: 'string',
				default: 'no'
			},
			parallax_start: {
				type: 'string',
				default: '0.0'
			},
			parallax_end: {
				type: 'string',
				default: '0.0'
			},
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'popup', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					full_image: media.url,
					full_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-popup-image is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Montoya Popup Image', 'montoya-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Popup Thumbnail Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.full_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.full_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Popup Full Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.full_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Full Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' }, 
							el( SelectControl, {
								label: __('Animation Type', 'montoya-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'None', value: 'none' },
									{ label: 'Cover', value: 'cover' },
									{ label: 'Fade', value: 'fade' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'montoya-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							
							el( SelectControl, {
								label: __('Has Parallax', 'montoya-gutenberg'),
								value: props.attributes.parallax,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { parallax: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Start Parallax. A value between 0 and 1 representing the top parallax translation.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.parallax_start,
								onChange: ( value ) => { props.setAttributes( { parallax_start: value } ); },
							} ),
							
							el( TextControl, {
								label: __('End Parallax. A value between 0 and 1 representing the bottom parallax translation.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.parallax_end,
								onChange: ( value ) => { props.setAttributes( { parallax_end: value } ); },
							} ),
							
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_popup_image img_url="' + props.attributes.full_image + '" img_id="' + props.attributes.full_image_id + '" thumb_url="' + props.attributes.thumb_image + '" thumb_id="' + props.attributes.thumb_image_id + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" parallax="' + props.attributes.parallax + '" start_parallax="' + props.attributes.parallax_start + '" end_parallax="' + props.attributes.parallax_end + '" extra_class_name="' + addClassName + '"][/clapat_popup_image]'; 

		},
	} );
	
	/** Popup Video **/
	blocks.registerBlockType( 'montoya-gutenberg/popup-video', {
		title: __( 'Montoya: Popup Video', 'montoya-gutenberg' ),
		icon: 'format-video',
		category: 'montoya-block-category',
		
		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			video_url: {
				type: 'string',
				default: ''
			},
			animation_type: {
				type: 'string',
				default: 'none'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'popup', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-popup-video is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Montoya Popup Video', 'montoya-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Video Thumbnail Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' }, 
							el( TextControl, {
								label: __('Video URL (Youtube or Vimeo)', 'montoya-gutenberg'),
								value: props.attributes.video_url,
								onChange: ( value ) => { props.setAttributes( { video_url: value } ); },
							} ),
						
							el( SelectControl, {
								label: __('Animation Type', 'montoya-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'None', value: 'none' },
									{ label: 'Cover', value: 'cover' },
									{ label: 'Fade', value: 'fade' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
							
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'montoya-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
							} ) ),
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_popup_video video_url="' + props.attributes.video_url + '" thumb_url="' + props.attributes.thumb_image + '" thumb_id="' + props.attributes.thumb_image_id + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/clapat_popup_video]'; 

		},
	} );
	
	/** Team Members **/
	const template_clapat_team_members = [
	  [ 'montoya-gutenberg/team-member', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'montoya-gutenberg/team-members', {
		title: __( 'Montoya: Team Members', 'montoya-gutenberg' ),
		icon: 'businessman',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/team-member'],
	
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'team member', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-team-members is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
								),
								__('Montoya Team Members', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/team-member'], template: template_clapat_team_members } )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'team-members-list';
			
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'ul', { className: blockClasses, 'data-fx': '1' }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/team-member', {
		title: __( 'Montoya: Team Member', 'montoya-gutenberg' ),
		icon: 'editor-quote',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/team-members' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			since: {
				type: 'string',
				default: ''
			},
			name: {
				type: 'string',
				default: ''
			},
			position: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Team Member Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Since:', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.since,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { since: value } ); },
					}),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Name:', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.name,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { name: value } ); },
					}),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Position:', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.position,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { position: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[team_member img_url="' + props.attributes.img_url + '" since="' + props.attributes.since + '" name="' + props.attributes.name + '" position="' + props.attributes.position + '"][/team_member]'; 

		},
	} );
	
	/** Clients **/
	const template_clapat_clients = [
	  [ 'montoya-gutenberg/client', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'montoya-gutenberg/clients', {
		title: __( 'Montoya: Clients', 'montoya-gutenberg' ),
		icon: 'businessman',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/client'],
		attributes: {
			has_borders: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
	
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'client', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-clients is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
									),
									__('Montoya Clients', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/client'], template: template_clapat_clients } ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Table has borders', 'montoya-gutenberg'),
										value: props.attributes.has_borders,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_borders: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'montoya-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'montoya-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'clients-table';
			
			if( props.attributes.has_borders !== 'yes' ) { blockClasses += ' no-borders'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'ul', 
							{ 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay,
							}, InnerBlocks.Content() );
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/client', {
		title: __( 'Montoya: Client', 'montoya-gutenberg' ),
		icon: 'editor-quote',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/clients' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			client_url: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Client Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Client Image', 'montoya-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Client URL', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.client_url,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { client_url: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[client_item img_url="' + props.attributes.img_url + '" client_url="' + props.attributes.client_url + '"][/client_item]'; 

		},
	} );
	
	/** Moving Clients Gallery **/
	const template_clapat_clients_moving_gallery = [
	  [ 'montoya-gutenberg/clients-moving-gallery-item', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'montoya-gutenberg/clients-moving-gallery', {
		title: __( 'Montoya: Clients Moving Gallery', 'montoya-gutenberg' ),
		icon: 'businessman',
		category: 'montoya-block-category',
		allowedBlocks: ['montoya-gutenberg/clients-moving-gallery-item'],
		attributes: {
			direction: {
				type: 'string',
				default: 'fw-gallery'
			}
		}, 
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'clients moving gallery', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-clients-moving-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
									),
									__('Montoya Clients Moving Gallery', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['montoya-gutenberg/clients-moving-gallery-image'], template: template_clapat_clients_moving_gallery} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Direction', 'montoya-gutenberg'),
										value: props.attributes.direction,
										options : [
											{ label: __('Forward', 'montoya-gutenberg'), value: 'fw-gallery' },
											{ label: __('Backward', 'montoya-gutenberg'), value: 'bw-gallery' },
										],
										onChange: ( value ) => { props.setAttributes( { direction: value } ); },
									} )
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'moving-gallery';
			blockClasses += ' ' + props.attributes.direction;
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'ul', { className: 'wrapper-gallery' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'montoya-gutenberg/clients-moving-gallery-item', {
		title: __( 'Montoya: Client', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/clients-moving-gallery' ],

		attributes: {
			client_image: {
				type: 'string',
				default: ''
			},
			client_image_id: {
				type: 'number',
			},
			client_name: {
				type: 'string',
				default: ''
			},
			client_url: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					client_image: media.url,
					client_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.client_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.client_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.client_image_id ? i18n.__( 'Upload Client Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.client_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Client Image', 'montoya-gutenberg' ) )
								);
							}
						} ),
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Client Name', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.client_name,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { client_name: value } ); },
					}),
						
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Client URL', 'montoya-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.client_url,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { client_url: value } ); },
					}),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_clients_moving_gallery_item img_url="' + props.attributes.client_image + '" img_id="' + props.attributes.client_image_id + '" client_name="' + props.attributes.client_name + '" client_url="' + props.attributes.client_url + '"][/clapat_clients_moving_gallery_item]'; 

		},
	} );
	
	/** Pinned Section **/
	const PINNED_SECTION_ALLOWED_BLOCKS = [ 'montoya-gutenberg/scrolling-element', 'montoya-gutenberg/pinned-element' ]
	
	const RIGHT_PINNED_SECTION_TEMPLATE = [
				[ 'montoya-gutenberg/scrolling-element', { className:'left' } ],
				[ 'montoya-gutenberg/pinned-element', { className:'right' } ]
			];

	blocks.registerBlockType( 'montoya-gutenberg/right-pinned-section', {
		title: __( 'Montoya: Right Pinned Section', 'montoya-gutenberg' ),
		icon: 'image-rotate-right',
		category: 'montoya-block-category',
		
		attributes: {},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'right pinned text', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-right-pinned-section is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-image-rotate-right' } ),
						),
						__('Montoya Right Pinned Section', 'montoya-gutenberg' ) ),
					
					el( InnerBlocks,
						{
							template: RIGHT_PINNED_SECTION_TEMPLATE,
							templateLock: 'all',
							allowedBlocks: PINNED_SECTION_ALLOWED_BLOCKS,
							orientation: 'horizontal'
						} ),
				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'pinned-section';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses	}, InnerBlocks.Content() );

		},
		
	} );
	
	const LEFT_PINNED_SECTION_TEMPLATE = [
				[ 'montoya-gutenberg/pinned-element', { className:'left' } ],
				[ 'montoya-gutenberg/scrolling-element', { className:'right' } ]
			];

	blocks.registerBlockType( 'montoya-gutenberg/left-pinned-section', {
		title: __( 'Montoya: Left Pinned Section', 'montoya-gutenberg' ),
		icon: 'image-rotate-left',
		category: 'montoya-block-category',
		
		attributes: {},

		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'left pinned text', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-left-pinned-section is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-image-rotate-right' } ),
						),
						__('Montoya Left Pinned Section', 'montoya-gutenberg' ) ),
					
					el( InnerBlocks,
						{
							template: LEFT_PINNED_SECTION_TEMPLATE,
							templateLock: 'all',
							allowedBlocks: PINNED_SECTION_ALLOWED_BLOCKS,
							orientation: 'horizontal'
						} ),
					
				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'pinned-section';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', {	className: blockClasses	}, InnerBlocks.Content() );

		},
		
	} );
	
	const PINNED_ELEMENT_TEMPLATE = [
				[ 'core/html', {} ],
			];
	blocks.registerBlockType( 'montoya-gutenberg/pinned-element', {
		title: __( 'Montoya: Pinned Element', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/right-pinned-section', 'montoya-gutenberg/left-pinned-section' ],

		attributes: { },

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-pinned-content is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('Pinned Content', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {
								template: PINNED_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
				
				),
				
			];
		},

		save: function( props ) {
			let blockClasses = 'pinned-element';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	const SCROLLING_ELEMENT_TEMPLATE = [
				[ 'core/html', {} ],
			];
	blocks.registerBlockType( 'montoya-gutenberg/scrolling-element', {
		title: __( 'Montoya: Scrolling Element', 'montoya-gutenberg' ),
		icon: 'format-image',
		category: 'montoya-block-category',
		parent: [ 'montoya-gutenberg/right-pinned-section', 'montoya-gutenberg/left-pinned-section' ],

		attributes: { },

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-pinned-content is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('Scrolling Content', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {
								template: SCROLLING_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
				
				),
				
			];
		},

		save: function( props ) {
			let blockClasses = 'scrolling-element';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	/** Portfolio Grid **/
	blocks.registerBlockType( 'montoya-gutenberg/portfolio-grid', {
		title: __( 'Montoya: Portfolio Grid', 'montoya-gutenberg' ),
		icon: 'grid-view',
		category: 'montoya-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: ''
			},
			filter_category: {
				type: 'string',
				default: ''
			},
			thumbs_effect: {
				type: 'string',
				default: 'webgl-fitthumbs'
			},
			thumbs_effect_webgl: {
				type: 'string',
				default: 'fx-one'
			},			
		},

		keywords: [ __( 'montoya', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'portfolio', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'montoya-editor-block-wrapper clapat-editor-portfolio-grid is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-grid-view' } ),
						),
						__('Montoya Portfolio Grid', 'montoya-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of portfolio items. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more portfolio categories separated by comma. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Thumbs effect', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect,
								options: [
									{ label: 'WebGL Animation', value: 'webgl-fitthumbs' },
									{ label: 'None', value: 'no-fitthumbs' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('WebGL Animation Type', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect_webgl,
								options: [
									{ label: 'FX One', value: 'fx-one' },
									{ label: 'FX Two', value: 'fx-two' },
									{ label: 'FX Three', value: 'fx-three' },
									{ label: 'FX Four', value: 'fx-four' },
									{ label: 'FX Five', value: 'fx-five' },
									{ label: 'FX Six', value: 'fx-six' },
									{ label: 'FX Seven', value: 'fx-seven' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect_webgl: value } ); },
							} ),
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[montoya_portfolio_grid items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" thumbs_effect="' + props.attributes.thumbs_effect + '" thumbs_effect_webgl="' + props.attributes.thumbs_effect_webgl + '" extra_class_name=""][/montoya_portfolio_grid]';

		},
	} );
	
		/** Portfolio Overlapping Gallery **/
	blocks.registerBlockType( 'montoya-gutenberg/portfolio-overlapping-gallery', {
		title: __( 'Montoya: Portfolio Overlapping Gallery', 'montoya-gutenberg' ),
		icon: 'format-gallery',
		category: 'montoya-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: ''
			},
			filter_category: {
				type: 'string',
				default: ''
			},
			thumbs_effect: {
				type: 'string',
				default: 'webgl-fitthumbs'
			},
			thumbs_effect_webgl: {
				type: 'string',
				default: 'fx-one'
			},			
		},

		keywords: [ __( 'montoya', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'portfolio', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'montoya-editor-block-wrapper clapat-editor-portfolio-grid is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-gallery' } ),
						),
						__('Montoya Portfolio Overlapping Gallery', 'montoya-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of portfolio items. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more portfolio categories separated by comma. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Thumbs effect', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect,
								options: [
									{ label: 'WebGL Animation', value: 'webgl-fitthumbs' },
									{ label: 'None', value: 'no-fitthumbs' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('WebGL Animation Type', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect_webgl,
								options: [
									{ label: 'FX One', value: 'fx-one' },
									{ label: 'FX Two', value: 'fx-two' },
									{ label: 'FX Three', value: 'fx-three' },
									{ label: 'FX Four', value: 'fx-four' },
									{ label: 'FX Five', value: 'fx-five' },
									{ label: 'FX Six', value: 'fx-six' },
									{ label: 'FX Seven', value: 'fx-seven' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect_webgl: value } ); },
							} ),
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[montoya_portfolio_overlapping_gallery items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" thumbs_effect="' + props.attributes.thumbs_effect + '" thumbs_effect_webgl="' + props.attributes.thumbs_effect_webgl + '" extra_class_name=""][/montoya_portfolio_overlapping_gallery]';

		},
	} );
	
	/** Portfolio Parallax Gallery **/
	blocks.registerBlockType( 'montoya-gutenberg/portfolio-parallax-gallery', {
		title: __( 'Montoya: Portfolio Parallax Gallery', 'montoya-gutenberg' ),
		icon: 'format-gallery',
		category: 'montoya-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: ''
			},
			filter_category: {
				type: 'string',
				default: ''
			},
			thumbs_effect: {
				type: 'string',
				default: 'webgl-fitthumbs'
			},
			thumbs_effect_webgl: {
				type: 'string',
				default: 'fx-one'
			},			
		},

		keywords: [ __( 'montoya', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'portfolio', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'montoya-editor-block-wrapper clapat-editor-portfolio-parallax is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-gallery' } ),
						),
						__('Montoya Portfolio Parallax Gallery', 'montoya-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of portfolio items. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more portfolio categories separated by comma. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Thumbs effect', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect,
								options: [
									{ label: 'WebGL Animation', value: 'webgl-fitthumbs' },
									{ label: 'None', value: 'no-fitthumbs' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('WebGL Animation Type', 'montoya-gutenberg'),
								value: props.attributes.thumbs_effect_webgl,
								options: [
									{ label: 'FX One', value: 'fx-one' },
									{ label: 'FX Two', value: 'fx-two' },
									{ label: 'FX Three', value: 'fx-three' },
									{ label: 'FX Four', value: 'fx-four' },
									{ label: 'FX Five', value: 'fx-five' },
									{ label: 'FX Six', value: 'fx-six' },
									{ label: 'FX Seven', value: 'fx-seven' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect_webgl: value } ); },
							} ),
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[montoya_portfolio_parallax_gallery items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" thumbs_effect="' + props.attributes.thumbs_effect + '" thumbs_effect_webgl="' + props.attributes.thumbs_effect_webgl + '" extra_class_name=""][/montoya_portfolio_parallax_gallery]';

		},
	} );
		
	/** News List **/
	blocks.registerBlockType( 'montoya-gutenberg/news-list', {
		title: __( 'Montoya: News', 'montoya-gutenberg' ),
		icon: 'grid-view',
		category: 'montoya-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: '4'
			},
			filter_category: {
				type: 'string',
				default: ''
			}
		},

		keywords: [ __( 'montoya', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'news', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-news is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-grid-view' } ),
						),
						__('Montoya News List', 'montoya-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of post items. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more blog categories separated by comma. Leave empty for ALL.', 'montoya-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} )
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[montoya_news items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" extra_class_name=""][/montoya_news]';

		},
	} );
	
	/** Hosted Video **/
	blocks.registerBlockType( 'montoya-gutenberg/video-hosted', {
		title: __( 'Montoya: Hosted Video', 'montoya-gutenberg' ),
		icon: 'video-alt',
		category: 'montoya-block-category',
		attributes: {
			cover_image: {
				type: 'string',
				default: ''
			},
			cover_image_id: {
				type: 'number',
			},
			webm_url: {
				type: 'string',
				default: 'http://'
			},
			mp4_url: {
				type: 'string',
				default: 'http://'
			},
			
		},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'video', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					cover_image: media.url,
					cover_image_id: media.id,
				} );
			};
			
			return [
				
				 el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-hosted-video is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Montoya Hosted Video', 'montoya-gutenberg' ) ),
						
						el( 'div', { className: 'clapat-editor-image' },
							el( MediaUpload, {
								onSelect: onSelectImage,
								type: 'image',
								value: props.attributes.cover_image_id,
								render: function( obj ) {
									return el( components.Button, {
											className: props.attributes.cover_image_id ? 'clapat-image-added' : 'button button-large',
											onClick: obj.open
										},
										! props.attributes.cover_image_id ? i18n.__( 'Upload Video Cover Image', 'montoya-gutenberg' ) : el( 'img', { src: props.attributes.cover_image } ),
										el ('div', { className: 'components-placeholder__instructions' }, __( 'Cover Image', 'montoya-gutenberg' ) )
									);
								}
							} ),
						),
						
						el ('div', { className: 'components-placeholder__instructions' }, __( 'MP4 video url:', 'montoya-gutenberg' ) ),
						
						el( PlainText,
						{
							value: props.attributes.mp4_url,
							className: 'clapat-inline-content',
							onChange: ( value ) => { props.setAttributes( { mp4_url: value } ); },
						}),
						
						el ('div', { className: 'components-placeholder__instructions' }, __( 'Webm video url:', 'montoya-gutenberg' ) ),
						
						el( PlainText,
						{
							value: props.attributes.webm_url,
							className: 'clapat-inline-content',
							onChange: ( value ) => { props.setAttributes( { webm_url: value } ); },
						}),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_video cover_img_url="' + props.attributes.cover_image + '" mp4_url="' + props.attributes.mp4_url + '" webm_url="' + props.attributes.webm_url + '" extra_class_name="' + addClassName + '"][/clapat_video]';
		},
	} );
	

	/** Google Map **/
	blocks.registerBlockType( 'montoya-gutenberg/google-map', {
		title: __( 'Montoya: Google Map', 'montoya-gutenberg' ),
		icon: 'admin-site',
		category: 'montoya-block-category',
		attributes: {	},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ),  __( 'map', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-google-map is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-admin-site' } ),
									),
									__('Montoya Google Map', 'montoya-gutenberg' ) ),
								el( 'span', { className: 'clapat-inline-caption' }, __( 'Set google map properties in customizer - map settings.', 'montoya-gutenberg' ) ),
				)
						
			]
		},
		save: function( props ) {
			
			return '[clapat_map][/clapat_map]'; 
		},
	} );
	
	/** Animated Line **/
	blocks.registerBlockType( 'montoya-gutenberg/animated-line', {
		title: __( 'Montoya: Animated Line', 'montoya-gutenberg' ),
		icon: 'ellipsis',
		category: 'montoya-block-category',
		attributes: {	},
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ),  __( 'animated line', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-animated-line is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-ellipsis' } ),
									),
									__('Montoya Animated Line', 'montoya-gutenberg' ) ),
				)
						
			]
		},
		save: function( props ) {
			
			return el('hr', {className: 'animated-line has-animation'}); 
		},
	} );
	
	/** Container **/
	blocks.registerBlockType( 'montoya-gutenberg/container', {
		title: __( 'Montoya: Container', 'montoya-gutenberg' ),
		icon: 'analytics',
		category: 'montoya-block-category',
		attributes: {
			background_color: {
				type: 'string',
				default: '#ffffff'
			},
			type: {
				type: 'string',
				default: 'light-section'
			},
			width: {
				type: 'string',
				default: 'normal'
			},
			padding_top: {
				type: 'string',
				default: 'no'
			},
			padding_bottom: {
				type: 'string',
				default: 'no'
			},
			padding_left: {
				type: 'string',
				default: 'no'
			},
			padding_right: {
				type: 'string',
				default: 'no'
			},
			change_header_color: {
				type: 'string',
				default: 'no'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			has_clip_path: {
				type: 'string',
				default: 'no'
			},
			alignment: {
				type: 'string',
				default: 'left'
			},
		}, 
		
		keywords: [ __( 'clapat', 'montoya-gutenberg'), __( 'shortcode', 'montoya-gutenberg' ), __( 'container', 'montoya-gutenberg' ) ],
		
		edit: function( props ) {
			
			const colors = [ 
				{ name: 'Default', color: '#ffffff' }, 
				{ name: 'Light Grey', color: '#eeeeee' }, 
				{ name: 'Dark Grey', color: '#171717' }, 
				{ name: 'Black', color: '#000000' },
			];
			
			function onChangeAlignment( newAlignment ) {
				props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
			}
			
			return	[ el( BlockControls,
							{ key: 'controls' },
							el(
								AlignmentToolbar,
								{
									value: props.attributes.alignment,
									onChange: onChangeAlignment,
								}
							)
						),
						el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-container is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-analytics' } ),
								),
								__('Montoya Container', 'montoya-gutenberg' ) ),
							el( InnerBlocks, {} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( 'strong', {}, __('Select Background Color:',  'montoya-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colors,
											value: props.attributes.background_color,
											onChange: ( value ) => { 
												props.setAttributes( { background_color: value === undefined ? 'transparent' : value } ); 
											},
										} )
									),
									el( SelectControl, {
										label: __('Type', 'montoya-gutenberg'),
										value: props.attributes.type,
										options : [
											{ label: __('Light', 'montoya-gutenberg'), value: 'light-section' },
											{ label: __('Dark',  'montoya-gutenberg'), value: 'dark-section' },
										],
										onChange: ( value ) => { props.setAttributes( { type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Invert header color', 'montoya-gutenberg'),
										desc: __('Inverts header color depending on Type: light or dark', 'montoya-gutenberg'),
										value: props.attributes.change_header_color,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { change_header_color: value } ); },
									} ),
									el( SelectControl, {
										label: __('Width', 'montoya-gutenberg'),
										value: props.attributes.width,
										options : [
											{ label: __('Normal', 'montoya-gutenberg'), value: 'normal' },
											{ label: __('Small',  'montoya-gutenberg'), value: 'small' },
											{ label: __('Full',  'montoya-gutenberg'), value: 'full' },
										],
										onChange: ( value ) => { props.setAttributes( { width: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has top padding', 'montoya-gutenberg'),
										value: props.attributes.padding_top,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_top: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has bottom padding', 'montoya-gutenberg'),
										value: props.attributes.padding_bottom,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_bottom: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has left padding', 'montoya-gutenberg'),
										value: props.attributes.padding_left,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_left: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has right padding', 'montoya-gutenberg'),
										value: props.attributes.padding_right,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_right: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'montoya-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has clip path', 'montoya-gutenberg'),
										value: props.attributes.has_clip_path,
										options : [
											{ label: __('Yes', 'montoya-gutenberg'), value: 'yes' },
											{ label: __('No',  'montoya-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_clip_path: value } ); },
									} ),
								),
							),
						)	
					];
		},

		save: function( props ) {
			let blockClasses = 'content-row';
			blockClasses += ' ' + props.attributes.type;
			blockClasses += ' ' + props.attributes.width;
			if( props.attributes.padding_top !== 'no' ) { blockClasses += ' row_padding_top'; }
			if( props.attributes.padding_bottom !== 'no' ) { blockClasses += ' row_padding_bottom'; }
			if( props.attributes.padding_left !== 'no' ) { blockClasses += ' row_padding_left'; }
			if( props.attributes.padding_right !== 'no' ) { blockClasses += ' row_padding_right'; }
			if( props.attributes.change_header_color !== 'no' ) { blockClasses += ' change-header-color'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.attributes.has_clip_path !== 'no' ) { blockClasses += ' has-clip-path'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', 
							{ 
								className: blockClasses,
								'data-bgcolor': props.attributes.background_color,
								style : {
									'text-align': props.attributes.alignment
								}
							}, InnerBlocks.Content() );
	
		},
	} );
	
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components
) );
