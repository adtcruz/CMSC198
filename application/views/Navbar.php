<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper grey darken-4">
      <a href="<?php echo base_url();?>" class="brand-logo center hide-on-small-only">ITC Networking Services and Billing System</a>
      <h6 href="<?php echo base_url();?>" class="brand-logo center hide-on-med-and-up">ITC Net. Svc. &amp; Billing</h6>
      <ul class="left">
        <li><a id="menuToggleButton" data-activates="slide-out" class="btn-floating btn-large btn-flat"><i class="large material-icons">view_list</i></a></li>
      </ul>
      <ul class="right">
        <li class="hide-on-small-only"><a class="waves-effect waves-light btn dropdown-button grey darken-3 center-align white-text" data-activates="user-dropdown"><?php echo $_SESSION["givenName"]." ".$_SESSION["lastName"];?> ▼</a></li>
        <li class="hide-on-med-and-up"><a class="btn-floating btn dropdown-button grey darken-4 center-align white-text" data-activates="mob-dropdown">▼</a></li>
      </ul>
      <ul id="user-dropdown" class="dropdown-content">
        <?php
        if($_SESSION["type"]==="client") echo '<li><a href="'.base_url().'job_requests">My Job Requests</a></li>';
        ?>
        <li><a href="<?php echo base_url();?>my_account">My Account</a></li>
        <li class="divider"></li>
        <li><a onclick="logOut('<?php echo base_url();?>');">Log Out</a></li>
      </ul>
      <ul id="mob-dropdown" class="dropdown-content">
        <?php
        if($_SESSION["type"]==="client") echo '<li><a href="'.base_url().'job_requests">My Job Requests</a></li>';
        ?>
        <li><a href="<?php echo base_url();?>my_account">My Account</a></li>
        <li class="divider"></li>
        <li><a onclick="logOut('<?php echo base_url();?>');">Log Out</a></li>
      </ul>
    </div>
  </nav>
</div>
