<!doctype html>
<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,minimal-ui">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

<?php if ( is_singular() ) : the_post(); ?>
    <title><?php echo esc_html( get_the_title() ); ?> — Netgazeti.ge</title>
    <meta name="description" content="<?php echo esc_attr( wp_trim_words( get_the_excerpt(), 30 ) ); ?>">
    <link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>">

    <meta property="og:site_name" content="NETGAZETI.ge">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( wp_trim_words( get_the_excerpt(), 30 ) ); ?>">
    <meta property="og:image" content="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="450">
    <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
    <meta property="og:locale" content="ru_RU">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@RuNetgazeti">
    <meta name="twitter:creator" content="@RuNetgazeti">
    <meta name="twitter:title" content="<?php echo esc_attr( get_the_title() ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">

    <?php
    $cat = get_the_category();
    if ( ! empty( $cat ) ) {
        $feed_url = home_url( '/category/' . $cat[0]->slug . '/feed/' );
        echo '<link rel="alternate" type="application/rss+xml" title="' . esc_attr( $cat[0]->name ) . ' в формате RSS" href="' . esc_url( $feed_url ) . '">';
    }
    rewind_posts();
    ?>

<?php elseif ( is_category() || is_tag() || is_archive() ) :
    $term_title = single_term_title( '', false );
    if ( ! $term_title ) { $term_title = wp_get_document_title(); }
?>
    <title><?php echo esc_html( $term_title ); ?> — Netgazeti.ge</title>
    <meta name="description" content="<?php echo esc_attr( $term_title ); ?> — новости, мнения, аналитика на ru.netgazeti.ge">
    <link rel="canonical" href="<?php echo esc_url( ( is_category() ? get_category_link( get_queried_object_id() ) : ( is_tag() ? get_tag_link( get_queried_object_id() ) : home_url( $_SERVER['REQUEST_URI'] ) ) ) ); ?>">

    <meta property="og:site_name" content="NETGAZETI.ge">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr( $term_title ); ?>">
    <meta property="og:locale" content="ru_RU">

<?php elseif ( is_search() ) : ?>
    <title>Поиск: <?php echo esc_html( get_search_query() ); ?> — Netgazeti.ge</title>
    <meta name="robots" content="noindex,follow">
    <link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">

<?php else : /* home, page, 404 */ ?>
    <title>Netgazeti на русском</title>
    <meta name="description" content="Netgazeti на русском — новости, политика, общество, мнения. Грузия, Украина, Кавказ.">
    <meta name="keywords" content="Новости, Грузия, Тбилиси, Батуми, Украина, Политика, Экономика, Мнение">
    <link rel="canonical" href="<?php echo esc_url( home_url( '/' ) ); ?>">

    <meta property="og:site_name" content="ru.netgazeti.ge">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Netgazeti на русском языке">
    <meta property="og:description" content="Читай и делись умными новостями из Грузии, и не только">
    <meta property="og:image" content="https://netgazeti.ge/wp-content/uploads/2022/03/news-on-russian.jpg">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">
    <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
    <meta property="og:locale" content="ru_RU">

    <link rel="alternate" type="application/rss+xml" title="Netgazeti RSS" href="<?php echo esc_url( home_url( '/feed/' ) ); ?>">
<?php endif; ?>

<meta property="fb:app_id" content="683715585163569">

<!-- Sitemaps -->
<link rel="sitemap" href="/sitemap-2023.xml" type="application/xml">
<link rel="sitemap" href="/sitemap-2022.xml" type="application/xml">
<link rel="sitemap" href="/sitemap-2015-2021.xml" type="application/xml">

<!-- Bootstrap 5.3.3 + Bootstrap Icons + Ubuntu -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
<link href="<?php echo get_stylesheet_uri(); ?>?v=2.57" rel="stylesheet">

<!-- Google AdSense + Analytics -->
<meta name="google-adsense-account" content="ca-pub-4844191115425321">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4844191115425321" crossorigin="anonymous"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JVEJ3XZ0KG"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-JVEJ3XZ0KG');
</script>

<!-- ShareThis -->
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61ca2755cd90e100193cce30&product=sop" async></script>

<!-- Revive Adserver -->
<script async src="//ads.netgazeti.ge/www/delivery/asyncjs.php"></script>
</head>
<body>

<!-- Top banner -->
<div class="content text-center border border-end bg-light">
    <div class="d-none d-md-block w-100">
        <ins data-revive-zoneid="26" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
    </div>
    <div class="d-md-none d-sm-block">
        <ins data-revive-zoneid="34" data-revive-id="e44574db144f1080fd2f9cd61de8dd0a"></ins>
    </div>
</div>

<div class="container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" title="Наші серця — з Україною">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-03.png" width="138" height="auto" alt="Netgazeti на русском">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/category/news/" title="Новости Грузии">Новости</a></li>
                    <li class="nav-item"><a class="nav-link" href="/category/politics/" title="Политика Грузии">Политика</a></li>
                    <li class="nav-item"><a class="nav-link" href="/category/society/" title="Общество Грузии">Люди</a></li>
                    <li class="nav-item"><a class="nav-link" href="/category/money/" title="Финансовые новости Грузии">Деньги</a></li>
                    <li class="nav-item"><a class="nav-link" href="/category/opinion/" title="Мнения экспертов в Грузии">Мнение</a></li>
                </ul>
                <span class="navbar-text">
                    <span class="nav-link small text-secondary">
                        <a href="https://netgazeti.ge" class="text-secondary" target="_blank" rel="noopener noreferrer">Netgazeti</a>
                        |
                        <a href="https://batumelebi.ge" class="text-secondary" target="_blank" rel="noopener noreferrer">Batumelebi</a>
                    </span>

                    <!-- Search overlay -->
                    <div id="searchOverlay" class="overlay nav-link">
                        <span class="closebtn" id="searchClose" title="Закрыть окно">×</span>
                        <div class="overlay-content">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="search" placeholder="Найти..." name="s" value="<?php echo esc_attr( get_search_query() ); ?>" autofocus>
                                <button type="submit" aria-label="Искать"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                </span>
                <button class="openBtn" id="searchOpen" aria-label="Открыть поиск"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </nav>
</div>
<hr class="shadow p-0 my-1 mb-3 bg-body-tertiary">
