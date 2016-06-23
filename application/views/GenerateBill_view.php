<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav');?>
	<div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainc" class="col s9 m9 l9 section">
		<div class="row">
			<form autocomplete="off">
				<br/>
				<h3 class="center-align">Generate Bill</h3>
				<br/>
					<?php
					$this->load->library ('table');
					$template = array (
							'table_open' => '<table class="bordered centered highlight">'
						);
					$this->table->set_template ($template);
					$this->table->set_heading ('Job ID', 'Client Name', 'Generate Bill');

					$button = array(
							'data' => '<a href="topdf_bfp" class="waves-effect waves-light btn"><i class="material-icons left">credit_card</i>Generate</a>'
						);

					foreach ($generateBill_array as $row)
					{
						$this->table->add_row ($row['jobID'], $row['givenName'].' '.$row['lastName'], $button);

					}

					echo $this->table->generate ();
				?>
				<br/>
				<br/>
			</form>
		</div>
	</div>
</div>



</body>
</html>
