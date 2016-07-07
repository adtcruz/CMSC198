<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<br/>
		<br/>
        <a class="waves-effect waves-light btn" href="<?php echo base_url();?>manage_application"><i class ="material-icons left">fast_rewind</i>Back to previous page</a>
		<h3 class="center-align">User Logs</h3>
		<br/>
		<div class="row">
			<div>
				<?php

				//if there are no log entries, display the message that there are no log entries
				//this may signify that there is a problem with the the database or application
				if($logsTable==="No log entries"){
					echo "<h5 class\"center-align\">Sorry, there are no log entries.</h5>";
				}

				//display the log entries table
				else{

					//loads the tab links and the main tab headers
					$this->load->view('View_user_logs_tab_header');

					//loads the table
					echo $logsTable;

					//loads the main tab footer and other tabs
					$this->load->view('View_user_logs_tab_footer');
				}
				?>
			</div>
		</div>
	</div>
	<div id="enterUsernameModal" class="modal">
		<div class="row">
	    <br/>
	    <h5 class="center-align">Please enter a username.</h5>
			<br/>
			<div class="row">
				<div class="col s3 m3 l3">&nbsp;</div>
				<div class="col s6 m6 l6 input-field">
					<i class="material-icons large prefix">perm_identity</i>
					<input id="usernameInput" name="usernameInput" type="text"/>
					<label for="usernameInput">Username</label>
				</div>
				<div class="col s3 m3 l3">&nbsp;</div>
			</div>
	  </div>
	  <div class="row center-align">
	    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="getUsersLogs('<?php echo base_url();?>');">Done!</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="goBackToAll();">Cancel</a>
	  </div>
	</div>

</div>
