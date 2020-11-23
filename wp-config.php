<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', '' );

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
define( 'AUTH_KEY',         '+/PW{&cj8,{v*n29XE5!YQB1@x C1[8z(ZK.TNv<|$x]g3eEqwOc *YV5x HWQvk' );
define( 'SECURE_AUTH_KEY',  ']b>{lWw`XvkL/F2Y4WVA2p}morS;)D5dq7p)>p {,m%#<FR.E}bam?cDWh<jk2/Q' );
define( 'LOGGED_IN_KEY',    '[Uv#05@3wh*NsFS-n}}bUU4UD-gjcosW?x-M&~0YeJAsiHtk xs/3 olLA[F)YgS' );
define( 'NONCE_KEY',        '9x[X1=g%K7/N;:0CJK!NzXtRTdjB@#C$X1YKZuJ=K9Dm{gDCttwY@V<0[XNn!>Ea' );
define( 'AUTH_SALT',        '9 wSXa#!E0OqXVH8yXq}aHffk}K|du!UmWE<t];nUt_kg6[tB[H;Xt1!4DtPk]P8' );
define( 'SECURE_AUTH_SALT', 'Cfi$apPb={CBIa!Za*fsj7doQDlF(8QWe!gq1y@^| I ~Db>>VS3E?`jZ?GGT8?5' );
define( 'LOGGED_IN_SALT',   'mADdGK};27bcAfK*T]G|P}LKEhLN1K&=&/cTJi07d6$YaIlpx8l87YR .b`F0VIc' );
define( 'NONCE_SALT',       '`&HYpqYaidJD3-:=pp)t,E!_^sM?dzmcOkLVic0#t)76h<.zcLPBS`%|{RA>%%KC' );

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
