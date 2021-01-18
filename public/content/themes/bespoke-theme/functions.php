<?php
require_once __DIR__ . '/includes/misc.php';
require_once __DIR__ . '/includes/post_types.php';
require_once __DIR__ . '/includes/taxonomies.php';
require_once __DIR__ . '/includes/acf.php';
require_once __DIR__ . '/includes/widgets.php';
require_once __DIR__ . '/includes/mega.php';
require_once __DIR__ . '/includes/login.php';
require_once __DIR__ . '/includes/bootstrap_helper.php';
require_once __DIR__ . '/includes/navwalker.php';


if( function_exists('acf_add_options_page') ) {

  acf_add_options_page();

}

/*
  ==========================================
   Include scripts
  ==========================================
*/

function script_enqueue()
{
  $version = intval(@file_get_contents(dirname(__FILE__) . '/dist/version.txt'));

  wp_enqueue_style('stylesheets', get_template_directory_uri() . '/dist/css/main.css', array(), $version, 'all');

  wp_enqueue_script('javascript', get_template_directory_uri() . '/dist/js/main.js', array(), $version, true);
}

add_action('wp_enqueue_scripts', 'script_enqueue');

/*
  ==========================================
   Activate menus
  ==========================================
*/
function theme_setup()
{
  add_theme_support('menus');
  register_nav_menu('primary', 'Primary Header Navigation');
}

add_action('init', 'theme_setup');

/*
  ==========================================
   Theme support function
  ==========================================
*/

add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form'));
add_theme_support( 'title-tag' );


/*
  ==========================================
   Theme cleanup
  ==========================================
*/

function theme_cleanup ()
{
    add_filter('the_generator', '__return_false');

    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'print_emoji_detection_script', 7 );
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action('wp_print_styles', 'print_emoji_styles' );

    add_image_size( 'desktop', 2100, 1080, false);
    add_image_size( 'desktop-side', 1050, 1080, false);
    add_image_size( 'mobile-portrait', 470, 800, false);
}

add_action('after_setup_theme', 'theme_cleanup');


function use_bootstrap_navwalker($args)
{
  $args = array_merge($args, [
    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
    'walker'      => new WP_Bootstrap_Navwalker(),
  ]);

  $args['menu_class'] .= ' navbar-nav';

  return $args;
}

add_filter('wp_nav_menu_args', 'use_bootstrap_navwalker');

