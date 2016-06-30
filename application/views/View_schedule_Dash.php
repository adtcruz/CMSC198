<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainc" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<h3 class="center-align">Schedule</h3>
			<br/>
				<?php
				$this->load->library ('table');
				$template = array (
						'table_open' => '<table class="bordered centered highlight">'
					);
				$this->table->set_template ($template);
				$this->table->set_heading ('Priority', 'Date Scheduled', 'Job Description', 'Client Name', 'Location', 'Action');

				if(count($schedule_array) == 0){
					echo "<h5 class=\"center-align\">Sorry, there are no scheduled job requests at the moment.</h5>";
					return;
				}

				foreach ($schedule_array as $row)
				{
					if($row['priority']==1) $priority = "Normal";
					if($row['priority']==2) $priority = "Urgent";
					if($row['priority']==3) $priority = "Very Urgent";
					$this->table->add_row ($priority, $row['dateScheduled'], $row['jobDescription'], $row['givenName'].' '.$row['lastName'], $row['officeName'],"");
				}

				echo $this->table->generate ();
			?>
			<br/>
			<br/>
		</div>
	</div>
</div>



</body>
</html>
