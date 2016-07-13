$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('select').material_select();
});

//removes visible error messages
function adminPasswordChange(){

	$("#adminPasswordLabel").removeAttr("data-error");

	$("#adminPasswordLabel").html("Password");

	if($("#adminPassword").hasClass("invalid")) $("#adminPassword").removeClass("invalid");

	$("#adminConfirmPassword").val("");

	if($("#adminPassword").val()===""){

		$("#adminConfirmPassword").attr("disabled","disabled");
	}

	$("#adminConfirmPassword").val("");

	if($("#adminPassword").val().length >= 6){

		$("#adminConfirmPassword").removeAttr("disabled");
	}
}

//removes visible error messages
function adminConfirmPasswordChange(){

	$("#adminPasswordLabel").removeAttr("data-error");

	$("#adminPasswordLabel").html("Password");

	$("#adminConfirmPasswordLabel").removeAttr("data-error");

	$("#adminConfirmPasswordLabel").html("Confirm Password");

	if($("#adminPassword").hasClass("invalid")) $("#adminPassword").removeClass("invalid");

	if($("#adminConfirmPassword").hasClass("invalid")) $("#adminConfirmPassword").removeClass("invalid");
}

//removes visible error messages
function adminGivenNameChange(){

	$("#adminGivenNameLabel").removeAttr("data-error");

	$("#adminGivenNameLabel").html("Given Name");

	if($("#adminGivenName").hasClass("invalid")) $("#adminGivenName").removeClass("invalid");
}

//removes visible error messages
function adminLastNameChange(){

	$("#adminLastNameLabel").removeAttr("data-error");

	$("#adminLastNameLabel").html("Last Name");

	if($("#adminLastName").hasClass("invalid")) $("#adminLastName").removeClass("invalid");
}

//removes visible error messages
function adminUsernameChange(){

	$("#adminUsernameLabel").removeAttr("data-error");

	$("#adminUsernameLabel").html("Username");

	if($("#adminUsername").hasClass("invalid")) $("#adminUsername").removeClass("invalid");
}

//checks for input errors before calling API to create a new admin account
//if there are errors, the function execution is preterminated
function addAdmin(url){

	username = $("#adminUsername").val();
	password = $("#adminPassword").val();
	givenName = $("#adminGivenName").val();
	lastName = $("#adminLastName").val();

	err = false;

	if (username===""){
		$("#adminUsernameLabel").attr("data-error","This is a required field");
		$("#adminUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#adminUsername").addClass("invalid");
		err = true;
	}
	if (password===""){
		$("#adminPasswordLabel").attr("data-error","This is a required field");
		$("#adminPasswordLabel").html(
			"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#adminPassword").addClass("invalid");
		err = true;
	}
	if (givenName===""){
		$("#adminGivenNameLabel").attr("data-error","This is a required field");
		$("#adminGivenNameLabel").html(
			"Given Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#adminGivenName").addClass("invalid");
		err = true;
	}
	if (lastName===""){
		$("#adminLastNameLabel").attr("data-error","This is a required field");
		$("#adminLastNameLabel").html(
			"Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#adminLastName").addClass("invalid");
		err = true;
	}

	if(password<6) return;

	if (password!==$("#adminConfirmPassword").val()){
	  $("#adminPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#adminConfirmPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#adminPasswordLabel").html(
	    "Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#adminConfirmPasswordLabel").html(
	    "Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#adminPassword").addClass("invalid");
	  $("#adminConfirmPassword").addClass("invalid");
	  err = true;
	}

	if(err) return;

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(givenName))){
		$("#adminGivenNameLabel").attr("data-error","Invalid characters detected");
		$("#adminGivenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#adminGivenName").hasClass("invalid"))) $("#adminGivenName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(lastName))){
		$("#adminLastNameLabel").attr("data-error","Invalid characters detected");
		$("#adminLastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#adminLastName").hasClass("invalid"))) $("#adminLastName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z0-9_]*$/).test(username))){
		$("#adminUsernameLabel").attr("data-error","Invalid characters detected");
		$("#adminUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#adminUsername").hasClass("invalid"))) $("#adminUsername").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"create_account",
		{
			accountType:"admin",
			username:username,
			password:password,
			givenName:givenName,
			lastName:lastName
		},
		function(data){
			if(data==="Created new admin"){
				$("#accountCreatedModal").openModal({dismissible:false});
				//reset forms
				$("#adminUsername").val("");
				$("#adminPassword").val("");
				$("#adminConfirmPassword").val("");
				$("#adminGivenName").val("");
				$("#adminLastName").val("");
			}
			if(data==="Account already exists"){
				$("#adminUsernameLabel").attr("data-error","Username already taken");
				$("#adminUsernameLabel").html(
					"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
				$("#adminUsername").addClass("invalid");
			}
		}
	);

}

