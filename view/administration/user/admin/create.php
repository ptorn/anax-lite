<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Skapa användare</h1>
                <p><?= $error ?></p>

                <form class="admin-edit user form" action="create/process" method="post">
                    <div class="input">
                        <label><b>Användarnamn</b></label>
                        <input type="text" name="username" value="">
                    </div>
                    <div class="input">
                        <label><b>Förnamn</b></label>
                        <input type="text" name="firstname" value="">
                    </div>
                    <div class="input">
                        <label><b>Efternamn</b></label>
                        <input type="text" name="lastname" value="">
                    </div>
                    <div class="input">
                        <label><b>Epost</b></label>
                        <input type="text" name="email" value="">
                    </div>
                    <div class="input">
                        <label><b>Level</b></label>
                        <select name="level">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="input">
                        <label><b>Administrator</b></label>

                        <input type="checkbox" name="administrator">
                    </div>
                    <div class="input">
                        <label><b>Aktiverad</b></label>
                        <input type="checkbox" name="enabled">
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
                        <button type="submit">Lägg till</button>
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
