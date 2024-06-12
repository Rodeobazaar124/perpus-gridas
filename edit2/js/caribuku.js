var serviceURL = localStorage['serviceURL'];
var scroll = new iScroll('wrapper', { vScrollbar: false, hScrollbar:false, hScroll: false });

var judul = getUrlVars()["judul"];

$(window).load(function() {
	setTimeout(getEmployee, 100);
});

$(document).ajaxError(function(event, request, settings) {
	$('#busy').hide();
	alert("Error accessing the server");
});

function getEmployee() {
	$('#busy').show();
	$.getJSON(serviceURL + 'cari_buku.php?judul='+judul, function(data) {
$('#busy').hide();
		$('#daftarbuku li').remove();
		b = data.cr;
		$.each(b, function(index, c) {
			$('#daftarbuku').append('<li><a href="detailbuku.html?id=' + c.id_buku + '">' +
				  '<img src="img/sampul.jpg" class="list-icon"/>' +
					'<p class="line1">' + c.judul + '</p>' +
				     '<p class="line2">' + c.nama_pengarang + '</p>' +
					'<span class="bubble">' + c.jumlahbuku + '</span></a></li>');
		});
		setTimeout(function(){
			scroll.refresh();
		});
	});
}
	

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
