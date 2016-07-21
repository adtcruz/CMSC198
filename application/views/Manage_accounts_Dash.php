<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="container">
		<br/>
		<br/>
		<h4 class="center-align">Manage <?php if ($_SESSION["type"]==="superadmin") echo "Accounts"; else echo "Clients";?></h4>
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
