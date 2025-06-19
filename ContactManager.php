<?php

declare(strict_types=1);

/** Cette classe permet de communiquer avec la base de données */

class ContactManager
{
    /**
     * @var PDO $pdo
     */
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new DBConnect())->getPdo();
    }

    /**
     * Instancie un nouveau contact
     * @param array $items
     * @return Contact
     */
    private static function setContact(array $items): Contact
    {
            $contact = new Contact();
            $contact->setId($items['id']);
            $contact->setName($items['name']);
            $contact->setEmail($items['email']);
            $contact->setPhone($items['phone_number']);
            return $contact;
    }

    /**
     * Récupère tous les contacts en base de données et les stocke dans un tableau d'objets Contact
     * @return Contact[]
     */
    public function findAll(): array
    {
        $contacts = [];
        $dbItems = $this->pdo->query("SELECT * FROM `contact`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dbItems as $items)
        {
            $contacts[] = self::setContact($items);
        }
        return $contacts;
    }

    /**
     * Récupère le contact en base de données puis le stocke dans un object Contact
     * @param int $id
     * @return Contact|null
     */
    public function findById(int $id): ?Contact
    {
            $dbItem = $this->pdo->prepare("SELECT * FROM `contact` WHERE `id` = :id");
            $dbItem->bindParam(":id", $id, PDO::PARAM_INT);
            $dbItem->execute();
            $items = $dbItem->fetch(PDO::FETCH_ASSOC);
            if (empty($items)){
                return null;
            }
            return self::setContact($items);
    }

    /**
     * Insère un nouveau contact en base de données
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return void
     */
    public function create(string $name, string $email, string $phone): void
    {
        $query = 'Insert INTO contact (name, email, phone_number) values (:name, :email, :phoneNumber)';
        $insertContact = $this->pdo->prepare($query);
        $insertContact->execute([
            "name" => $name,
            "email" => $email,
            "phoneNumber" => $phone
        ]);
    }

    /**
     * Supprime le contact en base de données en fonction de son ID
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $dbItem = $this->pdo->prepare("DELETE FROM `contact` WHERE `id` = :id");
        $dbItem->bindParam(":id", $id, PDO::PARAM_INT);
        $dbItem->execute();
    }

    /**
     * Met à jour le contact en base de données
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return void
     */
    public function update(int $id, string $name, string $email, string $phone): void
    {
        $query = 'Update contact set name = :name, email = :email, phone_number = :phoneNumber where id = :id';
        $updateContact = $this->pdo->prepare($query);
        $updateContact->execute([
            "name" => $name,
            "email" => $email,
            "phoneNumber" => $phone,
            "id" => $id,
        ]);
    }
}
