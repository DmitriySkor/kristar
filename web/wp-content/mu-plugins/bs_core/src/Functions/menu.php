<?php
/**
 * Function for Nav menus
 */

/**
 * Get navigation menu id by item id
 *
 * @param string $menu_item_id Navigation menu item id
 * @return string|false        Navigation menu id
 */
function bs_core_menu_get_nav_menu_id_by_item_id( string $menu_item_id ): string|false {
	global $wpdb;

	$menu_id = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT term_taxonomy_id \n" .
			"   FROM wp_term_relationships \n" .
			'   WHERE object_id = %d',
			$menu_item_id
		)
	);

	if ( (int) $menu_id > 0 ) {
		return $menu_id;
	}

	return false;
}

/**
 * Get related navigation menu id by navigation menu id
 *
 * @param string $menu_id Navigation menu id
 * @return string|false   Related navigation menu id
 */
function bs_core_menu_get_related_nav_menu_id_by_nav_menu_id( string $menu_id ): string|false {

	if ( (int) $menu_id > 0 ) {
		$related_nav_menus = get_nav_menu_locations();
		if ( ! empty( $related_nav_menus ) ) {
			foreach ( $related_nav_menus as $related_menu_id => $related_menu_value ) {
				if ( $related_menu_value == $menu_id ) {
					return $related_menu_id;
				}
			}
		}
	}

	return false;
}

/**
 * Get the icon ID of the menu item
 *
 * @param string $menu_item_id - Id of the menu item
 * @return int|false           - Menu item icon ID
 */
function bs_core_menu_get_icon_id_of_menu_item( string $menu_item_id ): int|false {

	if ( ! empty( $menu_item_id ) ) {
		$icon_id = get_post_meta( $menu_item_id, '_menu_item_image', true );
		if ( ! empty( $icon_id ) ) {
			return $icon_id;
		}
	}

	return false;
}

/**
 * Get the icon url of the menu item
 *
 * @param string $menu_item_id - Id of the menu item
 * @param string $size         - Crop size
 * @return string|false        - Menu item icon url
 */
function bs_core_menu_get_icon_url_of_menu_item( string $menu_item_id, string $size = '' ): string|false {

	if ( ! empty( $menu_item_id ) ) {
		$icon_id = bs_core_menu_get_icon_id_of_menu_item( $menu_item_id );
		if ( ! empty( $icon_id ) ) {
			$thumbnail_url = wp_get_attachment_image_url( $icon_id, $size );
			if ( ! empty( $thumbnail_url ) ) {
				return $thumbnail_url;
			}
		}
	}

	return false;
}

/**
 * Get WP menu items
 *
 * @param string $menu_name
 * @return string|false
 */
function bs_core_menu_get_menu_items( string $menu_name = '' ): array|false {

	if ( ! empty( $menu_name ) ) {
		$menu_locations = get_nav_menu_locations();
		if ( ! empty( $menu_locations ) && ! empty( $menu_locations[ $menu_name ] ) ) {
			$menu_items = wp_get_nav_menu_items( $menu_locations[ $menu_name ] );
			if ( ! empty( $menu_items ) ) {
				$menu_items = bs_core_menu_clear_menu_items( $menu_items );
				$menu_items = bs_core_menu_create_menu_levels( $menu_items );
				$menu_items = bs_core_menu_sort_menu_level( $menu_items );

				return $menu_items;
			}
		}
	}
	return false;
}

/**
 * Clear menu items ( service function )
 *
 * @param array $menu_items - Menu items
 * @return array|false      - Cleaned menu items / False
 */
function bs_core_menu_clear_menu_items( array $menu_items ): array|false {

	if ( ! empty( $menu_items ) ) {
		$menu_cleaned = array();
		foreach ( $menu_items as $item_id => $item_args ) {
			$menu_cleaned[ $item_args->ID ] = array(
				'id'          => $item_args->ID,
				'title'       => $item_args->title,
				'icon_id'     => bs_core_menu_get_icon_id_of_menu_item( $item_args->ID ),
				'menu_parent' => $item_args->menu_item_parent,
				'menu_order'  => $item_args->menu_order,
				'url'         => $item_args->url,
				'post_id'     => $item_args->object_id,
				'post_status' => $item_args->post_status,
			);
		}
		return $menu_cleaned;
	}
	return false;
}

/**
 * Creating menu levels ( service function )
 *
 * @param array $menu_items - Menu items
 * @return array|false      - Zero-level menu items / False
 */
function bs_core_menu_create_menu_levels( array $menu_items ): array|false {

	if ( ! empty( $menu_items ) ) {
		$menu_levels = array();
		foreach ( $menu_items as $item_id => $item_args ) {
			if ( '0' === $item_args['menu_parent'] ) {
				$menu_levels[ $item_id ]             = $item_args;
				$menu_levels[ $item_id ]['level']    = 0;
				$menu_levels[ $item_id ]['children'] = array();
			}
		}

		if ( ! empty( $menu_levels ) ) {
			foreach ( $menu_levels as $menu_id => $menu_args ) {
				$prepared_levels = bs_core_menu_create_menu_level( $menu_args, $menu_items, 0 );
				if ( ! empty( $prepared_levels ) ) {
					$menu_levels[ $menu_id ]['children'] = $prepared_levels;
				}
			}
		}

		if ( ! empty( $menu_levels ) ) {
			return $menu_levels;
		}
	}

	return false;
}

/**
 * Creating menu level ( service function )
 *
 * @param array $menu_item  - Menu processing element
 * @param array $menu_items - Menu items
 * @param int   $level        - Current level
 * @return array|false      - created menu level / False
 */
function bs_core_menu_create_menu_level( array $menu_item, array $menu_items, int $level = 0 ): array|false {

	if ( ! empty( $menu_item ) && ! empty( $menu_items ) ) {
		$menu_item_id = (string) $menu_item['id'];
		$children     = array();
		$new_level    = $level + 1;

		foreach ( $menu_items as $item_id => $item_args ) {
			if ( $item_args['menu_parent'] === $menu_item_id ) {
				$item_args['level']    = $new_level;
				$item_args['children'] = bs_core_menu_create_menu_level( $item_args, $menu_items, $new_level );
				$children[ $item_id ]  = $item_args;
			}
		}

		if ( ! empty( $children ) ) {
			return $children;
		}
	}

	return false;
}

/**
 * Sort menu levels ( service function )
 *
 * @param array $menu_items - Menu items
 * @return array|false      - Sorted menu level / False
 */
function bs_core_menu_sort_menu_level( array $menu_items ): array|false {

	if ( ! empty( $menu_items ) ) {
		$menu_items_by_order = array();

		foreach ( $menu_items as $menu_item_args ) {
			if ( ! empty( $menu_item_args['children'] ) && count( $menu_item_args['children'] ) > 1 ) {
				$menu_item_args['children'] = bs_core_menu_sort_menu_level( $menu_item_args['children'] );
			}
			$menu_items_by_order[ $menu_item_args['menu_order'] ] = $menu_item_args;
		}

		ksort( $menu_items_by_order );

		$menu_items = array();
		foreach ( $menu_items_by_order as $sorted_item_args ) {
			$menu_items[ $sorted_item_args['id'] ] = $sorted_item_args;
		}

		if ( ! empty( $menu_items ) ) {
			return $menu_items;
		}
	}

	return false;
}
