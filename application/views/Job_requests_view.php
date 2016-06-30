<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('Header');

$this->load->view('Job_requests_Dash');

$this->load->view('Common_scripts');

$this->load->view('Job_requests_script');

if (($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")) $this->load->view('Update_job_request_script');

$this->load->view('Logout_script');
?>
	</body>
</html>