//removes visible error messages
function clientPasswordChange(){

	$("#clientPasswordLabel").removeAttr("data-error");

	$("#clientPasswordLabel").html("Password");

	if($("#clientPassword").hasClass("invalid")) $("#clientPassword").removeClass("invalid");

	$("#clientConfirmPassword").val("");

	if($("#clientPassword").val()===""){

		$("#clientConfirmPassword").attr("disabled","disabled");
	}

	$("#clientConfirmPassword").val("");

	if($("#clientPassword").val().length >= 6){

		$("#clientConfirmPassword").removeAttr("disabled");
	}
}

//removes visible error messages
function clientConfirmPasswordChange(){

	$("#clientPasswordLabel").removeAttr("data-error");

	$("#clientPasswordLabel").html("Password");

	$("#clientConfirmPasswordLabel").removeAttr("data-error");

	$("#clientConfirmPasswordLabel").html("Confirm Password");

	if($("#clientPassword").hasClass("invalid")) $("#clientPassword").removeClass("invalid");

	if($("#clientConfirmPassword").hasClass("invalid")) $("#clientConfirmPassword").removeClass("invalid");
}

//removes visible error messages
function clientGivenNameChange(){

	$("#clientGivenNameLabel").removeAttr("data-error");

	$("#clientGivenNameLabel").html("Given Name");

	if($("#clientGivenName").hasClass("invalid")) $("#clientGivenName").removeClass("invalid");
}

//removes visible error messages
function clientLastNameChange(){

	$("#clientLastNameLabel").removeAttr("data-error");

	$("#clientLastNameLabel").html("Last Name");

	if($("#clientLastName").hasClass("invalid")) $("#clientLastName").removeClass("invalid");
}

//removes visible error messages
function clientUsernameChange(){

	$("#clientUsernameLabel").removeAttr("data-error");

	$("#clientUsernameLabel").html("Username");

	if($("#clientUsername").hasClass("invalid")) $("#clientUsername").removeClass("invalid");
}

//removes visible error messages
function designationChange(){

	$("#designationLabel").removeAttr("data-error");

	$("#designationLabel").html("Designation");

	if($("#designation").hasClass("invalid")) $("#designation").removeClass("invalid");
}

