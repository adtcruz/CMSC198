<div class="section">
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
					<li><a href="<?php echo base_url();?>">HOME</a></li>
					<?php
					if($_SESSION["type"] === "client") $this->load->view('Client_menu');
					if($_SESSION["type"] === "technician") $this->load->view('Admin_menu');
					if($_SESSION["type"] === "admin") $this->load->view('Admin_menu');
					?>
					<li class="light-blue darken-3"><a class="center-align white-text" onclick="logOut('<?php echo base_url();?>');">LOG OUT</a></li>
				</ul>
			</div>
		</div>
		<div class="col s3">&nbsp;</div>
		<!-- MAIN CONTENT CONTAINER-->
		<div class="col s6 z-depth-4">
			<div class="row">
				<div class="container">
				<form autocomplete="off">
					<div class="row">
						<div class="input-field">
							<textarea id="problemsEncountered" class="materialize-textarea"></textarea>
							<label for="problemsEncountered">Problems encountered</label>
						</div>
						<div class="mdl-textfield mdl-js-textfield" align="right">
							<button class="btn waves-effect waves-light red">Submit
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>