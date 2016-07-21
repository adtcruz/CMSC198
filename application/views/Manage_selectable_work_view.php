<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('Header');

$this->load->view('Navbar');

$this->load->view('Manage_selectable_work_Dash', $unread);

$this->load->view('Common_scripts');

$this->load->view('Manage_selectable_work_script');

$this->load->view('Logout_script');

?>
	</body>
</html>
