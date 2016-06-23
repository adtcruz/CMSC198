$('document').ready(
	function(){
		$("#viewJRButton").addClass("black");
	}
);

job_ID = 0;
new_job_description = "";
old_job_description = "";

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

function openAddToSched(jobID){
	$("#addToScheduleModal").openModal({dismissible:false});
	job_ID = jobID;
}

function addToSchedule(url){
	technician_ID = $("#technicianSelect").val();
	$.post(url+"assign_technician",{technicianID:technician_ID,jobID:job_ID},function(data){
		if(data==="Assigned"){
			$("#addToScheduleModal").closeModal();
			$("#addedToScheduleModal").openModal({dismissible:false});
		}
	});
}

function openEditModal(jobID){
	job_ID = jobID;
	$("#editJobModal").openModal({dismissible:false});
}

function confirmEditJob(){
	$("#editJobModal").closeModal();
	$("#confirmEditModal").openModal({dismissible:false});
}

function editJob(url){
	$("#confirmEditModal").closeModal();
}
