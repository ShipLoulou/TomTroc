<div class="wrapperPage">
    <h2 class="firstTitle">Mon compte</h2>

    <section class="profil">
        <div class="image">
            <?php if (!$_GET['modal']) { ?>
                <img
                    src="<?= $user->getProfilePicture() ?>"
                    alt="<?= $user->getPseudo() ?>"
                />
                <a 
                href="index.php?action=myAccount&modal=updateProfilePicture"
                aria-label="Modifier mon image de profil."
                >modifier</a>
            <?php } else {?>
                <form action="index.php?action=myAccount" method="post" class="formUpdateProfilePicture" enctype="multipart/form-data" >
                    <a 
                    href="index.php?action=myAccount"
                    aria-label="Retour"
                    >
                        <svg version="1.1" id="fi_25704" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 438.533 438.533" style="enable-background:new 0 0 438.533 438.533;" xml:space="preserve">
                            <g>
                            <path d="M409.133,109.203c-19.608-33.592-46.205-60.189-79.798-79.796C295.736,9.801,259.058,0,219.273,0
                                c-39.781,0-76.47,9.801-110.063,29.407c-33.595,19.604-60.192,46.201-79.8,79.796C9.801,142.8,0,179.489,0,219.267
                                c0,39.78,9.804,76.463,29.407,110.062c19.607,33.592,46.204,60.189,79.799,79.798c33.597,19.605,70.283,29.407,110.063,29.407
                                s76.47-9.802,110.065-29.407c33.593-19.602,60.189-46.206,79.795-79.798c19.603-33.596,29.403-70.284,29.403-110.062
                                C438.533,179.485,428.732,142.795,409.133,109.203z M365.446,237.539c0,4.948-1.808,9.236-5.421,12.847
                                c-3.621,3.614-7.898,5.431-12.847,5.431H203.855l53.958,53.958c3.429,3.425,5.14,7.703,5.14,12.847c0,5.14-1.711,9.418-5.14,12.847
                                l-25.981,25.98c-3.426,3.423-7.712,5.141-12.849,5.141c-5.136,0-9.419-1.718-12.847-5.141L102.783,258.093l-25.979-25.981
                                c-3.427-3.429-5.142-7.707-5.142-12.845c0-5.14,1.714-9.42,5.142-12.847l25.979-25.981L206.136,77.083
                                c3.428-3.425,7.707-5.137,12.847-5.137c5.141,0,9.423,1.711,12.849,5.137l25.981,25.981c3.617,3.617,5.428,7.902,5.428,12.851
                                c0,4.948-1.811,9.231-5.428,12.847l-53.958,53.959h143.324c4.948,0,9.226,1.809,12.847,5.426c3.613,3.615,5.421,7.898,5.421,12.847
                                V237.539z">
                            </path>
                        </g>
                        </svg>
                    </a>
                    <input type="file" name="profilePicture" id="profilePicture" aria-label="Sélection votre nouvelle image de profil.">
                    <input 
                    type="submit" 
                    value="confirmer" 
                    aria-label="Confirmer"
                    >
                </form>
            <?php }?>
        </div>
        <div class="dash"></div>
        <div class="name">
            <h3><?= $user->getPseudo() ?></h3>
            <p class="member">Membre depuis <?= $memberSince ?></p>
            <div class="library">
                <h4>BIBLIOTHEQUE</h4>
                <div>
                    <svg
                        width="11"
                        height="14"
                        viewBox="0 0 11 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M9.46556 0.160154L7.2112 0.00251429C6.65202 -0.0365878 6.16701 0.385024 6.12791 0.944207L5.32192 12.4705C5.28281 13.0296 5.70442 13.5147 6.26361 13.5538L8.51796 13.7114C9.07715 13.7505 9.56215 13.3289 9.60125 12.7697L10.4072 1.24345C10.4464 0.684262 10.0247 0.199256 9.46556 0.160154ZM6.84113 0.99408C6.85269 0.828798 6.99605 0.70418 7.16133 0.715737L9.41568 0.873377C9.58096 0.884935 9.70558 1.02829 9.69403 1.19357L8.88803 12.7198C8.87647 12.8851 8.73312 13.0097 8.56783 12.9982L6.31348 12.8405C6.1482 12.829 6.02358 12.6856 6.03514 12.5203L6.84113 0.99408Z"
                        fill="#292929"
                        />
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M3.27482 0.0648067H1.01496C0.454414 0.0648067 0 0.519224 0 1.07977V12.6342C0 13.1947 0.454416 13.6491 1.01496 13.6491H3.27482C3.83537 13.6491 4.28979 13.1947 4.28979 12.6342V1.07977C4.28979 0.519221 3.83537 0.0648067 3.27482 0.0648067ZM0.714965 1.07977C0.714965 0.914086 0.849279 0.779771 1.01496 0.779771H3.27482C3.44051 0.779771 3.57482 0.914086 3.57482 1.07977V12.6342C3.57482 12.7999 3.44051 12.9342 3.27482 12.9342H1.01496C0.849279 12.9342 0.714965 12.7999 0.714965 12.6342V1.07977Z"
                        fill="#292929"
                        />
                    </svg>
                    <p><?= count($booksUser) ?> livres</p>
                </div>
            </div>
        </div>
    </section>

    <section class="personalInfo">
        <h3>Vos informations personnelles</h3>
        <form action="index.php?action=myAccount" method="post">
            <div>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= $user->getEmail() ?>"/>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"  value="password"/>
            </div>
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo"  value="<?= $user->getPseudo() ?>"/>
            </div>
            <?php if ($_SESSION["error"] !== null) {
                echo "<p id='authError'>{$_SESSION['error']}</p>";
            } ?>
            <input type="text" id="formulaireSend" name="formulaireSend" value="ok" class="displayNone" aria-label="Enregistrer">
            <input class="btn-style-2" type="submit" value="Enregistrer" <?= Utils::askConfirmation("Êtes-vous sur de vouloir changer vos informations ?") ?> aria-label="Enregistrer"/>
        </form>
    </section>

    <section class="containerComment">
        <h2 class="displayNone">Article</h2>
        <div class="summary">
            <ul class="container">
                <li>PHOTO</li>
                <li>TITRE</li>
                <li>AUTEUR</li>
                <li>DESCRIPTION</li>
                <li>DISPONIBILITE</li>
                <li>ACTION</li>
            </ul>
        </div>
        <a 
        href="index.php?action=bookEdition"
        aria-label="Publier un nouveau livre."
        >
            <div class="addBook">
                <svg height="30" viewBox="0 0 32 32" width="30" fill="#a6a6a6" xmlns="http://www.w3.org/2000/svg" id="fi_2740600">
                    <g id="Layer_13" data-name="Layer 13">
                        <path d="m16 2a14 14 0 1 0 14 14 14 14 0 0 0 -14-14zm0 26a12 12 0 1 1 12-12 12 12 0 0 1 -12 12zm7-12a1 1 0 0 1 -1 1h-5v5a1 1 0 0 1 -2 0v-5h-5a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 1 1z">
                        </path>
                    </g>
                </svg>
                <p>Ajouter un article</p>
            </div>
        </a>
        <?php foreach ($booksUser as $book) { ?>
            <article class="card-style-2">
                <div class="container">
                    <img
                        src="<?= $book->getPicture() ?>"
                        alt="<?= $book->getTitle() ?>"
                    />
                    <h3><?= $book->getTitle() ?></h3>
                    <h4><?= $book->getAuthor() ?></h4>
                    <p><?= $book->getDescription() ?></p>
                    <div class="availability <?= $book->getAvailability() === true ? 'green' : 'red' ?>">
                        <?= $book->getAvailability() === true ? 'disponible' : 'non dispo.' ?>
                    </div>
                    <div class="action">
                        <a 
                        class="btn-edit" 
                        href="index.php?action=bookEdition&id=<?= $book->getBookId() ?>"
                        aria-label="Modifier le livre <?= $book->getTitle() ?>"
                        >Éditer</a>
                        <a 
                        class="btn-delete" 
                        href="index.php?action=myAccount&idDelete=<?= $book->getBookId() ?>"  
                        <?= Utils::askConfirmation("Êtes-vous sur de vouloir supprimer ce livre ?") ?>
                        aria-label="Supprimer le livre <?= $book->getTitle() ?>"
                        >Supprimer</a>
                    </div>
                </div>
            </article>
        <?php } ?>
        
    </section>
</div>