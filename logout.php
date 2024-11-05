<?php
session_start(); // Démarre la session

// Détruire toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion (index.php)
header("Location: ../index.php");
exit;
?>
