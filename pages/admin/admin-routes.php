<style>
.btn-edit-route {
	color: gray;
	position: absolute;
	display: block;
	top: 3px;
	right: 3px;
}
.btn-edit-route:hover {
	color: darkgreen;
}
#routes-list {
	animation: fadeIn ease .2s;
	-webkit-animation: fadeIn ease .2s;
	-moz-animation: fadeIn ease .2s;
	-o-animation: fadeIn ease .2s;
	-ms-animation: fadeIn ease .2s;
}
@keyframes fadeIn {
	0% {opacity:0;}
	100% {opacity:1;}
}
@-moz-keyframes fadeIn {
	0% {opacity:0;}
	100% {opacity:1;}
}

label.checkbox,
input.checkbox {
	vertical-align: middle;
}
textarea { 
	resize: vertical; 
	min-height: 30px;
	max-height: 150px;
}

#route-form .form-group select,
#route-form .form-group textarea,
#route-form .form-group input {
	min-width: 350px;
}

</style>
<?php

class Routes {

	public function __construct($Gawain) {
		$this->route_files = $Gawain->getValidRoutesFiles();
		$this->templates = $Gawain->getTemplatesList();

		$cr = $Gawain->arg(1);
		$cr = explode('?', $cr);
		$cr = $cr[0];

		$this->current_route_file = $Gawain->arg(0) !== null ? $Gawain->arg(0) : null; 
		$this->current_route = isset($cr) ? $this->fix($cr) : null; 

		echo '<script>const routes_list = '.json_encode($Gawain->getLoadedRoutes(), JSON_UNESCAPED_SLASHES).'</script>';

		if (isset($this->current_route_file)) {
			if (!in_array($this->current_route_file, $this->route_files)) {
				$Gawain->lateRedirect();
			}
		}				
	}

	private function fix($s, $to_unicode = false) {
		return !$to_unicode ? str_replace('∕','/', $s) : str_replace('/', '∕', $s);
	}

	private function link($text, $href, $class = '') {
		return '<a class="route auto '.$class.'" href="'.$href.'">'.$text.'</a>';
	}

	public function header() {
		$header = '<nav><h3>'.$this->link('Routes', 'admin-routes');
		if (!empty($this->current_route_file)) {
			$header.= ' <span class="va-8 x-small">⤳ </span>';
			$header.= $this->link($this->current_route_file, 'admin-routes/'.$this->current_route_file);

			if (!empty($this->current_route)) {
				$header.= ' <span class="va-8 x-small">⤳ </span>';
				$header.= $this->link($this->current_route, 'admin-routes/'.$this->current_route_file.'/'.$this->fix($this->current_route), 'mono');
			}
		}
		$header.= '</h3></nav>';
		echo $header;
	}

	public function routeFileSelect() {
		$header = '<div class="form-group"><label for="route-file" XXXclass="form-group-label"></label><div class="form-group-input">';
		$header.= '<button class="btn-add float-left btn-input-group" id="btn-new-routes-file"></button>';
		$header.= '<select id="select-route-file">';
		$header.= '<option value="⦃all⦄">All</option>';
		foreach($this->route_files as $route_file) {
			$header.= $route_file === $this->current_route_file
				? '<option value="'.$route_file.'" selected>'.$route_file.'</option>'
				: '<option value="'.$route_file.'">'.$route_file.'</option>';
		}
		$header.= '</select>';
		$header.= '</div></div>';
		echo $header;
	}

	public function getRoutes() {
		$all_routes = array();
		foreach($this->route_files as $route_file) {
			$routes = JSON::get('routes/'.$route_file);
			if (isset($routes->routes) && !empty($routes->routes)) {
				$index = -1;
				foreach($routes->routes as $route) {
					$index++;
					if ($this->current_route_file === '⦃all⦄' || $route_file === $this->current_route_file) {
						$all_routes[] = (object) array('route'=> $route->route, 'file' => $route_file);

						if ($this->current_route === $route->route) {
							echo '<script>const current_route_index = '.$index.'</script>';
							echo '<script>const current_route = '.json_encode($route).'</script>';
						}
					}
				}
				if ($this->current_route_file === $route_file) {
					echo '<script>const current_route_file = "'.$route_file.'"</script>';
					echo '<script>const current_routes = '.json_encode($routes).'</script>';
				}
			}
		}	
		usort($all_routes, function($a, $b) {
			return strcmp($a->route, $b->route);
		});
		return $all_routes;
	}

