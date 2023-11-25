<?php

/*
	Escalibor for Gawain

	𝑓𝑜𝑟 𝑎𝑡 ℎ𝑖𝑠 𝑏𝑒𝑙𝑡 ℎ𝑢𝑛𝑔 𝐸𝑠𝑐𝑎𝑙𝑖𝑏𝑜𝑟
	𝑡ℎ𝑒 𝑓𝑖𝑛𝑒𝑠𝑡 𝑠𝑤𝑜𝑟𝑑 𝑡ℎ𝑎𝑡 𝑡ℎ𝑒𝑟𝑒 𝑤𝑎𝑠
	𝑤ℎ𝑖𝑐ℎ 𝑠𝑙𝑖𝑐𝑒𝑑 𝑡ℎ𝑟𝑜𝑢𝑔ℎ 𝑖𝑟𝑜𝑛 𝑎𝑠 𝑡ℎ𝑟𝑜𝑢𝑔ℎ 𝑤𝑜𝑜𝑑
**/

$noob = function() {};

interface IElement {
	public function body();
}

interface IPage extends IElement {
	public function title();
	public function meta();
	public function head();
	public function footer();
}

interface IApp {}

interface IPlugin {}
interface IApi extends IPlugin {}
interface ITemplate extends IPlugin {}
interface IMiddleware extends IPlugin {}

define('SLASHES', '/\//');

/*****************************
  AElement
******************************/
abstract class AElement implements IElement {
	protected $body;
	protected $router;

	protected function output($v) {
		if (!isset($v)) return; 
		if (is_string($v)) {
			echo $v;
		}
		if (is_object($v) && get_class($v) == 'Closure') {
			call_user_func_array($v, isset($this->router) ? $this->router->args() : array());
		}
	}
	protected function setRouter(Gringolet $router) { 
		$this->router = $router;
	}
	public function router() { 
		return $this->router;
	}
	public function body() {
		$this->output($this->body);
	}
}


/*****************************
  ACollection
******************************/
abstract class ACollection extends AElement {
	protected $collection = array();

	public function add($element) {
		$this->collection[] = $element;
	}
	protected function get404() {
		return isset($this->collection['404'])
			? $this->collection['404']
			: false;
	}
	protected function current() {
		$path = $this->router->name();
		if ($path !== false) {
			return isset($this->collection[$path])
				? $this->collection[$path] 
				: $this->get404();
		}	else {
			if (trim(EXCLUDE_PATH, SLASHES) == trim($this->router->getPath(), SLASHES)) return false;
			return count($this->router->getFragments())>0
				? $this->get404()
				: false;
		}
	}
}


/*****************************
  PageElement
******************************/
class PageElement extends ACollection implements IElement { 

	protected function current() {
		$content = parent::current();
		return $content !== false ? $content : $this->body;
	}
	public function __call($name, $arg) {
		if ($name === 'default') {
			return $this->_default($arg[0]);
		}
	}
	public static function create($routerOrApp) {
		$router = get_class($routerOrApp) == 'GawainApp' ? $routerOrApp->router() : $routerOrApp; 
		$instance = new self();
		$instance->setRouter($router);
		return $instance;
	}
	public function body() {
		$this->output($this->current());
	}
	public function on($path, $action) {
		if (is_array($path)) {
			foreach($path as $p) {
				$this->collection[$p] = $action;
			}
		} else {
			$this->collection[$path] = $action;
		}
		return $this;
	}
	public function _default($action) {
		$this->body = $action;
		return $this;
	}
	public function addTo($router) {
		$this->setRouter($router);
		return $this;
	}
}


/*****************************
  APage
******************************/
abstract class APage extends AElement implements IPage { 
	protected $path;
	protected $title;
	protected $meta;
	protected $head;
	protected $footer;

	public function pre() {
		$this->output($this->pre);
	}
	public function title() {
		$this->output($this->title);
	}
	public function meta() {
		$this->output($this->meta);
	}
	public function head() {
		$this->output($this->head);
	}
	public function footer() {
		$this->output($this->footer);
	}
}


/*****************************
  Page
******************************/

#[AllowDynamicProperties]
class Page extends APage { 

	public static function create($path = '', $pre = '', $title = '', $meta = '', $head = '', $body = '', $footer = '') {
		$instance = new self();
		$instance->path = $path;
		$instance->pre = $pre;
		$instance->title = $title;
		$instance->meta = $meta;  
		$instance->head = $head; 
		$instance->body = $body; 
		$instance->footer = $footer; 
		$instance->props = new StdClass();
		return $instance;
	}
	public function setPre($p) {
		$this->pre = $p;
		return $this;
	}
	public function setTitle($t) {
		$this->title = $t;
		return $this;
	}
	public function setMeta($m) {
		$this->meta = $m;
		return $this;
	}
	public function setHead($h) {
		$this->head = $h;
		return $this;
	}
	public function setBody($b) {
		$this->body = $b;
		return $this;
	}
	public function setFooter($f) {
		$this->footer = $f;
		return $this;
	}
	public function setProp($key, $value) {
		$this->props->$key = $value;
		return $this;
	}
	public function addTo(IApp $app) {
		$this->setRouter( $app->router() );
		$app->add($this);
		return $this;
	}
	public function getPath() {
		return $this->path;
	}
	public function getPre() {
		return $this->pre;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getMeta() {
		return $this->meta;
	}
	public function getHead() {
		return $this->head;
	}
	public function getBody() {
		return $this->body;
	}
	public function getFooter() {
		return $this->footer;
	}
	public function hasProp($key) {
		return isset($this->props->$key);
	}
	public function getProp($key) {
		return $this->hasProp($key) ? $this->props->$key : false;
	}

}


/*****************************
  Escalibor App
******************************/
class Escalibor extends ACollection implements IPage, IApp { 

	public function __construct() {
		$this->setRouter( new Gringolet() );
		$this->addIndex();
	}
	private function addIndex() {
		$this->add(Page::create('', 
			' index page',
			'',
			'',
			function() {
				echo 'this is a function!';
			},
			''
		));
	}
	protected function current() {
		$page = parent::current();
		return $page !== false ? $page : $this->collection[''];
	}
	public function getCurrent() {
		return $this->current();
	}
	public function add($element) {
		global $noob;
		$this->collection[$element->getPath()] = $element;
		$this->router->onPath($element->getPath())->then($noob);
	}
	public function pre() {
		$this->current()->pre();		
	}
	public function title() {
		$this->current()->title();		
	}
	public function meta() {
		$this->current()->meta();
	}
	public function head() {
		$this->current()->head();
	}
	public function body() {
		$this->current()->body();
	}
	public function footer() {
		$this->current()->footer();
	}
	public function hasProp($key) {
		return $this->current()->hasProp($key);
	}
	public function getProp($key) {
		return $this->current()->getProp($key);
	}

}

?>
