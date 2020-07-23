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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'atlas' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '+by 5}{U{tWE6!f4W#?NA$Pa] D3=y`%rBEdz:*uW`S>Eagm]w6f~D @6=U@H$c<' );
define( 'SECURE_AUTH_KEY',  'ot$bLPc&Lh-$K`<@}5=tRZzj^J0!8R/PAi5Ba91<Y@XTwW*:XF[V5m=6G.1 |8:K' );
define( 'LOGGED_IN_KEY',    'wjZ6IEkm9)i3wWOVFc/P26y]qK-2~^2m&q0wEp$mmnUcO@$i8A<Y[/`klCD~cA~%' );
define( 'NONCE_KEY',        ')XT|+qDKYrh--f@$GXjAK8)[r-DP}dF=V#N4wU&Ie=QrGn{*L!PM(!dM^v{o(,H>' );
define( 'AUTH_SALT',        '>:@USSVucpSUfP5q<_=*ybH{F6k%sQtQ1OJ#)wD{L,kOo$sj1wa&J~/)fOIKXu93' );
define( 'SECURE_AUTH_SALT', 'n)y_5qteZ=Qz}_%@$W.Ieuv^ThRxr }Kh-e-Vf$Le*Z0z;L9fE}k>VW9ZLmS9j%q' );
define( 'LOGGED_IN_SALT',   '$4hB45v/?S},{g+uO PEj[V2a7xS<YGCY4{wJx&n,k9|W<kg`0Pf,jZCPgJZ&{km' );
define( 'NONCE_SALT',       'r<J<YV9ds%xQb]oF8j# w63nUq:*OJ&KpW~jH,2uw_[[89 E$/,>{n$f-H:M/~Oh' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
