<?php

/**
 * Class qui gère les livres.
 */
class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book
     */
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM book";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère les 4 derniers livres ajouté.
     * @return array : un tableau d'objets Book
     */
    public function getLastsBooks(): array
    {
        $sql = "SELECT * FROM book ORDER BY book_id DESC LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère un livre en fonction de son id.
     * @param int $id : id du livre
     * @return ?array : un tableau d'objets Book ou null si l'objet n'existe pas
     */
    public function getBookById(int $bookId): ?Book
    {
        $sql = "SELECT * FROM book WHERE book_id = :id";
        $result = $this->db->query($sql, ['id' => $bookId]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    /**
     * Récupère les livres en fonction de la recherche soumis par l'utilisateur (en fonction du titre du livre).
     * @return array : un tableau d'objets Book
     */
    public function getBooksAfterSearch(string $contentSearch): array
    {
        $sql = "SELECT * FROM book WHERE title LIKE :search";
        $result = $this->db->query($sql, [
            'search' => "%$contentSearch%"
        ]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }

        return $books;
    }

    /**
     * Récupère les livres d'un utilisateur.
     * @param int $userId : id de l'utilisateur.
     * @return ?array : un tableau d'objets Book ou null si l'objet n'existe pas
     */
    public function getBooksWithUserId(int $userId): ?array
    {
        $sql = "SELECT * FROM book WHERE user_id = :id";
        $result = $this->db->query($sql, [
            'id' => $userId
        ]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Ajouter un livre dans le base de données
     * @param Book $book : objet contenent les informations du livre à ajouter
     * @param int $availabilityBool : disponibilité du livre (TRUE => 1, FALSE => 0)
     * @return void
     */
    public function addBook(Book $book, $availabilityBool): void
    {
        $sql = "INSERT INTO book (picture, title, author, description, availability, user_id) VALUES (:picture, :title, :author, :description, :availability, :user_id)";
        $this->db->query($sql, [
            'picture' => $book->getPicture(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'availability' => $availabilityBool,
            'user_id' => $book->getUserId()
        ]);
    }

    /**
     * Mets à jours les informations d'un livre.
     * @param Book $book : objet contenent les informations du livre à modifier
     * @param int $book : id du livre à modifier
     * @param int $availabilityBool : disponibilité du livre (TRUE => 1, FALSE => 0)
     * @return void
     */
    public function updateBook(Book $book, int $bookId, int $availabilityBool): void
    {
        $sql = "UPDATE book SET title = :title, author = :author, description = :description, availability = :availability WHERE book_id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'availability' => $availabilityBool,
            'id' => $bookId
        ]);
    }

    /**
     * Modifie l'image du livre
     * @param string $picture : chemin vers l'image
     * @param int $bookId : id du livre à modifer l'image
     * @return void
     */
    public function updateBookPicture(string $picture, int $bookId): void
    {
        $sql = "UPDATE book SET picture = :picture WHERE book_id = :id";
        $this->db->query($sql, [
            'picture' => $picture,
            'id' => $bookId
        ]);
    }

    /**
     * Supprime un livre.
     * @param int $idDelete : id du livre à supprimer.
     * @return void
     */
    public function deleteBook(int $idDelete): void
    {
        $sql = "DELETE FROM book WHERE book_id = :id";
        $result = $this->db->query($sql, ['id' => $idDelete]);
    }
}
