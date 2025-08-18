<?php
/**
 * Functions for media files
 */

/**
 * Get attachment image
 *
 * @param int          $image_id - Image ID.
 * @param string|array $size     - Optional. Image size. Accepts any registered image size name.
 * @param array        $attrs    - Attributes and value (true - display attribute only, empty - not displayed, not empty display attribute and value).
 *      'src'   string - Link to the image,
 *      'alt'   string - Alt text for image,
 *      'class' string - Class for image,
 *      'style' string - Styles for image,
 *
 * @return string - Image tag
 */
function bs_core_media_get_attachment_image( int $image_id = 0, string|array $size = 'thumbnail', array $attrs = array() ): string {

	$img_tag   = '';
	$image_src = '';
	if ( ! empty( $image_id ) && 'publish' === get_post_status( $image_id ) ) {
		$image_src = wp_get_attachment_image_url( $image_id, $size );
	} elseif ( ! empty( $attrs['src'] ) ) {
		$image_src = esc_url( $attrs['src'] );
	}

	if ( ! empty( $image_src ) ) {

		$image_attrs = array(
			'src' => $image_src,
			'alt' => '',
		);

		if ( ! empty( $attrs['alt'] ) ) {
			$image_attrs['alt'] = esc_html( $attrs['alt'] );
		} elseif ( ! empty( $image_id ) ) {
			$image_attrs['alt'] = esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
		}

		if ( ! empty( $attrs ) && is_array( $attrs ) ) {
			foreach ( $attrs as $attr_id => $attr_value ) {
				if ( ! in_array( $attr_id, array( 'src', 'alt' ) ) && ! empty( $attr_value ) ) {
					$image_attrs[ $attr_id ] = $attr_value;
				}
			}
		}

		$img_tag = '<img ' . bs_core_html_get_tag_attributes_as_string( $image_attrs ) . '>';
	}

	return $img_tag;
}

/**
 * Print attachment image
 *
 * @param int          $image_id - Image ID.
 * @param string|array $size     - Optional. Image size. Accepts any registered image size name.
 * @param array        $attrs    - Attributes and value (true - display attribute only, empty - not displayed, not empty display attribute and value).
 * @return void
 */
function bs_core_media_print_attachment_image( int $image_id = 0, string|array $size = 'thumbnail', array $attrs = array() ): void {

	if ( $image_id > 0 || ! empty( $attrs['src'] ) ) {

		$img_tag = bs_core_media_get_attachment_image( $image_id, $size, $attrs );

		if ( ! empty( $img_tag ) ) {
			echo $img_tag;
		}
	}
}

/**
 * Get the srcset attribute for a theme image
 *
 * @param array $srcset_args - srcset attributes ( example: array( '1x' => array( 'image_id' => $image_id, 'size' => 'thumbnail' ) ) )
 * @return string - value for srcset attribute
 */
function bs_core_media_get_srcset_attr_for_image( array $srcset_args = array() ): string {

	if ( ! empty( $srcset_args ) && is_array( $srcset_args ) ) {

		$srcset_str = '';

		$srcset_count = count( $srcset_args );
		$iteration    = 0;
		foreach ( $srcset_args as $src_id => $src_args ) {
			++$iteration;
			if ( ! empty( $src_args['image_id'] ) && ! empty( $src_args['size'] ) ) {
				$img_url = wp_get_attachment_image_url( $src_args['image_id'], $src_args['size'] );
				if ( ! empty( $img_url ) ) {
					$srcset_str .= ( 1 === $iteration ? ' ' : '' );
					$srcset_str .= $img_url . ' ' . $src_id;
					$srcset_str .= ( $srcset_count > $iteration ? ',' : '' );
				}
			}
		}

		if ( ! empty( $srcset_str ) ) {
			return $srcset_str;
		}
	}

	return '';
}

/**
 * Print attachment video
 *
 * @param string $video_url - video url.
 * @param array  $attrs     - Attributes and value (true - display attribute only, empty - not displayed, not empty display attribute and value).
 * @return void
 */
function bs_core_media_print_attachment_video( string $video_url = '', array $attrs = array() ): void {

	if ( $video_url > 0 ) {
		$attrs = wp_parse_args(
			$attrs,
			array(
				'src'      => $video_url,
				'controls' => true,
				'autoplay' => true,
				'muted'    => true,
				'loop'     => true,
				'class'    => '',
			)
		);

		$video_tag = '<video ' . bs_core_html_get_tag_attributes_as_string( $attrs ) . '></video>';

		echo $video_tag;
	}
}

/**
 * Get the contents of an SVG file.
 *
 * @param string $path File path.
 * @return string
 */
function bs_core_media_get_svg_content_from_file( string $path ): string {
	if ( is_file( $path ) && 'svg' === strtolower( pathinfo( $path, PATHINFO_EXTENSION ) ) ) {
		$file_content = file_get_contents( $path );
		if ( ! empty( $file_content ) ) {
			return $file_content;
		}
	}
	return '';
}

/**
 * Print the contents of an SVG file.
 *
 * @param string $path File path.
 * @return void
 */
function bs_core_media_print_svg_content_from_file( string $path ): void {

	echo bs_core_media_get_svg_content_from_file( $path );
}

/**
 * Get the contents of an SVG file by ID.
 *
 * @param int $id SVG file ID.
 * @return string
 */
function bs_core_media_get_svg_content_from_file_by_id( int $id = 0 ): string {

	if ( ! empty( $id ) ) {
		$path = get_attached_file( $id );
		if ( is_file( $path ) ) {
			$file_content = bs_core_media_get_svg_content_from_file( $path );
			if ( ! empty( $file_content ) ) {
				return $file_content;
			}
		}
	}

	return '';
}

/**
 * Print the contents of an SVG file by ID.
 *
 * @param int $id SVG file ID.
 * @return void
 */
function bs_core_media_print_svg_content_from_file_by_id( int $id = 0 ): void {

	echo bs_core_media_get_svg_content_from_file_by_id( $id );
}
