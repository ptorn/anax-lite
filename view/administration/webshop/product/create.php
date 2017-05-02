<?php
$output = "";
$id = 1;
foreach ($categories as $category) {
    $output .= '<input type="checkbox" name="category[]" value="' . $id . '">';
    $output .= $category->category . '</br>';
    $id++;
}
?>

<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Skapa produkt</h1>
                <form class="product-create product form" action="create/process" method="post">
                    <div class="input">
                        <label><b>Namn*</b></label>
                        <input type="text" name="name" value="" required>
                    </div>
                    <div class="input">
                        <label><b>Beskrivning</b></label>
                        <textarea name="description" rows=10></textarea>
                    </div>
                    <div class="input">
                        <label><b>Bild</b></label>
                        <input type="text" name="image" value="">
                    </div>
                    <div class="input">
                        <label><b>Pris</b></label>
                        <input type="number" name="price" value="">
                    </div>
                    <div class="input">
                        <label><b>Kategorier</b></label>
                        <!-- <input type="checkbox" name="category[]" value="1">Tennis</br>
                        <input type="checkbox" name="category[]" value="2">Fotboll</br>
                        <input type="checkbox" name="category[]" value="3">Ishockey</br>
                        <input type="checkbox" name="category[]" value="4">Bollar</br> -->

                        <?= $output; ?>
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Lägg till</button>
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
