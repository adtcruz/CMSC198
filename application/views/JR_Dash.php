<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainc" class="col s9 m9 l9 section">
		<div class="row">
			<div class="col s1 m1 l1">&nbsp;</div>
			<form autocomplete="off" class="col s10 m10 l10">
				<br/>
				<h3 class="center-align">File a Job Request</h3>
				<br/>
				<?php
				if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
					$this->load->view('Office_selector');
					$this->load->view('Clients_selector');
				}
				?>
				<div class="input-field">
					<i class="material-icons large prefix">assignment_late</i>
					<textarea id="problemsEncountered" name="problemsEncountered"class="materialize-textarea"></textarea>
					<label for="problemsEncountered">Problems encountered</label>
				</div>
				<div class="mdl-textfield mdl-js-textfield" align="right">
					<a class="btn waves-effect waves-light red" onclick="fileJobRequest('<?php echo base_url();?>');">
						Submit<i class="material-icons right">send</i>
					</a>
				</div>
				<br/>
				<br/>
			</form>
			<div class="col s1 m1 l1">&nbsp;</div>
		</div>
		<div id="submittedMessage" class="modal">
			<div class="row">
				<br/>
				<h5 class="center-align">Job Request filed.</h5>
			</div>
			<div class="row center-align">
				<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#submittedMessage').closeModal();">OK</a>
			</div>
		</div>
	</div>
</div>
