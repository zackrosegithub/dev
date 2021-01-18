<div class="content-block-blue">
  <div class="container content-block-blue-container">
    <div class="row">
      <div class="col-12">
        <?php the_sub_field('title'); ?>
      </div>
        <?php if( have_rows('column-block-blue-repeater') ): ?>
          <?php while( have_rows('column-block-blue-repeater') ) : the_row(); ?>
          <div class="lower-card col-12 col-lg-3 d-flex justify-content-center flex-column align-items-center the-content">
            <?php echo the_sub_field('content'); ?>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
    </div>
  </div>
</div>