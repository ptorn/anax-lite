<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Logga in</h1>
                <?= $status ?>
                <form class="user-login user form" method="post">
                    <div class="input">
                        <label><b>Användarnamn</b></label>
                        <input type="username" name="username" value="">
                    </div>
                    <div class="input">
                        <label><b>Lösenord</b></label>
                        <input type="password" name="password" value="">
                    </div>
                    <div class="button-form">
                        <button type="submit" name="button">Login</button>
                    </div>
                </form>
                <div class="button-form">
                    <a href="<?= $app->url->create('administration/create') ?>"><button name="button">Skapa konto</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
