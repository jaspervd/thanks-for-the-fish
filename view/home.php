<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $basePath; ?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Klassiekers in je klas</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
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
			<a href="#" class="menu-toggle button">&#9776;</a>
			<ul>
				<li><a href="#page-0" class="nav-menu button active">Campagne</a></li>
				<li><a href="#page-1" class="nav-menu button">Boek</a></li>
				<li><a href="#page-2" class="nav-menu button">Voorproefje</a></li>
				<li><a href="#page-3" class="nav-menu button">Klasfoto's</a></li>
				<li><a href="login" class="button">Login</a></li>
			</ul>
		</nav>
		<main class="container page-0">
			<div class="page home">
				<section class="page-screen">
					<header class="hide">
						<h1>Klassiekers in je klas</h1>
						<h2>The Hitchhiker's Guide to the Galaxy</h2>
					</header>
					<div class="screen-img move-layer">
						<img src="images/campaign/title.png" srcset="images/campaign/title.png 1x, images/campaign/title@2x.png 2x" alt="" />
					</div>
					<div class="observers">
						<img src="images/campaign/observers.png" srcset="images/campaign/observers.png 1x, images/campaign/observers@2x.png 2x" alt="" />
					</div>
					<div class="cloud-1 move-layer">
						<img src="images/clouds/cloud_1.png" srcset="images/clouds/cloud_1.png 1x, images/clouds/cloud_1@2x.png 2x" alt="" />
					</div>
					<div class="cloud-2 move-layer">
						<img src="images/clouds/cloud_2.png" srcset="images/clouds/cloud_2.png 1x, images/clouds/cloud_2@2x.png 2x" alt="" />
					</div>
					<div class="cloud-3 move-layer">
						<img src="images/clouds/cloud_3.png" srcset="images/clouds/cloud_3.png 1x, images/clouds/cloud_3@2x.png 2x" alt="" />
					</div>
					<div class="cloud-4 move-layer">
						<img src="images/clouds/cloud_4.png" srcset="images/clouds/cloud_4.png 1x, images/clouds/cloud_4@2x.png 2x" alt="" />
					</div>
					<div class="narwhale move-layer">
						<img src="images/campaign/narwhale.png" srcset="images/campaign/narwhale.png 1x, images/campaign/narwhale@2x.png 2x" alt="" />
					</div>
					<div class="spacecraft move-layer">
						<img src="images/campaign/spacecraft.png" srcset="images/campaign/spacecraft.png 1x, images/campaign/spacecraft@2x.png 2x" alt="" />
					</div>
					<a href="#" class="nav-down participate move-layer">
						<img src="images/campaign/participate.png" srcset="images/campaign/participate.png 1x, images/campaign/participate@2x.png 2x" alt="Neem deel &amp; win 100 exemplaren!" />
					</a>
				</section>
				<section class="page-content active">
					<header class="header-title">
						<h2>Campagne</h2>
					</header>
					<div class="campaign-wrapper show">
						<article class="campaign-info">
							<header class="header-content">
								<h2>Verover het heelal met boeken!</h2>
							</header>
							<p class="text">Ter promotie van het lezen en bespreken van boeken in middelbare scholen, organiseert <a href="http://boek.be">boek.be</a> een actie waar alle docenten Nederlands aan mee kunnen doen.
								De prijs van deze actie? 100 exemplaren van de wereldbekende klassieker 'Het Galactisch Liftershandboek', geschreven door Douglas Adams.
							</p>
							<p class="text">
								Deelnemen is simpel. Laat jouw leerlingen 'Hitchhikers Guide to the Galaxy' lezen en dien per deelnemende klas een klassikale boekbespreking in. De jury zal na de deadline van 20 Mei (20:42) stemmen op welke boekbespreking de prijs zal binnenhalen.
							</p>
							<p class="text center">
								<input type="button" class="toggle-order button submit" value="Deelnemen!" />
							</p>
						</article>
						<article class="countdown">
							<header class="header-content">
								<h2>Tijd tot de <time datetime="2016-05-20 20:42">deadline</time></h2>
							</header>
							<div class="clock">
								<div class="countdown-days"><span>0</span>dagen</div>
								<div class="countdown-hours"><span>0</span>uur</div>
								<div class="countdown-minutes"><span>0</span>minuten</div>
								<div class="countdown-seconds"><span>0</span>seconden</div>
							</div>
							<div class="clear"></div>
						</article>
						<blockquote>
							<p>
								Panikeer niet
							</p>
							<footer>
								Douglas Adams
							</footer>
						</blockquote>
					</div>
					<article class="order hide">
						<header class="header-content">
							<h2>Bestelformulier</h2>
						</header>
						<form method="post" action="/" class="order-form">
							<p class="input-wrapper">
								<label for="firstname">Voornaam</label>
								<input type="text" name="firstname" id="firstname" required />
							</p>
							<p class="input-wrapper right">
								<label for="lastname">Achternaam</label>
								<input type="text" name="lastname" id="lastname" required />
							</p>
							<p class="input-wrapper">
								<label for="email">E-mailadres</label>
								<input type="email" name="email" id="email" required />
							</p>
							<p class="input-wrapper right">
								<label for="phone">Telefoonnummer</label>
								<input type="tel" name="phone" id="phone" placeholder="0412 34 45 67" required />
							</p>
							<p class="input-wrapper">
								<label for="password">Wachtwoord</label>
								<input type="password" name="password" id="password" required />
							</p>
							<p class="input-wrapper right">
								<label for="password_repeat">Wachtwoord herhalen</label>
								<input type="password" name="password_repeat" id="password_repeat" required />
							</p>
							<p class="input-wrapper">
								<label for="school_name">Schoolnaam</label>
								<input type="text" name="school_name" id="school_name" required />
							</p>
							<p class="input-wrapper right">
								<label for="school_email">School e-mailadres</label>
								<input type="email" name="school_email" id="school_email" required />
							</p>
							<p class="input-wrapper">
								<label for="school_address">Schooladres</label>
								<input type="text" name="school_address" id="school_address" required />
							</p>
							<p class="input-wrapper right">
								<label for="school_website">Schoolwebsite</label>
								<input type="url" name="school_website" id="school_website" required />
							</p>
							<p class="input-wrapper">
								<a href="#" class="toggle-order" tabindex="-1">Ga terug</a>
							</p>
							<p class="input-wrapper right center">
								<input type="submit" name="submit" value="Bestellen" class="button submit" />
							</p>
						</form>
					</article>
				</section>
			</div>
			<div class="page book">
				<section class="page-screen">
					<header class="hide">
						<h1>Informatie over het boek en de auteur</h1>
					</header>
					<div class="cloud-1 move-layer">
						<img src="images/clouds/cloud_1.png" srcset="images/clouds/cloud_1.png 1x, images/clouds/cloud_1@2x.png 2x" alt="" />
					</div>
					<div class="cloud-2 move-layer">
						<img src="images/clouds/cloud_2.png" srcset="images/clouds/cloud_2.png 1x, images/clouds/cloud_2@2x.png 2x" alt="" />
					</div>
					<div class="ford-prefect move-layer">
						<img src="images/book/ford_prefect.png" srcset="images/book/ford_prefect.png 1x, images/book/ford_prefect@2x.png 2x" alt="" />
					</div>
					<div class="book-cloud move-layer">
						<img src="images/book/book_cloud.png" srcset="images/book/book_cloud.png 1x, images/book/book_cloud@2x.png 2x" alt="" />
					</div>
					<div class="cloud-3 move-layer">
						<img src="images/clouds/cloud_3.png" srcset="images/clouds/cloud_3.png 1x, images/clouds/cloud_3@2x.png 2x" alt="" />
					</div>
				</section>
				<section class="page-content">
					<header class="header-title">
						<h1>Boek</h1>
					</header>
					<blockquote>
						<p>
							Met een geestig gevoel voor humor, een goed oog voor detail en een grote dosis inzicht... Adams doet ons lachen tot we erbij neervallen.
						</p>
						<footer>
							San Diego Union
						</footer>
					</blockquote>
					<article>
						<header class="header-content">
							<h2>Korte inhoud</h2>
						</header>
						<p class="text">Het Transgalactisch Liftershandboek (Engels: The Hitchhikers Guide to the Galaxy) is een komisch sciencefictionfranchise bedacht door Douglas Adams. De boekenserie was echter het succesvolst: tussen 1979 en 1992 verschenen vijf delen van de reeks. Dit jaar nog zal het zesde en laatste deel in het Nederlands verschijnen: "En dan nog iets..."</p>

						<p class="text">Bij het schrijven van het boek heeft Adams goed gekeken naar andere Sience fiction projecten, en hij schuwt ook niet om sommige dingen op de hak te nemen. Zo zijn er onder andere verwijzingen naar Star Trek, Star Wars. Verder zijn de standaard ideeën van de gruwelijk lelijke aliens (de Vogons) ook aanwezig. Deze Vogons zijn behalve oerlelijk ook nog gruwelijk saai, en enorm bureaucratisch. De beschrijving van de aard van de Vogons is enorm grappig, en het hoofdstuk waarin Ford en Arthur vast zitten op een ruimteschip van diezelfde Vogons is dan ook meesterlijk grappig geschreven.</p>

						<p class="text">Verder staat het boek vol van de humor, en tijdens het lezen is het soms zwaar om weer op adem te komen van het lachen. Veel van de grappen zijn te belachelijk, of te flauw voor woorden, maar juist daardoor zijn ze zo goed. Deze humor is voor een groot deel verantwoordelijk voor de grote schare fans die het boek heeft. Het boek is verheven tot een soort cult-status, en naar hun meningen verdiend dit het ook ten volle.</p>
					</article>
					<blockquote>
						<p>
							Is er überhaupt wel thee op dit ruimteschip?
						</p>
						<footer>
							Arthur Dent
						</footer>
					</blockquote>
					<article>
						<header class="header-content">
							<h2>Douglas Adams</h2>
						</header>
						<p class="text">Douglas Adams heeft een groot aantal banen gehad, waaronder ziekenhuisbode, schoonmaker, lijfwacht, radioproducent en scriptredacteur van Doctor Who. Ook heeft hij met Graham Chapman van Monty Python samengewerkt en wordt hij in de credits van een van de afleveringen daarvan vermeld. Hij is echter het bekendst geworden door zijn hoorspel en boek "The Hitchhiker's Guide to the Galaxy" (HHGTTG), in het Nederlands uitgebracht als Het Transgalactisch Liftershandboek.</p>

						<p class="text">Adams had de reputatie erg moeilijk een boek af te kunnen maken. Misschien daarom dat zijn boeken vrij veel bewerkingen en referenties naar eerder werk bevatten. Adams op zijn best kenmerkt zich door een levendige stijl met vele onverwachte wendingen, absurde plots, subtiele satire met name op de Californische hippie-levensstijl, en een totale minachting voor de logica en fysica van het dagelijks leven.</p>

						<p class="text">Douglas Adams overleed in 2001 op 49-jarige leeftijd aan een hartaanval tijdens een work-out in een sportschool in Santa Barbara. Sinds zijn dood is 25 mei elk jaar Towel Day, als hommage aan de Guide. Het is de bedoeling dat men de gehele dag met een handdoek binnen handbereik rondloopt; een verwijzing naar HHGTTG, waarin een goede lifter "altijd weet waar zijn handdoek is".</p>
					</article>
					<article>
						<header class="header-content">
							<h2>Towel Day</h2>
						</header>
						<p class="text">"Handdoekdag" oftwel "Towel Day" is een evenement bedoeld als eerbetoon aan Douglas Adams. Het evenement werd door fans van Adams' werken bedacht na zijn overlijden op 11 mei 2001, en wordt sindsdien jaarlijks gehouden op 25 mei.</p>

						<p class="text">De bedoeling is dat fans van Adams' werken op Towel Day de hele dag een handdoek mee nemen om zo aan te tonen dat ze zijn werken waarderen. Dit idee is afkomstig uit de boekenreeks, waarin een handdoek bekendstaat als het handigste hulpmiddel dat een intergalactische lifter bij zich kan hebben, en waarvan hij dus altijd moet weten waar hij hem heeft opgeborgen.</p>
					</article>
					<blockquote>
						<p>
							Alles was klaar, alles was voorbereid, hij wist waar zijn handdoek was.
						</p>
						<footer>
							Douglas Adams
						</footer>
					</blockquote>
				</section>
			</div>
			<div class="page excerpt">
				<section class="page-screen">
					<header class="hide">
						<h1>Een stuk uit het boek</h1>
					</header>
					<div class="cloud-1 move-layer">
						<img src="images/clouds/cloud_1.png" srcset="images/clouds/cloud_1.png 1x, images/clouds/cloud_1@2x.png 2x" alt="" />
					</div>
					<div class="whale-cloud move-layer">
						<img src="images/whale/whale_cloud.png" srcset="images/whale/whale_cloud.png 1x, images/whale/whale_cloud@2x.png 2x" alt="" />
					</div>
					<div class="space-whale move-layer">
						<img src="images/whale/space_whale.png" srcset="images/whale/space_whale.png 1x, images/whale/space_whale@2x.png 2x" alt="" />
					</div>
					<div class="flower-spout move-layer">
						<img src="images/whale/flower_spout.png" srcset="images/whale/flower_spout.png 1x, images/whale/flower_spout@2x.png 2x" alt="" />
					</div>
					<div class="cloud-4 move-layer">
						<img src="images/clouds/cloud_4.png" srcset="images/clouds/cloud_4.png 1x, images/clouds/cloud_4@2x.png 2x" alt="" />
					</div>
				</section>
				<section class="page-content">
					<header class="header-title">
						<h1>Voorproefje</h1>
					</header>
					<blockquote>
						<p>
							Weet je wel hoeveel schade deze bulldozer zou oplopen als ik hem gewoon over je liet rijden?
						</p>
						<footer>
							Mr. Prosser
						</footer>
					</blockquote>
					<article>
						<header class="header-content">
							<h2>Excerpt</h2>
						</header>
						<p class="text">Ver weg in de nimmer in kaart gebrachte achtergebleven gebieden aan de weinig gewilde kant van de Westelijke Spiraalarm van de Melkweg, ligt een kleine, onaanzienlijke, gele zon. In een baan hieromheen cirkelt op een afstand van ruwweg honderdvijftig miljoen kilometer een volslagen onbeduidend blauwgroen planeetje, bewoond door aapachtige levensvormen die zo verbijsterend primitief zijn dat ze nog altijd denken dat het digitale horloge een geweldige uitvinding is.</p>

						<p class="text">Deze planeet zit - of liever gezegd zat - met een probleem: de meeste bewoners ervan waren vrijwel continu ongelukkig. Er werden vele oplossingen voor dit probleem geopperd, maar de meeste daarvan hadden vooral betrekking op het heen en weer schuiven van gekleurde briefjes met getallen op, wat een beetje eigenaardig is, want het waren over het algemeen niet die gekleurde briefjes die zich ongelukkig voelden.</p>

						<p class="text">En dus bleef het probleem bestaan; heel veel mensen waren krenterig en de meesten voelden zich ellendig, zelf degenen met een digitaal horloge. En ze beseften steeds meer dat het een afschuwelijke vergissing was geweest dat ze ooit uit die boom gekomen waren. Sommigen gingen nog verder en zeiden dat die bomen op zich al een domme zet waren geweest en dat ze nooit uit de zee hadden moeten komen.</p>

						<p class="text">En toen, op een goede dag, zo'n tweeduizend jaar nadat er iemand aan een boom gespijkerd was omdat hij had gezegd dat het toch geweldig zou zijn als de mensen voor verandering eens aardig tegen elkaar deden, realiseerde een meisje dat in haar ééntje in een café in Dirkshorn zat zich plotseling wat er nu precies al die tijd was misgegaan. Zo wist zij uiteindelijk hoe de wereld goed en gelukkig moest worden. Deze keer klopte het, het zou lukken, en niemand zou waar dan ook aan vastgespijkerd hoeven worden. Maar voordat zij iemand had kunnen bellen om erover te vertellen, vond er helaas een krankzinnige catastrofe plaats en ging het inzicht voorgoed verloren.</p>
					</article>
					<blockquote>
						<p>
							Eén van de grappigste Science Fiction parodiën ooit geschreven.
						</p>
						<footer>
							School Library Journal
						</footer>
					</blockquote>
					<aside>
						<header>
							<h2>Tips &amp; Tricks</h2>
						</header>
						<ul>
							<li>Neem altijd een handdoek mee</li>
							<li>Laat Vogons geen poëzie voorlezen</li>
							<li>Je kunt 30 seconden lang overleven in de ruimte</li>
							<li>Vermijd liefde</li>
							<li>De beste cocktail is en blijft de Pan Galactic Gargle Blaster (of Breinbeuker)</li>
							<li>Het belangrijkste voor het laatste: Geen paniek.</li>
						</ul>
					</aside>
				</section>
			</div>
			<div class="page photos">
				<section class="page-screen">
					<header class="hide">
						<h1>Een overzicht van de inzendingen</h1>
					</header>
					<div class="planetearth move-layer">
						<img src="images/photos/planetearth.png" srcset="images/photos/planetearth.png 1x, images/photos/planetearth@2x.png 2x" alt="" />
					</div>
					<div class="spacehiker move-layer">
						<img src="images/photos/spacehiker.png" srcset="images/photos/spacehiker.png 1x, images/photos/spacehiker@2x.png 2x" alt="" />
					</div>
					<div class="mouse move-layer">
						<img src="images/photos/mouse.png" srcset="images/photos/mouse.png 1x, images/photos/mouse@2x.png 2x" alt="" />
					</div>
					<div class="hitchhikers move-layer">
						<img src="images/photos/hitchhikers.png" srcset="images/photos/hitchhikers.png 1x, images/photos/hitchhikers@2x.png 2x" alt="" />
					</div>
					<div class="thelooker">
						<img src="images/photos/thelooker.png" srcset="images/photos/thelooker.png 1x, images/photos/thelooker@2x.png 2x" alt="" />
					</div>
				</section>
				<section class="page-content">
					<header class="header-title">
						<h2>Klasfoto's</h2>
					</header>
					<p class="input-wrapper">
						<input type="search" class="photos-search" placeholder="Zoek op klasnaam" />
					</p>
					<div class="clear"></div>
					<ul class="photos-container"></ul>
					<p class="text no-photos-found hide">Er zijn geen foto's gevonden met de opgegeven zoekterm.</p>
					<div class="clear"></div>
					<p class="text center">
						<a href="#page-0" class="add-class">Voeg je klas toe!</a>
					</p>
					<blockquote>
						<p>
							Ik ken dit waanzinnig goed restaurant op het uiteinde van het universum.
						</p>
						<footer>
							Ford Prefect
						</footer>
					</blockquote>
				</section>
			</div>
		</main>
		<div class="navigation">
			<a href="#" class="nav-left button">&lt;</a>
			<a href="#" class="nav-right button">&gt;</a>
			<a href="#" class="nav-down button">
				<img src="images/petunia.png" srcset="images/petunia.png 1x, images/petunia@2x.png 2x" alt="Logo boek.be" />
				&darr;
			</a>
		</div>
	</div>
	<script>
	window.app = window.app || {};
	window.app.basename = '<?php echo $basePath;?>';
	</script>
	<script src="js/script.js"></script>
</body>
</html>