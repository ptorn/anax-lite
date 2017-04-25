<?php
$origNl2br = "Nu testar vi radbrytning,
vid varje komma,
så kör vi en radbrytning,
så då gör vi en till,
detta är sista.";

$origBBCode = "[b]This is bold[/b] [i]This is italic[/i] [u]This is underline[/u]
[url=http://www.github.com]Check out github[/url]";

$origLink = "http://www.github.com sen tar vi en till http://www.google.com och https://dbwebb.se";

$origMarkdown = <<<EOD
Då ska vi se om *tada* och sen **tada**
[Github](http://www.github.com "Github")
EOD;

?>


<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Filter</h1>

                <h2>Nl2br</h2>
                <h3>Oformaterad</h3>
                <?= $origNl2br ?>
                <h3>Formaterad - nl2br</h3>
                <?= $app->textfilter->formatToHtml($origNl2br, "nl2br") ?>

                <h2>BBCode</h2>
                <h3>Oformaterad</h3>
                <?= $origBBCode ?>
                <h3>Formaterad - BBCode</h3>
                <?= $app->textfilter->formatToHtml($origBBCode, "bbcode") ?>

                <h2>Link</h2>
                <h3>Oformaterad</h3>
                <?= $origLink ?>
                <h3>Formaterad - BBCode</h3>
                <?= $app->textfilter->formatToHtml($origLink, "link") ?>

                <h2>Markdown</h2>
                <h3>Oformaterad</h3>
                <?= $origMarkdown ?>
                <h3>Formaterad - Markdown</h3>
                <?= $app->textfilter->formatToHtml($origMarkdown, "markdown") ?>
            </main>
        </div>
    </div>
</div>
