<?php
include('pages/header.html');
?>
<!--
<header>
	<div class="collapse" id="navbarHeader">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-7 py-4">
					<h4 class="text-dark">Lidt om mig</h4>
					<img src="assets/pernille-weidner-mugshot-ii.jpg" class="img-thumbnail float-left w-25 mr-sm-3">
					<p class="text-muted">Jeg er født i 1980 og bor i Taastrup med min kæreste og min hund. Jeg er uddannet pædagog, og har tidligere bl.a. arbejdet på en døgninstitution for unge med forskellige diagnoser. I 2020 blev jeg uddannet psykoterapeut fra Københavns Gestalt Institut. Derudover har jeg taget forskellige kurser igennem årene som bl.a. mindfullness instruktør, positiv psykologi vejleder, ernæringskonsulent, fitnessinstruktør og som det nyeste, klangmassage behandler og klangaktør hos Anne Viese.</p>
				</div>
				<div class="col-sm-4 offset-md-1 py-4">
					<h4 class="text-white">&nbsp;</h4>
					<ul class="list-unstyled">
						<li><a href="#" class="text-dark">Følg på Instagram</a></li>
						<li><a href="#" class="text-dark">Følg på Facebook</a></li>
						<li><a href="#" class="text-dark">(+45) 26 81 40 34</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="navbar navbar-light box-shadow page-navbar">
		<div class="container d-flex XXjustify-content-between" style="color:red;">
			<a href="#" class="navbar-brand XXd-flex XXalign-items-center XXalign-items-start">
				<img src="assets/pernille-weidner.png" style="height: 3rem;">
				<h1 class="display-3 Xml-sm-2">Pernille Weidner</h1>
			</a>
			<button class="navbar-toggler bg-light text-muted" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</div>
</header>
-->

<?php
	echo '<header class="page-header" style="background: url('.$this->getProp('image').');">';
	echo '<h1 class="display-2">'.$this->getProp('header').'</h1>';
	echo '</header>';
?>
 <main role="main">
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

 <footer class="text-muted mt-sm-4">
      <div class="container">
        <p class="float-right">
        </p>
					<div class="service-item ">
						<div class="service-image icon-image">
							<img style="height:100px;" src="assets/pernille-weidner-mugshot.jpg" class="img-thumbnail float-left mr-sm-3" alt="Pernille Weidner - psykoterapeut">
						</div>
						<div class="service-content">
							<h4 class="service-title">Pernille Weidner</h4>
							<p>Jeg er født i 1980 og bor i Taastrup med min kæreste og min hund.Jeg er uddannet pædagog, og har tidligere bl.a. arbejdet på en døgninstitution for unge med forskellige …</p>
					</div>
				</div>

      </div>
    </footer>

<?php
include('pages/footer.html');
?>


