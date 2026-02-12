<?php

// Template Name: Full width

get_header();

?>
<style type="text/css">
  .page-wrap {
    padding: 20px 0 40px !important;
  }
</style>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php

      while ( have_posts() ) : the_post();

        get_template_part( 'content', 'page' );

        if ( comments_open() || '0' != get_comments_number() ) :
          comments_template();
        endif;

      endwhile;

    ?>
  </main>
</div>

<?php

get_footer();

