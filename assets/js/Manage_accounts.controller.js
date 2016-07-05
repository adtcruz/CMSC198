uname = "";

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
	return password;
}

function deactivateAccount(url,username){
	$.post(
		url+"deactivate_account",
		{username:username},
		function(data){
			if(data==="Deactivated account"){
				window.location.href=url+"manage_accounts";
			}
		}
	);
}

function activateAccount(url,username){
	$.post(
		url+"activate_account",
		{username:username},
		function(data){
			if(data==="Activated account"){
				window.location.href=url+"manage_accounts";
			}
		}
	);
}

function confirmPasswordReset(username){
	uname = username;
	$("#confirmResetPasswordModal").openModal({dismissible:false});

}

function resetPassword(url){
	newUserPassword = randomPassword();
	$.post(
		url+"reset_password",
		{
			username:uname,
			password:newUserPassword
		},
		function(data){
			if(data==="Account password reset"){
				$("#confirmResetPasswordModal").closeModal();
				$("#passwordResetModal").openModal({dismissible:false});
				$("#newPasswordArea").html(newUserPassword+"");
			}
		}
	);
}
