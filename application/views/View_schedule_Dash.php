<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div id="mainAppArea" class="container">
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
