<?php
get_header();

$author     = get_queried_object();
$loop_title = 'Автор: ' . esc_html( $author->display_name );
$loop_intro = ! empty( $author->description ) ? esc_html( $author->description ) : '';

include locate_template( 'template-parts/loop-archive.php' );

get_footer();
