$('document').ready(
	function(){
		$("#viewJRButton").addClass("light-blue");
		$("#viewJRButton").addClass("darken-4");
		$("#viewJRItem").removeClass("black-text");
		$("#viewJRItem").addClass("white-text");
	}
);

job_ID = 0;

function confirmCancel(jobID){
	$("#cancelModal").openModal();
	job_ID = jobID;
}

function cancelJob(url){
	console.log(job_ID);
	$("#cancelModal").closeModal();
}



