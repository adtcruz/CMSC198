$('document').ready(
	function(){
		//adds black background colour to the view job requests / my job requests button
		//this adds a "selected" effect
		$("#viewJRButton").addClass("black");
	}
);

//job ID of the selected job
job_ID = 0;
//new job description set to blank
new_job_description = "";
//old job description set to blank
old_job_description = "";

//triggered when the cancel job button is clicked
//opens the modal asking if the user wants to cancel the job or not
//modal can't be closed by clicking outside it
//it has to click the no button in order to close it
function confirmCancel(jobID){
	$("#cancelModal").openModal({dismissible:false});
	job_ID = jobID; //sets the job_ID from the jobID of the selected job
}

//triggered when the "Yes" button in the modal confirming user action is clicked
//function that handles cancelling the jobID
//closes the cancel job modal then communicates to the server via jQuery POST
//the job ID of the selected job is sent as post argument
//opens the modal containing "Job canceled" message
//in the case it gets a "Job canceled" message from the server
//the message modal can only be closed by clicking OK
function cancelJob(url){
	$("#cancelModal").closeModal();
	$.post(url+"cancel_job",{jobID:job_ID},function(data){
		if(data==="Job canceled"){
			$("#jobCanceledModal").openModal({dismissible:false});
		}
	});
}

//reloads the page
function reloadPage(url){
	window.location.href = url+"view_jobs";
}

//triggered when the "add to schedule" button is clicked
//rewrites the main app area containing the Job Requests main label and table
//with a form asking the user for the date of the schedule
function openAddToSched(url,jobID){
	$('.tooltipped').tooltip('remove');
	$.get(url+"get_add_to_schedule_form",function(data){
		$("#mainAppArea").html(data);
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 1,
			format: 'yyyy-mm-dd'
		});
		$("#jobPrioritySelect").material_select();
	});
	job_ID = jobID; //sets the job_ID from the jobID of the selected job
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
