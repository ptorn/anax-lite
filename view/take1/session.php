<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Session testlänkar</h1>
                <p>Test nummer: <?= $app->session->get("number") ? $app->session->get("number") : 0; ?></p>
                <div class="session-button">
                    <a href="session/increment">Increment</a>
                    <a href="session/decrement">Decrement</a>
                    <a href="session/status">Status</a>
                    <a href="session/dump">Dump</a>
                    <a href="session/destroy">Destroy</a>
                </div>
            </main>
        </div>
    </div>
</div>
