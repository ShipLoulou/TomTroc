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

        // Url de redirection du button message.
        $urlMessage = null;

        if ($userId) {
            // Récupère les conversations de l'utilisateur.
            // Si une conversation est déjà existante entre les utilisateurs, l'url va nous redirigé vers celle-ci.
            $conversationManager = new ConversationManager();
            $conversations = $conversationManager->getAllConversationOfUser($userId);

            $listInterlocutor = [];
            $index = 0;

            foreach ($conversations as $conversation) {
                if ($conversation->getUserAtInitiativeOfRequest() === $book->getUserId()) {
                    $urlMessage = "index.php?action=messaging&id={$book->getUserId()}&conv={$conversation->getConversationId()}#scroolBottom";

                } elseif ($conversation->getUserWhoReceivesRequest() === $book->getUserId()) {
                    $urlMessage = "index.php?action=messaging&id={$book->getUserId()}&conv={$conversation->getConversationId()}#scroolBottom";
                }
                $index++;
            }
        }

        // Si la conversation n'existe pas, l'url nous redirige avec le lien d'une nouvelle conversation.
        if (!$urlMessage) {
            $urlMessage = "index.php?action=messaging&id={$book->getUserId()}&conv={$userId}{$book->getUserId()}&new=new#scroolBottom";
        }

        // Description de la page home (SEO).
        $description = "Livre {$book->getTitle()} de l'auteur {$book->getAuthor()}";

        $view = new View($book->getTitle(), $description, "page_singleBook");
        $view->render("singleBook", [
            'book' => $book,
            'users' => $users,
            'userId' => $userId,
            'urlMessage' => $urlMessage
        ]);
    }

    /**
     * Affiche la page bookEdition.
     * Permet d'ajouter un nouveau livre ou de le mettre à jour.
     * @return void
     */
    public function showBookEdition()
    {
        // Récupère l'id de l'utilisateur.
        $userId = filter_var($_SESSION['idUser'], FILTER_VALIDATE_INT);

        // Supprime des données $_SESSION 'error' et 'verificationInfoUser' à chaque actualiation.
        unset($_SESSION['error']);
        unset($_SESSION['verificationInfoUser']);

        // Récupère les données du formualaires.
        $title = filter_var(Utils::request("title"), FILTER_SANITIZE_STRING);
        $author = filter_var(Utils::request("author"), FILTER_SANITIZE_STRING);
        $description = Utils::request("description");
        $availability = Utils::request("availability");
        $bookPicture = $_FILES["bookPicture"];

        // Transforme la valeur du champs dispobibilité ($availability) : TRUE => 1, FALSE => 0.
        if ($availability) {
            $availabilityBool = match ($availability) {
                'available' => 1,
                'notAvailable' => 0,
            };
        }

        // Renomme et télécharge l'image inséré dans le champs $bookPicture.
        if ($bookPicture && !empty($bookPicture['name'])) {
            $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
            $file_extension = pathinfo($bookPicture['name'], PATHINFO_EXTENSION);

            $file_basename = pathinfo($bookPicture['name'], PATHINFO_FILENAME);

            if (!in_array($file_extension, $allowedExtensions)) {
                throw new Exception("Type de fichier invalide");
            }

            $new_image_name = $file_basename . '_bookPicture_' . $userId . '_' . date("Ymd_His") . '.' . $file_extension;
            $target_directory = 'images/bookPicture/';
            $targer_path = $target_directory . $new_image_name;
            move_uploaded_file($bookPicture['tmp_name'], $targer_path);
        } else {
            // Image émis par défault si aucune image n'ai importée.
            $targer_path = 'images/static/bookPictureDefault.webp';
        }

        // Gestion des messages d'erreur.
        $errorMessage = null;

        $outputError = match (true) {
            empty($title)
            || empty($author)
            || empty($description)
            || $availabilityBool === null  => "Tous les champs sont obligatoires",
            strlen($description) < 20  => "Le pseudo doit avoir au minimun 20 caractères",
            default => null
        };

        $errorMessage = $outputError;

        if ($_POST['formulaireSend'] === 'ok') {
            if ($errorMessage !== null) {
                $_SESSION['error'] = $errorMessage;
            } else {
                unset($_SESSION['error']);
                $_SESSION['verificationInfoUser'] = true;
            }
        }

        if ($_GET['id']) {
            // Récupère l'id du livre à modifier
            $bookId = (int)$_GET['id'];
            // Récupère les informations du livre à modifier
            $book = $this->bookManager->getBookById($bookId);
        }

        if ($_SESSION['verificationInfoUser'] === true) {

            if ($_GET['id']) {
                // Modifie les informations du livre.
                $updateBook = new Book([
                    'title' => strip_tags($title),
                    'author' => strip_tags($author),
                    'description' => strip_tags($description),
                ]);

                $this->bookManager->updateBook($updateBook, $bookId, $availabilityBool);
            } else {
                // Créer un livre.
                $book = new Book([
                    'picture' => $targer_path,
                    'title' => strip_tags($title),
                    'author' => strip_tags($author),
                    'description' => strip_tags($description),
                    'user_id' => strip_tags($userId)
                ]);
                $this->bookManager->addBook($book, $availabilityBool);
            }

            Utils::redirect("myAccount");
        }

        // Renomme et télécharge l'image inséré dans le champs $_FILES.
        if ($_FILES && !empty($bookPicture['name'])) {
            $allowedExtensions = ['jpg', 'png', 'jpeg', 'webp'];
            $file_extension = pathinfo($_FILES['updatePicture']['name'], PATHINFO_EXTENSION);

            $file_basename = pathinfo($_FILES['updatePicture']['name'], PATHINFO_FILENAME);

            if (!in_array($file_extension, $allowedExtensions)) {
                throw new Exception("Type de fichier invalide");
            }

            $new_image_name = $file_basename . '_bookPicture_' . $userId . '_' . date("Ymd_His") . '.' . $file_extension;

            $target_directory = 'images/bookPicture/';
            $targer_path = $target_directory . $new_image_name;
            $test = move_uploaded_file($_FILES['updatePicture']['tmp_name'], $targer_path);
            $this->bookManager->updateBookPicture($targer_path, $bookId);

            Utils::redirect("bookEdition&id={$_GET['id']}");
        }

        // Description de la page home (SEO).
        $description = "Modification du livre.";

        $view = new View("Edition livre", $description, "page_bookEdition");
        $view->render("bookEdition", [
            'book' => $book
        ]);
    }
}