//checks for input errors before calling API to create a new client account
//if there are errors, the function execution is preterminated
function addClient(url){

	username = $("#clientUsername").val();
	password = $("#clientPassword").val();
	givenName = $("#clientGivenName").val();
	lastName = $("#clientLastName").val();
	designation = $("#designation").val();
	officeId = $("#officeId").val();

	err = false;

	if (username===""){
		$("#clientUsernameLabel").attr("data-error","This is a required field");
		$("#clientUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientUsername").addClass("invalid");
		err = true;
	}
	if (password===""){
		$("#clientPasswordLabel").attr("data-error","This is a required field");
		$("#clientPasswordLabel").html(
			"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientPassword").addClass("invalid");
		err = true;
	}
	if (givenName===""){
		$("#clientGivenNameLabel").attr("data-error","This is a required field");
		$("#clientGivenNameLabel").html(
			"Given Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientGivenName").addClass("invalid");
		err = true;
	}
	if (lastName===""){
		$("#clientLastNameLabel").attr("data-error","This is a required field");
		$("#clientLastNameLabel").html(
			"Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientLastName").addClass("invalid");
		err = true;
	}
	if (designation===""){
		$("#designationLabel").attr("data-error","This is a required field");
		$("#designationLabel").html(
			"Designation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#designation").addClass("invalid");
		err = true;
	}
	if (officeId==null) err = true;

	if(password<6) return;

	if (password!==$("#clientConfirmPassword").val()){
		$("#clientPasswordLabel").attr("data-error","Passwords do not match!");
		$("#clientConfirmPasswordLabel").attr("data-error","Passwords do not match!");
		$("#clientPasswordLabel").html(
			"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientConfirmPasswordLabel").html(
			"Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#clientPassword").addClass("invalid");
		$("#clientConfirmPassword").addClass("invalid");
		err = true;
	}

	if(err) return;

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(givenName))){
		$("#clientGivenNameLabel").attr("data-error","Invalid characters detected");
		$("#clientGivenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#clientGivenName").hasClass("invalid"))) $("#clientGivenName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(lastName))){
		$("#clientLastNameLabel").attr("data-error","Invalid characters detected");
		$("#clientLastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#clientLastName").hasClass("invalid"))) $("#clientLastName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z0-9_]*$/).test(username))){
		$("#clientUsernameLabel").attr("data-error","Invalid characters detected");
		$("#clientUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#clientUsername").hasClass("invalid"))) $("#clientUsername").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z0-9_\s\-]*$/).test(designation))){
		$("#designationLabel").attr("data-error","Invalid characters detected");
		$("#designationLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#designation").hasClass("invalid"))) $("#designation").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"create_account",
		{
			accountType:"client",
			username:username,
			password:password,
			givenName:givenName,
			lastName:lastName,
			designation:designation,
			officeId:officeId
		},
		function(data){
			if(data==="Created new client"){
				$("#accountCreatedModal").openModal({dismissible:false});
				//reset forms
				$("#clientUsername").val("");
				$("#clientPassword").val("");
				$("#clientConfirmPassword").val("");
				$("#clientGivenName").val("");
				$("#clientLastName").val("");
				$("#designation").val("");
				$("#officeId").val("");
				$('select').material_select(); //reload materialize select after changing its value
			}
			if(data==="Account already exists"){
				$("#clientUsernameLabel").attr("data-error","Username already taken");
				$("#clientUsernameLabel").html(
					"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
				$("#clientUsername").addClass("invalid");
			}
		}
	);
}

//removes visible error messages
function superadminPasswordChange(){

	$("#superadminPasswordLabel").removeAttr("data-error");

	$("#superadminPasswordLabel").html("Password");

	if($("#superadminPassword").hasClass("invalid")) $("#superadminPassword").removeClass("invalid");

	$("#superadminConfirmPassword").val("");

	if($("#superadminPassword").val()===""){

		$("#superadminConfirmPassword").attr("disabled","disabled");
	}

	$("#superadminConfirmPassword").val("");

	if($("#superadminPassword").val().length >= 6){

		$("#superadminConfirmPassword").removeAttr("disabled");
	}
}

//removes visible error messages
function superadminConfirmPasswordChange(){

	$("#superadminPasswordLabel").removeAttr("data-error");

	$("#superadminPasswordLabel").html("Password");

	$("#superadminConfirmPasswordLabel").removeAttr("data-error");

	$("#superadminConfirmPasswordLabel").html("Confirm Password");

	if($("#superadminPassword").hasClass("invalid")) $("#superadminPassword").removeClass("invalid");

	if($("#superadminConfirmPassword").hasClass("invalid")) $("#superadminConfirmPassword").removeClass("invalid");
}

//removes visible error messages
function superadminGivenNameChange(){

	$("#superadminGivenNameLabel").removeAttr("data-error");

	$("#superadminGivenNameLabel").html("Given Name");

	if($("#superadminGivenName").hasClass("invalid")) $("#superadminGivenName").removeClass("invalid");
}

//removes visible error messages
function superadminLastNameChange(){

	$("#superadminLastNameLabel").removeAttr("data-error");

	$("#superadminLastNameLabel").html("Last Name");

	if($("#superadminLastName").hasClass("invalid")) $("#superadminLastName").removeClass("invalid");
}

