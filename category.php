<?php
get_header();

$loop_title = single_cat_title( '', false );
$loop_intro = category_description();

include locate_template( 'template-parts/loop-archive.php' );

get_footer();
