<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $basePath; ?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Login | Klassiekers in je klas</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="login">
	<div class="wrapper">
		<div class="logo">
			<a href="http://boek.be">
				<img src="images/logo.png" srcset="images/logo.png 1x, images/logo@2x.png 2x" alt="Logo boek.be" />
			</a>
		</div>
		<nav class="menu closed">
			<header class="hide">
				<h1>Menu</h1>
			</header>
			<a href="<?php echo $basePath; ?>" class="menu-toggle button">&lt; terug</a>
		</nav>
		<main class="container">
			<section class="page-screen">
				<header class="hide">
					<h1>Login</h1>
				</header>
				<form method="post" action="" class="login-form">
					<p class="input-wrapper">
						<label for="login-email">E-mailadres</label>
						<input type="email" name="email" id="login-email" required />
					</p>
					<p class="input-wrapper">
						<label for="login-password">Wachtwoord</label>
						<input type="password" name="password" id="login-password" required />
					</p>
					<p class="input-wrapper center">
						<input type="submit" name="submit" value="Inloggen" class="button submit" />
					</p>
					<div class="clear"></div>
				</form>
			</section>
		</main>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="js/login.js"></script>
</body>
</html>