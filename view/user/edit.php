<!-- main -->
<div class="outer-wrap outer-wrap-main">
    <div class="inner-wrap inner-wrap-main">
        <div class="row">
            <main class="main">
                <h1>Redigera användare:</h1>
                <h2>Välkommen <?= $user->getFullName() ?></h2>
                <p>
                <form class="user-edit user" action="edit/process" method="post">
                    <div class="input">
                        <label><b>Användarnamn</b></label>
                        <input type="text" name="username" value="<?= $user->username ?>" disabled>
                    </div>
                    <div class="input">
                        <label><b>Förnamn</b></label>
                        <input type="text" name="firstname" value="<?= $user->firstname ?>">
                    </div>
                    <div class="input">
                        <label><b>Efternamn</b></label>
                        <input type="text" name="lastname" value="<?= $user->lastname ?>">
                    </div>
                    <div class="input">
                        <label><b>Epost</b></label>
                        <input type="text" name="email" value="<?= $user->email ?>">
                    </div>
                    <button type="submit" name="button">Uppdatera</button>

            </main>
        </div>
    </div>
</div>
