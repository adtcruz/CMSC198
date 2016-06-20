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
				<li class="light-blue darken-4"><a class="white-text" href="<?php base_url();?>">HOME</a></li>
				<?php
				if($_SESSION["type"]==="client") $this->load->view('Client_menu');
				?>
				<li class="light-blue darken-3"><a class="center-align white-text" onclick="logOut('<?php base_url();?>');">LOG OUT</a></li>
			</ul>
		</div>
	</div>
	<!-- MAIN CONTENT CONTAINER-->
	<div class="col s9">
	</div>
</div>