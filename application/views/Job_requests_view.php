<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('Header');

$this->load->view('Job_requests_Dash');

$this->load->view ('Select2_JS_include.php');

$this->load->view('Job_requests_script');

if (($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")) $this->load->view('Job_request_content_script');

$this->load->view('Logout_script');
?>
	</body>
</html>
