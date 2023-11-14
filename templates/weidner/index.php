<?php
include('pages/header.php');
?>

<?php
	echo '<header class="page-header" style="background: url('.$this->getProp('image').');">';
	echo '<h1 class="display-0">'.$this->getProp('header').'</h1>';
	echo '</header>';
?>
 <main class="mx-auto" role="main" style="background-color:#ece6dc;box-shadow:none;">
	<div class="py-1">
		<div class="container">
			<div class="row d-block ml-1 mr-1">
<?php
$this->body();
?>
			</div>
		</div>
	</div>
</main>

<?php
if (!$this->hasProp('no-pw-footer')) {
echo <<<FOOT
<footer class="text-muted mt-sm-4">
	<div class="container">
		<figure>
			<img style="height:100px;" src="images/pernille-weidner-i-haven.jpg" data-mfp-src="assets/pernille-weidner-i-haven-lg.jpg" class="img-thumbnail float-left mr-sm-3" alt="Pernille Weidner - psykoterapeut">
		</figure>
		<p class="pt-sm-1">
			Jeg er uddannet pædagog, og har tidligere bl.a. arbejdet med ungediagnoser. I 2020 blev jeg uddannet psykoterapeut fra Københavns Gestalt Institut. Derudover har jeg taget forskellige kurser igennem årene som bl.a. mindfullness instruktør, positiv psykologi vejleder, ernæringskonsulent, fitnessinstruktør og som det nyeste, klangmassage behandler og klangaktør hos Anne Viese.
			<a href="om-pernille-weidner" class="text-dark font-italic" title="Læs mere om Pernille Weidner">læs mere ...</a>
		</p>
	</div>
</footer>
FOOT;
}
?>

<?php
include('pages/footer.html');
?>


