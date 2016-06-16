function logOutControl(url){
	$.get(url+'logout/', function(data){
		window.location.href = url;
		console.log("logout");
	});
}