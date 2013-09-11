$(document).ready(function() {
	var query = String(document.location).split('/admin/');
	var route = query[1];
	//alert(route);
	if (route==='') {
		$('.dashboard').addClass('active');
	} else {
		var part = route.split('/');
		$('.'+part[0]).addClass('active');
		$('a[href*="' + route + '"]').addClass('active');
	}
});