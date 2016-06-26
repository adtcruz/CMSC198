<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('Header');

if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_page');
else $this->load->view('Dashboard');

$this->load->view('Common_scripts');

if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_script');
else{
	$this->load->view('Home_script');
	$this->load->view('Logout_script');
}
?>
	</body>
</html>
