<?php

/**
 * Entité User, un utilisateur est défini par les champs
 * id, pseudo, email, password, profilePicture, registration_date
 */
class User extends AbstractEntity
{
    private int $id = -1;
    private string $pseudo = "";
    private string $email = "";
    private string $password = "";
    private string $profilePicture = "";
    private string $registration_date;
    private int $unreadMessage = 0;

    /**
     * Setter pour l'id de l'utilisateur.
     * @param int $id
     */
    public function setUserId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int $id
     */
    public function getUserId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour le pseudo de l'utilisateur.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo de l'utilisateur.
     * @return string $pseudo
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Setter pour l'email de l'utilisateur.
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter pour l'email de l'utilisateur.
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setter pour le mot de passe de l'utilisateur.
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le mot de passe de l'utilisateur.
     * @return string $password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Setter pour l'image de profil de l'utilisateur.
     * @param string $profilePicture
     */
    public function setProfilePicture(string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    /**
     * Getter pour l'image de profil de l'utilisateur.
     * @return string $profilePicture
     */
    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }

    /**
     * Setter pour la date d'incritpion de l'utilisateur.
     * @param string $registration_date
     */
    public function setRegistrationDate(string $registration_date): void
    {
        $date = $registration_date; // defini la date
        $today = date("Y-m-d");

        $numberDate = Utils::CountNumberOfDays($date, $today);
        $this->registration_date = $numberDate;
    }

    /**
     * Getter pour le nombre de jours depuis la date d'incription de l'utilisateur.
     * @return int $registration_date
     */
    public function getRegistrationDate(): int
    {
        return $this->registration_date;
    }

    /**
     * Setter pour le nombre de message non plus de l'utilisateur.
     * @param int $unreadMessage
     */
    public function setUnreadMessage(int $unreadMessage): void
    {
        $this->unreadMessage = $unreadMessage;
    }

    /**
     * Getter pour le nombre de message non plus de l'utilisateur.
     * @return int $unreadMessage
     */
    public function getUnreadMessage(): int
    {
        return $this->unreadMessage;
    }
}
