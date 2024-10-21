<section class="presentation">
    <div class="right">
        <img
        src="images/static/introductionPicture.jpeg"
        alt="Homme qui est assie au milieu de plein de livre et qui est entrain de lire un livre"
        />
        <p>Hamza</p>
    </div>
    <div class="left">
        <h2 class="firstTitle">Rejoignez nos lecteurs passionnés</h2>
        <p>
        Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
        </p>
        <a 
        class="btn-style-1" 
        href="index.php?action=books" 
        aria-label="Découvrir tous les livres disponibles à l'échange."
        >Découvrir</a>
    </div>
</section>

<section class="latestAddition">
    <h2 class="secondeTitle">Les derniers livres ajoutés</h2>
    <div class="container">

        <?php foreach ($books as $book) { ?>
            <a 
            href="index.php?action=singleBook&id=<?= $book->getBookId() ?>" 
            aria-label="Livre <?= $book->getTitle() ?>"
            >
                <figure class="card-style-1">
                    <img
                    src="<?= $book->getPicture() ?>"
                    alt="<?= $book->getTitle() ?>"
                    />
                    <figcaption>
                        <div>
                            <h3><?= $book->getTitle() ?></h3>
                            <p><?= $book->getAuthor() ?></p>
                        </div>

                        <?php
                        foreach ($users as $user) {
                            if ($book->getUserId() === $user->getUserId()) {
                                echo "<p>Vendu par : {$user->getPseudo()}</p>";
                            }
                        } ?>
                        
                    </figcaption>
                </figure>
            </a>
        <?php } ?>
            
    </div>
    <a 
    class="btn-style-1" 
    href="index.php?action=books"
    aria-label="Voir tous les livres."
    >Voir tous les livres</a>
</section>

<section class="howItWorks">
    <h2 class="secondeTitle">Comment ça marche ?</h2>
    <p class="subtitle">
    Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
    </p>
    <div class="container">
        <div>
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div>
            <p>
            Ajoutez les livres que vous souhaitez échanger à votre profil.
            </p>
        </div>
        <div>
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div>
            <p>
            Proposez un échange et discutez avec d'autres passionnés de lecture.
            </p>
        </div>
    </div>
    <a 
    class="btn-style-2" 
    href="index.php?action=books"
    aria-label="Voir tous les livres."
    >Voir tous les livres</a>
</section>

<section class="ourValues">
    <img
    src="images/static/bannerHomePage.jpeg"
    alt="Femme qui cherche un livre dans une bibliothèque"
    />
    <div class="container">
        <h2 class="secondeTitle">Nos valeurs</h2>
        <p>
        Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
        </p>
        <p>
        Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
        </p>
        <p>
        Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
        </p>
        <p class="signature">L’équipe Tom Troc</p>
        <svg
        width="122"
        height="104"
        viewBox="0 0 122 104"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
            <path
            d="M1 96.2224V96.2224C2.29696 95.8216 6.2879 96.4842 7.64535 96.4785C34.2391 96.3656 77.2911 74.6923 96.4064 56.0062C109.127 40.7664 119.928 7.80529 85.8057 2.24352C65.0283 -1.1431 50.1873 26.7966 62.0601 33.1465C66.0177 35.2631 78.258 25.6112 65.0283 12.4034C51.7986 -0.804455 39.7279 0.126873 35.3463 2.24352C15.417 7.74679 2.27208 42.7137 71.8127 87.7558C96.4064 103.685 121 102.996 121 102.996"
            stroke="#00AC66"
            stroke-width="2"
            stroke-linecap="round"
            />
        </svg>
    </div>
</section>