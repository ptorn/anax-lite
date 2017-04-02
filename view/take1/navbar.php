<?php
require(ANAX_INSTALL_PATH . "/config/navbar.php");
// var_dump($navbar);


/**
 * Check if item matches current route
 * @method isActiveLink
 * @param  [array]       $item [array item from navbar config]
 * @return string            [result with class name for active]
 */
function isActiveLink($item)
{
    global $app;

    $currentUrl = $app->request->getRoute();
    if ($currentUrl === $item["route"]) {
        return ' class="active"';
    }
}


/**
 * Function to generate list items för the navbar
 * @method generateNavbarList
 * @param  [Array]             $items [navbar links]
 * @return [html list-items]                    [li-items in html]
 */
function generateNavbarList($items)
{
    global $app;

    // var_dump($items);
    $output = "";
    foreach ($items as $item) {
        $output .= '<li' . isActiveLink($item) . '><a href="' . $app->url->create($item["route"]) .
                   '" title="' . $item['text'] . '">' . $item['text'] . '</a></li>' . "\n";
    }
    return $output;
}
?>
<nav class="<?= $navbar["config"]["navbar-class"] ?>" role="navigation">
    <!-- memu click button -->
    <div class="rm-navbar-top rm-navbar">
        <ul class="rm-default rm-desktop">
            <?= generateNavbarList($navbar["items"]) ?>
        </ul>
    </div>
</nav>

<div class="profile">
    <!-- menu wrapper -->
<div class="mobile-nav">

    <!-- memu click button -->
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
        <ul class="mobile-nav-links" class="mobile-links">
            <?= generateNavbarList($navbar["items"]) ?>
        </ul>
    </div>
</div>
