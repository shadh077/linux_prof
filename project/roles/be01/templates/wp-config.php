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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpdb' );

/** Database username */
define( 'DB_USER', 'wpuser' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_HOME', 'https://blog.local/blog' );
define( 'WP_SITEURL', 'https://blog.local/blog' );

$_SERVER['REQUEST_URI'] = str_replace("/wp-admin/", "/blog/wp-admin/", $_SERVER['REQUEST_URI']);

$_SERVER['HTTP_HOST'] = 'blog.local';


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
define( 'AUTH_KEY',         '&^3b>*bl~=XI7g&L?:SYTD,;I!<IK<cDhfdQgz6sQo9B32M=r0=7/:+,EMpAkU*~' );
define( 'SECURE_AUTH_KEY',  'O-ZDxg!CmL^(@]LX Ok%HTFNQF99uf *Va%si`1-u](z-/mdfY,J+&)yNaOOc|p#' );
define( 'LOGGED_IN_KEY',    'y%yRio!9ATC<^:JE$!Uf5LIK@/0v#qOXDMhsmQr+QIqc-8g-{_c&~-.f4>w|5|5$' );
define( 'NONCE_KEY',        '+HW@:(0!dr#aBigRBl_V{>lM=`~&X6QE~tJiUC>|N#u+?Jx< A*3`oW ?3OJ<o}E' );
define( 'AUTH_SALT',        'jTK,9K-hV:=uPG$We^BF~F_QYlB?u(NNYp8a%@H%IxB9|@?|_6CTO:~Z>nM4}s$o' );
define( 'SECURE_AUTH_SALT', 'gU-0uCqINz]Y9HcOxy8/eC734pA+|V5egFhjH)qXaA?dIBC)Pt2<h+KfZh|ctu7x' );
define( 'LOGGED_IN_SALT',   '-3-]KMKj:V1VF}{.$[IWv`jd*c++#ObVq+1q0E8;~:S61::|B9Q+!Gjq-ZVL{k&4' );
define( 'NONCE_SALT',       '.zdI9#lX|UIw9Pf-+m91qK|H%h[0CM@]e.3ds@Mtm`tv;1p?.U6QFd,_tc,s%0:f' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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