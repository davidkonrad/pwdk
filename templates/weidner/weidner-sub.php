<?php include 'pages/utils.php'; ?>

<?php
/*
function testActive($link) {
	if (strpos($_GET['page'], $link) !== false) {
	 echo 'active';
	}
}
*/
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

	</section>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="https://www.pernilleweidner.dk">Hjem <span class="sr-only">Hjem</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php Utils::testActive('psyk');?>" href="psykoterapi">Psykoterapi</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php Utils::testActive('lyd');?>" href="lydhealing" id="lydhealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Lydhealing
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="lydhealing-dropdown">
						<a class="dropdown-item" href="lydhealing" title="Læs mere om hvad Lydhealing egentlig er">Hvad er lydhealing</a>
						<a class="dropdown-item" href="lydhealing-og-boern" title="Læs mere om hvordan lydhealing kan have positiv indflydelse på børn">Lydhealing til børn</a>
						<a class="dropdown-item" href="lydhealing-stress-og-angst" title="Om hvordan Lydhealing kan forebygge stress og angst">Lydhealing stress og angst</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php Utils::testActive('gong');?>" href="#" id="gong-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Gong
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="gong-dropdown">
						<a class="dropdown-item" href="gong-terapi" title="Den kraftfulde lyd fra gongerne, kombineret med deres dybe vibrationer, indbyder til en unik og transformerende oplevelse">Gong terapi</a>
						<a class="dropdown-item" href="gong-bad" title="Et gongbad er en form for lydterapi, hvor deltagerne oplever lydene og vibrationerne fra gonger i en meditativ og afslappende kontekst">Gong bad</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link <?php Utils::testActive('klang');?>" href="#" id="klanghealing-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Klang
					</a>
					<div class="dropdown-menu weidner-dropdown" aria-labelledby="klanghealing-dropdown">
						<a class="dropdown-item" href="klang-massage">Klangmassage</a>
						<a class="dropdown-item" href="klang-meditation">Klangmeditation</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php Utils::testActive('kaka');?>" href="kakao-ceremoni">Kakaoceremoni</a>
				</li>
			</ul>
		</div>
	</nav>

<?php
Utils::isURLValid();
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
<footer class="text-muted mt-4">
	<div class="container">
		<figure class="mt-sm-4 mt-md-0 pr-2 float-left">
			<img style="height:100px;" src="images/pernille-weidner-i-haven.jpg" data-mfp-src="images/pernille-weidner-i-haven-lg.jpg" class="img-thumbnail img-fluid" alt="Pernille Weidner - psykoterapeut" title="Pernille Weidner - uddannet pædagog, psykoterapeut mv">
		</figure>
		<p class="albert">
			Jeg er uddannet pædagog, og har tidligere bl.a. arbejdet med unge med diagnoser. I 2020 blev jeg uddannet psykoterapeut fra Københavns Gestalt Institut. Derudover har jeg taget forskellige kurser igennem årene som bl.a. mindfullness instruktør, positiv psykologi vejleder, ernæringskonsulent, fitnessinstruktør og som det nyeste, klangmassage behandler og klangaktør hos Anne Viese.
			<a href="om-pernille-weidner" class="text-dark font-italic" title="Læs mere om Pernille Weidner">læs mere&hellip;</a>
		</p>
	</div>
</footer>
FOOT;
}
?>

	</div>
</main>

<?php
include('pages/footer.html');
?>

