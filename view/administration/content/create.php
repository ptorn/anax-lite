<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Skapa innehåll</h1>
                <form class="content-create content form" action="create/process" method="post">
                    <div class="input">
                        <label><b>Titel*</b></label>
                        <input type="text" name="title" value="" required>
                    </div>
                    <div class="input">
                        <label><b>Path</b></label>
                        <input type="text" name="path" value="">
                    </div>
                    <div class="input">
                        <label><b>Slug</b></label>
                        <input type="text" name="slug" value="">
                    </div>
                    <div class="input">
                        <label><b>Text</b></label>
                        <textarea name="data" rows=10></textarea>
                    </div>
                    <div class="input">
                        <label><b>Type</b></label>
                        <select name="type">
                            <option value="page">Sida</option>
                            <option value="post">Bloggpost</option>
                            <option value="block">Block</option>
                        </select>
                    </div>
                    <div class="input">
                        <label><b>Filter</b></label>
                        <input type="text" name="filter" value="">
                    </div>
                    <div class="input">
                        <label><b>Publicerad</b></label>
                        <input type="text" name="published" value="">
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Lägg till</button>
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
