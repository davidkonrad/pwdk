"use strict";

const PW = (function(window, document) {
	const gebi = (id) => { return document.getElementById(id) }
	const qsel = (sel) => { return document.querySelector(sel) }

	const init = function() {
		const logo = gebi('footer-logo')
		if (logo) logo.onclick = function() {
			window.scroll({top: 0, left: 0, behavior: 'smooth'});
		}			
		initMP()
		initNavbar()
		initGong()
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

	const initNavbar = function() {
		const $dropdown = $(".dropdown")
		const $dropdownToggle = $(".dropdown-toggle")
		const $dropdownMenu = $(".dropdown-menu")
		const showClass = "show"

		$(window).on("load resize", function() {
			if (this.matchMedia("(min-width: 768px)").matches) {
				$dropdown.hover(
					function() {
						const $this = $(this)
						$this.addClass(showClass)
						$this.find($dropdownToggle).attr("aria-expanded", "true")
						$this.find($dropdownMenu).addClass(showClass)
					},
					function() {
						const $this = $(this)
						$this.removeClass(showClass)
						$this.find($dropdownToggle).attr("aria-expanded", "false")
						$this.find($dropdownMenu).removeClass(showClass)
					}
				)
			} else {
				$dropdown.off("mouseenter mouseleave")
			}
		})
	}

	const initGong = function() {
		const gong = gebi('gong-eksempel')
		const logo = qsel('.pernille-weidner-logo')
		if (!gong || !logo) return
		logo.addEventListener('mouseover', function() {
			gong.play()
		})
		logo.addEventListener('mouseleave', function() {
			gong.pause()
			gong.currentTime = 0
		})
	}

	return {
		init
	}

})(window, document);

window.addEventListener('DOMContentLoaded', function() {
	PW.init()
})

