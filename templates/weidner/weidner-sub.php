<?php 
include 'pages/utils.php'; 
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
<?php 
include 'pages/menu.php'; 
?>

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

