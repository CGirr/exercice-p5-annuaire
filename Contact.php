<?php

declare(strict_types=1);

class Contact
{
    /**
     * @var int|null $id
     */
    private ?int $id = null;

    /**
     * @var string|null $name
     */
    private ?string $name =null;

    /**
     * @var string $email
     */
    private string $email;

    /**
     * @var string $phone
     */
    private string $phone;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Nom : ".$this->getName()." Email : ".$this->getEmail()." Numéro de téléphone : ".$this->getPhone();
    }
}
