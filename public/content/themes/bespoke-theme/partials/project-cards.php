    <?php if( have_posts() ): ?>

        <?php while( have_posts() ): the_post(); ?>

      <div class="col-lg-4 col-12 py-4">

            <?php get_template_part( 'template-parts' , 'project', get_post_format()); ?>


              <div class="card" data-query="<?php esc_attr_e(json_encode(['cat' => $terms[$count]->term_id])) ?>">

                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full',['class'=>'image-class']); ?></a>

                <div class="card-body d-flex flex-column">

                  <?php $title = get_the_title(); ?>

                  <h5 class="custom-card-title"><?php echo $title ?></h5>

                  <div class="d-flex project-card-buttons">
                  <?php

                  $theterms = the_terms( $post->ID, 'service','','');

                  if($theterms) {
                  var_dump ($theterms);
                  }


                  ?>
                  </div>




                  <?php $title = (str_replace(' ', '-', strtolower($title))); ?>

                  <p class="excerpt" >
                    <?php the_excerpt(); ?>
                  </p>


                </div>

                <div class="project-view-button">
                  <a href="<?php echo $title ?>">View Project</a>
                </div>

              </div>


        </div>
          <?php endwhile; ?>

        <?php endif; ?>



        <?php if(get_next_posts_link()): ?>

        <div class="text-center col-lg-12 ajax-load-more mb-2">
          <a href="javascript:void(0)" data-query="<?php esc_attr_e(json_encode(['paged' => max( 1, get_query_var('paged') ) + 1])) ?>" class="text-center column-block-blue-button first-button mr-4 btn staxo-gradient btn-rounded"><span class="text-white">LOAD MORE</span></a>
        </div>

        <?php endif; ?>
