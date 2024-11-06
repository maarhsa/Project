<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{reset_password_title}</title>
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    {menu}
	<br>
	<br>
    <div class="container">
		<div class="resetpassword-form">
			<h2>{reset_password_title}</h2>
			<form method="POST">
				<p class="error-message">{error_message}</p>
				<label for="new_password">{new_password_label}</label>
				<input type="password" id="new_password" name="new_password" required>

				<label for="confirm_password">{confirm_password_label}</label>
				<input type="password" id="confirm_password" name="confirm_password" required>

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