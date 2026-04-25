<?php
/**
 * Template Name: Google News Sitemap
 * Standalone XML, last 2 days only (Google News spec).
 */
header( 'Content-Type: application/xml; charset=utf-8' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
<?php
$q = new WP_Query( [
    'posts_per_page'         => 1000,
    'date_query'             => [ [ 'after' => '2 days ago' ] ],
    'post_status'            => 'publish',
    'order'                  => 'DESC',
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
] );
while ( $q->have_posts() ) : $q->the_post(); ?>
    <url>
        <loc><?php the_permalink(); ?></loc>
        <news:news>
            <news:publication>
                <news:name>Netgazeti на русском</news:name>
                <news:language>ru</news:language>
            </news:publication>
            <news:publication_date><?php echo esc_html( get_the_date( 'c' ) ); ?></news:publication_date>
            <news:title><?php echo esc_html( get_the_title() ); ?></news:title>
        </news:news>
    </url>
<?php endwhile; wp_reset_postdata(); ?>
</urlset>
