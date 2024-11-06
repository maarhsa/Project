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
                        </form>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="disable_maintenance" class="btn btn-disable">{disable_button_text}</button>
                        </form>
                    </div>
                    <!-- Affichage de l'état actuel -->
                    <p class="status-message {status_class}">{maintenance_status_message}</p>
                </section>
            </div>
    </main>
	<br><br><br><br><br>
    <!-- Inclusion du footer -->
    {footer}
</body>
</html>