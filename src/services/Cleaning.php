<?php

/**
 * Class qui permet de supprimer les images stocker qui ne sont plus utilisé sur le site.
 * L'opération ne s'exécute qu'une seul fois par jour au changement de date.
 */
class Cleaning extends AbstractEntityManager
{
    public function deleteUnusedImage()
    {
        // Récupère la date de MAJ du site.
        $sql = "SELECT * FROM siteManagement";
        $result = $this->db->query($sql);
        $lastUpdate = $result->fetch();

        $dateUpdateSite = substr($lastUpdate['lastUpdate'], 0, 10);

        // Récupère la date actuel.
        $today = new DateTime();
        $nowDate = $today->format('Y-m-d');

        // if (false) {
        if ($dateUpdateSite !== $nowDate) {
            // MAJ de la date de MAJ du site dans la base de donnée.
            $sql = "UPDATE siteManagement SET lastUpdate = now() WHERE 1";
            $this->db->query($sql);

            // Contient les images à supprimer.
            $unusedPicture = [];

            // Récupération des livres.
            $bookManager = new BookManager();
            $allBooks = $bookManager->getAllBooks();

            // Récupération des images stocker des livres.
            $directory = 'images/bookPicture';
            $allImagesBookPicture = array_diff(scandir($directory), array('..', '.'));

            // Recherche de image de livre qui ne sont plus utilisé.
            foreach ($allImagesBookPicture as $image) {
                $index = 0;
                foreach ($allBooks as $book) {
                    $item = substr($book->getPicture(), 19);
                    if ($item === $image) {
                        $index++;
                    }
                }
                if ($index === 0) {
                    $unusedPicture[] = "images/bookPicture/$image";
                }
            }

            // Récupération des utilisateurs.
            $userManager = new UserManager();
            $allUsers = $userManager->getAllUser();

            // Récupération des images stocker des images de profils.
            $directory = 'images/profilePicture';
            $allImagesUserProfilePicture = array_diff(scandir($directory), array('..', '.'));

            // Recherche de image de livre qui ne sont plus utilisé.
            foreach ($allImagesUserProfilePicture as $image) {
                $index = 0;
                foreach ($allUsers as $user) {
                    $item = substr($user->getProfilePicture(), 22);
                    if ($item === $image) {
                        $index++;
                    }
                }
                if ($index === 0) {
                    $unusedPicture[] = "images/profilePicture/$image";
                }
            }

            // Suppression des images inutilisées.
            foreach ($unusedPicture as $filename) {
                unlink($filename);
            }
        }
    }
}