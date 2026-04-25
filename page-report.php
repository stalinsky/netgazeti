<?php
/**
 * Template Name: Editorial Report
 * Standalone report page (no header/footer, intentional).
 */

$year  = isset( $_GET['year'] )  ? max( 2010, min( 2100, (int) $_GET['year'] ) )  : (int) date( 'Y' );
$month = isset( $_GET['month'] ) ? max( 1,    min( 12,   (int) $_GET['month'] ) ) : (int) date( 'n' );

$months_ru = [ 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря' ];
$month_label = $months_ru[ $month - 1 ];
?>
<h1><?php echo esc_html( $month_label . ', ' . $year ); ?></h1>

<h3>სტატისტიკა თვეების მიხედვით (<?php echo esc_html( $year ); ?>)</h3>
<?php
global $wpdb;
$results = $wpdb->get_results( $wpdb->prepare(
    "SELECT MONTH(post_date) AS month, COUNT(ID) AS post_count
     FROM {$wpdb->posts}
     WHERE post_type = 'post'
       AND post_status = 'publish'
       AND YEAR(post_date) = %d
     GROUP BY MONTH(post_date)
     ORDER BY MONTH(post_date) DESC",
    $year
) );

foreach ( $results as $row ) {
    echo 'თვე ' . (int) $row->month . ': ' . (int) $row->post_count . ' სტატია<br>';
}
?>
<hr>
<table border="1" cellspacing="0" cellpadding="3">
    <tr style="background-color: #ccc">
        <th>თარიღი</th>
        <th>სათაური</th>
        <th>სტატიის URL</th>
        <th>ავტორი</th>
    </tr>
<?php
$q = new WP_Query( [
    'posts_per_page'         => 4000,
    'monthnum'               => $month,
    'year'                   => $year,
    'post_status'            => 'publish',
    'order'                  => 'ASC',
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
] );
while ( $q->have_posts() ) : $q->the_post(); ?>
    <tr>
        <td><small><?php echo esc_html( format_post_date() ); ?></small></td>
        <td><?php the_title(); ?></td>
        <td><a href="<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><?php the_permalink(); ?></a></td>
        <td><?php the_author_posts_link(); ?></td>
    </tr>
<?php endwhile; wp_reset_postdata(); ?>
</table>
