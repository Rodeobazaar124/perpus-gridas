
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
	$.getJSON(serviceURL + 'detailjurnal.php?id='+id, function(data) {
		$('#busy').hide();
		var employee = data.item;
		console.log(employee);
	  $('#sampulbuku').attr('src', 'img/jurnal.png');
		$('#judul').text(employee.judul );
		$('#penulis').text(employee.penulis);

		
		$('#kategori').append('<li class="info"><p class="line1">kategori</p>' +
					'<p class="line2">' + employee.kategori + '</p><img src="img/rak.png" width="30px" class="action-icon"/></li>');
		$('#tgl_posting').append('<li class="info"><p class="line1">Tgl. Posting</p>' +
					'<p class="line2">' + employee.tgl_posting + '</p><img src="img/flag.png" width="30px" class="action-icon"/></li>');		
		$('#abstrak').append('<li class="info"><p class="line1">Abstrak</p>' +
					'<p class="line2">' + employee.abstrak + '</p></li>');			
		
        $('#file').append('<li class="info"><p class="line1"></p>' +
					'<a href=../files/'+ employee.file + '> <button class="btn btn-large btn-primary tmd" type="button">Download Jurnal</button></a></li><br><br>');	

		
		
		
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
