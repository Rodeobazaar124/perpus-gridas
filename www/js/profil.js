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
	$('#busy').show();
	$.getJSON(serviceURL + 'profil.php', function(data) {
		$('#busy').hide();
		$('#profil li').remove();
		b = data.profils;
		$.each(b, function(index, c) {
			$('#profil').append('<li class="img">' +
				  '<img src="img/logo.png" class="list-icon" width="100px" height="100px"/>' +
					'' + c.nama_perpus + '</br>' +
				     '<p class="line2">' + c.alamat + '</p></a><br><br></li>'+
                    '<li><p class="line2" align="center"><strong>Visi</strong><br>' + c.visi +     ' </p></li>' +
                    '<li><p  class="line2" align="center"><strong>Misi</strong><br>' + c.misi +     ' </p></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}