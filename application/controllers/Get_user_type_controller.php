<?php
//this is the controller for the API that returns the type of the user in session
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_user_type_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//returns the user type
		echo $_SESSION["type"];
	}
}
?>
