<?php get_header(); ?>

<div class="row">

  <div class="container">
      <p>Hello</p>
    <?php

      if( have_posts() ):

        while( have_posts() ): the_post(); ?>

          <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

          <p><?php the_excerpt(); ?></p>

          <hr>

        <?php endwhile;

      endif;

      ?>
  </div>
</div>

<?php get_footer(); ?>
