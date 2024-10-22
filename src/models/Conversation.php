<?php

/**
 * Entité Conversation, une conversation est défini par les champs
 * id, userId1, userId2
 */
class Conversation extends AbstractEntity
{
    private int $id = -1;
    private int $userAtInitiativeOfRequest = -1;
    private int $userWhoReceivesRequest = -1;
    private string $lastMessageSend = "";

    /**
     * Setter pour l'id de la conversation.
     * @param int $id
     */
    public function setConversationId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id de la conversation.
     * @return int $id
     */
    public function getConversationId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour l'id du premier utilisateur.
     * @param int $userAtInitiativeOfRequest
     */
    public function setUserAtInitiativeOfRequest(int $userAtInitiativeOfRequest): void
    {
        $this->userAtInitiativeOfRequest = $userAtInitiativeOfRequest;
    }

    /**
     * Getter pour l'id du premier utilisateur.
     * @return int $userAtInitiativeOfRequest
     */
    public function getUserAtInitiativeOfRequest(): int
    {
        return $this->userAtInitiativeOfRequest;
    }

    /**
     * Setter pour l'id du premier utilisateur.
     * @param int $userWhoReceivesRequest
     */
    public function setUserWhoReceivesRequest(int $userWhoReceivesRequest): void
    {
        $this->userWhoReceivesRequest = $userWhoReceivesRequest;
    }

    /**
     * Getter pour l'id du premier utilisateur.
     * @return int $userWhoReceivesRequest
     */
    public function getUserWhoReceivesRequest(): int
    {
        return $this->userWhoReceivesRequest;
    }

    /**
     * Setter pour le datetime du dernier message envoyer ou reçu de la conversation.
     * @param int $lastMessageSend
     */
    public function setLastMessageSend(string $lastMessageSend): void
    {
        $this->lastMessageSend = $lastMessageSend;
    }

    /**
     * Getter pour le datetime du dernier message envoyer ou reçu de la conversation.
     * @return $lastMessageSend
     */
    public function getLastMessageSend(): string
    {
        return $this->lastMessageSend;
    }
}
