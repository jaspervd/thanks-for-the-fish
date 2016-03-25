<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $basePath; ?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Klas | Klassiekers in je klas</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="class">
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
					<h1>Hallo <?php echo $teacher['firstname']; ?>!</h1>
				</header>
				<article class="photos overview">
					<header class="header-content button">
						<h2>Overzicht klasfoto's</h2>
					</header>
					<ul class="photos-container">
						<li class="text no-photos-found">Er zijn nog geen klassen toegevoegd.</li>
					</ul>
					<div class="clear"></div>
				</article>
				<article>
					<header class="header-content button">
						<h2>Voeg een boekbespreking toe</h2>
					</header>
					<form method="post" action="/" class="class-form" enctype="multipart/form-data">
						<p class="input-wrapper">
							<label for="nickname">Nickname voor je klas</label>
							<input type="text" name="nickname" id="nickname" required />
						</p>
						<p class="input-wrapper">
							<label for="photo">Klasfoto</label>
							<input type="file" name="photo" id="photo" required />
						</p>
						<p class="input-wrapper">
							<label for="entry">Boekbespreking</label>
							<textarea name="entry" id="entry" required></textarea>
						</p>
						<p class="input-wrapper">
							<label for="num_students">Aantal leerlingen</label>
							<input type="number" name="num_students" id="num_students" min="1" required />
						</p>
						<p class="input-wrapper right">
							<input type="submit" name="submit" class="button submit" value="Toevoegen" />
						</p>
					</form>
				</article>
			</section>
		</main>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="js/class.js"></script>
</body>
</html>