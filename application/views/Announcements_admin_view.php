<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <!-- Includes the Header and Sidenav Viewa -->
    <?php
        $this->load->view('Header');
        $this->load->view('Sidenav', $unread);
    ?>
    <br>
    <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
    <!-- Shows the Add Announcements and View Announcements tabs -->
    <div class="col s9 m9 l9">
        <ul class="tabs">
            <li class="tab col s12"><a href="#annAddTab"> Add Announcements </a></li>
            <li class="tab col s12"><a href="#annViewTab"> View Announcements </a></li>
        </ul>
    </div>

    <!-- Add Announcement Form -->
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <br/>
        <br/>
        <div class="row">
            <div id="annAddTab" class="col s12 m12 l12">
                <!-- Announcements Add -->
                <?php
                    echo validation_errors ();
                    // <form> + attributes
                    $params = array (
                        'id' => 'addAnnouncements',
                        'name' => 'addAnnouncements',
                        'method' => 'POST'
                    );
                    echo form_open ('announcements', $params);
                    // input box for title
                    echo '<div class = "row"> <div class = "input-field col s12 m12 l12">';
                    $params = array (
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Enter Announcement Title',
                        'maxlength' => '100',
                        'size' => '20'
                    );
                    echo form_input ($params);
                    echo form_label ('Announcement Title', 'title');
                    echo '<div id="titleCount"></div>';
                    echo '</div> </div>';
                    // text area for content
                    echo '<div class = "row"> <div class = "row"> <div class = "input-field col s12 m12 l12">';
                    $param = array (
                        'name' => 'content',
                        'id' => 'content',
                        'placeholder' => 'Enter Announcement Content',
                        'maxlength' => '1024',
                        'style' => 'resize: none;',
                        'class' => 'materialize-textarea'
                    );
                    echo form_textarea ($param);
                    echo form_label ('Announcement Content', 'content');
                    echo '<div id="contentCount"></div>';
                    echo '</div> </div> </div>';
                    // submit button
                    echo '<div class = "input-field col s10 m10 l10"> <div class = "mdl-textfield mdl-js-textfield" align = "right">';
                    $params = array (
                        'name' => 'annAdd',
                        'id' => 'annAdd',
                        'type' => 'submit',
                        'class' => 'btn waves-effect waves-light green darken-4',
                        'content' => 'Add Announcement'
                    );
                    echo form_button ($params);
                    echo '</div> </div>';
                    // reset button
                    echo '<div class = "input-field col s2 m2 l2"> <div class = "mdl-textfield mdl-js-textfield" align = "right">';
                    $params = array (
                        'name' => 'annRes',
                        'id' => 'annRes',
                        'type' => 'reset',
                        'class' => 'btn waves-effect waves-light red darken-4',
                        'content' => 'Reset Form'
                    );
                    echo form_button ($params);
                    echo '</div> </div>';
                    echo form_close ()
                ?>
            </div>
        </div>
    </div>
    <!-- View Announcements -->
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <div class="row">
            <div id="annViewTab" class="col s12 m12 l12">
                <!-- Announcements View -->
                <?php
                    $lines = array ();
                    foreach ($announcements['announcements'] as $row)
                    {
                        // please align button and text
                        $line = '
                        <div class = "collapsible-header grey black-text">
                        <div>
                            <div class = "col s12 m12 l12">
                                <span> '.$row['title'].' </span>
                            </div>
                        </div>
                        </div>
                        <div class = "collapsible-body row">
                            <div class = "centerButton right-align">
                                <a class = "waves-effect btn-flat modal-trigger right-align" onclick="confirmDelete('.$row['ID'].')">
                                    Delete Announcement
                                </a>
                            </div>
                            <div class = "col s12 m12 l12" style = "padding: 6px;">
                                <pre style = "white-space: pre-line;">
                                '.$row['details'].'
                                </pre>
                            </div>
                            <br/>
                        </div>
                        ';
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

<!-- Modal for confirmin the deletion of the announcement -->
<div id = "deleteModal" class = "modal">
    <div class = "modal-content">
        <h5 class="center-align">Delete this announcement?</h5>
        <div class="center-align">h
          <a class = "waves-effect waves-light btn btn-large red darken-4" onclick = "deleteAnnouncement('<?= base_url();?>')">Yes</a>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <a class = "waves-effect waves-light btn btn-large blue darken-4" onclick = "$('#deleteModal').closeModal()">No</a>
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
