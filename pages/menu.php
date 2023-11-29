	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link <?php Utils::testActive();?>" href="https://www.pernilleweidner.dk">Hjem <span class="sr-only">Hjem</span></a>
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

