<?php
session_start(); // Démarre la session

// Détruire toutes les variables de session spécifiques à l'admin
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers le dashboard utilisateur
header("Location: game/dashboard.php");
exit;
?>