"use strict";

const Templates = (function(window, document) {

	const gebi = function(id) {
		return document.getElementById(id)
	}

	const init = function() {
		initTable()
	}

	const initTable = function() {
		if (window.$ !== undefined && $.fn && $.fn.DataTable) {
			$('#templates-table').DataTable({
				order: [],
				language: {
					sSearch: 'Filter'
				},
				paging: false,
				dom: 'ft'
			})
			$('hr').remove()
		}
	}

	return {
		init,
	}

})(window, document).init();

