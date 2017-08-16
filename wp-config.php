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
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'D:\xampp\htdocs\ispynyc.org\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'ispynyc');

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
define('AUTH_KEY',         '|&]xUhRe}GLW@<<iuZK<;Q<&Ubbh8x~6AOsY7Wh7PXAX75<_jU@kotgTPjRHi+Ov');
define('SECURE_AUTH_KEY',  '-zs%,!HAFw0gOVJsS#Qr1o(d~JvldA6 zh_x0_v1tg;?aVq]7VH!4{vCjF@ hQgt');
define('LOGGED_IN_KEY',    'g^F?nN[v:*=hj$A8VqHjBx;/FR%CtxZ!Zs~9=bxN7G6+G:3[n!%I%$DEBs,2;|c3');
define('NONCE_KEY',        'U3~s90LQEOgymQP`8Fs%TUzgt l5A_OaCK(p& +OH)Q@E$Y:RfU#b`sI$3QO_!}N');
define('AUTH_SALT',        'U5TE[t 82-?B1VgA;LrWPBmo|R]SI2??wX{w9o|./)`%&wc,:)L/}{hM_L1z$:as');
define('SECURE_AUTH_SALT', 'T/8Zr*i,iX2Ry5XrSaP.F_~9y-jX<m+Q?Pt-KJy3?GWYc_&2}-DGKGwQI-fpofa-');
define('LOGGED_IN_SALT',   'z_&r*LfwE1dzx.3;8F=hM~G#uHKAc=d:O(W]j+GOW_3lccF&(n6Dq=ARkFYTaMre');
define('NONCE_SALT',       '^v,cl&Q^&:m|@xXh;i:>.jqUg,pUHAP@*G?Q{hcq*C* m&1*=-< ?JdcR#EsVg]f');

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


