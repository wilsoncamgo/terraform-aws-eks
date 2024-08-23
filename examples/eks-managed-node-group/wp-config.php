<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'bn_wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'tysjt6Dhls' );

/** Database hostname */
define( 'DB_HOST', 'greatness-w-mariadb:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'yz-3sNe;%G(^cFqmkOJ!Y*OtBDLKGcBxJSJ95`4)wsj4}5c2!N=Ww{L?: Pn]0xa' );
define( 'SECURE_AUTH_KEY',  '2b#)VH^7W 7V3F,%Og](U~EYEwvJ.Q3z;V~Y$CqT!||tw]dl(:)XU)EvS^aqE`lm' );
define( 'LOGGED_IN_KEY',    'y5vFHBo:w<OX^@;*l Ka 3xJnId6CvfgJ*h>.!s98;OLb$ID@rroT7D;~/:zkS,Z' );
define( 'NONCE_KEY',        'j&t29l)?m8L[73-xV8h(Lt>o8,!1)3A[cd5+onWQ;B2wr,cOM01jQ}hT<{|X(d06' );
define( 'AUTH_SALT',        '|k?+y#$Ui]BHwkU9y~~j8sU;xxTRn&nN>vZA8^aML,sQ{>Xo^xx*-^To3x*Vo(xl' );
define( 'SECURE_AUTH_SALT', 'F{6sGV[*L6l)9mth~KW{Kd9TB%?pIL7t%DZN{L6eP{z&3X.!R.qR6:hwBq<@AgYh' );
define( 'LOGGED_IN_SALT',   ':F}iXUw]or]V)Sol[Cn`R;1;0xkQB;-1LsEswBH+EcbfaXN2l-sqdFB)fN= k-R!' );
define( 'NONCE_SALT',       'fU4:P:PS^nnZ_]g.I|H.1sqRNYvW:iSfAS-?$qNC~fzc+on@uv*(;&vK O;[!%BB' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}