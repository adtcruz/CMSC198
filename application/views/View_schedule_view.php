<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('Header');

$this->load->view('View_schedule_Dash');

$this->load->view('Common_scripts');

$this->load->view('View_schedule_script');

if (($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")) $this->load->view('Job_request_content_script');

$this->load->view('Logout_script');

?>
	</body>
</html>
