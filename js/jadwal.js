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
	$('#busy').show();
	$.getJSON(serviceURL + 'jadwal.php', function(data) {
		$('#busy').hide();
		$('#jadwal li').remove();
		b = data.jadwals;
		$.each(b, function(index, c) {
			$('#jadwal').append('<li class="img">' +
				  '<img src="img/jadwal.png" class="list-icon" width="100px" height="100px"/>' +
					'' + c.hari + '</br>' +
				     '<p class="line2"> Buka :' + c.jam_buka + ' Sampai : '+ c.jam_tutup + '</p></a><br><br></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}