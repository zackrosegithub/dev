<div class="row contact-hero">

  <div class="container-fluid">
    <div class="background-wrapper">
      <div class="overlay"></div>

      <?php
      $image = get_sub_field('background_image');
      if( !empty( $image ) ): ?>
          <img class="background-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
      <?php endif; ?>

    </div>
  </div>


  <div class="container contact-container">

    <div class="row">

      <div class="col-12 col-lg-6 content-side">

        <?php the_sub_field('content'); ?>


      </div>

      <div class="col-12 col-lg-6 image-side">

        <div class="image-wrapper">
          <?php
          $image = get_sub_field('foreground_image');
          if( !empty( $image ) ): ?>
              <img class="foreground-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
        </div>


      </div>


    </div>


  </div>

</div>
