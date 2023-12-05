<?php

class Utils {

	public static function isURLValid() {
		if (count($_GET)) {
			$pages = array('klang-massage', 'kakao-ceremoni', 'psykoterapi', 'gong-terapi', 
				'gong-bad', 'lydhealing', 'lydhealing-og-boern', 'lydhealing-stress-og-angst', 
				'kontakt', 'anbefalinger', 'om-pernille-weidner');

			$org_input = strtolower($_SERVER['REQUEST_URI']);
			$input = str_replace('/', '', $org_input);
			$input = str_replace('pwdk', '', $input);
			$input = explode('?', $input)[0];

			if ($input !== '' && !in_array($input, $pages)) {
				file_put_contents('log/404.log', $org_input.PHP_EOL, FILE_APPEND);
				$best = -1;
				$suggest = '';
				foreach ($pages as $word) {
					$s = similar_text($word, $input);
					if ($s > $best) {
						$best = $s;
						$suggest = $word;
					}
				}
				$redirect = $suggest !== '' ? 'https://www.pernilleweidner.dk/'.$suggest : 'https://www.pernilleweidner.dk';
				echo '<script>window.location='.$redirect.'</script>';
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

	public static function getImage() {
		//$this->getProp('image')
		return $this->getProp('image');
	}

}


?>
