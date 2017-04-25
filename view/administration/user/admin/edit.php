<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Redigera användare:</h1>
                <h2><?= esc($user->username) ?></h2>
                <p>
                <form class="admin-edit user form" action="edit/process" method="post">
                    <div class="input">
                        <label><b>Id: <?= esc($user->id) ?></b></label>
                        <input type="hidden" name="id" value="<?= esc($user->id) ?>">
                    </div>
                    <div class="input">
                        <label><b>Användarnamn</b></label>
                        <input type="text" name="username" value="<?= esc($user->username) ?>" disabled>
                    </div>
                    <div class="input">
                        <label><b>Förnamn</b></label>
                        <input type="text" name="firstname" value="<?= esc($user->firstname) ?>">
                    </div>
                    <div class="input">
                        <label><b>Efternamn</b></label>
                        <input type="text" name="lastname" value="<?= esc($user->lastname) ?>">
                    </div>
                    <div class="input">
                        <label><b>Epost</b></label>
                        <input type="text" name="email" value="<?= esc($user->email) ?>">
                    </div>
                    <div class="input">
                        <label><b>Level</b></label>
                        <input type="text" name="level" value="<?= esc($user->level) ?>">
                    </div>
                    <div class="input">
                        <label><b>Administrator</b></label>

                        <input type="checkbox" name="administrator" <?= $user->administrator ? "checked" : "" ?>>
                    </div>
                    <div class="input">
                        <label><b>Aktiverad</b></label>
                        <input type="checkbox" name="enabled" <?= $user->enabled ? "checked" : "" ?>>
                    </div>
                    <div class="password-box">
                        <div class="input">
                            <label><b>Lösenord</b></label>
                            <input type="password" name="password" value="">
                        </div>
                        <div class="input">
                            <label><b>Bekräfta lösenord</b></label>
                            <input type="password" name="password2" value="">
                        </div>
                    </div>
                    <div class="button-form">
                        <button type="submit">Uppdatera</button>
                    </div>
                    <div class="button-form">
                        <input type="reset">
                    </div>
                </form>
                <div class="button-form">
                    <a href="<?= $app->url->create('administration/user/admin') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
