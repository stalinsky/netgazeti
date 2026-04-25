# Netgazeti WordPress Theme — Boilerplate для медиа-проектов

> Лёгкая Bootstrap-тема без плагинов, без сборщиков, без `wp_enqueue`.
> Используется для **ru.netgazeti.ge**, форкается для **jnews.ge**, **nor.ge**, **ka.jnews.ge**, **ka.nor.ge**.

**Текущая версия:** 2.57 · **Дата:** 25 апреля 2026 · **Авторы:** Muge Ozkaptan, Konstantin Stalinsky ([@StalinskyK](https://x.com/StalinskyK))

---

## Содержание

1. [Философия](#1-философия)
2. [Технологии и зависимости](#2-технологии-и-зависимости)
3. [Структура файлов](#3-структура-файлов)
4. [Архитектурные конвенции](#4-архитектурные-конвенции)
5. [Форк темы под новый медиа-проект](#5-форк-темы-под-новый-медиа-проект)
6. [Локализация (ru → ka)](#6-локализация-ru--ka)
7. [Деплой и пост-деплой](#7-деплой-и-пост-деплой)
8. [Безопасность — чек-лист](#8-безопасность--чек-лист)
9. [Известные ограничения](#9-известные-ограничения)
10. [Changelog](#10-changelog)

---

## 1. Философия

Тема намеренно отказывается от практик современного WP-туториала:

| Стандартный WP-подход                       | Подход в этой теме                                                |
| ------------------------------------------- | ----------------------------------------------------------------- |
| `wp_enqueue_style`, `wp_enqueue_script`     | Прямые `<link>` и `<script>` теги в `header.php`/`footer.php`     |
| `wp_head()`, `wp_footer()`                  | Не вызываются (тема сама контролирует, что попадает в `<head>`)   |
| Кастомные CSS-классы под каждый блок        | Только нативные утилиты Bootstrap (`text-bg-success`, `fw-bold`…) |
| Плагины SEO, кеширования, sitemap, viewers  | Ничего: SEO-теги и sitemap руками, счётчик просмотров — `meta`    |
| Sass, Webpack, npm-сборка                   | Чистый CSS в `style.css`                                          |
| Gutenberg / блочный редактор                | Отключён через `use_block_editor_for_post → false`                |
| Загрузка миниатюр всех размеров             | Один размер 800×450, миниатюры отключены полностью                |

**Зачем так:** медиа-сайты — это редакторы, которые должны быстро публиковать тексты, и читатели на 3G в горных сёлах Самцхе-Джавахети. Каждый лишний килобайт CSS и каждый лишний SQL-запрос напрямую конвертируется в потерянных читателей. Толстые темы с админ-панелями опций и плагинами SEO дают редактору иллюзию контроля, но не дают читателю быстро открыть страницу.

**Прямое следствие:** все «настройки темы» хранятся в исходниках. Хочешь поменять цвет — правь `style.css`. Хочешь поменять структуру главной — правь `index.php`. Не существует Customizer, нет Theme Options, нет ACF.

---

## 2. Технологии и зависимости

| Слой        | Что используется                                       | Источник                                       |
| ----------- | ------------------------------------------------------ | ---------------------------------------------- |
| CSS         | Bootstrap 5.3.3                                        | jsDelivr CDN                                   |
| Иконки      | Bootstrap Icons 1.11.3                                 | jsDelivr CDN                                   |
| Карусели    | Swiper 11 (vanilla, без jQuery)                        | jsDelivr CDN                                   |
| Шрифты      | Ubuntu (Google Fonts), для ka — добавить Noto Sans Georgian |                                            |
| JS          | Vanilla JavaScript в `js/theme.js`                     | Локально                                       |
| PHP         | 8.0+ (использует `match`, `??=`, named arguments не используются) |                                     |
| WordPress   | 5.5+ (используется `wp_get_document_title()`, `the_title_attribute()`) |                                |

**Внешние сервисы (можно убрать при форке):**
- Google AdSense + Analytics (`G-JVEJ3XZ0KG`)
- ShareThis (`property=61ca2755cd90e100193cce30`)
- Revive Adserver (`ads.netgazeti.ge`)
- top.ge counter (`site-id=45113`)
- Facebook App ID (`683715585163569`)

Все эти ID — **проектные**, для форка надо заменить или удалить (см. §5).

---

## 3. Структура файлов

```
theme/
├── 404.php                          # Страница 404 (без mail(), без XSS)
├── archive.php                      # Архив (год/месяц/день)
├── author.php                       # Страница автора
├── category.php                     # Категория
├── footer.php                       # Подвал + соцсети + ссылки + Bootstrap JS
├── functions.php                    # Хелперы, фильтры, без wp_enqueue
├── header.php                       # <head>, мета-теги, навбар, поиск
├── index.php                        # Главная страница (8+ секций)
├── page.php                         # Страница (Pages в WP)
├── page-report.php                  # Внутренний отчёт по публикациям (Template)
├── page-sitemap.php                 # XML-sitemap по годам (Template)
├── search.php                       # Результаты поиска
├── single.php                       # Страница статьи
├── sitemap.php                      # Google News sitemap (последние 2 дня)
├── tag.php                          # Тег
├── style.css                        # Все кастомные стили (≈140 строк)
├── images/                          # Лого, иконки, no-featured-image
├── js/
│   └── theme.js                     # Vanilla JS (search overlay, back-to-top, Swiper)
└── template-parts/
    └── loop-archive.php             # Общий партиал для archive/category/tag/author/search
```

**Что НЕ должно появиться:**

- `inc/`, `lib/`, `vendor/`, `node_modules/` — нет сборщиков
- `screenshot.png` — добавляется опционально, для админки
- Директории языков (`languages/*.po`, `*.mo`) — не используем загрузку текстдомена, тексты на русском в коде, для грузинских проектов делается отдельный форк (см. §6)

---

## 4. Архитектурные конвенции

Эти правила применяются ко **всем** проектам — netgazeti, jnews, nor и их грузинским версиям.

### 4.1 Изображения

Один размер на весь сайт: **800×450 px, формат 16:9**.

```php
// В functions.php явно отключаем все промежуточные размеры:
add_filter( 'intermediate_image_sizes', function( $sizes ) {
    return array_diff( $sizes, [ 'thumbnail', 'medium', 'medium_large', 'large', '1536x1536', '2048x2048' ] );
} );
```

Дополнительно в WP Dashboard → Settings → Media → выставить **все размеры в 0**, включая «Thumbnail size».

В шаблонах используем `the_post_thumbnail_url()` без параметра — отдаст оригинал, который и есть 800×450.

**Атрибуты `<img>`:**
- `width="800" height="450"` — обязательно (CLS-friendly)
- `loading="lazy"` — на всё, кроме первого экрана главной
- `alt="<?php the_title_attribute(); ?>"` — никогда не пустой
- Fallback: `images/no-featured-image.png` (когда `has_post_thumbnail()` === false)

### 4.2 Slug'и категорий

В `index.php` категории фигурируют **только по slug**, не по ID:

```php
// ✓ ПРАВИЛЬНО
'category_name' => 'politics'

// ✗ НЕПРАВИЛЬНО (ID может измениться)
'cat' => 10
```

Пять основных slug'ов на всех проектах: **`news`, `politics`, `society`, `money`, `opinion`**. Если в новом проекте slug'и другие — менять централизованно в `index.php`.

### 4.3 Формат дат

Глобальное правило для всех проектов:

| Где                                                       | Формат                              | Функция                       |
| --------------------------------------------------------- | ----------------------------------- | ----------------------------- |
| **Главная страница** (index.php)                          | «5 минут назад», «2 дня назад»      | `time_ago()`                  |
| **Все остальные страницы** (single, category, tag, archive, author, search, page) | «25 Апреля, 2026»     | `format_post_date()`          |

Хелпер `format_post_date()` в `functions.php` обеспечивает заглавную букву месяца:

```php
function format_post_date( $post_id = null ) {
    $date = date_i18n( 'j F, Y', get_the_time( 'U', $post_id ) );
    return mb_strtoupper( mb_substr( $date, 0, 1 ) ) . mb_substr( $date, 1 );
}
```

Для грузинских проектов (`ka.*`) формат тот же, но `date_i18n` подберёт грузинские названия месяцев из локали — **без `mb_strtoupper`** (грузинский алфавит без заглавных), см. §6.

### 4.4 `WP_Query` — обязательные флаги

Каждый кастомный запрос к постам должен содержать:

```php
$base_args = [
    'post_status'            => 'publish',
    'no_found_rows'          => true,    // отключить SELECT FOUND_ROWS()
    'update_post_meta_cache' => false,   // не подгружать meta, если не нужна
    'update_post_term_cache' => false,   // не подгружать таксономию, если не нужна
];
```

Если в шаблоне всё-таки нужны теги/мета (например, в hero на главной показываются `the_tags()`) — **тогда** убрать `update_post_term_cache => false`.

### 4.5 Экранирование вывода

| Контекст                       | Функция                                           |
| ------------------------------ | ------------------------------------------------- |
| Текст в HTML                   | `esc_html()`                                      |
| Атрибут (alt, title, value)    | `esc_attr()` / `the_title_attribute()`            |
| URL                            | `esc_url()`                                       |
| Translatable + HTML            | `esc_html__()`, `esc_attr__()`                    |
| `$_GET`/`$_POST`               | Никогда не выводить без экранирования             |

В этой теме мы доверяем `the_title()`, `the_permalink()`, `the_post_thumbnail_url()` — они экранируют сами. Но **не доверяем** `$_SERVER`, `$_GET`, `$_POST`, БД-выборкам.

### 4.6 Внешние ссылки

Любая ссылка с `target="_blank"` обязана иметь:

```html
<a href="..." target="_blank" rel="noopener noreferrer">
```

Иначе — XSS-вектор через `window.opener`.

### 4.7 Подсчёт просмотров

`setPostViews()` в `functions.php` использует **atomic update** (`UPDATE ... SET count = count + 1`). Не использовать паттерн «прочитать → инкрементировать → сохранить» — race condition.

### 4.8 Bootstrap-first

Не создавай новый CSS-класс, пока не проверил, что **Bootstrap 5.3 этого не умеет**. Примеры:

| Хочется                  | Не пиши кастом                | Используй                     |
| ------------------------ | ----------------------------- | ----------------------------- |
| Жирный текст             | `.bold {font-weight: 700}`    | `class="fw-bold"`             |
| Зелёный фон + белый текст| `.green-box`                  | `class="text-bg-success"`     |
| Скрыть на мобиле         | `.hide-mobile`                | `class="d-none d-md-block"`   |
| Тёмный навбар            | `.dark-navbar`                | `data-bs-theme="dark"`        |

Если действительно нужен кастомный класс (overlay поиска, gradient на изображении) — он идёт в `style.css` с комментарием **зачем** и **почему Bootstrap не покрывает**.

---

## 5. Форк темы под новый медиа-проект

### Чек-лист форка (по порядку)

**Шаг 1 — Скопировать тему**

```bash
cp -r netgazeti/ jnews/
cd jnews/
```

**Шаг 2 — Переименовать в `style.css`**

```css
Theme Name:   jNews
Theme URI:    https://jnews.ge/
Description:  Bootstrap-тема для jnews.ge
Version:      1.0
Text Domain:  jnews
```

**Шаг 3 — Заменить значения по таблице ниже**

| Параметр              | netgazeti               | jnews.ge        | nor.ge        | ka.jnews.ge   | ka.nor.ge     |
| --------------------- | ----------------------- | --------------- | ------------- | ------------- | ------------- |
| `lang` в `<html>`     | `ru`                    | `ru`            | `ru`          | `ka`          | `ka`          |
| `og:locale`           | `ru_RU`                 | `ru_RU`         | `ru_RU`       | `ka_GE`       | `ka_GE`       |
| Brand text            | Netgazeti на русском    | jNews           | NOR           | jNews         | NOR           |
| Logo                  | `images/logo-03.png`    | свой            | свой          | свой          | свой          |
| Twitter handle        | `@RuNetgazeti`          | `@jNews_ge`     | `@nor_ge`     | `@jNews_ka`   | `@nor_ka`     |
| FB app ID             | `683715585163569`       | свой            | свой          | свой          | свой          |
| Google Analytics      | `G-JVEJ3XZ0KG`          | свой            | свой          | свой          | свой          |
| AdSense client        | `ca-pub-4844191115425321`| свой           | свой          | свой          | свой          |
| ShareThis property    | `61ca2755...`           | свой / удалить  | удалить       | свой / удалить| удалить       |
| Revive zones          | `1, 26, 27, 32, 33, 34` | другие/нет      | нет           | другие/нет    | нет           |
| top.ge counter ID     | `45113`                 | свой            | свой          | свой          | свой          |

**Шаг 4 — Заменить категории в `index.php`**

Найти все `category_name => 'X'` и `tag => 'X'` и сверить со структурой нового проекта. Если slug отличается — заменить.

**Шаг 5 — Соцсети в `footer.php`**

Заменить URL'ы Facebook, Telegram, Instagram, Twitter, RSS, Spotify на актуальные для проекта.

**Шаг 6 — Контакты в `footer.php`**

Заменить блок `<address>` (юридическое название, адрес офиса, телефоны, email).

**Шаг 7 — Меню навбара в `header.php`**

Меню захардкожено в HTML (это намеренно). Привести в соответствие со структурой категорий проекта:

```html
<li class="nav-item"><a class="nav-link" href="/category/news/">Новости</a></li>
<!-- ... -->
```

**Шаг 8 — Цветовая схема (если требуется)**

Бренд-цвет Netgazeti — зелёный `#28a745`. В `style.css` встречается в:
- `.text-success`, `.text-bg-success`
- `.swiper-pagination-bullet-active`
- `a, a:hover`
- `article > ul li::before`
- `.d-inline-block` (категории/теги)
- footer hover

Если у нового проекта другой бренд-цвет — заменить во всех 6 местах. Можно через CSS-переменные:

```css
:root {
    --brand: #28a745;
    --brand-bg: #28a745;
}
.text-success { color: var(--brand) !important; }
/* и т.д. */
```

**Шаг 9 — Удалить ненужное**

Если у проекта нет AdSense / ShareThis / Revive — удалить соответствующие `<script>` из `header.php` и `footer.php`. Меньше внешних запросов = быстрее загрузка.

**Шаг 10 — Sitemap-ссылки**

В `header.php` есть три `<link rel="sitemap">` для архивных годов Netgazeti. Их надо или удалить, или подменить на свои.

---

## 6. Локализация (ru → ka)

Для **ka.jnews.ge** и **ka.nor.ge** не делается отдельный `.po`-файл. Тексты переписываются прямо в шаблонах. Это намеренно: Text Domain не загружен, `__()` работает как identity function.

### Что меняется при переводе на грузинский

**6.1 `<html lang>`**
```php
<html prefix="og: http://ogp.me/ns#" lang="ka">
```

**6.2 `og:locale`**
```php
<meta property="og:locale" content="ka_GE">
```

**6.3 Шрифты в `header.php`**
```html
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Georgian:wght@400;700&display=swap" rel="stylesheet">
```

И в `style.css`:
```css
html, body { font-family: 'Noto Sans Georgian', sans-serif; }
```

**6.4 Хелпер `format_post_date()`**

Для грузинского НЕ нужен `mb_strtoupper` (в грузинском нет заглавных букв) и желателен другой формат — без запятой:

```php
function format_post_date( $post_id = null ) {
    return date_i18n( 'j F, Y', get_the_time( 'U', $post_id ) );
    // Грузинская локаль выдаст: «25 აპრილი, 2026»
}
```

WP сам подберёт грузинские названия месяцев, если **в Settings → General → Site Language выставлено `ქართული`**.

**6.5 Все строки шаблона**

Все `'Новости'`, `'Поиск'`, `'Не найдено'`, `'На главную'`, `'Также:'`, `'Найдено упоминаний'` — переписать на грузинский. Список мест:

- `header.php` — меню навбара, плейсхолдер поиска, alt лого
- `footer.php` — заголовки колонок (КАТЕГОРИИ, МЕСТА, ТЕМЫ, СПЕЦПРОЕКТЫ, ОБЛАСТЬ, АРХИВ), `Выберите дату`, юр.инфо
- `single.php` — `Также:`, `Правила перепечатки`
- `search.php` — `Поиск:`, `Найдено упоминаний:`, `Может изменим запрос`
- `404.php` — `Страница не найдена`, `На главную`, `Попробуйте поиск`
- `template-parts/loop-archive.php` — `Ничего не найдено`, `Попробуйте изменить запрос`

---

## 7. Деплой и пост-деплой

### 7.1 Загрузка темы

Через cPanel File Manager или SFTP — закинуть содержимое `theme/` в `wp-content/themes/<theme-name>/` и активировать в Dashboard → Appearance → Themes.

### 7.2 После активации обязательно

1. **Permalinks** — Settings → Permalinks → Save. Без изменений, просто сохранить, чтобы пересоздались rewrite rules.
2. **Media** — Settings → Media → выставить все размеры (Thumbnail / Medium / Large) в `0` и убрать галочку «Crop». Без этого WP всё равно начнёт генерировать миниатюры.
3. **Reading** — Settings → Reading → Front page displays = «Your latest posts».
4. **Discussion** — Settings → Discussion → отключить комментарии по умолчанию (если не используются).
5. **Site Language** — Settings → General → проверить, что для `ka.*` выставлено `ქართული`, а для `ru.*` — `Русский`.

### 7.3 Сервер

- **Open Graph image cache:** при выкатке нового лого — прогнать через [Facebook Debugger](https://developers.facebook.com/tools/debug/) и [Twitter Card Validator](https://cards-dev.twitter.com/validator).
- **Старые AMP-ссылки** (если форкнули из старой версии Netgazeti с AMP): добавить в `.htaccess`:
  ```apache
  RewriteRule ^(.+)/amp/?$ /$1 [R=301,L]
  ```

### 7.4 Smoke-test

После деплоя пройтись по всем шаблонам:

- [ ] `/` — главная отрендерилась, все секции на месте, обе карусели работают
- [ ] `/<пост>/` — single.php, просмотры тикают, дата `«25 Апреля, 2026»`
- [ ] `/category/news/` — category.php через partial
- [ ] `/tag/tbilisi/` — tag.php через partial
- [ ] `/author/<slug>/` — author.php через partial
- [ ] `/?s=test` — search.php, число найденных корректно
- [ ] `/несуществующая-страница` — 404.php без падений
- [ ] `/2025/04/` — archive.php
- [ ] DevTools Console — нет ошибок `Uncaught ReferenceError: $ is not defined`
- [ ] DevTools Network — нет 404 на статику, ни одного запроса к `jquery.js` / `owl.carousel.*`

---

## 8. Безопасность — чек-лист

При любом изменении или форке проверять:

- [ ] Нет вызовов `mail()` где попало (особенно в `404.php`)
- [ ] `$_GET`, `$_POST`, `$_SERVER` всегда экранированы (`esc_html`, `esc_url`, `(int)` для чисел)
- [ ] Все `WP_Query` с пользовательским вводом используют `prepare()` или приводят типы
- [ ] Все `target="_blank"` имеют `rel="noopener noreferrer"`
- [ ] Нет коротких PHP-тегов `<?` без `php`
- [ ] Нет кириллической `</а>` (выглядит как `</a>`, но является невалидным HTML)
- [ ] `setPostViews` использует atomic update (`UPDATE ... SET = + 1`)
- [ ] Нет `wp_specialchars` (deprecated) — использовать `esc_html` или `get_search_query()`
- [ ] Нет hardcoded category ID (`cat => N`) — только slug

---

## 9. Известные ограничения

1. **Нет Customizer.** Для смены лого/цветов — править исходники.
2. **Нет загрузки переводов.** Грузинский — отдельный форк, не локаль.
3. **Один размер изображений.** Если редактору нужны крупные хедеры (1600px), придётся менять архитектуру.
4. **Нет AMP.** Удалён в 2.57. Если Google вернёт AMP в Top Stories — придётся добавить обратно.
5. **Captcha на формах.** Тема не предусматривает comment-формы; если активируются — добавлять отдельно.
6. **Нет OEmbed-обёрток.** Ютубы и твиты в постах рендерятся как есть — желательны, но не предусмотрены `style.css`-стили для responsive iframe.

---

## 10. Changelog

### 2.57 — 2026-04-25

**Security:**
- 404.php переписан полностью (убраны `mail()`, XSS через `$_SERVER`)
- search.php: `wp_specialchars` → `get_search_query()` + `esc_html`
- Все `target="_blank"` получили `rel="noopener noreferrer"`
- `setPostViews()` теперь использует atomic SQL update

**Performance:**
- Bootstrap 5.3.0-alpha2 → **5.3.3** (стабильный релиз)
- Font Awesome 5.5.0 (≈100 KB) → **Bootstrap Icons 1.11.3** (≈30 KB, иконочный шрифт уже совместим с Bootstrap)
- jQuery 3.3.1 + 3.5.1-slim полностью удалены (-90 KB)
- Owl Carousel заменён на **Swiper 11** (vanilla JS)
- Все `WP_Query` получили `no_found_rows` + `update_post_*_cache` флаги
- `loading="lazy"` на все `<img>` кроме первого экрана

**Architecture:**
- AMP-поддержка полностью удалена (rewrite, template_redirect, amp.php)
- Хардкод категорий по ID → slug'и (`'cat' => 10` → `'category_name' => 'politics'`)
- 5 архивных шаблонов унифицированы через `template-parts/loop-archive.php`
- Кириллическая `</а>` исправлена на `</a>`
- Все короткие PHP-теги `<?` заменены на `<?php`
- Хелпер `format_post_date()` для словесного формата дат
- Удалён `the_posts_pagination()` со строки 90 functions.php (выполнялся на каждом запросе!)
- Условный `<link rel="canonical">` (на single — permalink, на главной — home_url, на category — category_link)

**Code quality:**
- Все 16 PHP-файлов проходят `php -l`
- functions.php сократился с 103 до 65 строк
- Общий PHP-LOC: ~1500 → ~1300

---

## Контакты

**Поддержка темы:** [@StalinskyK](https://x.com/StalinskyK) · `lab@iot.org.ge`
**Лицензия:** GPL v3 — `http://www.gnu.org/licenses/gpl-3.0.html`
