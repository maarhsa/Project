<?php
session_start(); // Démarre la session pour stocker la langue

// Charger le fichier de configuration de la base de données, si nécessaire
require_once 'db.php';
require_once 'functions.php';

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/lang/fr.php");

// Initialiser le message d'erreur d'inscription
$registerError = '';

// Vérifier si le mode maintenance est activé
if (isMaintenanceMode()) {
    die($lang['maintenance_message']);
}

// Charger les templates
$template = file_get_contents(__DIR__ . '/templates/home/register.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/templates/home/home_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/templates/footer.tpl');

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Vérifier si la case à cocher est cochée
    if (!isset($_POST['confirm'])) {
        die(['error_accept_terms']);
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$recovery_word = $_POST['recovery_word'];

    $stmt = $pdo->prepare('INSERT INTO users (username, email, password, recovery_word) VALUES (?, ?, ?, ?)');
    $stmt->execute([$username, $email, $password, $recovery_word]);

    // Redirection vers index.php après l'inscription réussie
    header('Location: index.php');
    exit;
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

// Ajouter le message d'erreur si l'inscription échoue ou le message de maintenance
$template = str_replace("{error_message}", $registerError, $template);

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