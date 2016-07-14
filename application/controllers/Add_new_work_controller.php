<?php
/*
*   file: Add_new_work_controller.php
*       this controller is for the API that adds new work or services
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_new_work_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		//if it does it means there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is an admin, technician, or superadmin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if workDescription is defined in POST
				if(array_key_exists("workDescription",$_POST)){

					//checks if workCost is defined in POST
					if(array_key_exists("workCost",$_POST)){

						//loads codeigniter database module
						$this->load->database();

						//loads the job requests model to access the function to getting the userid of the user in session
						$this->load->model('Job_requests_model','jrm');

						//adds the new work or services into the work table
						$this->db->query("INSERT INTO work(workDescription,workCost,dateCreated,createdBy,createdByType) VALUES ('".$_POST["workDescription"]."',".$_POST["workCost"].",CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

						//record this into the user logs
						$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a new work option',CURRENT_TIMESTAMP)");

						//sends a message that a new work or service option was added
						echo "Added new work option";

						//preterminates the execution of the script
						return;
					}
				}
			}
		}
	}
}
?>
