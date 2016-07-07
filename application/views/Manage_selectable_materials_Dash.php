<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainAppArea" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col s3"><a onclick="window.location.href='<?php echo base_url();?>'+'manage_application';" href="#">Back to Manage Application</a></li>
					<li class="tab col s3"><a class="active" href="#manageMaterials">Manage Selectable Materials</a></li>
					<li class="tab col s3"><a href="#addMaterial" onclick="$('#materialUnitMeasurement').material_select();">Add New Material</a></li>
				</ul>
			</div>
			<br/>
			<div id="manageMaterials">
				<br/>
				<br/>
				<h3 class="center-align">Manage Selectable Materials</h3>
				<br/>
				<div class="row">
					<?php
						echo $materialsTable;
					?>
				</div>
				<br/>
				<br/>
			</div>
			<div id="addMaterial">
				<br/>
				<br/>
				<h3 class="center-align">Add New Material</h3>
				<div class="row">
					<div class="col s1 m1 l1">&nbsp;</div>
					<div autocomplete="off" class="col s10 m10 l10">
						<div class="row">
							<div class="input-field">
								<input id="materialName" name="materialName" type="text"/>
								<label id="materialNameLabel" for="materialName">Material Name</label>
							</div>
						</div>
						<div class="row">
							<div class="col s6 m6 l6">
								<div class="input-field">
									<input id="materialCost" name="materialCost" type="number" min="0" value="0"/>
									<label id="materialCostLabel" for="materialCost">Cost per Unit</label>
								</div>
							</div>
							<div class="col s6 m6 l6">
								<div class="input-field">
									<select id="materialUnitMeasurement" name="materialUnitMeasurement">
										<option value="" disabled="disabled" selected="selected">Select Unit Measurement…</option>
										<option value="metres">metres</option>
										<option value="pieces">pieces</option>
										<option value="units">units</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="input-field">
								<textarea id="materialDescription" class="materialize-textarea"></textarea>
								<label id="materialDescriptionLabel">Material Description</label>
							</div>
						</div>
    				<div class="row" align="right">
    					<a class="btn waves-effect waves-light red">
    						Add New Material<i class="material-icons right">send</i>
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
