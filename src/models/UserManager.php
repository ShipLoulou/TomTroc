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
     * Récupère un utilisateur.
     * @param int $id : id de l'utilisateur
     * @return ?User : un objets User
     */
    public function getUserById(int $userId): ?User
    {
        $sql = "SELECT * FROM user WHERE user_id = :id";
        $result = $this->db->query($sql, ['id' => $userId]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
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

    /**
     * Modifie les informations d'un utilisateur.
     * @param User : objet User
     * @param int $userId : id de l'utilisateur à modifier
     * @return void
     */
    public function updateUser(User $user, int $userId): void
    {
        $sql = "UPDATE user SET pseudo = :pseudo, email = :email, password = :password WHERE user_id = :id";
        if (strlen($user->getPassword()) < 20) {
            $this->db->query($sql, [
                'pseudo' => $user->getPseudo(),
                'email' => $user->getEmail(),
                'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                'id' => $userId
            ]);
        } else {
            $this->db->query($sql, [
                'pseudo' => $user->getPseudo(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'id' => $userId
            ]);
        }
    }

    /**
     * Modifie l'image de profil d'un utilisateur
     * @param string $profilePicture : chemin vers l'image
     * @param int $userId : id de l'utilisateur à modifer l'image de profil
     * @return void
     */
    public function updateProfilePicture(string $profilePicture, int $userId): void
    {
        $sql = "UPDATE user SET profilePicture = :profilePicture WHERE user_id = :id";
        $this->db->query($sql, [
            'profilePicture' => $profilePicture,
            'id' => $userId
        ]);
    }
}
