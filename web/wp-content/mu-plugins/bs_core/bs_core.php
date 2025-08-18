<?php
/**
 * Plugin Name: BlueSky Core
 * Description: A set of basic functions for operation with WordPress themes and plugins
 * Author: Sergiy Pushenko
 * Author URI: mailto:dftpsp@gmail.com
 * Version: 1.15.0
 * Tested up to: 6.8.1
 * Requires at least: 6.6
 * Requires PHP: 8.0
 * Text Domain: bs_core
 * Network: true
 * License: GPL
 */

if ( ! class_exists( 'BlueSky\MuPlugin\CorePlugin\CorePlugin' ) ) {
	require_once __DIR__ . '/linking.php';
}

if ( class_exists( 'BlueSky\MuPlugin\CorePlugin\CorePlugin' ) ) {
	$products = new \BlueSky\MuPlugin\CorePlugin\CorePlugin();
}
