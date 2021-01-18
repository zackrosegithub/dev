<?php get_header(); ?>

<div class="row">

  <div class="container">
    <form class="form-group form-inline" action="/">
      <input type="text" value="<?php esc_attr_e( get_search_query() ) ?>" name="s" class="form-control" placeholder="Search...">
      <input type="submit" value="Search" class="btn btn-primary">
    </form>

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
