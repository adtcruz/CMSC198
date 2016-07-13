<?php
/*
* file: Add_materials_used_controller.php
*       This is the AJAX controller for adding materials used in the 'View Job Requests' function of the 'Job Requests' module
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_materials_used_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		//if it does it means there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is a technician or superadmin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if jobID is defined in POST
				if(array_key_exists("jobID",$_POST)){

					//checks if materialID is defined in POST
					if(array_key_exists("materialID",$_POST)){

						//checks if materialUnits is defined in POST
						if(array_key_exists("materialUnits",$_POST)){

							//loads codeigniter database module
							$this->load->database();

							//loads the job requests model to access the function to getting the userid of the user in session
							$this->load->model('Job_requests_model','jrm');

							//insert the material into materialsused table
							//adds a material in the materials used of a job
							$this->db->query("INSERT INTO materialsUsed(materialID,jobID,materialUnits,dateCreated,createdBy,createdByType) VALUES (".$_POST["materialID"].",".$_POST["jobID"].",".$_POST["materialUnits"].",CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

							//record this activity into the log
							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a material for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							//sends a message to jQuery or the calling function that a new material was added
							echo "Added new material";

							//returns for safety
							return;
						}
					}
				}
			}
		}
	}
}
?>
