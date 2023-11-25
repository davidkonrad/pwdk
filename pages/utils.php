<?php

class Utils {

	public static function isURLValid() {
		if (count($_GET)) {
			$pages = array('klang-massage', 'kakao-ceremoni', 'psykoterapi', 'klang-meditation', 
								'gong-terapi', 'gong-bad', 'lydhealing', 'lydhealing-og-boern', 'lydhealing-stress-og-angst', 
								'kontakt', 'anbefalinger', 'om-pernille-weidner');

			$input = strtolower($_SERVER['REQUEST_URI']);
			$cleaned_input = explode('?', $input)[0];
			$cleaned_input = str_replace('/', '', $cleaned_input);
			$cleaned_input = str_replace('pwdk', '', $cleaned_input);

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
	}

	public static function testActive($link) {
		if (strpos($_GET['page'], $link) !== false) {
		 echo 'active';
		}
	}

}


?>
