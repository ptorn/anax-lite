<?php
$output= "";
foreach ($invPositions as $shelf) {
    $output .= "<option value=\"" . $shelf->shelf . "\">" . $shelf->shelf . "</option>";
}
?>
<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Redigera product</h1>
                <form class="product-create product form" action="edit/process" method="post">
                    <div class="input">
                        <label><b>Id</b></label>
                        <input type="text" name="id" value="<?= esc($data->id) ?>" readonly>
                    </div>
                    <div class="input">
                        <label><b>Namn</b></label>
                        <input type="text" name="name" value="<?= esc($data->name) ?>" readonly>
                    </div>
                    <div class="input">
                        <label><b>Hylla</b></label>
                        <select name="shelf_id">
                            <?= $output ?>
                        </select>
                    </div>
                    <div class="input">
                        <label><b>Lagersaldo</b></label>
                        <input type="number" name="items" value="<?= esc($data->items) ?>">
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Uppdatera</button>
                    </div>
                    <div class="button-form">
                        <input type="reset">
                    </div>
                </form>

                <div class="button-form">
                    <a href="<?= $app->url->create('administration/webshop/inventory') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
