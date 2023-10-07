"use strict";

const PW = (function(window, document) {
	const qsel = (sel) => { return document.querySelector(sel) }	// eslint-disable-line no-unused-vars
	const qall = (sel) => { return document.querySelectorAll(sel) }	// eslint-disable-line no-unused-vars

	const init = function() {
		if (!$.magnificPopup) return				// eslint-disable-line no-undef
		$('figure > img').magnificPopup({		// eslint-disable-line no-undef
			type: 'image',
			verticalFit: true,
			showCloseBtn: false,
			closeOnContentClick: true,
			callbacks: {
				elementParse: function(item) {
					item.src = item.el[0].currentSrc.indexOf('/md/')>-1 
						? item.el[0].currentSrc.replace('/md/', '/lg/')
						: item.el[0].currentSrc.replace('/sm/', '/lg/')
				}
			},
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

