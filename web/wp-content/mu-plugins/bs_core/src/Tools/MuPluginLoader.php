<?php
/**
 * Connects plugins from the mu-plugins folder nested in directories.
 */

namespace BlueSky\MuPlugin\CorePlugin\Tools;

use Composer\Script\Event;
use BlueSky\MuPlugin\CorePlugin\Tools\ComposerScripts;

/**
 * Connects plugins from the mu-plugins folder nested in directories.
 */
class MuPluginLoader {

	/**
	 * Full path to the mu-plugins directory
	 *
	 * @var string
	 */
	public $mup_patch;

	/**
	 * Plugins located in the mu-plugins directory
	 *
	 * @var array
	 */
	public $mup_all;

	/**
	 * Plugins are loaded automatically by the system
	 *
	 * @var array
	 */
	public $mup_loaded;

	/**
	 * Plugins that need to be loaded manually
	 *
	 * @var array
	 */
	public $mup_candidates;

	/**
	 * Create singleton, populate vars, and set WordPress hooks
	 */
	public function __construct() {

		$this->mup_patch = WPMU_PLUGIN_DIR . '/';

		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$this->mup_all        = get_plugins( '/../mu-plugins' );
		$this->mup_loaded     = get_mu_plugins();
		$this->mup_candidates = array_diff_key( $this->mup_all, $this->mup_loaded );

		foreach ( array_keys( $this->mup_candidates ) as $mup_candidate ) {
			require_once $this->mup_patch . $mup_candidate;
		}

		if ( is_admin() ) {
			add_filter(
				'show_advanced_plugins',
				function ( $show, $type ) {

					$screen  = get_current_screen();
					$current = is_multisite() ? 'plugins-network' : 'plugins';

					if ( $screen->base === $current && 'mustuse' === $type && current_user_can( 'activate_plugins' ) ) {
						$GLOBALS['plugins']['mustuse'] = array_unique( $this->mup_all, SORT_REGULAR );
						return false;
					}

					return $show;
				},
				0,
				2
			);
		}
	}

	/**
	 * Add plugin dwMuPluginLoader into mu-plugins.
	 *
	 * @param Event $event
	 * @return void
	 */
	public static function add_plugin( Event $event ): void {

		$file_text = '<?php' . PHP_EOL .
			'/**' . PHP_EOL .
			' * Plugin Name: BlueSky Mu Plugin Loader' . PHP_EOL .
			' * Description: Connects plugins from the mu-plugins folder nested in directories.' . PHP_EOL .
			' * Version: 1.0.1' . PHP_EOL .
			' * Author: Sergiy Pushenko' . PHP_EOL .
			' * Author URI: mailto:dftpsp@gmail.com' . PHP_EOL .
			' * License:' . PHP_EOL .
			' * Requires at least: 6.2' . PHP_EOL .
			' * Requires PHP: 8.1' . PHP_EOL .
			' * Requires Plugins: bs_core' . PHP_EOL .
			' */' . PHP_EOL .
			PHP_EOL .
			'use BlueSky\MuPlugin\CorePlugin\Tools\MuPluginLoader;' . PHP_EOL .
			PHP_EOL .
			'if ( ! class_exists( \'BlueSky\MuPlugin\CorePlugin\Tools\MuPluginLoader\' ) ) {' . PHP_EOL .
			'   require_once __DIR__ . \'/bs_core/src/Tools/MuPluginLoader.php\';' . PHP_EOL .
			'}' . PHP_EOL .
			PHP_EOL .
			'/**' . PHP_EOL .
			' * Connects plugins from the mu-plugins folder nested in directories.' . PHP_EOL .
			' */' . PHP_EOL .
			'if ( is_blog_installed() && class_exists(MuPluginLoader::class ) ) {' . PHP_EOL .
			'   new MuPluginLoader();' . PHP_EOL .
			'}';

		$mu_plugins_path = ComposerScripts::get_composer_install_paths( $event, 1 );
		if ( ! empty( $mu_plugins_path ) ) {
			$file_patch = $mu_plugins_path . DIRECTORY_SEPARATOR . 'bsMuPluginLoader.php';

			if ( file_exists( $file_patch ) ) {
				unlink( $file_patch );
			}

			file_put_contents( $file_patch, trim( $file_text ) );
		}
	}
}
