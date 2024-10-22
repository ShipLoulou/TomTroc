<?php

require_once 'src/config/config.php';
require_once 'src/config/autoload.php';

$action = Utils::request('action', 'home');

$cleaning = new Cleaning;
$cleaning->deleteUnusedImage();

try {
    switch ($action) {
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'books':
            $bookController = new BookController();
            $bookController->showBooks();
            break;

        case 'singleBook':
            $bookController = new BookController();
            $bookController->showSingleBook();
            break;

        case 'singIn':
            $userController = new UserController();
            $userController->signIn();
            break;

        case 'logIn':
            $userController = new UserController();
            $userController->logIn();
            break;

        case 'logOut':
            $userController = new UserController();
            $userController->logOut();
            break;

        case 'myAccount':
            $userController = new UserController();
            $userController->showMyAccount();
            break;

        case 'publicAccount':
            $userController = new UserController();
            $userController->showPublicAccount();
            break;

        case 'bookEdition':
            $bookController = new BookController();
            $bookController->showBookEdition();
            break;

        case 'messaging':
            $messageController = new MessageController();
            $messageController->showMessaging();
            break;
        
        default:
            throw new Exception("La page demandée n'existe pas.");
            break;
    }
} catch (Exception $e) {
    $errorView = new View('Erreur', 'Error', "page_errorPage");
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}