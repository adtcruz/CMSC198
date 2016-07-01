job_ID = "";

n_priority = 0;

function getJobRequestContents(url,jobID){
  job_ID = jobID;
  $('.tooltipped').tooltip('remove');
  $.post(
    url+"get_job_request_contents",
    {jobID:job_ID},
    function (data){
      $("#mainAppArea").html(data);

      $('.tooltipped').tooltip({delay: 50});
    }
  );
}

function markThisJobDone(url){
  $.post(
    url+"mark_as_done",
    {isDone:"yes",jobID:job_ID},
    function (data){
      if(data==="Marked as done"){
        $("#confirmMarkingAsDoneModal").closeModal();
        $("#jobMarkedAsDoneModal").openModal({dismissible:false});
      }
    }
  );
}

function openChangePriorityModal(){
  $("#changePriorityModal").openModal({dismissible:false});
  $("#newPriority").material_select();
}

function confirmUpdatePriority(){
  n_priority = $("#newPriority").val();
  $("#changePriorityModal").closeModal();
  $("#confirmUpdatePriorityModal").openModal({dismissible:false});
}

function updatePriority(url){
  $.post(
    url+"update_priority",
    {jobID:job_ID,priority:n_priority},
    function (data){
      if(data==="Priority updated"){
        $("#confirmUpdatePriorityModal").closeModal();
        $("#priorityUpdatedModal").openModal({dismissible:false});
      }
    }
  );

}
