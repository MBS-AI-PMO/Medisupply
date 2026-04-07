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
define( 'DB_NAME', 'medissup_wp685' );

/** Database username */
define( 'DB_USER', 'medissup_wp685' );

/** Database password */
define( 'DB_PASSWORD', '@9Y8x@3S3p' );

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
define( 'AUTH_KEY',         '5J,^MWe=RP0G#CC`*[3_9S_*{5agt+o=,.Ivb=f4IKPftTeZQ49E7.:Ss HS$<9/' );
define( 'SECURE_AUTH_KEY',  '_O4W,WW$PX6y}Bl0XPAsN+xd5Pc@~Ok,xYI<UCZ8#~ v e^{ESbX)C=C$G[1* r<' );
define( 'LOGGED_IN_KEY',    ';$GbrdM*i4*!-dGSQC!a~6,0nBTQ5~!qsZMa{#PodA%_d1djn~=]DJ-b@ZLfzd(7' );
define( 'NONCE_KEY',        'r?S]D4nlPTAw|O?FWA?xk6VcFzKI@2p~S&B2wGX`g`;V~IWdZ|k>j.Cm<Vy;Vq,k' );
define( 'AUTH_SALT',        '/P,yI@y~znjq1wQ$<`N<Vr*Kk.>W]O<O/<<4hkd?~P>}FNZG_$HLX?n<e)9Y+pt~' );
define( 'SECURE_AUTH_SALT', '$=!?4,fkGAJ*LOo(O)=A5eV9|U#vm,JX`HM<1`m/BbMpa(A*hs]Vn3i@ZJ]TD`D<' );
define( 'LOGGED_IN_SALT',   'uTi>c$K2!3D|QsO1|Y)Q`l2AXbrl [-0Wd,b::;B2_T=&T+}VDmJTS6;yAud/#&u' );
define( 'NONCE_SALT',       'P8UTa`yq+%%DnH[f:w|Ymwo, llN4<|H,3~iLl_RzM74K{D+(|LHL?N^b[)cIb.^' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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



define('DISALLOW_FILE_EDIT', true);

define('CONCATENATE_SCRIPTS', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
