<?php
// Connexion à la base de données (PDO)
class Database
{
    public static function getConnexion(): PDO
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $database = getenv('DB_NAME') ?: 'zerne';
        $user = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD');
        if ($password === false) {
            $password = '';
        }

        $pdo = new PDO(
            "mysql:host=$host;dbname=$database;charset=utf8mb4",
            $user,
            $password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
