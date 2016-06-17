function logOut(url){
	$.get(url+'logout/', function(data){
		window.location.href = url;
	});
}