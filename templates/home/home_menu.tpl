<header class="header">
    <nav class="navbar">
        <div class="logo">
            <img src="../assets/images/logo/Weed_Valley_Logo.png" alt="Weed Valley Logo">
        </div>
        <ul class="menu">
            <li><a href="index.php">{home}</a></li>
            <li><a href="#">{rules}</a></li>
            <li><a href="https://discord.com/">{contact}</a></li>
            <li><a href="changelog.php">{changelog}</a></li>
        </ul>
        <div class="language-menu">
            <form method="get" action="index.php" class="language-form">
                <select name="lang" onchange="this.form.submit()" class="language-selector">
                    <option value="fr" {selected_fr}>Français</option>
                    <option value="en" {selected_en}>English</option>
                    <option value="es" {selected_es}>Español</option>
                    <option value="de" {selected_de}>Deutsch</option>
                    <option value="it" {selected_it}>Italiano</option>
                    <option value="nl" {selected_nl}>Nederlands</option>
                    <option value="pt" {selected_pt}>Português</option>
                </select>
            </form>
        </div>
    </nav>
</header>
