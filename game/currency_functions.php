<?php
require_once '../db.php';

// Fonction pour obtenir le solde des deux monnaies pour un utilisateur
function getUserBalance($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT credits, buds FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// Fonction pour ajouter des Crédits
function addCredits($userId, $amount) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET credits = credits + ? WHERE id = ?");
    $stmt->execute([$amount, $userId]);
}

// Fonction pour ajouter des Buds
function addBuds($userId, $amount) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET buds = buds + ? WHERE id = ?");
    $stmt->execute([$amount, $userId]);
}

// Fonction pour déduire des Crédits
function deductCredits($userId, $amount) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET credits = credits - ? WHERE id = ? AND credits >= ?");
    $stmt->execute([$amount, $userId, $amount]);
    return $stmt->rowCount() > 0;
}

// Fonction pour déduire des Buds
function deductBuds($userId, $amount) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE users SET buds = buds - ? WHERE id = ? AND buds >= ?");
    $stmt->execute([$amount, $userId, $amount]);
    return $stmt->rowCount() > 0;
}
?>
