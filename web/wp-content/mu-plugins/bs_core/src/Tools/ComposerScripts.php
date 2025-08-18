<?php
/**
 * A class for events that are triggered when the composer is running
 *
 * For proper operation of scripts in wp-config.php paths to the files : /vendor/autoload.php and /config/application.php must be written completely.
 * Example :
 * - require_once dirname( __FILE__ ) . '/vendor/autoload.php';
 * - require_once dirname( __FILE__ ) . '/config/application.php';
 */

namespace BlueSky\MuPlugin\CorePlugin\Tools;

use Composer\Script\Event;

class ComposerScripts {

	/**
	 * Path to the wp_cli directory
	 */
	const WP_CLI_PATCH = 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'wp --allow-root';

	/**
	 * Runs after the install command has been executed with a lock file present.
	 *
	 * @see https://getcomposer.org/doc/articles/scripts.md#event-names
	 * @param Event $event - Composer event.
	 * @return void
	 */
	public static function post_install_cmd( Event $event ): void {

		if ( ! empty( $event ) ) {

			echo 'Themes processing :' . PHP_EOL;
			static::clean_themes( $event );

			echo 'Language processing :' . PHP_EOL;
			static::update_languages( $event );
			echo PHP_EOL;

			echo 'Rewrite rules :' . PHP_EOL;
			static::rewrite_rules( $event );
			echo PHP_EOL;

			echo 'Clean cache :' . PHP_EOL;
			static::flush_all_caches( $event );
			echo PHP_EOL;
		}
	}

	/**
	 * Runs after the update command has been executed, or after the install command has been executed without a lock
	 * file present.
	 *
	 * @see https://getcomposer.org/doc/articles/scripts.md#event-names
	 * @param Event $event - Composer event.
	 * @return void
	 */
	public static function post_update_cmd( Event $event ): void {

		if ( ! empty( $event ) ) {

			echo 'Themes processing :' . PHP_EOL;
			static::clean_themes( $event );

			echo 'Language processing :' . PHP_EOL;
			static::update_languages( $event );
			echo PHP_EOL;

			echo 'Rewrite rules :' . PHP_EOL;
			static::rewrite_rules( $event );
			echo PHP_EOL;

			echo 'Clean cache :' . PHP_EOL;
			static::flush_all_caches( $event );
			echo PHP_EOL;
		}
	}

	/**
	 * Get the path to the vendor directory
	 *
	 * @param Event $event
	 * @return string
	 */
	public static function get_vendor_path( Event $event ): string {
		if ( ! empty( $event ) ) {
			$composer_extra = $event->getComposer()->getPackage()->getConfig();
			$vendor_path    = ( ! empty( $composer_extra['vendor-dir'] ) ) ? $composer_extra['vendor-dir'] : '';
			if ( ! empty( $vendor_path ) && is_dir( $vendor_path ) ) {
				return realpath( $vendor_path );
			}
		}

		if ( is_dir( 'vendor' ) ) {
			return realpath( 'vendor' );
		}

		return '';
	}

	/**
	 * Getting installation paths from Composer settings
	 *
	 * @param Event  $event - Composer event.
	 * @param int    $type - Type of installation : 1 - mu-plugins, 2 - plugins, 3 - themes, 4 - custom type
	 * @param string $custom_type - Custom type
	 *
	 * @return string Path to installation directory
	 */
	public static function get_composer_install_paths( Event $event, int $type = 1, string $custom_type = '' ): string {
		if ( ! empty( $event ) && ( ( $type > 0 && $type <= 3 ) || ( $type == 4 && ! empty( $custom_type ) ) ) ) {

			$composer_extra = $event->getComposer()->getPackage()->getExtra();
			$install_paths  = $composer_extra['installer-paths'];
			$install_type   = '';
			$install_path   = '';

			if ( 1 === $type ) {
				$install_type = 'type:wordpress-muplugin';
			} elseif ( 2 === $type ) {
				$install_type = 'type:wordpress-plugin';
			} elseif ( 3 === $type ) {
				$install_type = 'type:wordpress-theme';
			} elseif ( 4 === $type && ! empty( $custom_type ) ) {
				$install_type = $custom_type;
			}

			if ( ! empty( $install_paths ) && ! empty( $install_type ) ) {
				foreach ( $install_paths as $path_id => $path_arg ) {
					if ( $path_arg[0] === $install_type ) {
						$install_path = dirname( $path_id );
					}
				}
			}

			if ( ! empty( $install_path ) ) {
				return $install_path;
			}
		}

		return '';
	}

	/**
	 * Get the path to the super cache directory
	 *
	 * @param Event $event - Composer event.
	 * @return string - Path to the super cache directory
	 */
	public static function get_super_caches_path( Event $event ): string {
		if ( ! empty( $event ) ) {

			$plugins_dir = static::get_composer_install_paths( $event, 2 );

			if ( ! empty( $plugins_dir ) ) {
				return dirname( $plugins_dir ) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
			}
		}

		return '';
	}

	/**
	 * Remove file
	 *
	 * @param string $patch - Patch to file
	 * @return void
	 */
	public static function remove_file( string $patch = '' ): void {
		if ( ! empty( $patch ) && is_file( $patch ) ) {
			passthru( 'rm ' . $patch );
		}
	}

