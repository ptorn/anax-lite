<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");

?>
<nav class="navbar2" role="navigation">
    <div class="rm-navbar-top rm-navbar">
        <ul class="rm-default rm-desktop">
            <li><a href="<?= $urlHome ?>">Home</a></li>
            <li><a href="<?= $urlAbout ?>">About</a></li>
            <li><a href="<?= $urlReport ?>">Report</a></li>
        </ul>
    </div>
</nav>
