<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainAppArea" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<h4 class="center-align">Schedule</h4>
			<br/>
				<?php
					echo $table;
				?>
			<br/>
			<br/>
		</div>
	</div>
</div>
