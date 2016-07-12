<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view ('Header');
    $this->load->view ('Sidenav');
?>

<div class="row">
    <div class="col s3 m3 l3"><br/></div>
    <div class="col s9 m9 l9">
        <ul class="tabs">
            <li class="tab col s12"><a href="#annAddTab"> annAddTab </a></li>
            <li class="tab col s12"><a href="#annViewTab"> annViewTab </a></li>
        </ul>
    </div>
    <div id="annAddTab" class="col s12">
        <!-- Announcements Add -->
        <?php
            $this->load->helper ('form');
            echo form_open ('', 'id="addAnnForm"');
            echo form_hidden ('userDetails', array (
                'username' => $_SESSION['username'],
                'type' => $_SESSION['type']
            ));
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
                'name' => 'content',
                'id' => 'content',
                'placeholder' => 'Enter Announcement Content',
                'maxlength' => '1024',
                'rows' => '20',
                'cols' => '100',
                'style' => 'resize: none'
            );
            echo form_textarea ($param);
            echo form_submit ('Add Announcement');
            echo form_reset ('Reset Form');
            echo form_close ();
        ?>
    </div>
    <div id="annViewTab" class="col s12">
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
</div>


<?php
    $this->load->view ('Common_scripts');
    $this->load->view ('Logout_script');
?>
<script type="text/javascript">
    $('document').ready(
        function ()
        {
            $('#annButton').addClass("black");
            $('ul.tabs').tabs();
        }
    );
</script>
</body>
</html>
