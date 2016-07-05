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

function disableAccount(url,username){
	$.post(
		url+"disable_account",
		{username:username},
		function(data){
			if(data==="Deactivated account"){
				window.location.href=url+"manage_accounts";
			}
		}
	);
}
