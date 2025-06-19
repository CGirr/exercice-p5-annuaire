<?php
declare(strict_types=1);

include 'Commands.php';
include 'Contact.php';
include 'ContactManager.php';
include 'DBConnect.php';

$matches = [];

/** Boucle infinie permettant d'exécuter nos commandes */

while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === 'list') {
        Commands::list();
    } elseif (preg_match('/detail\s([0-9]+)/', $line, $matches)) {
        $id = (int)$matches[1];
        Commands::detail($id);
    } elseif (preg_match('/detail/', $line)) {
        echo "Vous devez entrer un id pour cette commande. \n";
    } elseif (preg_match('/create\s(?P<name>[a-zA-Z-]+)\W\s(?P<email>[a-zA-Z0-9.%_-]+@[a-zA-Z0-9.%_-]+\.[a-zA-Z]+)\W\s(?P<phone>[0-9]{10})/', $line, $matches)) {
        $name = (string)$matches[1];
        $email = (string)$matches[2];
        $phone = (string)$matches[3];
        Commands::create($name, $email, $phone);
    } elseif (preg_match('/delete\s([0-9]+)/', $line, $matches)) {
        $id = (int)$matches[1];
        Commands::delete($id);
    } elseif (preg_match('/update\s(?P<id>[0-9]+)\W\s(?P<name>[a-zA-Z-]+)\W\s(?P<email>[a-zA-Z0-9.%_-]+@[a-zA-Z0-9.%_-]+\.[a-zA-Z]+)\W\s(?P<phone>[0-9]{10})/', $line, $matches)) {
        $id = (int)$matches[1];
        $name = (string)$matches[2];
        $email = (string)$matches[3];
        $phone = (string)$matches[4];
        Commands::update($id, $name, $email, $phone);
    } elseif ($line === 'exit') {
        exit();
    } elseif ($line === 'help') {
        Commands::help();
    } else {
        echo "Vous avez saisi : " . $line . "\nVeuillez saisir une commande valide. \n";
    }
}
