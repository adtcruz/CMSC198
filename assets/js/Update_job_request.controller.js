job_ID = "";

function getUpdateJobContents(url,jobID){
  job_ID = jobID;
  $('.tooltipped').tooltip('remove');
  $.post(
    url+"get_update_job_request_contents",
    {jobID:job_ID},
    function (data){
      $("#mainAppArea").html(data);
    }
  );
}

function markThisJobDone(url){
  $.post(
    url+"update_job_request",
    {isDone:"yes",jobID:job_ID},
    function (data){
      if(data==="Marked as done"){
        $("#confirmMarkingAsDoneModal").closeModal();
        $("#jobMarkedAsDoneModal").openModal({dismissible:false});
      }
    }
  );
}
