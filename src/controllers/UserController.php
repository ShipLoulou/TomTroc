<?php

class UserController
{
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
        $userManager = new UserManager();
        $users = $userManager->getAllUser();

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
            $userManager->addUser($user);

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
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

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
}