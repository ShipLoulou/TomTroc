<section class="book">
    <div class="right">
        <div class="info">
            <h2 class="firstTitle"><?= $book->getTitle() ?></h2>
            <div>
                <p class="author"><?= $book->getAuthor() ?></p>
                <div class="dash"></div>
            </div>
            <h3>DESCRIPTION</h3>
            <p>
                <?= Utils::format($book->getDescription()) ?>
            </p>
            <h3>PROPRIÉTAIRE</h3>
            <figure>
                <?php foreach ($users as $user) {
                    if ($book->getUserId() === $user->getUserId()) { ?>
                    <a 
                    href="index.php?action=<?= $user->getUserId() !== $userId ? 'publicAccount&id=' . $user->getUserId() : 'myAccount' ?>"
                    aria-label="Redirection vers le profil de <?= $user->getPseudo() ?>"
                    >
                        <img
                        src="<?= $user->getProfilePicture() ?>"
                        alt="<?= $user->getPseudo() ?>"
                        />
                        <figcaption><?= $user->getPseudo() ?></figcaption>
                    </a>
                <?php }} ?>
            </figure>
        </div>
        <a 
        href= "<?= $book->getUserId() !== $userId ? $urlMessage : '#' ?>"
        aria-label="Envoyer un message au propriétaire du livre."
        class="btn-style-1"
        >Envoyer un message</a>
    </div>
    <div class="left">
    <img
        src="<?= $book->getPicture() ?>"
        alt="<?= $book->getTitle() ?>"
        class="cover"
    />
    </div>
</section>