localStorage['serviceURL'] = "http://project.smkn1sumedang.sch.id/services/";
var serviceURL = localStorage['serviceURL'];

var scroll = new iScroll('wrapper', { vScrollbar: false, hScrollbar:false, hScroll: false });

var b;

$(window).load(function() {
	setTimeout(getKat, 100);
});

$(document).ajaxError(function(event, request, settings) {
	$('#busy').hide();
	alert("Error accessing the server");
});

function getKat() {
	$('#busy').show();
	$.getJSON(serviceURL + 'get_katjurnal.php', function(data) {
		$('#busy').hide();
		$('#daftarkategori option').remove();
		b = data.kat;
		$.each(b, function(index, c) {
			$('#daftarkategori').append('<option value=' + c.id_kategori + '>' + c.nama_kategori + '</option>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}