	/**
	 * Remove folder
	 *
	 * @param string $patch - Patch to folder
	 * @return void
	 */
	public static function remove_folder( string $patch = '' ): void {
		if ( ! empty( $patch ) && is_dir( $patch ) ) {
			passthru( 'rm -rf ' . $patch );
		}
	}

	/**
	 * Remove files in folder
	 *
	 * @param string $patch - Patch to folder
	 * @return void
	 */
	public static function remove_file_in_folder( string $patch = '' ): void {

		if ( ! empty( $patch ) ) {
			foreach ( scandir( $patch ) as $file ) {
				$full_path = $patch . '/' . $file;
				if ( in_array( $file, array( '.', '..' ) ) ) {
					continue;
				}

				if ( is_file( $full_path ) ) {
					static::remove_file( $full_path );
				} elseif ( is_dir( $full_path ) ) {
					static::remove_folder( $full_path );
				}
			}
		}
	}

	/**
	 * Clean unused default themes.
	 *
	 * @param Event $event - Composer event.
	 * @return void
	 */
	public static function clean_themes( Event $event ): void {

		$theme_dir = static::get_composer_install_paths( $event, 3 );

		echo '- clean themes :' . PHP_EOL;
		foreach ( scandir( $theme_dir ) as $file ) {
			$full_path = $theme_dir . DIRECTORY_SEPARATOR . $file;
			if ( '.' === $file[0] || ! is_dir( $full_path ) ) {
				continue;
			}

			if ( 0 === strpos( $file, 'twentytwenty' ) && ! is_dir( $full_path . '-child' ) && false === strpos( $file, '-child' ) ) {
				echo '-- clean theme : ' . $file . PHP_EOL;
				static::remove_folder( $full_path );
			}
		}
		echo PHP_EOL;
	}

	/**
	 * Update language files for all languages.
	 *
	 * @param Event $event - Composer event.
	 * @return void
	 */
	public static function update_languages( Event $event ): void {

		if ( ! empty( $event ) ) {

			$composer_extra = $event->getComposer()->getPackage()->getExtra();
			$languages      = $composer_extra['languages'];

			if ( ! empty( $languages ) && is_array( $languages ) ) {
				foreach ( $languages as $language ) {
					static::update_language( $event, $language );
				}
			}
		}
	}

	/**
	 * Update language files for WordPress core and plugins
	 *
	 * @param Event  $event - Composer event.
	 * @param string $language - Language for update
	 * @return void
	 */
	public static function update_language( Event $event, string $language = '' ): void {

		if ( ! empty( $event ) && ! empty( $language ) ) {
			$vendor_dir = static::get_vendor_path( $event );
			$wp_cli_dir = static::WP_CLI_PATCH;
			if ( ! empty( $vendor_dir ) ) {

				chdir( dirname( $vendor_dir ) );

				echo '- installing languages for core :' . PHP_EOL;
				passthru( $wp_cli_dir . " language core install $language" );
				echo PHP_EOL;

				echo '- installing languages for plugins :' . PHP_EOL;
				passthru( $wp_cli_dir . " language plugin install --all $language" );
				echo PHP_EOL;

				// Update translations.
				echo '- update translations for core :' . PHP_EOL;
				passthru( $wp_cli_dir . ' language core update' );
				echo PHP_EOL;

				echo '- update translations for plugins :' . PHP_EOL;
				passthru( $wp_cli_dir . ' language plugin update --all' );
				echo PHP_EOL;
			}
		}
	}

	/**
	 * Rewrite rules
	 *
	 * @return void
	 */
	public static function rewrite_rules( Event $event ): void {
		$vendor_dir = static::get_vendor_path( $event );
		$wp_cli_dir = static::WP_CLI_PATCH;
		if ( ! empty( $vendor_dir ) && ! empty( $wp_cli_dir ) ) {
			chdir( dirname( $vendor_dir ) );

			// Rewrite rules are regenerated because the translation of rewrite slugs may have been updated.
			passthru( $wp_cli_dir . ' rewrite flush' );
		}
	}

	/**
	 * Flush all caches and WP Super caches also.
	 *
	 * @param Event $event - Composer event.
	 * @return void
	 */
	public static function flush_all_caches( Event $event ): void {

		$vendor_dir = static::get_vendor_path( $event );
		$wp_cli_dir = static::WP_CLI_PATCH;
		$cache_dir  = static::get_super_caches_path( $event );
		if ( ! empty( $vendor_dir ) && ! empty( $cache_dir ) && is_dir( $cache_dir ) ) {
			chdir( dirname( $vendor_dir ) );

			echo '- clean cache : ' . PHP_EOL;
			exec( $wp_cli_dir . ' cache flush', $output );

			if ( ! empty( $output ) && is_array( $output ) ) {
				foreach ( $output as $line ) {
					\WP_CLI::line( $line );
				}
			}
			echo PHP_EOL;

			if ( file_exists( $cache_dir ) && is_dir( $cache_dir ) ) {
				echo '- clean WP Super Cache : ' . PHP_EOL;
				self::remove_file_in_folder( $cache_dir );
				echo 'Success: The cache was flushed.' . PHP_EOL;
				echo PHP_EOL;
			}
		} else {
			echo '- cache is empty. ' . PHP_EOL;
		}
	}
}
