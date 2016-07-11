<li id="viewJRButton"><a id="viewJRItem" class="waves-effect waves-light white-text" href="<?php base_url();?>job_requests">Job Requests</a></li>
<li id="viewSchedButton"><a id="viewSchedItem" class="waves-effect waves-light white-text" href="<?php base_url();?>view_schedule">View Schedule</a></li>
<li id="genBillButton"><a id="gnrtBlItem" class="waves-effect waves-light white-text" href="<?php base_url();?>generate_bill">Generate Bill</a></li>
<!-- <li id="mngeApButton"><a id="mngeApItem" class="waves-effect waves-light white-text" href="<?php base_url();?>manage_application">Manage Application</a></li> -->

 <!-- Dropdown Trigger -->
 <div id="mngeApButton">
  <a id="mngeApItem" class='dropdown-button waves-effect waves-light white-text' href='#' data-activates='dropdown1'>Manage Application</a>
</div>
  <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
  	<!--<li id="mngeApButton"><a id="mngeApItem" class="waves-effect waves-light white-text" href="<?php base_url();?>manage_application">User Logs</a></li>
   	-->
    <li><a  href="<?php base_url();?>view_logs">User Logs</a></li>
    <li><a href="<?php base_url();?>manage_accounts">Manage Accounts</a></li>
    <li><a href="<?php base_url();?>manage_selectable_work">Manage Work</a></li>
    <li><a href="<?php base_url();?>manage_selectable_materials">Manage Materials</a></li>
  </ul>
