<?php
/*
Plugin Name:  Site Manager Role
Description:  Editor role plus Manage users
Version:      1.0.0
Author:       Staxoweb
Author URI:   https://staxoweb.com
License:      MIT License
*/

/**
 * User Add Role
 */
function _site_manager_role ()
{
  $editor = get_role('editor');

  $capabilities = $editor->capabilities;

  $capabilities['list_users'] = true;
  $capabilities['create_users'] = true;
  $capabilities['add_users'] = true;
  $capabilities['edit_users'] = true;
  $capabilities['delete_users'] = true;
  $capabilities['remove_users'] = true;
  $capabilities['promote_users'] = true;

  add_role('site_manager', 'Site Manager', $capabilities);
}

add_action('init', '_site_manager_role', 999);

/**
 * User Prevent access to user with higher permissions
 */
function _filter_promote_user($roles)
{
  if(isset($roles['administrator']) && !current_user_can('administrator'))
  {
    unset($roles['administrator']);
  }

  return $roles;
}

add_filter('editable_roles', '_filter_promote_user');


/**
 * User Prevent access to user with higher permissions
 */
function _filter_capabilities($capabilities, $cap, $current_user_id, $args)
{
  $user_id = reset($args);

  if($cap == 'administrator' || current_user_can('administrator') || $user_id == $current_user_id)
  {
    return $capabilities;
  }

  switch ($cap)
  {
    case 'promote_user':
    case 'delete_user':
    case 'remove_user':
    case 'edit_user':
    case 'add_user':

      $user = get_user_by('ID', $user_id);

      if($user && $user->has_cap('administrator'))
      {
        $capabilities = ['do_not_allow'];
      }
  }

  return $capabilities;
}

add_filter('map_meta_cap', '_filter_capabilities', 1, 4);
