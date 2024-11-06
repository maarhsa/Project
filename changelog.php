<?php
// Données de changelog
$changelog = [
	'1.0' => [
		'01000' => 'Alpha phase game launch',
	],
	'0.2' => [
		'00045' => '',
		'00044' => '',
		'00043' => '',
		'00042' => '',
		'00041' => '',
	],
    '0.1' => [
		'00040' => '',
		'00039' => '',
		'00038' => '',
		'00037' => '',
		'00036' => '',
		'00035' => '',
		'00034' => 'FIX Maintenance Mode',
		'00032' => 'Rework templates and CSS for responsive design',
		'00031' => 'Adding risks to index.php',
		'00030' => 'Fix all language files',
		'00029' => 'Added a maintenance system blocking login and register',
		'00028' => 'Added a counting system for registered and logged in players',
		'00027' => 'Fix login error',
		'00026' => 'Fix login for redirection',
		'00025' => 'Correction of the password recovery system, with a new entry (recovery_word) in register.php',
		'00024' => 'Added a password recovery system entirely in PHP',
        '00023' => 'Fix footer and add social media icons',
		'00022' => 'Creation of a clean menu once logged in',
		'00021' => 'Creation of the first page of the game home.php, harvest.php, plant.php, transform.php',
		'00020' => 'Fix player ID so that only the first registered account can obtain administrative rights',
        '00019' => 'Integration of the changelog for the advancement of game development',
		'00018' => 'Addition of the module authorizing or not to connect in the event of maintenance in the administration part',
		'00017' => 'Adding an administrator menu',
		'00016' => 'Creating the footer',
		'00015' => 'Addition of Dutch language',
		'00014' => 'Addition of Italian language',
		'00013' => 'Addition of Portuguese language',
		'00012' => 'Addition of Spanish language',
		'00011' => 'Addition of German language',
		'00010' => 'Addition of English language',
		'00009' => 'Addition of French language',
		'00008' => 'Implementation of the language choice system',
		'00007' => 'Search function in the database when recording so that 2 identical emails are not recorded',
		'00006' => 'Fix php to use version 8.0',
		'00005' => 'Creation of the connection and registration form',
        '00004' => 'Adding an index menu',
        '00003' => 'Writing files index.php, login.php, register.php, logout.php',
        '00002' => 'Database creation',
        '00001' => 'Creation of the project on paper',
		'00000' => 'Launch project Weed Valley',
    ],
];

// Récupérer la langue sélectionnée, par défaut "fr"
$langCode = $_GET['lang'] ?? $_SESSION['lang'] ?? 'fr';
$_SESSION['lang'] = $langCode; // Sauvegarde la langue dans la session

// Charger le fichier de langue approprié
$langFile = __DIR__ . "/lang/$langCode.php";
$lang = file_exists($langFile) ? include($langFile) : include(__DIR__ . "/lang/fr.php");

// Générer le contenu du changelog pour chaque version
$changelogContent = '';
foreach ($changelog as $version => $modifications) {
    $changelogContent .= '<div class="version" onclick="toggleModifications(\'modifications-' . $version . '\')">';
    $changelogContent .= 'Version ' . $version;
    $changelogContent .= '</div>';
    $changelogContent .= '<div class="modifications" id="modifications-' . $version . '">';
    foreach ($modifications as $modNumber => $description) {
        $changelogContent .= '<div class="mod-item"><strong>' . $modNumber . '&ensp;:&ensp;</strong> ' . $description . '</div>';
    }
    $changelogContent .= '</div>';
}

// Charger le template changelog.tpl
$template = file_get_contents(__DIR__ . '/templates/home/changelog.tpl');
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

// Remplacer le placeholder avec le contenu généré
$template = str_replace('{changelog_content}', $changelogContent, $template);

// Intégrer le menu et le footer dans le template principal
$template = str_replace("{menu}", $menuTemplate, $template);
$template = str_replace("{footer}", $footerTemplate, $template);

// Afficher le template final
echo $template;
?>