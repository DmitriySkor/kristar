<?php
/**
 * Functions for preparing HTML code.
 */

/**
 * Get attributes for HTML tags as a string.
 *
 * Rules:
 * - attributes are displayed separated by spaces;
 * - if the attribute value is true, it is displayed without a value (for example, checked):
 * - if the attribute value is an array, the attribute value will be output as a string of array elements separated by spaces;
 * - if the attribute value is not empty, it is displayed with its value;
 * - if the attribute has no value, it is not displayed.
 *
 * @param array $tag_attributes Key/value pairs.
 *
 * @return string - Attributes for HTML tags as a string
 */
function bs_core_html_get_tag_attributes_as_string( array $tag_attributes = array() ): string {

	$attributes = '';

	if ( ! empty( $tag_attributes ) && is_array( $tag_attributes ) ) {

		$attributes_count = count( $tag_attributes );
		$attributes_index = 0;
		foreach ( $tag_attributes as $tag_id => $tag_value ) {

			++$attributes_index;

			$tag_id = trim( $tag_id );

			if ( true === $tag_value ) {
				$attributes .= esc_attr( $tag_id );
			} elseif ( is_array( $tag_value ) ) {
				if ( ! empty( $tag_value ) ) {
					$attributes .= esc_attr( $tag_id ) . '="' . esc_attr( join( ' ', $tag_value ) ) . '"';
				}
			} elseif ( ! empty( $tag_value ) ) {
				$attributes .= esc_attr( $tag_id ) . '="' . esc_attr( $tag_value ) . '"';
			}

			if ( $attributes_index < $attributes_count ) {

				$attributes .= ' ';
			}
		}
	}

	return $attributes;
}

/**
 * Prints attributes for HTML tags.
 *
 * Rules:
 * - attributes are displayed separated by spaces;
 * - if the attribute value is true, it is displayed without a value (for example, checked):
 * - if the attribute value is an array, the attribute value will be output as a string of array elements separated by spaces;
 * - if the attribute value is not empty, it is displayed with its value;
 * - if the attribute has no value, it is not displayed.
 *
 * @param array $tag_attributes Key/value pairs.
 */
function bs_core_html_print_tag_attributes( array $tag_attributes = array() ): void {

	$attributes = '';

	if ( ! empty( $tag_attributes ) && is_array( $tag_attributes ) ) {
		$attributes .= bs_core_html_get_tag_attributes_as_string( $tag_attributes );
	}

	echo $attributes;
}

/**
 * Print tag <a> if not empty link or user tag ( <div> by default )
 *
 * @param string $link - Link for check
 * @param string $tag  - Tag if empty link
 * @return void
 */
function bs_core_html_print_a_or_tag( string $link = '', string $tag = 'div' ): void {

	if ( empty( $tag ) ) {
		$tag = 'div';
	}

	if ( ! empty( $link ) ) {
		echo 'a';
	} else {
		echo $tag;
	}
}

/**
 * Get an array of attributes for an external or internal link
 *
 * @param array $link_args = array( - Arguments for link
 *     'is_ext'          => false,  - Use external link (false - by default)
 *     'ext_url'         => '',     - External link
 *     'page_url'        => '',     - Link to page
 *     'ext_on_new_page' => true,   - true - add attribute target="_blank" and rel="noopener" for external link
 * )
 * @param array $attrs - Additional attributes and value ( true - display attribute only, empty - not displayed, not empty display attribute and value )
 *
 * @return array - Prepared list of attributes for link
 */
function bs_core_html_get_a_attrs_for_ext_or_int_link( array $link_args = array(), array $attrs = array() ): array {

	$a_args = array();

	if ( ! empty( $link_args ) && is_array( $link_args ) ) {

		$link_args = wp_parse_args(
			$link_args,
			array(
				'is_ext'          => false,
				'ext_url'         => '',
				'page_url'        => '',
				'ext_on_new_page' => true,
			)
		);

		$is_ext_url = ( ! empty( $link_args['is_ext'] ) ) ? true : false;
		$ext_url    = ( ! empty( $link_args['ext_url'] ) ) ? esc_url( $link_args['ext_url'] ) : '';
		$post_url   = ( ! empty( $link_args['page_url'] ) ) ? esc_url( $link_args['page_url'] ) : '';

		if ( $is_ext_url && ! empty( $ext_url ) ) {

			$a_args['href'] = $ext_url;

			if ( $link_args['ext_on_new_page'] ) {
				$a_args['target'] = '_blank';
				$a_args['rel']    = 'noopener';
			}
		} elseif ( ! $is_ext_url && ! empty( $post_url ) ) {
			$a_args['href'] = esc_url( $post_url );
		} else {
			$a_args['href'] = '';
		}

		if ( ! empty( $attrs ) && is_array( $attrs ) ) {

			$a_args = wp_parse_args(
				$a_args,
				$attrs,
			);
		}
	}

	return $a_args;
}

/**
 * Add tag into text
 *
 * @param string $text       - Text for processing
 * @param int    $from       - Number of the word before which the tag should be inserted
 * @param int    $to         - Number of the word after which the tag should be inserted
 * @param string $tag_before - Text of opening tag
 * @param string $tag_after  - Text of сlosing tag
 * @return void
 */
function bs_core_html_add_tag_in_text( string $text = '', int $from = 0, int $to = 0, string $tag_before = '<span>', string $tag_after = '</span>' ): void {

	if ( ! empty( $text ) && ! empty( $from ) && ! empty( $to ) && ! empty( $tag_before ) && ! empty( $tag_after ) ) {
		$word_list       = explode( ' ', $text );
		$word_list_count = count( $word_list );
		$text_and_tag    = '';
		if ( $word_list_count > 1 && $from <= $word_list_count && $to <= $word_list_count && $from <= $to ) {
			foreach ( $word_list as $word_id => $word_value ) {

				if ( $word_id + 1 === $from ) {
					$text_and_tag .= ' ' . $tag_before;
				}

				$text_and_tag .= ' ' . $word_value;

				if ( $word_id + 1 === $to ) {
					$text_and_tag .= $tag_after;
				}
			}

			$text_and_tag = trim( $text_and_tag );
		}

		if ( ! empty( $text_and_tag ) ) {
			$text = $text_and_tag;
		}
	}

	echo $text;
}

/**
 * Get template part text.
 *
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialized template.
 * @param array       $args Optional. Additional arguments passed to the template.
 * @return false|string
 */
function bs_core_html_get_template_part_text( string $slug, string $name = null, array $args = array() ) {

	ob_start();
	get_template_part( $slug, $name, $args );
	return ob_get_clean();
}
