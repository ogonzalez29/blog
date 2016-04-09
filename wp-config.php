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

/** Changing the site URL for WordPress */
define('WP_HOME','http://localhost/blog');
define('WP_SITEURL','http://localhost/blog');

/** The name of the database for WordPress */
define('DB_NAME', 'servital_blog');


/** MySQL database username */
define('DB_USER', 'root');


/** MySQL database password */
define('DB_PASSWORD', '');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');


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
define('AUTH_KEY',         'T{Ys_q6N{8Vo4rdD;PCRd[#QCb7A-D[^a|_Y4e}ZZ(r*+pg>S/mAI|D1wG5mpoZo');

define('SECURE_AUTH_KEY',  'qgD&H&/W5n0e.6+hUe:7Zp{`jNP!-nS84_:q1i|(u[tEJw1J9=WA%!vBbbR2+?T8');

define('LOGGED_IN_KEY',    ']+6;a}|0W_9}::_A;viEb`Tz,+7|qd!`E!;z8e_}OnJ+Nw|}hnn49L~qg+-T+|-X');

define('NONCE_KEY',        'j,[iRpj_#a8+k?iO+vqa^&1<Qp3B#q[zjazwHvueO^@y`dMb|7<QTCD!B|}ymnWs');

define('AUTH_SALT',        '@>S;q&Pdn&9)},${XL1Va|ZaOB& 0JlS_~. ,N_Lk9B^jQl#= ]hv.=<0JRKoI2E');

define('SECURE_AUTH_SALT', 'zV%F^kng9qQR}_?iuy/@|9Oy`eacw4;Sa(OU&aO,Pc05NGq200P9mbP,yX|JEHB6');

define('LOGGED_IN_SALT',   '&SfBhlTQSQ)S90a.Hi$d, :`#&9+F3gwz%*rG&}{f,yvz,R|m ;(`17M4ZE)85<V');

define('NONCE_SALT',       '{L+6H^lt=a(/)Tp,|//R$QX-!1|J>1B$]N0B5VW00Lzw8uhsbGdGMcF64~k]jDz?');


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
/*define('RELOCATE',true);*/

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
