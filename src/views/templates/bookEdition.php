<section class="wrapperPage">
    <a 
    href="index.php?action=myAccount"
    aria-label="Retour sur votre compte."
    >&lt;- retour</a>
    <h2><?= !$_GET['id'] ? 'Ajouter un livre' : 'Modifier les informations' ?></h2>
    <div class="infoBook <?= !$_GET['id'] ? 'justifyHeight' : '' ?>">
        <?php if ($_GET['id']) {
            if (!$_GET['modal']) { ?>
            <div class="left">
                <div class="container">
                    <p>Photo</p>
                    <img
                    src="<?= $book ? $book->getPicture() : '' ?>"
                    alt="<?= $book ? $book->getTitle() : '' ?>"
                    />
                    <a 
                    href="index.php?action=bookEdition&id=<?= $_GET['id'] ?>&modal=updatePicture"
                    class="btnEditPage"
                    >Modifier la photo</a>
                </div>
            </div>
            <?php } else { ?>
            <form action="index.php?action=bookEdition&id=<?= $_GET['id'] ?>" method="post" class="formUpdatePicture" enctype="multipart/form-data" >
                <a 
                href="index.php?action=bookEdition&id=<?= $_GET['id'] ?>"
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
                <input type="file" name="updatePicture" id="updatePicture" aria-label="Sélection votre nouvelle image du livre.">
                <input type="submit" value="confirmer" <?= Utils::askConfirmation("Êtes-vous sur de vouloir modifier l'image de ce livre ?") ?> aria-label="Confirmer">
            </form>
        <?php }
            } ?>
        <div class="right">
        <form action="#" method="post" enctype="multipart/form-data" class="<?= !$_GET['id'] ? 'displayFlexAlign' : '' ?>">
            <div>
                <label for="title">Titre</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    <?php if ($book) {
                        echo "value='{$book->getTitle()}'";
                    } ?>
                />
            </div>
            <div>
                <label for="author">Auteur</label>
                <input 
                    type="text" 
                    id="author" 
                    name="author"
                    <?php if ($book) {
                        echo "value='{$book->getAuthor()}'";
                    } ?>
                />
            </div>
            <div>
                <label for="description">Commentaire</label>
                <textarea 
                    name="description" 
                    id="description"
                    maxlength="990"
                ><?php if ($book) {
                    echo "{$book->getDescription()}";
                } ?></textarea>
            </div>
            <div>
                <label for="availability">Disponibilité</label>
                <select name="availability" id="availability">
                    <?php if ($book) {
                        if ($book->getAvailability() === true) {
                            echo "<option value='available'>disponible</option>";
                            $optionAvailable = true;
                        } elseif ($book->getAvailability() === false) {
                            echo "<option value='notAvailable'>non disponible</option>";
                            $optionNotAvailable = true;
                        }
                    } ?>
                    <?php if (!$book) { ?>
                        <option value="">--Choisir la disponibilité--</option>
                    <?php } ?>
                    <?php
                    if (!$optionAvailable) { ?>
                        <option value="available">disponible</option>
                    <?php } ?>
                    <?php if (!$optionNotAvailable) { ?>
                        <option value="notAvailable">non disponible</option>
                    <?php } ?>
                </select>
            </div>
            <?php if (!$_GET['id']) {
                echo "<input type='file' name='bookPicture' id='bookPicture' class='alignSelf' aria-label='Sélection un image du livre.'>";
            } ?>
            <?php if ($_SESSION["error"] !== null) {
                echo "<p id='authError' class='errorFormEditBook'>{$_SESSION['error']}</p>";
            } ?>
            <input type="text" id="formulaireSend" name="formulaireSend" value="ok" class="displayNone" aria-label="Confirmer">
            <input class="btn-style-1 <?= !$_GET['id'] ? 'alignSelfMargin' : ''?>" type="submit" value="Valider" <?= $_GET['id'] ? Utils::askConfirmation("Êtes-vous sur de vouloir modifier les informations de ce livre ?") : '' ?> aria-label="Confirmer"/>
        </form>
        </div>
    </div>
</section>