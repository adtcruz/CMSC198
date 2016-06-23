<div id="addToScheduleModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Add the selected job to schedule??</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="addToSchedule('<?php echo base_url();?>');">Done</a>
    &nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#addToScheduleModal').closeModal();">Cancel</a>
  </div>
</div>
<div id="addedToScheduleModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Added job to schedule.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
  </div>
</div>
