
var serviceURL = localStorage['serviceURL'];
var scroll = new iScroll('wrapper', { vScrollbar: false, hScrollbar:false, hScroll: false });

var id = getUrlVars()["id"];

$(window).load(function() {
	setTimeout(getEmployee, 100);
});

$(document).ajaxError(function(event, request, settings) {
	$('#busy').hide();
	alert("Error accessing the server");
});

function getEmployee() {
	$('#busy').show();
	$.getJSON(serviceURL + 'detailbuku.php?id='+id, function(data) {
		$('#busy').hide();
		var employee = data.item;
		console.log(employee);
	  $('#sampulbuku').attr('src', 'img/sampul.jpg');
		$('#judul').text(employee.judul );
		$('#pengarang').text(employee.pengarang);

		
		$('#koderak').append('<li class="info"><p class="line1">koderak</p>' +
					'<p class="line2">' + employee.koderak + '</p><img src="img/rak.png" width="30px" class="action-icon"/></li>');
		$('#bahasa').append('<li class="info"><p class="line1">Bahasa</p>' +
					'<p class="line2">' + employee.bahasa + '</p><img src="img/flag.png" width="30px" class="action-icon"/></li>');		
		$('#kategori').append('<li class="info"><p class="line1">Kategori</p>' +
					'<p class="line2">' + employee.kategori + '</p><img src="img/kategori.png" width="30px" class="action-icon"/></li>');			
		$('#jumlah').append('<li class="info"><p class="line1">Jumlah</p>' +
					'<p class="line2">' + employee.jumlahbuku + '</p><img src="img/jml.png" width="40px" class="action-icon"/></li>');	
        $('#tersedia').append('<li class="info"><p class="line1">Tersedia</p>' +
					'<p class="line2">' + employee.tersedia + '</p><img src="img/sedia.png" width="40px" class="action-icon"/></li>');	

		
		
		
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
