<div class="row">
	<br/>
	<h3 class="center-align">Update Job</h3>
	<br/>
	<br/>
	<div class="col s1 m1 l1">&nbsp;</div>
	<div class="col s10 m10 l10">
		<div class="row">
			<div class="row">
				<h5><i class="material-icons">assignment_late</i> Problems Encountered:<br/><br/><span class="red-text"><?php echo $jobDesc;?></span></h5>
			</div>
			<br/>
			<div class="center-align">
				<a class="waves-effect waves-light btn btn-small green darken-4 center-align white-text">List of work done…</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn btn-small green darken-4 center-align white-text">List of materials used…</a>
			</div>
		</div>
		<br/><br/>
		<div class="center-align">
			<a class="waves-effect waves-light btn btn-large yellow darken-4 center-align white-text">Change the Priority of this Job Request</a>
		</div>
		<br/><br/>
		<div class="center-align">
			<a class="waves-effect waves-light btn btn-large red darken-4 center-align white-text" onclick="$('#confirmMarkingAsDoneModal').openModal({dismissible:false});">Mark this Job Request as Done</a>
		</div>
	</div>
	<div class="col s1 m1 l1">&nbsp;</div>
</div>
<div id="confirmMarkingAsDoneModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Are you really sure you want to mark this Job Request as Done?<br/><br/>This process is NOT reversible.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large red darken-4" onclick="markThisJobDone('<?php echo base_url();?>');">YES</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#confirmMarkingAsDoneModal').closeModal();">NO</a>
  </div>
</div>
<div id="jobMarkedAsDoneModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Job is now marked as done.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
  </div>
</div>
