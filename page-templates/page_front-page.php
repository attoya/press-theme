<?php

// Template Name: Front Page

get_header();

?>
<div id="primary" class="fp-content-area">
  <main id="main" class="site-main" role="main">

    <div class="entry-content">
      <?php

        while ( have_posts() ) : the_post();
          the_content();
        endwhile;

      ?>
    </div>

  </main>
</div>
<?php

get_footer();

