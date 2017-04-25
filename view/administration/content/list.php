<?php
$defaultRoute = "content?";
$output = "";
for ($x = 0; $x < count($content); $x++) {
    $output .= "<tr>";
    $output .= "<td>" . $x . "</td>";
    $output .= "<td>" . $content[$x]->id . "</td>";
    $output .= "<td>" . $content[$x]->title . "</td>";
    $output .= "<td>" . $content[$x]->type . "</td>";
    $output .= "<td>" . $content[$x]->published . "</td>";
    $output .= "<td>" . $content[$x]->created . "</td>";
    $output .= "<td>" . $content[$x]->updated . "</td>";
    $output .= "<td>" . $content[$x]->deleted . "</td>";
    $output .= "<td><a href=\"content/edit?id=" . $content[$x]->id . "\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>
</a></td>";
    $output .= "<td><a href=\"content/delete?id=" . $content[$x]->id . "\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></td>";
    $output .= "</tr>";
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Innehåll</h1>

                <p>Innehåll per sida:
                    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
                    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
                    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
                </p>
                <table>
                    <tr>
                        <th>Rad</th>
                        <th>Id <?= orderby("id", $defaultRoute) ?></th>
                        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
                        <th>Typ</th>
                        <th>Publicerad</th>
                        <th>Skapad</th>
                        <th>Uppdaterad</th>
                        <th>Raderad</th>
                        <th>Redigera</th>
                        <th>Radera</th>
                    </tr>
                    <?= $output; ?>
                </table>
                <p>
                    Sida:
                    <?php for ($i = 1; $i <= $max; $i++) : ?>
                        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </p>
                <div class="button button-content">
                    <a href="<?= $app->url->create('administration/content/create') ?>">
                        <button name="button">Skapa</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
</div>
