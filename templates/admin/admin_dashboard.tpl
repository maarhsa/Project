<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{title}</title>
    <link rel="stylesheet" href="../../assets/css/admin_styles.css">
    <script src="assets/jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="assets/css/all.min.css">
</head>
<body>
    <!-- Inclusion du game_menu -->
    {menu}
    <main class="main-content">
        <div class="container">
            <div class="admin-form">
                <h2>{admin_dashboard}</h2>
            </div>
        </div>
        <div class="container">
            <div class="dashboard-stats">
                <h3>{stats_title}</h3>
                <p>{player_online_count}{online_count}</p>
                <p>{player_total_count}{total_count}</p>
            </div>
        </div>
        <div class="container">
                        <!-- Gestion de la maintenance -->
                        <section class="maintenance-control">
                            <h2>{maintenance_title}</h2>
                            <div class="maintenance-buttons">
                                <form method="POST" style="display:inline;">
                                    <button type="submit" name="enable_maintenance" class="btn btn-enable">{enable_button_text}</button>
                                    <button type="submit" name="disable_maintenance" class="btn btn-disable">{disable_button_text}</button>
                                </form>
                            </div>
                            <!-- Affichage de l'état actuel -->
                            <p class="status-message {status_class}">{maintenance_status_message}</p>
                        </section>
                        <!-- Paramètres de Monnaie à l'Inscription -->
                        <section class="initial-credit">
                            <h2>{initial_money_title}</h2>
                            <form method="POST" action="admin_currency_settings.php">
                                <label for="default_credits">{cred_start}</label>
                                <input type="number" id="default_credits" name="default_credits" value="{default_credits}" required>

                                <label for="default_buds">{bud_start}</label>
                                <input type="number" id="default_buds" name="default_buds" value="{default_buds}" required>

                                <button type="submit" name="update_balances">{update}</button>
                            </form>
                            <!-- Mise à jour des crédits initial à l'inscription -->
                            <p class="message">{update_message}</p>
                        </section>
        </div>
    </main>
    <br><br><br><br><br>
    <!-- Inclusion du footer -->
    {footer}
</body>
</html>
