<div class="row">
  <?php $this->load->view('Sidenav');?>
  <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
  <div id="mainc" class="col s9 m9 l9 section">
    <div class="row">
      <div class="col s1 m1 l1">&nbsp;</div>
      <div class="col s10 m10 l10">
        <br/>
        <h3 class="center-align">Add New Client</h3>
        <br/>
        <div class="row">
          <div class="input-field col s6">
            <?php echo form_label('Username :'); ?> <?php echo form_error('username'); ?><br />
            <?php echo form_input(array('id' => 'username', 'name' => 'username')); ?><br />
          </div>
          <div class="input-field col s6">
            <?php echo form_label('Password :'); ?> <?php echo form_error('password'); ?><br />
            <?php echo form_password(array('id' => 'password', 'name' => 'password')); ?><br />
          </div>
          <div class="input-field col s6">
            <?php echo form_label('Given Name :'); ?> <?php echo form_error('givenName'); ?><br />
            <?php echo form_input(array('id' => 'givenName', 'name' => 'givenName')); ?><br />
          </div>
          <div class="input-field col s6">
            <?php echo form_label('Last Name :'); ?> <?php echo form_error('lastName'); ?><br />
            <?php echo form_input(array('id' => 'lastName', 'name' => 'lastName')); ?><br />
          </div>
          <div class="input-field col s6">
            <?php echo form_label('Designation :'); ?> <?php echo form_error('designation'); ?><br />
            <?php echo form_input(array('id' => 'designation', 'name' => 'designation')); ?><br />
          </div>
          <div class="input-field col s6">
            <?php echo form_label('Office ID :'); ?> <?php echo form_error('officeId'); ?><br />
            <?php echo form_input(array('id' => 'officeId', 'name' => 'officeId')); ?><br />
          </div>
        </div>
        <div class="input-field" align="right">
            <button class="btn waves-effect waves-light red" onclick="addClient('<?php echo base_url();?>')">Create client<i class="material-icons right">send</i>
            </button>
        </div>
        <br/>
        <br/>
      </div>
      <div class="col s1 m1 l1">&nbsp;</div>
    </div>
  </div>
</div>
