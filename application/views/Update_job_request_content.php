<div class="row">
	<br/>
	<h3 class="center-align">Update Job</h3>
	<br/>
	<br/>
	<div class="col s1 m1 l1">&nbsp;</div>
	<div class="col s10 m10 l10">
		<div class="row">
			<div class="input-field">
				<i class="material-icons large prefix">assignment_late</i>
				<textarea id="updateProblemsEncountered" name="updateProblemsEncountered" class="materialize-textarea" disabled="disabled">
				<?php echo $jobDesc;?>
				</textarea>
			</div>
			<br/>
			<div class="row">
				<a class="waves-effect waves-light btn btn-small green darken-4 center-align white-text">List of work done…</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn btn-small green darken-4 center-align white-text">List of materials used…</a>
			</div>
			<div class="input-field">
				<input type="checkbox" id="jobDoneCheckbox"/>
	      <label for="jobDoneCheckbox">Job Completed</label>
			</div>
		</div>
		<br/><br/>
		<div class="center-align">
			<a class="waves-effect waves-light btn btn-large blue darken-4 center-align white-text" onclick="updateThisJob('<?php echo base_url();?>');">DONE</a>
		</div>
	</div>
	<div class="col s1 m1 l1">&nbsp;</div>
</div>