//removes visible error messages
function superadminUsernameChange(){

	$("#superadminUsernameLabel").removeAttr("data-error");

	$("#superadminUsernameLabel").html("Username");

	if($("#superadminUsername").hasClass("invalid")) $("#superadminUsername").removeClass("invalid");
}

//checks for input errors before calling API to create a new superadmin account
//if there are errors, the function execution is preterminated
function addSuper(url){

	username = $("#superadminUsername").val();
	password = $("#superadminPassword").val();
	givenName = $("#superadminGivenName").val();
	lastName = $("#superadminLastName").val();

	err = false;

	if (username===""){
		$("#superadminUsernameLabel").attr("data-error","This is a required field");
		$("#superadminUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#superadminUsername").addClass("invalid");
		err = true;
	}
	if (password===""){
		$("#superadminPasswordLabel").attr("data-error","This is a required field");
		$("#superadminPasswordLabel").html(
			"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#superadminPassword").addClass("invalid");
		err = true;
	}
	if (givenName===""){
		$("#superadminGivenNameLabel").attr("data-error","This is a required field");
		$("#superadminGivenNameLabel").html(
			"Given Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#superadminGivenName").addClass("invalid");
		err = true;
	}
	if (lastName===""){
		$("#superadminLastNameLabel").attr("data-error","This is a required field");
		$("#superadminLastNameLabel").html(
			"Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#superadminLastName").addClass("invalid");
		err = true;
	}

	if(password<6) return;

	if (password!==$("#superadminConfirmPassword").val()){
	  $("#superadminPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#superadminConfirmPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#superadminPasswordLabel").html(
	    "Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#superadminConfirmPasswordLabel").html(
	    "Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#superadminPassword").addClass("invalid");
	  $("#superadminConfirmPassword").addClass("invalid");
	  err = true;
	}

	if(err) return;

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(givenName))){
		$("#superadminGivenNameLabel").attr("data-error","Invalid characters detected");
		$("#superadminGivenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#superadminGivenName").hasClass("invalid"))) $("#superadminGivenName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(lastName))){
		$("#superadminLastNameLabel").attr("data-error","Invalid characters detected");
		$("#superadminLastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#superadminLastName").hasClass("invalid"))) $("#superadminLastName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z0-9_]*$/).test(username))){
		$("#clientUsernameLabel").attr("data-error","Invalid characters detected");
		$("#clientUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#superadminUsername").hasClass("invalid"))) $("#superadminUsername").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"create_account",
		{
			accountType:"superadmin",
			username:username,
			password:password,
			givenName:givenName,
			lastName:lastName
		},
		function(data){
			if(data==="Created new superadmin"){
				$("#accountCreatedModal").openModal({dismissible:false});
				//reset forms
				$("#superadminUsername").val("");
				$("#superadminPassword").val("");
				$("#superadminConfirmPassword").val("");
				$("#superadminGivenName").val("");
				$("#superadminLastName").val("");
			}
			if(data==="Account already exists"){
				$("#superadminUsernameLabel").attr("data-error","Username already taken");
				$("#superadminUsernameLabel").html(
					"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
				$("#superadminUsername").addClass("invalid");
			}
		}
	);

}

//removes visible error messages
function technPasswordChange(){

	$("#technPasswordLabel").removeAttr("data-error");

	$("#technPasswordLabel").html("Password");

	if($("#technPassword").hasClass("invalid")) $("#technPassword").removeClass("invalid");

	$("#technConfirmPassword").val("");

	if($("#technPassword").val()===""){

		$("#technConfirmPassword").attr("disabled","disabled");
	}

	$("#technConfirmPassword").val("");

	if($("#technPassword").val().length >= 6){

		$("#technConfirmPassword").removeAttr("disabled");
	}
}

//removes visible error messages
function technConfirmPasswordChange(){

	$("#technPasswordLabel").removeAttr("data-error");

	$("#technPasswordLabel").html("Password");

	$("#technConfirmPasswordLabel").removeAttr("data-error");

	$("#technConfirmPasswordLabel").html("Confirm Password");

	if($("#technPassword").hasClass("invalid")) $("#technPassword").removeClass("invalid");

	if($("#technConfirmPassword").hasClass("invalid")) $("#technConfirmPassword").removeClass("invalid");
}

