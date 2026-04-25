<?php
get_header();

$loop_title = wp_get_document_title();

if ( is_year() ) {
    $loop_title = single_year_title( '', false );
} elseif ( is_month() ) {
    $loop_title = single_month_title( ' ', false );
} elseif ( is_day() ) {
    $loop_title = get_the_date();
}

include locate_template( 'template-parts/loop-archive.php' );

get_footer();
