<div class="service-block">

  <div class="container service-container">
    <div class="row">
      <div class="col-12 col-lg-3 content-col">
        <div class="the-content">
          <?php the_sub_field('content'); ?>
        </div>
      </div>
      <div class="col-12 col-lg-3 second-col">
        <div class="image-wrapper">
        <?php
        $image = get_sub_field('image');
        if( !empty( $image ) ): ?>
            <img class="main-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
         </div>
      </div>
      <div class="col-12 col-lg-6 d-flex flex-column third">
        <div class="row">
         <?php if( have_rows('panels_repeater') ): ?>

          <?php  while( have_rows('panels_repeater') ) : the_row();  ?>

          <div class="col-md-6">
            <div class="row mr-0 ml-0 flex-lg-column align-items-center">
              <?php the_sub_field('panels'); ?>
            </div>
          </div>

            <?php  endwhile; ?>

          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>
