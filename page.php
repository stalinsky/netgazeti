<?php get_header(); ?>

<div class="container">

    <div class="row">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            setPostViews( get_the_ID() );
        ?>
            <div class="col-md-11">
                <h1 class="display-4 border-bottom"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>

    <!-- Latest from "news" -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
        <?php
        $q = new WP_Query( [
            'posts_per_page'         => 3,
            'category_name'          => 'news',
            'ignore_sticky_posts'    => 1,
            'post_status'            => 'publish',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );
        while ( $q->have_posts() ) : $q->the_post(); ?>
            <div class="col">
                <div class="card h-100">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>" width="800" height="450" loading="lazy">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-dark"><?php the_title(); ?></a>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo esc_html( format_post_date() ); ?></small>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</div>

<?php get_footer(); ?>
