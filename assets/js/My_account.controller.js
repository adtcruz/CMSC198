user_givenName_old = "";
user_lastName_old = "";

$('document').ready(
	function(){
		$("#myAccountButton").addClass("black");
		user_givenName_old = $("#user_givenName").val();
		user_lastName_old = $("#user_lastName").val();
	}
);

function givenNameOnChange(){
	$("#user_givenNameLabel").attr("data-error","Given Name can not be blank!");
	$("#user_givenNameLabel").html("Given Name: ");
	if($("#user_givenName").hasClass("invalid")) $("#user_givenName").removeClass("invalid");
}

function lastNameOnChange(){
	$("#user_lastNameLabel").attr("data-error","Given Name can not be blank!");
	$("#user_lastNameLabel").html("Last Name: ");
	if($("#user_lastName").hasClass("invalid")) $("#user_lastName").removeClass("invalid");
}

function updateProfile(url){

	if($("#user_givenName").val()===""){
		$("#user_givenNameLabel").attr("data-error","Given Name can not be blank!");
		$("#user_givenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_givenName").hasClass("invalid"))) $("#user_givenName").addClass("invalid");
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s]*$/).test($("#user_givenName").val()))){
		$("#user_givenNameLabel").attr("data-error","Invalid characters detected");
		$("#user_givenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_givenName").hasClass("invalid"))) $("#user_givenName").addClass("invalid");
	}

	if($("#user_lastName").val()===""){
		$("#user_lastNameLabel").attr("data-error","Last Name can not be blank!");
		$("#user_lastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_lastName").hasClass("invalid"))) $("#user_lastName").addClass("invalid");
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s]*$/).test($("#user_lastName").val()))){
		$("#user_lastNameLabel").attr("data-error","Invalid characters detected");
		$("#user_lastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#user_lastName").hasClass("invalid"))) $("#user_lastName").addClass("invalid");
	}

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
