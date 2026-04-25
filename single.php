<?php get_header(); ?>

<div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    setPostViews( get_the_ID() );
?>

    <span class="d-inline-block mb-3 mt-3 text-success">
        <?php the_category( ', ' ); ?> &bull; <?php the_tags( '', ' &bull; ' ); ?>
    </span>

    <h1><?php the_title(); ?></h1>

    <span class="d-inline-block mb-3 mt-3">
        <?php echo esc_html( format_post_date() ); ?> &bull;
        <?php the_author_posts_link(); ?> &bull;
        <i class="bi bi-eye text-success" aria-hidden="true"></i>
        <?php echo esc_html( getPostViews( get_the_ID() ) ); ?>
    </span>

    <div class="row mx-0 px-0">
        <div class="col-lg-8 col-md-10 mx-0 px-0">

            <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid mb-3 mx-0 px-0" width="800" height="450" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-featured-image.png" class="img-fluid mb-3" width="800" height="450" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>

            <div class="border border-danger bg-light text-uppercase p-3 my-3">
                <a href="https://ru.netgazeti.ge/59898/" target="_blank" rel="noopener noreferrer">
                    «Грузинская мечта» миллиардера Б. Иванишвили вновь намерена принять антиевропейский, российский закон, вызвавший гнев общества в 2023 году.<br>
                    <b>После волны протестов «Мечта» пообещала никогда не возвращаться к этому закону.</b><br>
                    В РФ аналогичный закон укрепил фундамент репрессивного путинского режима, уничтожив все демократические институты.
                </a>
            </div>

            <!-- ShareThis -->
            <div class="sharethis-inline-share-buttons my-3"></div>

            <!-- Mobile ad -->
            <div class="d-md-none d-sm-block text-center my-3">
                <ins data-revive-zoneid="32" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
            </div>

            <article><?php the_content(); ?></article>

            <p class="fw-lighter text-end small">
                <a href="/privacy-policy/" target="_blank" rel="noopener noreferrer" class="text-muted">Правила перепечатки</a>
            </p>

            <!-- Share buttons -->
            <div class="fs-4 text-center">
                <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/share?url=<?php echo urlencode( get_permalink() ); ?>&amp;text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="bi bi-twitter-x mx-4"></i></a>
                <a href="https://connect.ok.ru/offer?url=<?php echo urlencode( get_permalink() ); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;imageUrl=<?php echo urlencode( get_the_post_thumbnail_url() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Одноклассники"><i class="bi bi-person-circle"></i></a>
                <a href="https://vk.com/share.php?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="VK"><i class="bi bi-chat-square-text mx-4"></i></a>
                <a href="https://telegram.me/share/url?url=<?php echo urlencode( get_permalink() ); ?>&amp;text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><i class="bi bi-telegram"></i></a>
            </div>

            <hr>

            <!-- Desktop ad -->
            <div class="d-none d-md-block text-center my-3">
                <ins data-revive-zoneid="33" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
            </div>
            <div class="d-md-none d-sm-block text-center">
                <ins data-revive-zoneid="27" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
            </div>

            <!-- Related by tag -->
            <?php
            $tags = wp_get_post_tags( get_the_ID() );
            if ( $tags ) {
                $tag_ids = wp_list_pluck( $tags, 'term_id' );
                $rel = new WP_Query( [
                    'tag__in'                => $tag_ids,
                    'post__not_in'           => [ get_the_ID() ],
                    'posts_per_page'         => 4,
                    'post_status'            => 'publish',
                    'no_found_rows'          => true,
                    'update_post_meta_cache' => false,
                    'update_post_term_cache' => false,
                ] );
                if ( $rel->have_posts() ) {
                    echo '<h5>Также:</h5>';
                    while ( $rel->have_posts() ) : $rel->the_post(); ?>
                        <div class="d-flex align-items-center my-3">
                            <div class="flex-shrink-0">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <img src="<?php the_post_thumbnail_url(); ?>" class="align-self-center" alt="<?php the_title_attribute(); ?>" width="55" height="55" style="object-fit: cover;" loading="lazy">
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark mt-2"><?php the_title(); ?></a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                }
            }
            ?>

            <hr>

        </div><!-- /.col-lg-8 -->

        <div class="col-lg-4 text-center">
            <div class="d-none d-md-none d-lg-block">
                <div class="img-fluid rounded-lg bg-light border p-5 m-4">
                    <?php
                    $rel = new WP_Query( [
                        'posts_per_page'         => 3,
                        'tag'                    => 'ukraine',
                        'orderby'                => 'rand',
                        'post_status'            => 'publish',
                        'no_found_rows'          => true,
                        'update_post_meta_cache' => false,
                        'update_post_term_cache' => false,
                    ] );
                    while ( $rel->have_posts() ) : $rel->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </a>
                        <p>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark mb-5">
                                <b><?php the_title(); ?></b>
                            </a>
                        </p>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; else : ?>
    <h2>Не найдено</h2>
    <p>К сожалению, вы запросили то, чего здесь нет.</p>
<?php endif; ?>
</div>


<!-- ── More articles row ─────────────────────────── -->
<div class="container-fluid">
    <div class="row">
        <?php
        $more = new WP_Query( [
            'posts_per_page'         => 8,
            'post_status'            => 'publish',
            'post__not_in'           => [ get_queried_object_id() ],
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );
        while ( $more->have_posts() ) : $more->the_post(); ?>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid" width="800" height="450" loading="lazy">
                </a>
                <small><?php echo esc_html( format_post_date() ); ?></small>
                <h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>
