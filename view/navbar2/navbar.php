<nav class="navbar2" role="navigation">
    <!-- memu click button -->
    <div class="rm-navbar-top rm-navbar rm-desktop">
            <?= $app->navbar->generateNavbarHTML("rm-default rm-desktop") ?>
    </div>
</nav>

<!-- menu wrapper -->
<div class="mobile-nav">

    <!-- menu click button -->
    <div id="mobile-nav-top">
        <ul>
            <li><a id="rm-menu-button" class="rm-button" href="#">
                <i class="fa fa-bars rm-button-face-1"></i>
                <i class="fa fa-times rm-button-face-2"></i>
            </a></li>
        </ul>
    </div>

    <!-- main menu -->
    <div id="mobile-nav-container" class="hide">
            <?= $app->navbar->generateNavbarHTML("mobile-nav-links mobile-links") ?>
    </div>
</div>
<?php if ($app->session->get('user')) { ?>
<div class="logout">
    <a href="<?= $app->url->create('administration/user/logout') ?>" title="Logout">Logga Ut</a>
</div>
<?php } ?>
