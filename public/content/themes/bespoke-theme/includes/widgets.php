<?php
/*
  ==========================================
   Sidebar function
  ==========================================
*/
// function widget_footer()
// {
//   add_theme_support('widget');

//   register_sidebar(
//     [
//       'name'  => 'Footer',
//       'id'    => 'footer',
//       'description' => 'Footer widgets for navigation',
//       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//       'after_widget'  => '</aside>',
//       'before_title'  => '<h1 class="widget-title">',
//       'after_title'   => '</h1>',
//     ]
//   );
// }

// widget_footer();
// add_action('init', 'widget_footer');


//////

//////


function widget_init() {

  register_sidebar([
    'name' => esc_html__('Main Sidebar', 'bespoke-theme'),
    'id' => 'main-sidebar',
    'description' => esc_html__('Add widgets for main sidebar', 'bespoke-theme'),
    'before_widget' => '<section class="widget">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>'

  ]);

}

add_action('widgets_init' , 'widget_init');