//removes visible error messages
function technGivenNameChange(){

	$("#technGivenNameLabel").removeAttr("data-error");

	$("#technGivenNameLabel").html("Given Name");

	if($("#technGivenName").hasClass("invalid")) $("#technGivenName").removeClass("invalid");
}

//removes visible error messages
function technLastNameChange(){

	$("#technLastNameLabel").removeAttr("data-error");

	$("#technLastNameLabel").html("Last Name");

	if($("#technLastName").hasClass("invalid")) $("#technLastName").removeClass("invalid");
}

//removes visible error messages
function technUsernameChange(){

	$("#technUsernameLabel").removeAttr("data-error");

	$("#technUsernameLabel").html("Username");

	if($("#technUsername").hasClass("invalid")) $("#technUsername").removeClass("invalid");
}

//checks for input errors before calling API to create a new technician account
//if there are errors, the function execution is preterminated
function addTechnician(url){

	username = $("#technUsername").val();
	password = $("#technPassword").val();
	givenName = $("#technGivenName").val();
	lastName = $("#technLastName").val();
	designation = $("#designation").val();
	officeId = $("#officeId").val();

	err = false;

	if (username===""){
		$("#technUsernameLabel").attr("data-error","This is a required field");
		$("#technUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#technUsername").addClass("invalid");
		err = true;
	}
	if (password===""){
		$("#technPasswordLabel").attr("data-error","This is a required field");
		$("#technPasswordLabel").html(
			"Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#technPassword").addClass("invalid");
		err = true;
	}
	if (givenName===""){
		$("#technGivenNameLabel").attr("data-error","This is a required field");
		$("#technGivenNameLabel").html(
			"Given Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#technGivenName").addClass("invalid");
		err = true;
	}
	if (lastName===""){
		$("#technLastNameLabel").attr("data-error","This is a required field");
		$("#technLastNameLabel").html(
			"Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#technLastName").addClass("invalid");
		err = true;
	}

	if(password<6) return;

	if (password!==$("#technConfirmPassword").val()){
	  $("#technPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#technConfirmPasswordLabel").attr("data-error","Passwords do not match!");
	  $("#technPasswordLabel").html(
	    "Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#technConfirmPasswordLabel").html(
	    "Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
	    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	  );
	  $("#technPassword").addClass("invalid");
	  $("#technConfirmPassword").addClass("invalid");
	  err = true;
	}

	if(err) return;

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(givenName))){
		$("#technGivenNameLabel").attr("data-error","Invalid characters detected");
		$("#technGivenNameLabel").html(
			"Given Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#technGivenName").hasClass("invalid"))) $("#technGivenName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z\s\u00F1]*$/).test(lastName))){
		$("#technLastNameLabel").attr("data-error","Invalid characters detected");
		$("#technLastNameLabel").html(
			"Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#technLastName").hasClass("invalid"))) $("#technLastName").addClass("invalid");
		err = true;
	}

	if(!(new RegExp(/^[A-Z-a-z][A-Z-a-z0-9_]*$/).test(username))){
		$("#technUsernameLabel").attr("data-error","Invalid characters detected");
		$("#technUsernameLabel").html(
			"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		if(!($("#technUsername").hasClass("invalid"))) $("#technUsername").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"create_account",
		{
			accountType:"technician",
			username:username,
			password:password,
			givenName:givenName,
			lastName:lastName
		},
		function(data){
			if(data==="Created new technician"){
				$("#accountCreatedModal").openModal({dismissible:false});
				//reset forms
				$("#technUsername").val("");
				$("#technPassword").val("");
				$("#technConfirmPassword").val("");
				$("#technGivenName").val("");
				$("#technLastName").val("");
			}
			if(data==="Account already exists"){
				$("#technUsernameLabel").attr("data-error","Username already taken");
				$("#technUsernameLabel").html(
					"Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
					"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
				);
				$("#technUsername").addClass("invalid");
			}
		}
	);
}
