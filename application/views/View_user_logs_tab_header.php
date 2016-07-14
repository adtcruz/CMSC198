<div class="row">
  <div class="col s12">
    <ul class="tabs">
        <li class="tab"><a class="active" href="#allLogs">All</a></li>
        <li class="tab"><a href="#logInLogs" onclick="getLogInLogs('<?php echo base_url();?>');">Log-in</a></li>
        <li class="tab"><a href="#logOutLogs" onclick="getLogOutLogs('<?php echo base_url();?>');">Log-out</a></li>
        <li class="tab"><a href="#jobActionsLogs" onclick="getJobActionsLogs('<?php echo base_url();?>');">Job Actions</a></li>
        <li class="tab"><a href="#searchByUser" onclick="$('#enterUsernameModal').openModal({dismissible:false});">By User</a></li>
    </ul>
  </div>
  <div id="allLogs" class="row">
    <div class="col s1 m1 l1">&nbsp;</div>
    <div class="col s10 m10 l10">
