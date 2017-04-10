<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Session dump</h1>
                <pre><?= $app->session->dump(); ?></pre>
                <a href="<?= $app->url->create("session"); ?>" title="Tillbaka till Session">Tillbaka till Session</a>
            </main>
        </div>
    </div>
</div>
