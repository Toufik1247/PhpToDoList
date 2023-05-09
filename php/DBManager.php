<?php


require_once 'config.php';

// Définir la classe DBManager pour gérer la connexion à la base de données
class DBManager
{
    private $bdd;

    public function __construct()
    {
        try {
            // Créer une nouvelle instance de l'objet PDO en utilisant les constantes définies dans config.php
            $this->bdd = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
                DB_USER,
                DB_PASSWORD
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Méthode pour se connecter à la base de données
    public function getConnexion()
    {
        return $this->bdd;
    }

}

?>