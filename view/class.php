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
	<div class="container">
		<section>
			<header>
				<h1>Hallo <?php echo $teacher['firstname']; ?>!</h1>
			</header>
		</section>
		<section class="overview">
			<header>
				<h1>Overzicht klasfoto's</h1>
			</header>
		</section>
		<section>
			<header>
				<h1>Voeg een boekbespreking toe</h1>
			</header>
			<form method="post" action="">
				<p>
					<label for="nickname">Nickname voor je klas</label>
					<input type="text" name="nickname" id="nickname" required />
				</p>
				<p>
					<label for="photo">Klasfoto</label>
					<input type="file" name="photo" id="photo" required />
				</p>
				<p>
					<label for="review">Boekbespreking</label>
					<textarea name="review" id="review" required></textarea>
				</p>
			</form>
		</section>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="<?php echo $basePath; ?>/js/script.js"></script>
</body>
</html>