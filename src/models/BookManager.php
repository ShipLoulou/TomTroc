<?php

/**
 * Class qui gère les livres.
 */
class BookManager extends AbstractEntityManager
{
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
}
