<?php

defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

$this->load->view('Header');

if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_page');
else $this->load->view('JR_Dash');

$this->load->view('Common_scripts');

if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_script');
else{
	$this->load->view('File_JR_script'); 
	$this->load->view('Logout_script');
}
?>	
	</body>
</html>