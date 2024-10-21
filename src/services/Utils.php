<?php

class Utils
{
    /**
     * Cette méthode permet de compter le nombre de jour entre la date de création du compte et la date d'aujourd'hui.
     * @param string $start : la date de création du compte
     * @param string $end : la date d'aujourd'hui
     * @return int : la nombre de jour qui c'est écoulé depuis la création du compte
     */
    public static function CountNumberOfDays(string $start, string $end): int
    {
        // Division de la date exemple
        // Si $start = "2024-10-16", alors :
        //      •$tSta[0] = 2024 (année),
        //      •$tSta[1] = 10 (mois),
        //      •$tSta[2] = 16 (jour).
        $tSta = explode("-", $start);
        $tEnd = explode("-", $end);

        // Convertir les dates de début et de fin en timestamps Unix
        $diff = mktime(0, 0, 0, $tEnd[1], $tEnd[2], $tEnd[0]) -
                mktime(0, 0, 0, $tSta[1], $tSta[2], $tSta[0]);

        // Nombre de secondes dans une journée
        $secondPerDay = 86400;

        // Le +1 est ajouté pour inclure à la fois la date de début et la date de fin dans le calcul
        return(($diff / $secondPerDay) + 1);
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable.
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string): string
    {
        // Etape 1, on protège le texte avec htmlspecialchars.
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Etape 2, le texte va être découpé par rapport aux retours à la ligne,
        $lines = explode("\n", $finalString);

        // On reconstruit en mettant chaque ligne dans un paragraphe (et en sautant les lignes vides).
        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }

        return $finalString;
    }
    
    /**
     * Vérifie que les données saisies par un utilisateur soit correctes
     * @param string $pseudo : le pseudo saisie par l'utilisateur
     * @param string $email : l'email saisie par l'utilisateur
     * @param string $password : le password saisie par l'utilisateur
     * @param array $users : l'ensemble des utilisateurs
     * @return void
     */
    public static function verificationInfoUser(string $pseudo, string $email, string $password, array $users, ?bool $passwordTreatment, ?bool $emailTreatment, ?bool $pseudoTreatment)
    {
        // Vérifie la validité du mot de passe
        $checkPassword;

        if ($passwordTreatment) {
            if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(\w|[!@#$%]).{4,8}$/", $password)) {
                $checkPassword = true;
            } else {
                $checkPassword = false;
            }
        } else {
            $checkPassword = true;
        }

        // Vérifie que les données saisies soient correctes, si non, un message d'erreur est revoyer
        $errorMessage = null;

        $returnsError = match (true) {
            empty($pseudo)
            || empty($email)
            || empty($password) => $errorMessage = "Tous les champs sont obligatoires",
            strlen($pseudo) < 4  => $errorMessage = "Le pseudo doit avoir au minimun 4 caractères",
            $checkPassword === false => $errorMessage = "Le mot de passe doit avoir 1 majuscule, 1 minuscule, un nombre et doit contenir entre 6 à 13 caractères",
            default => null
        };

        foreach ($users as $user) {
            if ($pseudoTreatment && $user->getPseudo() === $pseudo) {
                $errorMessage = "Le pseudo est déjà utilisé";
                break;
            } elseif ($emailTreatment && $user->getEmail() === $email) {
                $errorMessage = "L'email est déjà utilisé";
            }
        }

        // Affiche les messages d'erreurs
        if ($errorMessage !== null && $_POST['formulaireSend'] === 'ok') {
            $_SESSION['error'] = $errorMessage;
        } else {
            unset($_SESSION['error']);
            $_SESSION['verificationInfoUser'] = true;
        }
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []): void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }
}