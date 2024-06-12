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
var id  = $('select#daftarkategori option:selected').val()
	$('#busy').show();
	$.getJSON(serviceURL + 'katjurnal.php?id='+id, function(data) {
		$('#busy').hide();
		$('#daftarbuku li').remove();
		b = data.items;
		$.each(b, function(index, c) {
				$('#daftarbuku').append('<li><a href="detailjurnal.html?id=' + c.id_jurnal + '">' +
				  '<img src="img/jurnal.jpg" class="list-icon"/>' +
					'<p class="line1">' + c.jdl + '</p>' +
				     '<p class="line2">' + c.penulis + '</p>' +
					'</a></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}