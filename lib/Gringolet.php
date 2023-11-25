<?php

/*
	Gawain rides on Gringolet 

	𝑇ℎ𝑒 𝑏𝑟𝑖𝑑𝑙𝑒 𝑤𝑎𝑠 𝑒𝑚𝑏𝑜𝑠𝑠𝑒𝑑 𝑎𝑛𝑑 𝑏𝑜𝑢𝑛𝑑 𝑤𝑖𝑡ℎ 𝑏𝑟𝑖𝑔ℎ𝑡 𝑔𝑜𝑙𝑑;
	𝑆𝑜 𝑤𝑒𝑟𝑒 𝑡ℎ𝑒 𝑓𝑢𝑟𝑛𝑖𝑠ℎ𝑖𝑛𝑔𝑠 𝑜𝑓 𝑡ℎ𝑒 𝑓𝑜𝑟𝑒-ℎ𝑎𝑟𝑛𝑒𝑠𝑠 𝑎𝑛𝑑 𝑡ℎ𝑒 𝑓𝑖𝑛𝑒 𝑠𝑘𝑖𝑟𝑡𝑠.
	𝑇ℎ𝑒 𝑐𝑟𝑢𝑝𝑝𝑒𝑟 𝑎𝑛𝑑 𝑡ℎ𝑒 𝑐𝑎𝑝𝑎𝑟𝑖𝑠𝑜𝑛 𝑎𝑐𝑐𝑜𝑟𝑑𝑒𝑑 𝑤𝑖𝑡ℎ 𝑡ℎ𝑒 𝑠𝑎𝑑𝑑𝑙𝑒-𝑏𝑜𝑤𝑠,
	𝐴𝑛𝑑 𝑎𝑙𝑙 𝑤𝑎𝑠 𝑎𝑟𝑟𝑎𝑦𝑒𝑑 𝑜𝑛 𝑟𝑒𝑑 𝑤𝑖𝑡ℎ 𝑛𝑎𝑖𝑙𝑠 𝑜𝑓 𝑟𝑖𝑐ℎ𝑒𝑠𝑡 𝑔𝑜𝑙𝑑,
	𝑊ℎ𝑖𝑐ℎ 𝑔𝑙𝑖𝑡𝑡𝑒𝑟𝑒𝑑 𝑎𝑛𝑑 𝑔𝑙𝑎𝑛𝑐𝑒𝑑 𝑙𝑖𝑘𝑒 𝑔𝑙𝑒𝑎𝑚𝑠 𝑜𝑓 𝑡ℎ𝑒 𝑠𝑢𝑛.
**/

define("R_UNDEFINED", 0x00);
define("R_ENDPOINT", 0x01);

define("R_PARAM", 0x02);
define("R_PARAM_INT", 0x03);
define("R_PARAM_FLOAT", 0x04);
define("R_PARAM_STRING", 0x05);
define("R_PARAM_BOOL", 0x06);

define("RE_INVALID_TYPE", '"%s" is not a valid router item type.');
define("RE_INVALID_REGEX", 'Parser error. ˝path_exclude()˝ must contain a valid regex.');
define("RE_INVALID_ENDPOINT", 'Cannot assign null to Router endPoint.');

define('RS_DEFAULT_PREFIX', 'route_');
define('RS_DEFAULT_404', '<h1>404: Page not found</h1>');

/* exception class */
class RouterException extends Exception { }

/* fragments */
class _RItem {
	protected $data = null;
	protected $type = R_UNDEFINED;

	public function __construct($name) {
		$this->data = $name;
	}
	public function getName() {
		return $this->data;
	}
	public function getType() {
		return $this->type;
	}
}
class _REndPoint extends _RItem {
	public function __construct($name) {
		parent::__construct($name);
		$this->type = R_ENDPOINT;
	}
}
class _RParam extends _RItem {
	public function __construct($regex, $type = R_PARAM) {
		parent::__construct($regex);
		$this->type = $type;
	}
	public function getRegex() {
		return $this->data;
	}

}

/* path */
class _RPath {
	private $uri;
	private $fragments;
	private $exclude;

	public function __construct() {
		$this->uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '/');
		$this->parse();
	}
	public function getPath() {
		if (isset($this->uri) && isset($this->exclude)) {
			try {
				return preg_replace($this->exclude, '', $this->uri);
			}	catch (Exception $e) { 
				trigger_error(RE_INVALID_REGEX, E_USER_WARNING);
			}
		}
		return $this->uri;
	}
	private function parse() {
		$this->fragments = explode('/', urldecode($this->getPath()) );
	}
	public function path_exclude($exclude) {
		$this->exclude = $exclude;
		$this->parse();
	}
	public function getFragments() {
		return $this->fragments;
	}	
}	

/* router */

#[AllowDynamicProperties]
class Gringolet extends _RPath {
	private $case = false;
	private $routes = array();
	private $args;
	private $current;

