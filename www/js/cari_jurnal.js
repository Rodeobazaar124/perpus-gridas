localStorage['serviceURL'] = "http://project.smkn1sumedang.sch.id/services/";
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
	$.getJSON(serviceURL + 'cari_jurnal.php?judul='+jdl, function(data) {
		$('#busy').hide();
		$('#daftarjurnal li').remove();
		b = data.jr;
		$.each(b, function(index, c) {
			$('#daftarjurnal').append('<li><a href="detailjurnal.html?id=' + c.id_jurnal + '">' +
				  '<img src="img/jurnal.png" class="list-icon"/ height="50px">' +
					'<p class="line1">' + c.jdl + '..</p>' +
				     '<p class="line2">' + c.penulis + '</p>' +
					'</a></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}