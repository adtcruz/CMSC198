<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_logs_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if($_SESSION["type"]==="superadmin"){

				//checks if the API is accessed via POST
				if(array_key_exists("filter",$_POST)){

					$this->load->model('View_user_logs_model','vulm');


					if ($_POST["filter"]==="login"){
						echo $this->vulm->getLogInEntries();
					}

					if ($_POST["filter"]==="logout"){
						echo $this->vulm->getLogOutEntries();
					}

					if ($_POST["filter"]==="jobActions"){
						echo $this->vulm->getJobActionsEntries();
					}

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
