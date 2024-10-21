<section class="auth">
    <div class="left">
        <h2 class="firstTitle">Connexion</h2>
        <form action="index.php?action=logIn" method="post">
            <div>
                <label for="email">Adresse email</label>
                <input type="text" id="email" name="email" />
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" />
            </div>
            <?php if ($_SESSION["error"] !== null) {
                echo "<p id='authError'>{$_SESSION['error']}</p>";
            } ?>
            <input type="text" id="formulaireSend" name="formulaireSend" value="ok" class="displayNone" aria-label="Se connecter.">
            <input class="btn-style-1" type="submit" value="Se connecter" aria-label="Se connecter."/>
        </form>
        <div class="alreadyRegistered">
            <p>Pas de compte ?</p>
            <a 
            href="index.php?action=singIn"
            aria-label="Redirige vers le formulaire d'incription."
            >Inscrivez-vous</a>
        </div>
    </div>
    <div class="right">
        <img
            class="authImage"
            src="images/static/bannerAuth.jpeg"
            alt="Bibliothèque avec beaucoup de livre."
        />
    </div>
</section>