<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'BetaCode');

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
define('AUTH_KEY',         'W8uBoFk!{`Sg,Ac8MHtvy+[()9__&l*teJY#+Lz-3dyk?yt~0Kpc_Xh&tQoom<3|');
define('SECURE_AUTH_KEY',  'z,h;wT=b{q:v_G[((,6w92v(_yu/y^N/1:NC}N40s4rL(s?NA-TMV~Bo<jTA$^= ');
define('LOGGED_IN_KEY',    ')6v}&2W=l#byA}eV%.xDF#Begk.=0,Ao#;jr,U~O(osP#=/)Z8X=</1?nf !HtNT');
define('NONCE_KEY',        '|BQ!2Tc|3%ktXBR4]/=.JrNN)T%w!q3||BzDRIL2v~25^V|3MBlvt<;Es&]!Rsy}');
define('AUTH_SALT',        'xixqMN}U(:l?TGeM(;,g02OaBCAxBM @{_h)P6JGC%MR0 4k)w`Q]W=~Xt0 W+q-');
define('SECURE_AUTH_SALT', '9K46y3d1w4}73>?f# j:(;{T9!R30T6]Kp$h` k(JCE~R%3c];xqAp9$A|aX@>7R');
define('LOGGED_IN_SALT',   'FQpxuId=oKgXV@FmTWAt9@}ueM[ms}ywW{IE`b*u22~tg+X=:k@$is6B@{G0d5gM');
define('NONCE_SALT',       'mldPP[R!XkL]/!CVTE@_p(2>TwuJi&}DC)l[FX3d.q_ w{vU~p6*pT0Ho0!e3W&v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'BetaCode_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
