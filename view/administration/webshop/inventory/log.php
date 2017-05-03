<?php
$defaultRoute = "log?";
$output = "";
for ($x = 0; $x < count($content); $x++) {
    $output .= "<tr>";
    $output .= "<td>" . esc($content[$x]->id) . "</td>";
    $output .= "<td>" . esc($content[$x]->prod_id) . "</td>";
    $output .= "<td>" . esc($content[$x]->Name) . "</td>";
    $output .= "<td>" . esc($content[$x]->Items) . "</td>";
    $output .= "<td>" . esc($content[$x]->Occured) . "</td>";
    $output .= "</tr>";
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Lagerlogg - varning lågt saldo</h1>

                <p>Produkter per sida:
                    <a href="<?= mergeQueryString(["hits" => 5], $defaultRoute) ?>">5</a> |
                    <a href="<?= mergeQueryString(["hits" => 10], $defaultRoute) ?>">10</a> |
                    <a href="<?= mergeQueryString(["hits" => 20], $defaultRoute) ?>">20</a>
                </p>
                <table>
                    <tr>
                        <th>Id <?= orderby("id", $defaultRoute) ?></th>
                        <th>Produkt id <?= orderby("name", $defaultRoute) ?></th>
                        <th>Namn</th>
                        <th>Antal</th>
                        <th>Tidpunkt</th>
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
