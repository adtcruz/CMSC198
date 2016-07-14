<?php
//this is the controller for the API that deletes materials used for a job

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delete_materials_used_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
    //if it exists it means there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is a superadmin or technician
			//only superadmins and technicians can add and delete materials used for a job
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if materialsUsedID is defined in post
				if(array_key_exists("materialsUsedID",$_POST)){

					//loads codeigniter database module
					$this->load->database();

					//gets the jobID for recording of the action later
					$jobID = $this->db->query("SELECT jobID FROM materialsUsed WHERE materialsUsedID=".$_POST["materialsUsedID"]."")->result_array()[0]["jobID"];

					//deletes the row identified by materialsUsedID
					$this->db->query("DELETE FROM materialsUsed WHERE materialsUsedID=".$_POST["materialsUsedID"]."");

					//records this action to the userlogs
					$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." deleted a material for jobID #".$jobID."',CURRENT_TIMESTAMP)");

					//sends a message that material was deleted
					echo "Deleted material";

					//preterminates the execution of the script
					return;
				}
			}
		}
	}
}
?>
