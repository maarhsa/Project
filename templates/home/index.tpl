<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title}</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="assets/css/all.min.css">
</head>
<body>
    <!-- Inclusion du home_menu -->
    {menu}
    <br><br>
    <!-- Section principale avec le formulaire de connexion -->
    <main class="main-content">
        <div class="container">
            <!-- Section de connexion à gauche -->
            <div class="login-section">
                <form class="login-form" method="POST" action="index.php">
                    <label for="username">{username_label}</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
                    
                    <label for="password">{password_label}</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    
                    <button type="submit" class="login-button" name="login">{login_button}</button>
					<br>
                    <a href="forgot_password.php">{reset_password}</a>
                </form>
                <!-- Placeholder pour le message d'erreur -->
                <div class="error-message">{error_message}</div>
            </div>
            <!-- Section de bienvenue à droite -->
            <div class="welcome-section">
                <h1>{welcome_message}</h1><br>
                <p>{game_description}</p>
				<br>
                <a href="register.php" class="register-button">{start_button}</a>
            </div>
        </div>
		<br><br>
        <div class="container">
            <div class="attention-section">
                <h1>{attention}</h1>
                <p>{info_weed}</p>
                <p>{info_weed2}</p>
            </div>
        </div>
		<br>
        <!-- Section des images en dessous -->
		<div class="container">
			<div class="image-row">
				<div class="image-box">Image</div>
				<div class="image-box">Image</div>
				<div class="image-box">Image</div>
				<div class="image-box">Image</div>
				<div class="image-box">Image</div>
			</div>
		</div>
        <br><br><br><br><br>
    </main>
    <!-- Inclusion du footer -->
    {footer}
</body>
</html>