<?php
/**
 * Function for work with posts
 */

/**
 * Getting archive number articles
 *
 * @return array
 */
function bs_core_posts_get_archive_number_articles(): array {
	global $wp_query;

	$number_articles = array();

	$posts_count = $wp_query->found_posts;
	if ( $posts_count > 0 ) {
		$posts_per_page = $wp_query->query_vars['posts_per_page'];
		$posts_per_page = ( ! empty( $posts_per_page ) ) ? $posts_per_page : get_option( 'posts_per_page', 1 );
		$pages_count    = isset( $wp_query->max_num_pages ) ? (int) $wp_query->max_num_pages : 1;
		$page_current   = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;

		$post_numbers = array();
		for ( $post_number = 1; $post_number <= $posts_count; $post_number++ ) {
			$post_numbers[] = $post_number;
		}

		$post_ranges = array_chunk( $post_numbers, $posts_per_page );

		$number_articles = array(
			'posts_from'  => $post_ranges[ $page_current - 1 ][ array_key_first( $post_ranges[ $page_current - 1 ] ) ],
			'posts_to'    => $post_ranges[ $page_current - 1 ][ array_key_last( $post_ranges[ $page_current - 1 ] ) ],
			'posts_count' => $posts_count,
		);
	}

	return $number_articles;
}

/**
 * Getting archive pagination parameters
 *
 * @return array
 */
function bs_core_posts_get_archive_pagination_parameters(): array {
	global $wp_query;

	$pagination_parameters = array();

	$pages_count = isset( $wp_query->max_num_pages ) ? (int) $wp_query->max_num_pages : 1;
	if ( $pages_count > 1 ) {

		$page_current = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
		$pages_links  = array();
		for ( $page_num = 1; $page_num <= $pages_count; $page_num++ ) {
			$pages_links[ $page_num ] = get_pagenum_link( $page_num );
		}

		$pagination_parameters = array(
			'pages_count'  => $pages_count,
			'pages_links'  => $pages_links,

			'page_current' => $page_current,
		);
	}

	return $pagination_parameters;
}

/**
 * Returns a list of taxonomy names in the selected form
 *
 * @param int|null $post_id - Id of post
 * @param array    $taxonomies - List of taxonomies
 * @param bool     $return_array - Return array ( true ) or string ( false )
 * @param string   $separator - Separator ( ', ' - default )
 *
 * @return string|array List of taxonomy names
 */
function bs_core_posts_get_term_names( int $post_id = null, array $taxonomies = array(), bool $return_array = false, string $separator = ', ' ): string|array {

	$result = $return_array ? array() : '';

	if ( empty( $post_id ) ) {
		return $result;
	}

	$separator = ( empty( $separator ) ) ? ',' : $separator;

	if ( ! $taxonomies ) {
		$taxonomies = get_post_taxonomies( $post_id );
	}

	$terms = array();
	foreach ( $taxonomies as $taxonomy ) {
		$taxonomy_terms = get_the_terms( $post_id, $taxonomy );
		if ( ! empty( $taxonomy_terms ) ) {
			$terms = array_merge( $terms, $taxonomy_terms );
		}
	}

	$term_nammes = array();
	foreach ( $terms as $term ) {
		if ( ! empty( $term->name ) ) {
			$term_nammes[] = $term->name;
		}
	}

	sort( $term_nammes );

	if ( ! $return_array ) {
		$result = bs_core_posts_array_to_str_with_separator( $term_nammes, $separator );
	} else {
		$result = $term_nammes;
	}

	return $result;
}

/**
 * Converts an array to a string with separator
 *
 * @param array  $array - Array for conversion
 * @param string $separator - Separator ( ', ' - default )
 *
 * @return string Converted string
 */
function bs_core_posts_array_to_str_with_separator( array $array = array(), string $separator = ', ' ): string {

	if ( empty( $array ) ) {
		return '';
	}

	$separator = ( empty( $separator ) ) ? ',' : $separator;

	$result   = '';
	$last_key = array_key_last( $array );

	foreach ( $array as $id_arg => $item ) {
		$result .= $item;

		if ( $id_arg !== $last_key ) {
			$result .= $separator;
		}
	}

	return $result;
}