	protected function subscribe($type, $data) {
		switch ($type) {
			case R_ENDPOINT: 
				if (!isset($data)) {
					trigger_error(sprintf(RE_INVALID_ENDPOINT, $type), E_USER_WARNING);
					return $this;
					break;
				}
				$this->current[] = new _REndPoint($data);
				break;
			case R_PARAM: 
				$this->current[] = new _RParam($data);
				break;
			case R_PARAM_INT :
			case R_PARAM_FLOAT : 
			case R_PARAM_STRING :
			case R_PARAM_BOOL :    
				$this->current[] = new _RParam($data, $type);
				break;
			default :
				throw new RouterException(sprintf(RE_INVALID_TYPE, $type));
				break;
		}
		return $this;
	}
	public function set_case($case) {
		$this->case = $case;
	}
	private function reset_args() {
		$this->args = array();
	}
	public function endPoint($name = null) {
		return $this->subscribe(R_ENDPOINT, $name);
	}
	public function ep($name = null) {
		return $this->endPoint($name);
	}
	public function index() {
		return $this->endPoint('');
	}
	public function param($preg = null) {
		return $this->subscribe(R_PARAM, $preg);
	}
	public function p($preg = null) {
		return $this->param($preg);
	}
	public function int($preg = null) {
		return $this->subscribe(R_PARAM_INT, $preg);
	}
	public function float($preg = null) {
		return $this->subscribe(R_PARAM_FLOAT, $preg);
	}
	public function bool($preg = null) {
		return $this->subscribe(R_PARAM_BOOL, $preg);
	}
	public function string($preg = null) {
		return $this->subscribe(R_PARAM_STRING, $preg);
	}
	public function str($preg = null) {
		return $this->string($preg);
	}
	public function on($route_name = null) {
		$this->current = array();
		$this->route_name = isset($route_name) ? $route_name : RS_DEFAULT_PREFIX.(count($this->routes)+1);
		return $this;
	}
	public function onPath($path) {
		$current = $this->on($path);
		$groups = explode('/', $path);
		foreach ($groups as $n) {
			if ($n && $n[0] == ':')	{
				switch ($n) {
					case ':int':
						$current = $current->int();
						break;
					case ':float':
						$current = $current->float();
						break;
					case ':bool':
						$current = $current->bool();
						break;
					case ':string':
						$current = $current->string();
						break;
					default :	
						$current = $current->p();
						break;
				}
			} else {		
				$current = $current->ep($n);
			}
		}
		return $current;
	}
	public function then($func) {
		$this->current[] = $func;
		$this->routes[] = (object)['name' => $this->route_name, 'route' => $this->current];
	}
	public function thenAs($name) {
		foreach ($this->routes as $route) {
			if ($route->name == $name) {
				$this->current[] = end($route->route);
				$this->routes[] = (object)['name' => $this->route_name, 'route' => $this->current];
				return;
			}
		}
	}
	private function match($route) {
		$this->reset_args();
		$i = -1;
		$f = $this->getFragments();
		foreach($route as $r) {
			$i++;
			if (count($f)<$i) {
				return false;
				break;
			}

			$isFragment = get_class($r) !== 'Closure' ? true : false;
			$n1 = ($isFragment) ? ($this->case ? $f[$i] : strtolower($f[$i])) : '?';
			$N1 = ($isFragment) ? $f[$i] : '?';
			$n2 = ($isFragment) ? ($this->case ? $r->getName() : strtolower($r->getName())) : '¿';

			if ($isFragment && $r->getType() == R_ENDPOINT) {
				if ($n1 === $n2) {
					if (count($f) == $i) {
						return true;
						break;
					}
				} else {
					return false;
				}
			} else {
				if ($isFragment) switch ($r->getType()) {
					case R_PARAM_INT :
						if (!ctype_digit($N1)) {
							return false;
						} else {
							//$this->args[] = (int)$N1;
							//long int's are misinterpreted on 32bit systems
							//and it is an overhead anyway
							$this->args[] = $N1;
						}
						break;
					case R_PARAM_FLOAT :
						if (!is_numeric($N1)) {
							return false;
						} else {
							$this->args[] = (float)$N1;
						}
						break;
					case R_PARAM_BOOL :
						if (!in_array($n1, ['true', 'false', '1', '0'])) {
							return false;
						} else {
							$this->args[] = (bool)$N1;
						}
						break;
					default :
						$this->args[] = $N1;
						break;
				}

				if (count($f) == $i) {
					return true;
					break;
				}
			}
		}
	}

	public function is($name) {
		return $this->name() == $name;
	}
	public function name() {
		foreach ($this->routes as $route) {
			if ($this->match($route->route)) {
				return isset($route->name) ? $route->name : $route->route;
			}
		}
		return false;
	}
/*
	public function route() {
		foreach ($this->routes as $route) {
			if ($this->match($route->route)) {
				return $route->route;
			}
		}
		return false;
	}
*/
	public function go() {
		foreach ($this->routes as $route) {
			if ($this->match($route->route)) {
				call_user_func_array($route->route[count($route->route)-1], $this->args);
				return;
			}
		}
		echo RS_DEFAULT_404;
	}

	public function args() {
		return $this->args;
	}

	public function getCurrent() {
		return $this->current;
	}


}

?>
