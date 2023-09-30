<?php

include 'Gringolet.php';
include 'Escalibor.php';
include 'Gingalain.php';

define('EXCLUDE_PATH', '/pwdk\//');
define('APP_NAME', 'Gawain');
define('LOCALHOST', 'http://localhost/pwdk/');
define('SERVER', 'https://example.com/');


class Gawain extends Escalibor {
	private $bundles = null;
	private $valid_routes_files = null;
	private $bad_routes_files = null;
	private $loaded_routes = null;
	private $templates = null;
	private $current_template = null;

	public function __construct($settings) {
		parent::__construct();
		$this->exclude_path = isset($settings->exclude_path) ? $settings->exclude_path : EXCLUDE_PATH;
		$this->localhost = isset($settings->localhost) ? $settings->localhost : LOCALHOST;
		$this->router()->path_exclude($this->exclude_path);
		$this->loadRoutes();
		$this->loadTemplates();
		$this->loadBundles();
	}

	private function q($s) {
		return '"'.$s.'"';
	}

	private function jsErr($message) {
		echo '<script>console.warn("Gawain: '.str_replace('"', '\x22', $message).'")</script>';
	}

	private function internalErr($message) {
		$html = '<h1>Internal error</h1>';
		$html.= '<p>An internal error occured while parsing system files.</p>';
		$html.= '<p><strong>'.$message.'</strong></p>';
		$html.= '<p>Go to <a href="">index</a>.';
		return $html;
	}
	private function isRemote($href) {
		return strpos($href, '//') !== false;
	}

	protected function loadRoutes() {
		$route_files = IO::dir('routes', 'routes'); 
		$this->valid_routes_files = array();
		$this->bad_routes_files = array();
		$this->loaded_routes = array();
		foreach($route_files as $file) {
			$routes = JSON::get('routes/'.$file);
			if (isset($routes->routes)) {	
				array_walk($routes->routes, array($this, 'initRoute'));
				$this->valid_routes_files[] = $file;
			} else {
				$this->jsErr('´'.$file.'´ is not a valid routes file');
				$this->bad_routes_files[] = $file;
			}
		}
	}

	private function initRoute($route) {
		if (!isset($route->meta)) $route->meta = '';
		if (!isset($route->title)) $route->title = APP_NAME;
		if (!isset($route->template)) $route->template = 'default';
		$this->loaded_routes[] = $route;
		$page = Page::create($route->route)
			->setTitle($route->title)
			->setMeta($route->meta)
			->setTitle($route->title)
			->setBody(function() use ($route) { 
				$_ARGS = func_get_args(); 
				if (file_exists($route->include)) { //add support for closure and text 
					include $route->include; 
				} else {
					echo $this->internalErr('Route "/'.$route->route.'" has no content to render.');
				}
			})
			->addTo($this);

		if (isset($route->properties)) {
			foreach($route->properties as $prop) {
				$prop = (array)$prop;
				$page->setProp(array_keys($prop)[0], array_values($prop)[0]);
			}
		}
	}

	protected function loadBundles() {
		$this->bundles = JSON::get('bundles/bundles.register');
		if (isset($this->bundles->error)) {
			$this->jsErr('Error loading bundles:: '.$this->bundles->error);
		}
	}

	private function renderLinkTag($link, $path) {
		if (!isset($link->rel)) $link->rel = 'stylesheet';
		$tag = '<link';
		foreach($link as $key => $value) {
			if ($key !== 'tagtype') {
				$tag.= ' '.$key.'="';
				if ($key === 'href') {
					$tag.= $this->isRemote($value) ? $value : $path.$value;
					$tag.= '"';
				} else {
					$tag.= $value.'"';
				}
			}
		}
		$tag.= '/>'."\n\r";
		echo $tag;
	}

	private function renderScriptTag($script, $path) {
		$tag = '<script';
		foreach($script as $key => $value) {
			if ($key !== 'tagtype') {
				$tag.= ' '.$key.'="';
				if ($key === 'src') {
					$tag.= $this->isRemote($value) ? $value : $path.$value;
					$tag.= '"';
				} else {
					$tag.= $value.'"';
				}
			}
		}
		$tag.= '></script>'."\n\r";
		echo $tag;
	}

