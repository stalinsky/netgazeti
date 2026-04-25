<footer class="footer text-light bg-dark pt-5 mt-5">
    <div class="container">

        <div class="row no-gutters social-container mx-auto w-50">
            <div class="col"><a class="social-inner" href="https://fb.com/Netgazeti.News.Russian" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook fs-4"></i></a></div>
            <div class="col"><a class="social-inner" href="https://open.spotify.com/show/21OdQ5R0hHRwECiOJv9iWw" target="_blank" rel="noopener noreferrer" aria-label="Spotify"><i class="bi bi-spotify fs-4"></i></a></div>
            <div class="col"><a class="social-inner" href="/feed/" target="_blank" rel="noopener noreferrer" aria-label="RSS"><i class="bi bi-rss-fill fs-4"></i></a></div>
            <div class="col"><a class="social-inner" href="https://t.me/netgazetirussian" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><i class="bi bi-telegram fs-4"></i></a></div>
            <div class="col"><a class="social-inner" href="https://instagram.com/ru_netgazeti" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram fs-4"></i></a></div>
            <div class="col"><a class="social-inner" href="https://twitter.com/ruNetgazeti" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="bi bi-twitter-x fs-4"></i></a></div>
        </div>

        <p class="float-end">
            <a class="back-to-top text-light border rounded p-3 pt-4" href="#" id="backToTop" aria-label="Наверх"><i class="bi bi-hand-index-thumb fs-3"></i></a>
        </p>

        <div class="row row-cols-2">
            <div class="col-md-2">
                <h5 class="card-title mb-3 border-bottom border-info-subtle">КАТЕГОРИИ</h5>
                <ul class="nav flex-column">
                    <li class="item"><a href="/category/news/">Новости</a></li>
                    <li class="item"><a href="/category/society/">Люди и общество</a></li>
                    <li class="item"><a href="/category/politics/">Политика и власть</a></li>
                    <li class="item"><a href="/category/money/">Деньги</a></li>
                    <li class="item"><a href="/category/opinion/">Мнение и комментарии</a></li>
                    <li class="item"><a href="/tag/ukraine/"><b>Война в Украине</b></a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-6">
                <h5 class="card-title mb-3 border-bottom border-success">МЕСТА</h5>
                <ul class="nav flex-column">
                    <li class="item"><a href="/tag/tbilisi/">Тбилиси</a></li>
                    <li class="item"><a href="/tag/adjara/">Аджария</a></li>
                    <li class="item"><a href="/tag/south-ossetia/">Южная Осетия</a></li>
                    <li class="item"><a href="/tag/armenia/">Армения</a></li>
                    <li class="item"><a href="/tag/azerbaijan/">Азербайджан</a></li>
                    <li class="item"><a href="/tag/batumi/">Батуми</a></li>
                    <li class="item"><a href="/tag/abkhazia/">Абхазия</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-6">
                <h5 class="card-title mb-3 border-bottom border-info">ТЕМЫ</h5>
                <ul class="nav flex-column">
                    <li class="item"><a href="/tag/revolt/">Акции и протесты</a></li>
                    <li class="item"><a href="/tag/law/">Право и закон</a></li>
                    <li class="item"><a href="/tag/money/">Деньги</a></li>
                    <li class="item"><a href="/tag/authority/">Власть</a></li>
                    <li class="item"><a href="/tag/incident/">Происшествие</a></li>
                    <li class="item"><a href="/tag/covid-19/">Covid-19</a></li>
                    <li class="item"><a href="/tag/elections/">Выборы</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h5 class="card-title mb-3 border-bottom border-primary">СПЕЦПРОЕКТЫ</h5>
                <ul class="nav flex-column">
                    <li class="item"><a href="/book-trip-old-batumi/">Книга «Путешествие по старому Батуми»</a></li>
                    <li class="item"><a href="https://soundcloud.com/netgazeti-ge-1" target="_blank" rel="noopener noreferrer">Подкасты</a></li>
                    <li class="item"><a href="/tag/commercial/">Нативная реклама</a></li>
                    <li class="item"><a href="https://batumelebi.tilda.ws/forukraine" target="_blank" rel="noopener noreferrer">Поддержка СМИ в Украине</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h5 class="card-title mb-3 border-bottom border-info">ОБЛАСТЬ</h5>
                <ul class="nav flex-column">
                    <li class="item"><a href="/tag/infrastructure/">Инфраструктура</a></li>
                    <li class="item"><a href="/tag/education/">Образование</a></li>
                    <li class="item"><a href="/tag/tourism/">Туризм</a></li>
                    <li class="item"><a href="/tag/art/">Искусство</a></li>
                    <li class="item"><a href="/tag/itech/">Технологии</a></li>
                    <li class="item"><a href="/tag/ecology/">Экология</a></li>
                    <li class="item"><a href="/tag/history/">История</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h5 class="card-title mb-3 border-bottom border-danger">АРХИВ</h5>
                <select name="archive-dropdown" class="btn btn-success" onchange="if(this.value)document.location.href=this.value;" aria-label="Архив по месяцам">
                    <option value=""><?php echo esc_attr__( 'Выберите дату' ); ?></option>
                    <?php wp_get_archives( 'type=monthly&format=option&show_post_count=0' ); ?>
                </select>
            </div>
        </div>
    </div>
</footer>

<aside class="footer text-light bg-dark pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <address>
                    <b>Gazeti Batumelebi LLC</b><br>
                    7a Louis Pasteur Str. Tbilisi, Georgia, 0102<br>
                    48 Memed Abashidze Ave. Batumi, Georgia, 6010<br>
                    Phone: (995) 422 274512, 0322960830<br>
                    Mobile: (995) 577537154, 591960109<br>
                    Email: <a href="mailto:info@batumelebi.ge" class="text-info">info@batumelebi.ge</a>, <a href="mailto:info@netgazeti.ge" class="text-info">info@netgazeti.ge</a>
                </address>
            </div>
            <div class="col-md-6">
                <p>Создан при поддержке BBC. Взгляды, мнения и заявления, опубликованные авторами издания, являются собственностью <a href="/privacy-policy/" class="text-info">редакции «Батумелеби»</a> и не отражают позицию фонда BBC. Таким образом, BBC не несёт ответственности за содержание информационных материалов.</p>
            </div>
            <div class="col-md-2">
                <div id="top-ge-counter-container" data-site-id="45113"></div>
                <script async src="//counter.top.ge/counter.js"></script>
            </div>
        </div>
    </div>
</aside>

<!-- Bootstrap 5.3.3 bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<!-- Swiper 11 (carousel replacement) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<!-- Theme JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/theme.js?v=2.57" defer></script>
</body>
</html>
