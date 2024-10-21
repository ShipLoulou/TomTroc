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
}
