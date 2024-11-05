<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{forgot_password_title}</title>
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    {menu}
	<br>
	<br>
    <div class="container">
		<div class="recovery-form">
			<h2>{forgot_password_title}</h2>
			<form method="POST" action="forgot_password.php">
				<label for="email">{email_label}</label>
				<input type="email" id="email" name="email" required>

				<label for="recovery_word">{recovery_word_label}</label>
				<input type="text" id="recovery_word" name="recovery_word" required>

				<button type="submit">{submit_button}</button>
			</form>
		</div>
    </div>
	<br>
	<br>
	<br>
	<br>
    {footer}
</body>
</html>
