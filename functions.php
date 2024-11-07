<?php
require_once 'db.php';

function isMaintenanceMode() {
    global $pdo;
    $stmt = $pdo->query("SELECT maintenance_mode FROM config LIMIT 1");
    return (bool) $stmt->fetchColumn();
}

// Fonction pour récupérer les soldes de départ
function getDefaultBalances() {
    global $pdo;
    $stmt = $pdo->query("SELECT default_credits, default_buds FROM settings LIMIT 1");
    return $stmt->fetch();
}

// Fonction pour mettre à jour les soldes de départ
function updateDefaultBalances($credits, $buds) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE settings SET default_credits = ?, default_buds = ? WHERE id = 1");
    $stmt->execute([$credits, $buds]);
}
?>
