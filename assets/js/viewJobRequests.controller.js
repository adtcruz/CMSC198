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
	$("#cancelModal").openModal({dismissible:false});
	job_ID = jobID;
}

function cancelJob(url){
	$("#cancelModal").closeModal();
	$.post(url+"cancel_job",{jobID:job_ID},function(data){
		if(data==="Job canceled"){
			$("#jobCanceledModal").openModal({dismissible:false});
		}
	});
}

function reloadPage(url){
	window.location.href = url+"view_jobs";
}

function openAssignModal(url,jobID){
	$("#assignTechnicians").openModal({dismissible:false});
	job_ID = jobID;
	$.get(url+"get_technicians/",function(data){
		$("#technicianSelect").html(data);
		$("#technicianSelect").material_select();
	});
}

function closeAssignModal(){
	$("#technicianSelect").html("");
	$("#assignTechnicians").closeModal();
}

function assignTechnician(url){
	technician_ID = $("#technicianSelect").val();
	console.log("Passing jobID: "+job_ID);
	$.post(url+"assign_technician",{technicianID:technician_ID,jobID:job_ID},function(data){
		if(data==="Assigned"){
			$("#assignTechnicians").closeModal();
			$("#technicianAssignedModal").openModal({dismissible:false});
		}
	});
}
