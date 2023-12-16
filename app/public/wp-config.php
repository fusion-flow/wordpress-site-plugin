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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '!@l%~WqN}e3YyU O@4E:Z`4^jS9$qt`:f{#omnPw/sbzp![wQO[4)#1l8.lsg/V$' );
define( 'SECURE_AUTH_KEY',   'o*z$1p:_>W,:r`qm,.C5[4mY=lJJwQ(2e7*wsln(n%!r@1uF=dEmRI)tJD~+-$ s' );
define( 'LOGGED_IN_KEY',     'u-[7Pc:9>Mlz2[qh.g(+j;e^:u9c 1WB{AdLr-f/7G`_QEZj8(crh?%&k*4^e(=@' );
define( 'NONCE_KEY',         'VF^]8#c!76Lq!XrtESc[TfYLf&29|TTs4oWk2C>@hUQa6R9>~L`,2wBk;P27=YTl' );
define( 'AUTH_SALT',         '%2yI-tM)kidGlU=r[P:ow[63emVj5-~**)G_v#]Ry5:26]G!IGx1<D0ggA-3YDSg' );
define( 'SECURE_AUTH_SALT',  ' V$U^yq~7g3O>%>4%>MXY9<~6B3)&QJG|P$n*%Hp!Lo#c!`<9M0tY0#dGyRIQ!AE' );
define( 'LOGGED_IN_SALT',    'fa~9o1>ew]qC_KUQk~YG~TseRILh0d?!rJ{bFw1;N8w66z}Z4LV;pL&K>)-nG]@&' );
define( 'NONCE_SALT',        '^u9,N|4;(6{jDIoaA2gsi20$qhFu*wYD`t5jEu(v V+djVs^,s[ktrd1^}8D?;ZQ' );
define( 'WP_CACHE_KEY_SALT', 'm=+eE~^6Xfe(s5*2p!A|8w-s#F`=dJi&!^<?>OB+e-HULA_Z#&Ppz2&Wx,do_!Sq' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
