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
            <li class="tab col s12"><a href="#annViewTab"> View Announcements </a></li>
            <li class="tab col s12"><a href="#annAddTab"> Add Announcements </a></li>
        </ul>
    </div>
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
                        'maxlength' => '128',
                        'size' => '20'
                    );
                    echo form_input ($params);
                    echo form_label ('Announcement Title', 'title');
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
                    echo '<div id="charCount"></div>';
                    echo '</div> </div> </div>';

                    // submit button
                    echo '<div class = "input-field col s10 m10 l10"> <div class = "mdl-textfield mdl-js-textfield" align = "right">';
                    $params = array (
                        'name' => 'annAdd',
                        'id' => 'annAdd',
                        'type' => 'submit',
                        'class' => 'btn waves-effect waves-light red',
                        'content' => 'Add Announcements'
                    );
                    echo form_button ($params);
                    echo '</div> </div>';

                    // reset button
                    echo '<div class = "input-field col s2 m2 l2"> <div class = "mdl-textfield mdl-js-textfield" align = "right">';
                    $params = array (
                        'name' => 'annRes',
                        'id' => 'annRes',
                        'type' => 'reset',
                        'class' => 'btn waves-effect waves-light red',
                        'content' => 'Reset Form'
                    );
                    echo form_button ($params);
                    echo '</div> </div>';

                    echo form_close ()
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
                        // please align button and text
                        $line = '
                        <div class = "collapsible-header blue-grey darken-1 white-text">
                            <div class = "col s10 m10 l10">
                                <span> '.$row['title'].' </span>
                            </div>
                            <div class = "col s2 m2 l2">
                                <a class = "waves-effect btn-flat"> Delete </a>
                            </div>
                        </div>
                        <div class = "collapsible-body">'.$row['details'].'</div>
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

<?php
    $this->load->view ('Common_scripts');
    $this->load->view ('Logout_script');
    $this->load->view ('Announcements_script');
?>
</body>

</html>
