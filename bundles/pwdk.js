"use strict";

const Weidner = (function(window, document) {
	const gebi = (id) => { return document.getElementById(id) }
	const qsel = (sel) => { return document.querySelector(sel) }
	const qall = (sel) => { return document.querySelectorAll(sel) }

	const init = function() {
		initLogo()	
		initMP()
		initNavbar()
		initGong()
		initVideo()
	}

	const initLogo = function() {
		const logo = gebi('footer-logo')
		if (logo) logo.onclick = function() {
			window.scroll({top: 0, left: 0, behavior: 'smooth'})
		}		
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
		const logos = qall('.pernille-weidner-logo')
		//const gongtest = gebi('gong-lyd-proeve')
		if (!gong || !logos) return
		logos.forEach(function(logo) {
			logo.addEventListener('mouseover', function() {
				gong.play()
			})
			logo.addEventListener('mouseleave', function() {
				gong.pause()
				gong.currentTime = 0
			})
		})
		//if (gongtest) gongtest.setAttribute('src', gong.getAttribute('src'))
	}

	const initVideo = function() {
		const video = qsel('video')
		if (video) {
			video.onclick = function() {
				this.play()
			}
		}
	}

	return {
		init
	}

})(window, document);

window.addEventListener('DOMContentLoaded', function() {
	Weidner.init()
})

