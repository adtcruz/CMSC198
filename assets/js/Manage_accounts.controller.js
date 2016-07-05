$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs();
	}
);

function randomPassword() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz-_@";
	var password = '';
	for (var i=0; i<6; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		password += chars.substring(rnum,rnum+1);
	}
}
