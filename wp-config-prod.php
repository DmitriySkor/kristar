<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u675256559_bubkrist444');

/** MySQL database username */
define('DB_USER', 'u675256559_bubbleswp');

/** MySQL database password */
define('DB_PASSWORD', 'q$iHCz349$xGz3y');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KpKR4OJQ77@k@Zj@*&4lOX!a47WFaFDtmCgH4p*RNbZYU^yHa%Mp748%iG0U2eZA');
define('SECURE_AUTH_KEY',  '3OEAT24l8Fc#V*p&Jk7NxQMT1NCzI*mioCUlcU4uCJLMhKTyo^gh9qTlg0qAIJRl');
define('LOGGED_IN_KEY',    'sOG#&9iYnerTg@nJCwNkU92^eJqVAeaTRKtLI)Q*a@&h7fv2OqhdSey&3^H@f%LI');
define('NONCE_KEY',        'iGpABqa)#b)1b16n#OCu@FTY)OZ6Ev46eXy6Tf6w3KF%nNSXTiMtDGm2M#bnmd16');
define('AUTH_SALT',        '@27!YA305kgLSO^Lb*3RLQyhlNqoQm9q)p6@orc^TQHV1(TVF&XYOTraG6hw5c^^');
define('SECURE_AUTH_SALT', 'Yd5R!*Q*b#nCus*EaEh3eKG^Wo#mErHWhNThDjLON(qk#Im7@(Xhxi1fjJh&U&cq');
define('LOGGED_IN_SALT',   'RC*SNQ!YD5(Ht8kY0b5oSwk0Ltwrs&T8xN2aIdoKOQrw81)IkZsCB#uTMoaSeZsK');
define('NONCE_SALT',       '0rG#v!&dM4*5llvX#qeGlurt2!JpexlwMoci#itovj&u!rrAlXJJXGLWIP*BwgEa');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
