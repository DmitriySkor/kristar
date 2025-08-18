<?php
/**
 * Functions for WordPress plugins.
 */

/**
 * Get the plugin URL in the mu-plugins directory.
 *
 * @param string $plugin_name - plugin name.
 *
 * @return string|false - url to the plugin.
 */
function bs_core_plugins_get_mu_plugins_url( string $plugin_name = '' ) {

	if ( empty( $plugin_name ) ) {
		$plugin_name = 'bs_core';
	}

	$plugin_url = false;

	$mu_plugins_url = WPMU_PLUGIN_URL . DIRECTORY_SEPARATOR;
	$mu_plugins_dir = WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR;

	if ( ! empty( $plugin_name ) && is_dir( $mu_plugins_dir . $plugin_name ) ) {
		$plugin_url = $mu_plugins_url . $plugin_name;
	}

	return $plugin_url;
}

/**
 * Get the plugin patch in the mu-plugins directory.
 *
 * @param string $plugin_name - plugin name.
 *
 * @return string|false - patch to the plugin directory.
 */
function bs_core_plugins_get_mu_plugins_dir( string $plugin_name = '' ) {

	if ( empty( $plugin_name ) ) {
		$plugin_name = 'bs_core';
	}

	$plugin_dir = WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_name;

	if ( ! empty( $plugin_name ) && is_dir( $plugin_dir ) ) {
		return $plugin_dir;
	} else {
		return false;
	}
}

/**
 * Get the plugin URL in the plugins directory.
 *
 * @param string $plugin_name - plugin name.
 * @return string|false - url to the plugin.
 */
function bs_core_plugins_get_plugin_url( string $plugin_name = '' ): string|false {

	$plugin_url = false;

	if ( ! empty( $plugin_name ) && is_dir( bs_core_plugins_get_plugin_dir( $plugin_name ) ) ) {
		$plugin_url = WP_CONTENT_URL . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plugin_name;
	}

	return $plugin_url;
}

/**
 * Get the plugin patch in the plugins directory.
 *
 * @param string $plugin_name - plugin name.
 *
 * @return string|false - patch to the plugin directory.
 */
function bs_core_plugins_get_plugin_dir( string $plugin_name = '' ): string|false {

	$plugin_dir = false;

	if ( ! empty( $plugin_name ) ) {
		$directory = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plugin_name;
		if ( is_dir( $directory ) ) {
			$plugin_dir = $directory;
		}
	}

	return $plugin_dir;
}

/**
 * Get the uploads url in the uploads directory.
 *
 * @param string $directory_name - directory name.
 * @return string|false - url to the uploads directory
 */
function bs_core_plugins_get_uploads_url( string $directory_name = '' ): string|false {

	$uploads_url = false;

	if ( ! empty( $directory_name ) && is_dir( bs_core_plugins_get_uploads_dir( $directory_name ) ) ) {
		$uploads_url = WP_CONTENT_URL . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $directory_name;
	}

	return $uploads_url;
}

/**
 * Get the uploads patch in the uploads directory.
 *
 * @param string $directory_name - directory name.
 * @param bool   $create - create if empty
 * @return string|false - patch to the uploads directory
 */
function bs_core_plugins_get_uploads_dir( string $directory_name = '', bool $create = false ): string|false {

	$uploads_dir = false;

	if ( ! empty( $directory_name ) ) {
		$directory = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $directory_name;
		if ( is_dir( $directory ) || ( $create && mkdir( $directory ) ) ) {
			$uploads_dir = $directory;
		}
	}

	return $uploads_dir;
}

/**
 * Get template part from plugin or main theme or children theme
 *
 * The function is designed to get a template from a plugin, and also allows you to replace it with a template from the
 * main or child theme. The order of loading templates:
 * - a specialized template from a theme;
 * - a specialized template from a plugin;
 * - a template from a theme;
 * - a template from a plugin.
 *
 * @param string      $plugin_name - Plugin name ( as in the plugin directory ).
 * @param string      $slug - The slug name for the generic template.
 * @param string|null $name - Optional. The name of the specialized template.
 * @param array       $args - Optional. Additional arguments passed to the template. Default empty array.
 *
 * @return bool - True - if the template is found and connected, false - if the template not found.
 */
function bs_core_plugins_get_template_part( string $plugin_name = '', string $slug = '', string|null $name = null, array $args = array() ): bool {

	if ( ! empty( $slug ) ) {

		$plugin_patch = bs_core_plugins_get_plugin_dir( $plugin_name );

		// Search specialized template
		if ( ! empty( $name ) ) {

			// In the theme
			$template = locate_template( $slug . '-' . $name . '.php', true, false, $args );
			if ( ! empty( $template ) ) {

				return true;
			}

			// In the plugin
			if ( ! empty( $plugin_patch ) ) {
				$template = $plugin_patch . DIRECTORY_SEPARATOR . $slug . '-' . $name . '.php';
				if ( file_exists( $template ) ) {

					load_template( $template, false, $args );
					return true;
				}
			}
		}

		// Search template in the theme
		$template = locate_template( $slug . '.php', true, false, $args );
		if ( ! empty( $template ) ) {

			return true;
		}

		// Search template in the plugin
		if ( ! empty( $plugin_patch ) ) {
			$template = $plugin_patch . DIRECTORY_SEPARATOR . $slug . '.php';
			if ( file_exists( $template ) ) {

				load_template( $template, false, $args );
				return true;
			}
		}
	}

	return false;
}

/**
 * Get the path to a template in a plugin or main/child theme.
 *
 * The function is designed to get a path to a template in a plugin, and also allows you to replace it with a main/child theme. The order of search path to a template :
 * - a specialized template from a theme;
 * - a specialized template from a plugin;
 * - a template from a theme;
 * - a template from a plugin.
 *
 * @param string $plugin_name - Plugin name ( as in the plugin directory ).
 * @param string $slug - The slug name for the generic template.
 * @param string $name - Optional. The name of the specialized template.
 *
 * @return string|false - path to a template or false.
 */
function bs_core_plugins_get_template_path( string $plugin_name = '', string $slug = '', string $name = '' ): string|false {

	if ( ! empty( $slug ) ) {

		$plugin_patch = bs_core_plugins_get_plugin_dir( $plugin_name );

		// Search specialized template
		if ( ! empty( $name ) ) {

			// In the theme
			$template = locate_template( $slug . '-' . $name . '.php' );
			if ( ! empty( $template ) ) {
				return $template;
			}

			// In the plugin
			if ( ! empty( $plugin_patch ) ) {
				$template = $plugin_patch . DIRECTORY_SEPARATOR . $slug . '-' . $name . '.php';
				if ( file_exists( $template ) ) {
					return $template;
				}
			}
		}

		// Search template in the theme
		$template = locate_template( $slug . '.php' );
		if ( ! empty( $template ) ) {
			return $template;
		}

		// Search template in the plugin
		if ( ! empty( $plugin_patch ) ) {
			$template = $plugin_patch . DIRECTORY_SEPARATOR . $slug . '.php';
			if ( file_exists( $template ) ) {
				return $template;
			}
		}
	}

	return false;
}
