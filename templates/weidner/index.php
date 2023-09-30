<?php
include('pages/header.php');
?>

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
		<p class="float-right"></p>
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


