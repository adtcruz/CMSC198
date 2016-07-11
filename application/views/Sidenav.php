<!-- SIDENAV -->
<div class="col s3 m3 l3 side-nav fixed grey darken-4 white-text">
	<div id="logo-container" class="center-align">
		<p>
			<h6>Welcome, <span id="sidebar_givenName"><?php echo $_SESSION["givenName"]."</span> <span id=\"sidebar_lastName\">".$_SESSION["lastName"];?></span>!</h6>
		</p>
	</div>
	<ul class="center-align">
		<li id="homeButton"><a id="homeItem" class="waves-effect waves-light white-text" href="<?php echo base_url();?>">HOME</a></li>
		<?php
		if($_SESSION["type"] === "client") $this->load->view('Menu_client');
		if($_SESSION["type"] === "technician") $this->load->view('Menu_admin');
		if($_SESSION["type"] === "admin") $this->load->view('Menu_admin');
		if($_SESSION["type"] === "superadmin") $this->load->view('Menu_admin');
		?>
		<li id="myAccountButton"><a id="myAccountItem" class="waves-effect waves-light white-text" href="<?php echo base_url();?>my_account">My Account</a></li>
		<li><a class="waves-effect waves-light btn red darken-4 center-align white-text" onclick="logOut('<?php echo base_url();?>');">LOG OUT</a></li>
	</ul>
</div>
