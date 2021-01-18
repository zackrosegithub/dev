
<div class="hero call-to-action-hero">

  <div class="call-to-action-gradient"></div>

  <?php
  $image = get_sub_field('image');
  if( $image ):

      // Image variables.
      $url = $image['url'];
      $title = $image['title'];
      $alt = $image['alt'];
      $caption = $image['caption'];

      // Thumbnail size attributes.
      $size = 'thumbnail';
      $thumb = $image['sizes'][ $size ];
      $width = $image['sizes'][ $size . '-width' ];
      $height = $image['sizes'][ $size . '-height' ]; ?>

      <?php if( !empty( $image ) ): ?>
          <img class="call-to-action-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
      <?php endif; ?>

    <?php endif; ?>

  <div class="container call-to-action-container">
    <div class="d-flex align-items-center justify-content-center h-100">
      <div class="call-to-action-content">
        <?php the_sub_field('content') ?>
      </div>
    </div>
  </div>

</div>
