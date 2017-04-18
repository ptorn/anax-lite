<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Skapa användare</h1>
                <p><?= $error ?></p>

                <form class="admin-edit user" action="create/process" method="post">
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
                        <input type="text" name="level" value="">
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
                    <button type="submit">Lägg till</button>


                </form>
                <div class="button-create-back">
                    <a href="<?= $app->url->create('admin') ?>"><button name="button">Tillbaka</button></a>
                </div>
            </main>
        </div>
    </div>
</div>
