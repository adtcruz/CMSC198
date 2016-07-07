<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainAppArea" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col s3"><a class="active" href="#manageMaterials">Manage Selectable Materials</a></li>
					<li class="tab col s3"><a href="#addMaterial">Add New Material</a></li>
				</ul>
			</div>
			<br/>
			<div id="manageMaterials">
				<br/>
				<h3 class="center-align">Manage Selectable Materials</h3>
				<br/>
					<?php
						echo $materialsTable;
					?>
				<br/>
				<br/>
			</div>
			<div id="addMaterial">
				<br/>
				<h3 class="center-align">Add New Material</h3>
				<br/>
			</div>
		</div>
	</div>
</div>
