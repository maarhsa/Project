<?php
session_start(); // Démarre la session pour stocker la langue

// Charger le fichier de configuration de la base de données, si nécessaire
require_once '../db.php';

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/../lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/../lang/fr.php");

// Charger les templates
$template = file_get_contents(__DIR__ . '/../templates/game/dashboard.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/../templates/game/game_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/../templates/footer.tpl');

// PHP CODE HERE

// END PHP CODE

// Définir le lien admin pour l'utilisateur avec ID = 1
$adminLink = '';
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) {
    $adminLink = '<li><a href="admin/admin_dashboard.php">' . $lang['adm_dashboard'] . '</a></li>';
}

// Remplacer les placeholders dans le menu
foreach ($lang as $key => $value) {
    $menuTemplate = str_replace("{" . $key . "}", $value, $menuTemplate);
}

// Remplacer le placeholder {admin_link} avec $adminLink
$menuTemplate = str_replace("{admin_link}", $adminLink, $menuTemplate);

// Remplacer les placeholders dans le footer
foreach ($lang as $key => $value) {
    $footerTemplate = str_replace("{" . $key . "}", $value, $footerTemplate);
}

// Remplacer les placeholders dans le template principal
foreach ($lang as $key => $value) {
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