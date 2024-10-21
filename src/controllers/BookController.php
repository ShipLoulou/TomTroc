<?php

/**
 * Contrôleur de la partie book
 */

class BookController
{
    private $bookManager;
    private $userManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }
    
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        // Récupère les 4 derniers livres publiés.
        $books = $this->bookManager->getLastsBooks();

        // Récupère tous les utilisateurs.
        $users = $this->userManager->getAllUser();

        // Description de la page home (SEO).
        $description = "Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.";

        $view = new View("Accueil", $description, "page_home");
        $view->render("home", [
            'books' => $books,
            'users' => $users
        ]);
    }

    /**
     * Affiche la page books.
     * @return void
     */
    public function showBooks(): void
    {
        // Récupère tous les livres.
        $books = $this->bookManager->getAllBooks();

        // Récupère tous les utilisateurs.
        $users = $this->userManager->getAllUser();

        // Récupère le contenu saisie dans le barre de recherche
        $contentSearch = Utils::request("search");

        if (isset($contentSearch) && !empty($contentSearch)) {
            $books = $this->bookManager->getBooksAfterSearch($contentSearch);
        }

        // Description de la page home (SEO).
        $description = "Ensemble de livre à échanger.";

        $view = new View("Nos livres", $description, "page_book");
        $view->render("books", [
            'books' => $books,
            'users' => $users
        ]);
    }

    /**
     * Affiche la page singleBook.
     * Si l'utilisateur clique sur message, il est redirigé avec une conversation.
     * @return void
     */
    public function showSingleBook(): void
    {
        // Id du livre à afficher
        $bookId = filter_var(Utils::request("id", -1), FILTER_VALIDATE_INT);

        // Récupère l'id de l'utilisateur.
        $userId = filter_var($_SESSION["idUser"], FILTER_VALIDATE_INT);

        // Récupère le livre en fonction de l'id.
        $book = $this->bookManager->getBookById($bookId);

        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }

        // Récupère tous les utilisateurs.
        $users = $this->userManager->getAllUser();

        // Description de la page home (SEO).
        $description = "Livre {$book->getTitle()} de l'auteur {$book->getAuthor()}";

        $view = new View($book->getTitle(), $description, "page_singleBook");
        $view->render("singleBook", [
            'book' => $book,
            'users' => $users,
            'userId' => $userId
        ]);
    }
}