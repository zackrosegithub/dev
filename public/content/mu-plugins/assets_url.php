<?php
/*
Plugin Name:  Assets URL
Description:  Sets different domain for media, to give improved browser load speed via .env file
Version:      1.0.1
Author:       Staxoweb
Author URI:   https://staxoweb.com
License:      MIT License
*/

namespace Staxoweb\WP;


function replace_assets_url ($uri)
{
  if(defined('ASSETS_URL') && ASSETS_URL)
  {
    $uri = str_replace(home_url(), ASSETS_URL, $uri);
  }

  return $uri;
};

add_filter('upload_dir', function ($uploads) {
  $uploads['url'] = replace_assets_url( $uploads['baseurl']);
  $uploads['baseurl'] = replace_assets_url( $uploads['baseurl']);

  return $uploads;
});

add_filter('theme_root_uri', __NAMESPACE__ . '\\replace_assets_url');
add_filter('script_loader_src', __NAMESPACE__ . '\\replace_assets_url');
add_filter('style_loader_src', __NAMESPACE__ . '\\replace_assets_url');
