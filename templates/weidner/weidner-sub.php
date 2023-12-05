<?php 
include 'pages/utils.php'; 
?>
<main class="mx-auto">
	<section class="front-header">
		<header class="d-flex justify-content-between pt-1">
			<small><a href="mailto:info@pernilleweidner.dk" class="ml-2 text-weidner arsenal-bold" title="Skriv email til Pernille" aria-label="Skriv til Pernille Weidner">info@pernilleweidner.dk</a></small>
			<small><a href="tel:26814034" class="mr-2 text-weidner arsenal-bold" title="Klik / tap for at ringe op ..." aria-label="Ring til Pernille Weidner">(+45) 26 81 40 34</a></small>
		</header>
		<img class="pernille-weidner-logo pernille-weidner-logo-lg" src="images/pernille-weidner-logo.webp" title="Livets hjul" alt="Livets hjul">
		<a href="https://www.pernilleweidner.dk" class="text-decoration-none" title="Gå til forside">
			<h1>Psykoterapi og Lydhealing</h1>
		</a>
<?php
if ($this->getProp('image-size')) {
	$class = 'weidner-underside-billede-'.$this->getProp('image-size');
} else {
	$class = 'weidner-underside-billede-sm';
}
if ($this->getProp('image-desc')) {
	$title = $this->getProp('image-desc');
} else {
	$title = 'Pernille Weidner, psykoterapi og lydhealing';
}
echo '<header class="weidner-underside-billede '.$class.'" style="background-image: url('.$this->getProp('image').');" title="'.$title.'"></header>';
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
		<figure class="mt-3 mt-md-0 pr-2 float-left">
			<img style="height:150px;" src="images/pernille-weidner-i-haven.jpg" data-mfp-src="images/pernille-weidner-i-haven-lg.jpg" class="img-thumbnail img-fluid" alt="Pernille Weidner - psykoterapeut" title="Pernille Weidner - uddannet pædagog, psykoterapeut mv">
		</figure>
		<p class="albert">
			Jeg er uddannet pædagog og arbejder deltid på et socialpsykiatrisk bosted. Tidligere har jeg bl.a. arbejdet 
			som pædagog i en SFO hvor jeg også havde timer i skolen. Jeg har ligeledes arbejdet på et kvindekrise-center og et 
			døgntilbud for unge. I 2020 blev jeg uddannet psykoterapeut fra Københavns Gestalt Institut. Derudover har jeg taget forskellige kurser 
			igennem årene som bl.a. mindfullness instruktør, positiv psykologi vejleder, ernæringskonsulent og fitnessinstruktør. 
			Som det nyeste klangmassage behandler, klangaktør, gong spiller og gongterapeut
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

