<?php get_header(); ?>


  <?php

    if( have_posts() ):

      while( have_posts() ): the_post(); ?>

          <div class="single-project-gradient"></div>

          <?php
          $image = get_field('background_image');
          if( !empty( $image ) ): ?>
              <img class="single-project-background-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>



        <div class="container title">
          <h3><?php the_title(); ?></h3>

          <p><?php the_content(); ?></p>


        </div>

        <div class="foreground-image-wrapper">
          <?php
          $image = get_field('foreground_image');
          if( !empty( $image ) ): ?>
              <img class="single-project-foreground-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
        </div>

        <?php if( have_rows('wysiwyg_repeater') ): ?>

            <div class="container wysiwyg-container">

          <?php while( have_rows('wysiwyg_repeater') ) : the_row(); ?>


              <?php the_sub_field('wysiwyg'); ?>



        <?php endwhile; ?>

            </div>

      <?php endif; ?>

      <div class="container">

        <div class="row">

          <?php if( have_rows('image_repeater') ): ?>

          <?php while( have_rows('image_repeater') ) : the_row(); ?>

              <div class="col-4">

                <?php
                $image = get_field('image');
                var_dump($image);
                echo $image;
                if( !empty( $image ) ): ?>
                    <img class="single-project-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>

              </div>

            <?php endwhile; ?>

          <?php endif; ?>


        </div>

      </div>

      <!-- below here ends the page  -->


      <?php endwhile;

    endif;

    ?>




<?php get_footer(); ?>
