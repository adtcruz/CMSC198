<?php
//this is the controller for the API that gets the logs tables
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_logs_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		//if it does, it means that there's a user in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is a superadmin
			//only superadmins may access and view logs
			if($_SESSION["type"]==="superadmin"){

				//checks if the API is accessed via POST
				if(array_key_exists("filter",$_POST)){

					//loads the view user logs model to access functions that return the tables
					$this->load->model('View_user_logs_model','vulm');

					//if the filter parameter is set to login, return the login logs table
					if ($_POST["filter"]==="login"){
						echo $this->vulm->getLogInEntries();
					}

					//if the filter parameter is set to login, return the logout logs table
					if ($_POST["filter"]==="logout"){
						echo $this->vulm->getLogOutEntries();
					}

					//if the filter parameter is set to jobActions, return the jobActions logs table
					if ($_POST["filter"]==="jobActions"){
						echo $this->vulm->getJobActionsEntries();
					}

					//if the filter parameter is set to byUser, return the user logs table
					if ($_POST["filter"]==="byUser"){
						if(array_key_exists("username",$_POST)){
							echo $this->vulm->getUsersEntries($_POST["username"]);
						}
					}
				}
			}
		}
	}
}
?>
