<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Login | Klassiekers in je klas</title>
	<link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css">
</head>
<body>
	<div class="container">
		<section>
			<header>
				<h1>Login</h1>
			</header>
			<form method="post" action="" class="login-form">
				<p>
					<label for="login-email">E-mailadres</label>
					<input type="email" name="email" id="login-email" required />
				</p>
				<p>
					<label for="login-password">Wachtwoord</label>
					<input type="password" name="password" id="login-password" required />
				</p>
				<p>
					<input type="submit" name="submit" value="Bestellen" />
				</p>
			</form>
		</section>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="<?php echo $basePath; ?>/js/login.js"></script>
</body>
</html>