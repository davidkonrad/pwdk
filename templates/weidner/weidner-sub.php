<?php

function testActive($link) {
	if (strpos($_GET['page'], $link) !== false) {
	 echo 'active';
	}
}

function testLink() {
	if (!count($_GET)) return;
	$pages = array('klang-massage', 'kakao-ceremoni', 'psykoterapi', 'klang-meditation', 'gong-terapi', 
								'gong-bad',	'lydhealing', 'lydhealing-til-boern', 'lydhealing-stress-og-angst', 
								'kontakt', 'om-pernille-weidner');

	$input = strtolower($_SERVER['REQUEST_URI']);
	$cleaned_input = explode('?', $input)[0];
	$cleaned_input = str_replace(array('pwdk', '/'), '', $cleaned_input);

	//echo $cleaned_input;

	if ($cleaned_input !== $input && !in_array($cleaned_input, $pages)) {
		//echo '<script>console.log("'.$cleaned_input.")</script>';
		//fjern på server
		//echo '<script>window.location.href = "https://www.pernilleweidner.dk/'.$cleaned_input.'";</script>';
	}
	
	$suggest = '';
	if (!in_array($cleaned_input, $pages)) {
		$best = -1;
		foreach ($pages as $word) {
			$s = similar_text($word, $input);
			if ($s > $best) {
				$best = $s;
				$suggest = $word;
			}
		}
	}

	//echo 'X '.$word;

	$recommend = $suggest !== '' ? 'Måske mente du <a href="'.$suggest.'" class="text-weidner">/'.$suggest.'</a>?' : false;
	return $recommend;
}		
?>	

<main class="mx-auto">

	<section class="front-header">
		<a href="https://www.pernilleweidner.dk">
			<img class="pernille-weidner-logo pernille-weidner-logo-lg" src="assets/pernille-weidner.png" title="Livets hjul" alt="Livets hjul">
		</a>
		<h1>Psykoterapi og Lydhealing</h1>

<?php
echo '<header class="weidner-underside-billede" style="background: url('.$this->getProp('image').');background-size:cover;background-repeat:no-repeat;">';
if (!$this->getProp('hide-title')) {
	echo '<h2 class="display-1 weidner-underside">'.$this->getProp('header').'</h2>';
}
echo '</header>';
?>

<!--
		<img src="images/gong-skåle-md.jpg" class="d-block w-100" alt="Gong skåle" style="object-fit:cover;height:13rem;max-height:13rem;">
-->
<!--
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
-->
	</section>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="https://www.pernilleweidner.dk">Hjem <span class="sr-only">Hjem</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php testActive('psyk');?>" href="psykoterapi">Psykoterapi</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php testActive('lyd');?>" href="lydhealing" id="lydhealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Lydhealing
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="lydhealing-dropdown">
						<a class="dropdown-item" href="lydhealing" title="Læs mere om hvad Lydhealing egentlig er">Hvad er lydhealing</a>
						<a class="dropdown-item" href="lydhealing-til-boern" title="Læs mere om hvordan lydhealing kan have positiv indflydelse på børn">Lydhealing til børn</a>
						<a class="dropdown-item" href="lydhealing-stress-og-angst" title="Om hvordan Lydhealing kan forebygge stress og angst">Lydhealing stress og angst</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php testActive('gong');?>" href="#" id="gong-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Gong
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="gong-dropdown">
						<a class="dropdown-item" href="gong-terapi" title="Den kraftfulde lyd fra gongerne, kombineret med deres dybe vibrationer, indbyder til en unik og transformerende oplevelse">Gong terapi</a>
						<a class="dropdown-item" href="gong-bad" title="Et gongbad er en form for lydterapi, hvor deltagerne oplever lydene og vibrationerne fra gonger i en meditativ og afslappende kontekst">Gong bad</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php testActive('klang');?>" href="#" id="klanghealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Klang
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="klanghealing-dropdown">
						<a class="dropdown-item" href="klang-massage">Klangmassage</a>
						<a class="dropdown-item" href="klang-meditation">Klangmeditation</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php testActive('kaka');?>" href="kakao-ceremoni">Kakaoceremoni</a>
				</li>
			</ul>
		</div>
	</nav>

<?php
$test = testLink();
//echo ' -'.$test.'-';
if (isset($test) && $test !== '' && $test !== false) {
	echo <<<HTML
		<div class="alert alert-danger p-4 mr-4 ml-4">
			<h5 class="albert">Desværre, siden <em class="text-muted">/{$_GET['page']}</em> findes ikke. {$test}</h5>
		</div>
HTML;
}
?>

	<div class="py-3">
		<div class="container">
			<div class="pt-sm-1 pl-sm-3 pr-sm-3 pb-sm-3 albert">
<?php
$this->body();
?>
			</div>
		</div>

<?php
if (!$this->hasProp('no-pw-footer')) {
echo <<<FOOT
<footer class="text-muted mt-sm-4">
	<div class="container">
		<figure>
			<img style="height:100px;" src="images/pernille-weidner-i-haven.jpg" data-mfp-src="assets/pernille-weidner-i-haven-lg.jpg" class="img-thumbnail float-left mr-sm-2" alt="Pernille Weidner - psykoterapeut">
		</figure>
		<p class="albert">
			Jeg er uddannet pædagog, og har tidligere bl.a. arbejdet med unge med diagnoser. I 2020 blev jeg uddannet psykoterapeut fra Københavns Gestalt Institut. Derudover har jeg taget forskellige kurser igennem årene som bl.a. mindfullness instruktør, positiv psykologi vejleder, ernæringskonsulent, fitnessinstruktør og som det nyeste, klangmassage behandler og klangaktør hos Anne Viese.
			<a href="om-pernille-weidner" class="text-dark font-italic" title="Læs mere om Pernille Weidner">læs mere ...</a>
		</p>
	</div>
</footer>
FOOT;
}
?>

<!--
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
-->
	</div>
</main>

<?php
include('pages/footer.html');
?>

