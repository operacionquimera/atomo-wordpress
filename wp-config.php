<?php

/**
 * Base configuration for Átomo WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following notable exports:
 *
 *     - MySQL settings
 *     - Secret keys
 *     - Database table prefix
 *     - ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package atomo
 */

/** Absolute path to the WordPress directory. */
defined( 'ABSPATH' ) or define( 'ABSPATH', __DIR__ . '/' );

if ( file_exists( ABSPATH . 'vendor/autoload.php' ) ) {
	require_once ABSPATH . 'vendor/autoload.php';
}

if ( is_readable( ABSPATH . '.env' ) ) {
	$ini = parse_ini_file( ABSPATH . '.env', false, INI_SCANNER_TYPED );
	foreach ($ ini as $name => $value ) {
		putenv( "$name=$value" );  // FIXME Not really elegant ..
	}
}


/** Operational environment for the whole WordPress application */
define( 'WP_ENV', getenv( 'WP_ENV', true ) ?: 'production' );


/*  ~: START OF CONFIGURATION :~  */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv( 'DB_NAME', true ) ?: 'atomo' );

/** MySQL database username */
define( 'DB_USER', getenv( 'DB_USER', true ) ?: 'atomo' );

/** MySQL database password */
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD', true ) ?: 'atomo' );

/** MySQL hostname */
define( 'DB_HOST', getenv( 'DB_HOST', true ) ?: 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv( 'DB_PREFIX', true ) ?: 'wp_';  // @codingStandardsIgnoreLine


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv( 'WP_AUTH_KEY', true ) ?: 'INSECURE:KEY' );
define( 'SECURE_AUTH_KEY',  getenv( 'WP_SECURE_AUTH_KEY', true ) ?: 'INSECURE:KEY' );
define( 'LOGGED_IN_KEY',    getenv( 'WP_LOGGED_IN_KEY', true ) ?: 'INSECURE:KEY' );
define( 'NONCE_KEY',        getenv( 'WP_NONCE_KEY', true ) ?: 'INSECURE:KEY' );
define( 'AUTH_SALT',        getenv( 'WP_AUTH_SALT', true ) ?: 'INSECURE:SALT' );
define( 'SECURE_AUTH_SALT', getenv( 'WP_SECURE_AUTH_SALT', true ) ?: 'INSECURE:SALT' );
define( 'LOGGED_IN_SALT',   getenv( 'WP_LOGGED_IN_SALT', true ) ?: 'INSECURE:SALT' );
define( 'NONCE_SALT',       getenv( 'WP_NONCE_SALT', true ) ?: 'INSECURE:SALT' );

/**#@-*/

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
define( 'WP_DEBUG', getenv('WP_DEBUG', true) );
define( 'WP_DEBUG_LOG', getenv('WP_DEBUG_LOG', true) );
define( 'WP_DEBUG_DISPLAY', getenv('WP_DEBUG_DISPLAY', true) );

define( 'SAVEQUERIES', getenv('WP_SAVEQUERIES', true) );


/*  ~: END OF CONFIGURATION :~  */

require_once ABSPATH . 'wp-settings.php';
