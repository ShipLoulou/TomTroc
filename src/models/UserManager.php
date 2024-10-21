<?php

/**
 * Class qui gère les utilisateurs.
 */
class UserManager extends AbstractEntityManager
{
    /**
     * Récupère tous les utilisateurs.
     * @return array : un tableau d'objets User
     */
    public function getAllUser(): array
    {
        $sql = "SELECT * FROM user";
        $result = $this->db->query($sql);
        $users = [];

        while ($user = $result->fetch()) {
            $users[] = new User($user);
        }
        return $users;
    }

    /**
     * Récupère un utilisateur en fonction de son email.
     * @return ?User : un objets User
     */
    public function getUserByEmail(?string $email): ?User
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Insère le nouvel utilisateur dans la base de données.
     * @param User $user : objet User
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO user (pseudo, email, password, profilePicture, registration_date, unreadMessage) VALUES (:pseudo, :email, :password, :profilePicture, NOW(), 0)";
        $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'profilePicture' => $user->getProfilePicture()
        ]);
    }
}
