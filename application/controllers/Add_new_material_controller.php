<?php
//this API adds a new material to the materials table

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_new_material_controller extends CI_Controller
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

				//checks if materialName is defined in POST
				if(array_key_exists("materialName",$_POST)){

					//checks if materialDescription is defined in POST
					if(array_key_exists("materialDescription",$_POST)){

						//checks if materialCost is defined in POST
						if(array_key_exists("materialCost",$_POST)){

							//checks if materialUnitMeasurement in defined in POST
							if(array_key_exists("materialUnitMeasurement",$_POST)){

								//loads codeigniter database module
								$this->load->database();

								//loads the job requests model to access the function to getting the userid of the user in session
								$this->load->model('Job_requests_model','jrm');

								//add the new material to the materials table
								$this->db->query("INSERT INTO materials(materialName,materialDescription,materialCost,materialUnitMeasurement,dateCreated,createdBy,createdByType) VALUES ('".$_POST["materialName"]."','".$_POST["materialDescription"]."',".$_POST["materialCost"].",'".$_POST["materialUnitMeasurement"]."',CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

								//record this action to the user logs
								$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a new material option',CURRENT_TIMESTAMP)");

								//sens a message to jQuery that a new material was created
								echo "Added new material option";

								//preterminates the script execution
								return;
							}
						}
					}
				}
			}
		}
	}
}
?>
