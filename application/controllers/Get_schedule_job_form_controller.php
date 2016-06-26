<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_schedule_job_form_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
        $this->load->view('View_job_requests_schedule_job_form');
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
