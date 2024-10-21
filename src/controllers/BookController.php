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
}