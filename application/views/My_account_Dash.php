<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<br/>
		<h3 class="center-align">My Account</h3>
		<br/>
		<div class="row">
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="col s10 m10 l10">
				<div class="input-field">
					<i class="material-icons prefix">perm_identity</i>
					<input name="username" type="text" value="<?php echo $_SESSION["username"];?>" disabled="disabled"/>
					<label for="username">Username: </label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">recent_actors</i>
					<input name="userType" type="text" value="<?php echo $_SESSION["type"];?>" disabled="disabled"/>
					<label for="userType">Account type: </label>
				</div>
				<br/>
				<div class="row">
					<div class="input-field col s6 m6 l6">
						<input id="user_givenName" name="user_givenName" type="text" onkeyup="givenNameOnChange();" onchange="givenNameOnChange()" value="<?php echo $_SESSION["givenName"];?>"/>
						<label id="user_givenNameLabel" for="user_givenName">Given Name: </label>
					</div>
					<div class="input-field col s6 m6 l6">
						<input id="user_lastName" name="user_lastName" type="text" onkeyup="lastNameOnChange();" onchange="lastNameOnChange()" value="<?php echo $_SESSION["lastName"];?>"/>
						<label id="user_lastNameLabel"for="user_lastName">Last Name: </label>
					</div>
				</div>
				<br/><br/>
				<div class="center-align">
					<a class="waves-effect waves-light btn green darken-4 center-align white-text" onclick="updateProfile('<?php echo base_url();?>')">Update Profile</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="waves-effect waves-light btn blue darken-4 center-align white-text">Change Password…</a>
				</div>
			</div>
			<div class="col s1 m1 l1">&nbsp;</div>
		</div>
	</div>
	<div id="profileUpdatedModal" class="modal">
		<div class="row">
	    <br/>
	    <h5 class="center-align">Profile updated!</h5>
	  </div>
	  <div class="row center-align">
	    <a class="waves-effect waves-light btn btn-large blue darken-4" onclick="$('#profileUpdatedModal').closeModal();">OK</a>
	  </div>
	</div>
</div>
