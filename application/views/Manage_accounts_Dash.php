<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<br/>
		<br/>
		<h3 class="center-align">Manage <?php if ($_SESSION["type"]==="superadmin") echo "Accounts"; else echo "Clients";?></h3>
		<br/>
		<div class="row">
			<div>
				<?php
					if($_SESSION["type"]==="superadmin") $this->load->view('Manage_accounts_superadmin_content');
					else $this->load->view('Manage_accounts_content');
				?>
			</div>
		</div>
	</div>
</div>
