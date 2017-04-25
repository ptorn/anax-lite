<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Ändra lösenord</h1>
                <p><?= $error ?></p>
                <form class="user-password user form" action="password/process" method="post">
                    <div class="input">
                        <label><b>Lösenord</b></label>
                        <input type="password" name="password" value="">
                    </div>
                    <div class="input">
                        <label><b>Bekräfta lösenord</b></label>
                        <input type="password" name="password2" value="">
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Uppdatera</button>
                    </div>
                    <div class="button-form">
                        <input type="reset">
                    </div>
                </form>
                <div class="button-form">
                    <a href="<?= $app->url->create('administration/user') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
