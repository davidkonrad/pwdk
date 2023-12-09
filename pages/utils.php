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

	public static function jsonldBusiness() {
		echo '<script type="application/ld+json">{';
		echo <<<JSON
      "@context": "https://schema.org",
      "@type": "Store",
      "image": [
        "https://www.pernilleweidner.dk/images/gong-skåle-md.jpg",
        "https://www.pernilleweidner.dk/images/pernille-weidner-i-haven-lg.jpg"
       ],
      "name": "Psykoterapi Pernille Weidner",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Hørvænget 10, 1. th",
        "addressLocality": "Taastrup",
        "addressRegion": "Taastrup",
        "postalCode": "2630",
        "addressCountry": "DK"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 37.293058,
        "longitude": -121.988331
      },
      "url": "https://www.pernilleweidner.dk/kontakt",
      "telephone": "(+45) 26 81 40 34",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday"
          ],
          "opens": "09:00",
          "closes": "17:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Friday",
          "opens": "09:00",
          "closes": "14:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "10:00",
          "closes": "14:00"
        }
      ],
      "department": [
        {
          "@type": "Pharmacy",
          "image": [
        "https://example.com/photos/1x1/photo.jpg",
        "https://example.com/photos/4x3/photo.jpg",
        "https://example.com/photos/16x9/photo.jpg"
       ],
          "name": "Dave's Pharmacy",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "1600 Saratoga Ave",
            "addressLocality": "San Jose",
            "addressRegion": "CA",
            "postalCode": "95129",
            "addressCountry": "US"
          },
          "priceRange": "$",
          "telephone": "+14088719385",
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
              ],
              "opens": "09:00",
              "closes": "19:00"
            },
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": "Saturday",
              "opens": "09:00",
              "closes": "17:00"
            },
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": "Sunday",
              "opens": "11:00",
              "closes": "17:00"
            }
          ]
        }
      ]
    }
JSON;
		echo '}</script>';
	}

}


?>
