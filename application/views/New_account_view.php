<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view('Header');
    $this->load->view('Navbar');
    $this->load->view('New_account_Dash', $unread);
    $this->load->view('New_account_script');
    $this->load->view('Logout_script');
?>
</body>
</html>
