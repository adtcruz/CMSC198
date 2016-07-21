<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('Header');
$this->load->view('Navbar');
?>
<div class="row">
    <?php $this->load->view('Sidenav', $unread);?>
    <div id="mainAppArea" class="container">
        <div class="row">
          <!-- Announcements View -->
          <?php
              $lines = array ();
              foreach ($announcements['announcements'] as $row)
              {
                  $line = '<div class = "collapsible-header grey white-text">'.$row['title'].'</div><div class = "collapsible-body">'.$row['details'].'</div>';
                  $lines[] = $line;
              }
              $attributes = array ('class' => 'collapsible', 'data-collapsible' => 'accordion');
              echo ul ($lines, $attributes);
          ?>
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
