<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'user_test' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(7]3P_8kiwU1}SC_KyW%V8+{_:%T6U@z7p4;%=a?P_igPkv?N}UmS|qFWTRmc5e4' );
define( 'SECURE_AUTH_KEY',  'v/<`+5at6kD>Gk?Y!$I;sZ89S7%p$mC0Z!Ktn:.<1J;N#8!Y:1N[!3XqFn$,#L)s' );
define( 'LOGGED_IN_KEY',    'Yf/ZU`W*BF*;)S%uwv3SXU LvKiv|pVY(t1k|-wNY<RYBX:sAlx{m? MPkp|nL_3' );
define( 'NONCE_KEY',        ')oDL<O6WGQF.Dg<L,1^hwjqFSA8E|+sFWM%asA>)*M`JdM5unayAh9z993v[bFA,' );
define( 'AUTH_SALT',        '[HLMqr`&a)9J5YQhk ^7nsJyhc<Jkr+&M*f?fZ#6YCY-.KOyX=Ai9a+>i.`R+)pD' );
define( 'SECURE_AUTH_SALT', '@0Z1(]wQ`j<N@r`U{|3-lRzS..<LN)!pecrd@fZ>)X4)LmIRkn08)jBJQV_^|!qh' );
define( 'LOGGED_IN_SALT',   'VISUK~mVd+W;euZK|@+Mo/pEJ4Cl>mNOIuix:Xu9$$=_#kPJRax3nooxYze^3F-M' );
define( 'NONCE_SALT',       'ovDIxsB||lcYfZWON$i{AgZs/MHaZP4,mxOn896EJlq;Zp/q;KW>uzOv3R{FqBQ_' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
