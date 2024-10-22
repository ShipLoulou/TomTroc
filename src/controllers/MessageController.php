<?php

class MessageController
{
    private $bookManager;
    private $userManager;
    private $conversationManager;
    private $messageManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
        $this->userManager = new UserManager();
        $this->conversationManager = new ConversationManager();
        $this->messageManager = new MessageManager();
    }

    /**
     * Affiche la page messaging.
     * @return void
     */
    public function showMessaging()
    {
        // On vérifie que l'utilisateur est connecté.
        Utils::checkIfUserIsConnected();

        // Récupère l'id de l'utilisateur.
        $userId = filter_var($_SESSION['idUser'], FILTER_VALIDATE_INT);

        // Récupère l'id de l'interlocuteur et le transforme en entier.
        $interlocutorId = filter_var(Utils::request("id", -1), FILTER_VALIDATE_INT);

        // Récupère l'id de la conversation et la transforme en entier.
        $conversationId = filter_var(Utils::request("conv", -1), FILTER_VALIDATE_INT);

        // Récupère l'ensemble des conversations
        $conversations = $this->conversationManager->getAllConversationOfUser($userId);

        // Récupère l'ensemble des utilisateurs.
        $users = $this->userManager->getAllUser();

        // Récupère tous les messages d'une conversation.
        $messagesByConversation = $this->messageManager->getAllMessageOfConversation($conversationId);

        // Récupère l'ensemble des conversations liées à l'utilisateur et un tableau contenant les informations suivantes :
        //      • l'id de l'interlocuteur
        //      • le datetime du dernier message envoyer
        $listInterlocutor = [];
        $index = 0;

        foreach ($conversations as $conversation) {
            if ($conversation->getUserAtInitiativeOfRequest() !== $userId) {
                $listInterlocutor[$index]['interlocutorId'] = $conversation->getUserAtInitiativeOfRequest();
                $listInterlocutor[$index]['conversationId'] = $conversation->getConversationId();
                $messages = $this->messageManager->getAllMessageOfConversation($conversation->getConversationId());
                $listInterlocutor[$index]['lastMessage'] = end($messages);
                $listInterlocutor[$index]['lastMessageSend'] = $conversation->getLastMessageSend();
            } elseif ($conversation->getUserWhoReceivesRequest() !== $userId) {
                $listInterlocutor[$index]['interlocutorId'] = $conversation->getUserWhoReceivesRequest();
                $listInterlocutor[$index]['conversationId'] = $conversation->getConversationId();
                $messages = $this->messageManager->getAllMessageOfConversation($conversation->getConversationId());
                $listInterlocutor[$index]['lastMessage'] = end($messages);
                $listInterlocutor[$index]['lastMessageSend'] = $conversation->getLastMessageSend();
            }
            $index++;
        }

        // Gestion conversation erreur
        $newConversation = Utils::request("new");

        $totalInterlocutor = count($listInterlocutor);
        $finalCount = [];

        foreach ($listInterlocutor as $interlocutor) {
            if ($interlocutor['interlocutorId'] . $interlocutor['conversationId'] !== $interlocutorId . $conversationId) {
                $finalCount[] = $interlocutor;
            }
        }

        if ($totalInterlocutor === count($finalCount) && !$newConversation) {
            throw new Exception("Le conversation n'existe pas");
        }

        // Permet de  définir l'ordre des interlocuteur en fonction du dernier message envoyé sur la conversation.
        function sortAscendingOrder($a, $b)
        {
            return $b['lastMessageSend'] <=> $a['lastMessageSend'];
        }

        usort($listInterlocutor, "sortAscendingOrder");

        // Récupère les informations de l'interlocuteur.
        $infoInterlocutor = $this->userManager->getUserById($interlocutorId);

        // Récupère les informations de l'utilisateur.
        $infoMyUser = $this->userManager->getUserById($userId);

        // Récupère les données du formualaires.
        $messageContent = Utils::request("messageContent");

        if ($messageContent) {
            $addNewConversation = true;
            // Vérifie si il existe déjà une conversation entre les utilisateurs.
            foreach ($listInterlocutor as $item) {
                if ($conversationId === $item['conversationId']) {
                    $addNewConversation = false;
                }
            }

            // Si aucun conversation existe, la conersation est créée.
            if ($addNewConversation === true) {
                $this->conversationManager->addConversation($userId, $interlocutorId);
            }

            // Création du nouveau message.
            $message = new Message([
                'conversation_id' => strip_tags($conversationId),
                'user_id' => strip_tags($userId),
                'content' => strip_tags($messageContent)
            ]);
            $this->messageManager->addMessage($message);
            $this->conversationManager->updateLastMessageSend($conversationId);

            Utils::redirect("messaging&id=$interlocutorId&conv=$conversationId#scroolBottom");
        }

        // Quand je suis sur la conversation
        // je change la valeur notification en false

        foreach ($messagesByConversation as $message) {
            if ($message->getUserId() !== $userId && $message->getView() === false) {
                $this->messageManager->updateView(true, $message->getMessageId());
            }
        }

        // Description de la page home (SEO).
        $description = "Messagerie";

        $view = new View("messagerie", $description, "page_messaging");
        $view->render("messaging", [
            'userId' => $userId,
            'conversations' => $conversations,
            'users' => $users,
            'listInterlocutor' => $listInterlocutor,
            'messagesByConversation' => $messagesByConversation,
            'infoInterlocutor' => $infoInterlocutor,
            'infoMyUser' => $infoMyUser,
            'interlocutorId' => $interlocutorId
        ]);
    }
}
