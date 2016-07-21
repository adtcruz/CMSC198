<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<!-- MAIN CONTENT CONTAINER -->
	<div id="mainAppArea" class="container">
    <br/>
    <div class="row">
    	<!-- List of Job Requests and File Job Request tab -->
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a class="active" href="#currNotifs"><i class="tiny material-icons">announcement</i>&nbsp;New Notifications</a></li>
          <li class="tab col s3"><a href="#allNotifs" onclick="$('#clients-selector').material_select();"><i class="tiny material-icons">email</i>&nbsp;Notifications Read</a></li>
        </ul>
        <br/>
      </div>
      <!-- Job Request table -->
      <div id="currNotifs">
        <div class="row">
            <br/>
            <br/>
            <br/>
            <?php
                echo $unreadNotifs;
            ?>
    		</div>
      </div>
      <!-- Job Request Form -->
      <div id="allNotifs">
        <div class="row">
    			<div class="col s1 m1 l1">&nbsp;</div>
    			<div autocomplete="off" class="col s10 m10 l10">
                <?php echo $readNotifs['table']; ?>
    			</div>
    			<div class="col s1 m1 l1">&nbsp;</div>
    		</div>
      </div>
    </div>
  </div>
</div>
