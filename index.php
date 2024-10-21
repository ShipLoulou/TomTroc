<?php

require_once 'src/config/config.php';
require_once 'src/config/autoload.php';

$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'singleBook':
            $bookController = new BookController();
            $bookController->showSingleBook();
            break;
        
        default:
            throw new Exception("La page demandée n'existe pas.");
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}