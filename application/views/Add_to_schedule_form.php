<div>
  <div class="row">
    <br/>
    <h5 class="center-align">Add the selected job to schedule on the following date?</h5>
    <br/>
    <div class="col s4 m4 l4">&nbsp;</div>
    <div class="col s4 m4 l4">
      <div class="input-field">
        <input id="scheduleDate" name="scheduleDate" type="date" class="center-align datepicker"/>
        <label for="scheduleDate"><i class="material-icons prefix">today</i></label>
      </div>
      <div class"input-field">
        <select id="jobPrioritySelect">
          <option value="" disabled="true" selected="true">Select priority…</option>
          <option value="1">Normal</option>
          <option value="2">Urgent</option>
          <option value="3">Very Urgent</option>
        </select>
      </div>
    </div>
    <div class="col s4 m4 l4">&nbsp;</div>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="addToSchedule('<?php echo base_url();?>');">Done</a>
    &nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">Cancel</a>
  </div>
</div>
