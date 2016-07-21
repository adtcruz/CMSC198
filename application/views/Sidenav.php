<!-- SIDENAV -->
<div id="slide-out" class="side-nav grey darken-4 white-text">
	<div id="logo-container" class="center-align">
		<p>
			<h6>Welcome, <span id="sidebar_givenName"><?php echo $_SESSION["givenName"]."</span> <span id=\"sidebar_lastName\">".$_SESSION["lastName"];?></span>!</h6>
		</p>
	</div>
	<ul class="center-align">
		<li id="homeButton"><a id="homeItem" class="waves-effect waves-light white-text" href="<?php echo base_url();?>">HOME</a></li>
    <li id="annButton"><a id="homeItem" class="waves-effect waves-light white-text" href="<?php echo base_url().'announcements';?>">Announcements</a></li>
		<?php
		  if (array_key_exists("type", $_SESSION))
		  {
				if ($unread == 0) echo '<li id="notifButton"><a id="homeItem" class="waves-effect waves-light white-text" href="'.base_url().'notifications">Notifications</a></li>';
				else echo '<li id="notifButton"><a id="homeItem" class="waves-effect waves-light white-text" href="'.base_url().'notifications">Notifications <span class="badge white-text">'.$unread.'</span></a></li>';
		  }
		  if (array_key_exists ('type', $_SESSION))
		  {
	      if($_SESSION["type"] === "client")
	      {
	        $this->load->view('Menu_client');
	      }
	      else
	      {
          $this->load->view('Menu_admin');
	      }
		  }
		  else
		  {
	      redirect (base_url(), 'refresh');
		  }
		?>
	</ul>
</div>
