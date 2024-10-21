<?php

session_start();

define('TEMPLATE_VIEW_PATH', 'src/views/templates/'); // Le chemin vers les templates de vues.
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // Le chemin vers le template principal.

// Paramètres pour accéder à la base de donnée.
define('DB_HOST', 'localhost');
define('DB_NAME', 'tom_troc');
define('DB_USER', 'root');
define('DB_PASS', '');

// Gestion des message d'erreur (utils uniquement au développement).
set_error_handler(function (int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);
