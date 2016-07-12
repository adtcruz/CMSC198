<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view ('Header');
?>

<div class="row">
    <?php
        session_start ();
        $this->load->view('Sidenav');
    ?>
    <!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
    <div class="col s3 m3 l3"><br/><br/></div>
    <!-- MAIN CONTENT CONTAINER -->
    <div class="col s9 m9 l9">
        <br/><br/>
        <div class="row">
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="col s9 m9 l9 center-align">

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
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="row"></div>
        </div>
    </div>
    <!-- MAIN CONTENT CONTAINER END -->
</div>

<?php
$this->load->view ('Common_scripts');
$this->load->view ('Logout_script');
?>
</body>
</html>
