<?php
session_start(); // Démarre la session pour stocker la langue

// Charger le fichier de configuration de la base de données et les fonctions
require_once '../db.php';
require_once '../functions.php';

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/../lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/../lang/fr.php");

// Vérifier si l'utilisateur est connecté et s'il a un accès admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    // Rediriger vers le tableau de bord si l'utilisateur n'est pas admin
    header("Location: dashboard.php");
    exit;
}

// Activer/désactiver le mode maintenance selon le bouton cliqué
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['enable_maintenance'])) {
        $stmt = $pdo->prepare("UPDATE config SET maintenance_mode = 1");
        $stmt->execute();
    } elseif (isset($_POST['disable_maintenance'])) {
        $stmt = $pdo->prepare("UPDATE config SET maintenance_mode = 0");
        $stmt->execute();
    }
    // Rafraîchit la page pour afficher le statut mis à jour
    header("Location: admin_dashboard.php");
    exit;
}

// Obtenir le statut actuel du mode maintenance
$maintenanceMode = isMaintenanceMode();

// Récupérer le nombre de joueurs connectés
$query_online = "SELECT COUNT(*) as online_count FROM users WHERE is_online = 1";
$stmt_online = $pdo->query($query_online);
$online_count = $stmt_online->fetch()['online_count'];

// Récupérer le nombre total de joueurs inscrits
$query_total = "SELECT COUNT(*) as total_count FROM users";
$stmt_total = $pdo->query($query_total);
$total_count = $stmt_total->fetch()['total_count'];

// Charger les templates
$template = file_get_contents(__DIR__ . '/../templates/admin/admin_dashboard.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/../templates/admin/admin_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/../templates/footer.tpl');

// Remplacer les données des statistiques de joueurs
$template = str_replace("{online_count}", $online_count, $template);
$template = str_replace("{total_count}", $total_count, $template);

// Remplacer les textes dynamiques pour les boutons de maintenance et le statut
$template = str_replace("{maintenance_title}", $lang['maintenance_title'], $template);
$template = str_replace("{maintenance_status_message}", $maintenanceMode ? $lang['maintenance_enabled'] : $lang['maintenance_disabled'], $template);
$template = str_replace("{enable_button_text}", $lang['enable_button'], $template);
$template = str_replace("{disable_button_text}", $lang['disable_button'], $template);
$template = str_replace("{total_users_label}", $lang['total_users_label'], $template);
$template = str_replace("{online_users_label}", $lang['online_users_label'], $template);

// Appliquer des classes CSS conditionnelles pour les boutons de maintenance
$template = str_replace("{enable_button_class}", $maintenanceMode ? 'button-inactive' : 'button-active', $template);
$template = str_replace("{disable_button_class}", $maintenanceMode ? 'button-active' : 'button-inactive', $template);
$template = str_replace("{status_class}", $maintenanceMode ? 'status-active' : 'status-inactive', $template);

// Remplacer les placeholders dans le menu et le footer avec les traductions
foreach ($lang as $key => $value) {
    $menuTemplate = str_replace("{" . $key . "}", $value, $menuTemplate);
    $footerTemplate = str_replace("{" . $key . "}", $value, $footerTemplate);
    $template = str_replace("{" . $key . "}", $value, $template);
}

// Ajouter la classe selected pour la langue actuelle
$template = str_replace("{selected_$langCode}", 'selected', $template);

// Supprimer les placeholders restants non utilisés (pour les autres langues)
$template = preg_replace('/\{selected_\w+\}/', '', $template);

// Intégrer le menu et le footer dans le template principal
$template = str_replace("{menu}", $menuTemplate, $template);
$template = str_replace("{footer}", $footerTemplate, $template);

// Afficher le template final
echo $template;
?>
