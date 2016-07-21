<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper grey darken-4">
      <a href="<?php echo base_url();?>" class="brand-logo center">ITC Networking Services and Billing System</a>
      <ul class="left">
        <li><a id="menuToggleButton" data-activates="slide-out" class="btn-floating btn-large btn-flat"><i class="large material-icons">view_list</i></a></li>
      </ul>
      <ul class="right">
        <li><a class="waves-effect waves-light btn dropdown-button grey darken-3 center-align white-text" data-activates="user-dropdown"><?php echo $_SESSION["givenName"]." ".$_SESSION["lastName"];?></a></li>
      </ul>
      <ul id="user-dropdown" class="dropdown-content">
        <li><a href="<?php echo base_url();?>my_account">My Account</a></li>
        <li class="divider"></li>
        <li><a onclick="logOut('<?php echo base_url();?>');">Log Out</a></li>
      </ul>
    </div>
  </nav>
</div>
