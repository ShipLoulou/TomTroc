<?php
/**
 * Gestion de la navigation mobile (RESPONSIVE)
 */

// Accède au différent paramètre de l'url.
$action = Utils::request('action');
$navbarGestion = Utils::request("navBar");

// Fonction générique pour renvoyer l'adresse de la page actuelle, avec possibilité d'exclure des paramètres
function getURI($exclusions = [])
{
    $adresse = null;
    $i = 0;
    foreach($_GET as $cle => $valeur) {
        if (!in_array($cle, $exclusions)) {
            $adresse .= ($i == 0 ? '&' : '&').$cle.($valeur ? '='.$valeur : '');
            $i++;
        }
    }
    return $adresse;
}

$url = getURI(['action']);
$oldUrl = getURI(['action', 'navBar']);

/**
 * Gestion notification message
 */

// Récupère l'id de l'utilisateur.
$userId = filter_var($_SESSION['idUser'], FILTER_VALIDATE_INT);

if ($userId) {

    // Récupère les informations de l'utilisateur.
    $userManager = new UserManager();
    $infoMyUser = $userManager->getUserById($userId);

    // Récupère l'ensemble des conversations de l'utilisateur.
    $conversationManager = new ConversationManager();
    $conversations = $conversationManager->getAllConversationOfUser($userId);


    // Ensemble des messages non lu
    $unreadMessage = [];

    foreach ($conversations as $conv) {
        // Récupère les messages de la conversation active.
        $messageManager = new MessageManager();
        $allMessage = $messageManager->getAllMessageOfConversation($conv->getConversationId());

        // Insère les messages non lu dans le tableau $unreadMessage
        foreach ($allMessage as $message) {
            if ($message->getUserId() !== $userId && $message->getView() === false) {
                $unreadMessage[] = $message;
            }
        }
    }

    // MAJ message non lu profil utilisateur.
    if (count($unreadMessage) !==  $infoMyUser->getUnreadMessage()) {
        $userManager->updateUnreadMessage(count($unreadMessage), $userId);
    }

    // Récupère les informations de l'utilisateur MAJ.
    $updateInfoMyUser = $userManager->getUserById($userId);
}

?>

<header>
    <nav class="<?= $navbarGestion ? 'navBarHeightResponsive' : '' ?>">
        <div class="navMobile">
            <a 
            href="index.php?action=home"
            aria-label="Redirection vers la page d'accueil."
            >
                <div class="logoHeader">
                    <div class="logo">
                        <span>T</span>
                        <span>T</span>
                    </div>
                    <h1>Tom Troc</h1>
                </div>
            </a>
            <a 
            href="<?= $navbarGestion ? 'index.php?action=' . $action . $oldUrl : 'index.php?action=' . $action . '&navBar=open' . $url ?>" 
            aria-label="Menu déroulant pour mobile."
            >
                <h2 class="displayNone">Menu</h2>
                <svg
                class="iconMenuMobile"
                viewBox="0 -53 384 384"
                xmlns="http://www.w3.org/2000/svg"
                id="fi_1828859"
                >
                    <path
                    d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"
                    ></path>
                    <path
                    d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"
                    ></path>
                    <path
                    d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"
                    ></path>
                </svg>
            </a>
        </div>
        <div class="navigation <?= $navbarGestion ? 'displayNone' : 'displayBlock' ?>">
            <ul>
                <li>
                    <a 
                    href="index.php?action=home"
                    aria-label="Redirige vers la page d'accueil."
                    class="<?= $_REQUEST["action"] === "home" ? 'navigationStyleActive' : '' ?>"
                    > Accueil </a>
                </li>
                <li>
                    <a 
                    href="index.php?action=books"
                    aria-label="Redirige vers la page contenant tous les livres à l'échanges."
                    class="<?= $_REQUEST["action"] === "books" ? 'navigationStyleActive' : '' ?>"
                    > Nos livres à l'échange 
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <a 
                    href=<?php $urlMessage = Utils::navigationMessagePart();
if (!$urlMessage) {
    echo 'index.php?action=home';
} else {
    echo $urlMessage;
} ?>
                    aria-label="Redirige vers vos messages si vous être connecté."
                    class="<?= $_REQUEST["action"] === "messaging" ? 'navigationStyleActive' : '' ?>"
                    >
                        <svg
                        width="15"
                        height="14"
                        viewBox="0 0 15 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            d="M12.5342 10.8594L12.3182 11.0439L12.4441 11.2822V12.7332L11.1804 12.0036L11.0119 11.8558L10.8037 11.9494C9.81713 12.3931 8.6938 12.645 7.5 12.645C3.50458 12.645 0.355 9.84779 0.355 6.5C0.355 3.15221 3.50458 0.355 7.5 0.355C11.4954 0.355 14.645 3.15221 14.645 6.5C14.645 8.19467 13.8458 9.73885 12.5342 10.8594ZM11.1765 12.0014C11.1765 12.0014 11.1766 12.0014 11.1766 12.0014L11.1765 12.0014L11.1765 12.0014Z"
                            stroke="#292929"
                            stroke-width="0.71"
                            />
                        </svg>
                        Messagerie
                        <?php
    if($userId && $updateInfoMyUser->getUnreadMessage() !== 0) { ?>
                            <div class='numberNotification'> <?= $updateInfoMyUser->getUnreadMessage() ?></div>
                        <?php } ?>
                    </a>
                </li>
                <li>
                    <a 
                    href='index.php?action=myAccount'
                    aria-label="Redirige vers votre compte si vous être connecté."
                    class="<?= $_REQUEST["action"] === "myAccount" ? 'navigationStyleActive' : '' ?>"
                    >
                        <svg
                        id="fi_2105556"
                        enable-background="new 0 0 128 128"
                        height="22"
                        viewBox="0 0 128 128"
                        width="22"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            d="m87 50c0-12.7-10.3-23-23-23s-23 10.3-23 23 10.3 23 23 23 23-10.3 23-23zm-40 0c0-9.4 7.6-17 17-17s17 7.6 17 17-7.6 17-17 17-17-7.6-17-17z"
                            ></path>
                            <path
                            d="m25.5 108.2c.5.3 1 .4 1.5.4 1 0 2.1-.5 2.6-1.5 7-12.4 20.2-20.1 34.4-20.1s27.4 7.7 34.5 20.1c.8 1.4 2.7 1.9 4.1 1.1s1.9-2.7 1.1-4.1c-8.1-14.2-23.3-23.1-39.7-23.1s-31.6 8.9-39.7 23.1c-.8 1.4-.3 3.3 1.2 4.1z"
                            ></path>
                        </svg>
                        Mon compte
                    </a>
                </li>
                <li>
                <?php if (isset($_SESSION["user"])): ?>
                    <a 
                    href='index.php?action=logOut'
                    aria-label="Permet de me déconnecter de votre compte."
                    >Déconnexion</a>
                <?php else: ?>
                    <a 
                    href='index.php?action=logIn'
                    aria-label="Permet de vous connecter à votre compte."
                    >Connexion</a>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</header>