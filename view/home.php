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
	<div class="wrapper">
		<div class="logo">
			<a href="http://boek.be">
				<img src="<?php echo $basePath; ?>/images/logo.png" alt="Logo boek.be" />
			</a>
		</div>
		<div class="navigation">
			<a href="#" class="nav-left button">&laquo;</a>
			<a href="#" class="nav-right button">&raquo;</a>
		</div>
		<div class="nav-indicators">
			<ul>
				<li><a href="#page-0" class="nav-indicator">&bullet;</a></li>
				<li><a href="#page-1" class="nav-indicator">&bullet;</a></li>
				<li><a href="#page-2" class="nav-indicator">&bullet;</a></li>
				<li><a href="#page-3" class="nav-indicator">&bullet;</a></li>
			</ul>
		</div>
		<nav class="menu closed">
			<a href="#" class="menu-toggle button">&#9776;</a>
			<ul>
				<li><a href="#page-0" class="nav-menu button">Campagne</a></li>
				<li><a href="#page-1" class="nav-menu button">Boek</a></li>
				<li><a href="#page-2" class="nav-menu button">Voorproefje</a></li>
				<li><a href="#page-3" class="nav-menu button">Klasfoto's</a></li>
				<li><a href="login" class="button">Login</a></li>
			</ul>
		</nav>
		<div class="container">
			<div class="page home">
				<section class="page-screen">
					<header>
						<h1>Klassiekers in je klas</h1>
						<h2>The Hitchhiker's Guide to the Galaxy</h2>
					</header>
					<div class="screen-img"><img src="images/title.png" alt="" /></div>
					<a href="#" class="nav-down">&darr;</a>
				</section>
				<section class="page-content">
					<header class="header-title">
						<h1>Campagne</h1>
					</header>
					<article class="campaign-info">
						<header class="header-content">
							<h1>Verover het heelal met boeken!</h1>
						</header>
						<p>Ter promotie van het lezen en bespreken van boeken in middelbare scholen, organiseert boek.be een actie waar alle docenten nederlands aan mee kunnen doen.
							De prijs van deze actie? 100 exemplaren van de wereldbekende klassieker 'Het Galactisch Liftershandboek', geschreven door Douglas Adams.
						</p>
						<p>
							Deelnemen is simpel. Laat jouw leerlingen 'Hitchhikers Guide to the Galaxy' lezen en dien per deelnemende klas een klassikale boekbespreking in. De jury zal na de deadline van 20 Mei (20:42) stemmen op welke boekbespreking de prijs zal binnenhalen.
						</p>
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
								<input type="submit" name="submit" value="Bestellen" class="button" />
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
					<a href="#" class="nav-down">&darr;</a>
				</section>
				<section class="page-content">
					<article>
						<header class="header-content">
							<h1>Korte inhoud</h1>
						</header>
						<p>Het Transgalactisch Liftershandboek (Engels: The Hitchhikers Guide to the Galaxy) is een komisch sciencefictionfranchise bedacht door Douglas Adams. De boekenserie was echter het succesvolst: tussen 1979 en 1992 verschenen vijf delen van de reeks. Dit jaar nog zal het zesde en laatste deel in het Nederlands verschijnen: "En dan nog iets..."</p>

						<p>Bij het schrijven van het boek heeft Adams goed gekeken naar andere Sience fiction projecten, en hij schuwt ook niet om sommige dingen op de hak te nemen. Zo zijn er onder andere verwijzingen naar Star Trek, Star Wars. Verder zijn de standaard ideeën van de gruwelijk lelijke aliens (de Vogons) ook aanwezig. Deze Vogons zijn behalve oerlelijk ook nog gruwelijk saai, en enorm bureaucratisch. De beschrijving van de aard van de Vogons is enorm grappig, en het hoofdstuk waarin Ford en Arthur vast zitten op een ruimteschip van diezelfde Vogons is dan ook meesterlijk grappig geschreven.</p>

						<p>Verder staat het boek vol van de humor, en tijdens het lezen is het soms zwaar om weer op adem te komen van het lachen. Veel van de grappen zijn te belachelijk, of te flauw voor woorden, maar juist daardoor zijn ze zo goed. Deze humor is voor een groot deel verantwoordelijk voor de grote schare fans die het boek heeft. Het boek is verheven tot een soort cult-status, en naar hun meningen verdiend dit het ook ten volle.</p>
					</article>
					<article>
						<header class="header-content">
							<h1>Douglas Adams</h1>
						</header>
						<p>Douglas Adams heeft een groot aantal banen gehad, waaronder ziekenhuisbode, schoonmaker, lijfwacht, radioproducent en scriptredacteur van Doctor Who. Ook heeft hij met Graham Chapman van Monty Python samengewerkt en wordt hij in de credits van een van de afleveringen daarvan vermeld. Hij is echter het bekendst geworden door zijn hoorspel en boek "The Hitchhiker's Guide to the Galaxy" (HHGTTG), in het Nederlands uitgebracht als Het Transgalactisch Liftershandboek.</p>

						<p>Adams had de reputatie erg moeilijk een boek af te kunnen maken. Misschien daarom dat zijn boeken vrij veel bewerkingen en referenties naar eerder werk bevatten. Adams op zijn best kenmerkt zich door een levendige stijl met vele onverwachte wendingen, absurde plots, subtiele satire met name op de Californische hippie-levensstijl, en een totale minachting voor de logica en fysica van het dagelijks leven.</p>

						<p>Douglas Adams overleed in 2001 op 49-jarige leeftijd aan een hartaanval tijdens een work-out in een sportschool in Santa Barbara. Sinds zijn dood is 25 mei elk jaar Towel Day, als hommage aan de Guide. Het is de bedoeling dat men de gehele dag met een handdoek binnen handbereik rondloopt; een verwijzing naar HHGTTG, waarin een goede lifter "altijd weet waar zijn handdoek is".</p>
					</article>
					<article>
						<header class="header-content">
							<h1>Towel Day</h1>
						</header>
						<p>"Handdoekdag" oftwel "Towel Day" is een evenement bedoeld als eerbetoon aan Douglas Adams. Het evenement werd door fans van Adams' werken bedacht na zijn overlijden op 11 mei 2001, en wordt sindsdien jaarlijks gehouden op 25 mei.</p>

						<p>De bedoeling is dat fans van Adams' werken op Towel Day de hele dag een handdoek mee nemen om zo aan te tonen dat ze zijn werken waarderen. Dit idee is afkomstig uit de boekenreeks, waarin een handdoek bekendstaat als het handigste hulpmiddel dat een intergalactische lifter bij zich kan hebben, en waarvan hij dus altijd moet weten waar hij hem heeft opgeborgen.</p>
					</article>
				</section>
			</div>
			<div class="page excerpt">
				<section class="page-screen">
					<header class="header-title">
						<h1>Voorproefje</h1>
					</header>
					<a href="#" class="nav-down">&darr;</a>
				</section>
				<section class="page-content">
					<article>
						<header class="header-content">
							<h1>Excerpt</h1>
						</header>
						<p>Ver weg in de nimmer in kaart gebrachte achtergebleven gebieden aan de weinig gewilde kant van de Westelijke Spiraalarm van de Melkweg, ligt een kleine, onaanzienlijke, gele zon. In een baan hieromheen cirkelt op een afstand van ruwweg honderdvijftig miljoen kilometer een volslagen onbeduidend blauwgroen planeetje, bewoond door aapachtige levensvormen die zo verbijsterend primitief zijn dat ze nog altijd denken dat het digitale horloge een geweldige uitvinding is.</p>

						<p>Deze planeet zit - of liever gezegd zat - met een probleem: de meeste bewoners ervan waren vrijwel continu ongelukkig. Er werden vele oplossingen voor dit probleem geopperd, maar de meeste daarvan hadden vooral betrekking op het heen en weer schuiven van gekleurde briefjes met getallen op, wat een beetje eigenaardig is, want het waren over het algemeen niet die gekleurde briefjes die zich ongelukkig voelden.</p>

						<p>En dus bleef het probleem bestaan; heel veel mensen waren krenterig en de meesten voelden zich ellendig, zelf degenen met een digitaal horloge. En ze beseften steeds meer dat het een afschuwelijke vergissing was geweest dat ze ooit uit die boom gekomen waren. Sommigen gingen nog verder en zeiden dat die bomen op zich al een domme zet waren geweest en dat ze nooit uit de zee hadden moeten komen.</p>

						<p>En toen, op een goede dag, zo'n tweeduizend jaar nadat er iemand aan een boom gespijkerd was omdat hij had gezegd dat het toch geweldig zou zijn als de mensen voor verandering eens aardig tegen elkaar deden, realiseerde een meisje dat in haar ééntje in een café in Dirkshorn zat zich plotseling wat er nu precies al die tijd was misgegaan. Zo wist zij uiteindelijk hoe de wereld goed en gelukkig moest worden. Deze keer klopte het, het zou lukken, en niemand zou waar dan ook aan vastgespijkerd hoeven worden. Maar voordat zij iemand had kunnen bellen om erover te vertellen, vond er helaas een krankzinnige catastrofe plaats en ging het inzicht voorgoed verloren.</p>
					</article>
				</section>
			</div>
			<div class="page photos">
				<section class="page-screen">
					<header class="header-title">
						<h1>Klasfoto's</h1>
					</header>
					<a href="#" class="nav-down">&darr;</a>
				</section>
				<section class="page-content">
					<input type="search" class="photos-search" />
					<ul class="photos-container"></ul>
				</section>
			</div>
		</div>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="<?php echo $basePath; ?>/js/script.js"></script>
</body>
</html>