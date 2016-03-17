<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Klassiekers in je klas</title>
	<link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css">
</head>
<body>
	<div class="container">
		<h1>Klassiekers in je klas</h1>
	</div>
	<div class="countdown">
		<div class="countdown-days">0</div>
		<div class="countdown-hours">0</div>
		<div class="countdown-minutes">0</div>
		<div class="countdown-seconds">0</div>
	</div>
	<form method="post" action="">
		<p>
			<label for="firstname">Voornaam</label>
			<input type="text" name="firstname" id="firstname" required />
		</p>
		<p>
			<label for="lastname">Achternaam</label>
			<input type="text" name="lastname" id="lastname" required />
		</p>
		<p>
			<label for="email">E-mailadres</label>
			<input type="email" name="email" id="email" required />
		</p>
		<p>
			<label for="number">Telefoonnummer</label>
			<input type="tel" name="number" id="number" placeholder="0412 34 45 67" required />
		</p>
		<p>
			<label for="password">Wachtwoord</label>
			<input type="password" name="password" id="password" required />
		</p>
		<p>
			<label for="password-repeat">Wachtwoord herhalen</label>
			<input type="password" name="password-repeat" id="password-repeat" required />
		</p>
		<p>
			<label for="school-name">Schoolnaam</label>
			<input type="text" name="school-name" id="school-name" required />
		</p>
		<p>
			<label for="school-email">School e-mailadres</label>
			<input type="text" name="school-email" id="school-email" required />
		</p>
		<p>
			<label for="school-address">Schooladres</label>
			<input type="text" name="school-address" id="school-address" required />
		</p>
		<p>
			<label for="school-website">Schoolwebsite</label>
			<input type="url" name="school-website" id="school-website" required />
		</p>
		<p>
			<input type="submit" name="submit" value="Bestellen" />
		</p>
	</form>
	<script src="<?php echo $basePath; ?>/js/script.js"></script>
</body>
</html>