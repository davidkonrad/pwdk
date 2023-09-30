"use strict";

const AdminRoutes = (function(window) {
	
	const gebi = function(id) {
		return document.getElementById(id)
	}

	const qone = function(sel) {
		return document.querySelector(sel)
	}

	const qall = function(sel) {
		return document.querySelectorAll(sel)
	}

	const delegate = function(selector, event, handler) {
	  document.querySelectorAll(selector).forEach(function(element) {
			element.addEventListener(event, function(e) {
        handler(e)
			})
    })
	}

	const fix = function(route) {
		return route.replace('/g', '∕')
	}

	const showSystemRoutes = function(set) {
		const ls = window.localStorage
		if (set === undefined) return ls.getItem('showSystemRoutes') || false
		ls.setItem('showSystemRoutes', set)
	}

	const rapi = function(data) {
		const urlEncode = function(data) {
			let r = ''
			for (let arg in data) {
				r += arg + '=' + encodeURIComponent(data[arg]) + '&'
			}
			return r
		}
		const headers = {
			'Accept': 'application/json, application/gawain',
			'Content-Type': 'application/x-www-form-urlencoded'
		}
		return new Promise(function(resolve) {
			fetch('lib/Gingalain.php', { 
				method: 'POST',
				headers: headers,
				body: urlEncode(data)
			})
			.then(r => r.text()).then(text => {
				resolve( JSON.parse(text) )
			})
		})
	}		

	const renderProp = function(prop) {
		const index = document.querySelectorAll('.prop-group').length + 1
		const tmpl =  `<div class="form-group row prop-group">
	    <label for="prop${index}" class="">${prop.name}</label>
			<div class="input-group col-sm-9">
				<input type="text" class="prop-input" id="prop${index}" data-prop="${prop.name}" value="${prop.value}">
				<div class="input-group-prepend">
					<div class="input-group-text">&times;</div>
				</div>
      </div>
		</div>`;
		gebi('form-input-end').insertAdjacentHTML('beforebegin', tmpl)
	}

	const renderProps = function() {
		if (current_route && current_route.props) {
			current_route.props.forEach(function(prop) {
				renderProp(prop)
			})
		}
	}				

	const renderTemplates = function(template) {
		const select = gebi('route-template')
		select.innerHTML = '' //dirty
		if (templates) {
			templates.forEach(function(t) {
				select.options[select.options.length] = new Option(t, t)
			})
			if (template) {
				document.querySelector('#route-template [value="' + template + '"]').selected = true
			} else {
				select.selectedIndex =-1
			}
		}
	}				

	const redirectToRoutes = function(routesFile) {
		document.location.href = 'admin-routes/' + routesFile +'/⦃edit⦄'
	}

	const redirectToRoute = function(routesFile, route) {
		document.location.href = 'admin-routes/' + routesFile + '/' + fix(route)
	}

	const populateForm = function() {
		gebi('route-route').value	= current_route.route || ''
		gebi('route-route').focus()
		gebi('route-title').value = current_route.title || ''
		gebi('route-include').value = current_route.include || ''
		gebi('route-meta').value = current_route.meta || ''
		renderTemplates(current_route.template || '')
		renderProps()
	}

	const populateFormListeners = function() {
		gebi('btn-save-route').onclick = function() {
			let upd = {
				route: gebi('route-route').value,
				include: gebi('route-include').value,
				title: gebi('route-title').value,
				meta: gebi('route-meta').value,
				template: gebi('route-template').value,
			}
			if (current_route.props) {
				upd.props = current_route.props.map(function(prop) {
					console.dir(qone('input[data-prop="' + prop.name + '"]'))
					return {
						name: prop.name,
						value: qone('input[data-prop="' + prop.name + '"]').value
					}
				})
			}
			current_routes.routes[current_route_index] = upd
			rapi({
				action: 'cf',
				path: 'routes',
				name: current_route_file,
				content: JSON.stringify(current_routes)
			}).then(function(res) {
				redirectToRoute(current_route_file, upd.route)
			})
		}

		gebi('btn-revert-route').onclick = function() {
			populateForm()
			gebi('btn-save-route').setAttribute('disabled', 'disabled')
			gebi('btn-revert-route').setAttribute('disabled', 'disabled')
		}		

		gebi('btn-add-prop').onclick = function() {
			Dialogs.input('Enter name, e.g MyProp').then(function(res) {
				if (res) {
					if (!current_route.props) current_route.props = []
					const prop = {
						name: res,
						value: ''
					}
					current_route.props.push(prop)
					renderProp(prop)
				}
			})
			return false
		} 

		const routeChange = function() {
			gebi('btn-save-route').removeAttribute('disabled')
			gebi('btn-revert-route').removeAttribute('disabled')
		}
		delegate('input', 'keyup', routeChange)
		delegate('textarea', 'keyup', routeChange)
		delegate('select', 'change', routeChange)

		gebi('btn-view-route').onclick = function() {
			window.open(gebi('route-route').value, '_blank')
		}
	}		

	const init = function() {
		const btnNewRoutes = gebi('btn-new-routes-file')
		const btnNewRoute = gebi('btn-new-route')
		const btnDeleteRoute = gebi('btn-delete-route')
		const btnRemoveRoutesFile = gebi('btn-remove-routes-file')
		const inputRoute = gebi('route-route')
		const checkShowSystemRoutes = gebi('check-show-system-routes')
		const selectRouteFile = gebi('select-route-file')

		if (selectRouteFile) selectRouteFile.onchange = function() {
			redirectToRoutes(this.value)
		}

		if (btnNewRoutes) btnNewRoutes.onclick = function() {
			Dialogs.input('Enter name, e.g MyRoutes ..'  ).then(function(name) {
				if (name) createRoute(name).then(function(result) {
					redirectToRoutes(name + '.routes')
				})
			})
		}

		if (btnRemoveRoutesFile) btnRemoveRoutesFile.onclick = function() {
			const file = this.getAttribute('data-file')			
			Dialogs.confirm('Really remove <code>'+file+'</code> from the list?').then(function(result) {
				if (result) {
					const data = {
						action: 'rf',
						path: 'routes',
						name: file,
						ext: 'removed'
					}
					rapi(data).then(function(result) {
						document.location.href = 'admin-routes/'
					})
				}
			})
		}

		if (inputRoute) {
			populateForm()
			populateFormListeners()
		}

		if (btnNewRoute) btnNewRoute.onclick = function() {
			Dialogs.input('Enter route, e.g my/path/to ..').then(function(route) {
				if (route) {
					let dup = false
					if (routes_list) {
						for (let r in routes_list) {
							if (routes_list[r].route === route) {
								dup = true
								Dialogs.error('The route ´'+ route +'´ is already declared in ´'+ routes_list[r].file + '´').then(function() { })
								break;
							}
						}
					}
					if (dup) return
					current_routes.routes.push({ route: route })
					rapi({
						action: 'cf',
						path: 'routes',
						name: current_route_file,
						content: JSON.stringify(current_routes)
					}).then(function(res) {
						document.location.href = 'admin-routes/' + current_route_file + '/' + fix(route)
					})
				}
			})
		}

		if (btnDeleteRoute) btnDeleteRoute.onclick = function() {
			Dialogs.confirm('Really delete this route?').then(function(yes) {
				if (yes) {
					current_routes.routes.splice(current_route_index, 1)
					rapi({
						action: 'cf',
						path: 'routes',
						name: current_route_file,
						content: JSON.stringify(current_routes)
					}).then(function(res) {
						redirectToRoutes(current_route_file)
					})
				}
			})
		}

		if (checkShowSystemRoutes) {
			const toggle = function() {
				document.querySelectorAll('.is-system-route').forEach(function(cnt) {
					cnt.classList.toggle('display-none')
				})
			}
			checkShowSystemRoutes.onchange = function() {
				showSystemRoutes(this.checked)
				toggle()
			}
			const ssr = showSystemRoutes()
			if (ssr === 'true') setTimeout(function() {
				checkShowSystemRoutes.checked = true
				toggle()
			}, 100)
		}
	}

	const createRoute = function(name) {
		const data = {
			action: 'cf',
			path: 'routes',
			name: name+'.routes',
			content: '{ "routes": [] }'
		}
		return rapi(data)
	}

	return {
		init,
	}
})(window).init()


