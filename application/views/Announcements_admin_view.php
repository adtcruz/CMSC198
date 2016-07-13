<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <?php
        $this->load->view('Header');
        $this->load->view('Sidenav');
    ?>
    <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
    <div class="col s9 m9 l9">
        <ul class="tabs">
            <li class="tab col s12"><a href="#annAddTab"> Add Announcement </a></li>
            <li class="tab col s12"><a href="#annViewTab"> View Announcements </a></li>
        </ul>
    </div>
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <div class="row">
            <br/>
            <div id="annAddTab" class="col s12 m12 l12">
                <!-- Announcements Add -->
                <?php
                    echo validation_errors ();
                    $attributes = array (
                        'id' => 'addAnnouncement',
                        'name' => 'addAnnouncement',
                        'method' => 'POST'
                    );
                    echo form_open ('add_announcements', $attributes);
                    echo form_label ('Title', 'title');
                    $param = array (
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Enter Announcement Title',
                        'maxlength' => '128',
                        'size' => '20'
                    );
                    echo form_input ($param);
                    echo form_label ('Text', 'text');
                    $param = array (
                        'name' => 'text',
                        'id' => 'text',
                        'placeholder' => 'Enter Announcement Content',
                        'maxlength' => '1024',
                        'style' => 'resize: none; height: 200px'
                    );
                    echo form_textarea ($param);
                    echo '<div id="charCount"></div>';
                    echo form_submit ('addAnn','Add Announcement');
                    echo form_reset ('reset','Reset Form');
                    echo form_close ();
                ?>
            </div>
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
