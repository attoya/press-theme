<?php
/**
 * @package Attoya Press Template
 */
?>

<article id="post post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php


  if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) {
    ?>
      <div class="entry-thumb">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('attoya-large-thumb'); ?></a>
      </div>
    <?php
  }


  ?>
  <header class="entry-header">
    <?php

    the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

    if ( 'post' == get_post_type() && get_theme_mod('hide_meta_index') != 1 ) {
      ?>
      <div class="meta-post">
        <?php attoya_posted_on(); ?>
      </div><!-- .entry-meta -->
      <?php
    }

    ?>
  </header><!-- .entry-header -->
  <div class="entry-post">
    <?php


      if ( (get_theme_mod('full_content_home') == 1 && is_home() ) || (get_theme_mod('full_content_archives') == 1 && is_archive() ) ) {
        the_content();
      }
      else {
        the_excerpt();
      }

      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'attoya' ),
        'after'  => '</div>',
      ) );


    ?>
  </div><!-- .entry-post -->
  <footer class="entry-footer">
    <?php


      attoya_entry_footer();


    ?>
  </footer><!-- .entry-footer -->

</article><!-- #post-## -->