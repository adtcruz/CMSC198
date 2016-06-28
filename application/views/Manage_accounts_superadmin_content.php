<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab"><a class="active" href="#allAccounts">All Accounts</a></li>
      <li class="tab"><a href="#clientAccounts">Client Accounts</a></li>
      <li class="tab"><a href="#adminAccounts">Admin Accounts</a></li>
      <li class="tab"><a href="#technicianAccounts">Technician Accounts</a></li>
      <li class="tab"><a href="#superadminAccounts">Superadmin Accounts</a></li>
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
