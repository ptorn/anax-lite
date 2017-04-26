<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <header>
                    <h1><?= esc($content->title) ?></h1>
                    <p class="meta-header">
                        Publicerad: <time datetime="<?= esc($content->published) ?>" pubdate="<?= esc($content->published) ?>"><?= esc($content->published) ?></time>.
                    </p>
                </header>
                <article class="article blog-post">
                    <?= $app->textfilter->formatToHtmlStrip($content->data, $content->filter) ?>
                </article>
            </main>
        </div>
    </div>
</div>
