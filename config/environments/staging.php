<?php
/**
 * Configuration overrides for WP_ENV === 'staging'
 */
use Roots\WPConfig\Config;

/**
 * You should try to keep staging as close to production as possible. However,
 * should you need to, you can always override production configuration values
 * with `Config::define`.
 */

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
