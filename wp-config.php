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
define( 'DB_NAME', 'test_order' );
/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'lipl' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+-]aDJM%-0wkarwQU1+Ir`:`wWjXQlb~ g]~){-v/aKCs6nIZ;Q~|+&,g[6%<]{d' );
define( 'SECURE_AUTH_KEY',  'lBpjk]:;t7~nFhX#Raqcs,PXLLSk@LBk/By^P6g`U1SC^<C-S&7cba*vKOjiyk6Q' );
define( 'LOGGED_IN_KEY',    '5UZ|o|Iw@oitc>h9u2c:_OUy6jU!D+G(uyD~;m3Vp{?G<KS#H{#ZATr5!H~TJ_XY' );
define( 'NONCE_KEY',        'o5k:Dew:2G_Z?|?LR-o+;({Ta]sVim<&d(t!HGIcUg[v6pNuc. /cTO>=FdUwdJj' );
define( 'AUTH_SALT',        '@`Z]/Ug{ OR&HHWb&TJYTD-4Rj(q_uij$)mFUKNhQWW(q3Ag,DozD3?Q5,1<^yEP' );
define( 'SECURE_AUTH_SALT', '}@|uEFxkV9I0/jC+]@zO[^aB=qS[=/a8Vfl Tatq648ejP0Q2>@;{c 4[;,(kza0' );
define( 'LOGGED_IN_SALT',   '.v!=l1XlDEwOW3MPm[Anwh.8s-7M^9n,T4nWoJ7i{8}/5hn U3D5d CboriiFbwa' );
define( 'NONCE_SALT',       'xs^{VHbHq%=Bf{4~`N ovP{Ie;>3V+eQ2K7FM2;%ZsS(fCj`_3 ,`jR9&B.e(;N{' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0777 );
define( 'FS_CHMOD_FILE', 0777 );
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