	public function routes() {
		$routes = $this->getRoutes();
		foreach ($routes as $route) {
			$class = $this->current_route === $route->route ? 'active' : '';
			echo '<a href="admin-routes/'.$route->file.'/'.$this->fix($route->route, true).'" class="mono route x-small font-weight-normal '.$class.'" title="'.$route->route.'">';
			echo $route->route !== '' ? $route->route : '/';
			echo '</a>';
		}
	}
	public function main() {
		if (!$this->current_route_file) {
			echo '<button class="btn-add" id="btn-new-routes-file">New routes file</button>';
		} else {
			if ($this->current_route === '⦃edit⦄') {
				echo '<button type="button" class="btn-add" id="btn-new-route">New Route</button>&nbsp;&nbsp;';
				echo '<button type="button" class="btn-remove" id="btn-remove-routes-file" data-file="'.$this->current_route_file.'">Remove</button>';
			} else {
				echo '<script>const templates = '.json_encode($this->templates, JSON_UNESCAPED_SLASHES).'</script>';
?>
<div class="float-left" style="margin-bottom: 15px;">
	<button type="button" class="btn-sm btn-ok" id="btn-save-route" title="Save changes" disabled="disabled">Save</button>
	<button type="button" class="btn-sm btn-revert" id="btn-revert-route" title="Undo changes" disabled>Revert</button>
</div>
<div class="float-right">
	<button type="button" class="btn-sm btn-link-out" id="btn-view-route" title="View (opens in another tab)">View</button>
</div>
<form id="route-form" spellcheck="false">
  <div class="form-group">
    <label for="route-route" class="text-normal">Route</label>
    <div class="form-group-input">
      <input type="text" id="route-route" class="mono">
    </div>
  </div>
  <div class="form-group row">
    <label for="route-include" class="text-normal">Include</label>
    <div>
      <input type="text" id="route-include" class="mono">
    </div>
  </div>
  <div class="form-group row">
    <label for="route-template" class="text-normal">Template</label>
    <div>
			<select id="route-template" placeholder="Select a template"></select>
    </div>
  </div>
  <div class="form-group row">
    <label for="route-title" class="text-normal">Title</label>
    <div>
			<input type="text" id="route-title">
    </div>
  </div>
  <div class="form-group row">
    <label for="route-meta" class="text-normal">Meta</label>
    <div>
			<textarea id="route-meta"></textarea>
    </div>
	</div>
	<div class="float-left" id="form-input-end" style="margin-bottom: 5px">
		<button type="button" class="btn-sm btn-add" id="btn-add-prop" title="Add property">Prop</button>
	</div>
	<div class="float-right" style="margin-bottom: 5px; margin-right: 20px;">
		<button type="button" class="btn btn-sm btn-delete" id="btn-delete-route" title="Delete route">Delete</button>
	</div>
</form>
<?php
			}
		}
	}
}

$routes = new Routes($this);
?>

<?php $routes->header(); ?>
<section class="col-routes">
	<?php $routes->routefileSelect(); ?>
	<section id="routes-list">
		<?php 
			$routes->routes();
		?>
	</section>
	<br>
	<small class="form-check float-left">
	  <input class="checkbox" type="checkbox" id="check-show-system-routes">
	  <label class="checkbox text-normal" for="check-show-system-routes">
			System routes
	  </label>
	</small>
</section>
<section class="col-main">
	<?php $routes->main(); ?>		
</section>

<script src="pages/admin/admin-routes.js"></script>

