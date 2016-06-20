<div class="row">
	<!-- SIDENAV CONTAINER-->
	<div class="col s3">
		<div class="side-nav fixed light-blue lighten-1">
			<div id="logo-container" class="center-align">
				<p>
					<h3>ITCBS</h3>
					<h6>Welcome, <?php echo $_SESSION["givenName"]." ".$_SESSION["lastName"];?>!</h6>
				</p>
			</div>
			<ul>
				<li id="homeButton" class="light-blue darken-4"><a class="white-text" href="<?php base_url();?>">HOME</a></li>
				<?php
				if($_SESSION["type"] === "client") $this->load->view('Client_menu');
				if($_SESSION["type"] === "technician") $this->load->view('Admin_menu');
				if($_SESSION["type"] === "admin") $this->load->view('Admin_menu');
				?>
				<li><a class="waves-effect waves-light btn light-blue darken-4 center-align white-text" onclick="logOut('<?php echo base_url();?>');">LOG OUT</a></li>
			</ul>
		</div>
	</div>
	<!-- MAIN CONTENT CONTAINER-->
	<div class="col s9">
	</div>
</div>