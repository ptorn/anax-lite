<?php
$defaultRoute = "admin?";
$output = "";
for ($x = 0; $x < count($users); $x++) {
    $output .= "<tr>";
    $output .= "<td>" . $users[$x]->id . "</td>";
    $output .= "<td>" . $users[$x]->username . "</td>";
    $output .= "<td>" . $users[$x]->firstname . "</td>";
    $output .= "<td>" . $users[$x]->lastname . "</td>";
    $output .= "<td>" . $users[$x]->email . "</td>";
    $output .= "<td>" . $users[$x]->level . "</td>";
    $output .= "<td>" . $users[$x]->administrator . "</td>";
    $output .= "<td>" . $users[$x]->enabled . "</td>";
    $output .= "<td><a href=\"admin/edit?id=" . $users[$x]->id . "\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>
</a></td>";
    $output .= "<td><a href=\"admin/delete?id=" . $users[$x]->id . "\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></td>";
    $output .= "</tr>";
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Adminportal:</h1>
                <h2>Välkommen <?= $user->getFullName() ?></h2>
                <form class="admin-search" action="admin" method="get">
                    <div class="input">
                        <label><b>Sök</b></label>
                        <input type="hidden" name="route" value="search">

                        <input type="text" name="keyword" value="<?= htmlentities(getGet('keyword')) ?>">
                    </div>
                    <button type="submit">Sök</button>
                </form>
                <p>Användare per sida:
                    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
                    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
                    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
                </p>
                <table>
                    <tr>
                        <th>Id <?= orderby("id", $defaultRoute) ?></th>
                        <th>Användare <?= orderby("username", $defaultRoute) ?></th>
                        <th>Förnamn <?= orderby("firstname", $defaultRoute) ?></th>
                        <th>Efternamn <?= orderby("lastname", $defaultRoute) ?></th>
                        <th>Epost</th>
                        <th>Level</th>
                        <th>Admin</th>
                        <th>Aktiverad</th>
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
                <div class="button-admin">
                    <a href="<?= $app->url->create('user') ?>"><button name="button">Användarportal</button></a>
                </div>
                <div class="button-admin">
                    <a href="<?= $app->url->create('admin/create') ?>">
                        <button name="button">Lägg till användare</button>
                    </a>
                </div>
            </main>
        </div>
    </div>
</div>
