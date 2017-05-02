<!-- main -->
<?php
$catArray = explode(',', $data->category);
$output = "";
foreach ($categories as $category) {
    $output .= '<input type="checkbox" name="category[]" value="' . $category->id . '"';
    $output .= in_array($category->category, $catArray) ? " checked" : "";
    $output .=  '>';
    $output .= $category->category . '</br>';
}
?>
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Redigera product</h1>
                <form class="product-create product form" action="edit/process" method="post">
                    <input type="hidden" name="id" value="<?= esc($data->id) ?>">
                    <div class="input">
                        <label><b>Namn*</b></label>
                        <input type="text" name="name" value="<?= esc($data->name) ?>" required>
                    </div>
                    <div class="input">
                        <label><b>Beskrivning</b></label>
                        <textarea name="description" rows=10><?= esc($data->description) ?></textarea>
                    </div>
                    <div class="input">
                        <label><b>Bild</b></label>
                        <input type="text" name="image" value="<?= esc($data->image) ?>">
                    </div>
                    <div class="input">
                        <label><b>Pris</b></label>
                        <input type="number" name="price" value="<?= esc($data->price) ?>">
                    </div>
                    <div class="input">
                        <label><b>Kategorier</b></label>
                        <?= $output; ?>
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Uppdatera</button>
                    </div>
                    <div class="button-form">
                        <input type="reset">
                    </div>
                </form>

                <div class="button-form">
                    <a href="<?= $app->url->create('administration/webshop') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
