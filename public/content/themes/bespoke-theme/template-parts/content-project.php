<article id="post-<?php the_ID();?>" <?php post_class(); ?>>

<header class="entry-header">

  <p>content-project</p>


  <?php the_title( '<h2><a href="'. get_the_permalink() . '">', '</a></h2>'); ?>

  <?php the_post_thumbnail('full'); ?>

</header>

  <div class="entry-content">

    <p>HELLO</p>
      <?php the_content(); ?>

  </div>


</article>
