<?php

declare(strict_types=1);

class Commands
{
    /**
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
}
