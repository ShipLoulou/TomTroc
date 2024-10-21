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
}
