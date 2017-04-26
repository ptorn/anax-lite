<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1><?= esc($content->title) ?></h1>
                <article class="article">
                    <?= $app->textfilter->formatToHtmlStrip($content->data, $content->filter) ?>
                </article>
            </main>
        </div>
    </div>
</div>
