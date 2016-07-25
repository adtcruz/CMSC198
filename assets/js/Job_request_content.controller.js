job_ID = "";

materialsUsed_ID = "";

workDone_ID = "";

n_priority = 0;

function getJobRequestContents(url,jobID){
  job_ID = jobID;
  $('.tooltipped').tooltip('remove');
  $.post(
    url+"get_job_request_contents",
    {jobID:job_ID},
    function (data){
      $("#mainAppArea").html(data);

      $.post(
        url+"get_materials_used",
        {jobID:job_ID},
        function(data){
          $("#materialsUsedTable").html(data);

          $('.tooltipped').tooltip({delay: 50});
        }
      );

      $.post(
        url+"get_work_done",
        {jobID:job_ID},
        function(data){
          $("#workDoneTable").html(data);

          $('.tooltipped').tooltip({delay: 50});
        }
      );

      $('.tooltipped').tooltip({delay: 50});
      btnhref = $("#generateFormButton").attr("href");
      $("#generateFormButton").attr("href",btnhref+""+job_ID);
    }
  );
}

function markThisJobDone(url){
  $.post(
    url+"mark_as_done",
    {isDone:"yes",jobID:job_ID},
    function (data){
      console.log(data);
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

function openAddMaterialsUsedModal(url){
  $.get(
    url+"get_materials_options",
    function(data){
      $("#addMaterialsUsedModal").openModal({dismissible:false});
      $("#materialID").html(data);
      $("#materialID").material_select();
    }
  );
}

function addMaterialsUsed(url){
  if($("#materialUnits").val()==0) return;
  $.post(
    url+"add_materials_used",
    {
      jobID:job_ID,
      materialID:$("#materialID").val(),
      materialUnits:$("#materialUnits").val()
    },
    function (data){
      if(data==="Added new material"){
        $.post(
          url+"get_materials_used",
          {jobID:job_ID},
          function(data){
            $("#materialsUsedTable").html(data);

            $('.tooltipped').tooltip({delay: 50});

            $("#addMaterialsUsedModal").closeModal();

            $("#materialUnits").val("");
          }
        );
      }
    }
  );
}

function openUpdateMaterialsModal(materialsUsedID){
  materialsUsed_ID = materialsUsedID;
  $("#changeMaterialQuantityUnitModal").openModal({dismissible:false});
}

function updateMaterialsUsed(url){
  if($("#newMaterialUnits").val()==0) return;
  $.post(
    url+"update_materials_used",
    {
      jobID:job_ID,
      materialsUsedID:materialsUsed_ID,
      materialUnits:$("#newMaterialUnits").val()
    },
    function (data){
      if(data==="Updated material"){
        $.post(
          url+"get_materials_used",
          {jobID:job_ID},
          function(data){
            $("#materialsUsedTable").html(data);

            $('.tooltipped').tooltip({delay: 50});

            $("#changeMaterialQuantityUnitModal").closeModal();

            $("#newMaterialUnits").val("");
          }
        );
      }
    }
  );
}

function deleteMaterialUsed(url,materialsUsedID){

  $('.tooltipped').tooltip('remove');

  $.post(
    url+"delete_materials_used",
    {materialsUsedID:materialsUsedID},
    function(data){
      if(data==="Deleted material"){
        $.post(
          url+"get_materials_used",
          {jobID:job_ID},
          function(data){
            $("#materialsUsedTable").html("");
            $("#materialsUsedTable").html(data);
            $('.tooltipped').tooltip({delay: 50});
          }
        );
      }
    }
  );
}

function openAddWorkDoneModal(url){
  $.get(
    url+"get_work_options",
    function(data){
      $("#addWorkDoneModal").openModal({dismissible:false});
      $("#workID").html(data);
      $("#workID").material_select();
    }
  );
}

function addWorkDone(url){
  if($("#workDuration").val()==0) return;
  $.post(
    url+"add_work_done",
    {
      jobID:job_ID,
      workID:$("#workID").val(),
      workDuration:$("#workDuration").val()
    },
    function (data){
      if(data==="Added work done"){
        $.post(
          url+"get_work_done",
          {jobID:job_ID},
          function(data){
            $("#workDoneTable").html(data);

            $('.tooltipped').tooltip({delay: 50});

            $("#addWorkDoneModal").closeModal();

            $("#workDuration").val("");
          }
        );
      }
    }
  );
}

function openChangeWorkDurationModal(workDoneID){
  workDone_ID = workDoneID;
  $("#changeWorkDurationModal").openModal({dismissible:false});
}

function updateWorkDoneDuration(url){
  if($("#newWorkDuration").val()==0) return;
  $.post(
    url+"update_work_done",
    {
      jobID:job_ID,
      workDoneID:workDone_ID,
      workDuration:$("#newWorkDuration").val()
    },
    function (data){
      if(data==="Updated work done"){
        $.post(
          url+"get_work_done",
          {jobID:job_ID},
          function(data){
            $("#workDoneTable").html(data);

            $('.tooltipped').tooltip({delay: 50});

            $("#changeWorkDurationModal").closeModal();

            $("#newWorkDuration").val("");
          }
        );
      }
    }
  );
}

function deleteWorkDone(url,workDoneID){

  $('.tooltipped').tooltip('remove');

  $.post(
    url+"delete_work_done",
    {workDoneID:workDoneID},
    function(data){
      if(data==="Deleted work done"){
        $.post(
          url+"get_work_done",
          {jobID:job_ID},
          function(data){
            $("#workDoneTable").html("");
            $("#workDoneTable").html(data);
            $('.tooltipped').tooltip({delay: 50});
          }
        );
      }
    }
  );
}
