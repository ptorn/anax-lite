<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Användarportal:</h1>
                <h2>Välkommen <?= $user->getFullName() ?></h2>
                <p>
                Användarnamn: <?= $user->username ?><br>
                Förnamn: <?= $user->firstname ?><br>
                Efternamn: <?= $user->lastname ?><br>
                Epost: <?= $user->email ?><br>
                Level: <?= $user->level ?></p>

                <p>Senast inloggad: <?= date('Y-m-d H:i:s', $lastLoggedIn) ?></p>
                <div class="button-edit">
                    <a href="<?= $app->url->create('user/edit') ?>"><button name="button">Redigera konto</button></a>
                </div>
                <div class="button-password">
                    <a href="<?= $app->url->create('user/edit/password') ?>"><button name="button">Ändra lösenord</button></a>
                </div>
                <div class="button-admin">
                    <a href="<?= $app->url->create('admin') ?>"><button name="button">Adminportal</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
