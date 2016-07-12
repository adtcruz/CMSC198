<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     $this->load->view('Header');
    if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_page');
    else $this->load->view('GenerateReport_view_form');
    $this->load->view('Common_scripts');
    if(!array_key_exists("username",$_SESSION)) $this->load->view('Login_script');
    else{
	       $this->load->view('GenerateReport_scripts');
	       $this->load->view('Logout_script');
    }
?>
</body>
</html>
