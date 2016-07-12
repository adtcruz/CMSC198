

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <?php $this->load->view('Header');?>
    <?php $this->load->view('Sidenav');?>
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
            <div id="annAddTab" class="col s12">
                <!-- Announcements Add -->
                <?php
                    $this->load->helper ('form');
                    echo form_open ();
                    echo form_label ('Title', 'title');
                    echo form_input ('title', 'title');
                    echo form_label ('Text', 'text');
                    echo form_textarea ('text', 'text');
                    echo form_submit ();
                    echo form_reset ();
                    echo form_close ();
                ?>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <div id="mainAppArea" class="col s9 m9 l9 section">
        <div class="row">
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
            <br/>
            <br/>
        </div>
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
