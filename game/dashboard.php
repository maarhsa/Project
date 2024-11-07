<?php
session_start(); // Démarre la session pour stocker la langue

// Charger la configuration de la base de données et les fonctions de monnaie
require_once '../db.php';
require_once '../game/currency_functions.php';

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/../lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/../lang/fr.php");

// Récupérer le solde de l’utilisateur
$userId = $_SESSION['user_id'];
$balance = getUserBalance($userId);

// Charger les templates
$template = file_get_contents(__DIR__ . '/../templates/game/dashboard.tpl');
$headerTemplate = file_get_contents(__DIR__ . '/../templates/game/header.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/../templates/game/game_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/../templates/footer.tpl');

// Définir le lien admin pour l'utilisateur avec ID = 1
$adminLink = '';
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) {
    $adminLink = '<li><a href="../admin/admin_dashboard.php">' . $lang['adm_dashboard'] . '</a></li>';
}

// Remplacer les placeholders de langue dans le menu, footer et template principal
foreach ($lang as $key => $value) {
    $menuTemplate = str_replace("{" . $key . "}", $value, $menuTemplate);
    $footerTemplate = str_replace("{" . $key . "}", $value, $footerTemplate);
	$headerTemplate = str_replace("{" . $key . "}", $value, $headerTemplate);
    $template = str_replace("{" . $key . "}", $value, $template);
}

// Remplacer le lien admin dans le menu
$menuTemplate = str_replace("{admin_link}", $adminLink, $menuTemplate);

// Remplacer les placeholders de crédits et buds dans le header
$headerTemplate = str_replace("{credits}", $balance['credits'], $headerTemplate);
$headerTemplate = str_replace("{buds}", $balance['buds'], $headerTemplate);

// Ajouter la classe selected pour la langue actuelle
$template = str_replace("{selected_$langCode}", 'selected', $template);

// Supprimer les placeholders restants non utilisés (pour les autres langues)
$template = preg_replace('/\{selected_\w+\}/', '', $template);

// Intégrer le header, menu et footer dans le template principal
$template = str_replace("{header}", $headerTemplate, $template);
$template = str_replace("{menu}", $menuTemplate, $template);
$template = str_replace("{footer}", $footerTemplate, $template);

// Afficher le template final
echo $template;
?>
