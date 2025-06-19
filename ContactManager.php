<?php

declare(strict_types=1);

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
     * @return Contact[]
     */
    public function findAll(): array
    {
        $contacts =[];
        $dbItems = $this->pdo->query("SELECT * FROM `contact`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dbItems as $items)
        {
            $contacts[] = self::setContact($items);
        }
        return $contacts;
    }

    /**
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
}
