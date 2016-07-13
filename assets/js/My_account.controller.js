user_givenName_old = "";
user_lastName_old = "";

$('document').ready(
	function(){
		$("#myAccountButton").addClass("black");
		user_givenName_old = $("#user_givenName").val();
		user_lastName_old = $("#user_lastName").val();
	}
);

//removes visible error messages
function oldPasswordOnChange(){
	$("#oldPasswordLabel").attr("data-error","Please re-enter old password.");
	$("#oldPasswordLabel").html("Re-enter old password");
	if($("#oldPassword").hasClass("invalid")) $("#oldPassword").removeClass("invalid");
}

//removes visible error messages
function newPasswordOnChange(){
	$("#newPasswordLabel").attr("data-error","Please enter a password.");
	$("#confirmPasswordLabel").attr("data-error","Please enter a password.");
	$("#newPasswordLabel").html("Enter new password");
	$("#confirmPasswordLabel").html("Confirm new password");
	if($("#newPassword").hasClass("invalid")) $("#newPassword").removeClass("invalid");
	if($("#confirmPassword").hasClass("invalid")) $("#confirmPassword").removeClass("invalid");
	if($("#newPassword").val().length < 6) $("#confirmPassword").attr("disabled","disabled");
	else $("#confirmPassword").removeAttr("disabled");
	$("#confirmPassword").val("");
}

//removes visible error messages
function confirmPasswordOnChange(){
	$("#newPasswordLabel").attr("data-error","Please enter a password.");
	$("#confirmPasswordLabel").attr("data-error","Please enter a password.");
	$("#newPasswordLabel").html("Enter new password");
	$("#confirmPasswordLabel").html("Confirm new password");
	if($("#newPassword").hasClass("invalid")) $("#newPassword").removeClass("invalid");
	if($("#confirmPassword").hasClass("invalid")) $("#confirmPassword").removeClass("invalid");
}

//checks for input errors before calling API to update the password
//if there are errors, the function execution is preterminated
function updatePassword(url){

	err = false;

	if($("#oldPassword").val()===""){
		$("#oldPasswordLabel").attr("data-error","Please re-enter old password.");
		$("#oldPasswordLabel").html(
			"Re-enter old password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#oldPassword").hasClass("invalid"))) $("#oldPassword").addClass("invalid");
		err = true;
	}

	if($("#newPassword").val()===""){
		$("#newPasswordLabel").attr("data-error","Please enter a password.");
		$("#newPasswordLabel").html(
			"Enter new password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#newPassword").hasClass("invalid"))) $("#newPassword").addClass("invalid");
		err = true;
	}

	if($("#confirmPassword").val()===""){
		$("#confirmPasswordLabel").attr("data-error","Please confirm new password.");
		$("#confirmPasswordLabel").html(
			"Confirm new password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#confirmPassword").hasClass("invalid"))) $("#confirmPassword").addClass("invalid");
		err = true;
	}

	if(err) return;

	if($("#newPassword").val()===$("#confirmPassword").val()){
		$.post(
			url+"update_password",
			{
				passwordOld:$("#oldPassword").val(),
				passwordNew:$("#newPassword").val()
			},
			function(data){
				if(data==="Password updated"){
					$("#changePasswordModal").closeModal();
					$("#passwordUpdatedModal").openModal({dismissible:false});
					$("#oldPassword").val("");
					$("#newPassword").val("");
					$("#confirmPassword").val("");
					$("#confirmPassword").attr("disabled","disabled");
				}
			}
		);
	}

	if($("#newPassword").val()!==$("#confirmPassword").val()){
		$("#newPasswordLabel").attr("data-error","Passwords do not match!");
		$("#confirmPasswordLabel").attr("data-error","Passwords do not match!");
		$("#newPasswordLabel").html(
			"Enter new password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#confirmPasswordLabel").html(
			"Confirm new password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#newPassword").hasClass("invalid"))) $("#newPassword").addClass("invalid");
		if(!($("#confirmPassword").hasClass("invalid"))) $("#confirmPassword").addClass("invalid");
	}

}

//removes visible error messages
function givenNameOnChange(){
	$("#user_givenNameLabel").attr("data-error","Given Name can not be blank!");
	$("#user_givenNameLabel").html("Given Name: ");
	if($("#user_givenName").hasClass("invalid")) $("#user_givenName").removeClass("invalid");
}

//removes visible error messages
function lastNameOnChange(){
	$("#user_lastNameLabel").attr("data-error","Given Name can not be blank!");
	$("#user_lastNameLabel").html("Last Name: ");
	if($("#user_lastName").hasClass("invalid")) $("#user_lastName").removeClass("invalid");
}

//checks for input errors before calling API to update the password
//if there are errors, the function execution is preterminated
function updateProfile(url){

	err = false;

	if($("#user_givenName").val()===""){
		$("#user_givenNameLabel").attr("data-error","Given Name can not be blank!");
		$("#user_givenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_givenName").hasClass("invalid"))) $("#user_givenName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test($("#user_givenName").val()))){
		$("#user_givenNameLabel").attr("data-error","Invalid characters detected");
		$("#user_givenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_givenName").hasClass("invalid"))) $("#user_givenName").addClass("invalid");
		err = true;
	}

	if($("#user_lastName").val()===""){
		$("#user_lastNameLabel").attr("data-error","Last Name can not be blank!");
		$("#user_lastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_lastName").hasClass("invalid"))) $("#user_lastName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test($("#user_lastName").val()))){
		$("#user_lastNameLabel").attr("data-error","Invalid characters detected");
		$("#user_lastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_lastName").hasClass("invalid"))) $("#user_lastName").addClass("invalid");
		err = true;
	}

	if (err) return;

	if((user_givenName_old!==$("#user_givenName").val())||
		(user_lastName_old!==$("#user_lastName").val())){
		$.post(
			url+"update_profile",
			{
				givenName:$("#user_givenName").val(),
				lastName:$("#user_lastName").val()
			},
			function(data){
				if(data==="Profile updated"){

					$("#profileUpdatedModal").openModal({dismissible:false});
					user_givenName_old = $("#user_givenName").val();
					user_lastName_old = $("#user_lastName").val();
					$("#sidebar_givenName").html($("#user_givenName").val());
					$("#sidebar_lastName").html($("#user_lastName").val());
				}
			}
		);
	}
}
