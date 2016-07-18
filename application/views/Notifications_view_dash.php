<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div class="col s3 m3 l3 section"><br/><br/></div>
	<div id="mainAppArea" class="col s9 m9 l9 section">
		<div class="row">
			<br/>
			<h3 class="center-align">Notifications</h3>
			<br/>
            <?php
                $template = array(
                    'table_open' => '<table class="bordered centered highlight">'
                );
                $this->table->set_template ($template);
                echo $unreadNotifs;
            ?>
			<br/>
			<br/>
		</div>
	</div>
</div>
