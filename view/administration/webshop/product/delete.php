<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Radera product</h1>
                <form method="post">
                    <fieldset>
                    <legend>Radera</legend>

                    <input type="hidden" name="id" value="<?= esc($data->id) ?>"/>

                    <p>
                        <label>Namn:<br>
                            <input type="text" name="name" value="<?= esc($data->name) ?>" readonly/>
                        </label>
                    </p>

                    <p>
                        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Radera</button>
                    </p>
                    </fieldset>
                </form>
            </main>
        </div>
    </div>
</div>
