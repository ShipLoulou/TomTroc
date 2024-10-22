<?php

/**
 * Class qui gère les conversations.
 */
class ConversationManager extends AbstractEntityManager
{
    /**
     * Récupère tous les utilisateurs.
     * @return array : un tableau d'objets User
     */
    public function getAllConversation(): array
    {
        $sql = "SELECT * FROM conversation";
        $result = $this->db->query($sql);
        $conversations = [];

        while ($conversation = $result->fetch()) {
            $conversations[] = new Conversation($conversation);
        }
        return $conversations;
    }

    /**
     * Récupère tous conversations liées à un utilisateur.
     * @return array : un tableau d'objets User
     */
    public function getAllConversationOfUser(int $userId): array
    {
        $sql = "SELECT * FROM conversation WHERE userAtInitiativeOfRequest = :userAtInitiativeOfRequest OR userWhoReceivesRequest = :userWhoReceivesRequest";
        $result = $this->db->query($sql, [
            'userAtInitiativeOfRequest' => $userId,
            'userWhoReceivesRequest' => $userId,
        ]);

        $conversations = [];

        while ($conversation = $result->fetch()) {
            $conversations[] = new Conversation($conversation);
        }
        return $conversations;
    }

    /**
     * Récupère une conversation.
     * @param int $id : id de la conversation
     * @return ?Conversation : un Objet conversation
     */
    public function getConversationById(int $id): ?Conversation
    {
        $sql = "SELECT * FROM conversation WHERE conversation_id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $conversation = $result->fetch();
        if ($conversation) {
            return new Conversation($conversation);
        }
        return null;
    }

    /**
     * Ajoute une conversation.
     * @param $user1 & $user2 : id des utilisateur de la conversation
     * @return void
     */
    public function addConversation(int $userInitiative, int $userReceives): void
    {
        $sql = "INSERT INTO conversation (conversation_id, userAtInitiativeOfRequest, userWhoReceivesRequest, lastMessageSend) VALUES (:conversation_id, :userAtInitiativeOfRequest, :userWhoReceivesRequest, now())";
        $this->db->query($sql, [
            'conversation_id' => $userInitiative . $userReceives,
            'userAtInitiativeOfRequest' => $userInitiative,
            'userWhoReceivesRequest' => $userReceives,
        ]);
    }

    /**
     * Ajoute une conversation.
     * @param $user1 & $user2 : id des utilisateur de la conversation
     * @return void
     */
    public function updateLastMessageSend(int $conversationId): void
    {
        $sql = "UPDATE conversation SET lastMessageSend = now() WHERE conversation_id = :id";
        $this->db->query($sql, [
            'id' => $conversationId
        ]);
    }
}
