<?php

/**
 * Slider template
 * @package Attoya Press Template
 */





// Slider template
if ( ! function_exists( 'attoya_slider_template' ) ) :
function attoya_slider_template() {

  if ( (get_theme_mod('front_header_type','slider') == 'slider' && is_front_page()) || (get_theme_mod('site_header_type') == 'slider' && !is_front_page()) ) {

  // Get the slider options
  $speed      = get_theme_mod('slider_speed', '4000');
  $text_slide = get_theme_mod('textslider_slide', 0);

  // Slider text
  $slider_title_1    = get_theme_mod('slider_title_1', 'Welcome to Attoya Press');
  $slider_title_2    = get_theme_mod('slider_title_2', 'Ready to begin your journey?');
  $slider_title_3    = get_theme_mod('slider_title_3');
  $slider_title_4    = get_theme_mod('slider_title_4');
  $slider_title_5    = get_theme_mod('slider_title_5');
  $slider_subtitle_1 = get_theme_mod('slider_subtitle_1', 'Feel free to look around');
  $slider_subtitle_2 = get_theme_mod('slider_subtitle_2', 'Click the button below');
  $slider_subtitle_3 = get_theme_mod('slider_subtitle_3');
  $slider_subtitle_4 = get_theme_mod('slider_subtitle_4');
  $slider_subtitle_5 = get_theme_mod('slider_subtitle_5');

  ?>

  <div id="slideshow" class="header-slider" data-speed="<?php echo esc_attr($speed); ?>">
    <div class="slides-container">
      <?php


        if ( get_theme_mod('slider_image_1', get_template_directory_uri() . '/images/slide-1.png') ) {

          echo '<div class="slide-item" style="background-image:url(' . esc_url(get_theme_mod('slider_image_1', get_template_directory_uri() . '/images/1.jpg')) . ');">';
          ?>
            <div class="slide-inner">
              <div class="contain animated fadeInRightBig text-slider">
                <h2 class="maintitle"><?php echo esc_html($slider_title_1); ?></h2>
                <p class="subtitle"><?php echo esc_html($slider_subtitle_1); ?></p>
              </div>
              <?php attoya_slider_button(); ?>
            </div>
          <?php
          echo '</div>';

        }


        if ( get_theme_mod('slider_image_2', get_template_directory_uri() . '/images/slide-2.jpg') ) {

          echo '<div class="slide-item" style="background-image:url(' . esc_url(get_theme_mod('slider_image_2', get_template_directory_uri() . '/images/2.jpg')) . ');">';
          ?>
            <div class="slide-inner">
              <div class="contain animated fadeInRightBig text-slider">
                <h2 class="maintitle"><?php echo esc_html($slider_title_2); ?></h2>
                <p class="subtitle"><?php echo esc_html($slider_subtitle_2); ?></p>
              </div>
              <?php attoya_slider_button(); ?>
            </div>
          <?php
          echo '</div>';

        }


        if ( get_theme_mod('slider_image_3') ) {

          echo '<div class="slide-item" style="background-image:url(' . esc_url(get_theme_mod('slider_image_3')) . ');">';
          ?>
            <div class="slide-inner">
              <div class="contain animated fadeInRightBig text-slider">
                <h2 class="maintitle"><?php echo esc_html($slider_title_3); ?></h2>
                <p class="subtitle"><?php echo esc_html($slider_subtitle_3); ?></p>
              </div>
              <?php attoya_slider_button(); ?>
            </div>
          <?php
          echo '</div>';

        }


        if ( get_theme_mod('slider_image_4') ) {

          echo '<div class="slide-item" style="background-image:url(' . esc_url(get_theme_mod('slider_image_4')) . ');">';
          ?>
            <div class="slide-inner">
              <div class="contain animated fadeInRightBig text-slider">
                <h2 class="maintitle"><?php echo esc_html($slider_title_4); ?></h2>
                <p class="subtitle"><?php echo esc_html($slider_subtitle_4); ?></p>
              </div>
              <?php attoya_slider_button(); ?>
            </div>
          <?php
          echo '</div>';

        }


        if ( get_theme_mod('slider_image_5') ) {

          echo '<div class="slide-item" style="background-image:url(' . esc_url(get_theme_mod('slider_image_5')) . ');">';
          ?>
            <div class="slide-inner">
              <div class="contain animated fadeInRightBig text-slider">
                <h2 class="maintitle"><?php echo esc_html($slider_title_5); ?></h2>
                <p class="subtitle"><?php echo esc_html($slider_subtitle_5); ?></p>
              </div>
              <?php attoya_slider_button(); ?>
            </div>
          <?php
          echo '</div>';

        }


      ?>
    </div>
  </div>

  <?php if ( $text_slide ) : ?>
    <?php echo attoya_stop_text(); ?>
  <?php endif; ?>

  <?php

  }

}
endif;



function attoya_slider_button() {

  $slider_button     = get_theme_mod('slider_button_text', 'Click to begin');
  $slider_button_url = get_theme_mod('slider_button_url',  '#primary');

  if ($slider_button) {
    echo '<a href="' . esc_url($slider_button_url) . '" class="roll-button button-slider">' . esc_html($slider_button) . '</a>';
  }

}



function attoya_stop_text() {

  $slider_title_1    = get_theme_mod('slider_title_1',   'Welcome to Attoya Press');
  $slider_subtitle_1 = get_theme_mod('slider_subtitle_1','Feel free to look around');

  ?>
  <div class="slide-inner text-slider-stopped">
    <div class="contain text-slider">
      <h2 class="maintitle"><?php echo esc_html($slider_title_1); ?></h2>
      <p class="subtitle"><?php echo esc_html($slider_subtitle_1); ?></p>
    </div>
    <?php attoya_slider_button(); ?>
  </div>
  <?php

}


