localStorage['serviceURL'] = "http://127.0.0.1/kat/services/";
var serviceURL = localStorage['serviceURL'];

var scroll = new iScroll('wrapper', { vScrollbar: false, hScrollbar:false, hScroll: false });

var b;


$(window).load(function() {
	setTimeout(getaBookList, 100);
});

$(document).ajaxError(function(event, request, settings) {
	$('#busy').hide();
	alert("Error accessing the server");
});

function getaBookList() {
var jdl = $('#txt').val();
	$('#busy').show();
	$.getJSON(serviceURL + 'cari_buku.php?judul='+jdl, function(data) {
		$('#busy').hide();
		$('#daftarbuku li').remove();
		b = data.cr;
		$.each(b, function(index, c) {
			$('#daftarbuku').append('<li><a href="detailbuku.html?id=' + c.id_buku + '">' +
				  '<img src="img/sampul.jpg" class="list-icon"/ height="50px">' +
					'<p class="line1">' + c.judul + '</p>' +
				     '<p class="line2">' + c.nama_pengarang + '</p>' +
					'<span class="bubble">' + c.tersedia + '</span></a></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}