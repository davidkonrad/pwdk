<?php

/*
  Gingalain
	Auxiliaries needed for manipulating routes, bundles and templates

	𝑇ℎ𝑒 𝐹𝑎𝑖𝑟 𝑈𝑛𝑘𝑛𝑜𝑤𝑛, 𝑠𝑜𝑛 𝑜𝑓 𝐺𝑎𝑤𝑎𝑖𝑛 𝑎𝑛𝑑 𝑎 𝑓𝑎𝑦 𝑓𝑟𝑜𝑚 𝑡ℎ𝑒 𝑓𝑜𝑟𝑒𝑠𝑡𝑠
**/


class JSON {
	public static function get($filename) {
		$json = @file_get_contents($filename);
		$test = @json_decode($json);
		$json = json_last_error() === 0 ? $json : JSON::Err();
		return json_decode($json);
	}
	public static function put($filename, $array) {
		$json = json_encode($array, JSON_PRETTY_PRINT);
		file_put_contents($filename, $json);
	}
	private static function Err() {
		switch (json_last_error()) {
			case JSON_ERROR_NONE :
       	$err = 'No errors'; break;
			case JSON_ERROR_DEPTH :
      	$err = 'Maximum stack depth exceeded'; break;
			case JSON_ERROR_STATE_MISMATCH :
      	$err = 'Underflow or the modes mismatch'; break;
			case JSON_ERROR_CTRL_CHAR :
				$err = 'Unexpected control character found'; break;
			case JSON_ERROR_SYNTAX :
				$err = 'Syntax error, malformed JSON'; break;
			case JSON_ERROR_UTF8 :
				$err = 'Malformed UTF-8 characters, possibly incorrectly encoded'; break;
			default:
				$err = 'Unknown error'; break;
		}
		return json_encode(array('error' => $err)); 
	}
}

class IO {

	public static function dir($path, $mask) {
		return isset($mask) ? preg_grep('~\.('.$mask.')$~', scandir($path)) : scandir($path);
	}

	public static function createFile($filename, $content) {
		set_error_handler(function($severity, $message, $file, $line) {
			throw new ErrorException($message, $severity, $severity, $file, $line);
		});
		try {
			file_put_contents($filename, json_encode( json_decode($content), JSON_PRETTY_PRINT));
			$res = true;
		} catch (Exception $e) {
			$res = $e->getMessage();
		}
		restore_error_handler();
		return $res;
	}

	public static function renameFile($filename, $ext) {
		set_error_handler(function($severity, $message, $file, $line) {
			throw new ErrorException($message, $severity, $severity, $file, $line);
		});
		try {
			$new = str_replace('.routes', '.removed', $filename);
			rename($filename, $new);
			$res = true;
		} catch (Exception $e) {
			$res = $e->getMessage();
		}
		restore_error_handler();
		return $res;
	}

}

//Remote API
class RAPI {
	private function get($prop) {
		return isset($_POST[$prop]) ? $_POST[$prop] : false;
	}
	private function ret($result) {
		if (is_bool($result)) $result = array('success' => $result);
		echo json_encode($result);
	}
	public function __construct() {
		$action = $this->get('action');
		switch($action) {
			case 'cf':
				$path = $this->get('path');
				$name = $this->get('name');
				$content = $this->get('content');
				if ($path && $name && $content) {
					$res = IO::createFile('../'.$path.'/'.$name, $content);
					$this->ret( $res === true ? $res : array('error' => $res));
				} else {
					$this->ret(false);
				}
				break;

			case 'rf': 
				$path = $this->get('path');
				$name = $this->get('name');
				$ext = $this->get('ext');
				if ($path && $name && $ext) {
					$res = IO::renameFile('../'.$path.'/'.$name, $ext);
					$this->ret( $res === true ? $res : array('error' => $res));
				}	else {
					$this->ret(false);
				}
				break;

			default:
				$this->ret(array('error' => 'Unknown action \\"'.$action.'\\"'));
				break;
		}
	}
}

if (!empty($_POST)) {
	$rapi = new RAPI();
}


?>
