$('document').ready(
	function(){
		$("#fileJRButton").addClass("black");
		$('select').material_select();
	}
);

//php passes the base url via onchange value/function call in the document
//javascript function handling the login
function getUsers(url){
	officeID = $("#office-selector").val();
	if (officeID===""){
		$("#clients-selector").attr("disabled","disabled");
		return;
	}
	$.post(url+"get_office_users",{officeID:officeID},function(data){
		if(data==="No clients") data = "<option value=\"\" disabled=\"disabled\" selected=\"selected\">No clients under the selected office!</option>";
		else $("#clients-selector").removeAttr("disabled");
		$("#clients-selector").html(data);
		$("#clients-selector").material_select();
	});
}

//php passes the base url via onclick value/function call in the document
//javascript function handling the login
function fileJobRequest(url){

	//gets the jobDescription/problemsEncountered field value
	jobDesc = problemsEncountered.value;
	//do not proceed to AJAX if the jobDescription is blank or empty
	if (jobDesc==="") return;

	//jQuery GET communication
	//communicates to the API
	//first argument is the API URL
	//second argument is an anonymous function that handles the event
	//this gets the user type
	$.get(url+"get_user_type", function(data){

		//if the user is a client
		if(data==="client"){

			//jQuery post communication
			//communicates to the API
			//first argument is the API URL
			//second argument is the JSON format of the key-value pairs to be sent
			//third argument is an anonymous function that handles the event
			$.post(url+"submit_request",{jobDescription:jobDesc},function(data){

				//if the data received is "Submitted"
				//reset the jobDescription/problemsEncountered field
				//tell the user that their job request was filed
				//displays the modal containing the message that the job request was filed
				if(data==="Submitted"){
					problemsEncountered.value = "";
					$("#submittedMessage").openModal();
				}
			});
		}

		//if the user in session is either an admin, superadmin, or technician
		else if((data === "technician")||(data === "admin")||(data === "superadmin")){
			//gets the client username from the clients selector value
			clientUname = $("#clients-selector").val();
			//if it's a blank value, do not proceed to AJAX
			if(clientUname === "") return;

			//jQuery post communication
			//communicates to the API
			//first argument is the API URL
			//second argument is the JSON format of the key-value pairs to be sent
			//third argument is an anonymous function that handles the event
			$.post(url+"submit_request",{jobDescription:jobDesc,clientUsername:clientUname},function(data){

				//if the data received is "Submitted"
				//reset the input fields
				//tell the user that their job request was filed
				//utilises Materialize CSS's toast
				if(data==="Submitted"){
					problemsEncountered.value = "";
					$("#office-selector").val("");
					$("#clients-selector").val("");
					$('select').material_select();
					$("#submittedMessage").openModal();
				}
			});
		}
	});
}
