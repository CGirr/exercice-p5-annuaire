<?php

declare(strict_types=1);

/** Classe qui gère la logique de nos commandes */

class Commands
{
    /**
     * Fonction pour afficher la liste de tous les contacts
     */
    public static function list(): void
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        echo "affichage de la liste des contacts" . PHP_EOL;
        foreach ($contacts as $contact) {
            echo $contact . PHP_EOL;
        }
    }

    /**
     * Fonction pour afficher les détails d'un contact à partir de son ID
     */
    public static function detail(int $id): void
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);
        if (isset($contact)) {
            echo "affichage du contact" . PHP_EOL;
            echo $contact . PHP_EOL;
        } else {
            echo "Cet id n'existe pas !" . PHP_EOL;
        }
    }

    /**
     * Fonction pour créer un contact
     */
    public static function create(string $name, string $email, string $phone): void
    {
        $contactManager = new ContactManager();
        $contactManager->create($name, $email, $phone);
        echo sprintf("Contact ajouté avec succès ! %s %s %s", $name, $email, $phone) . PHP_EOL;
    }

    /**
     * Fonction pour supprimer un contact à partir de son ID
     */
    public static function delete(int $id): void
    {
        $contactManager = new ContactManager();
        $contactManager->delete($id);
        echo sprintf("Le contact n°%d a été supprimé !", $id) . PHP_EOL;
    }

    /**
     * Fonction pour modifier un contact
     */
    public static function update(int $id, string $name, string $email, string $phone): void
    {
        $contactManager = new ContactManager();
        $contactManager->update($id, $name, $email, $phone);
        echo "Le contact a été mis à jour avec succès !" . PHP_EOL;
    }

    /**
     * Fonction affichant la liste des commandes
     */
    public static function help(): void
    {
        echo <<<TEXT
        Voici la liste des commandes :
           help : affiche cette aide
           exit : quitte l'application
           list : affiche la liste des contacts
           detail [id] : affiche le détail du contact
           create [nom], [email], [phone number] : crée un contact
           delete [id] : supprime le contact
           update [id], [nom], [email], [phone number] : modifie le contact
        
        TEXT;
    }
}
