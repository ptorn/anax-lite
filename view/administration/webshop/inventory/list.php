<?php
$defaultRoute = "inventory?";
$output = "";
for ($x = 0; $x < count($content); $x++) {
    $shelf = esc($content[$x]->shelf) ? esc($content[$x]->shelf) : "NONE";
    $location = esc($content[$x]->location) ? esc($content[$x]->location) : "Ingen plats";
    $items = esc($content[$x]->items) ? esc($content[$x]->items) : "Ej i lager";

    $output .= "<tr>";
    $output .= "<td>" . esc($content[$x]->id) . "</td>";
    $output .= "<td>" . esc($content[$x]->name) . "</td>";
    $output .= "<td>" . $shelf . "</td>";
    $output .= "<td>" . $location . "</td>";
    $output .= "<td>" . $items . "</td>";
    $output .= "<td><a href=\"inventory/edit?id=" . esc($content[$x]->id) . "\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>";
    $output .= " <a href=\"inventory/delete?id=" . esc($content[$x]->id) . "\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></td>";
    $output .= "</tr>";
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Lager</h1>

                <p>Produkter per sida:
                    <a href="<?= mergeQueryString(["hits" => 5], $defaultRoute) ?>">5</a> |
                    <a href="<?= mergeQueryString(["hits" => 10], $defaultRoute) ?>">10</a> |
                    <a href="<?= mergeQueryString(["hits" => 20], $defaultRoute) ?>">20</a>
                </p>
                <table>
                    <tr>
                        <th>Id <?= orderby("id", $defaultRoute) ?></th>
                        <th>Namn <?= orderby("name", $defaultRoute) ?></th>
                        <th>Hylla</th>
                        <th>Position</th>
                        <th>Lagersaldo</th>
                        <th>Hantera</th>
                    </tr>
                    <?= $output; ?>
                </table>
                <p>
                    Sida:
                    <?php for ($i = 1; $i <= $max; $i++) : ?>
                        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </p>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/webshop') ?>">
                        <button name="button">Tillbaka</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
</div>
