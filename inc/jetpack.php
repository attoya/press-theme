<?php

/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 * @package Attoya Press Template
 */




/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function attoya_jetpack_setup() {
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'footer'    => 'page',
  ) );
}
add_action( 'after_setup_theme', 'attoya_jetpack_setup' );



