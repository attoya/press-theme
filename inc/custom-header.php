<?php

/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 * @package Attoya Press Template
 */




/**
 * Set up the WordPress core custom header feature.
 * @uses attoya_header_style()
 * @uses attoya_admin_header_style()
 * @uses attoya_admin_header_image()
 */
function attoya_custom_header_setup() {

  add_theme_support(
     'custom-header',
     apply_filters( 'attoya_custom_header_args', array(
      'default-image'          => get_template_directory_uri() . '/images/header.jpg',
      'default-text-color'     => '000000',
      'width'                  => 1920,
      'height'                 => 600,
      'flex-height'            => true,
      'wp-head-callback'       => 'attoya_header_style',
      'admin-head-callback'    => 'attoya_admin_header_style',
      'admin-preview-callback' => 'attoya_admin_header_image',
    ))
  );

}
add_action( 'after_setup_theme', 'attoya_custom_header_setup' );




/**
 * Styles the header image and text displayed on the blog
 * @see attoya_custom_header_setup().
 */
if ( ! function_exists( 'attoya_header_style' ) ) {
  function attoya_header_style() {

    if ( get_header_image() && ( get_theme_mod('front_header_type') == 'image' && is_front_page() || get_theme_mod('site_header_type', 'image') == 'image' && !is_front_page() ) ) {
      ?>
      <style type="text/css">
        .header-image {
          background-image: url(<?php echo get_header_image(); ?>);
          display: block;
        }
        @media only screen and (max-width: 1024px) {
          .header-inner {
            display: none;
          }
          .header-image {
            /* background-image: none; */
            /* height: auto !important; */
          }
        }
      </style>
      <?php
    }

  }
}




/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 * @see attoya_custom_header_setup().
 */
if ( ! function_exists( 'attoya_admin_header_style' ) ) {
  function attoya_admin_header_style() {

    ?>
    <style type="text/css">
      .appearance_page_custom-header #headimg {
        border: none;
      }
      #headimg h1,
      #desc { }
      #headimg h1 { }
      #headimg h1 a { }
      #desc { }
      #headimg img { }
    </style>
    <?php

  }
}




/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 * @see attoya_custom_header_setup().
 */
if ( ! function_exists( 'attoya_admin_header_image' ) ) {
  function attoya_admin_header_image() {

    $style = sprintf( ' style="color:#%s;"', get_header_textcolor() );

    ?>
    <div id="headimg">

      <h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      <div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
      <?php

      if ( get_header_image() ) {
        ?><img src="<?php header_image(); ?>" alt=""><?php
      }

      ?>
    </div>
    <?php

  }

}



