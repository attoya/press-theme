<?php
/**
 * The template for displaying all single posts.
 * @package Attoya Press Template
 */

get_header();

if (get_theme_mod('fullwidth_single')) { //Check if the post needs to be full width
  $fullwidth = 'fullwidth';
} else {
  $fullwidth = '';
}

?>
<div id="primary" class="content-area col-md-9 <?php echo $fullwidth; ?>">
  <main id="main" class="post-wrap" role="main">
    <?php

      while ( have_posts() ) : the_post();

        get_template_part( 'content', 'single' );
        attoya_post_navigation();

        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }

      endwhile; // end of the loop.

    ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php

if ( get_theme_mod('fullwidth_single', 0) != 1 ) {
  get_sidebar();
}

get_footer();
