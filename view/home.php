<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Klassiekers in je klas</title>
	<link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css">
</head>
<body>
	<div class="navigation">
		<a href="#" class="nav-left">&laquo;</a>
		<a href="#" class="nav-right">&raquo;</a>
	</div>
	<div class="container">
		<div class="page home">
			<section class="page-screen">
				<header>
					<h1>Klassiekers in je klas</h1>
					<h2>The Hitchhiker's Guide to the Galaxy</h2>
				</header>
			</section>
			<section class="page-content">
				<header>
					<h1>Campagne</h1>
				</header>
				<article class="campaign-info">
					<header>
						<h1>Info</h1>
					</header>
				</article>
				<article class="countdown">
					<div class="countdown-days">0</div>
					<div class="countdown-hours">0</div>
					<div class="countdown-minutes">0</div>
					<div class="countdown-seconds">0</div>
				</article>
				<article class="order">
					<form method="post" action="" class="order-form">
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
							<label for="phone">Telefoonnummer</label>
							<input type="tel" name="phone" id="phone" placeholder="0412 34 45 67" required />
						</p>
						<p>
							<label for="password">Wachtwoord</label>
							<input type="password" name="password" id="password" required />
						</p>
						<p>
							<label for="password_repeat">Wachtwoord herhalen</label>
							<input type="password" name="password_repeat" id="password_repeat" required />
						</p>
						<p>
							<label for="school_name">Schoolnaam</label>
							<input type="text" name="school_name" id="school_name" required />
						</p>
						<p>
							<label for="school_email">School e-mailadres</label>
							<input type="email" name="school_email" id="school_email" required />
						</p>
						<p>
							<label for="school_address">Schooladres</label>
							<input type="text" name="school_address" id="school_address" required />
						</p>
						<p>
							<label for="school_website">Schoolwebsite</label>
							<input type="url" name="school_website" id="school_website" required />
						</p>
						<p>
							<input type="submit" name="submit" value="Bestellen" />
						</p>
					</form>
				</article>
			</section>
		</div>
		<div class="page book">
			<section class="page-screen">
				<header>
					<h1>Boek</h1>
				</header>
			</section>
			<section class="page-content">

			</section>
		</div>
		<div class="page excerpt">
			<section class="page-screen">
				<header>
					<h1>Voorproefje</h1>
				</header>
			</section>
			<section class="page-content">

			</section>
		</div>
		<div class="page photos">
			<section class="page-screen">
				<header>
					<h1>Klasfoto's</h1>
				</header>
			</section>
			<section class="page-content">

			</section>
		</div>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="<?php echo $basePath; ?>/js/script.js"></script>
</body>
</html>