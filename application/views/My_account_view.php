<?php

defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

$this->load->view('Header');

$this->load->view('My_account_Dash');

$this->load->view('Common_scripts');

$this->load->view('My_account_script');

$this->load->view('Logout_script');
?>
	</body>
</html>
