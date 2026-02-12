<?php

/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package Attoya Press Template
 */

?>
      </div>
    </div>
  </div><!-- #content -->

  <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
    <?php get_sidebar('footer'); ?>
  <?php endif; ?>

  <a class="go-top"><i class="fa fa-angle-up"></i></a>

  <footer class="site-footer">
    <div class="links">

      <div class="copyright">
        &copy; <?php echo date("Y"); ?> <?php /* Site Title */ echo get_bloginfo( 'name' ); ?>
      </div>

      <div class="social">
        <?php wp_nav_menu( array( 'theme_location' => 'social', 'fallback_cb' => 'attoya_menu_fallback' ) ); ?>
      </div>

      <div class="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'footer', 'fallback_cb' => 'attoya_menu_fallback' ) ); ?>
      </div>

    </div>
    <div class="designer">

      <a href="https://www.attoya.com" target="_blank">Designed by Attoya</a>

    </div>
  </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
