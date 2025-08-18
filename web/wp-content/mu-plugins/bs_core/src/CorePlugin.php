<?php

namespace BlueSky\MuPlugin\CorePlugin;

use BlueSky\MuPlugin\CorePlugin\Menu\MenuIcon;

class CorePlugin {

	/**
	 * Create object
	 */
	public function __construct() {

		// Register the plugin in Loco Translate
		add_filter( 'loco_plugins_data', array( $this, 'bs_core_register_plugin_in_loco_translate' ) );

		// Register translations for the plugin
		add_action( 'muplugins_loaded', array( $this, 'bs_core_register_translations_for_plugin' ) );

		// Register functions for the plugin.
		$this->register_functions_for_plugin();

		// Register Menu icon functions.
		new MenuIcon();
	}

	/**
	 * Register functions for the plugin.
	 *
	 * @return void
	 */
	protected function register_functions_for_plugin(): void {

		// Includes all Functions files from the src/Functions directory.
		foreach ( glob( plugin_dir_path( __FILE__ ) . 'Functions' . DIRECTORY_SEPARATOR . '*.php' )  as $file ) {
			require_once $file;
		}
	}

	/**
	 * Register translations for the plugin
	 *
	 * @return void
	 */
	public function bs_core_register_translations_for_plugin(): void {
		load_muplugin_textdomain(
			'bs_core',
			'bs_core' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR,
		);
	}

	/**
	 * Register the plugin in Loco Translate
	 *
	 * MU plugins inside directories are not returned in `get_mu_plugins`.
	 * This filter modifies the array obtained from WordPress when Loco grabs it.
	 *
	 * Note that this filter only runs once per script execution, because the value is cached.
	 * Define the function *before* Loco Translate plugin is even included by WP.
	 */
	function bs_core_register_plugin_in_loco_translate( array $plugins ) {

		// We know the plugin by this handle, even if WordPress doesn't.
		$handle = 'bs_core/bs_core.php';

		// Fetch the plugin's meta data from the would-be plugin file.
		$data = get_plugin_data( trailingslashit( WPMU_PLUGIN_DIR ) . $handle );

		// Extra requirement of Loco - $handle must be resolvable to full path.
		$data['basedir'] = WPMU_PLUGIN_DIR;

		// Add to array and return back to Loco Translate.
		$plugins[ $handle ] = $data;

		return $plugins;
	}
}
