<?php
//this is the controller for the API that updates the materials used for a job
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_materials_used_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is either a superadmin or technician
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//if materialsUsedID array key exists in post
				if(array_key_exists("materialsUsedID",$_POST)){

					//if materialUnits array key exists in post
					if(array_key_exists("materialUnits",$_POST)){

						//if jobID array key exists in post
						if(array_key_exists("jobID",$_POST)){

							//loads code igniter database module
							$this->load->database();

							//updates the entry in the materials used table
							$this->db->query("UPDATE materialsUsed SET materialUnits=".$_POST["materialUnits"]." WHERE materialsUsedID=".$_POST["materialsUsedID"]."");

							//records this action to the logs
							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." updated a material for use in jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							//sends a message that the material used was updated
							echo "Updated material";

							//preterminates the excecution of the script
							return;
						}
					}
				}
			}
		}
	}
}
?>
