<?php

declare(strict_types=1);

include 'config.php';

/** Classe permettant d'instancier un objet de type PDO */

class DBConnect
{
    /**
     * @var string $serverName
     */
    private string $serverName;

    /**
     * @var string $dbUsername
     */
    private string $dbUsername;

    /**
     * @var string $dbPassword
     */
    private string $dbPassword;

    /**
     * @var string $dbName
     */
    private string $dbName;

    /**
     * @var string $charSet
     */
    private string $charSet;

    /**
     * @var PDO $database
     */
    private PDO $database;

    public function __construct()
    {
        try {
            $this->serverName = DB_HOST;
            $this->dbName = DB_NAME;
            $this->charSet = "utf8mb4";
            $this->dbUsername = DB_USER;
            $this->dbPassword = DB_PASS;

            $dsn = "mysql:host=".$this->serverName.";dbname=".$this->dbName;"charset=".$this->charSet;
            $database = new PDO($dsn, $this->dbUsername, $this->dbPassword);
            $this->database = $database;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->database;
    }
}
