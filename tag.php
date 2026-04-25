<?php
get_header();

$loop_title = single_tag_title( '', false );
$loop_intro = tag_description();

include locate_template( 'template-parts/loop-archive.php' );

get_footer();
