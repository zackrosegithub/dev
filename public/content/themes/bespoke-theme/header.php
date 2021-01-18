<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<header class="scrolled-to-top" >
  <div class="container bg-transparent header-container">
      <div class="row">
        <div class="col-12 col-lg-6 d-flex align-items-center top-row">
          <div class="d-flex align-items-center justify-content-between w-100 mobile-menu-layout">
            <a class="first-item" href="/">
              <img class="staxo" src="<?php echo get_template_directory_uri() ?>/assets/images/STAXO.svg">
            </a>
            <h5 class="tel d-flex align-items-center justify-content-end"><a class="mobile-tel" href="tel:020 8017 2318">020 8017 2318</a></h5>

            <h5 class="about-us d-none d-lg-flex">COVID-19 Update</h5>
          </div>
        </div>
        <div class="col-12 col-lg-6 align-items-center d-flex justify-content-end project-contact pr-0 pl-0">
          <div class="d-flex justify-content-end nav-wrapper">
           <nav class="navbar navbar-expand-lg pr-0 pl-0">
              <!-- <a class="navbar-brand" href="#">Carousel</a> -->

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">

                <div class="row">
                  <h5 class="about-us mobile d-flex d-lg-none col-12 ml-0">COVID-19 Update</h5>
                </div>

                <hr class="d-lg-none mt-0 mb-0 w-100">

                <?php wp_nav_menu([
                  'theme_location'  => 'primary',
                  'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                  'container'       => '',
                  // 'menu_class'      => 'ml-auto',
                ]); ?>


                <hr class="d-lg-none mt-0 mb-0 w-100">

                <h4 class="d-lg-none header-address d-flex"><span class="header-text">Staxo Group Limited, Oriel House, 26 The Quadrant, Richmond, London, TW9 1DL</span></h4>

                <h4 class="d-lg-none header-book-call d-flex align-items-center">Book a Call</h4>

              </div>
            </nav>

            <button class="d-none d-lg-block btn btn-outline-secondary book-a-call"><a href="<?php echo get_site_url(); ?>/contact"><p class="one header-button">Get in touch</p></a></button>
          </div>
        </div>
      </div>
  </header>

