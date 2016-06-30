<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab"><a class="active" href="#allAccounts">All Accounts</a></li>
      <li class="tab"><a href="#clientAccounts">Clients</a></li>
      <li class="tab"><a href="#adminAccounts">Admins</a></li>
      <li class="tab"><a href="#technicianAccounts">Technicians</a></li>
      <li class="tab"><a href="#superadminAccounts">Superadmins</a></li>
      <li class="tab"><a href="#" onclick="window.location.href = '<?php echo base_url();?>new_account'"><i class="tiny material-icons">add</i> Create account</a></li>
    </ul>
  </div>
  <div id="allUsers" class="row">
    <div class="col s1 m1 l1">&nbsp;</div>
    <div class="col s10 m10 l10">
      <br/>
      <?php
        echo $allUsers;
      ?>
    </div>
    <div class="col s1 m1 l1">&nbsp;</div>
  </div>
  <div id="clientAccounts" class="row"></div>
  <div id="adminAccounts" class="row"></div>
  <div id="technicianAccounts" class="row"></div>
  <div id="superadminAccounts" class="row"></div>
</div>
