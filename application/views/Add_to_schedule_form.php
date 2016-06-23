<div>
  <div class="row">
    <br/>
    <h5 class="center-align">Add the selected job to schedule on the following date?</h5>
    <br/>
    <div class="col s4 m4 l4">&nbsp;</div>
    <input id="scheduleDate" type="date" class="center-align datepicker col s4 m4 l4"/>
    <div class="col s4 m4 l4">&nbsp;</div>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="addToSchedule('<?php echo base_url();?>');">Done</a>
    &nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">Cancel</a>
  </div>
</div>
