<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changelog</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<!-- Inclusion du home_menu -->
	{menu}
	<br>
	<br>
<div class="changelog-container">
    <h2>Changelog</h2>
    <!-- Placeholder pour les versions et modifications -->
    {changelog_content}
</div>
<script>
    // Fonction pour afficher/masquer les modifications d'une version
    function toggleModifications(id) {
        const element = document.getElementById(id);
        element.style.display = element.style.display === 'none' ? 'block' : 'none';
    }
</script>
	<br>
	<br>
	<br>
	<br>
	<!-- Inclusion du footer -->
    {footer}
	
</body>
</html>
