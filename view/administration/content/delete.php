<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Radera innehåll</h1>
                <form method="post">
                    <fieldset>
                    <legend>Radera</legend>

                    <input type="hidden" name="id" value="<?= esc($data->id) ?>"/>

                    <p>
                        <label>Titel:<br>
                            <input type="text" name="title" value="<?= esc($data->title) ?>" readonly/>
                        </label>
                    </p>

                    <p>
                        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </p>
                    </fieldset>
                </form>
            </main>
        </div>
    </div>
</div>
