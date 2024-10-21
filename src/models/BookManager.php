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
}
