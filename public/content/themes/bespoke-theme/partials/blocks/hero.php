<div class="row block-hero" style="margin-right: 0; margin-left: 0;">
  <div class="hero">
          <?php $uniqueid = uniqid();
                $images = get_sub_field('foreground_image'); ?>

    <?php $file = get_sub_field('file') ?>


    <?php if($file ['type'] == 'video'): ?>
      <?php $video_placeholder = get_sub_field('video_placeholder') ?>

      <video loop muted <?php echo $video_placeholder ? 'preload="off" class="d-none"' : 'autoplay' ?> playsinline>
        <source src="<?php esc_attr_e($file['url']) ?>" type="<?php esc_attr_e($file['mime_type']) ?>">
      </video>

      <?php if($video_placeholder) $file = $video_placeholder ?>
    <?php endif; ?>

    <?php if($file ['type'] == 'image'): ?>
      <?php echo BootstrapHelper::picture($file, ['xs' => 'desktop-side', 'md' => 'desktop']) ?>
    <?php endif; ?>

    <div class="container second-container main-container" style="z-index: 2; position: relative;">
      <div class="row second-row">
        <div class="col-12 d-flex justify-content-center align-items-center content-side">
          <div class="hero-content">

            <?php the_sub_field('content') ?>

            <div class="d-flex align-items-center justify-content-center row ">
              <div class="col-lg-5 first-button-hero">
                <a class=" first-first-button btn btn-light btn-rounded w-100 col-12 justify-content-center " href="<?php echo get_site_url(); ?>/contact"><span class="hero-button-text">Get in touch<span></a>
              </div>

            <div class="row mobile-auto col-12 col-lg-6">

              <a class=" transparent-button btn btn-outline-light btn-rounded col-lg-10" href="#"><span class="second hero-button-text justify-content-center">View this project</span></a>

            </div>
            </div>


            <?php if( have_rows('links_repeater') ): $outline = true; ?>

              <?php while( have_rows('links_repeater') ) : the_row(); $outline = !$outline; ?>

                <?php if( $link = get_sub_field('links') ): ?>
                    <a target="_blank" class="iwc-button btn btn-lg <?php echo $outline ? 'btn-outline-primary' : 'btn-primary' ?> btn-rounded mr-3" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                <?php endif; ?>

              <?php endwhile; ?>
            <?php endif; ?>


          </div>
        </div>


      </div>
    </div>

  </div>
</div>
