$('document').ready(
	function(){
		$("#fileJRButton").addClass("light-blue");
		$("#fileJRButton").addClass("darken-4");
		$("#fileJRItem").removeClass("black-text");
		$("#fileJRItem").addClass("white-text");
	}
);

function fileJobRequest(url,username,type){
	jobDesc = problemsEncountered.value;
	if (jobDesc==="") return;
	if(type==="client"){
		$.post(
			url+'FileJobRequest',
			{username:username,clientUsername:username,jobDescription:jobDesc},
			function(data){
				if (data==="Submitted"){
					problemsEncountered.value = "";
					Materialize.toast("Job Request posted.", 3000);
				}
			}
		);
	}
	if(type==="technician"){
	}
}