<?php
/**
 * Netgazeti theme functions
 * @version 2.57
 */

// ── Theme support ────────────────────────────────────────────────
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

// ── Disable Gutenberg ────────────────────────────────────────────
add_filter( 'use_block_editor_for_post', '__return_false' );

// ── PHP runtime tweaks ───────────────────────────────────────────
@ini_set( 'upload_max_filesize', '512K' );
@ini_set( 'post_max_size',       '1M'  );
@ini_set( 'max_execution_time',  '300' );

// ── Disable thumbnail generation (we use one 800×450 size) ───────
add_filter( 'intermediate_image_sizes', function( $sizes ) {
    return array_diff( $sizes, [ 'thumbnail', 'medium', 'medium_large', 'large', '1536x1536', '2048x2048' ] );
} );

// ── Post Views (atomic, race-condition-free) ─────────────────────
function setPostViews( $postID ) {
    global $wpdb;
    $key = 'post_views_count';

    $updated = $wpdb->query( $wpdb->prepare(
        "UPDATE {$wpdb->postmeta} SET meta_value = meta_value + 1 WHERE post_id = %d AND meta_key = %s",
        $postID, $key
    ) );

    if ( ! $updated ) {
        add_post_meta( $postID, $key, 1, true );
    }
}

function getPostViews( $postID ) {
    $count = get_post_meta( $postID, 'post_views_count', true );
    return $count === '' ? '0' : $count;
}

// ── Date helper: «25 Апреля, 2026» (capitalized month) ───────────
function format_post_date( $post_id = null ) {
    $date = date_i18n( 'j F, Y', get_the_time( 'U', $post_id ) );
    return mb_strtoupper( mb_substr( $date, 0, 1 ) ) . mb_substr( $date, 1 );
}

// ── Time-ago helper (used on home only) ──────────────────────────
function time_ago( $type = 'post' ) {
    $d = ( 'comment' === $type ) ? 'get_comment_time' : 'get_post_time';
    return human_time_diff( $d( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'назад' );
}

// ── Pagination markup (no <h2> wrapper) ──────────────────────────
add_filter( 'navigation_markup_template', function( $template ) {
    return '<nav class="nav %1$s justify-content-center" role="navigation"><div class="nav-link">%3$s</div></nav>';
} );

// ── Featured image in RSS feed ───────────────────────────────────
add_filter( 'the_content', function( $content ) {
    if ( is_feed() && has_post_thumbnail( get_the_ID() ) ) {
        $img = get_the_post_thumbnail( get_the_ID(), 'full', [ 'style' => 'float:right; margin:0 0 10px 10px;' ] );
        $content = $img . $content;
    }
    return $content;
} );
