<section class="booksOnExchange">
    <div class="part-Title">
        <h2 class="firstTitle">Nos livres à l’échange</h2>
        <div class="input">
            <form action="index.php?action=books" method="post">
                <input type="search" name="search" placeholder="Rechercher un livre" aria-label="Rechercher un livre"/>
                <input type="submit" value="" aria-label="Valider la recherche.">
            </form>
            <svg
                version="1.1"
                id="fi_246702"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 512 512"
                style="enable-background: new 0 0 512 512"
                xml:space="preserve"
                fill="#a6a6a6"
                >
                <g>
                    <g>
                        <path
                        d="M508.255,490.146l-128-128c-0.06-0.06-0.137-0.077-0.196-0.128c34.193-38.434,55.142-88.917,55.142-144.418
                        c0-120.175-97.425-217.6-217.6-217.6S0.001,97.425,0.001,217.6s97.425,217.6,217.6,217.6c55.501,0,105.975-20.949,144.418-55.151
                        c0.06,0.06,0.077,0.137,0.128,0.196l128,128c2.5,2.509,5.777,3.755,9.054,3.755s6.554-1.246,9.054-3.746
                        C513.247,503.253,513.247,495.147,508.255,490.146z M217.601,409.6c-105.865,0-192-86.135-192-192s86.135-192,192-192
                        s192,86.135,192,192S323.466,409.6,217.601,409.6z"
                        ></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    <div class="container">
        
        <?php if (count($books) === 0) {
            echo "<p class='errorPageBookSearch'>Aucun livre de correspond à votre recherche</p>";
        } else {
            foreach ($books as $book) { ?>
            <a 
            href="index.php?action=singleBook&id=<?= $book->getBookId() ?>"
            aria-label="<?= $book->getTitle() ?>"
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
        <?php }} ?>

    </div>
</section>