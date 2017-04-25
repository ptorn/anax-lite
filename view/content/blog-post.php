<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <header>
                    <h1><?= $app->textfilter->formatToHtmlStrip($content->title, $content->filter) ?></h1>
                    <p class="meta-header">
                        Publicerad: <time datetime="<?= $content->published ?>" pubdate="<?= $content->published ?>"><?= $content->published ?></time>.
                    </p>
                </header>
                <article class="article blog-post">
                    <?= $app->textfilter->formatToHtmlStrip($content->data, $content->filter) ?>
                </article>
            </main>
        </div>
    </div>
</div>
