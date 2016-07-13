<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <?php
        $this->load->view('Header');
        $this->load->view('Sidenav');
    ?>
    <br>
    <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
    <div class="col s9 m9 l9">
        <ul class="tabs">
            <li class="tab col s12"><a href="#annAddTab"> annAddTab </a></li>
            <li class="tab col s12"><a href="#annViewTab"> annViewTab </a></li>
        </ul>
    </div>
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <div class="row">
            <br/>
            <br/>
            <div id="annAddTab" class="col s12 m12 l12">
                <!-- Announcements Add -->
                <?php
                    echo form_open (base_url().'addAnnouncements', 'id="addAnnForm"');  
                ?>

             <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Enter Announcement Title" name="title" id="title" type="text" class="validate"maxlength="128" size="20" >
                  <label for="">Announcement Title</label>
                </div>
              </div>
              <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea placeholder="Enter Announcement Content" name="content" id="content" class="materialize-textarea" maxlength="1024" onkeyup="countChar(this)"></textarea>
                      <label for="">Announcement Content</label>
                      <?php echo '<div id="charCount"></div>'; ?>
                    </div>
                  </div>
                </form>

              </div>
        
            <div class="input-field col s10">  
                <div class="mdl-textfield mdl-js-textfield" align="right" >
                  <button class="btn waves-effect waves-light red" type="addAnn">Add Announcements
                  </button>
                </div>
            </div>
            <div class="input-field col s2">  
                <div class="mdl-textfield mdl-js-textfield" align="right" >
                  <button class="btn waves-effect waves-light red" type="reset">Reset Form
                  </button>
                </div>
            </div>
                <?php echo form_close (); ?>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <div class="row">
            <div id="annViewTab" class="col s12 m12 l12">
                <!-- Announcements View -->
                <?php
                    $lines = array ();
                    foreach ($announcements as $row)
                    {
                        $line = '<div class = "collapsible-header blue-grey darken-1 white-text">'.$row['title'].'</div><div class = "collapsible-body">'.$row['details'].'</div>';
                        $lines[] = $line;
                    }
                    $attributes = array ('class' => 'collapsible', 'data-collapsible' => 'accordion');
                    echo ul ($lines, $attributes);
                ?>
            </div>
            <br/>
        </div>
    </div>
</div>
<?php
    $this->load->view ('Common_scripts');
    $this->load->view ('Logout_script');
    $this->load->view ('Announcements_script');
?>
</body>

</html>
