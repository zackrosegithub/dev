<?php
/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config/environments/{{WP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use Roots\WPConfig\Config;



/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/public';


/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH'))
{
  define('ABSPATH', $webroot_dir . '/wp/');
}

require_once ABSPATH . 'wp-includes/plugin.php';

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
{
  $_SERVER['HTTPS'] = 'on';
}


/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv($root_dir);

if (file_exists($root_dir . '/.env'))
{
  $dotenv->load();

  $dotenv->required(['WP_HOME', 'WP_SITEURL']);

  if (!env('DATABASE_URL'))
  {
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD']);
  }
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');

/**
 * URLs
 */
Config::define('WP_HOME', env('WP_HOME'));
Config::define('WP_SITEURL', env('WP_SITEURL'));

/**
 * Custom Content Directory
 */
Config::define('CONTENT_DIR', '/content');
Config::define('WP_CONTENT_DIR', $webroot_dir . Config::get('CONTENT_DIR'));
Config::define('WP_CONTENT_URL', Config::get('WP_HOME') . Config::get('CONTENT_DIR'));

Config::define('WP_DEFAULT_THEME', env('WP_DEFAULT_THEME'));

/**
 * Assets URL
 */
Config::define('ASSETS_URL', env('ASSETS_URL'));

/**
 * DB settings
 */
Config::define('DB_NAME', env('DB_NAME'));
Config::define('DB_USER', env('DB_USER'));
Config::define('DB_PASSWORD', env('DB_PASSWORD'));
Config::define('DB_HOST', env('DB_HOST') ?: 'localhost');
Config::define('DB_CHARSET', 'utf8mb4');
Config::define('DB_COLLATE', 'utf8mb4_unicode_ci');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

if (env('DATABASE_URL'))
{
  $dsn = (object) parse_url(env('DATABASE_URL'));

  Config::define('DB_NAME', substr($dsn->path, 1));
  Config::define('DB_USER', $dsn->user);
  Config::define('DB_PASSWORD', isset($dsn->pass) ? $dsn->pass : null);
  Config::define('DB_HOST', isset($dsn->port) ? "{$dsn->host}:{$dsn->port}" : $dsn->host);
}

/**
 * Authentication Unique Keys and Salts
 */
Config::define('AUTH_KEY', env('AUTH_KEY'));
Config::define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
Config::define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
Config::define('NONCE_KEY', env('NONCE_KEY'));
Config::define('AUTH_SALT', env('AUTH_SALT'));
Config::define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
Config::define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
Config::define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Custom Settings
 */
Config::define('WPLANG', env('WPLANG') ?: '');
Config::define('AUTOMATIC_UPDATER_DISABLED', true);
Config::define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);
// Disable the plugin and theme file editor in the admin
Config::define('DISALLOW_FILE_EDIT', true);
// Disable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', true);
Config::define('WP_AUTO_UPDATE_CORE', env('WP_AUTO_UPDATE_CORE') ?: false);
Config::define('WP_ALLOW_MULTISITE', env('WP_ALLOW_MULTISITE') ?: false);
Config::define(
  'WP_TEMP_DIR',
  env('WP_TEMP_DIR') ?: Config::get('WP_CONTENT_DIR')
);


/**
 * SMTP
 */
Config::define('MAIL_HOST', env('MAIL_HOST') ?: false);
Config::define('MAIL_PORT', env('MAIL_PORT') ?: false);
Config::define('MAIL_USERNAME', env('MAIL_USERNAME') ?: false);
Config::define('MAIL_PASSWORD', env('MAIL_PASSWORD') ?: false);
Config::define('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS') ?: false);
Config::define('MAIL_FROM_NAME', env('MAIL_FROM_NAME') ?: false);
Config::define('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION') ?: false);
Config::define('MAIL_INSECURE', env('MAIL_INSECURE') ?: false);

/**
 * Debugging Settings
 */
Config::define('ROLLBAR_ACCESS_TOKEN', env('ROLLBAR_ACCESS_TOKEN') ?: false);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', false);
Config::define('SCRIPT_DEBUG', false);
ini_set('display_errors', 1);
ini_set('log_errors', 1 );
ini_set('error_log', $root_dir . '/debug.log');

/**
 * Other required
 */

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
  require_once $env_config;
}

Config::apply();


/**
 * Override debug function
 */
add_filter('enable_wp_debug_mode_checks', function () {
  if ( WP_DEBUG_DISPLAY ) {
    ini_set( 'display_errors', 1 );
  } elseif ( null !== WP_DEBUG_DISPLAY ) {
    ini_set( 'display_errors', 0 );
  }

  if ( defined( 'XMLRPC_REQUEST' ) || defined( 'REST_REQUEST' ) || ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) || wp_doing_ajax() || wp_is_json_request() )
  {
    ini_set( 'display_errors', 0 );
  }

  return false;
});
