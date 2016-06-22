<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainc" class="col s9 m9 l9 section">
		<div class="row">
			<div class="col s1 m1 l1" background>&nbsp;</div>
			<form autocomplete="off" class="col s10 m10 l10">
				<br/>
				<h3>Schedule</h3>
				<br/>
					<?php
					$this->load->library ('table');
					$template = array (
							'table_open' => '<table class="bordered">'
						);
					$this->table->set_template ($template);
					$this->table->set_heading ('Priority', 'Date Created', 'Job Description', 'Submitted By');
					
					foreach ($schedule_array as $row)
					{
						$this->table->add_row ($row['priority'], $row['dateCreated'], $row['jobDescription'], $row['givenName'].' '.$row['lastName']);
					}
					
					echo $this->table->generate ();
				?>
				<br/>
				<br/>
			</form>
			<div class="col s1 m1 l1">&nbsp;</div>
		</div>
	</div>
</div>



</body>
</html>