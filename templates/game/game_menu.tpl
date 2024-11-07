<button class="menu-toggle" onclick="toggleMenu()">☰</button>
<nav class="navbar">
    <ul class="menu">
        <li><a href="../game/dashboard.php">{dashboard}</a></li>
        <li><a href="#">{menu_item}</a></li>
		{admin_link}
        <li><a href="../logout.php">{logout}</a></li> <!-- Bouton de déconnexion -->
    </ul>
</nav>

<script>
function toggleMenu() {
    document.querySelector('.navbar').classList.toggle('active');
}
</script>
