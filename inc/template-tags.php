<?php

/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * @package Attoya Press Template
 */




/**
 * Display navigation to next/previous set of posts when applicable.
 */
if ( ! function_exists( 'the_posts_navigation' ) ) :
function the_posts_navigation() {

  // Don't print empty markup if there's only one page.
  if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
  }
  ?>
  <nav class="navigation posts-navigation" role="navigation">
    <h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'attoya' ); ?></h2>
    <div class="nav-links clearfix">

      <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'attoya' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'attoya' ) ); ?></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php

}
endif;



if ( ! function_exists( 'attoya_post_navigation' ) ) :
function attoya_post_navigation() {

  // Don't print empty markup if there's nowhere to navigate.
  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );

  if ( ! $next && ! $previous ) {
    return;
  }

  ?>
  <nav class="navigation post-navigation" role="navigation">
    <h2 class="screen-reader-text"><?php _e( 'Post navigation', 'attoya' ); ?></h2>
    <div class="nav-links clearfix">
      <?php
        previous_post_link( '<div class="nav-previous"><i class="fa fa-long-arrow-left"></i> %link</div>', '%title' );
        next_post_link( '<div class="nav-next">%link <i class="fa fa-long-arrow-right"></i></div>', '%title' );
      ?>
    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php

}
endif;




/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'attoya_posted_on' ) ) :
function attoya_posted_on() {

  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    _x( 'Posted on %s', 'post date', 'attoya' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  $byline = sprintf(
    _x( '%s', 'post author', 'attoya' ),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  );

  echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

  if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    comments_popup_link( __( 'Leave a comment', 'attoya' ), __( '1 Comment', 'attoya' ), __( '% Comments', 'attoya' ) );
    echo '</span>';
  }

  $categories_list = get_the_category_list( __( ', ', 'attoya' ) );
  if ( $categories_list && attoya_categorized_blog() ) {
    printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'attoya' ) . '</span>', $categories_list );
  }

}
endif;




/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'attoya_entry_footer' ) ) :
function attoya_entry_footer() {

  // Hide category and tag text for pages.
  if ( 'post' == get_post_type() ) {
    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', __( ', ', 'attoya' ) );
    if ( $tags_list && is_single() ) {
      printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . __( ' %1$s', 'attoya' ) . '</span>', $tags_list );
    }
  }

  edit_post_link( __( 'Edit', 'attoya' ), '<span class="edit-link">', '</span>' );

}
endif;




/**
 * Shim for `the_archive_title()`.
 * Display the archive title based on the queried object.
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
if ( ! function_exists( 'the_archive_title' ) ) :
function the_archive_title( $before = '', $after = '' ) {

  if ( is_category() ) {
    $title = sprintf( __( 'Category: %s', 'attoya' ), single_cat_title( '', false ) );
  } elseif ( is_tag() ) {
    $title = sprintf( __( 'Tag: %s', 'attoya' ), single_tag_title( '', false ) );
  } elseif ( is_author() ) {
    $title = sprintf( __( 'Author: %s', 'attoya' ), '<span class="vcard">' . get_the_author() . '</span>' );
  } elseif ( is_year() ) {
    $title = sprintf( __( 'Year: %s', 'attoya' ), get_the_date( _x( 'Y', 'yearly archives date format', 'attoya' ) ) );
  } elseif ( is_month() ) {
    $title = sprintf( __( 'Month: %s', 'attoya' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'attoya' ) ) );
  } elseif ( is_day() ) {
    $title = sprintf( __( 'Day: %s', 'attoya' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'attoya' ) ) );
  } elseif ( is_tax( 'post_format' ) ) {

    if ( is_tax( 'post_format', 'post-format-aside' ) ) {
      $title = _x( 'Asides', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
      $title = _x( 'Galleries', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
      $title = _x( 'Images', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
      $title = _x( 'Videos', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
      $title = _x( 'Quotes', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
      $title = _x( 'Links', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
      $title = _x( 'Statuses', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
      $title = _x( 'Audio', 'post format archive title', 'attoya' );
    } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
      $title = _x( 'Chats', 'post format archive title', 'attoya' );
    }

  } elseif ( is_post_type_archive() ) {
    $title = sprintf( __( 'Archives: %s', 'attoya' ), post_type_archive_title( '', false ) );
  } elseif ( is_tax() ) {
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
    $title = sprintf( __( '%1$s: %2$s', 'attoya' ), $tax->labels->singular_name, single_term_title( '', false ) );
  } else {
    $title = __( 'Archives', 'attoya' );
  }

  /**
   * Filter the archive title.
   *
   * @param string $title Archive title to be displayed.
   */
  $title = apply_filters( 'get_the_archive_title', $title );

  if ( ! empty( $title ) ) {
    echo $before . $title . $after;
  }

}
endif;




/**
 * Shim for `the_archive_description()`.
 * Display category, tag, or term description.
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
if ( ! function_exists( 'the_archive_description' ) ) :
function the_archive_description( $before = '', $after = '' ) {

  $description = apply_filters( 'get_the_archive_description', term_description() );

  if ( ! empty( $description ) ) {
    /**
     * Filter the archive description.
     *
     * @see term_description()
     *
     * @param string $description Archive description to be displayed.
     */
    echo $before . $description . $after;
  }

}
endif;




/**
 * Returns true if a blog has more than 1 category.
 * @return bool
 */
function attoya_categorized_blog() {

  if ( false === ( $all_the_cool_cats = get_transient( 'attoya_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,

      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'attoya_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so attoya_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so attoya_categorized_blog should return false.
    return false;
  }

}




/**
 * Flush out the transients used in attoya_categorized_blog.
 */
function attoya_category_transient_flusher() {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  // Like, beat it. Dig?
  delete_transient( 'attoya_categories' );

}
add_action( 'edit_category', 'attoya_category_transient_flusher' );
add_action( 'save_post',     'attoya_category_transient_flusher' );
