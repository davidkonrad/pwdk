"use strict";

const Bundles = (function(window) {

	const gebi = function(id) {
		return document.getElementById(id)
	}

	const init = function() {
		initTable()
		const importBtn = gebi('btn-import-file')
		const hiddenFile = gebi('file')
		hiddenFile.onchange = function() {
			importRegisterFile('file')
		}
		importBtn.onclick = function() {
			hiddenFile.click()
		}
		gebi('bundles-table').addEventListener('click', function(e) {
			if (event.target.matches('.btn-remove-bundle')) {
				const bundle_name = e.target.getAttribute('data-bundle')
				Dialogs.confirm('Remove '+bundle_name+'?').then(function(yes) {
					if (yes) {
						current_bundles.bundles = current_bundles.bundles.filter(function(b) {
							if (b.name !== bundle_name) return b
						})
						rapi({
							action: 'cf',
							path: 'bundles',
							name: 'bundles.register',
							content: JSON.stringify(current_bundles)
						}).then(function(res) {
							document.location.href = 'admin-bundles'
						})
					}
				})
			}

			if (event.target.matches('.check-enable-bundle')) {
				const bundle_name = e.target.parentNode.parentNode.getAttribute('data-bundle')
				for (let b in current_bundles.bundles) {
					if (current_bundles.bundles[b].name == bundle_name) {
						const enabled = current_bundles.bundles[b].enabled == 'true'
						current_bundles.bundles[b].enabled = enabled ? 'false' : 'true'
					}
				}
				rapi({
					action: 'cf',
					path: 'bundles',
					name: 'bundles.register',
					content: JSON.stringify(current_bundles)
				}).then(function(res) {
					document.location.href = 'admin-bundles'
				})
			}

		})
	}

	const initTable = function() {
		if (window.$ !== undefined && $.fn && $.fn.DataTable) {
			$.fn.dataTable.ext.order['dom-checkbox'] = function( settings, col ) {
				return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
					return $('input', td).prop('checked') ? '1' : '0';
				})
			}
			$('#bundles-table').DataTable({
				order: [],
				rowReorder: true,
				language: {
					sSearch: 'Filter'
				},
				columnDefs: [
					{ targets: 1, orderDataType: 'dom-checkbox' },
					{ targets: 5, orderable: false },
				],
				paging: false,
				dom: 'ft'
			}).on('row-reorder.dt', function(e, data, edit) {
				if (!data || !data[0]) return
				const move = function(array, oldindex, newindex) {
					array.splice(newindex, 0, array.splice(oldindex, 1)[0])
					return array
				}
				const reordered_bundles = {
					bundles: move(current_bundles.bundles, data[0].oldPosition, data[0].newPosition)
				}
				rapi({
					action: 'cf',
					path: 'bundles',
					name: 'bundles.register',
					content: JSON.stringify(reordered_bundles)
				}).then(function(res) {
					document.location.href = 'admin-bundles'
				})
			})
		}
	}

	//need to refactor a way out of growing redundancy 
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

	const dialogHTML = `
		<dialog id="dialog-bundle">
		  <h2 class="no-margin-top">Import Bundle</h2>
		  <div class="form-group row">
		    <label for="dialog-name" class="col-sm-3 col-form-label">Name</label>
		    <div class="col-sm-9">
		      <input type="text" id="dialog-name" class="form-control form-control-sm" spellcheck="false">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="dialog-category" class="col-sm-3 col-form-label">Category</label>
		    <div class="col-sm-9">
		      <input type="text" id="dialog-category" xxxxclass="form-control form-control-sm"  spellcheck="false">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="dialog-description" class="col-sm-3 col-form-label">Description</label>
		    <div class="col-sm-9">
					<textarea class="form-control form-control-sm" id="dialog-description" rows="3" spellcheck="false"></textarea>
		    </div>
			</div>
		  <div id="dialog-actions">
		    <button type="button" id="dialog-ok" class="btn-sm btn-add" type="submit">Import</button>
		    <button type="button" id="dialog-cancel" class="btn-sm btn-delete">Cancel</button>
		  </div>
		</dialog>
	`;

	const bundleDialog = function(bundle) {
		return new Promise(function(resolve) {
			let cnt = document.createElement("SPAN")
			cnt.innerHTML = dialogHTML
			document.body.appendChild(cnt)
			gebi('dialog-name').value = bundle.name
			gebi('dialog-category').value = bundle.category || ''
			gebi('dialog-description').innerHTML = bundle.description || ''
			gebi('dialog-bundle').showModal()
			gebi('dialog-ok').onclick = function() {
				bundle.name = gebi('dialog-name').value
				bundle.category = gebi('dialog-category').value
				bundle.description = gebi('dialog-description').value
				gebi('dialog-bundle').close()
				document.body.removeChild(cnt)
				resolve(bundle)
			}
			gebi('dialog-cancel').onclick = function() {
				gebi('dialog-bundle').close()
				document.body.removeChild(cnt)
				resolve(false)
			}
		})
	}

	const testRegisterFile = function(fileinput) {
		return new Promise(function(resolve) {
			const files = gebi(fileinput).files
			if (files.length > 0) {
				const formData = new FormData()
				formData.append("file", files[0])
				const xhttp = new XMLHttpRequest()
				xhttp.open('post', 'pages/admin/upload-register-file.php', true)
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						resolve( JSON.parse(this.response) )
					} else {
						//
					}
				}
	      xhttp.send(formData)
			} else {
				resolve( { error: 'No .register file selected' })
			}
		})
	}

	const importRegisterFile = function(fileinput) {
		testRegisterFile(fileinput).then(function(res) {
			if (res.error) {
				Dialogs.error( res.error )
			} else {
				for (let b in current_bundles.bundles) {
					if (current_bundles.bundles[b].name == res.name) {
						Dialogs.error('A bundle with the name "'+res.name+'" is already registered.').then(function() {
						})
						return
					}
				}
				bundleDialog(res).then(function(bundle) {
					if (bundle) {
						if (current_bundles && current_bundles.bundles) {
							current_bundles.bundles.push(bundle)
							rapi({
								action: 'cf',
								path: 'bundles',
								name: 'bundles.register',
								content: JSON.stringify(current_bundles)
							}).then(function(res) {
								document.location.href = 'admin-bundles'
							})
						}
					}
				})
			}
		})
	}

	return {
		init,
	}

})(window).init()


