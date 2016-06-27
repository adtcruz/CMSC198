<div class="row">
  <div class="col s12 m6 l6">
    <div class="card grey lighten-2">
      <div class="card-content black-text">
        <span class="card-title center-align">User Logs</span>
        <br/><span>Latest log entries:</span>
        <ul>
          <?php echo $logList;?>
        </ul>
      </div>
      <div class="card-action center-align">
        <a class="blue-text" href="<?php echo base_url();?>view_logs">View more user logs…</a>
      </div>
    </div>
  </div>
  <div class="col s12 m6 l6">
    <div class="card grey lighten-2">
      <div class="card-content black-text">
        <span class="card-title center-align">Admin and Technician Accounts</span>
      </div>
      <div class="card-action center-align">
        <a class="blue-text" href="#">Manage Admin and Technician accounts</a>
      </div>
    </div>
  </div>
</div>
