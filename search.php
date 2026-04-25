<?php
get_header();

$query_str = get_search_query();
$found     = (int) $GLOBALS['wp_query']->found_posts;

$loop_title = 'Поиск: ' . $query_str;
$loop_intro = sprintf(
    'Найдено упоминаний: <strong>%d</strong>',
    $found
);

include locate_template( 'template-parts/loop-archive.php' );

if ( ! have_posts() ) : ?>
    <div class="container pb-5">
        <p class="text-muted">Может изменим запрос к поисковику?</p>
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="d-flex" role="search">
            <input type="search" name="s" class="form-control me-2" placeholder="Найти..." value="<?php echo esc_attr( $query_str ); ?>">
            <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
        </form>
    </div>
<?php endif;

get_footer();
