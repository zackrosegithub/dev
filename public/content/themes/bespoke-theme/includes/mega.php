<?php

/* Mega */

if(!class_exists('ACF'))
{
  return;
}

function mega_content($post_content = null, $ID = null)
{
  if( empty(get_page_template_slug($ID)) && is_array(get_field('flexible_content', $ID)))
  {
    ob_start();

    ?>
    <div class="mega">
    <?php

    while(have_rows('flexible_content', $ID))
    {
      the_row();
      get_template_part('partials/blocks/' . get_row_layout());
    }

    ?>
    </div>
    <?php

    return ob_get_clean();
  }

  return $post_content;
}


function mega_content_as_content($ID)
{
  global $post, $wpdb;

  $post = get_post($ID);

  if($post->post_type != 'page')
  {
    return;
  }

  $post_content = $post->post_content;

  // wp-includes/class-wp-embed.php
  if( !empty($GLOBALS['wp_embed']) )
  {

    remove_filter( 'acf_the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8);
    remove_filter( 'acf_the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8);

  }

  remove_filter( 'acf_the_content', 'do_shortcode', 11);

  if( $post_content = mega_content($post_content, $ID) )
  {
    $post_content = "<!-- wp:html -->\n" . $post_content . "\n<!-- /wp:html -->";

    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = %s WHERE ID = %d", $post_content, $ID));
  }

  // wp-includes/class-wp-embed.php
  if( !empty($GLOBALS['wp_embed']) )
  {

    add_filter( 'acf_the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
    add_filter( 'acf_the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

  }

  add_filter( 'acf_the_content', 'do_shortcode', 11);
}

add_action('save_post', 'mega_content_as_content');

function refresh_mega_content_cache()
{
  $pages = new WP_Query([
    'post_type' => 'page',
    'post_status' => 'any',
    'posts_per_page' => -1,
  ]);

  while($pages->have_posts())
  {
    $pages->the_post();

    mega_content_as_content(get_the_ID());
  }
}

function admin_mega_rebuild()
{
  ?>

  <div class="wrap">

    <h1>Rebuild</h1>

    <form method="post">
      <table>
        <tr>
          <td><button type="submit" name="rebuild" value="true">Rebuild</button></td>
        </tr>
      </table>
    </form>

    <?php
    if(filter_input(INPUT_POST, 'rebuild'))
    {
      refresh_mega_content_cache();
      echo "Done";
    }

    ?>

  </div>

  <?php
}

function admin_mega_rebuild_menu()
{
  add_submenu_page(
    'edit.php?post_type=page',
    'Rebuild Mega Pages',
    'Rebuild Mega Pages',
    'edit_posts',
    'mega-rebuild',
    'admin_mega_rebuild'
  );
}

add_action( 'admin_menu', 'admin_mega_rebuild_menu', 99);

add_action('init', function () {
  if(defined('WP_ENV') && WP_ENV != 'production')
  {
    add_filter('the_content', 'mega_content');
  }
});


if(class_exists(WP_CLI::class))
{
  function cli_refresh_mega_content_cache($args)
  {
    refresh_mega_content_cache();

    WP_CLI::success('Pages Rebuilt');
  }

  add_action('init', function () {
    WP_CLI::add_command( 'theme rebuild-pages', 'cli_refresh_mega_content_cache' );
  });
}

