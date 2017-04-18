<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Skapa användare</h1>
                <form class="user-password user" action="password/process" method="post">
                    <div class="input">
                        <label><b>Lösenord</b></label>
                        <input type="password" name="password" value="">
                    </div>
                    <div class="input">
                        <label><b>Bekräfta lösenord</b></label>
                        <input type="password" name="password2" value="">
                    </div>
                    <button type="submit" name="button">Uppdatera</button>

                    <p><?= $error ?></p>

                </form>

            </main>
        </div>
    </div>
</div>
