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
                <input type="text" id="givenName" name="givenName"/>
                <label for="givenName">Given Name</label>
              </div>
              <div class="input-field col s6">
                <input type="text" id="lastName" name="lastName"/>
                <label for="lastName">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">perm_identity</i>
                <input type="text" id="username" name="username"/>
                <label for="username">Username</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">vpn_key</i>
                <input type="password" id="password" name="password"/>
                <label for="password">Password</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <i class="material-icons prefix">done_all</i>
                <input type="password" id="confirmPassword" name="confirmPassword"/>
                <label for="confirmPassword">Confirm Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">supervisor_account</i>
                <input type="text" id="designation" name="designation"/>
                <label for="designation">Designation</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">business</i>
                <select id="officeId">
                  <?php echo $options;?>
                </select>
              </div>
            </div>
          </div>
          <div class="input-field" align="right">
              <button id="submitButton" class="btn waves-effect waves-light red" onclick="addClient('<?php echo base_url();?>')">Create client<i class="material-icons right">send</i>
              </button>
          </div>
        </div>
        <div class="col s1 m1 l1">&nbsp;</div>
      </div>
			<!-- Add add admin technician accounts here later -->
		</div>
	</div>
</div>
