<?php 
include 'pages/utils.php'; 
?>
<main class="mx-auto">
	<section class="front-header">
		<header class="d-flex justify-content-between pt-1">
			<small><a href="mailto:info@pernilleweidner.dk" class="ml-2 text-weidner arsenal-bold" title="Skriv email til Pernille" aria-label="Skriv til Pernille Weidner">info@pernilleweidner.dk</a></small>
			<small><a href="tel:26814034" class="mr-2 text-weidner arsenal-bold" title="Klik / tap for at ringe op ..." aria-label="Ring til Pernille Weidner">(+45) 26 81 40 34</a></small>
		</header>
		<img class="pernille-weidner-logo pernille-weidner-logo-lg" src="images/pernille-weidner-logo.webp" title="Gong-bad, gong-terapi, klangmessage og psykoterapi" Livets hjul" alt="Livets hjul">
		<a href="https://www.pernilleweidner.dk" class="text-decoration-none" title="Gå til forside">
			<h1>Psykoterapi og Lydhealing</h1>
		</a>
		<div id="weidner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/gong-skåle-md.jpg" class="d-block w-100" alt="Klangskåle">
				</div>
				<div class="carousel-item">
					<img src="images/mange-gonger-karrusel.webp" class="d-block w-100" alt="Gongbad og gongterapi">
				</div>
				<div class="carousel-item">
					<img src="images/lydhealing-og-boern-md.webp" class="d-block w-100" alt="Lydhealing">
				</div>
				<div class="carousel-item">
					<img src="images/klangmassage-carousel.jpg" class="d-block w-100" alt="Klangmassage">
				</div>
			</div>
		</div>
	</section>
<?php 
include 'pages/menu.php'; 
?>
<?php
Utils::isURLValid();
?>
	<div class="py-3">
		<div class="container">
			<div class="pt-sm-1 pl-sm-3 pr-sm-3 pb-sm-3">
				<p>
					Jeg brænder for at hjælpe mennesker med at finde ro og balance i deres liv. Den verden vi lever i, 
					er fyldt med travlhed og konstante forandringer, hvilket gør det vigtigere end nogensinde, at genopdage vores indre ro og 
					<a class="weidner-link" href="gong-terapi" title="Gong-terapi skaber bedre harmoni og forbindelse på både fysisk og åndeligt plan">harmoni</a>.
				</p>
				<p>
					Jeg tror på at vejen til denne ro, begynder med at forstå os selv dybere, både vores tanker og vores følelser. 
					Her bruger jeg psykoterapien til at hjælpe dig til større selvreflektion og selvindsigt. 
				</p>
				<p>
					<a class="weidner-link" href="lydhealing" title="Hvad er Lydhealing?">Lydhealing</a> bruger jeg til at skabe dyb ro i krop og sind, 
					dette kan både være i kombination med <a class="weidner-link" href="psykoterapi" title="Oplevelsesorienteret psykoterapi og gestalt-terapi">psykoterapien</a>, 
					men kan også stå alene. Disse metoder vil lære dig at navigere i livets udfordringer, med større lethed og tilstedeværelse. 
				</p>
				<p>
					Det giver mig en dyb følelse af glæde og meningsfuldhed, at guide andre på denne rejse mod 
					<a class="weidner-link" href="kakao-ceremoni" title="Prøv at dikke ceremoniel cacao, et afbræk i en travl hverdag">indre ro</a>. 
					Det er fantastisk at se folk opdage deres egne ressourcer, selv når verden omkring os kan virke kaotisk. 
				</p>
				<p>
					Jeg vil glæde mig til, sammen med dig, at udforske veje til 
					<a class="weidner-link" href="klang-massage" title="Klangmassage hjælper mod tankemylder, stress, søvnproblemer, angst, smerte, manglende energi mm">indre fred</a>,
					og jeg ser meget frem til at hjælpe dig på din rejse.
				</p>
			</div>

			<div class="d-flex justify-content-around pb-md-4">
				<a href="anbefalinger" class="btn btn-raised btn-weidner shadow d-none d-lg-block albert" title="Læs anbefalinger fra nogle af mine herlige klienter">Anbefalinger</a>
				<a href="kontakt" class="btn btn-raised btn-weidner shadow albert" title="Se hvilke tidspunkter du kan komme i kontakt med mig">Bestil Tid</a>
				<a href="https://facebook.com/groups/1391458601057676" target=_blank class="btn-icon" title="Følg Pernilles cacao og lydunivers🍀🎶" aria-label="Følg Pernille Weidner på Facebook">
					<i class="fa fa-facebook fa-fw" style="color:#3b5998;font-size:3rem;font-weight:900;"></i>
				</a>
				<a href="https://instagram.com/pernilleweidner_firmaprofil" target=_blank class="btn-icon" title="Lydhealing🎶💗klangmassage🎵😌gong terapi✨Klangmeditation🌟✨Psykoterapi🪷Cacao ceremonier🍃💗Plantemedicinske rejser🌿🌱" aria-label="Følg Pernille Weidner på Instagram">
					<i class="fa fa-instagram fa-fw instagram" style="font-size:3rem;font-weight:900;"></i>
				</a>
			</div>
		</div>
	</div>
</main>

<?php
include('pages/footer.html');
?>

