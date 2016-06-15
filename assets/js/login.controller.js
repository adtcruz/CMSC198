$(document).ready(
	function(){
		if(!($('body').hasClass('red')&&$('body').hasClass('darken-1'))){
			$('body').addClass('red');
			$('body').addClass('darken-1');
		}
	}
);

function logInControl(url){
	uname = usernameInput.value;
	pword = passwordInput.value;
	if (uname === "") return;
	if (pword === "") return;
	$.post(url+'login',{username:uname,password:pword}, function(data){
		if(data === "Logged-on"){
			window.location.href = url;	 
		}
		else if (data === "Invalid password"){
			Materialize.toast("Invalid password!", 3000);
		}
		else if (data === "Invalid credentials"){
			//username does not exist
		}
	});
}