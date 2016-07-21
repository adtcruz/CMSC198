<div id="newAdminAccount">
  <div class="col s1 m1 l1">&nbsp;</div>
  <div class="col s10 m10 l10">
    <br/>
    <h4 class="center-align">New Admin account</h4>
    <br/>
    <div class="row">
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <i class="material-icons prefix">contacts</i>
          <input type="text" id="adminGivenName" name="adminGivenName" onkeyup="adminGivenNameChange();" onchange="adminGivenNameChange();"/>
          <label id="adminGivenNameLabel" for="adminGivenName">Given Name</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="adminLastName" name="adminLastName" onkeyup="adminLastNameChange();" onchange="adminLastNameChange();"/>
          <label id="adminLastNameLabel" for="adminLastName">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="adminUsername" name="adminUsername" onkeyup="adminUsernameChange();" onchange="adminUsernameChange();"/>
          <label id="adminUsernameLabel" for="adminUsername">Username</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">vpn_key</i>
          <input type="password" id="adminPassword" name="adminPassword" onkeyup="adminPasswordChange();" onchange="adminPasswordChange();"/>
          <label id="adminPasswordLabel" for="adminPassword">Password</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">done_all</i>
          <input type="password" id="adminConfirmPassword" disabled="disabled" name="adminConfirmPassword" onkeyup="adminConfirmPasswordChange();" onchange="adminConfirmPasswordChange();"/>
          <label id="adminConfirmPasswordLabel" for="adminConfirmPassword">Confirm Password</label>
        </div>
      </div>
    </div>
    <div class="input-field" align="right">
        <button id="submitButton" class="btn waves-effect waves-light green darken-4" onclick="addAdmin('<?php echo base_url();?>')">Create Account<i class="material-icons right">done</i>
        </button>
    </div>
  </div>
  <div class="col s1 m1 l1">&nbsp;</div>
</div>
<div id="newTechnAccount">
  <div class="col s1 m1 l1">&nbsp;</div>
  <div class="col s10 m10 l10">
    <br/>
    <h4 class="center-align">New Technician account</h4>
    <br/>
    <div class="row">
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <i class="material-icons prefix">contacts</i>
          <input type="text" id="technGivenName" name="technGivenName" onkeyup="technGivenNameChange();" onchange="technGivenNameChange();"/>
          <label id="technGivenNameLabel" for="technGivenName">Given Name</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="technLastName" name="technLastName"onkeyup="technLastNameChange();" onchange="technLastNameChange();"/>
          <label id="technLastNameLabel" for="technLastName">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="technUsername" name="technUsername" onkeyup="technUsernameChange();" onchange="technUsernameChange();"/>
          <label id="technUsernameLabel" for="technUsername">Username</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">vpn_key</i>
          <input type="password" id="technPassword" name="technPassword" onkeyup="technPasswordChange();" onchange="technPasswordChange();"/>
          <label id="technPasswordLabel" for="technPassword">Password</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">done_all</i>
          <input type="password" id="technConfirmPassword" disabled="disabled" name="technConfirmPassword" onkeyup="technConfirmPasswordChange();" onchange="technConfirmPasswordChange();"/>
          <label id="technConfirmPasswordLabel" for="technConfirmPassword">Confirm Password</label>
        </div>
      </div>
    </div>
    <div class="input-field" align="right">
        <button id="submitButton" class="btn waves-effect waves-light green darken-4" onclick="addTechnician('<?php echo base_url();?>')">Create Account<i class="material-icons right">done</i>
        </button>
    </div>
  </div>
  <div class="col s1 m1 l1">&nbsp;</div>
</div>
<div id="newSuperadminAccount">
  <div class="col s1 m1 l1">&nbsp;</div>
  <div class="col s10 m10 l10">
    <br/>
    <h4 class="center-align">New Superadmin account</h4>
    <br/>
    <div class="row">
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <i class="material-icons prefix">contacts</i>
          <input type="text" id="superadminGivenName" name="superadminGivenName" onkeyup="superadminGivenNameChange();" onchange="superadminGivenNameChange();"/>
          <label id="superadminGivenNameLabel" for="superadminGivenName">Given Name</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="superadminLastName" name="superadminLastName" onkeyup="superadminLastNameChange();" onchange="superadminLastNameChange();"/>
          <label id="superadminLastNameLabel" for="superadminLastName">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="superadminUsername" name="superadminUsername" onkeyup="superadminUsernameChange();" onchange="superadminUsernameChange();"/>
          <label id="superadminUsernameLabel" for="superadminUsername">Username</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">vpn_key</i>
          <input type="password" id="superadminPassword" name="superadminPassword" onkeyup="superadminPasswordChange();" onchange="superadminPasswordChange();"/>
          <label id="superadminPasswordLabel" for="superadminPassword">Password</label>
        </div>
        <div class="input-field col s4 m4 l4">
          <i class="material-icons prefix">done_all</i>
          <input type="password" id="superadminConfirmPassword" name="superadminConfirmPassword" disabled="disabled" onkeyup="superadminConfirmPasswordChange();" onchange="superadminConfirmPasswordChange();"/>
          <label id="superadminConfirmPasswordLabel" for="superadminConfirmPassword">Confirm Password</label>
        </div>
      </div>
    </div>
    <div class="input-field" align="right">
        <button id="submitButton" class="btn waves-effect waves-light green darken-4" onclick="addSuper('<?php echo base_url();?>')">Create account<i class="material-icons right">done</i>
        </button>
    </div>
  </div>
  <div class="col s1 m1 l1">&nbsp;</div>
</div>
