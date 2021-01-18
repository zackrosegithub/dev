<?php
/*
  ==========================================
   Custom URL
  ==========================================
*/

function disable_admin_redirects()
{
  remove_action('template_redirect', 'wp_redirect_admin_locations', 1000);
}

add_action('init', 'disable_admin_redirects', 999);

/*
  ==========================================
   Custom Function
  ==========================================
*/

function exit404()
{
  global $wp_query;

  $wp_query->set_404();

  while(ob_get_level())
  {
    ob_end_clean();
  }

  status_header( 404 );
  nocache_headers();
  include( get_query_template( '404' ) );
  exit;
}
