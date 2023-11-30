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
				file_put_contents('log/404.log', $input.PHP_EOL, FILE_APPEND);
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
				<br>
				<div class="alert alert-danger p-4 mr-4 ml-4">
					<h5 class="albert">Desværre, siden <em class="text-muted">/{$_GET['page']}</em> findes ikke. {$recommend}</h5>
				</div>
HTML;
			}
		}
	}

	public static function testActive($link = '') {
		$page = isset($_GET['page']) ? $_GET['page'] : false;
		if ($page === false && $link === '') {
			echo 'active';
		} else if ($page !== false && $link !== '' && strpos($page, $link) !== false) {
			echo 'active';
		}
	}

}


?>
