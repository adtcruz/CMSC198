<div id="assignTechnicians" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Assign</h5>
    <br/>
    <div class="row">
      <h5 class="col s3 m3 l3">&nbsp;</h5>
      <form class="col s6 m6 l6">
        <select id="technicianSelect">
        </select>
      </form>
      <h5 class="col s3 m3 l3">&nbsp;</h5>
    </div>
    <br/>
    <h5 class="center-align">to the selected job?</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="assignTechnician('<?php echo base_url();?>');">Done</a>
    &nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="closeAssignModal();">Cancel</a>
  </div>
</div>
<div id="technicianAssignedModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Technician assigned.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
  </div>
</div>
