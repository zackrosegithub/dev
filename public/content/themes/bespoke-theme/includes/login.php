<?php
/*
  ==========================================
   Theme login cleanup
  ==========================================
*/
function login_url()
{
  return home_url();
}

add_filter( 'login_headerurl', 'login_url' );

function login_title()
{
  return get_option( 'blogname' );
}

add_filter( 'login_headertext', 'login_title' );


function login_logo()
{
  ?>
    <style type="text/css">
    #login h1 a, .login h1 a {
      background: none;
      height:65px;
      width:320px;
      text-transform: uppercase;
      text-indent: 0;
      font-size: 2rem;
    }
    </style>
  <?php
}

add_action( 'login_enqueue_scripts', 'login_logo' );
