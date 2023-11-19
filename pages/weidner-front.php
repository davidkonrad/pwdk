<main class="mx-auto">

	<section class="front-header">
		<img class="pernille-weidner-logo pernille-weidner-logo-lg" src="assets/pernille-weidner.png" title="Livets hjul" alt="Livets hjul">
		<h1>Psykoterapi og Lydhealing</h1>
		<div id="weidner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/gong-skåle-md.jpg" class="d-block w-100" alt="Gong skåle">
				</div>
				<div class="carousel-item">
					<img src="images/klangmassage-ryg-carousel.jpg" class="d-block w-100" alt="Lydhealing">
				</div>
				<div class="carousel-item">
					<img src="images/klangmassage-carousel.jpg" class="d-block w-100" alt="Klangmassage">
				</div>
				<div class="carousel-item">
					<img src="images/klangmassage-behandling.jpg" class="d-block w-100" alt="Klangmassage">
				</div>
				<div class="carousel-item">
					<img src="images/gong-md.png" class="d-block w-100" alt="Specialfremstillet Gong">
				</div>
			</div>
		</div>
	</section>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="https://www.pernilleweidner.dk">Hjem <span class="sr-only">Hjem</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="psykoterapi">Psykoterapi</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="lydhealing" id="lydhealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Lydhealing
					</a>
					<div class="dropdown-menu" aria-labelledby="lydhealing-dropdown" style="background-color:#f8f9fa;border:0;padding-top:0;margin-top:0;">
						<a class="dropdown-item" href="lydhealing" title="Læs mere om hvad Lydhealing egentlig er">Hvad er lydhealing</a>
						<a class="dropdown-item" href="Lydhealing-til-boern" title="Læs mere om hvordan lydhealing kan have positiv indflydelse på børn">Lydhealing til børn</a>
						<a class="dropdown-item" href="Lydhealing-stress-og-angst" title="Om hvordan Lydhealing kan forebygge stress og angst">Lydhealing stress og angst</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="#" id="gong-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Gong
					</a>
					<div class="dropdown-menu" aria-labelledby="gong-dropdown" style="background-color:#f8f9fa;border:0;padding-top:0;margin-top:0;">
						<a class="dropdown-item" href="gong-terapi" title="Den kraftfulde lyd fra gongerne, kombineret med deres dybe vibrationer, indbyder til en unik og transformerende oplevelse">Gong terapi</a>
						<a class="dropdown-item" href="gong-bad" title="Et gongbad er en form for lydterapi, hvor deltagerne oplever lydene og vibrationerne fra gonger i en meditativ og afslappende kontekst">Gong bad</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="#" id="klanghealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Klang
					</a>
					<div class="dropdown-menu" aria-labelledby="klanghealing-dropdown" style="background-color:#f8f9fa;border:0;padding-top:0;margin-top:0;">
						<a class="dropdown-item" href="Klangmassage">Klangmassage</a>
						<a class="dropdown-item" href="Klangmeditation">Klangmeditation</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="kakao-ceremoni">Kakaoceremoni</a>
				</li>
			</ul>
		</div>
	</nav>

<?php
if (count($_GET)) {
	$pages = array('klangmassage', 'kakao-ceremoni', 'psykoterapi', 'klangmeditation', 'gong-terapi', 'gong-bad',
								'lydhealing', 'lydhealing-til-boern', 'lydhealing-stress-og-angst', 'kontakt');

	$input = strtolower($_SERVER['REQUEST_URI']);
	$cleaned_input = explode('?', $input)[0];
	$cleaned_input = str_replace('/', '', $cleaned_input);

	if ($cleaned_input !== $input && !in_array($cleaned_input, $pages)) {
		//echo '<script>console.log("'.$cleaned_input.")</script>';
		//echo '<script>window.location.href = "https://www.pernilleweidner.dk/'.$cinput.'";</script>';
	}
	
	if (!in_array($cleaned_input, $pages)) {
		$best = -1;
		$suggest = '';
		foreach ($pages as $word) {
			$s = similar_text($word, $input);
			if ($s > $best) {
				$best = $s;
				$suggest = $word;
			}
		}
		$recommend = $suggest !== '' ? 'Måske mente du <a href="'.$suggest.'" class="text-weidner">/'.$suggest.'</a>?' : '';
		echo <<<HTML
		<div class="alert alert-danger p-4 mr-4 ml-4">
			<h5 class="albert">Desværre, siden <em class="text-muted">/{$_GET['page']}</em> findes ikke. {$recommend}</h5>
		</div>
HTML;
	}
}
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
					<a class="weidner-link" href="klangmassage" title="Klangmassage hjælper mod tankemylder, stress, søvnproblemer, angst, smerte, manglende energi mm">indre fred</a>,
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

