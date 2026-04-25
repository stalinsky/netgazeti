<?php get_header(); ?>

<div id="primary" class="container py-5">
    <div id="content" class="site-content text-center" role="main">

        <header class="page-header mb-4">
            <h1 class="page-title display-3 text-muted">404</h1>
            <h2 class="h4 text-muted"><?php esc_html_e( 'Страница не найдена', 'netgazeti' ); ?></h2>
        </header>

        <div class="page-wrapper">
            <p class="lead"><?php esc_html_e( 'К сожалению, по этому адресу ничего нет. Возможно, материал был перемещён или удалён.', 'netgazeti' ); ?></p>

            <p class="my-4">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-success">
                    <i class="bi bi-house"></i> На главную
                </a>
            </p>

            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <h5 class="mb-3"><?php esc_html_e( 'Попробуйте поиск', 'netgazeti' ); ?></h5>
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="d-flex" role="search">
                        <input type="search" name="s" class="form-control me-2" placeholder="Найти..." aria-label="Поиск">
                        <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
