<?php get_header(); ?>

<!-- hero -->

<div class="row contact-hero" style="margin-right: 0; margin-left: 0;">

  <div class="background-image-project">
     <div class="overlay project"></div>

  </div>


  <div class="container project-container">

    <div class="row">

      <div class="col-12 col-lg-6 d-flex flex-column justify-content-center text-side">

        <?php the_field('project_description', 'option'); ?>

      </div>

      <div class="col-12 col-lg-6 pr-0 archive-image-side">

        <?php
        $image = get_field('featured_project_image', 'option');
        if( !empty( $image ) ): ?>
            <img class="project-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>

      </div>

    </div>

  </div>

</div>



<!-- //hero ends here  -->


<div class="bg-white archive-project top-of-buttons-panel" >
  <div class="container project-archive-container">

    <div class="panel-of-buttons ajax-posts-load" data-ajax="<?php esc_attr_e(site_url('wp-admin/admin-ajax.php?action=ajax_projects')) ?>">

      <?php

     $terms = get_terms( array(
         'taxonomy' => 'service',
         'hide_empty' => false,
     ) );

     $tax = isset($terms[0]) ? $terms[0]->taxonomy : null;



      ?>
      <?php $count = -1; ?>

      <div class="d-flex buttons-for-projects">

        <?php foreach($terms as $term) { ?>

           <?php $count+=1; ?>

               <a data-query="<?php esc_attr_e(json_encode(['cat' => $term->slug])) ?>" class="mr-lg-4 btn staxo-gradient btn-rounded"><span class="button-text-archive"><?php echo ($term->name) ?></span></a>

           <?php  } ?>

        </div>




    <div class="row ajax-posts">

      <?php get_template_part('partials/project-cards'); ?>

      </div>


    </div>
  </div>
</div>

<!-- hero 2 goes here  -->

<?php get_footer(); ?>
