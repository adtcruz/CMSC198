<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div id="mainAppArea" class="col s9 m9 l9">
		<div class="row">
			<br/>
			<h3 class="center-align"><?php if($_SESSION["type"]==="client") echo "My ";?>Job Requests</h3>
			<br/>
			<br/>
			<?php echo $table;?>
		</div>
	</div>
	<div id="editJobModal" class="modal">
		<div class="row">
			<br/>
			<h5 class="center-align">Edit Job Request</h5>
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="input-field col s10 m10 l10">
				<i class="material-icons large prefix">assignment_late</i>
				<textarea id="problemsEncountered" name="problemsEncountered"class="materialize-textarea"></textarea>
				<label for="problemsEncountered">Problems encountered</label>
			</div>
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="col s12 m12 l12 center-align">
				<a class="waves-effect waves-light btn btn-large red darken-4" onclick="confirmEditJob();">Edit</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn btn-large blue" onclick="$('#editJobModal').closeModal();">Cancel</a>
			</div>
		</div>

	</div>
	<div id="confirmEditModal" class="modal">
		<div class="modal-content">
			<div class="row">
				<h5 class="center-align">Are you sure you want to edit this Job Request?</h5>
			</div>
			<div class="row center-align">
				<a class="waves-effect waves-light btn btn-large red darken-4" onclick="editJob('<php echo base_url();?>')">Yes</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn btn-large blue" onclick="$('#confirmEditModal').closeModal();">No</a>
			</div>
		</div>
	</div>
	<div id="cancelModal" class="modal">
		<div class="modal-content">
			<div class="row">
				<h5 class="center-align">Are you sure you want to cancel this Job Request?</h5>
			</div>
			<div class="row center-align">
				<a class="waves-effect waves-light btn btn-large red darken-4" onclick="cancelJob('<?php echo base_url();?>');">Yes</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn btn-large blue" onclick="$('#cancelModal').closeModal();">No</a>
			</div>
		</div>
	</div>
	<div id="jobCanceledModal" class="modal">
		<div class="row">
			<br/>
			<h5 class="center-align">Job Canceled.</h5>
		</div>
		<div class="row center-align">
			<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
		</div>
	</div>
	<?php if(($_SESSION["type"]=="admin")||($_SESSION["type"]=="superadmin")) $this->load->view('Add_to_schedule_modal'); ?>
</div>