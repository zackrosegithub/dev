<div class="content-block-bigger <?php the_sub_field('choose_background'); ?>">
   <div class="container content-block-bigger-container">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6 image-side <?php the_sub_field('choose_side'); ?>">
        <?php $file = get_sub_field('file') ?>


        <?php if($file ['type'] == 'video'): ?>
          <?php $video_placeholder = get_sub_field('video_placeholder') ?>

          <video loop muted controls <?php echo $video_placeholder ? 'preload="off" class="d-none"' : '' ?> playsinline>
            <source src="<?php esc_attr_e($file['url']) ?>" type="<?php esc_attr_e($file['mime_type']) ?>">
          </video>

          <?php if($video_placeholder) $file = $video_placeholder ?>
        <?php endif; ?>

        <?php if($file ['type'] == 'image'): ?>
          <?php echo BootstrapHelper::picture($file, ['xs' => 'desktop-side', 'md' => 'desktop']) ?>
        <?php endif; ?>
      </div>
      <div class="col-12 col-lg-6 text-side d-flex justify-content-center flex-column">
        <?php the_sub_field('content') ?>
      </div>
    </div>
   </div>
</div>
