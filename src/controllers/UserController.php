<?php

class UserController
{
    private $bookManager;
    private $userManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
    }

    /**
     * Inscription de l'utilisateur.
     * @return void
     */
    public function signIn(): void
    {
        // Supprime des données $_SESSION 'error' et 'verificationInfoUser' à chaque actualiation.
        unset($_SESSION['error']);
        unset($_SESSION['verificationInfoUser']);

        // Récupère les données du formualaires
        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");
        $profilePicture = "images/static/profilePictureDefault.png";

        // Récupère tous les utilisateurs.
        $users = $this->userManager->getAllUser();

        // Vérifie que les données de l'utilisateur soit correctes
        if ($pseudo !== null && $email !== null && $password !== null && $users !== null) {
            $errorMessage = Utils::verificationInfoUser($pseudo, $email, $password, $users, true, true, true);
        }

        if ($_SESSION['verificationInfoUser'] === true) {
            unset($_SESSION['error']);
            unset($_SESSION['verificationInfoUser']);

            $user = new User([
                'pseudo' => strip_tags($pseudo),
                'email' => strip_tags($email),
                'password' => strip_tags($password),
                'profilePicture' => strip_tags($profilePicture)
            ]);
            $this->userManager->addUser($user);

            Utils::redirect("logIn");
        }

        // Description de la page home (SEO).
        $description = "Page d'inscription du site TomTroc.";

        $view = new View("Inscription", $description, "page_auth");
        $view->render("singIn");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function logIn(): void
    {
        // Supprime des données $_SESSION 'error' et 'verificationInfoUser' à chaque actualiation.
        unset($_SESSION['error']);
        unset($_SESSION['verificationInfoUser']);

        // Récupère les données du formualaires.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // Récupère tous les utilisateurs.
        $user = $this->userManager->getUserByEmail($email);

        // Gestion des erreurs.
        $errorMessage;

        if (!$user) {
            $errorMessage = "L'utilisateur demandé n'existe pas.";
        }

        $outputError = match (true) {
            empty($email)
            || empty($password) => "Tous les champs sont obligatoires",
            default => null
        };

        if ($outputError) {
            $errorMessage = "Tous les champs sont obligatoires";
        }

        if ($user) {
            if (!password_verify($password, $user->getPassword())) {
                $errorMessage = "Le mot de passe est incorrect.";
            } else {
                $_SESSION['user'] = $user;
                $_SESSION['idUser'] = $user->getUserId();
                Utils::redirect("home");
            }
        }

        if ($errorMessage !== null && $_POST['formulaireSend'] === 'ok') {
            $_SESSION['error'] = $errorMessage;
        } else {
            unset($_SESSION['error']);
            $_SESSION['verificationInfoUser'] = true;
        }

        // Description de la page home (SEO).
        $description = "Page de connexion du site TomTroc.";

        $view = new View("Connexion", $description, "page_auth");
        $view->render("logIn");
    }

        
    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function logOut(): void
    {
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);
        Utils::redirect("home");
    }

    /**
     * Affiche la page myAccount.
     * Permet la modification des informations de l'utilisateur.
     * @return void
     */
    public function showMyAccount(): void
    {
        // On vérifie que l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // Supprime des données $_SESSION 'error' et 'verificationInfoUser' à chaque actualiation.
        unset($_SESSION['error']);
        unset($_SESSION['verificationInfoUser']);

        // Récupère l'id de l'utilisateur.
        $userId = filter_var($_SESSION["idUser"], FILTER_VALIDATE_INT);

        // On récupère les données de l'utilisateur connecté.
        $user = $this->userManager->getUserById($userId);

        // On récupère le nomnbre de jours depuis l'inscription de l'utilisateur.
        $numberOfDay = $user->getRegistrationDate();
        $memberSince = Utils::memberSince($numberOfDay);

        // On récupère les livres associés à l'utilisateur connecté.
        $booksUser = $this->bookManager->getBooksWithUserId($userId);

        // vvv Gestion modification des données de l'utilisateur. vvv

        // On récupère les informations du formulaire.
        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");

        if ($_POST['formulaireSend'] === 'ok') {
            if ($password !== 'password') {
                $passwordTreatment = true;
            } else {
                $password = $user->getPassword();
            }

            if ($email !== $user->getEmail()) {
                $emailTreatment = true;
            }

            if ($pseudo !== $user->getPseudo()) {
                $pseudoTreatment = true;
            }
        }

        $users = $this->userManager->getAllUser();

        if ($pseudo !== null && $email !== null && $password !== null && $users !== null) {
            $errorMessage = Utils::verificationInfoUser($pseudo, $email, $password, $users, $passwordTreatment, $emailTreatment, $pseudoTreatment);
        }

        if ($_SESSION['verificationInfoUser'] === true) {
            unset($_SESSION['error']);
            unset($_SESSION['verificationInfoUser']);

            $updateUser = new User([
                'pseudo' => strip_tags($pseudo),
                'email' => strip_tags($email),
                'password' => strip_tags($password),
            ]);

            $this->userManager->updateUser($updateUser, $userId);
            Utils::redirect("myAccount");
        }

        // Renomme et télécharge l'image inséré dans le champs $_FILES.
        if ($_FILES) {
            // $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $file_basename = pathinfo($_FILES['profilePicture']['name'], PATHINFO_FILENAME);
            $file_extension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
            $new_image_name = $file_basename . '_profilePicture_' . date("Ymd_His") . '.' . $file_extension;

            $target_directory = 'images/profilePicture/';
            $targer_path = $target_directory . $new_image_name;
            $test = move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targer_path);
            $this->userManager->updateProfilePicture($targer_path, $userId);

            Utils::redirect("myAccount");
        }

        // Récupère l'id du livre à supprimer.
        $bookIdDelete = filter_var(Utils::request("idDelete", -1), FILTER_VALIDATE_INT);

        if ($bookIdDelete !== -1) {
            // On supprime l'article.
            $this->bookManager->deleteBook($bookIdDelete);

            // On redirige vers la page d'administration.
            Utils::redirect("myAccount");
        }

        // Description de la page home (SEO).
        $description = "Profil de {$user->getPseudo()}";

        $view = new View("Mon compte", $description, "page_myAccount");
        $view->render("myAccount", [
            'user' => $user,
            'booksUser' => $booksUser,
            'memberSince' => $memberSince
        ]);
    }

    /**
     * Affiche la page publicAccount.
     * @return void
     */
    public function showPublicAccount(): void
    {
        // Récupère l'id de l'utilisateur connecté.
        $myUserId = filter_var($_SESSION["idUser"], FILTER_VALIDATE_INT);

        // Récupère l'id de l'utilisateur visité.
        $userId = (int)Utils::request("id", -1);

        // On récupère les informations de l'utilisateur.
        $user = $this->userManager->getUserById($userId);

        if (!$user) {
            throw new Exception("L'utilisateur demander n'existe pas.");
        }

        // On récupère les livres de l'utilisateur
        $booksUser = $this->bookManager->getBooksWithUserId($userId);

        // On récupère le nomnbre de jours depuis l'inscription de l'utilisateur.
        $numberOfDay = $user->getRegistrationDate();
        $memberSince = Utils::memberSince($numberOfDay);

        // Description de la page home (SEO).
        $description = "Profil de {$user->getPseudo()}";

        $view = new View($user->getPseudo(), $description, "page_publicAccount");
        $view->render("publicAccount", [
            'user' => $user,
            'booksUser' => $booksUser,
            'memberSince' => $memberSince
        ]);
    }
}