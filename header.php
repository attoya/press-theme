<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Attoya Press Template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="/manifest.json" />
  <link rel="apple-touch-icon" href="/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/icon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="512x512" href="/icon/android-icon-512x512.png">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="preloader">
  <div class="spinner">
    <div class="pre-bounce1"></div>
    <div class="pre-bounce2"></div>
  </div>
</div>
<div id="page" class="hfeed site">
  <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'attoya' ); ?></a>

  <header id="masthead" class="site-header" role="banner">
    <div class="header-wrap">
      <div class="container">
        <div class="row">

          <div class="brand col-md-2 col-sm-8 col-xs-12">
            <?php if ( get_theme_mod('site_logo') ) : ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><img class="site-logo" src="<?php echo esc_url(get_theme_mod('site_logo')); ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <?php else : ?>
              <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php endif; ?>
          </div>

          <div class="menu col-md-10 col-sm-4 col-xs-12">
            <div class="btn-menu"></div>
            <nav id="mainnav" class="mainnav" role="navigation">
              <?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => 'attoya_menu_fallback' ) ); ?>
            </nav><!-- #site-navigation -->
          </div>

        </div>
      </div>
    </div>
  </header><!-- #masthead -->

  <?php attoya_slider_template(); ?>

  <div class="header-image">
    <?php attoya_header_overlay(); ?>
    <img class="header-inner" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>">
  </div>

  <div id="content" class="page-wrap">
    <div class="container content-wrapper">
      <div class="row">