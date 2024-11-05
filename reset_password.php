<?php
session_start(); // Démarre la session pour stocker la langue

// Charger le fichier de configuration de la base de données, si nécessaire
require_once 'db.php';

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/lang/fr.php");

// Charger les templates
$template = file_get_contents(__DIR__ . '/templates/home/reset_password.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/templates/home/home_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/templates/footer.tpl');

if (!isset($_SESSION['reset_user_id'])) {
    header("Location: forgot_password.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute(['password' => $hashedPassword, 'id' => $_SESSION['reset_user_id']]);
        unset($_SESSION['reset_user_id']);
        echo $lang['password_reset_success'];
        exit;
    } else {
        $error_message = $lang['password_mismatch'];
    }
}

// Remplacer les placeholders dans le menu
foreach ($lang as $key => $value) {
    $menuTemplate = str_replace("{" . $key . "}", $value, $menuTemplate);
}

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
$template = str_replace("{error_message}", $error_message ?? '', $template);

// Afficher le template final
echo $template;
?>