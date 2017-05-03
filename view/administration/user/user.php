<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Användarportal:</h1>
                <h2>Välkommen <?= esc($user->getFullName()) ?></h2>
                <p>
                Användarnamn: <?= esc($user->username) ?><br>
                Förnamn: <?= esc($user->firstname) ?><br>
                Efternamn: <?= esc($user->lastname) ?><br>
                Epost: <?= esc($user->email) ?><br>
                Level: <?= esc($user->level) ?></p>

                <p>Senast inloggad: <?= date('Y-m-d H:i:s', $lastLoggedIn) ?></p>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/user/edit') ?>"><button name="button">Redigera konto</button></a>
                </div>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/user/edit/password') ?>"><button name="button">Ändra lösenord</button></a>
                </div>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/user/admin') ?>"><button name="button">Adminportal</button></a>
                </div>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/content') ?>"><button name="button">Innehåll</button></a>
                </div>
                <div class="button button-form">
                    <a href="<?= $app->url->create('administration/webshop') ?>"><button name="button">Webshop</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
