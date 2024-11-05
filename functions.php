<?php
require_once 'db.php';

function isMaintenanceMode() {
    global $pdo;
    $stmt = $pdo->query("SELECT maintenance_mode FROM config LIMIT 1");
    return (bool) $stmt->fetchColumn();
}
?>
