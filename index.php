<?php
/**
 * Home page (index)
 * @version 2.57
 */
get_header();

// Common WP_Query optimization flags
$base_args = [
    'post_status'            => 'publish',
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
];
?>

<div class="container">

    <!-- ── Sticky / breaking ─────────────────────────────────────── -->
    <?php
    $sticky = get_option( 'sticky_posts' );
    if ( ! empty( $sticky[0] ) ) {
        $q = new WP_Query( array_merge( $base_args, [
            'posts_per_page'      => 1,
            'ignore_sticky_posts' => 0,
            'post__in'            => $sticky,
        ] ) );
        while ( $q->have_posts() ) : $q->the_post(); ?>
            <div class="col-md-12 mr-auto text-center border bg-outline mb-3">
                <h3 class="m-3 fw-bold border-1">
                    <a href="<?php the_permalink(); ?>" class="text-info" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </h3>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    }
    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="row">

                <!-- ── Hero (1 post) ─────────────────────────────────── -->
                <?php
                $q = new WP_Query( array_merge( $base_args, [
                    'posts_per_page'      => 1,
                    'ignore_sticky_posts' => 1,
                ] ) );
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="col-md-8">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" width="800" height="450" alt="<?php the_title_attribute(); ?>">
                        </a>
                        <span class="d-inline-block mb-2 mt-3 text-success"><?php the_tags( '', ' &bull; ' ); ?></span>
                        <h3 class="mb-0 fw-bold">
                            <a href="<?php the_permalink(); ?>" class="text-dark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="card-text"><?php echo esc_html( time_ago() ); ?></p>

                        <ul class="list-group list-group-flush">
                        <?php
                        $tags = wp_get_post_tags( get_the_ID() );
                        if ( $tags ) {
                            $tag_ids = wp_list_pluck( $tags, 'term_id' );
                            $rel = new WP_Query( array_merge( $base_args, [
                                'tag__in'        => $tag_ids,
                                'post__not_in'   => [ get_the_ID() ],
                                'posts_per_page' => 1,
                            ] ) );
                            while ( $rel->have_posts() ) : $rel->the_post(); ?>
                                <li class="list-group-item">
                                    <span class="card-text">
                                        <?php echo esc_html( time_ago() ); ?> —
                                        <a href="<?php the_permalink(); ?>" class="text-dark fw-light" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </span>
                                </li>
                            <?php endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                        </ul>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>

                <!-- ── Two stacked (offset 1, posts 2) ─────────────────── -->
                <div class="col-md-4 mb-4">
                    <?php
                    $q = new WP_Query( array_merge( $base_args, [
                        'posts_per_page'      => 2,
                        'offset'              => 1,
                        'ignore_sticky_posts' => 1,
                    ] ) );
                    while ( $q->have_posts() ) : $q->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </a>
                        <span class="d-inline-block mb-2 mt-3 text-success"><?php the_tags( '', ' &bull; ' ); ?></span>
                        <h6 class="fw-bold">
                            <a href="<?php the_permalink(); ?>" class="text-dark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h6>
                        <p class="card-text"><?php echo esc_html( time_ago() ); ?></p>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- ── 3 cards (offset 3) ─────────────────────────────── -->
                <?php
                $q = new WP_Query( array_merge( $base_args, [
                    'posts_per_page'      => 3,
                    'offset'              => 3,
                    'ignore_sticky_posts' => 1,
                ] ) );
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100 border-1 rounded-0 shadow-sm">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top rounded-0" alt="<?php the_title_attribute(); ?>" width="800" height="450" loading="lazy">
                            </a>
                            <div class="card-body">
                                <span class="d-inline-block text-success"><?php the_tags( '', ' &bull; ' ); ?></span>
                                <h6 class="card-title my-1">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                                </h6>
                            </div>
                            <div class="card-footer border-0 bg-body">
                                <span class="card-text"><?php echo esc_html( time_ago() ); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>

            </div>
        </div>

        <!-- ── News sidebar ──────────────────────────────────────────── -->
        <div class="col-md-3">
            <div class="d-flex p-1 mb-3 text-bg-success fw-bold">
                <a href="/category/news/" class="text-white ms-3">НОВОСТИ</a>
            </div>
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 7,
                'category_name'  => 'news',
                'offset'         => 6,
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="text-dark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                <p class="card-text border-bottom"><?php echo esc_html( time_ago() ); ?></p>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>


<!-- ═══════════════ SOCIETY ═══════════════ -->
<main role="main" class="container">
    <h3 class="mt-3 mb-3"><a href="/category/society/" class="text-white"><span class="text-bg-success px-3">Люди и Общество</span></a></h3>
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 2,
                'category_name'  => 'society',
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid mb-2" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                </a>
                <h6 class="fw-bold">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                </h6>
                <p class="card-text"><?php echo esc_html( time_ago() ); ?></p>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="col-lg-6 col-md-8">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 1,
                'category_name'  => 'society',
                'offset'         => 2,
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="card-deck mb-3">
                    <div class="card rounded-0">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid img-card" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <div class="card-img-overlay h-100 d-flex flex-column justify-content-end text-white">
                            <h3 class="card-title shadow">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                <?php
                $tags = wp_get_post_tags( get_the_ID() );
                if ( $tags ) {
                    $tag_ids = wp_list_pluck( $tags, 'term_id' );
                    $rel = new WP_Query( array_merge( $base_args, [
                        'tag__in'        => $tag_ids,
                        'post__not_in'   => [ get_the_ID() ],
                        'posts_per_page' => 2,
                    ] ) );
                    while ( $rel->have_posts() ) : $rel->the_post(); ?>
                        <li class="list-group-item">
                            <a href="<?php the_permalink(); ?>" class="text-dark fw-light" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata();
                }
                ?>
                </ul>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="col-lg-3 col-md-12">
            <ul class="list-unstyled">
                <?php
                $q = new WP_Query( array_merge( $base_args, [
                    'posts_per_page' => 5,
                    'category_name'  => 'society',
                    'offset'         => 3,
                ] ) );
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="d-flex my-2">
                        <div class="flex-shrink-0">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" width="55" height="55" style="object-fit: cover;" loading="lazy">
                            </a>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark mt-2"><?php the_title(); ?></a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</main>


<!-- ═══════════════ TBILISI carousel (Swiper) ═══════════════ -->
<div class="container my-5">
    <a href="/tag/tbilisi/" class="text-white pt-3 mb-3">
        <h3 class="mt-5 mb-3"><span class="text-bg-success px-3">Тбилиси</span></h3>
    </a>
    <div class="swiper tag-carousel">
        <div class="swiper-wrapper">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 8,
                'tag'            => 'tbilisi',
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="swiper-slide">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" width="800" height="450" alt="<?php the_title_attribute(); ?>" class="img-fluid" loading="lazy">
                    </a>
                    <h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>


<!-- ═══════════════ POLITICS ═══════════════ -->
<div class="content bg-light border-bottom border-top py-3 my-3">
    <div class="container">
        <h3 class="mt-5 mb-3"><a href="/category/politics/" class="text-white"><span class="text-bg-success px-3">ПОЛИТИКА</span></a></h3>
        <div class="row">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 4,
                'category_name'  => 'politics',
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="col-lg-3 col-md-6 mb-3">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid img-card" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    </a>
                    <h5 class="mt-1 mb-3"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>


<!-- ── Ad ─────────────────────────────────────────────── -->
<div class="content">
    <div class="row mx-auto">
        <div class="col-12 my-1">
            <ins data-revive-zoneid="1" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
        </div>
    </div>
</div>


<!-- ═══════════════ MONEY ═══════════════ -->
<main role="main" class="container">
    <h3 class="mt-5 mb-3"><a href="/category/money/" class="text-white"><span class="text-bg-success px-3">ДЕНЬГИ</span></a></h3>
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 2,
                'category_name'  => 'money',
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid mb-2" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                </a>
                <h6 class="fw-bold">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                </h6>
                <p class="card-text mb-1"><?php echo esc_html( time_ago() ); ?></p>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="col-lg-6 col-md-8">
            <?php
            $q = new WP_Query( array_merge( $base_args, [
                'posts_per_page' => 1,
                'category_name'  => 'money',
                'offset'         => 2,
            ] ) );
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="card-deck mb-3">
                    <div class="card rounded-0">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid img-card" width="800" height="450" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <div class="card-img-overlay h-100 d-flex flex-column justify-content-end text-white">
                            <h3 class="card-title shadow">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                <?php
                $tags = wp_get_post_tags( get_the_ID() );
                if ( $tags ) {
                    $tag_ids = wp_list_pluck( $tags, 'term_id' );
                    $rel = new WP_Query( array_merge( $base_args, [
                        'tag__in'        => $tag_ids,
                        'post__not_in'   => [ get_the_ID() ],
                        'posts_per_page' => 2,
                    ] ) );
                    while ( $rel->have_posts() ) : $rel->the_post(); ?>
                        <li class="list-group-item">
                            <a href="<?php the_permalink(); ?>" class="text-dark fw-light" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata();
                }
                ?>
                </ul>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="col-lg-3 col-md-12 d-sm-none d-lg-block">
            <ul class="list-unstyled">
                <?php
                $q = new WP_Query( array_merge( $base_args, [
                    'posts_per_page' => 5,
                    'category_name'  => 'money',
                    'offset'         => 3,
                ] ) );
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="d-flex my-3">
                        <div class="flex-shrink-0">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" width="55" height="55" style="object-fit: cover;" loading="lazy">
                            </a>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark mt-2"><?php the_title(); ?></a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</main>


<!-- ═══════════════ OPINION (3 cards) ═══════════════ -->
<div class="container mt-5">
    <h3 class="mt-5 mb-3"><a href="/category/opinion/" class="text-white"><span class="text-bg-success px-3">МНЕНИЕ</span></a></h3>
    <div class="row">
        <?php
        $q = new WP_Query( array_merge( $base_args, [
            'posts_per_page' => 3,
            'category_name'  => 'opinion',
        ] ) );
        while ( $q->have_posts() ) : $q->the_post(); ?>
            <div class="col-md-4">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid mb-2" width="800" height="450" loading="lazy">
                </a>
                <h5 class="mt-1 mb-5">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                </h5>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>


<!-- ── Ad + Ukraine carousel ───────────────────────────── -->
<div class="container">
    <div class="row mx-auto">
        <div class="col-12 my-1">
            <ins data-revive-zoneid="1" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>

            <h3 class="text-center my-3"><span class="text-bg-danger px-3">Украина</span></h3>
            <div class="swiper ukraine-carousel container-fluid">
                <div class="swiper-wrapper">
                    <?php
                    $q = new WP_Query( array_merge( $base_args, [
                        'posts_per_page' => 7,
                        'tag'            => 'ukraine',
                    ] ) );
                    while ( $q->have_posts() ) : $q->the_post(); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" width="800" height="450" class="img-fluid" loading="lazy">
                            </a>
                            <h6 class="my-1 ps-2 fw-bold">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                            </h6>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
