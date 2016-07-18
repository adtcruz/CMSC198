<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view ('Header');
    $this->load->view ('Notifications_view_dash', $unread);
    $this->load->view ('Common_scripts');
    $this->load->view ('Notifications_view_script');
    $this->load->view ('Logout_script');
?>
