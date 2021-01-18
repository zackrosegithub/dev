<?php
/*
Plugin Name:  SMTP Config
Description:  Sets email smtp via .env file
Version:      1.0.1
Author:       Staxoweb
Author URI:   https://staxoweb.com
License:      MIT License
*/
function smtp_setup( &$phpmailer )
{
  if(defined('MAIL_HOST'))
  {
    $phpmailer->IsSMTP();


    $phpmailer->Host = MAIL_HOST;
    $phpmailer->Port = defined('MAIL_PORT') ? MAIL_PORT : 25;

    if(defined('MAIL_FROM_ADDRESS'))
    {
      $phpmailer->From = MAIL_FROM_ADDRESS;
    }

    if(defined('MAIL_FROM_NAME'))
    {
      $phpmailer->FromName = MAIL_FROM_NAME;
    }

    $phpmailer->SetFrom( $phpmailer->From, $phpmailer->FromName );

    $phpmailer->SMTPSecure = defined('MAIL_ENCRYPTION') ? MAIL_ENCRYPTION : 'none';

    if(defined('MAIL_USERNAME') &&
       defined('MAIL_PASSWORD')
    )
    {
      $phpmailer->SMTPAuth   = true;
      $phpmailer->Username   = MAIL_USERNAME;
      $phpmailer->Password   = MAIL_PASSWORD;
    }

    $phpmailer->SMTPAutoTLS = true;

    $phpmailer->Timeout = 10;

    if(defined('MAIL_INSECURE') && MAIL_INSECURE)
    {
      $phpmailer->SMTPOptions = [
        'ssl' => [
          'verify_peer'        => false,
          'verify_peer_name'   => false,
          'allow_self_signed'  => true
        ]
      ];
    }
  }
}

add_action( 'phpmailer_init', 'smtp_setup', 999 );

function smtp_from_address($from)
{
  if(defined('MAIL_FROM_ADDRESS'))
  {
    return MAIL_FROM_ADDRESS;
  }

  return $from;
}

add_filter('wp_mail_from', 'smtp_from_address');

function smtp_from_name($from)
{
  if(defined('MAIL_FROM_NAME'))
  {
    return MAIL_FROM_NAME;
  }

  return $from;
}

add_filter('wp_mail_from_name', 'smtp_from_name');

function onMailError( $wp_error )
{
  ob_start();
  print_r($wp_error);
  $error = ob_get_clean();

  throw new ErrorException($error);
}

add_action( 'wp_mail_failed', 'onMailError', 10, 1 );

function smtp_test_page()
{
  ?>

  <div class="wrap">

    <h1>SMTP test</h1>

    <form method="post">
      <table>
        <tr>
          <td>Enter test email recipient:</td>
          <td><input type="email" name="test_email"></td>
          <td><button type="submit">Send</button></td>
        </tr>
      </table>
    </form>

    <?php
    if($test_email = filter_input(INPUT_POST, 'test_email'))
    {
      try {
        wp_mail($test_email, 'Test: ' . uniqid(), 'this is a test' );

        echo "Okay";
      } catch (ErrorException $ex) {
        echo "<pre>", $ex->getMessage(), "\n", $ex->getTraceAsString(), "</pre>";
      }

    }

    ?>

  </div>

  <?php
}


function smtp_test_page_menu()
{
  add_submenu_page(
    'tools.php',
    'SMTP Test',
    'SMTP Test',
    'edit_posts',
    'smtp-test-admin-page',
    'smtp_test_page'
  );
}

add_action( 'admin_menu', 'smtp_test_page_menu', 99);
