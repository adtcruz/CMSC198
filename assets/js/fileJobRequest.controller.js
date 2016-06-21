$('document').ready(
	function(){
		$("#fileJRButton").addClass("light-blue");
		$("#fileJRButton").addClass("darken-4");
		$("#fileJRItem").removeClass("black-text");
		$("#fileJRItem").addClass("white-text");
		$('select').material_select();
	}
);

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

function fileJobRequest(url){
	jobDesc = problemsEncountered.value;
	if (jobDesc==="") return;
	$.get(url+"get_user_type", function(data){
		if(data==="client"){
			$.post(url+"submit_request",{jobDescription:jobDesc},function(data){
				if(data==="Submitted"){
					problemsEncountered.value = "";
					Materialize.toast("Job Request filed", 3000);
				}
			});
		}
		else if(data === "technician"){
			clientUname = $("#clients-selector").val();
			if(clientUname === "") return;
			$.post(url+"submit_request",{jobDescription:jobDesc,clientUsername:clientUname},function(data){
				if(data==="Submitted"){
					problemsEncountered.value = "";
					$("#office-selector").val("");
					$("#clients-selector").val("");
					$('select').material_select();
					Materialize.toast("Job Request filed", 3000);
				}
			});
		}
		else if(data === "admin"){
		}
		else if(data === "superadmin"){
		}
	});
}