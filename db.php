<?php
declare(strict_types=1); // Enforce strict types

// db.php : Fichier pour la connexion à la base de données MySQL

// Paramètres de connexion
$host = 'localhost';
$dbname = 'weed_valley';  // Remplace par le nom de ta base de données
$username = 'root';           // Remplace par ton nom d'utilisateur
$password = '';              // Remplace par ton mot de passe

try {
    // Créer une nouvelle instance PDO
    $pdo = new PDO(
        dsn: "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
        username: $username, 
        password: $password, 
        options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false, // Utilise les requêtes préparées natives
        ]
    );

} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher un message d'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
