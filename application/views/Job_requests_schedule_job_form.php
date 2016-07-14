<!-- Schedule Job Form -->
<div>
  <div class="row">
    <br/>
    <h5 class="center-align">Schedule the selected job on the following date?</h5>
    <br/>
    <div class="col s4 m4 l4">&nbsp;</div>
    <div class="col s4 m4 l4">
      <!-- Date Picker-->
      <div class="input-field">
        <input id="scheduleDate" name="scheduleDate" type="date" class="center-align datepicker"/>
        <label for="scheduleDate"><i class="material-icons prefix">today</i></label>
      </div>
      <div class"input-field">
        <!-- Priority levels -->
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
    <!-- Done button -->
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="scheduleJob('<?php echo base_url();?>');">Done</a>
    &nbsp;&nbsp;&nbsp;
    <!-- Cancel button -->
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">Cancel</a>
  </div>
</div>
