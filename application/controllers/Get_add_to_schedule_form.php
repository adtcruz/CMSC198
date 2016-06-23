<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_add_to_schedule_form extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
        $this->load->view('Add_to_schedule_form');
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
