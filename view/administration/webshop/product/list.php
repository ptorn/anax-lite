<?php
$defaultRoute = "webshop?";
$output = "";
for ($x = 0; $x < count($content); $x++) {
    $output .= "<tr>";
    $output .= "<td>" . esc($content[$x]->id) . "</td>";
    $output .= "<td>" . esc($content[$x]->name) . "</td>";
    $output .= "<td>" . esc($content[$x]->description) . "</td>";
    $output .= "<td>" . esc($content[$x]->image) . "</td>";
    $output .= "<td>" . esc($content[$x]->price) . "</td>";
    $output .= "<td>" . esc($content[$x]->category) . "</td>";
    $output .= "<td>" . esc($content[$x]->inventory ? $content[$x]->inventory : "Ej i lager") . "</td>";
    $output .= "<td><a href=\"webshop/product/edit?id=" . esc($content[$x]->id) . "\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>";
    $output .= " <a href=\"webshop/product/delete?id=" . esc($content[$x]->id) . "\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></td>";
    $output .= "</tr>";
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Produkter</h1>

                <p>Produkter per sida:
                    <a href="<?= mergeQueryString(["hits" => 5], $defaultRoute) ?>">5</a> |
                    <a href="<?= mergeQueryString(["hits" => 10], $defaultRoute) ?>">10</a> |
                    <a href="<?= mergeQueryString(["hits" => 20], $defaultRoute) ?>">20</a>
                </p>
                <table>
                    <tr>
                        <th>Id <?= orderby("id", $defaultRoute) ?></th>
                        <th>Namn <?= orderby("name", $defaultRoute) ?></th>
                        <th>Beskrivning</th>
                        <th>Bild</th>
                        <th>Pris</th>
                        <th>Kategori</th>
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
                    <a href="<?= $app->url->create('administration/webshop/product/create') ?>">
                        <button name="button">Lägg till</button>
                    </a>
                </div>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/webshop/inventory') ?>">
                        <button name="button">Lager</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
</div>
