<?php

declare(strict_types=1);

/** Classe qui gère la logique de nos commandes */

class Commands
{
    /**
     * Fonction pour afficher la liste de tous les contacts
     * @return void
     */
    public static function list(): void
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        echo "affichage de la liste des contacts \n";
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    /**
     * Fonction pour afficher les détails d'un contact à partir de son ID
     * @param int $id
     * @return void
     */
    public static function detail(int $id): void
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);
        if (isset($contact)) {
            echo "affichage du contact \n";
            echo $contact . "\n";
        } else {
            echo "Cet id n'existe pas !\n";
        }
    }

    /**
     * Fonction pour créer un contact
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return void
     */
    public static function create(string $name, string $email, string $phone): void
    {
        $contactManager = new ContactManager();
        $contactManager->create($name, $email, $phone);
        echo "Contact ajouté avec succès ! " . $name . " " . $email . " " . $phone . "\n";
    }

    /**
     * Fonction pour supprimer un contact à partir de son ID
     * @param int $id
     * @return void
     */
    public static function delete(int $id): void
    {
        $contactManager = new ContactManager();
        $contactManager->delete($id);
        echo "Le contact n°".$id." a été supprimé !\n";
    }

    /**
     * Fonction pour modifier un contact
     * @param int $id
     * @return void
     */
    public static function update(int $id, string $name, string $email, string $phone): void
    {
        $contactManager = new ContactManager();
        $contactManager->update($id, $name, $email, $phone);
        echo "Le contact a été mis à jour avec succès !\n";
    }

    /**
     * Fonction affichant la liste des commandes
     * @return void
     */
    public static function help(): void
    {
        echo "Voici la liste des commandes :\nhelp : affiche cette aide\nexit : quitte l'application\nlist : affiche la liste de tous les contacts\ndetail [id] : affiche le détail du contact\ncreate [nom], [email], [phone number] : crée un contact\ndelete [id] : supprime le contact\nupdate [id] : modifie le contact\n";
    }
}
