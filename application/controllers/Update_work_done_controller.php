<?php
//this is the controller for the API that updates the work/service done in a job
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_work_done_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//if the type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is a superadmin or technician
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if workDoneID, workDuration, and jobID array key exist in POST
				if(array_key_exists("workDoneID",$_POST)){
					if(array_key_exists("workDuration",$_POST)){
						if(array_key_exists("jobID",$_POST)){

							//loads code igniter database module
							$this->load->database();

							//updates the work done entry
							//records the activity in the logs
							//sends a message that work done is updated
							$this->db->query("UPDATE workDone SET workDuration=".$_POST["workDuration"]." WHERE workDoneID=".$_POST["workDoneID"]."");
							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." updated a work done for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");
							echo "Updated work done";
							return;
						}
					}
				}
			}
		}
	}
}
?>
