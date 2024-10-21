<section class="auth">
    <div class="left">
        <h2 class="firstTitle">Inscription</h2>
        <form action="index.php?action=singIn" method="post">
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" />
            </div>
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" />
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" />
            </div>
            <?php if ($_SESSION["error"] !== null) {
                echo "<p id='authError'>{$_SESSION['error']}</p>";
            } ?>
            <input type="text" id="formulaireSend" name="formulaireSend" value="ok" class="displayNone" aria-label="Se connecter.">
            <input class="btn-style-1" type="submit" value="S'inscrire" aria-label="Se connecter."/>
        </form>
        <div class="alreadyRegistered">
            <p>Déjà incrit ?</p>
            <a 
            href="index.php?action=logIn"
            aria-label="Redirige vers la page de connexion."
            >Connectez-vous</a>
        </div>
    </div>
    <div class="right">
    <img
        class="authImage"
        src="images/static/bannerAuth.jpeg"
        alt="bibliothèque avec plein de livre"
    />
    </div>
</section>