<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<br/>
		<br/>
        <a class="waves-effect waves-light btn" href="<?php echo base_url();?>manage_application"><i class ="material-icons left">fast_rewind</i>Back to previous page</a>
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
<div id="confirmResetPasswordModal" class="modal">
	<div class="modal-content">
		<div class="row">
			<h5 class="center-align">Are you sure you want to reset this user's password?</h5>
		</div>
		<div class="row center-align">
			<a class="waves-effect waves-light btn btn-large red darken-4" onclick="resetPassword('<?php echo base_url();?>');">Yes</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="waves-effect waves-light btn btn-large blue" onclick="$('#confirmResetPasswordModal').closeModal();">No</a>
		</div>
	</div>
</div>
<div id="passwordResetModal" class="modal">
	<div class="modal-content">
		<div class="row">
			<h5 class="center-align">User's new password is the following:</h5>
			<h5 id="newPasswordArea" class="center-align red-text"></h5>
		</div>
		<div class="row center-align">
			<a class="waves-effect waves-light btn btn-large blue" onclick="$('#passwordResetModal').closeModal();">OK</a>
		</div>
	</div>
</div>
