<div class="row">
	<br/>
	<h3 class="center-align">Job Request</h3>
	<br/>
	<br/>
	<div class="col s1 m1 l1">&nbsp;</div>
	<div class="col s10 m10 l10">
		<div class="row">
			<div class="row">
				<h5><i class="material-icons">assignment_late</i> Problem(s) Encountered:</h5>
				<h5 class="red-text"><?php echo $jobDesc;?></h5>
			</div>
			<br/>
			<div class="row">
				<h5><i class="material-icons">work</i> Work(s) Done:</h5>
				<div id="workDoneTable" class="row">
				</div>
				<br/>
				<div class="right-align">
					<a class="btn-floating btn tooltipped waves-effect waves-light green darken-4" data-position="left" data-delay="50" data-tooltip="Add work done"><i class="material-icons">add</i></a>
				</div>
			</div>
			<br/>
			<div class="row">
				<h5><i class="material-icons">perm_device_information</i> Material(s) used:</h5>
				<div id="materialsUsedTable" class="row">
				</div>
				<br/>
				<div class="right-align">
					<a class="btn-floating btn tooltipped waves-effect waves-light green darken-4" data-position="left" data-delay="50" data-tooltip="Add material used" onclick="openAddMaterialsUsedModal('<?php echo base_url();?>')"><i class="material-icons">add</i></a>
				</div>
			</div>
			<br/>
		</div>
		<div class="center-align">
			<a class="waves-effect waves-light btn yellow darken-4 center-align white-text" onclick="openChangePriorityModal();">Change Priority</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="waves-effect waves-light btn red darken-4 center-align white-text" onclick="$('#confirmMarkingAsDoneModal').openModal({dismissible:false});">Mark as Done</a>
		</div>
		<br/><br/>
		<div class="center-align">
			<a class="waves-effect waves-light btn btn-large blue darken-4 center-align white-text" onclick="reloadPage('<?php echo base_url();?>')">Go back</a>
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
<div id="changePriorityModal" class="modal">
	<div class="row">
    <br/>
    <h5 class="center-align">Change Job Priority</h5>
		<br/><br/>
		<div class="row">
			<div class="col s3 m3 l3">&nbsp;</div>
			<div class="col s6 m6 l6">
				<select id="newPriority">
					<?php
					if($priority==1){
						echo ("<option value=\"\" disabled=\"disabled\">Select priority…</option>".
						"<option value=\"1\" selected=\"selected\">Normal</option>".
						"<option value=\"2\">Urgent</option>".
						"<option value=\"3\">Very Urgent</option>");
					}

					if ($priority==2){
							echo ("<option value=\"\" disabled=\"disabled\">Select priority…</option>".
							"<option value=\"1\">Normal</option>".
							"<option value=\"2\" selected=\"selected\">Urgent</option>".
							"<option value=\"3\">Very Urgent</option>");
					}

					if ($priority==3){
							echo ("<option value=\"\" disabled=\"disabled\">Select priority…</option>".
							"<option value=\"1\">Normal</option>".
							"<option value=\"2\">Urgent</option>".
							"<option value=\"3\" selected=\"selected\">Very Urgent</option>");
					}
					?>
				</select>
			</div>
			<div class="col s3 m3 l3">&nbsp;</div>
		</div>
  </div>
	<br/>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large yellow darken-4" onclick="confirmUpdatePriority();">Update Priority</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#changePriorityModal').closeModal();">Close</a>
  </div>
</div>
<div id="confirmUpdatePriorityModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Are you really sure you want to update Job Priority?<br/><br/>This process is NOT reversible.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large red darken-4" onclick="updatePriority('<?php echo base_url();?>');">YES</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#confirmUpdatePriorityModal').closeModal();">NO</a>
  </div>
</div>
<div id="priorityUpdatedModal" class="modal">
  <div class="row">
    <br/>
    <h5 class="center-align">Priority updated.</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
  </div>
</div>
<div id="addMaterialsUsedModal" class="modal">
	<div class="row">
    <br/>
    <h5 class="center-align">Add material(s) used.</h5>
		<br/><br/>
		<div class="row">
			<div class="col s3 m3 l3">&nbsp;</div>
			<div class="col s6 m6 l6">
				<div class="input-field">
					<select id="materialID">
					</select>
				</div>
				<div class="input-field">
					<input id="materialUnits" value="0" type="number"/>
					<label for="materialUnits">Total Number of Units</label>
				</div>
			</div>
			<div class="col s3 m3 l3">&nbsp;</div>
		</div>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large green darken-4" onclick="addMaterialsUsed('<?php echo base_url();?>')">Add Material</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#addMaterialsUsedModal').closeModal();">Close</a>
  </div>
</div>
<div id="changeMaterialQuantityUnitModal" class="modal">
	<div class="row">
		<br/>
		<h5 class="center-align">Change material(s) quantity/units.</h5>
		<br/><br/>
		<div class="row">
			<div class="col s3 m3 l3">&nbsp;</div>
			<div class="col s6 m6 l6">
				<div class="input-field">
					<input id="newMaterialUnits" value="0" type="number"/>
					<label for="newMaterialUnits">Total Number of Units</label>
				</div>
			</div>
			<div class="col s3 m3 l3">&nbsp;</div>
		</div>
	</div>
	<div class="row center-align">
		<a class="waves-effect waves-light btn btn-large green darken-4" onclick="updateMaterialsUsed('<?php echo base_url();?>');">Change Quantity/Units</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#changeMaterialQuantityUnitModal').closeModal();">Close</a>
	</div>
</div>
<div id="quantityUnitsCantBeNoughtModal" class="modal">
	<div class="row">
    <br/>
    <h5 class="center-align">Quantity/Units can not be less than 1!</h5>
  </div>
  <div class="row center-align">
    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#quantityUnitsCantBeNoughtModal').closeModal();">OK</a>
  </div>
</div>
