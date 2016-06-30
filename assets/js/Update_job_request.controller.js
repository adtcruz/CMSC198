job_ID = "";

function updateJob(url,jobID){
  job_ID = jobID;
  $('.tooltipped').tooltip('remove');
  $.post(
    url+"update_job_request",
    {jobID:job_ID},
    function (data){
      $("#mainAppArea").html(data);
    }
  );
}

function updateThisJob(url){
  if($("#jobDoneCheckbox").val()==="on"){
    $.post(
      url+"update_job_request",
      {isDone:"yes",jobID:job_ID},
      function (data){
        if(data==="Marked as done") Materialize.toast("Marked as done", 3000);
      }
    );
  }
}
