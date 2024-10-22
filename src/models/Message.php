<?php

/**
 * Entité Message, un message est défini par les champs
 * id, userId1, userId2
 */
class Message extends AbstractEntity
{
    private int $id = -1;
    private int $conversation_id  = -1;
    private int $user_id = -1;
    private string $sending_datetime = "";
    private string $content = "";
    private bool $messageView;

    /**
     * Setter pour l'id du message.
     * @param int $id
     */
    public function setMessageId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id du message.
     * @return int $id
     */
    public function getMessageId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour l'id de la conversation.
     * @param int $conversation_id
     */
    public function setConversationId(int $conversation_id): void
    {
        $this->conversation_id = $conversation_id;
    }

    /**
     * Getter pour l'id de la conversation.
     * @return int $conversation_id
     */
    public function getConversationId(): int
    {
        return $this->conversation_id;
    }

    /**
     * Setter pour l'id de l'utilisateur.
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int $user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Setter pour le datetime de l'utilisateur.
     * @param string $sending_datetime
     */
    public function setSendingDatetime(string $sending_datetime): void
    {
        $this->sending_datetime = $sending_datetime;
    }

    /**
     * Getter pour le datetime de l'utilisateur.
     * @return string $sending_datetime
     */
    public function getSendingDatetime(): string
    {
        return $this->sending_datetime;
    }

    /**
     * Setter pour le message de l'utilisateur.
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter pour le message de l'utilisateur.
     * @return string $content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Setter pour la gestion de la vue du message.
     * @param bool $messageView
     */
    public function setView(bool $messageView): void
    {
        $this->messageView = $messageView;
    }

    /**
     * Getter pour la gestion de la vue du message.
     * @return bool $messageView
     */
    public function getView(): bool
    {
        return $this->messageView;
    }
}
