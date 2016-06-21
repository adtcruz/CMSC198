$('document').ready(
	function(){
		$("#fileJRButton").addClass("light-blue");
		$("#fileJRButton").addClass("darken-4");
		$("#fileJRItem").removeClass("black-text");
		$("#fileJRItem").addClass("white-text");
	}
);

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
		}
		else if(data === "admin"){
		}
		else if(data === "superadmin"){
		}
	});
}