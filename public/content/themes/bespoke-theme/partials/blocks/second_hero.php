
  <div class="hero second-hero">

    <div class="second-hero-gradient"></div>


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


    <div class="container second-hero-container">
        <div class="second-hero-content">
          <?php the_sub_field('content') ?>
        </div>
    </div>

  </div>
