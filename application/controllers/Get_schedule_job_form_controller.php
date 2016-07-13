<?php
//this is the controller for getting the schedule job forms
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_schedule_job_form_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//only technicians, admins, and superadmins may schedule jobs
			//passes the the schedule form
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
        $this->load->view('Job_requests_schedule_job_form');
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
