<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'powergamer');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '?l@h3^1g#u?L-D2`<Y{WY4+@k]W<7d-cdhRc}uVI%{kc/n~7|8`:Z[@^(|hil%Yk');
define('SECURE_AUTH_KEY',  '@{AcIAT>CR@i8vnFNip)H`Wv `>mM&/hz]H(|ZM0zUBgk$df {-)MQZ94O+S#?4]');
define('LOGGED_IN_KEY',    '>1b[Ej#sP-N=g|mg2`%BLpI)h#:>8B_y[<t+=wg>QM;l~51lT2vv5vDj,/)Em#w>');
define('NONCE_KEY',        ')hVykO69Y62ErR|{WWB/wg%iQgPZ =3[qN/L{eU{2m%~|s-<MtUpD;/?!np?=AL{');
define('AUTH_SALT',        'pScz<m#j44e?zG(*uV+T5pZq]Dd&B2UibG#_Z[PN-dW!7gXaXqScffF7X=,N|!|<');
define('SECURE_AUTH_SALT', 'Wm>prnG|i%_rhq>P1[7g+3mG)i|$tVCvu1S^O^g-dz2.A t^k`n1;3$uAf/DF*lB');
define('LOGGED_IN_SALT',   'IU*)j$xt+(:i?uM*G{jX)`3?e7_3lwACuf0toTc+ +W}Pja<[ia|w+ahaa$5naQ1');
define('NONCE_SALT',       'qKn^WddTB)tx$I|{};n V%)^W)~^(TD/d$ NW2<t- -!+(6t,yoEF7C4B,S`{8YU');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('SCRIPT_DEBUG', true);
define('WP_ENV', 'development');

define('WP_CONTENT_DIR', dirname(__FILE__));
define('WP_CONTENT_URL', 'http://nicklas.x-dev.se/powergamer/deploy/public');
if (file_exists($bootstrapFile = dirname(__DIR__).'/application/bootstrap.php'))
	require_once($bootstrapFile);
else if (file_exists($autoloadFile = dirname(dirname(__FILE__)).'/vendor/autoload.php'))
	require_once($autoloadFile);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');