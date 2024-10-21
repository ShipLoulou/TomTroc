<?php

/**
 * Entité Book, un livre est défini par les champs
 * id, picture, title, author, description, availability, user_id
 */
class Book extends AbstractEntity
{
    private int $id = -1;
    private string $picture = "";
    private string $title = "";
    private string $author = "";
    private string $description = "";
    private bool $availability = true;
    private int $user_id = -1;

    /**
     * Setter pour l'id du livre.
     * @param int $id
     */
    public function setBookId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id du livre.
     * @return int $id
     */
    public function getBookId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour l'image du livre.
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * Getter pour l'image du livre.
     * @return string $picture
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * Setter pour le titre du livre.
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre du livre.
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour l'auteur du livre.
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter pour l'auteur du livre.
     * @return string $author
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Setter pour la description du livre.
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter pour la description du livre.
     * @return string $description
     */
    public function getDescription(): string
    {

        return $this->description;
    }

    /**
     * Setter pour la disponibilité du livre.
     * @param bool $availability
     */
    public function setAvailability(bool $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * Getter pour la disponibilité du livre.
     * @return bool $availability
     */
    public function getAvailability(): bool
    {
        return $this->availability;
    }

    /**
     * Setter pour l'id de l'utilisateur.
     * @param id $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return id $user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
