<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<br/>
		<br/>
		<h3 class="center-align">Manage Application</h3>
		<br/>
    	<?php
    		if($_SESSION["type"]==="superadmin")
            {
                $this->load->view('Manage_application_superadmin_cards');
            }
    		else
            {
                $this->load->view('Manage_application_admin_card');
            }
    		$this->load->view('Manage_application_materials_services');
		?>
	</div>
</div>
