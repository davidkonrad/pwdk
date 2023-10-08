"use strict";

const PW = (function(window, document) {
	const gebi = (id) => { return document.getElementById(id) }

	const init = function() {
		gebi('footer-logo').onclick = function() {
			window.scroll({top: 0, left: 0, behavior: 'smooth'});
		}			
		initMP()
	}

	const initMP = function() {
		if (!$.magnificPopup) return				
		$('figure > img').magnificPopup({
			type: 'image',
			verticalFit: true,
			showCloseBtn: false,
			closeOnContentClick: true,
			mainClass: 'mfp-with-zoom', 
			zoom: {
				enabled: true, 
				duration: 250, 
				easing: 'ease-in-out', 
				opener: function(openerElement) {
					return openerElement.is('img') ? openerElement : openerElement.find('img')
				}
			},
			gallery: {
				enabled: true
			}
		})
	}

	return {
		init
	}

})(window, document);

window.addEventListener('DOMContentLoaded', function() {
	PW.init()
})

