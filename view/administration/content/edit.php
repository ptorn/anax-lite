<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Redigera innehåll</h1>
                <form class="content-create content form" action="edit/process" method="post">
                    <input type="hidden" name="id" value="<?= esc($data->id) ?>">
                    <div class="input">
                        <label><b>Titel</b></label>
                        <input type="text" name="title" value="<?= $data->title ?>">
                    </div>
                    <div class="input">
                        <label><b>Path</b></label>
                        <input type="text" name="path" value="<?= $data->path ?>">
                    </div>
                    <div class="input">
                        <label><b>Slug</b></label>
                        <input type="text" name="slug" value="<?= $data->slug ?>">
                    </div>
                    <div class="input">
                        <label><b>Text</b></label>
                        <textarea name="data" id="data"><?= esc($data->data) ?></textarea>
                    </div>
                    <div class="input">
                        <label><b>Type</b></label>
                        <select name="type">
                            <option value="page" <?= $data->type == "page" ? "Selected" : null; ?>>Sida</option>
                            <option value="post" <?= $data->type == "post" ? "Selected" : null; ?>>Bloggpost</option>
                            <option value="block" <?= $data->type == "block" ? "Selected" : null; ?>>Block</option>
                        </select>
                    </div>
                    <div class="input">
                        <label><b>Filter</b></label>
                        <input type="text" name="filter" value="<?= $data->filter ?>">
                    </div>
                    <div class="input">
                        <label><b>Publicerad</b></label>
                        <input type="text" name="published" value="<?= $data->published ?>">
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Uppdatera</button>
                    </div>
                    <div class="button-form">
                        <input type="reset">
                    </div>
                </form>
                <div class="button-form">
                    <a href="<?= $app->url->create('administration/content') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
