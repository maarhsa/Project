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
$template = file_get_contents(__DIR__ . '/templates/home/forgot_password.tpl');
$menuTemplate = file_get_contents(__DIR__ . '/templates/home/home_menu.tpl');
$footerTemplate = file_get_contents(__DIR__ . '/templates/footer.tpl');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $recovery_word = trim($_POST['recovery_word']);

    // Vérifier si l'email et le mot de récupération existent et correspondent
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND recovery_word = :recovery_word");
    $stmt->execute(['email' => $email, 'recovery_word' => $recovery_word]);
    $user = $stmt->fetch();

    if ($user) {
        // Enregistrer l'ID utilisateur dans la session pour la page de réinitialisation
        $_SESSION['reset_user_id'] = $user['id'];

        // Ajouter des en-têtes pour forcer la redirection sans cache
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Location: reset_password.php");
        exit;
    } else {
        $error_message = $lang['invalid_recovery_info'];
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

// Afficher le template final
echo $template;
?>