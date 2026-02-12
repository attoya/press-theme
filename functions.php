<?php
/**
 * Attoya functions and definitions
 *
 * @package Attoya Press Template
 */

add_filter('jpeg_quality', function($arg){return 100;});

// Disable as auto updates always break wordpress
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );


/**
 * Remove all notice actions
 */
function disable_all_admin_notices() {
  remove_all_actions('admin_notices');
  remove_all_actions('all_admin_notices');
  remove_all_actions('user_admin_notices');
  remove_all_actions('network_admin_notices');
}
add_action('admin_init', 'disable_all_admin_notices', 1);

/**
* Add CSS to hide notice elements
*/
function hide_admin_notices_css() {
  ?>
  <style>
      .notice,
      .notice-error,
      .notice-warning,
      .notice-success,
      .notice-info,
      .updated,
      .error,
      .update-nag {
        display: none !important;
      }
  </style>
  <?php
}
add_action('admin_head', 'hide_admin_notices_css', 1);

/**
* Disable notice output
*/
function return_false() {
  return false;
}
add_action('admin_notices', 'return_false', 1);
add_action('all_admin_notices', 'return_false', 1);
add_action('user_admin_notices', 'return_false', 1);
add_action('network_admin_notices', 'return_false', 1);

/**
* Remove update nags
*/
function remove_core_update_notices() {
  remove_action('admin_notices', 'update_nag', 3);
  remove_action('admin_notices', 'maintenance_nag', 10);
}
add_action('admin_init', 'remove_core_update_notices', 1);



@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


# Hide admin bar on page display as it messes up CSS layout
add_filter('show_admin_bar', '__return_false');

# Stop WP writing .htaccess file
add_filter('flush_rewrite_rules_hard','__return_false');


if ( ! function_exists( 'attoya_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function attoya_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on Attoya, use a find and replace
   * to change 'attoya' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'attoya', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  // Content width
  global $content_width;
  if ( ! isset( $content_width ) ) {
    $content_width = 1170; /* pixels */
  }

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  add_image_size('attoya-large-thumb', 830);
  add_image_size('attoya-medium-thumb', 550, 400, true);
  add_image_size('attoya-small-thumb', 230);
  add_image_size('attoya-service-thumb', 350);
  add_image_size('attoya-mas-thumb', 480);

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'header' => __( 'Header Menu', 'attoya' ),
    'social' => __( 'Social Menu', 'attoya' ),
    'footer' => __( 'Footer Menu', 'attoya' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'attoya_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // attoya_setup
add_action( 'after_setup_theme', 'attoya_setup' );



/**
 * Register widget area.
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function attoya_widgets_init() {

  register_sidebar( array(
    'name'          => __( 'Sidebar', 'attoya' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  // Footer widget areas
  $widget_areas = get_theme_mod('footer_widget_areas', '3');
  for ($i=1; $i<=$widget_areas; $i++) {
    register_sidebar( array(
      'name'          => __( 'Footer ', 'attoya' ) . $i,
      'id'            => 'footer-' . $i,
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );
  }


}
add_action( 'widgets_init', 'attoya_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function attoya_scripts() {

  if ( get_theme_mod('body_font_name') !='' ) {
    wp_enqueue_style( 'attoya-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
  } else {
    wp_enqueue_style( 'attoya-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600');
  }

  if ( get_theme_mod('headings_font_name') !='' ) {
    wp_enqueue_style( 'attoya-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
  } else {
    wp_enqueue_style( 'attoya-headings-fonts', '//fonts.googleapis.com/css?family=Raleway:400,500,600');
  }

  wp_enqueue_style( 'attoya-style', get_stylesheet_uri() );

  wp_enqueue_style( 'attoya-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

  wp_enqueue_style( 'attoya-custom', get_template_directory_uri() . '/style-custom.css', array( 'attoya-style' ) );

  wp_enqueue_script( 'attoya-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

  wp_enqueue_script( 'attoya-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'', true );

  wp_enqueue_script( 'attoya-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {
    wp_enqueue_script( 'attoya-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('masonry'),'', true );
  }

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'attoya_scripts' );




/**
 * Enqueue Bootstrap
 */
function attoya_enqueue_bootstrap() {
  wp_enqueue_style( 'attoya-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'attoya_enqueue_bootstrap', 9 );




/**
 * Change the excerpt length
 */
function attoya_excerpt_length( $length ) {

  $excerpt = get_theme_mod('exc_lenght', '55');
  return $excerpt;

}
add_filter( 'excerpt_length', 'attoya_excerpt_length', 999 );




/**
 * Blog layout
 */
function attoya_blog_layout() {

  $layout = get_theme_mod('blog_layout','classic');
  return $layout;

}




/**
 * Menu fallback
 */
function attoya_menu_fallback() {

  echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'attoya' ) . '</a>';

}




/**
 * Header image overlay
 */
function attoya_header_overlay() {

  $overlay = get_theme_mod( 'hide_overlay', 0);
  if ( !$overlay ) {
    echo '<div class="overlay"></div>';
  }

}




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';

/**
 * Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Woocommerce basic integration
 */
// require get_template_directory() . '/inc/woocommerce.php';

