<?php
session_start(); // Démarre la session pour stocker la langue

// Charger le fichier de configuration de la base de données et des fonctions
require_once 'db.php';
require_once 'functions.php'; // Inclure le fichier avec la fonction isMaintenanceMode

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/lang/fr.php");

// Initialiser le message d'erreur de connexion
$loginError = '';

// Vérifier si le mode maintenance est activé
$maintenanceMode = isMaintenanceMode();

// Vérifier si le formulaire de connexion a été soumis, et si le mode maintenance est désactivé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && !$maintenanceMode) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Requête SQL pour vérifier l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();
    
    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Connecté avec succès, sauvegarder l'ID utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../game/dashboard.php'); // Redirection vers le tableau de bord
        exit;
    } else {
        $loginError = $lang['login_error']; // Message d'erreur de connexion
    }
} elseif ($maintenanceMode) {
    $loginError = $lang['maintenance_message']; // Message de maintenance si le mode est activé
}

// Charger les templates
$template = file_get_contents(__DIR__ . '/templates/home/index.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/templates/home/home_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/templates/footer.tpl');

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

// Ajouter le message d'erreur si la connexion échoue ou le message de maintenance
$template = str_replace("{error_message}", $loginError, $template);

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