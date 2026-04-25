<?php
/**
 * Template Name: Sitemap (yearly XML)
 */
header( 'Content-Type: application/xml; charset=utf-8' );

$year = isset( $_GET['year'] ) ? max( 2010, min( 2100, (int) $_GET['year'] ) ) : (int) date( 'Y' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
<?php
$q = new WP_Query( [
    'posts_per_page'         => 50000,
    'year'                   => $year,
    'post_status'            => 'publish',
    'order'                  => 'DESC',
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
] );
while ( $q->have_posts() ) : $q->the_post(); ?>
    <url>
        <loc><?php the_permalink(); ?></loc>
        <lastmod><?php the_time( 'Y-m-d' ); ?></lastmod>
    </url>
<?php endwhile; wp_reset_postdata(); ?>
</urlset>
