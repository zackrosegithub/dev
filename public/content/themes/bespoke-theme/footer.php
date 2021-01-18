    <footer>


      <!-- project section  -->


    <?php if (!is_post_type_archive('project') ) { ?>

      <div class="staxo-background archive-project">
        <div class="container">

          <div class="d-flex justify-content-between top-of-project-section-footer">

            <h3>Projects</h3>

            <a class="d-none d-lg-flex btn btn-light btn-rounded footer-projects-button" href="<?php echo get_template_directory_uri() ?>/projects"><span class="text-of-button">View All Projects</span></a>

          </div>

          <div class="text-left">
            <p class="one">Here are our most recent projects.</p>
          </div>

          <div class="row">

    <?php
            $args = array(
                'post_type' => 'project',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'cat' => 'home',
            ); ?>

<?php
            $loop = new WP_Query( $args ); ?>

           <?php  while ( $loop->have_posts() ) : $loop->the_post();
                $featured_img = wp_get_attachment_image_src( $post->ID ); ?>

                <div class="col-12 col-lg-4 py-4">
                  <div class="card footer">

                    <?php the_post_thumbnail('full',['class'=>'image-class']); ?>

                     <div class="card-body footer">


                      <h5 class="custom-card-title"><?php  print the_title(); ?></h5>


                      <div class="d-flex mb-2">
                      <?php

                      $theterms = the_terms( $post->ID, 'service','','');

                      if($theterms) {
                      var_dump ($theterms);
                      }


                      ?>
                      </div>

                       <p class="excerpt" >
                      <?php the_excerpt(); ?>
                     </p>

                     <a class="projects-link" href="<?php the_permalink(); ?>">View Project</a>

                     </div>



                  </div>



                </div>


               <?php
            endwhile;

            wp_reset_postdata(); ?>



     <!--      <?php //if( have_posts() ): ?>

              <?php //while( have_posts() ): the_post(); ?>

            <div class="col-12 col-lg-4 py-4">

                  <?php //get_template_part( 'template-parts' , 'project', get_post_format()); ?>


                    <div class="card">

                      <?php //the_post_thumbnail('full',['class'=>'image-class']); ?>

                      <div class="card-body footer">

                        <?php $title //= get_the_title(); ?>

                        <h5 class="custom-card-title"><?php// echo $title ?></h5>

                        <?php $title //= (str_replace(' ', '-', strtolower($title))); ?>

                        <p class="excerpt" >
                          <?php //the_excerpt(); ?>
                        </p>

                        <a style="color:blue;" href="<?php //echo $title ?>">View Project</a>

                      </div>

                    </div>


              </div>
                <?php //endwhile; ?>

              <?php //endif; ?> -->



            </div>
     <a class="d-lg-none btn btn-light btn-rounded footer-projects-button" href="<?php echo get_template_directory_uri() ?>/projects"><span class="text-of-button">View All Projects</span></a>

        </div>
      </div>

      <?php } ?>



     <!--  permanent call to action -->


     <div class="hero call-to-action-hero footer-hero">

       <div class="call-to-action-gradient"></div>

       <?php
       $image = get_field('image','option');
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
             <?php the_field('content','option') ?>
           </div>
         </div>
       </div>

     </div>


      <!-- third section  -->

      <div class="row footer-row" style="margin-right: 0; margin-left: 0;">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-3">
              <a href="/"><img class="staxo mb-4" src="<?php echo get_template_directory_uri() ?>/assets/images/STAXO.svg">
                <!-- <h3 class="mb-4">STAXO</h3> -->
              </a>
              <h5 class="mb-0">The Digital Business.</h5>
              <hr class="d-lg-none digital-business">
            </div>
            <div class="col-12 col-lg-4 order-2 order-lg-2 address-section">
              <h5 class="address">Staxo Group Limited, Oriel House, 26 The Quadrant, Richmond, London, TW9 1DL</h5>
              <h5 class="tel tel-footer"><a href="tel:020 8017 2318">020 8017 2318</a></h5>
            </div>
            <div class="col-12 col-lg-2 order-lg-2 links-section-about">
              <div class="row">
                <h5 class="about-us-footer col-12 col-lg-12"><a href="<?php echo get_site_url(); ?>/about-us">About Us</a></h5>
                <h5 class="projects col-12 col-lg-12"><a href="<?php echo get_site_url(); ?>/projects">Projects</a></h5>
                <!-- <h5 class="insights">Insights</h5> -->
                <h5 class="contact-us col-6 col-lg-12"><a href="<?php echo get_site_url(); ?>/contact">Contact Us</a></h5>
              </div>
            </div>
            <div class="col-12 d-lg-none">
              <hr class="d-lg-none mt-0 mb-0">
            </div>
            <div class="col-12 col-lg-3 order-4 ">
              <hr class="d-lg-none mt-0 mb-0">
              <h5 class="privacy-policy"><a href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a></h5>
              <h5 class="cookies-policy"><a href="<?php echo get_site_url(); ?>/cookies-policy">Cookies Policy</a></h5>
              <h5 class=""></h5>
              <h5 class="copyright">Staxo Group Limited <?php echo date('Y'); ?></h5>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </div>
  <?php wp_footer(); ?>
  </body>
</html>




<!--       <div class="widgets">
        <?php //dynamic_sidebar('footer'); ?>
      </div>

      <p><?php //bloginfo('name'); ?> &copy; <?php //echo date('Y'); ?></p>

      <a href="https://staxoweb.com" target="_blank">
        SITE BY STAXO
      </a> -->
