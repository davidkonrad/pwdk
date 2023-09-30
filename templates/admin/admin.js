"use strict";

/*
Gawain
Support diminutive GUI 'components' so we can have built-in admin pages work without use of third party libraries or CSS. 
Expect this to change a lot, G is for garbage :)
*/

const G = (function(document) {

	const initButtons = function() {
		document.querySelectorAll('.btn-input-group').forEach(function(b) {
			const s = b.parentElement.querySelector('select')
			b.style.height = s.offsetHeight + 'px'
			s.style.borderTopLeftRadius = 0
			s.style.borderBottomLeftRadius = 0
		})
	}

	const initAccordions = function() {
		const selector = '.accordion'
		const multiple = true //TODO, use data-multiple="false"
		document.addEventListener('click', function (e) {
			if (!e.target.matches(selector + ' .accordion-title')) return;
			else {
				if (!e.target.parentElement.classList.contains('active')) {
					if (!multiple) {
						var elementList = document.querySelectorAll(selector + ' .accordion-cnt')
						Array.prototype.forEach.call(elementList, function (e) {
							e.classList.remove('active')
						})
					}
					e.target.parentElement.classList.add('active')
				} else {
					e.target.parentElement.classList.remove('active')
				}
			}
		})
	}

	const initGUI = function() {
		//initAccordions()
		initButtons()
	}	

	const init = function() {
		const paths = location.pathname.split('/')
		for (let p of paths) {
			let e = document.querySelector('header a[href="' + p + '"]')
			if (e) {
				e.classList.toggle('active')
				break;
			}
		}
		initGUI()
	}

	return {
		init
	}

})(document).init()

