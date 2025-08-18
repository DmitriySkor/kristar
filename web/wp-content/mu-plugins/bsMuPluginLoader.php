<?php
/**
 * Plugin Name: BlueSky Mu Plugin Loader
 * Description: Connects plugins from the mu-plugins folder nested in directories.
 * Version: 1.0.1
 * Author: Sergiy Pushenko
 * Author URI: mailto:dftpsp@gmail.com
 * License:
 * Requires at least: 6.2
 * Requires PHP: 8.1
 * Requires Plugins: bs_core
 */

use BlueSky\MuPlugin\CorePlugin\Tools\MuPluginLoader;

if ( ! class_exists( 'BlueSky\MuPlugin\CorePlugin\Tools\MuPluginLoader' ) ) {
   require_once __DIR__ . '/bs_core/src/Tools/MuPluginLoader.php';
}

/**
 * Connects plugins from the mu-plugins folder nested in directories.
 */
if ( is_blog_installed() && class_exists(MuPluginLoader::class ) ) {
   new MuPluginLoader();
}
