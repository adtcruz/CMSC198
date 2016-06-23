<!-- SIDENAV -->
<div class="col s3 m3 l3 side-nav fixed grey darken-4 white-text">
	<div id="logo-container" class="center-align">
		<p>
			<h3>ITC Billing System</h3>
			<h6>Welcome, <?php echo $_SESSION["givenName"]." ".$_SESSION["lastName"];?>!</h6>
		</p>
	</div>
	<ul class="center-align">
		<li id="homeButton"><a id="homeItem" class="waves-effect waves-light white-text" href="<?php echo base_url();?>">HOME</a></li>
		<?php
		if($_SESSION["type"] === "client") $this->load->view('Client_menu');
		if($_SESSION["type"] === "technician") $this->load->view('Admin_menu');
		if($_SESSION["type"] === "admin") $this->load->view('Admin_menu');
		?>
		<li><a class="waves-effect waves-light btn red darken-4 center-align white-text" onclick="logOut('<?php echo base_url();?>');">LOG OUT</a></li>
	</ul>
</div>
