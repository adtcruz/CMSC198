<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_work_done_controller extends CI_Controller
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

					//checks if workID is defined in POST
					if(array_key_exists("workID",$_POST)){

						//checks if workDuration is defined in POST
						if(array_key_exists("workDuration",$_POST)){

							//loads the codeigniter database module
							$this->load->database();

							//loads the job requests model to access the function to get the user id of the user in session
							$this->load->model('Job_requests_model','jrm');

							//add the work in the workdone table of the job
							$this->db->query("INSERT INTO workDone(workID,jobID,workDuration,dateCreated,createdBy,createdByType) VALUES (".$_POST["workID"].",".$_POST["jobID"].",".$_POST["workDuration"].",CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

							//record this activity to the logs
							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a work done for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							//send a message to jQuery that the work done was added
							echo "Added work done";

							//return to preterminate the script's execution
							return;
						}
					}
				}
			}
		}
	}
}
?>
