<div class="row">
  <div class="col s12 m6 l6">
    <div class="card grey lighten-2">
      <div class="card-content black-text">
        <span class="card-title"><i class="material-icons">speaker_notes</i> User Logs</span>
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
        <span class="card-title center-align"><i class="material-icons">person_pin</i> Admin and Technician Accounts</span>
        <br/><br/><span>Currently:</span>
        <ul>
          <li>
            <?php
            if ($nAdmin==0){
              echo "No Admin Accounts";
            }
            if ($nAdmin==1){
              echo "1 Admin Account";
            }
            else{
              echo $nAdmin . " Admin Accounts";
            }
            ?>
          </li>
          <li>
            <?php
            if ($nTechn==0){
              echo "No Technician Accounts";
            }
            if ($nTechn==1){
              echo "1 Technician Account";
            }
            else{
              echo $nTechn . " Technician Accounts";
            }
            ?>
          </li>
        </ul>
        <br/><br/>
      </div>
      <div class="card-action center-align">
        <a class="blue-text" href="#">Manage Admin and Technician accounts</a>
      </div>
    </div>
  </div>
</div>
