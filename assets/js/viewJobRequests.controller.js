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

function openAddToSched(url,jobID){
	$('.tooltipped').tooltip('remove');
	$.get(url+"get_add_to_schedule_form",function(data){
		$("#mainAppArea").html(data);
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 30, // Creates a dropdown of 30 years to control year
			format: 'yyyy-mm-dd'
		});
	});
	job_ID = jobID;
}

function addToSchedule(url){
	schedule_date = $("#scheduleDate").val();
	$.post(url+"add_to_schedule",{jobID:job_ID,scheduleDate:schedule_date},function(data){
		if(data==="Added"){
			$("#addToScheduleModal").closeModal();
			$("#addedToScheduleModal").openModal({dismissible:false});
		}
		if(data==="Invalid date"){

		}
		if(data==="Can not add"){

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
