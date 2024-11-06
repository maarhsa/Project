<button class="menu-toggle" onclick="toggleMenu()">☰</button>
<nav class="navbar">
    <ul class="menu">
        <li><a href="admin_dashboard.php">{admin_dashboard}</a></li>
        <li><a href="#">{menu_item}</a></li>
        <li><a href="admin_logout.php">{admin_logout}</a></li>
    </ul>
</nav>

<script>
function toggleMenu() {
    document.querySelector('.navbar').classList.toggle('active');
}
</script>
