<?php

/**
 * Class qui gère les messages.
 */
class MessageManager extends AbstractEntityManager
{
    /**
     * Récupère tous les messages.
     * @return array : un tableau d'objets Message
     */
    public function getAllMessage(): array
    {
        $sql = "SELECT * FROM message";
        $result = $this->db->query($sql);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    /**
     * Récupère tous les messages d'une conversation
     * @param $user1 & $user2 : id des utilisateur de la conversation
     * @return void
     */
    public function getAllMessageOfConversation(int $conversationId): array
    {
        $sql = "SELECT * FROM message WHERE conversation_id = :conversationId";
        $result = $this->db->query($sql, [
            'conversationId' => $conversationId,
        ]);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }
    public function getMessageById(int $id): ?Message
    {
        $sql = "SELECT * FROM message WHERE message_id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $message = $result->fetch();
        if ($message) {
            return new Message($message);
        }
        return null;
    }

    /**
     * Ajoute un message.
     * @param $user1 & $user2 : id des utilisateur de la conversation
     * @return void
     */
    public function addMessage(Message $message): void
    {
        $sql = "INSERT INTO message (conversation_id, user_id, sending_datetime, content, view) VALUES (:conversation_id, :user_id, now(), :content, :view)";
        $this->db->query($sql, [
            'conversation_id' => $message->getConversationId(),
            'user_id' => $message->getUserId(),
            'content' => $message->getContent(),
            'view' => 0
        ]);
    }

    /**
     * Modifie l'état de vu du message
     * @param string $showStatusMessage : état de vue du message
     * @param int $messageId : id du message à modifier
     * @return void
     */
    public function updateView(int $showStatusMessage, int $messageId): void
    {
        $sql = "UPDATE message SET view = :view WHERE message_id = :id";
        $this->db->query($sql, [
            'view' => $showStatusMessage,
            'id' => $messageId
        ]);
    }
}
