<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div id="mainAppArea" class="col s9 m9 l9">
    <br/>
    <div class="row">
      <?php if($_SESSION["type"]==="superadmin") $this->load->view('New_account_superadmin_tabs');?>
      <div id="newClientAccount">
        <div class="col s1 m1 l1">&nbsp;</div>
        <div class="col s10 m10 l10">
          <br/>
          <h3 class="center-align">New Client account</h3>
          <br/>
          <div class="row">
            <div class="row">
              <div class="input-field col s6 m6 l6">
                <i class="material-icons prefix">contacts</i>
                <input type="text" id="clientGivenName" name="clientGivenName" onkeyup="clientGivenNameChange();" onchange="clientGivenNameChange();"/>
                <label id="clientGivenNameLabel" for="clientGivenName">Given Name</label>
              </div>
              <div class="input-field col s6">
                <input type="text" id="clientLastName" name="clientLastName" onkeyup="clientLastNameChange();" onchange="clientLastNameChange();"/>
                <label id="clientLastNameLabel" for="clientLastName">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">perm_identity</i>
                <input type="text" id="clientUsername" name="clientUsername" onkeyup="clientUsernameChange();" onchange="clientUsernameChange();"/>
                <label id="clientUsernameLabel" for="clientUsername">Username</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">vpn_key</i>
                <input type="password" id="clientPassword" name="clientPassword" onkeyup="clientPasswordChange();" onchange="clientPasswordChange();"/>
                <label id="clientPasswordLabel" for="clientPassword">Password</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">done_all</i>
                <input type="password" id="clientConfirmPassword" name="clientConfirmPassword" disabled="disabled" onkeyup="clientConfirmPasswordChange();" onchange="clientConfirmPasswordChange();"/>
                <label id="clientConfirmPasswordLabel" for="clientConfirmPassword">Confirm Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">business</i>
                <input type="text" id="designation" name="designation" onkeyup="designationChange();" onchange="designationChange();"/>
                <label id="designationLabel" for="designation">Designation</label>
              </div>
              <div class="input-field col s6">

                <select id="office-selector" class="dropSelect" name="office-selector">
                    <option disabled selected> </option>
                    <?php echo $options;?>
            	</select>
              </div>
            </div>
          </div>
          <div class="input-field" align="right">
              <button id="submitButton" class="btn waves-effect waves-light green darken-4" onclick="addClient('<?php echo base_url();?>')">Create Account<i class="material-icons right">done</i>
              </button>
          </div>
        </div>
        <div class="col s1 m1 l1">&nbsp;</div>
      </div>
			<?php if($_SESSION["type"]==="superadmin") $this->load->view('New_account_superadmin_forms');?>
		</div>
	</div>
	<div id="accountCreatedModal" class="modal">
		<div class="row">
	    <br/>
	    <h5 class="center-align">Account created!</h5>
	  </div>
	  <div class="row center-align">
	    <a class="waves-effect waves-light btn btn-large blue darken-4" href="<?php echo base_url();?>manage_accounts">OK</a>
	  </div>
	</div>
</div>
