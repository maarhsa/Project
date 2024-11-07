<button class="menu-toggle" onclick="toggleMenu()">☰</button>
<nav class="navbar">
	<button class="close-btn" onclick="toggleMenu()">×</button>
	</br>
    <ul class="menu">
        <li><a href="admin_dashboard.php">{admin_dashboard}</a></li>
        <li><a href="#">{menu_item}</a></li>
        <li><a href="admin_logout.php"><font color="red">{admin_logout}</font></a></li>
    </ul>
</nav>

<script>
function toggleMenu() {
    document.querySelector('.navbar').classList.toggle('closed');
}
</script>