	private function renderMetaTag($script) {
		$tag = '<meta';
		foreach($script as $key => $value) {
			if ($key !== 'tagtype') {
				$tag.= ' '.$key.'="'.$value.'"';
			}
		}
		$tag.= '>'."\n\r";
		echo $tag;
	}

	private function renderBundleTag($object, $name, $path) {
		if (isset($object->tagtype)) switch($object->tagtype) {
			case 'link': 
				$this->renderLinkTag($object, $path); 
				break;
			case 'script': 
				$this->renderScriptTag($object, $path); 
				break;
			case 'meta': 
				$this->renderMetaTag($object); 
				break;
			default: 
				break;
		} else {
			$this->jsErr($name.' missing "tagtype", '.serialize($object)); 
		}
	}

	private function bundleRequiredByTemplate($bundle_name) {
		if (!isset($bundle_name) || !is_array($this->current_template->bundles)) return false;
		return in_array($bundle_name, $this->current_template->bundles);
	}

	private function setTemplate($template_name) {
		foreach($this->templates->templates as $template) {		
			if ($template->name === $template_name) {
				$this->current_template = (object)[
					'name' => $template->name,
					'include' => $template->include,
					'bundles' => explode(';', $template->bundles)
				];
				if (isset($template->head)) $this->current_template->head = $template->head;
				if (isset($template->last)) $this->current_template->last = $template->last;
				return;
			}
		}
	}

	private function loadTemplates() {
		$this->templates = JSON::get('templates/templates.register');
		if (isset($this->templates->error)) {
			$this->jsErr('Error loading templates:: '.$this->templates->error);
		}
		$current_route = $this->router->name();
		foreach($this->loaded_routes as $route) {
			if ($route->route === $current_route) {
				if (isset($route->template)) {
					$this->setTemplate($route->template);
					return;
				}
			}
		}
		$this->setTemplate('default');
	}


/* public, inherite */
	public function isLocalhost() {
		$host = $_SERVER["SERVER_ADDR"]; 
		if (($host=='127.0.0.1') || ($host=='::1')) {
			return true;
		} else {
			return false;
		}
	}

	public function lateRedirect($to = '404') {
		echo '<script>';
		echo 'const p = (location.hostname === "localhost" || location.hostname === "127.0.0.1") ? "'.LOCALHOST.$to.'" : "'.SERVER.$to.'";';
		echo 'window.location = p';
		echo '</script>';
	}

	public function arg($id) {
		$args = $this->router->args();
		return isset($args[$id]) ? $args[$id] : null;
	}

	public function baseName() {
		return $this->isLocalhost() ? $this->localhost : $this->server;
	}

	public function renderBundles($last = null) {
		$scope = $last ? 'last' : 'head';
		if (isset($this->bundles->bundles)) {
			foreach($this->bundles->bundles as $bundle) {
				if ($bundle->enabled == 'true' || $this->bundleRequiredByTemplate($bundle->name)) {
					if (isset($bundle->$scope)) {
						switch (gettype($bundle->$scope)) {
							case 'object': 
								$this->renderBundleTag($bundle->$scope, $bundle->name, 'bundles/');
								break;
							case 'array': 
								foreach($bundle->$scope as $object) {
									$this->renderBundleTag($object, $bundle->name, 'bundles/');
								}
								break;
							default: 
								break;
						}
					}
				}
			}
		}
		if 	(isset($this->current_template)) {
			if (isset($this->current_template->$scope)) {
				switch (gettype($this->current_template->$scope)) {
					case 'object': 
						$this->renderBundleTag($this->current_template->$scope, $this->current_template->name, 'templates/');
						break;
					case 'array': 
						foreach($this->current_template->$scope as $object) {
							$this->renderBundleTag($object, $this->current_template->name, 'templates/');
						}
						break;
					default: 
						break;
				}
			}
		}
	}

	public function renderBundlesLast() {
		$this->renderBundles(true);
	}

	public function getValidRoutesFiles() {
		return $this->valid_routes_files;
	}

	public function getTemplatesList() {
		return array_map(function($template) {
			return $template->name;
		}, $this->templates->templates);
	}

	public function renderTemplate() {
		include 'templates/'.$this->current_template->include.'';
	}
	
	public function getLoadedRoutes() {
		return $this->loaded_routes;
	}

}

$App = new Gawain( isset($settings) ? $settings : null );
$Gawain = $App;

?>
