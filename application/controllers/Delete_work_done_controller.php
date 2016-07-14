<?php
//this is the controller for the API that deletes work/services done for a job
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delete_work_done_controller extends CI_Controller
{
	public function index ()
	{

		//loads codeigniter database module
		session_start();

		//checks if the type array key exists in session
    //if it exists it means there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is a superadmin or technician
			//only superadmins and technicians can add and delete work/services done for a job
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if workDoneID is defined in post
				if(array_key_exists("workDoneID",$_POST)){

					//loads codeigniter database module
					$this->load->database();

					//gets the jobID for recording of the action later
					$jobID = $this->db->query("SELECT jobID FROM workDone WHERE workDoneID=".$_POST["workDoneID"]."")->result_array()[0]["jobID"];

					//deletes the row identified by workDoneID
					$this->db->query("DELETE FROM workDone WHERE workDoneID=".$_POST["workDoneID"]."");

					//records this action to the userlogs
					$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." deleted a material for jobID #".$jobID."',CURRENT_TIMESTAMP)");

					//sends a message that material was deleted
					echo "Deleted work done";

					//preterminates the execution of the script
					return;
				}
			}
		}
	}
}
?>
