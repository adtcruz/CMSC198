<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainAppArea" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col s3"><a class="active" href="#manageWork">Manage Selectable Work</a></li>
					<li class="tab col s3"><a href="#addWork">Add New Work</a></li>
				</ul>
			</div>
			<br/>
			<div id="manageWork">
				<br/>
				<br/>
				<h4 class="center-align">Manage Selectable Work</h4>
				<br/>
				<div class="row">
					<?php
						echo $workTable;
					?>
				</div>
				<br/>
				<br/>
			</div>
			<div id="addWork">
				<br/>
				<br/>
				<h4 class="center-align">Add New Work</h4>
				<div class="row">
					<div class="col s1 m1 l1">&nbsp;</div>
					<div autocomplete="off" class="col s10 m10 l10">
						<div class="row">
							<div class="input-field">
								<input id="workDescription" name="workDescription" type="text" onkeyup="workDescriptionOnChange();" onchange="workDescriptionOnChange();"/>
								<label id="workDescriptionLabel" for="workDescription">Work Description</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field">
								<input id="workCost" name="workCost" type="number" min="0" value="0"/>
								<label id="workCostLabel" for="workCost">Cost per Hour</label>
							</div>
						</div>
    				<div class="row" align="right">
    					<a class="btn waves-effect waves-light red" onclick="addNewSelectableWork('<?php echo base_url();?>');">
    						Add New Work<i class="material-icons right">send</i>
    					</a>
    				</div>
					</div>
					<div class="col s1 m1 l1">&nbsp;</div>
				</div>
				<br/>
			</div>
		</div>
	</div>
</div>
<div id="selectableWorkAddedModal" class="modal">
	<div class="row">
		<br/>
		<h5 class="center-align">New Selectable Work added.</h5>
	</div>
	<div class="row center-align">
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
	</div>
</div>
<div id="updateSelectableWorkModal" class="modal">
	<div class="row">
		<br/>
		<h5 class="center-align">Update Selectable Work</h5>
		<br/><br/>
		<div class="row">
		  <div class="col s1 m1 l1">&nbsp;</div>
		  <div autocomplete="off" class="col s10 m10 l10">
		    <div class="row">
		      <div class="input-field">
		        <input id="newWorkDescription" name="newWorkDescription" type="text" onkeyup="newWorkDescriptionOnChange();" onchange="newWorkDescriptionOnChange();"/>
		        <label id="newWorkDescriptionLabel" for="newWorkDescription">New Work Description</label>
		      </div>
		    </div>
		    <div class="row">
	        <div class="input-field">
	          <input id="newWorkCost" name="newWorkCost" type="number" min="0" value="0"/>
	          <label id="newWorkCostLabel" for="newWorkCost">Cost per Unit</label>
	        </div>
		    </div>
		  </div>
		  <div class="col s1 m1 l1">&nbsp;</div>
		</div>
		<div class="row center-align">
			<a class="waves-effect waves-light btn btn-large red darken-4" onclick="updateSelectableWork('<?php echo base_url();?>')">Edit</a>
			&nbsp;&nbsp;&nbsp;
			<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#updateSelectableWorkModal').closeModal();">Cancel</a>
		</div>
	</div>
</div>
<div id="selectableWorkUpdatedModal" class="modal">
	<div class="row">
		<br/>
		<h5 class="center-align">Selectable Work updated.</h5>
	</div>
	<div class="row center-align">
		<a class="waves-effect waves-light btn btn-large blue darken-4" onclick="reloadPage('<?php echo base_url();?>');">OK</a>
	</div>
</div>
