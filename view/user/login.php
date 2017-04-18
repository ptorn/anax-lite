<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Logga in</h1>
                <?= $status ?>
                <form class="user-login user" method="post">
                    <div class="input">
                        <label><b>Användarnamn</b></label>
                        <input type="username" name="username" value="">
                    </div>
                    <div class="input">
                        <label><b>Lösenord</b></label>
                        <input type="password" name="password" value="">
                    </div>
                    <button type="submit" name="button">Login</button>
                </form>
                <div class="button-create">
                    <a href="<?= $app->url->create('user/create') ?>"><button name="button">Skapa konto</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
