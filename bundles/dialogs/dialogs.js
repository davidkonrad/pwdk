"use strict";

const Dialogs = (function(document) {

	const gebi = function(id) {
		return document.getElementById(id)
	}

	const getCnt = function(html) {
		const cnt = document.createElement("SPAN")
		cnt.innerHTML = html
		document.body.appendChild(cnt)
		return cnt
	}

//alert
	const alertHTML = `
		<dialog id="dialog-alert" style="min-width:250px;">
		  <h4 id="dialog-header">Confirm</h4>
			<span class="icon">&#9888;</span>
		  <p id="dialog-message" style="margin-top:0.5em;"></p>
		  <div id="dialog-actions">
		    <button type="button" id="dialog-ok" class="btn-sm btn-ok">Ok</button>
		  </div>
		</dialog>
	`;

	const alert = function(message) {
		let cnt = document.createElement("SPAN")
		cnt.innerHTML = alertHTML
		document.body.appendChild(cnt)
		gebi('dialog-message').innerHTML = message
		gebi('dialog-alert').showModal()
		gebi('dialog-ok').onclick = function() {
			gebi('dialog-alert').close()
			document.body.removeChild(cnt)
		}
	}


//error
	const errorHTML = `
		<dialog id="dialog-error" style="min-width:250px;">
		  <h4 id="dialog-header">Error</h4>
			<span style="font-size:300%;line-height:100%;color:red;margin-right:10px;float:left;style:inline-block;font-weight:bold;">&#9888;</span>
		  <p id="dialog-message"></p>
		  <div id="dialog-actions">
		    <button type="submit" id="dialog-ok" class="btn-sm btn-ok">Ok</button>
		  </div>
		</dialog>
	`;

	const error = function(message) {
		return new Promise(function(resolve) {
			/*
			let cnt = document.createElement("SPAN")
			cnt.innerHTML = errorHTML
			document.body.appendChild(cnt)
			*/
			const cnt = getCnt(errorHTML)
			gebi('dialog-message').innerHTML = message
			gebi('dialog-error').showModal()
			gebi('dialog-ok').addEventListener('click', function() {
				gebi('dialog-error').close()
				document.body.removeChild(cnt)
				resolve(true)
			})
		})
	}
	
//input
	const inputHTML = `
		<dialog id="dialog-input">
		  <h4 id="dialog-message"></h4>
		  <input type="text" id="dialog-input-text">
		  <div id="dialog-actions">
		    <button id="dialog-ok" class="btn-ok" type="submit">OK</button>
		    <button id="dialog-cancel">Cancel</button>
		  </div>
		</dialog>
	`;

	const input = function(message) {
		return new Promise(function(resolve) {
			let cnt = document.createElement("SPAN")
			cnt.innerHTML = inputHTML
			document.body.appendChild(cnt)
			gebi('dialog-message').innerHTML = message
			gebi('dialog-input').showModal()
			gebi('dialog-input-text').focus()
			const ret = function(val) {
				gebi('dialog-input').close()
				document.body.removeChild(cnt)
				resolve(val)
			}
			const test = function() {
				const ok = gebi('dialog-input-text').value.length < 3
				gebi('dialog-ok').disabled = ok
				return !ok
			}
			gebi('dialog-input-text').onkeydown = function(e) {
				e = e || window.event
				switch (e.keyCode) {
					case 13: 
						if (test()) ret(this.value)
						break;
					case 27: 
						ret(false)
						//prevent with e.preventDefault()
						break;
					default:
						test()
						break;
				}
			}
			gebi('dialog-ok').onclick = function() {
				ret(gebi('dialog-input-text').value)
			}
			gebi('dialog-cancel').onclick = function() {
				ret(false)
			}
			test()
		})
	}

//confirm
	const confirmHTML = `
		<dialog id="dialog-confirm" style="min-width:250px;">
		  <h4 id="dialog-header">Confirm</h4>
			<span class="icon" style="color:navy;">❓</span>
		  <p id="dialog-message"></p>
		  <div id="dialog-actions">
		    <button type="button" id="dialog-ok" class="btn-sm btn-ok">Yes</button>
		    <button type="submit" id="dialog-cancel" class="btn-sm btn-no" autofocus>No</button>
		  </div>
		</dialog>
	`;

	const confirm = function(message) {
		return new Promise(function(resolve) {
			let cnt = document.createElement("SPAN")
			cnt.innerHTML = confirmHTML
			document.body.appendChild(cnt)
			gebi('dialog-message').innerHTML = message
			gebi('dialog-confirm').showModal()
			const ret = function(val) {
				gebi('dialog-confirm').close()
				document.body.removeChild(cnt)
				resolve(val)
			}
			gebi('dialog-ok').onclick = function() {
				ret(true)
			}
			gebi('dialog-cancel').onclick = function() {
				ret(false)
			}
		})
	}

	return {
		alert,
		error,
		input,
		confirm,
	}
	
})(document);

