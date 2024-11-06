<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{registration_title}</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	{menu}
	<br>
	<br>
    <div class="container">
        <div class="registration-form">
            <h2>{registration_title}</h2>
            <form action="register.php" method="POST">
                <label for="username">{username}</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">{email}</label>
                <input type="email" id="email" name="email" required>

                <label for="confirm_email">{confirm_email}</label>
                <input type="email" id="confirm_email" name="confirm_email" required>
                
                <label for="password">{password}</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">{confirm_password}</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
				
				<label for="recovery_word">{recovery_word_label}</label>
                <input type="text" id="recovery_word" name="recovery_word" required>
                
				<label for="confirm">{terms_conditions}</label>
				<input type="checkbox" id="confirm" name="confirm" required>
		
                <button type="submit">{register}</button>
            </form>
			<!-- Placeholder pour le message d'erreur -->
            <div class="error-message">{error_message}</div>
        </div>
    </div>
	<br>
	<br>
	<br>
	{footer}
</body>
</html>
